@extends('actualizacion_docente.welcome')

@section('header_primero')
    <a class="barra-nav" href="{{ route('index') }}">Actualización Docente</a>
@endsection

@section('header_sesion')
    <a class="barra-nav" href="{{ route('iniciar_sesion') }}">Iniciar sesión</a>
@endsection

@section('contenido')

<div class="contenedor-formulario" style="max-height: 450px;">
    <img src="{{ asset('images/registro.png') }}" alt="Icono registro" style="width: 40px; height: 40px;">
    <div>
        <div class="titulo-registro"><strong>Registro</strong></div>
    </div>
    {{-- Se ha añadido un ID al formulario para poder seleccionarlo con JavaScript --}}
    <form id="registroForm" action="{{ url('/api/crear-usuario') }}" method="POST">
        @csrf

        <div class="form-group">
            <input type="text" name="nombre" placeholder="Nombre" required>
        </div>

        <div class="form-group">
            <input type="tel" name="telefono" placeholder="Número de teléfono" required>
        </div>

        <div class="form-group">
            <input type="text" name="escuela" placeholder="Escuela de procedencia" required>
        </div>

        <div class="form-group">
            <input type="email" name="correo" placeholder="Correo electrónico" required>
        </div>

        <div class="form-group">
            <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña" required>
        </div>

        <div class="form-group">
            <input type="password" name="confirmar_contrasena" id="confirmar_contrasena" placeholder="Confirmar contraseña" required>
        </div>

        <button type="submit" class="btn-registrarme">Registrarme</button>
    </form>
</div>

<!-- Modal para correo ya registrado -->
<div id="emailExistsModal" class="modal">
    <div class="modal-content">
        {{-- Icono de error. Asegúrate de tener 'error_icon.png' en public/images/ o cámbialo por un SVG/Emoji --}}
        <img src="https://placehold.co/60x60/7E2C2C/ffffff?text=!" alt="Icono de error" class="modal-icon">
        <p class="modal-message">El correo electrónico ya ha sido registrado.</p>
        <button id="closeEmailModalBtn" class="modal-button">Cerrar</button>
    </div>
</div>

<!-- Nuevo Modal para contraseña no coincidente -->
<div id="passwordMismatchModal" class="modal">
    <div class="modal-content">
        <img src="https://placehold.co/60x60/7E2C2C/ffffff?text=!" alt="Icono de advertencia" class="modal-icon">
        <p class="modal-message">Las contraseñas no coinciden. Por favor, verifique.</p>
        <button id="closePasswordModalBtn" class="modal-button">Cerrar</button>
    </div>
</div>

{{-- Script JavaScript para manejar el envío del formulario y los modales --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtenemos referencias a los elementos del DOM
        const registroForm = document.getElementById('registroForm');
        const emailExistsModal = document.getElementById('emailExistsModal');
        const passwordMismatchModal = document.getElementById('passwordMismatchModal'); // Nuevo modal
        const closeModalBtn = document.getElementById('closeEmailModalBtn'); // Botón para modal de email
        const closePasswordModalBtn = document.getElementById('closePasswordModalBtn'); // Botón para modal de contraseña
        const contrasenaInput = document.getElementById('contrasena'); // Campo de contraseña
        const confirmarContrasenaInput = document.getElementById('confirmar_contrasena'); // Campo de confirmar contraseña


        // Verifica si el formulario fue encontrado
        if (!registroForm) {
            console.error('Error: El formulario con ID "registroForm" no fue encontrado en el DOM.');
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
        registroForm.addEventListener('submit', async function(event) {
            event.preventDefault(); // Previene el envío de formulario por defecto (recarga de página)

            // Validar que las contraseñas coincidan antes de cualquier otra cosa
            if (contrasenaInput.value !== confirmarContrasenaInput.value) {
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
            const formData = new FormData(registroForm);
            // Obtiene la URL de acción del formulario
            const actionUrl = registroForm.getAttribute('action');

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
                if (response.status === 400) { // Esperamos un 400 para correo ya registrado
                    const errorData = await response.json();
                    showModal(emailExistsModal); // Muestra el modal de correo existente
                } else if (response.ok) {
                    // Si la respuesta es exitosa (código 2xx), redirige a la página de inicio de sesión
                    window.location.href = '/iniciar_sesion';
                } else {
                    // Maneja otros errores (ej. errores de validación, errores del servidor 5xx)
                    const errorData = await response.json();
                    console.error('Error en el registro:', errorData.message || 'Error desconocido', 'Estado:', response.status);
                }
            } catch (error) {
                // Captura errores de red o errores que impiden que la petición se complete
                console.error('Error de red o del servidor:', error);
            }
        });

        // Añade event listeners para cerrar los modales
        closeModalBtn.addEventListener('click', () => hideModal(emailExistsModal));
        closePasswordModalBtn.addEventListener('click', () => hideModal(passwordMismatchModal));

        // Opcional: Cierra los modales si se hace clic fuera del contenido del modal
        emailExistsModal.addEventListener('click', function(event) {
            if (event.target === emailExistsModal) {
                hideModal(emailExistsModal);
            }
        });

        passwordMismatchModal.addEventListener('click', function(event) {
            if (event.target === passwordMismatchModal) {
                hideModal(passwordMismatchModal);
            }
        });
    });
</script>

@endsection