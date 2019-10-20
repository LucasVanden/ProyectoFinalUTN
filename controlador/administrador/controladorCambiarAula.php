<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR.$conexion);
require_once ($DIR . $Alumno);
require_once ($DIR . $Materia);
require_once ($DIR . $HorarioDeConsulta);
require_once ($DIR . $Profesor);
require_once ($DIR . $HoraDeConsulta);
require_once ($DIR . $Departamento);
require_once ($DIR . $AnotadosEstado);
require_once ($DIR . $DetalleAnotados);
require_once ($DIR . $EstadoAnotados);
require_once ($DIR . $AvisoProfesor);
require_once ($DIR . $Dedicacion);
require_once ($DIR . $Aula);
date_default_timezone_set('America/Argentina/Mendoza');
class controladorCambiarAula extends conexion
{

    function BuscarAulas(){

        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_aula,cuerpoAula,nivelAula,numeroAula FROM aula"); 
        $stmt->execute();
        $listaAulas=array();
        while($row = $stmt->fetch()) {

                $aula = new Aula();
                $aula->setid_aula($row['id_aula']);
                $aula->setcuerpoAula($row['cuerpoAula']);
                $aula->setnivelAula($row['nivelAula']);
                $aula->setnumeroAula($row['numeroAula']);
                array_push($listaAulas,$aula);
            }
        return $listaAulas;
    }

    function buscarHorariosParallenarEnlosSelect($idmateria,$idprofesor){
        $ListaHorariosDeConsulta=array();
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,semestre,fk_dia,n,fk_aula FROM horariodeconsulta
         where fk_profesor=$idprofesor AND fk_materia=$idmateria AND activoHasta='0000-00-00'" ); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            
            $hor = new HorarioDeConsulta();
            $hor->setid_horariodeconsulta($row['id_horariodeconsulta']);
            $hor->sethora($row['hora']);
            $hor->setactivoDesde($row['activoDesde']);
            $hor->setsemestre($row['semestre']);
            $hor->setn($row['n']);
            $hor->setfk_aula($row['fk_aula']);
                
                $tempDia =$row['fk_dia'];
                $stmt4 = $conn->prepare("SELECT id_dia,dia FROM dia where id_dia=$tempDia"); 
                $stmt4->execute();
                while($row = $stmt4->fetch()) {
                    $dia = new Dia();
                    $dia->setid_dia($row['id_dia']);
                    $dia->setdia($row['dia']);
                    $hor->setdia($dia);
                }
            array_push($ListaHorariosDeConsulta,$hor);
            }
            return $ListaHorariosDeConsulta;
    }

    function BuscarDepartamento(){
        $listaDepartamento=array();
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_departamento,nombre FROM departamento ORDER BY nombre "); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $dep = new Departamento();
            $dep->setid_departamento($row['id_departamento']);
            $dep->setnombre($row['nombre']);
           array_push($listaDepartamento,$dep);
        }
        return $listaDepartamento;
    }
}
?>