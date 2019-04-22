<?php
// TODO COPIADO DEL SEARCH.PHP
//Inicio del procesamiento
require_once("includes/config.php");
require_once("includes/aplicacion.php");
require_once("includes/usuario.php")

/*
	$app = Aplicacion::getInstance();
	$conn = $app->conexionBD();
	
	*/
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
		<h1>COMPRA REALIZADA CON ÉXITO</h1>
		<p>El billete que has comprado tiene estos datos: </p>
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
									<th>Ciudad Origen</th><br>
									<th>Aeropuerto Destino</th>
									<th>Ciudad Destino</th>
									<th>Precio</th>
									<th>Aerolínea</th>
								</tr>
							</thead>

							<tbody>
								<?php 
									//Bucle que mostrará los 10 países con más ciudades
									while($row = $rs->fetch_assoc()){
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
							$cityori = sprintf("SELECT c.name 
											FROM city c
											JOIN airport a
											WHERE c.city_id = a.city_id
											AND a.acronym = '%s'",
										$conn->real_escape_string($row['acr_ori']));
							$ciudadorigen = $conn->query($cityori);
							$corigen = $ciudadorigen->fetch_assoc();
							?>
									<td align="center"><?php echo $corigen['name']; ?></td>
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

									<?php

										//Conexión con la base de datos
							$app = Aplicacion::getInstance();
							$conn = $app->conexionBD();

							//Selecciona el nombre del aeropuerto
							$citydst = sprintf("SELECT c.name
											FROM city c
											JOIN airport a
											WHERE c.city_id = a.city_id
											AND a.acronym = '%s'",
										$conn->real_escape_string($row['acr_dst']));
							$ciudaddestino = $conn->query($citydst);
							$codestino = $ciudaddestino->fetch_assoc();
							?>
									<td align="center"><?php echo $codestino['name']; ?></td>
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
		<?php
			if(isset($_GET['id'])){
				$id= $_GET['id'];
				$idUser = $_SESSION['ID'];
			
			if(!empty($id) && !empty($idUser)){
					$app = Aplicacion::getInstance();
					$conn = $app->conexionBD();
					$query = sprintf("INSERT INTO ticket(user_id, ava_trip_id)
										VALUES ('%d', '%d')",
									$conn->real_escape_string($idUser),
									$conn->real_escape_string($id));
						$rs = $conn->query($query);
		}
	}

		?>
		</div>

	</div>

<?php
	require("includes/comun/pie.php");
?>


</div>

</body>
</html>