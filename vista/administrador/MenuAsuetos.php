<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR.$ReportesControlador);

$Menu= $URL.$AsuetoMenu;

$AsuetosReceso= $URL.$asutosReceso;
$AsuetosFeriado= $URL.$asutosFeriado;
$AsuetoAsueto=$URL.$AsuetoAsueto;
$BorrarAsueto=$URL.$BorrarAsueto;

$_SESSION['comprobacion']=null;
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
        <?php require './../partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h2>Asutos</h2>
        <form action=<?php echo $Menu ?> method="POST"> <!-- -->
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF">  
             
                    <tr>
                       
                        <td>
                        <div>  <input type="submit" value="Recesos" name="Obtener" formaction=<?php echo $AsuetosReceso ?>  /></div>
                        </td>
                        <td>   <div>  <input type="submit" value="Feriado" name="Obtener" formaction=<?php echo $AsuetosFeriado ?> /></div></td>
                
                        <td>   <div>  <input type="submit" value="Asuetos" name="Obtener" formaction=<?php echo $AsuetoAsueto ?> /></div></td>
                        <td>   <div>  <input type="submit" value="Borrar fecha" name="Obtener" formaction=<?php echo $BorrarAsueto ?> /></div></td>
                    </tr>                   
                    </form>


    <footer>
        <?php require './../partials/footer.php'; ?>     
    </footer>  
</html>