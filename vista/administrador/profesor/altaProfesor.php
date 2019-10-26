<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once $DIR . $conexion;

$menuAltaProfesor= $URL.$menuAltaProfesor;

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
    $message= 'Ingrese: legajo, nombre, apellido y e-mail.';
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Alta Profesor</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
  </head>
  <body background = <?php echo $URL.$fondo?>>
  <?php require $DIR.$headera ?>

    <?php if (!empty($message)) : ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h2>Alta Profesor</h2>
    <form action="altaProfesor.php" method="POST">
        <p>
          <label>Legajo: </label><input name="legajo" type="number" placeholder=" Legajo" min=1 requerid><br><br>
          <label>Nombre: </label><input name="nombre" type="text1" placeholder=" Nombre" requerid><br><br>
          <label>Apellido: </label><input name="apellido" type="text1" placeholder=" Apellido" requerid><br><br>
          <label>E - mail: </label><input name="email" type="mail" placeholder="email@dominio.com" requerid><br><br>
        </p>
        <div><br><br><input type="submit" value="Enviar"></div>
        <div><input type="submit" value="Volver" name="Buscar" formaction=<?php echo $menuAltaProfesor ?> /></div>
    </form>
  </body>
  <footer>
        <?php require $DIR.$footer; ?>      
    </footer>
</html>