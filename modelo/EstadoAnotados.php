<?php



class EstadoAnotados
{
	var $id_estadoanotados;
	var $nombreEstado;

	function EstadoAnotados()
	{
	}


	function getid_estadoanotados()
	{
		return $this->id_estadoanotados;
	}

	function setid_estadoanotados($newVal)
	{
		$this->id_estadoanotados = $newVal;
	}
	function getnombreEstado()
	{
		return $this->nombreEstado;
	}

	function setnombreEstado($newVal)
	{
		$this->nombreEstado = $newVal;
	}

}
?>