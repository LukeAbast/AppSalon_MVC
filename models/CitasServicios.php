<?php

namespace Model;

class CitasServicios extends ActiveRecord{
    //Base de Datos
    protected static $tabla = 'citasservicios';
    protected static $columnasDB = ['id', 'citas_ID', 'servicios_ID'];

    public $id;
    public $citas_ID;
    public $servicios_ID;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->citas_ID = $args['citas_ID'] ?? '';
        $this->servicios_ID = $args['servicios_ID'] ?? '';
    }
    
    
}