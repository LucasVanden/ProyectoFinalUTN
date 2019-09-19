<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once $DIR . '/controlador/alumnoControlador.php';
require_once $DIR . '/controlador/departamentoMaterias.php';
$eliminar= $URL . '/controlador/eliminarAnotacion.php';
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
        
<!-- <script>
    $(document).ready(function() {

        $('#example tr').click(function() {
            var href = $(this).find("a").attr("href");
            if (href) {
                window.location = href;
            }
        });

    });
</script> -->

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
                        $alumno = $a->buscarAlumno(1);
                        foreach ($alumno[0]->getMateria() as $materia): ?> 
                      
                            <tr>
                            <td><a href='busquedaPorMateria.php?id=".$id["id"].'><?php echo $materia->getnombreMateria(); ?></a></td>
                           <td> <input name="nombreMateriaSeleccionada" id=<?php echo $materia->getid_materia()?> type="submit" value="<?php echo $materia->getnombreMateria()?>" formaction="busquedaPorMateria.php" 
                            onclick="buscarHorariosporMateria(id)"></td>
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
                 $("#second-choice").load("http://localhost:8888/ProyectoFinalUTN/controlador/departamentoMaterias.php?choice=" + $("#first-choice").val());
                });</script>

                            </td>
                        </tr>                   
                </table>
            </div>
            <div>
                <br>
                <!-- <input type="submit" value="Buscar" name="Buscar" disabled="disabled" />     -->
                <input id=buttonBuscar type="submit" value="Buscar Profesor" formaction="busquedaPorProfesor.php" onclick="buscarHorarios(Materias,profesor)">
                <input type="submit" value="Buscar Materia" formaction="busquedaPorMateria.php">
            </div>
            <div>                     
                <h2>Mis Anotaciones</h2>
                <div>
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
                        $misanotaciones = $a->MisAnotaciones(1);
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
                           
                          
                            
 <!-- BOTON BONITO   
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Desea eliminarse de la conulsta title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>  -->
<!-- BOTON BONITO  --> 
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
            <div>
                <br>
                <h2>Mis Notificaciones</h2>
                <h5>Usted no tiene Mensajes Nuevos</h5>
                <br>
                <?php     
                        foreach ($misanotaciones as $hora): ?> 
                      <tr>
                           
                                <td>
                                    <?php echo $hora->getMateria()->getnombreMateria(); ?>
                                </td>
                                <td>
                                    <?php echo $hora->getHorariodeConsulta()->getProfesor()->getapellido(); ?>
                                    <?php echo $hora->getHorariodeConsulta()->getProfesor()->getnombre(); ?> :
                                </td>
                               <?php foreach ($hora->getAvisoProfesor() as $aviso): ?> 
                               
                                <td>
                                    <?php echo $aviso->getdetalleDescripcion() ?>
                                </td>
                                <td>
                                    <?php echo $aviso->getfechaAvisoProfesor() ?>
                                </td>
                                <?php endforeach; 
                            ?>
                               
                                </tr>
                        <?php endforeach; 
                            ?>
                <br>
                <br>
            </div>
        </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>         
    </footer>  
</html>