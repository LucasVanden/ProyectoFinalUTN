<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
session_start();
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
}else{
    if($_SESSION['rol'] != 1){
        header('location: '. $URL.$login);
    }
}

$crearanotacion= $URL .$crearAnotacion;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
        <script src="./../js/funciones.js" type="text/javascript"></script>
    </head>
    <body background = <?php echo $URL.$fondo?>>
        <?php require $DIR.$header ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h1>Confirmar Asistencia</h1>
<?php 
   
     $idhora = $_POST['Asistir'];
        ?>
        <form action=<?php echo $crearanotacion ?> method="POST">
        
            <textarea placeholder="Ingrese su tema (opcional)" name="textarea" rows="10" cols="80"></textarea>
            <input name="idhora" type="hidden" value=<?php echo $idhora ?> > </button>
            <br>
            <br>
            <!-- agregar CSS -->
            <input id=buttonConfirmar name="textoConfirmar" type="submit" value="Confirmar" onclick="">
            <input type="submit" value="Cancelar" formaction="alumnoPpal.php" onclick="self.location.href=<?php echo $URL.$alumnoPpal?>"/>
        </form>
    </body>
    <footer>
       <?php require $DIR.$footer; ?>          
    </footer>  
</html>
