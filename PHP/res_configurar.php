<?php
    include 'pre_cabecera.php';
    $_SESSION[ 'display_page2' ] = FALSE;
    $_SESSION[ 'display_page1' ] = FALSE;
	$title = "Resultado selección estilo";
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

		<section class="menu_user_logeado">
            <?php
                if (isset($_COOKIE['usuario_recordado'])==true) {
                    $valores = explode(" ", $_COOKIE['usuario_recordado']);
                } elseif (isset($_SESSION['usuario_sesion'])==true) {
                    $valores = explode(" ", $_SESSION['usuario_sesion']);
                }

                $usu = $valores[0];

                require_once("../Plantilla/bbdd.inc");

                if (!$enlace) {
                    echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
                    echo '</p>';
                    exit;
                }
                mysqli_set_charset($enlace, "utf8");
                $sentencia = "SELECT * from usuarios, estilos WHERE NomUsuario='$usu' AND IdEstilo=Estilo";

                if(!($resultado = @mysqli_query($enlace, $sentencia))) {
                    echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
                    echo '</p>';
                    exit;
                }
                $fila = mysqli_fetch_assoc($resultado);

                echo "<h2>Nuevo estilo: ".$fila['Nombre']."</h2>";

    		    echo "<p>".$fila['Descripcion']."</p>";
            ?>
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>
