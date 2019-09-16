<?php
require_once ('../../modelo/persistencia/conexion.php');
require_once ('../../modelo/Alumno.php');
require_once ('../../modelo/Materia.php');
//quiza separado en otro controlador
require_once ('../../modelo/HorarioDeConsulta.php');
require_once ('../../modelo/Profesor.php');
require_once ('../../modelo/HoraDeConsulta.php');
require_once ('../../modelo/Departamento.php');

class AlumnoControlador extends conexion
{

function buscarAlumno($id){
	$conn = $this->getconexion();

	$stmt = $conn->prepare("SELECT id_alumno,legajo,apellido,nombre,email,fechaNacimientoAlumno,telefonoAlumno FROM alumno where id_alumno=$id"); 
    $stmt->execute();
	$ListaAlumno=array();
    while($row = $stmt->fetch()) {
        $alum = new Alumno();
        $alum->setid_alumno($row['id_alumno']);
		$alum->setlegajo($row['legajo']);
        $alum->setapellido($row['apellido']);
        $alum->setnombre($row['nombre']);
        $alum->setemail($row['email']);
        $alum->setfechaNacimientoAlumno($row['fechaNacimientoAlumno']);
        $alum->settelefonoAlumno($row['telefonoAlumno']);
       $alum->setmateria($this->buscarMateriasAlumno($id));
       array_push($ListaAlumno,$alum);
    }
    $conn= null;
   // return $ListaAlumno[0]->getlegajo();
    return $ListaAlumno;
    }

    function buscarMateriasAlumno($id){

        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT fk_materia FROM materias_alumno where fk_alumno=$id"); 
        $stmt->execute();

        $ListaMaterias=array();
        while($row = $stmt->fetch()) {
            $materia= $row['fk_materia'];
            $stmt2 = $conn->prepare("SELECT id_materia,nombreMateria,fk_departamento,fk_dia FROM materia where id_materia=$materia"); 
            $stmt2->execute();
            while($row = $stmt2->fetch()) {
                $mat = new Materia();
                $mat->setid_materia($row['id_materia']);
                $mat->setnombreMateria($row['nombreMateria']);
                // $mat->setfk_departamento($row['fk_departamento']);
                // $mat->setfk_dia($row['fk_dia']);
           array_push($ListaMaterias,$mat);
        }
    }
        $conn= null;
        return $ListaMaterias;
        }
//remplazada
    function buscarHorariosDeConsultaDeMateria($idmateria){
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_materia,nombreMateria,fk_departamento,fk_dia FROM materia where id_materia=$idmateria"); 
        $stmt->execute();

        while($row = $stmt->fetch()) {
            $mat = new Materia();
            $mat->setid_materia($row['id_materia']);
            $mat->setnombreMateria($row['nombreMateria']);
            $ListaHorariosDeConsulta=array();
            //quiza incecsarios
           // $mat->setapellido($row['fk_departamento']);
            //$mat->setnombre($row['fk_dia']);
           
            $conn = $this->getconexion();
            $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia FROM horariodeconsulta where fk_materia=$idmateria"); 
            $stmt2->execute();

            while($row = $stmt2->fetch()) {
                $hor = new HorarioDeConsulta();
                $hor->setid_horariodeconsulta($row['id_horariodeconsulta']);
                $hor->sethora($row['hora']);
                $hor->setactivoDesde($row['activoDesde']);
                $hor->setactivoHasta($row['activoHasta']);
                $hor->setsemestre($row['semestre']);
                    
                    $tempDia =$row['fk_dia'];
                    $tempProfesor =$row['fk_profesor'];

                    $stmt3 = $conn->prepare("SELECT id_dia,dia FROM dia where id_dia=$tempDia"); 
                    $stmt3->execute();
                    while($row = $stmt3->fetch()) {
                        $dia = new Dia();
                        $dia->setid_dia($row['id_dia']);
                        $dia->setdia($row['dia']);
                        $hor->setdia($dia);
                    }

                    
                    $stmt4 = $conn->prepare("SELECT id_profesor,apellido,nombre FROM profesor where id_profesor=$tempProfesor"); 
                    $stmt4->execute();
                    while($row = $stmt4->fetch()) {
                        $prof = new Profesor();
                        $prof->setid_profesor($row['id_profesor']);
                        $prof->setapellido($row['apellido']);
                        $prof->setnombre($row['nombre']);
                        $hor->setprofesor($prof);
                    }
               
            array_push($ListaHorariosDeConsulta,$hor);
            }
            $mat->setHorarioDeConsulta($ListaHorariosDeConsulta);
        }
return $mat;

    }
    
    function buscarIDdeNombreMateria($nombre){
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_materia FROM materia where nombreMateria='$nombre'"); 
        $stmt->execute(); 
        $id="";
        while($row = $stmt->fetch()) {
        $id= $row['id_materia'];
    }
        return $id;
    }







    function buscarHorariosDeConsultaDeMateriaporhoraconsulta($idmateria){
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_materia,nombreMateria,fk_departamento,fk_dia FROM materia where id_materia=$idmateria"); 
        $stmt->execute();

        while($row = $stmt->fetch()) {
            $mat = new Materia();
            $mat->setid_materia($row['id_materia']);
            $mat->setnombreMateria($row['nombreMateria']);
            $ListHoraDeConsulta=array();

            $conn = $this->getconexion();
            $stmt2 = $conn->prepare("SELECT id_horadeconsulta,fk_horariodeconsulta FROM horadeconsulta where fk_materia=$idmateria and estadoVigencia='activo'"); 
            $stmt2->execute();

            while($row = $stmt2->fetch()) {
                $hora = new HoraDeConsulta();
              
                $hora->setid_horadeconsulta($row['id_horadeconsulta']);
                    
                $tempidhorario =$row['fk_horariodeconsulta'];
                
                $stmt3 = $conn->prepare("SELECT  id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia FROM horariodeconsulta where id_horariodeconsulta=$tempidhorario");
                $stmt3->execute();

                    while($row = $stmt3->fetch()) {
                        $ListaHorariosDeConsulta=array();
                        $hor = new HorarioDeConsulta();
                        $hor->setid_horariodeconsulta($row['id_horariodeconsulta']);
                        $hor->sethora($row['hora']);
                        $hor->setactivoDesde($row['activoDesde']);
                        $hor->setactivoHasta($row['activoHasta']);
                        $hor->setsemestre($row['semestre']);
                            
                            $tempDia =$row['fk_dia'];
                            $tempProfesor =$row['fk_profesor'];
        
                            $stmt4 = $conn->prepare("SELECT id_dia,dia FROM dia where id_dia=$tempDia"); 
                            $stmt4->execute();
                            while($row = $stmt4->fetch()) {
                                $dia = new Dia();
                                $dia->setid_dia($row['id_dia']);
                                $dia->setdia($row['dia']);
                                $hor->setdia($dia);
                            }
                            $stmt5 = $conn->prepare("SELECT id_profesor,apellido,nombre FROM profesor where id_profesor=$tempProfesor"); 
                            $stmt5->execute();
                            while($row = $stmt5->fetch()) {
                                $prof = new Profesor();
                                $prof->setid_profesor($row['id_profesor']);
                                $prof->setapellido($row['apellido']);
                                $prof->setnombre($row['nombre']);
                                $hor->setprofesor($prof);
                            }
                        $hora->setHorarioDeConsulta($hor);
                        }
                 array_push($ListHoraDeConsulta,$hora);
                }
            $mat->setHoraDeConsulta($ListHoraDeConsulta);
        }
        return $mat;

    }
//sin uso
    function crearAnotacion($idhoradeconsulta,$mensaje,$idalumno){
        
        $conn = $this->getconexion();
        $fecha=getdate();
        $fechahora=$fecha['hours'] + $fecha['minutes']+ $fecha['seconds'];
        $fechadia= $fecha['year']+'-'+$fecha['mon']+'-'+$fecha['mday'];
        $stmt = $conn->prepare("INSERT INTO `detalleanotados` (`id_detalleanotados`, `fechaDesdeAnotados`, `horaDetalleAnotados`, `tema`, `fk_alumno`, `fk_horadeconsulta`) 
        VALUES (NULL, $fechadia, $fechahora , $mensaje, $idalumno, $idhoradeconsulta);"); 
        $stmt->execute();

    }

    function BuscarProfesor(){
        $listaProfesor=array();
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_profesor,nombre,apellido,email FROM profesor ORDER BY apellido "); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $prof = new Profesor();
            $prof->setid_profesor($row['id_profesor']);
            $prof->setapellido($row['apellido']);
            $prof->setnombre($row['nombre']);
            $prof->setemail($row['email']);
           array_push($listaProfesor,$prof);
        }
        return $listaProfesor;
    }
    function BuscarDepartamento(){
        $listaDepartamento=array();
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_departamento,nombre FROM departamento ORDER BY nombre "); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $dep = new Departamento();
            $dep->setid_departamento($row['id_departamento']);
            $dep->setnombre($row['nombre']);
           array_push($listaDepartamento,$dep);
        }
        return $listaDepartamento;
    }

    function buscarHorariosDeConsultaporProfesor($idprofesor){
        $profesorHorarios=array();
        $listaHorarios=array();
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_profesor,nombre,apellido,email FROM profesor where id_profesor=$idprofesor "); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $prof = new Profesor();
            $prof->setid_profesor($row['id_profesor']);
            $prof->setapellido($row['apellido']);
            $prof->setnombre($row['nombre']);
            $prof->setemail($row['email']);
           array_push($profesorHorarios,$prof);
        }
        $stmt2 = $conn->prepare("SELECT id_horadeconsulta,fk_horariodeconsulta,fk_materia FROM horadeconsulta where fk_profesor=$idprofesor and estadoVigencia='activo'"); 
            $stmt2->execute();
          

            while($row = $stmt2->fetch()) {
                $hora = new HoraDeConsulta();
                $hora->setid_horadeconsulta($row['id_horadeconsulta']);
                $tempidhorario =$row['fk_horariodeconsulta'];
                $temporalMateriaid =$row['fk_materia'];

                  $stmt3 = $conn->prepare("SELECT  id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia FROM horariodeconsulta where id_horariodeconsulta=$tempidhorario");
                  $stmt3->execute();

                    while($row = $stmt3->fetch()) {
                        $ListaHorariosDeConsulta=array();
                        $hor = new HorarioDeConsulta();
                        $hor->setid_horariodeconsulta($row['id_horariodeconsulta']);
                        $hor->sethora($row['hora']);
                        $hor->setactivoDesde($row['activoDesde']);
                        $hor->setactivoHasta($row['activoHasta']);
                        $hor->setsemestre($row['semestre']);
                    
                            $tempDia =$row['fk_dia'];

                            $stmt4 = $conn->prepare("SELECT id_dia,dia FROM dia where id_dia=$tempDia"); 
                            $stmt4->execute();
                            while($row = $stmt4->fetch()) {
                                $dia = new Dia();
                                $dia->setid_dia($row['id_dia']);
                                $dia->setdia($row['dia']);
                                $hor->setdia($dia);
                            }
                $hora->setHorarioDeConsulta($hor);
                array_push($listaHorarios,$hora);
                }
                $stmt5 = $conn->prepare("SELECT id_materia,nombreMateria,fk_departamento,fk_dia FROM materia where id_materia=$temporalMateriaid"); 
                $stmt5->execute();
        
                while($row = $stmt5->fetch()) {
                    $mat = new Materia();
                    $mat->setid_materia($row['id_materia']);
                    $mat->setnombreMateria($row['nombreMateria']);
                    $hora->setMateria($mat);
                }
              
    }
    array_push($profesorHorarios,$listaHorarios);
    return $profesorHorarios;
}

}
?>