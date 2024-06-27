<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinicaweb";

// Establece la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibie los datos del formulario
$username = $_POST["reg-username"];
$email = $_POST["reg-email"];
$password = $_POST["reg-password"];

// Valida los datos recibidos
if (empty($username) || empty($email) || empty($password)) {
    echo "Por favor, complete todos los campos.";
    exit();
}

// Valida el formato del correo electrónico
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Por favor, ingrese un correo electrónico válido.";
    exit();
}

// Consulta para verificar si el usuario ya existe
$sql = "SELECT * FROM creacion WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "El nombre de usuario ya está en uso.";
    exit();
}


$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Inserta el usuario en la base de datos
$insert_sql = "INSERT INTO creacion (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

if ($conn->query($insert_sql) === TRUE) {
    $_SESSION["username"] = $username;
    echo "success";
} else {
    echo "Error al registrar: " . $conn->error;
}

$conn->close();
?>






