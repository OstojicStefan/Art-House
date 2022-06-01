<?php

namespace App\Http\Controllers\nikola;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;

class MailController extends Controller
{

    function sendTestMail()
    {

        $name = "Art House";
        $to = "arthousemailer@gmai.com"; //kome saljemo
        $subject = "Test";
        $body = "Send mail using PHPMailer";
        $from = "arthousemailer@gmai.com";
        $password = "Sifra12345";


        require_once "app/public/includes/PHPMailer-master/src/PHPMailer.php";
        require_once "app/public/includes/PHPMailer-master/src/SMTP.php";
        require_once "app/public/includes/PHPMailer-master/src/Exception.php";
        $mail = new PHPMailer();

        $mail->isSMTP();
        //$mail->SMTPDebug = 3;
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = "true";
        $mail->SMTPSecure = "tls";
        $mail->Port = "587";
        $mail->Username = $from;
        $mail->Password = $password;
        $mail->Subject = $subject;
        $mail->Body = "This is plain text email body";
        $mail->smtpConnect(
            [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ]
        );

        $mail->isHTML(true);
        $mail->setFrom($from, $name);
        $mail->addAddress($to);
        $mail->Subject = ("$subject");
        $mail->Body = $body;
        if ($mail->send()) {
            echo 'brao';
        } else {
            echo 'lose';
        }
        //$mail->smtpClose(); nzm zasto u tutorijai nisu stavili ovo
    }
}
