<?php

require_once("form.php");
require_once("travel.php");
require_once("aplicacion.php");


class formularioUpdate extends Form{

    public function  __construct($formId, $opciones = array() ){
        parent::__construct($formId, $opciones);
    } 

    /**
     * Genera el HTML necesario para presentar los campos del formulario.
     *
     * @param string[] $datosIniciales Datos iniciales para los campos del formulario (normalmente <code>$_POST</code>).
     * 
     * @return string HTML asociado a los campos del formulario.
     */
    protected function generaCamposFormulario($datosIniciales){
         $app = Aplicacion::getInstance();
            $conn = $app->conexionBD();
        $aero = sprintf("SELECT * FROM pilot WHERE user_id = '%d'", $conn->real_escape_string($_SESSION['ID']));
        $a = $conn->query($aero);
        $aerolineapiloto = $a->fetch_assoc();


        $query = sprintf("SELECT * 
                                    FROM available_trip
                                    WHERE travel_id = '%d'",
                                    $conn->real_escape_string($_GET['id']));
                $rs = $conn->query($query);
                $row = $rs->fetch_assoc();
                $acraero = $row['airline_acr'];
                                         

            if($aerolineapiloto['belongs_airline'] == $acraero){
            $query = sprintf("SELECT name, acronym FROM airport ORDER BY name");
            $resultado = $conn->query($query);
            

        $html= '<b>Aeropuerto origen: </b><select name="origen">';
                         foreach ($resultado as $r): 
        $html.= '<option value='.$r['acronym']; $html.='>'.$r["name"]; $html.='</option>';
                            endforeach; 
        $html.= '</select>';
        $html.= '<b>Aeropuerto destino: </b><select name="destino" id="aeropuerto">';
                                           foreach ($resultado as $r): 
                                   $html.= '<option value='.$r['acronym']; $html.='>'.$r["name"]; $html.='</option>';
                            endforeach; 
        $html.= '</select>';
        $html.= '<b>Precio en euros: </b><input type="number" min="1.00" step="0.01" class="campo" name="precio" />';
           $html.=     ' <b>Asientos disponibles: </b><input type="number" min="1" class="campo" name="asientos" />';
           $html.=     ' <button type="submit" id="enviar" name="enviar">Actualizar</button>';
            } else{
                echo "No puedes editar este viaje porque pertenece a ".$acraero." y usted trabaja en ".$aerolineapiloto['belongs_airline'];
                exit();
            }
        

    

        return $html;
    }

    protected function procesaFormulario($datos){

        $erroresFormulario = array();

        $origen = isset($datos['origen']) ? $datos['origen'] : null;

        if (empty($origen) ) {
            $erroresFormulario[] = "El aeropuerto origen no puede estar vacío";
        }
         $destino = isset($datos['destino']) ? $datos['destino'] : null;

        if ( empty($destino) ) {
            $erroresFormulario[] = "El nombre de usuario no puede estar vacío";
        }
         $precio = isset($datos['precio']) ? $datos['precio'] : null;

        if ( empty($precio) ) {
            $erroresFormulario[] = "El nombre de usuario no puede estar vacío";
        }
         $asientos = isset($datos['asientos']) ? $datos['asientos'] : null;

        if ( empty($asientos) ) {
            $erroresFormulario[] = "El nombre de usuario no puede estar vacío";
        }

        if (count($erroresFormulario) === 0) {
            //$app esta incluido en config.php
            $update = Travel::updateTravel($precio, $origen, $destino, $asientos, $_GET['id']);
            if($update){
			 return "search.php";
            }

        }

        return $erroresFormulario;
    }

}