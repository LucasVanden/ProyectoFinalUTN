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
$idhora=$_POST['Notificaridhora'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0">
        <title>Alumnos Anotados</title>
        <link rel="stylesheet" href="./../css/bootstrap.min.css">
    </head>
    <body background = <?php echo $URL.$fondo?> style="padding-top: 70px;">
    <?php require $DIR.$headerp ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <div class="container">
            <form action="profesorAlumnosAnotados.php" method="POST" class="form-horizontal">        
            <?php
                $a = new Profesorcontrolador();
                $detalles=$a->detallealumnosAnotados($idhora);
                $nombMateria=$a->buscarMateriaDeHoradeconsulta($idhora);
            ?>
                <div class="form-group">
                    <h2 for="detalleAnotados" class="text-primary col-md-10 col-md-offset-3">Detalle de Alumnos Anotados </h2>
                </div>
                <div class="form-group">
                    <h3 class="text-primary col-md-10 col-md-offset-3"><?php echo $nombMateria;
                        echo ": ";
                        echo $_POST['dia'];
                        echo " ";
                        echo $_POST['hora'];
                        ?></h3>
                </div>
                <div class="container">
                    <div class="table-responsive col-md-6 col-md-offset-3">
                        <table class="table table-bordered table-hover table-condensed" id="tablaAlumnosAnotadosMateria">
                            <tr class="info">                    
                                <th></th>
                                <th>Nombre</th>
                                <th>Legajo</th>
                                <th>Tema</th>
                            </tr>
                            <tbody style="text-align: left">
                            <?php $i=0;
                                foreach ($detalles as $detalle): 
                                    $i++;?>   
                            <tr>
                            <td>
                            <?php echo $i?>
                            </td>
                            <td>
                            <?php echo $detalle->getAlumno()->getnombre() ?>
                            <?php echo $detalle->getAlumno()->getapellido() ?>
                            </td>
                            <td>
                            <?php echo $detalle->getAlumno()->getlegajo() ?>
                            </td>                            
                            <td>
                            <?php echo $detalle->gettema() ?>
                            </td>                            
                        </tr>
                          <?php endforeach; 
                              ?>    

                      
                    </tbody>                    
                </table>                
            </div>
<!--            <div>
                <h2>Enviar Notificaciones</h2>
                <textarea name="cuerpoNotificacion" placeholder="Ingrese Contenido de la Notificación"rows="10" cols="80">Escribe aquí tu Notificación</textarea>
                <br>
                <br>
                <input type="submit" value="Enviar" name="Enviar" disabled="disabled" />
                <input type="submit" value="Cancelar" name="Cancelar" disabled="disabled" />
            </div>-->
            </form>
        </div>
        <script src="./../js/jquery.js"></script>
        <script src="./../js/bootstrap.min.js"></script>
    </body>
    <footer class="footer">
      <?php require $DIR.$footer; ?>     
    </footer>   
</html>