<?php
    include 'pre_cabecera.php';
    $_SESSION[ 'display_page2' ] = FALSE;
    $_SESSION[ 'display_page1' ] = FALSE;
	$title = "Accesibilidad";
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

		<section class="menu_user_logeado">
			<h2>Accesibilidad</h2>
			<p>Con respecto a la accesibilidad de la página cabe destacar que todas las imagenes que aparecen en ella vienen con una descripción alternativa, se ha tratado de utilizar un etiquetado lo más semántico posible. También se han utilizado combinaciones de color con alto contraste y un tamaño de letra ampliado para facilitar la lectura y visión general de la página además de un mayor tamaño en los formularios y una diferenciación a la hora de rellenar cada campo.</p>
			<p>Para activar la hoja de estilo se tiene que acceder al menú "Ver" de Mozilla Firefox, seleccionar la opción "Estilo de página" y el Estilo accesible.</p>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
