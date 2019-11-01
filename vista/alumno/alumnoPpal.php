<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';

session_start();
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
}else{
    if($_SESSION['rol'] != 1){
        header('location: '. $URL.$login);
    }
}

require_once $DIR . $alumnoControlador;
require_once $DIR . $departamentoMaterias;
$eliminar= $URL . $eliminarAnotacion;
$depatartamentomaterias= $URL.$departamentoMaterias;

$a =new AlumnoControlador ;
$idusuario=$_SESSION['usuario'];
$idalumno= $a->buscarAlumnoDeUsuario($idusuario);
$alumno = $a->buscarAlumno($idalumno);
$_SESSION['idalumno']=$idalumno;
$_SESSION['nombre']=$a->idAlumnoaNombre($idalumno);
$_SESSION['mensaje']=null;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
        <title>Alumno Principal</title>
        <link rel="stylesheet" href="./../css/bootstrap.min.css">   
        <link href="css/sticky-footer-navbar.css" rel="stylesheet">
    </head>
    <body background = <?php echo $URL."/vista/fondoCuerpo.jpg>"?>
        <?php require $DIR.$header ?>
            <?php if (!empty($message)): ?>
                <p> <?= $message ?></p>
            <?php endif; ?>
        <!-- se usa los dos script siguientes??-->
        <script src="jquery.js"></script>
        <script src="./../js/funciones.js" type="text/javascript"></script>
        <div class="container">
            <br>
            <form action="alumnoPpal.php" method="POST" class="form-horizontal">
                <div class="form-group">
                    <h2 for="cursando" class="text-primary col-md-4 col-md-offset-5">Estás cursando:</h2>
                </div>        
                <div class="container">
                    <div class="table-responsive col-md-4 col-md-offset-4">
                        <table class="table table-bordered table-hover" id="tablaMateria">
                            <tr class="info">
                                <th> Materias </th>
                            </tr>
                            <?php foreach ($alumno[0]->getMateria() as $materia): ?>
                            <tr>
                                <td>
                                    <input class="form-control" name="nombreMateriaSeleccionada" id=<?php echo $materia->getid_materia()?> type="submit" value="<?php echo $materia->getnombreMateria()?>" formaction="busquedaPorMateria.php">
                                </td>
                            </tr>
                            <?php endforeach;?>
                        </table>
                    </div>
                </div>
                <div class="form-group"> 
                    <div class="col-md-6 col-md-offset-5">
                        <button class="btn btn-primary" type="submit" formaction="alumnoAgregarMateria.php">Agregar Materia
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </div>                     
                </div>           
                <div class="container">
                    <br>
                    <div class="form-group">
                        <h2 for="consulta" class="text-primary col-md-4 col-md-offset-4">Buscar Otra Consulta</h2>
                    </div>
                    <div class="container">
                        <div class="table-responsive col-md-6 col-md-offset-3">
                            <table class="table table-bordered table-hover" id="tablaBuscar">  
                                <tr class="info">
                                    <th>Por Profesor</th>
                                    <th colspan="2">Por Materia</th>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 for="profesor" class="text-primary">Seleccione Profesor</h5>
                                    </td>
                                    <td colspan="2">
                                        <h5 for="departamento" class="text-danger">Seleccione Departamento despúes Materia</h5>
                                    </td>
                                    <tr>
                                        <td> 
                                            <div class="col-md-6 my-3">
                                                <select class="browser-default custom-select" name="profesor" data-style="btn-primary" data-widthen="auto">                               
                                                    <?php $listaprofesores = $a->BuscarProfesor();
                                                        foreach ($listaprofesores as $profesor): ?> 
                                                    <option data-divider="true" value=<?php echo "{$profesor->getid_profesor()}" ?>> <?php echo "{$profesor->getApellido()}, {$profesor->getnombre()}" ?></option>   
                                                    <?php endforeach; ?>
                                                </select> 
                                            </div>                               
                                        </td>
                                        <td>                                
                                            <select class="mdb-select md-form" id="first-choice" name="departamentos">
                                            <?php $listadepartamento = $a->BuscarDepartamento();
                                                    foreach ($listadepartamento as $departamento): ?> 
                                                <option value=<?php echo "{$departamento->getid_departamento()}" ?>> <?php echo "{$departamento->getnombre()}" ?></option>   
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>                       
                                            <select class="mdb-select md-form" id="second-choice" name="Materias">
                                            </select> 
                                            <script>
                                                $("#first-choice").change(function() {
                                                    $("#second-choice").load("<?php echo $depatartamentomaterias.'?choice='?>"+ $("#first-choice").val());
                                                }).change();
                                            </script>
                                        </td>
                                </tr>                   
                        </table>
                    </div>
                </div>
                <div class="container">
                    <br>
                    <div class="form-group"> 
                        <div class="col-md-4 col-md-offset-4">
                            <button class="btn btn-primary" id=buttonBuscar type="submit" formaction="busquedaPorProfesor.php"> Buscar Profesor 
                                <span class="glyphicon glyphicon-search"></span>
                            </button>                   
                            <button class="btn btn-primary" type="submit" formaction="busquedaPorMateria.php"> Buscar Materia 
                                <span class="glyphicon glyphicon-search"></span>
                            </button>
                        </div>                     
                    </div>
                </div>                   
                <br>
                <div class="form-group">                  
                    <h2 for="anotaciones" class="text-primary col-md-4 col-md-offset-4">Mis Anotaciones</h2>
                </div>
                    <?php $misanotaciones = $a->MisAnotaciones($idalumno);?>
                    <?php if (count($misanotaciones)>0){ ?>
                    <div class="container">
                        <div class="table-responsive col-md-9 col-md-offset-1">
                            <table class="table table-bordered table-hover" id="tablaAnotaciones">
                                <tr class="info">                    
                                    <th>Materia</th>
                                    <th>Profesor</th>
                                    <th>Día</th>
                                    <th>Horario</th>
                                    <th>Aula</th>
                                    <th></th>
                                </tr>
                                <?php foreach ($misanotaciones as $hora): ?> 
                                    <tr>
                                        <td>
                                            <?php echo $hora->getMateria()->getnombreMateria(); ?>
                                        </td>
                                        <td>
                                            <?php echo $hora->getHorariodeConsulta()->getProfesor()->getapellido(); ?>
                                            <?php echo $hora->getHorariodeConsulta()->getProfesor()->getnombre(); ?>
                                        </td>
                                        <td>
                                            <?php echo $hora->getHorariodeConsulta()->getdia()->getdia(); ?>
                                            <?php echo date("d-m-Y", strtotime($hora->getfechaHastaAnotados())); ?>
                                        </td>
                                        <td>
                                            <?php echo $hora->getHorariodeConsulta()->gethora(); ?>
                                        </td>
                                        <td>
                                        <?php echo $hora->getHorarioDeConsulta()->getfk_aula()->getcuerpoAula();
                                        echo " nivel: ";
                                        echo $hora->getHorarioDeConsulta()->getfk_aula()->getnivelAula();
                                        echo " aula: ";
                                        echo $hora->getHorarioDeConsulta()->getfk_aula()->getnumeroAula(); ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-xs" title="Eliminar Anotación" type="submit" id="buttonBorrar" name="idDetalle" value=  <?php echo $hora->gettempiddetalle(); ?> formaction=<?php echo $eliminar?> onclick="return confirm('Está seguro que desea eliminarse')">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php } else{ ?>
                        </div>
                    </div>
                    <div class="container">
                        <div class="table-responsive col-md-9 col-md-offset-1">
                            <table class="table" id="tablaAnotaciones">
                                <td>
                                    <?php echo "No esta anotado" ?>
                                </td>
                            </table> 
                            <?php }; ?>
                        <br>
                        </div>
                    </div>
                <div class="container">
                    <br>
                    <h2 for="notificaciones" class="text-primary col-md-4 col-md-offset-4">Mis Notificaciones</h2>
                    <?php $notificaciones= $a->notificaciones($misanotaciones); ?>
                    <?php if (count($notificaciones)>0){ ?>
                    <div class="container">
                        <div class="table-responsive col-md-9 col-md-offset-1">
                            <table class="table table-bordered table-hover" id="tablaAvisos">
                                <tr class="info">                    
                                    <th>Materia</th>
                                    <th>Profesor</th>
                                    <th>Dia</th>
                                    <th>Fecha</th>
                                    <th>Mensaje</th>  
                                </tr>
                                <?php foreach ($notificaciones as $hora): ?>   
                                <br>
                                <tr>     
                                    <td>
                                        <?php echo $hora->getMateria()->getnombreMateria(); ?>
                                    </td>
                                    <td>
                                        <?php echo $hora->getHorariodeConsulta()->getProfesor()->getapellido(); ?>
                                        <?php echo $hora->getHorariodeConsulta()->getProfesor()->getnombre(); ?> 
                                    </td>
                                    <td>
                                        <?php echo $hora->getHorariodeConsulta()->getdia()->getdia(); ?>
                                        <?php echo $hora->getHorariodeConsulta()->gethora(); ?>
                                    </td>
                                    <?php foreach ($hora->getAvisoProfesor() as $aviso): ?> 
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <?php echo $aviso->getfechaAvisoProfesor();
                                                echo " ";
                                                echo substr($aviso->gethoraAvisoProfesor(), 0, 5); ?>
                                        </td>
                                        <td>
                                            <?php echo $aviso->getdetalleDescripcion() ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>              
                                </tr>
                                    <?php endforeach; ?>
                            </table>
                                <?php } else{ ?>
                        </div>
                    </div>
                    <div class="container">
                        <div class="table-responsive col-md-9 col-md-offset-1">
                            <table class="table" id="tablanotificaciones">
                                <td>
                                    <?php echo "No hay notificaciones" ?>
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
    </body>
    <footer class="footer">
      <div class="container">
            <div class="col-md-12">
                <p class="text-muted text-center credit"> Copyright &copy; 2019 aHora</p> 
            </div>
      </div>
    </footer> 
</html>