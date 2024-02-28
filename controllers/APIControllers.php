<?php

namespace Controllers;

use Model\Citas;
use Model\CitasServicios;
use Model\Servicios;
use Model\Barberos;

class APIControllers {

    public static function index(){
        //Al Abrir la Pagina de Generar Cita, se listan los servicios para ser seleccionados y asignados a la cita
        header('Content-Type: application/json');
        
        $objServicios = Servicios::all();
        echo json_encode($objServicios);
    }

    public static function guardarCita(){

        //Almacena la Cita y Devuelve el ID de esa cita creada
        $objCita = new Citas($_POST);
        
        /*Descomentar para ver en consola que informacion LLEGO al Back End
        echo json_encode($objCita);
        return;*/
        $resultado = $objCita->crear();
        $serviciosID = explode( ",", $_POST['servicioID'] );
        
        //Descomentar para ver los ID de Servicios recibidos en el Back End
        /*$resultado = [
            'servicios' => $serviciosID
        ];
        echo json_encode($resultado);
        return;*/
        
        foreach( $serviciosID as $servicioID ) {
            $args = [
                'citaID' => $resultado['ID'],
                'servicioID' => $servicioID
            ];
            
            $citasServicios = new CitasServicios($args);
            $citasServicios->crear();
        }
        
        $respuesta = [
            'resultado' => $resultado
        ];
        
        echo json_encode($respuesta);
    }


    public static function barberos() {
        header('Content-Type: application/json');

        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            $datosQuery = new Citas($_POST);
            
            $query = "SELECT m.ID, m.nombre";
            $query .= " FROM Master_Barberos m";
            $query .= " LEFT JOIN Citas c ON m.ID = c.empleadoID";
            $query .= " AND c.fecha='" . $datosQuery->fecha . "' AND c.hora BETWEEN '" . $datosQuery->hora . "' AND '" . $datosQuery->horaFin . "'";
            $query .= " WHERE c.ID IS NULL";
            //echo json_encode($query);

            $objBarberos = Barberos::traer($query);
            echo json_encode($objBarberos);
        } 
    }

    public static function eliminarCita() {
        
        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            $citaID = $_POST['ID'];
            

            $eliminarCita = new Citas();
            $eliminarCita->eliminarID($citaID);
            if($eliminarCita){
                $eliminarCitaServ = new CitasServicios();
                $eliminarCitaServ->eliminarCitasServicios($citaID);

                if($eliminarCitaServ){
                    header('Location:' . $_SERVER['HTTP_REFERER']);
                }
            }

            
            
        }
    }
}