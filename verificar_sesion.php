<?php
session_start();
// Verificar si el usuario está autenticado
if (isset($_SESSION['username'])) {
    echo "authenticated";
} else {
    echo "not_authenticated";
}
?>
