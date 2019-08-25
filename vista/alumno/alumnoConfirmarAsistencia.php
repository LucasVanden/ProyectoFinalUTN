<?php
session_start();
if (isset($_SESSION['usuario_id'])) {
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
        <script src="funciones.js" type="text/javascript"></script>
    </head>
    <body>
        <?php require './../partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h1>Confirmar Asistencia</h1>
        <form action="alumnoPpal.php" method="POST">
        
            <textarea name="textarea" rows="10" cols="50">Ingrese su tema (opcional)</textarea>
            <br>
            <br>
            <input type="button" value="Confirmar" onclick="confirmarasistencia()">
            <input type="button" value="Cancelar" onclick="self.location.href=<?php echo $alumnoPrincipal?>"/>
        </form>
    </body>
    <footer>
        <?php require './../partials/footer.php'; ?>      
    </footer>  
</html>
