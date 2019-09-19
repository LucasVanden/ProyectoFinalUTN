<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR . '/modelo/persistencia/conexion.php');

$con= new conexion();
$conexttion=$con->getconexion();
      
    $detalle=$_POST["idDetalle"];

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

        $stmt = $conexttion->prepare("INSERT INTO `anotadosestado` (`id_anotadoestado`, `fechaAnotadosEstado`, `horaAnotadosEstado`, `fk_detalleanotados`, `fk_estadoanotados`) 
        VALUES (NULL, '$fechadia', '$fechahora' , '$detalle', 2);"); 
        $stmt->execute();

        header_remove();
        //header("Location: http://localhost:8888/PFProyect/vista/alumno/alumnoPpal.php");
      
        header("Location: $alumnoPrincipal");
        
    ?>