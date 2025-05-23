@extends('actualizacion_docente.welcome')
@section('contenido')

<div class="contenedor-formulario" style="max-height: 450px;">
    <img src="{{ asset('images/contraseña.png') }}" alt="Icono editar" style="width: 70px; height: 80px;">
    <br>
    <div>
        <div class="titulo-registro"><strong>Recuperar Contraseña</strong></div>
    </div>
    <br>
    <form action="#" method="POST">
        @csrf

        <div class="form-group">
            <input type="text" name="codigo" placeholder="Código" required>
        </div>

        <div class="form-group">
            <input type="text" name="contraseña" placeholder="Contraseña" required>
        </div>

        <div class="form-group">
            <input type="text" name="confirmar" placeholder="Confirmar Contraseña" required>
        </div>
        <br>
        <button type="submit" class="btn-registrarme">Enviar cambios</button>
    </form>
</div>

@endsection