<?php 
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $DIR.'/controlador/PHPMailer/src/Exception.php';
require $DIR.'/controlador/PHPMailer/src/PHPMailer.php';
require $DIR.'/controlador/PHPMailer/src/SMTP.php';


function enviaremail($destino,$mensaje){
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                             
    $mail->isSMTP();    
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth   = true;                              
    $mail->Username   = 'consultasutnfrm2019@gmail.com';    
    $mail->Password   = '123qweQWE$';                 
    $mail->SMTPSecure = 'ssl';                       
    $mail->Port       = 465;                 

    //Recipients
    $mail->setFrom('no-reply@howcode.org');
    foreach ($destino as $email) {
        $mail->addAddress($email);    
    }

    $mail->isHTML(true);
    $mail->Subject = 'Anotaciones Consulta';
    $mail->Body    = $mensaje;

    $mail->send();

    $mensaje= 'Message has been sent';
} catch (Exception $e) {
    $mensaje= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
return $mensaje;
}
?>

