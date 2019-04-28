<?php

	//Inicio del procesamiento
	require_once("includes/config.php");
	require_once("includes/aplicacion.php");

	//Conexión base de datos
	$app = Aplicacion::getInstance();
	$conn = $app->conexionBD();

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../assets/css/estilo.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Perfil</title>
	</head>

	<body>
		<div id="contenedor">
			<?php
				require("includes/comun/cabecera.php");
			?>
			<div class="principal">
				<?php
					require("includes/comun/sidebarIzq.php");
				?>
				<div class="main">
					<!-- Títlo de la página -->
					<h2 align="center">PERFIL</h2>
					<!-- Muestra el nombre del usuario -->
					<a>Nombre de usuario: 
						<?php
							 echo $_SESSION['nombre']; 
						?>						
					</a>
					<?php
						//Si es piloto entrará al is para mostrar la aerolínea a la que pertenece
						if($_SESSION['esPiloto']){
							//Selecciona el nombre de la aerolínea a la que pertenece el usuario (piloto)
							$query=sprintf("SELECT a.name
											FROM airline a
											JOIN pilot p
											WHERE p.belongs_airline = a.airline_acr
											AND p.user_id = '%d'",
										$conn->real_escape_string($_SESSION['ID']));
							$rs = $conn->query($query);
							$airline = $rs->fetch_assoc();
					?>
							<!-- Muestra el nombre de la aerolíonea a la que peretenece -->
							<a>Aerolínea a la que pertenece: 
								<?php 
									echo $airline['name']; 
								?>
							</a>
					<?php
						} //Cierre if($_SESSION['esPiloto'])
						//Selecciona el id del usuario y la suma de todos los billetes comprados por él
						$query = sprintf("SELECT user_id, count(ava_trip_id) as total
											FROM ticket 
											WHERE user_id = '%d'
											GROUP BY user_id",
									$conn->real_escape_string($_SESSION['ID']));
						$rs = $conn->query($query);
						$totalviajes = $rs->fetch_assoc();
					?>
					<!-- Muestra el número de viajes pendientes que tiene el usuario -->
					<a>Viajes pendientes: 
						<?php 
							echo $totalviajes['total']; 
						?>
					</a>
					<?php
						//Solo si el usuario tiene algún viaje pendiente entrará en el if
						if($totalviajes > 0){
							//Selecciona el precio, el aeropuerto origen, el aeropuerto destino y la aerolinea
							//de los viajes que tiene pendientes el usuario
							$query = sprintf("SELECT a.price, a.acr_ori, a.acr_dst, a.airline_acr
												FROM available_trip a
												JOIN ticket t
												WHERE a.travel_id = t.ava_trip_id
												AND t.user_id = '%d'",
										$conn->real_escape_string($_SESSION['ID']));
							$rs = $conn->query($query);
						} //Cierre if($totalviajes > 0)
					?>
					<!-- Tabla que mostrará todos los viajes pendientes del usuario -->
					<table>
						<thead>
							<tr>
								<!-- Nombre de todas las columnas de la tabla --> 
								<th>Aeropuerto Origen</th>
								<th>Aeropuerto Destino</th>
								<th>Precio</th>
								<th>Aerolínea</th>
								<!-- Salto de línea -->
								<br>
							</tr>
						</thead>
						<tbody>
							<?php 
								//bucle que va a mostrar todos los viajes pendientes
								while($row = $rs->fetch_assoc()){
							?>
									<tr>
										<?php
											//Conexión con la base de datos
											$app = Aplicacion::getInstance();
											$conn = $app->conexionBD();

											//Selecciona el nombre del aeropuerto origen
											$select = sprintf("SELECT * 
																FROM airport
																WHERE acronym = '%s'",
														$conn->real_escape_string($row['acr_ori']));
											$aeropuerto = $conn->query($select);
											$nombre = $aeropuerto->fetch_assoc();
										?>
										<!-- Muestra el nombre del aeropuerto origen -->
										<td>
											<?php 
												echo $nombre['name']; 
											?>
										</td>
										<?php
											//Conexión con la base de datos
											$app = Aplicacion::getInstance();
											$conn = $app->conexionBD();

											//Selecciona el nombre del aeropuerto destino
											$select = sprintf("SELECT * 
																FROM airport
																WHERE acronym = '%s'",
														$conn->real_escape_string($row['acr_dst']));
											$aeropuerto = $conn->query($select);
											$destino = $aeropuerto->fetch_assoc();
										?>
										<!-- Muestra el nombre del aeropuerto destino -->
										<td>
											<?php 
												echo $destino['name']; 
											?>												
										</td>
										<!-- Muestra el precio de cada viaje -->
										<td>
											<?php 
												echo $row['price'];
											?>										 	
										</td>
										<?php
											//Conexión con la base de datos
											$app = Aplicacion::getInstance();
											$conn = $app->conexionBD();

											//Selecciona el nombre de la aerolínea
											$select = sprintf("SELECT * 
																FROM airline
																WHERE airline_acr = '%s'",
														$conn->real_escape_string($row['airline_acr']));
											$aeropuerto = $conn->query($select);
											$airline = $aeropuerto->fetch_assoc();
										?>
										<!-- Muestra el nombre de la aerolínea -->
										<td>
											<?php 
												echo $airline['name']; 
											?>												
										</td>
										<!-- Salto de línea -->
										<br>
									</tr>
							<?php
								} //Cierre while($row = $rs->fetch_assoc())
							?>
						</tbody>
					</table>	
				</div> <!-- Cierre div class="main" -->		
			</div> <!-- Cierre div class="principal" -->
			<?php
				require("includes/comun/pie.php");
			?>
		</div> <!-- Cierre div class="contenedor" -->
	</body>
</html>