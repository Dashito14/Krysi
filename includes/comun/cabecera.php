<div class="cabecera">

	<img src="../assets/img/krysi.png" />

	<div id="link">
		<?php
			if (isset($_SESSION["login"]) && ($_SESSION["login"]===true)) {
				echo "Bienvenido, " . $_SESSION['nombre'] .
				". <a href='perfil.php' class='perfil'>Perfil</a>
				<a href='logout.php' class='salir'>Salir</a>";		
			} else {
				//Poner class para los enlaces?? y enlazarlo con CSS
				echo "<a href='login.php' class='login'>Iniciar sesión</a> 
				<a href='registro.php' class='registro'>Registrarse</a>";
			}
		?>
	</div>
</div>
