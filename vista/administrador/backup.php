<?php
session_start();

require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR.$ReportesControlador);

$MenuIndex= $URL.$MenuIndex;


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/>
 
    </head>
    <body background = <?php echo $URL.$fondo?>>
    <script src="jquery.js"></script>
        <?php require './../partials/headera.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h2>Backup</h2>
        <form action=<?php echo $MenuIndex ?> method="POST"> <!-- -->
            <div>
                <table align='center' id="tablaBuscar" style="border-color: #FFFFFF">  
             
                    
                        <tr>
                        <td>   <div>  <input type="submit" value="Volver" name="Obtener" formaction=<?php echo $MenuIndex ?> /></div></td>       
                        </tr>         
                    </form>
                    <IMG SRC="manquina de escribir invisible.gif">


    <footer>
        <?php require './../partials/footer.php'; ?>     
    </footer>  
</html>