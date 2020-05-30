<?php 
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';

require $DIR.$conexion;
require $DIR.$Asueto;
require_once ($DIR . $Alumno);
require_once ($DIR . $Materia);
require_once ($DIR . $HorarioDeConsulta);
require_once ($DIR . $Profesor);
require_once ($DIR . $HoraDeConsulta);
require_once ($DIR . $Departamento);
require_once ($DIR . $AnotadosEstado);
require_once ($DIR . $DetalleAnotados);
require_once ($DIR . $EstadoAnotados);
require_once ($DIR . $AvisoProfesor);
require_once ($DIR . $Dedicacion);
$marcarAsuetoAsueto= $URL.$marcarAsuetoAsueto;


function CambiarFechaHastaDeConsultaAnterior($idmateria,$idprofesor,$semestre,$n){
    $con= new conexion();
    $conn = $con->getconexion();
  
    $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia 
    FROM horariodeconsulta where fk_materia=$idmateria and fk_profesor=$idprofesor and semestre=$semestre and activoHasta='0000-00-00' and n=$n"); 
    $stmt2->execute();
    while($row = $stmt2->fetch()) {
        $hor = new HorarioDeConsulta();
        $hor->setid_horarioDeConsulta($row['id_horariodeconsulta']);
        //--
        global $idhorarioAcambiar;
        $id=$hor->getid_horarioDeConsulta();
        $idhorarioAcambiar=$id;
        $fechaActual= date("Y-m-d");
        $stmt = $conn->prepare("UPDATE horariodeconsulta SET activoHasta='$fechaActual' WHERE id_horariodeconsulta=$id");
        $stmt->execute();
    }
}
CambiarFechaHastaDeConsultaAnterior(4,27,31,1);
?>




<html>
<head>

</head>
<body>



    <form action=<?php echo $marcarAsuetoAsueto?> class="form-container"  method="POST">
        <h1>Asueto</h1>


        <input type="time" id="f1" name="horaDesde" value="08:11" required>
        <input type="time" id="f2" name="horaHasta" value="09:23" required>
 

        <button type="submit" class="btn" formaction=<?php echo $marcarAsuetoAsueto ?> >Agregar</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </form>



</body>
</html>

