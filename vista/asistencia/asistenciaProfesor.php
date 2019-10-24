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

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body background = <?php echo $URL.$fondo?>>
    <?php require $DIR.$headerpasistencia?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <?php
        ?>
        <h2>Estás Dictando:</h2>
          
            <div>
                <table align='center' class="table-mostrar" id="tablaMateria">
                    <thead>
                    <!--aca va cabecera de tabla-->
                    </thead>
                    <tbody>
                        <tr>
                            <th> Materias </th>
                        </tr>   
                        <?php 
                        $a =new Asistenciacontrolador ;
                        $listaDedicaciones = $a->buscarMateriasProfesor($idProfesor);
                        foreach ($listaDedicaciones as $dedicacion): ?>   

                      
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
                        
                            
                            <td><?php echo $hora->getHorarioDeConsulta()->getdia()->getdia() ?></td>
                            <td><?php echo $hora->getHorarioDeConsulta()->gethora() ?></td>
                            
                            <?php ?>
                            <td>
                            <!-- nose xq no quiere recibir el id desde el boton, pero si desde el input hidden caundo en alumno ppal si anda -->
                            <form action=<?php echo $asistirprofesor?> method="POST">     
                            <input type="hidden" name="idmateria" value=<?php echo $dedicacion->getMateria()->getid_materia() ?>>
                            <input type="hidden" name="asistir" value=<?php echo $hora->getid_horadeconsulta();?>>
                            <button type="submit" name"asistir2" value=<?php echo $hora->getid_horadeconsulta();?> formaction=<?php echo $asistirprofesor?> onclick="return confirm('Marcar Horario de <?php echo $dedicacion->getMateria()->getnombreMateria()?>?')"> <?php echo $nombreBoton?></button>
                            </form>
                            </td>
                            </tr>
                            <?php endif; ?>
                      
                        <?php endforeach; ?>
                        <?php endforeach; ?>
                          
                    </tbody>
                </table>
            </div>
            <br>
     
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>      
    </footer>  
</html>