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


$abmcrearAula= $URL.$abmcrearAula;
$Menu= $URL.$AsuetoMenu;
$ABMAula= $URL.$ABMAula;
$borrarAula=$URL.$borrarAula;

$a=new controladorAdministrador();
$aulas=$a->BuscarAulas();

?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
 
    </head>
    <body background = <?php echo $URL.$fondo?> onload="myFunction()">
    <script src="jquery.js"></script>
    <?php require $DIR.$headera ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h2>Cargar Aula</h2>
        <form action=<?php echo $abmcrearAula ?> method="POST">
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF" align="center">                     
                    <tr>
                        <th>Cuerpo</th>
                        <td>
                            <input type="text" name="cuerpo" required><br>
                        </td>
                    </tr>
                    <tr>                   
                        <th>Nivel</th>
                        <td>
                            <input type="number" name="nivel" min="-2" max="10" step="1" required>
                        </td>
                        <br>
                    </tr>
                    <tr>   
                        <th>Aula</th>
                        <td>
                            <input type="text" name="Aula" required><br>
                        </td>
                        <br>
                    </tr>   
                </table>
            </div>
            <div><input type="submit" value="Cargar Aula" name="Buscar" formaction=<?php echo $abmcrearAula ?> /></div>     
        </form>
            <div><input type="submit" value="Mostrar Aulas" name="Buscar" formaction=<?php echo $ABMAula ?> onClick="myFunction()"/></div>
        
        <form action=<?php echo $borrarAula ?> method="POST">
            <div id="myDIV" align="center">
            <div class="container"> 
                <div class="table-responsive col-md-12 col-md-offset-0">
                    <table id="myTable2" class="table table-bordered table-hover">
                        <tr class="info">
                            <th onclick="sortTable(0)" style="cursor:pointer";>Cuerpo</th>
                            <th onclick="sortTable(1)" style="cursor:pointer";>Nivel</th>
                            <th onclick="sortTable(2)" style="cursor:pointer";>Aula</th>
                            <th onclick="sortTable(3)" style="cursor:pointer";></th>
                        </tr>
                        <?php foreach ($aulas as $aula): ?>
                        <tr>
                            <div>
                                <td>
                                    <?php echo "cuerpo ".$aula->getcuerpoAula() ?>
                                </td>
                                <td>
                                    <?php echo "nivel ".$aula->getnivelAula() ?>
                                </td>
                                <td>
                                    <?php echo "aula ".$aula->getnumeroAula() ?>
                                </td>
                                <td>
                                <button type="submit" value=<?php echo $aula->getid_aula()?> name="borrarAula" formaction=<?php echo $borrarAula ?> onClick="return confirm('Esta seguro que desea eliminar <?php echo "cuerpo".$aula->getcuerpoAula()." nivel".$aula->getnivelAula()." aula". $aula->getnumeroAula()?> ')"> Eliminar</button>
                                </td>             
                            </div>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div> 
            <!-- // -->

                <!-- //    -->
            </div>
        </form>
        <script>
            var x = document.getElementById("myDIV");
            x.style.display = "none";
        </script>

        <?php if(isset($_SESSION['mostrarAulas'])) :?>
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
            <!-- metodo vandenbosch para ver el fondo -->
            <div>
            <td>.</td><br>
            <td>.</td>
            </div>
             <!-- metodo vandenbosch para ver el fondo -->

           
<div id="snackbar">
    No puede eliminar un aula asignada
</div>
<!-- Style popUP -->
<style>
    #snackbar {
    visibility: hidden; /* Hidden by default. Visible on click */
    min-width: 250px; /* Set a default minimum width */
    margin-left: -125px; /* Divide value of min-width by 2 */
    background-color: red; /* Black background color */
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
    function myFunction() {
    // Get the snackbar DIV

    if(<?php echo ($_SESSION["NoBorrar"]) ?>){
    var x = document.getElementById("snackbar");
    <?php $_SESSION["NoBorrar"]=NULL;?>
    // Add the "show" class to DIV
    x.className = "show";
    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }


    } 
</script>
</body>
    <footer>
    <?php require $DIR.$footer; ?>       
    </footer>  
</html>