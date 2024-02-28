<?php

namespace Controllers;
use MVC\Router;

class CitasControllers{

    public static function citasIndex(Router $router){
        //ProbarVariable($_SESSION);

        Loggeado();
        
        $router->render('citas/citasIndex', [
            //'ObjLogin' => $ObjLogin,
            //'Validador' => $Validador,
            'nombre'=> $_SESSION['Nombre'] . " " . $_SESSION['Apellido'],
            'Mensaje' => 'Lo Lograste Baby...'
        ]);
    }
}