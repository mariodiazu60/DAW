<!DOCTYPE html>
<html lang="es">
	<head >
		<meta charset="utf-8">
		<meta name = "description" content="Web de fotos">
		<title>Fotos</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" type="text/css" href="estilo.css" media="screen" title="Estilo principal">
        <link rel="stylesheet" type="text/css" href="estilo_imprimir.css" media="print">
        <link rel="alternate stylesheet" type="text/css" href="estilo_accesible.css" media="screen" title="Estilo accesible">
        <link rel="alternate stylesheet" type="text/css" href="estilo_clasico.css" media="screen" title="Estilo clásico">
	</head>


	<body>
		<header id="header">
			<figure> 
				<a title="Logotipo" href="index.html"><img src="logo.png" width="180" height="200" alt="Logotipo de la web" ></a>
			</figure>
			<h1>PI - Pictures & images</h1>
		</header>

		<nav>
			<ul>
				<li><a href="index.html">Inicio</a></li>
				<li><a href="busqueda.html">B&uacute;squeda</a></li>
			</ul>
			<form name="busqueda" class="buscador" action="res_busqueda.php">
				<input type="search" placeholder="Buscar">
                <input class="puntero_mano" type="submit" name="Enviar">
			</form>
		</nav>

		<section class="detalle">
			<h2>Detalles de la foto:</h2>

			<article>
				<figure> 
					<img src="camaleon2.jpg" alt="Imagen temporal" width="250" height="250">
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

		<footer>
			<p>Mario D&iacute;az-Ufano Nuevo / Antonio Hern&aacute;ndez Velasco | DAW / Ingenier&iacute;a Multimedia / UA | <span>&copy;</span><time datetime="2018">2018</time><a href="declaracion_accesibilidad.html">Accesibilidad</a><a class="enlace" href="#header">Ir arriba</a></p>
		</footer>
	</body>
</html>
