<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once $DIR . '/modelo/persistencia/conexion.php';
require_once $DIR . '/modelo/Materia.php';

$con= new conexion();
$conexttion=$con->getconexion();


  
    $conn = $conexttion;
    if (isset($_GET['choice'])){
    $choice = $_GET['choice'];
    $stmt = $conn->prepare("SELECT id_materia,nombreMateria FROM materia where fk_departamento='$choice' ORDER BY nombreMateria "); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $dep = new Materia();
        $dep->setid_materia($row['id_materia']);
        $dep->setnombreMateria($row['nombreMateria']);
        echo "<option>" . $row{'nombreMateria'} . "</option>";
    }
}

    ?>