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

// Consulta la base de datos para obtener los datos necesarios
$sql = "SELECT idContrato, idUsuario, idUsuario_Administrador, idPaquete, 
idDireccion_Usuario, fecha_inicio, fecha_final, duracion_contrato, estado_contrato,
porcentaje_reconexion FROM contratos where estado_contrato='PENDIENTE'";
$result = $conn->query($sql);




if ($result->num_rows > 0) {
    // Output data de cada fila
    while ($row = $result->fetch_assoc()) {
      
        $idUsuario = $row["idUsuario"];
        $idPaquete = $row["idPaquete"];

        $sqlUsuario = "SELECT nombre, apellido1, apellido2 FROM clientes WHERE idUsuario = $idUsuario";
        $resultUsuario = $conn->query($sqlUsuario);
        $rowUsuario = $resultUsuario->fetch_assoc();
        $nombre = $rowUsuario["nombre"];
        $apellido1 = $rowUsuario["apellido1"];
        $apellido2 = $rowUsuario["apellido2"];

        $sqlPaquete = "SELECT nombre FROM paquetes WHERE idPaquete = $idPaquete";
        $resultPaquete = $conn->query($sqlPaquete);
        $rowPaquete = $resultPaquete->fetch_assoc();
        $nombrePaquete = $rowPaquete["nombre"];
       


        echo '<div class="sales">
            <div class="status">
                <div class="info">
                    <h3>' . $nombrePaquete . '</h3>
                    <h1>' . $nombre . ' '. $apellido1 . ' '. $apellido2 .'</h1>
                    <p>Duracion de contrato: ' . $row["duracion_contrato"] . ' año'.'</p>
                    <p>Estado de contrato: ' . $row["estado_contrato"] . '</p>
                </div>
                <div class="progress">
                <button><a href="#" onclick="confirmarEliminacion(' . $row["idContrato"] . ')">Eliminar</a></button>
                <button><a href="#" onclick="confirmarContrato(' . $row["idContrato"] . ')">Activar</a></button>

                </div>
            </div>
        </div>';
    }
} else {
    echo "0 resultados";
}
// Cierra la conexión
$conn->close();
// Verificar si los datos del formulario se han enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $idContrato = $_POST['idContrato'];
    $numero_pago = $_POST['numero_pago'];
    $fecha_pago = $_POST['fecha_pago'];
    $estado = $_POST['estado'];


    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar y ejecutar la consulta
    $sql = "INSERT INTO contratos_detalle (idContrato, numero_pago, fecha_pago, estado) 
            VALUES ('$idContrato', '$numero_pago', '$fecha_pago', '$estado')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("¡El paquete ha sido creado con éxito!");</script>';
        echo '<script>window.location.href = "solicitudes.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}



?>