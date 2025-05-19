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
                <div><strong>Inicio</strong></div>
                <div><a href="#">Regístrate</a><a> / </a><a href="#">Iniciar sesión</a></div>
                
            </nav>
        </header>

        <main>
            <img src="{{ asset('images/logo-blanco.png') }}" alt="Logo" style="width: 200px; height: 200px;" >
            <div class="mensaje">
                <p><strong>Recuerda que:</strong></p>
                <p> los cursos se abren con un mínimo de 10 integrantes</p>
                <p>Si no se apertura un curso puedes darte de baja y elegir otro</p>
                <p>La fecha límite de registro es el <strong>2 de julio de 2025</strong></p>
            </div>
        </main>

        <footer>
            <p><strong>Universidad Tecnológica de la Mixteca</strong></p>
            <p>Av. Doctor Modesto Seara Vázquez No.1, Acatlima,<br>
            Heroica Ciudad de Huajuapan de León, Oax., México, C.P. 69004</p>
        </footer>
        
    </body>
</html>
