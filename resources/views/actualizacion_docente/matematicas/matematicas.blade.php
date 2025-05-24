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
                <img src="{{ asset('images/inscripción_matematicas.png') }}" alt="Icono Diploma" class="icon"> {{-- Asegúrate de tener un icono apropiado --}}
                <h2>Inscripción - Matemáticas</h2>
                <p>Nombre: {{$currentUser['name']}}</p>
                <p>Institución: {{$currentUser['procedencia']}}</p>
                <button>Inscribirme</button>
            </div>
    
            <div class="reminder-card">
               <h2><span>Recuerda que:</span> <span>5/25</sapn></h2>
                <p>Solo puedes cambiar de curso si hay disponibilidad.</p>
                <p>Este curso tiene un cupo máximo para 25 participantes </p>
            </div>
        </div>
@endsection