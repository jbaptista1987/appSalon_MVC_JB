<?php

namespace Model;

class Admincitas extends AppSalon {

    //Base de Datos
    protected static $tabla = 'CitasServicios';
    protected static $columnasDB = ['ID', 'Hora', 'HoraFin', 'Cliente', 'Correo', 'Telefono', 'Servicio', 'precio'];
    public $ID, $Hora, $HoraFin, $Cliente, $Correo, $Telefono, $Servicio, $precio;

    public function __construct( $args = [] )
    {
        $this->ID=$valores['ID'] ?? '';
        $this->Hora=$valores['Hora'] ?? '';
        $this->HoraFin=$valores['HoraFin'] ?? '1';   
        $this->Cliente=$valores['Cliente'] ?? '';
        $this->Correo=$valores['Correo'] ?? '';
        $this->Telefono=$valores['Telefono'] ?? '';
        $this->Servicio=$valores['Servicio'] ?? '';
        $this->precio=$valores['precio'] ?? '';    
    }
}