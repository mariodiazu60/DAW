<?php
    $estilo = "estilo.css";
	session_start();
    if (isset($_COOKIE['usuario_recordado'])==true) {
        $valores = explode(" ", $_COOKIE['usuario_recordado']);
        $usu = $valores[5];
        require_once("../Plantilla/bbdd.inc");

        if (!$enlace) {
            echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
            echo '</p>';
            exit;
        }
        mysqli_set_charset($enlace, "utf8");
        $sentencia = "SELECT * from usuarios, estilos WHERE IdUsuario='$usu' AND Estilo=IdEstilo";

        if(!($resultado = @mysqli_query($enlace, $sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
            echo '</p>';
            exit;
        }
        $fila = mysqli_fetch_assoc($resultado);
        $fechayhora = date("Y-m-d H:i");
        $usu = $fila['NomUsuario'];
        $contra = $fila['Clave'];
        $estilo = $fila['Fichero'];
        setcookie("usuario_recordado", $usu.' '.$contra.' '.$fechayhora.' '.$estilo.' '.$fila['IdUsuario'], time() + 90 * 24 * 60 * 60);
    } elseif (isset($_SESSION['usuario_sesion'])==true) {
    	$valores = explode(" ", $_SESSION['usuario_sesion']);
        $usu = $valores[5];
        require_once("../Plantilla/bbdd.inc");

        if (!$enlace) {
            echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
            echo '</p>';
            exit;
        }
        mysqli_set_charset($enlace, "utf8");
        $sentencia = "SELECT * from usuarios, estilos WHERE IdUsuario='$usu' AND Estilo=IdEstilo";

        if(!($resultado = @mysqli_query($enlace, $sentencia))) {
            echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
            echo '</p>';
            exit;
        }
        $fila = mysqli_fetch_assoc($resultado);
        $fechayhora = date("Y-m-d H:i");
        $usu = $fila['NomUsuario'];
        $contra = $fila['Clave'];
        $estilo = $fila['Fichero'];
        $_SESSION['usuario_sesion'] = $usu.' '.$contra.' '.$fechayhora.' '.$estilo.' '.$fila['IdUsuario'];
    }
?>