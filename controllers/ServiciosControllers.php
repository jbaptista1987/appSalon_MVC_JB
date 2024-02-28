<?php

namespace Controllers;

use Model\AppSalon;
use Model\Servicios;
use MVC\Router;

class ServiciosControllers extends AppSalon {

    public static function crudservicios(Router $router) {
        Loggeado();
        esAdmin();
        $ObjServicio = Servicios::all();

        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            header('Content-Type: application/json');

            if($_POST['accion'] == 'eliminar'){
                $IDs = $_POST['IDs'];
                $query = "DELETE FROM Master_Servicios WHERE ID IN" .  $IDs;
                $objAdminServicio = Servicios::ejecutar($query);
                
                echo json_encode($objAdminServicio);
                return;
            }

            if($_POST['accion'] == 'crear'){
                $objAdminServicio2 = new Servicios($_POST);
                $objAdminServicio2->sincronizar($_POST);

                $Validador = array();
                $Validador = $objAdminServicio2->validarServNuevo();

                if( empty($Validador) ) {
                    //Registrar al Usuario
                    $resultado =  $objAdminServicio2->crear();
                    
                    if ($resultado['resultado']) {
                        echo json_encode($resultado);
                        return;
                    }
                }

                echo json_encode($objAdminServicio2);
                return;
            }
        }

        $router->render('servicios/crudservicios', [
            'nombre'=> $_SESSION['Nombre'] . " " . $_SESSION['Apellido'],
            'clienteID' => $_SESSION['ID'],
            'ObjServicio' => $ObjServicio,
            //'Validador' => $Validador,
            'Mensaje' => 'Lo Lograste Baby...'
        ]);
    }


}