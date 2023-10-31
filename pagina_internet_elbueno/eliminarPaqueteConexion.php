<?php
// Configura tus credenciales de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Crea una conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si se ha enviado un ID para eliminar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Crea y ejecuta la consulta para eliminar el paquete con el ID especificado
    $sql = "DELETE FROM paquetes WHERE idPaquete = $id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("¡El paquete ha sido eliminado con éxito!");</script>';
        echo '<script>window.location.href = "dashboard.php";</script>';
    } else {
        echo "Error al eliminar el paquete: " . $conn->error;
    }
    // Cierra la conexión a la base de datos
    $conn->close();
}

?>