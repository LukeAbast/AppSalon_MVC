<?php

namespace Model;

class Citas extends ActiveRecord{
    //Base de Datos
    protected static $tabla = 'citas';
    protected static $columnasDB = ['id', 'fecha', 'hora', 'usuarios_ID'];

    public $id;
    public $fecha;
    public $hora;
    public $usuarios_ID;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->usuarios_ID = $args['usuarios_ID'] ?? '';
    }
    
    
}