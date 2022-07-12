<?php

namespace Controllers;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController {

    public static function index(){

        $servicios = Servicio::all();
        echo json_encode($servicios);
        
    }

    public static function obtenerCitas(){

        $cita = new Cita($_POST);

        
        $resultado = $cita->guardar();
        $id = $resultado['id'];
        $serviciosId = explode(',', $_POST['servicios']);

        foreach ($serviciosId as $servicioId) {
            $argumentos = [
                'citaId' => $id,
                'servicioId' => $servicioId
            ];

            $citaServicio = new CitaServicio($argumentos);
            $citaServicio->guardar();
        }

        $respuesta = [
            'resultado' => $resultado
        ];

        echo json_encode($respuesta);
    }

    public static function eliminar(){

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();
            header('Location: '. $_SERVER['HTTP_REFERER']);
        }


    }
}