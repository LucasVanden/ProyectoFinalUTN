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
date_default_timezone_set('America/Argentina/Mendoza');
//Horas de consulta
$dia1erSemestre1=$_SESSION['dia1S_1'];
$hora1erSemestre1=$_SESSION['hora1S_1'];
$min1erSemestre1=$_SESSION['min1S_1'];

$dia2doSemestre1=$_SESSION['dia2S_1'];
$hora2doSemestre1=$_SESSION['hora2S_1'];
$min2doSemestre1=$_SESSION['min2S_1'];

$dia1erSemestre2=$_SESSION['dia1S_2'];
$hora1erSemestre2=$_SESSION['hora1S_2'];
$min1erSemestre2=$_SESSION['min1S_2'];

$dia2doSemestre2=$_SESSION['dia2S_2'];
$hora2doSemestre2=$_SESSION['hora2S_2'];
$min2doSemestre2=$_SESSION['min2S_2'];
//MESAS    
$diaMesa11=$_SESSION['DiaMesa11'];
$horaMesa11=$_SESSION['HoraMesa11'];
$minMesa11=$_SESSION['MinMesa11'];

$diaMesa21=$_SESSION['DiaMesa21'];
$horaMesa21=$_SESSION['HoraMesa21'];
$minMesa21=$_SESSION['MinMesa21'];

$diaMesa12=$_SESSION['DiaMesa12'];
$horaMesa12=$_SESSION['HoraMesa12'];
$minMesa12=$_SESSION['MinMesa12'];

$diaMesa22=$_SESSION['DiaMesa22'];
$horaMesa22=$_SESSION['HoraMesa22'];
$minMesa22=$_SESSION['MinMesa22'];
//Datos
$idProfesor=$_SESSION['idProfesor'];
$idmateria=$_SESSION['IdMateriaCreacion'];
$semestreactual=$_SESSION['semestreactualCreacion'];
$dedicaciondoble=$_SESSION['dedicacionCreacion'];
$idhorarioAcambiar;


if(isset($_SESSION['CreacionHorariosComunes'])){
    if($_SESSION['CreacionHorariosComunes']==true){
        $primeraVez=primeraVezQueCargaHorario($idmateria,$idProfesor);

        creacion($idProfesor,$idmateria,$dia1erSemestre1,$hora1erSemestre1,$min1erSemestre1,1,1);
        creacion($idProfesor,$idmateria,$dia2doSemestre1,$hora2doSemestre1,$min2doSemestre1,1,2);

        if($dedicaciondoble){
            creacion($idProfesor,$idmateria,$dia1erSemestre2,$hora1erSemestre2,$min1erSemestre2,2,1);
            creacion($idProfesor,$idmateria,$dia2doSemestre2,$hora2doSemestre2,$min2doSemestre2,2,2);
        }
    }
}

if(isset($_SESSION['CreacionHorariosMesas'])){
    if($_SESSION['CreacionHorariosMesas']==true){
        if(in_array("11",$_SESSION['horariosdeMesasAagregar'])) {
            creacionMesas($idmateria,$idProfesor,$diaMesa11,$horaMesa11,$minMesa11,31,1);
        }
        if(in_array("21",$_SESSION['horariosdeMesasAagregar'])) {
            creacionMesas($idmateria,$idProfesor,$diaMesa21,$horaMesa21,$minMesa21,32,1);
        }
        if(in_array("12",$_SESSION['horariosdeMesasAagregar'])) {
            creacionMesas($idmateria,$idProfesor,$diaMesa12,$horaMesa12,$minMesa12,31,2);
        }
        if(in_array("22",$_SESSION['horariosdeMesasAagregar'])) {
            creacionMesas($idmateria,$idProfesor,$diaMesa22,$horaMesa22,$minMesa22,32,2);
        }
    }
}

$mensajes=array();
array_push($mensajes,"Se Creo Correctamente");
$_SESSION['mensajesCrearHorario']=$mensajes;
$_SESSION['creacionExitosa']=true;
$_SESSION['igualMesa']=false;

$direccion = $URL.$mensajesCrearHoraDeConsulta;
header_remove();
header("Location: $direccion");
//echo '<pre>'; print_r($idhorarioAcambiar); echo '</pre>';
//TEST

// crear
function creacion($idProfesor,$idmateria,$dia,$hora,$min,$n,$semestre){
    global $idhorarioconsulta;
    global $primeraVez;
    global $semestreactual;
    if(!$primeraVez){
        if(!horarioIngresadoIgualAlAnterior($dia,$hora,$min,$semestre,$idProfesor,$idmateria,$n)){

            //CambiarFechaHastaDeConsultaAnterior de Mesa especial si cambia de dia y deja de tener mesa especial
            $cambiarfechaHastaMesa="3{$semestre}";
            CambiarFechaHastaDeConsultaAnterior($idmateria,$idProfesor,$cambiarfechaHastaMesa,$n);

            CambiarFechaHastaDeConsultaAnterior($idmateria,$idProfesor,$semestre,$n);

            if($semestreactual==$semestre){
                CambiarActivoDeHoraAnterior($idmateria,$idProfesor);
            }
        
            crearHorarioDeConsulta($hora,$min,$semestre,$dia,$idProfesor,$idmateria,$n);
            if($semestreactual==$semestre){
                crearHoraDeConsulta($idmateria,$idProfesor,$idhorarioconsulta,$dia);
            }
        }
    }else{
        crearHorarioDeConsulta($hora,$min,$semestre,$dia,$idProfesor,$idmateria,$n);
        if($semestreactual==$semestre){
            crearHoraDeConsulta($idmateria,$idProfesor,$idhorarioconsulta,$dia);
        }
    }
}
function creacionMesas($idmateria,$idProfesor,$dia,$hora,$min,$mesa,$n){
    if(!horarioIngresadoIgualAlAnterior($dia,$hora,$min,$mesa,$idProfesor,$idmateria,$n)){
        CambiarFechaHastaDeConsultaAnterior($idmateria,$idProfesor,$mesa,$n);
        crearHorarioDeConsulta($hora,$min,$mesa,$dia,$idProfesor,$idmateria,$n);
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