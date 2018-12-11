<?php
    include 'pre_cabecera.php';
    $_SESSION[ 'display_page2' ] = FALSE;
	$_SESSION[ 'display_page1' ] = FALSE;
	$title = "Resultado resgistro";
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
			<h2>Resultado del resgistro:</h2>
			
				<?php
					$usu = $_POST["usu"];
					$contra = $_POST["contra"];
					$contra1 = $_POST["contra1"];
					$correo = $_POST["correo"];
					$sexo = $_POST["sex"];
					$fnac = $_POST["fecha"];
					$pais = $_POST["pais"];
					$city = $_POST["ciud"];
					$foto = $_FILES["foto"]["name"];
					
					echo "<ul>";

					require_once("../Plantilla/regex.inc");

					if ($contra==$contra1) {
						if (preg_match('/'.$regexpusu.'/', $usu)) {
							if (preg_match('/'.$regexcontra.'/', $contra)) {
								if (preg_match('/'.$regexemail.'/', $correo)) {
									if (preg_match('/'.$regexfecha.'/', $fnac)) {
										require_once("../Plantilla/bbdd.inc");

									    if (!$enlace) {
									    	echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
					   						echo '</p>';
					   						exit;
									    }

				              			mysqli_set_charset($enlace, "utf8");
				              			$sentencia = "INSERT INTO usuarios (IdUsuario, NomUsuario, Clave, Email, Sexo, FNacimiento, Ciudad, Pais, Foto) VALUES (null, '$usu', '$contra', '$correo', $sexo, '$fnac', '$city', $pais, '$foto')";

				              			if(!mysqli_query($enlace, $sentencia)) 
				   							die("Error: no se pudo realizar la inserción");

									    $sentencia = "SELECT * FROM usuarios, paises WHERE NomUsuario='$usu' AND IdPais=Pais";

									    if(!($resultado = @mysqli_query($enlace, $sentencia))) {
										   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
										   echo '</p>';
										   exit;
										}

										$fila = mysqli_fetch_assoc($resultado);

										if($_FILES["foto"]["error"] > 0) { 
   											echo "Error: " . $msgError[$_FILES["foto"]["error"]] . "<br />"; 
   										} else {
   											if (@move_uploaded_file($_FILES["foto"]["tmp_name"], "G:\\xampp\\htdocs\\DAW\\Imagenes\\Perfil\\".$fila['IdUsuario'].$_FILES["foto"]["name"])){}
   										}

										echo "<li>Nombre de usuario: ".$usu."</li>";
										echo "<li>Contraseña: ".$contra."</li>";
										echo "<li>Correo electrónico: ".$correo."</li>";

										if ($fila['Sexo'] == 1) {
											$sexo = "Mujer";
										} else {
											$sexo = "Hombre";
										}
										echo "<li>Sexo: ".$sexo."</li>";

										echo "<li>Fecha de nacimiento: ".$fila['FNacimiento']."</li>";
										echo "<li>Pais de residencia: ".$fila['NomPais']."</li>";

										if (!empty($fila['Ciudad'])) {
											echo "<li>Ciudad: ".$fila['Ciudad']."</li>";
										}

										echo "<li>Foto de perfil:</li>";
										echo "<br>";
										echo "<figure>";
		        						echo "<img src='../Imagenes/Perfil/".$fila['IdUsuario'].$fila['Foto']."' width=50% height=50%>";
		        						echo "</figure>";

										mysqli_free_result($resultado);
						            	mysqli_close($enlace);
						            } else {
						            	echo "<h4>La fecha introducida no es válida</h4>";
						            }
						        } else {
						        	echo "<h4>El correo electrónico introducido no es válido</h4>";
						        }
						    } else {
						    	echo "<h4>La contraseña introducida no es válida</h4>";
						    }
						} else {
							echo "<h4>El nombre de usuario introducido no es válido</h4>";
						}	
					} else {
						echo "<h4>Las contraseñas introducidas no coinciden</h4>";
					}
			
					echo "</ul>";
				?>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>