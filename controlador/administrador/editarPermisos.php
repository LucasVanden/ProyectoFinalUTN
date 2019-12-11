<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);
session_start();
$con= new conexion();
$conexttion=$con->getconexion();
      
    $idpermiso=$_POST['permiso'];
    $rol=6;

    $stmt = $conexttion->prepare("SELECT fk_privilegio,fk_perfil FROM privilegioperfil WHERE fk_perfil=$rol and fk_privilegio=$idpermiso");  
    $stmt->execute();
    if($stmt->rowCount() == 0) {
        $stmt2 = $conexttion->prepare("INSERT INTO `privilegioperfil` (`fk_perfil`, `fk_privilegio`) 
        VALUES ('$rol', '$idpermiso');"); 
        $stmt2->execute();
    }else{
        $stmt2 = $conexttion->prepare("DELETE FROM privilegioperfil WHERE  fk_perfil=$rol and fk_privilegio=$idpermiso");  
        $stmt2->execute();
    }

        // header_remove();
        // $direccion= $URL . $Permisos;
        // header("Location: $direccion");

        
    ?>