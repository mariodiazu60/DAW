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
			<?php
				if (isset($_COOKIE['usuario_recordado'])) {
			    	$valores = explode(" ", $_COOKIE['usuario_recordado']);
			    	echo "<p>Hola ".$valores[0].", su última visita fue el ".$valores[2]." a las ".$valores[3].".</p>";
			    	echo "<a href='control_salida.php'>Salir</a>";
			    } else {
			    	require_once("../Plantilla/login.inc");
			    }
			?>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
