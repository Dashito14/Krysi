<?php

//Inicio del procesamiento
require_once("../includes/config.php");
require_once("../includes/aplicacion.php");
	
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../assets/css/estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Eliminar</title>
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
			<?php
		echo "<a href='countrydelete.php' class='sidebar'>País</a>";
		echo "<a href='citydelete.php' class='sidebar'>Ciudad</a>";
		echo "<a href='airportdelete.php' class='sidebar'>Aeropuerto</a>";
		
		?>
		</div>

</div>
	

<?php
	require("../includes/comun/pie.php");
?>


</div>

</body>