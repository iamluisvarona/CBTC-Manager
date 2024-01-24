<?php
// obtenerJugadores.php

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

// Obtener el equipo CBTC seleccionado desde la solicitud GET
$equipoCBTC = $_GET['equipoCBTC'];

// Realizar la consulta a la base de datos para obtener jugadores del equipo CBTC
$sql = "SELECT * FROM tjugador WHERE codEquipo = $equipoCBTC ORDER BY numJugador";
$resultado = mysqli_query($conexion, $sql);


// Generar la tabla con los jugadores
if ($resultado && mysqli_num_rows($resultado) > 0) {
    $jc = 1;
    while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<input type='hidden' value='{$fila['codJugador']}' name='codJugador$jc'>";
        echo "<td style='color: white'>{$fila['numJugador']}</td>";
        echo "<td style='color: white'>{$fila['nomJugador']} {$fila['apeJugador']}</td>";
        echo "<td><input class=\"inputFormAdmin inputTabla anchoInpDorsal\" type=\"number\" name='minutos$jc'></td>";
        echo "<td><input class=\"inputFormAdmin inputTabla anchoInpDorsal\" type=\"number\" name='puntos$jc'></td>";
        echo "<td><input class=\"inputFormAdmin inputTabla anchoInpDorsal\" type=\"number\" name='tlFallados$jc'></td>";
        echo "<td><input class=\"inputFormAdmin inputTabla anchoInpDorsal\" type=\"number\" name='t3Anotados$jc'></td>";
        echo "<td><input class=\"inputFormAdmin inputTabla anchoInpDorsal\" type=\"number\" name='faltas$jc'></td>";
        echo "</tr>";
        $jc = $jc + 1;
    }
    echo "<input type='hidden' value='$jc' name='numJugadoresCargados'>";
} else {
    echo "<tr><td colspan='7'>No hay jugadores disponibles</td></tr>";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
