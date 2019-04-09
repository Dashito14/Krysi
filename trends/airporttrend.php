<?php

//Inicio del procesamiento
require_once("../includes/config.php");
require_once("../includes/aplicacion.php");

$app = Aplicacion::getInstance();
			$conn = $app->conexionBD();
			$query = sprintf("SELECT * FROM airport ORDER BY n_cities DESC LIMIT 10");
			$rs = $conn->query($query);

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../assets/css/estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Aeropuertos populares</title>
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
	<h1>AEROPUERTOS MÁS POPULARES</h1>
	<p>En este ránking están ordenados los aeropuertos con más viajes disponibles, siendo el aeropuerto
	del ránking el aeropuerto origen.</p>
	<table>
		<thead>
			<tr>
		<th>Aeropuerto</th>
		<th>Ciudad</th>
		<th>País</th>
		<th>Número de viajes</th>
	</tr>
</thead>

<tbody>
					<?php while($row = $rs->fetch_assoc()){
						?>
					<tr>
						<td align="center"><?php echo $row['name']; ?></td>
						<td align="center"><?php echo $row['n_cities']; ?></td>
						<td align="center"><?php echo $row['name']; ?></td>
						<td align="center"><?php echo $row['name']; ?></td>
				
					</tr>
					<?php
						}
					?>
				</tbody>
	</table>

	<a>Para ver las ciudades de un país en concreto <a href="citycountry.php">pulsa aquí </a> </a>
	
</div>

</div>
<?php
	require("../includes/comun/pie.php");
?>




</body>
</html>