<?php
	if(isset($_COOKIE['usuario_recordado'])){
			setcookie("usuario_recordado", $_COOKIE['usuario_recordado'] + 1, time() - 90 * 24 * 60 * 60);
			header("Location: http://localhost/DAW/PHP/index.php");
	}

	session_start();
	if (isset($_SESSION['usuario_sesion'])){
		$_SESSION = array();
		session_destroy();
		header("Location: http://localhost/DAW/PHP/index.php");
	}
?>
