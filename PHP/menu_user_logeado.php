<?php
	$title = "Menú de usuario";
    require_once("../Plantilla/cabecera.inc");
    require_once("../Plantilla/inicio.inc");
		session_start();
		if(isset($_COOKIE['usuario_recordado'])==false && isset($_SESSION['usuario_sesion'])==false){
			header("Location: http://localhost/DAW/PHP/index.php");
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
				 		$nombre_cookie = explode(" ", $_COOKIE['usuario_recordado']);
						echo $nombre_cookie[0];
			 } else{
						 $nombre_sesion = explode(" ", $_SESSION['usuario_sesion']);
						 echo $nombre_sesion[0];
			 } ?>

			<h2>Men&uacute; de cuenta:</h2>
			<ul>
				<li><a href="">Modificar mis datos</a></li>
				<li><a href="">Mis &aacute;lbumes</a></li>
				<li><a href="crear_album.php">Crear &aacute;lbum</a></li>
				<li><a href="solic_album.php">Solicitar &aacute;lbum</a></li>
				<li><a href="">Darme de baja</a></li>
				<li><a href="control_salida.php">Cerrar sesión</a></li>
			</ul>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
