<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR.$controladorAdministrador);
session_start();
$con= new conexion();
$conexttion=$con->getconexion();


$select=false;
$a=new controladorAdministrador();
if(isset($_GET['aula'])){
    $salon=$_GET['aula'];
    $aula=$a->BuscarAulaID($salon);
    $select=true;
}
  
    $conn = $conexttion;
    if (isset($_GET['choice'])){
    $choice = $_GET['choice'];

    if(!$select){
        echo "<option selected value=''>" . "ingrese Nivel" . "</option>";
    }
    $stmt = $conn->prepare("SELECT DISTINCT nivelAula FROM aula where cuerpoAula='$choice' and eliminado is null ORDER BY nivelAula "); 
  
    $stmt->execute();
    while($row = $stmt->fetch()) {
            if( $select && ($aula->getnivelAula()==$row['nivelAula'])){
                echo "<option selected value=" . $row['nivelAula'].">" . $row{'nivelAula'} . "</option>";
            }else{
        echo "<option value=" . $row['nivelAula'].">" . $row{'nivelAula'} . "</option>";
        }
    }
}

    ?>