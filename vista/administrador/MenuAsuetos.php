<?php
session_start();
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
  }else{
    if($_SESSION['rol'] != 4){
        header('location: '. $URL.$login);
    }
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
        <h2>Asuetos</h2>
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
       <?php require $DIR.$footer; ?>         
    </footer>  
</html>