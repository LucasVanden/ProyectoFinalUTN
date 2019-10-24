

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
$departamentos=$_POST['departamentos'];
$nombreMateria=$_POST['nombreMateria'];
$diaMesa=$_POST['diaMesa'];

$_SESSION['departamentos']=$departamentos;

$con= new conexion();
$conn=$con->getconexion();

$stmt = $conn->prepare("SELECT id_materia FROM materia where nombreMateria='$nombreMateria' and fk_departamento='$departamentos' "); 
$stmt->execute();
if($stmt->rowCount() == 0) {

$stmt = $conn->prepare("INSERT INTO `materia` (`id_materia`,`nombreMateria`,`fk_departamento`,`fk_dia`)
VALUES (null, '$nombreMateria','$departamentos','$diaMesa');");  
$stmt->execute();
}

 $direccion= $URL . $abmMateria;
 header("Location: $direccion");


?>