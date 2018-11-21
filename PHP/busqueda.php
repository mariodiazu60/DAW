<?php
	include 'pre_cabecera.php';
	$title = "Búsqueda";
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

		<h2 class="titulo_formulario_buscar">B&uacute;squeda por filtros:</h2>
		<section class="formulario_buscar">
			<form name="busquedaPorCriterios" action="res_busqueda.php" method="post">
				<label for="tit"> T&iacute;tulo:</label>
				<input id="tit" name="tit" type="text">

				<label for="date1"> Desde:</label>
				<input id="date1" name="date1" type="date">

				<label for="date2"> Hasta:</label>
				<input id="date2" name="date2" type="date">

				<label for="pais"> Pa&iacute;s:</label>
                <select name="pais" id="pais">
                	<option value="0">Elegir</option>
                	<?php
						$enlace = @mysqli_connect("localhost", "root", "", "pibd");

					    if (!$enlace) {
					    	echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error(); 
	   						echo '</p>'; 
	   						exit;
					    }

					    $sentencia = "SELECT * from paises";

					    if(!($resultado = @mysqli_query($enlace, $sentencia))) { 
						   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace); 
						   echo '</p>';
						   exit; 
						}

						while ($fila = mysqli_fetch_assoc($resultado)) {
							echo "<option value='".$fila['IdPais']."'>".$fila['NomPais']."</option>";
						}

						mysqli_free_result($resultado);
		            	mysqli_close($enlace);
					?>
                </select>

				<input class="puntero_mano" type="submit" name="Enviar">
			</form>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
