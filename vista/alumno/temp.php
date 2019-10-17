<?php 
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';


// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require $DIR.'/controlador/PHPMailer/src/Exception.php';
// require $DIR.'/controlador/PHPMailer/src/PHPMailer.php';
// require $DIR.'/controlador/PHPMailer/src/SMTP.php';

// require $DIR.'/controlador/alumnoControlador.php';
// require $DIR.'/controlador/profesor/profesorControlador.php';
require $DIR.$conexion;
require $DIR.$Asueto;
require_once ($DIR . $Alumno);
require_once ($DIR . $Materia);
require_once ($DIR . $HorarioDeConsulta);
require_once ($DIR . $Profesor);
require_once ($DIR . $HoraDeConsulta);
require_once ($DIR . $Departamento);
require_once ($DIR . $AnotadosEstado);
require_once ($DIR . $DetalleAnotados);
require_once ($DIR . $EstadoAnotados);
require_once ($DIR . $AvisoProfesor);
require_once ($DIR . $Dedicacion);



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


// $a =new profesorControlador ;
// // $listaDedicaciones = $a->buscarMateriasProfesor(2);
// // echo '<pre>'; print_r($listaDedicaciones); echo '</pre>';
// echo 'buscarHorariodeConsultadeMateriadeProfesor'.'<br>';
// $ded=$a->buscarHorariodeConsultadeMateriadeProfesor(1,2);
// echo '<pre>'; print_r($ded); echo '</pre>';
// echo 'alumnosAnotados'.'<br>';
// $ded=$a->alumnosAnotados(2);
// echo '<pre>'; print_r($ded); echo '</pre>';
// echo(strtotime("next Monday") . "<br>");
// echo 'hayAvisosProfesor';
// echo $a->hayAvisosProfesor($ded);
// echo"detallealumnosAnotados:";
// $t= $a->detallealumnosAnotados(2);
// echo '<pre>'; print_r($t); echo '</pre>';
// echo $a->buscarMateriaDeHoradeconsulta(2);

// $tf=$a->mayorMentorigual("18:47:47.000000","==","18","47");
// if($tf){echo "true";}
// else echo "false";

// alert("Hello World");

// function alert($msg) {
//     echo "<script type='text/javascript'>alert('$msg');</script>";
// }
// $t=$a->horarioIngresadoIgualAlAnterior(5,'08','00',2,2,1);
// if($t){
//     echo "TRUE";
// }else{
//     echo "FLASE";
// }


 //echo '<pre>'; print_r(BuscarMateriasAAsistir(1)); echo '</pre>';   
 $con= new conexion();
 $conn=$con->getconexion();

 $stmt = $conn->prepare("SELECT id_detalleanotados,fk_horadeconsulta FROM detalleanotados where fk_alumno=1 "); 
 $stmt->execute();
 if($stmt->rowCount() == 0) {
echo "vacio";
 }
 function BuscarMateriasAAsistir($idalumno){
    $con= new conexion();
    $conn=$con->getconexion();

    $ListDetalles=array();
 
    $stmt = $conn->prepare("SELECT id_detalleanotados,fk_horadeconsulta FROM detalleanotados where fk_alumno=$idalumno "); 
    $stmt->execute();
   
        while($row = $stmt->fetch()) {
                $detalle = new Detalleanotados();
                $detalle->setid_detalleanotados($row['id_detalleanotados']);
                $detalle->setfk_horadeconsulta($row['fk_horadeconsulta']);

                $iddetalle=$row['id_detalleanotados'];
                $Estados=array();

                $stmt2 = $conn->prepare("SELECT id_anotadoestado,fechaAnotadosEstado,horaAnotadosEstado,fk_estadoanotados FROM anotadosestado where fk_detalleanotados=$iddetalle "); 
                $stmt2->execute();
                while($row = $stmt2->fetch()) {
                    $anotado = new AnotadosEstado();
                    $anotado->setid_anotadosEstado($row['id_anotadoestado']);
                    $anotado->setfechaAnotadosEstado($row['fechaAnotadosEstado']);
                    $anotado->sethoraAnotadosEstado($row['horaAnotadosEstado']);
                    $idnombreestado=$row['fk_estadoanotados'];

                    $stmt3 = $conn->prepare("SELECT nombreEstado,id_estadoanotados FROM estadoanotados where id_estadoanotados=$idnombreestado "); 
                    $stmt3->execute();
                    while($row = $stmt3->fetch()) {
                        $estado = new EstadoAnotados();
                        $estado->setnombreEstado($row['nombreEstado']);
                        $estado->setid_estadoanotados($row['id_estadoanotados']);
                        $anotado->setEstadoAnotados($estado);       
                    }
                
                        array_push($Estados,$anotado);
                }
                $detalle->setAnotadosEstado($Estados);
                array_push($ListDetalles,$detalle);
        } 
        
        $ListHoraDeConsulta=array();
       
       foreach ($ListDetalles as $detalle) {
        
        //    echo $detalle->getAnotadosEstado()[0]->getid_anotadosEstado();
          $d= $detalle->getAnotadosEstado();
     if  ( end($d)->getEstadoAnotados()->getnombreEstado()=="Anotado") {
       
        //llamar a buscar la hs cosulta
      
        $id= $detalle->getfk_horadeconsulta();
        $idvaluedetalle=$detalle->getid_detalleanotados();

        $stmt4 = $conn->prepare("SELECT id_horadeconsulta,fk_horariodeconsulta,fk_materia FROM horadeconsulta where id_horadeconsulta=$id "); 
        $stmt4->execute();

                        while($row = $stmt4->fetch()) {
                            $hora = new HoraDeConsulta();
                            $hora->settempiddetalle($idvaluedetalle);
                            $hora->setid_horadeconsulta($row['id_horadeconsulta']);
                            $hora->setDetalleAnotados($detalle);
                            $listaAvisos=array();    
                            $tempidhorario =$row['fk_horariodeconsulta'];
                            $tempmaeria =$row['fk_materia'];
                            $tempidhora=$row['id_horadeconsulta'];
                            $hora->setPresentismo(false);
                            $stmt9 = $conn->prepare("SELECT id_presentismo FROM presentismo where fk_horadeconsulta=$tempidhora and HoraHasta='00:00:00'"); 
                            $stmt9->execute();
                            while($row = $stmt9->fetch()) {
                                $hora->setPresentismo(true);
                            }

                            $stmt5 = $conn->prepare("SELECT id_avisoprofesor,fechaAvisoProfesor,detalleDescripcion,horaAvisoProfesor FROM avisoprofesor where fk_horadeconsulta=$tempidhora"); 
                            $stmt5->execute();
                            

                            while($row = $stmt5->fetch()) {
                                $aviso = new AvisoProfesor();
                                $aviso->setid_avisoprofesor($row['id_avisoprofesor']);
                                $aviso->setfechaAvisoProfesor($row['fechaAvisoProfesor']);
                                $aviso->setdetalleDescripcion($row['detalleDescripcion']);
                                $aviso->sethoraAvisoProfesor($row['horaAvisoProfesor']);
                                array_push($listaAvisos,$aviso);
                              
                                
                            }
                            $hora->setAvisoProfesor($listaAvisos);
                            $stmt5 = $conn->prepare("SELECT id_materia,nombreMateria,fk_departamento,fk_dia FROM materia where id_materia=$tempmaeria"); 
                            $stmt5->execute();

                            while($row = $stmt5->fetch()) {
                                $mat = new Materia();
                                $mat->setid_materia($row['id_materia']);
                                $mat->setnombreMateria($row['nombreMateria']);
                                $hora->setMateria($mat);
                            }

                            $stmt6 = $conn->prepare("SELECT  id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia FROM horariodeconsulta where id_horariodeconsulta=$tempidhorario");
                            $stmt6->execute();

                                while($row = $stmt6->fetch()) {
                                    $ListaHorariosDeConsulta=array();
                                    $hor = new HorarioDeConsulta();
                                    $hor->setid_horariodeconsulta($row['id_horariodeconsulta']);
                                    $hor->sethora($row['hora']);
                                    $hor->setactivoDesde($row['activoDesde']);
                                    $hor->setactivoHasta($row['activoHasta']);
                                    $hor->setsemestre($row['semestre']);
                                        
                                        $tempDia =$row['fk_dia'];
                                        $tempProfesor =$row['fk_profesor'];

                                        $stmt7 = $conn->prepare("SELECT id_dia,dia FROM dia where id_dia=$tempDia"); 
                                        $stmt7->execute();
                                        while($row = $stmt7->fetch()) {
                                            $dia = new Dia();
                                            $dia->setid_dia($row['id_dia']);
                                            $dia->setdia($row['dia']);
                                            $hor->setdia($dia);
                                        }
                                        $stmt8 = $conn->prepare("SELECT id_profesor,apellido,nombre FROM profesor where id_profesor=$tempProfesor"); 
                                        $stmt8->execute();
                                        while($row = $stmt8->fetch()) {
                                            $prof = new Profesor();
                                            $prof->setid_profesor($row['id_profesor']);
                                            $prof->setapellido($row['apellido']);
                                            $prof->setnombre($row['nombre']);
                                            $hor->setprofesor($prof);
                                        }
                                    $hora->setHorarioDeConsulta($hor);
                                    }
                                           
                            array_push($ListHoraDeConsulta,$hora);
                                            
                            }
                           
        } 
    }
    // echo '<pre>'; print_r($ListHoraDeConsulta); echo '</pre>';
    return $ListHoraDeConsulta;
}


function buscarAsuetos(){
    $con= new conexion();
    $conn=$con->getconexion();
    $listaAsuetos=array();
    $año=date("Y");
    $fecha="{$año}-01-01";
    $stmt = $conn->prepare("SELECT horaDesdeAsueto,horaHastaAsueto,fechaAsueto FROM asueto");
    $stmt->execute(); 
    while($row = $stmt->fetch()){
        $asueto= new Asueto();
        $asueto->setfechaAsueto($row['fechaAsueto']);
        $asueto->sethoraDesdeAsueto($row['horaDesdeAsueto']);
        $asueto->sethoraHastaAsueto($row['horaHastaAsueto']);
        array_push($listaAsuetos,$asueto);
    }
    return $listaAsuetos;
}
?>

