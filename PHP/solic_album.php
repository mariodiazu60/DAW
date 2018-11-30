<?php
    include 'pre_cabecera.php';
    $_SESSION[ 'display_page2' ] = FALSE;
    $_SESSION[ 'display_page1' ] = FALSE;
    $title = "Solicitud de álbum";
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
			<form name="busqueda" class="buscador" action="res_busqueda.php" method="post">
				<input type="search" name="buscar" placeholder="Buscar">
                <input class="puntero_mano" type="submit" name="Enviar">
			</form>
		</nav>

		<section class="formularios">
			<h2>Solicita t&uacute; &aacute;lbum:</h2>

			<table style="width:40%">
				<caption>Tabla de precios para solicitar un álbum</caption>
				<details>
					<summary>Detalles de la tabla</summary>
					<p>Dependiendo del concepto escogido el precio por página varía.</p>
					<p>menos de 5 página, 0.10 euros por página, entre 5 y 10 página, 0.08 euros por página, más de once páginas, 0.07 euros por página, blanco y negro, 0 euros, color, 0.05 euros por foto, resolución mayor que 300 dpi, 0.02 euros por foto</p>
				</details>
				<tr>
					<th>Concepto</th>
					<th>Tarifa</th>
				</tr>
				<tr>
					<td> &lt; 5 p&aacute;g</td>
					<td> 0.10 € por p&aacute;g.</td>

				</tr>
				<tr>
					<td> entre 5 y 10 p&aacute;g</td>
					<td> 0.08 € por p&aacute;g.</td>
				</tr>
				<tr>
					<td> &gt; 11 p&aacute;g</td>
					<td> 0.07 € por p&aacute;g.</td>
				</tr>
				<tr>
					<td> Blanco y negro</td>
					<td> 0 €</td>
				</tr>
				<tr>
					<td> Color</td>
					<td> 0.05 € por foto</td>
				</tr>
				<tr>
					<td> Resoluci&oacute;n > 300 dpi</td>
					<td> 0.02 € por foto</td>
				</tr>
		    </table>

            <form action="res_solic_album.php" method="post">
                <label for="nomb"> Nombre(*):</label>
                <input type="text" name="nomb" id="nomb" title="M&aacute;ximo 200 caracteres." maxlength="200" required>

                <label for="tit"> T&iacute;tulo del &aacute;lbum(*):</label>
                <input type="text" name="tit" id="tit" title="M&aacute;ximo 200 caracteres." maxlength="200" required>

                <label for="dedic"> Dedicatoria o descripci&oacute;n:</label>
                <textarea rows="4" id="dedic" name="dedic" cols="50" maxlength="4000"></textarea>

                <label for="correo"> Correo del destinatario(*):</label>
                <input type="email" name="correo" id="correo" maxlength="200" required />

                <label for="direc"> Direcci&oacute;n postal(*):</label>
                <input type="text" name="direc" id="direc" placeholder="País, provincia, ciudad, calle, portal, piso y código postal" maxlength="500" required>

                <label for="colo"> Color de portada:</label>
                <input type="color" name="colo" id="colo">

                <label for="colo_foto"> Color de las fotos:</label>
                <select name="colo_foto" id="colo_foto">
                    <option value="0">Blanco y negro</option>
                    <option value="1">A todo color</option>
                </select>

                <label for="copias"> N&uacute;mero de copias(*):</label>
                <input type="number" name="copias" id="copias" value="1" min="1" required>

                <label for="imp"> &Aacute;lbum a imprimir(*):</label>
                <select name="imp" id="imp">
                    <?php
                        if(isset($_COOKIE['usuario_recordado'])){
                            $valores = explode(" ", $_COOKIE['usuario_recordado']);
                        } else{
                            $valores = explode(" ", $_SESSION['usuario_sesion']);
                        }

                        $enlace = @mysqli_connect("localhost", "root", "", "pibd");

                        if (!$enlace) {
                            echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
                            echo '</p>';
                            exit;
                        }

                        mysqli_set_charset($enlace, "utf8");
                        $sentencia = "SELECT IdAlbum, Titulo from usuarios, albumes where NomUsuario='$valores[0]' AND IdUsuario=Usuario";

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

                <label for="res"> Resoluci&oacute;n de las fotos:</label>
                <input type="number" name="res" id="res" value="150" min="150" max="900" step="150">

                <label for="fecha">Fecha de recepci&oacute;n del &aacute;lbum:</label>
                <input type="date" name="fecha" id="fecha" required>

                <input class="puntero_mano" type="submit" value="Enviar" name="Enviar">
            </form>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
