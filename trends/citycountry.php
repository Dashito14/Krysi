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
		<title>Ciudades por país</title>
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
							//Si no está vacía la selección del "POST" entra en el bucle
							if(!empty($_POST)){
								
								$pais= $_POST['pais'];

								//Si no está vacía la variable $pais entra en el bucle, la variable tiene el valor del post elegido por el usuario
								if(!empty($pais)){
									//Coge el nombre de las ciudades distintas que pertenecen al país elegido con $_POST, ordenados por nombre
									$select = sprintf("SELECT DISTINCT c.name FROM city c JOIN country cn WHERE c.country_id = '%d' ORDER BY c.name",
									$conn->real_escape_string($pais));
									$conn = $conn->query($select);
						?>	
						<table>
							<thead>
								<tr>
									<th>Ciudades del país</th>
								</tr>
							</thead>

							<tbody>
								<?php
									while($row = $conn->fetch_assoc()){
								?>
								<tr>
									<td align="center"><?php echo $row['name']; ?></td>
								</tr>
								<?php
									} //Cierre del while
								?>
							</tbody>
						</table>

						<?php
								} //Cierre if(!empty($pais))
							} //Cierre if(!empty($_POST))
						?>

						<!--Etiqueta del select para escoger el país -->
						<a>Elige el país del cual quieres ver las ciudades: </a>
						<select name="pais" id="">
							<?php
								$app = Aplicacion::getInstance();
								$conn = $app->conexionBD();
								//Coge todos los elementos de la tabla "country"
								$query = sprintf("SELECT * FROM country");
								$res = $conn->query($query);
							?>
	   						<?php 
	   							foreach ($res as $r): //Bucle para mostrar todos los países en el select
	   						?>
	   						<!-- Al seleccionar un país por su nombre ($r['name']) se guardará en el $_POST su id ($r['country_id']) -->
	       					<option value=<?php echo $r['country_id']; ?>>
	       						<?php 
	       							echo $r['name']; 
	       						?>
	       					</option>
	    					<?php 
	    						endforeach; 
	    					?>
						</select>
						<!-- Botón buscar -->
						<input type="submit" value="Buscar" />
					</form>
				</div> <!-- Cierre div class="main" -->
			</div> <!-- Cierre div class="principal" -->
			<?php
				require("../includes/comun/pie.php");
			?>
		</div> <!-- Cierre dic class ="contenedor" -->
	</body>
</html>


	