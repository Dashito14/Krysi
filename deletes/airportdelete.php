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
		<title>Eliminar aeropuerto</title>
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
					<!-- Al hacer el POST volverá a cargar esta misma página con PHP_SELF -->
					<form class="insertar" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
						<?php
							//Si no se ha seleccionado nada por el usuario no entrará en el if
							if(!empty($_POST)){
								
								$aeropuerto= $_POST['airport'];

								//Si la variable $aeropuerto está vacía no entrará en el if
								if(!empty($aeropuerto)){
									//Elimina de la tabla "airport" la fila en la que coincida el acronimo con el seleccionado con el POST
									//Método implementado con DELETE ON CASCADE en el archivo "krysi.sql"
									$select = sprintf("DELETE FROM airport WHERE acronym = '%s'",
									$conn->real_escape_string($aeropuerto));
									$conn = $conn->query($select);			
								}
							}
						?>
						<!-- Etiqueta que se muestra antes de la selección del aeropuerto -->
						<a>Elige el aeropuerto que quieres eliminar: </a>
						<select name="airport" id="">
							<?php
								//Conexión a la base de datos
								$app = Aplicacion::getInstance();
								$conn = $app->conexionBD();
								//Selecciona todos los elementos de la tabla "airport"
								$query = sprintf("SELECT * FROM airport");
								$res = $conn->query($query);
							?>
							<!-- Bucle que muestra el nombre de todos los aeropuertos -->
	   						<?php 
	   							foreach ($res as $r): 
	   						?>
	   							<!-- Se seleccionará el aeropuerto por su nombre pero se cogerá por POST el acrónimo -->
	       						<option value=<?php echo $r['acronym']; ?>>
	       							<?php 
	       								echo $r['name']; 
	       							?>
	       						</option>
	    					<?php 
	    						endforeach; 
	    					?>
						</select>
						<!-- Botón Eliminar -->
						<input type="submit" value="Eliminar" />
					</form>
				</div> <!-- Cierre div class= "main" -->
			</div> <!-- Cierre div class= "principal" -->
			<?php
				require("../includes/comun/pie.php");
			?>
		</div> <!-- Cierre div class= "contenedor" -->
	</body>
</html>


	