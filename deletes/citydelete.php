<?php

	//Inicio del procesamiento
	require_once("../includes/config.php");
	require_once("../includes/aplicacion.php");

	//Conexión base de datos
	$app = Aplicacion::getInstance();
	$conn = $app->conexionBD();

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../assets/css/estilo.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Eliminar ciudad</title>
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
					<form class="insertar" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
						<?php
							if(!empty($_POST)){
								
								$ciudad= $_POST['city'];

								if(!empty($ciudad)){
									//Elimina de la tabla ciudad la fila seleccionada con el POST ($ciudad)
									//Método implementado con DELETE ON CASCADE en el archivo "krysi.sql"
									$select = sprintf("DELETE FROM city WHERE city_id = '%d'",
									$conn->real_escape_string($ciudad));
									$conn = $conn->query($select);			
								}

							}
						?>
						<a>Elige el país que quieres eliminar: </a>
						<select name="city" id="">
							<?php
								$app = Aplicacion::getInstance();
								$conn = $app->conexionBD();
								//Selecciona todos los elementos de la tabla "city"
								$query = sprintf("SELECT * FROM city");
								$res = $conn->query($query);
							?>
							<!-- Bucle que muestra todos los nombres de las ciudades que estén en la base de datos -->
   							<?php 
   								foreach ($res as $r): 
   							?>
   							<!-- Muestra las ciudades por su nombre ($r['name']) y guarda en el POST el id de la ciudad ($r['city_id']) -->
       						<option value=<?php echo $r['city_id']; ?>>
       							<?php
       								echo $r['name']; 
       							?>
       						</option>
    						<?php 
    							endforeach; 
    						?>
						</select>
						<!-- Botón eliminar -->
						<input type="submit" value="Eliminar" />
					</form>
				</div> <!-- Cierre div clas= "main" -->
			</div> <!-- Cierre div clas= "principal" -->
			<?php
				require("../includes/comun/pie.php");
			?>
		</div> <!-- Cierre div class= "contenedor" -->
	</body>
</html>

