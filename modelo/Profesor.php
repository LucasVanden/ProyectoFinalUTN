<?php

class Profesor
{
	var $id_profesor;
	var $apellido;
	var $email;
	var $legajo;
	var $nombre;
	var $telefono ;
	var $m_Dedicacion;

	function Profesor()
	{
	}

	function getid_profesor()
	{
		return $this->id_profesor;
	}

	function setid_profesor($newVal)
	{
		$this->id_profesor = $newVal;
	}


	function getapellido()
	{
		return $this->apellido;
	}

	function setapellido($newVal)
	{
		$this->apellido = $newVal;
	}

	function getemail()
	{
		return $this->email;
	}

	function setemail($newVal)
	{
		$this->email = $newVal;
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


	function setnombre($newVal)
	{
		$this->nombre = $newVal;
	}

}
?>