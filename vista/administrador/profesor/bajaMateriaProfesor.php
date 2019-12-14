<!-- ASIGNAR HORARIO DE CURSADO -->
<!-- Batman -->
<?php
session_start();
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
  }else{
    if(!in_array(10,$_SESSION['permisos'])){
        header('location: '. $URL.$login);
    }
  }  
require_once ($DIR.$conexion);
require_once ($DIR.$controladorAdministrador);

$a=new controladorAdministrador();

$altaMateriaAProfesor= $URL.$altaMateriaProfesor;
$darbajaMateriaProfesor= $URL.$darbajaMateriaProfesor;
$buscarmateriasProfesor= $URL.$buscarmateriasProfesor;
$bajaMateriaProfesor= $URL.$bajaMateriaProfesor;
$eliminarHorariodeCursado= $URL.$eliminarHorariodeCursado;
$menuAltaProfesor= $URL.$menuAltaProfesor;
$agregarHorarioCursado= $URL.$agregarHorarioCursado;

if(isset($_POST['profesor'])){
    if(isset($_POST['Materias'])){
$listaMaterias=$a->BuscarHorarioDeCursadodeProfesorMateria($_POST['profesor'],$_POST['Materias']);
// echo '<pre>'; print_r($listaMaterias); echo '</pre>';   
}
}
if(isset($_SESSION['idprofesor'])){
    if(isset($_SESSION['idMaterias'])){
$listaMaterias=$a->BuscarHorarioDeCursadodeProfesorMateria($_SESSION['idprofesor'],$_SESSION['idMaterias']);
// echo '<pre>'; print_r($listaMaterias); echo '</pre>';   
}
}

if(isset($_POST['profesor'])){
    $_SESSION['idprofesor']=$_POST['profesor'];
}
if(isset($_POST['Materias'])){
    $_SESSION['idMaterias']=$_POST['Materias'];
}
if(isset($_POST['ver'])){
    $_SESSION['mostrarAulas']=true;}
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
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
        <title>Asignar Horario de Cursado</title>
        <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/> 
    </head>
    <body background = <?php echo $URL.$fondo?>>
    <script src="jquery.js"></script>
        <?php include  $DIR.$headerAdmin ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <div class="container" align="center">
            <br>
      
           

            <form action=<?php echo $bajaMateriaProfesor ?> method="POST" name="horamayor">
                <div class="form-group" align="center">
                    <h2 for="editarPersonal" class="text-primary" style="font-family:myFirstFont,garamond,serif;font-size:42px;">Horario de Cursado</h2>
                </div>
                <div class="container" align="center">
                    <div class="table-responsive col-md-8 col-md-offset-4">
                        <table class="table table-bordered table-hover" id="tablaBuscar">  
                            <tr class="info">
                                <th>Profesor</th>
                                <td>
                                    <select class="browser-default custom-select"  data-style="btn-primary" data-widthen="auto" id="idprofesor"name="profesor">
                                    <?php 
                                        $listaprofesores = $a->BuscarProfesor();
                                        foreach ($listaprofesores as $profesor): ?> 
                                        <option <?php if(isset($_SESSION['idprofesor'])){if($profesor->getid_profesor()==$_SESSION['idprofesor']){echo "selected";}}?> value=<?php echo "{$profesor->getid_profesor()}" ?>> <?php echo "{$profesor->getApellido()}, {$profesor->getnombre()}" ?></option>   
                                    <?php endforeach;?>
                                    </select>                                
                                </td>
                                <th>Materia</th>
                                <td>                       
                                    <select class="browser-default custom-select"  data-style="btn-primary" data-widthen="auto" id="second-choice" name="Materias">
                                    </select> 
                                    <script>
                                        $("#idprofesor").change(function() {
                                            $("#second-choice").load("<?php echo $buscarmateriasProfesor.'?choice='?>"+ $("#idprofesor").val());
                                        }).change();
                                    </script>
                                </td>
                            </tr>   
                        </table>
                    </div>

      <?php if(isset($_SESSION['mostraMensaje'])):?>
            <div class="alert alert-danger" role="alert">
                <?php echo $_SESSION['mostraMensaje']?>
            </div>
    <?php $_SESSION['mostraMensaje']=null;
     endif;?>
                </div>
                <br>
                <div class="form-group" align="center"> 
                    <button class="btn btn-success" id="buttonBuscar" name="agregar" value="Agregar" type="submit" formaction=<?php echo $bajaMateriaProfesor?>> <b>  +  Agregar </b>  
                        <span class="glyphicon glyphicon-ok"></span>
                    </button>  
                    <button class="btn btn-primary" id="buttonBuscar" name="ver" value="Ver Horario Cursado" type="submit" formaction=<?php echo $bajaMateriaProfesor?>> <b>  +  Ver Horario Cursado </b>  
                        <span class="glyphicon glyphicon-ok"></span>
                    </button>
                </div>                  
                <tr>                           
                <?php if(isset($_POST['ver'])||isset($_SESSION['mostrarAulas'])):?>
                    <?php if(isset( $_SESSION['idprofesor'])):?>
                        <?php if(isset( $_SESSION['idMaterias'])):?>
                    <div class="container" align="center"> 
                        <div class="table-responsive col-md-12 col-md-offset-0">
                            <table id="myTable2" class="table table-bordered table-hover">
                                <tr class="info">
                                    <th onclick="sortTable(0)" style="cursor:pointer";>Materia</th>
                                    <th onclick="sortTable(1)" style="cursor:pointer";>Profesor</th>
                                    <th onclick="sortTable(2)" style="cursor:pointer";>Dia</th>
                                    <th onclick="sortTable(3)" style="cursor:pointer";>Hora Desde</th>
                                    <th onclick="sortTable(4)" style="cursor:pointer";>Hora Hasta</th>
                                    <th onclick="sortTable(5)" style="cursor:pointer";>Semestre</th>
                                </tr>
                                    <?php  foreach ($listaMaterias as $horacursado) : ?>        
                                <tr>
                                    <td>
                                        <?php echo $horacursado->getfk_materia()->getnombreMateria()?>
                                    </td>
                                    <td>
                                        <?php echo $horacursado->getProfesor()->getApellido()." ".$horacursado->getProfesor()->getNombre()?>
                                    </td>
                                    <td>
                                        <?php echo $horacursado->getdia()->getdia()?>
                                    </td>
                                    <td>
                                        <?php echo $horacursado->gethoraDesde()?>
                                    </td>
                                    <td>
                                        <?php echo $horacursado->gethoraHasta()?>
                                    </td>
                                    <td>
                                        <?php echo $horacursado->getsemestreAnual()?>
                                    </td>
                                    <td>
                                        <button type="submit" value=<?php echo $horacursado->getid_HorarioCursado()?> name="idhoraCursado" formaction=<?php echo $eliminarHorariodeCursado ?> onclick="return confirm('Esta seguro que desea eliminar')"> Eliminar</button>
                                    </td>
                                </tr>
                                    <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                        <?php else: echo "No hay materias"; ?>
                        <?php endif?>
                    <?php endif?>  
                <?php endif?>
                <?php if(isset($_POST['agregar'])):?>
                    <?php if(isset($_POST['profesor'])):?>
                        <?php if(isset($_POST['Materias'])):?>
                    <div class="container" align="center">
                        <div class="table-responsive col-md-12 col-md-offset-0">
                            <table class="table table-bordered table-hover">
                                <tr class="info">
                                    <th>Tipo</th>
                                    <th>Día</th>
                                    <th>Hora Desde</th>
                                    <th>Hora Hasta</th>
                                </tr>           
                                <tr>
                                    <td> 
                                        <select class="browser-default custom-select" data-style="btn-primary" data-widthen="auto" id="second-choice" name="semestreAnual">
                                            <option value="1">1 semestre</option>   
                                            <option value="2">2 semestre</option>   
                                            <option value="anual">Anual</option>   
                                        </select>
                                    </td>
                                    <td>
                                        <select class="browser-default custom-select" data-style="btn-primary" data-widthen="auto" id="second-choice" name="dia">
                                            <option value="1">Lunes</option>   
                                            <option value="2">Martes</option>   
                                            <option value="3">Miercoles</option>   
                                            <option value="4">Jueves</option>   
                                            <option value="5">Viernes</option>   
                                        </select>
                                    </td>
                                    <td>
                                        <input type="time" id="f1" name="horaDesde" value=08:00 oninput="check()">           
                                    </td>
                                    <td>
                                        <input type="time" id="f1" name="horaHasta" value=08:00 oninput="check()">    
                                    </td>
                                    <td>
                                        <button type="submit" formaction=<?php echo $agregarHorarioCursado ?> onclick="return confirm('Esta seguro que desea agregar')"> Agregar</button>
                                    </td>
                                </tr>    
                            </table>
                        </div>
                    </div>
                        <?php else: echo "No hay materias"; ?>
                        <?php endif?>     
                    <?php endif?>
                <?php endif?>
            </form>  
        </div>
    </body>

 <script>
 function check(input) {
  var x = document.forms["horamayor"]["horaDesde"].value;
  var y = document.forms["horamayor"]["horaHasta"].value;
   if ( x>y) {
    document.getElementById("f1").setCustomValidity("Hora Desde debe ser menor a Hora Hasta");
    return false;
   } else {      
    document.getElementById("f1").setCustomValidity("");
    document.getElementById("f2").setCustomValidity("");
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

    <footer>
        <?php require $DIR.$footer; ?>     
    </footer>  
</html>