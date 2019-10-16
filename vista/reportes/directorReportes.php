<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR.$ReportesControlador);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/>
        <style type="text/css">
            table {
                font:11px/120% Verdana, Arial, Helvetica, sans-serif;
                color:#777777;	
            }
            .barrasv {
                width:2.5em;
                text-shadow:#CCCCCC 0.1em 0.1em 0.1em;
                border-radius:5px;
                -moz-border-radius:5px;
                -webkit-border-radius:5px;
                box-shadow:1px 1px 1px black;
                -webkit-box-shadow:1px 1px 1px black;
                -moz-box-shadow:1px 1px 1px black;
                margin-bottom:1px;
            }
            .verticalmente {
                position:relative; 
                transform:rotate(-90deg);
                -o-transform:rotate(-90deg);
                -webkit-transform:rotate(-90deg);
                -moz-transform:rotate(-90deg);
                -ms-filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
                filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
                writing-mode:tb-rl;
                filter:flipv fliph;
                margin:0 -1em;
            }
            #etiq td {
                height:7em;
                width:3em;
                font-weight:bold;
            }
            .bordetd {
                border-top: 1px solid #777777;
                border-bottom: 1px solid #777777;
                margin-left: 1px;
                margin-right: 1px;
                padding-top:1px;
                padding-bottom:1px;
            }            
        </style>
    </head>
    <body background = <?php echo $URL.$fondo?>>
        <?php require './../partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h2>Obtener Reportes sobre Horarios de Consulta:</h2>
        <form action="directorReportes.php" method="POST"> <!-- -->
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF">  
                    <tr>
                        <th>Departamento</th>
                        <td>
                            <select name="Departamentos">                       
                                <option>Sistemas</option>
                                <option>Básicas</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Fecha Desde</th>
                        <td>
                            <select name="fechaDEsde">                       
                                <option>01 de Marzo</option>
                                <option>15 de Julio</option>
                            </select>
                        </td>
                    </tr>                   
                    <tr>
                        <th>Fecha Hasta</th>
                        <td>
                            <select name="fechaHasta">                       
                                <option>15 de Julio</option>
                                <option>01 de Marzo</option>                                
                            </select>
                        </td>
                    </tr>                   
                    <tr>
                        <th>Tipo de Reporte</th>
                        <td>
                            <select name="reporte">                       
                                <option>Alumnos por Materia</option>
                                <option>Materia Ranking</option>
                                <option>Alumnos por Profesor por Materia</option>
                            </select>
                        </td>
                    </tr>   
                    </div> 
                    </table>
                    <div>  <input type="submit" value="Obtener" name="Obtener"  /></div>
                    </form>
                    <?php     


$c=new ReportesControlador();
$AlumnosPorMateria=$c->AlumnosPorMateria(1,'0000-00-00','2025-00-00');
$etiquetas=$AlumnosPorMateria[0];
$valores=$AlumnosPorMateria[1];
$labels=$c->auxiliarLabels($etiquetas);
$data=$c->auxiliarValores($valores);
$label="'".$_POST['reporte']."'";
echo $_POST['reporte'];
echo '<pre>'; print_r($etiquetas); echo '</pre>';   
echo '<pre>'; print_r($valores); echo '</pre>';   
?>


<div id="container" style="width: 25%;">
<canvas id="myChart" ></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: <?php echo $labels?>,
        datasets: [{
            label: <?php echo $label?>,
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: <?php echo $data?>,
        }]
    },

    // Configuration options go here
    options: {}
});
</script>
    <footer>
        <?php require './../partials/footer.php'; ?>     
    </footer>  
</html>