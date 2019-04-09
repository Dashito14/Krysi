<?php

require_once('aplicacion.php');

class Usuario {

    private $id;
    private $username;
    private $password;
 


    private function __construct($username, $userpass){
        $this->username= $username;
        $this->password = $userpass;
    }

    public function id(){ 
        return $this->id; 
    }

    public function rol(){ 
        return $this->rol;
     }

    public function nombreUsuario(){
        return $this->nombreUsuario;
    }

    public function cambiaPassword($nuevoPassword){
        $this->password = self::hashPassword($nuevoPassword);
    }


    /* Devuelve un objeto Usuario con la información del usuario $username,
     o false si no lo encuentra*/
    public static function buscaUsuario($username){
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBD();
		/*Coge todas las columnas de la tabla "users" de la fila en la que user_name sea igual a $username*/
        $query = sprintf("SELECT * FROM users U WHERE U.user_name = '%s'", $conn->real_escape_string($username));
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            if ( $rs->num_rows == 1) {
                $fila = $rs->fetch_assoc();
                $user = new Usuario($fila['user_name'], $fila['user_pass']);
                $user->id = $fila['user_id'];
                $result = $user;
            }
            $rs->free();
        } else {
            echo "Error al consultar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $result;
    }

    /*Comprueba si la contraseña introducida coincide con la del Usuario.*/
    public function compruebaPassword($password){
        return password_verify($password, $this->password);
    }

    /* Devuelve un objeto Usuario si el usuario existe y coincide su contraseña. En caso contrario,
     devuelve false.*/
    public static function login($username, $password){
        $user = self::buscaUsuario($username);
        if ($user && $user->compruebaPassword($password)) {
            return $user;
        }
        return false;
    }
    
    /* Crea un nuevo usuario con los datos introducidos por parámetro. */
    public static function crea($username, $password){
        $user = self::buscaUsuario($username);
        if ($user) {
            return false;
        }
        $user = new Usuario($username, password_hash($password, PASSWORD_DEFAULT));
        return self::guarda($user);
    }
    
    
    public static function guarda($usuario){
        if ($usuario->id !== null) {
            return self::actualiza($usuario);
        }
        return self::inserta($usuario);
    }
    
    private static function inserta($usuario){
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBD();
        $query=sprintf("INSERT INTO users(user_name, user_pass) VALUES('%s', '%s')"
            , $conn->real_escape_string($usuario->username)
            , $conn->real_escape_string($usuario->password));

        if ( $conn->query($query) ){
            $usuario->id = $conn->insert_id;
            $query=sprintf("INSERT INTO normal_user(user_id, pending) VALUES('%s', 'false')"
            , $conn->real_escape_string($usuario->id()));
            $rs = $conn->query($query);

        } else {
            echo "Error al insertar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        return $usuario;
    }
    
    private static function actualiza($usuario){
        $app = Aplicacion::getInstance();
        $conn = $app->conexionBD();
        $query=sprintf("UPDATE users U SET user_name = '%s', user_pass='%s' WHERE U.id=%i"
            , $conn->real_escape_string($usuario->username)
            , $conn->real_escape_string($usuario->password)
            , $usuario->id);
        if ( $conn->query($query) ) {
            if ( $conn->affected_rows != 1) {
                echo "No se ha podido actualizar el usuario: " . $usuario->id;
                exit();
            }
        } else {
            echo "Error al actualizar en la BD: (" . $conn->errno . ") " . utf8_encode($conn->error);
            exit();
        }
        
        return $usuario;
    }
    
}
