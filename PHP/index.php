<?php
    include 'pre_cabecera.php';
    $_SESSION[ 'display_page2' ] = FALSE;
	$_SESSION[ 'display_page1' ] = FALSE;
	$title = "Inicio";
    //include 'selector_css.php';
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

		<h2 class="titulo_filtros_busq">Foto recomendada:</h2>
		<section class="filtros_busq">
				<?php
					if(($fichero = @file("G:\\xampp\\htdocs\\DAW\\Imagenes\\seleccion.txt")) == false) { 
	   					echo "No se ha podido abrir el fichero";
	 				} else {
	 					$nRand = mt_rand(0, count($fichero)-1);
	 					$words = explode("/", $fichero[$nRand]);

	 					echo "<p><b>Recomendado por: ".$words[0]."</b></p>";
	 					echo "<p><b>Comentario: ".$words[1]."</b></p>";

	 					echo "<div class='linea_negra'>";
	 					require_once("../Plantilla/bbdd.inc");

	 					if (!$enlace) {
					    	echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
	   						echo '</p>';
	   						exit;
					    }

	            		mysqli_set_charset($enlace, "utf8");
					    $sentencia = "SELECT IdFoto, Titulo, Descripcion, Fecha, NomPais, Fichero, Alternativo from fotos, paises WHERE IdFoto=$words[2] AND fotos.Pais=paises.IdPais";

					    if(!($resultado = @mysqli_query($enlace, $sentencia))) {
							echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
						    echo '</p>';
						    exit;
						}

					    $fila = mysqli_fetch_assoc($resultado);

					    echo "<article>";
			            echo "<p>".$fila['Titulo']."</p>";
			            echo "<figure>";
			            echo "<a title='".$fila['Descripcion']."' href='detalle.php?id=".$fila['IdFoto']."'><img src='../Imagenes/".$fila['Fichero']."' alt='".$fila['Alternativo']."' width=100% height=100%></a>";
			            echo "</figure>";
			            echo "<footer>";
			            echo "<p>".$fila['Fecha']." | ".$fila['NomPais']."</p>";
			            echo "</footer>";
			            echo "</article>";
	 				}
				?>
			</div>
		</section>
		<hr>
		<h2 class="titulo_filtros_busq">Últimas fotos:</h2>
		<section>
            <div>
            	<?php
            		require_once("../Plantilla/bbdd.inc");

				    if (!$enlace) {
				    	echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
   						echo '</p>';
   						exit;
				    }

            		mysqli_set_charset($enlace, "utf8");
				    $sentencia = "SELECT IdFoto, Titulo, Descripcion, Fecha, NomPais, Fichero, Alternativo from fotos, paises WHERE fotos.Pais=paises.IdPais ORDER BY FRegistro DESC LIMIT 5";

				    if(!($resultado = @mysqli_query($enlace, $sentencia))) {
					   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
					   echo '</p>';
					   exit;
					}

					while ($fila = mysqli_fetch_assoc($resultado)) {
		                echo "<article>";
		                echo "<p>".$fila['Titulo']."</p>";
		                echo "<figure>";
		                echo "<a title='".$fila['Descripcion']."' href='detalle.php?id=".$fila['IdFoto']."'><img src='../Imagenes/".$fila['Fichero']."' alt='".$fila['Alternativo']."' width=100% height=100%></a>";
		                echo "</figure>";
		                echo "<footer>";
		                echo "<p>".$fila['Fecha']." | ".$fila['NomPais']."</p>";
		                echo "</footer>";
		                echo "</article>";
		            }

		            mysqli_free_result($resultado);
		            mysqli_close($enlace);
	            ?>
            </div>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
