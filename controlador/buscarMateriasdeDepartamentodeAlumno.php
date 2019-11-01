<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR . $Materia);
session_start();
$con= new conexion();
$conexttion=$con->getconexion();

$idalumno=$_SESSION['idalumno'];


//ORDER BY nombreMateria


    $conn = $conexttion;
    if (isset($_GET['choice'])){
    $choice = $_GET['choice'];
    $stmt = $conn->prepare("SELECT materia.id_materia,materia.nombreMateria FROM materia where materia.eliminado is null and materia.fk_departamento='$choice' and materia.id_materia NOT IN
    (SELECT materias_alumno.fk_materia 
     FROM materias_alumno
    WHERE materias_alumno.fk_alumno=$idalumno)
 "); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $dep = new Materia();
        $dep->setid_materia($row['id_materia']);
        $dep->setnombreMateria($row['nombreMateria']);
        echo "<option value=" . $row['id_materia'].">" . $row{'nombreMateria'} . "</option>";
    }
}

    ?>