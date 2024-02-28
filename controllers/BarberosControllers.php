<?php

namespace Controllers;

use Model\AppSalon;
use Model\Barberos;
use MVC\Router;

class BarberosControllers extends AppSalon {

    public static function crudbarberos(Router $router) {
        Loggeado();
        esAdmin();
        $ObjBarberos = Barberos::all();

        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            header('Content-Type: application/json');

            if($_POST['accion'] == 'eliminar'){
                $IDs = $_POST['IDs'];
                $query = "DELETE FROM Master_Barberos WHERE ID IN" .  $IDs;
                $objAdminBarberos = Barberos::ejecutar($query);
                
                echo json_encode($objAdminBarberos);
                return;
            }

            if($_POST['accion'] == 'crear'){
                $objAdminBarberos2 = new Barberos($_POST);
                $objAdminBarberos2->sincronizar($_POST);

                $Validador = array();
                $Validador = $objAdminBarberos2->validarBarberoNuevo();

                if( empty($Validador) ) {
                    //Registrar al Usuario
                    $resultado =  $objAdminBarberos2->crear();
                    
                    if ($resultado['resultado']) {
                        echo json_encode($resultado);
                        return;
                    }
                }
            }
        }

        $router->render('barberos/crudbarberos', [
            'nombre'=> $_SESSION['Nombre'] . " " . $_SESSION['Apellido'],
            'clienteID' => $_SESSION['ID'],
            'ObjBarberos' => $ObjBarberos,
            //'Validador' => $Validador,
            'Mensaje' => 'Lo Lograste Baby...'
        ]);
    }
}