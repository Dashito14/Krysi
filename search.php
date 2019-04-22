<?php

//Inicio del procesamiento
require_once("includes/config.php");
require_once("includes/aplicacion.php");


	$app = Aplicacion::getInstance();
	$conn = $app->conexionBD();

	$sql = "SELECT * FROM available_trip";
	$resultado = $conn->query($sql);


	if(!empty($_POST)){
		$valor= $_POST['campo'];
		if(!empty($valor)){
			$app = Aplicacion::getInstance();
			$conn = $app->conexionBD();
			$query = sprintf("SELECT at.acr_ori, at.acr_dst FROM available_trip at JOIN city c JOIN airport a 
				WHERE at.acr_ori = a.acronym AND a.city_id = c.city_id AND c.name = '%s'", $conn->real_escape_string($valor));
			$rs = $conn->query($query);
		}
	}
	
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
			<div class="row">
				<h1>Buscar nuevo viaje</h1>
			</div>
			<?php
				if($_SESSION['esPiloto']){
			?>
			<div class="nuevoregistro">
				<a href="../newinserts/newtravel.php">Nuevo Registro</a>
			</div>		

			<?php
		}
			?>

			<br>

			<div class="row">
			<table class = "table">
				<thead>
					<tr>
						<th>Aeropuerto Origen</th>
						<th>Aeropuerto Destino</th>
						<th>Precio</th>
						<th>Asientos</th>
						<th>Aerolínea</th>
						<th>Comprar</th>
						<th>Editar</th>
						<th>Eliminar</th>
				</thead>

				<tbody>
					<?php while($row = $resultado->fetch_assoc()){
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

						<td><?php echo $nombre['name']; ?></td>

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
						<td><?php echo $destino['name']; ?></td>
						<td><?php echo $row['price']; ?></td>
						<td><?php echo $row['sits']; ?></td>

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

						<td><?php echo $airline['name']; ?></td>
						<td><a href="../buy.php?id=<?php echo $row['travel_id']; ?>">Comprar</a></td>
						<?php
						if($_SESSION['esPiloto']){
						?>
						<td><a href="../updateTravel.php?id=<?php echo $row['travel_id']; ?>">Editar</a></td>
						<td><a href="../deleteTravel.php?id=<?php echo $row['travel_id']; ?>">Eliminar</a></td>
						<?php
					}
					?>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>	
					<!-- <form action="<?php /*$_SERVER['PHP_SELF'];*/ ?>" method="POST">
						<b>Ciudad Origen: </b><input type="text" id="campo" name="campo" />
						<input type="submit" id="enviar" name="enviar" value="Buscar" />
					</form> -->
			</div>
		</div>

	</div>

<?php
	require("includes/comun/pie.php");
?>


</div>

</body>
</html>