<?php

namespace Model;

class CitasServicios extends AppSalon {

    protected static $tabla = 'CitasServicios';
    protected static $columnasDB = ['ID','citaID','servicioID'];

    public $ID, $fecha, $hora, $clienteID;

    public function __construct( $valores = [] )
    {
        $this->ID=$valores['ID'] ?? '';
        $this->citaID=$valores['citaID'] ?? '';
        $this->servicioID=$valores['servicioID'] ?? '';
    }
}