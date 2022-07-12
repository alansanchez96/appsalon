<?php

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController {
    public static function index(Router $router){

        if(!isset($_SESSION)){
            session_start();
        }

        isAdmin();

        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-', $fecha);

        if( !checkdate($fechas[1], $fechas[2], $fechas[0])){
            header('Location: /404');
        }

        $query = "SELECT ";
        $query.= " citas.id, ";
        $query.= " citas.hora, ";
        $query.= " CONCAT(usuarios.nombre, ' ', usuarios.apellido) as Cliente,";
        $query.= " usuarios.email, usuarios.telefono, ";
        $query.= " servicios.nombre as Servicios, ";
        $query.= " servicios.precio ";
        $query.= " FROM citas ";
        $query.= " LEFT JOIN usuarios ON usuarios.id = citas.usuarioId";
        $query.= " LEFT JOIN citasservicios ON citasservicios.citaId = citas.id";
        $query.= " LEFT JOIN servicios ON servicios.id = citasservicios.servicioId";
        $query.= " WHERE fecha = '${fecha}'; ";

        $citas = AdminCita::SQL($query);

        $router->render('admin/index', [
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'fecha' => $fecha
        ]);
    }
}