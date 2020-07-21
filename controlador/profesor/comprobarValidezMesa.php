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
require_once $DIR . $profesorControlador;
session_start();
date_default_timezone_set('America/Argentina/Mendoza');

//    GET DATOS

//materia profesor
$idmateria=$_SESSION['IdMateriaCreacion'];
$idProfesor=$_SESSION['idProfesor'];
// doble
$a=new Profesorcontrolador();
$dedicacion=$a->buscarDedicaciondeMateria($idmateria,$idProfesor);//id PROFESOR SESSION<---------------------------------------------------------------------------------------------       
$dedicaciondoble=false;
if($dedicacion->getid_dedicacion()==1){
    $dedicaciondoble=true;
}

//doble semestre 1
if($dedicaciondoble){
    $dia1erSemestre2=$_SESSION['dia1S_2'];
    $$hora1erSemestre2=$_SESSION['hora1S_2'];
    $$min1erSemestre2=$_SESSION['min1S_2'];

    $dia2doSemestre2=$_SESSION['dia2S_2'];
    $hora2doSemestre2=$_SESSION['hora2S_2'];
    $min2doSemestre2=$_SESSION['min2S_2'];
}
//simple
$dia1erSemestre1=$_SESSION['dia1S_1'];
$hora1erSemestre1=$_SESSION['hora1S_1'];
$min1erSemestre1=$_SESSION['min1S_1'];

$dia2doSemestre1=$_SESSION['dia2S_1'];
$hora2doSemestre1=$_SESSION['hora2S_1'];
$min2doSemestre1=$_SESSION['min2S_1'];

//MESA
$existemesa11=false;
$existemesa12=false;
$existemesa21=false;
$existemesa22=false;
//simple
if(isset($_POST['MesaDia1ersemestre1'])){
    $existemesa11=true;
$diaMesa11=$_POST['MesaDia1ersemestre1'];
$horaMesa11=$_POST['MesaHorarioshora1ersemestre1'];
$minMesa11=$_POST['MesaHorariomin1ersemestre1'];

$_SESSION['DiaMesa11']=$diaMesa11;
$_SESSION['HoraMesa11']=$horaMesa11;
$_SESSION['MinMesa11']=$minMesa11;
}
if(isset($_POST['MesaDia2dosemestre1'])){
    $existemesa21=true;
$diaMesa21=$_POST['MesaDia2dosemestre1'];
$horaMesa21=$_POST['MesaHorarioshora2dosemestre1'];
$minMesa21=$_POST['MesaHorariomin2dosemestre1'];

$_SESSION['DiaMesa21']=$diaMesa21;
$_SESSION['HoraMesa21']=$horaMesa21;
$_SESSION['MinMesa21']=$minMesa21;
}

//doble
if(isset($_POST['MesaDia1ersemestre2'])){
    $existemesa12=true;
$diaMesa12=$_POST['MesaDia1ersemestre2'];
$horaMesa12=$_POST['MesaHorarioshora1ersemestre2'];
$minMesa12=$_POST['MesaHorariomin1ersemestre2'];

$_SESSION['DiaMesa12']=$diaMesa12;
$_SESSION['HoraMesa12']=$horaMesa12;
$_SESSION['MinMesa12']=$minMesa12;
}
if(isset($_POST['MesaDia2dosemestre2'])){
    $existemesa22=true;
$diaMesa22=$_POST['MesaDia2dosemestre2'];
$horaMesa22=$_POST['MesaHorarioshora2dosemestre2'];
$minMesa22=$_POST['MesaHorariomin2dosemestre2'];

$_SESSION['DiaMesa22']=$diaMesa22;
$_SESSION['HoraMesa22']=$horaMesa22;
$_SESSION['MinMesa22']=$minMesa22;
}

//semestre actual
$semestreactual=$_SESSION['semestreactualCreacion'];

$mensajes=array();
$mesas=array();
$ejecuta=true;
$idhorarioAcambiar=null;

$soloMesas=false;
if(isset($_SESSION['SoloCambiaoMesasEspecial'])){
    if($_SESSION['SoloCambiaoMesasEspecial']==true){
        $soloMesas=true;
    }
};

//    VERIFICACION DATOS
//simple
ComprobarValidez($idProfesor,$idmateria,$diaMesa11,$horaMesa11,$minMesa11,1,1,31,$existemesa11);
ComprobarValidez($idProfesor,$idmateria,$diaMesa21,$horaMesa21,$minMesa21,1,2,31,$existemesa21);

//doble
if($dedicaciondoble){
    if($existemesa12&&$existemesa22){
    ComprobarSuperposicionEntreLosHorariosAsignados($diaMesa11,$horaMesa11,$minMesa11,$diaMesa12,$horaMesa12,$minMesa12,$diaMesa21,$horaMesa21,$minMesa21,$diaMesa22,$horaMesa22,$minMesa22);
    }
    ComprobarValidez($idProfesor,$idmateria,$diaMesa12,$horaMesa12,$minMesa12,2,1,32,$existemesa12);
    ComprobarValidez($idProfesor,$idmateria,$diaMesa22,$horaMesa22,$minMesa22,2,2,32,$existemesa22);
}

//si falla alguna verificacion ir a mensaje
if(!empty($mensajes)){
    // echo '<pre>'; print_r($mensajes); echo '</pre>';
    $_SESSION['mensajesCrearHorario']=$mensajes;
    $direccion = $URL.$mensajesCrearHoraDeConsulta;
    header_remove();
    header("Location: $direccion");
}else{
//   si DATOS OK CREAR HORA
    $_SESSION['CreacionHorariosMesas']=true;
    $direccion = $URL.$creacionHorario;
    header_remove();
    header("Location: $direccion");
}
// comprobar
function ComprobarValidez($idProfesor,$idmateria,$dia,$hora,$min,$n,$semestre,$mesa,$existe){
    if($existe){
        global $semestreactual;

        $superposicion_Materia=comprobarSuperposiciónHorariaconotraMateria($idProfesor,$dia,$hora,$min,$semestre);
        $superposicion_Consulta=comprobarSuperposiciónHorariaconotraConsulta($idProfesor,$dia,$hora,$min,$semestre,$idmateria,$n,$mesa);
        if($_SESSION['SoloCambiaoMesasEspecial']==false){
            ComprobarSuperposicionEntreLosHorariosAsignadosDeMesas($dia,$hora,$min,$semestre,$n);
        }
        $esSemandaDeConsultaDeMesa=comprobarCambioDeHorarioMesa($idProfesor,$idmateria,$semestre,$mesa,$n);  
        global $mensajes;
        global $mesas;
   

        if(isset($superposicion_Materia)){
            array_push($mensajes,("superposicion del horario {$n} del semestre {$semestre} con materia {$superposicion_Materia->getfk_materia()->getnombreMateria()}"));
            $ejecuta=false;
            $_SESSION["falloComprobacionMesa"]=true;
        }
        if(isset($superposicion_Consulta)){
            array_push($mensajes,("superposicion del  horario {$n} del semestre {$semestre} con consulta de {$superposicion_Consulta->getfk_materia()->getnombreMateria()}"));
            $ejecuta=false;
            $_SESSION["falloComprobacionMesa"]=true;
        }
        if(!$esSemandaDeConsultaDeMesa){
            array_push($mensajes,("No puede cambiar el horario {$n} especial de dia de mesas especial del semestre {$semestre} de mesas 1 semana antes de la consulta"));
            $ejecuta=false;
            $_SESSION["falloComprobacionMesa"]=true;
        }
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
    //si no es solo cambio de mesas, evitar compara con las horas guardadas en BD de la misma materia y verificar con las horas que se estan seteando desde SESSION
    if($_SESSION['SoloCambiaoMesasEspecial']==false){
        $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia FROM horariodeconsulta 
        where (id_materia!=$idmateria)and(fk_profesor=$idprofesor )and( activoHasta='0000-00-00' )and((semestre=$semestre) or (semestre='$mesaSemestre')) "); 
    }
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
           echo '<pre>'; print_r($horarioConsulta); echo '</pre>';
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
function ComprobarSuperposicionEntreLosHorariosAsignados($dia1erSemestre1,$hora1erSemestre1,$min1erSemestre1,$dia1erSemestre2,$hora1erSemestre2,$min1erSemestre2,$dia2doSemestre1,$hora2doSemestre1,$min2doSemestre1,$dia2doSemestre2,$hora2doSemestre2,$min2doSemestre2){
    global $mensajes;
        $HI=los2HorariosAsignadosDifierenEn1Hs($dia1erSemestre1,$hora1erSemestre1,$min1erSemestre1,$dia1erSemestre2,$hora1erSemestre2,$min1erSemestre2);
        if(!$HI){
            array_push($mensajes,("Los Horarios Ingresados del 1 semestre se superponen"));
            $_SESSION["falloComprobacion"]=true;
        }
        $HI2=los2HorariosAsignadosDifierenEn1Hs($dia2doSemestre1,$hora2doSemestre1,$min2doSemestre1,$dia2doSemestre2,$hora2doSemestre2,$min2doSemestre2);
        if(!$HI2){
            array_push($mensajes,("Los Horarios Ingresados del 2 semestre se superponen"));
            $_SESSION["falloComprobacion"]=true;
        }
}
function ComprobarSuperposicionEntreLosHorariosAsignadosDeMesas($diaMesa,$horaMesa,$minMesa,$semestre,$n){

    global $dia1erSemestre1;
    global $hora1erSemestre1;
    global $min1erSemestre1;
    
    global  $dia1erSemestre2;
    global $hora1erSemestre2;
    global $min1erSemestre2;

    global $dia2doSemestre1;
    global $hora2doSemestre1;
    global $min2doSemestre1;

    global $dia2doSemestre2;
    global $hora2doSemestre2;
    global $min2doSemestre2;

    global $mensajes;
    global $dedicaciondoble;

    if($semestre==1){
        $dia=$dia1erSemestre1;
        $hora=$hora1erSemestre1;
        $min=$min1erSemestre1;
        
        $dia2=$dia1erSemestre2;
        $hora2=$hora1erSemestre2;
        $min2=$min1erSemestre2;
    }
    if($semestre==2){
        $dia=$dia2doSemestre1;
        $hora=$hora2doSemestre1;
        $min=$min2doSemestre1;
        
        $dia2=$dia2doSemestre2;
        $hora2=$hora2doSemestre2;
        $min2=$min2doSemestre2;
    }
  
        $HI=los2HorariosAsignadosDifierenEn1Hs($diaMesa,$horaMesa,$minMesa,$dia,$hora,$min);
        if(!$HI){
            array_push($mensajes,("Los Horarios Ingresados de la mesa {$n} se superponen con el 1er horario de consulta del semestre {$semestre} "));
            $_SESSION["falloComprobacion"]=true;
        }
        if($dedicaciondoble){    
            $H2=los2HorariosAsignadosDifierenEn1Hs($diaMesa,$horaMesa,$minMesa,$dia2,$hora2,$min2);
            if(!$H2){
                array_push($mensajes,("Los Horarios Ingresados de la mesa {$n} se superponen con el 2do horario de consulta del semestre {$semestre} "));
                $_SESSION["falloComprobacion"]=true;
            }
        }
}
function DElETE($diaMesa11,$horaMesa11,$minMesa11,$diaMesa12,$horaMesa12,$minaMesa12,
    $diaMesa21,$horaMesa21,$minaMesa21,$dia1erSemestre1,$hora1erSemestre1,$min1erSemestre1,$dia1erSemestre2,$hora1erSemestre2,$min1erSemestre2,
    $dia2doSemestre1,$hora2doSemestre1,$min2doSemestre1,$dia2doSemestre2,$hora2doSemestre2,$min2doSemestre2){

    global $existemesa11;
    global $existemesa12;
    global $existemesa21;
    global $existemesa22;

    if($existemesa11){
        ComprobarSuperposicionEntreLosHorariosAsignadosDeMesas($diaMesa11,$horaMesa11,$minMesa11,$dia1erSemestre1,$hora1erSemestre1,$min1erSemestre1,$dia1erSemestre2,$hora1erSemestre2,$min1erSemestre2,1,1);
    }
    if($existemesa12){
        ComprobarSuperposicionEntreLosHorariosAsignadosDeMesas($diaMesa12,$horaMesa12,$minaMesa12,$dia1erSemestre1,$hora1erSemestre1,$min1erSemestre1,$dia1erSemestre2,$hora1erSemestre2,$min1erSemestre2,1,2);
    }
    if($existemesa21){
        ComprobarSuperposicionEntreLosHorariosAsignadosDeMesas($diaMesa21,$horaMesa21,$minaMesa21,$dia2doSemestre1,$hora2doSemestre1,$min2doSemestre1,$dia2doSemestre2,$hora2doSemestre2,$min2doSemestre2,2,1);
    }
    if($existemesa22){
        ComprobarSuperposicionEntreLosHorariosAsignadosDeMesas($diaMesa22,$horaMesa22,$minaMesa22,$dia2doSemestre1,$hora2doSemestre1,$min2doSemestre1,$dia2doSemestre2,$hora2doSemestre2,$min2doSemestre2,2,2);
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
function mesActual(){
    global $semestreactual;
    $mes= date('m');
    if($mes<=6){
        $semestreactual=1;
    }else{
        $semestreactual=2;
    }
}

?>