<?php

namespace Model;

class Servicios extends AppSalon{

    //Base de Datos
    protected static $tabla = 'Master_Servicios';
    protected static $columnasDB = ['ID','nombre','precio','Tiempo'];
    public $ID, $nombre, $precio, $Tiempo;

    public function __construct( $args = [] )
    {
        $this->ID=$valores['ID'] ?? '';
        $this->nombre=$valores['nombre'] ?? '';
        $this->precio=$valores['precio'] ?? ''; 
        $this->Tiempo=$valores['Tiempo'] ?? '';      
    }

    public function validarServNuevo(){

        if(!$this->nombre){
            self::$Validador['error'][] = '* El Nombre del Servicio es Requerido';
        }
        if(!$this->precio){
            self::$Validador['error'][] = '* El Precio del Servicio es Requerido';
        }
        if(!$this->Tiempo){
            self::$Validador['error'][] = '* El Tiempo del Servicio es Requerido';
        }

        return self::$Validador;
    }

}