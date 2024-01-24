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

$nombreJugador = $_POST['nombre'];
$apellidoJugador = $_POST['apellido'];
$dorsal = $_POST['dorsal'];
$posicion = $_POST['posicion'];
$salud = $_POST['salud'];
$valorJugador = $_POST['valorJugador']; // Nuevo campo agregado
$codEquipo = $_POST['equipo'];

// Insertar datos en la tabla 'tjugador'
$sqlInsertJugador = "INSERT INTO tjugador (nomJugador, apeJugador, numJugador, posJugador, valorJugador, imgJugador, saludJugador, codEquipo) 
                    VALUES ('$nombreJugador', '$apellidoJugador', $dorsal, '$posicion', $valorJugador, './img/Jugadores/jugSinFoto.png', '$salud', $codEquipo)";

// Ejecutar la consulta
if (mysqli_query($conexion, $sqlInsertJugador)) {
    // Obtener el codJugador recién insertado
    $codJugador = mysqli_insert_id($conexion);

    // Actualizar el campo imgJugador
    $sqlUpdateImg = "UPDATE tjugador SET imgJugador = './img/Jugadores/$codJugador.png' WHERE codJugador = $codJugador";
    if (!mysqli_query($conexion, $sqlUpdateImg)) {
        echo "Error al actualizar imgJugador: " . mysqli_error($conexion);
    }

    // Cerrar la conexión
    mysqli_close($conexion);

    // Redirigir a la página principal o mostrar un mensaje de éxito
    header("Location: ../tablas/jugador.php");
    exit();
} else {
    echo "Error al insertar en tjugador: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>
