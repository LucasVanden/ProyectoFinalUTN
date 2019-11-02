<?php
session_start();
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
$cambiarContraseniaUsuario=$URL.$cambiarContraseniaUsuario;

if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
}else{
    if($_SESSION['rol'] != 1){
        header('location: '. $URL.$login);
    }
}

?>

<!DOCTYPE html>
<html>
  <head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>

    <link rel="stylesheet" href="./../css/bootstrap.min.css">
  </head>
  <body background = <?php echo $URL.$fondo?> style="padding-top: 70px;">
    <?php require $DIR.$header ?>
    <?php if (!empty($message)) : ?>
      <p> <?= $message ?></p>
    <?php endif; ?>
    <div class="container">
      <br>
      <form action=cambiarContraseniaalumno.php method="POST" class="form-horizontal">
        <div class="form-group">
          <h1 for="contrasenia" class="text-primary col-md-4 col-md-offset-4"> Cambiar Contraseña </h1>
        </div>
        <div class="form-group">   
          <label for="contraseña" class="control-label col-md-4"> Contraseña Actual </label>
          <div class="col-md-4">
            <input class="form-control" name="contraseña" type="text" placeholder="Ingrese Contraseña" required>
          </div>
        </div>
        <div class="form-group">   
          <label for="nuevacontraseña" class="control-label col-md-4"> Contraseña Actual </label>
          <div class="col-md-4">
            <input class="form-control" name="nuevacontraseña" type="password" placeholder="Ingrese Nueva Contraseña" required>
          </div>
        </div>
        <div class="form-group">   
          <label for="confirma_contraseña" class="control-label col-md-4"> Contraseña Actual </label>
          <div class="col-md-4">
            <input class="form-control" name="confirma_contraseña" type="password" placeholder="Repita Nueva Contraseña" required>
          </div>
        </div> 
        <input name="tipo" type="hidden" value="alumno">
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
      <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['contenidomensaje'];?>
      </div>
      <?php endif;?>

      <?php if($_SESSION['mensaje']=="ok"):?>
        <div class="alert alert-success" role="alert">
          <h4 class="alert-heading"> Contraseña Creada Exitosamente </h4>
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