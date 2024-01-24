<?php
// Conexión a la base de datos (debes completar con tus propios detalles de conexión)
$conexion = mysqli_connect("127.0.0.1:3307", "root", "", "fantasy");

// Verificación de la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener el valor del campo de entrada
$nomCategoria = $_POST['nomCategoria'];

// Query para insertar en la tabla
$sql = "INSERT INTO tcategoria (nomCategoria) VALUES ('$nomCategoria')";

// Ejecutar la consulta
if (mysqli_query($conexion, $sql)) {
    echo "Categoría insertada correctamente";
    header('Location: http://localhost/actualizado/Fantasy/panelAdmin/tablas/categoria.html');
} else {
    echo "Error al insertar categoría: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>
