<?php
require_once ('Materia.php');
require_once ('HorarioDeConsulta.php');



class HoraDeConsulta
{
	var $id_horadeconsulta;
	var $fechaDesdeAnotados;
	var $fechaHastaAnotados;
	var $cantidadAnotados;
	var $estadoPresentismo;
	var $estadoVigencia;
	var $Materia;
	var $HorarioDeConsulta;
	var $tempiddetalle;
	var $m_AvisoProfesor;
	var $m_Presentismo;
	var $m_DetalleAnotados;

	function HoraDeConsulta()
	{
	}

	function getid_horadeconsulta()
	{
		return $this->id_horadeconsulta;
	}
	function setid_horadeconsulta($newVal)
	{
		$this->id_horadeconsulta = $newVal;
	}
	function getMateria()
	{
		return $this->Materia;
	}
	function setMateria($newVal)
	{
		$this->Materia = $newVal;
	}

	function gettempiddetalle()
	{
		return $this->tempiddetalle;
	}
	function settempiddetalle($newVal)
	{
		$this->tempiddetalle = $newVal;
	}

	function getfechaAnotados()
	{
		return $this->fechaAnotados;
	}

	function getfechaHastaAnotados()
	{
		return $this->fechaHastaAnotados;
	}


	function setfechaAnotados($newVal)
	{
		$this->fechaAnotados = $newVal;
	}

	function setfechaHastaAnotados($newVal)
	{
		$this->fechaHastaAnotados = $newVal;
	}

	function getcantidadAnotados()
	{
		return $this->cantidadAnotados;
	}


	function setcantidadAnotados($newVal)
	{
		$this->cantidadAnotados = $newVal;
	}

	function getestadoPresentismo()
	{
		return $this->estadoPresentismo;
	}


	function setestadoPresentismo($newVal)
	{
		$this->estadoPresentismo = $newVal;
	}

	function getestadoVigencia()
	{
		return $this->estadoVigencia;
	}


	function setestadoVigencia($newVal)
	{
		$this->estadoVigencia = $newVal;
	}

	function getHorarioDeConsulta()
	{
		return $this->HorarioDeConsulta;
	}
	function setHorarioDeConsulta($newVal)
	{
		$this->HorarioDeConsulta = $newVal;
	}

	function setDetalleAnotados()
	{
	}

	function incrementarAnotados()
	{
	}


}
?>