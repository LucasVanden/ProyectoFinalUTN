<?php

require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once $DIR . '/modelo/persistencia/conexion.php';
$message = '';
$exito=0;
if (!empty($_POST['legajo']) && !empty($_POST['nombre'])&& !empty($_POST['apellido'])) {
  $con = new conexion();
  $conexttion = $con->getconexion();

  $legajo = $_POST['legajo'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['email'];
  $fecha = $_POST['fecha'];
  $telefono = $_POST['telefono'];
  $mensaje=null;
 

  $stmt2 = $conexttion->prepare("SELECT id_alumno FROM alumno where legajo='$legajo'");
  $stmt2->execute();
  while ($row = $stmt2->fetch()) {
    $alumno = ($row['id_alumno']);
  }
  if (isset($alumno)){$message="legajo existente";}else{


    $stmt = $conexttion->prepare("INSERT INTO `alumno` (`id_alumno`, `legajo`, `apellido`, `nombre`, `email`, `fechaNacimientoAlumno`,`telefonoAlumno`) 
    VALUES (NULL, '$legajo', '$apellido' , '$nombre', '$email','$fecha','$telefono');");

    $contraseña = password_hash($legajo, PASSWORD_BCRYPT);
    $stmt = $conexttion->prepare("INSERT INTO `usuario` (`id_usuario`, `usuario`, `contraseña`, `fk_alumno`, `fk_profesor`, `fk_perfil`) 
    VALUES (NULL, '$legajo', '$contraseña' , '$alumno', NULL,1);");
    $stmt->execute();

    if ( $stmt->execute() ){
        $message="Alumno creado exitosamente";
        $exito=1;
    }else{
        $message="Hubo un problema al crear al alumno";
    }

  }
 
}else{
    $message= 'ingrese Legajo,nombre y apellido';
}
?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
  <title>Alta Alumno</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  </head>
  <body background = <?php echo $URL.$fondo?> style="padding-top: 70px;">
    <?php require 'partials/header.php' ?>
    <div class="container">
      <br>
      <form action="altaAlumno.php" method="POST" class="form-horizontal">
        <div align="center" class="form-group">
          <h2 for="contrasenia" class="text-primary"> Alta Alumno </h2>
        </div>
        <div class="form-group">   
          <label for="contraseña" class="control-label col-md-4"> Legajo </label>
          <div class="col-md-4">
            <input class="form-control" name="legajo" type="number" min=1 placeholder="Legajo" required>
          </div>
        </div>
        <div class="form-group">   
          <label for="nuevacontraseña" class="control-label col-md-4"> Nombre </label>
          <div class="col-md-4">
            <input class="form-control" name="nombre" type="text" placeholder="Nombre" required>
          </div>
        </div>
        <div class="form-group">   
          <label for="confirma_contraseña" class="control-label col-md-4"> Apellido </label>
          <div class="col-md-4">
            <input class="form-control" name="apellido" type="text" placeholder="Apellido" required>
          </div>
        </div> 
        <div class="form-group">   
          <label for="contraseña" class="control-label col-md-4"> e - mail </label>
          <div class="col-md-4">
            <input class="form-control" name="email" type="mail" min=1 placeholder=" " required>
          </div>
        </div>
        <div class="form-group">   
          <label for="nuevacontraseña" class="control-label col-md-4"> Nacimiento </label>
          <div class="col-md-4">
            <input class="form-control" name="fecha" type="date" required>
          </div>
        </div>
        <div class="form-group">   
          <label for="confirma_contraseña" class="control-label col-md-4"> Teléfono </label>
          <div class="col-md-4">
            <input class="form-control" name="telefono" type="number" min=1 max=999999 placeholder="555-555" required>
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
      </form>
    </div>
    <br>
    <?php if (!empty($message)) : ?>
    <?php if ($exito) : ?>
    <div align="center" class="alert alert-success" role="alert">
      <h4 class="alert-heading">Alumno creado Exitosamente</h4>
      <p>Se creo alumno: <?php echo $_POST['nombre']?> </p>
    </div>
    <?php else: ?>
    <div align="center" class="alert alert-danger" role="alert">
      <?php echo $message?>
    </div>
    <?php endif; ?>
    <?php endif; ?>
   
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
  <footer class="footer">
      <?php require $DIR.$footer; ?>     
  </footer> 
</html>