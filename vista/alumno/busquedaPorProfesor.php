<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require './../dbPFprueba.php';
require './../rutas.php';
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
            <h2 style="align-content: center">Troglia, Carlos</h2>
            <h3>Horarios de Consulta</h3>
            <form action="alumnoConfirmarAsistencia.php" method="POST">        
            <div>
                <table id="tablaBusquedaPorProfesor" onclick="">
                    <thead>
                        <th>Materia</th>
                        <th>Día</th>
                        <th>Horario</th>
                        <th>Asistir</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Administración Gerencial
                            </td>
                            <td>
                                Jueves
                            </td>                            
                            <td>
                                17:30 - 19:00
                            </td>
                            <td>
                                <button id="buttonAsistir" name="Asistir"> Asistir </button>
                            </td>
                        </tr>                        
                        <tr>
                            <td>
                                Administracion de Recursos
                            </td>
                            <td>
                                Martes
                            </td>                            
                            <td>
                                19:00 - 20:00
                            </td>
                            <td>
                                <button id="buttonAsistir" name="Asistir"> Asistir </button>
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