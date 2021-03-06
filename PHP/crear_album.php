<?php
    include 'pre_cabecera.php';
    $_SESSION[ 'display_page2' ] = FALSE;
    $_SESSION[ 'display_page1' ] = FALSE;
	$title = "Crear álbum";
    require_once("../Plantilla/cabecera.inc");
    require_once("../Plantilla/inicio.inc");
		if(isset($_COOKIE['usuario_recordado'])==false && isset($_SESSION['usuario_sesion'])==false){
            $_SESSION[ 'display_page1' ] = TRUE;
			header("Location: http://localhost/DAW/PHP/inicio_sesion.php");
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
		</nav>

		<section class="formularios">
			<h2>Crea t&uacute; &aacute;lbum:</h2>
            <form name='registro' action='res_crear_album.php' id='form' method='post'>
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
