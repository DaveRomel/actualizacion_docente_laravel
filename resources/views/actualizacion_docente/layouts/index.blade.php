@extends('actualizacion_docente.welcome')

@section('header_primero')
    <a class="barra-nav" href="#">Actualización Docente</a>
@endsection

@section('header_sesion')
    <a class="barra-nav" href="{{ route('no_inscripcion') }}">Regístrate</a><a> / </a><a class="barra-nav" href="{{ route('iniciar_sesion') }}">Iniciar sesión</a>
@endsection

@section('contenido')
<img src="{{ asset('images/logo-blanco.png') }}" alt="Logo" style="width: 200px; height: 200px;" >
<div class="contenedor-lista">
    <div>
        <p class="mensaje-strong"><strong>Recuerda que:</strong></p>
    </div>
    <div class="mensajes">
        <ul>
            <li>
                <p>Los cursos se abren con un mínimo de 10 integrantes.</p>
            </li>
            <li>
                <p>Si no se apertura un curso puedes darte de baja y elegir otro.</p>
            </li>
            <li>
                <p>fecha <strong>límite </strong>de registro es el <strong>2 de julio de 2025.</strong></p>
            </li>
        </ul>
    </div>
</div>
@endsection