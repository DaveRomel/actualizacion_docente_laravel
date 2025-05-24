@extends('actualizacion_docente.welcome')

@extends('actualizacion_docente.welcome')

@section('header_primero')
    <a class="barra-nav" href="{{ route('index') }}">Actualización Docente</a>
@endsection

@section('header_sesion')
    <a class="barra-nav" href="{{ route('iniciar_sesion') }}">Iniciar sesión</a>
@endsection


@section('contenido')

<div class="contenedor-formulario" style="max-height: 450px;">
    <img src="{{ asset('images/registro.png') }}" alt="Icono registro" style="width: 40px; height: 40px;">
    <div>
        <div class="titulo-registro"><strong>Registro</strong></div>
    </div>
    <form action="{{ url('/api/crear-usuario') }}" method="POST">
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

        <div class="form-group">
            <input type="password" name="contrasena" placeholder="Contraseña" required>
        </div>

        <div class="form-group">
            <input type="password" name="confirmar_contrasena" placeholder="Confirmar contraseña" required>
        </div>

        <button type="submit" class="btn-registrarme">Registrarme</button>
    </form>
</div>

@endsection