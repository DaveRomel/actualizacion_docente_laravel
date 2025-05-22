<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Actualizar Información</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/registro-editar.css') }}">
</head>
<body>

    <header>
        <nav>
            <div><a class="barra-nav" href="#"><u>Inicio</u></a></div>
        </nav>
    </header>

    <main class="fondo-personalizado">
        <div class="contenedor-formulario2">
            <img src="{{ asset('images/registro.png') }}" alt="Icono editar" style="width: 80px; height: 80px;">
            <div>
                <div class="titulo-registro"><strong>Editar información</strong></div>
            </div>
            <form action="#" method="POST">
                @csrf
                <!-- @method('PUT') si es necesario -->

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

                <!-- <div class="form-group">
                    <input type="password" name="contrasena" placeholder="Nueva contraseña">
                </div>

                <div class="form-group">
                    <input type="password" name="confirmar_contrasena" placeholder="Confirmar nueva contraseña">
                </div> -->

                <button type="submit" class="btn-registrarme">Guardar cambios</button>
            </form>
        </div>
    </main>

    <footer>
        <div class="container">
            <div>
                <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width: 60px; height: 60px;" >
                <div class="footer-uni">
                    <p>Universidad Tecnológica de la Mixteca</p>
                </div>
            </div>
            <div>
                <img src="{{ asset('images/ubicacion_gris.png') }}" alt="Ubicación" style="width: 40px; height: 50px;" >
                <div class="footer-texto">
                    <p>Av. Doctor Modesto Seara Vázquez No.1, Acatlima,<br>
                    Heroica Ciudad de Huajuapan de León, Oax., México, C.P. 69004</p>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
