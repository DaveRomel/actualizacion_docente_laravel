@extends('actualizacion_docente.welcome')

@section('header_primero')
    <a class="barra-nav" href="{{ route('principal') }}">Actualización Docente</a>
@endsection

@section('header_sesion')
    <a class="barra-nav" href="{{ route('no_inscripcion') }}">Regístrate</a><a> / </a><a class="barra-nav" href="{{ route('iniciar_sesion') }}">Iniciar sesión</a>
@endsection

@if (session()->has('current_user_data'))
    @php
        $currentUser = session('current_user_data')
    @endphp
@endif

@section('contenido')
<div class="contenedor-formulario" style="max-height: 450px;">
    <img src="{{ asset('images/registro.png') }}" alt="Icono editar" style="width: 80px; height: 80px;">
    <br>
    <div>
        <div class="titulo-registro"><strong>Editar información</strong></div>
    </div>
    <br>
    {{-- Se ha añadido un ID al formulario para poder seleccionarlo con JavaScript --}}
    <form id="editUserForm" action="{{ url('/actualizar-usuario/' . $currentUser['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <input type="text" name="name" value="{{$currentUser['name']}}" placeholder="Nombre" required>
        </div>

        <div class="form-group">
            <input type="tel" name="celular" value="{{$currentUser['celular']}}" placeholder="Número de teléfono" required>
        </div>

        <div class="form-group">
            <input type="text" name="procedencia" value="{{$currentUser['procedencia']}}" placeholder="Escuela de procedencia" required>
        </div>

        <div class="form-group">
            <input type="email" name="email" value="{{$currentUser['email']}}" placeholder="Correo electrónico" required>
        </div>
        <button type="submit" class="btn-registrarme">Guardar cambios</button>
    </form>
</div>

<!-- Modal para correo ya registrado en edición -->
<div id="editEmailExistsModal" class="modal">
    <div class="modal-content">
        {{-- Icono de error. Puedes usar el mismo placeholder o uno diferente --}}
        <img src="https://placehold.co/60x60/7E2C2C/ffffff?text=!" alt="Icono de error" class="modal-icon">
        <p class="modal-message">El nuevo correo electrónico ya está registrado.</p>
        <button id="closeEditEmailModalBtn" class="modal-button">Cerrar</button>
    </div>
</div>

{{-- Script JavaScript para manejar el envío del formulario y el modal --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Obtenemos referencias a los elementos del DOM
        const editUserForm = document.getElementById('editUserForm');
        const editEmailExistsModal = document.getElementById('editEmailExistsModal');
        const closeEditEmailModalBtn = document.getElementById('closeEditEmailModalBtn');

        // Verifica si el formulario fue encontrado
        if (!editUserForm) {
            console.error('Error: El formulario con ID "editUserForm" no fue encontrado en el DOM.');
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
        editUserForm.addEventListener('submit', async function(event) {
            event.preventDefault(); // Previene el envío de formulario por defecto (recarga de página)

            // Verifica si el token CSRF está disponible antes de intentar usarlo
            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            if (!csrfMeta) {
                console.error('Error: La meta etiqueta CSRF no fue encontrada. Asegúrate de que está en el <head> de tu layout principal.');
                return;
            }
            const csrfToken = csrfMeta.getAttribute('content');

            // Crea un objeto FormData a partir del formulario
            const formData = new FormData(editUserForm);
            // Obtiene la URL de acción del formulario
            const actionUrl = editUserForm.getAttribute('action');

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
                if (response.status === 400) { // Esperamos un 400 para correo ya registrado
                    const errorData = await response.json();
                    // Opcional: Puedes verificar el mensaje específico si lo deseas
                    // if (errorData.message === 'El correo electrónico ya ha sido registrado.') {
                        showModal(editEmailExistsModal); // Muestra el modal de correo existente
                    // } else {
                    //     console.error('Error 400 desconocido:', errorData.message || 'Error desconocido.');
                    // }
                } else if (response.ok) {
                    // Si la respuesta es exitosa (código 2xx), redirige a la página principal
                    window.location.href = '/principal'; // O la ruta a la que deba ir después de editar
                } else {
                    // Maneja otros errores (ej. errores del servidor 5xx)
                    const errorData = await response.json();
                    console.error('Error al actualizar el usuario:', errorData.message || 'Error desconocido', 'Estado:', response.status);
                    // Aquí podrías mostrar un mensaje de error genérico diferente si lo deseas
                }
            } catch (error) {
                // Captura errores de red o errores que impiden que la petición se complete
                console.error('Error de red o del servidor:', error);
                // Podrías mostrar un mensaje al usuario indicando problemas de conexión
            }
        });

        // Añade event listener para cerrar el modal de correo existente en edición
        closeEditEmailModalBtn.addEventListener('click', () => hideModal(editEmailExistsModal));

        // Opcional: Cierra el modal si se hace clic fuera del contenido del modal
        editEmailExistsModal.addEventListener('click', function(event) {
            if (event.target === editEmailExistsModal) {
                hideModal(editEmailExistsModal);
            }
        });
    });
</script>

@endsection