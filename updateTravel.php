<?php
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
		<h1>EDITAR VIAJE</h1>
		<p>El billete que vas a editar tienes estos datos: </p>
		<?php
			if(isset($_GET['id'])){
				$app = Aplicacion::getInstance();
				$conn = $app->conexionBD();
				$query = sprintf("SELECT * 
									FROM available_trip
									WHERE travel_id = '%d'",
									$conn->real_escape_string($_GET['id']));
				$rs = $conn->query($query);

			}
		?>
		<table>
							<thead>
								<tr>
									<th>Aeropuerto Origen</th>
									<th>Aeropuerto Destino</th>
									<th>Asientos</th>
									<th>Precio</th>
									<th>Aerolínea</th>
								</tr>
							</thead>

							<tbody>
								<?php 

									//Bucle que mostrará los 10 países con más ciudades
									while($row = $rs->fetch_assoc()){
										$acraero = $row['airline_acr'];
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
										$conn->real_escape_string($row['acr_ori']));
							$aeropuerto = $conn->query($select);
							$destino = $aeropuerto->fetch_assoc();
							?>
									<td align="center"><?php echo $destino['name']; ?></td>
		
									<?php
										//Conexión con la base de datos
							$app = Aplicacion::getInstance();
							$conn = $app->conexionBD();

							//Selecciona el nombre del aeropuerto
							$orig = sprintf("SELECT * 
											FROM airport
											WHERE acronym = '%s'",
										$conn->real_escape_string($row['acr_dst']));
							$ori = $conn->query($orig);
							$origen = $ori->fetch_assoc();
							?>
									<td align="center"><?php echo $origen['name']; ?></td>
									<td align="center"><?php echo $row['sits']; ?></td>
									<td align="center"><?php echo $row['price']; ?></td>
									<?php

										//Conexión con la base de datos
							$app = Aplicacion::getInstance();
							$conn = $app->conexionBD();

							//Selecciona el nombre del aeropuerto
							$selairline = sprintf("SELECT * 
											FROM airline
											WHERE airline_acr = '%s'",
										$conn->real_escape_string($row['airline_acr']));
							$air = $conn->query($selairline);
							$airline = $air->fetch_assoc();
							?>
									<td align="center"><?php echo $airline['name']; ?></td>
								</tr>
								<?php
									} //Cierre del while
								?>
							</tbody>
						</table> 
						<h2>Actualizar datos</h2>
					<?php

						$formularioUpdate = new formularioUpdate("Actualizar", array('action'=>'updateTravel.php?id='.$_GET['id']));
						$formularioUpdate->gestiona();
					?>
		</div>

	</div>

<?php
	require("includes/comun/pie.php");
?>


</div>

</body>
</html>