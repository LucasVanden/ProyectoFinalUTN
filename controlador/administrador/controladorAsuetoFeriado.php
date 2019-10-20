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

$fechaFeriado=$_POST['fechaFeriado'];

crearFeriado($fechaFeriado);


$direccion= $URL . $asutosFeriado;
header("Location: $direccion");

function crearFeriado($fecha){
    $con= new conexion();
    $conn=$con->getconexion();

    $stmt = $conn->prepare("SELECT id_asueto FROM asueto where fechaAsueto='$fecha' "); 
    $stmt->execute();
    if($stmt->rowCount() == 0) {

        $stmt = $conn->prepare("INSERT INTO `asueto` (`id_asueto`, `fechaAsueto`, `horaDesdeAsueto`, `horaHastaAsueto`) 
        VALUES (NULL, '$fecha', '08:00:00' , '23:30');");  
        $stmt->execute();
    }

}

?>