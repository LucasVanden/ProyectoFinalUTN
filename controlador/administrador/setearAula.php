<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);

session_start();


$idhorarioconsulta=$_POST['asignar'];
$idaula=$_POST['AulaAsignada'];

date_default_timezone_set('America/Argentina/Mendoza');

$con= new conexion();
$conn=$con->getconexion();

$stmt = $conn->prepare("UPDATE horariodeconsulta SET fk_aula = '$idaula' WHERE id_horariodeconsulta=$idhorarioconsulta"); 
$stmt->execute();



$direccion= $URL . $SeleccionEditarAulaAsignada;
header("Location: $direccion");
?>