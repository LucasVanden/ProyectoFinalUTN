<?php
session_start();
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once $DIR . $conexion;
require_once ($DIR.$controladorAdministrador);
$controladorbajaProfesor= $URL.$controladorbajaProfesor;
$editAlumno= $URL.$editAlumno;
$altaAlumno=$URL . $altaAlumno;
$a= new controladorAdministrador();?>

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
  <?php $alumno=$a->buscarAlumnoID($_POST['alumno'])?>
 

    <h2>Editar Alumno</h2>
    <form action=<?php echo $editAlumno?> method="POST">
        <p>
          <label>Legajo: </label><input name="legajo" type="number" value= <?php echo $alumno->getlegajo()?> min=1 required disabled ><br><br>
          <label>Legajo: </label><input name="legajo" type="hidden" value= <?php echo $alumno->getlegajo()?> min=1 required  >
          <label>Nombre: </label><input name="nombre" type="text1" value="<?php echo $alumno->getnombre()?>" pattern="([^\s][A-zÀ-ž\s]+)" title="Nombres separados por espacio conformados por letras A-z" required><br><br>
          <label>Apellido: </label><input name="apellido" type="text1" value="<?php echo $alumno->getapellido()?>" pattern="([^\s][A-zÀ-ž\s]+)" title="Apellido separados por espacio conformados por letras A-z" required><br><br>
          <label>E - mail: </label><input name="email" type="mail" value=<?php echo $alumno->getemail()?> pattern="[a-zA-Z0-9ñ._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="email@dominio.com" required><br><br>
          <label>Teléfono:</label><input name="telefono" type="text1"  value=<?php echo $alumno->gettelefonoAlumno()?> pattern="[0-9]{11}" title="11 numeros (0261-XXXXXXX)" required><br>
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
        <form action=<?php echo $altaAlumno?> method="POST">
        <div><input type="submit" value="Volver" name="enviar" formaction=<?php echo $altaAlumno ?> /></div>
        </form>
  </body>
  </html>