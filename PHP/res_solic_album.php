<?php
    include 'pre_cabecera.php';
    $_SESSION[ 'display_page2' ] = FALSE;
	$_SESSION[ 'display_page1' ] = FALSE;
	$title = "Resultado solicitud álbum";
    require_once("../Plantilla/../Plantilla/cabecera.inc");
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
			<form name="busqueda" class="buscador" action="res_busqueda.php" method="post">
				<input type="search" name="buscar" placeholder="Buscar">
                <input class="puntero_mano" type="submit" name="Enviar">
			</form>
		</nav>

		<section class="menu_user_logeado">
			<h2>&Aacute;lbum solicitado</h2>
			
			<ul>
				<?php
					$name = $_POST["nomb"];
					$tit = $_POST["tit"];
					$dedic = $_POST["dedic"];
					$correo = $_POST["correo"];
					$direc = $_POST["direc"];
					$colo_portada = $_POST["colo"];
					$colo_foto = $_POST["colo_foto"];
					$copias = $_POST["copias"];
					$album = $_POST["imp"];
					$res = $_POST["res"];
					$fecha = $_POST["fecha"];

					require_once("../Plantilla/bbdd.inc");

				    if (!$enlace) {
					  	echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
						echo '</p>';
						exit;
				    }

           			mysqli_set_charset($enlace, "utf8");
           			$sentencia = "SELECT * FROM fotos WHERE Album='$album'";

					if(!($resultado = @mysqli_query($enlace, $sentencia))) {
						echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
						echo '</p>';
						exit;
					}

           			$costeres = 0;
					if ($res > 300) {
						$costeres = 0.02;
					}

					if ($colo_foto==1) {
						$coste = (40 * 0.07) + (mysqli_num_rows($resultado) * 0.05) + (mysqli_num_rows($resultado) * $costeres);
					} else {
						$coste = (40 * 0.07) + (mysqli_num_rows($resultado) * $costeres);
					}
           			$sentencia = "INSERT INTO solicitudes (IdSolicitud, Album, Nombre, Titulo, Descripcion, Email, Direccion, Color, Copias, Resolucion, Fecha, IColor, Coste) VALUES (null, $album, '$name', '$tit', '$dedic', '$correo', '$direc', '$colo_portada', $copias, $res, '$fecha', $colo_foto, $coste)";

           			if(!mysqli_query($enlace, $sentencia)) 
						die("Error: no se pudo realizar la inserción");

					$sentencia = "SELECT al.Titulo as ATitulo FROM solicitudes as so, albumes as al WHERE so.Titulo='$tit' AND so.Album=al.IdAlbum";

					if(!($resultado = @mysqli_query($enlace, $sentencia))) {
						echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
						echo '</p>';
						exit;
					}

					$fila = mysqli_fetch_assoc($resultado);

					echo "<li>Nombre: ".$name."</li>";
					echo "<li> Título del álbum: ".$tit."</li>";
				    if (!empty($decic)) {
				    	echo "<li> Dedicatoria o descripci&oacute;n: </li>";
				    }
					echo "<li>Correo del destinatario: ".$correo."</li>";			
					echo "<li> Direcci&oacute;n postal: ".$direc."</li>";
					if (!empty($colo_portada)) {
						echo "<li> Color de portada: ".$colo_portada."</li>";
					}
					if ($colo_foto == 1) {
						$colo_foto = "A todo color";
					} else {
						$colo_foto = "Blanco y negro";
					}	
					echo "<li> Color de las fotos: ".$colo_foto."</li>";				
					echo "<li> N&uacute;mero de copias: ".$copias."</li>";
					echo "<li> &Aacute;lbum a imprimir: ".$fila['ATitulo']."</li>";				
					echo "<li> Resoluci&oacute;n de las fotos: ".$res." DPI</li>";
					if (!empty($fecha)) {
						echo "<li>Fecha de recepción del álbum: ".$fecha."</li>";
					}

					echo "</ul>";
				echo "<h3>Coste total del producto: ".$coste."€</h3>";

				mysqli_free_result($resultado);
				mysqli_close($enlace);
			?>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>