<?php
session_start();
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);

$mensj= $_SESSION['mensajesCrearHorario'];
$volver= $URL . $profesorPpal;
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
            <h2 style="align-content: center">Creacion Horario Consulta</h2>    
            <div>       
                    <?php $i=0;
                     foreach ($mensj as $m):?>   
                            <?php echo "-".$m?> <br><br>
                          <?php endforeach; 
                              ?>                                               
            </div>
            <form action="profesorEstablecerHorario.php" method="POST">     
            <div>

            <input type="submit" value="Aceptar" >
            </div>
            </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>   
    </footer>  
</html>