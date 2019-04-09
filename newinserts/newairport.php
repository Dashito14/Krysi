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
			<h1>Insertar nuevo aeropuerto</h1>			
				<form class="insertar" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">

	<?php
			$app = Aplicacion::getInstance();
			$conn = $app->conexionBD();
			$query = sprintf("SELECT city_id, name FROM city ORDER BY name");
			$resultado = $conn->query($query);

	?>
				<b>Ciudad a la que pertenece: </b><select name="city" id="">
   										 	<?php foreach ($resultado as $r): ?>
       									 	<option value=<?php echo $r['city_id']; ?>><?php echo $r['name']; ?></option>
    										<?php endforeach; ?>
										</select>
				<b>Si no encuentras la ciudad <a href="newcity.php">pulsa aquí</a></b>
				<b>Nombre del aeropuerto: </b><input type="text" class="campo" name="nombre" />
				<b>Código IATA: </b><input type="text" maxlength="3" name="IATA" />
				<input type="submit" id="enviar" name="enviar" value="Insertar" />
<?php

	if(!empty($_POST)){
		$ciudad= $_POST['city'];
		$aeropuerto= $_POST['nombre'];
		$iata= $_POST['IATA'];

		if(!empty($ciudad) && !empty($aeropuerto) && !empty($iata)){
			$app = Aplicacion::getInstance();
			$conn = $app->conexionBD();

			$query = sprintf("INSERT INTO airport(city_id, acronym, name) VALUES ('%d', '%s', '%s')", 
					$conn->real_escape_string($ciudad),
					$conn->real_escape_string($iata),
					$conn->real_escape_string($aeropuerto));
			$conn = $conn->query($query);
		}
	}

?>
	
				</form>
		
		</div>

	</div>

<?php
	require("../includes/comun/pie.php");
?>


</div>

</body>
</html>