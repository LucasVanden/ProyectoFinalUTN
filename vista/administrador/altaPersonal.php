<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
session_start();
if(!isset($_SESSION['rol'])){
  header('location: '. $URL.$login);
}else{
  if(!in_array(14,$_SESSION['permisos'])){
      header('location: '. $URL.$login);
  }
}
require_once $DIR . $conexion;
require_once ($DIR.$controladorAdministrador);
$bajaPersonal= $URL.$bajaPersonal;
$editPersonal= $URL.$editPersonal;
$editarPersonal= $URL.$editarPersonal;

$_SESSION['PersonalAdmin']="Personal";
$a= new controladorAdministrador();

$message = null;
$exito=0;
if(isset($_POST['dni'])){
if (!empty($_POST['dni']) && !empty($_POST['nombre'])&& !empty($_POST['apellido'])) {
  $con = new conexion();
  $conexttion = $con->getconexion();

  $dni = $_POST['dni'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['email'];
  $mensaje=null; 

  // $stmt2 = $conexttion->prepare("SELECT dni FROM persona where dni='$dni' and eliminado is null");
  $stmt2 = $conexttion->prepare("SELECT usuario FROM usuario where usuario='$dni'");
  $stmt2->execute();
  if($stmt2->rowCount() == 0) {

        $stmt3 = $conexttion->prepare("INSERT INTO `persona` (`id_persona`, `dni`, `apellido`, `nombre`,`email`) 
        VALUES (NULL, '$dni', '$apellido' , '$nombre','$email');");
        $stmt3->execute();

        $idpersona = $conexttion->lastInsertId("persona");
        $contraseña = password_hash($dni, PASSWORD_BCRYPT);
        $stmt4 = $conexttion->prepare("INSERT INTO `usuario` (`id_usuario`, `usuario`, `contraseña`, `fk_alumno`, `fk_profesor`, `fk_perfil`, `fk_persona`) 
        VALUES (NULL, '$dni', '$contraseña' , NULL, NULL,5,'$idpersona');");
      
        if ( $stmt4->execute() ){
            $message="Personal creado exitosamente";
            $exito=1;
        }else{
            $message="Hubo un problema al crear al alumno";
            }        
    }else{$message="Legajo existente";}
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
    <title>Alta Personal</title>
    <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
  </head>
  <body background = <?php echo $URL.$fondo?> style="padding-top: 70px; bg-secondary">
  <?php include  $DIR.$headerAdmin ?>
  <div class="container">
    <form action="altaPersonal.php" method="POST" class="form-horizontal">
    <p><br>
      <div class="form-group">
        <h2 for="altaadministrador" style="font-family:myFirstFont,garamond,serif;font-size:42px;"> Alta Personal </h2>
      </div>   
      <div class="form-group">   
        <label><b> Legajo: </b></label><input name="dni" type="number" placeholder=" Legajo" min=1 value="" required><br>
      </div>
      <div class="form-group">
        <label><b>Nombre:</b></label><input name="nombre" type="text1" placeholder=" Nombre" pattern="([^\s][A-zÀ-ž\s]+)" title="Nombres separados por espacio conformados por letras A-z" required><br>
      </div>
      <div class="form-group">
        <label><b>Apellido:</b></label><input name="apellido" type="text1" placeholder=" Apellido" pattern="([^\s][A-zÀ-ž\s]+)" title="Apellido separados por espacio conformados por letras A-z" required><br>
      </div>
      <div class="form-group">
        <label><b>e - mail:</b></label><input name="email" type="email" placeholder=" email@dominio.com" pattern="[a-zA-Z0-9ñ._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="email@dominio.com" required><br>
      </div>
      </p>
  
      <div class="form-group" align="center"> 
        <button class="btn btn-success" type="submit" value="Enviar" name="enviar"><b> +  Enviar  </b>  
          <span class="glyphicon glyphicon-log-in"></span>
        </button>                   
      </div>
    </form>
    <form action="altaPersonal.php" method="POST" class="form-horizontal">
      <div class="form-group" align="center"> 
        <button class="btn btn-primary" type="submit" value="consultar" name="consultar"><b> +  Consultar  </b>  
          <span class="glyphicon glyphicon-log-in"></span>
        </button>                    
      </div>
    </form>
    <br>
    <?php if (!empty($message)) : ?>
    <?php if ($exito) : ?>
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Personal creado Exitosamente</h4>
      <p>Se creo personal: <?php echo $_POST['nombre']?> </p>
    </div>
    <?php else: ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $message?>
    </div>
    <?php endif; ?>
    <?php endif; ?>
    </div>
  </body>

<?php if( isset($_POST['consultar'] ) || isset($_POST['enviar']) || isset($_SESSION['eliminarPersonal']) ) :?>
<?php $_SESSION['eliminarPersonal']=null;?>
  <form action="altaPersonal.php" method="POST">
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
                        <?php $listaprofesores=$a->BuscarPersonal(); ?>
                        
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
                                <button type="submit" value=<?php echo $profe->getid_profesor()?> name="persona" formaction=<?php echo $editarPersonal ?>> Editar</button>
                                </td>
                                <td>
                                <button type="submit" value=<?php echo $profe->getid_profesor()?> name="persona" formaction=<?php echo $bajaPersonal ?> onClick="return confirm('Esta seguro que desea eliminar')"> Eliminar</button>
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