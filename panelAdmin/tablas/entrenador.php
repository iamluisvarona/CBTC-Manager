<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrenador</title>
    <link rel="stylesheet" href="../panelAdmin.css">
</head>
<body>
    <header>
        <a class="btnSubmit" href="../index.html">Volver</a>
        <h1>Entrenador</h1>
    </header>
    <main>
        <form class="formAdmin" action="../php/subirEntrenador.php" method="POST">
            <label class="etiquetaFormAdmin" for="nombre">Nombre:</label>
            <input class="inputFormAdmin" type="text" name="nombre"><br>
            <label class="etiquetaFormAdmin" for="apellido">Apellido:</label>
            <input class="inputFormAdmin" type="text" name="apellido"><br>
            <label class="etiquetaFormAdmin" for="valorEntrenador">Valor Entrenador:</label>
            <input class="inputFormAdmin" type="number" name="valorEntrenador"><br>
            <label class="etiquetaFormAdmin" for="tipoEntrenador">Tipo Entrenador:</label>
            <select class="inputFormAdmin" name="tipoEntrenador" id="tipoEntrenador">
                <option value="P">Principal</option>
                <option value="A">Ayudante</option>
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
            <button class="btnSubmit" type="submit">Subir Entrenador</button>
        </form>
    </main>
</body>
</html>

