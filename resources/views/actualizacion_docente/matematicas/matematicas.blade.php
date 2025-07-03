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
                <img src="{{ asset('images/Inscripción_matematicas.png') }}" alt="Icono Diploma" class="icon">
                <h2>Inscripción - Matemáticas</h2>
                <p>Nombre: {{$currentUser['name']}}</p>
                <p>Institución: {{$currentUser['procedencia']}}</p>

                <form id="inscriptionForm" action="{{ url('/inscribir-usuario/' . $currentUser['id'] .'/3') }}" method="post">
                    @csrf
                 <button type="button" id="openModalBtn" class="{{ $contagem_inscritos >= 25 || $currentUser['status'] != 0 ? 'disabled' : '' }}" {{ $contagem_inscritos == 25 || $currentUser['status'] != 0 ? 'disabled' : '' }}>
                    Inscribirme
                </button>
                </form>
            </div>
    
            {{-- 1. MODIFICACIÓN HTML: Se añade data-materia-id y el id al span del contador --}}
            <div class="reminder-card" data-materia-id="3">
               <h2><span>Recuerda que:</span> <span><span id="inscritos-count">{{ $contagem_inscritos }}</span>/25 inscritos</span></h2>
                <p>Solo puedes cambiar de curso si hay disponibilidad.</p>
                <p>Este curso tiene un cupo máximo para 25 participantes </p>
            </div>
        </div>

        <div id="confirmationModal" class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <h2>Confirmar Inscripción</h2>
                <p>¿Estás seguro de que deseas inscribirte a Matemáticas?</p>
                <div class="modal-buttons">
                    <button id="cancelBtn" class="modal-btn cancel">Cancelar</button>
                    <button id="confirmBtn" class="modal-btn confirm">Confirmar</button>
                </div>
            </div>
        </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        console.log('Script de la página de Matemáticas cargado.');

        // --- LÓGICA DEL MODAL (EXISTENTE) ---
        // ... (el código del modal no se modifica) ...
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


        // --- LÓGICA PARA ACTUALIZAR CONTADOR CON DIAGNÓSTICO ---
        const reminderCard = document.querySelector('.reminder-card');
        const countElement = document.getElementById('inscritos-count');

        // Mensaje para ver si encontró los elementos
        console.log('Buscando elementos:', { reminderCard, countElement });

        if (reminderCard && countElement) {
            const materiaId = reminderCard.dataset.materiaId;
            console.log('✅ Elementos encontrados. Iniciando polling para materia ID:', materiaId);

            const fetchCount = () => {
                console.log('Consultando al servidor...'); // Verás esto cada 5 segundos
                fetch(`/materia/${materiaId}/inscritos`)
                .then(response => response.json())
                .then(data => {
                    if (data.count !== undefined) {
                        countElement.textContent = data.count;
                    }
                })
                .catch(error => console.error('Error durante el fetch:', error));
            };

            setInterval(fetchCount, 5000);
        } else {
            // Si llega aquí, es porque no encontró uno de los elementos
            console.error('❌ Error: No se encontraron los elementos HTML necesarios (.reminder-card o #inscritos-count). Revisa tu archivo Blade.');
        }
    });
</script>