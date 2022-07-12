<?php

namespace Model;

class AdminCita extends ActiveRecord{

    protected static $tabla = 'citasservicios';
    protected static $columnasDB = ['id','hora','Cliente','email','telefono','Servicios','precio'];

    public $id;
    public $hora;
    public $Cliente;
    public $email;
    public $telefono;
    public $Servicios;
    public $precio;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->hora = $args['hora'] ?? '';
        $this->Cliente = $args['Cliente'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->Servicios = $args['Servicios'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

}