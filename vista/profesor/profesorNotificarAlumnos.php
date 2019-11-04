<?php
session_start();

require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
}else{
    if(!($_SESSION['rol'] == 2 || $_SESSION['rol']==3)){
        header('location: '. $URL.$login);
    }
}
require_once $DIR . $profesorControlador;
$profesorNotificar=$URL.$profesorCrearNotificacion;
$idhora=$_POST['Notificaridhora'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
        <title>Notificar Alumnos</title>
        <link rel="stylesheet" href="./../css/bootstrap.min.css">
    </head>
    <body background = <?php echo $URL.$fondo?> style="padding-top: 70px;">
    <?php require $DIR.$headerp ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <div class="container">
            <br>
            <form action=<?php echo $profesorNotificar?> method="POST" class="form-horizontal">  
            <?php
                $a = new Profesorcontrolador();
                $nombMateria=$a->buscarMateriaDeHoradeconsulta($idhora);
            ?>
                <div class="form-group">
                    <h2 for="notificar" class="text-primary col-md-10 col-md-offset-3">Enviar Notificación a Alumnos de <?php echo $nombMateria ?> </h2>
                </div>   
                <div class="form-group"> 
                    <div class="col-md-4 col-md-offset-3">
                        <textarea placeholder="Ingrese Contenido de la Notificación" name="cuerpoNotificacion" rows="10" cols="80"></textarea>
                            <input type='hidden' name='idhoradeconsulta' value = <?php echo $idhora?>>
                            <input type='hidden' name='materia' value = <?php echo $nombMateria?>>
                    </div>
                </div>  
                <div class="container">
                    <br>
                    <div class="form-group"> 
                        <div class="col-md-4 col-md-offset-3">
                            <button class="btn btn-success" name="Enviar" type="submit"> Enviar 
                                <span class="glyphicon glyphicon-ok"></span>
                            </button> 
                            <button class="btn btn-danger" type="submit" name="Cancelar"> Cancelar 
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