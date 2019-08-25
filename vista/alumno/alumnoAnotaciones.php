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
            <h2 style="align-content: center">Detalle de Mis Anotaciones</h2>
            <form action="anotaciones.php" method="POST">        
            <div>
                <table id="tablaMateriaDetalle" onclick="">
                    <thead>                    
                        <th>Materia</th>
                        <th>Profesor</th>
                        <th>Día</th>
                        <th>Horario</th>
                        <th>Tema</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody style="text-align: left">
                        <tr>
                            <td>
                                Administración Gerencial
                            </td>
                            <td>
                                Carbonari, Daniela
                            </td>
                            <td>
                                Lunes
                            </td>                            
                            <td>
                                15:45 - 16:45
                            </td>
                            <td>                            
                                <input name="tema" placeholder="Opcional Indique Tema">
                            </td>
                            <td>
                                <button id="buttonBorrar" name="Eliminar"> Eliminar </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Administración Gerencial
                            </td>
                            <td>
                                Troglia, Carlos
                            </td>
                            <td>
                                Jueves
                            </td>                            
                            <td>
                                17:30 - 19:00
                            </td>
                            <td>                            
                                <input name="tema" placeholder="Opcional Indique Tema">
                            </td>
                            <td>
                                <button id="buttonAsistir" name="Eliminar"> Eliminar </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Sistemas de Gestión
                            </td>
                            <td>
                                Cortés, Lucía
                            </td>
                            <td>
                                Jueves
                            </td>                            
                            <td>
                                16:45 - 17:45
                            </td>
                            <td>                            
                                <input name="tema" placeholder="Opcional Indique Tema">
                            </td>
                            <td>
                                <button id="buttonAsistir" name="Eliminar"> Eliminar </button>
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