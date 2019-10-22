<?php

class HorarioCursado
{
	var $id_HorarioCursado;
	var $horaDesde;
	var $horaHasta;
	var $dia;
	var $comision;
	var $semestreAnual;
	var $Profesor;
	var $Turno;
	var $fk_materia;

	function HorarioCursado()
	{
	}

	function getid_HorarioCursado()
	{
		return $this->id_HorarioCursado;
	}
	function setid_HorarioCursado($newVal)
	{
		$this->id_HorarioCursado = $newVal;
	}

	function getProfesor()
	{
		return $this->Profesor;
	}
	function setProfesor($newVal)
	{
		$this->Profesor = $newVal;
	}

	function getfk_materia()
	{
		return $this->fk_materia;
	}

	function setfk_materia($newVal)
	{
		$this->fk_materia = $newVal;
	}

	function getsemestreAnual()
	{
		return $this->semestreAnual;
	}

	function setsemestreAnual($newVal)
	{
		$this->semestreAnual = $newVal;
	}
	function gethoraDesde()
	{
		return $this->horaDesde;
	}
	

	function sethoraDesde($newVal)
	{
		$this->horaDesde = $newVal;
	}

	function gethoraHasta()
	{
		return $this->horaHasta;
	}


	function sethoraHasta($newVal)
	{
		$this->horaHasta = $newVal;
	}

	function getdia()
	{
		return $this->dia;
	}


	function setdia($newVal)
	{
		$this->dia = $newVal;
	}

	function getcomision()
	{
		return $this->comision;
	}


	function setcomision($newVal)
	{
		$this->comision = $newVal;
	}

}
?>