<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once $DIR . $conexion;
$message = '';
if (!empty($_POST['legajo']) && !empty($_POST['nombre'])&& !empty($_POST['apellido'])) {
  $con = new conexion();
  $conexttion = $con->getconexion();

  $legajo = $_POST['legajo'];
  $nombre = $_POST['nombre'];
  $apellido = $_POST['apellido'];
  $email = $_POST['email'];

  $mensaje=null;


  $stmt2 = $conexttion->prepare("SELECT id_profesor FROM profesor where legajo='$legajo'");
  $stmt2->execute();
  while ($row = $stmt2->fetch()) {
    $profesor = ($row['id_profesor']);
  }
  if (isset($profesor)){$message="legajo existente";}else{


      $stmt = $conexttion->prepare("INSERT INTO `profesor` (`id_profesor`, `legajo`, `apellido`, `nombre`, `email`) 
    VALUES (NULL, '$legajo', '$apellido' , '$nombre', '$email');");
    if ( $stmt->execute() ){
        $message="Profesor creado exitosamente";

        $contraseña = password_hash($legajo, PASSWORD_BCRYPT);
        $idprofesor = $conexttion->lastInsertId("profesor");
        $stmt = $conexttion->prepare("INSERT INTO `usuario` (`id_usuario`, `usuario`, `contraseña`, `fk_alumno`, `fk_profesor`, `fk_perfil`) 
        VALUES (NULL, '$legajo', '$contraseña' , NULL, '$idprofesor' ,2);");
          $stmt->execute();
    }else{
        $message="Hubo un problema al crear al Profesor";
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
    <title>Alta Profesor</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body background = http://192.168.43.84/ProyectoFinalUTN/vista/fondoCuerpo.jpg>

    <?php require $DIR.$header ?>

    <?php if (!empty($message)) : ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Alta Profesor</h1>
    <br>
    <span>or <a href="signup.php">Alta Usuario</a></span>
    <br>
    <form action="altaProfesor.php" method="POST">
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
      <input type="submit" value="Enviar">
    </form>

  </body>
  <footer>
        <?php require $URL.$footer; ?>      
    </footer>
</html>