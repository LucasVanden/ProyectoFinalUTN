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

$año=$_POST['año'];

$fechas=buscarAsueto($año);
sort($fechas);
$_SESSION['fechasBuscadas']=$fechas;


$direccion= $URL . $BorrarAsueto;
header("Location: $direccion");

function buscarAsueto($año){
    $con= new conexion();
    $conn=$con->getconexion();

        $listaAsuetos=array();
        $stmt = $conn->prepare("SELECT fechaAsueto FROM asueto WHERE fechaAsueto LIKE '$año%'");  
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $asueto=$row['fechaAsueto'];
         
            array_push($listaAsuetos,$asueto);
        }
        return $listaAsuetos;

}

?>