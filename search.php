<?php

	//Inicio del procesamiento
	require_once("includes/config.php");
	require_once("includes/aplicacion.php");

	//Conexión con la base de datos
	$app = Aplicacion::getInstance();
	$conn = $app->conexionBD();

	//Selecciona todos los elementos de la tabla "available_trip"
	$sql = "SELECT * FROM available_trip";
	$resultado = $conn->query($sql);
	
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="assets/css/estilo.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Buscar viaje</title>
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
					<!-- Clase row, título de la página -->
					<div class="row">
						<h1>Buscar nuevo viaje</h1>
					</div> <!-- Cierre div class = row -->
					<?php
						//Si es piloto entrará en el if para mostrar el enlace 'Nuevo Registro'
						if($_SESSION['esPiloto']){
					?>
							<div class="nuevoregistro">
								<!-- Enlace 'Nuevo Registro' -->
								<a href="../newinserts/newtravel.php">Nuevo Registro</a>
							</div>		

					<?php
						//Cierre if($_SESSION['esPiloto'])
						}
					?>
					<!-- Salto de línea -->
					<br>
					<!-- Clase para la tabla que mostrará todos los viajes -->
					<div class="row">
						<table class = "table">
							<thead>
								<tr>
									<!-- Título de cada columna de la tabla -->
									<th>Aeropuerto Origen</th>
									<th>Aeropuerto Destino</th>
									<th>Precio</th>
									<th>Asientos</th>
									<th>Aerolínea</th>
									<th>Comprar</th>
									<th>Editar</th>
									<th>Eliminar</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									//Bucle para mostrar todas las filas que hay en "available_trip"
									while($row = $resultado->fetch_assoc()){
								?>
										<tr>
											<?php
												//Conexión con la base de datos
												$app = Aplicacion::getInstance();
												$conn = $app->conexionBD();
												//Selecciona todos los elementos de la tabla available_trip para poder comprobar
												//que tiene asientos disponibles el viaje
												$query = sprintf("SELECT *
																	FROM available_trip
																	WHERE travel_id = '%d'",
															$conn->real_escape_string($row['travel_id']));
												$rs = $conn->query($query);
												$row = $rs->fetch_assoc();

												//Solo si tiene asientos disponibles entrará en el if
												if($row['sits'] > 0){
													//Conexión con la base de datos
													$app = Aplicacion::getInstance();
													$conn = $app->conexionBD();

													//Selecciona el nombre del aeropuerto origen a partir del acrónimo de la tabla "available_trip"
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
													<!-- Muestra el precio -->
													<td>
														<?php 
															echo $row['price']; 
														?>
													</td>
													<!-- Muestra los asientos del viaje -->
													<td>
														<?php 
															echo $row['sits']; 
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
													<!-- Muestra el nombre del aeropuerto -->
													<td>
														<?php 
															echo $airline['name']; 
														?>
													</td>
													<!-- Enlace para comprar -->
													<td>
														<a href="../buy.php?id=<?php echo $row['travel_id']; ?>">Comprar</a>
													</td>
													<?php
														//Si es piloto entra al if para mostrar los enlaces para editar y eliminar
														if($_SESSION['esPiloto']){
													?>
															<!-- Enlace para editar el viaje -->
															<td>
																<a href="../updateTravel.php?id=<?php echo $row['travel_id']; ?>">Editar</a>
															</td>
															<!-- Enlace para eliminar viaje -->
															<td>
																<a href="../deletes/deleteTravel.php?id=<?php echo $row['travel_id']; ?>">Eliminar</a>
															</td>
													<?php
														//Cierre if($_SESSION['esPiloto'])
														}
												} //Cierre if($row['sits'] > 0)
											?>
										</tr>
								<?php
									//Cierre while($row = $resultado->fetch_assoc())
									}  
								?>
							</tbody>
						</table>	
					</div> <!-- Cierre div class="row" -->
				</div> <!-- Cierre div class="main" -->
			</div> <!-- Cierre div class="principal" -->
			<?php
				require("includes/comun/pie.php");
			?>
		</div> <!-- Cierre div class="contenedor" -->
	</body>
</html>