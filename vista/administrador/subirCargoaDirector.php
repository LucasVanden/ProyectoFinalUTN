<?php
session_start();
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
  }else{
    if(!in_array(13,$_SESSION['permisos'])){
        header('location: '. $URL.$login);
    }
  }  
require_once ($DIR.$conexion);
require_once ($DIR.$controladorAdministrador);
//antes de romper
$a=new controladorAdministrador();
$asignarDirector= $URL.$asignarDirector;
$eliminarDirecotr= $URL.$eliminarDirecotr;
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
        <title>aHora</title>
        <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/> 
    </head>
    <body background = <?php echo $URL.$fondo?>>
    <script src="jquery.js"></script>
        <?php require $DIR.$headera ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <div class="container" align="center">
        <br>
            <form action=<?php echo $asignarDirector ?> method="POST">
                <div class="form-group" align="center">
                    <h2 for="asignarMateriaAProfesor" class="text-primary" style="font-family:myFirstFont,garamond,serif;font-size:42px;">Cargo Director</h2>
                </div>
                <br>
                <div class="container" align="center">
                    <div class="table-responsive col-md-6 col-md-offset-2">
                        <table class="table table-bordered table-hover"id="tablaBuscar">  
                            <tr class="info">
                                <th>Profesor</th>
                                <td>
                                    <select class="browser-default custom-select" data-style="btn-primary" data-widthen="auto" name="profesor">
                                        <?php 
                                            $listaprofesores = $a->BuscarProfesor();
                                            foreach ($listaprofesores as $profesor): ?> 
                                        <option value=<?php echo "{$profesor->getid_profesor()}" ?>> <?php echo "{$profesor->getApellido()}, {$profesor->getnombre()}" ?></option>   
                                            <?php endforeach; 
                                            ?>
                                    </select>                                
                                </td>                          
                            </tr>     
                        </table>
                    </div>
                </div>
                <div class="form-group" align="center"> 
                    <button class="btn btn-success" id="buttonBuscar" value="Asignar Cargo Director" name="Asignar Cargo Director" type="submit" formaction=<?php echo $asignarDirector?> onclick=""> <b>  +  Asignar Cargo Director </b>  
                        <span class="glyphicon glyphicon-ok"></span>
                    </button>  
                </div>  
                <br>              
                    <tr>    
                <div class="container" align="center">
                    <div class="table-responsive col-md-6 col-md-offset-2">
                        <table class="table table-bordered table-hover" id="tablaBuscar">  
                            <tr class="info">
                                <th>Profesor</th>
                                <td>
                                    <select class="browser-default custom-select" data-style="btn-primary" data-widthen="auto" id="profesorBaja" name="profesorBaja">   
                                        <?php 
                                            $listaprofesores = $a->BuscarDirector();
                                            foreach ($listaprofesores as $profesor): ?> 
                                        <option value=<?php echo "{$profesor->getid_profesor()}" ?>> <?php echo "{$profesor->getApellido()}, {$profesor->getnombre()}" ?></option>   
                                            <?php endforeach; 
                                            ?>
                                    </select>                                
                                </td>                          
                            </tr>    
                        </table>
                    </div>
                </div>
                <!-- <input type="submit" value="Buscar" name="Buscar" disabled="disabled" />     -->
                <div class="form-group" align="center"> 
                    <button class="btn btn-danger" id="buttonBuscar" value="Eliminar Cargo Director" name="Eliminar Cargo Director" type="submit" formaction=<?php echo $eliminarDirecotr?> onclick=""> <b>  +  Eliminar Cargo Director </b>  
                        <span class="glyphicon glyphicon-ok"></span>
                    </button>  
                </div>               
                    <tr>                  
            </form>
        </div>
    </body>
    <footer>
        <?php require $DIR.$footer; ?>     
    </footer>  
</html>