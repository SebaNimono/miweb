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

// limpia los datos del formulario
$username = $conn->real_escape_string($_POST["login-username"]);
$password = $conn->real_escape_string($_POST["login-password"]);

// Consulta preparada para verificar las credenciales del usuario
$sql = "SELECT * FROM creacion WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row["password"])) {
        
        $_SESSION["username"] = $username;
        echo "success";
    } else {
        
        echo "error";
    }
} else {
    
    echo "error";
}

$stmt->close();
$conn->close();
?>









