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
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body background = <?php echo $URL.$fondo?>>
    <?php require $DIR.$headerasistencia ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <?php
        ?>
        <h2>Estás Dictando:</h2>
        <form action=<?php echo $asisitrAlumno?> method="POST">        
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
                        $listaHora = $a->BuscarMateriasAAsistir($idAlumno);
                        foreach ($listaHora as $Hora): ?>   


                        <?php if (null!==($Hora->getPresentismo())): ?>
                        <tr>
                            <td> 
                                <?php echo $Hora->getMateria()->getnombreMateria()?>
                                
                            </td>
                        
                            
                            <td><?php echo $Hora->getHorarioDeConsulta()->getdia()->getdia() ?></td>
                            <td><?php echo $Hora->getHorarioDeConsulta()->gethora() ?></td>
                            <td><?php echo $Hora->getHorarioDeConsulta()->getProfesor()->getNombre() ?></td>
                            <td><?php echo $Hora->getHorarioDeConsulta()->getProfesor()->getApellido() ?></td>
                            <?php ?>
                            <td>
                            <!-- nose xq no quiere recibir el id desde el boton, pero si desde el input hidden caundo en alumno ppal si anda -->
                            <input type="hidden" name="asistir" value=<?php echo $Hora->getDetalleAnotados()->getid_detalleanotados();?>>
                            <button type="submit" name="asistir2" formaction=<?php echo $asisitrAlumno?> onclick="return confirm('Marcar Horario de <?php echo $Hora->getMateria()->getnombreMateria()?>?')"> Dar Presente</button>
                            </td>
                            </tr>
                            <?php endif; ?>
                        
                        <?php endforeach; ?>
                          
                    </tbody>
                </table>
            </div>
            <br>
        </form>
    </body>
    <footer>
       <?php require $DIR.$footer; ?>          
    </footer>  
</html>