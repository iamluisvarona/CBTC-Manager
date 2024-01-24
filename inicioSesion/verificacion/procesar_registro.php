<?php
// Iniciar sesión
session_start();

// Verifica si el formulario se envió
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Datos de conexión a la base de datos
    $host = "127.0.0.1:3307";
    $usuario_db = "root";
    $clave_db = "";
    $nombre_db = "fantasy"; // Reemplaza con el nombre de tu base de datos

    // Conexión a la base de datos
    $conexion = new mysqli($host, $usuario_db, $clave_db, $nombre_db);

    // Verificación de la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Obtener datos del formulario
    $usuario = mysqli_real_escape_string($conexion, $_POST['username']);
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $password = mysqli_real_escape_string($conexion, $_POST['password']);

    // Verificar si el usuario ya existe
    $stmtUsuarioExistente = $conexion->prepare("SELECT * FROM tusuario WHERE nomUsuario = ? OR mailUsuario = ?");
    $stmtUsuarioExistente->bind_param("ss", $usuario, $email);
    $stmtUsuarioExistente->execute();
    $resultadoUsuarioExistente = $stmtUsuarioExistente->get_result();

    if ($resultadoUsuarioExistente->num_rows > 0) {
        // El usuario o el correo electrónico ya existen, mostrar mensaje específico y redireccionar a la página de registro
        $filaExistente = $resultadoUsuarioExistente->fetch_assoc();
        if ($filaExistente['nomUsuario'] == $usuario) {
            $_SESSION['registro_error'] = "El usuario '$usuario' ya está registrado.";
        } elseif ($filaExistente['mailUsuario'] == $email) {
            $_SESSION['registro_error'] = "El correo electrónico '$email' ya está registrado.";
        }
        $stmtUsuarioExistente->close();
        header("Location: ../registro.php");
        exit();
    }
    $stmtUsuarioExistente->close();

    // Verificar longitud del usuario
    if (strlen($usuario) < 3 || strlen($usuario) > 15) {
        // La longitud del usuario no es válida, mostrar mensaje y redireccionar a la página de registro
        $_SESSION['registro_error'] = "El usuario debe tener entre 3 y 15 caracteres.";
        header("Location: ../registro.php");
        exit();
    }

    // Insertar nuevo usuario en la base de datos
    $stmtInsertarUsuario = $conexion->prepare("INSERT INTO tusuario (nomUsuario, mailUsuario, passUsuario) VALUES (?, ?, ?)");
    $stmtInsertarUsuario->bind_param("sss", $usuario, $email, $password);
    
    if ($stmtInsertarUsuario->execute()) {
        // Registro exitoso, redireccionar a la página de inicio de sesión
        $_SESSION['registro_success'] = "¡Registro exitoso! Inicia sesión para continuar.";
        header("Location: ../login.php");
        exit();
    } else {
        // Error al insertar usuario, mostrar mensaje y redireccionar a la página de registro
        $_SESSION['registro_error'] = "Error al registrar el usuario. Inténtalo nuevamente.";
        header("Location: ../registro.php");
        exit();
    }

    // Cerrar la conexión
    $stmtInsertarUsuario->close();
    $conexion->close();
}
?>

