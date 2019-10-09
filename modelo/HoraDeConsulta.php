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
	var $AvisoProfesor;
	var $Presentismo;
	var $DetalleAnotados;

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

	
	function getPresentismo()
	{
		return $this->Presentismo;
	}
	function setPresentismo($newVal)
	{
		$this->Presentismo = $newVal;
	}

	function getDetalleAnotados()
	{
		return $this->DetalleAnotados;
	}
	function setDetalleAnotados($newVal)
	{
		$this->DetalleAnotados = $newVal;
	}

	function getMateria()
	{
		return $this->Materia;
	}
	function setMateria($newVal)
	{
		$this->Materia = $newVal;
	}

	function getAvisoProfesor()
	{
		return $this->AvisoProfesor;
	}
	function setAvisoProfesor($newVal)
	{
		$this->AvisoProfesor = $newVal;
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


	function incrementarAnotados()
	{
	}


}
?>