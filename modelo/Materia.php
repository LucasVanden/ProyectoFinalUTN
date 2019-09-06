<?php


/**
 * @author vande
 * @version 1.0
 * @created 05-Sep-2019 22:56:35
 */
class Materia
{
	var $id_materia;
	var $nombreMateria;
	//var $m_Horario Cursado;
	var $m_CarreRA;
	var $m_HorarioDeConsulta;
	var $m_Mesas;

	function Materia()
	{
	}



	function getnombreMateria()
	{
		return $this->nombreMateria;
	}

	function setnombreMateria($newVal)
	{
		$this->nombreMateria = $newVal;
	}

}
?>