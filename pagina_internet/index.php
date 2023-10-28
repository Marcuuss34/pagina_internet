<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="docs/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playpen+Sans:wght@500&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <title>FORMULARIO DE REGISTRO E INICIO DE SESION</title>
</head>

<body>
    <div class="container-form register">
        <div class="information">
            <div class="info-childs">
                <h2>Bienvenido</h2>
                <p>Para unirte a nuestra comunidad por favor Inicia Sesión
                    con tus datos</p>
                <input type="button" value="Iniciar Sesión" id="sign-in">

            </div>

        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Crear una Cuenta</h2>
                <div class="icons">

                </div>

                <form class="form" method="post" action="send.php" enctype="multipart/form-data">
                    <label>
                        <i class='bx bx-user'></i>
                        <input id="_nombre_ " type="text" name="nombre" placeholder="Nombre">
                    </label>
                    <label>
                        <i class='bx bx-user'></i>
                        <input id="_nombre_ " type="text" name="apellido1" placeholder="Apellido Paterno">
                    </label>
                    <label>
                        <i class='bx bx-user'></i>
                        <input id="_nombre_ " type="text" name="apellido2" placeholder="Apellido Materno">
                    </label>
                    <label>
                        <i class='bx bx-user'></i>
                        <input id="_nombre_ " type="text" name="telefono" placeholder="Telefono">
                    </label>
                    <label>
                        <i class='bx bx-user'></i>
                        <input id="_usuario_" type="text" name="usuario" placeholder="Username">
                    </label>
                    <label>
                        <i class='bx bx-envelope'></i>
                        <input id="_correo_" type="email" name="correo_electronico" placeholder="Correo Electronico">
                    </label>
                    <label>
                        <i class='bx bx-lock-alt'></i>
                        <input id="_pssword_" type="password" name="contrasena" placeholder="Contraseña">
                    </label>

                    <input type="submit" name="send" value="Enviar">
                </form>


            </div>
        </div>
    </div>

    <div class="container-form login hide">
        <div class="information">
            <div class="info-childs">
                <h2>¡¡Bienvenido nuevamente!!</h2>
                <p>Para unirte a nuestra comunidad por favor Inicia Sesión
                    con tus datos</p>
                <input type="button" value="Registrarse" id="sign-up">

            </div>

        </div>
        <div class="form-information">
            <div class="form-information-childs">
                <h2>Iniciar Sesión</h2>
                <div class="icons">

                </div>
                <form class="form" method="post" action="procesar_inicio_sesion.php">
                    <label>
                        <i class='bx bx-envelope'></i>
                        <input type="email" name="email" placeholder="Correo Electronico">
                    </label>
                    <label>
                        <i class='bx bx-lock-alt'></i>
                        <input type="password" name="pass" placeholder="Contraseña">
                    </label>

                    <input type="submit" value="Iniciar Sesión" id="iniciar-sesion-button">
                </form>
            </div>
        </div>
    </div>
    <script src="docs/script.js"></script>
    <!-- Incluye jQuery y jQuery UI -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>

</body>

</html>