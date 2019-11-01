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
$depatartamentomaterias= $URL.$departamentoMaterias;
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

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
        <title>Reportes</title>       
        <link rel="stylesheet" href="./../css/bootstrap.min.css">   
        <link href="css/sticky-footer-navbar.css" rel="stylesheet"> 
    </head>
    <body background = <?php echo $URL.$fondo?>>
    <script src="jquery.js"></script>
    <?php require $DIR.$headerp ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <div class="container">
            <br>
        <form action="directorReportes.php" method="POST" class="form-horizontal">
            <div class="form-group">
                <h2 for="cursando" class="text-primary col-md-9 col-md-offset-2"> Obtener Reportes sobre Horarios de Consulta: </h2>
            </div> 
            <div class="container"> 
                <div class="table-responsive col-md-8 col-md-offset-2">
                    <table class="table table-bordered table-hover" id="tablaBuscar">  
                        <tr>
                            <th> Departamento </th>
                            <td>                                
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
                            <td>
                                <input type="date" id="f1" name="fechaDesde" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"value=<?php echo $fechadesde;?>>   
                            </td>
                        </tr>                   
                        <tr>
                            <th>Fecha Hasta</th>
                            <td>                           
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
                <div class="col-md-4 col-md-offset-4">
                    <button class="btn btn-primary" id="Obtener" type="submit" name="Obtener"> Obtener 
                        <span class="glyphicon glyphicon-play"></span>
                    </button> 
                </div>                     
            </div>
        </form>
    </div>
    <script src="./../js/jquery.js"></script>
    <script src="./../js/bootstrap.min.js"></script>
    </body>

     
            <div class="container">
            <div class="col-md-12 col-md-offset-2">
<br>
                    <?php     

if(isset($_POST["Obtener"])){
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
}
if (empty($etiquetas)): ?>   
No hay datos
<?php endif; ?>

  <?php if ($grafico): ?>

<div id="container" style="width:70%;">
<canvas id="myChart"></canvas>
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
    options: {}
});
<?php endif; ?>
</script>
<br>
</div>
</div>
    <footer class="footer">
      <div class="container">
            <div class="col-md-12">
                <p class="text-muted text-center credit"> Copyright &copy; 2019 aHora</p> 
            </div>
      </div>
    </footer>   
</html>