<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);
require_once ($DIR. $email);
session_start();
$con= new conexion();
$conexttion=$con->getconexion();

$idhoradeconsulta= $_POST['idhoradeconsulta'];
$idProfesor=$_SESSION['idProfesor'];
$mensaje= $_POST['cuerpoNotificacion'];
$materia=$_POST['materia'];

        
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

            enviarMailAAlumnosAnotados($idhoradeconsulta,$idprofesor);
        }
        $direccion= $URL . $profesorPpal;
        header("Location: $direccion");

        
function enviarMailAAlumnosAnotados($idhoradeconsulta,$idprofesor){
    $listaDetalles=array();
    $conn = $con->getconexion();
    $stmt = $conn->prepare("SELECT id_detalleanotados,fk_alumno FROM detalleanotados where fk_horadeconsulta=$idhora"); 
    $stmt->execute();
        while($row = $stmt->fetch()) {
                $detalle = new Detalleanotados();
                $detalle->setid_detalleanotados($row['id_detalleanotados']);
                $iddetalle=$row['id_detalleanotados'];
                $tempAlumno=$row['fk_alumno'];
                $Estados=array();

                $stmt = $conn->prepare("SELECT id_alumno,legajo,apellido,nombre,email,fechaNacimientoAlumno,telefonoAlumno FROM alumno where id_alumno=$id"); 
                $stmt->execute();
                while($row = $stmt->fetch()) {
                    $alum = new Alumno();
                    $alum->setid_alumno($row['id_alumno']);
                    $alum->setlegajo($row['legajo']);
                    $alum->setapellido($row['apellido']);
                    $alum->setnombre($row['nombre']);
                    $alum->setemail($row['email']);
                    $alum->setfechaNacimientoAlumno($row['fechaNacimientoAlumno']);
                    $alum->settelefonoAlumno($row['telefonoAlumno']);
                    $detalle->setAlumno($alum);
                }

                $stmt2 = $conn->prepare("SELECT id_anotadoestado,fechaAnotadosEstado,horaAnotadosEstado,fk_estadoanotados FROM anotadosestado where fk_detalleanotados=$iddetalle "); 
                $stmt2->execute();
                while($row = $stmt2->fetch()) {
                    $anotado = new AnotadosEstado();
                    $anotado->setid_anotadosEstado($row['id_anotadoestado']);
                    $anotado->setfechaAnotadosEstado($row['fechaAnotadosEstado']);
                    $anotado->sethoraAnotadosEstado($row['horaAnotadosEstado']);
                    $idnombreestado=$row['fk_estadoanotados'];

                    $stmt3 = $conn->prepare("SELECT nombreEstado,id_estadoanotados FROM estadoanotados where id_estadoanotados=$idnombreestado "); 
                    $stmt3->execute();
                    while($row = $stmt3->fetch()) {
                        $estado = new EstadoAnotados();
                        $estado->setnombreEstado($row['nombreEstado']);
                        $estado->setid_estadoanotados($row['id_estadoanotados']);
                        $anotado->setEstadoAnotados($estado);       
                    }
                
                        array_push($Estados,$anotado);
                }
                $detalle->setAnotadosEstado($Estados);
                array_push($listaDetalles,$detalle);
        }
        $listaEmails=array();
    foreach ($listaDetalles as $detalle) {
        $listaEstado=$detalle->getAnotadosEstado();
        if  ( end($listaEstado)->getEstadoAnotados()->getnombreEstado()=="Anotado") {
           array_push($listaEmails,$detalle->getAlumno()->getemail());
        }    
    }
   
    $stmt = $conn->prepare("SELECT nombre,apellido FROM profesor where id_profesor=$idprofesor"); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $nombre=$row['nombre'];
        $apellido=$row['apellido'];
    }

    $body= "Aviso del profesor {$nombre} {$apellido} de la materia {$materia} : {$mensaje}";
    enviaremail($listaEmails,$body);
}