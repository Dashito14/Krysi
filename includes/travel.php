<?php

require_once("includes/aplicacion.php");

class Travel {


	/*-----------------------------------------------*/
	/*updateTravel: Actualiza los valores de un viaje*/
	/*-----------------------------------------------*/
	public static function updateTravel($precio, $origen, $destino, $asiento, $id){
				/*Conexión con la base de datos*/
		    	$app = Aplicacion::getInstance();
		    	$conn = $app->conexionBD();
				/*Actualiza los datos del viaje donde el travel_id sea igual al id que le hemos pasado por el enlance*/
		        $query = sprintf("UPDATE available_trip
									SET price = '%F',
									acr_ori = '%s',
									acr_dst = '%s',
									sits = '%d'
									WHERE travel_id = '%d'", 
									$conn->real_escape_string($precio),
									$conn->real_escape_string($origen),
									$conn->real_escape_string($destino),
									$conn->real_escape_string($asiento),
									$conn->real_escape_string($id));
		        $rs = $conn->query($query);
		        return $rs;
	    	}
	
   

}