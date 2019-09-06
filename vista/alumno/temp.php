<?php 


require '../../controlador/alumnoControlador.php';

$cont =new alumnoControlador();
$temporal = $cont->buscarAlumno(1);
echo $temporal[0]->getmateria()[0]->getnombremateria();
?>