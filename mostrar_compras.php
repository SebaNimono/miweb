<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['username'])) {
    echo json_encode(array("error" => "Usuario no autenticado"));
    exit;
}

$username = $_SESSION['username'];

// Reemplaza con tus propias credenciales y configuración de conexión a la base de datos
$servername = "localhost";
$username_db = "tu_usuario_db";
$password_db = "tu_contraseña_db";
$dbname = "tu_nombre_db";

try {
    // Conexión a la base de datos usando PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username_db, $password_db);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener las compras del usuario
    $sql = "SELECT * FROM orders WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver las compras como JSON
    echo json_encode($orders);

} catch(PDOException $e) {
    // Capturar y mostrar errores de conexión o consulta
    echo json_encode(array("error" => "Error en la conexión o consulta: " . $e->getMessage()));
}

// Cerrar la conexión PDO
$pdo = null;
?>
