<?php

	//Inicio del procesamiento
	require_once("../includes/config.php");
	require_once("../includes/aplicacion.php");

	//Conexión base de datos
	$app = Aplicacion::getInstance();
	$conn = $app->conexionBD();

	
									//Elimina de la tabla ciudad la fila seleccionada con el POST ($ciudad)
									//Método implementado con DELETE ON CASCADE en el archivo "krysi.sql"
									$select = sprintf("DELETE FROM available_trip WHERE travel_id = '%d'",
									$conn->real_escape_string($_GET['id']));
									$conn = $conn->query($select);		
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../assets/css/estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Buscar viaje</title>
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
	<h1>SE HA ELIMINADO EL VIAJE</h1>
	<a href="../search.php">Volver a viajes disponibles</a>
				</div>
		</div>

	</div>

<?php
	require("../includes/comun/pie.php");
?>


</div>

</body>