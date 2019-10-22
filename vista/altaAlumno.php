<?php
require 'dbPFPrueba.php';
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

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <meta charset="utf-8">
    <title>Alta Alumno</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
 
  </head>
  <body background = http://192.168.43.84/ProyectoFinalUTN/vista/fondoCuerpo.jpg>

    <?php require 'partials/header.php' ?>



    <h1>Alta Alumno</h1>
    <br>
    <span>or <a href="signup.php">Alta Usuario</a></span>
    <br>
    <form action="altaAlumno.php" method="POST">
  
    <tr>
    <td>legajo</td>
    
      <td><input name="legajo" type="text" placeholder="legajo"></td>
      </tr>

      <tr>
      <td>nombre</td>  
      
      <td><input name="nombre" type="text" placeholder="nombre"></td>
      </tr>

      <tr>
      <td>apellido</td>
      
    <td>  <input name="apellido" type="text" placeholder="apellido"></td>
      </tr>

      <tr>
      <td>email</td>
      
     <td> <input name="email" type="text" placeholder="email"></td>
      </tr>

      <tr>
      <td>  fecha Nacimiento </td>
    
     <td> <input name="fecha" type="text" placeholder="AAAA-MM-DD"></td>
      </tr>

      <tr>
      <td>telefono</td>
      
     <td> <input name="telefono" type="text" placeholder="telefono"></td>
      </tr>
     
      <input type="submit" value="Enviar">
    </form>
    <br>
    <?php if (!empty($message)) : ?>
      <?php if ($exito) : ?>
      <div class="alert alert-success" role="alert">
  <h4 class="alert-heading">Alumno creado Exitosamente</h4>
  <p>Se creo alumno <?php echo $_POST['nombre']?> </p>
  <hr>
  <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
      </div>
<?php else: ?>
     <div class="alert alert-danger" role="alert">
        <?php echo $message?>
      </div>
    <?php endif; ?>
    <?php endif; ?>
  </body>
  <footer>
        <?php require 'partials/footer.php'; ?>      
    </footer>
</html>