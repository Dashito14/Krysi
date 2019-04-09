<?php

class formularioBuscar extends Form{


	protected function generaCamposFormulario($datosIniciales){

			$html = '<fieldset>';

			$html .= '<div class="grupo-control">';
			$html .= '<label>Ciudad Origen:</label> <input class="control" type="text" name="username" />';
			$html .= '</div>';

			$html .= '<div class="grupo-control">';
			$html .= '<label>Ciudad Destino:</label> <input class="control" type="password" name="password" />';
			$html .= '</div>';
	
			$html .= '</fieldset>';
			return $html;
    }
	
	
	 protected function procesaFormulario($datos){

        $erroresFormulario = array();

        $username = isset($_POST['username']) ? $_POST['username'] : null;
        if ( empty($username) || mb_strlen($username) < 5 ) {
            $erroresFormulario[] = "El nombre de usuario tiene que tener una longitud de al menos 5 caracteres.";
        }
        
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        if ( empty($password) || mb_strlen($password) < 5 ) {
            $erroresFormulario[] = "El password tiene que tener una longitud de al menos 5 caracteres.";
        }
        $password2 = isset($_POST['password2']) ? $_POST['password2'] : null;
        if ( empty($password2) || strcmp($password, $password2) !== 0 ) {
            $erroresFormulario[] = "Los passwords deben coincidir";
        }

        $accept = isset($_POST['accept']) ? $_POST['accept'] : null; 
        if (empty($accept) || !$accept){
            $erroresFormulario[] = "Debes acceptar los términos y condiciones.";
        }

        $robot = isset($_POST['robot']) ? $_POST['robot'] : null;
        if (empty($robot) || !$robot){
            $erroresFormulario[] = "Debes confirmar que no eres un robot.";
        }
        
        if (count($erroresFormulario) === 0) {
            $usuario = Usuario::crea($username, $password);
            
            if (! $usuario ) {
                $erroresFormulario[] = "El usuario ya existe";
            } else {
                $_SESSION['login'] = true;
                $_SESSION['nombre'] = $username;
                //header('Location: index.php');
                return "index.php";
            }
        }

        return $erroresFormulario;
}