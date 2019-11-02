<?php
session_start();
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$loginasistencia);
}else{
    if($_SESSION['rol'] != 1){
        header('location: '. $URL.$loginasistencia);
    }
}

require_once $DIR . $AsistenciaControlador;
date_default_timezone_set('America/Argentina/Mendoza');

$idusuario=$_SESSION['usuario'];
$a=new Asistenciacontrolador();
$idAlumno=$a->buscarAlumnoDeUsuario($idusuario);
$_SESSION['idAlumno']=$idAlumno;
$asisitrAlumno=$URL.$AsistirAlumno;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0,  minimum-scale=1.0">
        <title>Asistencia Alumno</title>
        <link rel="stylesheet" href="./../css/bootstrap.min.css">   
        <link href="css/sticky-footer-navbar.css" rel="stylesheet">
    </head>
    <body background = <?php echo $URL.$fondo?>>
    <?php require $DIR.$headerasistencia ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <?php?>
        <div class="container">
            <br>
            <form action=<?php echo $asisitrAlumno?> method="POST" class="form-horizontal">        
                <div class="form-group">
                    <h2 for="anotado" class="text-primary col-md-4 col-md-offset-4"> Estás Anotado a: </h2>
                </div> 
                <div class="container">
                    <div class="table-responsive col-md-9 col-md-offset-1">
                        <table class="table table-bordered table-hover" id="tablaMateria">
                            <tr class="info">
                                <th> Materia </th>
                                <th> Día </th>
                                <th> Hora </th>
                                <th colspan="2"> Profesor </th>
                                <th>  </th>
                            </tr>   
                            <?php 
                                $a =new Asistenciacontrolador ;
                                $listaHora = $a->BuscarMateriasAAsistir($idAlumno);
                                foreach ($listaHora as $Hora): 
                            ?>   
                            <?php if (null!==($Hora->getPresentismo())): ?>
                            <tr>
                                <td> <?php echo $Hora->getMateria()->getnombreMateria()?></td>
                                <td><?php echo $Hora->getHorarioDeConsulta()->getdia()->getdia() ?></td>
                                <td><?php echo $Hora->getHorarioDeConsulta()->gethora() ?></td>
                                <td><?php echo $Hora->getHorarioDeConsulta()->getProfesor()->getNombre() ?></td>
                                <td><?php echo $Hora->getHorarioDeConsulta()->getProfesor()->getApellido() ?></td>
                                <?php?>
                                <td>
                                <!-- nose xq no quiere recibir el id desde el boton, pero si desde el input hidden caundo en alumno ppal si anda -->
                                    <div class="form-group"> 
                                        <div class="col-md-4 col-md-offset-4">
                                            <input type="hidden" name="asistir" value=<?php echo $Hora->getDetalleAnotados()->getid_detalleanotados();?>>
                                            <button class="btn btn-success btn-xs" title="Dar Presente" type="submit" name="asistir2" formaction=<?php echo $asisitrAlumno?> onclick="return confirm('Marcar Horario de <?php echo $Hora->getMateria()->getnombreMateria()?>?')"> 
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </button> 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </form>
        </div>
        <script src="./../js/jquery.js"></script>
        <script src="./../js/bootstrap.min.js"></script>
    </body>
    <footer class="footer">
      <?php require $DIR.$footer; ?>     
 </footer>
</html>