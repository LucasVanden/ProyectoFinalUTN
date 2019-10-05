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
            $stmt6 = $conn->prepare("SELECT id_avisoProfesor,detalleDescripcion,fechaAvisoProfesor,horaAvisoProfesor FROM avisoprofesor where fk_horadeconsulta=$temphoraconsulta"); 
            $stmt6->execute();
            while($row = $stmt6->fetch()) {
                $aviso= new AvisoProfesor();
                $aviso->setid_avisoProfesor($row['id_avisoProfesor']);
                $aviso->setdetalleDescripcion($row['detalleDescripcion']);
                $aviso->setfechaAvisoProfesor($row['fechaAvisoProfesor']);
                $aviso->sethoraAvisoProfesor($row['horaAvisoProfesor']);
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

    function detallealumnosAnotados($idhora){
        $ListDetalles=array();
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_detalleanotados,fk_horadeconsulta,fk_alumno,tema FROM detalleanotados where fk_horadeconsulta=$idhora "); 
        $stmt->execute();
       
            while($row = $stmt->fetch()) {
                    $detalle = new Detalleanotados();
                    $detalle->setid_detalleanotados($row['id_detalleanotados']);
                    $detalle->setfk_horadeconsulta($row['fk_horadeconsulta']);
                    $detalle->settema($row['tema']);
                    $tempidalumno=($row['fk_alumno']);

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
                    $stmt4 = $conn->prepare("SELECT nombre,apellido,email,legajo FROM alumno where id_alumno=$tempidalumno "); 
                    $stmt4->execute();
                    while($row = $stmt4->fetch()) {
                        $alum=new alumno();
                        $alum->setnombre($row['nombre']);
                        $alum->setapellido($row['apellido']);
                        $alum->setemail($row['email']);
                        $alum->setlegajo($row['legajo']);
                        $detalle->setAlumno($alum);
                    }
                    $detalle->setAnotadosEstado($Estados);
                    
                    array_push($ListDetalles,$detalle);
            } 
                $listaDetallesAnotados=array();
            foreach ($ListDetalles as $detalle) {
                    //    echo $detalle->getAnotadosEstado()[0]->getid_anotadosEstado();
                    $d= $detalle->getAnotadosEstado();
                if  ( end($d)->getEstadoAnotados()->getnombreEstado()=="Anotado") {
                array_push($listaDetallesAnotados,$detalle);
                }      
            }
            return $listaDetallesAnotados;
        }


        function buscarMateriaDeHoradeconsulta($idhora){
          
            $conn = $this->getconexion();
            $stmt = $conn->prepare("SELECT fk_materia FROM horadeconsulta where id_horadeconsulta=$idhora "); 
            $stmt->execute();
           
                while($row = $stmt->fetch()) {
                    $temp=$row['fk_materia'];
                    $stmt = $conn->prepare("SELECT nombreMateria FROM materia where id_materia=$temp "); 
                    $stmt->execute();
                    while($row = $stmt->fetch()) {
                        $mat= $row['nombreMateria'];
                    }
                    }
                return $mat;
                }

function buscarHorariosParallenarEnlosSelect($idmateria,$idprofesor){
    $ListaHorariosDeConsulta=array();
    $conn = $this->getconexion();
    $stmt = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,semestre,fk_dia,n FROM horariodeconsulta where fk_profesor=$idprofesor AND fk_materia=$idmateria AND activoHasta='0000-00-00'" ); 
    $stmt->execute();
    while($row = $stmt->fetch()) {
        
        $hor = new HorarioDeConsulta();
        $hor->setid_horariodeconsulta($row['id_horariodeconsulta']);
        $hor->sethora($row['hora']);
        $hor->setactivoDesde($row['activoDesde']);
        $hor->setsemestre($row['semestre']);
        $hor->setn($row['n']);
            
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


                function mayorMentorigual($horasql1,$signo,$hora2,$min2){
                    $hora=  substr($horasql1, 0, 2);
                    $min=substr($horasql1, 3, 2);
                      //  $hora= date('H',$horasql1);
                       // $min=date('i',$horasql1);
                        switch ($signo) {
                            case '>':
                                if($hora>$hora2){
                                    return true;}
                                        elseif ($hora<$hora2) {
                                            return false;}
                                                elseif($min>$min2){return true;}
                                                    elseif ($min<$min2){return false;}
                                                        else return false;
                                
                                break;
                            case '<':
                                if($hora<$hora2){
                                    return true;}
                                        elseif ($hora>$hora2) {
                                            return false;}
                                                elseif($min<$min2){return true;}
                                                    elseif ($min>$min2){return false;}
                                                        else return false;
                                break;
                            case "==":
                                if($hora==$hora2){
                                    if ($min==$min2)
                                        {return true;}
                                }
                                else return false;
                                break;
                        }
                    }

                    function temp(){

                        echo "ULTIMO ID";
                        $pikachu= new conexion();

                        $pikachu= $this->getconexion();
                        $stmt = $pikachu->prepare("INSERT INTO `materia` (`id_materia`,`nombreMateria`,`fk_departamento`,`fk_dia`)
                        VALUES (null, 'materia','1','1');");  
                        $stmt->execute();
                        $id = $pikachu->lastInsertId("materia");
                        echo $id;
                    }

                    function horarioIngresadoIgualAlAnterior($diaingresadonumero,$horaingresada,$miningresado,$semestreDeLaConsulta,$idprofesor,$idmateria){
                      $igual=false;
                        $con= new conexion();
                        $hora="{$horaingresada}:{$miningresado}";
                        $conn = $con->getconexion();
                        $stmt = $conn->prepare("SELECT id_horariodeconsulta,hora,activoDesde,activoHasta,semestre,fk_dia,fk_profesor,fk_materia 
                        FROM horariodeconsulta 
                        where fk_profesor=$idprofesor and fk_materia=$idmateria and activoHasta='0000-00-00' and semestre=$semestreDeLaConsulta and hora='$hora' and fk_dia='$diaingresadonumero'"); 
                        $stmt->execute();
                         while($row = $stmt->fetch()) {
                          $igual= true;
                        }
                      return $igual;
                    }

















}