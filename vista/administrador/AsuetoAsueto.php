<?php
session_start();
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
  }else{
    if($_SESSION['rol'] != 4){
        header('location: '. $URL.$login);
    }
  }
  
require_once ($DIR.$conexion);
require_once ($DIR.$ReportesControlador);
$contAsuetoAsueto= $URL.$controladorAsuetoAsueto;
$Menu= $URL.$AsuetoMenu;
$fechadesdeVerano="'".date("Y-m-d")."'";
$horaDesde="'08:00'";
$HoraHasta="'23:30'";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
 
    </head>
    <body background = <?php echo $URL.$fondo?>>
    <script src="jquery.js"></script>
    <?php require $DIR.$headera ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h2>Cargar Asueto</h2>
        <form action=<?php echo $contAsuetoAsueto ?> method="POST"> <!-- -->
            <div>
                <table align='center' class="table-mostrar" id="tablaBuscar" style="border-color: #FFFFFF">  
                   
                    <tr>
                        <th>Fecha Asueto</th>
                        <td>
                        <input type="date" id="f1" name="fechaFeriado" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"value=<?php echo $fechadesdeVerano;?>>   
                        </td>

                    </tr>      
                    <tr>
                        <th>Hora Desde</th>
                        <td>
                        <input type="time" id="f1" name="horaDesde" value=<?php echo $horaDesde;?>>   
                        </td>

                    </tr>         
                    <tr>
                        <th>Hora Hasta</th>
                        <td>
                        <input type="time" id="f1" name="horaHasta" value=<?php echo $HoraHasta;?>>   
                        </td>

                    </tr>                      
</table>
                </div>
                <?php
if(isset($_SESSION['comprobacion'])){
   echo  $_SESSION['comprobacion'];
}
?>
                    <div> <br> <input type="submit" value="Cargar" name="Obtener" formaction=<?php echo $contAsuetoAsueto ?> /></div>
                    <div>  <input type="submit" value="Volver" name="Buscar" formaction=<?php echo $Menu ?> /></div>
                    </form>


    <footer>
    <?php require $DIR.$footer; ?>     
    </footer>  
</html>