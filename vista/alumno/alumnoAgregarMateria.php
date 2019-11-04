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

$agregarmat=$URL.$AgregarMateriaAlumno;
$eleminarmat=$URL.$EliminarMateriaAlumno;
$buscarMateriasdeDepartamentodeAlumno= $URL.$buscarMateriasdeDepartamentodeAlumno;

$OpctionSeleccionadaDepartamento=2;
if(isset( $_SESSION['departamentos'])){
    $OpctionSeleccionadaDepartamento= $_SESSION['departamentos'];
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
        <title>Agregar Materia</title>
        <link rel="stylesheet" href="./../css/bootstrap.min.css">
    </head>
    <body background = <?php echo $URL.$fondo?> style="padding-top: 70px;">
    <?php require $DIR.$header ?>
    <?php if (!empty($message)): ?>
    <p> <?= $message ?></p>
    <?php endif; ?>
        
        <!--ver si el sigte script se usa sino borrarlo-->
        <script src="jquery.js"></script>
        <script src="./../js/funciones.js" type="text/javascript"></script>
        <?php 
        $a =new AlumnoControlador ;
        $idusuario=$_SESSION['usuario'];
        $idalumno= $a->buscarAlumnoDeUsuario($idusuario);
        $_SESSION['idalumno']=$idalumno;
        ?> 
        <div class="container">
            <br>
            <form action=<?php echo $agregarmat?> method="POST" class="form-horizontal">  
                <div class="form-group">
                    <h2 for="agregar" class="text-primary col-md-4 col-md-offset-5"> Agregar Materias </h2>
                </div> 
                <div class="container">
                    <div class="table-responsive col-md-5 col-md-offset-4">
                        <table class="table table-bordered table-hover" id="tablaBuscar"> 
                            <tr class="info">
                                <th>Departamento</th>
                                <th colspan="2">Materia</th>
                            </tr>
                                <td>                                
                                    <select class="mdb-select md-form" id="first-choice" name="departamentos" data-widthen="auto">
                                    <?php 
                                        $listadepartamento = $a->BuscarDepartamento();
                                        foreach ($listadepartamento as $departamento): ?> 
                                        <option  <?php if($departamento->getid_departamento() == $OpctionSeleccionadaDepartamento){echo("selected");}?> value=<?php echo "{$departamento->getid_departamento()}" ?>> <?php echo "{$departamento->getnombre()}" ?></option>   
                                    <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>                       
                                    <select class="mdb-select md-form" id="second-choice" name="Materias" data-widthen="auto">
                                    </select> 
                                    <script>
                                        $("#first-choice").change(function() {
                                            $("#second-choice").load("<?php echo $buscarMateriasdeDepartamentodeAlumno.'?choice=';?>"+ $("#first-choice").val());
                                        }).change();</script>
                                </td>
                            </tr>                   
                        </table>
                    </div> 
                </div>
                <div class="container">
                    <div class="form-group"> 
                        <div class="col-md-4 col-md-offset-4">
                            <button class="btn btn-primary" type="submit" formaction=<?php echo $agregarmat?>> Agregar Materia 
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>                   
                        </div>                     
                    </div>
                </div>
                <div class="container">
                    <br>
                    <div class="form-group">
                        <h2 for="eliminarse" class="text-primary col-md-4 col-md-offset-4">Eliminarse de Materia</h2>
                    </div>
                    <div class="container">
                        <div class="table-responsive col-md-4 col-md-offset-4">
                            <table class="table table-bordered table-hover" id="tablaMateria">
                                <tr class="info">
                                    <th colspan="2"> Materias </th>
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
                                        <button class="btn btn-warning btn-xs" title="Eliminar Materia" type="submit" id="buttonBorrar" name="nombreMateriaSeleccionada" value=<?php echo $materia->getid_materia(); ?> formaction=<?php echo $eleminarmat?> onclick="return confirm('Esta seguro que desea eliminar <?php echo $materia->getnombreMateria()?>')">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>                        
                            </table>
                            <br> <br>
                        </div>
                    </div>
                </div>
            </form> 
        </div>
        <script src="./../js/jquery.js"></script>
        <script src="./../js/bootstrap.min.js"></script>
    </body>
    <footer class="footer">
      <?php require $DIR.$footer; ?>     
 </footer>
</html>