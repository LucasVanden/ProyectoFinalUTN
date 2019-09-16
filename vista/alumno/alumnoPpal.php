<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require './../dbPFprueba.php';
require './../rutas.php';
require './../../controlador/alumnoControlador.php';
require './../../controlador/departamentoMaterias.php';
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
                 $("#second-choice").load("departamentoMaterias.php?choice=" + $("#first-choice").val());
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
                            <tr>
                                <td>
                                    Administración Gerencial
                                </td>
                                <td>
                                    Carbonari, Daniela
                                </td>
                                <td>
                                    Lunes
                                </td>                            
                                <td>
                                    15:45 - 16:45
                                </td>
                                <td>
                                    <button id="buttonBorrar" name="Eliminar"> Eliminar </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Administración Gerencial
                                </td>
                                <td>
                                    Troglia, Carlos
                                </td>
                                <td>
                                    Jueves
                                </td>                            
                                <td>
                                    17:30 - 19:00
                                </td>
                                <td>
                                    <button id="buttonAsistir" name="Eliminar"> Eliminar </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Sistemas de Gestión
                                </td>
                                <td>
                                    Cortés, Lucía
                                </td>
                                <td>
                                    Jueves
                                </td>                            
                                <td>
                                    16:45 - 17:45
                                </td>
                                <td>
                                    <button id="buttonAsistir" name="Eliminar"> Eliminar </button>
                                </td>
                            </tr>
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