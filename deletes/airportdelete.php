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
								
								$aeropuerto= $_POST['airport'];

								if(!empty($aeropuerto)){

									$select = sprintf("DELETE FROM airport WHERE acronym = '%s'",
									$conn->real_escape_string($aeropuerto));
									$conn = $conn->query($select);

							
							
									
						}

}
?>
	<a>Elige el país que quieres eliminar: </a>
		<select name="airport" id="">
				<?php
					$app = Aplicacion::getInstance();
					$conn = $app->conexionBD();
					$query = sprintf("SELECT * FROM airport");
					$res = $conn->query($query);
				?>
   				<?php foreach ($res as $r): ?>
       					<option value=<?php echo $r['acronym']; ?>><?php echo $r['name']; ?></option>
    			<?php endforeach; ?>
	</select>
	<input type="submit" value="Eliminar" />
	</form>
</div>

</div>
<?php
	require("../includes/comun/pie.php");
?>




</body>
</html>


	