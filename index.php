<?php
	//Inicio del procesamiento
	require_once("includes/config.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="assets/css/estilo.css" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Portada</title>
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
				<div class="contenido">
					<!-- Título página -->
					<h1 align="center">Bienvendi@ a Krysi</h1>
					<!-- Presentación de la página -->
					<p align="center"> Krysi es un buscador/comparador de viajes poco realista. Dividido en dos tipos de usuarios:
							usuarios normales y pilotos. Los usuarios normales podrán acceder al ránking en el que se clasifican ciudades,
							países, aerolíneas y más cosas; además podrán acceder al buscador para comprar los billetes que quieran, 
							tendrán disponible una pestaña perfil para que puedan ver cuantos viajes tienen pendientes y cuáles son. Los pilotos
							tendrán los mismos accesos que los usuarios normales y además podrán eliminar, añadir y actualizar viajes, ciudades, países
							y aeropuertos. Cada piloto pertenece a una aerolínea distinta y cada aerolínea solo tiene un piloto. No hay ninguna forma
							en la aplicación en la que se puedan añadir nuevas aerolíneas o pilotos. Para agregarlas habrá que hacerlo desde la propia base
							de datos. Espero que disfrute de la aplicación! </p>
				</div> <!-- Cierre class = "contenido" --> 
			</div> <!-- Cierre class = "main" -->
			<?php 
				require("includes/comun/pie.php"); 
			?>
		</div> <!-- Cierre class = "contenedor" -->
	</body>
</html>