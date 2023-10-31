<?php
$mensajeError = "";
// Conexión a la base de datos (Asegúrate de completar los datos de conexión)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar la conexión
if ($conn->connect_error) {
    die("Conexión a la base de datos fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["pass"])) {
        $email = $_POST["email"];
        $password = $_POST["pass"];

        // Realiza la consulta para verificar el correo y la contraseña
        $sql = "SELECT * FROM usuarios_administradores WHERE correo_electronico = '$email' AND contrasena = '$password' AND cuenta_activa='1'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Usuario válido
            header("Location: dashboard.php"); // Redirigir al usuario a menu.html
            exit();
        } else {
            echo "Usuario y contraseña incorrectos";

        }
    } else {
        // Los campos de correo y contraseña no están configurados en la solicitud POST
        echo "Campos de correo y contraseña no especificados";
    }
}

$conn->close();
?>