<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);
session_start();
$con= new conexion();
$conexttion=$con->getconexion();

$idhoradeconsulta= $_POST['idhoradeconsulta'];
$mensaje= $_POST['cuerpoNotificacion'];

        
if(isset($_POST['Enviar'])){
        $fecha=getdate();

        date_default_timezone_set('America/Argentina/Mendoza');

        $mes= date('m');
        $dia= date('d');
      
        $hora= date('H');
        $min= date('i');
        $seg= date('s');

        $fechahora="{$hora}:{$min}:{$seg}.000000";
        $fechadia= "{$fecha['year']}-{$mes}-{$dia}";

            $stmt2 = $conexttion->prepare("INSERT INTO `avisoprofesor` (`id_avisoprofesor`, `fechaAvisoProfesor`,`horaAvisoProfesor`, `detalleDescripcion`, `fk_horadeconsulta`)
             VALUES (NULL, '$fechadia', '$fechahora', '$mensaje', '$idhoradeconsulta');"); 
            $stmt2->execute();
        }
        $direccion= $URL . $profesorPpal;
        header("Location: $direccion");
