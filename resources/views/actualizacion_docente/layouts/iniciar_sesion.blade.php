@extends('actualizacion_docente.welcome')

@section('header_primero')
    <a class="barra-nav" href="{{ route('index') }}">Actualización Docente</a>
@endsection

@section('header_sesion')
    <a class="barra-nav" href="{{ route('no_registro') }}">Regístrate</a>
@endsection

@section('contenido')

{{-- El alert de sesión ya no será necesario si el modal maneja los errores --}}
@if (session()->has('error'))
    <div class="custom-alert-error" style="display: none;"> {{-- Ocultamos este div --}}
        {{ session('error') }}
    </div>
@endif

<div class="contenedor-formulario-inicio-sesion" style="max-height: 450px;">
    <img src="{{ asset('images/inicio_sesion.png') }}" alt="Icono editar" style="width: 80px; height: 80px;">
    <br>
    <div>
        <div class="titulo-iniciar-sesion"><strong>Iniciar Sesión</strong></div>
    </div>
    <br>
    {{-- Se ha añadido un ID al formulario para poder seleccionarlo con JavaScript --}}
    <form id="loginForm" action="{{ url('/login') }}" method="POST">
        @csrf
        <div class="form-group-inicio-sesion">
            <input class="imput-inicio-sesion" type="text" name="username" placeholder="Correo electrónico" required>
        </div>
        <br>
        <div class="form-group-inicio-sesion">
            <input class="imput-inicio-sesion" type="password" name="password" placeholder="Contraseña" required>
        </div>
        <br>
        <button type="submit" class="btn-registrarme">Iniciar Sesión</button>
    </form>
    <br>
    <a href="{{ route('cambiar_contrasena') }}" class="pass_olvidado" style="color: #7E2C2C; font-style: italic;">Olvidaste tu contraseña</a>
</div>

<!-- Modal para credenciales incorrectas -->
<div id="loginErrorModal" class="modal">
    <div class="modal-content">
        {{-- Icono de error. Puedes usar el mismo placeholder o uno diferente --}}
        <img src="https://placehold.co/60x60/7E2C2C/ffffff?text=!" alt="Icono de error" class="modal-icon">
        <p class="modal-message">Correo o contraseña incorrectos.</p>
        <button id="closeLoginModalBtn" class="modal-button">Cerrar</button>
    </div>
</div>

{{-- Script JavaScript para manejar el envío del formulario y el modal --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtenemos referencias a los elementos del DOM
        const loginForm = document.getElementById('loginForm');
        const loginErrorModal = document.getElementById('loginErrorModal');
        const closeLoginModalBtn = document.getElementById('closeLoginModalBtn');

        // Verifica si el formulario fue encontrado
        if (!loginForm) {
            console.error('Error: El formulario con ID "loginForm" no fue encontrado en el DOM.');
            return;
        }

        /**
         * Muestra un modal específico.
         * @param {HTMLElement} modalElement - El elemento del modal a mostrar.
         */
        function showModal(modalElement) {
            if (modalElement) {
                modalElement.style.display = 'flex';
            }
        }

        /**
         * Oculta un modal específico.
         * @param {HTMLElement} modalElement - El elemento del modal a ocultar.
         */
        function hideModal(modalElement) {
            if (modalElement) {
                modalElement.style.display = 'none';
            }
        }

        // Añade un event listener para el envío del formulario
        loginForm.addEventListener('submit', async function(event) {
            event.preventDefault(); // Previene el envío de formulario por defecto (recarga de página)

            // Verifica si el token CSRF está disponible antes de intentar usarlo
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            if (!csrfMeta) {
                console.error('Error: La meta etiqueta CSRF no fue encontrada. Asegúrate de que está en el <head> de tu layout principal.');
                return;
            }
            const csrfToken = csrfMeta.getAttribute('content');

            // Crea un objeto FormData a partir del formulario
            const formData = new FormData(loginForm);
            // Obtiene la URL de acción del formulario
            const actionUrl = loginForm.getAttribute('action');

            try {
                // Realiza la petición asíncrona usando fetch API
                const response = await fetch(actionUrl, {
                    method: 'POST', // Método POST
                    body: formData, // Datos del formulario
                    headers: {
                        // Incluye el token CSRF para la seguridad de Laravel
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json' // Solicita una respuesta JSON explícitamente
                    }
                });

                // Verifica el código de estado de la respuesta
                if (response.status === 401) { // Esperamos un 401 para credenciales incorrectas
                    // No es necesario parsear el JSON si solo mostramos un mensaje genérico.
                    // const errorData = await response.json(); // Si quisieras un mensaje dinámico
                    showModal(loginErrorModal); // Muestra el modal de error de login
                } else if (response.ok) {
                    // Si la respuesta es exitosa (código 2xx), redirige a la página principal
                    // Esto asume que el controlador Laravel ya maneja la redirección en caso de éxito.
                    window.location.href = '/principal'; // Redirige a la ruta principal
                } else {
                    // Maneja otros errores (ej. errores del servidor 5xx)
                    const errorData = await response.json();
                    console.error('Error en el inicio de sesión:', errorData.message || 'Error desconocido', 'Estado:', response.status);
                    // Aquí podrías mostrar un mensaje de error genérico diferente si lo deseas
                }
            } catch (error) {
                // Captura errores de red o errores que impiden que la petición se complete
                console.error('Error de red o del servidor:', error);
                // Podrías mostrar un mensaje al usuario indicando problemas de conexión
            }
        });

        // Añade event listener para cerrar el modal de login
        closeLoginModalBtn.addEventListener('click', () => hideModal(loginErrorModal));

        // Opcional: Cierra el modal si se hace clic fuera del contenido del modal
        loginErrorModal.addEventListener('click', function(event) {
            if (event.target === loginErrorModal) {
                hideModal(loginErrorModal);
            }
        });
    });
</script>

@endsection
