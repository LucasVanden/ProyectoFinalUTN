<nav class="navbar-fixed-top">
    <div><br>
<?php require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';?>
<?php if(isset($_SESSION['nombre'])): ?>
<TD> <strong style="float:left;"> <span class="glyphicon glyphicon-user"></span> - Alumno: <?php echo $_SESSION['nombre']?></strong>   &nbsp;&nbsp;  </TD>
<?php endif; ?>
  <a href=<?php echo $URL.$asistenciaAlumno?>> <img src=<?php echo '"'.$URL.$logo.'"'?> width="75" height="75" /> </a>
  <TD><a href=<?php echo $URL.$logoutasistencia?> style="float:right;"><span class="glyphicon glyphicon-log-out"></span> Salir &nbsp;&nbsp;  </a> </TD>
  </div>
  </nav>