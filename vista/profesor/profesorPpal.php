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
        <div class="container">
            <br>
            <form action="profesorPpal.php" method="POST" class="form-horizontal">
                <div class="form-group">
                    <h2 for="anotado" class="text-primary col-md-5 col-md-offset-4"> Establecer Horario de Consulta: </h2>
                </div>                 
                <div class="container">
                    <div class="table-responsive col-md-4 col-md-offset-4">
                        <table class="table table-bordered table-hover" id="tablaMateria">
                            <tr class="info">
                                <th> Materias </th>
                            </tr>   
                            <?php 
                                $a =new profesorControlador;
                                $listaDedicaciones = $a->buscarMateriasProfesor($idProfesor);
                                foreach ($listaDedicaciones as $dedicacion): ?>   
                            <tr>
                                <td> 
                                    <input class="form-control" name="nombreMateriaSeleccionada" id=<?php echo $dedicacion->getid_dedicacion()?> type="submit" value="<?php echo $dedicacion->getMateria()->getnombreMateria()?>" formaction="profesorEstablecerHorario.php">    
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <h2 for="anotado" class="text-primary col-md-5 col-md-offset-4"> Alumnos Anotados </h2>
                </div>
                <div class="container"> 
                    <div class="table-responsive col-md-9 col-md-offset-1"> 
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
                                <td>
                                    <?php if ($hora->getcantidadAnotados()>0){ ?>
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
            <div>
            <br>
            <h2>Mis Notificaciones</h2> <!-- desde aca acomodar con lo que viene-->
            <?php if ($a->hayAvisosProfesor($alumnosanotados)){ ?>
            <table  align='center' class="table-mostrar" id="tablaAvisos" onclick="" >
                <thead>                    
                    <th>Materia</th>
                    <th>Dia</th>
                    <th>Fecha</th>
                    <th>Mensaje</th>          
                </thead>
                <?php     
                    foreach ($alumnosanotados as $hora): ?>   
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
                    <?php endforeach;
                    ?>
                </tr>
                    <?php endforeach; 
                    ?>
                </table>
                <?php } else { ?>
                    <table align='center' class="table-mostrar" id="tablanotificaciones" onclick="" >
                    <td>
                        <?php echo "No hay notificaciones." ?>
                    </td>
                </table> 
                    <?php }; ?>
                <br>
                <br>
                <br>
            </div>
        </form>
    </body>
    <footer class="footer">
      <?php require $DIR.$footer; ?>     
 </footer> 
</html>