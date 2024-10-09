<?php
// config.php

$servername = "localhost";
$username = "root";
$password = ""; // Ingresa tu contraseña de MySQL
$dbname = "agenda";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
