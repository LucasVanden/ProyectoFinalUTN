<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);

session_start();


$idhorarioconsulta=$_POST['asignar'];

$cuerpo=$_POST['cuerpo'];
$nivel=$_POST['nivel'];
$Aula=$_POST['numeroaula'];

date_default_timezone_set('America/Argentina/Mendoza');

$con= new conexion();
$conn=$con->getconexion();

$stmt = $conn->prepare("SELECT id_aula FROM aula where cuerpoAula='$cuerpo' and nivelAula='$nivel' and numeroAula='$Aula' "); 
$stmt->execute();
while($row = $stmt->fetch()) {
    $idaula=$row['id_aula'];
$stmt2 = $conn->prepare("UPDATE horariodeconsulta SET fk_aula = '$idaula' WHERE id_horariodeconsulta=$idhorarioconsulta"); 
$stmt2->execute();
}


$direccion= $URL . $SeleccionEditarAulaAsignada;
header("Location: $direccion");
?>