<?php

	//Inicio del procesamiento
	require_once("../includes/config.php");
	require_once("../includes/aplicacion.php");

	//Solo si exste $_POST entrará en el if
	if(!empty($_POST)){
		$origen= $_POST['origen'];
		$destino= $_POST['destino'];
		$precio= $_POST['precio'];
		$asiento= $_POST['asientos'];

		//Conexión con la base de datos
		$app = Aplicacion::getInstance();
		$conn = $app->conexionBD();

		//Selecciona la aerolínea a la que pertenece el piloto
		$airline = sprintf("SELECT *
							FROM airline a
							JOIN pilot p
							WHERE p.user_id = '%d'
							AND p.belongs_airline = a.airline_acr",
							$conn->real_escape_string($_SESSION['ID']));
		$aero = $conn->query($airline);
		$empresa = $aero->fetch_assoc();

		//Guardamos el acrónimo de la aerolínea en una variable
		$aerolinea= $empresa['airline_acr'];
		
		//Si las variables anteriores no están vacías entra en el if
		if(!empty($origen) && !empty($destino) && !empty($precio) && !empty($asiento) && !empty($aerolinea)){
			//Conexión con la base de datos
			$app = Aplicacion::getInstance();
			$conn = $app->conexionBD();

			//Inserta los nuevos valores introducidos por el piloto en la tabla
			$query = sprintf("INSERT INTO available_trip(price, acr_ori, acr_dst, sits, airline_acr) 
								VALUES ('%F', '%s', '%s', '%d', '%s')", 
						$conn->real_escape_string($precio),
						$conn->real_escape_string($origen),
						$conn->real_escape_string($destino),
						$conn->real_escape_string($asiento),
						$conn->real_escape_string($aerolinea));
			$conn = $conn->query($query);
		} //Cierre de if(!empty($origen) && !empty($destino) && !empty($precio) && !empty($asiento) && !empty($aerolinea))
	} //Cierre de if(!empty($_POST))
	
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
					<!-- Título de la página -->
					<h1>Insertar nuevo viaje</h1>			
					<form class="insertar" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
						<?php
							//Conexión con la base de datos
							$app = Aplicacion::getInstance();
							$conn = $app->conexionBD();
							//Selecciona el nombre y el acrónimo de todos los aeropuertos, ordenados por el nombre
							$query = sprintf("SELECT name, acronym 
												FROM airport 
												ORDER BY name");
							$resultado = $conn->query($query);
						?>
						<b>Aeropuerto origen: </b>
						<select name="origen" id="">
			   				<?php 
			   					//Bucle para introducir en el select todos los aeropuertos, se muestra el nombre
			   					//pero guardamos el acrónimo. Para el aeropuerto origen
			   					foreach ($resultado as $r): 
			   				?>
			       					<option value=<?php echo $r['acronym']; ?>>
			       						<?php 
			       							echo $r['name']; 
			       						?>			       							
			       					</option>
			    			<?php 
			    				endforeach;
			     			?>
						</select>
						<b>Aeropuerto destino: </b>
						<select name="destino" id="aeropuerto">
			   				<?php 
			   					//Bucle para introducir en el select todos los aeropuertos, se muestra el nombre
			   					//pero guardamos el acrónimo. Para el aeropuerto destino
			   					foreach ($resultado as $r): 
			   				?>
			       					<option value=<?php echo $r['acronym']; ?>>
			       						<?php 
			       							echo $r['name']; 
			       						?>			       							
			       					</option>
			    			<?php 
			    				endforeach; 
			    			?>
						</select>
						<!-- Sentencia que muestra la etiqueta de precio en euros y el campo para inbtroducir el precio -->
						<b>Precio en euros: </b>
						<input type="number" min="1.00" step="0.01" class="campo" name="precio" />
						<!-- Sentencia que muestra la etiqueta de asientos y el campo para introducir los asientos -->
						<b>Asientos disponibles: </b>
						<input type="number" min="1" class="campo" name="asientos" />
						<!-- Botón enviar -->
						<input type="submit" id="enviar" name="enviar" value="Insertar" />
					</form>					
				</div> <!-- Cierre div class="main" -->
			</div> <!-- Cierre div class="principal" -->
			<?php
				require("../includes/comun/pie.php");
			?>
		</div> <!-- Cierre div class="contenedor" -->
	</body>
</html>