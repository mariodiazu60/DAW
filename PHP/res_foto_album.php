<?php
    include 'pre_cabecera.php';
    $_SESSION[ 'display_page2' ] = FALSE;
	$_SESSION[ 'display_page1' ] = FALSE;
	$title = "Foto añadida";
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
			<form name="busqueda" class="buscador" action="res_busqueda.php" method="post">
				<input type="search" name="buscar" placeholder="Buscar">
                <input class="puntero_mano" type="submit" name="Enviar">
			</form>
		</nav>

		<section class="menu_user_logeado">
			<h2>Foto añadida:</h2>		
				<?php
					if (isset($_COOKIE['usuario_recordado'])==true) {
				        $valores = explode(" ", $_COOKIE['usuario_recordado']);
				    } elseif (isset($_SESSION['usuario_sesion'])==true) {
				        $valores = explode(" ", $_SESSION['usuario_sesion']);
				    }

					$tit = $_POST["tit"];
					$desc = $_POST["desc"];
					$fecha = $_POST["date"];
					$pais = $_POST["pais"];
					$foto = $_POST["foto"];
					$alter = $_POST["alter"];
					$album = $_POST["album"];
					
					echo "<ul>";

					require_once("../Plantilla/bbdd.inc");

					if (!$enlace) {
					    echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
					    echo '</p>';
					    exit;
					}

					mysqli_set_charset($enlace, "utf8");
					$sentencia = "INSERT INTO fotos (IdFoto, Titulo, Descripcion, Fecha, Pais, Album, Fichero, Alternativo) VALUES (null, '$tit', '$desc', '$fecha', $pais, $album, '$foto', '$alter')";

				    if(!mysqli_query($enlace, $sentencia)) 
				   		die("Error: no se pudo realizar la inserción");

				   	$sentencia = "SELECT NomPais, Titulo FROM paises, albumes WHERE IdAlbum=$album AND IdPAis=$pais";

					if(!($resultado = @mysqli_query($enlace, $sentencia))) {
					    echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
					    echo '</p>';
					    exit;
					}

					$fila = mysqli_fetch_assoc($resultado);

					echo "<li>Título de la foto: ".$tit."</li>";
					echo "<li>Descripción: ".$desc."</li>";
					echo "<li>Fecha de la foto: ".$fecha."</li>";
					echo "<li>País donde fue tomada la foto: ".$fila['NomPais']."</li>";
					echo "<li>Fichero: ".$foto."</li>";
					echo "<li>Album: ".$fila['Titulo']."</li>";
					echo "<li>Texto alternativo: ".$alter."</li>";

					mysqli_free_result($resultado);
					mysqli_close($enlace);

					echo "</ul>";
				?>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>