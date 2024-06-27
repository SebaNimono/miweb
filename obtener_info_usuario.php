<?php
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION["username"])) {
    echo json_encode(["error" => "No se ha iniciado sesión"]);
    exit;
}

// Establece conexión con la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Tu contraseña de la base de datos si la tiene
$dbname = "clinicaweb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$username = $_SESSION["username"];


$sql = "SELECT * FROM creacion WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();

    
    $usuario = [
        "username" => $row["username"],
        "email" => $row["email"]
    ];

    
    echo json_encode($usuario);
} else {
    echo json_encode(["error" => "No se encontró al usuario"]);
}

$conn->close();
?>

