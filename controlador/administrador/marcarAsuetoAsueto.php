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

$fecha=$_SESSION['cargarEnSessionLaFecha'];
$desde=$_POST['horaDesde'];
$hasta=$_POST['horaHasta'];




$fechas=ConsultarAsueto($fecha,$desde,$hasta);

$direccion= $URL . $AsuetoAsueto;
header("Location: $direccion");

function ConsultarAsueto($fecha,$desde,$hasta){
    $con= new conexion();
    $conn=$con->getconexion();
    
        $stmt = $conn->prepare("SELECT fechaAsueto FROM asueto WHERE tipo='asueto' and fechaAsueto = '$fecha'");  
        $stmt->execute();
        $crearFecha=true;
        while($row = $stmt->fetch()) {
            $stmt2 = $conn->prepare("DELETE FROM asueto WHERE tipo='asueto' and fechaAsueto= '$fecha'");  
            $stmt2->execute();
            $crearFecha=false;
            $_SESSION["elimino"]=true;
        }
        if($crearFecha){
            $stmt3 = $conn->prepare("INSERT INTO `asueto` (`id_asueto`, `fechaAsueto`, `horaDesdeAsueto`, `horaHastaAsueto`,`tipo`) 
            VALUES (NULL, '$fecha', '$desde' , '$hasta','asueto');");  
            $stmt3->execute();
            $_SESSION["agrego"]=true;
        }


}

?>