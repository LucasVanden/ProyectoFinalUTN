-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-09-2019 a las 03:35:37
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
  `telefonoAlumno` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`, `legajo`, `apellido`, `nombre`, `email`, `fechaNacimientoAlumno`, `telefonoAlumno`) VALUES
(1, 35821, 'van den bosch', 'lucas', 'vandenboschlucas@hotmail.com', '1992-05-18', '2616394922'),
(2, 32145, 'Porte', 'Gaston', 'email', '2019-09-09', '2618586488');

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

--
-- Volcado de datos para la tabla `anotadosestado`
--

INSERT INTO `anotadosestado` (`id_anotadoestado`, `fechaAnotadosEstado`, `horaAnotadosEstado`, `fk_estadoanotados`, `fk_detalleanotados`) VALUES
(35, '2019-09-19', '20:43:24', 1, 54),
(36, '2019-09-19', '20:49:40', 2, 54),
(37, '2019-09-19', '20:49:44', 1, 55),
(38, '2019-09-19', '21:22:18', 1, 56),
(39, '2019-09-19', '22:22:40', 2, 55),
(40, '2019-09-19', '22:23:29', 1, 57),
(41, '2019-09-19', '22:23:33', 2, 57),
(42, '2019-09-19', '22:23:41', 1, 58),
(43, '2019-09-19', '22:24:08', 2, 58),
(44, '2019-09-19', '22:24:16', 1, 59),
(45, '2019-09-19', '22:24:28', 2, 59),
(46, '2019-09-19', '22:29:12', 1, 60),
(47, '2019-09-19', '22:29:35', 2, 60),
(48, '2019-09-19', '22:29:39', 1, 61),
(49, '2019-09-19', '22:31:09', 2, 61);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asueto`
--

CREATE TABLE `asueto` (
  `id_asueto` int(20) NOT NULL,
  `fechaAsueto` date NOT NULL,
  `horaDesdeAsueto` time NOT NULL,
  `horaHastaAsueto` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `asueto`
--

INSERT INTO `asueto` (`id_asueto`, `fechaAsueto`, `horaDesdeAsueto`, `horaHastaAsueto`) VALUES
(4, '2019-07-19', '00:26:16', '00:26:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

CREATE TABLE `aula` (
  `cuerpoAula` varchar(20) NOT NULL,
  `nivelAula` int(11) NOT NULL,
  `numeroAula` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avisoprofesor`
--

CREATE TABLE `avisoprofesor` (
  `id_avisoprofesor` int(20) NOT NULL,
  `fechaAvisoProfesor` date NOT NULL,
  `detalleDescripcion` varchar(500) NOT NULL,
  `fk_horadeconsulta` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `avisoprofesor`
--

INSERT INTO `avisoprofesor` (`id_avisoprofesor`, `fechaAvisoProfesor`, `detalleDescripcion`, `fk_horadeconsulta`) VALUES
(2, '2019-09-19', 'no habra consulta', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dedicacion`
--

CREATE TABLE `dedicacion` (
  `id_dedicacion` int(16) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `cantidadHora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dedicacion_materia_profesor`
--

CREATE TABLE `dedicacion_materia_profesor` (
  `id_dedicacion_materia_profesor` int(20) NOT NULL,
  `fk_dedicacion` int(20) NOT NULL,
  `fk_materia` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `id_departamento` int(20) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `nombre`) VALUES
(1, 'Sistemas'),
(2, 'Básicas'),
(3, 'Civil'),
(4, 'Electrónica'),
(5, 'Electromecénica'),
(6, 'Química');

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

--
-- Volcado de datos para la tabla `detalleanotados`
--

INSERT INTO `detalleanotados` (`id_detalleanotados`, `fechaDesdeAnotados`, `horaDetalleAnotados`, `tema`, `fk_alumno`, `fk_horadeconsulta`) VALUES
(54, '2019-09-19', '20:43:24.000000', 'Probar repetido', 1, 2),
(55, '2019-09-19', '20:49:44.000000', 'Ingrese su tema (opcional)', 1, 2),
(56, '2019-09-19', '21:22:18.000000', 'Ingrese su tema (opcional)', 1, 3),
(57, '2019-09-19', '22:23:29.000000', 'lipieza', 1, 2),
(58, '2019-09-19', '22:23:41.000000', 'limpieza', 1, 2),
(59, '2019-09-19', '22:24:16.000000', 'Ingrese su tema (opcional)', 1, 2),
(60, '2019-09-19', '22:29:12.000000', 'Ingrese su tema (opcional)', 1, 2),
(61, '2019-09-19', '22:29:39.000000', 'Ingrese su tema (opcional)', 1, 2);

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
  `fk_presentismo` int(20) DEFAULT NULL,
  `fk_horariodeconsulta` int(20) NOT NULL,
  `fk_profesor` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `horadeconsulta`
--

INSERT INTO `horadeconsulta` (`id_horadeconsulta`, `fechaDesdeAnotados`, `fechaHastaAnotados`, `cantidadAnotados`, `estadoPresentismo`, `estadoVigencia`, `fk_materia`, `fk_presentismo`, `fk_horariodeconsulta`, `fk_profesor`) VALUES
(2, '2019-09-02', '2019-09-09', 0, 'pendiente', 'activo', 1, NULL, 1, 2),
(3, '2019-09-13', '2019-09-20', 0, 'pendiente', 'activo', 2, NULL, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horariocursado`
--

CREATE TABLE `horariocursado` (
  `id_horariocursado` int(20) NOT NULL,
  `HoraDesde` date NOT NULL,
  `comision` varchar(50) NOT NULL,
  `semestreAnula` varchar(50) NOT NULL,
  `fk_materia` int(20) NOT NULL,
  `HoraHasta` date NOT NULL,
  `fk_dia` int(20) NOT NULL,
  `fk_profesor` int(20) NOT NULL,
  `fk_turno` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horariodeconsulta`
--

CREATE TABLE `horariodeconsulta` (
  `id_horariodeconsulta` int(20) NOT NULL,
  `hora` varchar(10) NOT NULL,
  `activoDesde` date NOT NULL,
  `activoHasta` date NOT NULL,
  `semestre` int(11) NOT NULL,
  `fk_dia` int(20) NOT NULL,
  `fk_profesor` int(20) NOT NULL,
  `fk_materia` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `horariodeconsulta`
--

INSERT INTO `horariodeconsulta` (`id_horariodeconsulta`, `hora`, `activoDesde`, `activoHasta`, `semestre`, `fk_dia`, `fk_profesor`, `fk_materia`) VALUES
(1, '17:00', '2019-09-01', '2019-12-30', 2, 1, 2, 1),
(2, '18:30', '2019-09-19', '2019-09-26', 2, 5, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `id_materia` int(20) NOT NULL,
  `nombreMateria` varchar(50) NOT NULL,
  `fk_departamento` int(20) NOT NULL,
  `fk_dia` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id_materia`, `nombreMateria`, `fk_departamento`, `fk_dia`) VALUES
(1, 'ProyectoFinal', 1, 1),
(2, 'Computacion en la Nube', 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias_alumno`
--

CREATE TABLE `materias_alumno` (
  `fk_alumno` int(20) NOT NULL,
  `fk_materia` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `materias_alumno`
--

INSERT INTO `materias_alumno` (`fk_alumno`, `fk_materia`) VALUES
(1, 1),
(1, 2);

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
('alumno', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentismo`
--

CREATE TABLE `presentismo` (
  `id_presentismo` int(20) NOT NULL,
  `fecha` date NOT NULL,
  `horaDesde` time NOT NULL,
  `horaHasta` time NOT NULL,
  `fk_profesor` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegio`
--

CREATE TABLE `privilegio` (
  `nombrePrivilegio` varchar(20) NOT NULL,
  `numeroPerfil` int(11) NOT NULL,
  `id_privilegio` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegioperfil`
--

CREATE TABLE `privilegioperfil` (
  `fk_perfil` int(20) NOT NULL,
  `fk_privilegio` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `fk_dedicacion_materia_profesor` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`id_profesor`, `legajo`, `apellido`, `nombre`, `email`, `fk_dedicacion_materia_profesor`) VALUES
(2, '1234', 'Vazquez', 'Alejandro ', 'alejandro.vazquez@docentes.frm.utn.edu.ar', NULL),
(3, '789', 'Ryan', 'Mauricio', 'mauriciorayan@gmail.com', NULL);

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
  `fk_perfil` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `contraseña`, `fk_alumno`, `fk_profesor`, `fk_perfil`) VALUES
(6, '35821', '$2y$10$LTAsfQoxzhQXQOu88XBAoerUDbW7O68wNPrHz3x8gIc0Ddnyt61s6', 1, NULL, 1);

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
  ADD KEY `fk_materia` (`fk_materia`);

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
-- Indices de la tabla `horadeconsulta`
--
ALTER TABLE `horadeconsulta`
  ADD PRIMARY KEY (`id_horadeconsulta`),
  ADD KEY `fk_horariodeconsulta` (`fk_horariodeconsulta`),
  ADD KEY `fk_materia` (`fk_materia`),
  ADD KEY `fk_presentismo` (`fk_presentismo`),
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
-- Indices de la tabla `presentismo`
--
ALTER TABLE `presentismo`
  ADD PRIMARY KEY (`id_presentismo`),
  ADD KEY `fk_profesor` (`fk_profesor`);

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
  MODIFY `id_alumno` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `anotadosestado`
--
ALTER TABLE `anotadosestado`
  MODIFY `id_anotadoestado` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT de la tabla `asueto`
--
ALTER TABLE `asueto`
  MODIFY `id_asueto` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `avisoprofesor`
--
ALTER TABLE `avisoprofesor`
  MODIFY `id_avisoprofesor` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `dedicacion`
--
ALTER TABLE `dedicacion`
  MODIFY `id_dedicacion` int(16) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `dedicacion_materia_profesor`
--
ALTER TABLE `dedicacion_materia_profesor`
  MODIFY `id_dedicacion_materia_profesor` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_departamento` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `detalleanotados`
--
ALTER TABLE `detalleanotados`
  MODIFY `id_detalleanotados` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
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
-- AUTO_INCREMENT de la tabla `horadeconsulta`
--
ALTER TABLE `horadeconsulta`
  MODIFY `id_horadeconsulta` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `horariocursado`
--
ALTER TABLE `horariocursado`
  MODIFY `id_horariocursado` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `horariodeconsulta`
--
ALTER TABLE `horariodeconsulta`
  MODIFY `id_horariodeconsulta` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `presentismo`
--
ALTER TABLE `presentismo`
  MODIFY `id_presentismo` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `privilegio`
--
ALTER TABLE `privilegio`
  MODIFY `id_privilegio` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `id_profesor` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `id_turno` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anotadosestado`
--
ALTER TABLE `anotadosestado`
  ADD CONSTRAINT `anotadosestado_ibfk_1` FOREIGN KEY (`fk_detalleanotados`) REFERENCES `detalleanotados` (`id_detalleanotados`),
  ADD CONSTRAINT `anotadosestado_ibfk_2` FOREIGN KEY (`fk_estadoanotados`) REFERENCES `estadoanotados` (`id_estadoanotados`);

--
-- Filtros para la tabla `avisoprofesor`
--
ALTER TABLE `avisoprofesor`
  ADD CONSTRAINT `avisoprofesor_ibfk_1` FOREIGN KEY (`fk_horadeconsulta`) REFERENCES `horadeconsulta` (`id_horadeconsulta`);

--
-- Filtros para la tabla `dedicacion_materia_profesor`
--
ALTER TABLE `dedicacion_materia_profesor`
  ADD CONSTRAINT `dedicacion_materia_profesor_ibfk_1` FOREIGN KEY (`fk_dedicacion`) REFERENCES `dedicacion` (`id_dedicacion`),
  ADD CONSTRAINT `dedicacion_materia_profesor_ibfk_2` FOREIGN KEY (`fk_materia`) REFERENCES `materia` (`id_materia`);

--
-- Filtros para la tabla `detalleanotados`
--
ALTER TABLE `detalleanotados`
  ADD CONSTRAINT `detalleanotados_ibfk_3` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`id_alumno`),
  ADD CONSTRAINT `detalleanotados_ibfk_4` FOREIGN KEY (`fk_horadeconsulta`) REFERENCES `horadeconsulta` (`id_horadeconsulta`);

--
-- Filtros para la tabla `horadeconsulta`
--
ALTER TABLE `horadeconsulta`
  ADD CONSTRAINT `horadeconsulta_ibfk_1` FOREIGN KEY (`fk_horariodeconsulta`) REFERENCES `horariodeconsulta` (`id_horariodeconsulta`),
  ADD CONSTRAINT `horadeconsulta_ibfk_2` FOREIGN KEY (`fk_materia`) REFERENCES `materia` (`id_materia`),
  ADD CONSTRAINT `horadeconsulta_ibfk_3` FOREIGN KEY (`fk_presentismo`) REFERENCES `presentismo` (`id_presentismo`),
  ADD CONSTRAINT `horadeconsulta_ibfk_4` FOREIGN KEY (`fk_profesor`) REFERENCES `profesor` (`id_profesor`);

--
-- Filtros para la tabla `horariocursado`
--
ALTER TABLE `horariocursado`
  ADD CONSTRAINT `horariocursado_ibfk_1` FOREIGN KEY (`fk_dia`) REFERENCES `dia` (`id_dia`),
  ADD CONSTRAINT `horariocursado_ibfk_2` FOREIGN KEY (`fk_materia`) REFERENCES `materia` (`id_materia`),
  ADD CONSTRAINT `horariocursado_ibfk_3` FOREIGN KEY (`fk_profesor`) REFERENCES `profesor` (`id_profesor`),
  ADD CONSTRAINT `horariocursado_ibfk_4` FOREIGN KEY (`fk_turno`) REFERENCES `turno` (`id_turno`);

--
-- Filtros para la tabla `horariodeconsulta`
--
ALTER TABLE `horariodeconsulta`
  ADD CONSTRAINT `horariodeconsulta_ibfk_1` FOREIGN KEY (`fk_dia`) REFERENCES `dia` (`id_dia`),
  ADD CONSTRAINT `horariodeconsulta_ibfk_2` FOREIGN KEY (`fk_materia`) REFERENCES `materia` (`id_materia`),
  ADD CONSTRAINT `horariodeconsulta_ibfk_3` FOREIGN KEY (`fk_profesor`) REFERENCES `profesor` (`id_profesor`);

--
-- Filtros para la tabla `materia`
--
ALTER TABLE `materia`
  ADD CONSTRAINT `materia_ibfk_1` FOREIGN KEY (`fk_dia`) REFERENCES `dia` (`id_dia`),
  ADD CONSTRAINT `materia_ibfk_2` FOREIGN KEY (`fk_departamento`) REFERENCES `departamento` (`id_departamento`);

--
-- Filtros para la tabla `materias_alumno`
--
ALTER TABLE `materias_alumno`
  ADD CONSTRAINT `materias_alumno_ibfk_2` FOREIGN KEY (`fk_materia`) REFERENCES `materia` (`id_materia`),
  ADD CONSTRAINT `materias_alumno_ibfk_3` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`id_alumno`);

--
-- Filtros para la tabla `presentismo`
--
ALTER TABLE `presentismo`
  ADD CONSTRAINT `presentismo_ibfk_1` FOREIGN KEY (`fk_profesor`) REFERENCES `profesor` (`id_profesor`);

--
-- Filtros para la tabla `privilegioperfil`
--
ALTER TABLE `privilegioperfil`
  ADD CONSTRAINT `privilegioperfil_ibfk_1` FOREIGN KEY (`fk_perfil`) REFERENCES `perfil` (`id_perfil`),
  ADD CONSTRAINT `privilegioperfil_ibfk_2` FOREIGN KEY (`fk_privilegio`) REFERENCES `privilegio` (`id_privilegio`);

--
-- Filtros para la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD CONSTRAINT `profesor_ibfk_1` FOREIGN KEY (`fk_dedicacion_materia_profesor`) REFERENCES `dedicacion_materia_profesor` (`id_dedicacion_materia_profesor`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`fk_profesor`) REFERENCES `profesor` (`id_profesor`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`fk_perfil`) REFERENCES `perfil` (`id_perfil`),
  ADD CONSTRAINT `usuario_ibfk_4` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`id_alumno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
