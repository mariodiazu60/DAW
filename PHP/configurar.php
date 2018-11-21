<?php
    include 'pre_cabecera.php';
	$title = "Menú de usuario";
    require_once("../Plantilla/cabecera.inc");
    require_once("../Plantilla/inicio.inc");
	if(isset($_COOKIE['usuario_recordado'])==false && isset($_SESSION['usuario_sesion'])==false){
		header("Location: http://localhost/DAW/PHP/index.php");
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
			<form name="busqueda" class="buscador" action="res_busqueda.php" method="post">
				<input type="search" name="buscar" placeholder="Buscar">
                <input class="puntero_mano" type="submit" name="Enviar">
			</form>
		</nav>

		<section class="menu_user_logeado">
			<h2>Estilos disponibles:</h2>
			<ul>
				<?php
            		$enlace = @mysqli_connect("localhost", "root", "", "pibd");

				    if (!$enlace) {
				    	echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error(); 
   						echo '</p>'; 
   						exit;
				    }

				    $sentencia = "SELECT Nombre from estilos";

				    if(!($resultado = @mysqli_query($enlace, $sentencia))) { 
					   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace); 
					   echo '</p>';
					   exit; 
					}

					while ($fila = mysqli_fetch_assoc($resultado)) {
		                echo "<li><a href=''>".$fila['Nombre']."</a></li>";
		            }

		            mysqli_free_result($resultado);
		            mysqli_close($enlace);
	            ?>
			</ul>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>