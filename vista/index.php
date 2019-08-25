<?php
session_start();
require 'dbPFprueba.php';
if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, ususrio, contrasenia FROM usuarios WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $user = null;
    if (count($results) > 0) {
        $user = $results;
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
        <link href="assert/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php require 'partials/header.php' ?>
        <?php if (!empty($user)): ?>
            <br> Welcome. <?= $user['usuario']; ?>
            <br>Usted se ha logueado correctamente
            <a href="logout.php">
                Logout
            </a>
        <?php else: ?>
            <h1> Bienvenido </h1>
            <br><a href="login.php">Ingrese</a>
            <br>
            <br><a href="registrarse.php"> Registrese</a>
            <br>
            <br><a href="http://www.frm.utn.edu.ar/index.php"> Regresar a la Web de la Regional</a>
        <?php endif; ?>
    </body>
    <footer>
        <?php require 'partials/footer.php'; ?>
    </footer>
</html>
