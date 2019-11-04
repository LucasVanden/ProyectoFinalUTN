<nav class="navbar-fixed-top">
    <div>
      <br>
      <?php require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';?>
      <?php if(isset($_SESSION['nombre'])): ?>
      <TD> <strong style="float:left;"><span class="glyphicon glyphicon-user"></span> - Alumno: <?php echo $_SESSION['nombre']?></strong> &nbsp;&nbsp; </TD>
      <?php endif; ?>
      <TD><a href=<?php echo $URL."/vista/alumno/alumnoPpal.php"?>> <img src=<?php echo '"'.$URL.$logo.'"'?> width="75" height="75" title="Volver"/> </a></TD>
      <TD><a href=<?php echo $URL."/vista/logout.php"?> style="float:right;"><span class="glyphicon glyphicon-log-out"></span> Salir &nbsp;&nbsp;  </a> </TD>
      <TD><a href=<?php echo $URL.$cambiarContraseniaalumno?> style="float:right;"><span class="glyphicon glyphicon-edit"></span> Cambiar Contraseña &nbsp;&nbsp;  </a> </TD>   
    </div>
  </nav>