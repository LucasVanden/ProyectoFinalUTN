<?php
session_start();

require 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
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
            /*
            esto hace que se desplace hacia la derecha e izquierda el menu*/
            #nav{
                margin: auto;
                width: 200px;
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
            <div class="nav" id="nav">
                <ul align='left'>
                    <li><a href="<?php echo $AsuetosMenu ?>">Asuetos</a></li>
                    <li><a href="<?php echo $Mesas ?>">Mesas</a></li>
                    <li><a href="<?php echo $ABMAula ?>">Cargar Aulas</a></li>
                    <li><a href="<?php echo $EditarAultaAsignada ?>">Editar Aula Asignada</a></li>
                    <li><a href="<?php echo $abmDepartamento ?>">Departamentos</a></li>
                    <li><a href="<?php echo $abmMateria ?> ">Materias</a></li>
                    <li><a href="<?php echo $menuAltaProfesor ?>">Profesores</a></li>                    
                    <li><a href="<?php echo $backup ?>">Backup</a></li>                    
                </ul>
            </div>
    </body>
    <footer>
        <?php require $DIR.$footer; ?>     
    </footer>  
</html>