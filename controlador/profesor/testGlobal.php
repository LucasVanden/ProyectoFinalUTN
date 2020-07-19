<?php
require_once 'C:/xampp/htdocs/ProyectoFinalUTN/vista/rutas.php';
require_once ($DIR . $conexion);

require_once ($DIR . $Alumno);
require_once ($DIR . $Materia);
require_once ($DIR . $HorarioDeConsulta);
require_once ($DIR . $Profesor);
require_once ($DIR . $HoraDeConsulta);
require_once ($DIR . $Dia);
require_once ($DIR . $turno);
require_once ($DIR . $HorarioCursado);
require_once ($DIR . $email);
require_once ($DIR . $DetalleAnotados);
require_once ($DIR . $AnotadosEstado);
require_once ($DIR . $EstadoAnotados);
require_once ($DIR . $Asueto);
require_once ($DIR . $FechaMesa);

session_start();
date_default_timezone_set('America/Argentina/Mendoza');

$variable=1;
function funcion1(){
    $variable = 5;
    funcion2();
};
function funcion2(){
    global $variable;
    $variable = 10;
};
funcion1();

echo $variable;
$diaActual= date('N');
$diaActualN= date('D');
echo $diaActual;
echo $diaActualN;

?>