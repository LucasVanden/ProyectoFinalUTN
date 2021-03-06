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
date_default_timezone_set('America/Argentina/Mendoza');
class Asistenciacontrolador extends conexion
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
        $conn= null;
        return $listaDedicaciones;
    }


function buscarHorasConsulta($idprofesor,$idMateria){
    $listaHora=array();
    $conn = $this->getconexion();
    $stmt2 = $conn->prepare("SELECT id_horadeconsulta,fk_horariodeconsulta,fk_materia,fechaHastaAnotados FROM horadeconsulta where fk_profesor=$idprofesor and fk_materia=$idMateria and estadoVigencia='activo'"); 
    $stmt2->execute();
    while($row = $stmt2->fetch()) {
        $hora = new HoraDeConsulta();
        $hora->setid_horadeconsulta($row['id_horadeconsulta']);
        $hora->setfechaHastaAnotados($row['fechaHastaAnotados']);

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
        array_push($listaHora,$hora);
    }
    $conn= null;
    return $listaHora;
}
function buscarProfesorDeUsuario($idusuario){
    $conn = $this->getconexion();
    $stmt = $conn->prepare("SELECT fk_profesor FROM usuario where id_usuario=$idusuario"); 
    $stmt->execute();
    $idprofesor=null;
    while($row = $stmt->fetch()) {
       $idprofesor=$row['fk_profesor'];
    }
    $conn= null;
   return $idprofesor;
    }

function tienePresentismo($idhoradeconsulta){
    $conn = $this->getconexion();
    $stmt = $conn->prepare("SELECT id_presentismo FROM presentismo where fk_horadeconsulta=$idhoradeconsulta"); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        $idpresentismo =$row['id_presentismo'];
    }
    $conn= null;
    if(isset($idpresentismo)){
    return true;

    }else{
    return false;
    }
    }


function BuscarMateriasAAsistir($idalumno){
            $ListDetalles=array();
            $conn = $this->getconexion();
            $stmt = $conn->prepare("SELECT id_detalleanotados,fk_horadeconsulta FROM detalleanotados where fk_alumno=$idalumno "); 
            $stmt->execute();
           
                while($row = $stmt->fetch()) {
                        $detalle = new Detalleanotados();
                        $detalle->setid_detalleanotados($row['id_detalleanotados']);
                        $detalle->setfk_horadeconsulta($row['fk_horadeconsulta']);
    
                        $iddetalle=$row['id_detalleanotados'];
                        $Estados=array();
        
                        $stmt2 = $conn->prepare("SELECT id_anotadoestado,fechaAnotadosEstado,horaAnotadosEstado,fk_estadoanotados FROM anotadosestado where fk_detalleanotados=$iddetalle "); 
                        $stmt2->execute();
                        while($row = $stmt2->fetch()) {
                            $anotado = new AnotadosEstado();
                            $anotado->setid_anotadosEstado($row['id_anotadoestado']);
                            $anotado->setfechaAnotadosEstado($row['fechaAnotadosEstado']);
                            $anotado->sethoraAnotadosEstado($row['horaAnotadosEstado']);
                            $idnombreestado=$row['fk_estadoanotados'];
        
                            $stmt3 = $conn->prepare("SELECT nombreEstado,id_estadoanotados FROM estadoanotados where id_estadoanotados=$idnombreestado "); 
                            $stmt3->execute();
                            while($row = $stmt3->fetch()) {
                                $estado = new EstadoAnotados();
                                $estado->setnombreEstado($row['nombreEstado']);
                                $estado->setid_estadoanotados($row['id_estadoanotados']);
                                $anotado->setEstadoAnotados($estado);       
                            }
                        
                                array_push($Estados,$anotado);
                        }
                        $detalle->setAnotadosEstado($Estados);
                        array_push($ListDetalles,$detalle);
                } 
                
                $ListHoraDeConsulta=array();
               
               foreach ($ListDetalles as $detalle) {
                
                //    echo $detalle->getAnotadosEstado()[0]->getid_anotadosEstado();
                  $d= $detalle->getAnotadosEstado();
             if  ( end($d)->getEstadoAnotados()->getnombreEstado()=="Anotado") {
               
                //llamar a buscar la hs cosulta
              
                $id= $detalle->getfk_horadeconsulta();
                $idvaluedetalle=$detalle->getid_detalleanotados();
    
                $stmt4 = $conn->prepare("SELECT id_horadeconsulta,fk_horariodeconsulta,fk_materia FROM horadeconsulta where id_horadeconsulta=$id "); 
                $stmt4->execute();
    
                                while($row = $stmt4->fetch()) {
                                    $hora = new HoraDeConsulta();
                                    $hora->settempiddetalle($idvaluedetalle);
                                    $hora->setid_horadeconsulta($row['id_horadeconsulta']);
                                    $hora->setDetalleAnotados($detalle);
                                    $listaAvisos=array();    
                                    $tempidhorario =$row['fk_horariodeconsulta'];
                                    $tempmaeria =$row['fk_materia'];
                                    $tempidhora=$row['id_horadeconsulta'];
                                    $hora->setPresentismo(false);
                           

                                    $stmt9 = $conn->prepare("SELECT id_presentismo FROM presentismo where fk_horadeconsulta=$tempidhora and HoraHasta='00:00:00'"); 
                                    $stmt9->execute();
                                    while($row = $stmt9->fetch()) {
                                        $hora->setPresentismo(true);
                                
                                    }

                                    $stmt5 = $conn->prepare("SELECT id_avisoprofesor,fechaAvisoProfesor,detalleDescripcion,horaAvisoProfesor FROM avisoprofesor where fk_horadeconsulta=$tempidhora"); 
                                    $stmt5->execute();
                                    
    
                                    while($row = $stmt5->fetch()) {
                                        $aviso = new AvisoProfesor();
                                        $aviso->setid_avisoprofesor($row['id_avisoprofesor']);
                                        $aviso->setfechaAvisoProfesor($row['fechaAvisoProfesor']);
                                        $aviso->setdetalleDescripcion($row['detalleDescripcion']);
                                        $aviso->sethoraAvisoProfesor($row['horaAvisoProfesor']);
                                        array_push($listaAvisos,$aviso);
                                      
                                        
                                    }
                                    $hora->setAvisoProfesor($listaAvisos);
                                    $stmt5 = $conn->prepare("SELECT id_materia,nombreMateria,fk_departamento,fk_dia FROM materia where id_materia=$tempmaeria"); 
                                    $stmt5->execute();
    
                                    while($row = $stmt5->fetch()) {
                                        $mat = new Materia();
                                        $mat->setid_materia($row['id_materia']);
                                        $mat->setnombreMateria($row['nombreMateria']);
                                        $hora->setMateria($mat);
                                    }
    
                                    $stmt6 = $conn->prepare("SELECT  id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia FROM horariodeconsulta where id_horariodeconsulta=$tempidhorario");
                                    $stmt6->execute();
    
                                        while($row = $stmt6->fetch()) {
                                            $ListaHorariosDeConsulta=array();
                                            $hor = new HorarioDeConsulta();
                                            $hor->setid_horariodeconsulta($row['id_horariodeconsulta']);
                                            $hor->sethora($row['hora']);
                                            $hor->setactivoDesde($row['activoDesde']);
                                            $hor->setactivoHasta($row['activoHasta']);
                                            $hor->setsemestre($row['semestre']);
                                                
                                                $tempDia =$row['fk_dia'];
                                                $tempProfesor =$row['fk_profesor'];
    
                                                $stmt7 = $conn->prepare("SELECT id_dia,dia FROM dia where id_dia=$tempDia"); 
                                                $stmt7->execute();
                                                while($row = $stmt7->fetch()) {
                                                    $dia = new Dia();
                                                    $dia->setid_dia($row['id_dia']);
                                                    $dia->setdia($row['dia']);
                                                    $hor->setdia($dia);
                                                }
                                                $stmt8 = $conn->prepare("SELECT id_profesor,apellido,nombre FROM profesor where id_profesor=$tempProfesor"); 
                                                $stmt8->execute();
                                                while($row = $stmt8->fetch()) {
                                                    $prof = new Profesor();
                                                    $prof->setid_profesor($row['id_profesor']);
                                                    $prof->setapellido($row['apellido']);
                                                    $prof->setnombre($row['nombre']);
                                                    $hor->setprofesor($prof);
                                                }
                                            $hora->setHorarioDeConsulta($hor);
                                            }

                                    if($hora->getPresentismo()){            
                                        array_push($ListHoraDeConsulta,$hora);
                                    }
                                }
                                   
                } 
            }
            // echo '<pre>'; print_r($ListHoraDeConsulta); echo '</pre>';
            $conn= null;
            return $ListHoraDeConsulta;
        }
        function buscarAlumnoDeUsuario($idusuario){
            $conn = $this->getconexion();
        
            $stmt = $conn->prepare("SELECT fk_alumno FROM usuario where id_usuario=$idusuario"); 
            $stmt->execute();
            $idalumno=null;
            $conn= null;
            while($row = $stmt->fetch()) {
               $idalumno=$row['fk_alumno'];
            }
           return $idalumno;
            }
            function idAlumnoaNombre($idalumno){
                $con= new conexion();
                $conn = $con->getconexion();
                $stmt3 = $conn->prepare("SELECT apellido,nombre FROM alumno where id_alumno=$idalumno"); 
                $stmt3->execute();
                while($row = $stmt3->fetch()) {
                    $apellido=$row['apellido'];
                    $nombre=$row['nombre'];
                }
                $NombreAlumno=$apellido." ".$nombre;
                $conn= null;
                return $NombreAlumno;
            }
}
?>