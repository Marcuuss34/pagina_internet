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
if (isset($_GET['idContrato'])) {
    $idContrato = $_GET['idContrato'];
    // Crea y ejecuta la consulta para eliminar el paquete con el ID especificado
    $sql = "UPDATE contratos SET estado_contrato = 'BAJA' WHERE idContrato ='".$idContrato. "' AND estado_contrato = 'PENDIENTE'";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("¡La solicitud se ha sido eliminado con éxito!");</script>';
        echo '<script>window.location.href = "solicitudes.php";</script>';
    } else {
        echo "Error al eliminar al eliminar solicitud: " . $conn->error;
    }
    // Cierra la conexión a la base de datos
    $conn->close();
}

?>