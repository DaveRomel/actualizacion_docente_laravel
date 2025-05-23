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
@extends('actualizacion_docente.welcome')
@section('contenido')
    
        <div class="content-area">
            <h1 class="main-title">Actualización docente educación media superior</h1>
    
            <div class="inscription-card">
                <img src="{{ asset('images/Inscripción_fisica.png') }}" alt="Icono Diploma" class="icon"> {{-- Asegúrate de tener un icono apropiado --}}
                <h2>Inscripción - Física</h2>
                <p>Nombre:Juan Perez</p>
                <p>Institución: Instituto 1234</p>
                <button>Inscribirme</button>
            </div>
    
            <div class="reminder-card">
               <h2><span>Recuerda que:</span> <span>5/20</sapn></h2>
                <p>Solo puedes cambiar de curso si hay disponibilidad.</p>
                <p>Este curso tiene un cupo máximo para 20 participantes </p>
            </div>
        </div>
@endsection