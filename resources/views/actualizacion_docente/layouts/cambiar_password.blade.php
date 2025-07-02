@extends('actualizacion_docente.welcome')

@section('header_primero')
    <a class="barra-nav" href="{{ route('index') }}">Actualización Docente</a>
@endsection

@section('header_sesion')
    <a class="barra-nav" href="{{ route('registrarse') }}">Regístrate</a><a> / </a><a class="barra-nav" href="{{ route('iniciar_sesion') }}">Iniciar sesión</a>
@endsection

@php
    $correo = session('correo')
@endphp


@section('contenido')

<div class="contenedor-formulario" style="max-height: 450px;">
    <img src="{{ asset('images/contraseña.png') }}" alt="Icono editar" style="width: 70px; height: 80px;">
    <br>
    <div>
        <div class="titulo-registro"><strong>Recuperar Contraseña</strong></div>
    </div>
    <br>
    {{-- Se ha añadido un ID al formulario para poder seleccionarlo con JavaScript --}}
    <form id="cambiarPasswordForm" action="{{ url('/cambiar-contrasena') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <input type="text" name="codigo" placeholder="Código (Enviado en su correo)" required>
        </div>

        <div class="form-group">
            <input type="password" name="nuevo_password" id="nuevo_password" placeholder="Contraseña" required>
        </div>

        <div class="form-group">
            <input type="password" name="confirmar_password" id="confirmar_password" placeholder="Confirmar Contraseña" required>
        </div>
        <br>
        <input type="hidden" name="email" value="{{$correo}}">
        <button type="submit" class="btn-registrarme">Enviar cambios</button>
    </form>
</div>

<!-- Modal para contraseñas no coincidentes -->
<div id="passwordMismatchModal" class="modal">
    <div class="modal-content">
        <img src="https://placehold.co/60x60/7E2C2C/ffffff?text=!" alt="Icono de advertencia" class="modal-icon">
        <p class="modal-message">Las contraseñas no coinciden. Por favor, verifique.</p>
        <button id="closePasswordMismatchModalBtn" class="modal-button">Cerrar</button>
    </div>
</div>

<!-- Modal para código incorrecto -->
<div id="incorrectCodeModal" class="modal">
    <div class="modal-content">
        <img src="https://placehold.co/60x60/7E2C2C/ffffff?text=!" alt="Icono de error" class="modal-icon">
        <p class="modal-message">El código de verificación no es correcto.</p>
        <button id="closeIncorrectCodeModalBtn" class="modal-button">Cerrar</button>
    </div>
</div>

{{-- Script JavaScript para manejar el envío del formulario y los modales --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtenemos referencias a los elementos del DOM
        const cambiarPasswordForm = document.getElementById('cambiarPasswordForm');
        const nuevoPasswordInput = document.getElementById('nuevo_password');
        const confirmarPasswordInput = document.getElementById('confirmar_password');
        const passwordMismatchModal = document.getElementById('passwordMismatchModal');
        const incorrectCodeModal = document.getElementById('incorrectCodeModal');
        const closePasswordMismatchModalBtn = document.getElementById('closePasswordMismatchModalBtn');
        const closeIncorrectCodeModalBtn = document.getElementById('closeIncorrectCodeModalBtn');

        // Verifica si el formulario fue encontrado
        if (!cambiarPasswordForm) {
            console.error('Error: El formulario con ID "cambiarPasswordForm" no fue encontrado en el DOM.');
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
        cambiarPasswordForm.addEventListener('submit', async function(event) {
            event.preventDefault(); // Previene el envío de formulario por defecto (recarga de página)

            // 1. Validar que las contraseñas coincidan
            if (nuevoPasswordInput.value !== confirmarPasswordInput.value) {
                showModal(passwordMismatchModal); // Muestra el modal de error de contraseña
                return; // Detiene la ejecución del envío del formulario
            }

            // Verifica si el token CSRF está disponible antes de intentar usarlo
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            if (!csrfMeta) {
                console.error('Error: La meta etiqueta CSRF no fue encontrada. Asegúrate de que está en el <head> de tu layout principal.');
                return;
            }
            const csrfToken = csrfMeta.getAttribute('content');

            // Crea un objeto FormData a partir del formulario
            const formData = new FormData(cambiarPasswordForm);
            // Obtiene la URL de acción del formulario
            const actionUrl = cambiarPasswordForm.getAttribute('action');

            try {
                // Realiza la petición asíncrona usando fetch API
                const response = await fetch(actionUrl, {
                    method: 'POST', // Laravel maneja @method('PUT') con POST para formularios HTML
                    body: formData, // Datos del formulario
                    headers: {
                        // Incluye el token CSRF para la seguridad de Laravel
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json' // Solicita una respuesta JSON explícitamente
                    }
                });

                // Verifica el código de estado de la respuesta
                if (response.status === 500) { // Esperamos un 500 para código incorrecto o error del servidor
                    const errorData = await response.json();
                    // Puedes verificar el mensaje específico si tu API lo devuelve,
                    // o simplemente mostrar el modal genérico para 500 en esta ruta.
                    showModal(incorrectCodeModal); // Muestra el modal de código incorrecto
                } else if (response.ok) {
                    // Si la respuesta es exitosa (código 2xx), Laravel redirigirá
                    // el navegador a /iniciar_sesion como está configurado en el controlador.
                    window.location.href = '/iniciar_sesion';
                } else {
                    // Maneja otros errores (ej. errores de validación, otros errores del servidor)
                    const errorData = await response.json();
                    console.error('Error al cambiar la contraseña:', errorData.message || 'Error desconocido', 'Estado:', response.status);
                    // Aquí podrías mostrar un mensaje de error genérico diferente si lo deseas
                }
            } catch (error) {
                // Captura errores de red o errores que impiden que la petición se complete
                console.error('Error de red o del servidor:', error);
                // Podrías mostrar un mensaje al usuario indicando problemas de conexión
            }
        });

        // Añade event listeners para cerrar los modales
        closePasswordMismatchModalBtn.addEventListener('click', () => hideModal(passwordMismatchModal));
        closeIncorrectCodeModalBtn.addEventListener('click', () => hideModal(incorrectCodeModal));

        // Opcional: Cierra los modales si se hace clic fuera del contenido del modal
        passwordMismatchModal.addEventListener('click', function(event) {
            if (event.target === passwordMismatchModal) {
                hideModal(passwordMismatchModal);
            }
        });

        incorrectCodeModal.addEventListener('click', function(event) {
            if (event.target === incorrectCodeModal) {
                hideModal(incorrectCodeModal);
            }
        });
    });
</script>

@endsection
