<?php
    include 'pre_cabecera.php';
    $_SESSION[ 'display_page2' ] = FALSE;
	$_SESSION[ 'display_page1' ] = FALSE;
	$title = "Foto añadida";
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
					$foto = $valores[5].$_FILES["foto"]["size"].$_FILES["foto"]["name"];
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
					$sentencia = "SELECT * FROM albumes, usuarios WHERE NomUsuario='$valores[0]' AND Usuario=IdUsuario";

					if(!($resultado = @mysqli_query($enlace, $sentencia))) {
					    echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
					    echo '</p>';
					    exit;
					}

					if (mysqli_num_rows($resultado)>0) {
						$sentencia = "INSERT INTO fotos (IdFoto, Titulo, Descripcion, Fecha, Pais, Album, Fichero, Alternativo) VALUES (null, '$tit', '$desc', '$fecha', $pais, $album, '$foto', '$alter')";

					    if(!mysqli_query($enlace, $sentencia)) 
					   		die("Error: no se pudo realizar la inserción");

					   	if($_FILES["foto"]["error"] > 0) { 
   							echo "Error: " . $msgError[$_FILES["foto"]["error"]] . "<br />"; 
   						} else {
   							if (@move_uploaded_file($_FILES["foto"]["tmp_name"], "G:\\xampp\\htdocs\\DAW\\Imagenes\\".$valores[5].$_FILES["foto"]["size"].$_FILES["foto"]["name"])){}
   						}

					   	$sentencia = "SELECT NomPais, al.Titulo as ATitulo, Fichero FROM paises as pa, albumes as al, fotos as fo WHERE Fichero='$foto' AND IdAlbum=$album AND IdPAis=$pais";

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
						echo "<li>Foto:</li>";
						echo "<br>";
						echo "<figure>";
		        		echo "<img src='../Imagenes/".$fila['Fichero']."' width=50% height=50%>";
		        		echo "</figure>";
						echo "<li>Album: ".$fila['ATitulo']."</li>";
						echo "<li>Texto alternativo: ".$alter."</li>";
					} else {
						echo "<h3>Selecciona álbum al cual añadir la foto, si no tienes ninguno, créalo.</h3>";
					}

					mysqli_free_result($resultado);
					mysqli_close($enlace);

					echo "</ul>";
				?>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>