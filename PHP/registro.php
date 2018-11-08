<?php
    include 'pre_cabecera.php';
	$title = "Registro";
    require_once("../Plantilla/cabecera.inc");
    require_once("../Plantilla/inicio.inc");
?>
		<nav>
			<?php
                if (isset($_COOKIE['usuario_recordado'])) {
                    require_once("../Plantilla/nav_si.inc");
                } elseif (isset($_SESSION['usuario_sesion'])) {
                    require_once("../Plantilla/nav_si.inc");
                } else {
                    require_once("../Plantilla/nav_no.inc");
                }
            ?>
			<form name="busqueda" class="buscador" action="res_busqueda.php" method="post">
				<input type="search" name="buscar" placeholder="Buscar">
                <input class="puntero_mano" type="submit" name="Enviar">
			</form>
		</nav>

		<section class="formularios">
			<h2>Registro</h2>
			<form name="registro" action="res_registro.php" id="form" method="post">
			
				<label for="usu"> Nombre de usuario:</label>
				<input type="text" id="usu" name="usu" required>
					
				<label for="contra"> Contraseña:</label>
				<input type="password" id="contra" name="contra" required>
				
				<label for="contra1"> Repetir contraseña:</label>
				<input type="password" id="contra1" name="contra1" required>
				
			    <label for="correo"> Correo electr&oacute;nico:</label>
			    <input type="email" id="correo" name="correo" required>		
				
				<label for="sex"> Sexo:</label>
			    <select name="sex" id="sex">
			    	<option value="0">Elegir</option>
					<option value="1">Mujer</option>
					<option value="2">Hombre</option>
					<option value="3">Otro</option>
					<option value="4">Prefiero no decirlo</option>
				</select>
				
				<label for="fecha"> Fecha de nacimiento:</label>
				<input id="fecha" name="fecha" type="date">
				
				<label for="pais"> Pa&iacute;s de residencia:</label>
				<select name="pais" id="pais">
					<option value="0">Elegir</option>
					<option value="1">España</option>
					<option value="2">Francia</option>
					<option value="3">Alemania</option>
				</select>
				
				<label for="ciud"> Ciudad:</label>
				<select name="ciud" id="ciud">
					<option value="0">Elegir</option>
					<option value="1">Álava</option>
					<option value="2">Albacete</option>
					<option value="3">Alicante</option>
				</select>
				
				<label for="foto"> Foto de perfil:</label>
				<input id="foto" class="puntero_mano" name="foto" type="file">
				
				
				<input type="submit" class="puntero_mano" value="Enviar" name="Enviar">

			</form>		
		</section>
<?php
    require_once("../Plantilla/pie.inc");
?>