<?php
	session_start();
    if (isset($_COOKIE['usuario_recordado'])==true) {
        $valores = explode(" ", $_COOKIE['usuario_recordado']);
        $fechayhora = date("Y-m-d H:i");
        setcookie("usuario_recordado", $valores[0].' '.$valores[1].' '.$fechayhora.' '.$valores[4], time() + 90 * 24 * 60 * 60);
    } elseif (isset($_SESSION['usuario_sesion'])==true) {
    	$valores = explode(" ", $_SESSION['usuario_sesion']);
        unset($_SESSION['usuario_sesion']);
        $fechayhora = date("Y-m-d H:i");
        $_SESSION['usuario_sesion'] = $valores[0] . ' ' . $valores[1] . ' ' . $fechayhora . ' ' . $valores[4];
    }

	$title = "Inicio";
    include 'selector_css.php';
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

		<section>
            <div>
                <article>
                    <p><a class="enlace" href=""> Autor</a></p>
                    <figure>
                        <a title="Imagen temporal" href="detalle.php?id=1"><img src="../Imagenes/camaleon2.jpg" alt="Imagen temporal" width=100% height=100%></a>
                    </figure>
                </article>
                <article>
                    <p><a class="enlace" href=""> Autor</a></p>
                    <figure>
                        <a title="Imagen temporal" href="detalle.php?id=2"><img src="../Imagenes/camaleon2.jpg" alt="Imagen temporal" width=100% height=100%></a>
                    </figure>
                </article>

                <article>
                    <p><a class="enlace" href=""> Autor</a></p>
                    <figure>
                        <a title="Imagen temporal" href="detalle.php?id=3"><img src="../Imagenes/camaleon2.jpg" alt="Imagen temporal" width=100% height=100%></a>
                    </figure>
                </article>

                <article>
                    <p><a class="enlace" href=""> Autor</a></p>
                    <figure>
                        <a title="Imagen temporal" href="detalle.php?id=4"><img src="../Imagenes/camaleon2.jpg" alt="Imagen temporal" width=100% height=100%></a>
                    </figure>
                </article>
                <article>
                    <p><a class="enlace" href=""> Autor</a></p>
                    <figure>
                        <a title="Imagen temporal" href="detalle.php?id=5"><img src="../Imagenes/camaleon2.jpg" alt="Imagen temporal" width=100% height=100%></a>
                    </figure>
                </article>
            </div>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>