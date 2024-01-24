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
    <title>Plantilla</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="plantilla horizontal3 centradoVert">
        <div id="divVolver">
            <a href="./menuPrincipal.php"><p>Volver</p></a>
        </div>
        <div>
            <h2 id="nomEquipo" class="centrarTexto"><?=$_SESSION['username']?></h2>
        </div>
        <div id="divGestionarPlantilla">
            <a href="./gestionarPlantilla.php" ><p id="btnGestionarPlantilla">Gestionar <br>Plantilla</p></a>
        </div>
    </header>
    <main>
        <div id="divTitJugadores">
            <h6 id="titJugadores" class="titApartado centrarTexto">JUGADORES</h6>
        </div>
        <div id="divPlantillaJugadores">
            <div class="titTipoJugador centrarDiv">
                <p>EXTERIORES</p>
            </div>
            <div id="divPlantillaJugadoresExt" class="plantilla horizontal4 centradoVert centrarTexto">
                <?php
                    // Consulta SQL para obtener los datos
                    $sqlExt = "SELECT tjugador.codJugador, tjugador.nomJugador, tjugador.apeJugador, tjugador.numJugador, tjugador.posJugador, tjugador.valorJugador, tjugador.imgJugador,
                            0 as valJugador
                            FROM tplantillajornada
                            JOIN tjugadorjornada ON tplantillajornada.codPlantillaJornada = tjugadorjornada.codPlantillaJornada
                            JOIN tjugador ON tjugadorjornada.codJugador = tjugador.codJugador
                            WHERE tjugador.posJugador = 'E'";

                    $resultado = mysqli_query($conexion, $sqlExt);
                    $posicionRegistro = 1;
                    // Verificar si se obtuvo el resultado correctamente
                    if ($resultado && mysqli_num_rows($resultado) > 0) {
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            // Mostrar los datos en los divs
                            
                            echo '  <div id="divJugadorExt'.$posicionRegistro.'" class="divTarjetaJugador">';
                            echo '    <a href="./jugador.php?codJugador=' . $fila['codJugador'] . '">';
                            echo '      <div class="divTarjetaJugadorFondo centrarDiv divContenedor anchoJugadorExt">';
                            echo '          <div class="divImgJugador">';
                            echo '              <img class="imgJugador" src="' . $fila['imgJugador'] . '" alt="">';
                            echo '          </div>';
                            echo '          <div class="infoJugador">';
                            echo '              <div class="divInfoJugador">';
                            echo '                  <p class="nomJugador">' . $fila['nomJugador'] . ' ' . substr($fila['apeJugador'], 0, 1) . '.</p>';
                            echo '              </div>';
                            echo '              <div class="divValJugador padre ';
                            // Verificar el valor y asignar la clase correspondiente
                            if ($fila['valJugador'] > 0) {
                                echo 'valPositiva';
                            } elseif ($fila['valJugador'] < 0) {
                                echo 'valNegativa';
                            } elseif ($fila['valJugador'] == 0) {
                                echo 'valCero';
                            } else {
                                echo 'valVacia';
                            }
                            echo '  ">';
                            echo '                  <p class="valJugador">' . $fila['valJugador']  . '</p>';
                            echo '              </div>';
                            echo '          </div>';
                            echo '      </div>';
                            echo '      </a>';
                            echo '  </div>';

                            $posicionRegistro ++;
                        }
                        for (; $posicionRegistro <= 4; $posicionRegistro++) {
                            echo '<div id="divJugadorExt'.$posicionRegistro.'" class="divTarjetaJugador">';
                            echo '    <div class="divTarjetaJugadorFondo centrarDiv divContenedor anchoJugadorExt">';
                            echo '        <div class="divImgJugador">';
                            echo '            <img class="imgJugador" src="./img/Jugadores/jugSinFoto.png" alt="">';
                            echo '        </div>';
                            echo '        <div class="infoJugador">';
                            echo '            <div class="divInfoJugador">';
                            echo '                <p class="nomJugador"> -- </p>';
                            echo '            </div>';
                            echo '            <div class="divValJugador padre valVacia">';
                            echo '                <p class="valJugador"> - </p>';
                            echo '            </div>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    } 
                ?>
            </div>
            <div class="titTipoJugador centrarDiv">
                <p>INTERIORES</p>
            </div>
            <div id="divPlantillaJugadoresInt" class="plantilla horizontal3 centradoVert centrarTexto">
            <?php

                    // Consulta SQL para obtener los datos
                    $sqlInt = "SELECT tjugador.codJugador, tjugador.nomJugador, tjugador.apeJugador, tjugador.numJugador, tjugador.posJugador, tjugador.valorJugador, tjugador.imgJugador,
                            -1 as valJugador
                            FROM tplantillajornada
                            JOIN tjugadorjornada ON tplantillajornada.codPlantillaJornada = tjugadorjornada.codPlantillaJornada
                            JOIN tjugador ON tjugadorjornada.codJugador = tjugador.codJugador
                            WHERE tjugador.posJugador = 'I'";

                    $resultado = mysqli_query($conexion, $sqlInt);

                    $posicionRegistro = 1;
                    // Verificar si se obtuvo el resultado correctamente
                    if ($resultado && mysqli_num_rows($resultado) > 0) {
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            // Mostrar los datos en los divs

                            echo '  <div id="divJugadorInt'.$posicionRegistro.'" class="divTarjetaJugador">';
                            echo '    <a href="./jugador.php?codJugador=' . $fila['codJugador'] . '">';
                            echo '      <div class="divTarjetaJugadorFondo centrarDiv divContenedor anchoJugadorInt">';
                            echo '          <div class="divImgJugador">';
                            echo '              <img class="imgJugador" src="' . $fila['imgJugador'] . '" alt="">';
                            echo '          </div>';
                            echo '          <div class="infoJugador">';
                            echo '              <div class="divInfoJugador">';
                            echo '                  <p class="nomJugador">' . $fila['nomJugador'] . ' ' . substr($fila['apeJugador'], 0, 1) . '.</p>';
                            echo '              </div>';
                            echo '              <div class="divValJugador padre ';
                            // Verificar el valor y asignar la clase correspondiente
                            if ($fila['valJugador'] > 0) {
                                echo 'valPositiva';
                            } elseif ($fila['valJugador'] < 0) {
                                echo 'valNegativa';
                            } elseif ($fila['valJugador'] == 0) {
                                echo 'valCero';
                            } else {
                                echo 'valVacia';
                            }
                            echo '  ">';
                            echo '                  <p class="valJugador">' . $fila['valJugador']  . '</p>';
                            echo '              </div>';
                            echo '          </div>';
                            echo '      </div>';
                            echo '      </a>';
                            echo '  </div>';
                            $posicionRegistro ++;
                        }
                        for (; $posicionRegistro <= 3; $posicionRegistro++) {
                            echo '<div id="divJugadorInt'.$posicionRegistro.'" class="divTarjetaJugador">';
                            echo '    <div class="divTarjetaJugadorFondo centrarDiv divContenedor anchoJugadorInt">';
                            echo '        <div class="divImgJugador">';
                            echo '            <img class="imgJugador" src="./img/Jugadores/jugSinFoto.png" alt="">';
                            echo '        </div>';
                            echo '        <div class="infoJugador">';
                            echo '            <div class="divInfoJugador">';
                            echo '                <p class="nomJugador"> -- </p>';
                            echo '            </div>';
                            echo '            <div class="divValJugador padre valVacia">';
                            echo '                <p class="valJugador"> - </p>';
                            echo '            </div>';
                            echo '        </div>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    }
                ?>
            </div>
        </div>
        <div id="divTitEntrenadores">
            <h6 id="titEntrenadores" class="titApartado centrarTexto">ENTRENADORES</h6>
        </div>
        <div id="divPlantillaEntrenadores" class="plantilla horizontal2 centradoVert">
            <div id="divEntrenadorPrincipal">
                <div class="titTipoEntrenador centrarDiv">
                    <p>PRINCIPAL</p>
                </div>
                <?php
                $sqlEntP = "SELECT tentrenador.codEntrenador, tentrenador.nomEntrenador, tentrenador.apeEntrenador, tentrenador.valorEntrenador, tentrenador.imgEntrenador, 5 as valEntrenador
                                    FROM tplantillajornada
                                    JOIN tentrenadorjornada ON tplantillajornada.codPlantillaJornada = tentrenadorjornada.codPlantillaJornada
                                    JOIN tentrenador ON tentrenadorjornada.codEntrenador = tentrenador.codEntrenador
                                    WHERE tentrenador.tipoEntrenador = 'P'";

                $resultado = mysqli_query($conexion, $sqlEntP);
                
                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        // Mostrar los datos en los divs
                        echo '<a href="./entrenador.php?codEntrenador=' . $fila['codEntrenador'] . '">';
                        echo <<<HTML
                                <div class="divTarjetaJugadorFondo centrarDiv divContenedor anchoEnt">
                                    <div class="divImgJugador">
                                        <img class="imgJugador" src="{$fila['imgEntrenador']}" alt="">
                                    </div>
                                    <div class="infoJugador">
                                        <div class="divInfoJugador">
                                            <p class="nomJugador">{$fila['nomEntrenador']} {$fila['apeEntrenador'][0]}.</p>
                                        </div>
                                        <div class="divValJugador padre 
                            HTML;
                            
                            // Verificar el valor y asignar la clase correspondiente
                            if ($fila['valEntrenador'] > 0) {
                                echo 'valPositiva';
                            } elseif ($fila['valEntrenador'] < 0) {
                                echo 'valNegativa';
                            } elseif ($fila['valEntrenador'] == 0) {
                                echo 'valCero';
                            } else {
                                echo 'valVacia';
                            }

                        echo <<<HTML
                                    ">
                                        <p class="valJugador">{$fila['valEntrenador']}</p>
                                    </div>
                                </div>
                            </div>
                        HTML;

                        echo '</a>';
                    }
                } else {
                    echo <<<HTML
                            <div class="divTarjetaJugadorFondo centrarDiv divContenedor anchoEnt">
                                <div class="divImgJugador">
                                    <img class="imgJugador" src="./img/Jugadores/jugSinFoto.png" alt="">
                                </div>
                                <div class="infoJugador">
                                    <div class="divInfoJugador">
                                        <p class="nomJugador">--</p>
                                    </div>
                                    <div class="divValJugador padre valVacia">
                                        <p class="valJugador">-</p>
                                    </div>
                                </div>
                            </div>
                        HTML;
                }
                ?>
                
            </div>
            <div id="divEntrenadorAyudante">
                <div class="titTipoEntrenador centrarDiv">
                    <p>AYUDANTE</p>
                </div>

                <?php
                $sqlEntA = "SELECT tentrenador.codEntrenador, tentrenador.nomEntrenador, tentrenador.apeEntrenador, tentrenador.valorEntrenador, tentrenador.imgEntrenador,
                                    -1 as valEntrenador
                                    FROM tplantillajornada
                                    JOIN tentrenadorjornada ON tplantillajornada.codPlantillaJornada = tentrenadorjornada.codPlantillaJornada
                                    JOIN tentrenador ON tentrenadorjornada.codEntrenador = tentrenador.codEntrenador
                                    WHERE tentrenador.tipoEntrenador = 'A'";

                $resultado = mysqli_query($conexion, $sqlEntA);
                
                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        // Mostrar los datos en los divs
                        echo '<a href="./entrenador.php?codEntrenador=' . $fila['codEntrenador'] . '">';
                        echo <<<HTML
                            <div class="divTarjetaJugadorFondo centrarDiv divContenedor anchoEnt">
                                <div class="divImgJugador">
                                    <img class="imgJugador" src="{$fila['imgEntrenador']}" alt="">
                                </div>
                                <div class="infoJugador">
                                    <div class="divInfoJugador">
                                        <p class="nomJugador">{$fila['nomEntrenador']} {$fila['apeEntrenador'][0]}.</p>
                                    </div>
                                    <div class="divValJugador padre 
                        HTML;

                        // Verificar el valor y asignar la clase correspondiente
                        if ($fila['valEntrenador'] > 0) {
                            echo 'valPositiva';
                        } elseif ($fila['valEntrenador'] < 0) {
                            echo 'valNegativa';
                        } elseif ($fila['valEntrenador'] == 0) {
                            echo 'valCero';
                        } else {
                            echo 'valVacia';
                        }

                        echo <<<HTML
                                ">
                                    <p class="valJugador">{$fila['valEntrenador']}</p>
                                </div>
                            </div>
                        </div>
                        HTML;

                        echo '</a>';
                    }
                } else {
                    echo <<<HTML
                            <div class="divTarjetaJugadorFondo centrarDiv divContenedor anchoEnt">
                                <div class="divImgJugador">
                                    <img class="imgJugador" src="./img/Jugadores/jugSinFoto.png" alt="">
                                </div>
                                <div class="infoJugador">
                                    <div class="divInfoJugador">
                                        <p class="nomJugador">--</p>
                                    </div>
                                    <div class="divValJugador padre valVacia">
                                        <p class="valJugador">-</p>
                                    </div>
                                </div>
                            </div>
                        HTML;
                }
                ?>
            </div>
        </div>
    </main>
    <footer class="centrarDiv">
        <div class="plantilla horizontal2 centradoVert divDatosPlantilla">
            <div class="divDatoIzq"><p>Puntos</p></div>
            <div class="divDatoDcha"><p>1</p></div>
        </div>
        <div class="plantilla horizontal2 centradoVert divDatosPlantilla" id="">
            <div class="divDatoIzq"><p>Dinero en caja</p></div>
            <div class="divDatoDcha"><p><?=$dineroBancoUsuario?> €</p></div>
        </div>
    </footer>
</body>
</html>
<?php
    // Cerrar la conexión
    mysqli_close($conexion);  
?>