<?php
class Aula
{
	var $id_aula;
	var $cuerpoAula;
	var $nivelAula;
	var $numeroAula;


	function Alumno()
	{
    }

    function getid_aula()
	{
		return $this->id_aula;
	}
	function setid_aula($newVal)
	{
		$this->id_aula = $newVal;
    }
    
    function getcuerpoAula()
	{
		return $this->cuerpoAula;
	}
	function setcuerpoAula($newVal)
	{
		$this->cuerpoAula = $newVal;
    }

        
    function getnivelAula()
	{
		return $this->nivelAula;
	}
	function setnivelAula($newVal)
	{
		$this->nivelAula = $newVal;
    }

    function getnumeroAula()
	{
		return $this->numeroAula;
	}
	function setnumeroAula($newVal)
	{
		$this->numeroAula = $newVal;
    }
}
    ?>