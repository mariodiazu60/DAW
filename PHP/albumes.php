<?php
    include 'pre_cabecera.php';
    $_SESSION[ 'display_page2' ] = FALSE;
	$_SESSION[ 'display_page1' ] = FALSE;
	$title = "Álbumes";
    require_once("../Plantilla/cabecera.inc");
    require_once("../Plantilla/inicio.inc");
	if(isset($_COOKIE['usuario_recordado'])==false && isset($_SESSION['usuario_sesion'])==false){
		$_SESSION[ 'display_page1' ] = TRUE;
		header("Location: http://localhost/DAW/PHP/inicio_sesion.php");
	}
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
			<h2>Mis álbumes:</h2>
			<ul>
				<?php
					if(isset($_COOKIE['usuario_recordado'])){
						$valores = explode(" ", $_COOKIE['usuario_recordado']);
					} else{
						$valores = explode(" ", $_SESSION['usuario_sesion']);
					}

            		require_once("../Plantilla/bbdd.inc");

				    if (!$enlace) {
				    	echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
   						echo '</p>';
   						exit;
				    }

            		mysqli_set_charset($enlace, "utf8");
				    $sentencia = "SELECT IdAlbum, Titulo, Descripcion from usuarios, albumes WHERE NomUsuario='$valores[0]' AND Usuario=IdUsuario";

				    if(!($resultado = @mysqli_query($enlace, $sentencia))) {
					   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
					   echo '</p>';
					   exit;
					}

					while ($fila = mysqli_fetch_assoc($resultado)) {
		                echo "<li><a href='ver_album.php?id=".$fila['IdAlbum']."'>".$fila['Titulo']."</a></li>";
		                echo "<p>".$fila['Descripcion']."</p>";
		            }

		            mysqli_free_result($resultado);
		            mysqli_close($enlace);
	            ?>
			</ul>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
