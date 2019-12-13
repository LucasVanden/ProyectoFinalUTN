<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
session_start();
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
  }else{
    if(!in_array(5,$_SESSION['permisos'])){
        header('location: '. $URL.$login);
    }
  } 
require_once $DIR . $alumnoControlador;
require_once $DIR . $departamentoMaterias;
require_once $DIR . $controladorAdministrador;
$buscarDepartamentosconel1erovacio= $URL.$buscarDepartamentosconel1erovacio;
$buscarProfesoresDeMateriaSeleccionada= $URL.$buscarProfesoresDeMateriaSeleccionada;
$SeleccionEditarAulaAsignada=$URL.$SeleccionEditarAulaAsignada;
$_SESSION['Materias']=null;
$_SESSION['profesor']=null;
$a =new controladorAdministrador();
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0,  minimum-scale=1.0">
        <title>Editar Aula Asignada</title>
        <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>        
    </head>
    <body background = <?php echo $URL.$fondo?>>
    <?php require $DIR.$headera ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>    
        <script src="jquery.js"></script>
        <script src="./../js/funciones.js" type="text/javascript"></script>
        <div class="container" align="center">
        <br>
            <form action="EditarAulaAsignada.php" method="POST"> 
                <div class="form-group" align="center">
                    <h2 for="asignarMateriaAProfesor" class="text-primary" style="font-family:myFirstFont,garamond,serif;font-size:42px;">Editar Aula Asignada</h2>
                </div>  
                <div class="container" align="center">
                    <div class="table-responsive col-md-10 col-md-offset-2">
                        <table class="table table-bordered table-hover" id="tablaBuscar">  
                            <tr class="info">
                                <th>Departamento</th>
                                <th>Materia</th>
                                <th>Profesor</th>
                            </tr>                      
                                <td>                                
                                    <select class="browser-default custom-select" data-style="btn-primary" data-widthen="auto" id="first-choice" name="departamentos">
                                        <?php 
                                            $listadepartamento = $a->BuscarDepartamento();
                                            foreach ($listadepartamento as $departamento): ?> 
                                        <option value=<?php echo "{$departamento->getid_departamento()}" ?>> <?php echo "{$departamento->getnombre()}" ?></option>   
                                            <?php endforeach; 
                                            ?>
                                    </select>
                                </td>
                                <td>                       
                                    <select class="browser-default custom-select" data-style="btn-primary" data-widthen="auto" id="second-choice" name="Materias">
                                    </select> 
                                    <script>
                                        $("#first-choice").change(function() {
                                            $("#second-choice").load("<?php echo $buscarDepartamentosconel1erovacio.'?choice='?>"+ $("#first-choice").val());
                                        }).change();
                                    </script>
                                </td>
                                <td>
                                    <select class="browser-default custom-select" data-style="btn-primary" data-widthen="auto" id="profesor-choice" name="profesor">
                                    </select>                                
                                    <script>
                                        $("#second-choice").change(function() {
                                            $("#profesor-choice").load("<?php echo $buscarProfesoresDeMateriaSeleccionada.'?choice='?>"+ $("#second-choice").val());
                                        }).change();
                                    </script>
                                </td>
                            </tr>                   
                        </table>
                    </div>
                </div>
                <br>
                <div class="form-group" align="center"> 
                    <button class="btn btn-success" id="buttonBuscar" value="Aceptar" name="ButtonProfesor" type="submit" formaction=<?php echo $SeleccionEditarAulaAsignada?>> <b>  +  Aceptar </b>  
                        <span class="glyphicon glyphicon-ok"></span>
                    </button>  
                </div>  
            </form>
        </div>
    </body>
    <footer>
    <?php require $DIR.$footer; ?>           
    </footer>  
</html>