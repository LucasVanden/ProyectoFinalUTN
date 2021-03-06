

CREATE TABLE `alumno` (
  `id_alumno` int(20) NOT NULL AUTO_INCREMENT,
  `legajo` int(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fechaNacimientoAlumno` date NOT NULL,
  `telefonoAlumno` varchar(50) NOT NULL,
  `eliminado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_alumno`),
  KEY `id_alumno` (`id_alumno`),
  KEY `id_alumno_2` (`id_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `anotadosestado` (
  `id_anotadoestado` int(20) NOT NULL AUTO_INCREMENT,
  `fechaAnotadosEstado` date NOT NULL,
  `horaAnotadosEstado` time NOT NULL,
  `fk_estadoanotados` int(11) NOT NULL,
  `fk_detalleanotados` int(20) NOT NULL,
  PRIMARY KEY (`id_anotadoestado`),
  KEY `fk_detalleanotados` (`fk_detalleanotados`),
  KEY `fk_estadoanotados` (`fk_estadoanotados`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `asueto` (
  `id_asueto` int(20) NOT NULL AUTO_INCREMENT,
  `fechaAsueto` date NOT NULL,
  `horaDesdeAsueto` time NOT NULL,
  `horaHastaAsueto` time NOT NULL,
  `tipo` varchar(16) NOT NULL,
  PRIMARY KEY (`id_asueto`),
  UNIQUE KEY `id` (`id_asueto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `aula` (
  `cuerpoAula` varchar(20) NOT NULL,
  `nivelAula` int(11) NOT NULL,
  `numeroAula` varchar(20) NOT NULL,
  `id_aula` int(20) NOT NULL AUTO_INCREMENT,
  `eliminado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_aula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `avisoprofesor` (
  `id_avisoprofesor` int(20) NOT NULL AUTO_INCREMENT,
  `fechaAvisoProfesor` date NOT NULL,
  `detalleDescripcion` varchar(500) NOT NULL,
  `fk_horadeconsulta` int(20) NOT NULL,
  `horaAvisoProfesor` time(5) NOT NULL,
  PRIMARY KEY (`id_avisoprofesor`),
  KEY `fk_horadeconsulta` (`fk_horadeconsulta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `dedicacion` (
  `id_dedicacion` int(16) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) NOT NULL,
  `cantidadHora` int(11) NOT NULL,
  PRIMARY KEY (`id_dedicacion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO dedicacion VALUES("1","Semi-exclusiva","2");
INSERT INTO dedicacion VALUES("2","Simple","1");



CREATE TABLE `dedicacion_materia_profesor` (
  `id_dedicacion_materia_profesor` int(20) NOT NULL AUTO_INCREMENT,
  `fk_dedicacion` int(20) NOT NULL,
  `fk_materia` int(20) NOT NULL,
  `fk_profesor` int(20) NOT NULL,
  `eliminado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_dedicacion_materia_profesor`) USING BTREE,
  KEY `fk_dedicacion` (`fk_dedicacion`),
  KEY `fk_materia` (`fk_materia`),
  KEY `fk_profesor` (`fk_profesor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `departamento` (
  `id_departamento` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `fk_aula` int(20) NOT NULL,
  `eliminado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_departamento`),
  KEY `id_departamento` (`id_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `detalleanotados` (
  `id_detalleanotados` int(20) NOT NULL AUTO_INCREMENT,
  `fechaDesdeAnotados` date NOT NULL,
  `horaDetalleAnotados` time(6) NOT NULL,
  `tema` mediumtext,
  `fk_alumno` int(20) NOT NULL,
  `fk_horadeconsulta` int(20) NOT NULL,
  PRIMARY KEY (`id_detalleanotados`),
  KEY `fk_alumno` (`fk_alumno`),
  KEY `fk_horadeconsulta` (`fk_horadeconsulta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `dia` (
  `id_dia` int(20) NOT NULL AUTO_INCREMENT,
  `dia` varchar(50) NOT NULL,
  PRIMARY KEY (`id_dia`),
  KEY `id_dia` (`id_dia`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf32;

INSERT INTO dia VALUES("1","Lunes");
INSERT INTO dia VALUES("2","Martes");
INSERT INTO dia VALUES("3","Miércoles");
INSERT INTO dia VALUES("4","Jueves");
INSERT INTO dia VALUES("5","Viernes");
INSERT INTO dia VALUES("6","Sábado");



CREATE TABLE `estadoanotados` (
  `id_estadoanotados` int(20) NOT NULL AUTO_INCREMENT,
  `nombreEstado` varchar(15) NOT NULL,
  PRIMARY KEY (`id_estadoanotados`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO estadoanotados VALUES("1","Anotado");
INSERT INTO estadoanotados VALUES("2","Eliminado");
INSERT INTO estadoanotados VALUES("3","Ausente");
INSERT INTO estadoanotados VALUES("4","Presente");
INSERT INTO estadoanotados VALUES("5","Suspendido");
INSERT INTO estadoanotados VALUES("6","Reprogramado");



CREATE TABLE `falta` (
  `id_falta` int(20) NOT NULL AUTO_INCREMENT,
  `fechaFalta` date NOT NULL,
  `tipo` varchar(20) CHARACTER SET utf8 NOT NULL,
  `minutos` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `fk_horadeconsulta` int(20) NOT NULL,
  `fk_materia` int(20) NOT NULL,
  `fk_profesor` int(20) NOT NULL,
  `fk_departamento` int(20) NOT NULL,
  PRIMARY KEY (`id_falta`),
  KEY `fk_horadeconsulta` (`fk_horadeconsulta`),
  KEY `fk_departamento` (`fk_departamento`),
  KEY `fk_materia` (`fk_materia`),
  KEY `fk_profesor` (`fk_profesor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `fechamesa` (
  `id_fechaMesa` int(20) NOT NULL AUTO_INCREMENT,
  `fechaMesa` date NOT NULL,
  PRIMARY KEY (`id_fechaMesa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




CREATE TABLE `horadeconsulta` (
  `id_horadeconsulta` int(20) NOT NULL AUTO_INCREMENT,
  `fechaDesdeAnotados` date NOT NULL,
  `fechaHastaAnotados` date NOT NULL,
  `cantidadAnotados` int(50) NOT NULL,
  `estadoPresentismo` varchar(50) NOT NULL,
  `estadoVigencia` varchar(50) NOT NULL,
  `fk_materia` int(20) NOT NULL,
  `fk_horariodeconsulta` int(20) NOT NULL,
  `fk_profesor` int(20) NOT NULL,
  PRIMARY KEY (`id_horadeconsulta`),
  KEY `fk_horariodeconsulta` (`fk_horariodeconsulta`),
  KEY `fk_materia` (`fk_materia`),
  KEY `fk_profesor` (`fk_profesor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `horariocursado` (
  `id_horariocursado` int(20) NOT NULL AUTO_INCREMENT,
  `HoraDesde` time NOT NULL,
  `HoraHasta` time NOT NULL,
  `fk_profesor` int(20) NOT NULL,
  `fk_materia` int(20) NOT NULL,
  `semestreAnual` varchar(50) NOT NULL,
  `fk_dia` int(20) NOT NULL,
  `fk_turno` int(20) DEFAULT NULL,
  `comision` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_horariocursado`),
  KEY `fk_dia` (`fk_dia`),
  KEY `fk_materia` (`fk_materia`),
  KEY `fk_profesor` (`fk_profesor`),
  KEY `fk_turno` (`fk_turno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `horariodeconsulta` (
  `id_horariodeconsulta` int(20) NOT NULL AUTO_INCREMENT,
  `hora` char(5) NOT NULL,
  `activoDesde` date NOT NULL,
  `activoHasta` date NOT NULL,
  `fk_dia` int(20) NOT NULL,
  `fk_materia` int(20) NOT NULL,
  `fk_profesor` int(20) NOT NULL,
  `semestre` int(11) NOT NULL,
  `n` int(2) NOT NULL,
  `fk_aula` int(20) NOT NULL,
  PRIMARY KEY (`id_horariodeconsulta`),
  KEY `fk_dia` (`fk_dia`),
  KEY `fk_materia` (`fk_materia`),
  KEY `fk_profesor` (`fk_profesor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `materia` (
  `id_materia` int(20) NOT NULL AUTO_INCREMENT,
  `nombreMateria` varchar(50) NOT NULL,
  `fk_departamento` int(20) NOT NULL,
  `fk_dia` int(20) NOT NULL,
  `eliminado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_materia`),
  KEY `id_materia` (`id_materia`),
  KEY `fk_dia` (`fk_dia`),
  KEY `fk_departamento` (`fk_departamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `materias_alumno` (
  `fk_alumno` int(20) NOT NULL,
  `fk_materia` int(20) NOT NULL,
  PRIMARY KEY (`fk_alumno`,`fk_materia`),
  KEY `fk_materia` (`fk_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `perfil` (
  `nombrePerfil` varchar(20) NOT NULL,
  `id_perfil` int(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_perfil`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO perfil VALUES("alumno","1");
INSERT INTO perfil VALUES("profesor","2");
INSERT INTO perfil VALUES("director","3");
INSERT INTO perfil VALUES("root","4");
INSERT INTO perfil VALUES("personal","5");
INSERT INTO perfil VALUES("administrador","6");



CREATE TABLE `persona` (
  `id_persona` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(11) NOT NULL,
  `apellido` varchar(11) NOT NULL,
  `dni` int(11) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `eliminado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_persona`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO persona VALUES("1","Root","Root","0","consultasutnfrm2019@gmail.com",NULL);



CREATE TABLE `presentismo` (
  `id_presentismo` int(20) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `horaDesde` time NOT NULL,
  `horaHasta` time NOT NULL,
  `fk_profesor` int(20) NOT NULL,
  `fk_horadeconsulta` int(20) NOT NULL,
  PRIMARY KEY (`id_presentismo`),
  KEY `fk_profesor` (`fk_profesor`),
  KEY `fk_horadeconsulta` (`fk_horadeconsulta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `privilegio` (
  `nombrePrivilegio` varchar(35) NOT NULL,
  `id_privilegio` int(35) NOT NULL AUTO_INCREMENT,
  `numeroPermiso` int(11) NOT NULL,
  PRIMARY KEY (`id_privilegio`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

INSERT INTO privilegio VALUES("Receso","1","1");
INSERT INTO privilegio VALUES("Feriado","2","2");
INSERT INTO privilegio VALUES("Asueto","3","3");
INSERT INTO privilegio VALUES("Mesas","4","4");
INSERT INTO privilegio VALUES("Aulas","5","5");
INSERT INTO privilegio VALUES("Departamento","6","6");
INSERT INTO privilegio VALUES("Materias","7","7");
INSERT INTO privilegio VALUES("Profesores","8","8");
INSERT INTO privilegio VALUES("Asignar Materia a Profesor","9","9");
INSERT INTO privilegio VALUES("Asignar Horario de Cursado","10","10");
INSERT INTO privilegio VALUES("Cambiar Aula de Consulta","11","11");
INSERT INTO privilegio VALUES("Alumno","12","12");
INSERT INTO privilegio VALUES("Cargo Direcotr","13","13");
INSERT INTO privilegio VALUES("Personal","14","14");
INSERT INTO privilegio VALUES("Cerrar Horas de consulta Ausentes","15","15");
INSERT INTO privilegio VALUES("Calcular Asistencia","16","16");
INSERT INTO privilegio VALUES("Backup","17","17");
INSERT INTO privilegio VALUES("Administrador","18","18");



CREATE TABLE `privilegioperfil` (
  `fk_perfil` int(20) NOT NULL,
  `fk_privilegio` int(20) NOT NULL,
  PRIMARY KEY (`fk_perfil`,`fk_privilegio`),
  KEY `fk_privilegio` (`fk_privilegio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO privilegioperfil VALUES("4","1");
INSERT INTO privilegioperfil VALUES("4","2");
INSERT INTO privilegioperfil VALUES("4","3");
INSERT INTO privilegioperfil VALUES("4","4");
INSERT INTO privilegioperfil VALUES("4","5");
INSERT INTO privilegioperfil VALUES("4","6");
INSERT INTO privilegioperfil VALUES("4","7");
INSERT INTO privilegioperfil VALUES("4","8");
INSERT INTO privilegioperfil VALUES("4","9");
INSERT INTO privilegioperfil VALUES("4","10");
INSERT INTO privilegioperfil VALUES("4","11");
INSERT INTO privilegioperfil VALUES("4","12");
INSERT INTO privilegioperfil VALUES("4","13");
INSERT INTO privilegioperfil VALUES("4","14");
INSERT INTO privilegioperfil VALUES("4","15");
INSERT INTO privilegioperfil VALUES("4","16");
INSERT INTO privilegioperfil VALUES("4","17");
INSERT INTO privilegioperfil VALUES("4","18");



CREATE TABLE `profesor` (
  `id_profesor` int(20) NOT NULL AUTO_INCREMENT,
  `legajo` varchar(20) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fk_dedicacion_materia_profesor` int(20) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_profesor`),
  KEY `fk_dedicacion_materia_profesor` (`fk_dedicacion_materia_profesor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `turno` (
  `id_turno` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `HoraDesdeTurno` time NOT NULL,
  `HoraHastaTurno` time NOT NULL,
  PRIMARY KEY (`id_turno`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO turno VALUES("1","Mañana","08:00:00","00:00:00");



CREATE TABLE `usuario` (
  `id_usuario` int(20) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(70) NOT NULL,
  `fk_alumno` int(20) DEFAULT NULL,
  `fk_profesor` int(20) DEFAULT NULL,
  `fk_perfil` int(20) NOT NULL,
  `fk_persona` int(20) DEFAULT NULL,
  `keygen` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `fk_profesor` (`fk_profesor`),
  KEY `fk_perfil` (`fk_perfil`),
  KEY `fk_alumno` (`fk_alumno`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO usuario VALUES("1","root","$2y$10$PNwqEM24Ie1UMpkA999Z8eTrPa3.WRJ6UrU7U6sWDjCYEoP.qQs8K",NULL,NULL,"4","1",NULL);

