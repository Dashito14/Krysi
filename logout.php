<?php

	//Inicio del procesamiento
	require_once("includes/config.php");

	//Doble seguridad: unset + destroy
	unset($_SESSION["login"]);
	unset($_SESSION["ID"]);
	unset($_SESSION["nombre"]);
	unset($_SESSION["esPiloto"]);

	//Se destruye la sesión
	session_destroy();
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../assets/css/estilo.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Sesión cerrada</title>
	</head>
	<body>
		<div class="contenedor">
			<?php
				require("includes/comun/cabecera.php");		
			?>
				<div class="principal">
					<?php
						require("includes/comun/sidebarIzq.php");
					?>
					<div class="main">
						<!-- Mensaje que se muestra al salir de la aplicación -->
						<h1>Hasta pronto!</h1>
					</div> <!-- Cierre div class="main" -->
				</div> <!-- Cierre div class="principal" -->
			<?php
				require("includes/comun/pie.php");
			?>
		</div> <!-- Cierre div class="contenedor" -->
	</body>
</html>