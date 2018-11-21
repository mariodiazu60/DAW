<?php
	$estilo = "estilo.css";
    $usu = ""; $contra = "";
    $usu1 = "usu1"; $contra1 = "contra1";
    $usu2 = "usu2"; $contra2 = "contra2";
    $usu3 = "usu3"; $contra3 = "contra3";
    $usu4 = "usu4"; $contra4 = "contra4";
	session_start();
    if (isset($_COOKIE['usuario_recordado'])==true) {
        $valores = explode(" ", $_COOKIE['usuario_recordado']);
        $usu = $valores[0];
        $contra = $valores[1];
        if ($usu != $usu1 && $contra != $contra1) {
            if ($usu != $usu2 && $contra != $contra2) {
                if ($usu != $usu3 && $contra != $contra3) {
                    if ($usu != $usu4 && $contra != $contra4) {
                        header("Location: http://localhost/DAW/PHP/control_salida.php");
                    } else {
                        $estilo =$valores[4];
                        $fechayhora = date("Y-m-d H:i");
                        setcookie("usuario_recordado", $valores[0].' '.$valores[1].' '.$fechayhora.' '.$valores[4], time() + 90 * 24 * 60 * 60);
                    }
                } else {
                    $estilo =$valores[4];
                    $fechayhora = date("Y-m-d H:i");
                    setcookie("usuario_recordado", $valores[0].' '.$valores[1].' '.$fechayhora.' '.$valores[4], time() + 90 * 24 * 60 * 60);
                }
            } else {
                $estilo =$valores[4];
                $fechayhora = date("Y-m-d H:i");
                setcookie("usuario_recordado", $valores[0].' '.$valores[1].' '.$fechayhora.' '.$valores[4], time() + 90 * 24 * 60 * 60);
            }
        } else {
            $estilo =$valores[4];
            $fechayhora = date("Y-m-d H:i");
            setcookie("usuario_recordado", $valores[0].' '.$valores[1].' '.$fechayhora.' '.$valores[4], time() + 90 * 24 * 60 * 60);
        }
    } elseif (isset($_SESSION['usuario_sesion'])==true) {
    	$valores = explode(" ", $_SESSION['usuario_sesion']);
        $usu = $valores[0];
        $contra = $valores[1];
        if ($usu != $usu1 && $contra != $contra1) {
            if ($usu != $usu2 && $contra != $contra2) {
                if ($usu != $usu3 && $contra != $contra3) {
                    if ($usu != $usu4 && $contra != $contra4) {
                        header("Location: http://localhost/DAW/PHP/control_salida.php");
                    } else {
                        $estilo = $valores[4];
                        $fechayhora = date("Y-m-d H:i");
                        $_SESSION['usuario_sesion'] = $valores[0] . ' ' . $valores[1] . ' ' . $fechayhora . ' ' . $valores[4];
                    }
                } else {
                    $estilo = $valores[4];
                    $fechayhora = date("Y-m-d H:i");
                    $_SESSION['usuario_sesion'] = $valores[0] . ' ' . $valores[1] . ' ' . $fechayhora . ' ' . $valores[4];
                }
            } else {
                $estilo = $valores[4];
                $fechayhora = date("Y-m-d H:i");
                $_SESSION['usuario_sesion'] = $valores[0] . ' ' . $valores[1] . ' ' . $fechayhora . ' ' . $valores[4];
            }
        } else {
            $estilo = $valores[4];
            $fechayhora = date("Y-m-d H:i");
            $_SESSION['usuario_sesion'] = $valores[0] . ' ' . $valores[1] . ' ' . $fechayhora . ' ' . $valores[4];
        }
    }
?>