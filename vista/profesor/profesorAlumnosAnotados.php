<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once $DIR . $profesorControlador;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php require './../partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
            <h2 style="align-content: center">Detalle de Alumnos Anotados</h2>
            <form action="profesorAlumnosAnotados.php" method="POST">        
            <div>
                <h2>Administración Gerencial</h2>
                
                <?php
                 $a = new Profesorcontrolador();
                 $detalles=$a->detallealumnosAnotados($_POST['Notificaridhora'])
                 ?>
                <table id="tablaAlumnosAnotadosMateria" onclick="">
                    <thead>                    
                        <th></th>
                        <th>Nombre</th>
                        <th>Legajo</th>
                        <th>Tema</th>
                    </thead>
                    <tbody style="text-align: left">
                        
                    <?php $i=0;
                     foreach ($detalles as $detalle): 
                        $i++;?>   
                        <tr>
                            <td>
                            <?php echo $i?>
                            </td>
                            <td>
                            <?php echo $detalle->getAlumno()->getnombre() ?>
                            <?php echo $detalle->getAlumno()->getapellido() ?>
                            </td>
                            <td>
                            <?php echo $detalle->getAlumno()->getlegajo() ?>
                            </td>                            
                            <td>
                            <?php echo $detalle->gettema() ?>
                            </td>                            
                        </tr>
                          <?php endforeach; 
                              ?>    

                      
                    </tbody>                    
                </table>                
            </div>
<!--            <div>
                <h2>Enviar Notificaciones</h2>
                <textarea name="cuerpoNotificacion" placeholder="Ingrese Contenido de la Notificación"rows="10" cols="80">Escribe aquí tu Notificación</textarea>
                <br>
                <br>
                <input type="submit" value="Enviar" name="Enviar" disabled="disabled" />
                <input type="submit" value="Cancelar" name="Cancelar" disabled="disabled" />
            </div>-->
        </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>   
    </footer>  
</html>