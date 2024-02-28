<?php

namespace Model;

class Barberos extends AppSalon{

    //Base de Datos
    protected static $tabla = 'Master_Barberos';
    protected static $columnasDB = ['ID', 'nombre', 'sede'];
    public $ID, $nombre, $sede;

    public function __construct( $args = [] )
    {
        $this->ID=$valores['ID'] ?? '';
        $this->nombre=$valores['nombre'] ?? '';
        $this->sede=$valores['sede'] ?? '1';       
    }

    public function validarBarberoNuevo(){

        if(!$this->nombre){
            self::$Validador['error'][] = '* El Nombre del Barbero es Requerido';
        }
        if(!$this->sede){
            self::$Validador['error'][] = '* La Sede es Requerida';
        }

        return self::$Validador;
    }

}