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



}