@extends('actualizacion_docente.welcome')

@section('header_primero')
    <a class="barra-nav" href="{{ route('index') }}">Actualización Docente</a>
@endsection

@section('header_sesion')
    <a class="barra-nav" href="{{ route('no_inscripcion') }}">Regístrate</a><a> / </a><a class="barra-nav" href="{{ route('iniciar_sesion') }}">Iniciar sesión</a>
@endsection


@section('contenido')

<div class="contenedor-formulario" style="height: auto;">
    <img src="{{ asset('images/contraseña.png') }}" alt="Icono editar" style="width: 70px; height: 80px;">
    <br>
    <div>
        <div class="titulo-registro"><strong>Recuperar Contraseña</strong></div>
    </div>
    <br>
    <form action="{{ url('/recuperar-password') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="email" name="email" placeholder="Ingrese su correo" required>
        </div>
        <br>
        <button type="submit" class="btn-registrarme">Enviar codigo</button>
    </form>
</div>

@endsection