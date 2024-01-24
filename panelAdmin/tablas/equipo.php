<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipo</title>
    <link rel="stylesheet" href="../panelAdmin.css">
    <script>
        function marcarCheckbox(i) {
            var nombreInput = document.getElementsByName("nombre[" + i + "]")[0];
            var checkbox = document.getElementsByName("subirJugador[" + i + "]")[0];

            // Marcar el checkbox si hay texto en el campo de nombre
            checkbox.checked = nombreInput.value.trim() !== "";
        }
    </script>
</head>
<body>
    <header>
        <a class="btnSubmit" href="../index.html">Volver</a>
        <h1>Equipo</h1>
    </header>
    <main>
        <form class="formAdmin" action="../php/subirEquipo.php" method="POST">
            <label class="etiquetaFormAdmin" for="categoria">Categoria:</label>
            <select class="inputFormAdmin" name="categoria" id="categoria">
                <?php
                // Conexión a la base de datos
                $conexion = mysqli_connect("127.0.0.1:3307", "root", "", "fantasy");

                // Verificación de la conexión
                if (!$conexion) {
                    die("Error de conexión: " . mysqli_connect_error());
                }

                // Consulta para obtener las categorías
                $sql = "SELECT codCategoria, nomCategoria FROM tcategoria";
                $resultado = mysqli_query($conexion, $sql);

                // Verificar si hay resultados
                if (mysqli_num_rows($resultado) > 0) {
                    // Generar las opciones del select dinámicamente
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<option value=\"" . $fila['codCategoria'] . "\">" . $fila['nomCategoria'] . "</option>";
                    }
                } else {
                    echo "<option value=\"\">No hay categorías disponibles</option>";
                }

                // Cerrar la conexión
                mysqli_close($conexion);
                ?>
            </select><br>
            <label class="etiquetaFormAdmin" for="sexoEquipo">Sexo Equipo:</label>
            <select class="inputFormAdmin" name="sexoEquipo" id="sexoEquipo">
                <option value="F">Femenino</option>
                <option value="M">Masculino</option>
            </select><br>
            <label class="etiquetaFormAdmin" for="">Nombre Equipo:</label>
            <input class="inputFormAdmin" type="text" name="nombreEquipo"><br>
            <label class="etiquetaFormAdmin" for="">Alias Equipo:</label>
            <input class="inputFormAdmin" type="text" name="aliasEquipo" id="aliasEquipo"><br>
            <hr>
            <br>
            <label class="etiquetaFormAdmin" for="">Plantilla Equipo:</label>
            <table>
                <tr>
                    <th>Subir</th>
                    <th>Dorsal</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Posición</th>
                    <th>Valor</th>
                    <th>Salud</th>
                </tr>
                <?php
                // Generar 15 líneas de jugadores
                for ($i = 1; $i <= 15; $i++) {
                    echo "<tr>";
                    echo "<td><input type=\"checkbox\" name=\"subirJugador[$i]\" onchange=\"marcarCheckbox($i)\" ></td>";
                    echo "<td><input class=\"inputFormAdmin inputTabla anchoInpDorsal\" type=\"number\" name=\"dorsal[$i]\"></td>";
                    echo "<td><input class=\"inputFormAdmin inputTabla anchoInpNombre\" type=\"text\" name=\"nombre[$i]\" oninput=\"marcarCheckbox($i)\"></td>";
                    echo "<td><input class=\"inputFormAdmin inputTabla anchoInpNombre\" type=\"text\" name=\"apellido[$i]\"></td>";
                    echo "<td><select class=\"inputFormAdmin inputTabla anchoInpNombre\" name=\"posicion[$i]\">
                            <option value=\"E\">Exterior</option>
                            <option value=\"I\">Interior</option>
                          </select></td>";
                    echo "<td><input class=\"inputFormAdmin inputTabla anchoInpValor\" type=\"number\" name=\"valor[$i]\"></td>";
                    echo "<td><select class=\"inputFormAdmin inputTabla anchoInpValor\" name=\"salud[$i]\">
                            <option value=\"S\">Sano</option>
                            <option value=\"L\">Lesionado</option>
                          </select></td>";
                    echo "</tr>";
                }
                ?>
            </table>
            <button class="btnSubmit" type="submit">Subir Equipo</button>
        </form>
    </main>
</body>
</html>
