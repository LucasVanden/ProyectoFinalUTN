<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR.$ReportesControlador);
$depatartamentomaterias= $URL.$departamentoMaterias;
$grafico=false;

$d=date("Y-m-d");
$fecha="'".$d."'";
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
        <h2>Obtener Reportes sobre Horarios de Consulta:</h2>
        <form action="directorReportes.php" method="POST"> <!-- -->
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF">  
                    <tr>
                        <th>Departamento</th>
                        <td>                                
                                <select id="first-choice" name="departamentos">

                                       <?php 
                                       $a=new ReportesControlador();
                               $listadepartamento = $a->BuscarDepartamento();
                               foreach ($listadepartamento as $departamento): ?> 
                                <option value=<?php echo "{$departamento->getid_departamento()}" ?>> <?php echo "{$departamento->getnombre()}" ?></option>   
                                <?php endforeach; 
                               ?>
                                </select>
                            </td>

                    </tr>
                    <tr>
                        <th>Fecha Desde</th>
                        <td>
                        <input type="date" id="f1" name="fechaDesde" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"value=<?php echo $fecha;?>>   
                        </td>
                    </tr>                   
                    <tr>
                        <th>Fecha Hasta</th>
                        <td>
                           
                        <input type="date" id="f2" name="fechaHasta" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value=<?php echo $fecha;?>">                
                             
                            </select>
                        </td>
                    </tr>                   
                    <tr>
                        <th>Tipo de Reporte</th>
                        <td>
                            <select id="reporte" name="reporte2">                       
                                <option value='1'>Alumnos por Materia</option>
                                <option value=2>Materia Ranking</option>
                                <option value =3>Alumnos por Profesor por Materia</option>
                            </select>
                        </td>


                        <script>
                              $("#reporte").change(function() {   
                          if (($("#reporte").val())==3){
                            materia=1;}else{
                            materia=2;
                            }
                            //alert(materia);
                        }).change();
                        </script>

                
            
         
                        <?php 

                     $a="<script>document.writeln(materia)</script>";
                     echo $a;
                     echo "pikachu";
                     
                        if (true): ?>   
                            <td>                       
                                    <select id="second-choice" name="Materias">
                                    </select> 
                                    <script>
                                
                                    $("#first-choice").change(function() {
                                    $("#second-choice").load("<?php echo $depatartamentomaterias.'?choice='?>"+ $("#first-choice").val());
                                    }).change();</script>

                            </td>
                            <?php endif; ?>
                            
                    </tr>   
                    </div> 
                    </table>
                    <div>  <input type="submit" value="Obtener" name="Obtener"  /></div>
                    </form>
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
$label="'"."Cantidad Alumnos"."'";
echo $_POST['reporte2'];

echo '<pre>'; print_r($etiquetas); echo '</pre>';   
echo '<pre>'; print_r($valores); echo '</pre>';   
echo $_POST["fechaHasta"];
$grafico=isset($_POST["Obtener"]);

}

?>
  <?php if ($grafico): ?>

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
            backgroundColor: 'rgb('+Math.trunc(Math.random()*255)+','+Math.trunc(Math.random()*255)+','+Math.trunc(Math.random()*255)+')',
            borderColor: 'rgb(255, 99, 132)',
            data: <?php echo $data?>,
        }]
    },

    // Configuration options go here
    options: {}
});
<?php endif; ?>

</script>
    <footer>
        <?php require './../partials/footer.php'; ?>     
    </footer>  
</html>