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
$altaPersonal=$URL.$altaPersonal;
$subirCargoaDirector=$URL.$subirCargoaDirector;
$CerrarhoraAusente=$URL.$CerrarhoraAusente;
$calcularAsistencia=$URL.$calcularAsistencia;
$AsuetosReceso= $URL.$asutosReceso;
$AsuetosFeriado= $URL.$asutosFeriado;
$AsuetoAsueto=$URL.$AsuetoAsueto;

$altaProfesor=$URL.$altaProfesor;
$asignarMateriaAProfesor= $URL.$asignarMateriaAProfesor;
$bajaMateriaProfesor= $URL.$bajaMateriaProfesor;

$_SESSION['comprobacion']=null;
$_SESSION['fechasBuscadas']=null;
$_SESSION['mostrarAulas']=null;

$_SESSION['departamentos']=null;
$_SESSION['idDepartamentoSeleccionado']=null;


?>

<style>
        @font-face {
  font-family: myFirstFont;
  src: url(./../SnowHut.ttf);
}
</style>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0,  minimum-scale=1.0">
        <title>Menú Administrador</title>
        <link rel="stylesheet" href="./../css/bootstrap.min.css">
    </head>
    <body background = <?php echo $URL.$fondo?> style="padding-top: 70px; bg-secondary">
    <script src="jquery.js"></script>
        <?php require './../partials/headera.php' ?>
        <?php if (!empty($message)): ?>
            <p> <?= $message ?></p>
        <?php endif; ?>
        <div class="container">
            <br>
            <div class="form-group" align="center">
                <h2 for="menuindex" class="text-primary" style="font-family:myFirstFont,garamond,serif;font-size:42px;">Menú Administrador</h2>
            </div>
        </div> 
        <div class="navbar navbar-inverse" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">  
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
            </div>
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav">
                <li class="menu-item dropdown">
                    <a href="<?php echo $AsuetosMenu?>" class="dropdown-toggle" data-toggle="dropdown"> Asuetos <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $AsuetosReceso?>">Recesos</a></li>
                        <li><a href="<?php echo $AsuetosFeriado?>">Feriados</a></li>
                        <li><a href="<?php echo $AsuetoAsueto?>">Asuetos</a></li>
                    </ul>
                </li>

                <li><a href="<?php echo $Mesas?>">Mesas</a></li>
                <li><a href="<?php echo $ABMAula?>">Aulas</a></li>
                <li><a href="<?php echo $abmDepartamento?>">Departamentos</a></li>
                <li><a href="<?php echo $abmMateria?>">Materias</a></li>

                <li class="menu-item dropdown">
                    <a href="<?php echo $menuAltaProfesor?>" class="dropdown-toggle" data-toggle="dropdown"> Profesores <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?php echo $altaProfesor?>">Profesor</a></li>
                        <li><a href="<?php echo $asignarMateriaAProfesor?>">Asignar Materia a Profesor</a></li>
                        <li><a href="<?php echo $bajaMateriaProfesor?>">Asignar Horario de Cursado</a></li>
                    </ul>
                </li>

                <li><a href="<?php echo $EditarAultaAsignada?>">Cambiar Aula de consulta</a></li>
                <li><a href="<?php echo $altaAlumno?>">Alta Alumno</a></li>
                <li><a href="<?php echo $subirCargoaDirector?>">Cargo Director</a></li>
                <li><a href="<?php echo $altaPersonal?>">Alta Personal</a></li>
                <li><a href="<?php echo $CerrarhoraAusente?>">Cerrar horas de Ausentes</a></li>
                <li><a href="<?php echo $calcularAsistencia?>">Calcular Asistencia</a></li>
                <li><a href="<?php echo $backup?>">Backup</a></li>
            </ul>
        </div>              
        <script src="./../js/jquery.js"></script>
        <script src="./../js/bootstrap.min.js"></script>
    </body>
    <footer class="footer">
        <?php require $DIR.$footer; ?>     
    </footer> 
</html>