@extends('actualizacion_docente.welcome')

@section('header_primero')
    <a class="barra-nav" href="#">Actualización Docente</a>
@endsection

@section('header_sesion')
    @if (session()->has('api_token'))
    <a class="barra-nav" href="{{ route('logout') }}"
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
    Cerrar sesión
    </a>
    @else
    <a class="barra-nav" href="{{ route('registrarse') }}">Regístrate</a><a> / </a><a class="barra-nav" href="{{ route('iniciar_sesion') }}">Iniciar sesión</a>
    @endif

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
    </form>
@endsection

@if (session()->has('current_user_data'))
    @php
        $currentUser = session('current_user_data')
    @endphp
@endif

@php
    $materiaActual = 'Ninguno';
    if ($currentUser['status'] == 1) {
        $materiaActual = 'Computación';
    } elseif ($currentUser['status'] == 2) {
        $materiaActual = 'Física';
    } elseif ($currentUser['status'] == 3) {
        $materiaActual = 'Matemáticas';
    }
@endphp

@section('contenido')
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/impact" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/gabriola" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <div class="main1">
        <div class="bienvenido">
            <div class="nombres">
                <div class="bienvenidop">Bienvenido/a:&nbsp;</div>
                <div class="nombrep">{{$currentUser['name']}}</div>
            </div>
            <div class="nombres">
                <div class="bienvenidop">Inscrito a:&nbsp;</div>
                <div class="nombrep">{{$materiaActual}}</div>
            </div>
        </div>
        <div class="container1">
            <div class="cursos">
                <div class="curso">
                    @if($currentUser['status'] == 3)
                        <a href="{{ route('confirmacion_matematicas') }}">
                    @else
                        <a href="{{ route('inscripcion_matematicas') }}">
                    @endif
                    
                        <div class="img-hover-m"></div>
                    </a>
                    <div class="titulocurso">Matemáticas</div>
                    @if($currentUser['status'] == 3)
                        <form action="{{ route('confirmacion_matematicas') }}" method="GET">
                            <button type="submit" class="btn btn-primary">Inscribirse</button>
                        </form>
                    @else
                        <form action="{{ route('inscripcion_matematicas') }}" method="GET">
                            <button type="submit" class="btn btn-primary">Inscribirse</button>
                        </form>

                    @endif
                    <a href="{{ asset('temarios/Programa_Matematicas.pdf') }}" target="_blank">
                        <div class="botonTemario" style="cursor: pointer;">
                            <div class="temario1">Temario</div>
                            <div class="img-hover-t"></div>
                        </div>
                    </a>
                </div>
                <div class="curso">
                    @if($currentUser['status'] == 2)
                        <a href="{{ route('confirmacion_fisica') }}">
                    @else
                       <a href="{{ route('inscripcion_fisica') }}">
                    @endif
                     
                        <div class="img-hover-f"></div>
                    </a>
                    <div class="titulocurso">Física</div>
                    @if($currentUser['status'] == 2)
                        <form action="{{ route('confirmacion_fisica') }}" method="GET">
                            <button type="submit" class="btn btn-primary">Inscribirse</button>
                        </form>
                    @else
                        <form action="{{ route('inscripcion_fisica') }}" method="GET">
                            <button type="submit" class="btn btn-primary">Inscribirse</button>
                        </form>

                    @endif
                    <a href="{{ asset('temarios/Programa_Fisica.pdf') }}" target="_blank">
                        <div class="botonTemario" style="cursor: pointer;">
                            <div class="temario1">Temario</div>
                            <div class="img-hover-t"></div>
                        </div>
                    </a>
                </div>
                <div class="curso">
                    @if($currentUser['status'] == 1)
                        <a href="{{ route('confirmacion_computacion') }}">
                    @else
                       <a href="{{ route('inscripcion_computacion') }}">
                    @endif
                     
                        <div class="img-hover-c"></div>
                    <a>
                    <div class="titulocurso">Computación</div>
                    @if($currentUser['status'] == 1)
                        <form action="{{ route('confirmacion_computacion') }}" method="GET">
                            <button type="submit" class="btn btn-primary">Inscribirse</button>
                        </form>
                    @else
                        <form action="{{ route('inscripcion_computacion') }}" method="GET">
                            <button type="submit" class="btn btn-primary">Inscribirse</button>
                        </form>

                    @endif
                    <a href="{{ asset('temarios/Programa_Computacion.pdf') }}" target="_blank">
                        <div class="botonTemario" style="cursor: pointer;">
                            <div class="temario1">Temario</div>
                            <div class="img-hover-t"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="temario">
                <div class="botonTemario">
                    <img src="{{ asset('images/descargar constancia.png') }}" alt="descarga temario"
                        style="width: 30px; height: 30px;">
                </div>
                <div class="constanciatxt">Descarga aquí tu constancia una vez finalizado el curso</div>
            </div>
        </div>
        <div class="editar_baja">
             <a class="temariod" href="{{route('editar')}}">
            <div class="editar_informacion">
                <img src="{{ asset('images/configuracion.png') }}" alt="editar" style="width: 40px; height: 40px;">
               Editar<br/> información
            </div>
            </a>
            @if($currentUser['status']!=0)
            
            <form id="form-baja" action="{{ url('/eliminar-inscripcion/' . $currentUser['id']) }}" method="POST" style="display: inline;">
                @csrf
                @method('PUT')
                
                <button type="button" id="openBajaModalBtn" class="temariod" style="background: none; border: none; padding: 0; cursor: pointer;">
                    <div class="dar_baja">
                        <img src="{{ asset('images/Baja.png') }}" alt="baja" style="width: 40px; height: 40px;">
                        Darse de baja<br/> de {{ $materiaActual }}
                    </div>
                </button>
            </form>

            @endif
        </div>
    </div>

    <!-- Modal de Confirmación para Darse de Baja -->
    <div id="bajaConfirmationModal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <h2>Confirmar Baja</h2>
            <p>¿Estás seguro de que deseas darte de baja de {{ $materiaActual }}?</p>
            <div class="modal-buttons">
                <button id="cancelBajaBtn" class="modal-btn cancel">Cancelar</button>
                <button id="confirmBajaBtn" class="modal-btn confirm">Confirmar</button>
            </div>
        </div>
    </div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- LÓGICA DEL MODAL DE CONFIRMACIÓN PARA DARSE DE BAJA ---
        const bajaModal = document.getElementById('bajaConfirmationModal');
        const openBajaModalBtn = document.getElementById('openBajaModalBtn');
        const confirmBajaBtn = document.getElementById('confirmBajaBtn');
        const cancelBajaBtn = document.getElementById('cancelBajaBtn');
        const closeBajaButton = bajaModal.querySelector('.close-button'); // Selector específico para este modal
        const formBaja = document.getElementById('form-baja');

        if (openBajaModalBtn) {
            openBajaModalBtn.addEventListener('click', () => {
                bajaModal.style.display = 'flex'; // Usar 'flex' para centrar
            });
        }

        if(cancelBajaBtn) {
            cancelBajaBtn.addEventListener('click', () => {
                bajaModal.style.display = 'none';
            });
        }

        if(closeBajaButton) {
            closeBajaButton.addEventListener('click', () => {
                bajaModal.style.display = 'none';
            });
        }

        if(confirmBajaBtn) {
            confirmBajaBtn.addEventListener('click', () => {
                formBaja.submit(); // Envía el formulario si el usuario confirma
            });
        }

        // Cierra el modal si se hace clic fuera del contenido
        window.addEventListener('click', (event) => {
            if (event.target == bajaModal) {
                bajaModal.style.display = 'none';
            }
        });
    });
</script>