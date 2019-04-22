<?php
// TODO COPIADO DEL SEARCH.PHP
//Inicio del procesamiento
require_once("includes/config.php");
require_once("includes/aplicacion.php");
require_once("includes/usuario.php");

if(!empty($_POST)){
		$origen= $_POST['origen'];
		$destino= $_POST['destino'];
		$precio= $_POST['precio'];
		$asiento= $_POST['asientos'];

		//Conexión con la base de datos
		$app = Aplicacion::getInstance();
		$conn = $app->conexionBD();
		
		if(!empty($origen) && !empty($destino) && !empty($precio) && !empty($asiento)){
			$app = Aplicacion::getInstance();
			$conn = $app->conexionBD();

			$query = sprintf("UPDATE available_trip
							SET price = '%F',
							acr_ori = '%s',
							acr_dst = '%s',
							sits = '%d'
							WHERE travel_id = '%d'", 
							$conn->real_escape_string($precio),
							$conn->real_escape_string($origen),
							$conn->real_escape_string($destino),
							$conn->real_escape_string($asiento),
							$conn->real_escape_string($_GET['id']));
			$conn = $conn->query($query);
		}
	}
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
						<form class="insertar" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
		<?php
		$aero = sprintf("SELECT * FROM pilot WHERE user_id = '%d'", $conn->real_escape_string($_SESSION['ID']));
		$a = $conn->query($aero);
		$aerolineapiloto = $a->fetch_assoc();
			if($aerolineapiloto['belongs_airline'] == $acraero){
			$app = Aplicacion::getInstance();
			$conn = $app->conexionBD();
			$query = sprintf("SELECT name, acronym FROM airport ORDER BY name");
			$resultado = $conn->query($query);

	?>			
				<h2>Elige los nuevos datos</h2>
				<b>Aeropuerto origen: </b><select name="origen" id="">
   										 	<?php foreach ($resultado as $r): ?>
       									 	<option value=<?php echo $r['acronym']; ?>><?php echo $r['name']; ?></option>
    										<?php endforeach; ?>
										</select>
				<b>Aeropuerto destino: </b><select name="destino" id="aeropuerto">
   										 	<?php foreach ($resultado as $r): ?>
       									 	<option value=<?php echo $r['acronym']; ?>><?php echo $r['name']; ?></option>
    										<?php endforeach; ?>
										</select>
				<b>Precio en euros: </b><input type="number" min="1.00" step="0.01" class="campo" name="precio" />
				<b>Asientos disponibles: </b><input type="number" min="1" class="campo" name="asientos" />
				<input type="submit" id="enviar" name="enviar" value="Insertar" />
				</form>
				<?php
			} else{
				echo "No puedes editar este viaje porque pertenece a ".$acraero." y usted trabaja en ".$aerolineapiloto['belongs_airline'];
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