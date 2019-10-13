<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);
require_once ($DIR. $email);
require_once ($DIR . $DetalleAnotados);
require_once ($DIR . $Alumno);
require_once ($DIR . $AnotadosEstado);
require_once ($DIR . $EstadoAnotados);
require_once ($DIR . $Asueto);


session_start();

$idMateria= $_POST['idmateria'];
$idProfesor= $_SESSION['idProfesor'];
$idhoradeconsulta=$_POST['asistir'];
date_default_timezone_set('America/Argentina/Mendoza');
echo $idhoradeconsulta;
$con= new conexion();
$conn=$con->getconexion();


$stmt = $conn->prepare("SELECT id_presentismo FROM presentismo where fk_horadeconsulta=$idhoradeconsulta"); 
$stmt->execute();
while($row = $stmt->fetch()) {
    $idpresentismo =$row['id_presentismo'];
}
//EGRESO
if(isset($idpresentismo)){
    $hora=date("H:i:s");
    $stmt2 = $conn->prepare("UPDATE presentismo SET HoraHasta = '$hora' WHERE id_presentismo=$idpresentismo"); 
    $stmt2->execute();

   $alumnosAusentes= buscarAlumnosAusentes($idhoradeconsulta);
   registrarAusentes($alumnosAusentes);
   notificarPorMailaAusentes($alumnosAusentes,$idMateria);
   cambiarEstadoVigencia($idhoradeconsulta);

   $Asuetos=buscarAsuetos();

//INGRESO
}else{
    $fechaActual=date("Y-m-d");
    $hora=date("H:i:s");

    $stmt2 = $conn->prepare("INSERT INTO `presentismo` (`id_presentismo`, `fecha`,`horaDesde`, `HoraHasta`, `fk_profesor`,fk_horadeconsulta)
    VALUES (NULL, '$fechaActual', '$hora', '00:00:00','$idProfesor', '$idhoradeconsulta');"); 
    $stmt2->execute();
}

$direccion= $URL . $asistenciaProfesor;
header("Location: $direccion");

function buscarAlumnosAusentes($idhoradeconsulta){
    $listaDetalles=array();
    $con= new conexion();
    $conn = $con->getconexion();
    $stmt = $conn->prepare("SELECT id_detalleanotados,fk_alumno FROM detalleanotados where fk_horadeconsulta=$idhoradeconsulta"); 
    $stmt->execute();
        while($row = $stmt->fetch()) {
                $detalle = new Detalleanotados();
                $detalle->setid_detalleanotados($row['id_detalleanotados']);
                $iddetalle=$row['id_detalleanotados'];
                $tempAlumno=$row['fk_alumno'];
                $Estados=array();

                $stmt2 = $conn->prepare("SELECT id_alumno,legajo,apellido,nombre,email,fechaNacimientoAlumno,telefonoAlumno FROM alumno where id_alumno=$tempAlumno"); 
                $stmt2->execute();
                while($row = $stmt2->fetch()) {
                    $alum = new Alumno();
                    $alum->setid_alumno($row['id_alumno']);
                    $alum->setlegajo($row['legajo']);
                    $alum->setapellido($row['apellido']);
                    $alum->setnombre($row['nombre']);
                    $alum->setemail($row['email']);
                    $alum->setfechaNacimientoAlumno($row['fechaNacimientoAlumno']);
                    $alum->settelefonoAlumno($row['telefonoAlumno']);
                    $detalle->setAlumno($alum);
                }

                $stmt3 = $conn->prepare("SELECT id_anotadoestado,fechaAnotadosEstado,horaAnotadosEstado,fk_estadoanotados FROM anotadosestado where fk_detalleanotados=$iddetalle "); 
                $stmt3->execute();
                while($row = $stmt3->fetch()) {
                    $anotado = new AnotadosEstado();
                    $anotado->setid_anotadosEstado($row['id_anotadoestado']);
                    $anotado->setfechaAnotadosEstado($row['fechaAnotadosEstado']);
                    $anotado->sethoraAnotadosEstado($row['horaAnotadosEstado']);
                    $idnombreestado=$row['fk_estadoanotados'];

                    $stmt4 = $conn->prepare("SELECT nombreEstado,id_estadoanotados FROM estadoanotados where id_estadoanotados=$idnombreestado "); 
                    $stmt4->execute();
                    while($row = $stmt4->fetch()) {
                        $estado = new EstadoAnotados();
                        $estado->setnombreEstado($row['nombreEstado']);
                        $estado->setid_estadoanotados($row['id_estadoanotados']);
                        $anotado->setEstadoAnotados($estado);       
                    }
                
                        array_push($Estados,$anotado);
                }
                $detalle->setAnotadosEstado($Estados);
                array_push($listaDetalles,$detalle);
        }

        $listaAusentes=array();
    foreach ($listaDetalles as $detalle) {
   
        $listaEstado=$detalle->getAnotadosEstado();
        if  ( end($listaEstado)->getEstadoAnotados()->getnombreEstado()=="Anotado") {
           array_push($listaAusentes,$detalle);
        }    
    }
  return $listaAusentes;

    $stmt = $conn->prepare("SELECT nombre,apellido FROM profesor where id_profesor=$idprofesor"); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $nombre=$row['nombre'];
        $apellido=$row['apellido'];
    }
}
function registrarAusentes($listaAlumnosAusentes){
    $con= new conexion();
    $conn=$con->getconexion();

    $fechaActual= date("Y-m-d");
    $hora=date("H:i:s");
    foreach ($listaAlumnosAusentes as $detalle) {
       
        $iddetalle=$detalle->getid_detalleanotados();
        $stmt = $conn->prepare("INSERT INTO `anotadosestado` (`id_anotadoestado`, `fechaAnotadosEstado`, `horaAnotadosEstado`, `fk_detalleanotados`, `fk_estadoanotados`) 
        VALUES (NULL, '$fechaActual', '$hora' , '$iddetalle', 3);");  // 3=Ausente
        $stmt->execute();
    }
}
function notificarPorMailaAusentes($listaAlumnosAusentes,$idMateria){
    $listaEmails=array();
    foreach ($listaAlumnosAusentes as $detalle) {
       $email=$detalle->getAlumno()->getemail();
       array_push($listaEmails,$email);
    }
    $con= new conexion();
    $conn=$con->getconexion();
    $stmt = $conn->prepare("SELECT nombreMateria FROM materia where id_materia=$idMateria"); 
    while($row = $stmt->fetch()) {
        $materia =$row['nombreMateria'];
    }
    $fechaActual= date("Y-m-d");
    $body="El día {$fechaActual}, te ausentaste a la consulta de {$materia}. Es necesario que si no vas a asistir lo notifiques antes de la fecha de la misma";
    enviaremail($listaEmails,$body);
}
function cambiarEstadoVigencia($idhora){
    $con= new conexion();
    $conn = $con->getconexion();
    $stmt = $conn->prepare("UPDATE horadeconsulta SET estadoVigencia = 'Completo' WHERE id_horadeconsulta=$idhora"); 
    $stmt->execute();
}
function buscarAsuetos(){
    $con= new conexion();
    $conn=$con->getconexion();
    $año=date("Y");
    $fecha="{$año}-01-01";
    $stmt = $conn->prepare("SELECT horaDesdeAsueto,horaHastaAsueto,fechaAsueto FROM asueto where fechaAsueto>$año"); 
    while($row = $stmt->fetch()) {
        $asueto= new Asueto();
        $asueto->setfechaAsueto($row['id_presentismo']);
        $asueto->sethoraDesdeAsueto($row['horaDesdeAsueto']);
        $asueto->sethoraHastaAsueto($row['horaHastaAsueto']);
        array_push($listaAsuetos,$asueto);
    }
    return $listaAsuetos;
}
function siguienteHorario($Asuetos,$idhoradeconsulta,$idMateria){

    $con= new conexion();
    $conn=$con->getconexion();

    $stmt = $conn->prepare("SELECT id_horadeconsulta,fk_horariodeconsulta,fechaDesdeAnotados,fechaHastaAnotados FROM horadeconsulta where id_horadeconsulta=$idhoradeconsulta "); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $hora = new HoraDeConsulta();
        $hora->setid_horadeconsulta($row['id_horadeconsulta']);
        $hora->setfechaDesdeAnotados($row['fechaDesdeAnotados']);
        $hora->setfechaHastaAnotados($row['fechaHastaAnotados']);
            
        $tempidhorario =$row['fk_horariodeconsulta'];
        $stmt3 = $conn->prepare("SELECT  id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia,n FROM horariodeconsulta where id_horariodeconsulta=$tempidhorario");
        $stmt3->execute();
            while($row = $stmt3->fetch()) {
                $ListaHorariosDeConsulta=array();
                $hor = new HorarioDeConsulta();
                $hor->setid_horariodeconsulta($row['id_horariodeconsulta']);
                $hor->sethora($row['hora']);
                $hor->setactivoDesde($row['activoDesde']);
                $hor->setactivoHasta($row['activoHasta']);
                $hor->setsemestre($row['semestre']);
                $hor->setn($row['n']);
                    
                    $tempDia =$row['fk_dia'];
                    $tempProfesor =$row['fk_profesor'];

                    $stmt4 = $conn->prepare("SELECT id_dia,dia FROM dia where id_dia=$tempDia"); 
                    $stmt4->execute();
                    while($row = $stmt4->fetch()) {
                        $dia = new Dia();
                        $dia->setid_dia($row['id_dia']);
                        $dia->setdia($row['dia']);
                        $hor->setdia($dia);
                    }

                    $stmt5 = $conn->prepare("SELECT id_profesor,apellido,nombre FROM profesor where id_profesor=$tempProfesor"); 
                    $stmt5->execute();
                    while($row = $stmt5->fetch()) {
                        $prof = new Profesor();
                        $prof->setid_profesor($row['id_profesor']);
                        $prof->setapellido($row['apellido']);
                        $prof->setnombre($row['nombre']);
                        $hor->setprofesor($prof);
                    }
                $hora->setHorarioDeConsulta($hor);
                }
    }
   
  
 
   $dia=date('N');
   $proximaConsulta=nextfechaDia($dia);
   $mesProximaConsulta=date("m", strtotime($proximaConsulta));
   
   $semestreactual;
   if($mesProximaConsulta<=6){
       $semestreactual=1;
   }else{
       $semestreactual=2;
   }
    $n=$hora->getn();
 //BUscar siguiente Horario a asignar
        $stmt2 = $conn->prepare("SELECT id_horariodeconsulta FROM horariodeconsulta where fk_materia=$idMateria and fk_profesor=$idprofesor semestre=$semestreactual and n=$n"); 
        $stmt2->execute();
        while($row = $stmt->fetch()) {
            $idhorarioconsulta=$row['id_horariodeconsulta'];
        }
 //crear hora de consulta y asignarle ese horario

}  

function nextfechaDia($diaID){
    switch ($diaID){
        case '1':
           $fecha= date("Y-m-d", strtotime("next Monday"));
           break;
        case '2':
           $fecha= date("Y-m-d", strtotime("next Tuesday"));
           break;
        case '3':
           $fecha= date("Y-m-d", strtotime("next Wednesday"));
           break;
        case '4':
           $fecha= date("Y-m-d", strtotime("next Thursday"));
           break;
        case '5':
           $fecha= date("Y-m-d", strtotime("next Friday"));
           break;
    }
    return $fecha;
}
?>