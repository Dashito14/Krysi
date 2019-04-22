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
			<h2 align="center">PERFIL</h2>
			<a>Nombre de usuario: <?php echo $_SESSION['nombre']; ?></a>
			<?php
				if($_SESSION['esPiloto']){
					$query=sprintf("SELECT a.name
									FROM airline a
									JOIN pilot p
									WHERE p.belongs_airline = a.airline_acr
									AND p.user_id = '%d'",
									$conn->real_escape_string($_SESSION['ID']));
				$rs = $conn->query($query);
				$airline = $rs->fetch_assoc();
			?>
			<a>Aerolínea a la que pertenece: <?php echo $airline['name']; ?></a>
			<?php
			}
			$query = sprintf("SELECT user_id, count(ticket_id) as total
						FROM ticket 
						WHERE user_id = '%d'
						GROUP BY user_id 
						",
						$conn->real_escape_string($_SESSION['ID']));
					$rs = $conn->query($query);
					$totalviajes = $rs->fetch_assoc();
			?>	
			<a>Viajes pendientes: <?php echo $totalviajes['total']; ?></a>
			<?php
			if($totalviajes > 0){
				$query = sprintf("SELECT a.price, a.acr_ori, a.acr_dst, a.airline_acr
								FROM available_trip a
								JOIN ticket t
								WHERE a.travel_id = t.ava_trip_id
								AND t.user_id = '%d'",
								$conn->real_escape_string($_SESSION['ID']));
					$rs = $conn->query($query);
			}
			?>

			<thead>
					<tr>
						<th>Aeropuerto Origen</th>
						<th>Aeropuerto Destino</th>
						<th>Precio</th>
						<th>Aerolínea</th>
						<br>
				</thead>

				<tbody>
					<?php while($row = $rs->fetch_assoc()){
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
							$nombre = $aeropuerto->fetch_assoc();
						?>

						<td width: 25%;><?php echo $nombre['name']; ?></td>

						<?php
							//Conexión con la base de datos
							$app = Aplicacion::getInstance();
							$conn = $app->conexionBD();

							//Selecciona el nombre del aeropuerto
							$select = sprintf("SELECT * 
											FROM airport
											WHERE acronym = '%s'",
										$conn->real_escape_string($row['acr_dst']));
							$aeropuerto = $conn->query($select);
							$destino = $aeropuerto->fetch_assoc();
						?>
						<td width: 25%;><?php echo $destino['name']; ?></td>
						<td width: 25%;><?php echo $row['price']; ?></td>

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

						<td width: 25%;><?php echo $airline['name']; ?></td>
						<br>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>	
		</div>
	</div>
</div>
	</body>
	</html>