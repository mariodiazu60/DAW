<?php
    include 'pre_cabecera.php';
	$title = "Resultado solicitud álbum";
    require_once("../Plantilla/../Plantilla/cabecera.inc");
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
			<h2>&Aacute;lbum solicitado</h2>
			
			<ul>
				<?php
					$name = $_POST["nomb"];
					$tit = $_POST["tit"];
					$dedic = $_POST["dedic"];
					$correo = $_POST["correo"];
					$pais =$_POST["pais"];
					$prov = $_POST["prov"];
					$ciud = $_POST["ciud"];
					$cod = $_POST["cod"];
					$direc = $_POST["direc"];
					$colo_portada = $_POST["colo"];
					$colo_foto = $_POST["colo_foto"];
					$copias = $_POST["copias"];
					$album = $_POST["imp"];
					$res = $_POST["res"];
					$fecha = $_POST["fecha"];
					$costeres = 0;
					if ($res > 300) {
						$costeres = 0.02;
					}
					$coste = (40 * 0.07) + (80 * 0.05) + (80 * $costeres);

					echo "<li>Nombre: ".$name."</li>";
					echo "<li> Título del álbum: ".$tit."</li>";
				    if (!empty($decic)) {
				    	echo "<li> Dedicatoria o descripci&oacute;n: </li>";
				    }
					echo "<li>Correo del destinatario: ".$correo."</li>";		
					if ($pais == 0) {
						$pais = "España";
					} elseif ($pais == 1) {
						$pais = "Alemania";
					} elseif ($pais == 2) {
						$pais = "Francia";
					}
					echo "<li> Pa&iacute;s: ".$pais."</li>";
					if ($prov == 0) {
						$prov = "Álava";
					} elseif ($prov == 1) {
						$prov = "Albacete";
					} elseif ($prov == 2) {
						$prov = "Alicante";
					}
					echo "<li> Provincia/regi&oacute;n: Alicante".$prov."</li>";
					if ($ciud == 0) {
						$ciud = "Torrevieja";
					} elseif ($ciud == 1) {
						$ciud = "Elche";
					} elseif ($ciud == 2) {
						$ciud = "Alicante";
					}
					echo "<li> Ciudad: ".$ciud."</li>";
					echo "<li> C&oacute;digo postal: ".$cod."</li>";		
					echo "<li> Direcci&oacute;n postal: ".$direc."</li>";
					if (!empty($colo_portada)) {
						echo "<li> Color de portada: ".$colo_portada."</li>";
					}
					if ($colo_foto == 1) {
						$colo_foto = "A todo color";
					} else {
						$colo_foto = "Blanco y negro";
					}	
					echo "<li> Color de las fotos: ".$colo_foto."</li>";				
					echo "<li> N&uacute;mero de copias: ".$copias."</li>";
					if ($album == 0) {
						$album = "Vacaciones 2017";
					} elseif ($album == 1) {
						$album = "Vacaciones 2018";
					} elseif ($album == 2) {
						$album = "Mejores momentos";
					}
					echo "<li> &Aacute;lbum a imprimir: ".$album."</li>";				
					echo "<li> Resoluci&oacute;n de las fotos: ".$res." DPI</li>";
					if (!empty($fecha)) {
						echo "<li>Fecha de recepción del álbum: ".$fecha."</li>";
					}

					echo "</ul>";
				echo "<h3>Coste total del producto: ".$coste."€</h3>";
			?>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>