<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR . $Materia);
session_start();

$con= new conexion();
$conexttion=$con->getconexion();


  
    $conn = $conexttion;
    echo "<option value=" . "-1".">" . "Todas" . "</option>";
    if (isset($_GET['choice'])){
    $choice = $_GET['choice'];
    $stmt = $conn->prepare("SELECT id_materia,nombreMateria FROM materia where fk_departamento='$choice' ORDER BY nombreMateria "); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $dep = new Materia();
        $dep->setid_materia($row['id_materia']);
        $dep->setnombreMateria($row['nombreMateria']);

        if ($row['id_materia']==$_SESSION['Materias']){
            echo "<option selected value=" . $row['id_materia'].">" . $row{'nombreMateria'} . "</option>";
        }else{
            echo "<option value=" . $row['id_materia'].">" . $row{'nombreMateria'} . "</option>";
        }
    }
}

    ?>