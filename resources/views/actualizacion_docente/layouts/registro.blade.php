@extends('actualizacion_docente.welcome')
<!-- 
COSAS QUE VARIAN PERO NO SE PUEDEN CAMBIAR:
head:
    <title>Registro Docente</title>
body:
    <header>
        <nav>
            <div><a class="barra-nav" href="#"><u>Inicio</u></a></div>
            <div><a class="barra-nav" href="#"><u>Iniciar sesión</u></a></div>
        </nav>
    </header>
-->
@section('contenido')

<div class="contenedor-formulario">
    <img src="{{ asset('images/registro.png') }}" alt="Icono registro" style="width: 80px; height: 80px;">
    <div>
        <div class="titulo-registro"><strong>Registro</strong></div>
    </div>
    <form action="#" method="POST">
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
