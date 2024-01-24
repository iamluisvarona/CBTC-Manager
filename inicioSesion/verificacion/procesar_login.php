<?php
session_start();

// Verifica si el formulario se envió
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Datos de conexión a la base de datos
    $host = "127.0.0.1:3307";
    $usuario = "root";
    $clave = "";
    $base_de_datos = "fantasy";

    // Conexión a la base de datos
    $conexion = mysqli_connect($host, $usuario, $clave, $base_de_datos);

    // Verificación de la conexión
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Obtener datos del formulario
    $usuario = mysqli_real_escape_string($conexion, $_POST['username']);
    $password = mysqli_real_escape_string($conexion, $_POST['password']);

    // Consulta para verificar si el usuario existe
    $sqlUsuario = "SELECT * FROM tusuario WHERE nomUsuario = '$usuario'";
    $resultadoUsuario = mysqli_query($conexion, $sqlUsuario);

    // Verificar si el usuario existe
    if ($resultadoUsuario && mysqli_num_rows($resultadoUsuario) > 0) {
        // Consulta para verificar las credenciales
        $sql = "SELECT * FROM tusuario WHERE nomUsuario = '$usuario' AND passUsuario = '$password'";
        $resultado = mysqli_query($conexion, $sql);

        // Verificar si las credenciales son correctas
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            // Obtener datos del usuario
            $datosUsuario = mysqli_fetch_assoc($resultado);

            // Iniciar sesión y almacenar variables de sesión
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $usuario;
            $_SESSION['codUsuario'] = $datosUsuario['codUsuario'];
            $_SESSION['dineroBanco'] = $datosUsuario['dineroBanco'];

            // Redireccionar a la página principal
            header("Location: ../../menuPrincipal.php");
            exit();
        } else {
            // Credenciales incorrectas, mostrar mensaje y redireccionar a la página de inicio de sesión
            $_SESSION['login_error'] = "Datos incorrectos. Intente de nuevo.";
            header("Location: ../login.php");
            exit();
        }
    } else {
        // El usuario no existe, mostrar mensaje y redireccionar a la página de inicio de sesión
        $_SESSION['login_error'] = "El usuario '$usuario' no existe.";
        header("Location: ../login.php");
        exit();
    }

    // Cerrar la conexión
    mysqli_close($conexion);
}
?>
