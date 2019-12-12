<?php
session_start();

require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
if(!isset($_SESSION['rol'])){
    header('location: '. $URL.$login);
  }else{
    if(!($_SESSION['rol'] == 4 || $_SESSION['rol'] == 6)){
        header('location: '. $URL.$login);
    }
  }
  
require_once ($DIR.$conexion);
require_once ($DIR.$ReportesControlador);
require_once ($DIR.$controladorAdministrador);
//antes de romper
$a=new controladorAdministrador();

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
$altaAdministrador=$URL.$altaAdministrador;
$subirCargoaDirector=$URL.$subirCargoaDirector;
$CerrarhoraAusente=$URL.$CerrarhoraAusente;
$calcularAsistencia=$URL.$calcularAsistencia;
$AsuetosReceso= $URL.$asutosReceso;
$AsuetosFeriado= $URL.$asutosFeriado;
$AsuetoAsueto=$URL.$AsuetoAsueto;
$Permisos=$URL.$Permisos;

$altaProfesor=$URL.$altaProfesor;
$asignarMateriaAProfesor= $URL.$asignarMateriaAProfesor;
$bajaMateriaProfesor= $URL.$bajaMateriaProfesor;

$_SESSION['comprobacion']=null;
$_SESSION['fechasBuscadas']=null;
$_SESSION['mostrarAulas']=null;

$_SESSION['departamentos']=null;
$_SESSION['idDepartamentoSeleccionado']=null;



$lsitaPermisos=$a->BuscarPermisos($_SESSION['rol']);

$Backup=in_array("17", $lsitaPermisos);
$CalcularAsistencia=in_array("16", $lsitaPermisos);
$CerrarhorasdeAusentes=in_array("15", $lsitaPermisos);
$AltaPersonal=in_array("14", $lsitaPermisos);
$CargoDirector=in_array("13", $lsitaPermisos);
$AltaAlumno=in_array("12", $lsitaPermisos);
$CambiarAuladeconsulta=in_array("11", $lsitaPermisos);

$Profesor=in_array("8", $lsitaPermisos);
$AsignarMateriaaProfesor=in_array("9", $lsitaPermisos);
$AsignarHorariodeCursado=in_array("10", $lsitaPermisos);
$MenuProfesores=($Profesor||$AsignarMateriaaProfesor||$AsignarHorariodeCursado);


$Materias=in_array("7", $lsitaPermisos);
$Departamentos=in_array("6", $lsitaPermisos);
$Aulas=in_array("5", $lsitaPermisos);
$MesasP=in_array("4", $lsitaPermisos);


$Asuetos=in_array("3", $lsitaPermisos);
$Feriados=in_array("2", $lsitaPermisos);
$Recesos=in_array("1", $lsitaPermisos);
$MenuAsuetos=($Asuetos||$Feriados||$Recesos);
$Administrador=in_array("18", $lsitaPermisos);
if ($_SESSION['rol']==4){$Permiso=true;}else{$Permiso=false;}
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

            <?php if($MenuAsuetos) :?>
                <li class="menu-item dropdown">
                    <a href="<?php echo $AsuetosMenu?>" class="dropdown-toggle" data-toggle="dropdown"> Asuetos <b class="caret"> </b> </a>

                    <ul class="dropdown-menu">

                    <?php if($Recesos) :?>
                    <li><a href="<?php echo $AsuetosReceso?>">Recesos</a></li>
                    <?php endif?>

                    <?php if($Feriados) :?>
                    <li><a href="<?php echo $AsuetosFeriado?>">Feriados</a></li>
                    <?php endif?>

                    <?php if($Asuetos) :?>
                    <li><a href="<?php echo $AsuetoAsueto?>">Asuetos</a></li>
                    <?php endif?>
                    </ul>
                </li>
                <?php endif?>


                <?php if($MesasP) :?>
                <li><a href="<?php echo $Mesas?>">Mesas</a></li>
                <?php endif?>

                <?php if($Aulas) :?>
                <li > <a href="<?php echo $ABMAula?>"> Aulas</b></a></li>
                <?php endif?>

                <?php if($Departamentos) :?>
                <li><a href="<?php echo $abmDepartamento?>">Departamentos</a></li>
                <?php endif?>

                <?php if($Materias) :?>
                <li><a href="<?php echo $abmMateria?>">Materias</a></li>
                <?php endif?>

                <?php if($MenuProfesores) :?>
                <li class="menu-item dropdown">
                    <a href="<?php echo $menuAltaProfesor?>" class="dropdown-toggle" data-toggle="dropdown"> Profesores <b class="caret"></b></a>
                    <ul class="dropdown-menu">

                        <?php if($Profesor) :?>
                        <li><a href="<?php echo $altaProfesor?>">Profesor</a></li>
                        <?php endif?>

                        <?php if($AsignarMateriaaProfesor) :?>
                        <li><a href="<?php echo $asignarMateriaAProfesor?>">Asignar Materia a Profesor</a></li>
                        <?php endif?>

                        <?php if($AsignarHorariodeCursado) :?>
                        <li><a href="<?php echo $bajaMateriaProfesor?>">Asignar Horario de Cursado</a></li>
                        <?php endif?>

                    </ul>
                </li>
                <?php endif?>
                
                <?php if($CambiarAuladeconsulta) :?>
                <li><a href="<?php echo $EditarAultaAsignada?>">Cambiar Aula de consulta</a></li>
                <?php endif?>

                <?php if($AltaAlumno) :?>
                <li><a href="<?php echo $altaAlumno?>">Alumno</a></li>
                <?php endif?>

                <?php if($CargoDirector) :?>
                <li><a href="<?php echo $subirCargoaDirector?>">Cargo Director</a></li>
                <?php endif?>

                <?php if($AltaPersonal) :?>
                <li><a href="<?php echo $altaPersonal?>">Personal</a></li>
                <?php endif?>

                <?php if($CerrarhorasdeAusentes) :?>
                <li><a href="<?php echo $CerrarhoraAusente?>">Cerrar horas de Ausentes</a></li>
                <?php endif?>

                <?php if($CalcularAsistencia) :?>
                <li><a href="<?php echo $calcularAsistencia?>">Calcular Asistencia</a></li>
                <?php endif?>

                <?php if(true) :?>
                <li><a href="<?php echo $altaAdministrador?>">Administrador</a></li>
                <?php endif?>

                  <?php if($Backup) :?>
                <li><a href="<?php echo $backup?>">Backup</a></li>
                <?php endif?>

                        <?php if($Permiso) :?>
                <li><a href="<?php echo $Permisos?>">Permisos</a></li>
                <?php endif?>
            </ul>
        </div>              
        <script src="./../js/jquery.js"></script>
        <script src="./../js/bootstrap.min.js"></script>
    </body>
    <footer class="footer">
        <?php require $DIR.$footer; ?>     
    </footer> 
</html>