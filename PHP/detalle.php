<?php
    include 'pre_cabecera.php';
	$title = "Detalle de foto";
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

		<section class="detalle">
			<h2>Detalles de la foto:</h2>

			<article>
				<figure>
					<?php
						$id = $_GET["id"];

						$enlace = @mysqli_connect("localhost", "root", "", "pibd");

					    if (!$enlace) {
					    	echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error(); 
	   						echo '</p>'; 
	   						exit;
					    }

					    $sentencia = "SELECT IdFoto, fotos.Titulo as FTitulo, fotos.Descripcion as FDescripcion, Fecha, NomPais, Fichero, Alternativo, albumes.Titulo as ATitulo, NomUsuario from fotos, paises, albumes, usuarios WHERE fotos.IdFoto='$id' AND fotos.Pais=paises.IdPais AND fotos.Album=albumes.IdAlbum AND albumes.Usuario=usuarios.IdUsuario";

					    if(!($resultado = @mysqli_query($enlace, $sentencia))) { 
						   echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace); 
						   echo '</p>';
						   exit; 
						}

						$fila = mysqli_fetch_assoc($resultado);
						echo "<img title='".$fila['FDescripcion']."' src='../Imagenes/".$fila['Fichero']."' alt='".$fila['Alternativo']."' width=100% height=100%>";
					?>
				</figure>
				<ul>
					<?php
						echo "<li>Usuario: ".$fila['NomUsuario']."</li>";
						echo "<li>Título: ".$fila['FTitulo']."</li>";
						echo "<li>Álbum: ".$fila['ATitulo']."</li>";
						echo "<li>Fecha: <time>".$fila['Fecha']."</time></li>";
						echo "<li>País: ".$fila['NomPais']."</li>";

						mysqli_free_result($resultado);
			            mysqli_close($enlace);
					?>
				</ul>
			</article>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
