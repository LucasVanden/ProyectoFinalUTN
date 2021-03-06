<?php

session_start();
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
}else{
    if($_SESSION['rol'] != 3 ){
        header('location: '. $URL.$login);
    }
}
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR.$ReportesControlador);
$depatartamentomaterias= $URL.$llenarMaterias;
$grafico=false;
$etiquetas=true;
if(isset($_POST['departamentos'])){
$dep=$_POST['departamentos'];}else{
    $dep="pikachu";
}
if(isset($_POST['fechaDesde'])){
    $fechadesde=$_POST['fechaDesde'];}else{
        $d=date("Y-m-d");
        $fechadesde="'".$d."'";
    }
if(isset($_POST['fechaHasta'])){
        $fechahasta=$_POST['fechaHasta'];}else{
            $d=date("Y-m-d");
            $fechahasta="'".$d."'";
        }
if(isset($_POST['reporte2'])){
            $opcion=$_POST['reporte2'];}else{
                $opcion=1;
            }      
if(isset($_POST['fechaDesde'])){
    if ($_POST['fechaDesde'] >$_POST['fechaHasta']){
        $mensage="Fecha Hasta debe ser mayor a Fecha Desde";
    }
} 

if(isset($_POST['Materias'])){
    $_SESSION['materia']=$_POST['Materias'];}else{
    }
?>

<style>
        @font-face {
  font-family: myFirstFont;
  src: url(./../SnowHut.ttf);
}
</style>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
        <title>Reportes</title>       
        <link rel="stylesheet" href="./../css/bootstrap.min.css">  
    </head>
    <body background = <?php echo $URL.$fondo?> style="padding-top: 70px;">
    <script src="jquery.js"></script>
    <?php require $DIR.$headerp ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <div class="container">
            <br>
            <form action="directorReportes.php" method="POST" class="form-horizontal">
                <div class="form-group" align="center">
                    <h2 for="cursando" class="text-primary" style = "font-family:myFirstFont,garamond,serif;font-size:42px;"> Obtener Reportes sobre Horarios de Consulta: </h2>
                </div> 
                <div class="container"> 
                    <div class="table-responsive col-md-8 col-md-offset-2">
                        <table class="table table-bordered table-hover" id="tablaBuscar">  
                            <tr class="info">
                                <th> Departamento </th>
                                <td colspan="2">                                
                                    <select id="first-choice" name="departamentos">
                                        <?php $a=new ReportesControlador();
                                            $listadepartamento = $a->BuscarDepartamento();
                                            foreach ($listadepartamento as $departamento): ?> 
                                        <option <?php if($dep == $departamento->getid_departamento()){echo("selected");}?> value=<?php echo "{$departamento->getid_departamento()}" ?>> <?php echo "{$departamento->getnombre()}" ?></option>   
                                            <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                            <th>Fecha Desde</th>
                            <td colspan="2">
                                <input type="date" id="f1" name="fechaDesde" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"value=<?php echo $fechadesde;?>>   
                            </td>
                        </tr>                   
                        <tr>
                            <th>Fecha Hasta</th>
                            <td colspan="2">                           
                                <input type="date" id="f2" name="fechaHasta" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value=<?php echo $fechahasta;?>>                
                            </td>
                        </tr>                   
                        <tr>
                            <th>Tipo de Reporte</th>
                            <td>
                                <select id="reporte" name="reporte2">                       
                                    <option <?php if($opcion == 1){echo("selected");}?> value='1'>Alumnos por Materia</option>
                                    <option <?php if($opcion == 2){echo("selected");}?> value=2>Alumnos por Departamento</option>
                                    <option <?php if($opcion == 3){echo("selected");}?> value =3>Alumnos por Profesor por Materia</option>
                                </select>
                            </td>
                            <script>
                                $("#reporte").change(function() {   
                                    if (($("#reporte").val())==3){
                                        materia=1;}else{
                                        materia=2;
                                    }
                                }).change();
                            </script>                      
                            <?php $a="<script>document.writeln(materia)</script>";                    
                                if (true): ?>   
                            <td>                       
                                <select id="second-choice" name="Materias">
                                </select> 
                                <script>    
                                    $("#reporte").change(function() {
                                        if (($("#reporte").val())==3){
                                            $("#second-choice").load("<?php echo $depatartamentomaterias.'?choice='?>"+ $("#first-choice").val())}else{
                                            $("#second-choice").empty();
                                        }
                                    }).change();  
                                        
                                    $("#first-choice").change(function() {
                                        if (($("#reporte").val())==3){
                                            $("#second-choice").load("<?php echo $depatartamentomaterias.'?choice='?>"+ $("#first-choice").val())}else{
                                            $("#second-choice").empty();
                                        }
                                    }).change();                                       
                                </script>
                            </td>
                                <?php endif; ?>    
                        </tr>   
                    </table>
                </div>
            </div>
            <div class="form-group"> 
                <div class="col-md-4 col-md-offset-2">
                    <button class="btn btn-primary" id="Obtener" type="submit" name="Obtener"> Obtener 
                        <span class="glyphicon glyphicon-play"></span>
                    </button> 
                </div>                     
            </div>
            <br>
                <hr style= "height: 10px; border: 1; box-shadow: inset 0 9px 9px -3px rgba(11, 99, 184, 0.8); - webkit-border-radius: 5px; -moz-border-radius: 5px; -ms-border-radius: 5px; -o-border-radius: 5px; border-radius: 5px;">
        </form>
    </div>
     
        <div class="container">
            <div class="col-md-12 col-md-offset-0">
                <br>
                <?php 
                if(isset($_POST["Obtener"])){

                    if(isset($mensage)){
                       
                     echo '<div align="center" class="alert alert-danger" role="alert">';
                     echo $mensage;
                      echo "</div>";
                    }else{

                    $fechaDesde=$_POST["fechaDesde"];
                    $fechaHasta=$_POST["fechaHasta"];
                    $c=new ReportesControlador();
                    switch ($_POST["reporte2"]) {
                        case '1':
                            $AlumnosPorMateria=$c->AlumnosPorMateria($_POST["departamentos"],$fechaDesde,$fechaHasta);
                            break;
                        case '2':
                            $AlumnosPorMateria=$c->AlumnosPorDepartamento($fechaDesde,$fechaHasta);
                            break;
                        case '3':
                            $AlumnosPorMateria=$c->AlumnosPorProfesorPorMateria($_POST["Materias"],$fechaDesde,$fechaHasta);
                            break;
                        default:    
                            break;
                    }
                    $etiquetas=$AlumnosPorMateria[0];
                    $valores=$AlumnosPorMateria[1];
                    $labels=$c->auxiliarLabels($etiquetas);
                    $data=$c->auxiliarValores($valores);
                        //$label="'".$_POST['reporte2']."'";
                    $label="'"."Cantidad de Alumnos"."'";
                        //echo $_POST['reporte2'];
                        //echo '<pre>'; print_r($etiquetas); echo '</pre>';   
                        //echo '<pre>'; print_r($valores); echo '</pre>';   
                    $grafico=isset($_POST["Obtener"]);
                }}
              $noVacio=false;
              if(isset($valores)){
                    foreach ($valores as $valor) {
                            if($valor!=0){
                                $noVacio=true;
                            }
                    }
                    if(!$noVacio){
                  
        echo '<div align="center" class="alert alert-warning" role="alert">';
        echo "No hay datos";
        echo '</div>';
                }
            }
              ?>
                <?php if ($grafico&&$noVacio): ?>

                <div id="container" style="width:120%;">
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
                                backgroundColor: 'rgb('+Math.trunc(Math.random()*255)+','+Math.trunc(Math.random()*255)+','+Math.trunc(Math.random()*255)+')',
                                borderColor: 'rgb(0, 0, 0)',
                                data: <?php echo $data?>,
                            }]
                        },
                        // Configuration options go here
                        options: {
                            scales: {
                                xAxes: [{  barThickness: 48,  // number (pixels) or 'flex'
                                maxBarThickness: 48 }],
                                yAxes: [{
                                 
                                    ticks: {
                                        precision: 0
                                    }
                                }]
                            } 
                        }
                    });
                    <?php endif; ?>
                </script>
                <br><br><br>
            </div>
        </div>
        <script src="./../js/jquery.js"></script>
        <script src="./../js/bootstrap.min.js"></script>
    </body>
    <footer class="footer">
      <?php require $DIR.$footer; ?>     
    </footer>    
</html>