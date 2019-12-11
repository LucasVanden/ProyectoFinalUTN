<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$controladorAdministrador);
session_start();
if(!isset($_SESSION['rol'])){
  header('location: '. $URL.$login);
}else{
  if(!in_array(12,$_SESSION['permisos'])){
      header('location: '. $URL.$login);
  }
}
$editarAlumno= $URL.$editarAlumno;
$controladorbajaAlumno= $URL.$controladorbajaAlumno;
$a= new controladorAdministrador();
require_once $DIR . $conexion;
$message = null;
$exito=0;
if(isset($_POST['legajo'])){
if (!empty($_POST['legajo']) && !empty($_POST['nombre'])&& !empty($_POST['apellido'])) {
  $con = new conexion();
  $conexttion = $con->getconexion();

  $legajo = $_POST['legajo'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['email'];
  $fecha = $_POST['fecha'];
  $telefono = $_POST['telefono'];
  $mensaje=null;
 

  $stmt0 = $conexttion->prepare("SELECT id_alumno FROM alumno where legajo='$legajo'");
  $stmt0->execute();
  while ($row = $stmt0->fetch()) {
    $alumno = ($row['id_alumno']);
  }
  if (isset($alumno)){$message="legajo existente";}else{


    $stmt = $conexttion->prepare("INSERT INTO `alumno` (`id_alumno`, `legajo`, `apellido`, `nombre`, `email`, `fechaNacimientoAlumno`,`telefonoAlumno`) 
    VALUES (NULL, '$legajo', '$apellido' , '$nombre', '$email','$fecha','$telefono');");

    if ( $stmt->execute() ){
        $message="Alumno creado exitosamente";
        sleep(0.5);
        $alumno = $conexttion->lastInsertId("alumno");
        $contraseña = password_hash($legajo, PASSWORD_BCRYPT);

        $stmt2 = $conexttion->prepare("SELECT usuario FROM usuario where usuario='$legajo'");
        $stmt2->execute();
        if($stmt2->rowCount() == 0) {

        $stmt3 = $conexttion->prepare("INSERT INTO `usuario` (`id_usuario`, `usuario`, `contraseña`, `fk_alumno`, `fk_profesor`, `fk_perfil`) 
        VALUES (NULL, '$legajo', '$contraseña' , '$alumno', NULL,1);");
        $stmt3->execute();

        $exito=1;
    }else{
        $message="Hubo un problema al crear al alumno";
    }

  }
}
 
}else{
    $message= 'ingrese Legajo,nombre y apellido';
}
}
?>
<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <meta charset="utf-8">
  <title>Alta Alumno</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
  </head>
  <body background = <?php echo $URL.$fondo?>>
  <?php require $DIR.$headera ?>
    <h1>Alta Alumno</h1>
    <form action="altaAlumno.php" method="POST">
      <p><br>
        <label>Legajo:</label><input name="legajo" type="number" placeholder=" Legajo" min=1 value="" required><br>
        <label>Nombre:</label><input name="nombre" type="text1" placeholder=" Nombre" pattern="([^\s][A-zÀ-ž\s]+)" title="Nombres separados por espacio conformados por letras A-z" required><br><br>
        <label>Apellido:</label><input name="apellido" type="text1" placeholder=" Apellido" pattern="([^\s][A-zÀ-ž\s]+)" title="Apellido separados por espacio conformados por letras A-z" required><br><br>
        <label>e - mail:</label><input name="email" type="mail" placeholder=" email@dominio.com" pattern="[a-zA-Z0-9ñ._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="email@dominio.com" required><br><br>
        <label>Nacimiento:</label><input name="fecha" type="date" required><br>
        <label>Teléfono:</label><input name="telefono" type="text1" placeholder=" 0261-5555555" pattern="[0-9]{11}" title="11 numeros (0261-XXXXXXX)" required><br>
      </p>
      <input type="submit" value="Enviar">
      <br>
    </form>
    <form action="altaAlumno.php" method="POST">
        <div><input type="submit" value="consultar" name="consultar" onclick="myFunction()"></div>
        </form>
    <br>
    <?php if (!empty($message)) : ?>
    <?php if ($exito) : ?>
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Alumno creado Exitosamente</h4>
      <p>Se creo alumno: <?php echo $_POST['nombre']?> </p>
    </div>
    <?php else: ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $message?>
    </div>
    <?php endif; ?>
    <?php endif; ?>
  </body>

 
 <?php if( isset($_POST['consultar'] ) || isset($_POST['enviar']) || isset($_SESSION['eliminarAlumno']) ) :?>
<?php $_SESSION['eliminarAlumno']=null;?>
  <form action="altaAlumno.php" method="POST">
            <div id="myDIV" align="center">
            <div class="container"> 
                <div class="table-responsive col-md-12 col-md-offset-0">
                    <table id="myTable2" class="table table-bordered table-hover">
                        <tr class="info">
                            <th onclick="sortTable(0)" style="cursor:pointer";>legajo</th>
                            <th onclick="sortTable(1)" style="cursor:pointer";>Nombre</th>
                            <th onclick="sortTable(2)" style="cursor:pointer";>Apellido</th>
                            <th onclick="sortTable(3)" style="cursor:pointer";>Email</th>
                            <th onclick="sortTable(4)" style="cursor:pointer";>Telefono</th>
                        </tr>
                        <?php $listaalumnos=$a->BuscarAlumnos(); ?>
                        
                        <?php foreach ($listaalumnos as $alumno): ?>
                        <tr>
                            <div>
                                <td>
                                    <?php echo $alumno->getlegajo() ?>
                                </td>
                                <td>
                                    <?php echo $alumno->getnombre() ?>
                                </td>
                                <td>
                                    <?php echo $alumno->getapellido() ?>
                                </td>
                                <td>
                                    <?php echo $alumno->getemail() ?>
                                </td>
                                <td>
                                    <?php echo $alumno->gettelefonoAlumno() ?>
                                </td>
                                <td>
                                <button type="submit" value=<?php echo $alumno->getid_alumno()?> name="alumno" formaction=<?php echo $editarAlumno ?>> Editar</button>
                                </td>
                                <td>
                                <button type="submit" value=<?php echo $alumno->getid_alumno()?> name="alumno" formaction=<?php echo $controladorbajaAlumno ?> onClick="return confirm('Esta seguro que desea eliminar')"> Eliminar</button>
                                </td>             
                            </div>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div> 
            </div>
    </form>
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

  <footer>
    <?php require $DIR.$footer; ?>      
  </footer>
</html>