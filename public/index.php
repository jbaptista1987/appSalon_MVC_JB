<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\APIControllers;
use Controllers\loginControllers;
use Controllers\CitasControllers;
use Controllers\AdminControllers;
use Controllers\ServiciosControllers;
use Controllers\BarberosControllers;

use MVC\Router;

$router = new Router();

//------------********************MANEJO DE SESION****************---------------------------------//
//Iniciar y Cerrar Sesion
$router->get('/', [loginControllers::class, 'login']);
$router->post('/', [loginControllers::class, 'login']);
$router->get('/logout', [loginControllers::class, 'logout']);

//Recuperar Password
$router->get('/olvidarpass', [loginControllers::class, 'olvidarpass']);
$router->post('/olvidarpass', [loginControllers::class, 'olvidarpass']);
$router->get('/recuperarpass', [loginControllers::class, 'recuperarpass']);
$router->post('/recuperarpass', [loginControllers::class, 'recuperarpass']);

//Crear Cuenta
$router->get('/crearcta', [loginControllers::class, 'crearcta']);
$router->post('/crearcta', [loginControllers::class, 'crearcta']);

//Confirmar Cuenta
$router->get('/confirmarcta', [loginControllers::class, 'confirmarcta']);

//CRUD Usuarios
$router->get('/crudusuarios', [loginControllers::class, 'crudusuarios']);
$router->post('/crudusuarios', [loginControllers::class, 'crudusuarios']);

//------------********************MANEJO DE CITAS****************---------------------------------//

// Seccion Privada (Solo iniciando Sesion y Teniendo privilegios)
$router->get('/citasIndex',[CitasControllers::class, 'citasIndex']);

//API de Citas
$router->get('/api/servicios',[APIControllers::class, 'index']);
$router->post('/api/citas',[APIControllers::class, 'guardarCita']);
$router->post('/api/eliminarCita',[APIControllers::class, 'eliminarCita']);

//Listar los barberos disponibles para las citas
$router->get('/api/barberos',[APIControllers::class, 'barberos']);
$router->post('/api/barberos',[APIControllers::class, 'barberos']);

//Ingreso por usuario administrador
$router->get('/paneladmin',[AdminControllers::class, 'panelAdmin']);
$router->get('/admin',[AdminControllers::class, 'citasAdmin']);

//-------------*********************MANEJO DE SERVICIOS****************-----------------------------//
//CRUD SERVICIOS
$router->get('/crudservicios', [ServiciosControllers::class, 'crudservicios']);
$router->post('/crudservicios', [ServiciosControllers::class, 'crudservicios']);


//-------------*********************MANEJO DE BARBEROS****************-----------------------------//
//CRUD BARBEROS
$router->get('/crudbarberos', [BarberosControllers::class, 'crudbarberos']);
$router->post('/crudbarberos', [BarberosControllers::class, 'crudbarberos']);


$router->comprobarRutas();