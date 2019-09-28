<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once $DIR . $profesorControlador;
$profesorNotificar=$URL.$profesorCrearNotificacion;
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
         <form action=<?php echo $profesorNotificar?> method="POST">    
            <h1>Enviar Notificación</h1>            
            <div>
                <textarea name="cuerpoNotificacion" placeholder="Ingrese Contenido de la Notificación"rows="10" cols="80">Escribe aquí tu Notificación</textarea>
                <br>
                <br>
                <input type='hidden' name='idhoradeconsulta' value = <?php echo $_POST['Notificaridhora']?>></input>
                <input type="submit" value="Enviar" name="Enviar"  />
                <input type="submit" value="Cancelar" name="Cancelar"  />
            </div>
        </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>     
    </footer>  
</html>