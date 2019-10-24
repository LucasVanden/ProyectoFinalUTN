<?php
session_start();

require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR.$ReportesControlador);

$MenuIndex= $URL.$MenuIndex;

$AsuetosMenu= $URL.$AsuetoMenu;
$Mesas= $URL.$Mesas;
$EditarAultaAsignada=$URL.$EditarAultaAsignada;
$BorrarAsueto=$URL.$BorrarAsueto;
$ABMAula=$URL.$ABMAula;
$abmDepartamento=$URL.$abmDepartamento;
$abmMateria=$URL.$abmMateria;
$menuAltaProfesor=$URL.$menuAltaProfesor;
$backup=$URL.$backup;

$_SESSION['comprobacion']=null;
$_SESSION['fechasBuscadas']=null;
$_SESSION['mostrarAulas']=null;

$_SESSION['departamentos']=null;
$_SESSION['idDepartamentoSeleccionado']=null;

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
        <h2>menu?</h2>
        <form action=<?php echo $MenuIndex ?> method="POST"> <!-- -->
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF">  
             
                    
                        <tr>
                        <td>
                        <div>  <input type="submit" value="Asuetos" name="Obtener" formaction=<?php echo $AsuetosMenu ?>  /></div>
                        </td>
                        </tr>
                        <tr>
                        <td>   <div>  <input type="submit" value="Cargar Fecha de Mesa" name="Obtener" formaction=<?php echo $Mesas ?> /></div></td>
                        </tr>
                        <tr>
                        <td>   <div>  <input type="submit" value="Cargar Aula" name="Obtener" formaction=<?php echo $ABMAula ?> /></div></td>
                        <td>   <div>  <input type="submit" value="Editar Aula Asignada" name="Obtener" formaction=<?php echo $EditarAultaAsignada ?> /></div></td>
                        </tr>
                        <tr>
                        <td>   <div>  <input type="submit" value="Cargar Departamento" name="Obtener" formaction=<?php echo $abmDepartamento ?> /></div></td>
                        <td>   <div>  <input type="submit" value="Materia" name="Obtener" formaction=<?php echo $abmMateria ?> /></div></td>
                        <td>   <div>  <input type="submit" value="Profesor" name="Obtener" formaction=<?php echo $menuAltaProfesor ?> /></div></td>       
                        </tr>        

                             <tr>
                        <td>
                        <div>  <input type="submit" value="Backup" name="Obtener" formaction=<?php echo $backup ?>  /></div>
                        </td>
                        </tr> 
                    </form>


    <footer>
        <?php require './../partials/footer.php'; ?>     
    </footer>  
</html>