-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-04-2016 a las 16:36:42
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
  `Paciente_DNIPaciente` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`Localizacion_idLocalizacion`,`numeroCama`),
  KEY `fk_Cama_Paciente1_idx` (`Paciente_DNIPaciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cama`
--

INSERT INTO `cama` (`Localizacion_idLocalizacion`, `numeroCama`, `Paciente_DNIPaciente`) VALUES
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
  `DNIPaciente` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `Nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `Apellido1` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Apellido2` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Calle` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Numero` int(11) DEFAULT NULL,
  `Piso` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Estado` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`DNIPaciente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`DNIPaciente`, `Nombre`, `Apellido1`, `Apellido2`, `Calle`, `Numero`, `Piso`, `Estado`) VALUES
('33333333Ñ', 'María', 'García', 'García', 'Av Montepinar', 3, 'Entresuelo', NULL),
('44444444A', 'Pepito', 'Perez', 'Perez', 'Cale Falsa', 2, '3B', NULL),
('44444444B', 'Amador', 'Rivas', 'Rivas', 'Avenida Marín', 8, '8ºC', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacionpaciente`
--

CREATE TABLE IF NOT EXISTS `ubicacionpaciente` (
  `Paciente_DNIPaciente` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `Localizacion_idLocalizacion` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `Usuario_idUsuario` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time DEFAULT NULL,
  PRIMARY KEY (`Paciente_DNIPaciente`,`Localizacion_idLocalizacion`,`Usuario_idUsuario`,`fecha`,`horaInicio`),
  KEY `fk_Paciente_has_Localizacion_Localizacion1` (`Localizacion_idLocalizacion`),
  KEY `fk_Paciente_has_Localizacion_Usuario1` (`Usuario_idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
('usuario', 'usuario'),
('vdseoane', 'vdseoane');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cama`
--
ALTER TABLE `cama`
  ADD CONSTRAINT `fk_Cama_Paciente1` FOREIGN KEY (`Paciente_DNIPaciente`) REFERENCES `paciente` (`DNIPaciente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cama_Localizacion1` FOREIGN KEY (`Localizacion_idLocalizacion`) REFERENCES `localizacion` (`idLocalizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ubicacionpaciente`
--
ALTER TABLE `ubicacionpaciente`
  ADD CONSTRAINT `fk_Paciente_has_Localizacion_Paciente1` FOREIGN KEY (`Paciente_DNIPaciente`) REFERENCES `paciente` (`DNIPaciente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Paciente_has_Localizacion_Localizacion1` FOREIGN KEY (`Localizacion_idLocalizacion`) REFERENCES `localizacion` (`idLocalizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Paciente_has_Localizacion_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
