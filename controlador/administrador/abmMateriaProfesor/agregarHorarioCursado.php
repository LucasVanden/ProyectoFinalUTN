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

crearMateriaProfesor($profesor,$Materias,$dia,$horaDesde,$horaHasta,$semestreAnual);


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

?>