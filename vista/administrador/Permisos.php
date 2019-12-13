<?php
session_start();
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
  }else{
    if($_SESSION['rol'] != 4){
        header('location: '. $URL.$login);
    }
  }  
require_once ($DIR.$conexion);
require_once ($DIR.$controladorAdministrador);
$a=new controladorAdministrador();
$editarPermisos=$URL.$editarPermisos;
$permisoRol=6;
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
        <title>Permisos</title>
        <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/> 
    </head>
    <body background = <?php echo $URL.$fondo?>>
    <script src="jquery.js"></script>
        <?php require $DIR.$headera ?>
        <div class="container" align="center">
        <br>       
            <iframe width="0" height="0" border="0" name="dummyframe" id="dummyframe"></iframe>      
            <form action=<?php echo $editarPermisos ?> method="POST" target="dummyframe"> <!-- --> 
                <div class="form-group" align="center">
                    <h2 for="permisos" class="text-primary" style="font-family:myFirstFont,garamond,serif;font-size:42px;">Permisos</h2>
                </div> 
                <div id='div'>
                    <div class="container" align="center">
                        <div class="table-responsive col-md-6 col-md-offset-2">
                            <table class="table table-bordered table-hover" id="tablaBuscar">  
                                <tr class="info">
                                    <th colspan="2">Administrador</th>       
                                        <?php 
                                            $permisosActuales = $a->BuscarPermisos($permisoRol);
                                            $listaPermisos = $a->buscarNombrePrivilegios();
                                            //  echo '<pre>'; print_r($permisosActuales); echo '</pre>';
                                            foreach ($listaPermisos as $permiso): ?> 
                                    <tr>
                                        <td>
                                            <?php echo $permiso[0]?></option>   
                                        </td>
                                        <td>
                                            <?php if(in_array($permiso[1],$permisosActuales)):?>
                                            <div class="form-group" align="center"> 
                                                <button class="btn btn-danger btn-xs" value=<?php echo $permiso[1];?> name="permiso" type="submit" onclick="recargarPagina()"> <b>  -  Eliminar </b>  
                                                    <span class="glyphicon glyphicon-ok"></span>
                                                </button>  
                                            </div>
                                            <?php else:?>
                                            <div class="form-group" align="center"> 
                                                <button class="btn btn-success btn-xs" value=<?php echo $permiso[1];?> name="permiso" type="submit" onclick="recargarPagina()"> <b>  +  Agregar </b>  
                                                    <span class="glyphicon glyphicon-ok"></span>
                                                </button>  
                                            </div>
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                            <?php endforeach; ?>   
                                </tr>     
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </form> 
        </div>         
    </body>
<script>
    function recargarPagina(){
        setTimeout(function(){
            $("#div").load(" #div");
        }, 250);
    }
</script>
    <footer>
        <?php require $DIR.$footer; ?>     
    </footer>  
</html>