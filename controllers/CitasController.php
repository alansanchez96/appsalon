<?php

namespace Controllers;

use MVC\Router;
use Model\Usuario;

class CitasController {
    public static function index(Router $router)    {
        
        if(!isset($_SESSION)){
            session_start();
        }
        
        isAuth();

        $nombre = $_SESSION['nombre'];

        $router->render('citas/index',[
            'nombre' => $nombre,
            'id' => $_SESSION['id']
        ]);
    }
}