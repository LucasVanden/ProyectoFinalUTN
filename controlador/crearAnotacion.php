<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);
session_start();
$con= new conexion();
$conexttion=$con->getconexion();

$idhoradeconsulta= $_POST['idhora'];
$mensaje= $_POST['textarea'];
$idalumno= $_SESSION['idalumno'];
        
       echo $idhoradeconsulta;
       echo $mensaje;
       echo $idalumno;
       

        $fecha=getdate();

        date_default_timezone_set('America/Argentina/Mendoza');

        $mes= date('m');
        $dia= date('d');
      
        $hora= date('H');
        $min= date('i');
        $seg= date('s');

        $fechahora="{$hora}:{$min}:{$seg}.000000";

       // $fechahora="{$fecha['hours']}:{$fecha['minutes']}:{$fecha['seconds']}.000000";
        $fechadia= "{$fecha['year']}-{$mes}-{$dia}";
       
        $idnextdetalle=0;
        $stmt = $conexttion->prepare("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'consultasfrm' AND TABLE_NAME = 'detalleanotados'"); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $idnextdetalle=($row['AUTO_INCREMENT']);}
        
        $stmt = $conexttion->prepare("INSERT INTO `detalleanotados` (`id_detalleanotados`, `fechaDesdeAnotados`, `horaDetalleAnotados`, `tema`, `fk_alumno`, `fk_horadeconsulta`) 
        VALUES ('$idnextdetalle', '$fechadia', '$fechahora' , '$mensaje', $idalumno, $idhoradeconsulta);"); 
        $stmt->execute();

        $stmt = $conexttion->prepare("INSERT INTO `anotadosestado` (`id_anotadoestado`, `fechaAnotadosEstado`, `horaAnotadosEstado`, `fk_detalleanotados`, `fk_estadoanotados`) 
        VALUES (NULL, '$fechadia', '$fechahora' , '$idnextdetalle', 1);"); 
        $stmt->execute();
$direccion = $URL.$alumnoPpal;
        header_remove();
        header("Location: $direccion");
        
    ?>