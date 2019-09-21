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
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/>
        
<!-- IMPORTAR BOOSTRAP -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

    </head>
    <body>
        <?php require './../partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        
        <script src="jquery.js"></script>
        <script src="./../js/funciones.js" type="text/javascript"></script>


        <h2>Estás cursando:</h2>
        <form action="alumnoPpal.php" method="POST">        
            <div>
                <table class="table-mostrar" id="tablaMateria">
                    <thead>
                        <!--aca va cabecera de tabla-->
                    </thead>
                    <tbody>
                        <tr>
                            <th> Materias </th>
                        </tr>
                        <?php 
                        $a =new AlumnoControlador ;
                        $idusuario=$_SESSION['usuario'];
                        $idalumno= $a->buscarAlumnoDeUsuario($idusuario);
                        $alumno = $a->buscarAlumno($idalumno);
                        $_SESSION['idalumno']=$idalumno;
                        foreach ($alumno[0]->getMateria() as $materia): ?> 
                      
                            <tr>
                           <td> <input name="nombreMateriaSeleccionada" id=<?php echo $materia->getid_materia()?> type="submit" value="<?php echo $materia->getnombreMateria()?>" formaction="busquedaPorMateria.php" 
                            onclick=""></td>
                             </tr>
                        <?php endforeach; 
                            ?>
                    </tbody>
                </table>
            </div>
           
            <div>
                <br>
                <h2>Buscar Otra Consulta</h2>
                <table class="table-buscar" id="tablaBuscar" style="border-color: #FFFFFF">  
                    <tr>
                        <th>Por Profesor</th>
                        <th colspan="2">Por Materia</th>
                    </tr>
                        <tr>
                            <td>
                                <h5>Seleccione Profesor</h5>
                            </td>
                            <td colspan="2">
                                <h5>Seleccione Departamento despúes Materia</h5>
                            </td>
                        <tr>
                            <td>
                                <select name="profesor">
                               
                                <?php 
                               $listaprofesores = $a->BuscarProfesor();
                               foreach ($listaprofesores as $profesor): ?> 
                                <option value=<?php echo "{$profesor->getid_profesor()}" ?>> <?php echo "{$profesor->getApellido()}, {$profesor->getnombre()}" ?></option>   
                                <?php endforeach; 
                               ?>

                                </select>                                
                            </td>
                            <td>                                
                                <select id="first-choice" name="departamentos">

                                       <?php 
                               $listadepartamento = $a->BuscarDepartamento();
                               foreach ($listadepartamento as $departamento): ?> 
                                <option value=<?php echo "{$departamento->getid_departamento()}" ?>> <?php echo "{$departamento->getnombre()}" ?></option>   
                                <?php endforeach; 
                               ?>
                                </select>
                            </td>
                            <td>                       
                                <select id="second-choice" name="Materias">
                                </select> 
                                <script>
                 $("#first-choice").change(function() {
                 $("#second-choice").load("<?php echo $depatartamentomaterias.'?choice='?>"+ $("#first-choice").val());
                }).change();</script>

                            </td>
                        </tr>                   
                </table>
            </div>
            <div>
                <br>
                <!-- <input type="submit" value="Buscar" name="Buscar" disabled="disabled" />     -->
                <input id=buttonBuscar type="submit" value="Buscar Profesor" formaction="busquedaPorProfesor.php" onclick="">
                <input type="submit" value="Buscar Materia" formaction="busquedaPorMateria.php">
            </div>
            <div>                     
                <h2>Mis Anotaciones</h2>
                <div>
                <?php $misanotaciones = $a->MisAnotaciones($idalumno);?>
                
              
                    <?php if (count($misanotaciones)>0){ ?>
                    <table class="table-mostrar" id="tablaAnotaciones" onclick="" title="tablaAnotaciones">
                        <thead>                    
                            <th>Materia</th>
                            <th>Profesor</th>
                            <th>Día</th>
                            <th>Horario</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody style="text-align: left">
                        
                        <?php     
                        foreach ($misanotaciones as $hora): ?> 
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
                                </td>
                                <td>
                                    <?php echo $hora->getHorariodeConsulta()->gethora(); ?>
                                </td>
                                <td>
                                    <button type="submit" id="buttonBorrar" name="idDetalle" value=  <?php echo $hora->gettempiddetalle(); ?> formaction=<?php echo $eliminar?> onclick="return confirm('Esta seguro que desea eliminarse')"> Eliminar </button>
                                </td>
                                </tr>
                        <?php endforeach; 
                            ?>
                        </tbody>
                    </table>
                <?php } else{ ?>
                    <table class="table-mostrar" id="tablaAnotaciones" onclick="" title="tablaAnotaciones">
                    <td>
                                    <?php echo "No esta anotado" ?>
                        </td>
                        </table> 
                        <?php }; ?>
                    <br>
                </div>
            </div>
            <div>
                <br>
                <h2>Mis Notificaciones</h2>
                <!-- <h5>Usted no tiene Mensajes Nuevos</h5> -->
                <?php $notificaciones= $a->notificaciones($misanotaciones); ?>
                <?php if (count($notificaciones)>0){ ?>
                <table class="table-mostrar" id="tablaAvisos" onclick="" title="tablaAvisos">
                <thead>                    
                            <th>Materia</th>
                            <th>Profesor</th>
                            <th>Fecha</th>
                            <th>Mensaje</th>
                          
                        </thead>
                <?php     
                        foreach ($notificaciones as $hora): ?>   
                           <br>
                      <tr>     
                                <td>
                                    <?php echo $hora->getMateria()->getnombreMateria(); ?>
                                </td>
                                <td>
                                    <?php echo $hora->getHorariodeConsulta()->getProfesor()->getapellido(); ?>
                                    <?php echo $hora->getHorariodeConsulta()->getProfesor()->getnombre(); ?> 
                                </td>
                               <?php foreach ($hora->getAvisoProfesor() as $aviso): ?> 
                               <td>
                                    <?php echo $aviso->getfechaAvisoProfesor() ?>
                                </td>
                                <td>
                                    <?php echo $aviso->getdetalleDescripcion() ?>
                                </td>
                            
                                <?php endforeach; 
                            ?>
                               
                                </tr>
                        <?php endforeach; 
                            ?>
                </table>
                <?php } else{ ?>
                    <table class="table-mostrar" id="tablanotificaciones" onclick="" title="tablanotificaiones">
                    <td>
                                    <?php echo "No hay notificaciones" ?>
                        </td>
                        </table> 
                        <?php }; ?>
                <br>
                <br>
                <input type="submit" value="Agregar Materia" formaction="alumnoAgregarMateria.php">
                <br>
            </div>
            <!-- metodo vandenbosch para ver el fondo -->
            <div>
            <td>.</td><br>
            <td>.</td>
            </div>
             <!-- metodo vandenbosch para ver el fondo -->
        </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>         
    </footer>  
</html>