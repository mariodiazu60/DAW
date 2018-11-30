<?php
    session_start();
    $id = $_GET["id"];

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
    $sentencia = "UPDATE usuarios SET Estilo='$id' WHERE NomUsuario='$usu'";

    if(!mysqli_query($enlace, $sentencia)) 
        die("Error: no se pudo realizar la actualización");

    mysqli_close($enlace);

    header("Location: http://localhost/DAW/PHP/res_configurar.php");
?>