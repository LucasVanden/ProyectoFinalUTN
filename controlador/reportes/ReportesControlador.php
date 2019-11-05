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
require_once ($DIR . $Dia);
date_default_timezone_set('America/Argentina/Mendoza');
class ReportesControlador extends conexion
{
    function auxiliarLabels($etiquetas){

        $labels="[";
        foreach ($etiquetas as $item){
        $labels=$labels.'"'.$item.'",';
        }
        $labels=substr($labels, 0, -1);
        $labels=$labels."]";
        return $labels;
    }
    function auxiliarValores($valores){

        $values="[";
        foreach ($valores as $item){
        $values=$values.$item.',';
        }
        $values=substr($values, 0, -1);
        $values=$values."]";
        return $values;
    }

    function AlumnosPorMateria($departamento,$fechaDesde,$fechaHasta){
        $conn = $this->getconexion();
        $listaMaterias=array();
        $listaCantidadPresentesMaterias=array();
        $stmt = $conn->prepare("SELECT id_materia,nombreMateria FROM materia where fk_departamento=$departamento"); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $idmat=$row['id_materia'];
            $mat=$row['nombreMateria'];
            $cantidadAsitencia=0;

            $stmt2 = $conn->prepare("SELECT id_horadeconsulta FROM horadeconsulta where fk_materia=$idmat and fechaDesdeAnotados>='$fechaDesde' and fechaHastaAnotados<='$fechaHasta'"); 
            $stmt2->execute();
            while($row = $stmt2->fetch()) {
              
                $horadeconsulta=$row['id_horadeconsulta'];

                $stmt3 = $conn->prepare("SELECT id_detalleanotados FROM detalleanotados where fk_horadeconsulta=$horadeconsulta"); 
                $stmt3->execute();
                while($row = $stmt3->fetch()) {
                      
                        $detalle=$row['id_detalleanotados'];
            
                        $stmt4 = $conn->prepare("SELECT id_anotadoestado,fechaAnotadosEstado,horaAnotadosEstado,fk_estadoanotados FROM anotadosestado where fk_detalleanotados=$detalle "); 
                        $stmt4->execute();
                        while($row = $stmt4->fetch()) {
                           
                            $idnombreestado=$row['fk_estadoanotados'];
                            if($idnombreestado==4){ //4 -> PRESENTE
                                $cantidadAsitencia++;
                            }
                        }
                    }
            }
           array_push($listaMaterias,$mat);
           array_push($listaCantidadPresentesMaterias,$cantidadAsitencia);
        }
        $respuesta=array();
        array_push($respuesta,$listaMaterias);
        array_push($respuesta,$listaCantidadPresentesMaterias);
    
        return $respuesta;
    }
    function AlumnosPorProfesorPorMateria($idmateria,$fechaDesde,$fechaHasta){
        $conn = $this->getconexion();
        $listraNombreProfesor=array();
        $listaCantidadPresentesProfesor=array();
        $stmt = $conn->prepare("SELECT id_materia,nombreMateria FROM materia where id_materia=$idmateria"); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $idmat=$row['id_materia'];
            $mat=$row['nombreMateria'];

            $stmt2 = $conn->prepare("SELECT DISTINCT fk_profesor FROM horariodeconsulta where fk_materia='$idmat'"); 
            $stmt2->execute();
            while($row = $stmt2->fetch()) {
                $fk_profesor=$row['fk_profesor'];
                
                $stmt3 = $conn->prepare("SELECT apellido,nombre FROM profesor where id_profesor=$fk_profesor"); 
                $stmt3->execute();
                while($row = $stmt3->fetch()) {
                    $apellido=$row['apellido'];
                    $nombre=$row['nombre'];
                }
                $Nombreprofesor=$apellido." ".$nombre;
                $cantidadAsitencia=0;

                $stmt4 = $conn->prepare("SELECT id_horadeconsulta FROM horadeconsulta where fk_materia=$idmat and fk_profesor=$fk_profesor and fechaDesdeAnotados>='$fechaDesde' and fechaHastaAnotados<='$fechaHasta'"); 
                $stmt4->execute();
                while($row = $stmt4->fetch()) {
                
                    $horadeconsulta=$row['id_horadeconsulta'];

                    $stmt5 = $conn->prepare("SELECT id_detalleanotados FROM detalleanotados where fk_horadeconsulta=$horadeconsulta"); 
                    $stmt5->execute();
                    while($row = $stmt5->fetch()) {
                        
                            $detalle=$row['id_detalleanotados'];
                
                            $stmt6 = $conn->prepare("SELECT id_anotadoestado,fechaAnotadosEstado,horaAnotadosEstado,fk_estadoanotados FROM anotadosestado where fk_detalleanotados=$detalle "); 
                            $stmt6->execute();
                            while($row = $stmt6->fetch()) {
                            
                                $idnombreestado=$row['fk_estadoanotados'];
                                if($idnombreestado==4){ //4 -> PRESENTE
                                    $cantidadAsitencia++;
                                }
                            }
                        }
                }
           array_push($listraNombreProfesor,$Nombreprofesor);
           array_push($listaCantidadPresentesProfesor,$cantidadAsitencia);
        }
    }
        $respuesta=array();
        array_push($respuesta,$listraNombreProfesor);
        array_push($respuesta,$listaCantidadPresentesProfesor);
    
        return $respuesta;
    }
    function AlumnosPorDepartamento($fechaDesde,$fechaHasta){
        $conn = $this->getconexion();
        $listaNombreDepartamento=array();
        $listaCantidadPresentesDepartamento=array();

        $stmt0 = $conn->prepare("SELECT id_departamento,nombre FROM departamento"); 
        $stmt0->execute();
        while($row = $stmt0->fetch()) {
            $id_departamento=$row['id_departamento'];
            $nombre=$row['nombre'];
            $cantidadAsitencia=0;

            $stmt = $conn->prepare("SELECT id_materia,nombreMateria FROM materia where fk_departamento=$id_departamento"); 
            $stmt->execute();
            while($row = $stmt->fetch()) {
                $idmat=$row['id_materia'];
                $mat=$row['nombreMateria'];

                    $stmt4 = $conn->prepare("SELECT id_horadeconsulta FROM horadeconsulta where fk_materia=$idmat and fechaDesdeAnotados>='$fechaDesde' and fechaHastaAnotados<='$fechaHasta'"); 
                    $stmt4->execute();
                    while($row = $stmt4->fetch()) {
                    
                        $horadeconsulta=$row['id_horadeconsulta'];

                        $stmt5 = $conn->prepare("SELECT id_detalleanotados FROM detalleanotados where fk_horadeconsulta=$horadeconsulta"); 
                        $stmt5->execute();
                        while($row = $stmt5->fetch()) {
                            
                                $detalle=$row['id_detalleanotados'];
                    
                                $stmt6 = $conn->prepare("SELECT id_anotadoestado,fechaAnotadosEstado,horaAnotadosEstado,fk_estadoanotados FROM anotadosestado where fk_detalleanotados=$detalle "); 
                                $stmt6->execute();
                                while($row = $stmt6->fetch()) {
                                
                                    $idnombreestado=$row['fk_estadoanotados'];
                                    if($idnombreestado==4){ //4 -> PRESENTE
                                        $cantidadAsitencia++;
                                    }
                                }
                            }
                    }
            }
           array_push($listaNombreDepartamento,$nombre);
           array_push($listaCantidadPresentesDepartamento,$cantidadAsitencia);
    }
        $respuesta=array();
        array_push($respuesta,$listaNombreDepartamento);
        array_push($respuesta,$listaCantidadPresentesDepartamento);
    
        return $respuesta;
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
    function buscarPersonalDeUsuario($idusuario){
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT fk_persona FROM usuario where id_usuario=$idusuario"); 
        $stmt->execute();
        $idprofesor=null;
        while($row = $stmt->fetch()) {
           $idprofesor=$row['fk_persona'];

           $stmt3 = $conn->prepare("SELECT apellido,nombre FROM persona where id_persona=$idprofesor"); 
            $stmt3->execute();
            while($row = $stmt3->fetch()) {
                $apellido=$row['apellido'];
                $nombre=$row['nombre'];
            }
            $Nombreprofesor=$apellido." ".$nombre;
                
            
        }
        return $Nombreprofesor;
        }
}
?>