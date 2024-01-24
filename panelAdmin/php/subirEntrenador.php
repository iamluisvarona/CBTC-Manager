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

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$valorEntrenador = $_POST['valorEntrenador'];
$imgEntrenador = $_POST['imgEntrenador']; // Ten en cuenta que la imagen debe ser procesada correctamente
$tipoEntrenador = $_POST['tipoEntrenador'];
$codEquipo = $_POST['equipo'];

// Insertar datos en la tabla 'tentrenador'
$sqlInsertEntrenador = "INSERT INTO tentrenador (nomEntrenador, apeEntrenador, valorEntrenador, imgEntrenador, tipoEntrenador, codEquipo) 
                        VALUES ('$nombre', '$apellido', '$valorEntrenador', '$imgEntrenador', '$tipoEntrenador', $codEquipo)";

if (mysqli_query($conexion, $sqlInsertEntrenador)) {
    // Obtener el codEntrenador recién insertado
    $codEntrenador = mysqli_insert_id($conexion);

    // Actualizar el campo imgEntrenador con el valor por defecto
    $imgDefault = "./img/Entrenadores/$codEntrenador.png";
    $sqlUpdateImg = "UPDATE tentrenador SET imgEntrenador = '$imgDefault' WHERE codEntrenador = $codEntrenador";
    if (!mysqli_query($conexion, $sqlUpdateImg)) {
        echo "Error al actualizar imgEntrenador: " . mysqli_error($conexion);
    }

    // Cerrar la conexión
    mysqli_close($conexion);

    // Redirigir a la página principal o mostrar un mensaje de éxito
    header("Location: ../tablas/entrenador.php");
    exit();
} else {
    echo "Error al insertar en tentrenador: " . mysqli_error($conexion);
}

?>
