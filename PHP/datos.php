<?php
    include 'pre_cabecera.php';
    $_SESSION[ 'display_page2' ] = FALSE;
	$_SESSION[ 'display_page1' ] = FALSE;
	$title = "Modifica tus datos";
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
		<?php
			if(isset($_COOKIE['usuario_recordado'])){
				$valores = explode(" ", $_COOKIE['usuario_recordado']);
			} else {
				$valores = explode(" ", $_SESSION['usuario_sesion']);
			}

			require_once("../Plantilla/bbdd.inc");

			if (!$enlace) {
			  	echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
	   			echo '</p>';
	   			exit;
			}

      		mysqli_set_charset($enlace, "utf8");
			$sentencia = "SELECT NomUsuario, Email, Sexo, FNacimiento, Ciudad, NomPais, Foto from usuarios, paises WHERE NomUsuario='$valores[0]' AND Pais=IdPais";

			if(!($resultado = @mysqli_query($enlace, $sentencia))) {
				echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
				echo '</p>';
			    exit;
			}

			$fila = mysqli_fetch_assoc($resultado);

			echo "<section class='formularios'>";
			echo "<h2>Modifica tus datos:</h2>";
			echo "<form name='registro' action='res_datos.php' id='form' method='post' enctype='multipart/form-data'>";

				echo "<label for='usu'> Nombre de usuario: ".$fila['NomUsuario']."</label>";
				echo "<input type='text' id='usu' name='usu'>";

				echo "<label for='contra'> Contraseña: </label>";
				echo "<input type='password' id='contra' name='contra'>";

				echo "<label for='contra1'> Repetir contraseña: </label>";
				echo "<input type='password' id='contra1' name='contra1'>";

			    echo "<label for='correo'> Correo electr&oacute;nico: ".$fila['Email']."</label>";
			    echo "<input type='email' id='correo' name='correo'>";
				if ($fila['Sexo']==0) {
					 $sexo = 'Hombre';
				} else {
					$sexo = 'Mujer';
				}
				echo "<label for='sex'> Sexo: ".$sexo."</label>";
			    echo "<select name='sex' id='sex'>";
			    	echo "<option value='-1'>-Elegir-</option>";
					echo '<option value="0">Hombre</option>';
					echo '<option value="1">Mujer</option>';
				echo "</select>";

				echo "<label for='fecha'> Fecha de nacimiento: ".$fila['FNacimiento']."</label>";
				echo "<input id='fecha' name='fecha' type='date'>";

				echo "<label for='pais'> Pa&iacute;s de residencia: ".$fila['NomPais']."</label>";
				echo "<select name='pais' id='pais'>";
					echo "<option value='0'>-Elegir-</option>";

					require_once("../Plantilla/bbdd2.inc");

				    if (!$link) {
				    	echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
	   					echo '</p>';
	   					exit;
				    }

            		mysqli_set_charset($link, "utf8");
				    $sent = "SELECT * from paises";

				    if(!($res = @mysqli_query($link, $sent))) {
					   echo "<p>Error al ejecutar la sentencia <b>$sent</b>: " . mysqli_error($link);
					   echo '</p>';
					   exit;
					}

					while ($row = mysqli_fetch_assoc($res)) {
						echo "<option value='".$row['IdPais']."'>".$row['NomPais']."</option>";
					}

					mysqli_free_result($res);
		           	mysqli_close($link);

				echo "</select>";

				echo "<label for='ciud'> Ciudad: ".$fila['Ciudad']."</label>";
				echo "<input type='text' name='ciud' id='ciud'>";

				echo "<label for='foto'> Foto de perfil: </label>";
				if ($fila['Foto']!="") {
					echo "<br>";
					echo "<br>";
					echo "<figure>";
			        echo "<img src='../Imagenes/Perfil/".$valores[5].$fila['Foto']."' width=50% height=50%>";
			        echo "</figure>";
			        echo "<br>";
			    } else {
			    	echo "<br>";
					echo "<br>";
			    	echo "<p>No tienes definida ninguna foto de perfil</p>";
			    	echo "<br>";
			    }
				echo "<input id='foto' class='puntero_mano' name='foto' type='file'>";
				echo "<label for='eliminar'> Eliminar imagen de perfil: </label>";
			    echo "<input type='checkbox' id='eliminar' name='eliminar'>";

				echo "<label for='contra2'> Introduce tu contraseña actual para confirmar los cambios: </label>";
				echo "<input type='password' id='contra2' name='contra2' required>";

				echo "<input type='submit' class='puntero_mano' value='Enviar' name='Enviar'>";

				mysqli_free_result($resultado);
				mysqli_close($enlace);
			?>
			</form>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
