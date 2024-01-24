<?php
// Conexión a la base de datos (reemplaza con tus propios detalles de conexión)
$conexion = mysqli_connect("127.0.0.1:3307", "root", "", "fantasy");

// Verificación de la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener los valores del formulario
$numJornada = $_POST['numJornada'];
$fecInicio = $_POST['fecInicio'];
$fecFinal = $_POST['fecFinal'];

// Query para insertar en la tabla
$sql = "INSERT INTO tjornada (numJornada, fecInicio, fecFinal) VALUES ('$numJornada', '$fecInicio', '$fecFinal')";

// Ejecutar la consulta
if (mysqli_query($conexion, $sql)) {
    echo "Jornada insertada correctamente";
    header('Location: http://localhost/actualizado/Fantasy/panelAdmin/tablas/jornada.html');
} else {
    echo "Error al insertar jornada: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>
