﻿<?php
    include 'pre_cabecera.php';
    $_SESSION[ 'display_page2' ] = FALSE;
    $_SESSION[ 'display_page1' ] = FALSE;
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
		</nav>

		<h2 class="titulo_filtros_busq">Resultado de la b&uacute;squeda:</h2>
		<section class="filtros_busq">
            <?php
                if (isset($_POST["tit"])) { $tit = $_POST["tit"]; }
                if (isset($_POST["date1"])) { $fecha1 = $_POST["date1"]; }
                if (isset($_POST["date2"])) { $fecha2 = $_POST["date2"]; }
                if (isset($_POST["pais"])) { $pais = $_POST["pais"]; }

                if (!empty($tit)) {
                    echo "<p><b>Título: ".$tit."</b></p>";
                }
                if (!empty($fecha1)) {
                    echo "<p><b>Desde: ".$fecha1."</b></p>";
                }
                if (!empty($fecha2)) {
                    echo "<p><b>Hasta: ".$fecha2."</b></p>";
                }

                require_once("../Plantilla/bbdd.inc");

                if (!$enlace) {
                    echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
                    echo '</p>';
                    exit;
                }

                if (!empty($pais) && $pais>0) {
                    mysqli_set_charset($enlace, "utf8");
                    $sentencia = "SELECT * from paises WHERE paises.IdPais='$pais'";

                    if(!($resultado = @mysqli_query($enlace, $sentencia))) {
                        echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
                        echo '</p>';
                        exit;
                    }

                    $fila = mysqli_fetch_assoc($resultado);
                    echo "<p><b>País: ".$fila['NomPais']."</b></p>";
                    mysqli_free_result($resultado);
                }
            ?>
            <div>
                <?php
                    require_once("../Plantilla/bbdd.inc");

                    if (!$enlace) {
                        echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
                        echo '</p>';
                        exit;
                    }

                    mysqli_set_charset($enlace, "utf8");

                    if (!empty($tit) && empty($fecha1) && empty($fecha2) && (empty($pais) || $pais<=0)) {
                        $sentencia = "SELECT IdFoto, Titulo, Descripcion, Fecha, NomPais, Fichero, Alternativo from fotos, paises WHERE fotos.Titulo LIKE '%$tit%' AND fotos.Pais=paises.IdPais";
                    }

                    if (!empty($tit) && !empty($fecha1) && empty($fecha2) && (empty($pais) || $pais<=0)) {
                        $sentencia = "SELECT IdFoto, Titulo, Descripcion, Fecha, NomPais, Fichero, Alternativo from fotos, paises WHERE (fotos.Titulo LIKE '%$tit%' AND fotos.Fecha >= '$fecha1') AND fotos.Pais=paises.IdPais";
                    }

                    if (!empty($tit) && empty($fecha1) && !empty($fecha2) && (empty($pais) || $pais<=0)) {
                        $sentencia = "SELECT IdFoto, Titulo, Descripcion, Fecha, NomPais, Fichero, Alternativo from fotos, paises WHERE (fotos.Titulo LIKE '%$tit%' AND fotos.Fecha <= '$fecha2') AND fotos.Pais=paises.IdPais";
                    }

                    if (!empty($tit) && !empty($fecha1) && !empty($fecha2) && (empty($pais) || $pais<=0)) {
                        $sentencia = "SELECT IdFoto, Titulo, Descripcion, Fecha, NomPais, Fichero, Alternativo from fotos, paises WHERE (fotos.Titulo LIKE '%$tit%' AND fotos.Fecha BETWEEN '$fecha1' AND '$fecha2') AND fotos.Pais=paises.IdPais";
                    }

                    if (empty($tit) && !empty($fecha1) && !empty($fecha2) && (empty($pais) || $pais<=0)) {
                        $sentencia = "SELECT IdFoto, Titulo, Descripcion, Fecha, NomPais, Fichero, Alternativo from fotos, paises WHERE (fotos.Fecha BETWEEN '$fecha1' AND '$fecha2') AND fotos.Pais=paises.IdPais";
                    }

                    if (empty($tit) && !empty($fecha1) && !empty($fecha2) && (!empty($pais) && $pais>0)) {
                        $sentencia = "SELECT IdFoto, Titulo, Descripcion, Fecha, NomPais, Fichero, Alternativo from fotos, paises WHERE (fotos.Fecha BETWEEN '$fecha1' AND '$fecha2' AND fotos.Pais='$pais') AND fotos.Pais=paises.IdPais";
                    }

                    if (empty($tit) && !empty($fecha1) && empty($fecha2) && (empty($pais) || $pais<=0)) {
                        $sentencia = "SELECT IdFoto, Titulo, Descripcion, Fecha, NomPais, Fichero, Alternativo from fotos, paises WHERE (fotos.Fecha >= '$fecha1') AND fotos.Pais=paises.IdPais";
                    }

                    if (empty($tit) && empty($fecha1) && !empty($fecha2) && (empty($pais) || $pais<=0)) {
                        $sentencia = "SELECT IdFoto, Titulo, Descripcion, Fecha, NomPais, Fichero, Alternativo from fotos, paises WHERE (fotos.Fecha <= '$fecha2') AND fotos.Pais=paises.IdPais";
                    }

                    if (empty($tit) && empty($fecha1) && empty($fecha2) && (!empty($pais) && $pais>0)) {
                        $sentencia = "SELECT IdFoto, Titulo, Descripcion, Fecha, NomPais, Fichero, Alternativo from fotos, paises WHERE (fotos.Pais='$pais') AND fotos.Pais=paises.IdPais";
                    }

                    if (!empty($tit) && !empty($fecha1) && !empty($fecha2) && (!empty($pais) && $pais>0)) {
                        $sentencia = "SELECT IdFoto, Titulo, Descripcion, Fecha, NomPais, Fichero, Alternativo from fotos, paises WHERE (fotos.Titulo LIKE '%$tit%' AND fotos.Fecha BETWEEN '$fecha1' AND '$fecha2' AND fotos.Pais='$pais') AND fotos.Pais=paises.IdPais";
                    }

                    if (!empty($tit) && empty($fecha1) && empty($fecha2) && (!empty($pais) && $pais>0)) {
                        $sentencia = "SELECT IdFoto, Titulo, Descripcion, Fecha, NomPais, Fichero, Alternativo from fotos, paises WHERE (fotos.Titulo LIKE '%$tit%' AND fotos.Pais='$pais') AND fotos.Pais=paises.IdPais";
                    }

                    if (!empty($tit) && !empty($fecha1) && empty($fecha2) && (!empty($pais) && $pais>0)) {
                        $sentencia = "SELECT IdFoto, Titulo, Descripcion, Fecha, NomPais, Fichero, Alternativo from fotos, paises WHERE (fotos.Titulo LIKE '%$tit%' AND fotos.Fecha >= '$fecha1' AND fotos.Pais='$pais') AND fotos.Pais=paises.IdPais";
                    }

                    if (!empty($tit) && empty($fecha1) && !empty($fecha2) && (!empty($pais) && $pais>0)) {
                        $sentencia = "SELECT IdFoto, Titulo, Descripcion, Fecha, NomPais, Fichero, Alternativo from fotos, paises WHERE (fotos.Titulo LIKE '%$tit%' AND fotos.Fecha <= '$fecha2' AND fotos.Pais='$pais') AND fotos.Pais=paises.IdPais";
                    }

                    if (empty($tit) && empty($fecha1) && empty($fecha2) && (empty($pais) || $pais<=0)) {
                        $sentencia = "SELECT IdFoto, Titulo, Descripcion, Fecha, NomPais, Fichero, Alternativo from fotos, paises WHERE fotos.Pais=paises.IdPais ORDER BY FRegistro";
                    }

                    if(!($resultado = @mysqli_query($enlace, $sentencia))) {
                       echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
                       echo '</p>';
                       exit;
                    }

                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "<article>";
                        echo "<p>".$fila['Titulo']."</p>";
                        echo "<figure>";
                        echo "<a title='".$fila['Descripcion']."' href='detalle.php?id=".$fila['IdFoto']."'><img src='../Imagenes/".$fila['Fichero']."' alt='".$fila['Alternativo']."' width=100% height=100%></a>";
                        echo "</figure>";
                        echo "<footer>";
                        echo "<p>".$fila['Fecha']." | ".$fila['NomPais']."</p>";
                        echo "</footer>";
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
