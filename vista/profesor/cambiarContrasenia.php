<?php
session_start();
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
$cambiarContraseniaUsuario=$URL.$cambiarContraseniaUsuario;

require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
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
    <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
    <title>Cambiar contraseña</title>
    <link rel="stylesheet" href="./../css/bootstrap.min.css">
  </head>
  <body background = <?php echo $URL.$fondo?> style="padding-top: 70px;">
    <?php require $DIR.$headerp ?>
    <?php if (!empty($message)) : ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
    <div class="container">
      <br>
      <form action=cambiarContrasenia.php method="POST" class="form-horizontal">
        <div class="form-group"align="center">
          <h2 for="contrasenia" class="text-primary" style = "font-family:myFirstFont,garamond,serif;font-size:42px;"> Cambiar Contraseña </h2>
        </div>
        <div class="form-group">   
          <label for="contraseña" class="control-label col-md-4"> Contraseña Actual </label>
          <div class="col-md-4">
            <input class="form-control" name="contraseña" type="text" placeholder="Ingrese Contraseña" required>
          </div>
        </div>
        <div class="form-group">   
          <label for="nuevacontraseña" class="control-label col-md-4"> Contraseña Nueva</label>
          <div class="col-md-4">
            <input class="form-control" name="nuevacontraseña" type="password" placeholder="Ingrese Nueva Contraseña" required>
          </div>
        </div>
        <div class="form-group">   
          <label for="confirma_contraseña" class="control-label col-md-4"> Contraseña Nueva </label>
          <div class="col-md-4">
            <input class="form-control" name="confirma_contraseña" type="password" placeholder="Repita Nueva Contraseña" required>
          </div>
        </div> 
        <br>
          <input name="tipo" type="hidden" value="profesor">
        <div class="form-group"> 
          <div class="col-md-4 col-md-offset-4">             
            <button class="btn btn-primary" type="submit" formaction=<?php echo $cambiarContraseniaUsuario?>> Enviar
              <span class="glyphicon glyphicon-ok"></span>
            </button>
          </div> 
        </div>
    </form>

    <?php if(isset($_SESSION['mensaje'])):?>
    <?php if($_SESSION['mensaje']=="fail"):?>
    <div align="center"  class="alert alert-danger" role="alert">
    <?php echo $_SESSION['contenidomensaje'];?>
    </div>
    <?php endif;?>

    <?php if($_SESSION['mensaje']=="ok"):?>
      <div align="center"  class="alert alert-success" role="alert">
        <h4 class="alert-heading">Contraseña Creada Exitosamente</h4>
        <p> <?php echo $_SESSION['contenidomensaje']?></p>
        <hr>
        <p class="mb-0">Genial.</p>
      </div>
    <?php endif;?>  
    <?php endif;?>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
  <footer class="footer">
      <?php require $DIR.$footer; ?>     
  </footer> 
</html>