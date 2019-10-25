<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
session_start();
$con= new conexion();

$conexttion=$con->getconexion();
$contraseña=$_POST['contraseña'];
$nuevacontraseña=$_POST['nuevacontraseña'];
$confirma_contraseña=$_POST['confirma_contraseña'];
$usuario=$_SESSION['usuario'];





    $conn = $conexttion;
    $stmt = $conn->prepare("SELECT contraseña FROM usuario where id_usuario='$usuario' "); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
       $pass=$row['contraseña'];
    }

    if (password_verify($contraseña,$pass)){

        if($nuevacontraseña==$confirma_contraseña){
            $password = password_hash($nuevacontraseña, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("UPDATE usuario SET contraseña = '$password' WHERE id_usuario=$usuario"); 
            $stmt->execute();
            $mensaje="Se actualizo la contraseña";
            $_SESSION['mensaje']="ok";
        }else{$mensaje="nuevas contraseñas no son iguales";
            $_SESSION['mensaje']="fail";}
        
    }else{
        $mensaje="contraseña incorecta";
        $_SESSION['mensaje']="fail";
    }



$_SESSION['contenidomensaje']=$mensaje;
if($_POST['tipo']=="profesor"){
$direccion= $URL . $vistacambiocontraseña;
header("Location: $direccion");
}
if($_POST['tipo']=="alumno"){
    $direccion= $URL . $cambiarContraseniaalumno;
    header("Location: $direccion");
    }


?>