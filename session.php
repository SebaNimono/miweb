<?php
session_start();
// Verifica si el usuario está autenticado
function isUserAuthenticated() {
    return isset($_SESSION['username']);
}

// Redirecciona si el usuario no está autenticado
function redirectIfNotAuthenticated() {
    if (!isUserAuthenticated()) {
        header("Location: user.html"); // Cambia user.html por la página de inicio de sesión
        exit;
    }
}

// Verifica la sesión al inicio de cada script PHP
if (!isUserAuthenticated() && basename($_SERVER['PHP_SELF']) != 'login.php') {
    // Si no está autenticado y no está en la página de inicio de sesión, redireccionar
    header("Location: user.html"); // Cambia user.html por la página de inicio de sesión
    exit;
}
?>
