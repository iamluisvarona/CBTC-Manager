<?php
session_start();

// Verificar si el usuario está autenticado
if (isset($_SESSION['username'])) {
    // Usuario no autenticado, redirigir a login.php
    header("Location: ../menuPrincipal.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="./estilosInicioSesion/estilosLogin.css">
</head>
<body>
    <header class="plantilla centradoVert horizontalHeaderMenu">
        <div class="divLogoSM">
            <img class="logoSM" src="../img/logo/logoSM3C.png" alt="">
        </div>
        <div class="divTitMenu">
            <h2 class="titMenu">Inicia Sesión</h2>
        </div>
    </header>
    <main>
        <div class="divMostrarMensajes centrarDiv">
            <?php
            // Mostrar mensaje de éxito en el registro si existe
            if (isset($_SESSION['registro_success'])) {
                echo '<p style="color: green;">' . $_SESSION['registro_success'] . '</p>';
                // Limpiar el mensaje de éxito para que no se muestre en futuras recargas de la página
                unset($_SESSION['registro_success']);
            }

            // Mostrar mensaje de error si existe
            if (isset($_SESSION['login_error'])) {
                echo '<p style="color: red;">' . $_SESSION['login_error'] . '</p>';
                // Limpia el mensaje de error después de mostrarlo
                unset($_SESSION['login_error']);
            }
            ?>
        </div>
        <!-- Formulario de inicio de sesión -->
        <form action="./verificacion/procesar_login.php" method="post" class="formInicio anchoformInicio centrarDiv">
            <div class="divInputInicio centrarDiv">
                <input class="inputInicio" type="text" name="username" placeholder="Usuario" required>
            </div>
            <div class="divInputInicio centrarDiv">
                <input class="inputInicio" type="password" name="password" placeholder="Contraseña" required>
            </div>
            <div class="divBtnInicio centrarDiv">
                <button class="btnInicio" type="submit">Iniciar Sesión</button>
            </div>
            <!-- Enlace para registrarse -->
            <div class="centrarDiv divTxtRegistro">
                <p class="textoRegistro">¿No tienes una cuenta? <a href="registro.php">Registrarse</a></p>
            </div>
        </form>
    </main>
</body>
</html>

