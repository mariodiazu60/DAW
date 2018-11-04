<?php
    $title = "Resultado búsqueda";
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

		<h2 class="titulo_filtros_busq">Resultado de la b&uacute;squeda:</h2>
		<section class="filtros_busq">
            <?php
                if (isset($_POST["buscar"])) { $busc = $_POST["buscar"]; }
                if (isset($_POST["tit"])) { $tit = $_POST["tit"]; }
                if (isset($_POST["date1"])) { $fecha1 = $_POST["date1"]; }
                if (isset($_POST["date2"])) { $fecha2 = $_POST["date2"]; }
                if (isset($_POST["pais"])) { $pais = $_POST["pais"]; }

                if (!empty($busc)) {
                    echo "<p><b>Buscado: ".$busc."</b></p>";
                }
                if (!empty($tit)) {
                    echo "<p><b>Título: ".$tit."</b></p>";
                }
                if (!empty($fecha1)) {
                    echo "<p><b>Desde: ".$fecha1."</b></p>";
                }
                if (!empty($fecha2)) {
                    echo "<p><b>Hasta: ".$fecha2."</b></p>";
                }
                if (!empty($pais)) {
                    if ($pais == 1) {
                        $pais = "España";
                    } elseif ($pais == 2) {
                        $pais = "Francia";
                    } elseif ($pais == 3) {
                        $pais = "Alemania";
                    }
                    echo "<p><b>País: ".$pais."</b></p>";
                }
            ?>
            <div>
                <article>
                    <p>T&iacute;tulo de la foto</p>
                    <figure>
                        <a title="Imagen temporal" href="detalle.php?id=1"><img src="../Imagenes/camaleon2.jpg" alt="Imagen temporal" width=100% height=100%></a>
                    </figure>
                    <footer>
                        <p>Fecha | Pa&iacute;s</p>
                    </footer>
                </article>

                <article>
                    <p>T&iacute;tulo de la foto</p>
                    <figure>
                        <a title="Imagen temporal" href="detalle.php?id=2"><img src="../Imagenes/camaleon2.jpg" alt="Imagen temporal" width=100% height=100%></a>
                    </figure>
                    <footer>
                        <p>Fecha | Pa&iacute;s</p>
                    </footer>
                </article>

                <article>
                    <p>T&iacute;tulo de la foto</p>
                    <figure>
                        <a title="Imagen temporal" href="detalle.php?id=3"><img src="../Imagenes/camaleon2.jpg" alt="Imagen temporal" width=100% height=100%></a>
                    </figure>
                    <footer>
                        <p>Fecha | Pa&iacute;s</p>
                    </footer>
                </article>

                <article>
                    <p>T&iacute;tulo de la foto</p>
                    <figure>
                        <a title="Imagen temporal" href="detalle.php?id=4"><img src="../Imagenes/camaleon2.jpg" alt="Imagen temporal" width=100% height=100%></a>
                    </figure>
                    <footer>
                        <p>Fecha | Pa&iacute;s</p>
                    </footer>
                </article>

                <article>
                    <p>T&iacute;tulo de la foto</p>
                    <figure>
                        <a title="Imagen temporal" href="detalle.php?id=5"><img src="../Imagenes/camaleon2.jpg" alt="Imagen temporal" width=100% height=100%></a>
                    </figure>
                    <footer>
                        <p>Fecha | Pa&iacute;s</p>
                    </footer>
                </article>

                <article>
                    <p>T&iacute;tulo de la foto</p>
                    <figure>
                        <a title="Imagen temporal" href="detalle.php?id=6"><img src="../Imagenes/camaleon2.jpg" alt="Imagen temporal" width=100% height=100%></a>
                    </figure>
                    <footer>
                        <p>Fecha | Pa&iacute;s</p>
                    </footer>
                </article>
            </div>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
