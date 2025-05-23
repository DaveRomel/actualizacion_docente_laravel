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
                <div class="nombrep">Nombre</div>
            </div>
            <div class="nombres">
                <div class="bienvenidop">Estatus: </div>
                <div class="nombrep">Inscrito</div>
            </div>
        </div>
        <div class="container1">
            <h2 class="title1">Actualización docente educación media superior</h2>
            <div class="cursos">
                <div class="curso">
                    <div class="img-hover-m"></div>
                    <div class="titulocurso">Matemáticas</div>
                    <a href="{{ asset('temarios/Programa_Matematicas.pdf') }}" download>
                        <div class="botonTemario" style="cursor: pointer;">
                            <div class="temario1">Temario</div>
                            <img src="{{ asset('images/descarga temario.png') }}" alt="computacion"
                                style="width: 30px; height: 30px; margin-bottom: 10px;">
                        </div>
                    </a>
                </div>
                <div class="curso">
                    <div class="img-hover-f"></div>
                    <div class="titulocurso">Física</div>
                    <a href="{{ asset('temarios/Programa_Fisica.pdf') }}" download>
                        <div class="botonTemario" style="cursor: pointer;">
                            <div class="temario1">Temario</div>
                            <img src="{{ asset('images/descarga temario.png') }}" alt="computacion"
                                style="width: 30px; height: 30px; margin-bottom: 10px;">
                        </div>
                    </a>
                </div>
                <div class="curso">
                    <div class="img-hover-c"></div>
                    <div class="titulocurso">Computación</div>
                    <a href="{{ asset('temarios/Programa_Computacion.pdf') }}" download>
                        <div class="botonTemario" style="cursor: pointer;">
                            <div class="temario1">Temario</div>
                            <img src="{{ asset('images/descarga temario.png') }}" alt="computacion"
                                style="width: 30px; height: 30px; margin-bottom: 10px;">
                        </div>
                    </a>
                </div>
            </div>
            <div class="temario">
                <div class="botonTemario">
                    <img src="{{ asset('images/descargar constancia.png') }}" alt="descarga temario"
                        style="width: 30px; height: 30px;">
                </div>
                <div class="temariod">Descarga aquí tu constancia una vez finalizado el curso</div>
            </div>
        </div>
        <div class="editar_baja">
            <div class="editar_informacion">
                <img src="{{ asset('images/configuracion.png') }}" alt="editar" style="width: 40px; height: 40px;">
                <a class="temariod">Editar información</a>
            </div>
            <div class="dar_baja">
                <img src="{{ asset('images/baja.png') }}" alt="baja" style="width: 40px; height: 40px;">
                <a class="temariod">Dar de baja</a>
            </div>
        </div>
    </div>

@endsection