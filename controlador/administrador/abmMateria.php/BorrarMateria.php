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

$idMateria=$_POST['BorraridMateria'];

borrarMateria($idMateria);




$direccion= $URL . $abmMateria;
header("Location: $direccion");

$_SESSION['mostrarAulas']=true;
function borrarMateria($idMateria){
    $con= new conexion();
    $conn=$con->getconexion();

        $stmt = $conn->prepare("UPDATE materia SET eliminado = '1' WHERE id_materia='$idMateria'"); 
        $stmt->execute();
}
?>