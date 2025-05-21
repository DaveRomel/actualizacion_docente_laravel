<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.cdnfonts.com/css/impact" rel="stylesheet">
        <link href="https://fonts.cdnfonts.com/css/gabriola" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/fisica.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Actualización Docente</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body>
        
        <header style="height: 90px;">
            <nav>
                <div class="titles"><strong>Inicio</strong></div>
                <div class="titles"><a href="#">Cerrar sesión</a></div>
                
            </nav>
        </header>

        <main class="main1">
            <div class="container1">
                <h2 class="title1">Actualización docente educacion media superior</h2>
                <div class="fisica_inscripcion">
                    <img src="{{ asset('images/inscripción_fisica.png') }}" alt="fisica_logo" style="width: 67px; height: 67px;">
                    <div class="title1">Inscripcion - Física</div>
                    <div class="datos_ins">
                        <div class="nombre_ins">Nombre: </div>
                        <div class="nombre_ins">Instituto:</div>
                    </div>
                    <a href="http://" class="inscribirme">Inscribirme</a>
                </div>
                <div class="recuerda1">
                    <div class="titulo_r">Recuerda que:</div>
                    <ul>
                        <li>Solo puedes cambiar de curso sí hay disponibilidad</li>
                        <li>Este curso tíene un cupo máximo para 20 participantes</li>
                    </ul>
                </div>
            </div>
        </main>

        <footer>
            <p><strong>Universidad Tecnológica de la Mixteca</strong></p>
            <p>Av. Doctor Modesto Seara Vázquez No.1, Acatlima,<br>
            Heroica Ciudad de Huajuapan de León, Oax., México, C.P. 69004</p>
        </footer>
        
    </body>
</html>
