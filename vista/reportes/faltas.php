<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR . $Falta);
require_once ($DIR . $Departamento);
require_once ($DIR . $Profesor);
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}

require_once ($DIR.$conexion);
require_once ($DIR.$ReportesControlador);

$buscarMateriasDepartamentoincluidoTodas= $URL.$buscarMateriasDepartamentoincluidoTodas;
$buscarfaltas= $URL.$buscarfaltas;
  
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
                <table align='center' class="table-mostrar" id="tablaBuscar" style="border-color: #FFFFFF">  
                    <tr>
                        <th>Departamento</th>
                        <td>                                
                                <select id="first-choice" name="departamentos">

                                       <?php 
                                       $a=new ReportesControlador();
                               $listadepartamento = $a->BuscarDepartamento();
                               foreach ($listadepartamento as $departamento): ?> 
                                <option <?php if($dep == $departamento->getid_departamento()){echo("selected");}?> value=<?php echo "{$departamento->getid_departamento()}" ?>> <?php echo "{$departamento->getnombre()}" ?></option>   
                                <?php endforeach; 
                               ?>
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
                             
                            </select>
                        </td>
                    </tr>                   
                    <tr>
                        <th>Materia</th>
                        <td>
                            <select id="second-choice" name="Materias">                       
                            
                                
                            </select>
                        </td>

                  
                                    <script>

                                  $("#first-choice").change(function() {
                                    $("#second-choice").load("<?php echo $buscarMateriasDepartamentoincluidoTodas.'?choice='?>"+ $("#first-choice").val())}).change();
                                    
                                    </script>

                      
       
                    </tr>   
                    </div> 
                    </table>
                    <div>  <br><input type="submit" value="Obtener" name="Obtener" formaction=<?php echo $buscarfaltas?> /></div>
                    </form>
                    <?php     
 //echo '<pre>'; print_r($_SESSION["faltasBuscadas"]); echo '</pre>';   
if(isset($_SESSION["faltasBuscadas"])) : ?>

<table>
<?php foreach ($_SESSION["faltasBuscadas"] as $falta): ?>

<th>Legajo</th>
<th>Profesor</th>
<th>tipo</th>
<th>cantidad</th>
<th>fecha</th>
<th>Materia</th>
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
</script>
    <footer>
        <?php require './../partials/footer.php'; ?>     
    </footer>  
</html>