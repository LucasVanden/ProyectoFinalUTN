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

class Profesorcontrolador extends conexion
{

    function buscarMateriasProfesor($id){

        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT fk_materia,fk_dedicacion FROM dedicacion_materia_profesor where fk_profesor=$id"); 
        $stmt->execute();
        $listaDedicaciones=array();
        while($row = $stmt->fetch()) {
            $materia= $row['fk_materia'];
            $dedicacion= $row['fk_dedicacion'];
            $mat;
            $stmt2 = $conn->prepare("SELECT id_materia,nombreMateria,fk_departamento,fk_dia FROM materia where id_materia=$materia"); 
            $stmt2->execute();
            while($row = $stmt2->fetch()) {
                $mat = new Materia();
                $mat->setid_materia($row['id_materia']);
                $mat->setnombreMateria($row['nombreMateria']);
            }
        $stmt3 = $conn->prepare("SELECT id_dedicacion,tipo,cantidadHora FROM dedicacion where id_dedicacion=$dedicacion"); 
        $stmt3->execute();
            while($row = $stmt3->fetch()) {
                $ded = new Dedicacion();
                $ded->setid_dedicacion($row['id_dedicacion']);
                $ded->settipo($row['tipo']);
                $ded->setcantidadHora($row['cantidadHora']);
                $ded->setMateria($mat);
                array_push($listaDedicaciones,$ded);
            }
        }
        return $listaDedicaciones;
    }


    function buscarIDdeNombreMateria($nombre){
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_materia FROM materia where nombreMateria='$nombre'"); 
        $stmt->execute(); 
        $id="";
        while($row = $stmt->fetch()) {
        $id= $row['id_materia'];
    }
        return $id;
    }

    function buscarDedicaciondeMateria($idmateria,$idprofesor){
        $ded="";
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT fk_dedicacion FROM dedicacion_materia_profesor where fk_profesor=$idprofesor AND fk_materia=$idmateria" ); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $dedicacion= $row['fk_dedicacion'];
            $stmt3 = $conn->prepare("SELECT id_dedicacion,tipo,cantidadHora FROM dedicacion where id_dedicacion=$dedicacion"); 
            $stmt3->execute();
                while($row = $stmt3->fetch()) {
                    $ded =new Dedicacion();
                    $ded->setid_dedicacion($row['id_dedicacion']);
                    $ded->settipo($row['tipo']);
                    $ded->setcantidadHora($row['cantidadHora']);
                }
        }
        return $ded;
    }

    function buscarHorariodeConsultadeMateriadeProfesor($idmateria,$idprofesor){
        $listaHorarios=array();
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,semestre,fk_dia FROM horariodeconsulta where fk_profesor=$idprofesor AND fk_materia=$idmateria AND activoHasta='0000-00-00'" ); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $ListaHorariosDeConsulta=array();
            $hor = new HorarioDeConsulta();
            $hor->setid_horariodeconsulta($row['id_horariodeconsulta']);
            $hor->sethora($row['hora']);
            $hor->setactivoDesde($row['activoDesde']);
            $hor->setsemestre($row['semestre']);
                
                $tempDia =$row['fk_dia'];
                $stmt4 = $conn->prepare("SELECT id_dia,dia FROM dia where id_dia=$tempDia"); 
                $stmt4->execute();
                while($row = $stmt4->fetch()) {
                    $dia = new Dia();
                    $dia->setid_dia($row['id_dia']);
                    $dia->setdia($row['dia']);
                    $hor->setdia($dia);
                }
            array_push($listaHorarios,$hor);
            }
            return $listaHorarios;
    }

    function alumnosAnotados($idprofesor){
        $listaHora=array();
        $conn = $this->getconexion();
        $stmt2 = $conn->prepare("SELECT id_horadeconsulta,fk_horariodeconsulta,fk_materia,cantidadAnotados FROM horadeconsulta where fk_profesor=$idprofesor and estadoVigencia='activo'"); 
        $stmt2->execute();
        while($row = $stmt2->fetch()) {
            $hora = new HoraDeConsulta();
            $hora->setid_horadeconsulta($row['id_horadeconsulta']);
            $hora->setcantidadAnotados($row['cantidadAnotados']);

            $tempidhorario =$row['fk_horariodeconsulta'];
            $temporalMateriaid =$row['fk_materia'];
             $temphoraconsulta =$row['id_horadeconsulta'];
              $stmt3 = $conn->prepare("SELECT  id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia FROM horariodeconsulta where id_horariodeconsulta=$tempidhorario");
              $stmt3->execute();
                while($row = $stmt3->fetch()) {
                    $hor = new HorarioDeConsulta();
                    $hor->setid_horariodeconsulta($row['id_horariodeconsulta']);
                    $hor->sethora($row['hora']);
                    $hor->setactivoDesde($row['activoDesde']);
                    $hor->setactivoHasta($row['activoHasta']);
                    $hor->setsemestre($row['semestre']);
                
                        $tempDia =$row['fk_dia'];

                        $stmt4 = $conn->prepare("SELECT id_dia,dia FROM dia where id_dia=$tempDia"); 
                        $stmt4->execute();
                        while($row = $stmt4->fetch()) {
                            $dia = new Dia();
                            $dia->setid_dia($row['id_dia']);
                            $dia->setdia($row['dia']);
                            $hor->setdia($dia);
                        }
                    $hora->setHorarioDeConsulta($hor);
                }
            $stmt5 = $conn->prepare("SELECT id_materia,nombreMateria,fk_departamento,fk_dia FROM materia where id_materia=$temporalMateriaid"); 
            $stmt5->execute();
    
            while($row = $stmt5->fetch()) {
                $mat = new Materia();
                $mat->setid_materia($row['id_materia']);
                $mat->setnombreMateria($row['nombreMateria']);
                $hora->setMateria($mat);
            }
            $listaAvisos=array();
            $stmt6 = $conn->prepare("SELECT id_avisoProfesor,detalleDescripcion,fechaAvisoProfesor FROM avisoprofesor where fk_horadeconsulta=$temphoraconsulta"); 
            $stmt6->execute();
            while($row = $stmt6->fetch()) {
                $aviso= new AvisoProfesor();
                $aviso->setid_avisoProfesor($row['id_avisoProfesor']);
                $aviso->setdetalleDescripcion($row['detalleDescripcion']);
                $aviso->setfechaAvisoProfesor($row['fechaAvisoProfesor']);
                array_push($listaAvisos,$aviso);
            }
            $hora->setAvisoProfesor($listaAvisos);
            array_push($listaHora,$hora);
        }
        return $listaHora;
    }








    function hayAvisosProfesor($hora){
        $respuesta = false;
        foreach ($hora as $horadeconsulta) {
           foreach ($horadeconsulta->getAvisoProfesor() as $aviso) {
            if (isset($aviso)){
                $respuesta=true;
                break;
            }
           }
        }
        return $respuesta;
    }

}