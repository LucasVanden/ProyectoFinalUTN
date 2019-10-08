<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require './../dbPFprueba.php';
require './../rutas.php';
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
        <form action="alumnoPpal.php" method="POST"> <!-- -->
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
                </table>
            </div>
            <div>
                <br>
                <input type="submit" value="Obtener" name="Obtener" disabled="disabled" />
            </div>        
                <table align="center" cellpadding="0" cellspacing="0" border="0">
                <tbody align="center">
                    <tr>
                    <td valign="bottom"><div style="vertical-align:text-top">25</div><div class="barrasv" style="height:31.6px; background-color:#BDDA4C">&nbsp;</div></td>
                    <td valign="bottom"><div style="vertical-align:text-top">40</div><div class="barrasv" style="height:43.5px; background-color:#FF9A68">&nbsp;</div></td>
                    <td valign="bottom"><div style="vertical-align:text-top">15</div><div class="barrasv" style="height:15.8px; background-color:#69ABBF">&nbsp;</div></td>
                    <td valign="bottom"><div style="vertical-align:text-top">2</div><div class="barrasv" style="height:1.9px; background-color:#FFDE68">&nbsp;</div></td>
                    <td valign="bottom"><div style="vertical-align:text-top">7</div><div class="barrasv" style="height:6.9px; background-color:#AB6487">&nbsp;</div></td>
                    </tr>
                    <tr>
                    <td class="bordetd">31.6%</td>
                    <td class="bordetd">43.5%</td>
                    <td class="bordetd">15.8%</td>
                    <td class="bordetd">1.9%</td>
                    <td class="bordetd">6.9%</td>
                    </tr>
                    <tr id="etiq">
                    <td><div class="verticalmente">Barra 1</div></td>
                    <td><div class="verticalmente">Barra 2 </div></td>
                    <td><div class="verticalmente">Barra 3</div></td>
                    <td><div class="verticalmente">Barra 4</div></td>
                    <td><div class="verticalmente">Barra 5</div></td>
                    </tr>
                </tbody>
                </table>
        </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>     
    </footer>  
</html>