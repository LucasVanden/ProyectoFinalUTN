<nav class="navbar-fixed-top">
    <div>
<?php require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';?>
<?php if(isset($_SESSION['nombre'])): ?>
<TD> <strong style="float:left;">Alumno:<?php echo $_SESSION['nombre']?></strong>   &nbsp;&nbsp;  </TD>
<?php endif; ?>
  <TD><a href=<?php echo $URL."/vista/alumno/alumnoPpal.php"?>> <img src=<?php echo '"'.$URL.$logo.'"'?> width="75" height="75" /> </a></TD>
  <TD><a href=<?php echo $URL."/vista/logout.php"?> style="float:right;" > - Salir -    &nbsp;&nbsp;  </a> </TD>
  <TD><a href=<?php echo $URL.$cambiarContraseniaalumno?> style="float:right;" > - cambiar Contraseña -    &nbsp;&nbsp;  </a> </TD>

   
    </div>
    </nav>