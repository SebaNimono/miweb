<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clinicaweb";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener datos del POST
$data = json_decode(file_get_contents("php://input"), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $data['username'];
    $cardNumber = $data['card_number'];
    $expiryDate = $data['expiry_date'];
    $cvv = $data['cvv'];
    $cart = $data['cart'];
    $total = $data['total'];

    foreach ($cart as $item) {
        $doctorName = $item['doctor_name'];
        $price = $item['price'];
        $quantity = $item['quantity'];
        $totalPrice = $price * $quantity;

        // Preparar la consulta SQL
        $stmt = $conn->prepare("INSERT INTO orders (username, doctor_name, doctor_price, quantity, total_price, card_number, expiry_date, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiiisss", $username, $doctorName, $price, $quantity, $totalPrice, $cardNumber, $expiryDate, $cvv);
        
        // Ejecutar la consulta
        if (!$stmt->execute()) {
            echo "fail";
            exit;
        }
    }

    echo "success";
}

$conn->close();
?>
