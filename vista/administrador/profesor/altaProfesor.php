<?php
session_start();
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once $DIR . $conexion;
require_once ($DIR.$controladorAdministrador);
$controladorbajaProfesor= $URL.$controladorbajaProfesor;
$editarProfesor= $URL.$editarProfesor;
$a= new controladorAdministrador();

if(!isset($_SESSION['rol'])){
  header('location: '. $URL.$login);
}else{
  if(!in_array(8,$_SESSION['permisos'])){
      header('location: '. $URL.$login);
  }
}

$menuAltaProfesor= $URL.$menuAltaProfesor;

$message = '';
if (!empty($_POST['legajo']) && !empty($_POST['nombre'])&& !empty($_POST['apellido'])) {
  $con = new conexion();
  $conexttion = $con->getconexion();

  $legajo = $_POST['legajo'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['email'];

  $mensaje=null;
  $ok=false;
  $stmt2 = $conexttion->prepare("SELECT id_profesor FROM profesor where legajo='$legajo'");
  $stmt2->execute();
  while ($row = $stmt2->fetch()) {
    $profesor = ($row['id_profesor']);
  }
  if (isset($profesor)){$message="legajo existente";}else{

      $stmt = $conexttion->prepare("INSERT INTO `profesor` (`id_profesor`, `legajo`, `apellido`, `nombre`, `email`) 
    VALUES (NULL, '$legajo', '$apellido' , '$nombre', '$email');");
    if ( $stmt->execute() ){
        $message="Profesor creado exitosamente";
        $ok=true;

        $contraseña = password_hash($legajo, PASSWORD_BCRYPT);
        $idprofesor = $conexttion->lastInsertId("profesor");
        $stmt = $conexttion->prepare("INSERT INTO `usuario` (`id_usuario`, `usuario`, `contraseña`, `fk_alumno`, `fk_profesor`, `fk_perfil`) 
        VALUES (NULL, '$legajo', '$contraseña' , NULL, '$idprofesor' ,2);");
          $stmt->execute();
    }else{
        $message="Hubo un problema al crear al Profesor";
    }
  } 
}
?>

<style>
        @font-face {
  font-family: myFirstFont;
  src: url(./../SnowHut.ttf);
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
    <title>Alta Profesor</title>
    <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
  </head>
  <body background = <?php echo $URL.$fondo?> style="padding-top: 70px; bg-secondary">
  <?php require $DIR.$headera ?>
    <div class="container" align="center">
      <form action="altaProfesor.php" method="POST" class="form-horizontal">
      <p><br>
      <div class="form-group">
        <h2 for="altaprofesor" style="font-family:myFirstFont,garamond,serif;font-size:42px;"> Alta Profesor </h2>
      </div>   
      <div class="form-group">   
        <label><b> Legajo: </b></label><input name="legajo" type="number" placeholder=" Legajo" min=1 value="" required><br>
      </div>
      <div class="form-group">
        <label><b>Nombre:</b></label><input name="nombre" type="text1" placeholder=" Nombre" pattern="([^\s][A-zÀ-ž\s]+)" title="Nombres separados por espacio conformados por letras A-z" required><br>
      </div>
      <div class="form-group">
        <label><b>Apellido:</b></label><input name="apellido" type="text1" placeholder=" Apellido" pattern="([^\s][A-zÀ-ž\s]+)" title="Apellido separados por espacio conformados por letras A-z" required><br>
      </div>
      <div class="form-group">
        <label><b>e - mail:</b></label><input name="email" type="mail" placeholder=" email@dominio.com" pattern="[a-zA-Z0-9ñ._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="email@dominio.com" required><br>
      </div>
      </p><br>
        <?php if (!empty($message)) : ?>
            <?php if ($ok):?>
            <div class="alert alert-success" role="alert">
              <h4 class="alert-heading">Profesor creado Exitosamente</h4>
              <p>Se creo profesor: <?php echo $_POST['nombre']?> </p>
            </div>
        <?php else:?>
          <div class="alert alert-danger" role="alert">
            <?php echo $message?>
         </div>
         <?php endif; ?>    
         <?php endif; ?>
      <div class="form-group" align="center"> 
        <button class="btn btn-success" type="submit" value="Enviar" name="enviar"><b> +  Enviar  </b>  
          <span class="glyphicon glyphicon-log-in"></span>
        </button>
      </div>
    </form>
    <form action="altaProfesor.php" method="POST" class="form-horizontal">
      <div class="form-group" align="center"> 
        <button class="btn btn-primary" type="submit" value="consultar" name="consultar" onclick="myFunction()"><b> +  Consultar  </b>  
          <span class="glyphicon glyphicon-log-in"></span>
        </button>                    
      </div>
    </form>     
    <form action=<?php echo $menuAltaProfesor?> method="POST">
      <div class="form-group" align="center"> 
        <button class="btn btn-primary" type="submit" value="Volver" name="Buscar" formaction=<?php echo $menuAltaProfesor ?>><b> +  Buscar  </b>  
          <span class="glyphicon glyphicon-log-in"></span>
        </button>                    
      </div>
      </form>
    </div>
  </body>

<?php if( isset($_POST['consultar'] ) || isset($_POST['enviar']) || isset($_SESSION['eliminarProfesor']) ) :?>
<?php $_SESSION['eliminarProfesor']=null;?>
  <form action=<?php echo $borrarAula ?> method="POST">
            <div id="myDIV" align="center">
            <div class="container"> 
                <div class="table-responsive col-md-12 col-md-offset-0">
                    <table id="myTable2" class="table table-bordered table-hover">
                        <tr class="info">
                            <th onclick="sortTable(0)" style="cursor:pointer";>legajo</th>
                            <th onclick="sortTable(1)" style="cursor:pointer";>Nombre</th>
                            <th onclick="sortTable(2)" style="cursor:pointer";>Apellido</th>
                            <th onclick="sortTable(3)" style="cursor:pointer";>Email</th>
                        </tr>
                        <?php $listaprofesores=$a->BuscarProfesor(); ?>
                        
                        <?php foreach ($listaprofesores as $profe): ?>
                        <tr>
                            <div>
                                <td>
                                    <?php echo $profe->getlegajo() ?>
                                </td>
                                <td>
                                    <?php echo $profe->getnombre() ?>
                                </td>
                                <td>
                                    <?php echo $profe->getapellido() ?>
                                </td>
                                <td>
                                    <?php echo $profe->getemail() ?>
                                </td>
                                <td>
                                <button type="submit" value=<?php echo $profe->getid_profesor()?> name="profesor" formaction=<?php echo $editarProfesor ?>> Editar</button>
                                </td>
                                <td>
                                <button type="submit" value=<?php echo $profe->getid_profesor()?> name="profesor" formaction=<?php echo $controladorbajaProfesor ?> onClick="return confirm('Esta seguro que desea eliminar')"> Eliminar</button>
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