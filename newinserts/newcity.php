<?php

//Inicio del procesamiento
require_once("../includes/config.php");
require_once("../includes/aplicacion.php");

	if(!empty($_POST)){
		$pais= $_POST['country'];
		$nombre= $_POST['nombre'];

		if(!empty($pais) && !empty($nombre)){
			$app = Aplicacion::getInstance();
			$conn = $app->conexionBD();

			$query = sprintf("INSERT INTO city(name, country_id) VALUES ('%s', '%d')", 
					$conn->real_escape_string($nombre),
					$conn->real_escape_string($pais));
			$conn = $conn->query($query);
		}
	}
	
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
			<h1>Insertar nueva ciudad</h1>			
				<form class="insertar" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">

	<?php
			$app = Aplicacion::getInstance();
			$conn = $app->conexionBD();
			$query = sprintf("SELECT country_id, name FROM country ORDER BY name");
			$resultado = $conn->query($query);

	?>
				<b>País al que pertenece: </b><select name="country" id="">
   										 	<?php foreach ($resultado as $r): ?>
       									 	<option value=<?php echo $r['country_id']; ?>><?php echo $r['name']; ?></option>
    										<?php endforeach; ?>
										</select>
				<b>Si no encuentras el país <a href="newcountry.php">pulsa aquí</a></b>
				
				<b>Nombre de la ciudad:  </b><input type="text" class="campo" name="nombre" />
				<input type="submit" id="enviar" name="enviar" value="Insertar" />
				<b>Para volver a introducir un nuevo aeropuerto <a href="newairport.php">pulsa aquí</a></b>
				</form>
		
		</div>

	</div>

<?php
	require("../includes/comun/pie.php");
?>


</div>

</body>
</html>