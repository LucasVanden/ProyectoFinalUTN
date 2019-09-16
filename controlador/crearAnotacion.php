<?php
require_once ('./../modelo/persistencia/conexion.php');
require_once('./../vista/rutas.php');

$con= new conexion();
$conexttion=$con->getconexion();

$idhoradeconsulta= $_POST['idhora'];
$mensaje= $_POST['textarea'];
$idalumno= 1;
        
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

        echo $fechadia;
        echo $fechahora;
        $stmt = $conexttion->prepare("INSERT INTO `detalleanotados` (`id_detalleanotados`, `fechaDesdeAnotados`, `horaDetalleAnotados`, `tema`, `fk_alumno`, `fk_horadeconsulta`) 
        VALUES (NULL, '$fechadia', '$fechahora' , '$mensaje', $idalumno, $idhoradeconsulta);"); 
        $stmt->execute();
        header_remove();
        //header("Location: http://localhost:8888/PFProyect/vista/alumno/alumnoPpal.php");
      
        header("Location: $alumnoPrincipal");
        
    ?>