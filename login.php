<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinicaweb";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error);
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['login-username']);
    $password = md5($_POST['login-password']); // Encriptar la contraseña

    $checkUser = $conn->prepare("SELECT * FROM creacion WHERE username=? AND password=? LIMIT 1");
    if ($checkUser === false) {
        error_log("Prepare failed: " . $conn->error);
        die("Prepare failed: " . $conn->error);
    }

    $bind = $checkUser->bind_param("ss", $username, $password);
    if ($bind === false) {
        error_log("Bind param failed: " . $checkUser->error);
        die("Bind param failed: " . $checkUser->error);
    }

    $exec = $checkUser->execute();
    if ($exec === false) {
        error_log("Execute failed: " . $checkUser->error);
        die("Execute failed: " . $checkUser->error);
    }

    $result = $checkUser->get_result();
    if ($result === false) {
        error_log("Get result failed: " . $checkUser->error);
        die("Get result failed: " . $checkUser->error);
    }

    if ($result->num_rows > 0) {
        $_SESSION['usuario'] = $username;
        echo "success";
        error_log("Login successful for username: " . $username);
    } else {
        echo "fail";
        error_log("Login failed for username: " . $username);
    }

    $checkUser->close();
}

$conn->close();
?>









