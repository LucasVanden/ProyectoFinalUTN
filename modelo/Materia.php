<?php

class Materia
{
	var $id_materia;
	var $nombreMateria;
	var $dia;
	//var $m_Horario Cursado;
	var $fk_departamento;
	var $HorarioDeConsulta;
	var $HoraDeConsulta;


	function Materia()
	{
	}

	function getid_materia()
	{
		return $this->id_materia;
	}
	function setid_materia($newVal)
	{
		$this->id_materia = $newVal;
	}

	function getfk_departamento()
	{
		return $this->fk_departamento;
	}
	function setfk_departamento($newVal)
	{
		$this->fk_departamento = $newVal;
	}


	function getdia()
	{
		return $this->dia;
	}
	function setdia($newVal)
	{
		$this->dia = $newVal;
	}

	function getnombreMateria()
	{
		return $this->nombreMateria;
	}
	function setnombreMateria($newVal)
	{
		$this->nombreMateria = $newVal;
	}

	function getHorarioDeConsulta()
	{
		return $this->HorarioDeConsulta;
	}
	function setHorarioDeConsulta($newVal)
	{
		$this->HorarioDeConsulta = $newVal;
	}
	function getHoraDeConsulta()
	{
		return $this->HorarioDeConsulta;
	}
	function setHoraDeConsulta($newVal)
	{
		$this->HorarioDeConsulta = $newVal;
	}
}
?>