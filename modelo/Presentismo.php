<?php

class Presentismo
{

	var $fecha;
	var $horaDesde;
	var $horaHasta;


	function Presentismo()
	{
	}


	function getfecha()
	{
		return $this->fecha;
	}
	function setfecha($newVal)
	{
		$this->fecha = $newVal;
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

}
?>