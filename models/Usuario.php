<?php
namespace Model;

class Usuario extends ActiveRecord {

    // Base DE DATOS
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;
    

    //-----------------------------------------------------
    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? null;
        $this->confirmado = $args['confirmado'] ?? null;
        $this->token = $args['token'] ?? '';
    }
    //-----------------------------------------------------


    //-----------------------------------------------------
    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'Nombre Obligatorio';
        }
        if(!$this->apellido){
            self::$alertas['error'][] = 'Apellido Obligatorio';
        }
        if(!$this->telefono){
            self::$alertas['error'][] = 'Telefono Obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][] = 'E-mail Obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][] = 'Password Obligatorio';
        }else{
            if(strlen($this->password) < 6){
                self::$alertas['error'][] = 'El Password debe contener al menos 6 Caracteres';
            }
        }
        

        return self::$alertas;
    }
    //-----------------------------------------------------


    //-----------------------------------------------------
    public function validarLogin(){
        if(!$this->email){
            self::$alertas['error'][] = 'E-mail Obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][] = 'Password Obligatorio';
        }
        

        return self::$alertas;
    }
    //-----------------------------------------------------


    //-----------------------------------------------------
    public function validarEmail(){
        if(!$this->email){
            self::$alertas['error'][] = 'E-mail Obligatorio';
        }        

        return self::$alertas;
    }
    //-----------------------------------------------------


    //-----------------------------------------------------
    public function validarPassword(){
        if(!$this->password){
            self::$alertas['error'][] = 'Password Obligatorio';
        }else{
            if(strlen($this->password) < 6){
                self::$alertas['error'][] = 'El Password debe contener al menos 6 Caracteres';
            }
        }        

        return self::$alertas;
    }
    //-----------------------------------------------------


    //-----------------------------------------------------
    public function existeUsuario(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        
        $resultado = self::$db->query($query);
        
        if($resultado->num_rows){
            self::$alertas['error'][] = 'El Usuario Ya Existe';
        }

        return $resultado;

    }
    //-----------------------------------------------------


    //-----------------------------------------------------
    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    //-----------------------------------------------------


    //-----------------------------------------------------
    public function generarToken(){
        $this->token = uniqid();
    }
    //-----------------------------------------------------


    //-----------------------------------------------------
    public function comprobarPasswordyConfirmado($password){
        $resultado = password_verify($password, $this->password);
        
        if((!$resultado) || (!$this->confirmado)){
            self::$alertas['error'][] = 'Password Incorrecto o Cuenta sin Verificar';
        }else{
            return true;
        }
    }
    //-----------------------------------------------------

}