<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);
require_once ($DIR . $Profesor);


session_start();
date_default_timezone_set('America/Argentina/Mendoza');

$legajo=$_POST['legajo'];
$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$email=$_POST['email'];


editarProfesor($legajo,$nombre,$apellido,$email);

$direccion= $URL . $altaProfesor;
header("Location: $direccion");

$_SESSION['mostrarAulas']=true;

function editarProfesor($legajo,$nombre,$apellido,$email){
    $con= new conexion();
    $conn=$con->getconexion();
        $stmt2 = $conn->prepare("UPDATE profesor SET nombre = '$nombre',apellido = '$apellido',email = '$email' WHERE legajo=$legajo"); 
        $stmt2->execute();
        
}
?>