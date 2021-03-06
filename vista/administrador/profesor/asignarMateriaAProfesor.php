<?php
session_start();
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
  }else{
    if(!in_array(9,$_SESSION['permisos'])){
        header('location: '. $URL.$login);
    }
  }  
require_once ($DIR.$conexion);
require_once ($DIR.$controladorAdministrador);
//antes de romper
$a=new controladorAdministrador();
$altaMateriaAProfesor= $URL.$altaMateriaProfesor;
$departamentoMaterias= $URL.$departamentoMaterias;
$menuAltaProfesor= $URL.$menuAltaProfesor;
$asignarMateriaAProfesor= $URL.$asignarMateriaAProfesor;
$darbajaMateriaProfesor= $URL.$darbajaMateriaProfesor;
?>

<style>
        @font-face {
  font-family: myFirstFont;
  src: url(../../SnowHut.ttf);
}
</style>

<!DOCTYPE html>
<html>
    <head>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0,  minimum-scale=1.0">
      <title>Asignar Materia Profesor</title>
      <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/> 
    </head>
    <body background = <?php echo $URL.$fondo?> onload="PopUp()">
    <script src="jquery.js"></script>
        <?php include  $DIR.$headerAdmin ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?> 
      <div class="container" align="center">
      <br>
        <form action=<?php echo $altaMateriaAProfesor ?> method="POST"> <!-- -->
          <div class="form-group" align="center">
            <h2 for="asignarMateriaAProfesor" class="text-primary" style="font-family:myFirstFont,garamond,serif;font-size:42px;"> Asignar Materia a Profesor </h2>
          </div> 
          <br>
            <div class="container" align="center">
              <div class="table-responsive col-md-10 col-md-offset-2">
                <table class="table table-bordered table-hover" id="tablaBuscar">  
                  <tr class="info">
                    <th>Profesor</th>
                    <td>
                      <select class="browser-default custom-select" data-style="btn-primary" data-widthen="auto" name="profesor">
                        <?php 
                          $listaprofesores = $a->BuscarProfesor();
                          foreach ($listaprofesores as $profesor): ?> 
                        <option value=<?php echo "{$profesor->getid_profesor()}" ?>> <?php echo "{$profesor->getApellido()}, {$profesor->getnombre()}" ?></option>   
                          <?php endforeach; 
                          ?>
                      </select>                                
                    </td>
                    <th>Departamento</th>
                    <td>                                
                      <select class="browser-default custom-select" data-style="btn-primary" data-widthen="auto" id="first-choice" name="departamentos">
                        <?php 
                          $listadepartamento = $a->BuscarDepartamento();
                          foreach ($listadepartamento as $departamento): ?> 
                        <option value=<?php echo "{$departamento->getid_departamento()}" ?>> <?php echo "{$departamento->getnombre()}" ?></option>   
                          <?php endforeach; 
                          ?>
                      </select>
                    </td>
                    <th>Materia</th>
                    <td>                       
                      <select class="browser-default custom-select" data-style="btn-primary" data-widthen="auto" id="second-choice" name="Materias" required>
                      </select> 
                      <script>
                        $("#first-choice").change(function() {
                          $("#second-choice").load("<?php echo $departamentoMaterias.'?choice='?>"+ $("#first-choice").val());
                        }).change();</script>
                    </td>
                  </tr>
                      </select> <!--no se que cierra este-->
                    <th>Dedicacion</th>
                    <td>
                      <select class="browser-default custom-select" data-style="btn-primary" data-widthen="auto" name="dedicacion">         
                        <?php 
                          $listadedicacion = $a->BuscarDedicacion();
                          foreach ($listadedicacion as $ded): ?> 
                        <option value=<?php echo $ded->getid_dedicacion() ?>> <?php echo $ded->gettipo() ?></option>   
                          <?php endforeach; 
                          ?>
                      </select>   
                    </td>
                  </tr>   
                </table>
              </div>
            </div>
            <br>
              <!-- <input type="submit" value="Buscar" name="Buscar" disabled="disabled" />     -->
            <div class="form-group" align="center"> 
              <button class="btn btn-success" id="buttonBuscar" value="Asignar" name="Asignar" type="submit" formaction=<?php echo $altaMateriaAProfesor?> onclick=""> <b>  +  Asignar </b>  
                <span class="glyphicon glyphicon-ok"></span>
              </button>  
            </div>
          </form>
          <form action="asignarMateriaAProfesor.php" method="POST">
            <div class="form-group" align="center"> 
              <button class="btn btn-primary" id="buttonBuscar" value="Ver" name="ver" type="submit" formaction=<?php echo $asignarMateriaAProfesor?> onclick=""> <b>  +  Ver </b>  
                <span class="glyphicon glyphicon-ok"></span>
              </button>  
            </div>
          </form>
            </div>                   
        <tr>               
                 

<?php if( isset($_POST['ver'] ) || isset($_SESSION['Asignar']) ) :?>
<?php $_SESSION['Asignar']=null;?>
  <table align='center' class="table-mostrar">
     <div class="container"> 
        <div class="table-responsive col-md-12 col-md-offset-0">
            <table id="myTable2" class="table table-bordered table-hover"  align="center">
                <tr class="info">
                    <th onclick="sortTable(0)" style="cursor:pointer";>Departamento</th>
                    <th onclick="sortTable(1)" style="cursor:pointer";>Materia</th>
                    <th onclick="sortTable(2)" style="cursor:pointer";>Apellido</th>
                    <th onclick="sortTable(3)" style="cursor:pointer";>Nombre</th>
                    <th onclick="sortTable(4)" style="cursor:pointer";>Dedicacion</th>
                </tr>
                <form action=<?php echo $darbajaMateriaProfesor?>  method="POST"> 
                <div class="container"> 
                    <?php foreach ($a->MostrarMateriasProfesor() as $item) : ?>
                    <tr>
                      
                            <td>
                                <?php echo $item[1]?>
                            </td>
                            <td>
                                <?php echo $item[2]?>
                            </td>
                            <td>
                                <?php echo $item[3]?>
                            </td>
                            <td>
                                <?php echo $item[4]?>
                            </td>
                            <td>
                                <?php echo $item[5]?>
                            </td>
                    
                        <td>
                            <button value=<?php echo $item[0]?> name='id_dedicacion_materia_profesor' formaction=<?php echo $darbajaMateriaProfesor?> onClick="return confirm('Esta seguro que desea eliminar')">Eliminar </button>
                        </td>
                    </tr>
                    <?php endforeach?>
                </div>
                </form>
            </table>     
        </div> 
      </div> 
    </table>
            <?php endif?>

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
    <?php if ($_SESSION['MateriaProfesorExistente']) :?>
        Ya Existente
<?php else:?>
   
<?php endif;?>
</div>
<!-- Style popUP -->
<style>
    #snackbar {
    visibility: hidden; /* Hidden by default. Visible on click */
    min-width: 250px; /* Set a default minimum width */
    margin-left: -125px; /* Divide value of min-width by 2 */
    background-color: black; /* Black background color */
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

    if(<?php echo ($_SESSION['MateriaProfesorExistente']) ?>){
    var x = document.getElementById("snackbar");
    <?php $_SESSION['MateriaProfesorExistente']=NULL;
       ?>
    // Add the "show" class to DIV
    x.className = "show";
    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }


    } 
</script>
</div>
</body>
    <footer>
        <?php require $DIR.$footer; ?>     
    </footer>  
</html>