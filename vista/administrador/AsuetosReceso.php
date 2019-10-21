<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
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
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/>
 
    </head>
    <body background = <?php echo $URL.$fondo?>>
    <script src="jquery.js"></script>
    <?php require $DIR.$headera ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h2>Cargar Resesos</h2>
        <form action=<?php echo $controladorAsuetosReceso ?> method="POST"> <!-- -->
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF">  
                    <tr>
                        <th>Reseso Verano</th>
          
                    </tr>
                    <tr>
                        <th>Fecha Desde</th>
                        <td>
                        <input type="date" id="f1" name="fechaDesdeVerano" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"value=<?php echo $fechadesdeVerano;?>>   
                        </td>
                
                        <th>Fecha Hasta</th>
                        <td>
                           
                        <input type="date" id="f2" name="fechaHastaVerano" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value=<?php echo $fechahastaVerano;?>>                
                             
                            </select>
                        </td>
                    </tr>                   
                    </div> 
         
                    <tr>
                        <th>Reseso Invierno</th>
          
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
                    <div>  <input type="submit" value="Cargar" name="Obtener"  /></div>
                    <div>  <input type="submit" value="Volver" name="Buscar" formaction=<?php echo $Menu ?> /></div>
                    </form>


    <footer>
    <?php require $DIR.$footer; ?>     
    </footer>  
</html>