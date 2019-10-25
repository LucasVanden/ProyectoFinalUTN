<?php
require_once ('Materia.php');

/**
 * @author Albana
 * @version 1.0
 * @created 15-Sep-2019 22:57:13
 */
class Departamento
{
	var $id_departamento;
	var $nombre;
	var $fk_aula;


	function Departamento()
	{
	}




	function getid_departamento()
	{
		return $this->id_departamento;
	}
	function setid_departamento($newVal)
	{
		$this->id_departamento = $newVal;
	}
	function getnombre()
	{
		return $this->nombre;
	}
	function setnombre($newVal)
	{
		$this->nombre = $newVal;
	}

	function getfk_aula()
	{
		return $this->fk_aula;
	}
	function setfk_aula($newVal)
	{
		$this->fk_aula = $newVal;
	}

}
?>