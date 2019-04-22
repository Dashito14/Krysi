<div class="sidebarIzq">
	<?php
		if (isset($_SESSION['login']) && isset($_SESSION['esPiloto'])){
			if($_SESSION['login']){
				if($_SESSION['esPiloto']){
					echo "<a href='../search.php' class='sidebar'>Buscar</a>";
					echo "<a href='../newinserts/newtravel.php' class='sidebar'>Nuevo viaje</a>";
					echo "<a href='../newinserts/newairport.php' class='sidebar'>Nuevo Aeropuerto</a>";
					echo "<a href='../trends/trend.php' class='login'>Más populares</a>";
					echo "<a href='../deletes/delete.php' class='login'>Eliminar</a>";		
				}	else{
				echo "<a href='../search.php' class='sidebar'>Buscar Viaje</a>";
				echo "<a href='../trends/trend.php' class='login'>Más populares</a>";
				}
		}
	}
		else{
			echo "<a href='../trends/trend.php' class='login'>Más populares</a>";	
		}

		
	?>
</div>


