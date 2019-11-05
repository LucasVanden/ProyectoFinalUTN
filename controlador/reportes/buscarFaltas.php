<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR .$conexion);
require_once ($DIR. $email);
require_once ($DIR . $DetalleAnotados);
require_once ($DIR . $Alumno);
require_once ($DIR . $AnotadosEstado);
require_once ($DIR . $EstadoAnotados);
require_once ($DIR . $Asueto);
require_once ($DIR . $FechaMesa);
require_once ($DIR . $HoraDeConsulta);
require_once ($DIR . $HorarioDeConsulta);
require_once ($DIR . $Profesor);
require_once ($DIR . $Presentismo);
require_once ($DIR . $Falta);
require_once ($DIR . $Departamento);


session_start();
date_default_timezone_set('America/Argentina/Mendoza');

$fechaDesde=$_POST['fechaDesde'];
$fechaHasta=$_POST['fechaHasta'];
$Materias=$_POST['Materias'];
$departamentos=$_POST['departamentos'];

$_SESSION['fechaDesde']=$fechaDesde;
$_SESSION['Materias']=$Materias;
$_SESSION['fechaHasta']=$fechaHasta;
$_SESSION['departamentos']=$departamentos;

if($Materias=='-1'){
    $faltas=buscarFaltasDepartamento($fechaDesde,$fechaHasta,$Materias,$departamentos);
}else{
$faltas=buscarFaltas($fechaDesde,$fechaHasta,$Materias,$departamentos);
}
$_SESSION['faltasBuscadas']=$faltas;

echo $fechaDesde;
echo $fechaHasta;
echo $Materias;
echo $departamentos;
//echo '<pre>'; print_r($_SESSION["faltasBuscadas"]); echo '</pre>'; 


$direccion=$URL.$vistafaltas;
header("Location:$direccion");
echo $direccion;
function buscarFaltas($fechaDesde,$fechaHasta,$Materias,$departamentos){
    $con= new conexion();
    $conn=$con->getconexion();

        $listaFaltas=array();
        $stmt = $conn->prepare("SELECT id_falta,fechaFalta,tipo,minutos,fk_horadeconsulta,fk_materia,fk_profesor,fk_departamento FROM falta
        WHERE (fechaFalta >= '$fechaDesde' and fechaFalta <='$fechaHasta') and fk_departamento='$departamentos' and fk_materia='$Materias'" );  
        $stmt->execute();
        while($row = $stmt->fetch()) {
           $falta=new Falta();
           $falta->setfechaFalta($row['fechaFalta']);
           $falta->settipo($row['tipo']);
           $falta->setminutos($row['minutos']);

           $tempIdMateria=$row['fk_materia'];
           $tempIdProfesor=$row['fk_profesor'];
           $tempIdDepartamento=$row['fk_profesor'];

           $stmt1 = $conn->prepare("SELECT id_materia,nombreMateria FROM materia where id_materia=$tempIdMateria"); 
           $stmt1->execute();
           while($row = $stmt1->fetch()) {
                $mat = new Materia();
                $mat->setid_materia($row['id_materia']);
                $mat->setnombreMateria($row['nombreMateria']);
                $falta->setmateria($mat);
          
            }
            $stmt2 = $conn->prepare("SELECT id_departamento,nombre FROM departamento where id_departamento=$tempIdDepartamento "); 
            $stmt2->execute();
            while($row = $stmt2->fetch()) {
                $dep = new Departamento();
                $dep->setid_departamento($row['id_departamento']);
                $dep->setnombre($row['nombre']);
                $falta->setdepartamento($dep);
            }
            $stmt4 = $conn->prepare("SELECT id_profesor,apellido,nombre,legajo FROM profesor where id_profesor=$tempIdProfesor"); 
            $stmt4->execute();
            while($row = $stmt4->fetch()) {
                $prof = new Profesor();
                $prof->setlegajo($row['legajo']);
                $prof->setid_profesor($row['id_profesor']);
                $prof->setapellido($row['apellido']);
                $prof->setnombre($row['nombre']);
                $falta->setprofesor($prof);
            
            }
        
        array_push($listaFaltas,$falta);
        }
        return $listaFaltas;
}
function buscarFaltasDepartamento($fechaDesde,$fechaHasta,$Materias,$departamentos){
    $con= new conexion();
    $conn=$con->getconexion();

        $listaFaltas=array();
        $stmt = $conn->prepare("SELECT id_falta,fechaFalta,tipo,minutos,fk_horadeconsulta,fk_materia,fk_profesor,fk_departamento FROM falta
        WHERE (fechaFalta >= '$fechaDesde' and fechaFalta <='$fechaHasta') and fk_departamento='$departamentos'" );  
        $stmt->execute();
        while($row = $stmt->fetch()) {
           $falta=new Falta();
           $falta->setfechaFalta($row['fechaFalta']);
           $falta->settipo($row['tipo']);
           $falta->setminutos($row['minutos']);

           $tempIdMateria=$row['fk_materia'];
           $tempIdProfesor=$row['fk_profesor'];
           $tempIdDepartamento=$row['fk_profesor'];

           $stmt1 = $conn->prepare("SELECT id_materia,nombreMateria FROM materia where id_materia=$tempIdMateria"); 
           $stmt1->execute();
           while($row = $stmt1->fetch()) {
                $mat = new Materia();
                $mat->setid_materia($row['id_materia']);
                $mat->setnombreMateria($row['nombreMateria']);
                $falta->setmateria($mat);
          
            }
            $stmt2 = $conn->prepare("SELECT id_departamento,nombre FROM departamento where id_departamento=$tempIdDepartamento "); 
            $stmt2->execute();
            while($row = $stmt2->fetch()) {
                $dep = new Departamento();
                $dep->setid_departamento($row['id_departamento']);
                $dep->setnombre($row['nombre']);
                $falta->setdepartamento($dep);
            }
            $stmt4 = $conn->prepare("SELECT id_profesor,apellido,nombre,legajo FROM profesor where id_profesor=$tempIdProfesor"); 
            $stmt4->execute();
            while($row = $stmt4->fetch()) {
                $prof = new Profesor();
                $prof->setlegajo($row['legajo']);
                $prof->setid_profesor($row['id_profesor']);
                $prof->setapellido($row['apellido']);
                $prof->setnombre($row['nombre']);
                $falta->setprofesor($prof);
            
            }
        
        array_push($listaFaltas,$falta);
        }
        return $listaFaltas;
}
?>