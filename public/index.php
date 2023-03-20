<?php 

require_once __DIR__ . '/../includes/app.php';

use Controller\AdminController;
use Controller\APIController;
use Controller\CitaController;
use MVC\Router;
use Controller\LoginController;
use Controller\ServicioController;

$router = new Router();

//Iniciar Sesion
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);
//--------------

//Recuperar Password
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);
//------------------


//Crear Cuenta
$router->get('/crearCuenta', [LoginController::class, 'crearCuenta']);
$router->post('/crearCuenta', [LoginController::class, 'crearCuenta']);
//------------


//Confirmar Cuenta
$router->get('/confirmarCuenta', [LoginController::class, 'confirmarCuenta']);
$router->get('/mensajeConfirma', [LoginController::class, 'mensajeConfirma']);
//------------

//------------------------------AREA PRIVADA---------------------///
//Cita
$router->get('/cita', [CitaController::class, 'index']);
//------------
//Admin
$router->get('/admin', [AdminController::class, 'index']);
//------------

//API de Citas
$router->get('/api/servicios', [APIController::class, 'index']);
$router->post('/api/citas', [APIController::class, 'guardar']);
$router->post('/api/eliminar', [APIController::class, 'eliminar']);
//------------

//Servicios
$router->get('/servicios', [ServicioController::class, 'index']);
$router->get('/servicios/crear', [ServicioController::class, 'crear']);
$router->post('/servicios/crear', [ServicioController::class, 'crear']);
$router->get('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServicioController::class, 'eliminar']);
//------------


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();