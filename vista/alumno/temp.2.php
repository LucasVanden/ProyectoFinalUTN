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

