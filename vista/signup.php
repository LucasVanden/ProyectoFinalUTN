<?php
  require 'dbPFPrueba.php';
  require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
  require_once $DIR . '/modelo/persistencia/conexion.php';
  $message = '';
  if (!empty($_POST['usuario']) && !empty($_POST['contraseña'])) {
    $con = new conexion();
    $conexttion = $con->getconexion();
    $sql = "INSERT INTO usuario (usuario, contraseña) VALUES (:usuario, :contraseña)";
    $stmt = $conexttion->prepare($sql);
    $stmt->bindParam(':usuario', $_POST['usuario']);
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);
    $stmt->bindParam(':contraseña', $contraseña);
    if ($stmt->execute()) {
      $message = 'Usuario creado con exito!!!';
    } else {
      $message = 'No se pudo crear el usuario!!!';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>

    <form action="signup.php" method="POST">
      <input name="usuario" type="text" placeholder="Ingrese su usuario">
      <input name="contraseña" type="password" placeholder="Ingrese su contraseña">
      <input name="confirma_contraseña" type="password" placeholder="confirme su contraseña">
      <input type="submit" value="Enviar">
    </form>

  </body>
</html>