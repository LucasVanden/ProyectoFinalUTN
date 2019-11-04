<nav class="navbar-fixed-top">
    <div>
      <br>
      <?php require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';?>
      <?php if(isset($_SESSION['nombre'])): ?>
      <TD> <strong style="float:left;"><span class="glyphicon glyphicon-user"></span> - Profesor: <?php echo $_SESSION['nombre']?></strong> &nbsp;&nbsp; </TD>
      <?php endif; ?>
      <TD><a href=<?php echo $URL."/vista/logout.php"?> style="float:right;"><span class="glyphicon glyphicon-log-out"></span> Salir &nbsp;&nbsp; </a></TD>
      <TD><a href=<?php echo $URL.$vistacambiocontraseña?> style="float:right;"><span class="glyphicon glyphicon-edit"></span> cambiar Contraseña &nbsp;&nbsp; </a></TD>
      <?php if( $_SESSION['rol']==3) : ?>
      <TD><a href=<?php echo $URL.$directorReportes?> style="float:right;"><span class="glyphicon glyphicon-stats"></span> Reportes &nbsp;&nbsp; </a></TD>
      <?php endif;?>
    </div>
</nav>
