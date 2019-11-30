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
require_once ($DIR.$controladorAdministrador);

session_start();
date_default_timezone_set('America/Argentina/Mendoza');

$departamento=$_POST['asignar'];
$cuerpo=$_POST['cuerpo'];
$nivel=$_POST['nivel'];
$numeroaula=$_POST['numeroaula'];


editarDepartamento($departamento,$cuerpo,$nivel,$numeroaula);

$direccion= $URL . $abmDepartamento;
header("Location: $direccion");

$_SESSION['mostrarAulas']=true;

function editarDepartamento($departamento,$cuerpo,$nivel,$numeroaula){
    $con= new conexion();
    $conn=$con->getconexion();

        $stmt = $conn->prepare("SELECT id_aula FROM aula WHERE cuerpoAula='$cuerpo' and nivelAula='$nivel' and numeroAula='$numeroaula' and eliminado is null "); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $AulaAsignada=$row['id_aula'];
        $stmt2 = $conn->prepare("UPDATE departamento SET fk_aula = '$AulaAsignada' WHERE id_departamento=$departamento"); 
        $stmt2->execute();
        }
}
?>