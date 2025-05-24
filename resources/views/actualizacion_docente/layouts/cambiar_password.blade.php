@extends('actualizacion_docente.welcome')

@section('header_primero')
    <a class="barra-nav" href="{{ route('index') }}">Actualización Docente</a>
@endsection

@section('header_sesion')
    <a class="barra-nav" href="{{ route('registrarse') }}">Regístrate</a><a> / </a><a class="barra-nav" href="{{ route('iniciar_sesion') }}">Iniciar sesión</a>
@endsection

@php
    $correo = session('correo')

@endphp


@section('contenido')

<div class="contenedor-formulario" style="max-height: 450px;">
    <img src="{{ asset('images/contraseña.png') }}" alt="Icono editar" style="width: 70px; height: 80px;">
    <br>
    <div>
        <div class="titulo-registro"><strong>Recuperar Contraseña</strong></div>
    </div>
    <br>
    <form action="{{ url('/cambiar-contrasena') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <input type="text" name="codigo" placeholder="Código (Enviado en su correo)" required>
        </div>

        <div class="form-group">
            <input type="password" name="nuevo_password" placeholder="Contraseña" required>
        </div>

        <div class="form-group">
            <input type="password" name="confirmar_password" placeholder="Confirmar Contraseña" required>
        </div>
        <br>
        <input type="hidden" name="email" value="{{$correo}}">
        <button type="submit" class="btn-registrarme">Enviar cambios</button>
    </form>
</div>

@endsection