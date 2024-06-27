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
    echo "Error: Usuario no autenticado.";
    exit();
}

$username = $_SESSION['username'];
$data = json_decode(file_get_contents('php://input'), true);

$cardNumber = $data['cardNumber'];
$expiryDate = $data['expiryDate'];
$cvv = $data['cvv'];

foreach ($data['cartItems'] as $item) {
    $doctorName = $item['doctorName'];
    $doctorPrice = $item['doctorPrice'];
    $quantity = $item['quantity'];
    $totalPrice = $doctorPrice * $quantity;

    $sql = "INSERT INTO orders (username, doctor_name, doctor_price, quantity, total_price, card_number, expiry_date, cvv) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdiddss", $username, $doctorName, $doctorPrice, $quantity, $totalPrice, $cardNumber, $expiryDate, $cvv);

    if (!$stmt->execute()) {
        echo "Error al guardar el pedido: " . $stmt->error;
        $stmt->close();
        $conn->close();
        exit();
    }

    $stmt->close();
}

echo "success";
$conn->close();
?>


