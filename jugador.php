<?php
// Verifica si se proporcionó el parámetro codJugador en la URL
if (isset($_GET['codJugador'])) {
    // Obtiene el valor del parámetro codJugador
    $codJugador = $_GET['codJugador'];

    // Ahora puedes utilizar $codJugador en tu lógica para mostrar la información del jugador
    // También puedes realizar consultas adicionales en la base de datos

    // Resto del código para mostrar la información del jugador
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jugador</title>
    <link rel="stylesheet" href="./styleJugador.css">
</head>
<body>
    <header class="plantilla centradoVert">
        <div id="divVolver">
            <a href="./plantilla.php" id="btnVolver"><p>Volver</p></a>
        </div>
    </header>
    <main>
        <?php
        // Datos de conexión a la base de datos
        $host = "127.0.0.1:3307";
        $usuario = "root";
        $contrasena = "";
        $base_datos = "fantasy";

        // Crear la conexión
        $conexion = mysqli_connect($host, $usuario, $contrasena, $base_datos);

        // Verificar la conexión
        if (!$conexion) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        // Consulta para obtener los datos generales del jugador
        $sqlDatosGenerales = "SELECT
                        jug.nomJugador,
                        jug.apeJugador,
                        jug.numJugador,
                        jug.posJugador,
                        jug.valorJugador,
                        jug.imgJugador,
                        CONCAT(UPPER(cat.nomCategoria), ' ', 
                            CASE
                                WHEN eq.sexEquipo = 'M' THEN 'Masculino'
                                WHEN eq.sexEquipo = 'F' THEN 'Femenino'
                                ELSE eq.sexEquipo
                            END,
                            ' ', eq.nomEquipo) AS nombreEquipo
                    FROM vistajugadores jug
                    JOIN tequipo eq ON jug.codEquipo = eq.codEquipo
                    JOIN tcategoria cat ON eq.codCategoria = cat.codCategoria
                    WHERE jug.codJugador = $codJugador";


        // Consulta para obtener la valoración media del jugador
        $sqlValoracionMedia = "SELECT mediaValJugador
                            FROM vistamediavaljugador
                            WHERE codJugador = $codJugador";

        // Ejecutar la primera consulta
        $resultadoDatosGenerales = mysqli_query($conexion, $sqlDatosGenerales);

        // Verifica si se obtuvo el resultado correctamente
        if ($resultadoDatosGenerales && mysqli_num_rows($resultadoDatosGenerales) > 0) {
            // Obtiene la fila de resultados
            $filaDatosGenerales = mysqli_fetch_assoc($resultadoDatosGenerales);

            // Muestra los datos generales en el HTML
            echo '<div class="plantilla horizontalTarjetaJugador divTarjetaJugador centrarDiv">';
            echo '    <div class="divDatosJugador">';
            echo '        <div>';
            echo '            <p class="nomJugador">' . $filaDatosGenerales['nomJugador'] . ' ' . $filaDatosGenerales['apeJugador'] . '</p>';
            echo '        </div>';
            echo '        <div class="divNumJugador">';
            echo '            <p class="nomJugador">#' . $filaDatosGenerales['numJugador'] . '</p>';
            echo '        </div>';
            // Ejecutar la segunda consulta para obtener la valoración media
            $resultadoValoracionMedia = mysqli_query($conexion, $sqlValoracionMedia);

            // Verifica si se obtuvo el resultado correctamente
            if ($resultadoValoracionMedia && mysqli_num_rows($resultadoValoracionMedia) > 0) {
                // Obtiene la fila de resultados
                $filaValoracionMedia = mysqli_fetch_assoc($resultadoValoracionMedia);

                // Muestra la valoración media en el HTML
                echo '<div class="valoracionMedia">';
                echo '    <p class="datoJugador">Valoración Media: ' . $filaValoracionMedia['mediaValJugador'] . '</p>';
                echo '</div>';
            } else {
                // Manejar el caso en que no hay resultados para la valoración media
                echo '<div class="valoracionMedia">';
                echo '    <p class="datoJugador">Valoración Media: --</p>';
                echo '</div>';
            }
            echo '        <div class="divEquipoJugador">';
            echo '            <p class="datoJugador">' . $filaDatosGenerales['nombreEquipo'] . '</p>';
            echo '        </div>';
            echo '    </div>';
            echo '    <div>';
            echo '        <div class="divImgJugador centrarDiv">';
            echo '            <img class="imgJugador" src="' . $filaDatosGenerales['imgJugador'] . '" alt="">';
            echo '        </div>';
            echo '        <div class="divTipoJugador centrarDiv">';
            echo '            <p class="tipoJugador datoJugador">' . ($filaDatosGenerales['posJugador'] === 'E' ? 'EXTERIOR' : 'INTERIOR') . '</p>';
            echo '        </div>';
            echo '    </div>';
            echo '</div>';
        } else {
            // Manejar el caso en que no hay resultados para los datos generales del jugador
            echo '<div class="mensajeError">';
            echo '    <p>No se encontraron datos para el jugador con el código ' . $codJugador . '</p>';
            echo '</div>';
        }
        ?>

        <div class="divContenedorJornadas centrarDiv divContenedorValores">
            <div>
                <h4 class="titSeccion titValor">VALOR</h4>
            </div>
            <div class="divContenedorValorJugador centrarDiv">
                <div class="divValorJugador centrarDiv">
                    <p class="valorJugador"><?=$filaDatosGenerales['valorJugador']?> €</p>
                </div>
                <div class="plantilla horizontal3 centrarTexto divTextoBroker">
                    <div class="valorNegrita">Subir 15%</div>
                    <div>Mantenerse</div>
                    <div class="valorNegrita">Bajar 15%</div>
                </div>
                <div class="plantilla horizontal3 centrarTexto divValoresBroker">
                    <div class="valorNegrita">19.2</div>
                    <div>8.9</div>
                    <div class="valorNegrita">-1.2</div>
                </div>
            </div>
        </div>
        <?php
            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);
        ?>

        <div class="divContenedorJornadas centrarDiv">
            <h4 class="titSeccion">Jornadas</h4>
            <?php
            // Datos de conexión a la base de datos
            $host = "127.0.0.1:3307";
            $usuario = "root";
            $contrasena = "";
            $base_datos = "fantasy";

            // Crear la conexión
            $conexion = mysqli_connect($host, $usuario, $contrasena, $base_datos);

            // Verificar la conexión
            if (!$conexion) {
                die("Error de conexión: " . mysqli_connect_error());
            }

            // Consulta para obtener los datos de la tabla tjornada
            $sql = "SELECT codJornada, numJornada FROM tjornada";

            $resultado = mysqli_query($conexion, $sql);

            // Verifica si se obtuvo el resultado correctamente
            if ($resultado && mysqli_num_rows($resultado) > 0) {
                echo '<div class="divSelectJornadas centrarDiv">';
                echo '  <select name="selectJornadas" id="selectJornadas">';

                // Agrega la opción vacía
                echo '    <option value=""></option>';

                // Recorre los resultados y crea las opciones del select
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo '    <option value="' . $fila['codJornada'] . '">' . $fila['numJornada'] . '</option>';
                }

                echo '  </select>';
                echo '</div>';
            } else {
                // Manejar el caso en que no hay resultados
                echo 'No hay datos disponibles.';
            }

            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);
            ?>
        </div>
        <div class="divContenedorJornadas centrarDiv">
            <div>
                <h4 class="titSeccion">J3 vs Movistar Estudiantes (67-54)</h4>
            </div>
            <div class="divEstadisticas centrarDiv">
                <div>
                    <p class="titEstadisticas">Estadísticas</p>
                </div>
                <div class="plantilla horizontal5 centrarTexto centradoVert lineaEstadistica valorNegrita">
                    <div>Mins</div>
                    <div>Pts</div>
                    <div>T3a</div>
                    <div>TLf</div>
                    <div>Flts</div>
                </div>
                <div class="plantilla horizontal5 centrarTexto centradoVert lineaEstadistica">
                    <div>26</div>
                    <div>14</div>
                    <div>1</div>
                    <div>1</div>
                    <div>4</div>
                </div>
            </div>
            <div class="plantilla horizontal2 divDatosVal">
                <div class="divTextoVal">
                    <div>
                        <p class="valPartido">Valoración Jornada</p>
                    </div>
                    <div>
                        <p class="valTotal">Valoración TOTAL</p>
                    </div>
                </div>
                <div class="divDatoVal">
                    <div class="valPartido">10</div>
                    <div class="valTotal">12</div>
                </div>
            </div>
        </div>
        
    </main>
</body>
</html>
<?php
} else {
    // Si no se proporcionó el parámetro codJugador, redirige o muestra un mensaje de error
    header("Location: error.php"); // Puedes redirigir a otra página de error
    exit();
}
?>