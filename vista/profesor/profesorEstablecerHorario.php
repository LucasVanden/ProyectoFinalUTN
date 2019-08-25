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
        <h2>Establecer Horario de Consulta:</h2>
        <form action="alumnoPpal.php" method="POST">
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF">  
                    <tr>
                        <th>Nombre</th>
                        <td>
                            Administración de Recursos
<!--                            <select name="Materias">                       
                                <option>Administración de Recursos</option>
                                <option>Administración Gerencial</option>
                            </select> -->
                        </td>
                    </tr>
                    <tr>
                        <th>Dedicación</th>
                        <td>
                            Simple
                        </td>
                    </tr>                   
                    <tr>
                        <th>Día</th>
                        <td>
                            <select name="Dias">                       
                                <option>Lunes</option>
                                <option>Martes</option>
                                <option>Miércoles</option>
                                <option>Jueves</option>
                                <option>Viernes</option>
                            </select>
                        </td>
                    </tr>                   
                    <tr>
                        <th>Horario</th>                        
                        <td>
                            <select name="Horarios">                       
                                <option>8:00</option>
                                <option>8:15</option>
                            </select>
                        </td>
                    </tr>                   
                </table>
            </div>
            <div>
                <br>
                <input type="submit" value="Establecer" name="Establecer" disabled="disabled" />
            </div>
        </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>   
    </footer>  
</html>