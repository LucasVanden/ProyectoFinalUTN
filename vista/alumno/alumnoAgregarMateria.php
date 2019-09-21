<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';

session_start();
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.'/vista/login.php');
}else{
    if($_SESSION['rol'] != 1){
        header('location: '. $URL.'/vista/login.php');
    }
}

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
        

    </head>
    <body>
        <?php require './../partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        
        <script src="jquery.js"></script>
        <script src="./../js/funciones.js" type="text/javascript"></script>



                     
                        <?php 
                        $a =new AlumnoControlador ;
                        $idusuario=$_SESSION['usuario'];
                        $idalumno= $a->buscarAlumnoDeUsuario($idusuario);
                        $_SESSION['idalumno']=$idalumno;
                        $agregarmat=$URL.'/controlador/AgregarMateriaAlumno.php';
                        $eleminarmat=$URL.'/controlador/EliminarMateriaAlumno.php';

                         ?>
         
           
            <div>
                <br>
                <h2>Agregar Materias</h2>
                <form action=<?php echo $agregarmat?> method="POST">   
                <table class="table-buscar" id="tablaBuscar" style="border-color: #FFFFFF">  
                    <tr>
                        <th>Departamento</th>
                        <th colspan="2">Materia</th>
                    </tr>
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
                 $("#second-choice").load("<?php echo $URL.'/controlador/departamentoMaterias.php?choice='?>"+ $("#first-choice").val());
                }).change();</script>

                            </td>
                        </tr>                   
                </table>
            </div>
            <div>
                <br>

                <input type="submit" value="Agergar Materia" formaction=<?php echo $agregarmat?>>
            </div>




 <table class="table-mostrar" id="tablaMateria">
                    <thead>
                     <h2> Elimnarse de Materia</h2>
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
                           <td> <?php echo $materia->getnombreMateria()?> </td>
                           <td>
                            <button type="submit" id="buttonBorrar" name="nombreMateriaSeleccionada" value=  <?php echo $materia->getid_materia(); ?> formaction=<?php echo $eleminarmat?> onclick="return confirm('Esta seguro que desea eliminar <?php echo $materia->getnombreMateria()?>')"> Eliminar </button>
                             </td>
                             </tr>
                        <?php endforeach; 
                            ?>
                    </tbody>
                </table>

        </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>         
    </footer>  
</html>