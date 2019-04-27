<?php
	//Inicio del procesamiento
	require_once("includes/aplicacion.php");
	require_once("includes/formularioUpdate.php");
	require_once("includes/config.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../assets/css/estilo.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Editar viaje</title>
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
					<h1>EDITAR VIAJE</h1>
					<p>El billete que vas a editar tienes estos datos: </p>
					<?php
						//Solo entra en el if, si existe un id en el enlace de la página
						if(isset($_GET['id'])){
							//Conexión con la base de datos
							$app = Aplicacion::getInstance();
							$conn = $app->conexionBD();
							//Selecciona todos los elementos de la fila en la que travel_id sea el mismo que el que 
							//se le ha pasado por el enlace.
							$query = sprintf("SELECT * 
											FROM available_trip
											WHERE travel_id = '%d'",
										$conn->real_escape_string($_GET['id']));
							$rs = $conn->query($query);
						} //Cierre if(isset($_GET['id']))
					?>
					<!-- Tabla que muestra los datos del billete que se va a cambiar -->
					<table>
						<thead>
							<tr>
								<!-- Nombre de todas las columnas -->
								<th>Aeropuerto Origen</th>
								<th>Aeropuerto Destino</th>
								<th>Asientos</th>
								<th>Precio</th>
								<th>Aerolínea</th>
							</tr>
						</thead>

						<tbody>
							<?php 
								//Solo hará una vez el bucle, ya que solo hay una fila seleccionada
								while($row = $rs->fetch_assoc()){
									$acraero = $row['airline_acr'];
							?>
									<tr>
										<?php
											//Conexión con la base de datos
											$app = Aplicacion::getInstance();
											$conn = $app->conexionBD();
											//Selecciona el nombre del aeropuerto origen a partir del acrónimo
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

											//Selecciona el nombre del aeropuerto destino a partir del acrónimo
											$orig = sprintf("SELECT * 
															FROM airport
															WHERE acronym = '%s'",
													$conn->real_escape_string($row['acr_dst']));
											$ori = $conn->query($orig);
											$destino = $ori->fetch_assoc();
										?>
										<!-- Muestra el nombre del aeropuerto destino -->
										<td align="center">
											<?php 
												echo $destino['name']; 
											?>	
										</td>
										<!-- Muestra el número de asientos -->
										<td align="center">
											<?php
											 	echo $row['sits']; 
											 ?>
										</td>
										<!-- Muestra el precio -->
										<td align="center">
											<?php 
												echo $row['price']; 
											?>
										</td>
										<?php
											//Conexión con la base de datos
											$app = Aplicacion::getInstance();
											$conn = $app->conexionBD();

											//Selecciona el nombre de la aerolínea a partir del acrónimo
											$selairline = sprintf("SELECT * 
																	FROM airline
																	WHERE airline_acr = '%s'",
															$conn->real_escape_string($row['airline_acr']));
											$air = $conn->query($selairline);
											$airline = $air->fetch_assoc();
										?>
										<!-- Muestra el nombre de la aerolínea que opera el viaje -->
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
					<!-- Empieza el formulario para actualizar los datos -->
					<h2>Actualizar datos</h2>
						<?php
							$formularioUpdate = new formularioUpdate("Actualizar", array('action'=>'updateTravel.php?id='.$_GET['id']));
							$formularioUpdate->gestiona();
						?>
				</div>	<!-- Cierre div class="main" -->
			</div> <!-- Cierre div class="principal" -->
			<?php
				require("includes/comun/pie.php");
			?>
		</div> <!-- Cierre div class="contenedor" -->
	</body>
</html>