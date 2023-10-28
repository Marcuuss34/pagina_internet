<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
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
            <h1>Paquetes</h1>
            <!-- Analyses -->
            <div class="analyse">
                <?php include 'cargarInfo.php'; ?>
            </div>
            <!-- End of Analyses -->

            <!-- New Users Section -->
            <div class="new-users">
                <h2>New Users</h2>
                <div class="user-list">
                    <div class="user">
                        <img src="images/profile-2.jpg">
                        <h2>Jack</h2>
                        <p>54 Min Ago</p>
                    </div>
                    <div class="user">
                        <img src="images/profile-3.jpg">
                        <h2>Amir</h2>
                        <p>3 Hours Ago</p>
                    </div>
                    <div class="user">
                        <img src="images/profile-4.jpg">
                        <h2>Ember</h2>
                        <p>6 Hours Ago</p>
                    </div>
                    <div class="user">
                        <img src="images/plus.png">
                        <h2>More</h2>
                        <p>New User</p>
                    </div>
                </div>
            </div>
            <!-- End of New Users Section -->

            <!-- Recent Orders Table -->
            <div class="recent-orders">
                <h2>Recent Orders</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Course Name</th>
                            <th>Course Number</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
                <a href="#">Show All</a>
            </div>
            <!-- End of Recent Orders -->

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