<?php

namespace Controllers;

use Model\Admincitas;
use MVC\Router;

class AdminControllers {

    public static function panelAdmin(Router $router) {
        Loggeado();
        esAdmin();
        $router->render('citas/panelAdmin', [
            //'ObjLogin' => $ObjLogin,
            //'Validador' => $Validador,
            'nombre'=> $_SESSION['Nombre'] . " " . $_SESSION['Apellido'],
            'clienteID' => $_SESSION['ID'],
            'Mensaje' => 'Lo Lograste Baby...'
        ]);
    }

    public static function citasAdmin(Router $router) {
        Loggeado();
        esAdmin();
        $fechaQuery = $_GET['fecha'] ??  date("Y-m-d");

        $query = "SELECT citas.ID, citas.Hora, citas.HoraFin,";
	    $query .= " Concat(clientes.nombre, ' ', clientes.apellido) AS Cliente, clientes.Correo, clientes.Telefono,";
	    $query .= " Master_Servicios.nombre AS Servicio, Master_Servicios.Precio";
        $query .= " FROM Citas";
        $query .= " INNER JOIN clientes ON clientes.ID = citas.clienteID";
        $query .= " INNER JOIN CitasServicios ON CitasServicios.citaID = citas.ID";
        $query .= " INNER JOIN Master_Servicios ON Master_Servicios.ID = citasservicios.servicioID";
        $query .= " WHERE citas.fecha='" . $fechaQuery . "'";
        
        $citasServicios = Admincitas::traer($query);

        //ProbarVariable($citasServicios);

        $router->render('citas/citasAdmin', [
            //'ObjLogin' => $ObjLogin,
            //'Validador' => $Validador,
            'nombre'=> $_SESSION['Nombre'] . " " . $_SESSION['Apellido'],
            'clienteID' => $_SESSION['ID'],
            'citasServicios' => $citasServicios,
            'fechaQuery' => $fechaQuery,
            'Mensaje' => 'Lo Lograste Baby...'
        ]);
    }
}