<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

$connection = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($connection->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


if (
    isset($_GET['idContrato']) && !empty($_GET['idContrato'])
) {
    

    $idContrato = mysqli_real_escape_string($connection, $_GET['idContrato']);

    $sqlUsuario = "SELECT estado_contrato FROM contratos WHERE idContrato = $idContrato";
    $resultUsuario = $connection->query($sqlUsuario);
    $rowUsuario = $resultUsuario->fetch_assoc();
    $estado_contrato = $rowUsuario["estado_contrato"];

    // Obtiene la fecha actual
    $fecha_actual = date("Y-m-d");

    // Suma un mes a la fecha actual para obtener la fecha de inicio
    $fecha_inicio = date("Y-m-d", strtotime($fecha_actual . " +1 month"));

    // Calcula la fecha final como un año después de la fecha de inicio
    $fecha_final = date("Y-m-d", strtotime($fecha_inicio . " +1 year"));

    $numero_pago = 1; // Inicializa el número de pago

    $insertQuery = "INSERT INTO contratos_detalles (idContrato, numero_pago, fecha_pago, estado) VALUES (?, ?, ?, ?)";
    $stmt = $connection->prepare($insertQuery);

    $update_query = "UPDATE contratos SET estado_contrato = 'COMPLETADO' WHERE idContrato ='".$idContrato. "' AND estado_contrato = 'PENDIENTE'";
    $result = mysqli_query($connection, $update_query);
    

    while (true) {
        $fecha_pago = date("Y-m-d", strtotime($fecha_inicio . " +$numero_pago months")); // Convierte la fecha al formato "yyyy-mm-dd"

        // Verifica si el número de pago es mayor que 12 o si se supera la fecha final
        if ($numero_pago > 12 || strtotime($fecha_pago) > strtotime($fecha_final)) {
            break;
        }

        $stmt->bind_param("ssss", $idContrato, $numero_pago, $fecha_pago, $estado_contrato);
        $stmt->execute();
        $numero_pago++;
    }
    
    if ($stmt->execute()) {
        // La inserción se realizó con éxito
        // También, la actualización del estado se realizó con éxito
        echo '<script>alert("Contrato activado con éxito.");</script>';
        echo '<script>window.location.href = "solicitudes.php";</script>';
    } else {
        // Hubo un error en la inserción o actualización
        echo "Error al activar el contrato: " . $stmt->error;
        $stmt->close();
    }

}


?>
