<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $full_name = htmlspecialchars($_POST['full-name']);
    $email = htmlspecialchars($_POST['email']);
    $appointment_date = htmlspecialchars($_POST['date']);
    $department = htmlspecialchars($_POST['department']);
    $phone_number = htmlspecialchars($_POST['phone-number']);
    $message = htmlspecialchars($_POST['message']);

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "clinicaweb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar la consulta SQL para insertar los datos en la tabla 
    $sql = "INSERT INTO appointments (full_name, email, appointment_date, department, phone_number, message)
            VALUES (?, ?, ?, ?, ?, ?)";
    
    // Prepara la declaración SQL
    $stmt = $conn->prepare($sql);

    
    $stmt->bind_param("ssssss", $full_name, $email, $appointment_date, $department, $phone_number, $message);

    
    if ($stmt->execute()) {
        
        echo "<p>Gracias por enviar su cita. Nos pondremos en contacto pronto.</p>";
    } else {
        
        echo "<p>Error al enviar la cita: " . $stmt->error . "</p>";
    }

    // Cerra la declaración y la conexión
    $stmt->close();
    $conn->close();
} else {
    // Si se intenta acceder al archivo directamente sin enviar el formulario
    echo "<p>Error: Acceso no autorizado.</p>";
}
?>



