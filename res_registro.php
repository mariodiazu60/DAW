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
				<li><a href="registro.html">Registro</a></li>
			</ul>
			<form name="busqueda" class="buscador" action="res_busqueda.php">
				<input type="search" placeholder="Buscar">
                <input class="puntero_mano" type="submit" name="Enviar">
			</form>
		</nav>

		<section class="menu_user_logeado">
			<h2>Resultado del resgistro:</h2>
			
			<ul>
				<?php
					$usu = $_POST["usu"];
					$contra = $_POST["contra"];
					$contra1 = $_POST["contra1"];
					$correo = $_POST["correo"];
					$sexo = $_POST["sex"];
					$fnac = $_POST["fecha"];
					$pais = $_POST["pais"];
					$city = $_POST["ciud"];

					if ($contra == $contra1) {
						echo "<li>Nombre de usuario: ".$usu."</li>";
						echo "<li>Contraseña: ".$contra."</li>";
						echo "<li>Correo electrónico: ".$correo."</li>";

						if (isset($sexo)) {
							if ($sexo == 0) {
								$sexo = "Mujer";
							} elseif ($sexo == 1) {
								$sexo = "Hombre";
							} elseif ($sexo == 2) {
								$sexo = "Otro";
							} elseif ($sexo == 3) {
								$sexo = "Prefiero no decirlo";
							}
							echo "<li>Sexo: ".$sexo."</li>";
						}
						if (isset($fnac)) {
							echo "<li>Fecha de nacimiento: ".$fnac."</li>";
						}
						if (isset($pais)) {
							if ($pais == 0) {
								$pais = "España";
							} elseif ($pais == 1) {
								$pais = "Francia";
							} elseif ($pais == 2) {
								$pais = "Alemania";
							}
							echo "<li>País de residencia: ".$pais."</li>";
						}
						if (isset($city)) {
							if ($city == 0) {
								$city = "Álava";
							} elseif ($city == 1) {
								$city = "Albacete";
							} elseif ($city == 2) {
								$city = "Alicante";
							}
							echo "<li>Ciudad: ".$city."</li>";
						}
					} else {
						echo "<p>Las contraseñas introducidas no coinciden, por favor vuelve a intentarlo</p>";
					}
				?>
			</ul>
		</section>

		<footer>
			<p>Mario D&iacute;az-Ufano Nuevo / Antonio Hern&aacute;ndez Velasco | DAW / Ingenier&iacute;a Multimedia / UA | <span>&copy;</span><time datetime="2018">2018</time><a href="declaracion_accesibilidad.html">Accesibilidad</a><a class="enlace" href="#header">Ir arriba</a></p>
		</footer>
	</body>
</html>