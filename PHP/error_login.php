<?php
	$title = "Error inicio de sesión";
    require_once("../Plantilla/cabecera.inc");
    require_once("../Plantilla/inicio.inc");
?>
		<nav>
			<ul>
				<li><a href="index.php">Inicio</a></li>
				<li><a href="busqueda.php">B&uacute;squeda</a></li>
				<li><a href="registro.php">Registro</a></li>
				<li><a href="inicio_sesion.php">Iniciar sesi&oacute;n</a></li>
			</ul>
			<form name="busqueda" class="buscador" action="res_busqueda.php" method="post">
				<input type="search" name="buscar" placeholder="Buscar">
                <input class="puntero_mano" type="submit" name="Enviar">
			</form>
		</nav>

		<section class="menu_user_logeado">
			<h2>Error al iniciar sesión</h2>
			<p><b>Los datos introducidos no son válidos</b></p>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>