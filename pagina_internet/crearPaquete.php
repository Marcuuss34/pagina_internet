<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="style_menu.css">
    <title>Responsive Dashboard Design #1 | AsmrProg</title>
</head>

<body>

    <div class="container">
        <!-- Sidebar Section -->
        <aside>
            <div class="toggle">
                <div class="logo">
                    <img src="images/logo.png">
                    <h2>Asmr<span class="danger">Prog</span></h2>
                </div>
                <div class="close" id="close-btn">
                    <span class="material-icons-sharp">
                        close
                    </span>
                </div>
            </div>

            <div class="sidebar">
                <a href="#" id="paquetes" class="active">
                    <span class="material-icons-sharp">
                        dashboard
                    </span>
                    <h3>Paquetes</h3>
                </a>
                <a href="#" id="users">
                    <span class="material-icons-sharp">
                        person_outline
                    </span>
                    <h3>Usuarios</h3>
                </a>
                <a href="#" id="solicitudes">
                    <span class="material-icons-sharp">
                        mail_outline
                    </span>
                    <h3>Solicitudes</h3>
                </a>
                <a href="#">
                    <span class="material-icons-sharp">
                        logout
                    </span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>
        <!-- End of Sidebar Section -->

        <!-- Main Content -->
        <main>
            <h1>Crear nuevo paquete</h1>

            <form id="formCrearPaquete" class="form-crear-paquete" action="cargarInfo.php" method="post">
                <main>
                    <form id="formCrearPaquete" class="form-crear-paquete">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre-input" name="nombre" required>
                        </div>

                        <div class="form-group">
                            <label for="velocidad">Velocidad:</label>
                            <input type="text" id="velocidad-input" name="velocidad" required>
                        </div>

                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input type="text" id="precio-input" name="precio" required>
                        </div>

                        <div class="form-group">
                            <label for="duracion">Duración:</label>
                            <input type="number" id="duracion-input" name="duracion" required>
                        </div>

                        <div class="form-group">
                            <label for="datosIncluidos">Datos incluidos:</label>
                            <input type="text" id="datosIncluidos-input" name="datosIncluidos" required>
                        </div>

                        <div class="form-group">
                            <label for="tipoConexion">Tipo de conexión:</label>
                            <input type="text" id="tipoConexion-input" name="tipoConexion" required>
                        </div>

                        <div class="form-group">
                            <label for="descripcion">Descripción:</label><br>
                            <textarea id="descripcion" name="descripcion-input" rows="4" cols="50" required></textarea>
                        </div>
                        <div class="progress">
                            <button type="submit" id="crearPaqueteSubmit">Crear Paquete</button>
                        </div>
                    </form>
                </main>
            </form>

        </main>
        <!-- End of Main Content -->

        <!-- Right Section -->
        <div class="right-section">
            <div class="nav">
                <button id="menu-btn">
                    <span class="material-icons-sharp">
                        menu
                    </span>
                </button>
                <div class="dark-mode">
                    <span class="material-icons-sharp active">
                        light_mode
                    </span>
                    <span class="material-icons-sharp">
                        dark_mode
                    </span>
                </div>

                <div class="profile">
                    <div class="info">
                        <p>Hey, <b>Reza</b></p>
                        <small class="text-muted">Admin</small>
                    </div>
                    <div class="profile-photo">
                        <img src="images/profile-1.jpg">
                    </div>
                </div>

            </div>
            <!-- End of Nav -->

            <div class="user-profile">
                <div class="logo">
                    <img src="images/logo.png">
                    <h2>AsmrProg</h2>
                    <p>Fullstack Web Developer</p>
                </div>
            </div>

        </div>

    </div>


    </div>

    <script src="orders_menu.js"></script>
    <script src="index_menu.js"></script>

    <script>
        // Obtén el elemento del enlace por su id
        var menuLink = document.getElementById("paquetes");

        // Agrega un controlador de eventos "click" al enlace
        menuLink.addEventListener("click", function () {
            // Redirige al usuario a "menu2.php"
            window.location.href = "dashboard.php";
        });
    </script>

    <script>
        // Obtén el elemento del enlace por su id
        var menuLink = document.getElementById("users");

        // Agrega un controlador de eventos "click" al enlace
        menuLink.addEventListener("click", function () {
            // Redirige al usuario a "menu2.php"
            window.location.href = "users.php";
        });
    </script>

    <script>
        // Obtén el elemento del enlace por su id
        var menuLink = document.getElementById("solicitudes");

        // Agrega un controlador de eventos "click" al enlace
        menuLink.addEventListener("click", function () {
            // Redirige al usuario a "menu2.php"
            window.location.href = "solicitudes.php";
        });
    </script>
</body>

</html>