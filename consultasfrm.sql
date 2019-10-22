-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2019 a las 04:31:56
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
(2, 32145, 'Porte', 'Gaston', 'email', '2019-09-09', '2618586488'),
(4, 123, '123', '123', '', '0000-00-00', ''),
(16, 1234, '1234', '1234', '1234', '2019-08-01', '');

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
(83, '2019-09-21', '20:16:21', 2, 73),
(84, '2019-09-21', '20:17:17', 1, 73),
(85, '2019-09-21', '20:17:57', 2, 73),
(86, '2019-09-21', '20:18:01', 1, 73),
(87, '2019-09-21', '20:18:04', 2, 73),
(88, '2019-09-21', '20:18:07', 1, 73),
(90, '2019-09-21', '20:19:20', 1, 78),
(94, '2019-09-22', '22:47:03', 2, 73),
(95, '2019-09-22', '22:54:31', 1, 73),
(104, '2019-09-23', '00:24:43', 2, 73),
(105, '2019-09-23', '00:24:54', 1, 73),
(106, '2019-09-23', '00:25:07', 2, 73),
(107, '2019-09-23', '00:25:11', 1, 73),
(108, '2019-09-23', '00:30:26', 2, 73),
(109, '2019-09-23', '00:31:09', 1, 73),
(110, '2019-09-23', '00:31:23', 2, 73),
(111, '2019-09-23', '01:33:42', 1, 78),
(112, '2019-09-23', '12:18:57', 1, 73),
(113, '2019-09-23', '12:19:32', 2, 73),
(114, '2019-09-23', '12:19:41', 1, 73),
(115, '2019-09-23', '12:23:47', 2, 73),
(116, '2019-09-23', '12:23:50', 1, 73),
(117, '2019-09-23', '12:24:52', 2, 73),
(118, '2019-09-23', '12:24:55', 1, 73),
(119, '2019-09-23', '12:25:52', 2, 73),
(120, '2019-09-23', '12:25:55', 1, 73),
(121, '2019-09-23', '12:27:24', 2, 73),
(122, '2019-09-23', '12:27:27', 1, 73),
(123, '2019-09-23', '12:28:00', 2, 73),
(124, '2019-09-23', '12:28:03', 1, 73),
(125, '2019-09-23', '12:31:06', 2, 73),
(126, '2019-09-23', '12:31:11', 1, 73),
(127, '2019-09-23', '12:33:25', 2, 73),
(128, '2019-09-23', '12:33:29', 1, 73),
(131, '2019-09-28', '18:02:04', 2, 73),
(132, '2019-09-28', '18:02:18', 1, 73),
(139, '2019-10-12', '13:19:26', 2, 73),
(141, '2019-10-12', '13:20:18', 1, 73),
(147, '2019-10-12', '19:52:30', 4, 90),
(148, '2019-10-12', '19:53:03', 1, 91),
(149, '2019-10-14', '22:15:52', 2, 90),
(150, '2019-10-14', '22:21:14', 4, 91),
(151, '2019-10-20', '04:14:21', 1, 92),
(152, '2019-10-20', '04:16:48', 2, 92),
(153, '2019-10-20', '04:23:24', 1, 91);

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
(971, '2019-12-30', '08:00:00', '23:30:00'),
(972, '2019-12-31', '08:00:00', '23:30:00'),
(973, '2020-01-01', '08:00:00', '23:30:00'),
(974, '2020-01-02', '08:00:00', '23:30:00'),
(975, '2020-01-03', '08:00:00', '23:30:00'),
(976, '2020-01-04', '08:00:00', '23:30:00'),
(977, '2020-01-05', '08:00:00', '23:30:00'),
(978, '2020-01-06', '08:00:00', '23:30:00'),
(979, '2020-01-07', '08:00:00', '23:30:00'),
(980, '2020-01-08', '08:00:00', '23:30:00'),
(981, '2020-01-09', '08:00:00', '23:30:00'),
(982, '2020-01-10', '08:00:00', '23:30:00'),
(983, '2020-01-11', '08:00:00', '23:30:00'),
(984, '2020-01-12', '08:00:00', '23:30:00'),
(985, '2020-01-13', '08:00:00', '23:30:00'),
(986, '2020-01-14', '08:00:00', '23:30:00'),
(987, '2020-01-15', '08:00:00', '23:30:00'),
(988, '2020-01-16', '08:00:00', '23:30:00'),
(989, '2020-01-17', '08:00:00', '23:30:00'),
(990, '2020-01-18', '08:00:00', '23:30:00'),
(991, '2020-01-19', '08:00:00', '23:30:00'),
(992, '2020-01-20', '08:00:00', '23:30:00'),
(993, '2020-01-21', '08:00:00', '23:30:00'),
(994, '2020-01-22', '08:00:00', '23:30:00'),
(995, '2020-01-23', '08:00:00', '23:30:00'),
(996, '2020-01-24', '08:00:00', '23:30:00'),
(997, '2020-01-25', '08:00:00', '23:30:00'),
(998, '2020-01-26', '08:00:00', '23:30:00'),
(999, '2020-01-27', '08:00:00', '23:30:00'),
(1000, '2020-01-28', '08:00:00', '23:30:00'),
(1001, '2020-01-29', '08:00:00', '23:30:00'),
(1002, '2020-01-30', '08:00:00', '23:30:00'),
(1003, '2020-01-31', '08:00:00', '23:30:00'),
(1004, '2020-02-01', '08:00:00', '23:30:00'),
(1005, '2020-02-02', '08:00:00', '23:30:00'),
(1006, '2020-02-03', '08:00:00', '23:30:00'),
(1007, '2020-02-04', '08:00:00', '23:30:00'),
(1008, '2020-02-05', '08:00:00', '23:30:00'),
(1009, '2020-02-06', '08:00:00', '23:30:00'),
(1010, '2020-02-07', '08:00:00', '23:30:00'),
(1011, '2020-02-08', '08:00:00', '23:30:00'),
(1012, '2020-02-09', '08:00:00', '23:30:00'),
(1013, '2020-02-10', '08:00:00', '23:30:00'),
(1014, '2020-02-11', '08:00:00', '23:30:00'),
(1015, '2020-02-12', '08:00:00', '23:30:00'),
(1016, '2020-02-13', '08:00:00', '23:30:00'),
(1017, '2020-02-14', '08:00:00', '23:30:00'),
(1018, '2020-02-15', '08:00:00', '23:30:00'),
(1019, '2020-02-16', '08:00:00', '23:30:00'),
(1020, '2020-02-17', '08:00:00', '23:30:00'),
(1021, '2020-02-18', '08:00:00', '23:30:00'),
(1022, '2020-02-19', '08:00:00', '23:30:00'),
(1023, '2020-02-20', '08:00:00', '23:30:00'),
(1024, '2020-02-21', '08:00:00', '23:30:00'),
(1025, '2020-02-22', '08:00:00', '23:30:00'),
(1026, '2020-02-23', '08:00:00', '23:30:00'),
(1027, '2020-02-24', '08:00:00', '23:30:00'),
(1028, '2020-02-25', '08:00:00', '23:30:00'),
(1029, '2020-02-26', '08:00:00', '23:30:00'),
(1030, '2020-02-27', '08:00:00', '23:30:00'),
(1031, '2020-02-28', '08:00:00', '23:30:00'),
(1032, '2020-02-29', '08:00:00', '23:30:00'),
(1033, '2020-03-01', '08:00:00', '23:30:00'),
(1065, '2020-03-01', '08:00:00', '23:30:00'),
(1070, '2020-03-01', '08:00:00', '23:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

CREATE TABLE `aula` (
  `cuerpoAula` varchar(20) NOT NULL,
  `nivelAula` int(11) NOT NULL,
  `numeroAula` varchar(20) NOT NULL,
  `id_aula` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `aula`
--

INSERT INTO `aula` (`cuerpoAula`, `nivelAula`, `numeroAula`, `id_aula`) VALUES
('qwe', 1, '123', 106),
('', 0, '', 107);

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

--
-- Volcado de datos para la tabla `avisoprofesor`
--

INSERT INTO `avisoprofesor` (`id_avisoprofesor`, `fechaAvisoProfesor`, `detalleDescripcion`, `fk_horadeconsulta`, `horaAvisoProfesor`) VALUES
(9, '2019-10-12', 'pikachu', 28, '15:59:58.00000'),
(10, '2019-10-12', 'pikachu', 28, '16:03:25.00000'),
(11, '2019-10-12', 'pikachu', 28, '16:07:05.00000'),
(12, '2019-10-12', 'pikachu', 28, '16:10:43.00000'),
(13, '2019-10-12', '1', 31, '18:29:03.00000'),
(14, '2019-10-12', '2', 32, '18:29:06.00000'),
(15, '2019-10-12', 'pikachu', 31, '18:53:47.00000'),
(16, '2019-10-12', 'pikachu', 31, '18:56:09.00000'),
(17, '2019-10-12', 'pikachu', 31, '18:57:00.00000'),
(18, '2019-10-12', 'test mails 2', 31, '19:43:25.00000'),
(19, '2019-10-12', 'NO TIFICACION', 31, '19:44:22.00000'),
(20, '2019-10-12', 'test mail v1.0', 31, '19:53:30.00000'),
(21, '2019-10-12', 'v2.0', 31, '19:54:56.00000'),
(22, '2019-10-12', 'v.3', 31, '19:55:25.00000'),
(23, '2019-10-12', 'v.4', 31, '19:58:30.00000');

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
(1, 1, 1, 2, NULL),
(2, 2, 4, 2, NULL),
(3, 2, 2, 3, NULL),
(4, 2, 2, 3, NULL),
(5, 1, 3, 5, 1),
(6, 1, 7, 6, NULL),
(7, 1, 7, 6, NULL),
(8, 1, 7, 6, NULL),
(9, 1, 7, 6, NULL),
(18, 1, 7, 10, NULL);

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
(90, '2019-10-12', '19:52:30.000000', '1', 2, 31),
(91, '2019-10-12', '19:53:03.000000', '', 1, 31),
(92, '2019-10-20', '04:14:21.000000', '', 1, 54);

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
  `min` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
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

--
-- Volcado de datos para la tabla `fechamesa`
--

INSERT INTO `fechamesa` (`id_fechaMesa`, `fechaMesa`) VALUES
(46, '2020-02-22'),
(56, '2020-01-14'),
(57, '2020-01-15'),
(58, '2019-10-30'),
(59, '2019-10-31'),
(60, '2021-10-11'),
(62, '2019-10-20');

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
(31, '2019-10-12', '2019-10-22', 4, 'activo', 'activo', 1, 65, 2),
(40, '2019-10-08', '2019-10-15', 0, 'activo', 'completo', 1, 64, 2),
(54, '2019-10-15', '2019-10-29', 0, 'activo', 'activo', 1, 64, 2);

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
(1, '08:00:00', '08:00:00', 5, 3, '1', 1, NULL, NULL);

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
(62, '08:00', '2019-10-12', '0000-00-00', 1, 1, 2, 1, 1, 1),
(63, '08:00', '2019-10-12', '0000-00-00', 4, 1, 2, 1, 2, 2),
(64, '08:00', '2019-10-12', '0000-00-00', 2, 1, 4, 2, 1, 1),
(65, '08:00', '2019-10-12', '0000-00-00', 4, 1, 2, 2, 2, 2),
(66, '08:00', '2019-10-12', '0000-00-00', 2, 1, 2, 31, 1, 2),
(67, '08:00', '2019-10-12', '0000-00-00', 2, 1, 2, 32, 1, 1);

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
(1, 'Proyecto Final', 1, 1),
(2, 'Computacion en la Nube', 1, 5),
(3, 'Análisis matemático', 2, 3),
(4, 'Administración Gerencial', 1, 2),
(5, 'pikachu 3', 1, 3),
(6, 'pikachu 4', 1, 5),
(7, 'quimica 1', 6, 3);

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
(1, 2),
(1, 3),
(2, 1),
(4, 4);

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
('profesor', 2);

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

--
-- Volcado de datos para la tabla `presentismo`
--

INSERT INTO `presentismo` (`id_presentismo`, `fecha`, `horaDesde`, `horaHasta`, `fk_profesor`, `fk_horadeconsulta`) VALUES
(21, '2019-10-15', '00:50:52', '00:50:56', 2, 40);

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
(2, '1234', 'Vazquez', 'Alejandro ', 'vandenboschlucas@gmail.com', NULL),
(3, '789', 'Ryan', 'Mauricio', 'mauriciorayan@gmail.com', NULL),
(4, '1234', 'Moralejo', 'Raúl ', 'moralejoraul@gmail.com', NULL),
(5, '4321', 'Manino', 'Gustavo', 'marinogustavo@gmail.com', NULL),
(6, '1452', 'Villa', 'Diego', 'villadiego@gmail.com', NULL),
(10, '4625', 'Profesor', 'Señor', 'señorProfesor@hotmail.com', NULL);

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
  `fk_perfil` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `contraseña`, `fk_alumno`, `fk_profesor`, `fk_perfil`) VALUES
(6, '35821', '$2y$10$LTAsfQoxzhQXQOu88XBAoerUDbW7O68wNPrHz3x8gIc0Ddnyt61s6', 1, NULL, 1),
(7, 'porte', '$2y$10$LHdyKE6JxmTVqA6T.mdYPOblig4zCJw.BeUbalTk21wSG/h89uaJW', 2, NULL, 1),
(8, 'test', '$2y$10$jEshAdowgM5ekVRLD/b9YenbPegwO3aFY0vkwHU6KQ51rgBYg33ZK', 4, NULL, 1),
(10, 'root', '$2y$10$PNwqEM24Ie1UMpkA999Z8eTrPa3.WRJ6UrU7U6sWDjCYEoP.qQs8K', NULL, 2, 2),
(11, '4625', '$2y$10$BrXc50ww8zVVbEtCOezPzO.NCdcf7qVu08.WDz2byPVIOouhfOiAC', NULL, 10, 2);

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
  MODIFY `id_alumno` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `anotadosestado`
--
ALTER TABLE `anotadosestado`
  MODIFY `id_anotadoestado` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;
--
-- AUTO_INCREMENT de la tabla `asueto`
--
ALTER TABLE `asueto`
  MODIFY `id_asueto` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1071;
--
-- AUTO_INCREMENT de la tabla `aula`
--
ALTER TABLE `aula`
  MODIFY `id_aula` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;
--
-- AUTO_INCREMENT de la tabla `avisoprofesor`
--
ALTER TABLE `avisoprofesor`
  MODIFY `id_avisoprofesor` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT de la tabla `dedicacion`
--
ALTER TABLE `dedicacion`
  MODIFY `id_dedicacion` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `dedicacion_materia_profesor`
--
ALTER TABLE `dedicacion_materia_profesor`
  MODIFY `id_dedicacion_materia_profesor` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
  MODIFY `id_departamento` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `detalleanotados`
--
ALTER TABLE `detalleanotados`
  MODIFY `id_detalleanotados` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
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
  MODIFY `id_fechaMesa` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT de la tabla `horadeconsulta`
--
ALTER TABLE `horadeconsulta`
  MODIFY `id_horadeconsulta` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT de la tabla `horariocursado`
--
ALTER TABLE `horariocursado`
  MODIFY `id_horariocursado` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `horariodeconsulta`
--
ALTER TABLE `horariodeconsulta`
  MODIFY `id_horariodeconsulta` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT de la tabla `materia`
--
ALTER TABLE `materia`
  MODIFY `id_materia` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `presentismo`
--
ALTER TABLE `presentismo`
  MODIFY `id_presentismo` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `privilegio`
--
ALTER TABLE `privilegio`
  MODIFY `id_privilegio` int(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `id_profesor` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `id_turno` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
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
  ADD CONSTRAINT `dedicacion_materia_profesor_ibfk_2` FOREIGN KEY (`fk_materia`) REFERENCES `materia` (`id_materia`),
  ADD CONSTRAINT `dedicacion_materia_profesor_ibfk_3` FOREIGN KEY (`fk_profesor`) REFERENCES `profesor` (`id_profesor`);

--
-- Filtros para la tabla `detalleanotados`
--
ALTER TABLE `detalleanotados`
  ADD CONSTRAINT `detalleanotados_ibfk_1` FOREIGN KEY (`fk_alumno`) REFERENCES `alumno` (`id_alumno`),
  ADD CONSTRAINT `detalleanotados_ibfk_2` FOREIGN KEY (`fk_horadeconsulta`) REFERENCES `horadeconsulta` (`id_horadeconsulta`);

--
-- Filtros para la tabla `falta`
--
ALTER TABLE `falta`
  ADD CONSTRAINT `falta_ibfk_1` FOREIGN KEY (`fk_horadeconsulta`) REFERENCES `horadeconsulta` (`id_horadeconsulta`),
  ADD CONSTRAINT `falta_ibfk_2` FOREIGN KEY (`fk_departamento`) REFERENCES `departamento` (`id_departamento`),
  ADD CONSTRAINT `falta_ibfk_3` FOREIGN KEY (`fk_materia`) REFERENCES `materia` (`id_materia`),
  ADD CONSTRAINT `falta_ibfk_4` FOREIGN KEY (`fk_profesor`) REFERENCES `profesor` (`id_profesor`);

--
-- Filtros para la tabla `horadeconsulta`
--
ALTER TABLE `horadeconsulta`
  ADD CONSTRAINT `horadeconsulta_ibfk_1` FOREIGN KEY (`fk_horariodeconsulta`) REFERENCES `horariodeconsulta` (`id_horariodeconsulta`),
  ADD CONSTRAINT `horadeconsulta_ibfk_2` FOREIGN KEY (`fk_materia`) REFERENCES `materia` (`id_materia`),
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
  ADD CONSTRAINT `presentismo_ibfk_1` FOREIGN KEY (`fk_profesor`) REFERENCES `profesor` (`id_profesor`),
  ADD CONSTRAINT `presentismo_ibfk_2` FOREIGN KEY (`fk_horadeconsulta`) REFERENCES `horadeconsulta` (`id_horadeconsulta`);

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
