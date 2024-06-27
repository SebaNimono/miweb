<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinicaweb";

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si la sesión de usuario está activa
if (!isset($_SESSION['username'])) {
    // Si no está activa, redirigir a la página de inicio de sesión
    header("Location: user.html");
    exit(); 
}
?>

