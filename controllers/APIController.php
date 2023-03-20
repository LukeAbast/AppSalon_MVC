<?php

namespace Controller;

use Model\Citas;
use Model\CitasServicios;
use Model\Servicios;

class APIController {
    public static function index(){
        $servicios = Servicios::all();
        echo json_encode($servicios);
        
    }

    //Almacena la CITA y devuelve el ID
    public static function guardar(){
        $cita = new Citas($_POST);
        $resultado = $cita->guardar();

        $idCita = $resultado['id'];

        //Almacena los SERVICIOS con el ID de la Cita
        $idServicios = explode(",", $_POST['servicios']);
        foreach($idServicios as $idServicio){
            $args = [
                'citas_ID' => $idCita,
                'servicios_ID' => $idServicio
            ];
            $citasServicios = new CitasServicios($args);
            $citasServicios->guardar();
        }

        $respuesta = [
            'resultado' => $resultado
        ];

        echo json_encode($respuesta);
    }

    public static function eliminar(){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $cita = Citas::find($id);
            $cita->eliminar();

            header('Location:' . $_SERVER['HTTP_REFERER']);            
        }
    }
}