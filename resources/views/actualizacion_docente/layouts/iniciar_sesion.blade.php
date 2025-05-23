@extends('actualizacion_docente.welcome')
@section('contenido')



<div class="contenedor-formulario" style="max-height: 350px;">
    <img src="{{ asset('images/inicio_sesion.png') }}" alt="Icono editar" style="width: 40px; height: 40px;">
    <div>
        <div class="titulo-registro"><strong>Iniciar Sesión</strong></div>
    </div>
    <form action="#" method="POST">
        @csrf

        <div class="form-group">
            <input type="email" name="correo" placeholder="Correo electrónico" required>
        </div>

        <div class="form-group">
            <input type="text" name="contraseña" placeholder="Contraseña" required>
        </div>

        <button type="submit" class="btn-registrarme">Iniciar Sesión</button>
    </form>
</div>


@endsection