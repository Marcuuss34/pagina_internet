<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
// Inserción exitosa, ahora envía el token por correo

$connection = new mysqli($servername, $username, $password, $dbname);
if(
    isset($_GET['clave_aleatoria']) && !empty($_GET['clave_aleatoria'])
    ){
    // Verificar datos
    //$nombre = mysqli_real_escape_string($connection, $_GET['nombre']); 
    //$apellido1 = mysqli_real_escape_string($connection, $_GET['apellido1']); 
    //$apellido2 = mysqli_real_escape_string($connection, $_GET['apellido2']); 
    //$telefono = mysqli_real_escape_string($connection, $_GET['telefono']); 
    //$idUsuario = mysqli_real_escape_string($connection, $_GET['idUsuario']); 
    //$imagen_perfil1 = 123; // Reemplaza esto con tu valor de usuario

// Convierte el número en una cadena binaria de 16 bits (2 bytes)
    //$imagen_perfil = pack("n", $imagen_perfil1);
   
    $clave_aleatoria = mysqli_real_escape_string($connection, $_GET['clave_aleatoria']); // Asignar el hash a una variable
    
    $query = "SELECT correo_electronico, clave_aleatoria, cuenta_activa FROM usuarios_administradores WHERE clave_aleatoria='".$clave_aleatoria."' AND cuenta_activa='0'";
    
    $result = mysqli_query($connection, $query);
    
    if ($result) {
        $match = mysqli_num_rows($result);
        
        if($match > 0){
            // Hay una coincidencia, activar la cuenta
            $update_query = "UPDATE usuarios_administradores SET cuenta_activa = '1' WHERE clave_aleatoria ='".$clave_aleatoria. "' AND cuenta_activa = '0'";

            if (mysqli_query($connection, $update_query)) {
                
                echo "Tu cuenta ha sido activada, ya puedes iniciar sesión";
            } else {
                echo "Error al activar la cuenta: " . mysqli_error($connection);
            }
        } else {
            // No hay coincidencias
            echo "La URL es inválida o ya has activado tu cuenta";
        }
    } else {
        echo "Error en la consulta: " . mysqli_error($connection);
    }
    
    mysqli_close($connection);
} else {
    // Intento no válido (ya sea porque se ingresa sin tener el hash o porque la cuenta ya ha sido registrada)
    echo "Intento inválido, por favor revisa el mensaje que enviamos por correo electrónico";
}
?>
