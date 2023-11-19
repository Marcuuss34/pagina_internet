<?php
include("conexion.php");

if (isset($_GET['msg'])) {
    $titulo = $_GET['titulo'];
    $mensaje = $_GET['mensaje'];
    $idUsuario = $_GET['idUsuario'];

    $consulta = "SELECT * FROM usuarios WHERE idUsuario=?";
    $stmt = $conn->prepare($consulta);
    $stmt->bind_param("s", $idUsuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc();
        $token_telefono = $fila['token_telefono'];

        $ApiServer = "AAAAFKNy4IQ:APA91bGfhzOiC2vVcKXDdTXAZYP0Nd0NHisVDe2mr-gOAGFgzyGJbOORlWHCAQ4K7WZZB7hiPWr1E25hTcPURQDXjtj-l5OL6t-4VleBBsDKt4CG2dKaHHW6QAcZE5_bgObEokStOqK0";

        $result = sendNotification($token_telefono, $mensaje, $titulo, $ApiServer);
        echo $result;
    } else {
        echo "No existe usuario para enviar la notificación";
    }

    $stmt->close();
}

function sendNotification($devicetoken, $mesg, $title, $api_key)
{
    $registrationIds = $devicetoken;
    $msg = array(
        "body" => $mesg,
        "title" => $title,
        "sound" => "mySound",
        "color" => "#00a99d",
    );

    $fields = array(
        'to' => $registrationIds,
        'notification' => $msg,
        'priority' => 'high',
    );

    $headers = array(
        'Authorization: key=' . $api_key,
        'Content-Type: application/json;charset=UTF-8'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);

    $result = curl_exec($ch);

    if ($result === false) {
        // Manejar el error de cURL aquí
        echo "Error en la solicitud cURL: " . curl_error($ch);
    } else {
        $cur_message = json_decode($result);
        if ($cur_message->success == 1) {
            return $result;
        } else {
            // Manejar el error de Firebase aquí
            echo "Error en la solicitud a Firebase: " . $result;
        }
    }

    curl_close($ch);
}
?>