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

$listaHoras=buscarHorasdeConsulta();
foreach ($listaHoras as $hora) {
    if(comprobarSihuboAsuetoEseDia($hora->getfechaHastaAnotados())){
       if(AsuetofueEnHorarioDeConsulta($hora->getfechaHastaAnotados(),$hora->getHorarioDeConsulta()->gethora())){
            //continue;
       }else{
           //hubo presentismo
           if(existePresentismo($hora->getid_horadeconsulta())){    
                $presentismo=buscarPresentismo($hora->getid_horadeconsulta());
                    if(huboTardanza($presentismo,$hora-getHorarioDeConsulta()->gethora())){
                        crearTardanza($hora,$presentismo,$hora-getHorarioDeConsulta()->gethora());
                    }
            }else{
                //crear ausente
                crearAusente($hora);
            }
       }
    }else{
        //hubo presentismo
        if(existePresentismo($hora->getid_horadeconsulta())){
            $presentismo=buscarPresentismo($hora->getid_horadeconsulta());
            if(huboTardanza($presentismo,$hora-getHorarioDeConsulta()->gethora())){
                crearTardanza($hora,$presentismo,$hora-getHorarioDeConsulta()->gethora());
            }
        }else{
            //crear ausente
            crearAusente($hora);
        }
    }
    cambiarEstadoPresentismo($hora->getid_horadeconsulta());
}

function buscarHorasdeConsulta(){
    $listaHorasAcalcularAsistencia=array();
    $con= new conexion();
    $conn = $con->getconexion();
    $stmt = $conn->prepare("SELECT id_horadeconsulta,fk_horariodeconsulta,fechaDesdeAnotados,fechaHastaAnotados,fk_materia,fk_profesor FROM horadeconsulta where estadoVigencia='completo' and estadoPresentismo='pendiente' "); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $hora = new HoraDeConsulta();
        $hora->setid_horadeconsulta($row['id_horadeconsulta']);
        $hora->setfechaDesdeAnotados($row['fechaDesdeAnotados']);
        $hora->setfechaHastaAnotados($row['fechaHastaAnotados']);
        $tempidhora=$row['id_horadeconsulta'];
        $tempProfesor=$row['fk_profesor'];
        $tempmateria=$row['fk_materia'];

        $stmt2 = $conn->prepare("SELECT id_profesor,apellido,nombre FROM profesor where id_profesor=$tempProfesor"); 
        $stmt2->execute();
        while($row = $stmt2->fetch()) {
            $prof = new Profesor();
            $prof->setid_profesor($row['id_profesor']);
            $prof->setapellido($row['apellido']);
            $prof->setnombre($row['nombre']);
            $hora->setprofesor($prof);
        }
        $stmt3 = $conn->prepare("SELECT id_materia,nombreMateria,fk_departamento,fk_dia FROM materia where id_materia=$tempmateria"); 
        $stmt3->execute();
        while($row = $stmt->fetch()) {
            $mat = new Materia();
            $mat->setid_materia($row['id_materia']);
            $mat->setnombreMateria($row['nombreMateria']);
            $mat->setfk_departamento($row['fk_departamento']);
            $hora->setMateria($mat);
        }

        $stmt4 = $conn->prepare("SELECT  id_horariodeconsulta,hora FROM horariodeconsulta where id_horariodeconsulta=$tempidhora");
        $stmt4->execute();
            while($row = $stmt4->fetch()) {
                $hor = new HorarioDeConsulta();
                $hor->setid_horariodeconsulta($row['id_horariodeconsulta']);
                $hor->sethora($row['hora']);
                $hora->setHorarioDeConsulta($hor);
            }

        array_push($listaHorasAcalcularAsistencia,$hora);
    }
    return $listaHorasAcalcularAsistencia;
}
function comprobarSihuboAsuetoEseDia($fecha){
    $res=false;
    $asuetos=buscarAsuetos();
    if(count($asuetos)>1){
        foreach ($asuetos as $feriado) {
            if($fecha==$feriado->getfechaAsueto()){
                $res= true;
            }
        }
    }
    return $res;
}

function buscarAsuetos(){
    $con= new conexion();
    $conn=$con->getconexion();
    $listaAsuetos=array();
    date('Y',strtotime(date('Y-m-d').'-1 year'));
    $fecha="{$año}-01-01";
    $stmt = $conn->prepare("SELECT horaDesdeAsueto,horaHastaAsueto,fechaAsueto FROM asueto where fechaAsueto>$fecha"); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $asueto= new Asueto();
        $asueto->setfechaAsueto($row['fechaAsueto']);
        $asueto->sethoraDesdeAsueto($row['horaDesdeAsueto']);
        $asueto->sethoraHastaAsueto($row['horaHastaAsueto']);
        array_push($listaAsuetos,$asueto);
    }
    return $listaAsuetos;
}
function AsuetofueEnHorarioDeConsulta($fecha,$hora){
    $con= new conexion();
    $conn=$con->getconexion();
    $res=false;
    $stmt = $conn->prepare("SELECT horaDesdeAsueto,horaHastaAsueto,fechaAsueto FROM asueto where fechaAsueto=$fecha"); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $desde=$row['horaDesdeAsueto'];
        $hasta=$row['horaHastaAsueto'];
        $hor=$hora->getHorarioDeConsulta();
        if(
           (mayorMentorigual($desde,'<',$hor) || mayorMentorigual($desde,'==',$hor))
            &&
           (mayorMentorigual($hor,'<',$hasta))
            ){
            $res=true;
        }
    }
    return $res;
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
function existePresentismo($idhoradeconsulta){
    $con= new conexion();
    $conn=$con->getconexion();
    $res=false;
    $stmt = $conn->prepare("SELECT id_presentismo,horaDesde,horaHasta FROM presentismo where fk_horadeconsulta=$idhoradeconsulta"); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
       $res=true;
    }
    return $res;
}
function buscarPresentismo($idhoradeconsulta){
    $con= new conexion();
    $conn=$con->getconexion();
    
    $stmt = $conn->prepare("SELECT id_presentismo,horaDesde,horaHasta FROM presentismo where fk_horadeconsulta=$idhoradeconsulta"); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $presentismo= new Presentismo();
        $presentismo->sethoraDesde($row['horaDesde']);
        $presentismo->sethoraHasta($row['horaHasta']);
    }
    return $presentismo;
}
function cambiarEstadoPresentismo($idhora){
    $con= new conexion();
    $conn = $con->getconexion();
    $stmt = $conn->prepare("UPDATE horadeconsulta SET estadoPresentismo = 'calculado' WHERE id_horadeconsulta=$idhora"); 
    $stmt->execute();
}
function huboTardanza($presentismo,$horarioHora){
    $res=false;
    $horariofin=date('H:i',strtotime($horarioHora.'+1 hour'));
    if( mayorMentorigual($presentismo->gethoraDesde(),'>',$horarioHora) || mayorMentorigual($presentismo->gethoraHasta(),'<',$horariofin)){
        $res=true;
    }
    return $res;
}
function crearTardanza($hora,$presentismo,$horanumero){
    $con= new conexion();
    $conn=$con->getconexion();

    $fecha=$hora->getfechaHastaAnotados();
    $fk_horadeconsulta=$hora->getid_horadeconsulta();
    $fk_materia=$hora->getMateria()->getid_materia();
    $fk_profesor=$hora->getprofesor()->getid_profesor();
    $fk_departamento=$hora->getMateria()->getfk_departamento();

    $min=calcularMinutosTarde($presentismo,$horanumero);

    $stmt = $conn->prepare("INSERT INTO `falta` (`id_falta`, `fechaFalta`, `tipo`, `min`,`fk_horadeconsulta`,`fk_materia`,`fk_profesor`,`fk_departamento`) 
    VALUES (NULL, '$fecha', 'Tardanza' , '$minutos','$fk_horadeconsulta','$fk_materia','$fk_profesor','$fk_departamento');");  
    $stmt->execute();
}
function calcularMinutosTarde($presentismo,$horanumero){
    $min='00:00';
    $min2='00:00';
    $horariofin=date('H:i',strtotime($horanumero.'+1 hour'));
    if( mayorMentorigual($presentismo->gethoraDesde(),'>',$horarioHora)){
       $min=date("H:i",strtotime($presentismo->gethoraDesde())-strtotime($horanumero));
    }
    if( mayorMentorigual($presentismo->gethoraHasta(),'<',$horariofin)){
        $min2=date("H:i",strtotime($horafin)-strtotime($presentismo->gethoraHasta()));
    }
    $res=date("H:i",strtotime($min)+strtotime($min2));
    return $res;
}
function crearAusente($hora){
    $con= new conexion();
    $conn=$con->getconexion();

    $fecha=$hora->getfechaHastaAnotados();
    $fk_horadeconsulta=$hora->getid_horadeconsulta();
    $fk_materia=$hora->getMateria()->getid_materia();
    $fk_profesor=$hora->getprofesor()->getid_profesor();
    $fk_departamento=$hora->getMateria()->getfk_departamento();

    $stmt = $conn->prepare("INSERT INTO `falta` (`id_falta`, `fechaFalta`, `tipo`, `min`,`fk_horadeconsulta`,`fk_materia`,`fk_profesor`,`fk_departamento`) 
    VALUES (NULL, '$fecha', 'Falta' , null,'$fk_horadeconsulta','$fk_materia','$fk_profesor','$fk_departamento');");  
    $stmt->execute();
}
?>