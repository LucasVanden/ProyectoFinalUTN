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

    <meta charset="utf-8">
    <title>Cambiar contraseña</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
  </head>
  <body background = <?php echo $URL.$fondo?>>

    <?php require $DIR.$header ?>

    <?php if (!empty($message)) : ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Cambiar contraseña</h1>


    <form action=cambiarContraseniaalumno.php method="POST">
      <input name="contraseña" type="text" placeholder="Contraseña" required >
      <input name="nuevacontraseña" type="password" placeholder="Ingrese su nueva contraseña" required >
      <input name="confirma_contraseña" type="password" placeholder="Repita su nueva contraseña" required >
      <input name="tipo" type="hidden" value="alumno" >
      <input type="submit" value="Enviar" formaction=<?php echo $cambiarContraseniaUsuario?>>
    </form>

<?php if(isset($_SESSION['mensaje'])):?>
    <?php if($_SESSION['mensaje']=="fail"):?>
        <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['contenidomensaje'];?>
        </div>
    <?php endif;?>

    <?php if($_SESSION['mensaje']=="ok"):?>
        <div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Contraseña creada Exitosamente</h4>
        <p> <?php echo $_SESSION['contenidomensaje']?></p>
        <hr>
        <p class="mb-0">Genial.</p>
            </div>
    <?php endif;?>  
<?php endif;?>

  </body>
  <footer>
  <?php require $DIR.$footer; ?>     
    </footer>
</html>