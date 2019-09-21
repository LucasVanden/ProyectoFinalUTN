<?php
require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR . '/modelo/persistencia/conexion.php');
require_once ($DIR . '/modelo/Alumno.php');
require_once ($DIR . '/modelo/Materia.php');
require_once ($DIR . '/modelo/HorarioDeConsulta.php');
require_once ($DIR . '/modelo/Profesor.php');
require_once ($DIR . '/modelo/HoraDeConsulta.php');
require_once ($DIR . '/modelo/Departamento.php');
require_once ($DIR . '/modelo/AnotadosEstado.php');
require_once ($DIR . '/modelo/DetalleAnotados.php');
require_once ($DIR . '/modelo/EstadoAnotados.php');
require_once ($DIR . '/modelo/AvisoProfesor.php');
class AlumnoControlador extends conexion
{

function buscarAlumno($id){
	$conn = $this->getconexion();

	$stmt = $conn->prepare("SELECT id_alumno,legajo,apellido,nombre,email,fechaNacimientoAlumno,telefonoAlumno FROM alumno where id_alumno=$id"); 
    $stmt->execute();
	$ListaAlumno=array();
    while($row = $stmt->fetch()) {
        $alum = new Alumno();
        $alum->setid_alumno($row['id_alumno']);
		$alum->setlegajo($row['legajo']);
        $alum->setapellido($row['apellido']);
        $alum->setnombre($row['nombre']);
        $alum->setemail($row['email']);
        $alum->setfechaNacimientoAlumno($row['fechaNacimientoAlumno']);
        $alum->settelefonoAlumno($row['telefonoAlumno']);
       $alum->setmateria($this->buscarMateriasAlumno($id));
       array_push($ListaAlumno,$alum);
    }
    $conn= null;
   // return $ListaAlumno[0]->getlegajo();
    return $ListaAlumno;
    }

    function buscarMateriasAlumno($id){

        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT fk_materia FROM materias_alumno where fk_alumno=$id"); 
        $stmt->execute();

        $ListaMaterias=array();
        while($row = $stmt->fetch()) {
            $materia= $row['fk_materia'];
            $stmt2 = $conn->prepare("SELECT id_materia,nombreMateria,fk_departamento,fk_dia FROM materia where id_materia=$materia"); 
            $stmt2->execute();
            while($row = $stmt2->fetch()) {
                $mat = new Materia();
                $mat->setid_materia($row['id_materia']);
                $mat->setnombreMateria($row['nombreMateria']);
                // $mat->setfk_departamento($row['fk_departamento']);
                // $mat->setfk_dia($row['fk_dia']);
           array_push($ListaMaterias,$mat);
        }
    }
        $conn= null;
        return $ListaMaterias;
        }
//remplazada
    function buscarHorariosDeConsultaDeMateria($idmateria){
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_materia,nombreMateria,fk_departamento,fk_dia FROM materia where id_materia=$idmateria"); 
        $stmt->execute();

        while($row = $stmt->fetch()) {
            $mat = new Materia();
            $mat->setid_materia($row['id_materia']);
            $mat->setnombreMateria($row['nombreMateria']);
            $ListaHorariosDeConsulta=array();
            //quiza incecsarios
           // $mat->setapellido($row['fk_departamento']);
            //$mat->setnombre($row['fk_dia']);
           
            $conn = $this->getconexion();
            $stmt2 = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia FROM horariodeconsulta where fk_materia=$idmateria"); 
            $stmt2->execute();

            while($row = $stmt2->fetch()) {
                $hor = new HorarioDeConsulta();
                $hor->setid_horariodeconsulta($row['id_horariodeconsulta']);
                $hor->sethora($row['hora']);
                $hor->setactivoDesde($row['activoDesde']);
                $hor->setactivoHasta($row['activoHasta']);
                $hor->setsemestre($row['semestre']);
                    
                    $tempDia =$row['fk_dia'];
                    $tempProfesor =$row['fk_profesor'];

                    $stmt3 = $conn->prepare("SELECT id_dia,dia FROM dia where id_dia=$tempDia"); 
                    $stmt3->execute();
                    while($row = $stmt3->fetch()) {
                        $dia = new Dia();
                        $dia->setid_dia($row['id_dia']);
                        $dia->setdia($row['dia']);
                        $hor->setdia($dia);
                    }

                    
                    $stmt4 = $conn->prepare("SELECT id_profesor,apellido,nombre FROM profesor where id_profesor=$tempProfesor"); 
                    $stmt4->execute();
                    while($row = $stmt4->fetch()) {
                        $prof = new Profesor();
                        $prof->setid_profesor($row['id_profesor']);
                        $prof->setapellido($row['apellido']);
                        $prof->setnombre($row['nombre']);
                        $hor->setprofesor($prof);
                    }
               
            array_push($ListaHorariosDeConsulta,$hor);
            }
            $mat->setHorarioDeConsulta($ListaHorariosDeConsulta);
        }
return $mat;

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







    function buscarHorariosDeConsultaDeMateriaporhoraconsulta($idmateria){
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_materia,nombreMateria,fk_departamento,fk_dia FROM materia where id_materia=$idmateria"); 
        $stmt->execute();

        while($row = $stmt->fetch()) {
            $mat = new Materia();
            $mat->setid_materia($row['id_materia']);
            $mat->setnombreMateria($row['nombreMateria']);
            $ListHoraDeConsulta=array();

            $conn = $this->getconexion();
            $stmt2 = $conn->prepare("SELECT id_horadeconsulta,fk_horariodeconsulta FROM horadeconsulta where fk_materia=$idmateria and estadoVigencia='activo'"); 
            $stmt2->execute();

            while($row = $stmt2->fetch()) {
                $hora = new HoraDeConsulta();
              
                $hora->setid_horadeconsulta($row['id_horadeconsulta']);
                    
                $tempidhorario =$row['fk_horariodeconsulta'];
                
                $stmt3 = $conn->prepare("SELECT  id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia FROM horariodeconsulta where id_horariodeconsulta=$tempidhorario");
                $stmt3->execute();

                    while($row = $stmt3->fetch()) {
                        $ListaHorariosDeConsulta=array();
                        $hor = new HorarioDeConsulta();
                        $hor->setid_horariodeconsulta($row['id_horariodeconsulta']);
                        $hor->sethora($row['hora']);
                        $hor->setactivoDesde($row['activoDesde']);
                        $hor->setactivoHasta($row['activoHasta']);
                        $hor->setsemestre($row['semestre']);
                            
                            $tempDia =$row['fk_dia'];
                            $tempProfesor =$row['fk_profesor'];
        
                            $stmt4 = $conn->prepare("SELECT id_dia,dia FROM dia where id_dia=$tempDia"); 
                            $stmt4->execute();
                            while($row = $stmt4->fetch()) {
                                $dia = new Dia();
                                $dia->setid_dia($row['id_dia']);
                                $dia->setdia($row['dia']);
                                $hor->setdia($dia);
                            }
                            $stmt5 = $conn->prepare("SELECT id_profesor,apellido,nombre FROM profesor where id_profesor=$tempProfesor"); 
                            $stmt5->execute();
                            while($row = $stmt5->fetch()) {
                                $prof = new Profesor();
                                $prof->setid_profesor($row['id_profesor']);
                                $prof->setapellido($row['apellido']);
                                $prof->setnombre($row['nombre']);
                                $hor->setprofesor($prof);
                            }
                        $hora->setHorarioDeConsulta($hor);
                        }
                 array_push($ListHoraDeConsulta,$hora);
                }
            $mat->setHoraDeConsulta($ListHoraDeConsulta);
        }
        return $mat;

    }
//sin uso
    function crearAnotacion($idhoradeconsulta,$mensaje,$idalumno){
        
        $conn = $this->getconexion();
        $fecha=getdate();
        $fechahora=$fecha['hours'] + $fecha['minutes']+ $fecha['seconds'];
        $fechadia= $fecha['year']+'-'+$fecha['mon']+'-'+$fecha['mday'];
        $stmt = $conn->prepare("INSERT INTO `detalleanotados` (`id_detalleanotados`, `fechaDesdeAnotados`, `horaDetalleAnotados`, `tema`, `fk_alumno`, `fk_horadeconsulta`) 
        VALUES (NULL, $fechadia, $fechahora , $mensaje, $idalumno, $idhoradeconsulta);"); 
        $stmt->execute();

    }

    function BuscarProfesor(){
        $listaProfesor=array();
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_profesor,nombre,apellido,email FROM profesor ORDER BY apellido "); 
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

    function buscarHorariosDeConsultaporProfesor($idprofesor){
        $profesorHorarios=array();
        $listaHorarios=array();
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_profesor,nombre,apellido,email FROM profesor where id_profesor=$idprofesor "); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $prof = new Profesor();
            $prof->setid_profesor($row['id_profesor']);
            $prof->setapellido($row['apellido']);
            $prof->setnombre($row['nombre']);
            $prof->setemail($row['email']);
           array_push($profesorHorarios,$prof);
        }
        $stmt2 = $conn->prepare("SELECT id_horadeconsulta,fk_horariodeconsulta,fk_materia FROM horadeconsulta where fk_profesor=$idprofesor and estadoVigencia='activo'"); 
            $stmt2->execute();
          

            while($row = $stmt2->fetch()) {
                $hora = new HoraDeConsulta();
                $hora->setid_horadeconsulta($row['id_horadeconsulta']);
                $tempidhorario =$row['fk_horariodeconsulta'];
                $temporalMateriaid =$row['fk_materia'];

                  $stmt3 = $conn->prepare("SELECT  id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia FROM horariodeconsulta where id_horariodeconsulta=$tempidhorario");
                  $stmt3->execute();

                    while($row = $stmt3->fetch()) {
                        $ListaHorariosDeConsulta=array();
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
                array_push($listaHorarios,$hora);
                }
                $stmt5 = $conn->prepare("SELECT id_materia,nombreMateria,fk_departamento,fk_dia FROM materia where id_materia=$temporalMateriaid"); 
                $stmt5->execute();
        
                while($row = $stmt5->fetch()) {
                    $mat = new Materia();
                    $mat->setid_materia($row['id_materia']);
                    $mat->setnombreMateria($row['nombreMateria']);
                    $hora->setMateria($mat);
                }
              
    }
    array_push($profesorHorarios,$listaHorarios);
    return $profesorHorarios;
}



function AnotadoRepetido($idhora,$idalumno){
   
    $conn = $this->getconexion();
    $stmt = $conn->prepare("SELECT id_detalleanotados FROM detalleanotados where fk_horadeconsulta=$idhora and fk_alumno=$idalumno "); 
    $stmt->execute();
    $res;
    $respuesta=false;
        while($row = $stmt->fetch()) {
                $detalle = new Detalleanotados();
                $detalle->setid_detalleanotados($row['id_detalleanotados']);
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
                $res=$detalle;
        }  
        if(isset($res)){
        $listadetalles= $res->getAnotadosEstado();
     if  ( end($listadetalles)->getEstadoAnotados()->getnombreEstado()=="Anotado") {
        $respuesta=true; }
     } 
     return $respuesta;
    }
     function MisAnotaciones($idalumno){

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
                                $listaAvisos=array();    
                                $tempidhorario =$row['fk_horariodeconsulta'];
                                $tempmaeria =$row['fk_materia'];
                                $tempidhora=$row['id_horadeconsulta'];
                                $notificacion=null;

                                $stmt5 = $conn->prepare("SELECT id_avisoprofesor,fechaAvisoProfesor,detalleDescripcion FROM avisoprofesor where fk_horadeconsulta=$tempidhora"); 
                                $stmt5->execute();

                                while($row = $stmt5->fetch()) {
                                    $aviso = new AvisoProfesor();
                                    $aviso->setid_avisoprofesor($row['id_avisoprofesor']);
                                    $aviso->setfechaAvisoProfesor($row['fechaAvisoProfesor']);
                                    $aviso->setdetalleDescripcion($row['detalleDescripcion']);
                                    array_push($listaAvisos,$aviso);
                                    $notificacion=true;
                                    
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
                                                if(isset($notificacion)){
                                array_push($ListHoraDeConsulta,$hora);
                                                }
                                }
                               
            } 
        }
        // echo '<pre>'; print_r($ListHoraDeConsulta); echo '</pre>';
        return $ListHoraDeConsulta;
    }

    function buscarAlumnoDeUsuario($idusuario){
        $conn = $this->getconexion();
    
        $stmt = $conn->prepare("SELECT fk_alumno FROM usuario where id_usuario=$idusuario"); 
        $stmt->execute();
        $idalumno=null;
        while($row = $stmt->fetch()) {
           $idalumno=$row['fk_alumno'];
        }
       return $idalumno;
        }


}?>