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
 

  $stmt0 = $conexttion->prepare("SELECT id_alumno FROM alumno where legajo='$legajo'");
  $stmt0->execute();
  while ($row = $stmt0->fetch()) {
    $alumno = ($row['id_alumno']);
  }
  if (isset($alumno)){$message="legajo existente";}else{


    $stmt = $conexttion->prepare("INSERT INTO `alumno` (`id_alumno`, `legajo`, `apellido`, `nombre`, `email`, `fechaNacimientoAlumno`,`telefonoAlumno`) 
    VALUES (NULL, '$legajo', '$apellido' , '$nombre', '$email','$fecha','$telefono');");

    if ( $stmt->execute() ){
        $message="Alumno creado exitosamente";
        sleep(0.5);
        $alumno = $conexttion->lastInsertId("alumno");
        $contraseña = password_hash($legajo, PASSWORD_BCRYPT);

        $stmt2 = $conexttion->prepare("SELECT usuario FROM usuario where usuario='$legajo'");
        $stmt2->execute();
        if($stmt2->rowCount() == 0) {

        $stmt3 = $conexttion->prepare("INSERT INTO `usuario` (`id_usuario`, `usuario`, `contraseña`, `fk_alumno`, `fk_profesor`, `fk_perfil`) 
        VALUES (NULL, '$legajo', '$contraseña' , '$alumno', NULL,1);");
        $stmt3->execute();

        $exito=1;
    }else{
        $message="Hubo un problema al crear al alumno";
    }

  }
}
 
}else{
    $message= 'ingrese Legajo,nombre y apellido';
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
  <title>Alta Alumno</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
  </head>
  <body background = <?php echo $URL.$fondo?>>
  <?php require $DIR.$headera ?>
    <h1>Alta Alumno</h1>
    <form action="altaAlumno.php" method="POST">
      <p><br>
        <label>Legajo:</label><input name="legajo" type="number" placeholder=" Legajo" min=1 value="" required><br>
        <label>Nombre:</label><input name="nombre" type="text1" placeholder=" Nombre" required><br>
        <label>Apellido:</label><input name="apellido" type="text1" placeholder=" Apellido" required><br>
        <label>e - mail:</label><input name="email" type="mail" placeholder=" email@dominio.com"><br>
        <label>Nacimiento:</label><input name="fecha" type="date" required><br>
        <label>Teléfono:</label><input name="telefono" type="number" placeholder=" 555-555-5555" min=1 max=9999999999><br>
      </p>
      <input type="submit" value="Enviar">
      <br>
    </form>
    <br>
    <?php if (!empty($message)) : ?>
    <?php if ($exito) : ?>
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Alumno creado Exitosamente</h4>
      <p>Se creo alumno: <?php echo $_POST['nombre']?> </p>
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