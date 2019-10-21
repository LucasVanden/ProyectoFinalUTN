

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



session_start();
$departamento=$_POST['departamento'];
$con= new conexion();
$conn=$con->getconexion();
$stmt = $conn->prepare("INSERT INTO `departamento` (`id_departamento`,`nombre`)
VALUES (null, '$departamento');");  
$stmt->execute();

 $direccion= $URL . $abmDepartamento;
 header("Location: $direccion");


?>