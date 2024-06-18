<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: iniciar_sesion.php'); // Asegúrate de que la ruta a la página de inicio de sesión sea correcta
    exit();
}
$nombre_usuario = $_SESSION['usuario'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil / Vitahealth</title>
    <link rel="stylesheet" href="styleservicio.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/tooplate-style.css">
    <link rel="stylesheet" href="css/animate.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/tooplate-style.css">
</head>
    <style>
        .profile-container {
            margin-top: 100px;
        }
        .profile-container h2 {
            margin-bottom: 20px;
        }
        .profile-container .card {
            padding: 20px;
            margin-top: 20px;
        }
        .navbar .nav-item .btn {
            margin-left: 10px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">Servicio Médico</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html#top">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html#about">Sobre nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html#team">Doctores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html#news">Noticias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="indexservicio.html">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cuenta.php">Cuenta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html#google-map">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link appointment-btn" href="index.html#appointment">Haga una cita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger ms-2" href="cerrar_sesion.php">Cerrar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-primary ms-2" href="mis_compras.php">Ver Mis Compras</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="container profile-container">
        <h2 class="text-center">Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?>!</h2>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Detalles del Perfil</h5>
                        <p class="card-text">Aquí puedes añadir más detalles sobre el usuario.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="servicio.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/magnific-popup-options.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
</body>
</html>



