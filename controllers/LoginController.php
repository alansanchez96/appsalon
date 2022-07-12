<?php 

namespace Controllers;

use MVC\Router;
use Classes\Email;
use Model\Usuario;

class LoginController {
    public static function login(Router $router){
        
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();

            if(empty($alertas)){
                // Comprobar que el user existe en db
                $usuario = Usuario::where('email', $auth->email);
                
                if($usuario){
                    // Comprobar contraseña
                    $resultado = $usuario->verificarPasswordHash($auth->password);
                    if($resultado){
                        // Que el usuario ya mantenga su sesion iniciada
                        if(!isset($_SESSION)){
                            session_start();
                        }
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . ' ' . $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;
                        
                        if($usuario->admin === '1'){
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        }else{
                            header('Location: /citas');
                        }
                    }
                }
                else{
                    Usuario::setAlerta('error','Email no registrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/login',[
            'alertas' => $alertas
        ]);
    }
    public static function logout(){
        
        if(!isset($_SESSION)){
            session_start();
        }
        $_SESSION = [];

        header('Location: /');

    }

    public static function forgot(Router $router){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);

            $alertas = $auth->validarEmail();
            
            if(empty($alertas)){
                // Comprobar que email exista en nuestra db
                $usuario = Usuario::where('email', $auth->email);

                if($usuario && $usuario->confirmado === '1'){
                    // Generar el token
                    $usuario->crearToken();
                    $usuario->guardar();
                    // Enviar correo de confirmacion
                    $mail = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $mail->reestablecerPassword();
                    
                    Usuario::setAlerta('exito','Se han enviado las instrucciones a tu correo.');
                }
                else{
                    Usuario::setAlerta('error','Email no registrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        
        $router->render('auth/forgot-password', [
            'alertas' => $alertas
        ]);
    }
    public static function recover(Router $router){
        $alertas = [];
        $token = s($_GET['token']);
        $error = false;

        $usuario = Usuario::where('token' , $token);
        
        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token no válido');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $userClave = new Usuario($_POST);
            $alertas = $userClave->validarPasswordNueva();

            if(empty($alertas)){
                $usuario->password = '';
                $usuario->password = $userClave->password;
                $usuario->hashearPassword();

                $usuario->token = '';
                $resultado = $usuario->guardar();
                if($resultado){
                    header('Location: /');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/recover-password',[
            'alertas' => $alertas,
            'error' => $error
        ]);
    }

    public static function register(Router $router){

        $usuario = new Usuario;
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $usuario->sincronizar($_POST);      // Parametros al __constructor
            $alertas = $usuario->validarNuevaCuenta();

            if(empty($alertas)){

                $resultado = $usuario->validarUser();

                if($resultado->num_rows){
                    
                    $alertas = Usuario::getAlertas();
                    $alertas['error'][] = 'El email ya está registrado';

                }
                elseif($resultado->num_rows === 0){
                    $usuario->hashearPassword();
                    $usuario->crearToken();

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();

                    $resultado = $usuario->guardar();
                    if($resultado){
                        header('Location: /mensaje');
                    }

                }

            }
        }

        $router->render('auth/register', [
            'usuario' => $usuario,
            'alertas' => $alertas
        ]);
    }

    public static function confirm(Router $router){

        $alertas = [];

        $token = s($_GET['token']);
        $usuario = Usuario::where( 'token' , $token );

        if(empty($usuario)){
            $alertas = Usuario::setAlerta('error', 'Token no válido');
        } else{
            $usuario->confirmado = '1';
            $usuario->token = '';
            $usuario->guardar();

            $alertas = Usuario::setAlerta('exito', 'Cuenta confirmada exitosamente');
        }

        $alertas = Usuario::getAlertas();

        $router->render('auth/confirmar-cuenta',[
            'alertas' => $alertas
        ]);
    }
    public static function message(Router $router){

        $router->render('auth/mensaje');
    }
}