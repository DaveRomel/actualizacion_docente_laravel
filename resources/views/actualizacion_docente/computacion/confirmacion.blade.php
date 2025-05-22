

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización Docente</title>
    <link rel="stylesheet" href="{{ asset('css/computacion.css') }}">
    <style>
        .content-area {
            
            background-image: url('{{ asset('images/fondo.jpg') }}'); /* Asegúrate de tener una imagen de patrón o replicarlo con CSS */
            background-repeat: repeat;
            padding: 40px 20px;
            min-height: calc(100vh - 120px); /* Ajusta según la altura del header y footer */
            display: flex;
            flex-grow: 1;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

    </style>
</head>
<body>
    <div class="main-container">   
        <header class="header">
            <a href="#">Inicio</a>
            <a href="#">Cerrar sesión</a>
        </header>
    
        <div class="content-area">
            <h1 class="main-title">Actualización docente educación media superior</h1>
    
            <div class="inscription-card">
                <img src="{{ asset('images/reactivo_inscrito.png') }}" alt="Icono Diploma" class="icon">
                <h2>Inscrito a Computación</h2>
                <p>Nombre: Juan Perez</p>
                <p>Institución: Instituto 1234</p>
            </div>
    
            <div class="reminder-card">
                <h2>Recuerda que:</h2>
                <p>Los cursos se abren con un mínimo de 10 integrantes</p>
                <p>Si no se apertura un curso puedes darte de baja y elegir otro</p>
                <p>La fecha límite de registro es el 2 de Julio 2025</p>
            </div>
        </div>

        <div class="baja">
            <img src="{{ asset('images/Baja.png') }}" alt="Icono baja" class="icon">
            <p> Darse de baja </p>

        </div>
    
        <footer class="footer">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo UTM">
                <span>Universidad Tecnológica de la Mixteca</span>
            </div>
            <div class="address">
                <img src="{{ asset('images/posicion.png') }}" alt="Icono Ubicación">
                <span>Av. Doctor Modesto Seara Vázquez No.1, Acatlima, <br> Heroica Ciudad de Huajuapan de León, Oax., México, C.P.69004</span>
            </div>
        </footer>
    </div>
</body>
</html>