@extends('actualizacion_docente.welcome')

@extends('actualizacion_docente.welcome')

@section('header_primero')
    <a class="barra-nav" href="#">Actualización Docente</a>
@endsection

@section('header_sesion')
    <a class="barra-nav" href="{{ route('registrarse') }}">Regístrate</a><a> / </a><a class="barra-nav" href="{{ route('iniciar_sesion') }}">Iniciar sesión</a>
@endsection


@section('contenido')
<div class="contenedor-formulario" style="max-height: 450px;">
    <img src="{{ asset('images/registro.png') }}" alt="Icono editar" style="width: 80px; height: 80px;">
    <br>
    <div>
        <div class="titulo-registro"><strong>Editar información</strong></div>
    </div>
    <br>
    <form action="#" method="PUT">
        @csrf

        <div class="form-group">
            <input type="text" name="nombre" placeholder="Nombre" required>
        </div>

        <div class="form-group">
            <input type="tel" name="telefono" placeholder="Número de teléfono" required>
        </div>

        <div class="form-group">
            <input type="text" name="escuela" placeholder="Escuela de procedencia" required>
        </div>

        <div class="form-group">
            <input type="email" name="correo" placeholder="Correo electrónico" required>
        </div>
        
        <button type="submit" class="btn-registrarme">Guardar cambios</button>
    </form>
</div>

@endsection