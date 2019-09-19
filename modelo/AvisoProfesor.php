<?php


class AvisoProfesor
{
	var $id_avisoprofesor;
	var $detalleDescripcion;
	var $fechaAvisoProfesor;

	function AvisoProfesor()
	{
	}

	function getid_avisoprofesor()
	{
		return $this->id_avisoprofesor;
	}
	function setid_avisoprofesor($newVal)
	{
		$this->id_avisoprofesor = $newVal;
	}

	function getdetalleDescripcion()
	{
		return $this->detalleDescripcion;
	}
	function setdetalleDescripcion($newVal)
	{
		$this->detalleDescripcion = $newVal;
	}

	function getfechaAvisoProfesor()
	{
		return $this->fechaAvisoProfesor;
	}
	function setfechaAvisoProfesor($newVal)
	{
		$this->fechaAvisoProfesor = $newVal;
	}

}
?>