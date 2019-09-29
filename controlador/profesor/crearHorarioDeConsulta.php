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
if(
mayorMentorigual($hora,">",$hora1erSemestre1,$min1erSemestre1)||
mayorMentorigual($hora,"==",$hora1erSemestre1,$min1erSemestre1)||
mayorMentorigual($hasta,"<",$hora1erSemestre1,$min1erSemestre1)||
mayorMentorigual($hasta,"==",$hora1erSemestre1,$min1erSemestre1))
{
    return true;
}else{
    return false;
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