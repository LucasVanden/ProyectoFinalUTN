<?php
session_start();

require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
  }else{
    if($_SESSION['rol'] != 4){
        header('location: '. $URL.$login);
    }
  }
  
require_once ($DIR.$conexion);
require_once ($DIR.$ReportesControlador);

$MenuIndex= $URL.$MenuIndex;

$AsuetosMenu= $URL.$AsuetoMenu;
$Mesas= $URL.$Mesas;
$EditarAultaAsignada=$URL.$EditarAultaAsignada;
$BorrarAsueto=$URL.$BorrarAsueto;
$ABMAula=$URL.$ABMAula;
$abmDepartamento=$URL.$abmDepartamento;
$abmMateria=$URL.$abmMateria;
$menuAltaProfesor=$URL.$menuAltaProfesor;
$backup=$URL.$backup;
$altaAlumno=$URL.$altaAlumno;
$subirCargoaDirector=$URL.$subirCargoaDirector;
$CerrarhoraAusente=$URL.$CerrarhoraAusente;
$calcularAsistencia=$URL.$calcularAsistencia;

$_SESSION['comprobacion']=null;
$_SESSION['fechasBuscadas']=null;
$_SESSION['mostrarAulas']=null;

$_SESSION['departamentos']=null;
$_SESSION['idDepartamentoSeleccionado']=null;

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>aHora</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="./../assert/css/style.css" rel="stylesheet" type="text/css"/>
        
        <style type="text/css">
            body{
                padding:0px;
                margin:0px;
            }
            .nav ul{
                list-style: none;
                margin:0;
                padding:0;
            }
            .nav ul li {
                padding:15px;
                position:relative;
                width: 150px;
                vertical-align: middle;
                background-color: #0098cb;
                cursor:pointer;
                border-top: 1px solid white;
                -webkit-transition: all 0.3s;
                -o-transition: all 0.3s;
                transition: all 0.3s;
            }
            .nav ul li:{
                background-color: #0098cb;
            }
            .nav > ul > li{
                border-right: 1px solid yellow;
            }
            .nav ul ul{
                transition: all 0.3s;
                position: absolute;
                opacity:0;
                visibility: hidden;
                left:100%;
                top:-2%;
                border-left: 1px solid yellow; 
            }
            .nav ul li:hover > ul{
                opacity:1;
                visibility: visible;
            }
            .nav ul li a {
                color: white;
                text-decoration: none;
            }
        </style>
    </head>
    <body background = <?php echo $URL.$fondo?>>
    <script src="jquery.js"></script>
        <?php require './../partials/headera.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <h2>Menú Administrador</h2>
            <div class="nav">
                <ul align='left'>
                    <li><a href="<?php echo $AsuetosMenu ?>">Asuetos</a></li>
                        <ul>
                            <li><a href="http://localhost/ProyectoFinalUTN/vista/administrador/AsuetosReceso.php">Recesos</a></li>
                            <li><a href="#">Feriados</a></li>
                            <li><a href="#">Asuetos</a></li>
                            <li><a href="#">Borrar Fecha</a></li>
                        </ul>
                    <li><a href="<?php echo $Mesas ?>">Mesas</a></li>
                    <li><a href="<?php echo $ABMAula ?>">Aulas</a></li>
                        <ul>
                            <li><a href="#">Cargar Aulas</a></li>
                            <li><a href="#">Mostrar Aulas</a></li>
                        </ul>
                    <li><a href="<?php echo $abmDepartamento ?>">Departamentos</a></li>
                    <li><a href="<?php echo $abmMateria ?> ">Materias</a></li>
                    <li><a href="<?php echo $menuAltaProfesor ?>">Profesores</a></li>
                        <ul>
                            <li><a href="#">Alta Profesor</a></li>
                            <li><a href="#">Asignar Materia A Profesor</a></li>
                            <li><a href="#">Baja Materia Profesor</a></li>
                        </ul>
                    <li><a href="<?php echo $altaAlumno ?>">Alta alumno</a></li> 
                    <li><a href="<?php echo $subirCargoaDirector ?>">Cargo Director</a></li> 
                    <li><a href="<?php echo $CerrarhoraAusente ?>">Cerrar horas de Ausentes</a></li> 
                    <li><a href="<?php echo $calcularAsistencia ?>">calcular Asistencia</a></li> 
                    <li><a href="<?php echo $backup ?>">Backup</a></li> 
                </ul>
            </div>



<!--
            <div>
                <table id="tablaBuscar" style="border-color: #FFFFFF">  
             
                    
                        <tr>
                        <td>
                        <div>  <input type="submit" value="Asuetos" name="Obtener" formaction=<?php echo $AsuetosMenu ?>  /></div>
                        </td>
                        </tr>
                        <tr>
                        <td>   <div>  <input type="submit" value="Cargar Fecha de Mesa" name="Obtener" formaction=<?php echo $Mesas ?> /></div></td>
                        </tr>
                        <tr>
                        <td>   <div>  <input type="submit" value="Cargar Aula" name="Obtener" formaction=<?php echo $ABMAula ?> /></div></td>
                        <td>   <div>  <input type="submit" value="Editar Aula Asignada" name="Obtener" formaction=<?php echo $EditarAultaAsignada ?> /></div></td>
                        </tr>
                        <tr>
                        <td>   <div>  <input type="submit" value="Cargar Departamento" name="Obtener" formaction=<?php echo $abmDepartamento ?> /></div></td>
                        <td>   <div>  <input type="submit" value="Materia" name="Obtener" formaction=<?php echo $abmMateria ?> /></div></td>
                        <td>   <div>  <input type="submit" value="Profesor" name="Obtener" formaction=<?php echo $menuAltaProfesor ?> /></div></td>       
                        </tr>        

                             <tr>
                        <td>
                        <div>  <input type="submit" value="Backup" name="Obtener" formaction=<?php echo $backup ?>  /></div>
                        </td>
                        </tr> -->


    <footer>
       <?php require $DIR.$footer; ?>         
    </footer>  
</html>