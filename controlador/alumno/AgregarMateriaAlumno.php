<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);
session_start();
$con= new conexion();
$conexttion=$con->getconexion();
      
    $idmateria=$_POST["Materias"];
    //$idalumno=$_SESSION['idalumno'];
    $idalumno= $_SESSION['idalumno'];

 $_SESSION['departamentos']=$_POST["departamentos"];

        $stmt = $conexttion->prepare("INSERT INTO `materias_alumno` (`fk_alumno`, `fk_materia`) 
        VALUES ('$idalumno', '$idmateria');"); 
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