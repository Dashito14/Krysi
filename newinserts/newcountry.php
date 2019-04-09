<?php

//Inicio del procesamiento
require_once("../includes/config.php");
require_once("../includes/aplicacion.php");

	if(!empty($_POST)){
		$nombre= $_POST['nombre'];

		if(!empty($nombre)){
			$app = Aplicacion::getInstance();
			$conn = $app->conexionBD();

			$query = sprintf("INSERT INTO country(name) VALUES ('%s')", 
					$conn->real_escape_string($nombre));
			$conn = $conn->query($query);
		}
	}
	
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
			<h1>Insertar nuevo país</h1>			
				<form class="insertar" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">

				<b>Nombre del país: </b><input type="text" class="campo" name="nombre" />
				<input type="submit" id="enviar" name="enviar" value="Insertar" />
				<br>

				<b>Para volver a introducir ciudad <a href="newcity.php">pulsa aquí</a></b>
				
		
		</div>

	</div>

<?php
	require("../includes/comun/pie.php");
?>


</div>

</body>
</html>