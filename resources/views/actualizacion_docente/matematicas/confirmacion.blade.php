@extends('actualizacion_docente.welcome')
@section('header_primero')
    <a class="barra-nav" href="{{ route('principal') }}">Inicio</a>
@endsection

@section('header_sesion')
    <a class="barra-nav" href="{{ route('index') }}">Cerrar sesión</a>
@endsection
@section('contenido')
    
        <div class="content-area">
            <h1 class="main-title">Actualización docente educación media superior </h1>
    
            <div class="confirmacion-card">
                <img src="{{ asset('images/reactivo_inscrito.png') }}" alt="Icono Diploma" class="icon">
                <h2>Inscrito a Matemáticas</h2>
                <p>Nombre: Juan Perez</p>
                <p>Institución: Instituto 1234</p>
            </div>
    
            <div class="confirmacion-reminder-card">
                <h2><span>Recuerda que:</span> <span>5/30</sapn></h2>
                <p>Los cursos se abren con un mínimo de 10 integrantes</p>
                <p>Si no se apertura un curso puedes darte de baja y elegir otro</p>
                <p>La fecha límite de registro es el 2 de Julio 2025</p>
            </div>
            
                    <div class="baja">
                        <img src="{{ asset('images/Baja.png') }}" alt="Icono baja" class="icon" style="height:40px">
                        <p class="textoBaja"> Darse de baja </p>
            
                    </div>
        </div>
@endsection