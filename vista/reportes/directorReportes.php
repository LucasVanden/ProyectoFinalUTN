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
        <h2>Obtener Reportes sobre Horarios de Consulta:</h2>
        <form action="alumnoPpal.php" method="POST">
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF">  
                    <tr>
                        <th>Departamento</th>
                        <td>
                            <select name="Departamentos">                       
                                <option>Sistemas</option>
                                <option>Básicas</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Fecha Desde</th>
                        <td>
                            <select name="fechaDEsde">                       
                                <option>01 de Marzo</option>
                                <option>15 de Julio</option>
                            </select>
                        </td>
                    </tr>                   
                    <tr>
                        <th>Fecha Hasta</th>
                        <td>
                            <select name="fechaHasta">                       
                                <option>15 de Julio</option>
                                <option>01 de Marzo</option>                                
                            </select>
                        </td>
                    </tr>                   
                    <tr>
                        <th>Tipo de Reporte</th>
                        <td>
                            <select name="reporte">                       
                                <option>Alumnos por Materia</option>
                                <option>Materia Ranking</option>
                                <option>Alumnos por Profesor por Materia</option>
                            </select>
                        </td>
                    </tr>                  
                </table>
            </div>
            <div>
                <br>
                <input type="submit" value="Obtener" name="Obtener" disabled="disabled" />
            </div>
        </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>     
    </footer>  
</html>