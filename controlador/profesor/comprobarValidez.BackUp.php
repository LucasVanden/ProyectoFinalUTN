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
require_once ($DIR . $Asueto);
require_once ($DIR . $FechaMesa);
session_start();
$_SESSION["falloComprobacion"]=false;
$_SESSION['mensajesCrearHorario']=null;

//    GET DATOS

//simple semestre 1
$dia1erSemestre1=$_POST['Dia1ersemestre1'];
$hora1erSemestre1=$_POST['Horarioshora1ersemestre1'];
$min1erSemestre1=$_POST['Horariomin1ersemestre1'];

//simple semestre 2
$dia1erSemestre2=$_POST['Dia1ersemestre2'];
$hora1erSemestre2=$_POST['Horarioshora1ersemestre2'];
$min1erSemestre2=$_POST['Horariomin1ersemestre2'];

//doble semestre 1
$dia2doSemestre1=$_POST['Dia2dosemestre1'];
$hora2doSemestre1=$_POST['Horarioshora2dosemestre1'];
$min2doSemestre1=$_POST['Horariomin2dosemestre1'];

//doble semestre 2
$dia2doSemestre2=$_POST['Dia2dosemestre2'];
$hora2doSemestre2=$_POST['Horarioshora2dosemestre2'];
$min2doSemestre2=$_POST['Horariomin2dosemestre2'];

//materia profesor
$idmateria=$_POST['idmateria'];
$idProfesor=$_SESSION['idProfesor'];
// doble
$id_dedicacion=$_POST['dedicacion'];
$_SESSION['dedicacionParaqueNoExploteMensaje']=$id_dedicacion;
$dedicaciondoble=false;
if($id_dedicacion==1){
    $dedicaciondoble=true;
}
//semestre actual
$semestreactual;
$mes= date('m');
if($mes<=6){
    $semestreactual=1;
}else{
    $semestreactual=2;
}

$mensajes=array();
$mesas=array();
$ejecuta=true;
$idhorarioAcambiar=null;

//    VERIFICACION DATOS
//simple
ComprobarValidez($idProfesor,$idmateria,$dia1erSemestre1,$hora1erSemestre1,$min1erSemestre1,1,1);
ComprobarValidez($idProfesor,$idmateria,$dia2doSemestre1,$hora2doSemestre1,$min2doSemestre1,1,2);

//doble
if($dedicaciondoble){
    ComprobarSuperposicionEntreLosHorariosAsignados();
    ComprobarValidez($idProfesor,$idmateria,$dia1erSemestre2,$hora1erSemestre2,$min1erSemestre2,2,1);
    ComprobarValidez($idProfesor,$idmateria,$dia2doSemestre2,$hora2doSemestre2,$min2doSemestre2,2,2);
}

//si falla alguna verificacion ir a mensaje
if(isset($mensajes)){
    echo '<pre>'; print_r($mensajes); echo '</pre>';
   
    $_SESSION['mensajesCrearHorario']=$mensajes;
    $_SESSION['horariosdeMesasAagregar']=$mesas;
    $direccion = $URL.$mensajesCrearHoraDeConsulta;
    header_remove();
    header("Location: $direccion");
}else{
//   si DATOS OK CREAR HORA

    creacion($idProfesor,$idmateria,$dia1erSemestre1,$hora1erSemestre1,$min1erSemestre1,1,1);
    creacion($idProfesor,$idmateria,$dia2doSemestre1,$hora2doSemestre1,$min2doSemestre1,1,2);

    if($dedicaciondoble){
        creacion($idProfesor,$idmateria,$dia1erSemestre2,$hora1erSemestre2,$min1erSemestre2,2,1);
        creacion($idProfesor,$idmateria,$dia2doSemestre2,$hora2doSemestre2,$min2doSemestre2,2,2);
    }

    $_SESSION['mensajesCrearHorario']=$mensajes;

    $direccion = $URL.$mensajesCrearHoraDeConsulta;
    header_remove();
    //header("Location: $direccion");
    echo '<pre>'; print_r($idhorarioAcambiar); echo '</pre>';
}
// comprobar
function ComprobarValidez($idProfesor,$idmateria,$dia,$hora,$min,$n,$semestre){
    $superposicion_Materia=comprobarSuperposiciónHorariaconotraMateria($idProfesor,$dia,$hora,$min,$semestre);
    $superposicion_Consulta=comprobarSuperposiciónHorariaconotraConsulta($idProfesor,$dia,$hora,$min,$semestre,$idmateria,$n);
    $Cambios_Disponibles=tieneCantidadDeCambiosDisponible($idProfesor,$semestre,$idmateria);
    $diaigualMesa=ComprobaSiCoincidecondiaMesas($idmateria,$dia);
    if($dedicaciondoble){
        $ComprobacionTiempo48=secambia48hsantes($idProfesor,$idmateria,$semestre,$dia,$hora,$min,$n);
    }
    
    global $mensajes;
    if(isset($superposicion_Materia)){
        array_push($mensajes,("superposicion del horario {$n} del {$semestre} semestre con materia {$superposicion_Materia->getfk_materia()->getnombreMateria()}"));
        $ejecuta=false;
        $_SESSION["falloComprobacion"]=true;
        }
    if(isset($superposicion_Consulta)){
        array_push($mensajes,("superposicion del horario {$n}  del {$semestre} semestre con consulta de {$superposicion_Consulta->getfk_materia()->getnombreMateria()}"));
        $ejecuta=false;
        $_SESSION["falloComprobacion"]=true;
        }
    if(!$Cambios_Disponibles){
        array_push($mensajes,("supera la cantidad maxima de cambios por semestre"));
        $ejecuta=false;
        $_SESSION["falloComprobacion"]=true;
        }
    if(!$ComprobacionTiempo48){
        array_push($mensajes,("No puede cambiar la hora {$n} de consulta  del semestre {$semestre} en este momento, debe realizarlo 2 días antes de la consulta o despues de dictarla"));
        $ejecuta=false;
        $_SESSION["falloComprobacion"]=true;
        }
    if($diaigualMesa){
        array_push($mensajes,("La consulta {$n} del semestre {$semestre} conicide con el dia de la mesa.Deberá agregar una consulta especial para esa semana."));
        array_push($mesas,("{$semestre}{$n}"));
        $ejecuta=false;
        $_SESSION["igualMesa"]=true;
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
function ComprobarSuperposicionEntreLosHorariosAsignados(){
        $HI=los2HorariosAsignadosDifierenEn1Hs($dia1erSemestre1,$hora1erSemestre1,$min1erSemestre1,$dia1erSemestre2,$hora1erSemestre2,$min1erSemestre2);
        if(!$HI){
            array_push($mensajes,("Los Horarios Ingresados del 1 semestre se superponen"));
            $ejecuta=false;
            $_SESSION["falloComprobacion"]=true;
        }
        $HI2=los2HorariosAsignadosDifierenEn1Hs($dia2doSemestre1,$hora2doSemestre1,$min2doSemestre1,$dia2doSemestre2,$hora2doSemestre2,$min2doSemestre2);
        if(!$HI2){
            array_push($mensajes,("Los Horarios Ingresados del 2 semestre se superponen"));
            $ejecuta=false;
            $_SESSION["falloComprobacion"]=true;
        }
}
// crear
function creacion($idProfesor,$idmateria,$dia,$hora,$min,$n,$semestre){
    global $idhorarioconsulta;
   if(!horarioIngresadoIgualAlAnterior($dia,$hora,$min,$semestre,$idProfesor,$idmateria,$n)){
        if(!primeraVezQueCargaHorario($idmateria,$idProfesor)){
            CambiarFechaHastaDeConsultaAnterior($idmateria,$idProfesor,$semestre,$n);
            global $semestreactual;
            if($semestreactual==$semestre){
            CambiarActivoDeHoraAnterior($idmateria,$idProfesor);
            }
        }
        crearHorarioDeConsulta($hora,$min,$semestre,$dia,$idProfesor,$idmateria,$n);
        crearHoraDeConsulta($idmateria,$idProfesor,$idhorarioconsulta,$dia);
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
function crearHoraDeConsulta($idmateria,$idprofesor,$idhorarioconsulta,$diaingresadonumero){
    $con= new conexion();
    $conn = $con->getconexion();
    $fecha= date("Y-m-d");
    global $idhorariodeconsultacreado;
    $proximoHorario=$idhorariodeconsultacreado;
    $fechaHasta=nextfechaDia($diaingresadonumero);
    //fehcaHasta=FERIADO ++7
    $fechaHasta=saltarTodosLosDiasNoHabiles($fechaHasta,$idmateria,$proximoHorario);
    if($_SESSION['seCabmioAhorarioDeMesaX']){
        $proximoHorario=$_SESSION['id_horariodeconsultaDeMesaCambio'];
    }

    $stmt = $conn->prepare("INSERT INTO `horadeconsulta` (`id_horadeconsulta`,`fechaDesdeAnotados`,`fechaHastaAnotados`,`cantidadAnotados`,
    `estadoPresentismo`,`estadoVigencia`,`fk_materia`,`fk_horariodeconsulta`,`fk_profesor`)
    VALUES (null, '$fecha', '$fechaHasta' , 0, 'pendiente', 'activo','$idmateria','$proximoHorario','$idprofesor');");  
    $stmt->execute();

}
function CambiarFechaHastaDeConsultaAnterior($idmateria,$idprofesor,$semestre,$n){
    $con= new conexion();
    $conn = $con->getconexion();
  
    $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia 
    FROM horariodeconsulta where fk_materia=$idmateria and fk_profesor=$idprofesor and semestre=$semestre and activoHasta='0000-00-00' and n=$n"); 
    $stmt2->execute();
    while($row = $stmt2->fetch()) {
        $hor = new HorarioDeConsulta();
        $hor->setid_horariodeconsulta($row['id_horariodeconsulta']);
        //--
        global $idhorarioAcambiar;
        $id=$hor->getid_horarioDeConsulta();
        $idhorarioAcambiar=$id;
       // $GLOBALS['idhorarioAcambiar']=$id;
        $fechaActual= date("Y-m-d");
        $stmt = $conn->prepare("UPDATE horariodeconsulta SET activoHasta='$fechaActual'  WHERE id_horariodeconsulta=$id"); 
        $stmt->execute();
    }
}
function CambiarActivoDeHoraAnterior($idmateria,$idprofesor){
    global $idhorarioAcambiar;
    //$idhorarioAcambiar=$GLOBALS['idhorarioAcambiar'];
    $con= new conexion();
    $conn = $con->getconexion();
    $stmt2 = $conn->prepare("SELECT id_horadeconsulta FROM horadeconsulta 
    where fk_materia=$idmateria and fk_profesor=$idprofesor and fk_horariodeconsulta=$idhorarioAcambiar"); 
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
// auxiliar
function saltarTodosLosDiasNoHabiles($proximaConsulta,$idMateria,$proximoHorario){
    $_SESSION['seCabmioAhorarioDeMesaX']=false;
        $proximaConsulta=saltarDiasFeriados($proximaConsulta);
        if(proximafechaEsMesa($idMateria,$proximaConsulta)){
            $proximaConsulta=buscarLaInstanciaDeHorarioDeMesas($proximoHorario,$proximaConsulta);
        }
    while(esFeriado($proximaConsulta)){
            $proximaConsulta=saltarDiasFeriados($proximaConsulta);
            if(proximafechaEsMesa($idMateria,$proximaConsulta)){
            $proximaConsulta=buscarLaInstanciaDeHorarioDeMesas($proximoHorario,$proximaConsulta);

        }
    }
    return $proximaConsulta;

}
function buscarLaInstanciaDeHorarioDeMesas($proximoHorario,$proximaConsulta){
    $con= new conexion();
    $conn=$con->getconexion();
    $stmt = $conn->prepare("SELECT semestre,n,fk_materia,fk_profesor FROM horariodeconsulta where id_horariodeconsulta='$proximoHorario'"); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $semeste=$row['semestre'];
        $n=$row['n'];
        $fk_materia=$row['fk_materia'];
        $fk_profesor=$row['fk_profesor'];
        $sem="3".$semeste;
    }   
    $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,fk_dia FROM horariodeconsulta where semestre=$sem and n=$n and fk_profesor=$fk_profesor and fk_materia=$fk_materia "); 
    $stmt2->execute();
    while($row = $stmt2->fetch()) {
        $fk_dia=$row['fk_dia'];
        $id_horariodeconsulta=$row['id_horariodeconsulta'];
        $_SESSION['id_horariodeconsultaDeMesaCambio']=$id_horariodeconsulta;
     
    }
    $proximaConsulta2=fechaDiaAnteriorAfecha($proximaConsulta,$fk_dia);
    if(esFeriado($proximaConsulta2)){
        $proximaConsulta= date('Y-m-d',strtotime($proximaConsulta.'+7 day'));
        $_SESSION['seCabmioAhorarioDeMesaX']=false;
    }else{
        $proximaConsulta=$proximaConsulta2;
        $_SESSION['seCabmioAhorarioDeMesaX']=true;
    }
    return $proximaConsulta;
}
function saltarDiasFeriados($proximaConsulta){
    $asuetos=buscarAsuetos();
    if(count($asuetos)>0){
        $repetir=true;
        while ($repetir) {
            $repetir=false;
            foreach ($asuetos as $feriado) {
                if($proximaConsulta==$feriado->getfechaAsueto()){
                $proximaConsulta= date('Y-m-d',strtotime($proximaConsulta.'+7 day'));
                $repetir=true;
                }
            }
        }
    }
    return $proximaConsulta;
}
function proximafechaEsMesa($idMateria,$proximaConsulta){
    $answ=false;
    $diaMesa=buscardiaMesaDeMateria($idMateria);
    $diaproximaConsulta=date("N", strtotime($proximaConsulta));

    if($diaMesa->getid_dia()==$diaproximaConsulta){
       $mesasX=buscarFechaMesas();
       foreach ($mesasX as $fechaMesa) {
           if($proximaConsulta==$fechaMesa->getfechaMesa()){
              $answ=true;
           }
       }
   }
   return $answ;
}
function esFeriado($fecha){
    $esferiado=false;
    $asuetos=buscarAsuetos();
    if(count($asuetos)>0){
        foreach ($asuetos as $feriado) {
            if($fecha==$feriado->getfechaAsueto()){
            $esferiado=true;
            }
        }
    }
    return $esferiado;
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
function buscarAsuetos(){
    $con= new conexion();
    $conn=$con->getconexion();
    $listaAsuetos=array();
    $año=date("Y");
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
function buscardiaMesaDeMateria($idMateria){
    $con= new conexion();
    $conn=$con->getconexion();
    $stmt2 = $conn->prepare("SELECT fk_dia FROM materia where id_materia=$idMateria"); 
    $stmt2->execute();
    while($row = $stmt2->fetch()) {
        $fkdia=$row['fk_dia'];

        $stmt3 = $conn->prepare("SELECT id_dia,dia FROM dia where id_dia=$fkdia"); 
        $stmt3->execute();
        while($row = $stmt3->fetch()) {
            $dia = new Dia();
            $dia->setid_dia($row['id_dia']);
            $dia->setdia($row['dia']);
        }
    }
    return $dia;
}
function buscarFechaMesas(){
    $con= new conexion();
    $conn=$con->getconexion();
    $listaMesas=array();
    $año=date("Y");
    $fecha="{$año}-01-01";
    $stmt = $conn->prepare("SELECT id_fechaMesa,fechaMesa FROM fechaMesa where fechaMesa>$año"); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $mesa= new FechaMesa();
        $mesa->setid_fechaMesa($row['id_fechaMesa']);
        $mesa->setfechaMesa($row['fechaMesa']);
        array_push($listaMesas,$mesa);
    }
    return $listaMesas;
}
function fechaDiaAnteriorAfecha($fecha,$diaID){
    switch ($diaID){
        case '1':
           $fecha= date("Y-m-d", strtotime($fecha."last Monday"));
           break;
        case '2':
           $fecha= date("Y-m-d", strtotime($fecha."last Tuesday"));
           break;
        case '3':
           $fecha= date("Y-m-d", strtotime($fecha."last Wednesday"));
           break;
        case '4':
           $fecha= date("Y-m-d", strtotime($fecha."last Thursday"));
           break;
        case '5':
           $fecha= date("Y-m-d", strtotime($fecha."last Friday"));
           break;
    }
    return $fecha;
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
?>