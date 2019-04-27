<?php

	//Inicio del procesamiento
	require_once("../includes/config.php");
	require_once("../includes/aplicacion.php");

	//Conexión base de datos
	$app = Aplicacion::getInstance();
	$conn = $app->conexionBD();
	//Coge 10 elementos de la tabla "available_trip" ordenado por la cantidad de viajes que tiene un aeropuerto, de mayor a menor
	$query = sprintf("SELECT DISTINCT acr_ori, count(travel_id) as total
						FROM available_trip 
						GROUP BY acr_ori 
						ORDER BY count(travel_id) 
						DESC LIMIT 10");
	$rs = $conn->query($query);

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../assets/css/estilo.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Aeropuertos populares</title>
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
					<!-- Título de la página -->
					<h1>AEROPUERTOS CON MÁS VIAJES</h1>
						<p>En este ránking están ordenados los aeropuertos con más viajes disponibles.</p>
						<!-- Inicio de la tabla que mostrará los usuarios y el número de viajes -->
						<table>
							<thead>
								<tr> 
									<!-- Nombre de las columnas -->
									<th>Aeropuerto</th>
									<th>Número de viajes</th>
								</tr>
							</thead>

							<tbody>
								<?php 
									//Bucle que mostrará los 10 aeropuertos con más viajes
									while($ranking = $rs->fetch_assoc()){
								?>
										<tr>
											<?php
												//Conexión con la base de datos
												$app = Aplicacion::getInstance();
												$conn = $app->conexionBD();

												//Selecciona el nombre del aeropuerto
												$select = sprintf("SELECT *
																FROM airport
																WHERE acronym = '%s'",
															$conn->real_escape_string($ranking['acr_ori']));
												$usuario = $conn->query($select);
												$nombre = $usuario->fetch_assoc();
											?>
											<!-- Muestra el nombre del aeropuerto -->
											<td align="center">
												<?php 
													echo $nombre['name'];
												?>												 	
											</td>
											<!-- Muestra el número de viajes disponibles de cada aeropuerto -->
											<td align="center">
												<?php 
													echo $ranking['total']; 
												?>													
											</td>
										</tr>
								<?php
									} //Cierre de while($ranking = $rs->fetch_assoc())
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