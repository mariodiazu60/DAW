<?php
    include 'pre_cabecera.php';
    $_SESSION[ 'display_page2' ] = FALSE;
	$_SESSION[ 'display_page1' ] = FALSE;
	$title = "Iniciar sesión";
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

		<section class="formularios">
			<h2>Inicio de sesi&oacute;n:</h2>
			<?php
				if ((isset($_SESSION['display_page2'])) && $_SESSION[ 'display_page2' ] === TRUE )  {
					echo "<h4>Error al iniciar sesión</h4>";
					echo "<br>";
					echo "<h5>Los datos introducidos no son válidos</h5>";
					echo "<br>";
				}

				if ((isset($_SESSION['display_page1'])) && $_SESSION[ 'display_page1' ] === TRUE )  {
					echo "<h4>Registrate para acceder</h4>";
					echo "<br>";
				}

			    require_once("../Plantilla/login.inc");
			?>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
