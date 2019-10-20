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


$fechadesdeVerano="'".date("Y-m-d")."'";

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
        <h2>Cargar Feriado</h2>
        <form action=<?php echo $controladorBorrarAsueto ?> method="POST"> <!-- -->
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF">  
                   
                    <tr>
                        <th>Fecha Feriado</th>
                        <td>
                        <input type="date" id="f1" name="fechaAborrar" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"value=<?php echo $fechadesdeVerano;?>>   
                        </td>

                    </tr>                   

                </table>
                    <div>  <input type="submit" value="Borrar" name="Obtener" formaction=<?php echo $controladorBorrarAsueto ?> /></div>
                    </form>


    <footer>
        <?php require './../partials/footer.php'; ?>     
    </footer>  
</html>