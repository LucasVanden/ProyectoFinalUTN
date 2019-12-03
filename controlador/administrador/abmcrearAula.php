

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
$cuerpo=$_POST['cuerpo'];
$nivel=$_POST['nivel'];
$Aula=$_POST['Aula'];


$con= new conexion();
$conn=$con->getconexion();

$stmt = $conn->prepare("SELECT id_aula FROM aula where cuerpoAula='$cuerpo' and nivelAula='$nivel' and numeroAula='$Aula' and eliminado is null"); 
$stmt->execute();
if($stmt->rowCount() == 0) {

$stmt = $conn->prepare("INSERT INTO `aula` (`id_aula`,`cuerpoAula`,`nivelAula`,`numeroAula`)
VALUES (null, '$cuerpo', '$nivel' , '$Aula');");  
$stmt->execute();

}else{
    $_SESSION["existenteAula"]=true;
}
$_SESSION['mostrarAulas']=true;
 $direccion= $URL . $ABMAula;
 header("Location: $direccion");


?>