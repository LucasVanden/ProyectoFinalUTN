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

$fechaMesa=$_POST['fechaMesa'];
$_SESSION['FechaMesaIngresada']=$fechaMesa;
crearfechaMesa($fechaMesa);

$año=$_POST['año'];
$fechas=buscarMesa($año);
sort($fechas);
$_SESSION['fechasBuscadas']=$fechas;


$direccion= $URL . $Mesas;
header("Location: $direccion");


function crearfechaMesa($fecha){
    $con= new conexion();
    $conn=$con->getconexion();

    $stmt = $conn->prepare("SELECT id_fechamesa FROM fechamesa where fechaMesa='$fecha'"); 
    $stmt->execute();
    if($stmt->rowCount() == 0) {

    $stmt2 = $conn->prepare("INSERT INTO `fechamesa` (`id_fechamesa`,`fechaMesa`)
    VALUES (null,'$fecha');");  
    $stmt2->execute();
    
    }
}
function buscarMesa($año){
    $con= new conexion();
    $conn=$con->getconexion();

        $listaMesas=array();
        $stmt = $conn->prepare("SELECT fechaMesa FROM fechamesa WHERE fechaMesa LIKE '$año%'");  
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $mesa=$row['fechaMesa'];
         
            array_push($listaMesas,$mesa);
        }
        return $listaMesas;

}
?>