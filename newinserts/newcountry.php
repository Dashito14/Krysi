<?php

	//Inicio del procesamiento
	require_once("../includes/config.php");
	require_once("../includes/aplicacion.php");

	//Si el usuario no ha introducido algún dato no entrará 
	if(!empty($_POST)){
		$nombre= $_POST['nombre'];

		//Si la variable $nombre está vacía no entrará
		if(!empty($nombre)){
			//Conexión con la base de datos
			$app = Aplicacion::getInstance();
			$conn = $app->conexionBD();
			//Inserta en la tabla "country" el nombre que le hemos pasado por el método POST
			$query = sprintf("INSERT INTO country(name) 
								VALUES ('%s')", 
							$conn->real_escape_string($nombre));
			$conn = $conn->query($query);
		} //Cierre if(!empty($nombre))
	} //Cierre if(!empty($_POST))
	
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../assets/css/estilo.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Insertar país</title>
	</head>

	<body>

		<div id="contenedor">

			<?php
				require("../includes/comun/cabecera.php");
			?>

			<div class="principal">
				<?php
					require("../includes/comun/sidebarIzq.php");
				?>
				<div class="main">
					<!-- Título que se muestra en la página -->
					<h1>Insertar nuevo país</h1>
					<!-- Al pulsar en el botón se recargará la página para hacer el INSERT, por el PHP_SELF -->			
					<form class="insertar" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
						<!-- Campo para introducir el nombre del país -->
						<b>Nombre del país: </b><input type="text" class="campo" name="nombre" />
						<!-- Botón Insertar -->
						<input type="submit" id="enviar" name="enviar" value="Insertar" />
						<!-- Salto de línea -->
						<br>
						<!-- Setencia con enlace para volver a la página para insertar una ciudad -->
						<b>Para volver a introducir ciudad <a href="newcity.php">pulsa aquí</a></b>
					</form>
				</div> <!-- Cierre div class= "main" -->
			</div> <!-- Cierre div class= "principal" -->
			<?php
				require("../includes/comun/pie.php");
			?>
		</div> <!-- Cierre div class= "contenedor" -->
	</body>
</html>