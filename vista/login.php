<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
session_start();
//como estaba
//if (isset($_SESSION['user_id'])) {    
    //header('Location: /PFProyect');
    //footer('Location: /PFProyect');
//}
//con sesiones para los distintos tipos de roles de los usuarios
if (isset($_SESSION['rol'])) {
    switch($_SESSION['rol']){
        case 1: //alumno
            header('location: '. $URL.'/vista/alumno/alumnoPpal.php');
        break;
        case 2: //profesor
        header('location: '. $URL.'/vista/profesor/profesorPpal.php');
        break;
        //agregar director
        default:
    }
}
require 'dbPFprueba.php';

require_once $DIR . '/modelo/persistencia/conexion.php';

//asi estaba
//if (!empty($_POST['usuario']) && !empty($_POST['contraseña'])) {
    //$con = new conexion();
    //$conexttion = $con->getconexion();
    //$stmt = $conexttion->prepare('SELECT id_usuario, usuario, contraseña FROM usuario WHERE usuario = :usuario');
    //$stmt->bindParam(':usuario', $_POST['usuario']);
    //$stmt->execute();
    //$results = $stmt->fetch(PDO::FETCH_ASSOC);
    //$message = ' ';
    //if (count($results) > 0 && password_verify($_POST['contraseña'], $results['contraseña'])) {
        //$_SESSION['user_id'] = $results['id_usuario'];
        //header("Location: /PFProyect");//header("Location: /PFProyect/login.php"); tal vez//
        //footer('Location: /PFProyect');
    //} else {
        //$message = 'Usuario y/o contraseñas inválidos.-';
    //}
//}
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
            Nombre de Usuario <input name="usuario" type="text" placeholder="Ingrese Usuario" required>
            Contraseña <input name="contraseña" type="password" placeholder="Ingrese Contraseña" required>
            <div class="send-button">
                <input type="submit" value="Ingresar">
            </div>        
            <a href="recuperarContraseña.php">Olvidó su contraseña?</a>
            <br>
            <br> <a href="altaAlumno.php">Registrese</a>
        </form>
    </body>
    <footer>
        <?php require 'partials/footer.php'; ?>      
    </footer>  
</html>
