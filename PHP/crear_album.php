<?php
	$title = "Crear álbum";
    require_once("../Plantilla/cabecera.inc");
    require_once("../Plantilla/inicio.inc");
?>
		<nav>
			<ul>
				<li><a href="index.php">Inicio</a></li>
				<li><a href="busqueda.php">B&uacute;squeda</a></li>
			</ul>
			<form name="busqueda" class="buscador" action="res_busqueda.php" method="post">
				<input type="search" name="buscar" placeholder="Buscar">
                <input class="puntero_mano" type="submit" name="Enviar">
			</form>
		</nav>

		<section class="formularios">
			<h2>Crea t&uacute; &aacute;lbum:</h2>
            <form action="">
                <label for="nomb"> Título:</label>
                <input type="text" name="tit" id="nomb" title="M&aacute;ximo 200 caracteres." maxlength="200" required>

                <label for="dedic"> Descripción:</label>
                <textarea rows="4" id="dedic" name="desc" cols="50" maxlength="4000" required></textarea>

                <input class="puntero_mano" type="submit" value="Enviar" name="Enviar">
            </form>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
