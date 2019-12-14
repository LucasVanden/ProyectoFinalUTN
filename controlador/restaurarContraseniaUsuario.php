<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
session_start();
$con= new conexion();

$conn=$con->getconexion();

$keygen=$_POST['keygen'];
echo $keygen;
echo " buscquda:   ";
$nuevacontraseña=$_POST['nuevacontraseña'];
$confirma_contraseña=$_POST['confirma_contraseña'];

$usuario=buscarUsuariokeygen($keygen);
echo $usuario;

if($usuario!="-1"){
        if($nuevacontraseña==$confirma_contraseña){
            $password = password_hash($nuevacontraseña, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("UPDATE usuario SET contraseña = '$password' WHERE usuario='$usuario'"); 
            $stmt->execute();
            $mensaje="Se actualizo la contraseña";
            $_SESSION['mensaje1']="ok";
        }else{$mensaje="nuevas contraseñas no son iguales";
            $_SESSION['mensaje1']="fail";}
}else{
    $mensaje="link expiro";
    $_SESSION['mensaje1']="fail";
}


$_SESSION['contenidomensaje1']=$mensaje;


$direccion= $URL . $restaurarContraseña."?keygen=".$keygen;
header("Location: $direccion");


function buscarUsuariokeygen($keygen){
    $con= new conexion();
    $conn=$con->getconexion();
 
    $stmt = $conn->prepare("SELECT usuario FROM usuario where keygen='$keygen' "); 
    $stmt->execute();
    if($stmt->rowCount() == 0) {
        $idusuario="-1";
    }
    while($row = $stmt->fetch()) {
       $idusuario=$row['usuario'];
    }
    return $idusuario;
}

?>