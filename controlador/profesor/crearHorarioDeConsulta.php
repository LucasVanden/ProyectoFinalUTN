<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);
session_start();
$con= new conexion();
$conexttion=$con->getconexion();

$dia1erSemestre1=$_POST['Dia1ersemestre1'];
$hora1erSemestre1=$_POST['Horarioshora1ersemestre1'];
$min1erSemestre1=$_POST['Horariomin1ersemestre1'];
$idmateria=$_POST['idmateria'];


comprobarContraturno($_SESSION['idprofesor'],$idmateria);
$CM=comprobarSuperposiciónHorariaconotraMateria($_SESSION['idprofesor'],$dia1erSemestre1,$hora1erSemestre1,$min1erSemestre1,1);
$CC=comprobarSuperposiciónHorariaconotraConsulta($$_SESSION['idprofesor'],$dia1erSemestre1,$hora1erSemestre1,$min1erSemestre1,1);
$TC=tieneCantidadDeCambiosDisponible($idProfesor,$semestre,$idmateria);

//Comprobar que hora ingresada sea mayor o igual a 8:00 y menor o igual a 22:00
// predefinido

//comprobar que este en contraturno
function comprobarContraturno($idprofesor,$idmateria){

    $conn = $this->getconexion();
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

function comprobarSuperposiciónHorariaconotraMateria($idprofesor,$nombredia,$horaingresada,$miningresado,$semestre){
    $listaMateriasProfesor=array();

    $conn = $this->getconexion();
    $stmt = $conn->prepare("SELECT id_horariocursado,HoraDesde,HoraHasta,comision,semestreAnual,fk_materia,fk_dia FROM horarioCursado where fk_profesor=$idprofesor and semestre=$semestre"); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $HoradeCursado= new HoradeCursado();
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
    foreach ($listaMateriasProfesor as $horarioCursado) {
       if ($horarioCursado->getdia()->getdia()==$nombredia){
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
} 


function comprobarSuperposiciónHorariaconotraConsulta($idprofesor,$nombredia,$horaingresada,$miningresado,$semestre){
    $listaConsultasProfesor=array();

    $conn = $this->getconexion();
    $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia FROM horariodeconsulta where fk_profesor=$idprofesor and $activoHasta=null and semestre=$semestre or semestre=3 "); 
    $stmt2->execute();

    while($row = $stmt2->fetch()) {
        $hor = new HorarioDeConsulta();
        $hor->setid_horariodeconsulta($row['id_horariodeconsulta']);
        $hor->sethora($row['hora']);
        $hor->setactivoDesde($row['activoDesde']);
        $hor->setactivoHasta($row['activoHasta']);
        $hor->setsemestre($row['semestre']);
        $tempDia =$row['fk_dia'];

            $stmt3 = $conn->prepare("SELECT id_dia,dia FROM dia where id_dia=$tempDia"); 
            $stmt3->execute();
            while($row = $stmt3->fetch()) {
                $dia = new Dia();
                $dia->setid_dia($row['id_dia']);
                $dia->setdia($row['dia']);
                $hor->setdia($dia);
            }
        }
        array_push($listaConsultasProfesor,$hor);
    
    foreach ($listaConsultasProfesor as $horarioConsulta) {
       if ($horarioConsulta->getdia()->getdia()==$nombredia){
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

function ComprobaSiCoincidecondiaMesas($idmateria,$nombredia){
    $conn = $this->getconexion();
    $stmt = $conn->prepare("SELECT id_materia,nombreMateria,fk_departamento,fk_dia FROM materia where id_materia=$temmateria"); 
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
    if ($mat->getdia()-getdia()==$nombredia){
        return true;
    }else{
        return false;
    }
}

function tieneCantidadDeCambiosDisponible($idProfesor,$semestre,$idmateria){
    $año= date('Y');
    $mes= date('m');
    if($mes<=6){
        $semestreactual=1;
    }else{
        $semestreactual=2;
    }
    if($semestre==$semestreactual){
        $fechadia= "{$año}-01-01";
        $conn = $this->getconexion();
        $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia FROM horariodeconsulta where fk_materia=$idmateria and fk_profesor=$idPrfoesor and semestre=$semestre and activoDesde>$fechadia"); 
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

function secambia48hsantes($idprofesor,$idmateria,$semestre,$diaingresadonumero,$horaingresada){
    $mes= date('m');
    if($mes<=6){
        $semestreactual=1;
    }else{
        $semestreactual=2;
    }
    if($semestre==$semestreactual){
        $conn = $this->getconexion();
        $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia FROM horariodeconsulta where fk_materia=$idmateria and fk_profesor=$idPrfoesor and semestre=$semestre activoHasta='0000-00-00'"); 
        $stmt2->execute();
        while($row = $stmt2->fetch()) {
            $hor = new HorarioDeConsulta();
            $hor->setid_horariodeconsulta($row['id_horariodeconsulta']);
            $hor->sethora($row['hora']);
            $hor->setactivoDesde($row['activoDesde']);
            $hor->setactivoHasta($row['activoHasta']);
            $hor->setsemestre($row['semestre']);
                
                $tempProfesor =$row['fk_profesor'];

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
        $diaconsutla=$hor->getdia()->getdia();
        $diaActual= date('N');

        if($diaconsutla==$diaingresadonumero){
            if($diaActual<$diaconsutla-2||$diaActual>$diaconsulta){
                return true;
            }else{
                return false;
            }
        }else{
            if($diaActual>$diaconsulta){
                return true;
            }else{
                if($diaActual==$diaconsulta){
                    $hora= date('H');
                    $min= date('i');
                    $seg= date('s');
                    $fechahora="{$hora}:{$min}:{$seg}.000000";
                    if(mayorMentorigual($hor->gethora(),"<",$hora-1,$min)){
                        return true;
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            }
        }
    }
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
?>