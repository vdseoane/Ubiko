-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-05-2016 a las 10:34:10
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ubiko`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cama`
--

CREATE TABLE IF NOT EXISTS `cama` (
  `Localizacion_idLocalizacion` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `numeroCama` int(11) NOT NULL,
  `Paciente_NHCPaciente` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`Localizacion_idLocalizacion`,`numeroCama`),
  KEY `fk_Cama_Paciente1_idx` (`Paciente_NHCPaciente`),
  KEY `fk_Cama_Localizacion1_idx` (`Localizacion_idLocalizacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cama`
--

INSERT INTO `cama` (`Localizacion_idLocalizacion`, `numeroCama`, `Paciente_NHCPaciente`) VALUES
('BOX', 1, NULL),
('BOX', 2, NULL),
('BOX', 3, NULL),
('BOX', 4, NULL),
('BOX', 5, NULL),
('BOX', 6, NULL),
('BOX', 7, NULL),
('BOX', 8, NULL),
('BOX', 9, NULL),
('BOX', 10, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localizacion`
--

CREATE TABLE IF NOT EXISTS `localizacion` (
  `idLocalizacion` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `numeroPlanta` int(11) DEFAULT NULL,
  `nombreLocalizacion` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idLocalizacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `localizacion`
--

INSERT INTO `localizacion` (`idLocalizacion`, `numeroPlanta`, `nombreLocalizacion`) VALUES
('BOX', 1, 'BOX'),
('ECO', 2, 'Ecografia'),
('QUI', 4, 'Quirofano'),
('RX', -2, 'Rayos X'),
('SA', 0, 'Sala A'),
('SalaOBS', 0, 'Sala de Ob'),
('SalaTRA', 3, 'Sala TRA'),
('SB', 1, 'Sala B'),
('TAC', -1, 'Tac'),
('TR', 0, 'Triaje');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE IF NOT EXISTS `paciente` (
  `NHC` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `Nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `Apellidos` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Calle` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Estado` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `anotaciones` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`NHC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`NHC`, `Nombre`, `Apellidos`, `Calle`, `Estado`, `telefono`, `anotaciones`) VALUES
('0502', 'Maria', 'G P', '', '1', 0, ''),
('111222333', 'Alberto', 'Dominguez Diaz', 'Calle falsa n 123', '', 665587745, 'Estas son mis primeras anotaciones'),
('12545', 'vic', 'diaz', '', '1', 0, ''),
('2222', 'paciente', 'paciente', '11111', '1', 111111, '2sdcvsfv'),
('3200', 'pacientePrueba', 'Prueba', '', '1', 0, ''),
('564', 'hola', 'hola', 'hola', '1', 546, 'sadf'),
('5648', 'Maria', 'Gonzalez Perez', 'asjfdgvhsg', '1', 673296766, 'Guapi'),
('6666', 'vd', 'vd', 'vd', '1', 6666, 'vdvdvd\r\n'),
('8745', 'paciente 2 ', 'paaaciente', 'aszdcvasdv', '1', 665874, 'asdvasv'),
('888', 'hola', 'hola', 'hola', '1', 777, 'sdf'),
('985', 'hola', 'hola', 'holalalalala', '1', 77777, 'sadhsdl'),
('999', 'qq', 'qq', '', '1', 0, ''),
('9999', 'caca', 'caca', '', '1', 0, ''),
('99999', 'ppp', 'ppp', 'ppp', '1', 0, 'ppp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacionpaciente`
--

CREATE TABLE IF NOT EXISTS `ubicacionpaciente` (
  `Localizacion_idLocalizacion` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `Usuario_idUsuario` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time DEFAULT NULL,
  `Paciente_NHC` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`Localizacion_idLocalizacion`,`Usuario_idUsuario`,`fecha`,`horaInicio`,`Paciente_NHC`),
  KEY `fk_Paciente_has_Localizacion_Localizacion1_idx` (`Localizacion_idLocalizacion`),
  KEY `fk_Paciente_has_Localizacion_Usuario1_idx` (`Usuario_idUsuario`),
  KEY `fk_ubicacionPaciente_Paciente1_idx` (`Paciente_NHC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ubicacionpaciente`
--

INSERT INTO `ubicacionpaciente` (`Localizacion_idLocalizacion`, `Usuario_idUsuario`, `fecha`, `horaInicio`, `horaFin`, `Paciente_NHC`) VALUES
('TR', 'usuario', '2016-05-17', '08:37:00', NULL, '3200'),
('TR', 'usuario', '2016-05-17', '09:07:00', NULL, '0502');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Password` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `Password`) VALUES
('usuario', 'user'),
('vdseoane', 'vdseoane');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cama`
--
ALTER TABLE `cama`
  ADD CONSTRAINT `fk_Cama_Localizacion1` FOREIGN KEY (`Localizacion_idLocalizacion`) REFERENCES `localizacion` (`idLocalizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cama_Paciente1` FOREIGN KEY (`Paciente_NHCPaciente`) REFERENCES `paciente` (`NHC`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ubicacionpaciente`
--
ALTER TABLE `ubicacionpaciente`
  ADD CONSTRAINT `fk_Paciente_has_Localizacion_Localizacion1` FOREIGN KEY (`Localizacion_idLocalizacion`) REFERENCES `localizacion` (`idLocalizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Paciente_has_Localizacion_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ubicacionPaciente_Paciente1` FOREIGN KEY (`Paciente_NHC`) REFERENCES `paciente` (`NHC`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
