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
$idhora=$_POST['Notificaridhora'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href=<?php echo $URL.$style?> rel="stylesheet" type="text/css"/>
    </head>
    <body background = <?php echo $URL.$fondo?>>
    <?php require $DIR.$headerp ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
            <h2 style="align-content: center">Detalle de Alumnos Anotados</h2>
            <form action="profesorAlumnosAnotados.php" method="POST">        
            <div>
            <?php
                 $a = new Profesorcontrolador();
                 $detalles=$a->detallealumnosAnotados($idhora);
                 $nombMateria=$a->buscarMateriaDeHoradeconsulta($idhora);

                 ?>
                <h2><?php echo $nombMateria;
                 echo " ";
                 echo $_POST['dia'];
                 echo " ";
                 echo $_POST['hora'];
                ?></h2>
                
             
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
    <?php require $DIR.$footer; ?>    
    </footer>  
</html>