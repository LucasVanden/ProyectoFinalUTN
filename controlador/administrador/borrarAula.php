<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);
require_once ($DIR. $email);
require_once ($DIR . $DetalleAnotados);
require_once ($DIR . $Alumno);
require_once ($DIR . $AnotadosEstado);
require_once ($DIR . $EstadoAnotados);
require_once ($DIR . $Asueto);
require_once ($DIR . $FechaMesa);
require_once ($DIR . $HoraDeConsulta);
require_once ($DIR . $HorarioDeConsulta);
require_once ($DIR . $Profesor);
require_once ($DIR . $Presentismo);

session_start();
date_default_timezone_set('America/Argentina/Mendoza');

$idAula=$_POST['borrarAula'];

borrarAula($idAula);
$_SESSION['IDintentoBorrarAula']=$idAula;

$direccion= $URL . $ABMAula;
header("Location: $direccion");

$_SESSION['mostrarAulas']=true;
function borrarAula($idAula){
    $v1=true;
    $con= new conexion();
    $conn=$con->getconexion();
    $stmt = $conn->prepare("SELECT fk_aula FROM `horariodeconsulta` WHERE activoHasta='0000-00-00' and fk_aula=$idAula"); 
    $stmt->execute();
    if($stmt->rowCount() == 0) {
        $stmt2 = $conn->prepare("SELECT fk_aula FROM `departamento` WHERE eliminado is null and fk_aula=$idAula"); 
        $stmt2->execute();
        if($stmt2->rowCount() == 0) {
            $stmt3 = $conn->prepare("UPDATE aula SET eliminado = '1' WHERE id_aula='$idAula'"); 
            $stmt3->execute();
            $v1=false;
        }
    }
    if($v1){
        $_SESSION['NoBorrar']=true;
    }
}
?>