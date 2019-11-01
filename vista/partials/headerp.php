<header>
<?php require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';?>
<?php if(isset($_SESSION['nombre'])): ?>
<TD> <strong style="float:left;">Profesor:<?php echo $_SESSION['nombre']?></strong>   &nbsp;&nbsp;  </TD>
<?php endif; ?>
  <TD><a href=<?php echo $URL."/vista/logout.php"?> style="float:right;" > - Salir -    &nbsp;&nbsp;  </a> </TD>
  <TD><a href=<?php echo $URL.$vistacambiocontraseña?> style="float:right;" > - cambiar Contraseña -    &nbsp;&nbsp;  </a> </TD>
  <?php if( $_SESSION['rol']==3) : ?>
  <TD><a href=<?php echo $URL.$directorReportes?> style="float:right;" > - Reportes -    &nbsp;&nbsp;  </a> </TD>
<?php endif;?>
</header>
