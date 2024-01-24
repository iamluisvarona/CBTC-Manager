<?php
    session_start();

    // Verificar si el usuario está autenticado
    if (!isset($_SESSION['username'])) {
        // Usuario no autenticado, redirigir a login.php
        header("Location: ./InicioSesion/login.php");
        exit();
    }

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
    $codUsuario = $_SESSION['codUsuario'];
    $sqlDineroBanco = "SELECT dineroBanco FROM tusuario WHERE codUsuario = '$codUsuario'";
    $resultadoDineroBanco = mysqli_query($conexion, $sqlDineroBanco);
    $fila = mysqli_fetch_assoc($resultadoDineroBanco);
    $dineroBancoUsuario = $fila['dineroBanco'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Plantilla</title>
    <link rel="stylesheet" href="styleGestionarPlantilla.css">
</head>
<body>
    <header class="plantilla horizontalHeader centradoVert">
        <div id="divVolver">
            <a href="./plantilla.php"><p id="btnVolver">Volver</p></a>
        </div>
        <div>
            <h2 id="titGestionarPlantilla" class="centrarTexto">Gestionar Plantilla</h2>
        </div>
    </header>
    <main>
        <div class="divTituloGestionar letraBlanca">
            <h3>JUGADORES</h3>
        </div>
        <div>
            <div class="divSubtituloGestionar letraBlanca">
                <h4>Exteriores</h4>
            </div>
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

            // Consulta para obtener los datos de tjugadorjornada donde posJugador sea 'E'
            $sqlJugadoresExteriores = "SELECT jj.codJugador, jj.codPlantillaJornada, jj.codJugadorJornada, j.nomJugador, j.valorJugador, j.apeJugador, j.imgJugador
                                        FROM tjugadorjornada jj
                                        JOIN tjugador j ON jj.codJugador = j.codJugador
                                        WHERE j.posJugador = 'E'";

            $resultadoJugadoresExteriores = mysqli_query($conexion, $sqlJugadoresExteriores);

            $posicionRegistro = 1;
            // Verifica si se obtuvo el resultado correctamente
            if ($resultadoJugadoresExteriores && mysqli_num_rows($resultadoJugadoresExteriores) > 0) {
                // Muestra los resultados de tjugadorjornada con posJugador='E'
                while ($filaJugadorExterior = mysqli_fetch_assoc($resultadoJugadoresExteriores)) {
                    echo <<<HTML
                    <div class="divTarjetaFichaje centrarDiv plantilla horizontalTarjetaMercado">
                        <div class="plantilla centradoVert divImgTarjetaMercado">
                            <img class="imgTarjetaMercado" src="{$filaJugadorExterior['imgJugador']}" alt="">
                        </div>
                        <div class="plantilla vertical3 margenIzq">
                            <div class="plantilla centradoAbajo">
                                <h5 class="nomTarjetaMercado">{$filaJugadorExterior['nomJugador']} {$filaJugadorExterior['apeJugador']}</h5>
                            </div>
                            <div class="plantilla centradoVert">
                                <p class="infoTarjetaMercado">Código Jugador: {$filaJugadorExterior['codJugador']}</p>

                            </div>
                            <div class="plantilla centradoArriba">
                                <p class="infoTarjetaMercado">Valoración Media: {$filaJugadorExterior['valorJugador']}</p>
                            </div>
                        </div>
                        <div class="plantilla vertical2 centradoVert">
                            <div>
                                <p class="valorTarjetaMercado centrarTexto">{$filaJugadorExterior['valorJugador']} €</p>
                            </div>
                            <div class="divBtnVender centrarDiv">
                                <button class="centrarDiv btnVender">Vender</button>
                            </div>
                        </div>
                    </div>
                    HTML;
                    $posicionRegistro ++;
                }
                for (; $posicionRegistro <=4; $posicionRegistro++) {
                    echo <<<HTML
                    <div class="divTarjetaFichaje centrarDiv">
                        <div class="divBtnFichar centrarDiv plantilla centradoVert">
                            <button class="btnFichar">Fichar</button>
                        </div>
                    </div>
                    HTML;
                }
            }

            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);
            ?>

        </div>
        <div>
            <div class="divSubtituloGestionar letraBlanca">
                <h4>Interiores</h4>
            </div>
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

            // Consulta para obtener los datos de tjugadorjornada donde posJugador sea 'E'
            $sqlJugadoresExteriores = "SELECT jj.codJugador, jj.codPlantillaJornada, jj.codJugadorJornada, j.nomJugador, j.valorJugador, j.apeJugador, j.imgJugador
                                        FROM tjugadorjornada jj
                                        JOIN tjugador j ON jj.codJugador = j.codJugador
                                        WHERE j.posJugador = 'I'";

            $resultadoJugadoresExteriores = mysqli_query($conexion, $sqlJugadoresExteriores);

            $posicionRegistro = 1;
            // Verifica si se obtuvo el resultado correctamente
            if ($resultadoJugadoresExteriores && mysqli_num_rows($resultadoJugadoresExteriores) > 0) {
                // Muestra los resultados de tjugadorjornada con posJugador='E'
                while ($filaJugadorExterior = mysqli_fetch_assoc($resultadoJugadoresExteriores)) {
                    echo <<<HTML
                    <div class="divTarjetaFichaje centrarDiv plantilla horizontalTarjetaMercado">
                        <div class="plantilla centradoVert divImgTarjetaMercado">
                            <img class="imgTarjetaMercado" src="{$filaJugadorExterior['imgJugador']}" alt="">
                        </div>
                        <div class="plantilla vertical3 margenIzq">
                            <div class="plantilla centradoAbajo">
                                <h5 class="nomTarjetaMercado">{$filaJugadorExterior['nomJugador']} {$filaJugadorExterior['apeJugador']}</h5>
                            </div>
                            <div class="plantilla centradoVert">
                                <p class="infoTarjetaMercado">Código Jugador: {$filaJugadorExterior['codJugador']}</p>

                            </div>
                            <div class="plantilla centradoArriba">
                                <p class="infoTarjetaMercado">Valoración Media: {$filaJugadorExterior['valorJugador']}</p>
                            </div>
                        </div>
                        <div class="plantilla vertical2 centradoVert">
                            <div>
                                <p class="valorTarjetaMercado centrarTexto">{$filaJugadorExterior['valorJugador']} €</p>
                            </div>
                            <div class="divBtnVender centrarDiv">
                                <button class="centrarDiv btnVender">Vender</button>
                            </div>
                        </div>
                    </div>
                    HTML;
                    $posicionRegistro ++;
                }
                for (; $posicionRegistro <=3; $posicionRegistro++) {
                    echo <<<HTML
                    <div class="divTarjetaFichaje centrarDiv">
                        <div class="divBtnFichar centrarDiv plantilla centradoVert">
                            <button class="btnFichar">Fichar</button>
                        </div>
                    </div>
                    HTML;
                }
            }

            // Cerrar la conexión a la base de datos
            mysqli_close($conexion);
            ?>
        </div>
        <div class="divTituloGestionar letraBlanca">
            <h3>ENTRENADORES</h3>
        </div>
        <div>
            <div class="divSubtituloGestionar letraBlanca">
                <h4>Principal</h4>
            </div>
            <div class="divTarjetaFichaje centrarDiv plantilla horizontalTarjetaMercado">
                <div class="plantilla centradoVert divImgTarjetaMercado">
                    <img class="imgTarjetaMercado" src="./img/alba.png" alt="">
                </div>
                <div class="plantilla vertical3 margenIzq">
                    <div class="plantilla centradoAbajo">
                        <h5 class="nomTarjetaMercado">Alba Sierra</h5>
                    </div>
                    <div class="plantilla centradoVert">
                        <p class="infoTarjetaMercado">Valoracion Media: 3</p>
                    </div>
                    <div class="plantilla centradoArriba">
                        <p class="infoTarjetaMercado">Última Jornada: 6</p>
                    </div>
                </div>
                <div class="plantilla vertical2 centradoVert">
                    <div>
                        <p class="valorTarjetaMercado centrarTexto">278500 €</p>
                    </div>
                    <div class="divBtnVender centrarDiv">
                        <button class="centrarDiv btnVender">Vender</button>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="divSubtituloGestionar letraBlanca">
                <h4>Ayudante</h4>
            </div>
            <div class="divTarjetaFichaje centrarDiv plantilla horizontalTarjetaMercado">
                <div class="plantilla centradoVert divImgTarjetaMercado">
                    <img class="imgTarjetaMercado" src="./img/richi.png" alt="">
                </div>
                <div class="plantilla vertical3 margenIzq">
                    <div class="plantilla centradoAbajo">
                        <h5 class="nomTarjetaMercado">Ricardo Rey</h5>
                    </div>
                    <div class="plantilla centradoVert">
                        <p class="infoTarjetaMercado">Valoracion Media: 2</p>
                    </div>
                    <div class="plantilla centradoArriba">
                        <p class="infoTarjetaMercado">Última Jornada: -3</p>
                    </div>
                </div>
                <div class="plantilla vertical2 centradoVert">
                    <div>
                        <p class="valorTarjetaMercado centrarTexto">190320 €</p>
                    </div>
                    <div class="divBtnVender centrarDiv">
                        <button class="centrarDiv btnVender">Vender</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="centrarDiv">
        <div class="plantilla horizontal2 centradoVert divDatosPlantilla" id="">
            <div class="divDatoIzq"><p>Dinero en caja</p></div>
            <div class="divDatoDcha"><p><?=$dineroBancoUsuario?> €</p></div>
        </div>
    </footer>
</body>
</html>