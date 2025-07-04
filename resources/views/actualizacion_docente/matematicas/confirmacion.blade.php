@extends('actualizacion_docente.welcome')
@section('header_primero')
    <a class="barra-nav" href="{{ route('principal') }}">Inicio</a>
@endsection

@section('header_sesion')
    @if (session()->has('api_token'))
    <a class="barra-nav" href="{{ route('logout') }}"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Cerrar sesión
    </a>
    @else
    <a class="barra-nav" href="{{ route('registrarse') }}">Regístrate</a><a> / </a><a class="barra-nav" href="{{ route('iniciar_sesion') }}">Iniciar sesión</a>
    @endif

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
    </form>
@endsection

@if (session()->has('current_user_data'))
    @php
        $currentUser = session('current_user_data')
    @endphp
@endif
@section('contenido')
    
        <div class="content-area">
            <h1 class="main-title">Actualización docente educación media superior </h1>
    
            <div class="confirmacion-card">
                <img src="{{ asset('images/reactivo_inscrito.png') }}" alt="Icono Diploma" class="icon">
                <h2>Inscrito a Matemáticas</h2>
                <p>Nombre: {{$currentUser['name'] ?? 'N/A'}}</p>
                <p>Institución: {{$currentUser['procedencia'] ?? 'N/A'}}</p>
            </div>
    
            {{-- 1. MODIFICACIÓN HTML: Se añade data-materia-id y el id al span del contador --}}
            <div class="confirmacion-reminder-card" data-materia-id="3">
                <h2><span>Recuerda que:</span> <span><span id="inscritos-count" style="margin: 0;">{{ $contagem_inscritos ?? 0 }}</span>/25 inscritos</span></h2>
                <p>Los cursos se abren con un mínimo de 10 integrantes</p>
                <p>Si no se apertura un curso puedes darte de baja y elegir otro</p>
                <p>La fecha límite de registro es el 2 de Julio 2025</p>
            </div>
            
            <form id="form-baja"  class="baja" action="{{ url('/eliminar-inscripcion/' . ($currentUser['id'] ?? '')) }}" method="POST" style="display: inline;">
                @csrf
                @method('PUT')
                <button type="button" id="openBajaConfirmationModalBtn" style="background: none; border: none; padding: 0; cursor: pointer;">
                    <div class="baja">
                        <img src="{{ asset('images/Baja.png') }}" alt="Icono baja" class="icon" style="height:40px">
                        <p class="textoBaja"> Darse de baja </p>
                    </div>
                </button>
            </form>
        </div>

    <!-- Modal de Confirmación para Darse de Baja -->
    <div id="bajaConfirmationModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Confirmar Baja</h2>
            <p>¿Estás seguro de que deseas darte de baja de Matemáticas?</p>
            <div class="modal-buttons">
                <button id="cancelBajaBtn" class="modal-btn cancel">Cancelar</button>
                <button id="confirmBajaBtn" class="modal-btn confirm">Confirmar</button>
            </div>
        </div>
    </div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- LÓGICA DEL MODAL DE CONFIRMACIÓN PARA DARSE DE BAJA ---
        const bajaModal = document.getElementById('bajaConfirmationModal');
        const openBajaConfirmationModalBtn = document.getElementById('openBajaConfirmationModalBtn');
        const confirmBajaBtn = document.getElementById('confirmBajaBtn');
        const cancelBajaBtn = document.getElementById('cancelBajaBtn');
        const closeButton = bajaModal.querySelector('.close-button'); // Selector específico para este modal
        const formBaja = document.getElementById('form-baja');

        if (openBajaConfirmationModalBtn) {
            openBajaConfirmationModalBtn.addEventListener('click', () => {
                bajaModal.style.display = 'flex'; // Usar 'flex' para centrar
            });
        }

        if(cancelBajaBtn) {
            cancelBajaBtn.addEventListener('click', () => {
                bajaModal.style.display = 'none';
            });
        }

        if(closeButton) {
            closeButton.addEventListener('click', () => {
                bajaModal.style.display = 'none';
            });
        }

        if(confirmBajaBtn) {
            confirmBajaBtn.addEventListener('click', () => {
                formBaja.submit(); // Envía el formulario si el usuario confirma
            });
        }

        // Cierra el modal si se hace clic fuera del contenido
        window.addEventListener('click', (event) => {
            if (event.target == bajaModal) {
                bajaModal.style.display = 'none';
            }
        });


        // --- LÓGICA PARA ACTUALIZAR CONTADOR EN TIEMPO REAL ---
        const reminderCard = document.querySelector('.confirmacion-reminder-card');
        const countElement = document.getElementById('inscritos-count');

        if (reminderCard && countElement) {
            const materiaId = reminderCard.dataset.materiaId;

            const fetchCount = () => {
                // Llama a la ruta que apunta a tu FastApiController
                fetch(`/materia/${materiaId}/inscritos`)
                .then(response => response.json())
                .then(data => {
                    if (data.count !== undefined) {
                        countElement.textContent = data.count;
                    }
                })
                .catch(error => console.error('Error al actualizar el contador:', error));
            };

            // Llama a la función cada 5 segundos
            setInterval(fetchCount, 5000);
        }
    });
</script>
