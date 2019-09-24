<?php
require 'dbPFPrueba.php';
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once $DIR . '/modelo/persistencia/conexion.php';
$message = '';
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
    if ( $stmt->execute() ){
        $message="Alumno creado exitosamente";
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
    <meta charset="utf-8">
    <title>Alta Alumno</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body background = http://192.168.43.84/ProyectoFinalUTN/vista/fondoCuerpo.jpg>

    <?php require 'partials/header.php' ?>

    <?php if (!empty($message)) : ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Alta Alumno</h1>
    <br>
    <span>or <a href="signup.php">Alta Usuario</a></span>
    <br>
    <form action="altaAlumno.php" method="POST">
    <br>
    legajo
      <input name="legajo" type="text" placeholder="legajo">
      <br>
      nombre
      <input name="nombre" type="text" placeholder="nombre">
      <br>
      apellido
      <input name="apellido" type="text" placeholder="apellido">
      <br>
      email
      <input name="email" type="text" placeholder="email">
      <br>
      fecha Nacimiento 
      <input name="fecha" type="text" placeholder="AAAA-MM-DD">
      <br>
      telefono
      <input name="telefono" type="text" placeholder="telefono">
      <br>
      <input type="submit" value="Enviar">
    </form>

  </body>
  <footer>
        <?php require 'partials/footer.php'; ?>      
    </footer>
</html>