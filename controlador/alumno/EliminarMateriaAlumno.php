<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
session_start();
$con= new conexion();
$conexttion=$con->getconexion();
      
    $idmateria=$_POST["nombreMateriaSeleccionada"];
    //$idalumno=$_SESSION['idalumno'];
    $idalumno= $_SESSION['idalumno'];
    

 

        $stmt = $conexttion->prepare("DELETE FROM `materias_alumno` WHERE `fk_alumno`=$idalumno AND `fk_materia`=$idmateria"); 
     try{   $stmt->execute();
    } 
     catch(Exception $e){
        echo '<script language="javascript">';
        echo 'alert("Caught exception")';  
        echo '</script>';
     }

        header_remove();
        $direccion= $URL . $alumnoagregarmateria;
        header("Location: $direccion");

        
    ?>