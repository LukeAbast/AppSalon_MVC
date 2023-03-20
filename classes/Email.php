<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $email;
    public $nombre;
    public $token;

    //-----------------------------------------------------
    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }
    //-----------------------------------------------------


    //-----------------------------------------------------
    public function enviarConfirmacion() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '4fbc07691b3355';
        $mail->Password = 'fc187425f4db38';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Confirma tu Cuenta';

        //Set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        //Contenido del Mensaje

        $contenido = "<html>";
        $contenido .= "<p>Hola <strong>" . $this->nombre . "</strong>. Has creado tu cuenta en AppSalon, solo debes confirmarla presionando el siguiente enlace:</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmarCuenta?token=" . $this->token . "'>Confirmar Cuenta</a> </p>"; 
        $contenido .= "<p>Si no has sido tú, ignora este mensaje</p>";
        $contenido .= "</html>";
        //---------------------

        $mail->Body = $contenido;

        //Enviar Mail
        $mail->send();
    }
    //-----------------------------------------------------


    //-----------------------------------------------------
    public function enviarInstrucciones() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '4fbc07691b3355';
        $mail->Password = 'fc187425f4db38';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail->Subject = 'Reestablece tu Password';

        //Set HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';

        //Contenido del Mensaje

        $contenido = "<html>";
        $contenido .= "<p>Hola <strong>" . $this->nombre . "</strong>. Has solicitado Reestablecer tu Password en AppSalon. Presiona el siguiente enlace:</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/recuperar?token=" . $this->token . "'>Reestablecer Password</a> </p>"; 
        $contenido .= "<p>Si no has sido tú, ignora este mensaje</p>";
        $contenido .= "</html>";
        //---------------------

        $mail->Body = $contenido;

        //Enviar Mail
        $mail->send();
    }
    //-----------------------------------------------------
}