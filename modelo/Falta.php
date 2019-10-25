<?php

class Falta
{
	var $id_falta;
	var $fechaFalta;
	var $tipo;
	var $min;
	var $horadeconsulta;
	var $materia;
	var $profesor;
	var $departamento;

	function Falta()
	{
	}
	function getdepartamento()
	{
		return $this->departamento;
	}
	function setdepartamento($newVal)
	{
		$this->departamento = $newVal;
	}

	function getprofesor()
	{
		return $this->profesor;
	}
	function setprofesor($newVal)
	{
		$this->profesor = $newVal;
	}

	function getmateria()
	{
		return $this->materia;
	}
	function setmateria($newVal)
	{
		$this->materia = $newVal;
	}

	function gethoradeconsulta()
	{
		return $this->horadeconsulta;
	}
	function sethoradeconsulta($newVal)
	{
		$this->horadeconsulta = $newVal;
	}

	function getminutos()
	{
		return $this->minutos;
	}
	function setminutos($newVal)
	{
		$this->minutos = $newVal;
	}
	function getid_falta()
	{
		return $this->id_falta;
	}
	function setid_falta($newVal)
	{
		$this->id_falta = $newVal;
	}

	function getfechaFalta()
	{
		return $this->fechaFalta;
	}
	function setfechaFalta($newVal)
	{
		$this->fechaFalta = $newVal;
	}

	function gettipo()
	{
		return $this->tipo;
	}
	function settipo($newVal)
	{
		$this->tipo = $newVal;
	}

}
?>