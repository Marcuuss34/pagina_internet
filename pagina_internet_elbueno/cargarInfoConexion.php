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
$sql = "SELECT idPaquete, nombre, velocidad, precio_mensual, datos_incluidos, tipo_conexion FROM paquetes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data de cada fila
    while ($row = $result->fetch_assoc()) {
        echo '<div class="sales">
            <div class="status">
                <div class="info">
                    <h3>' . $row["nombre"] . '</h3>
                    <h1>$' . $row["precio_mensual"] . '</h1>
                    <p>Velocidad: ' . $row["velocidad"] . '</p>
                    <p>Tipo de conexion: ' . $row["tipo_conexion"] . '</p>
                    <p>Datos incluidos: ' . $row["datos_incluidos"] . '</p>
                </div>
                <div class="progress">
                <button><a href="#" onclick="confirmarEliminacion(' . $row["idPaquete"] . ')">Eliminar</a></button>
                <button><a href="editar_paquete.php?id=' . $row["idPaquete"] . '">Editar</a></button>
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
    $nombre = $_POST['nombre'];
    $velocidad = $_POST['velocidad'];
    $precio = $_POST['precio'];
    $duracion = $_POST['duracion'];
    $datosIncluidos = $_POST['datosIncluidos'];
    $tipoConexion = $_POST['tipoConexion'];
    $descripcion = $_POST['descripcion-input'];

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Preparar y ejecutar la consulta
    $sql = "INSERT INTO paquetes (nombre, velocidad, precio_mensual, duracion_anual, datos_incluidos, tipo_conexion, descripcion) 
            VALUES ('$nombre', '$velocidad', '$precio', '$duracion', '$datosIncluidos', '$tipoConexion', '$descripcion')";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("¡El paquete ha sido creado con éxito!");</script>';
        echo '<script>window.location.href = "dashboard.php";</script>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
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