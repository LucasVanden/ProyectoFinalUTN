<?php



class AnotadosEstado
{
	var $id_anotadosEstado;
	var $fechaAnotadosEstado;
	var $horaAnotadosEstado;
	var $EstadoAnotados;

	function AnotadosEstado()
	{
	}


	function getid_anotadosEstado()
	{
		return $this->id_anotadosEstado;
	}
	function setid_anotadosEstado($newVal)
	{
		$this->id_anotadosEstado = $newVal;
	}
	function getEstadoAnotados()
	{
		return $this->EstadoAnotados;
	}
	function setEstadoAnotados($newVal)
	{
		$this->EstadoAnotados = $newVal;
	}

	function getfechaAnotadosEstado()
	{
		return $this->fechaAnotadosEstado;
	}
	function setfechaAnotadosEstado($newVal)
	{
		$this->fechaAnotadosEstado = $newVal;
	}

	function gethoraAnotadosEstado()
	{
		return $this->horaAnotadosEstado;
	}

	/**
	 * 
	 * @param newVal
	 */
	function sethoraAnotadosEstado($newVal)
	{
		$this->horaAnotadosEstado = $newVal;
	}

	function new()
	{
	}

	function setEstadoAnotado()
	{
	}

}
?>