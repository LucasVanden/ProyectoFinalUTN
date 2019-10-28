<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);

session_start();


$profesor=$_POST['profesor'];
if(isset($_POST['Materias'])){
    $Materias=$_POST['Materias'];
    date_default_timezone_set('America/Argentina/Mendoza');

    $con= new conexion();
    $conn=$con->getconexion();

    $stmt = $conn->prepare("UPDATE dedicacion_materia_profesor SET eliminado = '1' WHERE fk_profesor=$profesor and fk_materia=$Materias"); 
    $stmt->execute();

    buscarHorasACerrar($Materias,$profesor);
}

$direccion= $URL . $bajaMateriaProfesor;
header("Location: $direccion");

function buscarHorasACerrar($Materia,$profesor){
    $listaHorariosACerrar=array();
    $listaidmateria=array();
    $listaidprofesor=array();
    $fechaActual=date("Y-m-d");
    $con= new conexion();
    $conn = $con->getconexion();
    $stmt = $conn->prepare("SELECT id_horadeconsulta,fk_horariodeconsulta,fechaDesdeAnotados,fechaHastaAnotados,fk_materia,fk_profesor FROM horadeconsulta where estadoVigencia='activo' and fk_materia=$Materia and fk_profesor=$profesor "); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $tempidhorario=$row['id_horadeconsulta'];
        $idmateria=$row['fk_materia'];
        $idprofesor=$row['fk_profesor'];

        $stmt2 = $conn->prepare("UPDATE horadeconsulta SET estadoVigencia = 'completo' WHERE id_horadeconsulta=$tempidhorario");
        $stmt2->execute();
        $stmt3 = $conn->prepare("UPDATE horadeconsulta SET estadoPresentismo = 'calculado' WHERE id_horadeconsulta=$tempidhorario");
        $stmt3->execute();

        $stmt4 = $conn->prepare("SELECT id_horariodeconsulta FROM horariodeconsulta where fk_profesor=$idprofesor and fk_materia=$idmateria");
        $stmt4->execute();
        while($row = $stmt4->fetch()) {
            $temphorario=$row['id_horariodeconsulta'];
            $stmt5 = $conn->prepare("UPDATE horariodeconsulta SET activoHasta = '$fechaActual' WHERE id_horariodeconsulta=$temphorario");
            $stmt5->execute();
        }
    }
    
}

?>