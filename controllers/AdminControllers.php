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

        $query = "SELECT Citas.ID, Citas.Hora, Citas.HoraFin,";
	    $query .= " Concat(Clientes.nombre, ' ', Clientes.apellido) AS Cliente, Clientes.Correo, Clientes.Telefono,";
	    $query .= " Master_Servicios.nombre AS Servicio, Master_Servicios.precio";
        $query .= " FROM Citas";
        $query .= " INNER JOIN Clientes ON Clientes.ID = Citas.clienteID";
        $query .= " INNER JOIN CitasServicios ON CitasServicios.citaID = Citas.ID";
        $query .= " INNER JOIN Master_Servicios ON Master_Servicios.ID = CitasServicios.servicioID";
        $query .= " WHERE Citas.fecha='" . $fechaQuery . "'";
        
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