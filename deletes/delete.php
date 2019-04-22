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
		<title>Eliminar datos</title>
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
						//Menú que muestra por pantalla las opciones que podemos elegir para eliminar de la base de datos
						echo "<a href='countrydelete.php' class='sidebar'>País</a>";
						echo "<a href='citydelete.php' class='sidebar'>Ciudad</a>";
						echo "<a href='airportdelete.php' class='sidebar'>Aeropuerto</a>";
					?>
				</div> <!-- Cierre div class= "main" -->
			</div> <!-- Cierre div class= "principal" -->
			<?php
				require("../includes/comun/pie.php");
			?>
		</div> <!-- Cierre div class= "contenedor" -->
	</body>
</html>