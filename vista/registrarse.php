<?php
require 'dbPFprueba.php';

$message = '';
if (!empty($_POST['usuario']) && !empty($_POST['contrasenia'])) {
    $sql = "INSERT INTO users (usuario, contrasenia) VALUES (:usuario, :contrasenia)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $_POST['usuario']);
    $password = password_hash($_POST['contrasenia'], PASSWORD_BCRYPT);
    $stmt->bindParam(':contrasenia', $password);
    if ($stmt->execute()) {
        $message = 'Usuario creado correctamente';
    } else {
        $message = 'Usuario no creado';
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
            <form>
                <div>
                <h1 style="text-align: center;">Nuevo Sistema de Consultas</h1>
                <h3>¿Cómo generar su cuenta?</h3>
                <p>La primera vez para generar su cuenta, deberá acceder a Autogestión:
                <p><a href="https://sysacad.frm.utn.edu.ar">https://sysacad.frm.utn.edu.ar</a>
                <br>
                <br>
                <br>
                <p>Para crear la cuenta:</p>
                <p style="text-align: left">1) Ingresar sus datos de acceso a Autogestión.
                <br>2) Hacer click en el botón de <b>Registrarse</b>.
                <br>3) Luego de generada la cuenta podrá acceder, con los <b>mismos datos de acceso a Autogestión</b>.
                </div>
            </form>
    </body>
    <footer class="footer">
      <?php require $DIR.$footer; ?>     
 </footer> 
</html>