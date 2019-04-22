<?php

//Inicio del procesamiento
require_once("includes/config.php");

//Doble seguridad: unset + destroy
unset($_SESSION["login"]);
unset($_SESSION["ID"]);
unset($_SESSION["nombre"]);
unset($_SESSION["esPiloto"]);


session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../assets/css/estilo.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Adiós</title>
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
		<h1>Hasta pronto!</h1>
	</div>
	</div>

<?php
	require("includes/comun/pie.php");
?>


</div>

</body>
</html>