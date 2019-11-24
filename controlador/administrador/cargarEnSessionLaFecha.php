<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);
session_start();
$_SESSION['cargarEnSessionLaFecha']=$_POST['fechadia'];
$f=$_POST['fechadia'];

$con= new conexion();
$conn=$con->getconexion();
$stmt = $conn->prepare("SELECT horaDesdeAsueto,horaHastaAsueto FROM asueto WHERE tipo='asueto' and fechaAsueto = '$f'");  
$stmt->execute();
while($row = $stmt->fetch()) {
$_SESSION['desde']=$row['horaDesdeAsueto'];
$_SESSION['hasta']=$row['horaHastaAsueto'];
}
?>