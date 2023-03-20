<?php

namespace Controller;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    //-----------------------------------------------------
    public static function login(Router $router){
        $alertas = [];
        $auth = new Usuario();

        //--------------------//
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //**$AUTH = Lo que escriben para Login**//
            //**$USUARIO = Lo que esta almacenado en BD**//
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            //--------------------//
            if(empty($alertas)){
                //Verificar que existe el Usuario
                $usuario = Usuario::where('email', $auth->email);

                //--------------------//
                if($usuario){
                    //--------------------//
                    //Verificar Password
                    if($usuario->comprobarPasswordyConfirmado($auth->password)){
                        session_start();                        
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " " . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;
                        
                        //--------------------//
                        if($usuario->admin){
                            //Es Admin
                            $_SESSION['admin'] = $usuario->admin ?? null;                            
                            header('Location: /admin');

                        } else{
                            //Es cliente
                            header('Location: /cita');
                        }//--------------------//                        
                    }//--------------------//

                }else{
                    Usuario::setAlerta('error', 'Usuario No Registrado');
                }//--------------------//
            }//--------------------//
        }//--------------------//


        $alertas = Usuario::getAlertas();
        
        $router->render('auth/login', [
            'alertas' => $alertas,
            'auth' => $auth
        ]);
    }
    //-----------------------------------------------------


    //-----------------------------------------------------
    public static function logout(Router $router){
        session_start();
        $_SESSION = [];

        header('Location: /');
    }
    //-----------------------------------------------------


    //-----------------------------------------------------
    public static function olvide(Router $router){
        $alertas  = [];

        //--------------------//
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();
            
            //--------------------//
            if(empty($alertas)){
                $usuario = Usuario::where('email', $auth->email);                

                //--------------------//
                if($usuario && $usuario->confirmado === '1'){
                    $usuario->generarToken();
                    $usuario->guardar();

                    //Enviar E-mail
                    $email = new Email(($usuario->email), ($usuario->nombre), ($usuario->token));
                    $email->enviarInstrucciones();

                    Usuario::setAlerta('exito', 'Revise su E-mail');

                }else{
                    Usuario::setAlerta('error', 'Usuario no Existe o No ha sido Confirmado');
                }//--------------------//
            }//--------------------//
        }//--------------------//

        $alertas = Usuario::getAlertas();

        $router->render('auth/olvide', [
            'alertas' => $alertas
        ]);
    }
    //-----------------------------------------------------


    //-----------------------------------------------------
    public static function recuperar(Router $router){
        $alertas = [];
        $error = false;
        
        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);

        //--------------------//
        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token No Válido');
            $error = true;
        }//--------------------//

        //--------------------//
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();            

            //--------------------//
            if(empty($alertas)){
                //Modificar Usuario Confirmado
                $usuario->password = $password->password;                
                $usuario->hashPassword();
                $usuario->token = '';
                $resultado = $usuario->guardar();

                //--------------------//
                if($resultado){
                    header('Location: /');
                }//--------------------//
            }//--------------------//
        }//--------------------//


        $alertas = Usuario::getAlertas();

        $router->render('auth/recuperar', [
            'alertas' => $alertas,
            'error' => $error
        ]);
    }
    //-----------------------------------------------------


    //-----------------------------------------------------
    public static function crearCuenta(Router $router){
        $usuario = new Usuario;
        $alertas = [];

        //--------------------//
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            //--------------------//
            //Revisar la Validación
            if(empty($alertas)){
                //Verificar que el Usuario no esté registrado
                $resultado = $usuario->existeUsuario();
                //--------------------//
                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                } else{
                    //Hashear Password
                    $usuario->hashPassword();
                    //Generar Token
                    $usuario->generarToken();
                    //Enviar E-mail
                    $email = new Email(($usuario->email), ($usuario->nombre), ($usuario->token));
                    $email->enviarConfirmacion();
                    //Guardar Usuario
                    $resultado = $usuario->guardar();

                    if($resultado){
                        header('Location: /mensajeConfirma');
                    }                
                }//--------------------//
            }//--------------------//
        }//--------------------//        

        $router->render('auth/crearCuenta', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }
    //-----------------------------------------------------


    //-----------------------------------------------------
    public static function confirmarCuenta(Router $router){
        $alertas = [];
        $token = s($_GET['token']);

        $usuario = Usuario::where('token', $token);
        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token No Válido');
        } else{
            //Modificar Usuario Confirmado
            $usuario->confirmado = 1;
            $usuario->token = '';
            $usuario->guardar();

            Usuario::setAlerta('exito', 'Has Confirmado Tu Cuenta Correctamente');
        }
        
        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmarCuenta', [
            'alertas' => $alertas
        ]);
    }
    //-----------------------------------------------------


    //-----------------------------------------------------
    public static function mensajeConfirma(Router $router){

        $router->render('auth/mensajeConfirma', []);
    }
    //-----------------------------------------------------
}