<?php

namespace Model;

class Clientes extends AppSalon {
    protected static $tabla = 'Clientes';
    protected static $columnasDB = ['ID','Doc','Identificacion','Nombre','Apellido', 'Correo','Telefono','Usuario','Clave','Tipo_Usuario','Token','Estatus','captchaGoogle'];

    public $ID, $Doc, $Identificacion, $Nombre, $Apellido, $Correo, $Telefono, $Usuario, $Clave, $Tipo_Usuario, $Token, $Estatus, $captchaGoogle;

    public function __construct( $valores = [] )
    {
        $this->ID=$valores['ID'] ?? '';
        $this->Doc=$valores['Doc'] ?? '';
        $this->Identificacion=$valores['Identificacion'] ?? '';
        $this->Nombre=$valores['Nombre'] ?? '';
        $this->Apellido=$valores['Apellido'] ?? '';
        $this->Correo=$valores['Correo'] ?? '';
        $this->Telefono=$valores['Telefono'] ?? '';
        $this->Usuario=$valores['Usuario'] ?? '';
        $this->Clave=$valores['Clave'] ?? '';
        $this->Tipo_Usuario=$valores['Tipo_Usuario'] ?? '';
        $this->Token=$valores['Token'] ?? '';
        $this->Estatus=$valores['Estatus'] ?? '1';
        $this->captchaGoogle=$valores['captchaGoogle'] ?? false;
    }

    public function validarCtaNueva(){
      
        if(!$this->Doc){
            self::$Validador['error'][] = '* V o E es Requerido';
         }
         if(!$this->Identificacion){
            self::$Validador['error'][] = '* CI o RIF es Requerida';
         }
         if(!$this->Nombre){
            self::$Validador['error'][] = '* Nombre es Requerido';
         }
         if(!$this->Apellido){
            self::$Validador['error'][] = '* Apellido es Requerido';
         }
         if(!$this->Telefono || !$this->validarTelefono($this->Telefono)){
            self::$Validador['error'][] = '* Telefono es Requerido y con Formato XXXX-XXXXXXX';
         }
         if(!$this->Correo || !$this->validarEmail($this->Correo) ) {
            self::$Validador['error'][] = '* Correo en formato Valido es Requerido';
         }      
         if(!$this->Usuario){
            self::$Validador['error'][] = '* Usuario es Requerido';
         }
         if(!$this->Clave){
            self::$Validador['error'][] = '* Clave es Requerida';
         }
         if(!$this->Tipo_Usuario){
            self::$Validador['error'][] = '* Tipo de Usuario es Requerido';
         }       
         
        return self::$Validador;
    }

    public static function validarTelefono($tel) {
      if (strlen($tel) != 12) {
          return false;
      }
  
      if (!preg_match("/^\d{4}-\d{7}$/", $tel)) {
          return false;
      }
  
      return true;
   }

  public function validarLogIn(){
      if(!$this->Usuario){
          self::$Validador['error'][] = '* Usuario es Requerido';
       }
       if(!$this->Clave){
          self::$Validador['error'][] = '* Clave es Requerida';
       }
       if($this->captchaGoogle == false){
          self::$Validador['error'][] = '* El Captcha es Requerido';
       }
               
       
      return self::$Validador;
  }

  public function valNuevaClave(){
      if(!$this->Clave){
          self::$Validador['error'][] = '* Clave es Requerida';
       }
       return self::$Validador;
  }

  public function hashPassword(){
      //Has el Password e insertarlo en el Objeto Login
      $this->Clave = password_hash($this->Clave, PASSWORD_BCRYPT); 
  }

}
