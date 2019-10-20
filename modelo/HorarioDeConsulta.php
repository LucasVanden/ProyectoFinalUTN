<?php
require_once('Dia.php');

class HorarioDeConsulta
{
	var $id_horarioDeConsulta;
	var $dia;
	var $hora;
	var $activoDesde;
	var $activoHasta;
	var $semestre;
	var $Profesor;
	var $fk_materia;
	var $n;
	var $m_HorarioDeConsultaEstado;
	var $fk_aula;

	function HorarioDeConsulta()
	{
	}

	function getid_horarioDeConsulta()
	{
		return $this->id_horarioDeConsulta;
	}
	function setid_horarioDeConsulta($newVal)
	{
		$this->id_horarioDeConsulta = $newVal;
	}

	function getn()
	{
		return $this->n;
	}
	function setn($newVal)
	{
		$this->n = $newVal;
	}
	function getfk_materia()
	{
		return $this->fk_materia;
	}
	function setfk_materia($newVal)
	{
		$this->fk_materia = $newVal;
	}

	function getDia()
	{
		return $this->Dia;
	}
	function setDia($newVal)
	{
		$this->Dia = $newVal;
	}

	function gethora()
	{
		return $this->hora;
	}
	function sethora($newVal)
	{
		$this->hora = $newVal;
	}

	function getsemestre()
	{
		return $this->semestre;
	}
	function setsemestre($newVal)
	{
		$this->semestre = $newVal;
	}

	function getactivoDesde()
	{
		return $this->activoDesde;
	}

	function setactivoDesde($newVal)
	{
		$this->activoDesde = $newVal;
	}

	function getactivoHasta()
	{
		return $this->activoHasta;
	}
	function setactivoHasta($newVal)
	{
		$this->activoHasta = $newVal;
	}

	function getProfesor()
	{
		return $this->profesor;
	}
	function setProfesor($newVal)
	{
		$this->profesor = $newVal;
	}

	function getfk_aula()
	{
		return $this->fk_aula;
	}
	function setfk_aula($newVal)
	{
		$this->fk_aula = $newVal;
	}

}
?>