<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
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
            <h2 style="align-content: center">Registrar Asistencia de Alumno a Consulta</h2>
            <form action="alumnoNotificaciones.php" method="POST">        
            <div>
                <table id="tablaMateriaDetalle" onclick="">
                    <thead>                    
                        <th>Materia</th>
                        <th>Día</th>
                        <th>Hora</th>
                        <th>Profesor</th>
                    </thead>
                    <tbody style="text-align: left">
                        <tr>
                            <td>
                                Administración Gerencial
                            </td>
                            <td>
                                Jueves
                            </td>
                            <td>
                                17:30
                            </td>
                            <td>
                                Troglia, Carlos
                            </td>
                        </tr> 
                        <tr>
                            <td>
                                Sistemas de Gestión
                            </td>
                            <td>
                                Jueves
                            </td>
                            <td>
                                17:45
                            </td>
                            <td>
                                Cortés, Lucía
                            </td>
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