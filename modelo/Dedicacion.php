<?php


class Dedicacion
{
	var $id_dedicacion;
	var $tipo;
	var $cantidadHora;
	var $Materia;

	function Dedicacion()
	{
	}


	function getid_dedicacion()
	{
		return $this->id_dedicacion;
	}
	function setid_dedicacion($newVal)
	{
		$this->id_dedicacion = $newVal;
	}
	
	function gettipo()
	{
		return $this->tipo;
	}
	function settipo($newVal)
	{
		$this->tipo = $newVal;
	}

	function getMateria()
	{
		return $this->Materia;
	}
	function setMateria($newVal)
	{
		$this->Materia = $newVal;
	}
	function getcantidadHora()
	{
		return $this->cantidadHora;
	}


	function setcantidadHora($newVal)
	{
		$this->cantidadHora = $newVal;
	}

}
?>