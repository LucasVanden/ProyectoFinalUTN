<?php 


require '../../controlador/alumnoControlador.php';

$cont =new alumnoControlador();
$temporal = $cont->buscarAlumno(1);
echo $temporal[0]->getmateria()[0]->getnombremateria();

     
$temporal2 = $cont->buscarHorariosDeConsultaDeMateria(1);
echo $temporal2->getnombremateria();
echo $temporal2->getid_materia();
echo $temporal2->getHorarioDeConsulta()[0]->getdia()->getdia();
echo $temporal2->getHorarioDeConsulta()[0]->gethora();
echo $temporal2->getHorarioDeConsulta()[0]->getprofesor()->getnombre();
echo $temporal2->getHorarioDeConsulta()[0]->getprofesor()->getapellido();
?>