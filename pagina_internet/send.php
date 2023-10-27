<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Conexión a la base de datos (Asegúrate de completar los datos de conexión)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
// Inserción exitosa, ahora envía el token por correo

$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if (
        isset($_POST['nombre']) && isset($_POST['apellido1']) && isset($_POST['apellido2']) && isset($_POST['telefono'])  &&
        isset($_POST['usuario']) && isset($_POST['correo_electronico']) && isset($_POST['contrasena'] ))
    {
        $nombre = $_POST["nombre"];
        $apellido1 = $_POST["apellido1"];
        $apellido2 = $_POST["apellido2"];
        $telefono = $_POST["telefono"];
        //$imagen_perfil = $_FILES["imagen"]["tmp_name"];
        $usuario = $_POST["usuario"];
        $correo_electronico = $_POST["correo_electronico"];
        $contrasena = $_POST["contrasena"];
        // Lee los datos binarios de la imagen
        //$imagenBinaria = file_get_contents($imagen_perfil);

        //Load Composer's autoloader
       require 'PHPMailer/Exception.php';
       require 'PHPMailer/PHPMailer.php';
       require 'PHPMailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
       $mail = new PHPMailer(true);
       $clave_aleatoria1 = md5(uniqid(rand(), true));
       $clave_aleatoria = substr($clave_aleatoria1, 0, 10);
       // Realiza una consulta para verificar si el correo ya está en uso
       $checkEmailQuery = "SELECT * FROM usuarios WHERE correo_electronico = ?";
       $stmt = $conn->prepare($checkEmailQuery);
       $stmt->bind_param("s", $correo_electronico);
       $stmt->execute();
       $result = $stmt->get_result();
       $row = $result->fetch_assoc();
       $idUsuario = $row['idUsuario'];

       if ($result->num_rows > 0) {
          
           echo "El correo electrónico ya está en uso. Introduce otro.";
       } 
       else 
       {

        $insertQuery = "INSERT INTO usuarios (usuario, correo_electronico, contrasena, clave_aleatoria) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssss", $usuario, $correo_electronico, $contrasena, $clave_aleatoria);
        $stmt->execute();

        try 
        {
            $checkEmailQuery = "SELECT * FROM usuarios WHERE correo_electronico = ?";
            $stmt = $conn->prepare($checkEmailQuery);
            $stmt->bind_param("s", $correo_electronico);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $idUsuario = $row['idUsuario'];
            //$idUsuario=123;
            //Server settings
                               //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'marudzul17@gmail.com';                     //SMTP username
            $mail->Password   = 'ybbzdrouirashsfg';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('marudzul17@gmail.com', 'Contact form');
            $mail->addAddress($correo_electronico, $usuario);     //Add a recipient
            
           

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Confirmacion de registro';
            $mail->Body    = 'Para confirmar tu registro, haz clic en el siguiente enlace: http://localhost/pagina_internet/activar.php?clave_aleatoria=' . $clave_aleatoria . 
            '&idUsuario=' . $idUsuario .
            '&nombre=' . $nombre .
            '&apellido1=' . $apellido1 . 
            '&apellido2=' . $apellido2 . 
            '&telefono=' . $telefono;
            //'&imagen_perfil=' . $imagenBinaria;
            
            $mail->send();
            echo 'Message has been sent';
            header("Location: index.php"); 
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

       }
       
    }
}
