<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinicaweb";

// Creando conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si el usuario está autenticado
if (!isset($_SESSION['username'])) {
    echo json_encode(["error" => "Usuario no autenticado."]);
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM orders WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$orders = [];
while ($row = $result->fetch_assoc()) {
    $orders[] = $row;
}

echo json_encode($orders);

$stmt->close();
$conn->close();
?>
