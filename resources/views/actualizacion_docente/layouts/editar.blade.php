@extends('actualizacion_docente.welcome')

@extends('actualizacion_docente.welcome')

@section('header_primero')
    <a class="barra-nav" href="#">Actualización Docente</a>
@endsection

@section('header_sesion')
    <a class="barra-nav" href="{{ route('registrarse') }}">Regístrate</a><a> / </a><a class="barra-nav" href="{{ route('iniciar_sesion') }}">Iniciar sesión</a>
@endsection

@if (session()->has('current_user_data'))
    @php
        $currentUser = session('current_user_data')
    @endphp
@endif

@section('contenido')
<div class="contenedor-formulario" style="max-height: 450px;">
    <img src="{{ asset('images/registro.png') }}" alt="Icono editar" style="width: 80px; height: 80px;">
    <br>
    <div>
        <div class="titulo-registro"><strong>Editar información</strong></div>
    </div>
    <br>
    <form action="{{ url('/actualizar-usuario/' . $currentUser['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <input type="text" name="name" value="{{$currentUser['name']}}" placeholder="Nombre" required>
        </div>

        <div class="form-group">
            <input type="tel" name="celular" value="{{$currentUser['celular']}}" placeholder="Número de teléfono" required>
        </div>

        <div class="form-group">
            <input type="text" name="procedencia" value="{{$currentUser['procedencia']}}" placeholder="Escuela de procedencia" required>
        </div>

        <div class="form-group">
            <input type="email" name="email" value="{{$currentUser['email']}}" placeholder="Correo electrónico" required>
        </div>
        <button type="submit" class="btn-registrarme">Guardar cambios</button>
    </form>
</div>

@endsection