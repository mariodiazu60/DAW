<?php
	session_start();
	$tit = $_POST['tit'];
	$desc = $_POST['desc'];

	if (isset($_COOKIE['usuario_recordado'])==true) {
	    $valores = explode(" ", $_COOKIE['usuario_recordado']);
	} elseif (isset($_SESSION['usuario_sesion'])==true) {
	    $valores = explode(" ", $_SESSION['usuario_sesion']);
	}

	require_once("../Plantilla/bbdd.inc");

	if (!$enlace) {
	    echo '<p>Error al conectar con la base de datos: ' . mysqli_connect_error();
	    echo '</p>';
	    exit;
	}

	mysqli_set_charset($enlace, "utf8");
	$sentencia = "SELECT * FROM usuarios WHERE NomUsuario='$valores[0]'";

	if(!($resultado = @mysqli_query($enlace, $sentencia))) {
	    echo "<p>Error al ejecutar la sentencia <b>$sentencia</b>: " . mysqli_error($enlace);
	    echo '</p>';
	    exit;
	}

	$fila = mysqli_fetch_assoc($resultado);
	$id = $fila['IdUsuario'];

	mysqli_free_result($resultado);

	$sentencia = "INSERT INTO albumes (IdAlbum, Titulo, Descripcion, Usuario) VALUES (null, '$tit', '$desc', $id)";

	if(!mysqli_query($enlace, $sentencia)) 
		die("Error: no se pudo realizar la inserción");

	mysqli_close($enlace);

	header("Location: http://localhost/DAW/PHP/foto_album.php");
?>
