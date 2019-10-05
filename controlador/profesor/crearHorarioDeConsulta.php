<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);

require_once ($DIR . $Alumno);
require_once ($DIR . $Materia);
require_once ($DIR . $HorarioDeConsulta);
require_once ($DIR . $Profesor);
require_once ($DIR . $HoraDeConsulta);
require_once ($DIR . $Dia);
require_once ($DIR . $turno);
require_once ($DIR . $HorarioCursado);

session_start();
$con= new conexion();
$conn = $con->getconexion();

$dia1erSemestre1=$_POST['Dia1ersemestre1'];
$hora1erSemestre1=$_POST['Horarioshora1ersemestre1'];
$min1erSemestre1=$_POST['Horariomin1ersemestre1'];

$dia1erSemestre2=$_POST['Dia1ersemestre2'];
$hora1erSemestre2=$_POST['Horarioshora1ersemestre2'];
$min1erSemestre2=$_POST['Horariomin1ersemestre2'];

$dia2doSemestre1=$_POST['Dia2dosemestre1'];
$hora2doSemestre1=$_POST['Horarioshora2dosemestre1'];
$min2doSemestre1=$_POST['Horariomin2dosemestre1'];

$dia2doSemestre2=$_POST['Dia2dosemestre2'];
$hora2doSemestre2=$_POST['Horarioshora2dosemestre2'];
$min2doSemestre2=$_POST['Horariomin2dosemestre2'];


$idmateria=$_POST['idmateria'];
//$idProfesor=$_SESSION['idprofesor'];
$idProfesor=2;
$idhorariodeconsultacreado=null;
$idhorarioAcambiar=null;

$primera=primeraVezQueCargaHorario($idmateria,$idProfesor);
$ejecuta=true;
$ejecuta11=false;
$ejecuta12=false;
$ejecuta21=false;
$ejecuta22=false;
$mensajes=array();

$semestreactual;
$mes= date('m');
if($mes<=6){
    $semestreactual=1;
}else{
    $semestreactual=2;
}
$dedicaciondoble=true;
if ($primera){
    if($dedicaciondoble){
        $HI=los2HorariosAsignadosDifierenEn1Hs($dia1erSemestre1,$hora1erSemestre1,$min1erSemestre1,$dia1erSemestre2,$hora1erSemestre2,$min1erSemestre2);
        if(!$HI){
            array_push($mensajes,("Los Horarios Ingresados del 1 semestre se superponen"));
            $ejecuta=false;
        }
        $HI2=los2HorariosAsignadosDifierenEn1Hs($dia2doSemestre1,$hora2doSemestre1,$min2doSemestre1,$dia2doSemestre2,$hora2doSemestre2,$min2doSemestre2);
        if(!$HI2){
            array_push($mensajes,("Los Horarios Ingresados del 2 semestre se superponen"));
            $ejecuta=false;
        }
    }

    $CM11=comprobarSuperposiciónHorariaconotraMateria($idProfesor,$dia1erSemestre1,$hora1erSemestre1,$min1erSemestre1,1);
    $CC11=comprobarSuperposiciónHorariaconotraConsulta($idProfesor,$dia1erSemestre1,$hora1erSemestre1,$min1erSemestre1,1,$idmateria,1);   
    $diaigualMesa11=ComprobaSiCoincidecondiaMesas($idmateria,$dia1erSemestre1);
    if(isset($CM11)){
        array_push($mensajes,("superposicion con materia {$CM->getfk_materia()->getnombreMateria()}"));
        $ejecuta=false;
        }
    if(isset($CC11)){
        array_push($mensajes,("superposicion con materia {$CC->getfk_materia()->getnombreMateria()}"));
        $ejecuta=false;
        }
    if($diaigualMesa11){
        alert("Debe agregar una consulta especial para esa semana, ¿Desea continuar?");
        array_push($mensajes,("Debe agregar una consulta especial para esa semana, ¿Desea continuar?"));
        $ejecuta=false;
    }
    if($dedicaciondoble){    
    $CM12=comprobarSuperposiciónHorariaconotraMateria($idProfesor,$dia1erSemestre2,$hora1erSemestre2,$min1erSemestre2,1);
    $CC12=comprobarSuperposiciónHorariaconotraConsulta($idProfesor,$dia1erSemestre2,$hora1erSemestre2,$min1erSemestre,1,$idmateria,2);
    $diaigualMesa12=ComprobaSiCoincidecondiaMesas($idmateria,$dia1erSemestre2);
    if(isset($CM12)){
        array_push($mensajes,("superposicion con materia {$CM->getfk_materia()->getnombreMateria()}"));
        $ejecuta=false;
        }
    if(isset($CC12)){
        array_push($mensajes,("superposicion con materia {$CC->getfk_materia()->getnombreMateria()}"));
        $ejecuta=false;
        }
    if($diaigualMesa12){
        alert("Debe agregar una consulta especial para esa semana, ¿Desea continuar?");
        array_push($mensajes,("Debe agregar una consulta especial para esa semana, ¿Desea continuar?"));
        $ejecuta=false;
    }
    }
    $CM21=comprobarSuperposiciónHorariaconotraMateria($idProfesor,$dia2doSemestre1,$hora2doSemestre1,$min2doSemestre1,2);
    $CC21=comprobarSuperposiciónHorariaconotraConsulta($idProfesor,$dia2doSemestre1,$hora2doSemestre1,$min2doSemestre1,2,$idmateria,1);
    $diaigualMesa21=ComprobaSiCoincidecondiaMesas($idmateria,$dia2doSemestre1);
    if(isset($CM21)){
        array_push($mensajes,("superposicion con materia {$CM->getfk_materia()->getnombreMateria()}"));
        $ejecuta=false;
        }
    if(isset($CC21)){
        array_push($mensajes,("superposicion con materia {$CC->getfk_materia()->getnombreMateria()}"));
        $ejecuta=false;
        }
    if($diaigualMesa21){
        alert("Debe agregar una consulta especial para esa semana, ¿Desea continuar?");
        array_push($mensajes,("Debe agregar una consulta especial para esa semana, ¿Desea continuar?"));
        $ejecuta=false;
    }
    if($dedicaciondoble){
    $CM21=comprobarSuperposiciónHorariaconotraMateria($idProfesor,$dia2doSemestre2,$hora2doSemestre2,$min2doSemestre2,2);
    $CC21=comprobarSuperposiciónHorariaconotraConsulta($idProfesor,$dia2doSemestre2,$hora2doSemestre2,$min2doSemestre2,2,$idmateria,2);
    $diaigualMesa21=ComprobaSiCoincidecondiaMesas($idmateria,$dia2doSemestre2);
    if(isset($CM22)){
        array_push($mensajes,("superposicion con materia {$CM->getfk_materia()->getnombreMateria()}"));
        $ejecuta=false;
        }
    if(isset($CC22)){
        array_push($mensajes,("superposicion con materia {$CC->getfk_materia()->getnombreMateria()}"));
        $ejecuta=false;
        }
    if($diaigualMesa22){
        alert("Debe agregar una consulta especial para esa semana, ¿Desea continuar?");
        array_push($mensajes,("Debe agregar una consulta especial para esa semana, ¿Desea continuar?"));
        $ejecuta=false;
    }
    }
    if($ejecuta){    
    array_push($mensajes,("Se Creo Correctamente"));   
         
        crearHorarioDeConsulta($hora1erSemestre1,$min1erSemestre1,1,$dia1erSemestre1,$idProfesor,$idmateria,1);
        if($semestreactual==1){
        crearHoraDeConsulta($idmateria,$idProfesor,$idhorariodeconsultacreado,$dia1erSemestre1);
        }
    if($dedicaciondoble){
        crearHorarioDeConsulta($hora1erSemestre2,$min1erSemestre2,1,$dia1erSemestre2,$idProfesor,$idmateria,1);
        if($semestreactual==1){
        crearHoraDeConsulta($idmateria,$idProfesor,$idhorariodeconsultacreado,$dia1erSemestre1);
        }
    }
        crearHorarioDeConsulta($hora2doSemestre1,$min2doSemestre1,2,$dia2doSemestre1,$idProfesor,$idmateria,1);
        if($semestreactual==2){
        crearHoraDeConsulta($idmateria,$idProfesor,$idhorariodeconsultacreado,$dia2doSemestre1);
        }
    if($dedicaciondoble){
        crearHorarioDeConsulta($hora2doSemestre2,$min2doSemestre2,2,$dia2doSemestre2,$idProfesor,$idmateria,2);
        if($semestreactual==2){
        crearHoraDeConsulta($idmateria,$idProfesor,$idhorariodeconsultacreado,$dia2doSemestre2);
        }
    }
    }
}
else{
//$contraturno=comprobarContraturno($idProfesor,$idmateria);
if($dedicaciondoble){
    $HI=los2HorariosAsignadosDifierenEn1Hs($dia1erSemestre1,$hora1erSemestre1,$min1erSemestre1,$dia1erSemestre2,$hora1erSemestre2,$min1erSemestre2);
    if(!$HI){
        array_push($mensajes,("Los Horarios Ingresados del 1 semestre se superponen"));
        $ejecuta=false;
    }
    $HI2=los2HorariosAsignadosDifierenEn1Hs($dia2doSemestre1,$hora2doSemestre1,$min2doSemestre1,$dia2doSemestre2,$hora2doSemestre2,$min2doSemestre2);
    if(!$HI2){
        array_push($mensajes,("Los Horarios Ingresados del 2 semestre se superponen"));
        $ejecuta=false;
    }
}
if($dedicaciondoble){
    $repetido22=horarioIngresadoIgualAlAnterior($dia2doSemestre2,$hora2doSemestre2,$min2doSemestre2,2,$idProfesor,$idmateria,2);
    $repetido12=horarioIngresadoIgualAlAnterior($dia1erSemestre2,$hora1erSemestre2,$min1erSemestre2,1,$idProfesor,$idmateria,2);
}
$repetido11=horarioIngresadoIgualAlAnterior($dia1erSemestre1,$hora1erSemestre1,$min1erSemestre1,1,$idProfesor,$idmateria,1);
$repetido21=horarioIngresadoIgualAlAnterior($dia2doSemestre1,$hora2doSemestre1,$min2doSemestre1,2,$idProfesor,$idmateria,1);


if(!$repetido11){
    $ejecuta11=true;
    $CM11=comprobarSuperposiciónHorariaconotraMateria($idProfesor,$dia1erSemestre1,$hora1erSemestre1,$min1erSemestre1,1);
    $CC11=comprobarSuperposiciónHorariaconotraConsulta($idProfesor,$dia1erSemestre1,$hora1erSemestre1,$min1erSemestre1,1,$idmateria,1);
    $TC11=tieneCantidadDeCambiosDisponible($idProfesor,1,$idmateria);
    $diaigualMesa11=ComprobaSiCoincidecondiaMesas($idmateria,$dia1erSemestre1);
    $C4811=secambia48hsantes($idProfesor,$idmateria,1,$dia1erSemestre1,$hora1erSemestre1,$min1erSemestre1);

    if(isset($CM11)){
        array_push($mensajes,("superposicion con materia {$CM->getfk_materia()->getnombreMateria()}"));
        $ejecuta=false;
        }
    if(isset($CC11)){
        array_push($mensajes,("superposicion con materia {$CC->getfk_materia()->getnombreMateria()}"));
        $ejecuta=false;
        }
    if(!$TC11){
        array_push($mensajes,("supera la cantidad maxima de cambios por semestre"));
        $ejecuta=false;
        }
    if(!$C4811){
        array_push($mensajes,("No puede cambiar la hs de consulta en este momento, debe realizarlo 2 dian antes de la consulta o despues de dictarla"));
        $ejecuta=false;
        }
    if($diaigualMesa11){
        alert("Debe agregar una consulta especial para esa semana, ¿Desea continuar?");
        array_push($mensajes,("Debe agregar una consulta especial para esa semana, ¿Desea continuar?"));
        $ejecuta=false;
    }
}
if($dedicaciondoble){
if(!$repetido12){
    $ejecuta12=true;
    $CM12=comprobarSuperposiciónHorariaconotraMateria($idProfesor,$dia1erSemestre2,$hora1erSemestre2,$min1erSemestre2,1);
    $CC12=comprobarSuperposiciónHorariaconotraConsulta($idProfesor,$dia1erSemestre2,$hora1erSemestre2,$min1erSemestre2,1,$idmateria,2);
    $TC12=tieneCantidadDeCambiosDisponible($idProfesor,1,$idmateria);
    $diaigualMesa12=ComprobaSiCoincidecondiaMesas($idmateria,$dia1erSemestre2);
    $C4812=secambia48hsantes($idProfesor,$idmateria,1,$dia1erSemestre2,$hora1erSemestre2,$min1erSemestre2);

    if(isset($CM12)){
        array_push($mensajes,("superposicion con materia {$CM->getfk_materia()->getnombreMateria()}"));
        $ejecuta=false;
        }
    if(isset($CC12)){
        array_push($mensajes,("superposicion con materia {$CC->getfk_materia()->getnombreMateria()}"));
        $ejecuta=false;
        }
    if(!$TC12){
        array_push($mensajes,("supera la cantidad maxima de cambios por semestre"));
        $ejecuta=false;
        }
    if(!$C4812){
        array_push($mensajes,("No puede cambiar la hs de consulta en este momento, debe realizarlo 2 dian antes de la consulta o despues de dictarla"));
        $ejecuta=false;
        }
    if($diaigualMesa12){
        alert("Debe agregar una consulta especial para esa semana, ¿Desea continuar?");
        array_push($mensajes,("Debe agregar una consulta especial para esa semana, ¿Desea continuar?"));
        $ejecuta=false;
    }
}
}
if(!$repetido21){
    $ejecuta21=true;
    $CM21=comprobarSuperposiciónHorariaconotraMateria($idProfesor,$dia2doSemestre1,$hora2doSemestre1,$min2doSemestre1,2);
    $CC21=comprobarSuperposiciónHorariaconotraConsulta($idProfesor,$dia2doSemestre1,$hora2doSemestre1,$min2doSemestre1,2,$idmateria,1);
    $TC21=tieneCantidadDeCambiosDisponible($idProfesor,2,$idmateria);
    $diaigualMesa21=ComprobaSiCoincidecondiaMesas($idmateria,$dia2doSemestre1);
    $C4821=secambia48hsantes($idProfesor,$idmateria,2,$dia2doSemestre1,$hora2doSemestre1,$min2doSemestre1);

    if(isset($CM21)){
        array_push($mensajes,("superposicion con materia {$CM->getfk_materia()->getnombreMateria()}"));
        $ejecuta=false;
        }
    if(isset($CC21)){
        array_push($mensajes,("superposicion con materia {$CC->getfk_materia()->getnombreMateria()}"));
        $ejecuta=false;
        }
    if(!$TC21){
        array_push($mensajes,("supera la cantidad maxima de cambios por semestre"));
        $ejecuta=false;
        }
    if(!$C4821){
        array_push($mensajes,("No puede cambiar la hs de consulta en este momento, debe realizarlo 2 dian antes de la consulta o despues de dictarla"));
        $ejecuta=false;
        }
    if($diaigualMesa21){
        alert("Debe agregar una consulta especial para esa semana, ¿Desea continuar?");
        array_push($mensajes,("Debe agregar una consulta especial para esa semana, ¿Desea continuar?"));
        $ejecuta=false;
    }
}
if($dedicaciondoble){
if(!$repetido22){
    $ejecuta22=true;
    $CM21=comprobarSuperposiciónHorariaconotraMateria($idProfesor,$dia2doSemestre2,$hora2doSemestre2,$min2doSemestre2,2);
    $CC21=comprobarSuperposiciónHorariaconotraConsulta($idProfesor,$dia2doSemestre2,$hora2doSemestre2,$min2doSemestre2,2,$idmateria,2);
    $TC21=tieneCantidadDeCambiosDisponible($idProfesor,2,$idmateria);
    $diaigualMesa21=ComprobaSiCoincidecondiaMesas($idmateria,$dia2doSemestre2);
    $C4821=secambia48hsantes($idProfesor,$idmateria,2,$dia2doSemestre2,$hora2doSemestre2,$min2doSemestre2);

    if(isset($CM22)){
        array_push($mensajes,("superposicion con materia {$CM->getfk_materia()->getnombreMateria()}"));
        $ejecuta=false;
        }
    if(isset($CC22)){
        array_push($mensajes,("superposicion con materia {$CC->getfk_materia()->getnombreMateria()}"));
        $ejecuta=false;
        }
    if(!$TC22){
        array_push($mensajes,("supera la cantidad maxima de cambios por semestre"));
        $ejecuta=false;
        }
    if(!$C4822){
        array_push($mensajes,("No puede cambiar la hs de consulta en este momento, debe realizarlo 2 dian antes de la consulta o despues de dictarla"));
        $ejecuta=false;
        }
    if($diaigualMesa22){
        alert("Debe agregar una consulta especial para esa semana, ¿Desea continuar?");
        array_push($mensajes,("Debe agregar una consulta especial para esa semana, ¿Desea continuar?"));
        $ejecuta=false;
    }
}
}
if($ejecuta){
    if($ejecuta11){
        // editar el anterior , que tenaga esa hora dia, no cualquiera------------------------------------------------------------------
        CambiarFechaHastaDeConsultaAnterior($idmateria,$idProfesor,1,1);
        if($semestreactual==1){
        CambiarActivoDeHoraAnterior($idmateria,$idProfesor);
        }    
        crearHorarioDeConsulta($hora1erSemestre1,$min1erSemestre1,1,$dia1erSemestre1,$idProfesor,$idmateria,1);
        if($semestreactual==1){
        crearHoraDeConsulta($idmateria,$idProfesor,$idhorariodeconsultacreado,$dia1erSemestre1);
        }
    }
    if($ejecuta12){
        CambiarFechaHastaDeConsultaAnterior($idmateria,$idProfesor,1,2);
        if($semestreactual==1){
        CambiarActivoDeHoraAnterior($idmateria,$idProfesor);
        }    
        crearHorarioDeConsulta($hora1erSemestre2,$min1erSemestre2,1,$dia1erSemestre2,$idProfesor,$idmateria,1);
        if($semestreactual==1){
        crearHoraDeConsulta($idmateria,$idProfesor,$idhorariodeconsultacreado,$dia1erSemestre1);
        }
    }
    if($ejecuta21){
        CambiarFechaHastaDeConsultaAnterior($idmateria,$idProfesor,2,1);
        if($semestreactual==2){
        CambiarActivoDeHoraAnterior($idmateria,$idProfesor);
        }    
        crearHorarioDeConsulta($hora2doSemestre1,$min2doSemestre1,2,$dia2doSemestre1,$idProfesor,$idmateria,1);
        if($semestreactual==2){
        crearHoraDeConsulta($idmateria,$idProfesor,$idhorariodeconsultacreado,$dia2doSemestre1);
        }
    }
    if($ejecuta22){
        CambiarFechaHastaDeConsultaAnterior($idmateria,$idProfesor,2,2);
        if($semestreactual==2){
        CambiarActivoDeHoraAnterior($idmateria,$idProfesor);
        }    
        crearHorarioDeConsulta($hora2doSemestre2,$min2doSemestre2,2,$dia2doSemestre2,$idProfesor,$idmateria,2);
        if($semestreactual==2){
        crearHoraDeConsulta($idmateria,$idProfesor,$idhorariodeconsultacreado,$dia2doSemestre2);
        }
    }
    array_push($mensajes,("Se Creo Correctamente"));
    }
}

$_SESSION['mensajesCrearHorario']=$mensajes;
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
    $stmt = $conn->prepare("SELECT id_horariocursado,HoraDesde,HoraHasta,comision,semestreAnual,fk_materia,fk_dia FROM horariocursado where fk_profesor=$idprofesor and semestreAnual=$semestre OR semestreAnual='anual'"); 
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
} 


function comprobarSuperposiciónHorariaconotraConsulta($idprofesor,$diaingresadonumero,$horaingresada,$miningresado,$semestre,$idmateria,$n){
    $listaConsultasProfesor=array();
    $con= new conexion();
    $conn = $con->getconexion();

    //--buscar la hr consulta q estoy cambiando para excliurla
    $idExcluir;
    $stmt0 = $conn->prepare("SELECT id_horariodeconsulta FROM horariodeconsulta 
    where fk_profesor=$idprofesor and fk_materia=$idmateria and activoHasta='0000-00-00' and semestre=$semestre and n=$n "); 
    $stmt0->execute();
    while($row = $stmt0->fetch()) {
        $idExcluir=$row['id_horariodeconsulta'];
    }
    //--
    $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia FROM horariodeconsulta where fk_profesor=$idprofesor and activoHasta='0000-00-00' and semestre=$semestre or semestre=3 "); 
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
        $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia FROM horariodeconsulta where fk_materia=$idmateria and fk_profesor=$idProfesor and semestre=$semestre and activoDesde>$fechadia"); 
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

function secambia48hsantes($idProfesor,$idmateria,$semestre,$diaingresadonumero,$horaingresada,$miningresado){
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
       
        $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia FROM horariodeconsulta where fk_materia=$idmateria and fk_profesor=$idProfesor and semestre=$semestre and activoHasta='0000-00-00'"); 
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
            if($diaActual<$diaconsulta-2||$diaActual>$diaconsulta){
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
        $hor->setid_horariodeconsulta($row['id_horariodeconsulta']);

    }
    if(isset($hor)){
        global $idhorarioAcambiar;
        $id=$hor->getid_horarioDeConsulta();
        $idhorarioAcambiar=$id;
        $fechaActual= date("Y-m-d");
        $stmt = $conn->prepare("UPDATE horariodeconsulta SET activoHasta=$fechaActual  WHERE id_horariodeconsulta=$id"); 
        $stmt->execute();
    }
}

function crearHorarioDeConsulta($horaingresada,$miningresado,$semestre,$diaingresadonumero,$idprofesor,$idmateria,$n){
    $con= new conexion();
    $conn = $con->getconexion();
    $fecha= date("Y-m-d");
    $hora= "{$horaingresada}:{$miningresado}";

 
    $stmt = $conn->prepare("INSERT INTO `horariodeconsulta` (`id_horariodeconsulta`,`hora`,`activoDesde`,`activoHasta`,`semestre`,`fk_dia`,`fk_profesor`,`fk_materia`,`n`)
    VALUES (null, '$hora', '$fecha' , '0000-00-00', '$semestre', '$diaingresadonumero','$idprofesor','$idmateria','$n');");  
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
    where fk_materia=$idmateria and fk_profesor=$idprofesor and estadoVigencia='activo' and fk_horariodeconsulta=$idhorarioAcambiar"); 
    $stmt2->execute();
        while($row = $stmt2->fetch()) {
            $hora=($row['id_horadeconsulta']);
    }
    if(isset($hora)){
        $id=$hora;
        $fecha= date("Y-m-d");
        $stmt = $conn->prepare("UPDATE horadeconsulta SET estadoVigencia='completo'  WHERE id_horadeconsulta=$id"); 
        $stmt->execute();
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
               if($min1=='45' && $min2=='30' || $min2=='15' ||  $min2=='00' ){
                   return false;
               }elseif($min1=='30' && $min2=='15' || $min2=='00'){
                   return false;
               }elseif($min1=='15' && $min2=='00'){
                    return false;
               }else{
                   return true;
                }
            }else{
                if($min2=='45' && $min1=='30' || $min1=='15' ||  $min1=='00' ){
                    return false;
                }elseif($min2=='30' && $min1=='15' || $min1=='00'){
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
//auxiliares
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