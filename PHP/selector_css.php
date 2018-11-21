<?php
	$estilo = "";

	if (!isset($_COOKIE['usuario_recordado'])) {
		$estilo = "../Estilo/estilo.css";
	} else {
		$valores = explode(" ", $_COOKIE['usuario_recordado']);
		$estilo = $valores[4];
	}

	if (!isset($_SESSION['usuario_sesion'])) {
		$estilo = "../Estilo/estilo.css";
	} else {
		$valores = explode(" ", $_SESSION['usuario_sesion']);
		$estilo = $valores[4];
	}
?>