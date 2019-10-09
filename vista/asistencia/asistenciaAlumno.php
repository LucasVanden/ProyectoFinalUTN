<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
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
        <?php require './../partials/header.php' ?>
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


                        <?php if ($Hora->getPresentismo()): ?>
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
                            <button type="submit" name"asistir2" formaction=<?php echo $asisitrAlumno?> onclick="return confirm('Marcar Horario de <?php echo $Hora->getMateria()->getnombreMateria()?>?')"> Dar Presente</button>
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
        <?php require './../partials/footer.php'; ?>      
    </footer>  
</html>