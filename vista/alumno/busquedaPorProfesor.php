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
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body background = <?php echo $URL.$fondo?>>
        <?php require './../partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>

        <?php  $a=new AlumnoControlador();
        $listaHorarios= $a->buscarHorariosDeConsultaporProfesor($_POST["profesor"])?>

            <h2 style="align-content: center"><?php echo $listaHorarios[0]->getapellido();echo ' '; echo $listaHorarios[0]->getnombre()?></h2>
            <h3>Horarios de Consulta</h3>
            
            <form action="alumnoConfirmarAsistencia.php" method="POST">      
           
            <div>
                <table id="tablaBusquedaPorProfesor" onclick="">
                    <thead>
                        <th>Materia</th>
                        <th>Día</th>
                        <th>Horario</th>
                        <th>Aula</th>
                        <th>Asistir</th>
                    </thead>
                    <tbody>
                       
                         <?php  
                            foreach ($listaHorarios[1] as $horadeconsulta): ?> 
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
                            
                                    <!-- <button id="buttonAsistir" name="Asistir" value=<?php echo $horadeconsulta->getid_horadeconsulta();?> onclick="returnid_materia()"> Asistir </button> -->
                                
                            </tr>   
                            <?php endforeach; 
                                ?>        
                                
                    </tbody>                    
                </table>                
            </div>
        </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>          
    </footer>  
</html>