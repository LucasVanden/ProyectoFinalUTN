<?php
session_start();
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
}else{
    if(!($_SESSION['rol'] == 2 || $_SESSION['rol']==3)){
        header('location: '. $URL.$login);
    }
}
require_once $DIR . $profesorControlador;
$_SESSION['mensaje']=null;

$idusuario=$_SESSION['usuario'];
$a=new profesorControlador();
$idProfesor=$a->buscarProfesorDeUsuario($idusuario);
$_SESSION['idProfesor']=$idProfesor;
$_SESSION['nombre']=$a->idpofesoraNombre($idProfesor);
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
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0,  minimum-scale=1.0">
        <title>Profesor Principal</title>
        <link rel="stylesheet" href="./../css/bootstrap.min.css">
    </head>
    <body background = <?php echo $URL.$fondo?> style="padding-top: 70px;">
    <?php require $DIR.$headerp ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <?php
        $notificar= $URL . $profesorNotificarAlumno; 
        $anotados= $URL . $profesorAlumnosAnotados; 
        ?>

<style>
.column {
  float: left;
  width: 30%;
  padding: 50px;
  text-align: center;
  font-size: 20px;
  cursor: pointer;
  color: white;
  margin: 5px;
}

.containerTab {
  padding: 20px;
  color: white;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Closable button inside the image */
.closebtn {
  float: right;
  color: white;
  font-size: 35px;
  cursor: pointer;
}</style>
<!-- The grid: three columns -->

        <div class="container">
            <br>
            <form action="profesorPpal.php" method="POST" class="form-horizontal">
                <div class="form-group" align="center">
                    <h2 for="establecer" class="text-primary" style="font-family:myFirstFont,garamond,serif;font-size:42px;"> Establecer Horario de Consulta: </h2>
                </div>                 
                <div class="container">
                    <div class="table-responsive col-md-8 col-md-offset-2">
                        <!-- <table class="table table-bordered table-hover" id="tablaMateria">
                            <tr class="info">
                                <th> Materias </th>
                            </tr> -->
                            <?php 
                                $a =new profesorControlador;
                                $listaDedicaciones = $a->buscarMateriasProfesor($idProfesor);
                             $listaDepartamentosConMaterias=$a->agruparMateriasPorDepartamento($listaDedicaciones); 
// echo '<pre>'; print_r($a->agruparMateriasPorDepartamento($listaDedicaciones)); echo '</pre>';  
?>
<div class="row">
        <?php  foreach ($listaDepartamentosConMaterias as $departamentoLista): ?>   
        <div class="column" onclick="openTab('<?php echo $departamentoLista[0]?>');" style="background:#00b8eb;"> <?php echo $departamentoLista[0]?> </div>
        <?php endforeach; ?>
</div>

<?php  foreach ($listaDepartamentosConMaterias as $departamentoLista): ?>   
      
 
        <div id="<?php echo $departamentoLista[0]?>" class="containerTab" style="display:none;background:#00b8eb">
        <!-- If you want the ability to close the container, add a close button -->
        <span onclick="this.parentElement.style.display='none'" class="closebtn">x</span>
        
        <?php foreach ($departamentoLista[1] as $materia): ?>   
        <h2>  <input class="form-control" name="nombreMateriaSeleccionada" type="submit" value="<?php echo $materia->getnombreMateria()?>" formaction="profesorEstablecerHorario.php">    </h2>
        <?php endforeach; ?>

        </div>
       
<?php endforeach; ?>


                            <!-- <?php foreach ($listaDedicaciones as $dedicacion): ?>   
                            <tr>
                                <td> 
                                    <input class="form-control" name="nombreMateriaSeleccionada" id=<?php echo $dedicacion->getid_dedicacion()?> type="submit" value="<?php echo $dedicacion->getMateria()->getnombreMateria()?>" formaction="profesorEstablecerHorario.php">    
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table> -->
                    </div>
                </div>
                <br>
                <hr style= "height: 10px; border: 1; box-shadow: inset 0 9px 9px -3px rgba(11, 99, 184, 0.8); - webkit-border-radius: 5px; -moz-border-radius: 5px; -ms-border-radius: 5px; -o-border-radius: 5px; border-radius: 5px;">
                <div class="form-group" align="center">
                    <h2 for="anotados" class="text-primary" style="font-family:myFirstFont,garamond,serif;font-size:42px;"> Alumnos Anotados </h2>
                </div>
                <div class="container"> 
                    <div class="table-responsive col-md-12"> 
                        <table class="table table-bordered table-hover table-condensed" id="tablaAlumnosAnotados">
                            <tr class="info">
                                <th>Materia</th>
                                <th>Día</th>
                                <th>Hora</th>
                                <th>Cantidad</th>
                                <th colspan="2"></th>
                            </tr>
                            <?php 
                                $alumnosanotados = $a->alumnosAnotados($idProfesor);//<--------------id session
                            ?>
                            <?php foreach ($alumnosanotados as $hora): ?>   
                            <tr>
                                <td>
                                    <?php echo $hora->getMateria()->getnombreMateria() ?>
                                </td>
                                <td>
                                    <?php echo $hora->getHorarioDeConsulta()->getdia()->getdia() ?>
                                    <?php echo date("d-m-Y", strtotime($hora->getfechaHastaAnotados())); ?>
                                </td>
                                <td>
                                    <?php echo $hora->getHorarioDeConsulta()->gethora() ?>
                                </td>
                                <td>
                                    <?php echo $hora->getcantidadAnotados() ?>
                                </td>
                                <td>
                                    <div class="form-group"> 
                                        <div class="col-md-4 col-md-offset-2">
                                            <button class="btn btn-primary btn-xs" type="submit" id="Notificaridhora" title="Notificar Alumnos" name="Notificaridhora" value=<?php echo $hora->getid_horadeconsulta();?> formaction=<?php echo $notificar?>>
                                                <span class="glyphicon glyphicon-send"></span>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                
                                    <?php if ($hora->getcantidadAnotados()>0){ ?>
                                        <td>
                                    <div class="form-group"> 
                                        <div class="col-md-4 col-md-offset-2">
                                            <input type='hidden' name='dia' value=<?php echo $hora->getHorarioDeConsulta()->getdia()->getdia() ?>>
                                            <input type='hidden' name='hora' value=<?php echo $hora->getHorarioDeConsulta()->gethora() ?>>
                                            <button class="btn btn-primary btn-xs" title="Ver Detalle" name="Notificaridhora" type='submit' value=<?php echo $hora->getid_horadeconsulta()?> formaction=<?php echo $anotados?> > 
                                                <span class="glyphicon glyphicon-info-sign"></span>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                    <?php } else { 
                                                echo  '<td bgcolor="Lime">';
                                                echo "No anotados";
                                                echo  '</td>';
                                                }; ?>
                            </tr>
                            <?php endforeach; ?>                       
                        </table>
                    </div>
                </div>
                <br>
                <hr style= "height: 10px; border: 1; box-shadow: inset 0 9px 9px -3px rgba(11, 99, 184, 0.8); - webkit-border-radius: 5px; -moz-border-radius: 5px; -ms-border-radius: 5px; -o-border-radius: 5px; border-radius: 5px;">
                <div class="form-group" align="center">
                    <h2 for="anotados" class="text-primary" style = "font-family:myFirstFont,garamond,serif;font-size:42px;">Mis Notificaciones</h2>
                </div>
                <?php if ($a->hayAvisosProfesor($alumnosanotados)){ ?>
                <div class="container"> 
                    <div class="table-responsive col-md-12"> 
                        <table class="table table-bordered table-hover table-condensed" id="tablaAvisos">
                            <tr class="info">
                                <th>Materia</th>
                                <th>Dia</th>
                                <th>Fecha</th>
                                <th>Mensaje</th>          
                            </tr>
                            <?php foreach ($alumnosanotados as $hora): ?>   
                            <br>
                            <tr>     
                                <td>
                                    <?php echo $hora->getMateria()->getnombreMateria(); ?>
                                </td>
                                <td>    <?php echo $hora->getHorariodeConsulta()->getdia()->getdia(); ?>
                                        <?php echo $hora->getHorariodeConsulta()->gethora(); ?>
                                        </td>
                        
                                <?php foreach ($hora->getAvisoProfesor() as $aviso): ?> <!-- aca mensaje del alumno-->
                                <tr>    
                                    <td></td>
                                    <td>
                                        <?php echo ""?> <!-- aca fecha aviso del alumno-->
                                    </td>
                                    <td>
                                        <?php echo $aviso->getfechaAvisoProfesor();
                                        echo " ";
                                        echo substr($aviso->gethoraAvisoProfesor(), 0, 5);
                                        ?> <!-- aca fecha aviso del alumno-->
                                    </td>
                                    <td>
                                        <?php echo $aviso->getdetalleDescripcion() ?>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tr>
                            <?php endforeach;?>
                        </table>
                        <br>
                <?php } else { ?>
                    </div>
                </div>
                <div class="container">
                        <div class="table-responsive col-md-9 col-md-offset-1">
                            <table class="table table-bordered table-hover table-condensed" id="tablanotificaciones">
                                <td> 
                                    <strong style="float:left;"><span class="glyphicon glyphicon-envelope"></span><?php echo "  - No hay notificaciones"?></strong>
                                </td>
                            </table> 
                <?php }; ?>
                            <br>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script src="./../js/jquery.js"></script>
        <script src="./../js/bootstrap.min.js"></script>
<script>
function openTab(tabName) {
  var i, x;
  x = document.getElementsByClassName("containerTab");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  document.getElementById(tabName).style.display = "block";
} 
</script>   
    </body>
    <footer class="footer">
      <?php require $DIR.$footer; ?>     
 </footer> 
</html>