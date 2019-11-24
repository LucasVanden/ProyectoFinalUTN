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

$_SESSION["agrego"]=NULL;
$_SESSION["elimino"]=NULL;

$fecha=$_POST['fechadia'];

$fechas=ConsultarAsueto($fecha);

$direccion= $URL . $Mesas;
header("Location: $direccion");

function ConsultarAsueto($fecha){
    $con= new conexion();
    $conn=$con->getconexion();
    
        $stmt = $conn->prepare("SELECT fechaMesa FROM fechamesa WHERE  fechaMesa = '$fecha'");  
        $stmt->execute();
        $crearFecha=true;
        while($row = $stmt->fetch()) {
            $stmt2 = $conn->prepare("DELETE FROM fechaMesa WHERE fechaMesa= '$fecha'");  
            $stmt2->execute();
            $crearFecha=false;
            $_SESSION["elimino"]=true;
        }
        if($crearFecha){
            $stmt3 = $conn->prepare("INSERT INTO `fechaMesa` (`id_fechaMesa`, `fechaMesa`) 
            VALUES (NULL, '$fecha');");  
            $stmt3->execute();
            $_SESSION["agrego"]=true;
        }


}

?>