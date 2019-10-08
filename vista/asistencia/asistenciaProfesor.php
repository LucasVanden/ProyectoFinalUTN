<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once $DIR . $AsistenciaControlador;


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
        <?php require './../partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <?php
        ?>
        <h2>Estás Dictando:</h2>
        <form action=<?php echo $asistirprofesor?> method="POST">        
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
                        <tr>
                            <td> 
                                <?php echo $dedicacion->getMateria()->getnombreMateria()?>
                                
                            </td>
                        
                             <?php foreach ($listaHorariosDecosnulta as $hora): ?>  
                            <td><?php echo $hora->getHorarioDeConsulta()->getdia()->getdia() ?></td>
                            <td><?php echo $hora->getHorarioDeConsulta()->gethora() ?></td>
                            
                            <?php ?>
                            <td>
                            <!-- nose xq no quiere recibir el id desde el boton, pero si desde el input hidden caundo en alumno ppal si anda -->
                            <input type="hidden" name="asistir" value=<?php echo $hora->getid_horadeconsulta();?>>
                            <button type="submit" name"asistir2" formaction=<?php echo $asistirprofesor?>>Asistir</button>
                            </td>
                            </tr>
                        
                        <?php endforeach; ?>
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