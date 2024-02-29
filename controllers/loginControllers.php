<?php

namespace Controllers;

use GuzzleHttp\Client;
use MVC\Router;
use Model\Clientes;

class loginControllers {

    public static function login(Router $router){
        //Objeto y Validador para Usuario
        $ObjLogin = new Clientes();
        $Validador = [];

        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            //Validacion del CAPTCHA de Google reCAPTCHA V2
            //$ip = $_SERVER['REMOTE_ADDR'];
            
            $captcha = $_POST["g-recaptcha-response"];
            $secretkey = $_ENV['GOOGLE_RECAPTCHA_KEY_BACK'];
            $respuestaCaptcha = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha&remoteip=localhost");
            $atributos = json_decode($respuestaCaptcha, true);
            //Llenar el Objeto de Login con los datos de Usuario, Clave y Captcha Validado
            $ObjLogin->sincronizar($_POST);
            $ObjLogin->captchaGoogle = $atributos['success'];
            
            //Validar que los datos esten llenos
            $Validador = $ObjLogin->validarLogIn();
            
            if( empty( $Validador ) ) {
                
                //Validar en BD el Usuario y la Clave
                $LoginApp = Clientes::findfirst("ID, Clave, Tipo_Usuario, Doc, Identificacion, Nombre, Apellido, Correo, Telefono ", "WHERE Usuario='" . $ObjLogin->Usuario . "' AND Estatus='2'");
                if( !empty($LoginApp) ) {
                    if ( password_verify($ObjLogin->Clave, $LoginApp->Clave) ) {
                       
                        $_SESSION['ID'] = $LoginApp->ID;
                        $_SESSION['Tipo_Usuario'] = $LoginApp->Tipo_Usuario;
                        $_SESSION['Loggeado'] = true;

                        //Datos del Cliente
                        $_SESSION['Doc'] = $LoginApp->Doc;
                        $_SESSION['Identificacion'] = $LoginApp->Identificacion;
                        $_SESSION['Nombre'] = $LoginApp->Nombre;
                        $_SESSION['Apellido'] = $LoginApp->Apellido;
                        $_SESSION['Correo'] = $LoginApp->Correo;
                        $_SESSION['Telefono'] = $LoginApp->Telefono;

                        switch ($LoginApp->Tipo_Usuario) {
                            case 1:
                                header('Location: /citasIndex');
                                break;
                            case 2:
                                header('Location: /citasIndex');
                                break;
                            case 3:
                                header('Location: /paneladmin');
                                break;
                        }
                        //Se que lo idea es un IF ELSE pero lo hago asi por tema de futuro crecimiento
                    }
                    else{
                        //Mensaje de error de Usuario o Clave Invalida - Por Motivos de Seguridad NO decir que la clave esta errada
                        $Validador['error'][] = "* Usuario o Clave Invalida(C)";
                    }
                }else{
                    //Mensaje de Usuario o Clave Invalida - Por Motivos de Seguridad NO decir que el usuario no existe
                    $Validador['error'][] = "* Usuario o Clave Invalida(U)";
                }
            } // Fin de la Validacion del reCAPTCHA V2 Google
            
            
        } //Fin del Metodo POST

       $router->render('autenticar/login', [
            //'ObjLogin' => $ObjLogin,
            'Validador' => $Validador,
            'Mensaje' => 'Lo Lograste Baby...'
        ]);
    }

    public static function logout(){
        $_SESSION = [];
        header('Location: /');

    }

    
    public static function olvidarpass(Router $router){
        $Validador = [];

        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            $ObjCliente = new Clientes($_POST);
            $Validador = $ObjCliente->validarEmail($ObjCliente->Correo);
            
            if( $Validador ) {
                $Validador = [];
                //Buscar los datos necesarios para envio de Token al correo
                $valUsuarioCorreo = Clientes::findfirst("ID, Usuario, Nombre, Apellido", "WHERE Correo='" . $ObjCliente->Correo . "'");
                
                if ( !empty($valUsuarioCorreo) ){
                    $valUsuarioCorreo->Correo = $ObjCliente->Correo;
                    
                    //Ejecuto el proceso de recuperacion
                    $valUsuarioCorreo->generarToken();
                    $resultado = $valUsuarioCorreo->actualizarToken();
                    
                    if ($resultado){
                        tokenRecPassResend($valUsuarioCorreo->Nombre . " " . $valUsuarioCorreo->Apellido . " (" . $valUsuarioCorreo->Usuario . ")", $valUsuarioCorreo->Token, $valUsuarioCorreo->Usuario, $valUsuarioCorreo->Correo);
                        $Validador['msjExito'][] = "* Token enviado al correo. Confirmar el enlace";
                    }

                }else{
                    $Validador['error'][] = "* Usuario No Registrado, No Confirmado o No Aprobado";
                }
            }
        }
        //ProbarVariable($Validador);
        $router->render('autenticar/olvidarpass', [
            //'ObjLogin' => $ObjLogin,
            'Validador' => $Validador,
            'Mensaje' => 'Lo Lograste Baby...'
        ]);
    }

    public static function recuperarpass(Router $router){
        $ObjLogin = new Clientes($_GET);
        $Validador = [];

         //Validar que tanto usuario como Token existen en la BD
         $valTokenUser = Clientes::findfirst('ID', "WHERE Usuario='" . dep($ObjLogin->Usuario) . "' AND Token='" . dep($ObjLogin->Token) . "' AND Estatus='2'");
         
         if( !empty($valTokenUser) ){
             $ObjLogin->setCampoObjeto($valTokenUser->ID,'ID');
         }else{
            header('Location: /index.php');
         }

        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            $ObjLogin->setCampoObjeto(dep($_POST['Clave']),'Clave');
            $ObjLogin->hashPassword();
            $nuevaClave = $ObjLogin->actNuevaClave();
            if ( $nuevaClave ) {
                $Validador['msjExito'][] = "* Clave Actualizada con Exito. Inicie Sesion";
            }
        }

        $router->render('autenticar/recuperarpass', [
            //'ObjLogin' => $ObjLogin,
            'Validador' => $Validador,
            'Mensaje' => 'Lo Lograste Baby...'
        ]);
    }

    public static function crearcta(Router $router){
        //Objeto y Validador para Usuario
        $ObjLogin = new Clientes();
        $Validador = [];

        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            //Llenar el objeto de Login y Validar sus campos esten llenos
            $ObjLogin->sincronizar($_POST);
            $Validador = $ObjLogin->validarCtaNueva();
            
            if( empty($Validador)  ) {
                $ObjLogin->hashPassword();
                
                //Validar que el usuario no este en uso
                $valUsuarioCorreo = Clientes::findfirst("ID", "WHERE Usuario='" . $ObjLogin->Usuario . "'");
                
                if ( !empty($valUsuarioCorreo) ) {
                    $Validador['error'][] = "* Usuario en Uso";
                }else{
                    $valUsuarioCorreo = Clientes::findfirst("ID", "WHERE Correo='" . $ObjLogin->Correo . "'");
                    if ( !empty($valUsuarioCorreo) ) {
                        $Validador['error'][] = "* Correo en Uso";
                    }else{
                        $ObjLogin->generarToken();
                        //Registrar Usuario - Obtener el ultimo ID y Registrar al cliente
                        $resultado =  $ObjLogin->crear();
                        //ProbarVariable($ObjLogin);
                        if ($resultado['resultado']) {
                            //$idInsertado = $resultado['ID'];
                            enviarTokenEmailResend($ObjLogin->Nombre . " " . $ObjLogin->Apellido . " (" . $ObjLogin->Usuario . ")", $ObjLogin->Token, $ObjLogin->Usuario, $ObjLogin->Correo);
                            echo "<script>alert('Registro de Usuario Exitoso');parent.location ='/'</script>";
                        }
                    }
                }
            }
        }
        $router->render('autenticar/crearcta', [
            'ObjLogin' => $ObjLogin,
            //'ObjCliente' => $ObjCliente,
            'Validador' => $Validador,
            'Mensaje' => 'Lo Lograste Baby...'
        ]);
    }

    public static function confirmarcta(Router $router){
        $ObjLogin = new Clientes($_GET);
        $valTokenEmail = Clientes::findfirst("ID, Tipo_Usuario", "WHERE Usuario='" . dep($ObjLogin->Usuario) . "' AND Token='" . dep($ObjLogin->Token) . "'");
        if ( !empty($valTokenEmail) ) {
            //Modifico el Registro
            if($valTokenEmail->Tipo_Usuario == '1'){
                $nuevoUsuarioEstatus = '2';
            }else{
                $nuevoUsuarioEstatus = '1';
            }

            $valTokenEmail->ActRegistroUsuario( $nuevoUsuarioEstatus ,$valTokenEmail->ID);
            if ($valTokenEmail) {
                $router->render('autenticar/confirmarcta', [
                    //'ObjLogin' => $ObjLogin,
                    //'Validador' => $Validador,
                    'nuevoUsuarioEstatus' => $nuevoUsuarioEstatus,
                    'Mensaje' => 'Lo Lograste Baby...'
                ]);
            }
            else{
                header('Location: /');
            }
        }else{
            header('Location: /');
        }
    }

    public static function crudusuarios(Router $router) {

        Loggeado();
        esAdmin();
        
        $query = "SELECT ID, Doc, Identificacion, Nombre, Apellido, Correo, Telefono, Usuario, Tipo_Usuario, Estatus ";
        $query .= "FROM Clientes ";
        $query .= "WHERE Tipo_Usuario<>'3'";

        $ObjLogin = Clientes::traer($query);

        $ObjLogin2 = new Clientes();
        
       
        if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
            header('Content-Type: application/json');

            if($_POST['accion'] == 'modificar'){
                $IDs = $_POST['IDs'];
                $nuevoEstatus = $_POST['estatus'];
                $query = "UPDATE Clientes SET Estatus='" . $nuevoEstatus . "' WHERE ID IN" .  $IDs;

                $objAdminUsuario = Clientes::ejecutar($query);
                
                echo json_encode($objAdminUsuario);
                return;
            }
            
            if($_POST['accion'] == 'crear') {
                header('Content-Type: application/json');
                $ObjLogin2 = new Clientes($_POST);
                $Validador = array();
                $Validador = $ObjLogin2->validarCtaNueva();
                
                if( empty($Validador) ){
                    $ObjLogin2->hashPassword();

                    //Validar que el usuario no este en uso
                    $valUsuarioCorreo = Clientes::findfirst("ID", "WHERE Usuario='" . $ObjLogin2->Usuario . "'");

                    if ( !empty($valUsuarioCorreo) ) {
                        echo json_encode( ['ErrorU' => 'Usuario en Uso' ] );
                        return;                     
                    }
                    else{
                        $valUsuarioCorreo = Clientes::findfirst("ID", "WHERE Correo='" . $ObjLogin2->Correo . "'");
                        if ( !empty($valUsuarioCorreo) ) {
                            echo json_encode( ['ErrorC' => 'Correo en Uso' ] );
                            return;
                        }
                        else{
                            //Registrar al Usuario
                            $resultado =  $ObjLogin2->crear();
                            if ($resultado['resultado']) {
                                echo json_encode($resultado);
                                return;
                            }
                            
                        }
                            
                            /*if ($resultado['resultado']) {
                                echo json_encode( ['Exito' => 'Usuario Registrado con Exito' ] );
                                return;
                            }*/
                    }
                }
            }
        }

        $router->render('autenticar/crudusuarios', [
            'ObjLogin' => $ObjLogin,
            'ObjLogin2' => $ObjLogin2,
            //'Validador' => $Validador,
            'nombre'=> $_SESSION['Nombre'] . " " . $_SESSION['Apellido'],
            'clienteID' => $_SESSION['ID'],
            'Mensaje' => 'Lo Lograste Baby...'
        ]);
    }
}