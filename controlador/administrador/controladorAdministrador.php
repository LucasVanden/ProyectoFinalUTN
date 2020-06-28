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
            $conn= null;
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
            $conn= null;
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
        $conn= null;
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
    $conn= null;
    return $ListaMaterias;
    }
    function BuscarProfesor(){
        $listaProfesor=array();
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_profesor,nombre,apellido,email,legajo FROM profesor where eliminado is null ORDER BY apellido "); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $prof = new Profesor();
            $prof->setid_profesor($row['id_profesor']);
            $prof->setapellido($row['apellido']);
            $prof->setnombre($row['nombre']);
            $prof->setemail($row['email']);
            $prof->setlegajo($row['legajo']);
           array_push($listaProfesor,$prof);
        }
        $conn= null;
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
        $conn= null;
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
        $conn= null;
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
        $conn= null;
        return $listaMateriasProfesor;
    }


    function ConsultarAsuetoReceso($año,$mes){
        $con= new conexion();
        $conn=$con->getconexion();
        $fecha=$año."-".$mes."%";
            $listaAsuetos=array();
            $stmt = $conn->prepare("SELECT fechaAsueto FROM asueto WHERE tipo='receso' and fechaAsueto LIKE '$fecha'");  
            $stmt->execute();
            while($row = $stmt->fetch()) {
                $asueto=$row['fechaAsueto'];
                $numero=date("j",strtotime($asueto));
                array_push($listaAsuetos,$numero);
            }
            $conn= null;
            return $listaAsuetos;
    
    }
    function ConsultarAsuetoFeriado($año,$mes){
        $con= new conexion();
        $conn=$con->getconexion();
        $fecha=$año."-".$mes."%";
            $listaAsuetos=array();
            $stmt = $conn->prepare("SELECT fechaAsueto FROM asueto WHERE tipo='feriado' and fechaAsueto LIKE '$fecha'");  
            $stmt->execute();
            while($row = $stmt->fetch()) {
                $asueto=$row['fechaAsueto'];
                $numero=date("j",strtotime($asueto));
                array_push($listaAsuetos,$numero);
            }
            $conn= null;
            return $listaAsuetos;
    
    }
    function ConsultarAsuetoAsueto($año,$mes){
        $con= new conexion();
        $conn=$con->getconexion();
        $fecha=$año."-".$mes."%";
            $listaAsuetos=array();
            $stmt = $conn->prepare("SELECT fechaAsueto FROM asueto WHERE tipo='asueto' and fechaAsueto LIKE '$fecha'");  
            $stmt->execute();
            while($row = $stmt->fetch()) {
                $asueto=$row['fechaAsueto'];
                $numero=date("j",strtotime($asueto));
                array_push($listaAsuetos,$numero);
            }
            $conn= null;
            return $listaAsuetos;
    
    }

    function ConsultarMesa($año,$mes){
        $con= new conexion();
        $conn=$con->getconexion();
        $fecha=$año."-".$mes."%";
            $listaMesas=array();
            $stmt = $conn->prepare("SELECT fechaMesa FROM fechamesa WHERE fechaMesa LIKE '$fecha'");  
            $stmt->execute();
            while($row = $stmt->fetch()) {
                $mesa=$row['fechaMesa'];
                $numero=date("j",strtotime($mesa));
                array_push($listaMesas,$numero);
            }
            $conn= null;
            return $listaMesas;
    
    }

    function BuscarCuerpoAulas(){
        $con= new conexion();
        $conn=$con->getconexion();
        
            $listaAula=array();
            $stmt = $conn->prepare("SELECT DISTINCT cuerpoAula FROM aula ORDER BY cuerpoAula");  
            $stmt->execute();
            while($row = $stmt->fetch()) {
                $aula=$row['cuerpoAula'];
                array_push($listaAula,$aula);
            }
            $conn= null;
            return $listaAula;
    
    }
    function BuscarAulaID($idAula){
        $con= new conexion();
        $conn=$con->getconexion();
        $aula = new Aula();
            $stmt = $conn->prepare("SELECT id_aula,cuerpoAula,nivelAula,numeroAula FROM aula where id_aula=$idAula ORDER BY cuerpoAula");  
            $stmt->execute();
            while($row = $stmt->fetch()) {
                
                $aula->setid_aula($row['id_aula']);
                $aula->setcuerpoAula($row['cuerpoAula']);
                $aula->setnivelAula($row['nivelAula']);
                $aula->setnumeroAula($row['numeroAula']);
            }
            $conn= null;
            return $aula;
    
    }

    function aulasOcupadas($aula){
       
        $b=array();
        $con=new conexion();
        $conn=$con->getconexion();
        $stmt=$conn->prepare("SELECT departamento.nombre,materia.nombreMateria,horariodeconsulta.semestre, profesor.apellido,profesor.nombre
        FROM horariodeconsulta
        INNER JOIN profesor 
            ON horariodeconsulta.fk_profesor = profesor.id_profesor
        INNER JOIN materia 
            ON horariodeconsulta.fk_materia = materia.id_materia
        INNER JOIN departamento 
            ON departamento.id_departamento = materia.fk_departamento
        WHERE horariodeconsulta.fk_aula=$aula");
         $stmt->execute();
         while($row = $stmt->fetch()) {
             $departamento=$row[0];
             $materia=$row[1];
             $semestre=$row[2];
             $apellido=$row[3];
             $nombre=$row[4];
             $a=array();
             array_push($a,$departamento,$materia,$semestre,$apellido,$nombre);
             array_push($b,$a);
         }
         $conn= null;
         return $b;
    }
    function departamentosOcupados($aula){
       
        $a=array();
        $con=new conexion();
        $conn=$con->getconexion();
        $stmt=$conn->prepare("SELECT nombre
        FROM departamento
        WHERE fk_aula=$aula");
         $stmt->execute();
         while($row = $stmt->fetch()) {
             $departamento=$row[0];
             array_push($a,$departamento);
         }
         $conn= null;
         return $a;
    }
    function MostrarMateriasProfesor(){
        $b=array();
        $con=new conexion();
        $conn=$con->getconexion();
        $stmt=$conn->prepare("SELECT dedicacion_materia_profesor.id_dedicacion_materia_profesor,materia.nombreMateria, profesor.apellido,profesor.nombre,dedicacion.tipo,departamento.nombre
        FROM dedicacion_materia_profesor
        INNER JOIN profesor 
            ON dedicacion_materia_profesor.fk_profesor = profesor.id_profesor
        INNER JOIN materia 
            ON dedicacion_materia_profesor.fk_materia = materia.id_materia
        INNER JOIN dedicacion 
            ON dedicacion_materia_profesor.fk_dedicacion = dedicacion.id_dedicacion
        INNER JOIN departamento
            ON materia.fk_departamento = departamento.id_departamento
        WHERE dedicacion_materia_profesor.eliminado is null");
         $stmt->execute();
         while($row = $stmt->fetch()) {
             $id=$row[0];
             $materia=$row[1];
             $apellido=$row[2];
             $nombre=$row[3];
             $dedicacion=$row[4];
             $departamento=$row[5];
             $a=array();
             array_push($a,$id,$departamento,$materia,$apellido,$nombre,$dedicacion);
             array_push($b,$a);
         }
         $conn= null;
         return $b;
    }
    function BuscarProfesorID($id){
        $conn = $this->getconexion();
        $stmt = $conn->prepare("SELECT id_profesor,nombre,apellido,email,legajo FROM profesor where id_profesor=$id"); 
        $stmt->execute();
        while($row = $stmt->fetch()) {
            $prof = new Profesor();
            $prof->setid_profesor($row['id_profesor']);
            $prof->setapellido($row['apellido']);
            $prof->setnombre($row['nombre']);
            $prof->setemail($row['email']);
            $prof->setlegajo($row['legajo']);
        }
        $conn= null;
        return $prof;
        }

        function BuscarAlumnos(){
            $listaAlumnos=array();
            $conn = $this->getconexion();
            $stmt4 = $conn->prepare("SELECT id_alumno,nombre,apellido,email,legajo,telefonoAlumno FROM alumno WHERE eliminado is null "); 
                    $stmt4->execute();
                    while($row = $stmt4->fetch()) {
                        $alum=new alumno();
                        $alum->setid_alumno($row['id_alumno']);
                        $alum->setnombre($row['nombre']);
                        $alum->setapellido($row['apellido']);
                        $alum->setemail($row['email']);
                        $alum->setlegajo($row['legajo']);
                        $alum->settelefonoAlumno($row['telefonoAlumno']);
                       array_push($listaAlumnos,$alum);
                    }
                    $conn= null;
            return $listaAlumnos;
        }
        function buscarAlumnoID($idalumno){
            $con= new conexion();
            $conn = $con->getconexion();
            $stmt3 = $conn->prepare("SELECT id_alumno,apellido,nombre,legajo,email,telefonoAlumno FROM alumno where id_alumno=$idalumno"); 
            $stmt3->execute();
            while($row = $stmt3->fetch()) {
                $alum=new alumno();
                $alum->setid_alumno($row['id_alumno']);
                $alum->setnombre($row['nombre']);
                $alum->setapellido($row['apellido']);
                $alum->setemail($row['email']);
                $alum->setlegajo($row['legajo']);
                $alum->settelefonoAlumno($row['telefonoAlumno']);
            }
            $conn= null;
            return $alum;
        }
        function BuscarPersonal(){
            $listaProfesor=array();
            $conn = $this->getconexion();
            $stmt = $conn->prepare("SELECT fk_persona FROM usuario where fk_perfil=5 "); 
            $stmt->execute();
            while($row = $stmt->fetch()) {
                $id=$row['fk_persona'];
                $stmt2 = $conn->prepare("SELECT id_persona,nombre,apellido,email,dni FROM persona where eliminado is null and id_persona=$id ORDER BY apellido "); 
                $stmt2->execute();
                while($row = $stmt2->fetch()) {
                    $prof = new Profesor();
                    $prof->setid_profesor($row['id_persona']);
                    $prof->setapellido($row['apellido']);
                    $prof->setnombre($row['nombre']);
                    $prof->setemail($row['email']);
                    $prof->setlegajo($row['dni']);
                array_push($listaProfesor,$prof);
                }
            }
            $conn= null;
            return $listaProfesor;
        }
        function BuscarAdmin(){
            $listaProfesor=array();
            $conn = $this->getconexion();
            $stmt = $conn->prepare("SELECT fk_persona FROM usuario where fk_perfil=6 "); 
            $stmt->execute();
            while($row = $stmt->fetch()) {
                $id=$row['fk_persona'];
                $stmt2 = $conn->prepare("SELECT id_persona,nombre,apellido,email,dni FROM persona where eliminado is null and id_persona=$id ORDER BY apellido "); 
                $stmt2->execute();
                while($row = $stmt2->fetch()) {
                    $prof = new Profesor();
                    $prof->setid_profesor($row['id_persona']);
                    $prof->setapellido($row['apellido']);
                    $prof->setnombre($row['nombre']);
                    $prof->setemail($row['email']);
                    $prof->setlegajo($row['dni']);
                array_push($listaProfesor,$prof);
                }
            }
            $conn= null;
            return $listaProfesor;
        }
        function BuscarPersonaID($id){
            $conn = $this->getconexion();
            $stmt = $conn->prepare("SELECT id_persona,nombre,apellido,email,dni FROM persona where id_persona=$id"); 
            $stmt->execute();
            while($row = $stmt->fetch()) {
                $prof = new Profesor();
                $prof->setid_profesor($row['id_persona']);
                $prof->setapellido($row['apellido']);
                $prof->setnombre($row['nombre']);
                $prof->setemail($row['email']);
                $prof->setlegajo($row['dni']);
            }
            $conn= null;
            return $prof;
            }

            function BuscarPermisos($idRol){
                $permisos=array();
                $conn = $this->getconexion();
                $stmt = $conn->prepare("SELECT privilegio.nombrePrivilegio,privilegio.numeroPermiso
                FROM privilegio
                INNER JOIN privilegioperfil 
                    ON privilegioperfil.fk_privilegio = privilegio.id_privilegio
                INNER JOIN perfil 
                    ON privilegioperfil.fk_perfil = perfil.id_perfil
                WHERE perfil.id_perfil='$idRol'"); 
                $stmt->execute();
                while($row = $stmt->fetch()) {
                    array_push($permisos,$row[1]);
                }
                $conn= null;
                return $permisos;

            }
            function BuscarPermisosNombre($idRol){
                $permisos=array();
                $conn = $this->getconexion();
                $stmt = $conn->prepare("SELECT privilegio.nombrePrivilegio,privilegio.numeroPermiso
                FROM privilegio
                INNER JOIN privilegioperfil 
                    ON privilegioperfil.fk_privilegio = privilegio.id_privilegio
                INNER JOIN perfil 
                    ON privilegioperfil.fk_perfil = perfil.id_perfil
                WHERE perfil.id_perfil='$idRol'"); 
                $stmt->execute();
                while($row = $stmt->fetch()) {
                    $permisos1=array();
                    array_push($permisos1,$row[0],$row[1]);
                    array_push($permisos,$permisos1);
                }
                $conn= null;
                return $permisos;

            }
            function buscarNombrePrivilegios(){
                $permisos=array();
                $conn = $this->getconexion();
                $stmt = $conn->prepare("SELECT privilegio.nombrePrivilegio,privilegio.numeroPermiso
                FROM privilegio");
                $stmt->execute();
                while($row = $stmt->fetch()) {
                    $permisos1=array();
                    array_push($permisos1,$row[0],$row[1]);
                    array_push($permisos,$permisos1);
                }
                $conn= null;
                return $permisos;

            }
            function BuscarProfesornoDirector(){
                $listaProfesor=array();
                $conn = $this->getconexion();
                $stmt = $conn->prepare("SELECT id_profesor,nombre,apellido,email,legajo FROM profesor 
                INNER JOIN usuario
                ON usuario.usuario=profesor.legajo
                where eliminado is null and fk_perfil=2 ORDER BY apellido"); 
                $stmt->execute();
                while($row = $stmt->fetch()) {
                    $prof = new Profesor();
                    $prof->setid_profesor($row['id_profesor']);
                    $prof->setapellido($row['apellido']);
                    $prof->setnombre($row['nombre']);
                    $prof->setemail($row['email']);
                    $prof->setlegajo($row['legajo']);
                   array_push($listaProfesor,$prof);
                }
                $conn= null;
                return $listaProfesor;
            }
}
?>