<?php
	$usuario = $_POST['usu'];
	$contra = $_POST['contra'];
	$recordar = $_POST['recordar'];
	$fechayhora = date("Y-m-d H:i");
	$usu1 = "usu1"; $contra1 = "contra1";
	$usu2 = "usu2"; $contra2 = "contra2";
	$usu3 = "usu3"; $contra3 = "contra3";
	$usu4 = "usu4"; $contra4 = "contra4";

	if ($usuario == $usu1 && $contra == $contra1) {
			if ($recordar == 'on') {

					if(isset($_COOKIE['usuario_recordado'])){
						setcookie("usuario_recordado", $_COOKIE['usuario_recordado'] + 1, time() - 90 * 24 * 60 * 60);
					}
					$estilo = "estilo.css";
					setcookie("usuario_recordado", $usuario . ' ' . $contra . ' ' . $fechayhora . ' ' . $estilo, time() + 90 * 24 * 60 * 60);
			}	else{
					session_start();
					unset($_SESSION['usuario_sesion']);
					$estilo = "estilo.css";
					$_SESSION['usuario_sesion'] = $usuario . ' ' . $contra . ' ' . $fechayhora . ' ' . $estilo;
			}
			header("Location: http://localhost/DAW/PHP/menu_user_logeado.php");
			exit;

	} elseif ($usuario == $usu2 && $contra == $contra2) {
				if ($recordar == 'on') {
					if(isset($_COOKIE['usuario_recordado'])){
						setcookie("usuario_recordado", $_COOKIE['usuario_recordado'] + 1, time() - 90 * 24 * 60 * 60);
					}
					$estilo = "estilo_accesible.css";
					setcookie("usuario_recordado", $usuario . ' ' . $contra . ' ' . $fechayhora . ' ' . $estilo, time() + 90 * 24 * 60 * 60);
				} else{
						session_start();
						unset($_SESSION['usuario_sesion']);
						$estilo = "estilo_accesible.css";
						$_SESSION['usuario_sesion'] = $usuario . ' ' . $contra . ' ' . $fechayhora . ' ' . $estilo;
				}
				header("Location: http://localhost/DAW/PHP/menu_user_logeado.php");
				exit;
	} elseif ($usuario == $usu3 && $contra == $contra3) {
				if ($recordar == 'on') {
					if(isset($_COOKIE['usuario_recordado'])){
						setcookie("usuario_recordado", $_COOKIE['usuario_recordado'] + 1, time() - 90 * 24 * 60 * 60);
					}
					$estilo = "estilo_clasico.css";
					setcookie("usuario_recordado", $usuario . ' ' . $contra . ' ' . $fechayhora . ' ' . $estilo, time() + 90 * 24 * 60 * 60);
				} else{
						session_start();
						unset($_SESSION['usuario_sesion']);
						$estilo = "estilo_clasico.css";
						$_SESSION['usuario_sesion'] = $usuario . ' ' . $contra . ' ' . $fechayhora . ' ' . $estilo;
				}
				header("Location: http://localhost/DAW/PHP/menu_user_logeado.php");
				exit;
	} elseif ($usuario == $usu4 && $contra == $contra4) {
				if ($recordar == 'on') {
					if(isset($_COOKIE['usuario_recordado'])){
						setcookie("usuario_recordado", $_COOKIE['usuario_recordado'] + 1, time() - 90 * 24 * 60 * 60);
					}
					$estilo = "estilo_accesible.css";
					setcookie("usuario_recordado", $usuario . ' ' . $contra . ' ' . $fechayhora . ' ' . $estilo, time() + 90 * 24 * 60 * 60);
				} else{
						session_start();
						unset($_SESSION['usuario_sesion']);
						$estilo = "estilo_accesible.css";
						$_SESSION['usuario_sesion'] = $usuario . ' ' . $contra . ' ' . $fechayhora . ' ' . $estilo;
				}
				header("Location: http://localhost/DAW/PHP/menu_user_logeado.php");
				exit;
		} else {
			header("Location: http://localhost/DAW/PHP/error_login.php");
			exit;
		}
?>
