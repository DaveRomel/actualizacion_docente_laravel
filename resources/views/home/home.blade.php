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

    $nombre ="Juan Pérez Pérez";// $datos["name"];
    $status = 1; //$datos["status"];
    $procedencia = "Computacion"//$datos["procedencia"];
?>

@extends('actualizacion_docente.welcome')
@section('contenido')
<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.cdnfonts.com/css/impact" rel="stylesheet">
        <link href="https://fonts.cdnfonts.com/css/gabriola" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">
<div class="main1">
            <div class="bienvenido">
                    <div class="nombres">
                        <div class="bienvenidop">Bienvenido/a: </div>
                        <div class="nombrep"><?php echo $nombre ?></div>
                    </div>
                    <div class="nombres">
                        <div class="bienvenidop">Estatus: </div>
                        <div class="nombrep"><?php echo $procedencia ?></div>
                    </div>
                </div>
            <div class="container1">
                <h2 class="title1">Actualización docente educacion media superior</h2>
                <div class="cursos">
                    <div class="curso">
                        <img src="{{ asset('images/matematicas.png') }}" alt="computacion" style="width: 146px; height: 146px;">
                        <div class="titulocurso">Matemáticas</div>
                        <div class="botonTemario">
                            <div class="temario1">Temario</div>
                            <img src="{{ asset('images/descarga.png') }}" alt="computacion" style="width: 60px; height: 60px; margin-bottom: 10px;">
                        </div>
                    </div>
                    <div class="curso">
                        <img src="{{ asset('images/fisica.png') }}" alt="computacion" style="width: 146px; height: 146px;">
                        <div class="titulocurso">Física</div>
                        <div class="botonTemario">
                            <div class="temario1">Temario</div>
                            <img src="{{ asset('images/descarga.png') }}" alt="computacion" style="width: 60px; height: 60px; margin-bottom: 10px;">
                        </div>
                    </div>
                    <div class="curso">
                        <img src="{{ asset('images/computación.png') }}" alt="computacion" style="width: 146px; height: 146px;">
                        <div class="titulocurso">Computación</div>
                        <div class="botonTemario">
                            <div class="temario1">Temario</div>
                            <img src="{{ asset('images/descarga.png') }}" alt="computacion" style="width: 60px; height: 60px; margin-bottom: 10px;">
                        </div>
                    </div>
                </div>
                <div class="temario">
                    <div class="botonTemario">
                        <img src="{{ asset('images/descarga.png') }}" alt="computacion" style="width: 60px; height: 60px;">
                    </div>
                    <div class="temariod">Descarga aqui tu constancia una vez finalizado el curso</div>
                </div>
                <div class="dar_baja">
                    <img src="{{ asset('images/configuracion.png') }}" alt="computacion" style="width: 40px; height: 40px;">
                    <a class="temariod">Dar de baja</a>
                </div>
            </div>
</div>

@endsection