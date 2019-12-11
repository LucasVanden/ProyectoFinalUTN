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

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
 
    </head>
    <body background = <?php echo $URL.$fondo?>>
    <script src="jquery.js"></script>
        <?php require $DIR.$headera ?>
        <h2>Permisos</h2>
       
        <iframe width="0" height="0" border="0" name="dummyframe" id="dummyframe"></iframe> 
        
          
            <form action=<?php echo $editarPermisos ?> method="POST" target="dummyframe"> <!-- --> 
            <div id='div'>
                <table align="center" id="tablaBuscar" style="border-color: #FFFFFF">  
                    <tr>
                    <th>Profesor</th>       
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
                           
                            <button name="permiso" value=<?php echo $permiso[1];?> style="background-color:red" onclick="recargarPagina()">Eliminar</button>
                        <?php else:?>
                            <button name="permiso" value=<?php echo $permiso[1];?>  style="background-color:green" onclick="recargarPagina()">Agregar</button>
                        <?php endif;?>
                        </td>
                       

                    </tr>
                        <?php endforeach; ?>   
                    </tr>     
                </table>
                </div>
                </form>
         
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