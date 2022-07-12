<?php

namespace Model;

class Usuario extends ActiveRecord {

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id','nombre','apellido','email', 'password','telefono','admin','confirmado','token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = [])    {
        
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';

    }

    public function validarNuevaCuenta()    {
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->apellido){
            self::$alertas['error'][] = 'El apellido es obligatorio';
        }
        if(!$this->telefono){
            self::$alertas['error'][] = 'El telefono es obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        // Validacion de passwords
        if(!$this->password){
            self::$alertas['error'][] = 'La clave es obligatoria';
        }
        /* if(strlen($this->password) < 6){
            self::$alertas['error'][] = "La clave debe tener al menos 6 caracteres";
         }
        elseif(strlen($this->password) > 16){
            self::$alertas['error'][] = "La clave no puede tener más de 16 caracteres";
         }
        elseif (!preg_match('`[a-z]`',$this->password)){
            self::$alertas['error'][] = "La clave debe tener al menos una letra minúscula";
         }
        elseif (!preg_match('`[A-Z]`',$this->password)){
            self::$alertas['error'][] = "La clave debe tener al menos una letra mayúscula";
         }
        elseif (!preg_match('`[0-9]`',$this->password)){
            self::$alertas['error'][] = "La clave debe tener al menos un caracter numérico";
         } */
    
        return self::$alertas;
    
    }

    public function validarLogin()    {
        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][] = 'La clave es obligatoria';
        }
        return self::$alertas;
    }
    public function validarEmail(){
        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        return self::$alertas;
    }

    public function validarUser()    {
        $query = " SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);

        return $resultado;
    }
    public function validarPasswordNueva(){
        if(!$this->password){
            self::$alertas['error'][] = 'La clave es obligatoria';
        }
        /* if(strlen($this->password) < 6){
            self::$alertas['error'][] = "La clave debe tener al menos 6 caracteres";
         }
        elseif(strlen($this->password) > 16){
            self::$alertas['error'][] = "La clave no puede tener más de 16 caracteres";
         }
        elseif (!preg_match('`[a-z]`',$this->password)){
            self::$alertas['error'][] = "La clave debe tener al menos una letra minúscula";
         }
        elseif (!preg_match('`[A-Z]`',$this->password)){
            self::$alertas['error'][] = "La clave debe tener al menos una letra mayúscula";
         }
        elseif (!preg_match('`[0-9]`',$this->password)){
            self::$alertas['error'][] = "La clave debe tener al menos un caracter numérico";
         } */
    
        return self::$alertas;
    }

    public function hashearPassword()    {
        $this->password = password_hash($this->password , PASSWORD_BCRYPT);
    }

    public function crearToken()    {
        $this->token = uniqid();
    }

    public function verificarPasswordHash($password)
    {
        $resultado = password_verify($password, $this->password);
        
        if(!$this->confirmado){
            self::$alertas['error'][] = 'Tu cuenta no ha sido confirmada. Porfavor revisa tu casilla de correo.';
        }
        elseif(!$resultado){
            self::$alertas['error'][] = 'Contraseña incorrecta';
        }
        else{
            return true;
        }
    }
}