<?php 
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require $DIR.'/controlador/PHPMailer/src/Exception.php';
require $DIR.'/controlador/PHPMailer/src/PHPMailer.php';
require $DIR.'/controlador/PHPMailer/src/SMTP.php';

require $DIR.'/controlador/alumnoControlador.php';
require $DIR.'/controlador/profesor/profesorControlador.php';

// $cont =new alumnoControlador();
// $temporal = $cont->buscarAlumno(1);
// echo $temporal[0]->getmateria()[0]->getnombremateria();

     
// $temporal2 = $cont->buscarHorariosDeConsultaDeMateria(1);
// echo $temporal2->getnombremateria();
// echo $temporal2->getid_materia();
// echo $temporal2->getHorarioDeConsulta()[0]->getdia()->getdia();
// echo $temporal2->getHorarioDeConsulta()[0]->gethora();
// echo $temporal2->getHorarioDeConsulta()[0]->getprofesor()->getnombre();
// echo $temporal2->getHorarioDeConsulta()[0]->getprofesor()->getapellido();


// $temporal3 = $cont->buscarHorariosDeConsultaDeMateriaporhoraconsulta(1);
// echo " <br> nuevo <br>";
// //echo $temporal3->getHorarioDeConsulta()[0]->getprofesor()->getnombre();
// echo $temporal3->getnombremateria();
// echo $temporal3->getHoraDeConsulta()[0]->getid_horadeconsulta();
// echo $temporal3->getHoraDeConsulta()[0]->getHorarioDeConsulta()->getid_horarioDeConsulta();
// echo $temporal3->getHoraDeConsulta()[0]->getHorarioDeConsulta()->getdia()->getdia();
// echo $temporal3->getHoraDeConsulta()[0]->getHorarioDeConsulta()->getprofesor()->getnombre();

// echo " <br> nuevo <br>";
// $listaprofesores = $cont->BuscarProfesor();
// echo $listaprofesores[0]->getnombre();
// echo "óáéíúñ";
// echo " <br> nuevo <br>";
// $listProfeHoras=$cont->buscarHorariosDeConsultaporProfesor(2);
// echo $listProfeHoras[0]->getnombre();
// echo $listProfeHoras[1][0]->getid_horadeconsulta();
// echo $listProfeHoras[1][0]->getHorarioDeConsulta()->getdia()->getdia();

// echo "nueva prueba <br>";
// $tf=$cont->AnotadoRepetido(2,1);
// if( $tf){echo 'true';} else { echo 'false';};

// echo "nueva prueba <br>";
// $anotados=$cont->MisAnotaciones(1);
// // echo $anotados->id_horadeconsulta();
// echo '<pre>'; print_r($anotados); echo '</pre>';

// $mail = new PHPMailer(true);

// try {
//     //Server settings
//    $mail->SMTPDebug = 2;                             // Enable verbose debug output
//     $mail->isSMTP();                                            // Set mailer to use SMTP
//     $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
//     $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
//     $mail->Username   = 'consultasutnfrm2019@gmail.com';                     // SMTP username
//     $mail->Password   = '123qweQWE$';                               // SMTP password
//     $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
//     $mail->Port       = 465;                                    // TCP port to connect to

//     //Recipients
//     $mail->setFrom('no-reply@howcode.org');
//     $mail->addAddress('vandenboschlucas@gmail.com');     // Add a recipient
//                  // Name is optional
    

//     // Attachments
   

//     // Content
//     $mail->isHTML(true);                                  // Set email format to HTML
//     $mail->Subject = 'Anotaciones Consulta';
//     $mail->Body    = 'Se anoto juanito';

//     $mail->send();

//     echo 'Message has been sent';
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }


$a =new profesorControlador ;
// $listaDedicaciones = $a->buscarMateriasProfesor(2);
// echo '<pre>'; print_r($listaDedicaciones); echo '</pre>';
echo 'buscarHorariodeConsultadeMateriadeProfesor'.'<br>';
$ded=$a->buscarHorariodeConsultadeMateriadeProfesor(1,2);
echo '<pre>'; print_r($ded); echo '</pre>';
echo 'alumnosAnotados'.'<br>';
$ded=$a->alumnosAnotados(2);
echo '<pre>'; print_r($ded); echo '</pre>';
echo(strtotime("next Monday") . "<br>");
echo 'hayAvisosProfesor';
echo $a->hayAvisosProfesor($ded);
echo"detallealumnosAnotados:";
$t= $a->detallealumnosAnotados(2);
echo '<pre>'; print_r($t); echo '</pre>';
echo $a->buscarMateriaDeHoradeconsulta(2);

$tf=$a->mayorMentorigual("18:47:47.000000","==","18","47");
if($tf){echo "true";}
else echo "false";

alert("Hello World");

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
$t=$a->horarioIngresadoIgualAlAnterior(5,'08','00',2,2,1);
if($t){
    echo "TRUE";
}else{
    echo "FLASE";
}
?>

