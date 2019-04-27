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
		<title>Eliminar país</title>
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
						<!-- Al hacer el POST volverá a cargar la página por el PHP_SELF -->
						<form class="insertar" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
							<?php
								//Si la elección del usuario está vacía no entra en el if
								if(!empty($_POST)){
									
									$pais= $_POST['pais'];
									
									//Si la variable $pais está vacía no entra en el if
									if(!empty($pais)){

										//Elimina de la tabla "country" la fila en la que coincida el id con el id seleccionado por el usuario
										//en el select de abajo
										//Método implementado con DELETE ON CASCADE en el archivo "krysi.sql"
										$select = sprintf("DELETE FROM country WHERE country_id = '%d'",
										$conn->real_escape_string($pais));
										$conn = $conn->query($select);
									} //Cierre if(!empty($pais))
								} //Cierre if(!empty($_POST))
							?>
							<!-- Etiqueta para la selección del país que queremos eliminar -->
							<a>Elige el país que quieres eliminar: </a>
							<select name="pais" id="">
								<?php
									//Conexión con la base de datos
									$app = Aplicacion::getInstance();
									$conn = $app->conexionBD();
									//Coge todos los elementos de la tabla "country"
									$query = sprintf("SELECT * FROM country");
									$res = $conn->query($query);
								?>
								<!-- Bucle que muestra todos los países para seleccionar el que quieres eliminar -->
	   							<?php 
	   								foreach ($res as $r): 
	   							?>
	   								<!-- Muestra el nombre de los países y al POST se le pasa el id del país ($r['country_id']) -->
	       							<option value=<?php echo $r['country_id']; ?>>
	       								<?php echo $r['name']; ?>
	       							</option>
	    						<?php 
	    							endforeach; 
	    						?>
							</select>
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


	