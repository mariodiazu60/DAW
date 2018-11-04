<?php
	$usuario = $_POST['usu'];
	$contra = $_POST['contra'];
	$usu1 = "usu1"; $contra1 = "contra1";
	$usu2 = "usu2"; $contra2 = "contra2";
	$usu3 = "usu3"; $contra3 = "contra3";
	$usu4 = "usu4"; $contra4 = "contra4";

	if ($usuario == $usu1) {
		if ($contra = $contra1) {
			header("Location: http://localhost/DAW/menu_user_logeado.php");
			exit;
		}
	} elseif ($usuario == $usu2) {
		if ($contra == $contra2) {
			header("Location: http://localhost/DAW/menu_user_logeado.php");
			exit;
		}
	} elseif ($usuario == $usu3) {
		if ($contra == $contra3) {
			header("Location: http://localhost/DAW/menu_user_logeado.php");
			exit;
		}
	} elseif ($usuario == $usu4) {
		if ($contra == $contra4) {
			header("Location: http://localhost/DAW/menu_user_logeado.php");
			exit;
		}
	} else {
		header("Location: http://localhost/DAW/error_login.php");
		exit;
	}
?>