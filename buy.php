<?php
	//Inicio del procesamiento
	require_once("includes/config.php");
	require_once("includes/aplicacion.php");
	require_once("includes/usuario.php")
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
				require("includes/comun/cabecera.php");
			?>
			<div class="principal">
				<?php
					require("includes/comun/sidebarIzq.php");
				?>
				<div class="main">
					<!-- Título de la página -->
					<h1>COMPRA REALIZADA CON ÉXITO</h1>
					<p>El billete que has comprado tiene estos datos: </p>
					<?php
						//Solo entrará al if si existe algún id en la cabecera
						if(isset($_GET['id'])){
							//Conexión con la base de datos
							$app = Aplicacion::getInstance();
							$conn = $app->conexionBD();
							//Selecciona todos los elementos de la fila de "available_trip" en la que 
							//coincida el id con el pasado por cabecera
							$query = sprintf("SELECT * 
												FROM available_trip
												WHERE travel_id = '%d'",
										$conn->real_escape_string($_GET['id']));
							$rs = $conn->query($query);
						} //Cierre if(isset($_GET['id']))
					?>
					<!-- Tabla que mostrará los datos del billete comprado -->
					<table>
						<thead>
							<tr>
								<!-- Nombre de todas las columnas de la tabla -->
								<th>Aeropuerto Origen</th>
								<th>Ciudad Origen</th><br>
								<th>Aeropuerto Destino</th>
								<th>Ciudad Destino</th>
								<th>Precio</th>
								<th>Aerolínea</th>
							</tr>	
						</thead>
						<tbody>
							<?php 
								//solo hará una vez el bucle porque solo hay una fila
								//Este buicle mostrará lso datos del billete
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
											$origen = $aeropuerto->fetch_assoc();
										?>
										<!-- Muestra el nombre del aeropuerto origen -->
										<td align="center">
											<?php 
												echo $origen['name']; 
											?>												
										</td>
										<?php
											//Conexión con la base de datos
											$app = Aplicacion::getInstance();
											$conn = $app->conexionBD();

											//Selecciona el nombre de la ciudad origen
											$cityori = sprintf("SELECT c.name 
																FROM city c
																JOIN airport a
																WHERE c.city_id = a.city_id
																AND a.acronym = '%s'",
														$conn->real_escape_string($row['acr_ori']));
											$ciudadorigen = $conn->query($cityori);
											$corigen = $ciudadorigen->fetch_assoc();
										?>
										<!-- Muestra el nombre de la ciudad origen -->
										<td align="center">
											<?php 
												echo $corigen['name']; 
											?>
										</td>
										<?php
											//Conexión con la base de datos
											$app = Aplicacion::getInstance();
											$conn = $app->conexionBD();

											//Selecciona el nombre del aeropuerto destino
											$desti = sprintf("SELECT * 
																FROM airport
																WHERE acronym = '%s'",
														$conn->real_escape_string($row['acr_dst']));
											$dst = $conn->query($desti);
											$destino = $dst->fetch_assoc();
										?>
										<!-- Muestra el nomrbe del aeropuerto destino -->
										<td align="center">
											<?php
											 	echo $destino['name']; 
											 ?>	
										</td>
										<?php
											//Conexión con la base de datos
											$app = Aplicacion::getInstance();
											$conn = $app->conexionBD();
											//Selecciona el nombre de la ciudad destino
											$citydst = sprintf("SELECT c.name
																FROM city c
																JOIN airport a
																WHERE c.city_id = a.city_id
																AND a.acronym = '%s'",
														$conn->real_escape_string($row['acr_dst']));
											$ciudaddestino = $conn->query($citydst);
											$codestino = $ciudaddestino->fetch_assoc();
										?>
										<!-- Muestra el nombre de la ciudad destino -->
										<td align="center">
											<?php
												echo $codestino['name']; 
											?>												 	
										</td>
										<!-- Muestra el precio del billete-->
										<td align="center">
											<?php 
												echo $row['price']; 
											?>													
										</td>
										<?php
											//Conexión con la base de datos
											$app = Aplicacion::getInstance();
											$conn = $app->conexionBD();
											//Selecciona el nombre de la aerolínea
											$selairline = sprintf("SELECT * 
																	FROM airline
																	WHERE airline_acr = '%s'",
															$conn->real_escape_string($row['airline_acr']));
											$air = $conn->query($selairline);
											$airline = $air->fetch_assoc();
										?>
										<!-- Muestra el nombre de la aerolínea -->
										<td align="center">
											<?php 
												echo $airline['name']; 
											?>													
										</td>
									</tr>
							<?php
								} //Cierre de while($row = $rs->fetch_assoc())
							?>
						</tbody>
					</table> 
					<?php
						//Solo entra en el if si existe un id en el buscador
						if(isset($_GET['id'])){
							$id= $_GET['id'];
							$idUser = $_SESSION['ID'];
								
							//Si las dos variables tienen valores entrará en le if
							if(!empty($id) && !empty($idUser)){
								//Conexión a la base de datos
								$app = Aplicacion::getInstance();
								$conn = $app->conexionBD();
								//Inserta los valores del id del viaje y el id del usuario en la tabla "ticket"
								$query = sprintf("INSERT INTO ticket(user_id, ava_trip_id)
														VALUES ('%d', '%d')",
										$conn->real_escape_string($idUser),
										$conn->real_escape_string($id));
								$rs = $conn->query($query);

								//Conexión con la base de datos
								$app = Aplicacion::getInstance();
								$conn = $app->conexionBD();
								//Selecciona todos los elementos de la tabla available_trip para poder restarle 1 
								//a los asientos disponibles
								$query = sprintf("SELECT *
													FROM available_trip
													WHERE travel_id = '%d'",
											$conn->real_escape_string($id));
								$rs = $conn->query($query);
								$row = $rs->fetch_assoc();
								$asientos = $row['sits'] - 1;

								//Conexión con la base de datos
								$app = Aplicacion::getInstance();
								$conn = $app->conexionBD();
								//Actualizamos el valor de asientos en la tabla del viaje que hayamos comprado
								$query = sprintf("UPDATE available_trip
													SET sits = '%d'
													WHERE travel_id = '%d'",
											$conn->real_escape_string($asientos),
											$conn->real_escape_string($id));
								$rs = $conn->query($query);		
							} //Cierre if(!empty($id) && !empty($idUser))
						} //Cierre if(isset($_GET['id']))
					?>
				</div> <!-- Cierre div class="main" -->
			</div> <!-- Cierre div class="principal" -->
			<?php
				require("includes/comun/pie.php");
			?>
		</div> <!-- Cierre div class="contenedor" -->
	</body>
</html>