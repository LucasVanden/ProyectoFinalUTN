<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR . $conexion);

require_once ($DIR . $Alumno);
require_once ($DIR . $Materia);
require_once ($DIR . $HorarioDeConsulta);
require_once ($DIR . $Profesor);
require_once ($DIR . $HoraDeConsulta);
require_once ($DIR . $Dia);
require_once ($DIR . $turno);
require_once ($DIR . $HorarioCursado);
require_once ($DIR . $email);
require_once ($DIR . $DetalleAnotados);
require_once ($DIR . $AnotadosEstado);
require_once ($DIR . $EstadoAnotados);

session_start();
$con= new conexion();
$conn = $con->getconexion();
$nombreDedicacion="1";
date_default_timezone_set('America/Argentina/Mendoza');
$_SESSION['seEnvioLosDatosParaLaConsultaEnSemanaDeMesa']=null;
$_SESSION["igualMesa"]=false;
$_SESSION["falloComprobacion"]=false;
$_SESSION["falloComprobacionMesa"]=false;
$_SESSION["Ejecuto"]=false;



$existemesa11=false;
$existemesa12=false;
$existemesa21=false;
$existemesa22=false;
$ejecutaHorarioMesa=false;
if(isset($_POST['mesa'])){
    $ejecutaHorarioMesa=true;
    if(isset($_POST['MesaDia1ersemestre1'])){
        $existemesa11=true;
    $diaMesa11=$_POST['MesaDia1ersemestre1'];
    $horaMesa11=$_POST['MesaHorarioshora1ersemestre1'];
    $minMesa11=$_POST['MesaHorariomin1ersemestre1'];
    }
    if(isset($_POST['MesaDia2dosemestre1'])){
        $existemesa21=true;
    $diaMesa21=$_POST['MesaDia2dosemestre1'];
    $horaMesa21=$_POST['MesaHorarioshora2dosemestre1'];
    $minMesa21=$_POST['MesaHorariomin2dosemestre1'];
    }
    if(isset($_POST['MesaDia1ersemestre2'])){
        $existemesa12=true;
    $diaMesa12=$_POST['MesaDia1ersemestre2'];
    $horaMesa12=$_POST['MesaHorarioshora1ersemestre2'];
    $minMesa12=$_POST['MesaHorariomin1ersemestre2'];
    }
    if(isset($_POST['MesaDia2dosemestre2'])){
        $existemesa22=true;
    $diaMesa22=$_POST['MesaDia2dosemestre2'];
    $horaMesa22=$_POST['MesaHorarioshora2dosemestre2'];
    $minMesa22=$_POST['MesaHorariomin2dosemestre2'];
    }
}
if(isset($_POST['idmateria'])){
$idmateria=$_POST['idmateria'];
$_SESSION['idmateria']=$idmateria;
}else{
    $idmateria=$_SESSION['idmateria'];
}
//$idProfesor=$_SESSION['idprofesor'];


$idProfesor=$_SESSION['idProfesor'];
$idhorariodeconsultacreado=null;
$idhorarioAcambiar=null;


$ejecuta=true;
$ejecuta11=false;
$ejecuta12=false;
$ejecuta21=false;
$ejecuta22=false;
$ejecutamesa11=false;
$ejecutamesa12=false;
$ejecutamesa21=false;
$ejecutamesa22=false;
$mensajes=array();
$mesas=array();

$semestreactual;
$mes= date('m');
if($mes<=6){
    $semestreactual=1;
}else{
    $semestreactual=2;
}
if(isset($_POST['dedicacion'])){
    $_SESSION['dedicacionParaqueNoExploteMensaje']=$_POST['dedicacion'];
    $ded=$_POST['dedicacion'];
}else{
    $ded= $_SESSION['dedicacionParaqueNoExploteMensaje'];
}
$dedicaciondoble=null;
if ($ded==$nombreDedicacion){
    $dedicaciondoble=true;
}else{
    $dedicaciondoble=false;//CAMBIAR A FALSE------------------------------------------------------------
}




if($ejecutaHorarioMesa){

    if($existemesa11){
            $repetidomesa11=horarioIngresadoIgualAlAnterior($diaMesa11,$horaMesa11,$minMesa11,31,$idProfesor,$idmateria,1);
            if(!$repetidomesa11){
                $ejecutamesa11=true;
                $CM11=comprobarSuperposiciónHorariaconotraMateria($idProfesor,$diaMesa11,$horaMesa11,$minMesa11,1);
                $CC11=comprobarSuperposiciónHorariaconotraConsulta($idProfesor,$diaMesa11,$horaMesa11,$minMesa11,1,$idmateria,1,31);
                $C4811=comprobarCambioDeHorarioMesa($idProfesor,$idmateria,1,31,1);
            
                if(isset($CM11)){
                    array_push($mensajes,("superposicion del horario especial de dia de mesas del 1er semestre con materia {$CM11->getfk_materia()->getnombreMateria()}"));
                    $ejecuta=false;
                    $_SESSION["falloComprobacionMesa"]=true;
                    }
                if(isset($CC11)){
                    array_push($mensajes,("superposicion del horario especial de dia de mesas del 1er semestre con consulta de {$CC11->getfk_materia()->getnombreMateria()}"));
                    $ejecuta=false;
                    $_SESSION["falloComprobacionMesa"]=true;
                    }
                if(!$C4811){
                    array_push($mensajes,("No puede cambiar el horario especial de dia de mesas especial del 1er semestre de mesas 1 semana antes de la consulta"));
                    $ejecuta=false;
                    $_SESSION["falloComprobacionMesa"]=true;
                    }
            }
    }
    if($existemesa21){
        $repetidomesa21=horarioIngresadoIgualAlAnterior($diaMesa21,$horaMesa21,$minMesa21,32,$idProfesor,$idmateria,1);
        if(!$repetidomesa21){
            $ejecutamesa21=true;
            $CM21=comprobarSuperposiciónHorariaconotraMateria($idProfesor,$diaMesa21,$horaMesa21,$minMesa21,1);
            $CC21=comprobarSuperposiciónHorariaconotraConsulta($idProfesor,$diaMesa21,$horaMesa21,$minMesa21,2,$idmateria,1,32);
            $C4821=comprobarCambioDeHorarioMesa($idProfesor,$idmateria,2,32,1);
        
            if(isset($CM21)){
                array_push($mensajes,("superposicion  del horario especial de dia de mesas del 2do semestre con materia {$CM21->getfk_materia()->getnombreMateria()}"));
                $ejecuta=false;
                $_SESSION["falloComprobacionMesa"]=true;
                }
            if(isset($CC21)){
                array_push($mensajes,("superposicion del horarioespecial de dia de mesas del 2do semestre con consulta de {$CC21->getfk_materia()->getnombreMateria()}"));
                $ejecuta=false;
                $_SESSION["falloComprobacionMesa"]=true;
                }
            if(!$C4821){
                array_push($mensajes,("No puede cambiar el horario especial del 2do semestre de mesas 1 semana antes de la consulta"));
                $ejecuta=false;
                $_SESSION["falloComprobacionMesa"]=true;
                }
        }
    }
    if($existemesa12){
        $repetidomesa12=horarioIngresadoIgualAlAnterior($diaMesa12,$horaMesa12,$minMesa12,31,$idProfesor,$idmateria,2);
        if(!$repetidomesa12){
            $ejecutamesa12=true;
            $CM12=comprobarSuperposiciónHorariaconotraMateria($idProfesor,$diaMesa12,$horaMesa12,$minMesa12,1);
            $CC12=comprobarSuperposiciónHorariaconotraConsulta($idProfesor,$diaMesa12,$horaMesa12,$minMesa12,1,$idmateria,2,31);
            $C4812=comprobarCambioDeHorarioMesa($idProfesor,$idmateria,1,31,2);
        
            if(isset($CM12)){
                array_push($mensajes,("superposicion del segundo horario especial de dia de mesas del 1er semestre con materia {$CM12->getfk_materia()->getnombreMateria()}"));
                $ejecuta=false;
                $_SESSION["falloComprobacionMesa"]=true;
                }
            if(isset($CC12)){
                array_push($mensajes,("superposicion del segundo horario especial de dia de mesas del 1er semestre con consulta de {$CC12->getfk_materia()->getnombreMateria()}"));
                $ejecuta=false;
                $_SESSION["falloComprobacionMesa"]=true;
                }
            if(!$C4812){
                array_push($mensajes,("No puede cambiar el segundo horario especial de dia de mesas especial del 1er semestre de mesas 1 semana antes de la consulta"));
                $ejecuta=false;
                $_SESSION["falloComprobacionMesa"]=true;
                }
        }
    }
    if($existemesa22){
        $repetidomesa22=horarioIngresadoIgualAlAnterior($diaMesa22,$horaMesa22,$minMesa22,32,$idProfesor,$idmateria,2);
        if(!$repetidomesa22){
            $ejecutamesa22=true;
            $CM22=comprobarSuperposiciónHorariaconotraMateria($idProfesor,$diaMesa22,$horaMesa22,$minMesa22,1);
            $CC22=comprobarSuperposiciónHorariaconotraConsulta($idProfesor,$diaMesa22,$horaMesa22,$minMesa22,2,$idmateria,2,32);
            $C4822=comprobarCambioDeHorarioMesa($idProfesor,$idmateria,2,32,2);
        
            if(isset($CM22)){
                array_push($mensajes,("superposicion del segundo horario especial de dia de mesasdel 2do semestre con materia {$CM22->getfk_materia()->getnombreMateria()}"));
                $ejecuta=false;
                $_SESSION["falloComprobacionMesa"]=true;
                }
            if(isset($CC22)){
                array_push($mensajes,("superposicion del segundo horario especial de dia de mesas del 2do semestre con consulta de {$CC22->getfk_materia()->getnombreMateria()}"));
                $ejecuta=false;
                $_SESSION["falloComprobacionMesa"]=true;
                }
            if(!$C4822){
                array_push($mensajes,("No puede cambiar el segundo horario especial del 2do semestre de mesas 1 semana antes de la consulta"));
                $ejecuta=false;
                $_SESSION["falloComprobacionMesa"]=true;
                }
        }
    }

if($ejecuta){
    $_SESSION["Ejecuto"]=true;
   
    if($ejecutaHorarioMesa){
       if($ejecutamesa11){
        CambiarFechaHastaDeConsultaAnterior($idmateria,$idProfesor,31,1);
        crearHorarioDeConsulta($horaMesa11,$minMesa11,31,$diaMesa11,$idProfesor,$idmateria,1);
       }
       if($ejecutamesa21){
        CambiarFechaHastaDeConsultaAnterior($idmateria,$idProfesor,32,1);
        crearHorarioDeConsulta($horaMesa21,$minMesa21,32,$diaMesa21,$idProfesor,$idmateria,1);
       }
       if ($dedicaciondoble){
        if($ejecutamesa12){
            CambiarFechaHastaDeConsultaAnterior($idmateria,$idProfesor,31,2);
            crearHorarioDeConsulta($horaMesa12,$minMesa12,31,$diaMesa12,$idProfesor,$idmateria,2);
           }
           if($ejecutamesa22){
            CambiarFechaHastaDeConsultaAnterior($idmateria,$idProfesor,32,2);
            crearHorarioDeConsulta($horaMesa22,$minMesa22,32,$diaMesa22,$idProfesor,$idmateria,2);
           }
       }
    }
    array_push($mensajes,"Se Creo Correctamente");
    }  
}

$_SESSION['mensajesCrearHorario']=$mensajes;
$_SESSION['horariosdeMesasAagregar']=$mesas;
$direccion = $URL.$mensajesCrearHoraDeConsulta;
header_remove();
header("Location: $direccion");



//Comprobar que hora ingresada sea mayor o igual a 8:00 y menor o igual a 22:00
// predefinido

//comprobar que este en contraturno
function comprobarContraturno($idprofesor,$idmateria){

    $con= new conexion();
    $conn = $con->getconexion();
    $stmt = $conn->prepare("SELECT fk_turno FROM horarioCursado where fk_profesor=$idprofesor and fk_materia=$idmateria"); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $tempturno= $row['fk_turno'];
        $stmt2 = $conn->prepare("SELECT id_turno,nombre,HoraDesdeTurno,HoraHastaTurno FROM turno where id_turno=$tempturno"); 
        $stmt2->execute();
        while($row = $stmt->fetch()) {
            $turno = new Turno();
            $turno->setid_turno($row['id_turno']);
            $turno->setnombre($row['nombre']);
            $turno->setHoraDesdeTurno($row['HoraDesdeTurno']);
            $turno->setHoraHastaTurno($row['HoraHastaTurno']);
        }
    }
     
    $desde= $turno->getHoraDesdeTurno();
    $hs= substr($desde,0,2);
    $hs=$hs-1;
    $min= substr($desde,2,3);
    $hora=$hs.$min;
    $hasta= $turno->gethoraHastaTurno();
    if(mayorMentorigual($hora,">",$hora1erSemestre1,$min1erSemestre1)||
    mayorMentorigual($hora,"==",$hora1erSemestre1,$min1erSemestre1)||
    mayorMentorigual($hasta,"<",$hora1erSemestre1,$min1erSemestre1)||
    mayorMentorigual($hasta,"==",$hora1erSemestre1,$min1erSemestre1)){
        return true;
    }else{
        return false;
    }
}

function comprobarSuperposiciónHorariaconotraMateria($idprofesor,$diaingresadonumero,$horaingresada,$miningresado,$semestre){
    $listaMateriasProfesor=array();

    $con= new conexion();
    $conn = $con->getconexion();
    $stmt = $conn->prepare("SELECT id_horariocursado,HoraDesde,HoraHasta,comision,semestreAnual,fk_materia,fk_dia FROM horariocursado where fk_profesor=$idprofesor and (semestreAnual=$semestre OR semestreAnual='anual')"); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $HoradeCursado= new HorarioCursado();
        $HoradeCursado->setid_horariocursado($row['id_horariocursado']);
        $HoradeCursado->sethoraDesde($row['HoraDesde']);
        $HoradeCursado->sethoraHasta($row['HoraHasta']);
        $HoradeCursado->setcomision($row['comision']);
        $HoradeCursado->setsemestreAnual($row['semestreAnual']);
        $temmateria=$row['fk_materia'];
        $tempDia=$row['fk_dia'];

        $stmt2 = $conn->prepare("SELECT id_materia,nombreMateria,fk_departamento,fk_dia FROM materia where id_materia=$temmateria"); 
        $stmt2->execute();
        while($row = $stmt2->fetch()) {
            $mat = new Materia();
            $mat->setid_materia($row['id_materia']);
            $mat->setnombreMateria($row['nombreMateria']);
            $HoradeCursado->setfk_materia($mat);
        }
        $stmt3 = $conn->prepare("SELECT id_dia,dia FROM dia where id_dia=$tempDia"); 
        $stmt3->execute();
        while($row = $stmt3->fetch()) {
            $dia = new Dia();
            $dia->setid_dia($row['id_dia']);
            $dia->setdia($row['dia']);
            $HoradeCursado->setdia($dia);
        }
        array_push($listaMateriasProfesor,$HoradeCursado);
    }
    if($stmt->rowCount() == 0) {return null;}
    foreach ($listaMateriasProfesor as $horarioCursado) {
       if ($horarioCursado->getdia()->getid_dia()==$diaingresadonumero){
          if(// se acaba antes de que empieze la calse, o empieza despues que termina la clase
           !(mayorMentorigual($horarioCursado->gethoraDesde(),">",$horaingresada+1 ,$miningresado )||
            mayorMentorigual($horarioCursado->gethoraDesde(),"==",$horaingresada+1 ,$miningresado )||

            mayorMentorigual($horarioCursado->getHoraHasta(),"<",$horaingresada ,$miningresado )||
            mayorMentorigual($horarioCursado->getHoraHasta(),"==",$horaingresada ,$miningresado ))
          ){
            return $horarioCursado;
            break;
          }
       }
    }
    if(count($listaMateriasProfesor)==0){
        return NULL;
    }
} 


function comprobarSuperposiciónHorariaconotraConsulta($idprofesor,$diaingresadonumero,$horaingresada,$miningresado,$semestre,$idmateria,$n,$mesa=false){
    $listaConsultasProfesor=array();
    $con= new conexion();
    $conn = $con->getconexion();

    //--buscar la hr consulta q estoy cambiando para excliurla
    $idExcluir=null;
    $semtemp=null;
    if($mesa){
        $semtemp=$mesa;
    }else{
        $semtemp=$semestre;
    }
    $stmt0 = $conn->prepare("SELECT id_horariodeconsulta FROM horariodeconsulta 
    where fk_profesor=$idprofesor and fk_materia=$idmateria and activoHasta='0000-00-00' and semestre=$semtemp and n=$n "); 
    $stmt0->execute();
    while($row = $stmt0->fetch()) {
        $idExcluir=$row['id_horariodeconsulta'];
    }
    //--
    $mesaSemestre="3{$semestre}";
    $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia FROM horariodeconsulta 
    where (fk_profesor=$idprofesor )and( activoHasta='0000-00-00' )and((semestre=$semestre) or (semestre='$mesaSemestre')) "); 
    $stmt2->execute();

    while($row = $stmt2->fetch()) {
        $hor = new HorarioDeConsulta();
        $hor->setid_horarioDeConsulta($row['id_horariodeconsulta']);
        $hor->sethora($row['hora']);
        $hor->setactivoDesde($row['activoDesde']);
        $hor->setactivoHasta($row['activoHasta']);
        $hor->setsemestre($row['semestre']);
        $tempDia =$row['fk_dia'];
        $tempMateria =$row['fk_materia'];

            $stmt3 = $conn->prepare("SELECT id_dia,dia FROM dia where id_dia=$tempDia"); 
            $stmt3->execute();
            while($row = $stmt3->fetch()) {
                $dia = new Dia();
                $dia->setid_dia($row['id_dia']);
                $dia->setdia($row['dia']);
                $hor->setdia($dia);
            }
            $stmt4 = $conn->prepare("SELECT id_materia,nombreMateria FROM materia where id_materia=$tempMateria"); 
            $stmt4->execute();
            while($row = $stmt4->fetch()) {
                $mat = new Materia();
                $mat->setid_materia($row['id_materia']);
                $mat->setnombreMateria($row['nombreMateria']);
                $hor->setfk_materia($mat);
            }
            if($hor->getid_horarioDeConsulta()!==$idExcluir){
        array_push($listaConsultasProfesor,$hor);
            }
        }
        if($stmt2->rowCount() == 0) {
            return null;
        }
        
    
    foreach ($listaConsultasProfesor as $horarioConsulta) {
       if ($horarioConsulta->getdia()->getid_dia()==$diaingresadonumero){
          if(// se acaba antes de que empieze la calse, o empieza despues que termina la clase
           !(mayorMentorigual($horarioConsulta->gethora(),">",$horaingresada+1 ,$miningresado )||
            mayorMentorigual($horarioConsulta->gethora(),"==",$horaingresada+1 ,$miningresado )||

            mayorMentorigual($horarioConsulta->gethora(),"<",$horaingresada-1 ,$miningresado )||
            mayorMentorigual($horarioConsulta->gethora(),"==",$horaingresada-1 ,$miningresado ))
          ){
            return $horarioConsulta;
            break;
          }
       }
    }
} 

function ComprobaSiCoincidecondiaMesas($idmateria,$diaingresadonumero){
    if(isset($_SESSION['seEnvioLosDatosParaLaConsultaEnSemanaDeMesa'])){
        return false;
    }else{
    $con= new conexion();
    $conn = $con->getconexion();
    $stmt = $conn->prepare("SELECT id_materia,nombreMateria,fk_departamento,fk_dia FROM materia where id_materia=$idmateria"); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $mat = new Materia();
        $mat->setid_materia($row['id_materia']);
        $mat->setnombreMateria($row['nombreMateria']);
        $tempdia=$row['fk_dia'];
    }
    $stmt2 = $conn->prepare("SELECT id_dia,dia FROM dia where id_dia=$tempdia"); 
    $stmt2->execute();
    while($row = $stmt2->fetch()) {
        $dia = new Dia();
        $dia->setid_dia($row['id_dia']);
        $dia->setdia($row['dia']);
        $mat->setdia($dia);
    }
    if ($mat->getdia()->getid_dia()==$diaingresadonumero){
        return true;
    }else{
        return false;
    }
}
}
function tieneCantidadDeCambiosDisponible($idProfesor,$semestre,$idmateria){
    $con= new conexion();
    $conn = $con->getconexion();
    $año= date('Y');
    $mes= date('m');
    if($mes<=6){
        $semestreactual=1;
    }else{
        $semestreactual=2;
    }
    if($semestre==$semestreactual){
        $fechadia= "{$año}-01-01";
        $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia FROM horariodeconsulta where fk_materia=$idmateria and fk_profesor=$idProfesor and semestre=$semestre and activoDesde>'$fechadia'"); 
        $stmt2->execute();
        $contador=0;
        while($row = $stmt2->fetch()) {
            $contador++;
        }
        if ($contador>2){
            return false;
        }else{
            return true;
        }
    }else{
        return true;
    }
}

function secambia48hsantes($idProfesor,$idmateria,$semestre,$diaingresadonumero,$horaingresada,$miningresado,$n){
    $con= new conexion();
    $conn = $con->getconexion();
    $mes= date('m');
    $hor;
    if($mes<=6){
        $semestreactual=1;
    }else{
        $semestreactual=2;
    }
    if($semestre==$semestreactual){
       
        $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia FROM horariodeconsulta
         where fk_materia=$idmateria and fk_profesor=$idProfesor and semestre=$semestre and activoHasta='0000-00-00' and n=$n"); 
        $stmt2->execute();
        while($row = $stmt2->fetch()) {
            $hor = new HorarioDeConsulta();
            $hor->setid_horariodeconsulta($row['id_horariodeconsulta']);
            $hor->sethora($row['hora']);
            $hor->setactivoDesde($row['activoDesde']);
            $hor->setactivoHasta($row['activoHasta']);
            $hor->setsemestre($row['semestre']);
                
                $tempProfesor =$row['fk_profesor'];
                $tempDia=$row['fk_dia'];

                $stmt3 = $conn->prepare("SELECT id_dia,dia FROM dia where id_dia=$tempDia"); 
                $stmt3->execute();
                while($row = $stmt3->fetch()) {
                    $dia = new Dia();
                    $dia->setid_dia($row['id_dia']);
                    $dia->setdia($row['dia']);
                    $hor->setdia($dia);
                }
        }
        //no se puede cambiar a un dia anterior al dia de consulta antes de la consulta. solo se puede cambiar con 2 o mas dias de anticipacion
        $diaconsulta=$hor->getdia()->getid_dia();
        $diaActual= date('N');

        if($diaconsulta==$diaingresadonumero){
            echo "1";
            echo $diaconsulta;
            echo $diaingresadonumero;
            if(($diaActual<($diaconsulta-2))||($diaActual>$diaconsulta)){
                echo "2";
                return true;
            }else{
                return false;
                echo "3";
            }
        }
        elseif ($diaActual>$diaconsulta){
                return true;
                echo "4";
            }
        elseif ($diaActual==$diaconsulta){
                    $hora= date('H');
                    $min= date('i');
                    $seg= date('s');
                    $fechahora="{$horaingresada}:{$miningresado}:00.000000";
                    if(mayorMentorigual($hor->gethora(),"<",$hora-1,$min)){
                        return true;
                        }else{
                            return false;
                            echo "5";
                        }
        }
    }else{
        return true;
    }
}
function CambiarFechaHastaDeConsultaAnterior($idmateria,$idprofesor,$semestre,$n){
    $con= new conexion();
    $conn = $con->getconexion();
  
    $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia 
    FROM horariodeconsulta where fk_materia=$idmateria and fk_profesor=$idprofesor and semestre=$semestre and activoHasta='0000-00-00' and n=$n"); 
    $stmt2->execute();
    while($row = $stmt2->fetch()) {
        $hor = new HorarioDeConsulta();
        $hor->setid_horarioDeConsulta($row['id_horariodeconsulta']);
        //--
        global $idhorarioAcambiar;
        $id=$hor->getid_horarioDeConsulta();
        $idhorarioAcambiar=$id;
        $fechaActual= date("Y-m-d");
        $stmt = $conn->prepare("UPDATE horariodeconsulta SET activoHasta='$fechaActual' WHERE id_horariodeconsulta=$id");
        $stmt->execute();
    }
}

function crearHorarioDeConsulta($horaingresada,$miningresado,$semestre,$diaingresadonumero,$idprofesor,$idmateria,$n){
    $con= new conexion();
    $conn = $con->getconexion();
    $fecha= date("Y-m-d");
    $hora= "{$horaingresada}:{$miningresado}";

    
    $stmt1 = $conn->prepare("SELECT fk_departamento FROM materia where id_materia='$idmateria' "); 
    $stmt1->execute();
    while($row = $stmt1->fetch()) {
        $iddepartamento=$row['fk_departamento'];

        $stmt2 = $conn->prepare("SELECT fk_aula FROM departamento WHERE id_departamento='$iddepartamento'"); 
        $stmt2->execute();
        while($row = $stmt2->fetch()) {
            $aula=$row['fk_aula'];
        }
    }


    $stmt = $conn->prepare("INSERT INTO `horariodeconsulta` (`id_horariodeconsulta`,`hora`,`activoDesde`,`activoHasta`,`semestre`,`fk_dia`,`fk_profesor`,`fk_materia`,`n`,`fk_aula`)
    VALUES (null, '$hora', '$fecha' , '0000-00-00', '$semestre', '$diaingresadonumero','$idprofesor','$idmateria','$n','$aula');");  
    $stmt->execute();
    global $idhorariodeconsultacreado;
    $idhorariodeconsultacreado = $conn->lastInsertId("horariodeconsulta");
}

function primeraVezQueCargaHorario($idmateria,$idprofesor){
    $con= new conexion();
    $conn = $con->getconexion();
   
    $stmt2 = $conn->prepare("SELECT id_horariodeconsulta FROM horariodeconsulta where fk_materia=$idmateria and fk_profesor=$idprofesor"); 
    $stmt2->execute();
    while($row = $stmt2->fetch()) {
        $hor=($row['id_horariodeconsulta']);
    }
    if (isset($hor)){
        return false;
    }else{
        return true;
    }
}

function crearHoraDeConsulta($idmateria,$idprofesor,$idhorarioconsulta,$diaingresadonumero){
    $con= new conexion();
    $conn = $con->getconexion();
    $fecha= date("Y-m-d");
    global $idhorariodeconsultacreado;
    $fechaHasta=nextfechaDia($diaingresadonumero);

    $stmt = $conn->prepare("INSERT INTO `horadeconsulta` (`id_horadeconsulta`,`fechaDesdeAnotados`,`fechaHastaAnotados`,`cantidadAnotados`,
    `estadoPresentismo`,`estadoVigencia`,`fk_materia`,`fk_horariodeconsulta`,`fk_profesor`)
    VALUES (null, '$fecha', '$fechaHasta' , 0, 'pendiente', 'activo','$idmateria','$idhorariodeconsultacreado','$idprofesor');");  
    $stmt->execute();

}

function CambiarActivoDeHoraAnterior($idmateria,$idprofesor){
    global $idhorarioAcambiar;
    $con= new conexion();
    $conn = $con->getconexion();
    $stmt2 = $conn->prepare("SELECT id_horadeconsulta FROM horadeconsulta 
    where fk_materia=$idmateria and fk_profesor=$idprofesor and estadoVigencia='cambioDeHora' and fk_horariodeconsulta=$idhorarioAcambiar"); 
    $stmt2->execute();
        while($row = $stmt2->fetch()) {
            $hora=($row['id_horadeconsulta']);
    }
    if(isset($hora)){
        $id=$hora;
        $fecha= date("Y-m-d");
        $stmt = $conn->prepare("UPDATE horadeconsulta SET estadoVigencia='completo'  WHERE id_horadeconsulta=$id"); 
        $stmt->execute();

        enviarMailAAlumnosAnotados($hora,$idmateria,$idprofesor);
    }
  
}

function los2HorariosAsignadosDifierenEn1Hs($dia1,$hora1,$min1,$dia2,$hora2,$min2){
    if($dia1==$dia2){
        $h1 = ltrim($hora1, "0");
        $h2 = ltrim($hora2, "0");
        if($h1==$h2){
            return false;
        }elseif(abs($h1-$h2) ==1){
           if($h1<$h2){
               if($min1=='45' && ($min2=='30' || $min2=='15' ||  $min2=='00') ){
                   return false;
               }elseif($min1=='30' && ($min2=='15' || $min2=='00')){
                   return false;
               }elseif($min1=='15' && $min2=='00'){
                    return false;
               }else{
                   return true;
                }
            }else{
                if($min2=='45' && ($min1=='30' || $min1=='15' ||  $min1=='00') ){
                    return false;
                }elseif($min2=='30' && ($min1=='15' || $min1=='00')){
                    return false;
                }elseif($min2=='15' && $min1=='00'){
                    return false;
                }else {
                    return true;
                }
            }
        }else{
            return true;}
    }else{
        return true;
    }
}

function comprobarCambioDeHorarioMesa($idProfesor,$idmateria,$semestre,$semestreDeLaConsulta,$n){
    $con= new conexion();
    $conn = $con->getconexion();
    $mes= date('m');
    $comprobacion=true;
    if($mes<=6){
        $semestreactual=1;
    }else{
        $semestreactual=2;
    }
    if($semestre==$semestreactual){
        $stmt1 = $conn->prepare("SELECT fk_horariodeconsulta FROM horadeconsulta 
        where fk_materia=$idmateria and fk_profesor=$idProfesor and estadoVigencia='activo'"); 
        while($row = $stmt1->fetch()) {
            $horaconsulta=$row['fk_horariodeconsulta'];
            

        $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,semestre,n FROM horariodeconsulta
        where fk_horadeconsulta=$horaconsulta"); 
        $stmt2->execute();
        while($row = $stmt2->fetch()) {
           if ($row['semestre']==$semestreDeLaConsulta && $row['n']==$n){
                $comprobacion=false;
           }
        }
    }

}
return $comprobacion;
}
//auxiliares

function enviarMailAAlumnosAnotados($idhoradeconsulta,$idmateria,$idprofesor){
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

                $stmt = $conn->prepare("SELECT id_alumno,legajo,apellido,nombre,email,fechaNacimientoAlumno,telefonoAlumno FROM alumno where id_alumno=$tempAlumno"); 
                $stmt->execute();
                while($row = $stmt->fetch()) {
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
                array_push($listaDetalles,$detalle);
        }
        $listaEmails=array();
    foreach ($listaDetalles as $detalle) {
        $listaEstado=$detalle->getAnotadosEstado();
        if  ( end($listaEstado)->getEstadoAnotados()->getnombreEstado()=="Anotado") {
           array_push($listaEmails,$detalle->getAlumno()->getemail());
        }    
    }
    $stmt = $conn->prepare("SELECT nombreMateria FROM materia where id_materia=$idmateria"); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $nombremateria=$row['nombreMateria'];
    }
    $stmt = $conn->prepare("SELECT nombre,apellido FROM profesor where id_profesor=$idprofesor"); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $nombre=$row['nombre'];
        $apellido=$row['apellido'];
    }

    $body= "El profesor {$nombre} {$apellido} cambio el horario de la consulta de {$nombremateria}";
    enviaremail($listaEmails,$body);
}
function horarioIngresadoIgualAlAnterior($diaingresadonumero,$horaingresada,$miningresado,$semestreDeLaConsulta,$idprofesor,$idmateria,$n){
    $igual=false;
      $con= new conexion();
      $hora="{$horaingresada}:{$miningresado}";
      $conn = $con->getconexion();
      $stmt = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia 
      FROM horariodeconsulta 
      where fk_profesor=$idprofesor and fk_materia=$idmateria and activoHasta='0000-00-00' and semestre=$semestreDeLaConsulta and hora='$hora' and fk_dia='$diaingresadonumero' and n=$n"); 
      $stmt->execute();
       while($row = $stmt->fetch()) {
        $igual= true;
      }
    return $igual;
  }
  function horarioIngresadoMesaIgualAlAnterior($diaingresadonumero,$horaingresada,$miningresado,$semestreDeLaConsulta,$idprofesor,$idmateria){
    $igual=false;
      $con= new conexion();
      $hora="{$horaingresada}:{$miningresado}";
      $conn = $con->getconexion();
      $stmt = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia 
      FROM horariodeconsulta 
      where fk_profesor=$idprofesor and fk_materia=$idmateria and activoHasta='0000-00-00' and semestre=$semestreDeLaConsulta and hora='$hora' and fk_dia='$diaingresadonumero'"); 
      $stmt->execute();
       while($row = $stmt->fetch()) {
        $igual= true;
      }
    return $igual;
  }

function mayorMentorigual($horasql1,$signo,$hora2,$min2){
$hora=  substr($horasql1, 0, 2);
$min=substr($horasql1, 3, 2);
    switch ($signo) {
        case '>':
            if($hora>$hora2){
                return true;}
                    elseif ($hora<$hora2) {
                        return false;}
                            elseif($min>$min2){return true;}
                                elseif ($min<$min2){return false;}
                                    else return false;
            
            break;
        case '<':
            if($hora<$hora2){
                return true;}
                    elseif ($hora>$hora2) {
                        return false;}
                            elseif($min<$min2){return true;}
                                elseif ($min>$min2){return false;}
                                    else return false;
            break;
        case "==":
            if($hora==$hora2){
                if ($min==$min2)
                    {return true;}
            }
            else return false;
            break;
    }
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

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>