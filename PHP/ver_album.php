<?php
    include 'pre_cabecera.php';
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

		<?php
			$id = $_GET["id"];

			$enlace = @mysqli_connect("localhost", "root", "", "pibd");

            if (!$enlace) {
            	echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error(); 
                echo '</p>'; 
                exit;
            }

            $sentencia = "SELECT albumes.Titulo as ATitulo, albumes.Descripcion as ADescripcion, MAX(Fecha) as MaxFecha, MIN(Fecha) as MinFecha from albumes, fotos WHERE IdAlbum='$id' AND IdAlbum=Album";

            if(!($resultado = @mysqli_query($enlace, $sentencia))) { 
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace); 
                echo '</p>';
                exit; 
            }

			$fila = mysqli_fetch_assoc($resultado);
			echo "<h2 class='titulo_filtros_busq'>".$fila['ATitulo'].":</h2>";

			echo "<section class='filtros_busq'>";

			echo "<p><b>".$fila['ADescripcion']."</b></p>";
            echo "<p><b>Desde: ".$fila['MaxFecha']."</b></p>";
            echo "<p><b>Hasta: ".$fila['MinFecha']."</b></p>";

            mysqli_free_result($resultado);
            mysqli_close($enlace);

            $enlace = @mysqli_connect("localhost", "root", "", "pibd");

            if (!$enlace) {
                echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error(); 
                echo '</p>'; 
                exit;
            }             

            $sentencia = "SELECT NomPais from paises, albumes, fotos WHERE IdAlbum='$id' AND IdAlbum=Album AND paises.IdPais=Pais";

            if(!($resultado = @mysqli_query($enlace, $sentencia))) { 
                echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace); 
                echo '</p>';
                exit; 
            }

            echo "<p><b>Pais/es: </b></p>";
            echo "<ul>";

            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<li><b>".$fila['NomPais']."</b></li>";
            }

            echo "</ul>";

            mysqli_free_result($resultado);
            mysqli_close($enlace); 
        ?>
            <div>
                <?php
                    $enlace = @mysqli_connect("localhost", "root", "", "pibd");

                    if (!$enlace) {
                        echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error(); 
                        echo '</p>'; 
                        exit;
                    }

                    $sentencia = "SELECT IdFoto, fotos.Titulo as ATitulo, fotos.Descripcion as ADescripcion, Fichero, Alternativo from fotos, albumes WHERE IdAlbum='$id' AND IdAlbum=Album";

                    if(!($resultado = @mysqli_query($enlace, $sentencia))) { 
                       echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace); 
                       echo '</p>';
                       exit; 
                    }

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<article>";
                        echo "<p>".$fila['ATitulo']."</p>";
                        echo "<figure>";
                        echo "<a title='".$fila['ADescripcion']."' href='detalle.php?id=".$fila['IdFoto']."'><img src='../Imagenes/".$fila['Fichero']."' alt='".$fila['Alternativo']."' width=100% height=100%></a>";
                        echo "</figure>";
                        echo "</article>";
                    }

                    mysqli_free_result($resultado);
                    mysqli_close($enlace);
                ?>
            </div>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>