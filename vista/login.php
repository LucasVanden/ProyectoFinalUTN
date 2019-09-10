<?php
session_start();
if (isset($_SESSION['id_usuario'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
}
require 'dbPFprueba.php';
if (!empty($_POST['usuario']) && !empty($_POST['contrasenia'])) {
    $records = $conn->prepare('SELECT id_usuario, usuario, contraseña FROM usuario WHERE usuario = :usuario');
    $records->bindParam(':usuario', $_POST['usuario']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $message = '';
    if (count($results) > 0 && password_verify($_POST['contrasenia'], $results['contrasenia'])) {
        $_SESSION['user_id'] = $results['id'];
        header("Location: /PFProyect");
        footer('Location: /PFProyect');
    } else {
        $message = 'Usuario y/o contraseñas inválidos.-';
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="assert/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php require 'partials/header.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h1>Login</h1>
        <form action="login.php" method="POST">
            Nombre de Usuario <input name="usuario" type="text" placeholder="Ingrese Usuario" required="">
            Contraseña <input name="contrasenia" type="password" placeholder="Ingrese Contraseña" required="">
            <div class="send-button">
                <input type="submit" value="Ingresar">
            </div>
            <a href="recuperarContraseña.php">Olvidó su contraseña?</a>
        </form>
    </body>
    <footer>
        <?php require 'partials/footer.php'; ?>      
    </footer>  
</html>
