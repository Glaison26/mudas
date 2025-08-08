<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//echo $c_email;
//die();

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $c_email_envio = 'glaison26.queiroz@gmail.com';
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'glaison26.queiroz@gmail.com';                     //SMTP username
    $mail->Password   = 'dcwy xqvr cqjr zojn';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    //$mail->Port       = 587; 
    //Recipients
    $mail->setFrom($c_email_envio, 'pms');
    //echo $c_email;
    //die;
    $mail->addAddress($c_email, 'pms');     // endereco para onde será enviado
    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $c_assunto;
    $mail->Body    = $c_body;
    $mail->send();
    //echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
//echo "Mensagem enviada com sucesso!";

