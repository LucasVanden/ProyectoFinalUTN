<?php 
session_start();
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';

$_SESSION["demonio"]=(!$_SESSION["demonio"]);

$direccion= $URL . $dem;
header("Location: $direccion");
?>