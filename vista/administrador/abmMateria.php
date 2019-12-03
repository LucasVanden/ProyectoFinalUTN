<?php
session_start();

require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
  }else{
    if($_SESSION['rol'] != 4){
        header('location: '. $URL.$login);
    }
  }
  
require_once ($DIR.$conexion);
require_once ($DIR.$controladorAdministrador);



$Menu= $URL.$AsuetoMenu;
$ABMAula= $URL.$ABMAula;

$borrarDepartamento=$URL.$borrarDepartamento;
$abmDepartamento=$URL.$abmDepartamento;
$crearMateria=$URL.$crearMateria;
$BorrarMateria=$URL.$BorrarMateria;
$editarmesaMateria=$URL.$editarmesaMateria;
$abmMateria=$URL.$abmMateria;
$mostrarMaterias=$URL.$mostrarMaterias;

$a=new controladorAdministrador();
$departamentos=$a->BuscarDepartamento();




if(isset($_SESSION['departamentos'])){
    $dep=$_SESSION['departamentos'];
}else{
    $dep=2;
}

if(isset($_SESSION['idDepartamentoSeleccionado'])){
    $idDepartamento=$_SESSION['idDepartamentoSeleccionado'];
}else{
    $idDepartamento=2;
}

$materias=$a->BuscarMaterias($idDepartamento);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
 
    </head>
    <body background = <?php echo $URL.$fondo?> onload="PopUp()"> 
    <script src="jquery.js"></script>
    <?php require $DIR.$headera ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h2>Materia</h2>
        <form action=<?php echo $crearMateria ?> method="POST">
            <div>
                    <tr>
                        <th>Nombre Materia</th>
                        <td>
                        <input type="text" name="nombreMateria" required><br>
                        </td>
                    </tr>    
                    
<tr>
<th>Departamento</th>
<select id="first-choice" name="departamentos">
<?php 
$listadepartamento = $a->BuscarDepartamento();
//'2' por la materia q sea basica
foreach ($listadepartamento as $departamento): ?> 
<option <?php if($departamento->getid_departamento() == $dep){echo("selected");}?> value=<?php echo "{$departamento->getid_departamento()}" ?>> <?php echo "{$departamento->getnombre()}" ?></option>   
<?php endforeach; 
?>
</select>
</tr> 
<tr>
<th>Dia de Mesa</th>
<select id="second-choice" name="diaMesa">

<option value="1">Lunes</option>   
<option value="2">Martes</option>   
<option value="3">Miercoles</option>   
<option value="4">Jueves</option>   
<option value="5">Viernes</option>   

</select>
</tr> 
                  </div>
                        <div><br><input type="submit" value="Cargar Materia" name="Buscar" formaction=<?php echo $crearMateria ?> /><br><br></div>

</form>         
<form action=<?php echo $abmMateria ?> method="POST">              
                        <h2>Ver Materias</h2>
                         <select id="first-choice" name="depBuscar">
<?php 
$listadepartamento = $a->BuscarDepartamento();

foreach ($listadepartamento as $departamento): ?> 
<option <?php if($departamento->getid_departamento() == $idDepartamento){echo("selected");}?> value=<?php echo "{$departamento->getid_departamento()}" ?>> <?php echo "{$departamento->getnombre()}" ?></option>   
<?php endforeach; 
?>
</select>

                         <div>  <br><input type="submit" value="Mostrar Materias" name="Buscar" formaction=<?php echo $mostrarMaterias ?> onClick="myFunction()"/></div>
                       

                       </form>



<div id="myDIV" align="center">
<div class="container"> 
                <div class="table-responsive col-md-12 col-md-offset-0">
                    <table id="myTable2" class="table table-bordered table-hover">
                        <tr class="info">
                            <th onclick="sortTable(0)" style="cursor:pointer";>Materia</th>
                            <th onclick="sortTable(1)" style="cursor:pointer";>Dia Mesa</th>
                
                        </tr>

                        <?php foreach ($materias as $mat): ?>
                        <form action=<?php echo $abmMateria ?> method="POST">         
                            <tr>
                                <td>
                                <div>
                                <?php   echo $mat->getnombreMateria() ?>
                                </td>
                                <td>
                                <select name="diamesa" id="iddiamesa">

                                <option <?php if($mat->getdia()->getid_dia()=='1'){echo ("selected");}?> value=1>Lunes</option>
                                <option <?php if($mat->getdia()->getid_dia()=='2'){echo ("selected");}?> value=2>Martes</option>
                                <option <?php if($mat->getdia()->getid_dia()=='3'){echo ("selected");}?> value=3>Miercoles</option>
                                <option <?php if($mat->getdia()->getid_dia()=='4'){echo ("selected");}?> value=4>Jueves</option>
                                <option <?php if($mat->getdia()->getid_dia()=='5'){echo ("selected");}?> value=5>Viernes</option>
                                </select>
                                </td>
                                <td>
                                <button type="submit" value=<?php echo $mat->getid_materia()?> name="BorraridMateria" formaction=<?php echo $editarmesaMateria ?> 
                                onclick="return confirm('Cambiar día de mesa de <?php echo $mat->getNombreMateria()?> ')">Asignar</button>
                                </td>
                                <td>
                                <button type="submit" value=<?php echo $mat->getid_materia()?> name="BorraridMateria" formaction=<?php echo $BorrarMateria ?> 
                                onclick="return confirm('Esta seguro que desea eliminar materia <?php echo $mat->getNombreMateria()?> ')">Eliminar</button>
                                </form>
                                </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </table>
    
                    </div>
    </div>
</div>

<!-- // -->


<script>
 var x = document.getElementById("myDIV");
 x.style.display = "none";
</script>

<?php if(isset($_SESSION['idDepartamentoSeleccionado'])) :?>
<script>
 var x = document.getElementById("myDIV");
 x.style.display = "block";
</script>
<?php endif; ?>



<script>
function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
} 
</script>
                

<script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable2");
  switching = true;
  // Set the sorting direction to ascending:
  dir = "asc"; 
  /* Make a loop that will continue until
  no switching has been done: */
  while (switching) {
    // Start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /* Loop through all table rows (except the
    first, which contains table headers): */
    for (i = 1; i < (rows.length - 1); i++) {
      // Start by saying there should be no switching:
      shouldSwitch = false;
      /* Get the two elements you want to compare,
      one from current row and one from the next: */
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /* Check if the two rows should switch place,
      based on the direction, asc or desc: */
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          // If so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /* If a switch has been marked, make the switch
      and mark that a switch has been done: */
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      // Each time a switch is done, increase this count by 1:
      switchcount ++; 
    } else {
      /* If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again. */
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>

<div id="snackbar">
  

   Materia Existente
        
</div>
<!-- Style popUP -->
<style>
    #snackbar {
    visibility: hidden; /* Hidden by default. Visible on click */
    min-width: 250px; /* Set a default minimum width */
    margin-left: -125px; /* Divide value of min-width by 2 */
    background-color: #333; /* Black background color */
    color: #fff; /* White text color */
    text-align: center; /* Centered text */
    border-radius: 2px; /* Rounded borders */
    padding: 16px; /* Padding */
    position: fixed; /* Sit on top of the screen */
    z-index: 1; /* Add a z-index if needed */
    left: 50%; /* Center the snackbar */
    bottom: 30px; /* 30px from the bottom */
    }

    /* Show the snackbar when clicking on a button (class added with JavaScript) */
    #snackbar.show {
    visibility: visible; /* Show the snackbar */
    /* Add animation: Take 0.5 seconds to fade in and out the snackbar. 
    However, delay the fade out process for 2.5 seconds */
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }


    /* Animations to fade the snackbar in and out */
    @-webkit-keyframes fadein {
    from {bottom: 0; opacity: 0;} 
    to {bottom: 30px; opacity: 1;}
    }

    @keyframes fadein {
    from {bottom: 0; opacity: 0;}
    to {bottom: 30px; opacity: 1;}
    }

    @-webkit-keyframes fadeout {
    from {bottom: 30px; opacity: 1;} 
    to {bottom: 0; opacity: 0;}
    }

    @keyframes fadeout {
    from {bottom: 30px; opacity: 1;}
    to {bottom: 0; opacity: 0;}
    }
</style>
<!-- funcion PopUp -->
<script>
    function PopUp() {
    // Get the snackbar DIV

    if(<?php echo ($_SESSION["existenteMateria"]) ?>){
    var x = document.getElementById("snackbar");
    <?php $_SESSION["existenteMateria"]=NULL;
    ?>
    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }


    } 
</script>
<!-- Cartel PopUp al clickear Fecha -->
<div id="snackbar">
    <?php 

    if( $_SESSION["agrego"]&&$_SESSION["elimino"]==NULL){
        echo "Se agrego la Fecha";}
    if( $_SESSION["elimino"]&&$_SESSION["agrego"]==NULL){
        echo "Se elimino la Fecha";}
        ?>
</body>
    <footer>
    <?php require $DIR.$footer; ?>     
    </footer>  
</html>