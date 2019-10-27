<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);

session_start();


$profesor=$_POST['profesor'];
    date_default_timezone_set('America/Argentina/Mendoza');

    $con= new conexion();
    $conn=$con->getconexion();

    $stmt = $conn->prepare("UPDATE usuario SET fk_perfil = '3' WHERE fk_profesor=$profesor "); 
    $stmt->execute();


$direccion= $URL . $subirCargoaDirector;
header("Location: $direccion");
?>