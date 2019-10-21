<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
session_start();



require_once $DIR .$alumnoControlador;
require_once $DIR .$profesorControlador;
require_once $DIR .$controladorAdministrador;
$setearAula= $URL .$setearAula;
$EditarAultaAsignada= $URL .$EditarAultaAsignada;

require_once $DIR .$Aula;



if(isset($_SESSION['Materias'])){
    $idmateria=$_SESSION['Materias'];
}else{
$idmateria=$_POST['Materias'];  
$_SESSION['Materias']=$idmateria;
}

if(isset($_SESSION['profesor'])){
    $idprofesor=$_SESSION['profesor'];
}else{
$idprofesor=$_POST['profesor'];  
$_SESSION['profesor']=$idprofesor;
}


?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/>
        <script src="./../js/funciones.js" type="text/javascript"></script>
    </head>
    <body>
        <?php require './../partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>


 <?php $a = new controladorAdministrador();
 $horarios=$a->buscarHorariosParallenarEnlosSelect($idmateria,$idprofesor);
 
   ?>
       
        <h3>Horarios de Consulta</h3>
       
      
            <div>
                <table id="tablaMateriaPpal">
                    <thead>                    
                        <th>Día</th>
                        <th>Horario</th>
                        <th>Semestre</th>
                        <th>Aula</th>
                    </thead>
                    <body style="text-align: center" background = <?php echo $URL.$fondo?>>
                        

                        <?php 
                        foreach ($horarios as $horario): ?> 
                            
                      <tr>
                            <td>
                                 <?php echo $horario->getDia()->getdia(); ?>
                            </td>
                            <td>
                                <?php echo $horario->getHora(); ?>
                            </td>
                   <td>
                   <?php if($horario->getsemestre()==31){echo "Mesa 1";}elseif
                     ($horario->getsemestre()==32){echo "Mesa 2";}else{
                         echo  $horario->getsemestre();};
                   ?>
                   </td>
                   <form action=<?php echo $setearAula ?> method="POST">     
                   <td>
                            <select name="AulaAsignada"> 
                            <?php
                            $aulas=$a->BuscarAulas();
                            foreach ($aulas as $aula): ?>
                          
                     
                            <option  <?php if($horario->getfk_aula() == $aula->getid_aula()){echo("selected");}?> value=<?php echo $aula->getid_aula()?>> 
                            
                            <?php 
                            echo "Cuerpo: ".$aula->getcuerpoAula()." nivel: ".$aula->getnivelAula()." aula: ".$aula->getnumeroAula();
                            
                            ?>
                            
                            </option>
                           
                            <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                    <button type="submit" id="buttonAsistir" name="asignar" value=<?php echo $horario->getid_horarioDeConsulta()?> formaction=<?php echo $setearAula?>> asignar </button>
                    </td>    
                                </tr>
                                </form>     
                        <?php endforeach; 
                            ?>
                            
                        
                    </tbody>   
                                            
                </table>     
                <form action=<?php echo $setearAula ?> method="POST">  
                <div>  <input type="submit" value="Volver" name="Buscar" formaction=<?php echo $EditarAultaAsignada ?> /></div>    
                </form>               
            </div>
     
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>     
    </footer>  
</html>