<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR.$ReportesControlador);

$MenuIndex= $URL.$MenuIndex;

$AsuetosMenu= $URL.$AsuetoMenu;
$Mesas= $URL.$Mesas;
$AsuetoAsueto=$URL.$AsuetoAsueto;
$BorrarAsueto=$URL.$BorrarAsueto;

$_SESSION['comprobacion']=null;
$_SESSION['fechasBuscadas']=null;
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
        <h2>Asutos</h2>
        <form action=<?php echo $MenuIndex ?> method="POST"> <!-- -->
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF">  
             
                    <tr>
                       
                        <td>
                        <div>  <input type="submit" value="Asuetos" name="Obtener" formaction=<?php echo $AsuetosMenu ?>  /></div>
                        </td>
                        <td>   <div>  <input type="submit" value="Mesas" name="Obtener" formaction=<?php echo $Mesas ?> /></div></td>
                
                        <td>   <div>  <input type="submit" value="Otro" name="Obtener" formaction=<?php echo $AsuetoAsueto ?> /></div></td>
                        <td>   <div>  <input type="submit" value="Otro" name="Obtener" formaction=<?php echo $BorrarAsueto ?> /></div></td>
                    </tr>                   
                    </form>


    <footer>
        <?php require './../partials/footer.php'; ?>     
    </footer>  
</html>