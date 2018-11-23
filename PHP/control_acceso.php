<?php
	session_start();
	$usuario = $_POST['usu'];
	$contra = $_POST['contra'];
	$recordar = $_POST['recordar'];
	$fechayhora = date("Y-m-d H:i");
	$usu1 = "usu1"; $contra1 = "contra1";
	$usu2 = "usu2"; $contra2 = "contra2";
	$usu3 = "usu3"; $contra3 = "contra3";
	$usu4 = "usu4"; $contra4 = "contra4";

	require_once("../Plantilla/bbdd.inc");

	if (!$enlace) {
	   	echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
   		echo '</p>';
   		exit;
	}
	mysqli_set_charset($enlace, "utf8");
	$sentencia = "SELECT NomUsuario, Clave, Fichero from usuarios, estilos WHERE (NomUsuario='$usuario' AND Clave='$contra') AND Estilo=IdEstilo";

	if(!($resultado = @mysqli_query($enlace, $sentencia))) {
	    echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
		echo '</p>';
	    exit;
	}

	if (mysqli_num_rows($resultado)==1) {
		$fila = mysqli_fetch_assoc($resultado);
		if ($recordar == 'on') {
			if(isset($_COOKIE['usuario_recordado'])){
				setcookie("usuario_recordado", $_COOKIE['usuario_recordado'] + 1, time() - 90 * 24 * 60 * 60);
			}
			setcookie("usuario_recordado", $usuario.' '.$contra.' '.$fechayhora.' '.$fila['Fichero'], time() + 90 * 24 * 60 * 60);
		} else {
			$estilo = "estilo.css";
			$_SESSION['usuario_sesion'] = $usuario.' '.$contra.' '.$fechayhora.' '.$fila['Fichero'];
		}
		mysqli_free_result($resultado);
		mysqli_close($enlace);
		header("Location: http://localhost/DAW/PHP/menu_user_logeado.php");
	} else {
		mysqli_free_result($resultado);
		mysqli_close($enlace);
		$_SESSION[ 'display_page2' ] = TRUE;
		$_SESSION[ 'display_page1' ] = FALSE;
		header("Location: http://localhost/DAW/PHP/inicio_sesion.php");
	}

	mysqli_free_result($resultado);
	mysqli_close($enlace);
?>
