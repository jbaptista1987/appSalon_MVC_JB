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
$router->get('/appsalon_mvc/public/index.php', [loginControllers::class, 'login']);
$router->post('/appsalon_mvc/public/index.php', [loginControllers::class, 'login']);
$router->get('/appsalon_mvc/public/index.php/logout', [loginControllers::class, 'logout']);

//Recuperar Password
$router->get('/appsalon_mvc/public/index.php/olvidarpass', [loginControllers::class, 'olvidarpass']);
$router->post('/appsalon_mvc/public/index.php/olvidarpass', [loginControllers::class, 'olvidarpass']);
$router->get('/appsalon_mvc/public/index.php/recuperarpass', [loginControllers::class, 'recuperarpass']);
$router->post('/appsalon_mvc/public/index.php/recuperarpass', [loginControllers::class, 'recuperarpass']);

//Crear Cuenta
$router->get('/appsalon_mvc/public/index.php/crearcta', [loginControllers::class, 'crearcta']);
$router->post('/appsalon_mvc/public/index.php/crearcta', [loginControllers::class, 'crearcta']);

//Confirmar Cuenta
$router->get('/appsalon_mvc/public/index.php/confirmarcta', [loginControllers::class, 'confirmarcta']);

//CRUD Usuarios
$router->get('/appsalon_mvc/public/index.php/crudusuarios', [loginControllers::class, 'crudusuarios']);
$router->post('/appsalon_mvc/public/index.php/crudusuarios', [loginControllers::class, 'crudusuarios']);

//------------********************MANEJO DE CITAS****************---------------------------------//

// Seccion Privada (Solo iniciando Sesion y Teniendo privilegios)
$router->get('/appsalon_mvc/public/index.php/citasIndex',[CitasControllers::class, 'citasIndex']);

//API de Citas
$router->get('/appsalon_mvc/public/index.php/api/servicios',[APIControllers::class, 'index']);
$router->post('/appsalon_mvc/public/index.php/api/citas',[APIControllers::class, 'guardarCita']);
$router->post('/appsalon_mvc/public/index.php/api/eliminarCita',[APIControllers::class, 'eliminarCita']);

//Listar los barberos disponibles para las citas
$router->get('/appsalon_mvc/public/index.php/api/barberos',[APIControllers::class, 'barberos']);
$router->post('/appsalon_mvc/public/index.php/api/barberos',[APIControllers::class, 'barberos']);

//Ingreso por usuario administrador
$router->get('/appsalon_mvc/public/index.php/paneladmin',[AdminControllers::class, 'panelAdmin']);
$router->get('/appsalon_mvc/public/index.php/admin',[AdminControllers::class, 'citasAdmin']);

//-------------*********************MANEJO DE SERVICIOS****************-----------------------------//
//CRUD SERVICIOS
$router->get('/appsalon_mvc/public/index.php/crudservicios', [ServiciosControllers::class, 'crudservicios']);
$router->post('/appsalon_mvc/public/index.php/crudservicios', [ServiciosControllers::class, 'crudservicios']);


//-------------*********************MANEJO DE BARBEROS****************-----------------------------//
//CRUD BARBEROS
$router->get('/appsalon_mvc/public/index.php/crudbarberos', [BarberosControllers::class, 'crudbarberos']);
$router->post('/appsalon_mvc/public/index.php/crudbarberos', [BarberosControllers::class, 'crudbarberos']);


//Prueba de Horario
$router->get('/appsalon_mvc/views/horarios.php',[APIControllers::class, 'barberos']);
$router->comprobarRutas();