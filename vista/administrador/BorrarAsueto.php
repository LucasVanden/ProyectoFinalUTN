<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR.$ReportesControlador);
$controladorBorrarAsueto= $URL.$controladorBorrarAsueto;
$controladorBuscarAsuetos= $URL.$controladorBuscarAsuetos;
$Menu= $URL.$AsuetoMenu;


$fechadesdeVerano="'".date("Y-m-d")."'";
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
    <?php require $DIR.$headera ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h2>Cargar Feriado</h2>
        <form action=<?php echo $controladorBorrarAsueto ?> method="POST"> <!-- -->
            <div>
                <table align='center' class="table-mostrar" id="tablaBuscar" style="border-color: #FFFFFF">  
                   
                    <tr>
                        <th>Fecha Feriado</th>
                        <td>
                        <input type="date" id="f1" name="fechaAborrar" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"value=<?php echo $fechadesdeVerano;?>>   
                        </td>
                    </tr>                   

                </table>
                    <div> <br> <input type="submit" value="Borrar" name="Obtener" formaction=<?php echo $controladorBorrarAsueto ?> /></div>

        <tr> <br>
                        <th>Buscar Asuetos</th>
                        <td>
                        <input type="number" name="año" min="1900" max="2200" step="1" value=<?php echo $año?> />
                        </td>
                        <br>

                    </tr>    
                                <div> <br> <input type="submit" value="Buscar Asuetos" name="Buscar" formaction=<?php echo $controladorBuscarAsuetos ?> /></div>
                                <div>  <input type="submit" value="Volver" name="Buscar" formaction=<?php echo $Menu ?> /></div>
                    </form>

    <?php if ($buscar): ?>
<table>

<?php
foreach ($_SESSION['fechasBuscadas'] as $fecha): ?> 
<tr>
<td>
<input type="submit" value=<?php echo $fecha?> name="fechaAborrar" formaction=<?php echo $controladorBorrarAsueto ?> onclick="return confirm('Esta seguro que desea eliminar fecha <?php echo $fecha?> ')"> Eliminar</input>
</td>
</tr>

<?php endforeach; ?>

</table>

     <?php endif; ?>
    <footer>
    <?php require $DIR.$footer; ?>     
    </footer>  
</html>