<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION["username"])) {
    echo json_encode(["error" => "No se ha iniciado sesión"]);
    exit;
}

// Establecer conexión con la base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Tu contraseña de la base de datos si la tiene
$dbname = "clinicaweb";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el nombre de usuario desde la sesión actual
$username = $_SESSION["username"];

// Consulta para obtener los datos del usuario
$sql = "SELECT * FROM creacion WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Obtener el primer resultado (debería ser solo uno)
    $row = $result->fetch_assoc();

    // Crear un array asociativo con los datos del usuario
    $usuario = [
        "username" => $row["username"],
        "email" => $row["email"]
    ];

    // Devolver los datos del usuario como JSON
    echo json_encode($usuario);
} else {
    echo json_encode(["error" => "No se encontró al usuario"]);
}

$conn->close();
?>
