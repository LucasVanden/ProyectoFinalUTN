<!-- ASIGNAR HORARIO DE CURSADO -->
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

if(isset($_POST['profesor'])){
    $_SESSION['idprofesor']=$_POST['profesor'];
}
if(isset($_POST['Materias'])){
    $_SESSION['idMaterias']=$_POST['Materias'];
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
 
    </head>
    <body background = <?php echo $URL.$fondo?>>
    <script src="jquery.js"></script>
        <?php require $DIR.$headera ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h2>Horarios de Cursado</h2>
        <form action=<?php echo $bajaMateriaProfesor ?> method="POST" name="horamayor"> <!-- -->
            <div>
                <table align='center' class="table-mostrar" id="tablaBuscar" style="border-color: #FFFFFF">  
                <tr>
                <th>Profesor</th>
                            <td>
                                <select id="idprofesor"name="profesor">
                               
                                <?php 
                               $listaprofesores = $a->BuscarProfesor();
                               foreach ($listaprofesores as $profesor): ?> 
                                <option <?php if($profesor->getid_profesor()==$_SESSION['idprofesor']){echo "selected";}?> value=<?php echo "{$profesor->getid_profesor()}" ?>> <?php echo "{$profesor->getApellido()}, {$profesor->getnombre()}" ?></option>   
                                <?php endforeach; 
                               ?>

                                </select>                                
                            </td>
                            <th>Materia</th>
                            <td>                       
                                <select id="second-choice" name="Materias">
                                </select> 
                                <script>
                                    $("#idprofesor").change(function() {
                                    $("#second-choice").load("<?php echo $buscarmateriasProfesor.'?choice='?>"+ $("#idprofesor").val());
                                    }).change();</script>

                            </td>
                        </tr>    
                </table>
            </div>
            <div>
                <br>
                <!-- <input type="submit" value="Buscar" name="Buscar" disabled="disabled" />     -->
                <input id=buttonBuscar name="agregar" type="submit" value="Agregar" formaction=<?php echo $bajaMateriaProfesor?> >
                <input id=buttonBuscar name="ver" type="submit" value="Ver Horario Cursado" formaction=<?php echo $bajaMateriaProfesor?> >
                <div>  <input type="submit" value="Volver" name="Buscar" formaction=<?php echo $menuAltaProfesor ?> /></div>
            </div>                  
        <tr>               
                 
<?php
if(isset($_POST['ver'])):?>
<?php if(isset($_POST['profesor'])):?>
 <?php if(isset($_POST['Materias'])):?>
  <table align='center' class="table-mostrar">

     <div class="container"> 
                <div class="table-responsive col-md-12 col-md-offset-0">
                    <table id="myTable2" class="table table-bordered table-hover"  align="center">
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
        <td><?php echo $horacursado->getfk_materia()->getnombreMateria()?></td>
        <td><?php echo $horacursado->getProfesor()->getApellido()." ".$horacursado->getProfesor()->getNombre()?></td>
        <td><?php echo $horacursado->getdia()->getdia()?></td>
        <td><?php echo $horacursado->gethoraDesde()?></td>
        <td><?php echo $horacursado->gethoraHasta()?></td>
        <td><?php echo $horacursado->getsemestreAnual()?></td>
        <td>
        <button type="submit" value=<?php echo $horacursado->getid_HorarioCursado()?> name="idhoraCursado" formaction=<?php echo $eliminarHorariodeCursado ?> onclick="return confirm('Esta seguro que desea eliminar')"> Eliminar</button>
        </td>
        </tr>
                    <?php endforeach; ?>
</table>
</div>
</div>
            <?php  else: echo "No hay materias"; ?>
            <?php endif?>
     
      <?php   endif?>  
      <?php   endif?>



<?php  if(isset($_POST['agregar'])):?>
<?php  if(isset($_POST['profesor'])):?>
    <?php if(isset($_POST['Materias'])):?>
        <table align='center' class="table-mostrar">
        <th>Tipo</th>
            <th>Dia</th>
            <th>Hora Desde</th>
            <th>Hora Hasta</th>
         
  
            <tr>
                <td> 
                    <select id="second-choice" name="semestreAnual">
                    <option value="1">1 semestre</option>   
                    <option value="2">2 semestre</option>   
                    <option value="anual">Anual</option>   
                    </select>
                </td>
                <td>
                    <select id="second-choice" name="dia">
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
                <button type="submit"  formaction=<?php echo $agregarHorarioCursado ?> onclick="return confirm('Esta seguro que desea agregar')"> Agregar</button>
                </td>
            </tr>    
    </table>
   
    <?php  else: echo "No hay materias"; ?>
            <?php endif?>
     
      <?php   endif?>
      <?php   endif?>
      </form>  
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