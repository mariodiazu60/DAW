<?php
    include 'pre_cabecera.php';
	$title = "Inicio";
    //include 'selector_css.php';
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

		<section>
            <div>
            	<?php
            		$enlace = @mysqli_connect("localhost", "root", "", "pibd");

				    if (!$enlace) {
				    	echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error(); 
   						echo '</p>'; 
   						exit;
				    }

				    $sentencia = "SELECT IdFoto, Titulo, Descripcion, Fecha, NomPais, Fichero, Alternativo from fotos, paises WHERE fotos.Pais=paises.IdPais ORDER BY FRegistro DESC LIMIT 5";

				    if(!($resultado = @mysqli_query($enlace, $sentencia))) { 
					   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace); 
					   echo '</p>';
					   exit; 
					}

					while ($fila = mysqli_fetch_assoc($resultado)) {
		                echo "<article>";
		                echo "<p>".$fila['Titulo']."</p>";
		                echo "<figure>";
		                echo "<a title='".$fila['Descripcion']."' href='detalle.php?id=".$fila['IdFoto']."'><img src='../Imagenes/".$fila['Fichero']."' alt='".$fila['Alternativo']."' width=100% height=100%></a>";
		                echo "</figure>";
		                echo "<footer>";
		                echo "<p>".$fila['Fecha']." | ".$fila['NomPais']."</p>";
		                echo "</footer>";
		                echo "</article>";
		            }

		            mysqli_free_result($resultado);
		            mysqli_close($enlace);
	            ?>
            </div>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>