<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partido</title>
    <link rel="stylesheet" href="../panelAdmin.css">
    <script>
        // Función para cargar jugadores según el equipo CBTC seleccionado
        function cargarJugadores() {
            var equipoCBTC = document.getElementById('equipoCBTC').value;

            

            // Realizar una solicitud AJAX para obtener los jugadores
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Actualizar la tabla con los datos recibidos
                    document.getElementById('tablaJugadores').innerHTML = `<tr>
                        <th>Nº</th>
                        <th>Nombre</th>
                        <th>Mins</th>
                        <th>Pts</th>
                        <th>TLf</th>
                        <th>T3a</th>
                        <th>Flts</th>
                    </tr>` + xhr.responseText;
                }
            };

            // Enviar la solicitud
            xhr.open('GET', 'obtenerJugadores.php?equipoCBTC=' + equipoCBTC, true);
            xhr.send();
        }
    
</script>

</head>
<body>
    <header>
        <a class="btnSubmit" href="../index.html">Volver</a>
        <h1>Partido</h1>
    </header>
    <main>
        <form class="formAdmin" action="../php/subirPartido.php" method="POST">
            <label class="etiquetaFormAdmin" for="jornada">Jornada:</label>
            <select class="inputFormAdmin" name="jornada" id="jornada">
                <?php
                // Conexión a la base de datos
                $host = "127.0.0.1:3307";
                $usuario = "root";
                $clave = "";
                $base_de_datos = "fantasy";
                $conexion = mysqli_connect($host, $usuario, $clave, $base_de_datos);

                // Verificación de la conexión
                if (!$conexion) {
                    die("Error de conexión: " . mysqli_connect_error());
                }

                // Consulta para obtener las jornadas
                $sqlJornadas = "SELECT * FROM tjornada";
                $resultadoJornadas = mysqli_query($conexion, $sqlJornadas);

                // Verificar si hay resultados
                if (mysqli_num_rows($resultadoJornadas) > 0) {
                    // Generar las opciones del select dinámicamente
                    while ($filaJornada = mysqli_fetch_assoc($resultadoJornadas)) {
                        $numJornada = $filaJornada['numJornada'];
                        $fecInicio = $filaJornada['fecInicio'];
                        $fecFinal = $filaJornada['fecFinal'];

                        // Formatear la fecha
                        $fecInicioFormateada = date("d/m/Y", strtotime($fecInicio));
                        $fecFinalFormateada = date("d/m/Y", strtotime($fecFinal));

                        // Mostrar la opción en el formato deseado
                        echo "<option value=\"" . $filaJornada['codJornada'] . "\">Jornada $numJornada, $fecInicioFormateada - $fecFinalFormateada</option>";
                    }
                } else {
                    echo "<option value=\"\">No hay jornadas disponibles</option>";
                }

                // Cerrar la conexión
                mysqli_close($conexion);
                ?>
            </select><br>
            <label class="etiquetaFormAdmin" for="">Fecha:</label>
            <input class="inputFormAdmin" type="date" name="fechaPartido"><br>
            <label class="etiquetaFormAdmin" for="" >Hora:</label>
            <input class="inputFormAdmin" type="time" name="horaPartido"><br>
            <label class="etiquetaFormAdmin" for="equipoCBTC">Equipo CBTC:</label>
            <select class="inputFormAdmin" name="equipoCBTC" id="equipoCBTC" onchange="cargarJugadores()">
                <?php
                    // Conexión a la base de datos
                    $conexion = mysqli_connect($host, $usuario, $clave, $base_de_datos);

                    // Consulta para obtener los equipos CBTC
                    $sqlEquiposCBTC = "SELECT * FROM tequipo";
                    $resultadoEquiposCBTC = mysqli_query($conexion, $sqlEquiposCBTC);

                    // Verificar si hay resultados
                    if (mysqli_num_rows($resultadoEquiposCBTC) > 0) {
                        // Generar las opciones del select dinámicamente
                        while ($filaEquipoCBTC = mysqli_fetch_assoc($resultadoEquiposCBTC)) {
                            echo "<option value=\"" . $filaEquipoCBTC['codEquipo'] . "\">" . $filaEquipoCBTC['aliasEquipo'] . "</option>";
                        }
                    } else {
                        echo "<option value=\"\">No hay equipos CBTC disponibles</option>";
                    }

                    // Cerrar la conexión
                    mysqli_close($conexion);
                ?>
            </select>
            <input class="inputFormAdmin anchoInpDorsal" type="number" name="dorsalCBTC" id="dorsalCBTC"><br>

            <label class="etiquetaFormAdmin" for="equipoRival">Equipo Rival:</label>
            <select class="inputFormAdmin" name="equipoRival" id="equipoRival">
                <?php
                    // Conexión a la base de datos
                    $conexion = mysqli_connect($host, $usuario, $clave, $base_de_datos);

                    // Consulta para obtener los equipos Rival
                    $sqlEquiposRival = "SELECT * FROM tequiporival";
                    $resultadoEquiposRival = mysqli_query($conexion, $sqlEquiposRival);

                    // Verificar si hay resultados
                    if (mysqli_num_rows($resultadoEquiposRival) > 0) {
                        // Generar las opciones del select dinámicamente
                        while ($filaEquipoRival = mysqli_fetch_assoc($resultadoEquiposRival)) {
                            echo "<option value=\"" . $filaEquipoRival['codEquipoRival'] . "\">" . $filaEquipoRival['aliasEquipoRival'] . "</option>";
                        }
                    } else {
                        echo "<option value=\"\">No hay equipos Rival disponibles</option>";
                    }

                    // Cerrar la conexión
                    mysqli_close($conexion);
                ?>
            </select>
            <input class="inputFormAdmin anchoInpDorsal" type="number" name="dorsalRival" id="dorsalRival"><br>

            <hr>
            <br>
            <label class="etiquetaFormAdmin" for="">Estadísticas</label>
            <table id="tablaJugadores">
                <!-- Contenido de la tabla se actualizará dinámicamente -->
            </table>
            <button class="btnSubmit" type="submit">Subir Partido</button>
        </form>
    </main>
</body>
</html>
