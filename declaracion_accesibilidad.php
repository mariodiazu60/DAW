<?php
    require_once("cabecera.inc");
    require_once("inicio.inc");
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
			<h2>Accesibilidad</h2>
			<p>Con respecto a la accesibilidad de la página cabe destacar que todas las imagenes que aparecen en ella vienen con una descripción alternativa, se ha tratado de utilizar un etiquetado lo más semántico posible. También se han utilizado combinaciones de color con alto contraste y un tamaño de letra ampliado para facilitar la lectura y visión general de la página además de un mayor tamaño en los formularios y una diferenciación a la hora de rellenar cada campo.</p>
			<p>Para activar la hoja de estilo se tiene que acceder al menú "Ver" de Mozilla Firefox, seleccionar la opción "Estilo de página" y el Estilo accesible.</p>
		</section>
<?php
    require_once("pie.inc");
?>
