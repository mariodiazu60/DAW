<?php
    include 'pre_cabecera.php';
	$title = "Registro";
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
		<?php
			if(isset($_COOKIE['usuario_recordado'])){
				$valores = explode(" ", $_COOKIE['usuario_recordado']);
			} else {
				$valores = explode(" ", $_SESSION['usuario_sesion']);
			}

			$enlace = @mysqli_connect("localhost", "root", "", "pibd");

			if (!$enlace) {
			  	echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error(); 
	   			echo '</p>'; 
	   			exit;
			}

			$sentencia = "SELECT NomUsuario, Email, Sexo, FNacimiento, Ciudad, NomPais, Foto from usuarios, paises WHERE NomUsuario='$valores[0]' AND Pais=IdPais";

			if(!($resultado = @mysqli_query($enlace, $sentencia))) { 
				echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace); 
				echo '</p>';
			    exit; 
			}

			$fila = mysqli_fetch_assoc($resultado);

			echo "<section class='formularios'>";
			echo "<h2>Modifica tus datos:</h2>";
			echo "<form name='registro' action='res_registro.php' id='form' method='post'>";

				echo "<label for='usu'> Nombre de usuario: ".$fila['NomUsuario']."</label>";
				echo "<input type='text' id='usu' name='usu'>";
					
				echo "<label for='contra'> Contraseña: </label>";
				echo "<input type='password' id='contra' name='contra' required>";
				
				echo "<label for='contra1'> Repetir contraseña: </label>";
				echo "<input type='password' id='contra1' name='contra1' required>";
				
			    echo "<label for='correo'> Correo electr&oacute;nico: ".$fila['Email']."</label>";
			    echo "<input type='email' id='correo' name='correo'>";		
				if ($fila['Sexo']==0) {
					 $sexo = 'Hombre';
				} else {
					$sexo = 'Mujer';
				}
				echo "<label for='sex'> Sexo: ".$sexo."</label>";
			    echo "<select name='sex' id='sex'>";
					echo '<option value="0">Hombre</option>';
					echo '<option value="1">Mujer</option>';
				echo "</select>";
				
				echo "<label for='fecha'> Fecha de nacimiento: ".$fila['FNacimiento']."</label>";
				echo "<input id='fecha' name='fecha' type='date'>";
				
				echo "<label for='pais'> Pa&iacute;s de residencia: ".$fila['NomPais']."</label>";
				echo "<select name='pais' id='pais'>";

					$link = @mysqli_connect("localhost", "root", "", "pibd");

				    if (!$link) {
				    	echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error(); 
	   					echo '</p>'; 
	   					exit;
				    }

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
				echo "<figure>";
		        echo "<img src='../Imagenes/".$fila['Foto']."' width=100% height=100%>";
		        echo "</figure>";
				echo "<input id='foto' class='puntero_mano' name='foto' type='file'>";
						
				echo "<input type='submit' class='puntero_mano' value='Enviar' name='Enviar'>";

				mysqli_free_result($resultado);
				mysqli_close($enlace);
			?>
			</form>		
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>