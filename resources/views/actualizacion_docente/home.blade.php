<?php
    $url = "http://localhost:8000/api/user/1"; // URL de la API

    // Inicializar cURL
    $ch = curl_init($url);

    // Configurar opciones
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Obtener respuesta como string

    // Ejecutar petición y obtener resultado
    $respuesta = curl_exec($ch);

    // Cerrar sesión cURL
    curl_close($ch);

    // Convertir JSON en array asociativo
    $datos = json_decode($respuesta, true);

    $nombre ="fasfa";// $datos["name"];
    $status = 1; //$datos["status"];
    $procedencia = "afsdfgds"//$datos["procedencia"];
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.cdnfonts.com/css/impact" rel="stylesheet">
        <link href="https://fonts.cdnfonts.com/css/gabriola" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Actualización Docente</title>

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body>
        
        <header style="height: 90px;padding: 0px; display: flex;flex-direction: row;align-items: center;justify-content: space-around;">
            <nav style="width: 90%;">
                <div class="titles"><strong>Inicio</strong></div>
                <div class="titles"><a href="#">Cerrar sesión</a></div>
                
            </nav>
        </header>

        <main class="main1">
            
            <div class="container1">
                <div class="bienvenido">
                    <div>
                        <div class="bienvenidop">Bienvenido/a: </div>
                        <div class="nombrep"><?php echo $nombre ?></div>
                    </div>
                    <div>
                        <div class="bienvenidop">Estatus: </div>
                        <div class="nombrep"><?php echo $nombre ?></div>
                    </div>
                </div>
                <h2 class="title1">Actualización docente educacion media superior</h2>
                <div class="cursos">
                    <div class="curso">
                        <img src="{{ asset('images/matematicas.png') }}" alt="computacion" style="width: 146px; height: 146px;">
                        <div class="titulocurso">Matemáticas</div>
                        <div class="botonTemario">
                            <div class="temario1">Temario</div>
                            <img src="{{ asset('images/descarga.png') }}" alt="computacion" style="width: 60px; height: 60px;">
                        </div>
                    </div>
                    <div class="curso">
                        <img src="{{ asset('images/fisica.png') }}" alt="computacion" style="width: 146px; height: 146px;">
                        <div class="titulocurso">Física</div>
                        <div class="botonTemario">
                            <div class="temario1">Temario</div>
                            <img src="{{ asset('images/descarga.png') }}" alt="computacion" style="width: 60px; height: 60px;">
                        </div>
                    </div>
                    <div class="curso">
                        <img src="{{ asset('images/computación.png') }}" alt="computacion" style="width: 146px; height: 146px;">
                        <div class="titulocurso">Computación</div>
                        <div class="botonTemario">
                            <div class="temario1">Temario</div>
                            <img src="{{ asset('images/descarga.png') }}" alt="computacion" style="width: 60px; height: 60px;">
                        </div>
                    </div>
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
