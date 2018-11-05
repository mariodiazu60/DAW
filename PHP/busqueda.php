<?php
	$title = "Búsqueda";
    require_once("../Plantilla/cabecera.inc");
    require_once("../Plantilla/inicio.inc");
?>
		<nav>
			<?php
				session_start();
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
                    <option value="1">España</option>
                    <option value="2">Francia</option>
                    <option value="3">Alemania</option>
                </select>

				<input class="puntero_mano" type="submit" name="Enviar">
			</form>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
