<?php
	$title = "Detalle de foto";
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

		<section class="detalle">
			<h2>Detalles de la foto:</h2>

			<article>
				<figure>
					<img src="../Imagenes/camaleon2.jpg" alt="Imagen temporal" width="250" height="250">
				</figure>
				<ul>
					<?php
						$id = $_GET["id"];

						if (($id%2)==0) {
							echo "<li>Usuario: Pepito Pérez</li>";
							echo "<li>Título: Camaleón</li>";
							echo "<li>Álbum: Animales</li>";
							echo "<li>Fecha: <time datetime=\"2018-09-24\">24/09/2018</time></li>";
							echo "<li>País: España</li>";
						} else {
							echo "<li>Usuario: Manolo Lama</li>";
							echo "<li>Título: Lagarto cabreado</li>";
							echo "<li>Álbum: Reptiles</li>";
							echo "<li>Fecha: <time datetime=\"2018-10-21\">21/10/2018</time></li>";
							echo "<li>País: Francia</li>";
						}
					?>
				</ul>
			</article>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
