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
$controladorAsuetosReceso= $URL.$controladorAsuetosReceso;
$Menu= $URL.$AsuetoMenu;


$fechadesdeVerano="'".date("Y")."-11-01"."'";
$fechahastaVerano="'".(date("Y")+1)."-03-01"."'";

$fechadesdeInvierno="'".date("Y")."-06-01"."'";
$fechahastaInvierno="'".date("Y")."-07-01"."'";


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
        <h2>Cargar Recesos</h2>
        <form action=<?php echo $controladorAsuetosReceso ?> method="POST"> <!-- -->
            <div>
                <table align='center' class="table-mostrar" id="tablaBuscar" style="border-color: #FFFFFF">  
                    <tr>
                        <th>Receso Verano</th>          
                    </tr>
                    <tr>
                        <th>Fecha Desde</th>
                        <td>
                        <input type="date" id="f1" name="fechaDesdeVerano" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"value=<?php echo $fechadesdeVerano;?>>   
                        </td>                
                        <th>Fecha Hasta</th>
                        <td>                           
                        <input type="date" id="f2" name="fechaHastaVerano" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value=<?php echo $fechahastaVerano;?>>               
                        </td>
                    </tr>               
         <tr><br></tr>
                    <tr>
                        <th>Receso Invierno</th>
          
                    </tr>
                    <tr>
                        <th>Fecha Desde</th>
                        <td>
                        <input type="date" id="f1" name="fechaDesdeInvierno" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"value=<?php echo $fechadesdeInvierno;?>>   
                        </td>
                
                        <th>Fecha Hasta</th>
                        <td>
                           
                        <input type="date" id="f2" name="fechaHastaInvierno" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value=<?php echo $fechahastaInvierno;?>>                
                             
                            </select>
                        </td>
                    </tr>   
                    </table>                
            </div> 
                <?php
if(isset($_SESSION['comprobacion'])){
   echo  $_SESSION['comprobacion'];
}
?>
                    <div> <br><br> <input type="submit" value="Cargar" name="Obtener"  /></div>
                    <div>  <input type="submit" value="Volver" name="Buscar" formaction=<?php echo $Menu ?> /></div>
                    </form>


    <footer>
    <?php require $DIR.$footer; ?>     
    </footer>  
</html>