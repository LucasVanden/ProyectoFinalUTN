<?php
session_start();
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$loginasistencia);
}else{
    if($_SESSION['rol'] != 2){
        header('location: '. $URL.$loginasistencia);
    }
}
require_once $DIR . $AsistenciaControlador;
date_default_timezone_set('America/Argentina/Mendoza');

$idusuario=$_SESSION['usuario'];
$a=new Asistenciacontrolador();
$idProfesor=$a->buscarProfesorDeUsuario($idusuario);
$_SESSION['idProfesor']=$idProfesor;

$asistirprofesor=$URL.$AsistirProfesor;

?>

<style>
        @font-face {
  font-family: myFirstFont;
  src: url(./../SnowHut.ttf);
}
</style>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0,  minimum-scale=1.0">
        <title>Asistencia Profesor</title>
        <link rel="stylesheet" href="./../css/bootstrap.min.css">  
    </head>
    <body background = <?php echo $URL.$fondo?> style="padding-top: 70px;">
    <?php require $DIR.$headerpasistencia?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <?php
        ?>
        <div class="container"> 
            <br>
            <form action=<?php echo $asistirprofesor?> method="POST" class="form-horizontal">
                <div class="form-group" align="center">
                    <h2 for="cursando" class="text-primary" style="font-family:myFirstFont,garamond,serif;font-size:42px;"> Estás Dictando: </h2>
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
                                $listaDedicaciones = $a->buscarMateriasProfesor($idProfesor);
                                foreach ($listaDedicaciones as $dedicacion): 
                            ?>   
                            <?php $listaHorariosDecosnulta=$a->buscarHorasConsulta($idProfesor,$dedicacion->getMateria()->getid_materia()) ?>
                            <input type="hidden" name="idmateria" value=<?php echo $dedicacion->getMateria()->getid_materia() ?>>
                            <?php foreach ($listaHorariosDecosnulta as $hora): ?>  
<!-- SI no anda la asistencia profesor fue aca -->

                        <!--  < ?php if ($hora->getHorarioDeConsulta()->getdia()->getid_dia()==date("N")): ?> -->
                        <?php if ($hora->getfechaHastaAnotados()==date("Y-m-d")): ?>
<!-- hasta aca -->
                        <?php $nombreBoton="Marcar Ingreso";
                        if($a->tienePresentismo($hora->getid_horadeconsulta())){
                            $nombreBoton="Marcar Egreso";
                        }
                        ?>
                            <tr>
                                <td> 
                                    <?php echo $dedicacion->getMateria()->getnombreMateria()?>                                
                                </td>                       
                                <td>
                                    <?php echo $hora->getHorarioDeConsulta()->getdia()->getdia() ?>
                                </td>
                                <td>
                                    <?php echo $hora->getHorarioDeConsulta()->gethora() ?>
                                </td>
                                <?php?>
                                <td>
                                <!-- nose xq no quiere recibir el id desde el boton, pero si desde el input hidden caundo en alumno ppal si anda -->
                                    <div class="form-group"> 
                                        <div class="col-md-4 col-md-offset-4">
                                            <input type="hidden" name="idmateria" value=<?php echo $dedicacion->getMateria()->getid_materia() ?>>
                                            <input type="hidden" name="asistir" value=<?php echo $hora->getid_horadeconsulta();?>>
                                            <button class="btn btn-success" title="Dar Presente" type="submit" name"asistir2" value=<?php echo $hora->getid_horadeconsulta();?> formaction=<?php echo $asistirprofesor?> onclick="return confirm('Marcar Horario de <?php echo $dedicacion->getMateria()->getnombreMateria()?>?')"> <?php echo $nombreBoton?>
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </button> 
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>                      
                            <?php endforeach; ?>
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