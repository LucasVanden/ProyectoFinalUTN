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


$temporal3 = $cont->buscarHorariosDeConsultaDeMateriaporhoraconsulta(1);
echo " <br> nuevo <br>";
//echo $temporal3->getHorarioDeConsulta()[0]->getprofesor()->getnombre();
echo $temporal3->getnombremateria();
echo $temporal3->getHoraDeConsulta()[0]->getid_horadeconsulta();
echo $temporal3->getHoraDeConsulta()[0]->getHorarioDeConsulta()->getid_horarioDeConsulta();
echo $temporal3->getHoraDeConsulta()[0]->getHorarioDeConsulta()->getdia()->getdia();
echo $temporal3->getHoraDeConsulta()[0]->getHorarioDeConsulta()->getprofesor()->getnombre();


$listaprofesores = $cont->BuscarProfesor();
echo $listaprofesores[0]->getnombre();
echo "óáéíúñ";
$listProfeHoras=$cont->buscarHorariosDeConsultaporProfesor(2);
echo $listProfeHoras[0]->getnombre();
echo $listProfeHoras[1][0]->getid_horadeconsulta();
echo $listProfeHoras[1][0]->getHorarioDeConsulta()->getdia()->getdia();


?>

