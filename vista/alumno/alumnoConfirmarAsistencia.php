<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
$crearanotacion= $URL .$crearAnotacion;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/>
        <script src="./../js/funciones.js" type="text/javascript"></script>
    </head>
    <body>
        <?php require './../partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h1>Confirmar Asistencia</h1>
<?php 
   
     $idhora = $_POST['Asistir'];
        ?>
        <form action=<?php echo $crearanotacion ?> method="POST">
        
            <textarea name="textarea" rows="10" cols="50">Ingrese su tema (opcional)</textarea>
            <input name="idhora" type="hidden" value=<?php echo $idhora ?> > </button>
            <br>
            <br>
            <!-- agregar CSS -->
            <input id=buttonConfirmar name="textoConfirmar" type="submit" value="Confirmar" onclick="">
            <input type="submit" value="Cancelar" formaction="alumnoPpal.php" onclick="self.location.href=<?php echo $URL.$alumnoPpal?>"/>
        </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>      
    </footer>  
</html>
