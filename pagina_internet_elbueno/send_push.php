<?php
include("conexion.php");

if (isset($_REQUEST['msg'])){
   
    
    $idUsuario = $_REQUEST['idUsuario'];
    $idContrato = $_REQUEST['mensaje'];
    //$idContrato = $_REQUEST['idContrato'];

    $sqlUsuario = "SELECT nombre, apellido1 FROM clientes WHERE idUsuario = $idUsuario";
    $resultUsuario = $conn->query($sqlUsuario);
    $rowUsuario = $resultUsuario->fetch_assoc();
    $nombre = $rowUsuario["nombre"];
    $apellido1 = $rowUsuario["apellido1"];
    
    $titulo = 'Estimado ' . $nombre . ' ' . $apellido1;
    $titulo = rtrim($titulo);

    
    $sqlMensaje = "SELECT idPaquete FROM contratos WHERE idContrato = $idContrato";
    $resultMensaje = $conn->query($sqlMensaje);
    $rowMensaje = $resultMensaje->fetch_assoc();
    $idPaquete = $rowMensaje["idPaquete"];

    $sqlPaquete = "SELECT nombre, velocidad, precio_mensual, duracion_anual FROM paquetes WHERE idPaquete = $idPaquete";
    $resultPaquete = $conn->query($sqlPaquete);
    $rowPaquete = $resultPaquete->fetch_assoc();
    $nombre = $rowPaquete["nombre"];
    $velocidad = $rowPaquete["velocidad"];
    $precio_mensual = $rowPaquete["precio_mensual"];
    $duracion_anual = $rowPaquete["duracion_anual"];

    $mensaje = 'Su ' . $nombre . ' con velocidad de '. $velocidad . ' con un precio mensual  de '. $precio_mensual . 
    ' y una duracion de ' . $duracion_anual .  ' años se activo con exito :)'  ;
    $mensaje = rtrim($mensaje);

    $consulta = "SELECT * FROM usuarios WHERE idUsuario='$idUsuario'";
    $resultado = $conn->query($consulta);
    $result = "";
    if ($resultado->num_rows > 0) {
        $fila = $resultado->fetch_assoc(); // Obtener la fila de resultado
        $token_telefono = $fila['token_telefono'];

        $ApiServer="AAAAEmis5_c:APA91bEn-SEqACjQ49MEiBs18GSna4ItsFkXir2fzOlNT1B8_1btbGm4wzECoURFtTmGisLuPnlWbsn4KzdKNSYJVCX2dpO4JtryTqeGWATIZ4lNihyAi0MpCCCOD1d2GT39k-dohXlx";
	 
        $result = sendNotification($token_telefono, $mensaje, $titulo, $ApiServer);
    }else{
        $result = "No existe usuario para enviar la notificacion";
    }	
    // $TokenCel = "fVFZiR7BS-2jYaE8f6jDfL:APA91bHl8rtauXtpTIwk_9dK6C_RqdK_HZDdG1Vf4IQyxLMRFIWjJveLLZWWI5xFvhONI_gj6HEmQAvjQASYSCAhi5DXxBXoOYKmL8leF3yFhVzPOWVVwws5nAPS15tvzvcRrFpqbM95";
    
    echo $result;
}

function sendNotification($devicetoken, $mesg, $title, $api_key) {
    $registrationIds = $devicetoken;
    #prep the bundle
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

    #ENVIAR A FireBase Server    
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    curl_close($ch);
    $cur_message = json_decode($result);
    if ($cur_message->success == 1)
        return $result;
    else
        return $result;    
}

?>
