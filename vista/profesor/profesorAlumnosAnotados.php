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
            <h2 style="align-content: center">Detalle de Alumnos Anotados</h2>
            <form action="profesorAlumnosAnotados.php" method="POST">        
            <div>
                <h2>Administración Gerencial</h2>
                <table id="tablaAlumnosAnotadosMateria" onclick="">
                    <thead>                    
                        <th></th>
                        <th>Nombre</th>
                        <th>Legajo</th>
                        <th>Tema</th>
                    </thead>
                    <tbody style="text-align: left">
                        <tr>
                            <td>1</td>
                            <td>Porte, Gastón</td>
                            <td>37184</td>                            
                            <td>Indicadores</td>                            
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Pereyra, Albana</td>
                            <td>34891</td>                            
                            <td></td>                            
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Van Den Bosch, Lucas</td>
                            <td>35821</td>                            
                            <td>Diferencia entre Puesta en Marcha - Prueba Piloto</td>                            
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Morales, María Alicia</td>
                            <td>26142</td>                            
                            <td></td>                            
                        </tr>
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