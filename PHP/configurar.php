<?php
    include 'pre_cabecera.php';
    $_SESSION[ 'display_page2' ] = FALSE;
	$_SESSION[ 'display_page1' ] = FALSE;
	$title = "Selección del estilo";
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
			<form name="busqueda" class="buscador" action="res_busqueda.php" method="post">
				<input type="search" name="buscar" placeholder="Buscar">
                <input class="puntero_mano" type="submit" name="Enviar">
			</form>
		</nav>

		<section class="menu_user_logeado">
			<h2>Estilos disponibles:</h2>
			<ul>
				<?php
            		require_once("../Plantilla/bbdd.inc");

				    if (!$enlace) {
				    	echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
   						echo '</p>';
   						exit;
				    }

            		mysqli_set_charset($enlace, "utf8");
				    $sentencia = "SELECT * from estilos";

				    if(!($resultado = @mysqli_query($enlace, $sentencia))) {
					   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
					   echo '</p>';
					   exit;
					}

					while ($fila = mysqli_fetch_assoc($resultado)) {
		                echo "<li><a href='res_res_configurar.php?id=".$fila['IdEstilo']."'>".$fila['Nombre']."</a></li>";
		            }

		            mysqli_free_result($resultado);
		            mysqli_close($enlace);
	            ?>
			</ul>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
