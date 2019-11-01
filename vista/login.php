<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
session_start();

//con sesiones para los distintos tipos de roles de los usuarios
if (isset($_SESSION['rol'])) {
    switch($_SESSION['rol']){
        case 1: //alumno
            header('location: '. $URL.'/vista/alumno/alumnoPpal.php');
        break;
        case 2: //profesor
        header('location: '. $URL.'/vista/profesor/profesorPpal.php');
        break;
        case 3: //profesor
        header('location: '. $URL.'/vista/profesor/profesorPpal.php');
        break;
        //agregar director
        case 4:
        // $message = 'Entro al 2';
             header('Location: '. $URL.'/vista/administrador/MenuIndex.php');
         break;
         case 5:
         // $message = 'Entro al 2';
              header('Location: '. $URL.'/vista/reportes/faltas.php');
          break;
        default:
    }
}
require 'dbPFprueba.php';
require_once $DIR . '/modelo/persistencia/conexion.php';

//nuevo con sesion
if (!empty($_POST['usuario']) && !empty($_POST['contraseña'])) {
    $usuario = $_POST['usuario'];   
    $contraseña = $_POST['contraseña'];
    $con = new conexion();
    $conexttion = $con->getconexion();
    $stmt = $conexttion->prepare("SELECT id_usuario,fk_perfil,contraseña FROM usuario WHERE usuario= '$usuario'");
    $stmt->execute();
    
    // $results = $stmt->fetch(PDO::FETCH_ASSOC);
    $message = ' ';
    $usuario=null;
    $perfil=null;
     $pass=null;
    while($row = $stmt->fetch()) {
        $perfil= $row['fk_perfil'];
        $pass= $row['contraseña'];
        $usuario=$row['id_usuario'];
    }
    if (isset($perfil)) {
    if (password_verify($_POST['contraseña'],$pass)){   
        $_SESSION['rol'] = $perfil;
        $_SESSION['usuario']=$usuario;
        switch($perfil){
            case 1:
           // $message = 'Entro al 1';
                header('Location: '. $URL.'/vista/alumno/alumnoPpal.php');
            break;
            case 2:
           // $message = 'Entro al 2';
                header('Location: '. $URL.'/vista/profesor/profesorPpal.php');
            break;
            case 3:
            // $message = 'Entro al 2';
                 header('Location: '. $URL.'/vista/profesor/profesorPpal.php');
             break;
             case 4:
             // $message = 'Entro al 2';
                  header('Location: '. $URL.'/vista/administrador/MenuIndex.php');
              break;
              case 5:
              // $message = 'Entro al 2';
                   header('Location: '. $URL.'/vista/reportes/faltas.php');
               break;
            default:
           // $message = 'Entro al default'. $perfil ;
        }
    }
    $message = 'contraseña inválida.-';    
}
    else {
        $message = 'Usuario inválido.-';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link href="css/sticky-footer-navbar.css" rel="stylesheet">
    </head>
    <body background = <?php echo $URL."/vista/fondoCuerpo.jpg>"?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>       
        <div class="container">
            <br> <br>
            <form action="login.php" method="POST" class="form-horizontal">
                <div class="row"> 
                    <div class="col-md-4">
                        <img src="partials\logo.png" title="aHora Sistemas de consultas educativas" style="background-color:transparent" class="img-thumbnail" >
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <h1 for="login" class="text-primary col-md-4 col-md-offset-4"> Login </h1>
                        </div>   
                        <div class="form-group">   
                            <label for="nombre" class="control-label col-md-4"> Usuario </label>
                            <div class="col-md-4">
                                <input class="form-control" name="usuario" id="nombreusuario" type="text" placeholder="Ingrese Usuario" required>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label for="contraseña" class="control-label col-md-4"> Contraseña </label>
                            <div class="col-md-4">
                                <input class="form-control" name="contraseña" id="contraseña" type="password" placeholder="Ingrese Contraseña" required>
                            </div>
                        </div>
                        <div class="form-group"> 
                            <div class="col-md-4 col-md-offset-4">
                                <button class="btn btn-primary"> Ingresar   
                                    <span class="glyphicon glyphicon-log-in"></span>
                                </button>
                            </div>                     
                        </div>
                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <a href="recuperarContraseña.php" class="btn btn-link"> Olvidó su contraseña?</a>
                            </div>
                        </div>
                    </div>
                </div> 
            </form> 
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
    <footer class="footer">
      <div class="container">
            <div class="col-md-12">
                <p class="text-muted text-center credit"> Copyright &copy; 2019 aHora</p> 
            </div>
      </div>
    </footer>
</html>