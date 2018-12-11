<?php
    include 'pre_cabecera.php';
    $_SESSION[ 'display_page2' ] = FALSE;
	$_SESSION[ 'display_page1' ] = FALSE;
	$title = "Detalle de foto";
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

		<section class="detalle">
			<h2>Detalles de la foto:</h2>

			<article>
					<?php
						$id = $_GET["id"];

						require_once("../Plantilla/bbdd.inc");

						if (!$enlace) {
					    	echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
	   						echo '</p>';
	   						exit;
					    }

              			mysqli_set_charset($enlace, "utf8");
              			$sentencia = "SELECT * from fotos WHERE $id=IdFoto";

					    if(!($resultado = @mysqli_query($enlace, $sentencia))) {
						   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
						   echo '</p>';
						   exit;
						}

						if (mysqli_num_rows($resultado)!=1) {
							echo "<h3>Esta foto no existe</h3>";
							echo "<br>";

							mysqli_free_result($resultado);
				            mysqli_close($enlace);
						} else {
							echo "<figure>";

							require_once("../Plantilla/bbdd.inc");

						    if (!$enlace) {
						    	echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
		   						echo '</p>';
		   						exit;
						    }

	              			mysqli_set_charset($enlace, "utf8");
						    $sentencia = "SELECT IdFoto, fotos.Titulo as FTitulo, fotos.Descripcion as FDescripcion, Fecha, NomPais, Fichero, Alternativo, albumes.Titulo as ATitulo, NomUsuario from fotos, paises, albumes, usuarios WHERE fotos.IdFoto='$id' AND fotos.Pais=paises.IdPais AND fotos.Album=albumes.IdAlbum AND albumes.Usuario=usuarios.IdUsuario";

						    if(!($resultado = @mysqli_query($enlace, $sentencia))) {
							   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
							   echo '</p>';
							   exit;
							}

							$fila = mysqli_fetch_assoc($resultado);
							echo "<img title='".$fila['FDescripcion']."' src='../Imagenes/".$fila['Fichero']."' alt='".$fila['Alternativo']."' width=40% height=40%>";
							echo "</figure>";
							echo "<ul>";
							echo "<li>Usuario: ".$fila['NomUsuario']."</li>";
							echo "<li>Título: ".$fila['FTitulo']."</li>";
							echo "<li>Álbum: ".$fila['ATitulo']."</li>";
							echo "<li>Fecha: <time>".$fila['Fecha']."</time></li>";
							echo "<li>País: ".$fila['NomPais']."</li>";

							mysqli_free_result($resultado);
				            mysqli_close($enlace);
					
							echo "</ul>";
						}

						echo "</article>";
						echo "</section>";
    require_once("../Plantilla/pie.inc");
?>
