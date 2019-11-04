<?php
require 'dbPFPrueba.php';
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once $DIR . '/modelo/persistencia/conexion.php';
$message = '';
if (!empty($_POST['usuario']) && !empty($_POST['contraseña'])) {
  $con = new conexion();
  $conexttion = $con->getconexion();

  $usuario = $_POST['usuario'];
  $passw = $_POST['contraseña'];
  $conpassw = $_POST['confirma_contraseña'];
  $legajoalumno = $_POST['alumno'];
  $mensaje=null;

  if ($passw == $conpassw) {
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);
    $alumno = null;
    $stmt2 = $conexttion->prepare("SELECT id_alumno FROM alumno where legajo='$legajoalumno'");
    $stmt2->execute();
    while ($row = $stmt2->fetch()) {
      $alumno = ($row['id_alumno']);
    }

    if (isset($alumno)) {
      $stmt = $conexttion->prepare("INSERT INTO `usuario` (`id_usuario`, `usuario`, `contraseña`, `fk_alumno`, `fk_profesor`, `fk_perfil`) 
    VALUES (NULL, '$usuario', '$contraseña' , '$alumno', NULL,1);");
      $stmt->execute();

        $message = 'Usuario creado con exito!!!';
      
    } else {
      $message = "legajo inexistente";
    }

  } else {
    $message = 'Contraseñas no iguales';
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
    <title>Alta Usuario</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
  </head>
  <body background = <?php echo $URL.$fondo?> style="padding-top: 70px;">
  <?php require $DIR.$header ?>
  <?php if (!empty($message)) : ?>
      <p> <?= $message ?></p>
  <?php endif; ?>
    <div class="container">
      <br>
      <form action="signup.php" method="POST" class="form-horizontal">
        <div class="form-group">
          <h2 align="center" for="contrasenia" class="text-primary col-md-4 col-md-offset-4"> Alta Usuario </h2>
        </div>
        <div class="form-group">   
          <label for="usuario" class="control-label col-md-4"> Usuario </label>
          <div class="col-md-4">
            <input class="form-control" name="usuario" type="text" placeholder="Ingrese Usuario" required>
          </div>
        </div>
        <div class="form-group">   
          <label for="contraseña" class="control-label col-md-4"> Contraseña </label>
          <div class="col-md-4">
            <input class="form-control" name="contraseña" type="password" placeholder="Ingrese Contraseña" required>
          </div>
        </div>
        <div class="form-group">   
          <label for="confirma_contraseña" class="control-label col-md-4"> Repita Contraseña </label>
          <div class="col-md-4">
            <input class="form-control" name="confirma_contraseña" type="password" placeholder="Repita Contraseña" required>
          </div>
        </div>
        <div class="form-group">   
          <label for="alumno" class="control-label col-md-4"> Legajo </label>
          <div class="col-md-4">
            <input class="form-control" name="alumno" type="text" placeholder="Ingrese Legajo" required>
          </div>
        </div> 
        <br>
        <div class="form-group"> 
          <div class="col-md-4 col-md-offset-4">             
            <button class="btn btn-primary" type="submit"> Enviar
              <span class="glyphicon glyphicon-ok"></span>
            </button>
          </div> 
        </div>
        <br>
        <div class="form-group">
          <h4 align="center" for="aviso" class="text-primary col-md-10 col-md-offset-1"> Si ya se registro como usuario, ingrese al sistema: <a href="login.php">Login</a></h4>
        </div>
      </form>
    </div>
    <script src="./js/jquery.js"></script>
    <script src="./js/bootstrap.min.js"></script>
  </body>
  <footer class="footer">
      <?php require $DIR.$footer; ?>     
  </footer>
</html>