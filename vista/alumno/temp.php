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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
</head>
<body>
<form action="temp.php" name="myForm"  method="post" >
  <b>Number Input:</b>
  <input type="time" step="any" min="0"  name="number" id="number" value="08:00" 
  />
         <b>Number Input2:</b>
  <input type="time" step="any" min="0"  name="number2" id="number2" value="23:30"
   /> 
  <input type="submit" class="submit" value="Save" onclick="check()"/>


  <div class="form-popup" id="myForm">
    <form action=<?php echo $marcarAsuetoAsueto?> class="form-container">
        <h1>Asueto</h1>

        <label for="time"><b>Hora Desde</b></label>
        <input type="time" id="f1" name="horaDesde" value=<?php echo $horaDesde;?> required>

        <label for="time"><b>Hora Hasta</b></label>
        <input type="time" id="f2" name="horaHasta" value=<?php echo $horaDesde;?> required>
 

        <button type="submit" class="btn">Agregar</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
    </form>
</div>
</form>
<script>
 function check() {
  var x = document.forms["myForm"]["number"].value;
  var y = document.forms["myForm"]["number2"].value;
   if ( x>y) {
    
     alert("Name must be filled out");
    return false;

   } else {
      
     input.setCustomValidity('');
   }
 }
</script>
<script>
 function check2(input) {
   if (($("#number2").val())  < ($("#number").val()) ) {
     input.setCustomValidity('2 tiene que ser mayor.');
     $("#number2").load()="";
     $("#number").load()="";
   } else {
      
     input.setCustomValidity('');
   }
 }
</script>
</script>


</body>
</html>

