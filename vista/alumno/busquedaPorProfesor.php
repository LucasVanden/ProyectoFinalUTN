<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
session_start();
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
}else{
    if($_SESSION['rol'] != 1){
        header('location: '. $URL.$login);
    }
}

require_once $DIR .$alumnoControlador;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimum-scale=1.0">
        <title>Búsqueda Profesor</title>        
        <link rel="stylesheet" href="./../css/bootstrap.min.css">
        <link href="css/sticky-footer-navbar.css" rel="stylesheet">
    </head>
    <body background = <?php echo $URL.$fondo?>>
    <?php require $DIR.$header ?>
    <?php if (!empty($message)): ?>
        <p> <?= $message ?></p>
    <?php endif; ?>

    <?php  
    $a=new AlumnoControlador();
    $listaHorarios= $a->buscarHorariosDeConsultaporProfesor($_POST["profesor"])?>
        <div class="container">
            <br>
            <form action="alumnoConfirmarAsistencia.php" method="POST" class="form-horizontal">  
                <div class="form-group">
                    <h2 for="profesor" class="text-primary col-md-4 col-md-offset-5"> <?php echo $listaHorarios[0]->getapellido();echo ', '; echo $listaHorarios[0]->getnombre()?> </h2>
                </div>
                <div class="form-group">
                    <h3 for="horarioProfesor" class="text-primary col-md-4 col-md-offset-5"> Horarios de Consulta: </h3>
                </div>
                <div class="container">
                    <div class="table-responsive col-md-6 col-md-offset-3">
                        <table class="table table-bordered table-hover" id="tablaBusquedaPorProfesor">
                            <tr class="info">
                                <th>Materia</th>
                                <th>Día</th>
                                <th>Horario</th>
                                <th>Aula</th>
                                <th></th>
                            </tr>                       
                            <?php foreach ($listaHorarios[1] as $horadeconsulta): ?> 
                            <tr>
                                <td>
                                    <?php echo $horadeconsulta->getMateria()->getnombreMateria() ?>
                                </td>
                                <td>
                                    <?php echo $horadeconsulta->getHorarioDeConsulta()->getdia()->getdia(); ?>
                                </td>
                                <td>
                                    <?php echo $horadeconsulta->getHorarioDeConsulta()->getHora(); ?>
                                </td>
                                <td>
                                    <?php 
                                    echo $horadeconsulta->getHorarioDeConsulta()->getfk_aula()->getcuerpoAula();
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
                                        echo  '<button class="btn btn-primary btn-xs" title="Asistir a Consulta" id="buttonAsistir" name="Asistir" value='; 
                                        echo $horadeconsulta->getid_horadeconsulta();
                                        echo '> <span class="glyphicon glyphicon-plus"></span> </button>';
                                        echo  '</td>';
                                    }
                                    ?>
                                        <!-- Esto hace falta o se puede borrar??? -->
                                        <!-- <button id="buttonAsistir" name="Asistir" value=<?php echo $horadeconsulta->getid_horadeconsulta();?> onclick="returnid_materia()"> Asistir </button> -->
                                    
                            </tr>   
                            <?php endforeach; ?>                  
                        </table>                
                    </div>
                </div>
            </form>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
    <footer class="footer">
      <div class="container">
            <div class="col-md-12">
                <p class="text-muted text-center credit"> Copyright &copy; 2019 aHora</p> 
            </div>
      </div>
    </footer> 
</html>