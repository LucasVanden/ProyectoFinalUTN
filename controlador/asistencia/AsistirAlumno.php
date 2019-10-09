<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);

session_start();


$idDetalleAnotados=$_POST['asistir'];

date_default_timezone_set('America/Argentina/Mendoza');

$con= new conexion();
$conn=$con->getconexion();

$hora=date("H:i:s");
$fechaActual=date("Y-m-d");


$stmt = $conn->prepare("INSERT INTO `anotadosestado` (`id_anotadoestado`, `fechaAnotadosEstado`, `horaAnotadosEstado`, `fk_detalleanotados`, `fk_estadoanotados`) 
VALUES (NULL, '$fechaActual', '$hora' , '$idDetalleAnotados', 4);"); 
$stmt->execute();

$direccion= $URL . $asistenciaAlumno;
header("Location: $direccion");
?>