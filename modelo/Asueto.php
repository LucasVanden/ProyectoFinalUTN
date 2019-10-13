<?php



class Asueto
{

	var $horaDesdeAsueto;
	var $horaHastaAsueto;
	var $fechaAsueto;

	function Asueto()
	{
	}



	function gethoraDesdeAsueto()
	{
		return $this->horaDesdeAsueto;
	}
	function sethoraDesdeAsueto($newVal)
	{
		$this->horaDesdeAsueto = $newVal;
	}

	function gethoraHastaAsueto()
	{
		return $this->horaHastaAsueto;
	}
	function sethoraHastaAsueto($newVal)
	{
		$this->horaHastaAsueto = $newVal;
	}

	function getfechaAsueto()
	{
		return $this->fechaAsueto;
	}
	function setfechaAsueto($newVal)
	{
		$this->fechaAsueto = $newVal;
	}

}
?>