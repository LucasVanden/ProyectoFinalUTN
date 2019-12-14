<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR. $email);
session_start();


$legajo=$_POST['legajo'];



$con = new conexion();
$conexttion = $con->getconexion();
$stmt = $conexttion->prepare("SELECT fk_alumno,fk_profesor,fk_persona FROM usuario WHERE usuario= '$legajo'");
$stmt->execute();
if($stmt->rowCount() == 0) {
    $mensaje="legajo inexistente";
    $_SESSION['mensaje']="fail";
}else{

    while($row = $stmt->fetch()) {
        $alumno=$row['fk_alumno'];
        $profesor=$row['fk_profesor'];
        $persona=$row['fk_persona'];
    }
     //
    // alumno
    //
    if($alumno!=NULL){
        $stmt2 = $conexttion->prepare("SELECT email FROM alumno WHERE id_alumno= '$alumno'");
        $stmt2->execute();
        while($row = $stmt2->fetch()) {
            $email=$row['email'];
        }
    }
    //
    // profesor
    if($profesor!=NULL){
        $stmt2 = $conexttion->prepare("SELECT email FROM profesor WHERE id_profesor= '$profesor'");
        $stmt2->execute();
        while($row = $stmt2->fetch()) {
            $email=$row['email'];
        }
    }
    //

    //
    // persona
    if($persona!=NULL){
        $stmt2 = $conexttion->prepare("SELECT email FROM persona WHERE id_persona= '$persona'");
        $stmt2->execute();
        while($row = $stmt2->fetch()) {
            $email=$row['email'];
        }
    }
    //

    $keygen=substr(md5(time()), 0, 25);
    $stmt0 = $conexttion->prepare("UPDATE usuario SET keygen = '$keygen' WHERE usuario='$legajo'"); 
    $stmt0->execute();
    $mail=array();
    array_push($mail,$email);
    $body='Ingrese al siguiente link para restaurar su contrase&#241;a : '.'<a href="'.$URL.$restaurarContraseñaMail.'?keygen='.$keygen.'">Link</a>';;
    
    // $body='<a href="http://localhost/ProyectoFinalUTN/vista/restaurarContrase%C3%B1a.php?keygen='.$keygen.'">Google</a>';
    echo $body;

    enviaremail($mail,$body);
    $mensaje="Se le envió un correo a $email con los pasos a seguir";
    $_SESSION['mensaje']="ok";
}



$_SESSION['contenidomensaje']=$mensaje;
$direccion= $URL . $recuperarContraseña;
header("Location: $direccion");




?>