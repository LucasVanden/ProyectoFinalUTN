<?php

$DIR='C:/xampp/htdocs/ProyectoFinalUTN';
$URL='http://localhost/ProyectoFinalUTN';

$logo="/vista//partials/logo.png";
$fondo="/vista/fondoCuerpo.jpg";

$header="/vista/partials/header.php";
$headerasistencia="/vista/partials/header.asistencia.php";
$headera="/vista/partials/headera.php";
$headerp="/vista/partials/headerp.php";
$headerpasistencia="/vista/partials/headerp.asistencia.php";
$footer="/vista/partials/footer.php";

$style="/vista/assert/css/style.css";

$loginasistencia='/vista/asistencia/login.php';
$login='/vista/login.php';

$cambiarContraseniaUsuario='/controlador/cambiarContraseniaUsuario.php';
$vistacambiocontraseña='/vista/profesor/cambiarContrasenia.php';
$cambiarContraseniaalumno='/vista/alumno/cambiarContrasenia.php';

$logoutasistencia='/vista/logoutasistencia.php';
$email='/controlador/enviaremail.php';

$conexion='/modelo/persistencia/conexion.php';

$asistenciaAlumno="/vista/asistencia/asistenciaAlumno.php";
$asistenciaProfesor="/vista/asistencia/asistenciaProfesor.php";
//ALUMNO
$alumnoPpal="/vista/alumno/alumnoPpal.php";
$alumnoagregarmateria='/vista/alumno/alumnoAgregarMateria.php';

$alumnoControlador='/controlador/alumnoControlador.php';
$departamentoMaterias='/controlador/departamentoMaterias.php';
$eliminarAnotacion='/controlador/eliminarAnotacion.php';
$AgregarMateriaAlumno='/controlador/AgregarMateriaAlumno.php';
$EliminarMateriaAlumno='/controlador/EliminarMateriaAlumno.php';
$departamentoMaterias='/controlador/departamentoMaterias.php';
$crearAnotacion='/controlador/crearAnotacion.php';

//MODELO
$Alumno='/modelo/Alumno.php';
$Materia='/modelo/Materia.php';
$HorarioDeConsulta='/modelo/HorarioDeConsulta.php';
$Profesor='/modelo/Profesor.php';
$HoraDeConsulta='/modelo/HoraDeConsulta.php';
$Departamento='/modelo/Departamento.php';
$AnotadosEstado='/modelo/AnotadosEstado.php';
$DetalleAnotados='/modelo/DetalleAnotados.php';
$EstadoAnotados='/modelo/EstadoAnotados.php';
$AvisoProfesor='/modelo/AvisoProfesor.php';
$Dia='/modelo/Dia.php';
$turno='/modelo/Turno.php';
$HorarioCursado='/modelo/HorarioCursado.php';
$Asueto='/modelo/Asueto.php';
$FechaMesa='/modelo/FechaMesa.php';
$Presentismo='/modelo/Presentismo.php';
$Aula='/modelo/Aula.php';
$Dedicacion='/modelo/Dedicacion.php';
$Falta='/modelo/Falta.php';

//PROFESOR
$profesorControlador='/controlador/profesor/profesorControlador.php';
$profesorNotificarAlumno='/vista/profesor/profesorNotificarAlumnos.php';
$profesorPpal='/vista/profesor/profesorPpal.php';
$profesorCrearNotificacion='/controlador/profesor/profesorCrearNotificacion.php';
$profesorAlumnosAnotados='/vista/profesor/profesorAlumnosAnotados.php';
$crearHorarioDeConsulta='/controlador/profesor/crearHorarioDeConsulta.php';
$mensajesCrearHoraDeConsulta='/vista/profesor/mensajesCrearHoraDeConsulta.php';
$EstablecerHorario='/vista/profesor/profesorEstablecerHorario.php';

//ASISTENCIA
$asistenciaProfesor='/vista/asistencia/asistenciaProfesor.php';
$asistenciaAlumno='/vista/asistencia/asistenciaAlumno.php';
$AsistenciaControlador='/controlador/asistencia/AsistenciaControlador.php';
$AsistirProfesor='/controlador/asistencia/AsistirProfesor.php';

$AsistirAlumno='/controlador/asistencia/AsistirAlumno.php';

$demonio='/controlador/asistencia/Demonio.php';
$dem='/vista/asistencia/demonio.php';

//REPORTES
$ReportesControlador='/controlador/reportes/ReportesControlador.php';
$buscarMateriasDepartamentoincluidoTodas='/controlador/reportes/buscarMateriasDepartamentoincluidoTodas.php';
$directorReportes='/vista/reportes/directorReportes.php';
$vistafaltas='/vista/reportes/faltas.php';
$buscarfaltas='/controlador/reportes/buscarFaltas.php';

$controladorAsuetosReceso='/controlador/administrador/controladorAsuetosReceso.php';
$controladorAsuetoFeriado='/controlador/administrador/controladorAsuetoFeriado.php';
$controladorAsuetoAsueto='/controlador/administrador/controladorAsuetoAsueto.php';
$controladorBorrarAsueto='/controlador/administrador/controladorBorrarAsueto.php';
$controladorBuscarAsuetos='/controlador/administrador/controladorBuscarAsuetos.php';
$controladorMesas='/controlador/administrador/controladorMesas.php';
$controladorBuscarMesa='/controlador/administrador/controladorBuscarMesa.php';
$controladorEliminarMesa='/controlador/administrador/controladorEliminarMesa.php';
$buscarProfesoresDeMateriaSeleccionada='/controlador/administrador/buscarProfesoresDeMateriaSeleccionada.php';
$controladorAdministrador='/controlador/administrador/controladorAdministrador.php';
$setearAula='/controlador/administrador/setearAula.php';
$abmcrearAula='/controlador/administrador/abmcrearAula.php';
$borrarAula='/controlador/administrador/borrarAula.php';

//ABM DEPARTAMENTO
$abmDepartamento='/vista/administrador/ambDepartamento.php';

$borrarDepartamento='/controlador/administrador/abmDepartamento/borrarDepartamento.php';
$crearDepartamento='/controlador/administrador/abmDepartamento/crearDepartamento.php';

//ABM materia
$abmMateria='/vista/administrador/abmMateria.php';

$BorrarMateria='/controlador/administrador/abmMateria.php/BorrarMateria.php';
$editarmesaMateria='/controlador/administrador/abmMateria.php/editarmesaMateria.php';
$crearMateria='/controlador/administrador/abmMateria.php/crearMateria.php';
$mostrarMaterias='/controlador/administrador/abmMateria.php/mostrarMaterias.php';

//Alta Profesor
$altaProfesor='/vista/administrador/profesor/altaProfesor.php';
$menuAltaProfesor='/vista/administrador/profesor/menuAltaProfesor.php';

//materiaProfesor
$altaMateriaProfesor='/controlador/administrador/abmMateriaProfesor/altaMateriaProfesor.php';
$darbajaMateriaProfesor='/controlador/administrador/abmMateriaProfesor/darbajaMateriaProfesor.php';
$buscarmateriasProfesor='/controlador/administrador/abmMateriaProfesor/buscarmateriasProfesor.php';
$eliminarHorariodeCursado='/controlador/administrador/abmMateriaProfesor/eliminarHorariodeCursado.php';
$asignarMateriaAProfesor='/vista/administrador/profesor/asignarMateriaAProfesor.php';
$bajaMateriaProfesor='/vista/administrador/profesor/bajaMateriaProfesor.php';

$AsuetoMenu='/vista/administrador/MenuAsuetos.php';
$asutosReceso='/vista/administrador/AsuetosReceso.php';
$asutosFeriado='/vista/administrador/Asuetoferiado.php';
$AsuetoAsueto='/vista/administrador/AsuetoAsueto.php';
$BorrarAsueto='/vista/administrador/BorrarAsueto.php';
$Mesas='/vista/administrador/Mesas.php';
$MenuIndex='/vista/administrador/MenuIndex.php';
$EditarAultaAsignada='/vista/administrador/EditarAultaAsignada.php';
$SeleccionEditarAulaAsignada='/vista/administrador/SeleccionEditarAulaAsignada.php';
$ABMAula='/vista/administrador/ABMAula.php';
$backup='/vista/administrador/backup.php';


$buscarDepartamentosconel1erovacio='/controlador/administrador/buscarDepartamentosconel1erovacio.php';