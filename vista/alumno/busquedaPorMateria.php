<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
session_start();
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
}else{
    if($_SESSION['rol'] != 1){
        header('location: '. $URL.$login);
    }
}

if (!isset($_POST['Materias'])){
    if(!isset($_POST['nombreMateriaSeleccionada'])){
    $direccion= $URL . $alumnoPpal;
    header("Location: $direccion");
    }}

require_once $DIR .$alumnoControlador;
$a = new alumnoControlador();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
        <script src="./../js/funciones.js" type="text/javascript"></script>
    </head>
    <body>
    <?php require $DIR.$header ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>


 <?php 
 
 if (isset($_POST['nombreMateriaSeleccionada'])){
  $id = $a->buscarIDdeNombreMateria($_POST["nombreMateriaSeleccionada"]);}
  else{
      $id=$_POST['Materias'];
  }
//echo $a->buscarIDdeNombreMateria("ProyectoFinal");
 
   ?>
        <?php

         $mat = $a->buscarHorariosDeConsultaDeMateriaporhoraconsulta($id);
        ?>

        <h2><?php echo $mat->getnombreMateria(); ?></h2>
        <h3>Horarios de Consulta</h3>
       
 

<!-- <input id="pikachu" type="button" value="" name="test"> </input>
<script> 
 
 document.getElementById("pikachu").value = localStorage.getItem("id_materia");
 </script> -->

<?php if(count($mat->getHoraDeConsulta())>0): ?>
        <form action="alumnoConfirmarAsistencia.php" method="POST">        
            <div>
                <table id="tablaMateriaPpal">
                    <thead>                    
                        <th>Día</th>
                        <th>Horario</th>
                        <th>Profesor</th>
                        <th>Aula</th>
                        <th>Asistir</th>
                    </thead>
                    <body style="text-align: center" background = <?php echo $URL.$fondo?>>
                        

                        <?php 
                        foreach ($mat->getHoraDeConsulta() as $horadeconsulta): ?> 
                      <tr>
                            <td>
                                 <?php echo $horadeconsulta->getHorarioDeConsulta()->getDia()->getdia(); ?>
                                 <?php echo date("d-m-Y", strtotime($horadeconsulta->getfechaHastaAnotados())); ?>
                            </td>
                            <td>
                                <?php echo $horadeconsulta->getHorarioDeConsulta()->getHora(); ?>
                            </td>
                            <td>
                                <?php echo $horadeconsulta->getHorarioDeConsulta()->getProfesor()->getnombre(); ?>
                                <?php echo $horadeconsulta->getHorarioDeConsulta()->getProfesor()->getapellido(); ?>
                            </td>
                            <td>
                                <?php echo $horadeconsulta->getHorarioDeConsulta()->getfk_aula()->getcuerpoAula();
                                echo " nivel: ";
                                echo $horadeconsulta->getHorarioDeConsulta()->getfk_aula()->getnivelAula();
                                echo " aula: ";
                                echo $horadeconsulta->getHorarioDeConsulta()->getfk_aula()->getnumeroAula(); ?>
                            </td>
                           
                            <?php
                            $idHora=$horadeconsulta->getid_horadeconsulta();
                            $idusuario=$_SESSION['usuario'];
                            $idalumno= $a->buscarAlumnoDeUsuario($idusuario);
                            //aca ingresar del login
                            if ($a->AnotadoRepetido($idHora,$idalumno)){
                              echo  '<td bgcolor="Lime">';
                             echo "Anotado";
                              echo  '</td>';
                            }else{
                               echo  '<td>';
                               echo  '<button id="buttonAsistir" name="Asistir" value='; 
                               echo $horadeconsulta->getid_horadeconsulta();
                                echo '> Asistir </button>';
                               echo  '</td>';
                            }
                            ?>
                                <!-- <button id="buttonAsistir" name="Asistir" value=<?php echo $horadeconsulta->getid_horadeconsulta();?> onclick=<?php echo $dialog?>> Asistir </button> -->
                           
                                </tr>
                        <?php endforeach; 
                            ?>
                        
                        
                    </tbody>                    
                </table>                
            </div>
        </form>
        <?php else:?>
<table align='center' class="table-mostrar" id="tablanotificaciones" onclick="" >
                    <td>
                                    <?php echo "No hay Horario de consulta Cargados" ?>
                        </td>
                        </table> 
            
<?php endif?>
    </body>
    <footer>
       <?php require $DIR.$footer; ?>         
    </footer>  
</html>