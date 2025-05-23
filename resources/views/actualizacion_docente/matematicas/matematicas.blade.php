{{-- Simulación: cambia a true si el usuario ya está inscrito --}}
@php
    $estaInscrito = true; 
@endphp

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inscripción - Matemáticas</title>
    <link rel="stylesheet" href="{{ asset('css/matematicas.css') }}">
</head>
<body>

    <div class="contenedorTitulo titulo">
        Actualización docente media superior
    </div>

    <div class="ContenedorInscripcion">

        <div class="ContenedorLogo"> 
            @if (!$estaInscrito)
                <img src="{{ asset('images/Inscripción_matematicas.png') }}" alt="Inscripción Matemáticas">
            @else
                <img src="{{ asset('images/reactivo_inscrito.png') }}" alt="Inscripción Matemáticas">
            @endif
        </div>

        <div class="ContenedorTituloSeccion tituloSeccion">
            {{ $estaInscrito ? 'Inscrito a Matemáticas' : 'Inscripción - Matemáticas' }}
        </div> 

        <div class="contenedorInformación">
            Nombre: Juan Perez Perez 
            <br>
            Institución: Instituto ABC
        </div>

        @if (!$estaInscrito)
            <div class="contendorBottonInscripcion"> 
                <button>Inscribirme</button>
            </div>
        @endif
    </div>

    <div class="recuerdaQue">
        <div class="tituloRecuerda">Recuerda que:</div>
        <div class="contenedorOcupación">2/25</div>

        @if (!$estaInscrito)
            <div class="texto">
                <ul>
                    <li>Solo puedes cambiar de curso si hay disponibilidad.</li>
                    <li>Este curso tiene un cupo máximo para 25 participantes.</li>
                </ul>
            </div>
        @else
            <div class="texto">
                <ul>
                    <li>Los cursos se abren con un mínimo de 10 integrantes.</li>
                    <li>Si no se apertura un curso puedes darte de baja y elegir otro.</li>
                    <li>La fecha límite de registro es el 2 de julio 2025.</li>
                </ul>
            </div>
        @endif
    </div>
    @if ($estaInscrito) 
        <div class="contenedorBaja">
            <img src="{{ asset('images/configuracion.png') }}" alt="">
            <div class="textoBaja">Dar de baja</div>
            
        </div>
    @endif
</body>
</html>
