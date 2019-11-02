<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
session_start();

if (isset($_SESSION['rol'])) {
    switch($_SESSION['rol']){
        case 1: //alumno
            header('location: '. $URL.$asistenciaAlumno);
        break;
        case 2: //profesor
        header('location: '. $URL.$asistenciaProfesor);
        break;
        //agregar director
        default:
    }
}


require_once $DIR . $conexion;


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
           header('location: '. $URL.$asistenciaAlumno);
            break;
            case 2:
           // $message = 'Entro al 2';
           header('location: '. $URL.$asistenciaProfesor);
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
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="assert/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body background = <?php echo $URL."/vista/fondoCuerpo.jpg>"?>
        <?php require 'partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>

        <h1>Login</h1>
        <form action="login.php" method="POST">
            Nombre de Usuario <input name="usuario" type="text" placeholder="Ingrese Usuario" required="">
            Contraseña <input name="contraseña" type="password" placeholder="Ingrese Contraseña" required="">
            <div class="send-button">
                <input type="submit" value="Ingresar">
            </div>        
        </form>
    </body>
    <footer class="footer">
      <?php require $DIR.$footer; ?>     
 </footer>    
</html>
