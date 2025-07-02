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
            <h1 class="main-title">Actualización docente educación media superior</h1>
    
            <div class="inscription-card">
                <img src="{{ asset('images/Inscripción_fisica.png') }}" alt="Icono Diploma" class="icon">
                <h2>Inscripción - Física</h2>
                <p>Nombre: {{$currentUser['name']}}</p>
                <p>Institución: {{$currentUser['procedencia']}}</p>
                
                {{-- 1. Añadir ID al formulario --}}
                <form id="inscriptionForm" action="{{ url('/inscribir-usuario/' . $currentUser['id'] .'/2') }}" method="post">
                    @csrf
                {{-- 2. Cambiar tipo de botón y añadir ID --}}
                <button type="button" id="openModalBtn" class="{{ $contagem_inscritos >= 20 || $currentUser['status'] != 0 ? 'disabled' : '' }}" {{ $contagem_inscritos >= 20 || $currentUser['status'] != 0 ? 'disabled' : '' }}>
                    Inscribirme
                </button>
                </form>
            </div>
    
            <div class="reminder-card">
               <h2><span>Recuerda que:</span> <span>{{ $contagem_inscritos }}/20</sapn></h2>
                <p>Sólo puedes cambiar de curso si hay disponibilidad.</p>
                <p>Este curso tiene un cupo máximo para 20 participantes </p>
            </div>
        </div>

        {{-- 3. Añadir HTML del modal --}}
        <div id="confirmationModal" class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <h2>Confirmar Inscripción</h2>
                <p>¿Estás seguro de que deseas inscribirte a Física?</p>
                <div class="modal-buttons">
                    <button id="cancelBtn" class="modal-btn cancel">Cancelar</button>
                    <button id="confirmBtn" class="modal-btn confirm">Confirmar</button>
                </div>
            </div>
        </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Elementos del DOM
        const modal = document.getElementById('confirmationModal');
        const openModalBtn = document.getElementById('openModalBtn');
        const confirmBtn = document.getElementById('confirmBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const closeButton = document.querySelector('.close-button');
        const inscriptionForm = document.getElementById('inscriptionForm');

        // Funciones para abrir y cerrar el modal
        const openModal = () => modal.style.display = 'block';
        const closeModal = () => modal.style.display = 'none';

        // Abrir el modal, solo si el botón no está deshabilitado
        if (openModalBtn && !openModalBtn.disabled) {
            openModalBtn.addEventListener('click', openModal);
        }

        // Cerrar el modal
        cancelBtn.addEventListener('click', closeModal);
        closeButton.addEventListener('click', closeModal);
        window.addEventListener('click', function (event) {
            if (event.target == modal) {
                closeModal();
            }
        });

        // Enviar el formulario al confirmar
        confirmBtn.addEventListener('click', function () {
            inscriptionForm.submit();
        });
    });
</script>