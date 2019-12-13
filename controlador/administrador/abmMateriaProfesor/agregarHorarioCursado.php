<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);
require_once ($DIR. $email);
require_once ($DIR . $DetalleAnotados);
require_once ($DIR . $Alumno);
require_once ($DIR . $AnotadosEstado);
require_once ($DIR . $EstadoAnotados);
require_once ($DIR . $Asueto);
require_once ($DIR . $FechaMesa);
require_once ($DIR . $HoraDeConsulta);
require_once ($DIR . $HorarioDeConsulta);
require_once ($DIR . $Profesor);
require_once ($DIR . $Presentismo);

session_start();
date_default_timezone_set('America/Argentina/Mendoza');

$profesor=$_POST['profesor'];
$Materias=$_POST['Materias'];

$dia=$_POST['dia'];
$horaDesde=$_POST['horaDesde'];
$horaHasta=$_POST['horaHasta'];
$semestreAnual=$_POST['semestreAnual'];

$ejecuta=comprobarSuperposicion($dia,$horaDesde,$horaHasta,$semestreAnual,$profesor);
if($ejecuta){
crearMateriaProfesor($profesor,$Materias,$dia,$horaDesde,$horaHasta,$semestreAnual);
}else{
    $_SESSION['mostraMensaje']="Superposición Horaria";
}


$direccion= $URL . $bajaMateriaProfesor;
header("Location: $direccion");

function crearMateriaProfesor($profesor,$Materias,$dia,$horaDesde,$horaHasta,$semestreAnual){
    $con= new conexion();
    $conn=$con->getconexion();

        $horaDesde=$horaDesde.':00.000000';
        $horaHasta=$horaHasta.':00.000000';
    $stmt = $conn->prepare("INSERT INTO `horariocursado` (`id_horariocursado`,`HoraDesde`,`HoraHasta`,`fk_dia`,`fk_profesor`,`fk_materia`,`semestreAnual`,`comision`,`fk_turno`) 
    VALUES (NULL,'$horaDesde','$horaHasta','$dia','$profesor','$Materias','$semestreAnual',NULL,NULL);");  
    $stmt->execute();

}
function comprobarSuperposicion($dia,$horaDesde,$horaHasta,$semestreAnual,$profesor){
    $con= new conexion();
    $conn=$con->getconexion();
    $comprobacion=true;

    if($horaDesde==$horaHasta){
    $comprobacion=false;
    }
    $stmt = $conn->prepare("SELECT HoraDesde,HoraHasta,fk_dia,semestreAnual FROM `horariocursado` WHERE fk_profesor=$profesor");
    $stmt->execute();
    while($row = $stmt->fetch()) {
        if($semestreAnual==$row['semestreAnual']  ||  $semestreAnual=="Anual" || $row['semestreAnual']=="Anual" ){
            if($dia==$row['fk_dia']){
              if (!(  
                  
                ( 
                    (mayorMentorigual($row['HoraDesde'],">",$horaDesde) )
                                                        &&  
                    (mayorMentorigual($row['HoraDesde'],">",$horaHasta) ||  mayorMentorigual($row['HoraDesde'],"==",$horaHasta) ) 
                ) 

                || 
                
                (
                    (mayorMentorigual($row['HoraHasta'],"<",$horaDesde) || mayorMentorigual($row['HoraHasta'],"==",$horaDesde ))
                                                         &&
                    (mayorMentorigual($row['HoraHasta'],"<",$horaHasta) ) 
                ) 

                )){
                    $comprobacion=false;
                }

           
  
            }
        }
    }
return $comprobacion;
}
function mayorMentorigual($horasql1,$signo,$horasql2){
    $hora=  substr($horasql1, 0, 2);
    $min=substr($horasql1, 3, 2);

    $hora2= substr($horasql2, 0, 2);
    $min2=substr($horasql2, 3, 2);    
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