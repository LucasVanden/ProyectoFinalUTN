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
//antes de romper
$a=new controladorAdministrador();

$controladorbajaProfesor= $URL.$controladorbajaProfesor;
$eliminarDirecotr= $URL.$eliminarDirecotr;
$menuAltaProfesor= $URL.$menuAltaProfesor;


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
        <h2>Baja Profesor</h2>
        <form action=<?php echo $controladorbajaProfesor ?> method="POST"> <!-- -->
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
                <input id=buttonBuscar type="submit" value="Dar de Baja Profesor"
                 formaction=<?php echo $controladorbajaProfesor?> onclick="return confirm('Esta seguro que desea darlo de baja')" >
                 <div>  <input type="submit" value="Volver" name="Buscar" formaction=<?php echo $menuAltaProfesor ?> /></div>
            </div>                               
                    </form>


    <footer>
        <?php require $DIR.$footer; ?>     
    </footer>  
</html>