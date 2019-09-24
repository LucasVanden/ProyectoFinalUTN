<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
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
    <body background = http://192.168.43.84/ProyectoFinalUTN/vista/fondoCuerpo.jpg>       
        <?php require 'partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <form>
            <div>
                <h4>Recuerde que su contraseña es la misma de Autogestión </h4>
                <h4>Si no recuerda la contraseña de Autogestión, diríjase a Alumnos</h4>
            </div>                
        </form>        
    </body>
    <footer>
        <?php require 'partials/footer.php'; ?>      
    </footer>  
</html>
