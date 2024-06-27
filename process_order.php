<?php
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

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener datos de la compra
    $username = $_SESSION["username"]; 
    $doctorName = $_POST["doctorName"];
    $doctorPrice = $_POST["doctorPrice"];
    $quantity = $_POST["quantity"];
    $totalPrice = $doctorPrice * $quantity; 
    $cardNumber = $_POST["cardNumber"];
    $expiryDate = $_POST["expiryDate"];
    $cvv = $_POST["cvv"];

  
    $sql = "INSERT INTO orders (username, doctor_name, doctor_price, quantity, total_price, card_number, expiry_date, cvv) VALUES ('$username', '$doctorName', '$doctorPrice', '$quantity', '$totalPrice', '$cardNumber', '$expiryDate', '$cvv')";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
