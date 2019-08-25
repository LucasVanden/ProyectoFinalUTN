<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require './../dbPFprueba.php';
require './../rutas.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php require './../partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
            <form action="profesorAlumnosAnotados.php" method="POST">        
            <h1>Enviar Notificación</h1>            
            <div>
                <textarea name="cuerpoNotificacion" placeholder="Ingrese Contenido de la Notificación"rows="10" cols="80">Escribe aquí tu Notificación</textarea>
                <br>
                <br>
                <input type="submit" value="Enviar" name="Enviar" disabled="disabled" />
                <input type="submit" value="Cancelar" name="Cancelar" disabled="disabled" />
            </div>
        </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>     
    </footer>  
</html>