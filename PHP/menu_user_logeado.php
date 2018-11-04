<?php
	$title = "Menú de usuario";
    require_once("../Plantilla/cabecera.inc");
    require_once("../Plantilla/inicio.inc");
?>
		<nav>
			<ul>
				<li><a href="index.php">Inicio</a></li>
				<li><a href="busqueda.php">B&uacute;squeda</a></li>
			</ul>
			<form name="busqueda" class="buscador" action="res_busqueda.php" method="post">
				<input type="search" name="buscar" placeholder="Buscar">
                <input class="puntero_mano" type="submit" name="Enviar">
			</form>
		</nav>

		<section class="menu_user_logeado">
			<h2>Men&uacute; de cuenta:</h2>
			<ul>
				<li><a href="">Modificar mis datos</a></li>
				<li><a href="">Mis &aacute;lbumes</a></li>
				<li><a href="crear_album.php">Crear &aacute;lbum</a></li>
				<li><a href="solic_album.php">Solicitar &aacute;lbum</a></li>
				<li><a href="">Darme de baja</a></li>
			</ul>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
