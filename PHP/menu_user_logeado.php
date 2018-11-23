<?php
    include 'pre_cabecera.php';
    $_SESSION[ 'display_page2' ] = FALSE;
	$_SESSION[ 'display_page1' ] = FALSE;
	$title = "Menú de usuario";
    require_once("../Plantilla/cabecera.inc");
    require_once("../Plantilla/inicio.inc");
	if(isset($_COOKIE['usuario_recordado'])==false && isset($_SESSION['usuario_sesion'])==false){
		$_SESSION[ 'display_page1' ] = TRUE;
		header("Location: http://localhost/DAW/PHP/inicio_sesion.php");
	}
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
			<?php
				if(isset($_COOKIE['usuario_recordado'])){
					$valores = explode(" ", $_COOKIE['usuario_recordado']);
					echo "<h3> ¡Hola ".$valores[0].", su última visita fue el ".$valores[2]." a las ".$valores[3]."! </h3>";
				} else{
					$valores = explode(" ", $_SESSION['usuario_sesion']);
					echo "<h3> ¡Hola ".$valores[0].", su última visita fue el ".$valores[2]." a las ".$valores[3]."! </h3>";
				}	
			?>

			<h2>Men&uacute; de cuenta:</h2>
			<ul>
				<li><a href="datos.php">Modificar mis datos</a></li>
				<li><a href="albumes.php">Mis &aacute;lbumes</a></li>
				<li><a href="crear_album.php">Crear &aacute;lbum</a></li>
				<li><a href="foto_album.php">Añadir un foto a un álbum</a></li>
				<li><a href="solic_album.php">Solicitar &aacute;lbum</a></li>
				<li><a href="configurar.php">Cambiar estilo de la página</a></li>
				<li><a href="">Darme de baja</a></li>
				<li><a href="control_salida.php">Cerrar sesión</a></li>
			</ul>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
