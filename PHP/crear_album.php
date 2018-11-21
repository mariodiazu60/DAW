<?php
    include 'pre_cabecera.php';
	$title = "Crear álbum";
    require_once("../Plantilla/cabecera.inc");
    require_once("../Plantilla/inicio.inc");
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
