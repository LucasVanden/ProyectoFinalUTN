<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR . $Materia);

$con= new conexion();
$conexttion=$con->getconexion();


  
    $conn = $conexttion;
    if (isset($_GET['choice'])){
    $choice = $_GET['choice'];

    $stmt = $conn->prepare("SELECT fk_profesor FROM dedicacion_materia_profesor where fk_materia='$choice' and eliminado is null"); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $pro=$row['fk_profesor'];

        $stmt2 = $conn->prepare("SELECT id_profesor,nombre,apellido FROM profesor where id_profesor='$pro' ORDER BY apellido "); 
        $stmt2->execute();
        while($row = $stmt2->fetch()) {
            $id=$row['id_profesor'];
            $nombre=$row['nombre'];
            $apellido=$row['apellido'];
            $nom=$apellido." ".$nombre;
        
            echo "<option value=" . $id.">" . $nom . "</option>";
        }
    }
}

    ?>