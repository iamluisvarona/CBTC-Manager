<?php
// subirPartido.php

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
$jornada = $_POST['jornada'];
$fechaPartido = $_POST['fechaPartido'];
$horaPartido = $_POST['horaPartido'];
$equipoCBTC = $_POST['equipoCBTC'];
$dorsalCBTC = $_POST['dorsalCBTC'];
$equipoRival = $_POST['equipoRival'];
$dorsalRival = $_POST['dorsalRival'];
$jc = $_POST['numJugadoresCargados'];

// Insertar datos en la tabla 'tpartido'
$sqlInsertPartido = "INSERT INTO tpartido (fecPartido, horaPartido, codEquipo, codEquipoRival, codJornada, ptsEquipo, ptsEquipoRival) 
                    VALUES ('$fechaPartido', '$horaPartido', '$equipoCBTC', '$equipoRival', '$jornada', '$dorsalCBTC', '$dorsalRival')";

if (mysqli_query($conexion, $sqlInsertPartido)) {
    // Obtener el codPartido recién insertado
    $codPartido = mysqli_insert_id($conexion);

    // Iterar sobre los datos de la tabla de jugadores y insertar en 'tjugadorpartido'
    for ($i = 1; $i <= $jc; $i++) {
        $codJugador = $_POST["codJugador$i"];
        $minutos = $_POST["minutos$i"];

        // Verificar si el input de minutos no está vacío
        if (!empty($minutos)) {
            $puntos = $_POST["puntos$i"];
            $tlFallados = $_POST["tlFallados$i"];
            $t3Anotados = $_POST["t3Anotados$i"];
            $faltas = $_POST["faltas$i"];

            // Insertar datos en 'tjugadorpartido'
            $sqlInsertJugadorPartido = "INSERT INTO tjugadorpartido (codJugador, codPartido, minutos, puntos, tlFallados, t3Anotados, faltas) 
                                        VALUES ('$codJugador', '$codPartido', '$minutos', '$puntos', '$tlFallados', '$t3Anotados', '$faltas')";
            mysqli_query($conexion, $sqlInsertJugadorPartido);
        }
    }

    // Cerrar la conexión
    mysqli_close($conexion);

    // Redirigir a la página principal o mostrar un mensaje de éxito
    header("Location: ../tablas/partido.php");
    exit();
} else {
    echo "Error al insertar en tpartido: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>
