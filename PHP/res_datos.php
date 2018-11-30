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
			<form name="busqueda" class="buscador" action="res_busqueda.php" method="post">
				<input type="search" name="buscar" placeholder="Buscar">
                <input class="puntero_mano" type="submit" name="Enviar">
			</form>
		</nav>

		<section class="menu_user_logeado">
			<h2>Tus datos:</h2>
			
				<?php
					if (isset($_COOKIE['usuario_recordado'])==true) {
				        $valores = explode(" ", $_COOKIE['usuario_recordado']);
				    } elseif (isset($_SESSION['usuario_sesion'])==true) {
				        $valores = explode(" ", $_SESSION['usuario_sesion']);
				    }

					$usu = $_POST["usu"];
					$contra = $_POST["contra"];
					$contra1 = $_POST["contra1"];
					$contra2 = $_POST["contra2"];
					$correo = $_POST["correo"];
					$sexo = $_POST["sex"];
					$fnac = $_POST["fecha"];
					$pais = $_POST["pais"];
					$city = $_POST["ciud"];
					$foto = $_POST["foto"];
					
					echo "<ul>";

					require_once("../Plantilla/bbdd.inc");

					if (!$enlace) {
					    echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
					    echo '</p>';
					    exit;
					}

					mysqli_set_charset($enlace, "utf8");
					$sentencia = "SELECT * FROM usuarios WHERE NomUsuario='$valores[0]'";

					if(!($resultado = @mysqli_query($enlace, $sentencia))) {
					    echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
					    echo '</p>';
					    exit;
					}

					$fila = mysqli_fetch_assoc($resultado);
					$id = $fila['IdUsuario'];

					require_once("../Plantilla/regex.inc");

					if (!empty($usu) && preg_match('/'.$regexpusu.'/', $usu) && $contra2==$valores[1] && preg_match('/'.$regexcontra.'/', $contra2)) {
						$sentencia = "UPDATE usuarios SET NomUsuario='$usu' WHERE NomUsuario='$valores[0]'";

						if(!mysqli_query($enlace, $sentencia)) 
					        die("Error: no se pudo realizar la actualización");
					}

					if (preg_match('/'.$regexcontra.'/', $contra2) && $contra2==$valores[1] && !empty($contra) && !empty($contra1) && $contra==$contra1) {
						$sentencia = "UPDATE usuarios SET Clave='$contra' WHERE NomUsuario='$valores[0]'";

					    if(!mysqli_query($enlace, $sentencia)) 
					        die("Error: no se pudo realizar la actualización");
					}
					if (preg_match('/'.$regexcontra.'/', $contra2) && $contra2==$valores[1] && !empty($correo) && preg_match('/'.$regexemail.'/', $correo)) {
						$sentencia = "UPDATE usuarios SET Email='$correo' WHERE NomUsuario='$valores[0]'";

					    if(!mysqli_query($enlace, $sentencia)) 
					        die("Error: no se pudo realizar la actualización");
					}
					if (preg_match('/'.$regexcontra.'/', $contra2) && $contra2==$valores[1]&& $sexo>=0) {
						$sentencia = "SELECT * FROM usuarios WHERE NomUsuario='$valores[0]'";

					    if(!($resultado = @mysqli_query($enlace, $sentencia))) {
						    echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
						    echo '</p>';
						    exit;
						}

						$fila = mysqli_fetch_assoc($resultado);

						if ($sexo!=$fila['Sexo']) {
							$sentencia = "UPDATE usuarios SET Sexo=$sexo WHERE NomUsuario='$valores[0]'";

						    if(!mysqli_query($enlace, $sentencia)) 
						        die("Error: no se pudo realizar la actualización");
						}
					}
					if (preg_match('/'.$regexcontra.'/', $contra2) && $contra2==$valores[1] && !empty($fnac) && preg_match('/'.$regexfecha.'/', $fnac)) {
						$sentencia = "UPDATE usuarios SET FNacimiento='$fnac' WHERE NomUsuario='$valores[0]'";

						if(!mysqli_query($enlace, $sentencia)) 
						    die("Error: no se pudo realizar la actualización");
					}
					if (preg_match('/'.$regexcontra.'/', $contra2) && $contra2==$valores[1] && $pais>=1) {
						$sentencia = "SELECT * FROM usuarios WHERE NomUsuario='$valores[0]'";

					    if(!($resultado = @mysqli_query($enlace, $sentencia))) {
						    echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
						    echo '</p>';
						    exit;
						}

						$fila = mysqli_fetch_assoc($resultado);

						if ($pais!=$fila['Pais']) {
							$sentencia = "UPDATE usuarios SET Pais=$pais WHERE NomUsuario='$valores[0]'";

						    if(!mysqli_query($enlace, $sentencia)) 
						        die("Error: no se pudo realizar la actualización");
						}
					}
					if (preg_match('/'.$regexcontra.'/', $contra2) && $contra2==$valores[1] && !empty($city)) {
						$sentencia = "UPDATE usuarios SET Ciudad='$city' WHERE NomUsuario='$valores[0]'";

					    if(!mysqli_query($enlace, $sentencia)) 
					        die("Error: no se pudo realizar la actualización");
					}
					if (preg_match('/'.$regexcontra.'/', $contra2) && $contra2==$valores[1] && !empty($foto)) {
						$sentencia = "UPDATE usuarios SET Foto='$foto' WHERE NomUsuario='$valores[0]'";

					    if(!mysqli_query($enlace, $sentencia)) 
					        die("Error: no se pudo realizar la actualización");
					}

					$sentencia = "SELECT * FROM usuarios, paises WHERE IdUsuario='$id' AND Pais=IdPais";

					if(!($resultado = @mysqli_query($enlace, $sentencia))) {
					    echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
					    echo '</p>';
					    exit;
					}

					if (mysqli_num_rows($resultado)==1) {
						$fila = mysqli_fetch_assoc($resultado);
						echo "<li>Nombre de usuario: ".$fila['NomUsuario']."</li>";
						echo "<li>Contraseña: ".$fila['Clave']."</li>";
						echo "<li>Correo electrónico: ".$fila['Email']."</li>";
						if ($fila['Sexo'] == 1) {
							$sexo = "Mujer";
						} else {
							$sexo = "Hombre";
						}
						echo "<li>Sexo: ".$sexo."</li>";
						echo "<li>Fecha de nacimiento: ".$fila['FNacimiento']."</li>";
						echo "<li>Pais de residencia: ".$fila['NomPais']."</li>";
						echo "<li>Ciudad: ".$fila['Ciudad']."</li>";
						echo "<li>Foto de perfil: ".$fila['Foto']."</li>";
					} else {
						echo "<h4>No existe este usuario".$id."</h4>";
					}

					mysqli_free_result($resultado);
					mysqli_close($enlace);

					echo "</ul>";
				?>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>