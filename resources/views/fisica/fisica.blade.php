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

    $nombre ="string"; //$datos["name"];
    $status = 0; //$datos["status"];
    $procedencia = "Instituto 1"//$datos["procedencia"];
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
        <link rel="stylesheet" href="{{ asset('css/fisica.css') }}">
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
                <h2 class="title1">Actualización docente educacion media superior</h2>
                <?php if ($status == 0){  ?> 
                    <div class="fisica_inscripcion">
                        <img src="{{ asset('images/inscripción_fisica.png') }}" alt="fisica_logo" style="width: 67px; height: 67px;">
                        <div class="title1">Inscripcion - Física</div>
                        <div class="datos_ins">
                            <div class="nombre_ins">Nombre: <?php echo $nombre ?> </div>
                            <div class="nombre_ins">Instituto: <?php echo $procedencia ?></div>
                        </div>
                        <a href="http://" class="inscribirme">Inscribirme</a>
                    </div>
                    <div class="recuerda1">
                        <div class="titulosr">
                            <div class="titulo_r">Recuerda que:</div>
                            <div class="cupos">3/20</div>
                        </div>
                        <ul class="colored-marker" style="text-align: start;">
                            <li class="lista">Solo puedes cambiar de curso sí hay disponibilidad</li>
                            <li class="lista">Este curso tíene un cupo máximo para 20 participantes</li>
                        </ul>
                    </div>
                <?php } else{ ?>
                    <div class="fisica_inscrito">
                        <img src="{{ asset('images/reactivo_inscrito.png') }}" alt="inscrito_logo" style="width: 74px; height: 77px;">
                        <div class="title1">Inscrito a Física</div>
                        <div class="datos_ins">
                            <div class="nombre_ins">Nombre: <?php echo $nombre ?></div>
                            <div class="nombre_ins">Instituto: <?php echo $procedencia ?></div>
                        </div>
                    </div>
                    <div class="recuerda2">
                        <div class="titulosr">
                            <div class="titulo_r">Recuerda que:</div>
                            <div class="cupos">3/20</div>
                        </div>
                        <div style="width: 100%; display: flex">
                            <ul style="text-align: start;">
                            <li class="lista">los cursos se abren con un mínimo de 10 integrantes</li>
                            <li class="lista">Si no se apertura un curso puedes darte de baja y elegir otro</li>
                            <li class="lista">La fecha limite de registro es el 2 de Julio 2025</li>
                        </ul>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </main>

        <footer>
            <p><strong>Universidad Tecnológica de la Mixteca</strong></p>
            <p>Av. Doctor Modesto Seara Vázquez No.1, Acatlima,<br>
            Heroica Ciudad de Huajuapan de León, Oax., México, C.P. 69004</p>
        </footer>
        
    </body>
</html>
