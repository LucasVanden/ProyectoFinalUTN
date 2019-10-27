<?php
session_start();
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
}else{
    if(!($_SESSION['rol'] == 2 || $_SESSION['rol']==3)){
        header('location: '. $URL.$login);
    }
}
require_once $DIR . $profesorControlador;
$_SESSION['mensaje']=null;

$idusuario=$_SESSION['usuario'];
$a=new profesorControlador();
$idProfesor=$a->buscarProfesorDeUsuario($idusuario);
$_SESSION['idProfesor']=$idProfesor;
$_SESSION['nombre']=$a->idpofesoraNombre($idProfesor);
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
    <?php require $DIR.$headerp ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <?php
        $notificar= $URL . $profesorNotificarAlumno; 
        $anotados= $URL . $profesorAlumnosAnotados; 
        ?>
        <h2>Establecer Horario de Consulta:</h2>
        <form action="profesorPpal.php" method="POST">        
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
                        $a =new profesorControlador ;
                        $listaDedicaciones = $a->buscarMateriasProfesor($idProfesor);
                        foreach ($listaDedicaciones as $dedicacion): ?>   
                        <tr>
                            <td> 
                                <input type="submit" name="nombreMateriaSeleccionada" id='<?php echo $dedicacion->getid_dedicacion()?>'  value="<?php echo $dedicacion->getMateria()->getnombreMateria()?>" formaction="profesorEstablecerHorario.php" 
                            onclick=""></input>
                            </td>
                        </tr>
                        <?php endforeach; 
                            ?>
                    </tbody>
                </table>
            </div>
            <div>                
                <h2>Alumnos Anotados</h2>
                <table align='center' id="tablaAlumnosAnotados" onclick="">
                    <thead>
                        <th>Materia</th>
                        <th>Día</th>
                        <th>Hora</th>
                        <th>Cantidad</th>
                        <th>Notificar</th>
                        <th>Ver detalles</th>
                    </thead>
                   <?php 
                   $alumnosanotados = $a->alumnosAnotados($idProfesor);//<---------------------------------id session
                  ?>
                    <tbody>
                     <?php  foreach ($alumnosanotados as $hora): ?>   
                       
                     <tr>
                            <td>
                            <?php echo $hora->getMateria()->getnombreMateria() ?>
                            </td>
                            <td>
                            <?php echo $hora->getHorarioDeConsulta()->getdia()->getdia() ?>
                            </td>
                            <td>
                            <?php echo $hora->getHorarioDeConsulta()->gethora() ?>
                            </td>
                            <td>
                            <?php echo $hora->getcantidadAnotados() ?>
                            </td>
                            <td>
                                <button name="Notificaridhora" type='submit' value=<?php echo $hora->getid_horadeconsulta()?> formaction=<?php echo $notificar?> > Notificar </button>
                            </td>
                            <?php if ($hora->getcantidadAnotados()>0){ ?>
                            <td>
                            <input type='hidden' name='dia' value=<?php echo $hora->getHorarioDeConsulta()->getdia()->getdia() ?>>
                            <input type='hidden' name='hora' value=<?php echo $hora->getHorarioDeConsulta()->gethora() ?>>
                                <button name="Notificaridhora" type='submit' value=<?php echo $hora->getid_horadeconsulta()?> formaction=<?php echo $anotados?> > Ver </button>
                            </td>
                            <?php } else { 
                                echo  '<td bgcolor="Lime">';
                                echo "No anotados";
                                echo  '</td>';
                                 }; ?>

                        </tr>
                        <?php endforeach; 
                            ?>                       
                    </tbody>
                </table>
            </div>
            <div>
            <br>
            <h2>Mis Notificaciones</h2> <!-- desde aca acomodar con lo que viene-->
            <?php if ($a->hayAvisosProfesor($alumnosanotados)){ ?>
            <table  align='center' class="table-mostrar" id="tablaAvisos" onclick="" >
                <thead>                    
                    <th>Materia</th>
                    <th>Dia</th>
                    <th>Fecha</th>
                    <th>Mensaje</th>          
                </thead>
                <?php     
                    foreach ($alumnosanotados as $hora): ?>   
                <br>
                <tr>     
                    <td>
                        <?php echo $hora->getMateria()->getnombreMateria(); ?>
                    </td>
                    <td>    <?php echo $hora->getHorariodeConsulta()->getdia()->getdia(); ?>
                               <?php echo $hora->getHorariodeConsulta()->gethora(); ?>
                               </td>
             
                    <?php foreach ($hora->getAvisoProfesor() as $aviso): ?> <!-- aca mensaje del alumno-->
                <tr>    
                <td></td>
                <td>
                    <?php echo ""?> <!-- aca fecha aviso del alumno-->
                </td>
                <td>
                    <?php echo $aviso->getfechaAvisoProfesor();
                    echo " ";
                    echo substr($aviso->gethoraAvisoProfesor(), 0, 5);
                     ?> <!-- aca fecha aviso del alumno-->
                </td>
                <td>
                    <?php echo $aviso->getdetalleDescripcion() ?>
                </td>
                </tr>
                    <?php endforeach;
                    ?>
                </tr>
                    <?php endforeach; 
                    ?>
                </table>
                <?php } else { ?>
                    <table align='center' class="table-mostrar" id="tablanotificaciones" onclick="" >
                    <td>
                        <?php echo "No hay notificaciones." ?>
                    </td>
                </table> 
                    <?php }; ?>
                <br>
                <br>
                <br>
            </div>
        </form>
    </body>
    <footer>
    <?php require $DIR.$footer; ?>    
    </footer>  
</html>