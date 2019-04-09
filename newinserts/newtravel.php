<?php

//Inicio del procesamiento
require_once("../includes/config.php");
require_once("../includes/aplicacion.php");

	if(!empty($_POST)){
		$origen= $_POST['origen'];
		$destino= $_POST['destino'];
		$precio= $_POST['precio'];
		$asiento= $_POST['asientos'];
		$aerolinea= "IB";
		
		if(!empty($origen) && !empty($destino) && !empty($precio) && !empty($asiento) && !empty($aerolinea)){
			$app = Aplicacion::getInstance();
			$conn = $app->conexionBD();

			$query = sprintf("INSERT INTO available_trip(price, acr_ori, acr_dst, sits, airline_acr) VALUES ('%F', '%s', '%s', '%d', '%s')", 
					$conn->real_escape_string($precio),
					$conn->real_escape_string($origen),
					$conn->real_escape_string($destino),
					$conn->real_escape_string($asiento),
					$conn->real_escape_string($aerolinea));
			$conn = $conn->query($query);
		}
	}
	
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../assets/css/estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Insertar viaje</title>
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
			<h1>Insertar nuevo viaje</h1>			
				<form class="insertar" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">

	<?php
			$app = Aplicacion::getInstance();
			$conn = $app->conexionBD();
			$query = sprintf("SELECT name, acronym FROM airport ORDER BY name");
			$resultado = $conn->query($query);

	?>
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
		
		</div>

	</div>

<?php
	require("../includes/comun/pie.php");
?>


</div>

</body>
</html>