<?php
session_start();
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
$recuperarContraseniaUsuario=$URL.$recuperarContraseniaUsuario;


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
    <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
    <title>Restaurar Contraseña</title>
    <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </head>
  <body background = <?php echo $URL.$fondo?> style="padding-top: 70px;">
    <!-- <?php require $DIR.$header ?> -->
    <?php if (!empty($message)) : ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
    <div  align="center">
    <div class="container">
      <br>
      <form action=cambiarContraseniaalumno.php method="POST" class="form-horizontal">
        <div class="form-group" align="center">
          <h2 for="contrasenia" class="text-primary" style="font-family:myFirstFont,garamond,serif;font-size:42px;"> Recuperar Contraseña </h2>
        </div>
        </div>

        <div class="form-group">   
          <label for="nuevacontraseña" class="control-label col-md-4"> Legajo</label>
          <div class="col-md-4">
            <input class="form-control" name="legajo" type="text" placeholder="Ingrese su Número de Legajo" required>
          </div>
        </div>

        
        <br>
        <input name="tipo" type="hidden" value="alumno">
        <div class="form-group"> 
          <div class="col-md-4 col-md-offset-4">             
            <button class="btn btn-primary" type="submit" name="keygen"  formaction=<?php echo $recuperarContraseniaUsuario?>> Enviar
              <span class="glyphicon glyphicon-ok"></span>
            </button>
          </div> 
        </div>
      </form>
      </div>
      <?php if(isset($_SESSION['mensaje'])):?>
      <?php if($_SESSION['mensaje']=="fail"):?>
      <div align="center" class="alert alert-danger" role="alert">
      <?php echo $_SESSION['contenidomensaje'];?>
      </div>
      <?php endif;?>

      <?php if($_SESSION['mensaje']=="ok"):?>
        <div align="center" class="alert alert-success" role="alert">
          <h4 class="alert-heading">Email de recuperación </h4>
          <p> <?php echo $_SESSION['contenidomensaje']?></p>
          <hr>
        </div>
      <?php endif;?>  
      <?php endif;?>
    </div>

  </body>
  <footer class="footer">
      <?php require $DIR.$footer; ?>     
 </footer>
</html>