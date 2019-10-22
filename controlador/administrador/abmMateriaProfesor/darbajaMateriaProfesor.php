<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);

session_start();


$profesor=$_POST['profesor'];
$Materias=$_POST['Materias'];

date_default_timezone_set('America/Argentina/Mendoza');

$con= new conexion();
$conn=$con->getconexion();

$stmt = $conn->prepare("UPDATE dedicacion_materia_profesor SET eliminado = '1' WHERE fk_profesor=$profesor and fk_materia=$Materias"); 
$stmt->execute();



$direccion= $URL . $SeleccionEditarAulaAsignada;
header("Location: $direccion");
?>