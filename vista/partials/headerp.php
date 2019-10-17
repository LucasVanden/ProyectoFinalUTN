<header>
<?php require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';?>
<?php if(isset($_SESSION['nombre'])): ?>
<TD> <strong style="float:left;">Profesor:<?php echo $_SESSION['nombre']?></strong>   &nbsp;&nbsp;  </TD>
<?php endif; ?>
  <a href=<?php echo $URL."/vista/profesor/profesorPpal.php"?>> <img src=<?php echo '"'.$URL.$logo.'"'?> width="75" height="75" /> </a>
  <TD><a href=<?php echo $URL."/vista/logout.php"?> style="float:right;" > - Salir -    &nbsp;&nbsp;  </a> </TD>
</header>
