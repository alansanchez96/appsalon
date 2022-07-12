<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use MVC\Router;
use Controllers\APIController;
use Controllers\CitasController;
use Controllers\LoginController;
use Controllers\ServiciosController;

$router = new Router();

// Log in - out
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

// Recuperar password
$router->get('/forgot-password', [LoginController::class, 'forgot']);
$router->post('/forgot-password', [LoginController::class, 'forgot']);
$router->get('/recover-password', [LoginController::class, 'recover']);
$router->post('/recover-password', [LoginController::class, 'recover']);

// Crear Cuenta
$router->get('/register', [LoginController::class, 'register']);
$router->post('/register', [LoginController::class, 'register']);
// Confirmacion
$router->get('/confirmar-cuenta', [LoginController::class, 'confirm']);
$router->get('/mensaje', [LoginController::class, 'message']);


// ZONA PRIVADA
$router->get('/citas', [CitasController::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']);

// API
$router->get('/api/servicios', [APIController::class, 'index']);
$router->post('/api/citas', [APIController::class, 'obtenerCitas']);
$router->post('/api/eliminar', [APIController::class, 'eliminar']);

// CRUD servicios
$router->get('/servicios', [ServiciosController::class, 'index']);
$router->get('/servicios/crear', [ServiciosController::class, 'crear']);
$router->post('/servicios/crear', [ServiciosController::class, 'crear']);
$router->get('/servicios/actualizar', [ServiciosController::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServiciosController::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServiciosController::class, 'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();