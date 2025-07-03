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
    <a class="barra-nav" href="{{ route('no_inscripcion') }}">Regístrate</a><a> / </a><a class="barra-nav" href="{{ route('iniciar_sesion') }}">Iniciar sesión</a>
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
                
                <form id="inscriptionForm" action="{{ url('/inscribir-usuario/' . $currentUser['id'] .'/2') }}" method="post">
                    @csrf
                <button type="button" id="openModalBtn" class="disabled" disabled>
                    Inscribirme
                </button>
                </form>
            </div>
    
            {{-- 1. MODIFICACIÓN HTML: Se añade data-materia-id y el id al span del contador --}}
            <div class="reminder-card" data-materia-id="2">
               <h2><span>Recuerda que:</span> <span><span id="inscritos-count">{{ $contagem_inscritos }}</span>/20 inscritos</span></h2>
                <p>Sólo puedes cambiar de curso si hay disponibilidad.</p>
                <p>Este curso tiene un cupo máximo para 20 participantes </p>
            </div>
        </div>

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
        // --- LÓGICA DEL MODAL (EXISTENTE) ---
        const modal = document.getElementById('confirmationModal');
        const openModalBtn = document.getElementById('openModalBtn');
        const confirmBtn = document.getElementById('confirmBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const closeButton = document.querySelector('.close-button');
        const inscriptionForm = document.getElementById('inscriptionForm');

        if (openModalBtn && !openModalBtn.disabled) {
            openModalBtn.addEventListener('click', () => modal.style.display = 'block');
        }
        if(cancelBtn) cancelBtn.addEventListener('click', () => modal.style.display = 'none');
        if(closeButton) closeButton.addEventListener('click', () => modal.style.display = 'none');
        if(confirmBtn) confirmBtn.addEventListener('click', () => inscriptionForm.submit());
        window.addEventListener('click', (event) => {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        });

        // --- 2. JAVASCRIPT: Lógica para el contador en tiempo real ---
        const reminderCard = document.querySelector('.reminder-card');
        const countElement = document.getElementById('inscritos-count');

        if (reminderCard && countElement) {
            const materiaId = reminderCard.dataset.materiaId; // Obtiene el "2"

            const fetchCount = () => {
                fetch(`/materia/${materiaId}/inscritos`)
                .then(response => response.json())
                .then(data => {
                    if (data.count !== undefined) {
                        countElement.textContent = data.count;
                    }
                })
                .catch(error => console.error('Error al actualizar el contador:', error));
            };

            setInterval(fetchCount, 5000); // Actualiza cada 5 segundos
        }
    });
</script>