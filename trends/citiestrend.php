<?php

	//Inicio del procesamiento
	require_once("../includes/config.php");
	require_once("../includes/aplicacion.php");

	//Conexión base de datos
	$app = Aplicacion::getInstance();
	$conn = $app->conexionBD();
	//Coge 10 elementos de la tabla "airport" ordenado por la cantidad de aeropuertos que tiene una ciudad, de mayor a menor
	$query = sprintf("SELECT DISTINCT city_id, count(acronym) as total
						FROM airport 
						GROUP BY city_id 
						ORDER BY count(acronym) 
						DESC LIMIT 10");
	$rs = $conn->query($query);

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../assets/css/estilo.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Ciudades populares</title>
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
					<h1>CIUDADES CON MÁS AEROPUERTOS</h1>
						<p>En este ránking están ordenados las ciudades con más aeropuertos.</p>
						<!-- Inicio de la tabla que mostrará las ciudades y el número de aeropuertos -->
						<table>
							<thead>
								<tr>
									<th>Ciudad</th>
									<th>Número de aeropuertos</th>
								</tr>
							</thead>

							<tbody>
								<?php 
									//Bucle que mostrará las 10 ciudades con más aeropuertos
									while($ranking = $rs->fetch_assoc()){
								?>
										<tr>
											<?php
												//Conexión con la base de datos
												$app = Aplicacion::getInstance();
												$conn = $app->conexionBD();

												//Selecciona el nombre de la ciudad
												$select = sprintf("SELECT *
																FROM city
																WHERE city_id = '%d'",
															$conn->real_escape_string($ranking['city_id']));
												$usuario = $conn->query($select);
												$nombre = $usuario->fetch_assoc();
											?>
											<!-- Muestra el nombre de la ciudad -->
											<td align="center">
												<?php 
													echo $nombre['name']; 
												?>													
											</td>
											<!-- Muestra el número de aeropuertos que tiene -->
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