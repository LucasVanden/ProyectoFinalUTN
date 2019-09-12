<?php
require_once ('../../modelo/persistencia/conexion.php');
require_once ('../../modelo/Alumno.php');
require_once ('../../modelo/Materia.php');
//quiza separado en otro controlador
require_once ('../../modelo/HorarioDeConsulta.php');
require_once ('../../modelo/Profesor.php');

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

}
?>