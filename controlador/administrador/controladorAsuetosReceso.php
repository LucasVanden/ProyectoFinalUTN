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

$fechaDesdeVerano=$_POST['fechaDesdeVerano'];
$fechaHastaVerano=$_POST['fechaHastaVerano'];



if(($fechaDesdeVerano<$fechaHastaVerano)){
    if($_POST["Obtener"]=="Cargar"){
    crearAsuetosDesdeHasta($fechaDesdeVerano,$fechaHastaVerano);
    }
    if($_POST["Obtener"]=="Borrar"){
        borrarAsuetosDesdeHasta($fechaDesdeVerano,$fechaHastaVerano);
        }
    $direccion= $URL . $asutosReceso;
    header("Location: $direccion");
}else{
    $_SESSION['comprobacion']="fecha Desde debe ser menor a fecha Hasta";
    $direccion= $URL . $asutosReceso;
    header("Location: $direccion");
}


function crearAsuetosDesdeHasta($fechadesde,$fechaHasta){
    $con= new conexion();
    $conn=$con->getconexion();
    $fecha=$fechadesde;

   
        while ($fecha!=$fechaHasta) {

            $stmt = $conn->prepare("SELECT id_asueto FROM asueto where  tipo='receso' and fechaAsueto='$fecha' "); 
            $stmt->execute();
            if($stmt->rowCount() == 0) {

            $stmt = $conn->prepare("INSERT INTO `asueto` (`id_asueto`, `fechaAsueto`, `horaDesdeAsueto`, `horaHastaAsueto`,`tipo`) 
            VALUES (NULL, '$fecha', '08:00:00' , '23:30','receso');");  
            $stmt->execute();
            }

            $fecha=date("Y-m-d",strtotime($fecha.'+ 1day'));
        }

        $stmt = $conn->prepare("INSERT INTO `asueto` (`id_asueto`, `fechaAsueto`, `horaDesdeAsueto`, `horaHastaAsueto`,`tipo`) 
        VALUES (NULL, '$fechaHasta', '08:00:00' , '23:30','receso');");  
        $stmt->execute();
        $_SESSION["agrego"]=true;

}
function borrarAsuetosDesdeHasta($fechadesde,$fechaHasta){
    $con= new conexion();
    $conn=$con->getconexion();
    $fecha=$fechadesde;

   
        while ($fecha!=$fechaHasta) {

            $stmt = $conn->prepare("SELECT id_asueto FROM asueto where  tipo='receso' and fechaAsueto='$fecha' "); 
            $stmt->execute();
            while($row = $stmt->fetch()) {

                $stmt2 = $conn->prepare("DELETE FROM asueto WHERE  tipo='receso' and fechaAsueto= '$fecha'");  
                $stmt2->execute();
            }

            $fecha=date("Y-m-d",strtotime($fecha.'+ 1day'));
        }

        $stmt3 = $conn->prepare("SELECT id_asueto FROM asueto where  tipo='receso' and fechaAsueto='$fechaHasta' "); 
        $stmt3->execute();
        while($row = $stmt3->fetch()) {
            $stmt4 = $conn->prepare("DELETE FROM asueto WHERE  tipo='receso' and fechaAsueto= '$fechaHasta'");  
            $stmt4->execute();
        }
        $_SESSION["elimino"]=true;
}

?>