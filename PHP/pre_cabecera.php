<?php
	$estilo = "estilo.css";
	session_start();
    if (isset($_COOKIE['usuario_recordado'])==true) {
        $valores = explode(" ", $_COOKIE['usuario_recordado']);
        $estilo =$valores[4];
        $fechayhora = date("Y-m-d H:i");
        setcookie("usuario_recordado", $valores[0].' '.$valores[1].' '.$fechayhora.' '.$valores[4], time() + 90 * 24 * 60 * 60);
    } elseif (isset($_SESSION['usuario_sesion'])==true) {
    	$valores = explode(" ", $_SESSION['usuario_sesion']);
        $estilo = $valores[4];
        unset($_SESSION['usuario_sesion']);
        $fechayhora = date("Y-m-d H:i");
        $_SESSION['usuario_sesion'] = $valores[0] . ' ' . $valores[1] . ' ' . $fechayhora . ' ' . $valores[4];
    }
?>