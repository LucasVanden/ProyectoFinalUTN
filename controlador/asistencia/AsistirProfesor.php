<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);

session_start();

$idMateria= $_POST['idmateria'];
$idProfesor= $_SESSION['idProfesor'];
$idhoradeconsulta=$_POST['asistir'];

echo $idhoradeconsulta;
$con= new conexion();
$conn=$con->getconexion();


$stmt = $conn->prepare("SELECT id_presentismo FROM presentismo where fk_horadeconsulta=$idhoradeconsulta"); 
$stmt->execute();
while($row = $stmt->fetch()) {
    $idpresentismo =$row['id_presentismo'];
}

if(isset($idpresentismo)){
    $hora=date("H:i:s");
    $stmt2 = $conn->prepare("UPDATE presentismo SET HoraHasta = '$hora' WHERE id_presentismo=$idpresentismo"); 
    $stmt2->execute();

}else{
    $fechaActual=date("Y-m-d");
    $hora=date("H:i:s");

    $stmt2 = $conn->prepare("INSERT INTO `presentismo` (`id_presentismo`, `fecha`,`horaDesde`, `HoraHasta`, `fk_profesor`,fk_horadeconsulta)
    VALUES (NULL, '$fechaActual', '$hora', '00:00:00','$idProfesor', '$idhoradeconsulta');"); 
    $stmt2->execute();
}

$direccion= $URL . $asistenciaProfesor;
header("Location: $direccion");
?>