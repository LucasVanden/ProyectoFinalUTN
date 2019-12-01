<?php
session_start();
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR.$controladorAdministrador);

$a=new controladorAdministrador();
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
        <h2>Aula Asignadas</h2>

<!-- <table align="center">
    <th>Departamento</th>
    <th>Materia</th>
    <th>Semestre</th>
    <th>Apellido</th>
    <th>Nombre</th>
    <?php foreach ($a->aulasOcupadas($_SESSION['IDintentoBorrarAula']) as $item) : ?>
    <tr>
    <?php foreach ($item as $atributo) : ?>
        <td>
        <?php echo $atributo?>
        </td>
        <?php endforeach?>
    </tr>
    <?php endforeach?>
</table> -->


 <div class="container"> 
                <div class="table-responsive col-md-12 col-md-offset-0">
                    <table id="myTable2" class="table table-bordered table-hover" align="center">
                        <tr class="info">
                            <th onclick="sortTable(0)" style="cursor:pointer";>Departamento</th>
                            <th onclick="sortTable(1)" style="cursor:pointer";>Materia</th>
                            <th onclick="sortTable(2)" style="cursor:pointer";>Semestre</th>
                            <th onclick="sortTable(3)" style="cursor:pointer";>Apellido</th>
                            <th onclick="sortTable(4)" style="cursor:pointer";>Nombre</th>
                        </tr>
                        <?php foreach ($a->aulasOcupadas($_SESSION['IDintentoBorrarAula']) as $item) : ?>
                        <tr>
                            <?php foreach ($item as $atributo) : ?>
                                <td>
                                    <?php echo $atributo?>
                                </td>
                            <?php endforeach?>
                        </tr>
                        <?php endforeach?>
                        </table>
                    </div>
    </div>  
    <h2>Aula de consulta Predeterminada Departamento</h2>
    <table align="center">
    <?php foreach ($a->departamentosOcupados($_SESSION['IDintentoBorrarAula']) as $item) : ?>
    <tr>
        <td>
            <?php echo $item?>
        </td>
    </tr>
    <?php endforeach?>
    </table>
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
</body>
</html>