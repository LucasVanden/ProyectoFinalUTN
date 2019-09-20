<?php
  session_start();
  session_unset();
  session_destroy();
  header('Location: /ProyectoFinalUTN/vista/login.php');
?>

