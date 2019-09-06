<?php
require_once ('Materia.php');
require_once ('persistencia/conexion.php');


class Alumno extends conexion
{
	var $id_alumno;
	var $apellido;
	var $legajo;
	var $nombre;
	var $email;
	var $fechaNacimientoAlumno;
	var $telefonoAlumno;
	var $materia =array();

	function Alumno()
	{
	}
function buscarAlumno($id){
	$conn = $this->getconexion();

	$stmt = $conn->prepare("SELECT legajo,apellido FROM alumno"); 
    $stmt->execute();
	$ListaAlumno=array();
    while($row = $stmt->fetch()) {
		$alum = new Alumno();
		$alum->setlegajo($row['legajo']);
		$alum->setapellido($row['apellido']);
       $ListaAlumno->array_push($alum);
	}
	return $ListaAlumno;
}

	function getid_alumno()
	{
	return $this->id_alumno;
	}

	function getapellido()
	{
		return $this->apellido;
	}


	function setapellido($newVal)
	{
		$this->apellido = $newVal;
	}

	function getlegajo()
	{
		return $this->legajo;
	}


	function setlegajo($newVal)
	{
		$this->legajo = $newVal;
	}

	function getnombre()
	{
		return $this->nombre;
	}

	function setid_alumno($newVal)
	{
		$this->id_alumno = $newVal;
	}

	
	function setnombre($newVal)
	{
		$this->nombre = $newVal;
	}

	function getfechaNacimientoAlumno()
	{
		return $this->fechaNacimientoAlumno;
	}


	function setfechaNacimientoAlumno($newVal)
	{
		$this->fechaNacimientoAlumno = $newVal;
	}

	function getemail()
	{
		return $this->e-mail;
	}

	function gettelefonoAlumno()
	{
		return $this->telefonoAlumno;
	}


	function setemail($newVal)
	{
		$this->email = $newVal;
	}


	function settelefonoAlumno($newVal)
	{
		$this->telefonoAlumno = $newVal;
	}


	function getMateria()
	{
		return $this->materia;
	}
	function setmateria($newVal)
	{
		$this->materia=$newVal;
	}

}
?>