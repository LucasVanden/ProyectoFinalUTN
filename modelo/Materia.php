<?php

class Materia
{
	var $id_materia;
	var $nombreMateria;
	//var $m_Horario Cursado;
	var $m_CarreRA;
	var $HorarioDeConsulta;
	var $m_Mesas;

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
}
?>