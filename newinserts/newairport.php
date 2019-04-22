<?php

//Inicio del procesamiento
require_once("../includes/config.php");
require_once("../includes/aplicacion.php");

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../assets/css/estilo.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Insertar aeropuerto</title>
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
					<h1>Insertar nuevo aeropuerto</h1>		
					<!-- Al hacer el POST se recargará esta página por el PHP_SELF -->	
					<form class="insertar" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">

						<?php
							//Conexión a la base de datos
							$app = Aplicacion::getInstance();
							$conn = $app->conexionBD();
							//Selecciona el id y el nombre de la tabla ciudades, ordenado alfabéticamente por nombre
							$query = sprintf("SELECT city_id, name 
												FROM city 
												ORDER BY name");
											$resultado = $conn->query($query);
						?>
						<!-- Etiqueta que se muestra antes del selector de la ciudad -->
						<b>Ciudad a la que pertenece: </b>
						<select name="city" id="">
							<!-- Bucle que muestra todas las ciudades de la base de datos -->
					   		<?php 
					   			foreach ($resultado as $r): 
					   		?>
					   		<!-- Se elige la ciudad por su nombre ($r['name']) pero guardamos en el POST el id ($r['city_id']) -->
					       	<option value=<?php echo $r['city_id']; ?>>
					       		<?php 
					       			echo $r['name']; 
					       		?>
					 		</option>
					    	<?php 
					    		endforeach; 
					    	?>
						</select>
						<!-- Sentencia con enlace para insertar una nueva ciudad -->
						<b>Si no encuentras la ciudad <a href="newcity.php">pulsa aquí</a></b>
						<!-- Campo para introducir el nombre del aeropuerto -->
						<b>Nombre del aeropuerto: </b><input type="text" class="campo" name="nombre" />
						<!-- Campo para introducir el Código IATA del aeropuerto que vas a introducir -->
						<b>Código IATA: </b><input type="text" maxlength="3" name="IATA" />
						<!-- Botón insertar -->
						<input type="submit" id="enviar" name="enviar" value="Insertar" />
						<?php

							//Si el usuario ha introducido algún dato entrará
							if(!empty($_POST)){
								$ciudad= $_POST['city'];
								$aeropuerto= $_POST['nombre'];
								$iata= $_POST['IATA'];

								//Solo entra al if si todos los campos han sido rellenados
								if(!empty($ciudad) && !empty($aeropuerto) && !empty($iata)){

									//Conexión con la base de datos
									$app = Aplicacion::getInstance();
									$conn = $app->conexionBD();
									//Inserta en la base de datos los campos introducidos por el usuario con el POST
									$query = sprintf("INSERT INTO airport(city_id, acronym, name) 
														VALUES ('%d', '%s', '%s')", 
										$conn->real_escape_string($ciudad),
										$conn->real_escape_string($iata),
										$conn->real_escape_string($aeropuerto));
									$conn = $conn->query($query);
								} // Cierre if(!empty($ciudad) && !empty($aeropuerto) && !empty($iata))
							} //Cierre if(!empty($_POST))
						?>						
					</form>		
				</div> <!-- Cierre div class= "main" -->
			</div> <!-- Cierre div class= "principal" -->
			<?php
				require("../includes/comun/pie.php");
			?>
		</div> <!-- Cierre div class= "contenedor" -->
	</body>
</html>