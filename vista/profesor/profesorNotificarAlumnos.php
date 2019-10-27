<?php
session_start();

require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
}else{
    if(!($_SESSION['rol'] == 2 || $_SESSION['rol']==3)){
        header('location: '. $URL.$login);
    }
}
require_once $DIR . $profesorControlador;
$profesorNotificar=$URL.$profesorCrearNotificacion;
$idhora=$_POST['Notificaridhora'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body  background = <?php echo $URL.$fondo?>>
        <?php require './../partials/headerp.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
         <form action=<?php echo $profesorNotificar?> method="POST">  
         <?php
                 $a = new Profesorcontrolador();
                 $nombMateria=$a->buscarMateriaDeHoradeconsulta($idhora);
                 ?>
            <h1>Enviar Notificación a Alumnos de <?php echo $nombMateria ?> </h1>            
            <div>
                <textarea name="cuerpoNotificacion" placeholder="Ingrese Contenido de la Notificación" rows="10" cols="80"></textarea>
                <br>
                <br>
                <input type='hidden' name='idhoradeconsulta' value = <?php echo $idhora?>>
                <input type='hidden' name='materia' value = <?php echo $nombMateria?>>
                <input type="submit" value="Enviar" name="Enviar"  />
                <input type="submit" value="Cancelar" name="Cancelar"  />
            </div>
        </form>
    </body>
    <footer>
    <?php require $DIR.$footer; ?>   
    </footer>  
</html>