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

$idalumno=$_POST['alumno'];

bajaAlumno($idalumno);


$_SESSION['eliminarAlumno']=true;

$direccion= $URL . $altaAlumno;
header("Location: $direccion");

$_SESSION['mostrarAulas']=true;
function bajaAlumno($idalumno){
    $con= new conexion();
    $conn=$con->getconexion();

        $stmt = $conn->prepare("UPDATE alumno SET eliminado = '1' WHERE id_alumno='$idalumno'"); 
        $stmt->execute();

        $stmt2 = $conn->prepare("DELETE FROM usuario WHERE fk_alumno='$idalumno'"); 
        $stmt2->execute();
}
?>