<?php

	//Inicio del procesamiento
	require_once("includes/config.php");
	require_once("includes/formularioLogin.php");

?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="assets/css/estilo.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Iniciar Sesión</title>
	</head>
	<body>
		<div id="contenedor">
			<?php
				require("includes/comun/cabecera.php");	
			?>
			<div class="principal">
				<?php
					require("includes/comun/sidebarIzq.php");
				?>
				<div class="main">
					<!-- Título de la página -->
					<h1>Acceso al sistema</h1>
					<?php
						$formulario = new formularioLogin("login");
						$formulario->gestiona();
					?>
				</div> <!-- Cierre div class="main" -->
			</div> <!-- Cierre div class="principal" -->
			<?php
				require("includes/comun/pie.php");
			?>
		</div> <!-- Cierre div class="contenedor" -->
	</body>
</html>