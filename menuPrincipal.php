<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['username'])) {
    // Usuario no autenticado, redirigir a login.php
    header("Location: ./InicioSesion/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Principal</title>
    <link rel="stylesheet" href="styleMenuPrincipal.css">
</head>
<body>
    <header class="plantilla centradoVert horizontalHeaderMenu">
        <div class="divLogoSM">
            <img class="logoSM" src="./img/logo/logoSM3C.png" alt="">
        </div>
        <div class="divTitMenu">
            <h2 class="titMenu">Menú Principal</h2>
        </div>
    </header>
    <main>
        <div class="divBtnMenu centrarDiv">
            <a class="btnMenu" href="./plantilla.php">Mi equipo</a>
        </div>
        <div class="divBtnMenu centrarDiv">
            <a class="btnMenu" href="">Clasificación</a>
        </div>
        <div class="divBtnMenu centrarDiv">
            <a class="btnMenu" href="">Mercado jugadores</a>
        </div>
        <div class="divBtnMenu centrarDiv">
            <a class="btnMenu" href="./pantallaMejores.php">Los mejores</a>
        </div>
        <div class="divBtnMenu centrarDiv">
            <a class="btnMenu" href="">¿Cómo funciona?</a>
        </div>
        <div class="divBtnMenu centrarDiv">
            <a class="btnMenu" href="./cerrarSesion/cierreSesion.php">Cerrar sesión</a>
        </div>
    </main>
    <footer>
        <p>¡<?=$_SESSION['username']?>, bienvenido al SM CBTC!</p>
    </footer>
</body>
</html>