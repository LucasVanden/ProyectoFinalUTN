<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
session_start();
if(!isset($_SESSION['rol'])){
  header('location: '. $URL.$login);
}else{
  if($_SESSION['rol'] != 4){
      header('location: '. $URL.$login);
  }
}

require_once $DIR . $conexion;
$message = null;
$exito=0;
if(isset($_POST['dni'])){
if (!empty($_POST['dni']) && !empty($_POST['nombre'])&& !empty($_POST['apellido'])) {
  $con = new conexion();
  $conexttion = $con->getconexion();

  $dni = $_POST['dni'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['email'];
  $mensaje=null;
 

  $stmt2 = $conexttion->prepare("SELECT dni FROM persona where dni='$dni'");
  $stmt2->execute();
  if($stmt2->rowCount() == 0) {


        $stmt3 = $conexttion->prepare("INSERT INTO `persona` (`id_persona`, `dni`, `apellido`, `nombre`,`email`) 
        VALUES (NULL, '$dni', '$apellido' , '$nombre','$email');");
        $stmt3->execute();

        $idpersona = $conexttion->lastInsertId("persona");
        $contraseña = password_hash($dni, PASSWORD_BCRYPT);
        $stmt4 = $conexttion->prepare("INSERT INTO `usuario` (`id_usuario`, `usuario`, `contraseña`, `fk_alumno`, `fk_profesor`, `fk_perfil`, `fk_persona`) 
        VALUES (NULL, '$dni', '$contraseña' , NULL, NULL,5,'$idpersona');");
      
        if ( $stmt4->execute() ){
            $message="Personal creado exitosamente";
            $exito=1;
        }else{
            $message="Hubo un problema al crear al alumno";
            }
        
    }else{$message="dni existente";}
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
  <title>Alta Personal</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
  </head>
  <body background = <?php echo $URL.$fondo?>>
  <?php require $DIR.$headera ?>
    <h1>Alta Personal</h1>
    <form action="altaPersonal.php" method="POST">
      <p><br>
        <label>legajo:</label><input name="dni" type="number" placeholder=" dni" min=1 value="" required><br>
        <label>Nombre:</label><input name="nombre" type="text1" placeholder=" Nombre" required><br>
        <label>Apellido:</label><input name="apellido" type="text1" placeholder=" Apellido" required><br>
        <label>email:</label><input name="email" type="text1" placeholder=" email" required><br>
      </p>
      <input type="submit" value="Enviar">
      <br>
    </form>
    <br>
    <?php if (!empty($message)) : ?>
    <?php if ($exito) : ?>
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Personal creado Exitosamente</h4>
      <p>Se creo personal: <?php echo $_POST['nombre']?> </p>
    </div>
    <?php else: ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $message?>
    </div>
    <?php endif; ?>
    <?php endif; ?>
  </body>
  <footer>
    <?php require $DIR.$footer; ?>      
  </footer>
</html>