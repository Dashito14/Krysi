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
<title>Más Populares</title>
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
		echo "<a href='countrytrend.php' class='sidebar'>Países</a>";
		echo "<a href='airlinetrend.php' class='sidebar'>Aerolíneas</a>";
		echo "<a href='citiestrend.php' class='sidebar'>Ciudades</a>";
		echo "<a href='airporttrend.php' class='sidebar'>Aeropuertos</a>";
		echo "<a href='userstrend.php' class='sidebar'>Usuarios</a>";
		
		?>
		</div>

</div>
	

<?php
	require("../includes/comun/pie.php");
?>


</div>

</body>
</html>