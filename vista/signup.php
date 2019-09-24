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
    <meta charset="utf-8">
    <title>Registrese</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body background = http://192.168.43.84/ProyectoFinalUTN/vista/fondoCuerpo.jpg>

    <?php require 'partials/header.php' ?>

    <?php if (!empty($message)) : ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Registrese</h1>
    <span>or <a href="login.php">Login</a></span>

    <form action="signup.php" method="POST">
      <input name="usuario" type="text" placeholder="Ingrese su usuario">
      <input name="contraseña" type="password" placeholder="Ingrese su contraseña">
      <input name="confirma_contraseña" type="password" placeholder="confirme su contraseña">
      <input name="alumno" type="text" placeholder="legajo">
      <input type="submit" value="Enviar">
    </form>

  </body>
  <footer>
        <?php require 'partials/footer.php'; ?>     
    </footer>
</html>