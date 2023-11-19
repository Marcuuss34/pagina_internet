<?php
$servername = "localhost";      // Computer host
$username = "root";             // MySql username
$password = "";         // MySQL password
$dbname = "app";               // Database name

// Crear conexion
$conn = new mysqli($servername, $username, $password, $dbname);
// Validar conexion
if ($conn->connect_error) {
    die("Error de Conexión: " . $conn->connect_error);
}

?>