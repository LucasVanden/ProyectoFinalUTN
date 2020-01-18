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
$headerPersonal="/vista/partials/headerPersonal.php";
$headerAdmin="/vista/partials/headerAdmin.php";
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
$temp1='/vista/alumno/temp.1.php';
$controladorbajaAlumno='/controlador/administrador/bajaAlumno.php';

$alumnoControlador='/controlador/alumnoControlador.php';
$departamentoMaterias='/controlador/departamentoMaterias.php';
$buscarMateriasdeDepartamentodeAlumno='/controlador/buscarMateriasdeDepartamentodeAlumno.php';
$eliminarAnotacion='/controlador/eliminarAnotacion.php';
$AgregarMateriaAlumno='/controlador/AgregarMateriaAlumno.php';
$EliminarMateriaAlumno='/controlador/EliminarMateriaAlumno.php';
$departamentoMaterias='/controlador/departamentoMaterias.php';
$crearAnotacion='/controlador/crearAnotacion.php';
$editAlumno='/controlador/administrador/editAlumno.php';

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
$crearHorarioDeConsultaSOLOMESAS='/controlador/profesor/crearHorarioDeConsultaSOLOMESAS.php';

$mensajesCrearHoraDeConsulta='/vista/profesor/mensajesCrearHoraDeConsulta.php';
$EstablecerHorario='/vista/profesor/profesorEstablecerHorario.php';

//ASISTENCIA
$asistenciaProfesor='/vista/asistencia/asistenciaProfesor.php';
$asistenciaAlumno='/vista/asistencia/asistenciaAlumno.php';
$AsistenciaControlador='/controlador/asistencia/AsistenciaControlador.php';
$AsistirProfesor='/controlador/asistencia/AsistirProfesor.php';

$AsistirAlumno='/controlador/asistencia/AsistirAlumno.php';

$CerrarhoraAusente='/controlador/asistencia/Demonio.php';
$calcularAsistencia='/controlador/asistencia/calcularAsistencia.php';

//REPORTES
$ReportesControlador='/controlador/reportes/ReportesControlador.php';
$buscarMateriasDepartamentoincluidoTodas='/controlador/reportes/buscarMateriasDepartamentoincluidoTodas.php';
$directorReportes='/vista/reportes/directorReportes.php';
$vistafaltas='/vista/reportes/faltas.php';
$buscarfaltas='/controlador/reportes/buscarFaltas.php';
$llenarMaterias='/controlador/reportes/llenarMaterias.php';

//ADMINISTRADOR
$editarAlumno='/vista/administrador/editarAlumno.php';
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
$marcarAsuetoReceso='/controlador/administrador/marcarAsuetoReceso.php';
$marcarAsuetoFeriado='/controlador/administrador/marcarAsuetoFeriado.php';
$marcarAsuetoAsueto='/controlador/administrador/marcarAsuetoAsueto.php';
$cargarEnSessionLaFecha='/controlador/administrador/cargarEnSessionLaFecha.php';
$marcarfechaMesa='/controlador/administrador/marcarfechaMesa.php';

$asignarDirector='/controlador/administrador/cargoDirector/asignarDirector.php';
$eliminarDirecotr='/controlador/administrador/cargoDirector/eliminarDirecotr.php';

$altaAlumno='/vista/administrador/altaAlumno.php';
$altaPersonal='/vista/administrador/altaPersonal.php';
$altaAdministrador='/vista/administrador/altaAdministrador.php';

$editarPersonal='/vista/administrador/editarPersonal.php';
$editPersonal='/controlador/administrador/editPersonal.php';
$bajaPersonal='/controlador/administrador/bajaPersonal.php';

//ABM DEPARTAMENTO
$abmDepartamento='/vista/administrador/ambDepartamento.php';

$borrarDepartamento='/controlador/administrador/abmDepartamento/borrarDepartamento.php';
$crearDepartamento='/controlador/administrador/abmDepartamento/crearDepartamento.php';
$editarDepartamento='/controlador/administrador/abmDepartamento/editarDepartamento.php';

//ABM materia
$abmMateria='/vista/administrador/abmMateria.php';

$BorrarMateria='/controlador/administrador/abmMateria.php/BorrarMateria.php';
$editarmesaMateria='/controlador/administrador/abmMateria.php/editarmesaMateria.php';
$crearMateria='/controlador/administrador/abmMateria.php/crearMateria.php';
$mostrarMaterias='/controlador/administrador/abmMateria.php/mostrarMaterias.php';

//Alta Profesor
$altaProfesor='/vista/administrador/profesor/altaProfesor.php';
$editarProfesor='/vista/administrador/profesor/editarProfesor.php';

$menuAltaProfesor='/vista/administrador/profesor/menuAltaProfesor.php';
$bajaProfesor='/vista/administrador/profesor/bajaProfesor.php';
$controladorbajaProfesor='/controlador/administrador/bajaProfesor.php';

$editProfesor='/controlador/administrador/editProfesor.php';

//materiaProfesor
$altaMateriaProfesor='/controlador/administrador/abmMateriaProfesor/altaMateriaProfesor.php';
$agregarHorarioCursado='/controlador/administrador/abmMateriaProfesor/agregarHorarioCursado.php';
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
$subirCargoaDirector='/vista/administrador/subirCargoaDirector.php';
$Permisos='/vista/administrador/Permisos.php';

$buscarDepartamentosconel1erovacio='/controlador/administrador/buscarDepartamentosconel1erovacio.php';
$buscarNivelAula1ervacio='/controlador/administrador/buscarNivelAula1ervacio.php';
$buscarNombreAula='/controlador/administrador/buscarNombreAula.php';

$restaurarContraseniaUsuario='/controlador/restaurarContraseniaUsuario.php';
$restaurarContraseña='/vista/restaurarContraseña.php';
$restaurarContraseñaMail='/vista/restaurarContrase&#241;a.php';

$recuperarContraseniaUsuario='/controlador/recuperarContraseniaUsuario.php';
$recuperarContraseña='/vista/recuperarContraseña.php';


$editarPermisos='/controlador/administrador/editarPermisos.php';

//backup
$restore='/modelo/persistencia/database-resotore.php';
$dbbackup='/modelo/persistencia/database-backup.php';