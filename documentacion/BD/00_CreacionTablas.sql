-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net

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
-- Estructura de tabla para la tabla `localizacion`
--

CREATE TABLE IF NOT EXISTS `localizacion` (
  `idLocalizacion` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `numeroPlanta` int(11) DEFAULT NULL,
  `nombreLocalizacion` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idLocalizacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE IF NOT EXISTS `paciente` (
  `NHC` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `Nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `Apellidos` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Direccion` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Estado` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `anotaciones` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`NHC`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
  `orden` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`Localizacion_idLocalizacion`,`Usuario_idUsuario`,`fecha`,`horaInicio`,`Paciente_NHC`),
  UNIQUE KEY `orden` (`orden`),
  KEY `fk_Paciente_has_Localizacion_Localizacion1_idx` (`Localizacion_idLocalizacion`),
  KEY `fk_Paciente_has_Localizacion_Usuario1_idx` (`Usuario_idUsuario`),
  KEY `fk_ubicacionPaciente_Paciente1_idx` (`Paciente_NHC`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=625 ;

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `Password` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

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
