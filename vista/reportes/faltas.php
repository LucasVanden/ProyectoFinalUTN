<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR . $Falta);
require_once ($DIR . $Departamento);
require_once ($DIR . $Profesor);
session_start();
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
}else{
    if($_SESSION['rol'] != 5 ){
        header('location: '. $URL.$login);
    }
}
require_once ($DIR.$conexion);
require_once ($DIR.$ReportesControlador);

$buscarMateriasDepartamentoincluidoTodas= $URL.$buscarMateriasDepartamentoincluidoTodas;
$buscarfaltas= $URL.$buscarfaltas;

if(isset($_SESSION['departamentos'])){
    $dep=$_SESSION['departamentos'];
}else{
    $dep="pikachu";
}
if(isset($_SESSION['fechaDesde'])){
    $fechadesde=$_SESSION['fechaDesde'];
}else{
    $d=date("Y-m-d");
    $fechadesde="'".$d."'";
}
if(isset($_SESSION['fechaHasta'])){
    $fechahasta=$_SESSION['fechaHasta'];
}else{
    $d=date("Y-m-d");
    $fechahasta="'".$d."'";
}
if(isset($_SESSION['reporte2'])){
    $opcion=$_SESSION['reporte2'];
}else{
    $opcion=1;
}  
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
        <title>Faltas</title>
        <link rel="stylesheet" href="./../css/bootstrap.min.css"> 
    </head>
    <body background = <?php echo $URL.$fondo?> style="padding-top: 70px;">
    <script src="jquery.js"></script>
    <?php require $DIR.$headera ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <div class="container">
            <br>
            <form action="directorReportes.php" method="POST" class="form-horizontal">
                <div class="form-group">
                    <h2 for="inasistencias" class="text-primary col-md-9 col-md-offset-2"> Obtener Reportes Inasistencias: </h2>
                </div>
                <div class="container"> 
                    <div class="table-responsive col-md-8 col-md-offset-2">
                        <table class="table table-bordered table-hover" id="tablaBuscar">  
                            <tr class="info">
                                <th>Departamento</th>
                                <td>                                
                                    <select id="first-choice" name="departamentos">
                                       <?php 
                                       $a=new ReportesControlador();
                                        $listadepartamento = $a->BuscarDepartamento();
                                        foreach ($listadepartamento as $departamento): ?> 
                                        <option <?php if($dep == $departamento->getid_departamento()){echo("selected");}?> value=<?php echo "{$departamento->getid_departamento()}" ?>> <?php echo "{$departamento->getnombre()}" ?></option>   
                                        <?php endforeach;?>
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
                                <th>Materia</th>
                                <td>
                                    <select id="second-choice" name="Materias">                       
                                        <!-- voy por aca-->
                                    </select>
                                </td>

                        
                                            <script>

                                  $("#first-choice").change(function() {
                                    $("#second-choice").load("<?php echo $buscarMateriasDepartamentoincluidoTodas.'?choice='?>"+ $("#first-choice").val())}).change();
                                    
                                    </script>
                            </tr>   
                 
                        </table>
                    </div> 
                </div> 
                <div>  <br><input type="submit" value="Obtener" name="Obtener" formaction=<?php echo $buscarfaltas?> /></div>
                    </form>
<?php     
 //echo '<pre>'; print_r($_SESSION["faltasBuscadas"]); echo '</pre>';   
if(isset($_SESSION["faltasBuscadas"])) : ?>
    <?php if(empty($_SESSION["faltasBuscadas"])) : ?>
    No hay Faltas
    <?php endif?>
<table>
<th>Legajo</th>
<th>Profesor</th>
<th>tipo</th>
<th>cantidad</th>
<th>fecha</th>
<th>Materia</th>
<?php foreach ($_SESSION["faltasBuscadas"] as $falta): ?>


<tr>
  
        <div>
        <td>    <?php echo $falta->getProfesor()->getlegajo() ?> </td>
        <td>    <?php echo $falta->getProfesor()->getapellido() ?> 
               <?php echo $falta->getProfesor()->getnombre() ?> </td>
        <td>    <?php echo $falta->gettipo() ?> </td>
        <td>     <?php echo $falta->getminutos() ?> </td>
        <td>     <?php echo $falta->getfechaFalta() ?> </td>
        <td>     <?php echo $falta->getMateria()->getnombreMateria() ?> </td>
 
        </div>
   
</tr>
<?php endforeach; ?>
</table>  

<?php endif?>
<footer class="footer">
      <?php require $DIR.$footer; ?>     
 </footer>   
</html>