-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2019 a las 21:12:08
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `consultasfrm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

CREATE TABLE `alumno` (
  `id_alumno` int(20) NOT NULL,
  `legajo` int(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fechaNacimientoAlumno` date NOT NULL,
  `telefonoAlumno` varchar(50) NOT NULL,
  `eliminado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anotadosestado`
--

CREATE TABLE `anotadosestado` (
  `id_anotadoestado` int(20) NOT NULL,
  `fechaAnotadosEstado` date NOT NULL,
  `horaAnotadosEstado` time NOT NULL,
  `fk_estadoanotados` int(11) NOT NULL,
  `fk_detalleanotados` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asueto`
--

CREATE TABLE `asueto` (
  `id_asueto` int(20) NOT NULL,
  `fechaAsueto` date NOT NULL,
  `horaDesdeAsueto` time NOT NULL,
  `horaHastaAsueto` time NOT NULL,
  `tipo` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

CREATE TABLE `aula` (
  `cuerpoAula` varchar(20) NOT NULL,
  `nivelAula` int(11) NOT NULL,
  `numeroAula` varchar(20) NOT NULL,
  `id_aula` int(20) NOT NULL,
  `eliminado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avisoprofesor`
--

CREATE TABLE `avisoprofesor` (
  `id_avisoprofesor` int(20) NOT NULL,
  `fechaAvisoProfesor` date NOT NULL,
  `detalleDescripcion` varchar(500) NOT NULL,
  `fk_horadeconsulta` int(20) NOT NULL,
  `horaAvisoProfesor` time(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dedicacion`
--

CREATE TABLE `dedicacion` (
  `id_dedicacion` int(16) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `cantidadHora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `dedicacion`
--

INSERT INTO `dedicacion` (`id_dedicacion`, `tipo`, `cantidadHora`) VALUES
(1, 'Semi-exclusiva', 2),
(2, 'Simple', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dedicacion_materia_profesor`
--

CREATE TABLE `dedicacion_materia_profesor` (
  `id_dedicacion_materia_profesor` int(20) NOT NULL,
  `fk_dedicacion` int(20) NOT NULL,
  `fk_materia` int(20) NOT NULL,
  `fk_profesor` int(20) NOT NULL,
  `eliminado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id_departamento` int(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `fk_aula` int(20) NOT NULL,
  `eliminado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleanotados`
--

CREATE TABLE `detalleanotados` (
  `id_detalleanotados` int(20) NOT NULL,
  `fechaDesdeAnotados` date NOT NULL,
  `horaDetalleAnotados` time(6) NOT NULL,
  `tema` mediumtext,
  `fk_alumno` int(20) NOT NULL,
  `fk_horadeconsulta` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dia`
--

CREATE TABLE `dia` (
  `id_dia` int(20) NOT NULL,
  `dia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Volcado de datos para la tabla `dia`
--

INSERT INTO `dia` (`id_dia`, `dia`) VALUES
(1, 'Lunes'),
(2, 'Martes'),
(3, 'Miércoles'),
(4, 'Jueves'),
(5, 'Viernes'),
(6, 'Sábado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoanotados`
--

CREATE TABLE `estadoanotados` (
  `id_estadoanotados` int(20) NOT NULL,
  `nombreEstado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `estadoanotados`
--

INSERT INTO `estadoanotados` (`id_estadoanotados`, `nombreEstado`) VALUES
(1, 'Anotado'),
(2, 'Eliminado'),
(3, 'Ausente'),
(4, 'Presente'),
(5, 'Suspendido'),
(6, 'Reprogramado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `falta`
--

CREATE TABLE `falta` (
  `id_falta` int(20) NOT NULL,
  `fechaFalta` date NOT NULL,
  `tipo` varchar(20) CHARACTER SET utf8 NOT NULL,
  `minutos` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `fk_horadeconsulta` int(20) NOT NULL,
  `fk_materia` int(20) NOT NULL,
  `fk_profesor` int(20) NOT NULL,
  `fk_departamento` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechamesa`
--

CREATE TABLE `fechamesa` (
  `id_fechaMesa` int(20) NOT NULL,
  `fechaMesa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horadeconsulta`
--

CREATE TABLE `horadeconsulta` (
  `id_horadeconsulta` int(20) NOT NULL,
  `fechaDesdeAnotados` date NOT NULL,
  `fechaHastaAnotados` date NOT NULL,
  `cantidadAnotados` int(50) NOT NULL,
  `estadoPresentismo` varchar(50) NOT NULL,
  `estadoVigencia` varchar(50) NOT NULL,
  `fk_materia` int(20) NOT NULL,
  `fk_horariodeconsulta` int(20) NOT NULL,
  `fk_profesor` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horariocursado`
--

CREATE TABLE `horariocursado` (
  `id_horariocursado` int(20) NOT NULL,
  `HoraDesde` time NOT NULL,
  `HoraHasta` time NOT NULL,
  `fk_profesor` int(20) NOT NULL,
  `fk_materia` int(20) NOT NULL,
  `semestreAnual` varchar(50) NOT NULL,
  `fk_dia` int(20) NOT NULL,
  `fk_turno` int(20) DEFAULT NULL,
  `comision` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horariodeconsulta`
--

CREATE TABLE `horariodeconsulta` (
  `id_horariodeconsulta` int(20) NOT NULL,
  `hora` char(5) NOT NULL,
  `activoDesde` date NOT NULL,
  `activoHasta` date NOT NULL,
  `fk_dia` int(20) NOT NULL,
  `fk_materia` int(20) NOT NULL,
  `fk_profesor` int(20) NOT NULL,
  `semestre` int(11) NOT NULL,
  `n` int(2) NOT NULL,
  `fk_aula` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(20) NOT NULL,
  `nombreMateria` varchar(50) NOT NULL,
  `fk_departamento` int(20) NOT NULL,
  `fk_dia` int(20) NOT NULL,
  `eliminado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias_alumno`
--

CREATE TABLE `materias_alumno` (
  `fk_alumno` int(20) NOT NULL,
  `fk_materia` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `nombrePerfil` varchar(20) NOT NULL,
  `id_perfil` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`nombrePerfil`, `id_perfil`) VALUES
('alumno', 1),
('profesor', 2),
('director', 3),
('root', 4),
('personal', 5),
('administrador', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(20) NOT NULL,
  `nombre` varchar(11) NOT NULL,
  `apellido` varchar(11) NOT NULL,
  `dni` int(11) NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `eliminado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentismo`
--

CREATE TABLE `presentismo` (
  `id_presentismo` int(20) NOT NULL,
  `fecha` date NOT NULL,
  `horaDesde` time NOT NULL,
  `horaHasta` time NOT NULL,
  `fk_profesor` int(20) NOT NULL,
  `fk_horadeconsulta` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegio`
--

CREATE TABLE `privilegio` (
  `nombrePrivilegio` varchar(35) NOT NULL,
  `id_privilegio` int(35) NOT NULL,
  `numeroPermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `privilegio`
--

INSERT INTO `privilegio` (`nombrePrivilegio`, `id_privilegio`, `numeroPermiso`) VALUES
('Receso', 1, 1),
('Feriad', 2, 2),
('Asueto', 3, 3),
('Mesas', 4, 4),
('Aulas', 5, 5),
('Depart', 6, 6),
('Materi', 7, 7),
('Profes', 8, 8),
('Asigna', 9, 9),
('Asigna', 10, 10),
('Cambia', 11, 11),
('Alumno', 12, 12),
('Cargo ', 13, 13),
('Person', 14, 14),
('Cerrar', 15, 15),
('Calcul', 16, 16),
('Backup', 17, 17),
('Admini', 18, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegioperfil`
--

CREATE TABLE `privilegioperfil` (
  `fk_perfil` int(20) NOT NULL,
  `fk_privilegio` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `privilegioperfil`
--

INSERT INTO `privilegioperfil` (`fk_perfil`, `fk_privilegio`) VALUES
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(4, 7),
(4, 8),
(4, 9),
(4, 10),
(4, 11),
(4, 12),
(4, 13),
(4, 14),
(4, 15),
(4, 16),
(4, 17),
(4, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `id_profesor` int(20) NOT NULL,
  `legajo` varchar(20) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fk_dedicacion_materia_profesor` int(20) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `id_turno` int(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `HoraDesdeTurno` time NOT NULL,
  `HoraHastaTurno` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`id_turno`, `nombre`, `HoraDesdeTurno`, `HoraHastaTurno`) VALUES
(1, 'Mañana', '08:00:00', '00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(20) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contraseña` varchar(70) NOT NULL,
  `fk_alumno` int(20) DEFAULT NULL,
  `fk_profesor` int(20) DEFAULT NULL,
  `fk_perfil` int(20) NOT NULL,
  `fk_persona` int(20) DEFAULT NULL,
  `keygen` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `contraseña`, `fk_alumno`, `fk_profesor`, `fk_perfil`, `fk_persona`, `keygen`) VALUES
(1, 'root', '$2y$10$PNwqEM24Ie1UMpkA999Z8eTrPa3.WRJ6UrU7U6sWDjCYEoP.qQs8K', NULL, NULL, 4, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `id_alumno` (`id_alumno`),
  ADD KEY `id_alumno_2` (`id_alumno`);

--
-- Indices de la tabla `anotadosestado`
--
ALTER TABLE `anotadosestado`
  ADD PRIMARY KEY (`id_anotadoestado`),
  ADD KEY `fk_detalleanotados` (`fk_detalleanotados`),
  ADD KEY `fk_estadoanotados` (`fk_estadoanotados`);

--
-- Indices de la tabla `asueto`
--
ALTER TABLE `asueto`
  ADD PRIMARY KEY (`id_asueto`),
  ADD UNIQUE KEY `id` (`id_asueto`);

--
-- Indices de la tabla `aula`
--
ALTER TABLE `aula`
  ADD PRIMARY KEY (`id_aula`);

--
-- Indices de la tabla `avisoprofesor`
--
ALTER TABLE `avisoprofesor`
  ADD PRIMARY KEY (`id_avisoprofesor`),
  ADD KEY `fk_horadeconsulta` (`fk_horadeconsulta`);

--
-- Indices de la tabla `dedicacion`
--
ALTER TABLE `dedicacion`
  ADD PRIMARY KEY (`id_dedicacion`);

--
-- Indices de la tabla `dedicacion_materia_profesor`
--
ALTER TABLE `dedicacion_materia_profesor`
  ADD PRIMARY KEY (`id_dedicacion_materia_profesor`) USING BTREE,
  ADD KEY `fk_dedicacion` (`fk_dedicacion`),
  ADD KEY `fk_materia` (`fk_materia`),
  ADD KEY `fk_profesor` (`fk_profesor`);

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD PRIMARY KEY (`id_departamento`),
  ADD KEY `id_departamento` (`id_departamento`);

--
-- Indices de la tabla `detalleanotados`
--
ALTER TABLE `detalleanotados`
  ADD PRIMARY KEY (`id_detalleanotados`),
  ADD KEY `fk_alumno` (`fk_alumno`),
  ADD KEY `fk_horadeconsulta` (`fk_horadeconsulta`);

--
-- Indices de la tabla `dia`
--
ALTER TABLE `dia`
  ADD PRIMARY KEY (`id_dia`),
  ADD KEY `id_dia` (`id_dia`);

--
-- Indices de la tabla `estadoanotados`
--
ALTER TABLE `estadoanotados`
  ADD PRIMARY KEY (`id_estadoanotados`);

--
-- Indices de la tabla `falta`
--
ALTER TABLE `falta`
  ADD PRIMARY KEY (`id_falta`),
  ADD KEY `fk_horadeconsulta` (`fk_horadeconsulta`),
  ADD KEY `fk_departamento` (`fk_departamento`),
  ADD KEY `fk_materia` (`fk_materia`),
  ADD KEY `fk_profesor` (`fk_profesor`);

--
-- Indices de la tabla `fechamesa`
--
ALTER TABLE `fechamesa`
  ADD PRIMARY KEY (`id_fechaMesa`);

--
-- Indices de la tabla `horadeconsulta`
--
ALTER TABLE `horadeconsulta`
  ADD PRIMARY KEY (`id_horadeconsulta`),
  ADD KEY `fk_horariodeconsulta` (`fk_horariodeconsulta`),
  ADD KEY `fk_materia` (`fk_materia`),
  ADD KEY `fk_profesor` (`fk_profesor`);

--
-- Indices de la tabla `horariocursado`
--
ALTER TABLE `horariocursado`
  ADD PRIMARY KEY (`id_horariocursado`),
  ADD KEY `fk_dia` (`fk_dia`),
  ADD KEY `fk_materia` (`fk_materia`),
  ADD KEY `fk_profesor` (`fk_profesor`),
  ADD KEY `fk_turno` (`fk_turno`);

--
-- Indices de la tabla `horariodeconsulta`
--
ALTER TABLE `horariodeconsulta`
  ADD PRIMARY KEY (`id_horariodeconsulta`),
  ADD KEY `fk_dia` (`fk_dia`),
  ADD KEY `fk_materia` (`fk_materia`),
  ADD KEY `fk_profesor` (`fk_profesor`);

--
-- Indices de la tabla `materia`
--
ALTER TABLE `materia`
  ADD PRIMARY KEY (`id_materia`),
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `fk_dia` (`fk_dia`),
  ADD KEY `fk_departamento` (`fk_departamento`);

--
-- Indices de la tabla `materias_alumno`
--
ALTER TABLE `materias_alumno`
  ADD PRIMARY KEY (`fk_alumno`,`fk_materia`),
  ADD KEY `fk_materia` (`fk_materia`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`);

--
-- Indices de la tabla `presentismo`
--
ALTER TABLE `presentismo`
  ADD PRIMARY KEY (`id_presentismo`),
  ADD KEY `fk_profesor` (`fk_profesor`),
  ADD KEY `fk_horadeconsulta` (`fk_horadeconsulta`);

--
-- Indices de la tabla `privilegio`
--
ALTER TABLE `privilegio`
  ADD PRIMARY KEY (`id_privilegio`);

--
-- Indices de la tabla `privilegioperfil`
--
ALTER TABLE `privilegioperfil`
  ADD PRIMARY KEY (`fk_perfil`,`fk_privilegio`),
  ADD KEY `fk_privilegio` (`fk_privilegio`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`id_profesor`),
  ADD KEY `fk_dedicacion_materia_profesor` (`fk_dedicacion_materia_profesor`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`id_turno`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_profesor` (`fk_profesor`),
  ADD KEY `fk_perfil` (`fk_perfil`),
  ADD KEY `fk_alumno` (`fk_alumno`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumno`
--
ALTER TABLE `alumno`
  MODIFY `id_alumno` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `anotadosestado`
--
ALTER TABLE `anotadosestado`
  MODIFY `id_anotadoestado` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `asueto`
--
ALTER TABLE `asueto`
  MODIFY `id_asueto` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `aula`
--
ALTER TABLE `aula`
  MODIFY `id_aula` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `avisoprofesor`
--
ALTER TABLE `avisoprofesor`
  MODIFY `id_avisoprofesor` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `dedicacion`
--
ALTER TABLE `dedicacion`
  MODIFY `id_dedicacion` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `dedicacion_materia_profesor`
--
ALTER TABLE `dedicacion_materia_profesor`
  MODIFY `id_dedicacion_materia_profesor` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_departamento` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalleanotados`
--
ALTER TABLE `detalleanotados`
  MODIFY `id_detalleanotados` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `dia`
--
ALTER TABLE `dia`
  MODIFY `id_dia` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `estadoanotados`
--
ALTER TABLE `estadoanotados`
  MODIFY `id_estadoanotados` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `falta`
--
ALTER TABLE `falta`
  MODIFY `id_falta` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `fechamesa`
--
ALTER TABLE `fechamesa`
  MODIFY `id_fechaMesa` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `horadeconsulta`
--
ALTER TABLE `horadeconsulta`
  MODIFY `id_horadeconsulta` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `horariocursado`
--
ALTER TABLE `horariocursado`
  MODIFY `id_horariocursado` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `horariodeconsulta`
--
ALTER TABLE `horariodeconsulta`
  MODIFY `id_horariodeconsulta` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `presentismo`
--
ALTER TABLE `presentismo`
  MODIFY `id_presentismo` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `privilegio`
--
ALTER TABLE `privilegio`
  MODIFY `id_privilegio` int(35) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `id_profesor` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `id_turno` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
