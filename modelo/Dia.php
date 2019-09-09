<?php
class Dia
{
	var $id_dia;
	var $dia;


	function Alumno()
	{
    }

    function getid_dia()
	{
		return $this->id_dia;
	}
	function setid_dia($newVal)
	{
		$this->id_dia = $newVal;
    }
    
    function getDia()
	{
		return $this->dia;
	}
	function setDia($newVal)
	{
		$this->dia = $newVal;
    }
}
    ?>