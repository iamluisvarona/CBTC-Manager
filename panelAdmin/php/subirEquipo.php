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

// Insertar datos en la tabla 'tequipo'
$sexoEquipo = mysqli_real_escape_string($conexion, $_POST['sexoEquipo']);
$nomEquipo = mysqli_real_escape_string($conexion, $_POST['nombreEquipo']);
$codCategoria = mysqli_real_escape_string($conexion, $_POST['categoria']);
$aliasEquipo = mysqli_real_escape_string($conexion, $_POST['aliasEquipo']);

$sqlInsertEquipo = "INSERT INTO tequipo (sexEquipo, nomEquipo, codCategoria, aliasEquipo) VALUES ('$sexoEquipo', '$nomEquipo', $codCategoria, '$aliasEquipo')";

if (mysqli_query($conexion, $sqlInsertEquipo)) {
    // Obtener el codEquipo recién insertado
    $codEquipo = mysqli_insert_id($conexion);

    // Insertar datos en la tabla 'tjugador'
    for ($i = 1; $i <= 15; $i++) {
        // Verificar que el campo nombre no esté vacío antes de insertar
        $nombreJugador = mysqli_real_escape_string($conexion, $_POST['nombre'][$i]);

        if (!empty($nombreJugador)) {
            $subirJugador = isset($_POST['subirJugador'][$i]) ? $_POST['subirJugador'][$i] : 0;
            $dorsal = $_POST['dorsal'][$i];
            $apellidoJugador = $_POST['apellido'][$i];
            $posicion = $_POST['posicion'][$i];
            $valor = $_POST['valor'][$i];
            $salud = $_POST['salud'][$i];
    
            // Insertar datos en la tabla 'tjugador'
            $sqlInsertJugador = "INSERT INTO tjugador (nomJugador, apeJugador, numJugador, posJugador, valorJugador, saludJugador, codEquipo) 
                                VALUES ('$nombreJugador', '$apellidoJugador', '$dorsal', '$posicion', '$valor', '$salud', '$codEquipo')";
    
            if (mysqli_query($conexion, $sqlInsertJugador)) {
                // Obtener el codJugador recién insertado
                $codJugador = mysqli_insert_id($conexion);
    
                // Actualizar el campo imgJugador
                $sqlUpdateImg = "UPDATE tjugador SET imgJugador = './img/Jugadores/$codJugador.png' WHERE codJugador = $codJugador";
                if (!mysqli_query($conexion, $sqlUpdateImg)) {
                    echo "Error al actualizar imgJugador: " . mysqli_error($conexion);
                }
            } else {
                echo "Error al insertar en tjugador: " . mysqli_error($conexion);
            }
        }
    }

    // Cerrar la conexión
    mysqli_close($conexion);

    // Redirigir a la página principal o mostrar un mensaje de éxito
    header("Location: ../tablas/equipo.php");
    exit();
} else {
    echo "Error al insertar en tequipo: " . mysqli_error($conexion);
}
?>
