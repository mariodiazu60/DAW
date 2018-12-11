<?php
    include 'pre_cabecera.php';
    $_SESSION[ 'display_page2' ] = FALSE;
    $_SESSION[ 'display_page1' ] = FALSE;
	$title = "Añadir foto";
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
			<h2>Añade una foto a un álbum:</h2>
            <form name='registro' action='res_foto_album.php' id='form' method='post' enctype='multipart/form-data'>
                <label for="nomb"> Título:</label>
                <input type="text" name="tit" id="nomb" title="M&aacute;ximo 200 caracteres." maxlength="200" required>

                <label for="dedic"> Descripción:</label>
                <textarea rows="4" id="dedic" name="desc" cols="50" maxlength="4000" required></textarea>

                <label for="fecha"> Fecha en la que fue tomada la foto:</label>
                <input type="date" name="date" id="fecha">

                <label for="pais"> Pa&iacute;s:</label>
                <select name="pais" id="pais">
                    <?php
                        require_once("../Plantilla/bbdd.inc");

                        if (!$enlace) {
                            echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
                            echo '</p>';
                            exit;
                        }

                        mysqli_set_charset($enlace, "utf8");
                        $sentencia = "SELECT * from paises";

                        if(!($resultado = @mysqli_query($enlace, $sentencia))) {
                           echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
                           echo '</p>';
                           exit;
                        }

                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo "<option value='".$fila['IdPais']."'>".$fila['NomPais']."</option>";
                        }

                        mysqli_free_result($resultado);
                    ?>
                </select>

                <label for="foto"> Foto:</label>
                <input id="foto" class="puntero_mano" required name="foto" type="file">

                <label for="alter"> Texto alternativo:</label>
                <textarea rows="4" id="alter" name="alter" cols="50" minlength="10" maxlength="4000" required></textarea>

                <label for="album"> Álbum:</label>
                <select name="album" id="album">
                <option value="0">-Elegir-</option>
                <?php
                    if(isset($_COOKIE['usuario_recordado'])){
                        $valores = explode(" ", $_COOKIE['usuario_recordado']);
                    } else{
                        $valores = explode(" ", $_SESSION['usuario_sesion']);
                    }

                    $sentencia = "SELECT IdAlbum, Titulo, Descripcion from usuarios, albumes WHERE NomUsuario='$valores[0]' AND Usuario=IdUsuario";

                    if(!($resultado = @mysqli_query($enlace, $sentencia))) {
                       echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
                       echo '</p>';
                       exit;
                    }

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<option value='".$fila['IdAlbum']."'>".$fila['Titulo']."</option>";
                    }

                    mysqli_free_result($resultado);
                    mysqli_close($enlace);
                ?>
                </select>

                <input class="puntero_mano" type="submit" value="Enviar" name="Enviar">
            </form>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
