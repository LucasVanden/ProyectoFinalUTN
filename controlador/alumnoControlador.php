<?php
require_once ('../../modelo/persistencia/conexion.php');
require_once ('../../modelo/Alumno.php');
require_once ('../../modelo/Materia.php');

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
                // $mat->setid_materia($row['id_materia']);
                $mat->setnombreMateria($row['nombreMateria']);
                // $mat->setfk_departamento($row['fk_departamento']);
                // $mat->setfk_dia($row['fk_dia']);
           array_push($ListaMaterias,$mat);
        }
    }
        $conn= null;
        return $ListaMaterias;
        }


}
?>