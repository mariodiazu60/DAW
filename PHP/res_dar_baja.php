<?php
	include 'pre_cabecera.php';
    $_SESSION[ 'display_page2' ] = FALSE;
	$_SESSION[ 'display_page1' ] = FALSE;
	$title = "Datos del usuario";
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
		<?php
		    $contra = $_POST['contra'];

		    if (isset($_COOKIE['usuario_recordado'])==true) {
			    $valores = explode(" ", $_COOKIE['usuario_recordado']);
			} elseif (isset($_SESSION['usuario_sesion'])==true) {
			    $valores = explode(" ", $_SESSION['usuario_sesion']);
			}

		    require_once("../Plantilla/bbdd.inc");
		    require_once("../Plantilla/regex.inc");

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

			if ($contra==$valores[1] && preg_match('/'.$regexcontra.'/', $contra)) {
				while ($fila = mysqli_fetch_assoc($resultado)) {
					$id = $fila['IdAlbum'];
					$sentencia5 = "SELECT Fichero FROM fotos WHERE Album='$id'";

					if(!($resultado1 = @mysqli_query($enlace, $sentencia5))) {
			    		echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
			    		echo '</p>';
			    		exit;
					}

					while ($fila1 = mysqli_fetch_assoc($resultado1)) {
						unlink("C:\\xampp\\htdocs\\DAW\\Imagenes\\".$fila1['Fichero']);
					}
					mysqli_free_result($resultado1);

					$sentencia1 = "DELETE FROM fotos WHERE Album='$id'";

					if(!mysqli_query($enlace, $sentencia1)) 
						die("Error: no se pudo realizar el borrado");

					$sentencia2 = "DELETE FROM solicitudes WHERE Album='$id'";

					if(!mysqli_query($enlace, $sentencia2)) 
						die("Error: no se pudo realizar el borrado");

					$sentencia3 = "DELETE FROM albumes WHERE IdAlbum='$id'";

					if(!mysqli_query($enlace, $sentencia3)) 
						die("Error: no se pudo realizar el borrado");
				}

				$sentencia4 = "DELETE FROM usuarios WHERE NomUsuario='$valores[0]'";

				if(!mysqli_query($enlace, $sentencia4)) 
						die("Error: no se pudo realizar el borrado");

				echo "<h3>Pulsa en Continuar para darte de baja</h3>";
				echo "<br>";
				echo "<h4><a href='control_salida.php'>Continuar</a></h4>";
			} else {
				echo "<h3>La contraseña introducida es incorrecta</h3>";
			}

			mysqli_free_result($resultado);
			mysqli_close($enlace);
		?>
	</section>
<?php
    require_once("../Plantilla/pie.inc");
?>