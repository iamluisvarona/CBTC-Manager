<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="./estilosInicioSesion/estilosLogin.css">
</head>
<body>
    <header class="plantilla centradoVert horizontalHeaderMenu">
        <div class="divLogoSM">
            <img class="logoSM" src="../img/logo/logoSM3C.png" alt="">
        </div>
        <div class="divTitMenu">
            <h2 class="titMenu">Regístrate</h2>
        </div>
    </header>
    <main>
        <div class="divMostrarMensajes centrarDiv">
            <?php
                // Mostrar mensaje de error si existe
                session_start();
                if (isset($_SESSION['registro_error'])) {
                    echo "<p style='color: red;'>{$_SESSION['registro_error']}</p>";
                    unset($_SESSION['registro_error']); // Limpiar el mensaje después de mostrarlo
                }
            ?>
        </div>
        <form action="./verificacion/procesar_registro.php" method="post" class="formInicio anchoformInicio centrarDiv">
            <div class="divInputInicio centrarDiv">
                <input class="inputInicio" type="text" id="username" name="username" placeholder="Usuario" required>
            </div>
            <div class="divInputInicio centrarDiv">
                <input class="inputInicio" type="email" id="email" name="email" placeholder="Correo" required>
            </div>
            <div class="divInputInicio centrarDiv">
                <input class="inputInicio" type="password" id="password" name="password" placeholder="Contraseña" required>
            </div>
            <div class="divBtnInicio centrarDiv">
                <button  class="btnInicio" type="submit">Registrarse</button>
            </div>
            <div class="centrarDiv divTxtRegistro">
                <p class="textoRegistro">¿Tienes cuenta? <a href="./login.php">Inicia sesión</a></p>
            </div>
        </form>

        
    </main>
    <!-- Puedes agregar tus scripts o enlaces a scripts aquí -->
</body>
</html>

