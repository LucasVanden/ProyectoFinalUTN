<?php
session_start();
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once $DIR . $conexion;

if(!isset($_SESSION['rol'])){
  header('location: '. $URL.$login);
}else{
  if($_SESSION['rol'] != 4){
      header('location: '. $URL.$login);
  }
}

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
  $ok=false;
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
        $ok=true;

        $contraseña = password_hash($legajo, PASSWORD_BCRYPT);
        $idprofesor = $conexttion->lastInsertId("profesor");
        $stmt = $conexttion->prepare("INSERT INTO `usuario` (`id_usuario`, `usuario`, `contraseña`, `fk_alumno`, `fk_profesor`, `fk_perfil`) 
        VALUES (NULL, '$legajo', '$contraseña' , NULL, '$idprofesor' ,2);");
          $stmt->execute();
    }else{
        $message="Hubo un problema al crear al Profesor";
    }

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
    <title>Alta Profesor</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
  </head>
  <body background = <?php echo $URL.$fondo?>>
  <?php require $DIR.$headera ?>

 

    <h2>Alta Profesor</h2>
    <form action="altaProfesor.php" method="POST">
        <p>
          <label>Legajo: </label><input name="legajo" type="number" placeholder=" Legajo" min=1 required><br><br>
          <label>Nombre: </label><input name="nombre" type="text1" placeholder=" Nombre" pattern="([^\s][A-zÀ-ž\s]+)" title="Nombres separados por espacio conformados por letras A-z" required><br><br>
          <label>Apellido: </label><input name="apellido" type="text1" placeholder=" Apellido" pattern="([^\s][A-zÀ-ž\s]+)" title="Apellido separados por espacio conformados por letras A-z" required><br><br>
          <label>E - mail: </label><input name="email" type="mail" placeholder="email@dominio.com" pattern="[a-zA-Z0-9ñ._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="email@dominio.com" required><br><br>
        </p>
        <?php if (!empty($message)) : ?>
            <?php if ($ok):?>
            <div class="alert alert-success" role="alert">
              <h4 class="alert-heading">Profesor creado Exitosamente</h4>
              <p>Se creo profesor: <?php echo $_POST['nombre']?> </p>
            </div>
        <?php else:?>
          <div class="alert alert-danger" role="alert">
            <?php echo $message?>
         </div>
         <?php endif; ?>    
         <?php endif; ?>

        <div><br><br><input type="submit" value="Enviar"></div>
        </form>
        <form action=<?php echo $menuAltaProfesor?> method="POST">
        <div><input type="submit" value="Volver" name="Buscar" formaction=<?php echo $menuAltaProfesor ?> /></div>
        </form>
  </body>


  <footer>
        <?php require $DIR.$footer; ?>      
    </footer>
</html>