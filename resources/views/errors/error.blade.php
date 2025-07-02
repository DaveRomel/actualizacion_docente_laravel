@extends('actualizacion_docente.welcome')

@section('header_primero')
    <a class="barra-nav" href="{{ route('index') }}">Actualización Docente</a>
@endsection

@section('contenido')
    <div style="text-align: center; padding: 60px 20px; font-family: Bahnschrift, sans-serif;">
        <h1 style="font-size: 64px; color: #7E2C2C; margin-bottom: 20px;">¡Ups!</h1>
        <p style="font-size: 28px; color: #C68C3E;">Algo salió mal, por favor inténtelo más tarde.</p>
        <a href="{{ url('/') }}" style="display: inline-block; margin-top: 30px; padding: 10px 30px; background-color: #7E2C2C; color: white; text-decoration: none; border-radius: 5px;">
            Volver al inicio
        </a>
    </div>
@endsection
