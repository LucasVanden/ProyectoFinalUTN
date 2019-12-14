<?php
session_start();
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
  header('location: '. $URL.$login);
}else{
  if(!in_array(8,$_SESSION['permisos'])){
      header('location: '. $URL.$login);
  }
}
require_once $DIR . $conexion;
require_once ($DIR.$controladorAdministrador);
$controladorbajaProfesor= $URL.$controladorbajaProfesor;
$editProfesor= $URL.$editProfesor;
$altaProfesor=$URL . $altaProfesor;
$a= new controladorAdministrador();
?>

<style>
        @font-face {
  font-family: myFirstFont;
  src: url(../../SnowHut.ttf);
}
</style>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
    <title>Editar Profesor</title>
    <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
  </head>
  <body background = <?php echo $URL.$fondo?>>
  <?php include  $DIR.$headerAdmin ?>
  <?php $profe=$a->BuscarProfesorID($_POST['profesor'])?>
    <div class="container" align="center">
    <br>
      <form action=<?php echo $editProfesor?> method="POST">
        <div class="form-group" align="center">
          <h2 for="editarProfesor" class="text-primary" style="font-family:myFirstFont,garamond,serif;font-size:42px;">Editar Profesor</h2>
        </div> 
        <p><br>
        <div class="form-group">   
          <label><b> Legajo: </b></label><input name="legajo" type="number" min=1 value= <?php echo $profe->getlegajo()?> required disabled><br>
         <input name="legajo" type="hidden" min=1 value= <?php echo $profe->getlegajo()?> required>
        </div>
        <div class="form-group">   
        <label> <b> Nombre:</b></label><input name="nombre" type="text1" value="<?php echo $profe->getnombre()?>" pattern="([^\s][A-zÀ-ž\s]+)" title="Nombres separados por espacio conformados por letras A-z" required><br>
        </div>
      
        <div class="form-group">
          <label><b>Apellido:</b></label><input name="apellido" type="text1" value="<?php echo $profe->getapellido()?>" pattern="([^\s][A-zÀ-ž\s]+)" title="Apellido separados por espacio conformados por letras A-z" required><br>
        </div>
        <div class="form-group">
          <label><b>e - mail:</b></label><input name="email" type="mail" value=<?php echo $profe->getemail()?> pattern="[a-zA-Z0-9ñ._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="email@dominio.com" required><br>
        </div>
        </p><br>
        <?php if (!empty($message)) : ?>
          <?php if ($ok):?>
            <div class="alert alert-success" role="alert">
              <h4 class="alert-heading">Profesor creado Exitosamente</h4>
              <p>Se creó profesor: <?php echo $_POST['nombre']?> </p>
            </div>
          <?php else:?>
            <div class="alert alert-danger" role="alert">
          <?php echo $message?>
            </div>
          <?php endif; ?>    
        <?php endif; ?>
        <div class="form-group" align="center"> 
          <button class="btn btn-success" value="Enviar" name="Enviar" type="submit"> <b>  +  Enviar </b>  
            <span class="glyphicon glyphicon-ok"></span>
          </button>  
        </div>
      </form>
        <form action=<?php echo $menuAltaProfesor?> method="POST">
          <div class="form-group" align="center"> 
            <button class="btn btn-primary" id="buttonBuscar" value="Volver" name="consultar" type="submit" formaction=<?php echo $altaProfesor ?>> <b>  +  Volver </b>  
              <span class="glyphicon glyphicon-ok"></span>
            </button>  
          </div>
      </form>
    </div>
  </body>
  <footer class="footer">
    <?php require $DIR.$footer; ?>     
  </footer>
<html>