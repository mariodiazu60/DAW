<?php
	$title = "Iniciar sesión";
    require_once("../Plantilla/cabecera.inc");
    require_once("../Plantilla/inicio.inc");
?>
		<nav>
			<ul>
				<li><a href="index.php">Inicio</a></li>
				<li><a href="busqueda.php">B&uacute;squeda</a></li>
				<li><a href="registro.php">Registro</a></li>
			</ul>
			<form name="busqueda" class="buscador" action="res_busqueda.php" method="post">
				<input type="search" name="buscar" placeholder="Buscar">
                <input class="puntero_mano" type="submit" name="Enviar">
			</form>
		</nav>

		<section class="formularios">
			<h2>Inicio de sesi&oacute;n:</h2>
			<form name="Login" action="control_acceso.php" method="post">
				<label for="usu"> Usuario:</label>
				<input type="text" id="usu" name="usu" required>

				<label for="contra"> Contraseña:</label>
				<input type="password" id="contra" name="contra" required>

				<input class="puntero_mano" type="submit" name="Enviar">
			</form>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
