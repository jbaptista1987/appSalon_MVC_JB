<?php

namespace Model;

class Citas extends AppSalon {

    protected static $tabla = 'Citas';
    protected static $columnasDB = ['ID','fecha','hora', 'horaFin','clienteID','empleadoID'];

    public $ID, $fecha, $hora, $horaFin, $clienteID, $empleadoID;

    public function __construct( $valores = [] )
    {
        $this->ID=$valores['ID'] ?? '';
        $this->fecha=$valores['fecha'] ?? '';
        $this->hora=$valores['hora'] ?? '';
        $this->horaFin=$valores['horaFin'] ?? '';
        $this->clienteID=$valores['clienteID'] ?? '';
        $this->empleadoID=$valores['empleadoID'] ?? '';
    }
}