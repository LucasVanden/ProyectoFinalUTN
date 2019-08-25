-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-08-2019 a las 03:12:02
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

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
  `apellido` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `legajo` int(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `fechaNacimientoAlumno` date NOT NULL,
  `telefonoAlumno` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anotadosestado`
--

CREATE TABLE `anotadosestado` (
  `fechaAnotadosEstado` date NOT NULL,
  `horaAnotadosEstado` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asueto`
--

CREATE TABLE `asueto` (
  `horaDesdeAsueto` time NOT NULL,
  `horaHastaAsueto` time NOT NULL,
  `fechaAsueto` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aula`
--

CREATE TABLE `aula` (
  `cuerpoAula` varchar(20) NOT NULL,
  `nivelAula` int(11) NOT NULL,
  `numeroAula` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `avisoprofesor`
--

CREATE TABLE `avisoprofesor` (
  `detalleDescripcion` varchar(500) NOT NULL,
  `fechaAvisoProfesor` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dedicacion`
--

CREATE TABLE `dedicacion` (
  `tipo` varchar(20) NOT NULL,
  `cantidadHora` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE `departamento` (
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleanotados`
--

CREATE TABLE `detalleanotados` (
  `fechaDesdeAnotados` date NOT NULL,
  `horaDetalleAnotados` time(6) NOT NULL,
  `tema` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadoanotados`
--

CREATE TABLE `estadoanotados` (
  `nombreEstado` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horadeconsulta`
--

CREATE TABLE `horadeconsulta` (
  `fechaDesdeAnotados` date NOT NULL,
  `fechaHastaAnotados` date NOT NULL,
  `cantidadAnotados` int(50) NOT NULL,
  `estadoPresentismo` varchar(50) NOT NULL,
  `estadoVigencia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horariocursado`
--

CREATE TABLE `horariocursado` (
  `HoraDesde` date NOT NULL,
  `HoraHasta` date NOT NULL,
  `Dia` varchar(50) NOT NULL,
  `comision` varchar(50) NOT NULL,
  `semestreAnula` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horariodeconsulta`
--

CREATE TABLE `horariodeconsulta` (
  `dia` varchar(10) NOT NULL,
  `hora` varchar(10) NOT NULL,
  `activoDesde` date NOT NULL,
  `activoHasta` date NOT NULL,
  `semestre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horariodeconsultamesa`
--

CREATE TABLE `horariodeconsultamesa` (
  `dia` varchar(20) NOT NULL,
  `hora` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materia`
--

CREATE TABLE `materia` (
  `nombreMateria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `Dia` varchar(50) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `nombrePerfil` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `presentismo`
--

CREATE TABLE `presentismo` (
  `fecha` date NOT NULL,
  `horaDesde` time NOT NULL,
  `horaHasta` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegio`
--

CREATE TABLE `privilegio` (
  `nombrePrivilegio` varchar(20) NOT NULL,
  `numeroPerfil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegioperfil`
--

CREATE TABLE `privilegioperfil` (
  `idalgo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `apellido` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `legajo` varchar(20) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `nombre` varchar(20) NOT NULL,
  `HoraDesdeTurno` time NOT NULL,
  `HoraHastaTurno` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `contraseña` varchar(50) NOT NULL,
  `usuario` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD PRIMARY KEY (`legajo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
