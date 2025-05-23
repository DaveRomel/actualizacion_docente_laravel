@extends('actualizacion_docente.welcome')
@section('contenido')
    
        <div class="content-area">
            <h1 class="main-title">Actualización docente educación media superior</h1>
    
            <div class="inscription-card">
                <img src="{{ asset('images/inscripción_matematicas.png') }}" alt="Icono Diploma" class="icon"> {{-- Asegúrate de tener un icono apropiado --}}
                <h2>Inscripción - Matemáticas</h2>
                <p>Nombre:Juan Perez</p>
                <p>Institución: Instituto 1234</p>
                <button>Inscribirme</button>
            </div>
    
            <div class="reminder-card">
               <h2><span>Recuerda que:</span> <span>5/25</sapn></h2>
                <p>Solo puedes cambiar de curso si hay disponibilidad.</p>
                <p>Este curso tiene un cupo máximo para 25 participantes </p>
            </div>
        </div>
@endsection