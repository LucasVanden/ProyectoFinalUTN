<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: /PFProyect');
    footer('Location: /PFProyect');
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
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <h1 style="text-align: center;"> ”Usted no es un Alumno”</h1>               
                                <input type="submit" value="Aceptar" name="Aceptar" />
                            </td>                               
                        </tr>
                    </tbody>
                </table>
            </form>
    </body>
    <footer>
        <?php require 'partials/footer.php'; ?>      
    </footer>
</html>