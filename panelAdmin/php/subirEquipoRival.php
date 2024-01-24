<?php
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

// Insertar datos en la tabla 'tequiporival'
$nomEquipoRival = $_POST['nomEquipoRival'];
$aliasEquipoRival = $_POST['aliasEquipoRival'];
$imgEquipoRival = $_POST['imgEquipoRival'];

$sqlInsertEquipoRival = "INSERT INTO tequiporival (nomEquipoRival, aliasEquipoRival, imgEquipoRival) VALUES ('$nomEquipoRival', '$aliasEquipoRival', '$imgEquipoRival')";

if (mysqli_query($conexion, $sqlInsertEquipoRival)) {
    // Cerrar la conexión
    mysqli_close($conexion);

    // Redirigir a la página principal o mostrar un mensaje de éxito
    header("Location: ../tablas/equipoRival.html");
    exit();
} else {
    echo "Error al insertar en tequiporival: " . mysqli_error($conexion);
}
?>
