<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);

$con= new conexion();
$conexttion=$con->getconexion();
      
    $detalle=$_POST["idDetalle"];

        $fecha=getdate();

        date_default_timezone_set('America/Argentina/Mendoza');

        $mes= date('m');
        $dia= date('d');
      
        $hora= date('H');
        $min= date('i');
        $seg= date('s');

        $fechahora="{$hora}:{$min}:{$seg}.000000";

       // $fechahora="{$fecha['hours']}:{$fecha['minutes']}:{$fecha['seconds']}.000000";
        $fechadia= "{$fecha['year']}-{$mes}-{$dia}";

        $stmt = $conexttion->prepare("INSERT INTO `anotadosestado` (`id_anotadoestado`, `fechaAnotadosEstado`, `horaAnotadosEstado`, `fk_detalleanotados`, `fk_estadoanotados`) 
        VALUES (NULL, '$fechadia', '$fechahora' , '$detalle', 2);"); 
        $stmt->execute();



        $idhora=null;
        $stmt = $conexttion->prepare("SELECT fk_horadeconsulta,fk_alumno FROM detalleanotados where id_detalleanotados=$detalle "); 
        $stmt->execute();
            while($row = $stmt->fetch()) {
                $idhora=$row['fk_horadeconsulta'];
                $idalumno=$row['fk_alumno'];
            }

        $stmt3 = $conexttion->prepare("UPDATE horadeconsulta SET cantidadAnotados = cantidadAnotados -1  WHERE id_horadeconsulta=$idhora"); 
        $stmt3->execute();
//preparar email
$idprofesor=null;
$idmateria=null;
$idhorario=null;
$stmt = $conexttion->prepare("SELECT fk_profesor,fk_materia,fk_horariodeconsulta FROM horadeconsulta WHERE id_horadeconsulta = $idhora"); 
$stmt->execute();
while($row = $stmt->fetch()) {
    $idprofesor=($row['fk_profesor']);
    $idmateria=($row['fk_materia']);
    $idhorario=($row['fk_horariodeconsulta']);
}

$emailprofesor=null;
$stmt = $conexttion->prepare("SELECT email FROM profesor WHERE id_profesor = $idprofesor"); 
$stmt->execute();
while($row = $stmt->fetch()) {
    $emailprofesor=($row['email']);
}

 $nombreMateria=null;
 $stmt = $conexttion->prepare("SELECT nombreMateria FROM materia WHERE id_materia = $idmateria"); 
 $stmt->execute();
 while($row = $stmt->fetch()) {
        $nombreMateria=($row['nombreMateria']);
}

$hora=null;
$dia=null;
$stmt = $conexttion->prepare("SELECT fk_dia,hora FROM horariodeconsulta WHERE id_horariodeconsulta = $idhorario"); 
$stmt->execute();
while($row = $stmt->fetch()) {
       $hora=($row['hora']);
       $iddia=($row['fk_dia']);
    echo "acacacaca_$iddia";
       $stmtx = $conexttion->prepare("SELECT dia FROM dia WHERE id_dia = '$iddia'"); 
       $stmtx->execute();
       while($row = $stmtx->fetch()) {
       $dia=$row['dia'];
       }
}
$alumapellido=null;
$alumnombre=null;
$stmt = $conexttion->prepare("SELECT legajo,apellido,nombre FROM alumno where id_alumno=$idalumno"); 
$stmt->execute();
while($row = $stmt->fetch()) {
        $alumapellido=($row['apellido']);
        $alumnombre=($row['nombre']);

}
$body="$alumapellido $alumnombre se ha eliminado de $nombreMateria el dia $dia a las $hora";

$emails=array();
array_push($emails,$emailprofesor);
$err=enviaremail($emails,$body);
//end prepara email



        $direccion = $URL.$alumnoPpal;
        header_remove();
        header("Location: $direccion");
        
    ?>