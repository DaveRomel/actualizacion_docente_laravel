<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Registro Docente</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/registro-editar.css') }}">

    </head>
    <body>
        
        <header>
            <nav>
                <div><a class="barra-nav" href="#"><u>Inicio</u></a></div>
                <div ><a class="barra-nav" href="#"><u>Iniciar sesión</u></a></div>
            </nav>
        </header>

        <main class="fondo-personalizado">
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
                    <img src="{{ asset('images/ubicacion_gris.png') }}" alt="Logo" style="width: 40px; height: 50px;" >
                    <div class="footer-texto">
                        <p>Av. Doctor Modesto Seara Vázquez No.1, Acatlima,<br>
                        Heroica Ciudad de Huajuapan de León, Oax., México, C.P. 69004</p>
                    </div>
                </div>
            </div>
        </footer>
        
    </body>
</html>
