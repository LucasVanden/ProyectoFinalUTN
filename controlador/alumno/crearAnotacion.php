<?php
// Importar rutas, dependencias
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);
require_once ($DIR. $email);

// Levantar sesión de usuario y establecer conexión a la base de datos
session_start();
$con= new conexion();
$conexttion=$con->getconexion();

// Leer datos ingresados desde la interfaz
$idhoradeconsulta= $_POST['idhora'];
$mensaje= $_POST['textarea'];
$idalumno= $_SESSION['idalumno'];

// Recuperar Fecha y hora
        date_default_timezone_set('America/Argentina/Mendoza');
        $fecha=getdate();

        $mes= date('m');
        $dia= date('d');
      
        $hora= date('H');
        $min= date('i');
        $seg= date('s');

// Concatenar Datos y armar Fecha y Hora
        $fechahora="{$hora}:{$min}:{$seg}.000000";
        $fechadia= "{$fecha['year']}-{$mes}-{$dia}";


        $idDetalleExistente=null;
        $idnextdetalle=0;

// Buscar las anotaciones del alumno logueado
        $stmt = $conexttion->prepare("SELECT id_detalleanotados FROM detalleanotados where fk_alumno=$idalumno AND fk_horadeconsulta=$idhoradeconsulta"); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
        $idDetalleExistente=$row['id_detalleanotados'];
        }

// Si existe anotación sobreescribe el mensaje
        if(isset($idDetalleExistente)){
            $idnextdetalle=$idDetalleExistente;
            $stmt2 = $conexttion->prepare("UPDATE detalleanotados SET tema = '$mensaje' WHERE id_detalleanotados=$idDetalleExistente"); 
            $stmt2->execute();
            
// Sino existe, crea el detalle de la anotación
        }else{        
        $stmt = $conexttion->prepare("SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'consultasfrm' AND TABLE_NAME = 'detalleanotados'"); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $idnextdetalle=($row['AUTO_INCREMENT']);}
        $stmt = $conexttion->prepare("INSERT INTO `detalleanotados` (`id_detalleanotados`, `fechaDesdeAnotados`, `horaDetalleAnotados`, `tema`, `fk_alumno`, `fk_horadeconsulta`) 
        VALUES ('$idnextdetalle', '$fechadia', '$fechahora' , '$mensaje', $idalumno, $idhoradeconsulta);"); 
        $stmt->execute();
        }

// Asigna el estado igual a anotado
        $stmt = $conexttion->prepare("INSERT INTO `anotadosestado` (`id_anotadoestado`, `fechaAnotadosEstado`, `horaAnotadosEstado`, `fk_detalleanotados`, `fk_estadoanotados`) 
        VALUES (NULL, '$fechadia', '$fechahora' , '$idnextdetalle', 1);"); 
        $stmt->execute();

// Incrementa en uno la cantidad de anotados
        $stmt3 = $conexttion->prepare("UPDATE horadeconsulta SET cantidadAnotados = cantidadAnotados +1  WHERE id_horadeconsulta=$idhoradeconsulta"); 
        $stmt3->execute();

// Preparar mail
        $idprofesor=null;
        $idmateria=null;
        $idhorario=null;
        $stmt = $conexttion->prepare("SELECT fk_profesor,fk_materia,fk_horariodeconsulta FROM horadeconsulta WHERE id_horadeconsulta = $idhoradeconsulta"); 
        $stmt->execute();

        // Buscar mail y datos de la consulta del Profesor
        while($row = $stmt->fetch()) {
            $idprofesor=($row['fk_profesor']);
            $idmateria=($row['fk_materia']);
            $idhorario=($row['fk_horariodeconsulta']);
        }
        $emailprofesor=null;
        $stmt = $conexttion->prepare("SELECT email FROM profesor WHERE id_profesor = $idprofesor"); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $emailprofesor=($row['email']);
        }
         $nombreMateria=null;
         $stmt = $conexttion->prepare("SELECT nombreMateria FROM materia WHERE id_materia = $idmateria"); 
         $stmt->execute();
         while($row = $stmt->fetch()) {
                $nombreMateria=($row['nombreMateria']);
        }
        $hora=null;
        $dia=null;
        $stmt = $conexttion->prepare("SELECT fk_dia,hora FROM horariodeconsulta WHERE id_horariodeconsulta = $idhorario"); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
               $hora=($row['hora']);
               $iddia=($row['fk_dia']);
            echo "acacacaca_$iddia";
               $stmtx = $conexttion->prepare("SELECT dia FROM dia WHERE id_dia = '$iddia'"); 
               $stmtx->execute();
               while($row = $stmtx->fetch()) {
               $dia=$row['dia'];
               }
       }
       // Busca nombre del Alumno
       $alumapellido=null;
       $alumnombre=null;
        $stmt = $conexttion->prepare("SELECT legajo,apellido,nombre FROM alumno where id_alumno=$idalumno"); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
                $alumapellido=($row['apellido']);
                $alumnombre=($row['nombre']);
    }

// Crea texto del cuerpo del mail con los datos buscados
        $body="$alumapellido $alumnombre se ha anotado a la consulta de $nombreMateria del dia $dia a las $hora";
        $emails=array();
        array_push($emails,$emailprofesor);
        
        // Envia mail al Profesor
        $err=enviaremail($emails,$body);
        $direccion = $URL.$alumnoPpal;
        header_remove();
        header("Location: $direccion");
    ?>