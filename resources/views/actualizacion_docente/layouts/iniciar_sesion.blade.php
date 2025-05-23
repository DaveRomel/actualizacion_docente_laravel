@extends('actualizacion_docente.welcome')

@extends('actualizacion_docente.welcome')

@section('header_primero')
    <a class="barra-nav" href="#">Actualización Docente</a>
@endsection

@section('header_sesion')
    <a class="barra-nav" href="{{ route('registrarse') }}">Regístrate</a>
@endsection


@section('contenido')

<div class="contenedor-formulario-inicio-sesion" style="max-height: 450px;">
    <img src="{{ asset('images/inicio_sesion.png') }}" alt="Icono editar" style="width: 80px; height: 80px;">
    <br>
    <div>
        <div class="titulo-iniciar-sesion"><strong>Iniciar Sesión</strong></div>
    </div>
    <br>
    <form action="#" method="POST">
        @csrf

        <div class="form-group-inicio-sesion">
            <input class="imput-inicio-sesion" type="email" name="correo" placeholder="Correo electrónico" required>
        </div>
        <br>
        <div class="form-group-inicio-sesion">
            <input class="imput-inicio-sesion" type="text" name="contraseña" placeholder="Contraseña" required>
        </div>
        <br>
        <button type="submit" class="btn-registrarme">Iniciar Sesión</button>
    </form>
</div>


@endsection