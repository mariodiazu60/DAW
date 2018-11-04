<?php
	$title = "Inicio";
    require_once("../Plantilla/cabecera.inc");
    require_once("../Plantilla/inicio.inc");

    if (isset($_COOKIE['usuario_recordado'])) {
        $valores = explode(" ", $_COOKIE['usuario_recordado']);
        $fechayhora = date("Y-m-d H:i");
        setcookie("usuario_recordado", $valores[0].' '.$valores[1].' '.$fechayhora, time() + 90 * 24 * 60 * 60);
    }
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