<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vitahealth";



// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['reg-username']);
    $email = mysqli_real_escape_string($conn, $_POST['reg-email']);
    $password = md5($_POST['reg-password']); // Encriptar la contraseña

    // Verificar si el usuario o el correo ya existen
    $checkUser = $conn->prepare("SELECT * FROM creacion WHERE username=? OR email=?");
    $checkUser->bind_param("ss", $username, $email);
    $checkUser->execute();
    $result = $checkUser->get_result();

    if ($result->num_rows > 0) {
        // Ya existe un usuario con ese nombre de usuario o correo electrónico
        echo "fail";
    } else {
        // No se encontró ningún usuario existente, se puede proceder con la inserción
        $stmt = $conn->prepare("INSERT INTO creacion (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "Correcto " . $stmt->error;
        }
        $stmt->close();
    }
    $checkUser->close();
}

$conn->close();
?>








