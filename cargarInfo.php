<?php
// Configura tus credenciales de la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aplicacion";

// Crea una conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta la base de datos para obtener los datos necesarios
$sql = "SELECT nombre, velocidad, precio_mensual, duracion_anual, datos_incluidos, tipo_conexion, descripcion FROM paquetes";
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
                <div class="progresss">
                <button>Eliminar</button>
                <button>Editar</button>
                </div>
            </div>
        </div>';
    }
} else {
    echo "0 resultados";
}

// Cierra la conexión
$conn->close();
?>