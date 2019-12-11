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
require_once ($DIR. $email);

$mail=array();
array_push($mail,"vandenboschlucas@gmail.com");
enviaremail($mail,"pikachu");
echo $_GET['key'];
echo rand(999, 99999);
echo substr(md5(time()), 0, 25);
?>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
</head>
<body>
<div>
<form action="temp.php" name="myForm"  method="post" >
  <b>Number Input:</b>
  <input type="time" step="any" min="0"  name="number1" id="number" value="08:00" oninput="check(this.value)"
  />
         <b>Number Input2:</b>
  <input type="time" step="any" min="0"  name="number21" id="number2" value="23:30" oninput="check(this.value)"
   /> 
  <input type="submit" class="submit" value="Save" />
</form>
<button onclick="test()">GET</button>

<script>
function test(){
  <?php echo"hola";?>
  <?php echo $_GET['key'];?>
}
</script>
<script>
 function check(input) {
  var x = document.forms["myForm"]["number1"].value;
  var y = document.forms["myForm"]["number21"].value;
   if ( x>y) {
    document.getElementById("number").setCustomValidity("This email is already registered!");
    return false;

   } else {
      
    document.getElementById("number").setCustomValidity("");
    document.getElementById("number2").setCustomValidity("");
   }
 }
</script>
<script>
 function check2(input) {
   if (($("#number2").val())  < ($("#number").val()) ) {
     input.setCustomValidity('2 tiene que ser mayor.');

   } else {
      
     input.setCustomValidity('');
   }
 }
</script>
</script>


</body>
</html>

