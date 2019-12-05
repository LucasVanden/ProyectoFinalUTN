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

$idpersonal=$_POST['persona'];

bajapersona($idpersonal);


$_SESSION['eliminarPersonal']=true;

$direccion= $URL . $altaPersonal;
header("Location: $direccion");

$_SESSION['mostrarAulas']=true;
function bajapersona($idpersonal){
    $con= new conexion();
    $conn=$con->getconexion();

        $stmt = $conn->prepare("UPDATE persona SET eliminado = '1' WHERE id_persona='$idpersonal'"); 
        $stmt->execute();

        $stmt2 = $conn->prepare("DELETE FROM usuario WHERE fk_persona='$idpersonal'"); 
        $stmt2->execute();
}
?>