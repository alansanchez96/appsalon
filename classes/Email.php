<?php


namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }
    public function enviarConfirmacion()
    {
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '1fc07c2e83af5e';
        $mail->Password = 'bad3f9441b0970';

        $mail->setFrom('administrador@appsalon.com', 'AppSalon.com');
        $mail->addAddress('administrador@appsalon.com');

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Confirmación de Cuenta APPSalon';

        $contenido = "<html>";
        $contenido .= "<h1 style='margin:0 0 .5em;font-size:28px;font-weight:300;line-height:130%'>Hello " . $this->nombre . "!</h1>";
        $contenido .= "<p>Haga clic en el botón de abajo para verificar su dirección de correo electrónico.</p>";
        $contenido .= '<tbody>
                        <tr>
                            <td style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;line-height:100%" valign="top" align="center">
                                <a href="http://localhost:3000/confirmar-cuenta?token='.$this->token.'" style="text-decoration:none;white-space:nowrap;font-weight:600;font-size:16px;padding:12px 32px;border-radius:3px;line-height:100%;display:block;border:1px solid transparent;background-color:#467fcf;color:#fff;border-color:#467fcf" target="_blank">
                                    <span style="color:#fff;font-size:16px;text-decoration:none;white-space:nowrap;font-weight:600;line-height:100%">Confirmar Cuenta</span>
                                </a>
                            </td>
                        </tr>
                    </tbody>';
        $contenido .= "<p>Si no creó una cuenta, ignore este mensaje.</p>";
        $contenido .= "<p>Saludos!</p><p>APPSalon Team</p>";
        $contenido .= "<p>Si tiene problemas para hacer clic en el botón 'Confirmar Cuenta', copie y pegue la siguiente URL en su navegador web: </p>";
        $contenido .= "<a href='http://localhost:3000/confirmar-cuenta?token=".$this->token."'>http://localhost:3000/confirmar-cuenta?token=".$this->token."</a>";
        $contenido .= "</html>";

        $mail->Body = $contenido;
        $mail->send();

    }

    public function reestablecerPassword()
    {
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '1fc07c2e83af5e';
        $mail->Password = 'bad3f9441b0970';

        $mail->setFrom('administrador@appsalon.com', 'AppSalon.com');
        $mail->addAddress('administrador@appsalon.com');

        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = 'Restablecer Contraseña APPSalon';

        $contenido = "<html>";
        $contenido .= "<h1 style='margin:0 0 .5em;font-size:28px;font-weight:300;line-height:130%'>Hello " . $this->nombre . "!</h1>";
        $contenido .= "<p>Haga clic en el botón de abajo para restablecer su contraseña.</p>";
        $contenido .= '<tbody>
                        <tr>
                            <td style="font-family:Open Sans,-apple-system,BlinkMacSystemFont,Roboto,Helvetica Neue,Helvetica,Arial,sans-serif;line-height:100%" valign="top" align="center">
                                <a href="http://localhost:3000/recover-password?token='.$this->token.'" style="text-decoration:none;white-space:nowrap;font-weight:600;font-size:16px;padding:12px 32px;border-radius:3px;line-height:100%;display:block;border:1px solid transparent;background-color:#467fcf;color:#fff;border-color:#467fcf" target="_blank">
                                    <span style="color:#fff;font-size:16px;text-decoration:none;white-space:nowrap;font-weight:600;line-height:100%">Restablecer Clave</span>
                                </a>
                            </td>
                        </tr>
                    </tbody>';
        $contenido .= "<p>Si no solicitó ésta acción, revise la seguridad de su cuenta.</p>";
        $contenido .= "<p>Saludos!</p><p>APPSalon Team</p>";
        $contenido .= "<p>Si tiene problemas para hacer clic en el botón 'Restablecer Clave', copie y pegue la siguiente URL en su navegador web: </p>";
        $contenido .= "<a href='http://localhost:3000/recover-password?token=".$this->token."'>http://localhost:3000/recover-password?token=".$this->token."</a>";
        $contenido .= "</html>";

        $mail->Body = $contenido;
        $mail->send();

    }
}