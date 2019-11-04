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
    }
}

require_once $DIR .$alumnoControlador;
$a = new alumnoControlador();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
        <title>Búsqueda Materias</title>
        <link rel="stylesheet" href="./../css/bootstrap.min.css">
        <script src="./../js/funciones.js" type="text/javascript"></script>
    </head>
    <body background = <?php echo $URL.$fondo?> style="padding-top: 70px;">
        <?php require $DIR.$header ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <?php 
        if (isset($_POST['nombreMateriaSeleccionada'])){
            $id = $a->buscarIDdeNombreMateria($_POST["nombreMateriaSeleccionada"]);
        }else{
            $id=$_POST['Materias'];
        }
        //echo $a->buscarIDdeNombreMateria("ProyectoFinal");
        ?>
        <?php $mat = $a->buscarHorariosDeConsultaDeMateriaporhoraconsulta($id);?>
        <?php if(count($mat->getHoraDeConsulta())>0): ?>
<!-- <input id="pikachu" type="button" value="" name="test"> </input>
<script> 
 document.getElementById("pikachu").value = localStorage.getItem("id_materia");
 </script> -->
        <div class="container">
            <br>            
            <form action="alumnoConfirmarAsistencia.php" method="POST" class="form-horizontal" >        
                <div class="form-group">
                    <h2 class="text-primary col-md-7 col-md-offset-3"><?php echo $mat->getnombreMateria(); ?></h2>
                </div>
                <div class="form-group">
                    <h3 for="consulta" class="text-primary col-md-4 col-md-offset-4">Horarios de Consulta</h3>
                </div>
                <div class="container">
                    <div class="table-responsive col-md-9 col-md-offset-1">
                        <table class="table table-bordered table-hover" id="tablaMateriaPpal">
                            <tr class="info">                    
                                <th>Día</th>
                                <th>Horario</th>
                                <th>Profesor</th>
                                <th colspan="2">Aula</th>
                            </tr>                        
                            <?php foreach ($mat->getHoraDeConsulta() as $horadeconsulta): ?> 
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
                                        echo  '<td bgcolor="(25, 0, 100, 0)">';
                                        echo "Anotado";
                                        echo  '</td>';
                                    }else{
                                        echo  '<td>';
                                        echo  '<button class="btn btn-primary btn-xs" title="Asistir a Consulta" id="buttonAsistir" name="Asistir" value='; 
                                        echo $horadeconsulta->getid_horadeconsulta();
                                        echo '> <span class="glyphicon glyphicon-plus"></span> </button>';
                                        echo  '</td>';
                                    }
                                    ?>
                                    <!-- <button id="buttonAsistir" name="Asistir" value=<?php echo $horadeconsulta->getid_horadeconsulta();?> onclick=<?php echo $dialog?>> Asistir </button> -->
                            </tr>
                            <?php endforeach; ?>  
                        </table>                
                    </div>
                </div>
            </form>
        <?php else:?>
            <div class="container">
                <div class="table-responsive col-md-4 col-md-offset-4">
                    <table class="table table-bordered table-hover" id="tablanotificaciones">
                        <td>
                            <?php echo "No hay Horario de consulta Cargados"?>
                        </td>
                    </table> 
                </div>
            </div>
        </div>    
        <?php endif?>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
    <footer class="footer">
      <?php require $DIR.$footer; ?>     
 </footer>
</html>