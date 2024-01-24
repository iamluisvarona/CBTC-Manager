<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jugador</title>
    <link rel="stylesheet" href="../panelAdmin.css">
</head>
<body>
    <header>
        <a class="btnSubmit" href="../index.html">Volver</a>
        <h1>Jugador</h1>
    </header>
    <main>
        <form class="formAdmin" action="../php/subirJugador.php" method="POST">
            <label class="etiquetaFormAdmin" for="nombre">Nombre:</label>
            <input class="inputFormAdmin" type="text" name="nombre"><br>
            <label class="etiquetaFormAdmin" for="apellido">Apellido:</label>
            <input class="inputFormAdmin" type="text" name="apellido"><br>
            <label class="etiquetaFormAdmin" for="dorsal">Dorsal:</label>
            <input class="inputFormAdmin anchoInpDorsal" type="number" name="dorsal"><br>
            <label class="etiquetaFormAdmin" for="valorJugador">Valor Jugador:</label>
            <input class="inputFormAdmin" type="number" name="valorJugador"><br>   
            <label class="etiquetaFormAdmin" for="posicion">Posicion:</label>
            <select class="inputFormAdmin" name="posicion" id="posicion">
                <option value="E">Exterior</option>
                <option value="I">Interior</option>
            </select><br>
            <label class="etiquetaFormAdmin" for="salud">Salud:</label>
            <select class="inputFormAdmin" name="salud" id="salud">
                <option value="S">Sano</option>
                <option value="L">Lesionado</option>
            </select><br>
            <label class="etiquetaFormAdmin" for="equipo">Equipo:</label>
            <select class="inputFormAdmin" name="equipo" id="equipo">
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

                // Consulta para obtener los equipos
                $sql = "SELECT * FROM tequipo";
                $resultado = mysqli_query($conexion, $sql);

                // Verificar si hay resultados
                if (mysqli_num_rows($resultado) > 0) {
                    // Generar las opciones del select dinámicamente
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<option value=\"" . $fila['codEquipo'] . "\">" . $fila['aliasEquipo'] . "</option>";
                    }
                } else {
                    echo "<option value=\"\">No hay equipos disponibles</option>";
                }

                // Cerrar la conexión
                mysqli_close($conexion);
                ?>
            </select><br>
            <button class="btnSubmit" type="submit">Subir Jugador</button>
        </form>
    </main>
</body>
</html>
