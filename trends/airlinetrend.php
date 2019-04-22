<?php

	//Inicio del procesamiento
	require_once("../includes/config.php");
	require_once("../includes/aplicacion.php");

	//Conexión base de datos
	$app = Aplicacion::getInstance();
	$conn = $app->conexionBD();
	//Coge 10 elementos de la tabla "ticket" ordenado por la cantidad de billetes que tiene un usuario, de mayor a menor
	$query = sprintf("SELECT DISTINCT airline_acr, count(travel_id) as total
						FROM available_trip 
						GROUP BY airline_acr 
						ORDER BY count(travel_id) 
						DESC LIMIT 10");
	$rs = $conn->query($query);

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../assets/css/estilo.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Aerolíneas populares</title>
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
					<h1>AEROLÍNEAS CON MÁS VIAJES</h1>
						<p>En este ránking están ordenados las aerolíneas con más viajes disponibles.</p>
						<!-- Inicio de la tabla que mostrará los usuarios y el número de viajes -->
						<table>
							<thead>
								<tr>
									<th>Aerolínea</th>
									<th>Número de viajes</th>
								</tr>
							</thead>

							<tbody>
								<?php 
									//Bucle que mostrará los 10 usuarios con más viajes
									while($ranking = $rs->fetch_assoc()){
								?>
								<tr>
									<?php
										//Conexión con la base de datos
										$app = Aplicacion::getInstance();
										$conn = $app->conexionBD();

										//Selecciona el nombre del usuario
										$select = sprintf("SELECT *
														FROM airline
														WHERE airline_acr = '%s'",
													$conn->real_escape_string($ranking['airline_acr']));
										$usuario = $conn->query($select);
										$nombre = $usuario->fetch_assoc();
									?>
									<td align="center"><?php echo $nombre['name']; ?></td>
									<td align="center"><?php echo $ranking['total']; ?></td>
								</tr>
								<?php
									} //Cierre del while
								?>
							</tbody>
						</table> <!-- Fin de la tabla -->
				</div> <!-- Cierre div class = "main" -->
			</div> <!-- Cierre div class = "principal" -->
			<?php
				require("../includes/comun/pie.php");
			?>
		</div> <!-- Cierre div class = "contenedor" -->
	</body>
</html>