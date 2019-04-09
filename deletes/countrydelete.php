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
					<form class="insertar" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
						<?php
							if(!empty($_POST)){
								
								$pais= $_POST['origen'];
echo $pais;
								if(!empty($pais)){

									$select = sprintf("DELETE FROM country WHERE country_id = '%d'",
									$conn->real_escape_string($pais));
									$conn = $conn->query($select);

							
							
									
						}

}
?>
	<a>Elige el país que quieres eliminar: </a>
		<select name="origen" id="">
				<?php
					$app = Aplicacion::getInstance();
					$conn = $app->conexionBD();
					$query = sprintf("SELECT * FROM country");
					$res = $conn->query($query);
				?>
   				<?php foreach ($res as $r): ?>
       					<option value=<?php echo $r['country_id']; ?>><?php echo $r['name']; ?></option>
    			<?php endforeach; ?>
	</select>
	<input type="submit" value="buscar" />
	</form>
</div>

</div>
<?php
	require("../includes/comun/pie.php");
?>




</body>
</html>


	