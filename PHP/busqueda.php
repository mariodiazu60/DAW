<?php
	$title = "Búsqueda";
    require_once("../Plantilla/cabecera.inc");
    require_once("../Plantilla/inicio.inc");
?>
		<nav>
			<ul>
				<li><a class="enlace" href="index.php">Inicio</a></li>
				<li><a href="registro.php">Registro</a></li>
				<li><a href="inicio_sesion.php">Iniciar sesi&oacute;n</a></li>
			</ul>
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
