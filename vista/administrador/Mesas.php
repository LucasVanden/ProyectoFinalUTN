<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR.$ReportesControlador);
$controladorMesas= $URL.$controladorMesas;
$controladorBuscarMesa= $URL.$controladorBuscarMesa;
$controladorEliminarMesa= $URL.$controladorEliminarMesa;
$MenuIndex= $URL.$MenuIndex;

$fechaMesaIngresar="'".date("Y-m-d")."'";
if(isset($_SESSION['FechaMesaIngresada'])){
 $fechaMesaIngresar=$_SESSION['FechaMesaIngresada'];
 }



$año=date('Y'); 
$buscar=false;
if(isset($_SESSION['fechasBuscadas'])){
    $buscar=true;
 }
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
        <h2>Cargar Fecha de Mesa</h2>
        <form action=<?php echo $controladorMesas ?> method="POST"> <!-- -->
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF">  
                   
                    <tr>
                        <th>Fecha Mesa</th>
                        <td>
                        <input type="date" id="f1" name="fechaMesa" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"value=<?php echo $fechaMesaIngresar;?>>   
                        </td>

                    </tr>                   

                </table>
                    <div>  <input type="submit" value="Cargar" name="Obtener" formaction=<?php echo $controladorMesas ?> /></div>

        <tr>
                        <th>Buscar mesas del año:</th>
                        <td>
                        <input type="number" name="año" min="1900" max="2200" step="1" value=<?php echo $año?> />
                        </td>
                        <br>

                    </tr>    
                                <div>  <input type="submit" value="Buscar fecha Mesas" name="Buscar" formaction=<?php echo $controladorBuscarMesa ?> /></div>
                                <!-- <div>  <input type="submit" value="Volver" name="Buscar" formaction=<?php echo $MenuIndex ?> /></div> -->
                    </form>

    <?php if ($buscar): ?>
<table>

<?php

foreach ($_SESSION['fechasBuscadas'] as $fecha): ?> 
<tr>
<td>
<?php   echo $fecha." " ?>
<button type="submit" value=<?php echo $fecha?> name="fechaAborrar" formaction=<?php echo $controladorEliminarMesa ?> onclick="return confirm('Esta seguro que desea eliminar fecha <?php echo $fecha?> ')"> Eliminar</input>

</td>
</tr>

<?php endforeach; ?>

</table>

     <?php endif; ?>
    <footer>
       <?php require $DIR.$footer; ?>         
    </footer>  
</html>