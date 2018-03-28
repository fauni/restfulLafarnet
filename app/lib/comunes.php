<?php
namespace App\Lib;

use PDO;
use PHPMailer;

class Comunes
{

    function sendMail($user){
        $mail = new PHPMailer();
        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->CharSet = "UTF-8";
        $mail->Host = 'lafar.net'; // SMTP server
        $mail->SMTPDebug = 1;                     // enables SMTP debug information (for testing)
        // 1 = errors and messages
        // 2 = messages only
        if('1'){
            $mail->SMTPAuth = true;                  // enable SMTP authentication
        }
        else{
            $mail->SMTPAuth = false;                  // enable SMTP authentication
        }
        $mail->Port       = '587';                    // set the SMTP port for the server
        $mail->Username = 'sgd@lafar.net'; // SMTP account username
        $mail->Password = 'K0t0r1';        // SMTP account password
        $mail->SetFrom('sgd@lafar.net', 'Lafarnet 2.0');
        $mail->Subject = 'Solicitud de Cambio de Contraseña';
    
        $body = '
    Estimado '.$user['first_name'].' '.$user['last_name'].',
    <br /><br />
    Recibimos una solicitud para restaurar su contraseña de Lafarnet 2.0. <br />
    Para continuar, por favor haga click en el siguiente enlace:<br /><br />
    <a href="http://intranet.lafar.net:8081/#/restorepass/'.base64_encode($user['username']).'">Cambiar mi Contraseña</a><br /><br />
    Si usted no solicito el cambio de contraseña, solo borre este correo.
    <br /><br />
    Atte,<br />
        Lafarnet 2.0';
        $mail->MsgHTML($body);
        $mail->AddAddress($user['email_address'], $user['first_name'].' '.$user['last_name'] );
        if(!$mail->Send()) {
            echo "Mailer Error (" . str_replace("@", "&#64;", $user['email_address']) . ') ' . $mail->ErrorInfo . '<br />';
            die();
        } else {
            //echo "Message sent to :" . $b["name"]." ".$b["lastname"] . ' (' . str_replace("@", "&#64;", $b["email"]) . ')<br />';
            return 1;
        }
    }
}
