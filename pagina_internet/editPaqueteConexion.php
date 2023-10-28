<?php
// Establece la conexión a tu base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aplicacion";

// Crea la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Realiza una consulta para obtener los detalles del paquete con el ID especificado
    $sql = "SELECT * FROM paquetes WHERE idPaquete = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // El paquete existe, muestra el formulario de edición con los datos prellenados
        $paquete = $result->fetch_assoc(); // Obtiene los detalles del paquete como un array asociativo

        // Muestra el formulario con los campos prellenados
        echo '<form id="formCrearPaquete" class="form-crear-paquete" action="editPaqueteConexion.php" method="post">
                <main>
                <input type="hidden" name="id" value="' . $id . '"> <!-- Campo oculto para el ID -->
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre-input" name="nombre" value="' . $paquete["nombre"] . '" required>
                    </div>

                    <div class="form-group">
                        <label for="velocidad">Velocidad:</label>
                        <input type="text" id="velocidad-input" name="velocidad" value="' . $paquete["velocidad"] . '" required>
                    </div>

                    <div class="form-group">
                        <label for="precio">Precio:</label>
                        <input type="text" id="precio-input" name="precio" value="' . $paquete["precio_mensual"] . '" required>
                    </div>

                    <div class="form-group">
                        <label for="duracion">Duración:</label>
                        <input type="number" id="duracion-input" name="duracion" value="' . $paquete["duracion_anual"] . '" required>
                    </div>

                    <div class="form-group">
                        <label for="datosIncluidos">Datos incluidos:</label>
                        <input type="text" id="datosIncluidos-input" name="datosIncluidos" value="' . $paquete["datos_incluidos"] . '" required>
                    </div>

                    <div class="form-group">
                        <label for="tipoConexion">Tipo de conexión:</label>
                        <input type="text" id="tipoConexion-input" name="tipoConexion" value="' . $paquete["tipo_conexion"] . '" required>
                    </div>

                    <div class="form-group">
                        <label for="descripcion">Descripción:</label><br>
                        <textarea id="descripcion" name="descripcion-input" rows="4" cols="50" required>' . $paquete["descripcion"] . '</textarea>
                    </div>
                    <div class="progress">
                        <button type="submit" id="editarPaqueteSubmit">Guardar Cambios</button>
                    </div>
                </main>
            </form>';
    } else {
        echo "No se encontró el paquete con el ID especificado.";
    }
}

// Verifica si se han enviado los datos del formulario para actualizar
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $id = $_POST['id']; // Asegúrate de tener este valor si es necesario para identificar el registro en tu base de datos
    $nombre = $_POST['nombre'];
    $velocidad = $_POST['velocidad'];
    $precio = $_POST['precio'];
    $duracion = $_POST['duracion'];
    $datosIncluidos = $_POST['datosIncluidos'];
    $tipoConexion = $_POST['tipoConexion'];
    $descripcion = $_POST['descripcion-input'];

    // Realiza la actualización en la base de datos
    $sql = "UPDATE paquetes SET nombre='$nombre', velocidad='$velocidad', precio_mensual='$precio', duracion_anual='$duracion', datos_incluidos='$datosIncluidos', tipo_conexion='$tipoConexion', descripcion='$descripcion' WHERE idPaquete=$id";

    if ($conn->query($sql) === TRUE) {
        echo '<script>alert("¡El paquete ha sido actualizado con éxito!");</script>';
        echo '<script>window.location.href = "dashboard.php";</script>';
    } else {
        echo "Error al actualizar el registro: " . $conn->error;
    }
}

?>