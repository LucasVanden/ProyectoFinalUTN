<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}

require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once $DIR .'/controlador/alumnoControlador.php'
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


 <?php $a = new alumnoControlador();
 
 if (isset($_POST['nombreMateriaSeleccionada'])){
  $id = $a->buscarIDdeNombreMateria($_POST["nombreMateriaSeleccionada"]);}
  else{
      $id=$_POST['Materias'];
  }
//echo $a->buscarIDdeNombreMateria("ProyectoFinal");
 
   ?>
        <?php
         $a =new AlumnoControlador ;
         $mat = $a->buscarHorariosDeConsultaDeMateriaporhoraconsulta($id);
        ?>

        <h2><?php echo $mat->getnombreMateria(); ?></h2>
        <h3>Horarios de Consulta</h3>
       
 

<!-- <input id="pikachu" type="button" value="" name="test"> </input>
<script> 
 
 document.getElementById("pikachu").value = localStorage.getItem("id_materia");
 </script> -->


        <form action="alumnoConfirmarAsistencia.php" method="POST">        
            <div>
                <table id="tablaMateriaPpal">
                    <thead>                    
                        <th>Día</th>
                        <th>Horario</th>
                        <th>Profesor</th>
                        <th>Asistir</th>
                    </thead>
                    <tbody style="text-align: left">
                        <tr>

                        <?php 
                        // $a =new AlumnoControlador ;
                        // $mat = $a->buscarHorariosDeConsultaDeMateria(1);
                        foreach ($mat->getHoraDeConsulta() as $horadeconsulta): ?> 
                      
                            <td>
                                 <?php echo $horadeconsulta->getHorarioDeConsulta()->getDia()->getdia(); ?>
                            </td>
                            <td>
                                <?php echo $horadeconsulta->getHorarioDeConsulta()->getHora(); ?>
                            </td>
                            <td>
                                <?php echo $horadeconsulta->getHorarioDeConsulta()->getProfesor()->getnombre(); ?>
                                <?php echo $horadeconsulta->getHorarioDeConsulta()->getProfesor()->getapellido(); ?>
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
                           

                        <?php endforeach; 
                            ?>
                        
                        </tr>
                    </tbody>                    
                </table>                
            </div>
        </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>     
    </footer>  
</html>