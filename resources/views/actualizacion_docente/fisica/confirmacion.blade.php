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
                <h2>Inscrito a Física</h2>
                <p>Nombre: {{$currentUser['name']}}</p>
                <p>Institución: {{$currentUser['procedencia']}}</p>
            </div>
    
            {{-- 1. MODIFICACIÓN HTML: Se añade data-materia-id y el id al span del contador --}}
            <div class="confirmacion-reminder-card" data-materia-id="2">
                <h2><span>Recuerda que:</span> <span><span id="inscritos-count">{{ $contagem_inscritos }}</span>/20 inscritos</span></h2>
                <p>Los cursos se abren con un mínimo de 10 integrantes</p>
                <p>Si no se apertura un curso puedes darte de baja y elegir otro</p>
                <p>La fecha límite de registro es el 2 de Julio 2025</p>
            </div>
            <form id="form-baja"  class="baja" action="{{ url('/eliminar-inscripcion/' . $currentUser['id']) }}" method="POST" style="display: inline;">
                @csrf
                @method('PUT')
                <button type="submit"  style="background: none; border: none; padding: 0; cursor: pointer;">
                    <div class="baja">
                        <img src="{{ asset('images/Baja.png') }}" alt="Icono baja" class="icon" style="height:40px">
                        <p class="textoBaja"> Darse de baja </p>
            
                    </div>
                    </button>
            </form>
        </div>
@endsection

{{-- 2. JAVASCRIPT: Lógica para el contador en tiempo real --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const reminderCard = document.querySelector('.confirmacion-reminder-card');
        const countElement = document.getElementById('inscritos-count');

        if (reminderCard && countElement) {
            const materiaId = reminderCard.dataset.materiaId;

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