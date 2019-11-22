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
require_once ($DIR . $HorarioCursado);
date_default_timezone_set('America/Argentina/Mendoza');
class controladorAdministrador extends conexion
{

    function BuscarAulas(){

        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_aula,cuerpoAula,nivelAula,numeroAula FROM aula where eliminado is null"); 
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
        $stmt = $conn->prepare("SELECT id_departamento,nombre,fk_aula FROM departamento where eliminado is null  ORDER BY nombre "); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $dep = new Departamento();
            $dep->setid_departamento($row['id_departamento']);
            $dep->setnombre($row['nombre']);
            $dep->setfk_aula($row['fk_aula']);
           array_push($listaDepartamento,$dep);
        }
        return $listaDepartamento;
    }
    function BuscarMaterias($iddepartamento){
        $ListaMaterias=array();
        $conn = $this->getconexion();
        $stmt2 = $conn->prepare("SELECT id_materia,nombreMateria,fk_departamento,fk_dia FROM materia where eliminado is null and fk_departamento=$iddepartamento"); 
        $stmt2->execute();
        while($row = $stmt2->fetch()) {
            $mat = new Materia();
            $mat->setid_materia($row['id_materia']);
            $mat->setnombreMateria($row['nombreMateria']);
            $mat->setfk_departamento($row['fk_departamento']);
            $tempDia=$row['fk_dia'];

            $stmt4 = $conn->prepare("SELECT id_dia,dia FROM dia where id_dia=$tempDia"); 
            $stmt4->execute();
            while($row = $stmt4->fetch()) {
                $dia = new Dia();
                $dia->setid_dia($row['id_dia']);
                $dia->setdia($row['dia']);
                $mat->setdia($dia);
            }

            $stmt = $conn->prepare("SELECT id_departamento,nombre FROM departamento WHERE id_departamento=$iddepartamento "); 
            $stmt->execute();
            while($row = $stmt->fetch()) {
                $dep = new Departamento();
                $dep->setid_departamento($row['id_departamento']);
                $dep->setnombre($row['nombre']);
                $mat->setfk_departamento($dep);
            }


       array_push($ListaMaterias,$mat);
    }
    return $ListaMaterias;
    }
    function BuscarProfesor(){
        $listaProfesor=array();
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_profesor,nombre,apellido,email FROM profesor where eliminado is null ORDER BY apellido "); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $prof = new Profesor();
            $prof->setid_profesor($row['id_profesor']);
            $prof->setapellido($row['apellido']);
            $prof->setnombre($row['nombre']);
            $prof->setemail($row['email']);
           array_push($listaProfesor,$prof);
        }
        return $listaProfesor;
    }
    function BuscarDirector(){
        $listaProfesor=array();
        $conn = $this->getconexion();

        $stmt = $conn->prepare("SELECT fk_profesor FROM usuario where fk_perfil='3' "); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $fk_profesor=$row['fk_profesor'];

            $stmt2 = $conn->prepare("SELECT id_profesor,nombre,apellido,email FROM profesor where id_profesor='$fk_profesor' ORDER BY apellido "); 
            $stmt2->execute();
            while($row = $stmt2->fetch()) {
                $prof = new Profesor();
                $prof->setid_profesor($row['id_profesor']);
                $prof->setapellido($row['apellido']);
                $prof->setnombre($row['nombre']);
                $prof->setemail($row['email']);
            array_push($listaProfesor,$prof);
            }
        }
        return $listaProfesor;
    }

    function BuscarDedicacion(){
        $listaDedicacion=array();
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_dedicacion,tipo,cantidadHora FROM dedicacion"); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $ded = new Dedicacion();
            $ded->setid_dedicacion($row['id_dedicacion']);
            $ded->settipo($row['tipo']);
            $ded->setcantidadHora($row['cantidadHora']);
           array_push($listaDedicacion,$ded);
        }
        return $listaDedicacion;
    }

    function BuscarHorarioDeCursadodeProfesorMateria($idProfesor,$idMateria){

        $listaMateriasProfesor=array();

        $con= new conexion();
        $conn = $con->getconexion();
        $stmt = $conn->prepare("SELECT id_horariocursado,HoraDesde,HoraHasta,semestreAnual,fk_materia,fk_dia FROM horariocursado where fk_profesor=$idProfesor and fk_materia=$idMateria"); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $HoradeCursado= new HorarioCursado();
            $HoradeCursado->setid_horariocursado($row['id_horariocursado']);
            $HoradeCursado->sethoraDesde($row['HoraDesde']);
            $HoradeCursado->sethoraHasta($row['HoraHasta']);
            $HoradeCursado->setsemestreAnual($row['semestreAnual']);
            $temmateria=$row['fk_materia'];
            $tempDia=$row['fk_dia'];
    
            $stmt2 = $conn->prepare("SELECT id_materia,nombreMateria,fk_departamento,fk_dia FROM materia where id_materia=$temmateria"); 
            $stmt2->execute();
            while($row = $stmt2->fetch()) {
                $mat = new Materia();
                $mat->setid_materia($row['id_materia']);
                $mat->setnombreMateria($row['nombreMateria']);
                $HoradeCursado->setfk_materia($mat);
            }
            $stmt3 = $conn->prepare("SELECT id_dia,dia FROM dia where id_dia=$tempDia"); 
            $stmt3->execute();
            while($row = $stmt3->fetch()) {
                $dia = new Dia();
                $dia->setid_dia($row['id_dia']);
                $dia->setdia($row['dia']);
                $HoradeCursado->setdia($dia);
            }
            $stmt4 = $conn->prepare("SELECT id_profesor,nombre,apellido,email FROM profesor where id_profesor=$idProfesor"); 
            $stmt4->execute();
            while($row = $stmt4->fetch()) {
                $prof = new Profesor();
                $prof->setid_profesor($row['id_profesor']);
                $prof->setapellido($row['apellido']);
                $prof->setnombre($row['nombre']);
                $prof->setemail($row['email']);
                $HoradeCursado->setProfesor($prof);
            }

            array_push($listaMateriasProfesor,$HoradeCursado);
        }
        return $listaMateriasProfesor;
    }


    function ConsultarAsueto($año,$mes){
        $con= new conexion();
        $conn=$con->getconexion();
        $fecha=$año."-".$mes."%";
            $listaAsuetos=array();
            $stmt = $conn->prepare("SELECT fechaAsueto FROM asueto WHERE fechaAsueto LIKE '$fecha'");  
            $stmt->execute();
            while($row = $stmt->fetch()) {
                $asueto=$row['fechaAsueto'];
                $numero=date("j",strtotime($asueto));
                array_push($listaAsuetos,$numero);
            }
            return $listaAsuetos;
    
    }
}
?>