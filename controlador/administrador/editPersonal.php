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

if($_SESSION['PersonalAdmin']=="Personal"){
    $direccion= $URL . $altaPersonal;
}
if($_SESSION['PersonalAdmin']=="Admin"){
    $direccion=$URL.$altaAdministrador;
}

header("Location: $direccion");

$_SESSION['eliminarPersonal']=true;

function editarProfesor($legajo,$nombre,$apellido,$email){
    $con= new conexion();
    $conn=$con->getconexion();
        $stmt2 = $conn->prepare("UPDATE persona SET nombre = '$nombre',apellido = '$apellido',email = '$email' WHERE dni=$legajo"); 
        $stmt2->execute();
        
}
?>