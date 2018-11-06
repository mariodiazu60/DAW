<?php
	$title = "Iniciar sesión";
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

		<section class="formularios">
			<h2>Inicio de sesi&oacute;n:</h2>
			<p>
			<?php
				if (isset($_COOKIE['usuario_recordado'])) {
			    	$valores = explode(" ", $_COOKIE['usuario_recordado']);
			    	echo "Hola ".$valores[0].", su última visita fue el ".$valores[2]." a las ".$valores[3].".<br><br>";
			    	echo "<a href='control_salida.php'>Salir</a>";
			    } elseif (isset($_SESSION['usuario_sesion'])) {
			    	$valores = explode(" ", $_SESSION['usuario_sesion']);
			    	echo "Hola ".$valores[0].", su última visita fue el ".$valores[2]." a las ".$valores[3].".<br><br>";
			    	echo "<a href='control_salida.php'>Salir</a>";
			    } else {
			    	require_once("../Plantilla/login.inc");
			    }
			?>
			</p>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
