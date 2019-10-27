<?php
session_start();

require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR.$controladorAdministrador);
//antes de romper
$a=new controladorAdministrador();

$asignarDirector= $URL.$asignarDirector;
$eliminarDirecotr= $URL.$eliminarDirecotr;

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
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h2>Cargo Director</h2>
        <form action=<?php echo $asignarDirector ?> method="POST"> <!-- -->
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF">  
                <tr>
                <th>Profesor</th>
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
                           

                    </tr>     

                </table>
            </div>
            <div>
                <br>
                <!-- <input type="submit" value="Buscar" name="Buscar" disabled="disabled" />     -->
                <input id=buttonBuscar type="submit" value="Asignar Cargo Director" formaction=<?php echo $asignarDirector?> onclick="">
            </div>                
        <tr>    

                    <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF">  
                <tr>
                <th>Profesor</th>
                            <td>
                                <select id="profesorBaja" name="profesorBaja">
                               
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
            <div>
                <br>
                <!-- <input type="submit" value="Buscar" name="Buscar" disabled="disabled" />     -->
                <input id=buttonBuscar type="submit" value="Eliminar Cargo Director" formaction=<?php echo $eliminarDirecotr?> onclick="">
            </div>                
        <tr>                  
                    </form>


    <footer>
        <?php require $DIR.$footer; ?>     
    </footer>  
</html>