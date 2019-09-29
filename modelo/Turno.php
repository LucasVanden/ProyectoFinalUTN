<?php


/**
 * @author Albana
 * @version 1.0
 * @created 29-Sep-2019 1:33:34
 */
class Turno
{
	var $id_turno;
	var $nombre;
	var $horaDesdeTurno;
	var $horaHastaTurno;

	function Turno()
	{
	}


	function getid_turno()
	{
		return $this->id_turno;
	}
	function setid_turno($newVal)
	{
		$this->id_turno = $newVal;
	}
	function getnombre()
	{
		return $this->nombre;
	}
	function setnombre($newVal)
	{
		$this->nombre = $newVal;
	}

	function gethoraDesdeTurno()
	{
		return $this->horaDesdeTurno;
	}
	function sethoraDesdeTurno($newVal)
	{
		$this->horaDesdeTurno = $newVal;
	}

	function gethoraHastaTurno()
	{
		return $this->horaHastaTurno;
	}
	function sethoraHastaTurno($newVal)
	{
		$this->horaHastaTurno = $newVal;
	}

}
?>