<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Actualización Docente</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body>
        
        <header>
            <nav>
                <div><a class="barra-nav" href="#">Inicio</a></div>
                <div ><a class="barra-nav" href="#">Regístrate</a><a> / </a><a class="barra-nav" href="#">Iniciar sesión</a></div>
            </nav>
        </header>

        <main class="fondo-personalizado">
            <img src="{{ asset('images/logo-blanco.png') }}" alt="Logo" style="width: 200px; height: 200px;" >
            <div class="contenedor-lista">
                <div>
                    <p class="mensaje-strong"><strong>Recuerda que:</strong></p>
                </div>
                <div class="mensajes">
                    <ul>
                        <li>
                            <p>Los cursos se abren con un mínimo de 10 integrantes</p>
                        </li>
                        <li>
                            <p>Si no se apertura un curso puedes darte de baja y elegir otro</p>
                        </li>
                        <li>
                            <p>fecha límite de registro es el <strong>2 de julio de 2025</strong></p>
                        </li>
                    </ul>
                </div>
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
                    <img src="{{ asset('images/posicion.png') }}" alt="Logo" style="width: 40px; height: 50px;" >
                    <div class="footer-texto">
                        <p>Av. Doctor Modesto Seara Vázquez No.1, Acatlima,<br>
                        Heroica Ciudad de Huajuapan de León, Oax., México, C.P. 69004</p>
                    </div>
                </div>
            </div>
        </footer>
        
    </body>
</html>
