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
        <script src="./../js/funciones.js" type="text/javascript"></script>
    </head>
    <body>
        <?php require './../partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h2>Administración Gerencial</h2>
        <h3>Horarios de Consulta</h3>
        <form action="alumnoConfirmarAsistencia.php" method="POST">        
            <div>
                <table id="tablaMateriaPpal">
                    <thead>                    
                        <th>Día</th>
                        <th>Horario</th>
                        <th>Profesor</th>
                        <th>Asistir</th>
                    </thead>
                    <tbody style="text-align: left">
                        <tr>
                            <td>
                                Lunes
                            </td>
                            <td>
                                15:45 - 16:45
                            </td>
                            <td>
                                Carbonari, Daniela
                            </td>
                            <td>
                                <button id="buttonAsistir" name="Asistir" onclick="asistirconsulta()"> Asistir </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Jueves
                            </td>
                            <td>
                                17:30 - 19:00
                            </td>
                            <td>
                                Troglia, Carlos
                            </td>
                            <td>
                                <button id="buttonAsistir" name="Asistir" onclick="asistirconsulta()"> Asistir </button>
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