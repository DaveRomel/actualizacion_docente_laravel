@extends('actualizacion_docente.welcome')

@section('header_primero')
    <a class="barra-nav" href="{{ route('index') }}">Actualización Docente</a>
@endsection

@section('header_sesion')
    <a class="barra-nav" href="{{ route('registrarse') }}">Regístrate</a>
@endsection


@section('contenido')

@if (session()->has('error'))
    <div class="custom-alert-error">
        {{ session('error') }}
    </div>
@endif

<div class="contenedor-formulario-inicio-sesion" style="max-height: 450px;">
    <img src="{{ asset('images/inicio_sesion.png') }}" alt="Icono editar" style="width: 80px; height: 80px;">
    <br>
    <div>
        <div class="titulo-iniciar-sesion"><strong>Iniciar Sesión</strong></div>
    </div>
    <br>
    <form action="{{ url('/login') }}" method="POST">
        @csrf
        <div class="form-group-inicio-sesion">
            <input class="imput-inicio-sesion" type="text" name="username" placeholder="Correo electrónico" required>
        </div>
        <br>
        <div class="form-group-inicio-sesion">
            <input class="imput-inicio-sesion" type="password" name="password" placeholder="Contraseña" required>
        </div>
        <br>
        <button type="submit" class="btn-registrarme">Iniciar Sesión</button>
    </form>
    <br>
    <a href="{{ route('cambiar_contrasena') }}" class="pass_olvidado" style="color: #7E2C2C; font-style: italic;">Olvidaste tu contraseña</a>



</div>


@endsection