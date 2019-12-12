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



session_start();

date_default_timezone_set('America/Argentina/Mendoza');


$listaHorasACerrar=buscarHorasACerrar();
if (count($listaHorasACerrar[0])>0){
    for ($i = 0; $i < count($listaHorasACerrar[0]); $i++) {

        $alumnosAusentes= buscarAlumnosAnotados($listaHorasACerrar[0][$i]);
        if (count($alumnosAusentes)>0){
            registrarAlumnosAnotadosycambiarEstadoASuspendido($alumnosAusentes);
        }
    cambiarEstadoVigencia($listaHorasACerrar[0][$i]);

    $hora= buscarHorarioDeConsultaActual($listaHorasACerrar[0][$i]);
    $siguientehorario=calcularSiguienteHorarioDeConsulta($hora,$listaHorasACerrar[1][$i],$listaHorasACerrar[2][$i]);
    crearSiguienteHoraDeConsulta($listaHorasACerrar[1][$i],$listaHorasACerrar[2][$i],$siguientehorario);
        
    }
}

echo "Cerrando Horas de consulta...";
//echo '<pre>'; print_r($listaHorasACerrar); echo '</pre>';  
$direccion= $URL . $MenuIndex;
//header("refresh:2;".$direccion); 



// echo "ok";?>
    <!-- <form action=<?php echo $URL.$MenuIndex ?> method="POST">
 <div>  <input type="submit" value="Volver" name="Buscar" formaction=<?php echo $URL.$MenuIndex ?> /></div>
 </form> -->
 <?php
// $direccion= $URL . $asistenciaProfesor;
// header("Location: $direccion");

function buscarHorasACerrar(){
    $listaHorariosACerrar=array();
    $listaidmateria=array();
    $listaidprofesor=array();
    $fechaActual=date("Y-m-d");
    $con= new conexion();
    $conn = $con->getconexion();
    $stmt = $conn->prepare("SELECT id_horadeconsulta,fk_horariodeconsulta,fechaDesdeAnotados,fechaHastaAnotados,fk_materia,fk_profesor FROM horadeconsulta where estadoVigencia='activo' and fechaHastaAnotados<='$fechaActual' "); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $tempidhorario=$row['id_horadeconsulta'];
        $tempHorario=$row['fk_horariodeconsulta'];
        $idmateria=$row['fk_materia'];
        $idprofesor=$row['fk_profesor'];
        $fecha=$row['fechaHastaAnotados'];

        $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,hora FROM horariodeconsulta where id_horariodeconsulta=$tempHorario");
        $stmt2->execute();
        while($row = $stmt2->fetch()) {
            $hora=$row['hora'];
            $h=date('H',strtotime(date('H:i:s').'-1 hour'));
            $m=date("i");
            echo $hora;
            echo $h;
            echo $m;
            $seleccionar=true;
            if($fecha==$fechaActual){
                if(mayorMentorigual($hora,"<",$h,$m)){
                    $seleccionar=true;
                }else{
                    $seleccionar=false;
                }
            }
           //  if(mayorMentorigual($hora,"<",$h,$m)){
                if($seleccionar){
                $stmt3 = $conn->prepare("SELECT horaDesde,horaHasta FROM presentismo where fk_horadeconsulta=$tempidhorario");
                $stmt3->execute();
                if($stmt3->rowCount() == 0) {

                    array_push($listaHorariosACerrar,$tempidhorario);
                    array_push($listaidmateria,$idmateria);
                    array_push($listaidprofesor,$idprofesor);
                }
            }
        }
    }
    $respuesta=array();
    array_push($respuesta,$listaHorariosACerrar);
    array_push($respuesta,$listaidmateria);
    array_push($respuesta,$listaidprofesor);
    return $respuesta;
}
function buscarAlumnosAnotados($idhoradeconsulta){
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


}
function registrarAlumnosAnotadosycambiarEstadoASuspendido($listaAlumnosAusentes){
    $con= new conexion();
    $conn=$con->getconexion();

    $fechaActual= date("Y-m-d");
    $hora=date("H:i:s");
    foreach ($listaAlumnosAusentes as $detalle) {
       
        $iddetalle=$detalle->getid_detalleanotados();
        $stmt = $conn->prepare("INSERT INTO `anotadosestado` (`id_anotadoestado`, `fechaAnotadosEstado`, `horaAnotadosEstado`, `fk_detalleanotados`, `fk_estadoanotados`) 
        VALUES (NULL, '$fechaActual', '$hora' , '$iddetalle', 5);");  // 5=Suspendido
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
    $materia="";
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $materia =$row['nombreMateria'];
    }

    $stmt = $conn->prepare("SELECT nombre,apellido FROM profesor where id_profesor=$idprofesor"); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $nombre=$row['nombre'];
        $apellido=$row['apellido'];
    }
    $nombreProfe=($nombre." ".$apellido);
    $fechaActual= date("Y-m-d");
    $body="El día {$fechaActual}, te ausentaste a la consulta de {$materia} del profesor {$nombreProfe}. Es necesario que si no vas a asistir lo notifiques antes de la fecha de la misma";
    enviaremail($listaEmails,$body);
}
function cambiarEstadoVigencia($idhora){
    $con= new conexion();
    $conn = $con->getconexion();
    $stmt = $conn->prepare("UPDATE horadeconsulta SET estadoVigencia = 'completo' WHERE id_horadeconsulta=$idhora"); 
    $stmt->execute();
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
function buscarHorarioDeConsultaActual($idhoradeconsulta){

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
    return $hora;
}  
function calcularSiguienteHorarioDeConsulta($hora,$idMateria,$idProfesor){
    $con= new conexion();
    $conn=$con->getconexion();

    $fechaHoraX=$hora->getfechaHastaAnotados();
    $dia=date("N", strtotime($fechaHoraX));
//comprobar si era horario de mesa
if($hora->getHorarioDeConsulta()->getsemestre()==31){
    $nMesa=$hora->getHorarioDeConsulta()->getn();
    $stmt = $conn->prepare("SELECT fk_dia FROM horariodeconsulta where fk_materia=$idMateria and fk_profesor=$idProfesor and semestre=1 and n=$nMesa");
    $stmt->execute();
    while($row = $stmt->fetch()) {
    $dia=$row['fk_dia'];
    }
}
if($hora->getHorarioDeConsulta()->getsemestre()==32){
    $nMesa=$hora->getHorarioDeConsulta()->getn();
    $stmt = $conn->prepare("SELECT fk_dia FROM horariodeconsulta where fk_materia=$idMateria and fk_profesor=$idProfesor and semestre=2 and n=$nMesa");
    $stmt->execute();
    while($row = $stmt->fetch()) {
    $dia=$row['fk_dia'];
    }
}
//
    
    $proximaConsulta=nextfechaDia($dia);
    //si es de mesa omitir la siguiente consulta que ya la dio
    if( ($hora->getHorarioDeConsulta()->getsemestre()==31) || ($hora->getHorarioDeConsulta()->getsemestre()==32)){
        $proximaConsulta=nextfechaDiaOmitiendo1($dia);
    }

 // $dia="5";

    $mesproximaConsulta=date("m", strtotime($proximaConsulta));
    
    $semestreactual;
    if($mesproximaConsulta<=6){
        $semestreactual=1;
        $tempsemestreactual=1;
    }else{
        $semestreactual=2;
        $tempsemestreactual=2;
    }
     $n=$hora->getHorarioDeConsulta()->getn();
 //comprobar si es feriado
    $asuetos=buscarAsuetos();
    if(count($asuetos)>1){
        $repetir=true;
        while ($repetir) {
            $repetir=false;
            foreach ($asuetos as $feriado) {
                //test bug
                //echo "entro al bucle";
                //
                if($proximaConsulta==$feriado->getfechaAsueto()){
                $proximaConsulta= date('Y-m-d',strtotime($proximaConsulta.'+7 day'));
                $tempProximaConsulta=$proximaConsulta;
                echo "sumo 7";
                echo $proximaConsulta;
                echo $feriado->getfechaAsueto();
                $repetir=true;
                }
            }
        }
    }
   //comprobar si la siguiente consulta hay mesa
 
     $diaMesa=buscardiaMesaDeMateria($idMateria);
     $diaproximaConsulta=date("N", strtotime($proximaConsulta));

     if($diaMesa->getid_dia()==$diaproximaConsulta){
        $mesas=buscarFechaMesas();
        foreach ($mesas as $fechaMesa) {
            if($proximaConsulta==$fechaMesa->getfechaMesa()){
                $semestreactual="3".$semestreactual;
            }
        }
    }
  //BUscar siguiente Horario a asignar
         $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,fk_dia FROM horariodeconsulta where fk_materia=$idMateria and fk_profesor=$idProfesor and semestre=$semestreactual and n=$n"); 
         $stmt2->execute();
         while($row = $stmt2->fetch()) {
             $idhorarioconsulta=$row['id_horariodeconsulta'];
             $fk_dia=$row['fk_dia'];
         }
        $desde= $hora->getfechaHastaAnotados();
        $hasta=$proximaConsulta;
        //si es una consulta especial de mesa
  
        if(($semestreactual=="31")||($semestreactual=="32")){
            $hasta=fechaDiaAnteriorAfecha($proximaConsulta,$fk_dia);
            //si la consulta especial de mesa es feriado rollback
            foreach ($asuetos as $feriado) {
            if($hasta==$feriado){
                $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,fk_dia FROM horariodeconsulta where fk_materia=$idMateria and fk_profesor=$idProfesor and semestre=$tempsemestreactual and n=$n"); 
                $stmt2->execute();
                while($row = $stmt2->fetch()) {
                    $idhorarioconsulta=$row['id_horariodeconsulta'];
                    $fk_dia=$row['fk_dia'];
                }
               $desde= $hora->getfechaHastaAnotados();
               $hasta=$proximaConsulta;
            }
        }
    }

echo "siguiente: "; 
echo $proximaConsulta;
echo $hasta;
        $siguenteconsulta=array();
        array_push($siguenteconsulta,$idhorarioconsulta);
        array_push($siguenteconsulta,$desde);
        array_push($siguenteconsulta,$hasta);
        return $siguenteconsulta;
}       
function crearSiguienteHoraDeConsulta($idMateria,$idProfesor,$siguientehorario){
 $con= new conexion();
 $conn=$con->getconexion();

 $idhorarioconsulta= $siguientehorario[0];
 $desde= $siguientehorario[1];
 $hasta= $siguientehorario[2];
 echo '<pre>'; print_r($siguientehorario); echo '</pre>';  
 //test bug
 echo ("desde:".$desde. "<br>");

 echo ("hasta:".$hasta. "<br>");

 echo ("mat:".$idMateria. '<br>');

 echo ("idh:".$idhorarioconsulta. "<br>");

 echo ("idprof:".$idProfesor. "<br>");
 //
 $stmt = $conn->prepare("INSERT INTO `horadeconsulta` (`id_horadeconsulta`,`fechaDesdeAnotados`,`fechaHastaAnotados`,`cantidadAnotados`,
 `estadoPresentismo`,`estadoVigencia`,`fk_materia`,`fk_horariodeconsulta`,`fk_profesor`)
 VALUES (null, '$desde', '$hasta' , 0, 'pendiente', 'activo','$idMateria','$idhorarioconsulta','$idProfesor');");  
 $stmt->execute();
}
function nextfechaDia($diaID){
    switch ($diaID){
        case '1':
           $fecha= date("Y-m-d", strtotime("next Monday"));
           return $fecha;
           break;
        case '2':
           $fecha= date("Y-m-d", strtotime("next Tuesday"));
           return $fecha;
           break;
        case '3':
           $fecha= date("Y-m-d", strtotime("next Wednesday"));
           return $fecha;
           break;
        case '4':
           $fecha= date("Y-m-d", strtotime("next Thursday"));
           return $fecha;
           break;
        case '5':
           $fecha= date("Y-m-d", strtotime("next Friday"));
           return $fecha;
           break;
    }
}
function nextfechaDiaOmitiendo1($diaID){
    switch ($diaID){
        case '1':
           $fecha= date("Y-m-d", strtotime("second Monday"));
           return $fecha;
           break;
        case '2':
           $fecha= date("Y-m-d", strtotime("second Tuesday"));
           return $fecha;
           break;
        case '3':
           $fecha= date("Y-m-d", strtotime("second Wednesday"));
           return $fecha;
           break;
        case '4':
           $fecha= date("Y-m-d", strtotime("second Thursday"));
           return $fecha;
           break;
        case '5':
           $fecha= date("Y-m-d", strtotime("second Friday"));
           return $fecha;
           break;
    }
}
function buscarFechaMesas(){
    $con= new conexion();
    $conn=$con->getconexion();
    $listaMesas=array();
    $año=date("Y");
    $fecha="{$año}-01-01";
    $stmt = $conn->prepare("SELECT fechaMesa FROM fechaMesa where fechaMesa>$año"); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $mesa= new FechaMesa();
        $mesa->setid_fechaMesa($row['id_fechaMesa']);
        $mesa->setfechaMesa($row['fechaMesa']);
        array_push($listaMesas,$mesa);
    }
    return $listaMesas;
}
function setearHoraIngreso($idpresentismo){
    $con= new conexion();
    $conn=$con->getconexion();
    $hora=date("H:i:s");
    $stmt2 = $conn->prepare("UPDATE presentismo SET HoraHasta = '$hora' WHERE id_presentismo=$idpresentismo"); 
    $stmt2->execute();
}
function setearHoraEgreso($idProfesor,$idhoradeconsulta){
    $con= new conexion();
    $conn=$con->getconexion();
    $fechaActual=date("Y-m-d");
    $hora=date("H:i:s");

    $stmt2 = $conn->prepare("INSERT INTO `presentismo` (`id_presentismo`, `fecha`,`horaDesde`, `HoraHasta`, `fk_profesor`,fk_horadeconsulta)
    VALUES (NULL, '$fechaActual', '$hora', '00:00:00','$idProfesor', '$idhoradeconsulta');"); 
    $stmt2->execute(); 
}
function buscarPresentismo($idhoradeconsulta){
    $con= new conexion();
    $conn=$con->getconexion();
    
    $stmt = $conn->prepare("SELECT id_presentismo FROM presentismo where fk_horadeconsulta=$idhoradeconsulta"); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $idpresentismo =$row['id_presentismo'];
    }
    return $idpresentismo;
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
