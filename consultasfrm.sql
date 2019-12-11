-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-12-2019 a las 20:42:36
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

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`id_alumno`, `legajo`, `apellido`, `nombre`, `email`, `fechaNacimientoAlumno`, `telefonoAlumno`, `eliminado`) VALUES
(26, 35821, 'Van den Bosch', 'Lucas', 'vandenboschlucas@gmail.com', '1992-05-18', '02616394922', NULL);

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
(259, '2019-12-06', '11:54:16', 1, 129),
(260, '2019-12-10', '23:42:06', 5, 129);

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

--
-- Volcado de datos para la tabla `asueto`
--

INSERT INTO `asueto` (`id_asueto`, `fechaAsueto`, `horaDesdeAsueto`, `horaHastaAsueto`, `tipo`) VALUES
(1224, '2019-01-01', '08:00:00', '23:30:00', 'receso'),
(1225, '2019-01-02', '08:00:00', '23:30:00', 'receso'),
(1226, '2019-01-03', '08:00:00', '23:30:00', 'receso'),
(1227, '2019-01-04', '08:00:00', '23:30:00', 'receso'),
(1228, '2019-01-05', '08:00:00', '23:30:00', 'receso'),
(1229, '2019-01-06', '08:00:00', '23:30:00', 'receso'),
(1230, '2019-01-07', '08:00:00', '23:30:00', 'receso'),
(1231, '2019-01-08', '08:00:00', '23:30:00', 'receso'),
(1232, '2019-01-09', '08:00:00', '23:30:00', 'receso'),
(1233, '2019-01-10', '08:00:00', '23:30:00', 'receso'),
(1234, '2019-01-11', '08:00:00', '23:30:00', 'receso'),
(1235, '2019-01-12', '08:00:00', '23:30:00', 'receso'),
(1236, '2019-01-13', '08:00:00', '23:30:00', 'receso'),
(1237, '2019-01-14', '08:00:00', '23:30:00', 'receso'),
(1238, '2019-01-15', '08:00:00', '23:30:00', 'receso'),
(1239, '2019-01-16', '08:00:00', '23:30:00', 'receso'),
(1240, '2019-01-17', '08:00:00', '23:30:00', 'receso'),
(1241, '2019-01-18', '08:00:00', '23:30:00', 'receso'),
(1242, '2019-01-19', '08:00:00', '23:30:00', 'receso'),
(1243, '2019-01-20', '08:00:00', '23:30:00', 'receso'),
(1244, '2019-01-21', '08:00:00', '23:30:00', 'receso'),
(1245, '2019-01-22', '08:00:00', '23:30:00', 'receso'),
(1246, '2019-01-23', '08:00:00', '23:30:00', 'receso'),
(1247, '2019-01-24', '08:00:00', '23:30:00', 'receso'),
(1248, '2019-01-25', '08:00:00', '23:30:00', 'receso'),
(1249, '2019-01-26', '08:00:00', '23:30:00', 'receso'),
(1250, '2019-01-27', '08:00:00', '23:30:00', 'receso'),
(1251, '2019-01-28', '08:00:00', '23:30:00', 'receso'),
(1252, '2019-01-29', '08:00:00', '23:30:00', 'receso'),
(1253, '2019-01-30', '08:00:00', '23:30:00', 'receso'),
(1254, '2019-01-31', '08:00:00', '23:30:00', 'receso'),
(1256, '2019-12-01', '08:00:00', '23:30:00', 'receso'),
(1257, '2019-12-02', '08:00:00', '23:30:00', 'receso'),
(1258, '2019-12-03', '08:00:00', '23:30:00', 'receso'),
(1259, '2019-12-04', '08:00:00', '23:30:00', 'receso'),
(1260, '2019-12-05', '08:00:00', '23:30:00', 'receso'),
(1261, '2019-12-06', '08:00:00', '23:30:00', 'receso'),
(1262, '2019-12-07', '08:00:00', '23:30:00', 'receso'),
(1263, '2019-12-08', '08:00:00', '23:30:00', 'receso'),
(1264, '2019-12-09', '08:00:00', '23:30:00', 'receso'),
(1265, '2019-12-10', '08:00:00', '23:30:00', 'receso'),
(1266, '2019-12-11', '08:00:00', '23:30:00', 'receso'),
(1267, '2019-12-12', '08:00:00', '23:30:00', 'receso'),
(1268, '2019-12-13', '08:00:00', '23:30:00', 'receso'),
(1269, '2019-12-14', '08:00:00', '23:30:00', 'receso'),
(1270, '2019-12-15', '08:00:00', '23:30:00', 'receso'),
(1271, '2019-12-16', '08:00:00', '23:30:00', 'receso'),
(1272, '2019-12-17', '08:00:00', '23:30:00', 'receso'),
(1273, '2019-12-18', '08:00:00', '23:30:00', 'receso'),
(1274, '2019-12-19', '08:00:00', '23:30:00', 'receso'),
(1275, '2019-12-20', '08:00:00', '23:30:00', 'receso'),
(1276, '2019-12-21', '08:00:00', '23:30:00', 'receso'),
(1277, '2019-12-22', '08:00:00', '23:30:00', 'receso'),
(1278, '2019-12-23', '08:00:00', '23:30:00', 'receso'),
(1279, '2019-12-24', '08:00:00', '23:30:00', 'receso'),
(1280, '2019-12-25', '08:00:00', '23:30:00', 'receso'),
(1281, '2019-12-26', '08:00:00', '23:30:00', 'receso'),
(1282, '2019-12-27', '08:00:00', '23:30:00', 'receso'),
(1283, '2019-12-28', '08:00:00', '23:30:00', 'receso'),
(1284, '2019-12-29', '08:00:00', '23:30:00', 'receso'),
(1285, '2019-12-30', '08:00:00', '23:30:00', 'receso'),
(1286, '2019-12-31', '08:00:00', '23:30:00', 'receso'),
(1287, '2019-04-12', '08:00:00', '23:30:00', 'feriado'),
(1288, '2019-05-01', '08:00:00', '23:30:00', 'feriado'),
(1289, '2019-05-25', '08:00:00', '23:30:00', 'feriado'),
(1290, '2019-12-25', '08:00:00', '23:30:00', 'feriado'),
(1291, '2019-10-10', '08:00:00', '23:30:00', 'feriado'),
(1294, '2019-02-01', '08:00:00', '23:30:00', 'feriado'),
(1295, '2019-02-09', '08:00:00', '23:30:00', 'feriado'),
(1296, '2019-02-06', '08:00:00', '23:30:00', 'feriado');

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

--
-- Volcado de datos para la tabla `aula`
--

INSERT INTO `aula` (`cuerpoAula`, `nivelAula`, `numeroAula`, `id_aula`, `eliminado`) VALUES
('central', 1, 'consultas', 143, NULL),
('1', 1, '01', 144, NULL),
('1', 1, '02', 145, NULL);

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
(1, 'doble', 2),
(2, 'simple', 1);

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

--
-- Volcado de datos para la tabla `dedicacion_materia_profesor`
--

INSERT INTO `dedicacion_materia_profesor` (`id_dedicacion_materia_profesor`, `fk_dedicacion`, `fk_materia`, `fk_profesor`, `eliminado`) VALUES
(83, 1, 24, 33, 1),
(84, 2, 26, 33, 1),
(85, 1, 24, 33, 1),
(86, 1, 25, 33, 1),
(87, 1, 26, 33, 1),
(88, 1, 24, 33, 1),
(89, 1, 25, 33, NULL),
(90, 1, 26, 33, 1),
(91, 1, 24, 33, NULL);

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

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `nombre`, `fk_aula`, `eliminado`) VALUES
(21, 'Sistemas', 143, NULL),
(22, 'Basicas', 144, NULL);

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
(129, '2019-12-06', '11:54:16.000000', 'lala', 26, 125);

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

--
-- Volcado de datos para la tabla `falta`
--

INSERT INTO `falta` (`id_falta`, `fechaFalta`, `tipo`, `minutos`, `fk_horadeconsulta`, `fk_materia`, `fk_profesor`, `fk_departamento`) VALUES
(1, '2019-12-09', 'Falta', NULL, 125, 24, 33, 21),
(2, '2019-12-09', 'Falta', NULL, 126, 24, 33, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fechamesa`
--

CREATE TABLE `fechamesa` (
  `id_fechaMesa` int(20) NOT NULL,
  `fechaMesa` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fechamesa`
--

INSERT INTO `fechamesa` (`id_fechaMesa`, `fechaMesa`) VALUES
(75, '2019-02-04'),
(76, '2019-02-05'),
(78, '2019-02-07'),
(79, '2019-02-08'),
(81, '2019-08-12'),
(82, '2019-08-13'),
(83, '2019-08-14'),
(84, '2019-08-15'),
(85, '2019-08-16'),
(86, '2019-11-04'),
(87, '2019-11-12'),
(88, '2019-11-28'),
(89, '2019-11-20'),
(90, '2019-10-25');

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

--
-- Volcado de datos para la tabla `horadeconsulta`
--

INSERT INTO `horadeconsulta` (`id_horadeconsulta`, `fechaDesdeAnotados`, `fechaHastaAnotados`, `cantidadAnotados`, `estadoPresentismo`, `estadoVigencia`, `fk_materia`, `fk_horariodeconsulta`, `fk_profesor`) VALUES
(125, '2019-12-06', '2019-12-09', 1, 'calculado', 'completo', 24, 132, 33),
(126, '2019-12-06', '2019-12-09', 0, 'calculado', 'completo', 24, 133, 33),
(127, '2019-12-09', '2020-01-06', 0, 'pendiente', 'activo', 24, 132, 33),
(128, '2019-12-09', '2020-01-06', 0, 'pendiente', 'activo', 24, 133, 33);

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

--
-- Volcado de datos para la tabla `horariocursado`
--

INSERT INTO `horariocursado` (`id_horariocursado`, `HoraDesde`, `HoraHasta`, `fk_profesor`, `fk_materia`, `semestreAnual`, `fk_dia`, `fk_turno`, `comision`) VALUES
(43, '14:00:00', '19:00:00', 33, 24, 'anual', 1, NULL, NULL),
(44, '19:00:00', '23:30:00', 33, 24, 'anual', 1, NULL, NULL);

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

--
-- Volcado de datos para la tabla `horariodeconsulta`
--

INSERT INTO `horariodeconsulta` (`id_horariodeconsulta`, `hora`, `activoDesde`, `activoHasta`, `fk_dia`, `fk_materia`, `fk_profesor`, `semestre`, `n`, `fk_aula`) VALUES
(130, '08:00', '2019-12-06', '0000-00-00', 1, 24, 33, 1, 1, 143),
(131, '09:00', '2019-12-06', '0000-00-00', 1, 24, 33, 1, 2, 143),
(132, '08:00', '2019-12-06', '0000-00-00', 1, 24, 33, 2, 1, 143),
(133, '09:00', '2019-12-06', '0000-00-00', 1, 24, 33, 2, 2, 143),
(134, '08:00', '2019-12-06', '0000-00-00', 4, 24, 33, 31, 1, 143),
(135, '08:00', '2019-12-06', '0000-00-00', 4, 24, 33, 32, 1, 143),
(136, '09:00', '2019-12-06', '0000-00-00', 4, 24, 33, 31, 2, 143),
(137, '09:00', '2019-12-06', '0000-00-00', 4, 24, 33, 32, 2, 143);

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

--
-- Volcado de datos para la tabla `materia`
--

INSERT INTO `materia` (`id_materia`, `nombreMateria`, `fk_departamento`, `fk_dia`, `eliminado`) VALUES
(24, 'Proyecto FInal', 21, 1, NULL),
(25, 'Analisis de sistema', 21, 3, NULL),
(26, 'Diseño de Sistemas', 21, 4, NULL);

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
(26, 24),
(26, 26);

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

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_persona`, `nombre`, `apellido`, `dni`, `email`, `eliminado`) VALUES
(8, 'aa', 'aa', 1, 'algo@gmail.com.ar', NULL),
(9, 'Admin', 'Admina', 3574, 'admin@gmail.com', NULL),
(10, 'test', 'test', 15478, 'algo@gmail.com.ar', NULL);

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
('Recesos', 1, 1),
('Feriados', 2, 2),
('Asuetos', 3, 3),
('Mesas', 4, 4),
('Aulas', 5, 5),
('Departamentos', 6, 6),
('Materias', 7, 7),
('Profesor', 8, 8),
('Asignar Materia a Profesor', 9, 9),
('Asignar Horario de Cursado', 10, 10),
('Cambiar Aula de consulta', 11, 11),
('Alumno', 12, 12),
('Cargo Director', 13, 13),
('Personal', 14, 14),
('Cerrar horas de Ausentes', 15, 15),
('Calcular Asistencia', 16, 16),
('Backup', 17, 17),
('Administrador', 30, 18);

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
(4, 18),
(6, 1),
(6, 2),
(6, 3),
(6, 7);

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

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`id_profesor`, `legajo`, `apellido`, `nombre`, `email`, `fk_dedicacion_materia_profesor`, `eliminado`) VALUES
(33, '1234', 'Vazques', 'Alejando', 'mail@gmail.com', NULL, NULL),
(34, '45688', 'ahora ', 'profe', 'algo@gmail.com.ar', NULL, NULL);

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
(10, 'root', '$2y$10$PNwqEM24Ie1UMpkA999Z8eTrPa3.WRJ6UrU7U6sWDjCYEoP.qQs8K', NULL, 2, 4, NULL, NULL),
(51, '1234', '$2y$10$zd1l7Ro5xkehn7yqDkvfdez00UYcJioTgWLymtxU.Y3eTfrciUzcm', NULL, 33, 3, NULL, NULL),
(52, '45688', '$2y$10$hQyvZ3Akft/TdYHYSQVkMui2sLMZhaTMSCGj4my7kp7DXnvQAU1HK', NULL, 34, 3, NULL, NULL),
(53, '35821', '$2y$10$0jX4ixRHNyQGsajrrij5meH5sT5e7Gkr2FoRma2h6kHyMub0QX23G', 26, NULL, 1, NULL, NULL),
(54, '1', '$2y$10$v4MankqoPPCAoZfVnBjlWe9Ys5KUz22t09.tuWl6B2ELDQo9affVi', NULL, NULL, 5, 8, NULL),
(55, '3574', '$2y$10$nOIU/fRbbv.ngnImn/bu2.O2yaVfC4k9kCbn1wrTVeiLaH.VSdlGm', NULL, NULL, 6, 9, NULL),
(56, '15478', '$2y$10$EHHC22SdYxgt0YlYjGfxD.1sn5zo4ysvn2W9XPrc5dj/0dSGiVIIm', NULL, NULL, 6, 10, NULL);

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
  MODIFY `id_alumno` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `anotadosestado`
--
ALTER TABLE `anotadosestado`
  MODIFY `id_anotadoestado` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;
--
-- AUTO_INCREMENT de la tabla `asueto`
--
ALTER TABLE `asueto`
  MODIFY `id_asueto` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1297;
--
-- AUTO_INCREMENT de la tabla `aula`
--
ALTER TABLE `aula`
  MODIFY `id_aula` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;
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
  MODIFY `id_dedicacion_materia_profesor` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_departamento` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT de la tabla `detalleanotados`
--
ALTER TABLE `detalleanotados`
  MODIFY `id_detalleanotados` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
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
  MODIFY `id_falta` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `fechamesa`
--
ALTER TABLE `fechamesa`
  MODIFY `id_fechaMesa` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT de la tabla `horadeconsulta`
--
ALTER TABLE `horadeconsulta`
  MODIFY `id_horadeconsulta` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT de la tabla `horariocursado`
--
ALTER TABLE `horariocursado`
  MODIFY `id_horariocursado` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT de la tabla `horariodeconsulta`
--
ALTER TABLE `horariodeconsulta`
  MODIFY `id_horariodeconsulta` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;
--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `presentismo`
--
ALTER TABLE `presentismo`
  MODIFY `id_presentismo` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `privilegio`
--
ALTER TABLE `privilegio`
  MODIFY `id_privilegio` int(35) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `id_profesor` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `id_turno` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
