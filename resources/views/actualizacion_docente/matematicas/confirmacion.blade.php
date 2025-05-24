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
                <p>Nombre: {{$currentUser['name']}}</p>
                <p>Institución: {{$currentUser['procedencia']}}</p>
            </div>
    
            <div class="confirmacion-reminder-card">
                <h2><span>Recuerda que:</span> <span>{{ $contagem_inscritos }}/30</sapn></h2>
                <p>Los cursos se abren con un mínimo de 10 integrantes</p>
                <p>Si no se apertura un curso puedes darte de baja y elegir otro</p>
                <p>La fecha límite de registro es el 2 de Julio 2025</p>
            </div>
            <form id="form-baja"  class="baja" action="{{ url('/eliminar-inscripcion/' . $currentUser['id']) }}" method="POST" style="display: inline;">
                @csrf
                @method('PUT')
                <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                    <div class="baja">
                        <img src="{{ asset('images/Baja.png') }}" alt="Icono baja" class="icon" style="height:40px">
                        <p class="textoBaja"> Darse de baja </p>
            
                    </div>
                    </button>
                </form>
        </div>
@endsection