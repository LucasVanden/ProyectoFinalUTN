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
        <meta charset="utf-8"  name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
        <title>Confirmar Asistencia</title>
        <link rel="stylesheet" href="./../css/bootstrap.min.css"> 
        <script src="./../js/funciones.js" type="text/javascript"></script>
    </head>
    <body background = <?php echo $URL.$fondo?> style="padding-top: 70px;">
        <?php require $DIR.$header ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
<?php 
   
     $idhora = $_POST['Asistir'];
        ?>
        <div class="container">
            <br>
            <form action=<?php echo $crearanotacion ?> method="POST" class="form-horizontal">
                <div class="form-group" align="center">
                    <h2 for="confirma" class="text-primary">Confirmar Asistencia</h2>
                </div>
                <div class="form-group"> 
                    <div class="col-md-4 col-md-offset-3">
                        <textarea placeholder="Ingrese su tema (opcional)" name="textarea" rows="10" cols="80"></textarea>
                            <input name="idhora" type="hidden" value=<?php echo $idhora ?>> 
                    </div>
                </div>
                <div class="container">
                    <br>
                    <div class="form-group"> 
                        <div class="col-md-4 col-md-offset-3">
                            <button class="btn btn-success" id=buttonConfirmar name="textoConfirmar" type="submit"> Confirmar 
                                <span class="glyphicon glyphicon-ok"></span>
                            </button> 
                            <button class="btn btn-danger" id=buttonCancelar type="submit" formaction="alumnoPpal.php" onclick="self.location.href=<?php echo $URL.$alumnoPpal?>""> Cancelar 
                                <span class="glyphicon glyphicon-remove"></span>
                            </button> 
                        </div> 
                    </div> 
                </div> 
            </form>
        </div>
        <script src="./../js/jquery.js"></script>
        <script src="./../js/bootstrap.min.js"></script>
    </body>
    <footer class="footer">
      <?php require $DIR.$footer; ?>     
    </footer>
</html>
