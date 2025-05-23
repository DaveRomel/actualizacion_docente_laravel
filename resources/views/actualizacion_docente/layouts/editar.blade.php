@extends('actualizacion_docente.welcome')
<!-- 
COSAS QUE VARIAN PERO NO SE PUEDEN CAMBIAR:
head:
    <title>Actualizar Información</title>
body:
    <header>
        <nav>
            <div><a class="barra-nav" href="#">Inicio</a></div>
        </nav>
    </header>
-->
@section('contenido')

<div class="contenedor-formulario">
    <img src="{{ asset('images/registro.png') }}" alt="Icono editar" style="width: 80px; height: 80px;">
    <div>
        <div class="titulo-registro"><strong>Editar información</strong></div>
    </div>
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
    
