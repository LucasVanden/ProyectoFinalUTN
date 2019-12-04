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
require_once ($DIR.$ReportesControlador);

$Menu= $URL.$AsuetoMenu;
$altaProfesor=$URL.$altaProfesor;
$asignarMateriaAProfesor= $URL.$asignarMateriaAProfesor;
$AsuetosFeriado= $URL.$asutosFeriado;
$bajaMateriaProfesor= $URL.$bajaMateriaProfesor;
$bajaProfesor= $URL.$bajaProfesor;

$_SESSION['comprobacion']=null;
$_SESSION['fechasBuscadas']=null;
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
        <h2>Menu Profesor</h2>
        <form action=<?php echo $Menu ?> method="POST"> <!-- -->
            <div>
                <table align='center' class="table-mostrar" id="tablaBuscar" style="border-color: #FFFFFF">  
             
                    <tr>
                       
                        <td>
                        <div>  <input type="submit" value="Alta Profesor" name="Obtener" formaction=<?php echo $altaProfesor ?>  /></div>
                        </td>
                        <td>   <div>  <input type="submit" value="Asignar Materia a Profesor" name="Obtener" formaction=<?php echo $asignarMateriaAProfesor ?> /></div></td>
                
                        <td>   <div>  <input type="submit" value="Asignar Horarios de Cursado" name="Obtener" formaction=<?php echo $bajaMateriaProfesor ?> /></div></td>
                        <td>   <div>  <input type="submit" value="Baja Profesor" name="Obtener" formaction=<?php echo $bajaProfesor ?> /></div></td>
            

                    </tr>  
</table>         
</div>        
                    </form>


    <footer>
        <?php require $DIR.$footer; ?>     
    </footer>  
</html>