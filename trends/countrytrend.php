<?php

	//Inicio del procesamiento
	require_once("../includes/config.php");
	require_once("../includes/aplicacion.php");

	//Conexión base de datos
	$app = Aplicacion::getInstance();
	$conn = $app->conexionBD();
	//Coge 10 elementos de la tabla "country" ordenado por n_cities (número de ciudades), de mayor a menor
	$query = sprintf("SELECT * FROM country ORDER BY n_cities DESC LIMIT 10");
	$rs = $conn->query($query);

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../assets/css/estilo.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Países populares</title>
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
					<h1>PAÍSES MÁS POPULARES</h1>
						<p>En este ránking están ordenados los países con más ciudades con aeropuerto que tenemos en nuestra base de datos.</p>
						<!-- Inicio de la tabla que mostrará los países y el número de ciudades -->
						<table>
							<thead>
								<tr>
									<th>País</th>
									<th>Número de ciudades</th>
								</tr>
							</thead>

							<tbody>
								<?php 
									//Bucle que mostrará los 10 países con más ciudades
									while($row = $rs->fetch_assoc()){
								?>
								<tr>
									<td align="center"><?php echo $row['name']; ?></td>
									<td align="center"><?php echo $row['n_cities']; ?></td>
								</tr>
								<?php
									} //Cierre del while
								?>
							</tbody>
						</table> <!-- Fin de la tabla -->
					<!-- Enlace para ir a la página que muestra las ciudades de cada país (citycountry.php) -->
					<a>Para ver las ciudades de un país en concreto <a href="citycountry.php">pulsa aquí </a> </a>
				</div> <!-- Cierre div class = "main" -->
			</div> <!-- Cierre div class = "principal" -->
			<?php
				require("../includes/comun/pie.php");
			?>
		</div> <!-- Cierre div class = "contenedor" -->
	</body>
</html>