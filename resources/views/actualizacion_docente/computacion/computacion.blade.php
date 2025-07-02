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
                <img src="{{ asset('images/Inscripción_computación.png') }}" alt="Icono Diploma" class="icon"> {{-- Asegúrate de tener un icono apropiado --}}
                <h2>Inscripción - Computación</h2>
                <p>Nombre: {{$currentUser['name']}}</p>
                <p>Institución: {{$currentUser['procedencia']}}</p>
                {{-- PASO 1.1: Agrega un ID al formulario --}}
                <form id="inscriptionForm" action="{{ url('/inscribir-usuario/' . $currentUser['id'] .'/1') }}" method="post">
                    @csrf
                {{-- PASO 1.2: Cambia el tipo de botón y añade un ID --}}
                <button type="button" id="openModalBtn" class="{{ $contagem_inscritos >= 30 || $currentUser['status'] != 0 ? 'disabled' : '' }}" {{ $contagem_inscritos >= 30 || $currentUser['status'] != 0 ? 'disabled' : '' }}>
                    Inscribirme
                </button>
                </form>
            </div>
    
            <div class="reminder-card">
               <h2><span>Recuerda que:</span> <span>{{ $contagem_inscritos }}/30</sapn></h2>
                <p>Solo puedes cambiar de curso si hay disponibilidad.</p>
                <p>Este curso tiene un cupo máximo para 30 participantes </p>
            </div>
        </div>

        {{-- PASO 1.3: Agrega el HTML para el modal --}}
        <div id="confirmationModal" class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <h2>Confirmar Inscripción</h2>
                <p>¿Estás seguro de que deseas inscribirte a este curso?</p>
                <div class="modal-buttons">
                    <button id="cancelBtn" class="modal-btn cancel">Cancelar</button>
                    <button id="confirmBtn" class="modal-btn confirm">Confirmar</button>
                </div>
            </div>
        </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- Elementos del DOM ---
        const modal = document.getElementById('confirmationModal');
        const openModalBtn = document.getElementById('openModalBtn');
        const confirmBtn = document.getElementById('confirmBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const closeButton = document.querySelector('.close-button');
        const inscriptionForm = document.getElementById('inscriptionForm');

        // --- Funciones para abrir y cerrar el modal ---
        const openModal = () => modal.style.display = 'block';
        const closeModal = () => modal.style.display = 'none';

        // --- Lógica de Eventos ---

        // 1. Abrir el modal al hacer clic en "Inscribirme", solo si no está deshabilitado.
        if (openModalBtn && !openModalBtn.disabled) {
            openModalBtn.addEventListener('click', openModal);
        }

        // 2. Cerrar el modal al hacer clic en "Cancelar" o en la 'X'.
        cancelBtn.addEventListener('click', closeModal);
        closeButton.addEventListener('click', closeModal);

        // 3. Cerrar el modal si se hace clic fuera de la caja de contenido.
        window.addEventListener('click', function (event) {
            if (event.target == modal) {
                closeModal();
            }
        });

        // 4. Enviar el formulario al hacer clic en "Confirmar".
        confirmBtn.addEventListener('click', function () {
            inscriptionForm.submit();
        });
    });
</script>