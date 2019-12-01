<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR.$controladorAdministrador);
$con= new conexion();
$conexttion=$con->getconexion();

$a=new controladorAdministrador();

$select=false;
if(isset($_GET['aula'])){
    $salon=$_GET['aula'];
    $aula=$a->BuscarAulaID($salon);
    $select=true;
}
if(!$select){
    echo "<option value=" . "".">" . "Ingrese Aula" . "</option>";
}
    $conn = $conexttion;
    if (isset($_GET['choice'])){
    $choice = $_GET['choice'];
    $choice2 = $_GET['choice2'];
    $stmt = $conn->prepare("SELECT DISTINCT numeroAula FROM aula where cuerpoAula='$choice2' and nivelAula='$choice' and eliminado is null ORDER BY numeroAula "); 
  
    $stmt->execute();
    while($row = $stmt->fetch()) {

        if($select && ($aula->getnumeroAula()==$row['numeroAula'])){
            echo "<option selected value=" . $row['numeroAula'].">" . $row{'numeroAula'} . "</option>";
        }else{
            echo "<option value=" . $row['numeroAula'].">" . $row{'numeroAula'} . "</option>";
        }
    }
}

    ?>