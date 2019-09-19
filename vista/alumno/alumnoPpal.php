<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once $DIR . '/controlador/alumnoControlador.php';
require_once $DIR . '/controlador/departamentoMaterias.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/>
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
                                    <button id="buttonBorrar" name="Eliminar" value=  <?php echo $hora->gettempiddetalle(); ?>> Eliminar </button>
                                </td>
                                </tr>
                        <?php endforeach; 
                            ?>
                           
                            
                            
                            
                          
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
                <br>
                <br>
            </div>
        </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>         
    </footer>  
</html>