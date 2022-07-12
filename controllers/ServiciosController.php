<?php

namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServiciosController {
    public static function index(Router $router){

        if(!isset($_SESSION)){
            session_start();
        }

        isAdmin();

        $servicio = Servicio::all();

        $router->render('servicios/index',[
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio
        ]);
    }

    public static function crear(Router $router){
        // method $router->get
        if(!isset($_SESSION)){
            session_start();
        }
        isAdmin();

        $servicio = new Servicio;
        $alertas = [];

        // method $router->post
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $servicio->sincronizar($_POST);
            
            $alertas = $servicio->validar();
            if(empty($alertas)){
                $servicio->guardar();
                header('Location: /servicios');
            }
        }

        $router->render('servicios/crear',[
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function actualizar(Router $router){
        // method $router->get
        if(!isset($_SESSION)){
            session_start();
        }
        isAdmin();

        if(!is_numeric($_GET['id'])) return;
        $servicio = Servicio::find($_GET['id']);
        $alertas = [];

        // method $router->post
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();
            if(empty($alertas)){
                $servicio->guardar();
                header('Location: /servicios');
            }
        }

        $router->render('servicios/actualizar',[
            'nombre' => $_SESSION['nombre'],
            'servicio' => $servicio,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar(){
        // method $router->get
        if(!isset($_SESSION)){
            session_start();
        }
        isAdmin();
        // method $router->post
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $id = $_POST['id'];
            $servicio = Servicio::find($id);
            $servicio->eliminar();
            header('location: /servicios');

        }
    }
}