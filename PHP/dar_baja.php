<?php
    include 'pre_cabecera.php';
    $_SESSION[ 'display_page2' ] = FALSE;
	$_SESSION[ 'display_page1' ] = FALSE;
	$title = "Datos del usuario";
    require_once("../Plantilla/cabecera.inc");
    require_once("../Plantilla/inicio.inc");
?>
		<nav>
			<?php
                if (isset($_COOKIE['usuario_recordado'])) {
                    require_once("../Plantilla/nav_si.inc");
                } elseif (isset($_SESSION['usuario_sesion'])) {
                    require_once("../Plantilla/nav_si.inc");
                } else {
                    require_once("../Plantilla/nav_no.inc");
                }
            ?>
		</nav>

		<section class="menu_user_logeado">
			<h2>Tu Galería:</h2>
			
				<?php
					if (isset($_COOKIE['usuario_recordado'])==true) {
				        $valores = explode(" ", $_COOKIE['usuario_recordado']);
				    } elseif (isset($_SESSION['usuario_sesion'])==true) {
				        $valores = explode(" ", $_SESSION['usuario_sesion']);
				    }
					
					echo "<ul>";

					require_once("../Plantilla/bbdd.inc");

					if (!$enlace) {
					    echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
					    echo '</p>';
					    exit;
					}

					mysqli_set_charset($enlace, "utf8");
					$sentencia = "SELECT * FROM usuarios, albumes WHERE NomUsuario='$valores[0]' AND IdUsuario=Usuario";

					if(!($resultado = @mysqli_query($enlace, $sentencia))) {
					    echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
					    echo '</p>';
					    exit;
					}

					$fTotal = 0;
					
					if (mysqli_num_rows($resultado)>1) {
						echo "<h3>Álbumes:</h3>";
					}
					if (mysqli_num_rows($resultado)==1) {
						echo "<h3>Álbum:</h3>";
					}

					while ($fila = mysqli_fetch_assoc($resultado)) {
						$tit = $fila['Titulo'];
						$peticion = "SELECT IdFoto FROM fotos as fo, albumes as al WHERE al.Titulo='$tit' AND IdAlbum=Album";

						if(!($res = @mysqli_query($enlace, $peticion))) {
						    echo "<p>Error al ejecutar la peticion <b>$peticion</b>: " . mysqli_error($enlace);
						    echo '</p>';
						    exit;
						}
						$lineas = mysqli_num_rows($res);
						$fTotal += $lineas;
						echo "<li>".$fila['Titulo'].": ".$lineas." foto/s</li>";
					}

					echo "<br>";
					echo "<h3>Tienes un total de: ".$fTotal." foto/s</h3>";

					mysqli_free_result($resultado);
					mysqli_close($enlace);

					echo "</ul>";

					echo "</section>";

					echo "<section class='formularios'>";
					echo "<form name='registro' action='res_dar_baja.php' id='form' method='post'>";
						echo "<label for='contra'> Introduce tu contraseña actual para confirmar la baja: </label>";
						echo "<input type='password' id='contra' name='contra' required>";
						echo "<input type='submit' class='puntero_mano' value='Enviar' name='Enviar'>";
					echo "</form>";
				?>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>