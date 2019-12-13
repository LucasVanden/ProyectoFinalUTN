<?php
session_start();
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
  }else{
    if(!in_array(17,$_SESSION['permisos'])){
        header('location: '. $URL.$login);
    }
  }  
require_once ($DIR.$conexion);
require_once ($DIR.$ReportesControlador);

$MenuIndex= $URL.$MenuIndex;
?>

<style>
        @font-face {
  font-family: myFirstFont;
  src: url(./../SnowHut.ttf);
}
</style>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
        <title>Backup</title>
        <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/> 
    </head>
    <body background = <?php echo $URL.$fondo?> style="padding-top: 70px; bg-secondary">
    <script src="jquery.js"></script>
        <?php require './../partials/headera.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <div class="container">
            <br>
            <form action=<?php echo $MenuIndex ?> method="POST" class="form-horizontal">
                <div class="form-group" align="center">
                    <h2 for="backup" class="text-primary" style="font-family:myFirstFont,garamond,serif;font-size:42px;"> Backup </h2>
                </div> 
                    <table align='center' id="tablaBuscar" style="border-color: #FFFFFF">             
                    
                        <tr>
                        <td>   <div>  <input type="submit" value="Volver" name="Obtener" formaction=<?php echo $MenuIndex ?> /></div></td>       
                        </tr>   
                        <tr>      
                  
                    <IMG SRC="manquina de escribir invisible.gif">
                    </tr>
                    </table>
                </div>
            </form>
        </div>
    </body>
    <footer>
       <?php require $DIR.$footer; ?>         
    </footer>  
</html>