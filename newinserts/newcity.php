<?php

	//Inicio del procesamiento
	require_once("../includes/config.php");
	require_once("../includes/aplicacion.php");

	//Si el usuario no ha introducido ningún dato no entrara en el if
	if(!empty($_POST)){
		$pais= $_POST['country'];
		$nombre= $_POST['nombre'];

		//Solo entrará en el if si ninguno de los campos introducidos está vacío
		if(!empty($pais) && !empty($nombre)){
			//Conexión con la base de datos
			$app = Aplicacion::getInstance();
			$conn = $app->conexionBD();
			//Inserta en la tabla "city" el campo nombre (name) y el id del pais (country_id)
			$query = sprintf("INSERT INTO city(name, country_id) 
								VALUES ('%s', '%d')", 
							$conn->real_escape_string($nombre),
							$conn->real_escape_string($pais));
			$conn = $conn->query($query);

			$app = Aplicacion::getInstance();
				$conn = $app->conexionBD();
				$query = sprintf("SELECT * 
									FROM country
									WHERE country_id = '%d'",
									$conn->real_escape_string($pais));
				$rs = $conn->query($query);
				$row = $rs->fetch_assoc();
				$cities = $row['n_cities'];
				$cities = $cities + 1;

				echo $cities;
				echo $pais;
				
			$app = Aplicacion::getInstance();
			$conn = $app->conexionBD();
			$query = sprintf("UPDATE country 
								SET n_cities = '%d',
								WHERE country_id = '%d'", 
							$conn->real_escape_string($cities),
							$conn->real_escape_string($pais));
			$conn = $conn->query($query);
		} //Cierre if(!empty($_POST))
	} //Cierre if(!empty($pais) && !empty($nombre))
	
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../assets/css/estilo.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Insertar ciudad</title>
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
					<h1>Insertar nueva ciudad</h1>	
					<!-- Cuando el usuario pulse el botón de insertar recargará la página para insetar los datos por el PHP_SELF -->		
					<form class="insertar" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">

						<?php
							//Conexión con la base de datos
							$app = Aplicacion::getInstance();
							$conn = $app->conexionBD();
							//Selecciona el id del país y el nombre de la tabla "country", ordenados alfabéticamente por nombre
							$query = sprintf("SELECT country_id, name 
												FROM country
												ORDER BY name");
							$resultado = $conn->query($query);

						?>
						<!-- Etiqueta que se muestra antes del selector del país -->
						<b>País al que pertenece: </b>
						<select name="country" id="">
							<!-- Bucle que muetra todos los países de la base de datos -->
	   						<?php 
	   							foreach ($resultado as $r): 
	   						?>
	   							<!-- Se muestran los países por su nombre ($r['name']) pero se guarda en el POST su id ($r['country_id']) -->
		     					<option value=<?php echo $r['country_id']; ?>>
			       					<?php 
			       						echo $r['name']; 
			       					?>
		       					</option>
	    					<?php 
	    						endforeach; 
	    					?>
						</select>
						<!-- Sentencia con enlace para insertar un nuevo país si no lo encuentras en la lista -->
						<b>Si no encuentras el país <a href="newcountry.php">pulsa aquí</a></b>
						<!-- Campo para introducir el nombre de la ciudad -->
						<b>Nombre de la ciudad:  </b><input type="text" class="campo" name="nombre" />
						<!-- Botón Insertar -->
						<input type="submit" id="enviar" name="enviar" value="Insertar" />
						<!-- Sentencia con enlace para volver a introducir un aeropuerto cuando hayas insertado la ciudad -->
						<b>Para volver a introducir un nuevo aeropuerto <a href="newairport.php">pulsa aquí</a></b>
					</form>
				</div> <!-- Cierre div class= "main" -->
			</div> <!-- Cierre div class= "principal" -->
			<?php
				require("../includes/comun/pie.php");
			?>
		</div> <!-- Cierre div class= "contenedor" -->
	</body>
</html>