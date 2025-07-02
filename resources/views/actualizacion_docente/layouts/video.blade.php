@extends('actualizacion_docente.welcome')

@section('header_primero')
    <a class="barra-nav" href="#">Actualización Docente</a>
@endsection

@section('header_sesion')
    <a class="barra-nav" href="{{ route('registrarse') }}">Regístrate</a><a> / </a><a class="barra-nav" href="{{ route('iniciar_sesion') }}">Iniciar sesión</a>
@endsection

@section('contenido')

    <video width="640" height="360" controls>
        <source src="{{ asset('videos/registro_actualizacion_docente_2025.mp4') }}" type="video/mp4">
            Tu navegador no soporta el video.
    </video>

@endsection