<nav class="navbar-fixed-top">
    <div><br>
<?php require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once $DIR . $profesorControlador;?>
<?php
$a=new profesorControlador();
$idProfesor=$a->buscarProfesorDeUsuario($idusuario);
$_SESSION['idProfesor']=$idProfesor;
$_SESSION['nombre']=$a->idpofesoraNombre($idProfesor);
?>
<?php if(isset($_SESSION['nombre'])): ?>
<TD> <strong style="float:left;"><span class="glyphicon glyphicon-user"></span> - Profesor: <?php echo $_SESSION['nombre']?></strong>   &nbsp;&nbsp;  </TD>
<?php endif; ?>
  <a href=<?php echo $URL.$asistenciaProfesor?>> <img src=<?php echo '"'.$URL.$logo.'"'?> width="75" height="75" /> </a>
  <TD><a href=<?php echo $URL.$logoutasistencia?> style="float:right;"><span class="glyphicon glyphicon-log-out"></span>Salir -    &nbsp;&nbsp;  </a> </TD>
  </div>
  </nav>