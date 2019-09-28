<?php

class DetalleAnotados
{
	var $id_detalleanotados;
	var $fechaDetalleAnotados;
	var $horaDetalleAnotados;
	var $tema;
	var $Alumno;
	var $AnotadosEstado;
	var $fk_horadeconsulta;

	function DetalleAnotados()
	{
	}
	
	function getid_detalleanotados()
	{
		return $this->id_detalleanotados;
	}
	function setid_detalleanotados($newVal)
	{
		$this->id_detalleanotados = $newVal;
	}
	function getAlumno()
	{
		return $this->Alumno;
	}
	function setAlumno($newVal)
	{
		$this->Alumno = $newVal;
	}

	function getfk_horadeconsulta()
	{
		return $this->fk_horadeconsulta;
	}
	function setfk_horadeconsulta($newVal)
	{
		$this->fk_horadeconsulta = $newVal;
	}

	function getAnotadosEstado()
	{
		return $this->AnotadosEstado;
	}
	function setAnotadosEstado($newVal)
	{
		$this->AnotadosEstado = $newVal;
	}

	function getfechaDetalleAnotados()
	{
		return $this->fechaDetalleAnotados;
	}
	function setfechaDetalleAnotados($newVal)
	{
		$this->fechaDetalleAnotados = $newVal;
	}

	function gethoraDetalleAnotados()
	{
		return $this->horaDetalleAnotados;
	}


	function sethoraDetalleAnotados($newVal)
	{
		$this->horaDetalleAnotados = $newVal;
	}

	function gettema()
	{
		return $this->tema;
	}


	function settema($newVal)
	{
		$this->tema = $newVal;
	}


}
?>