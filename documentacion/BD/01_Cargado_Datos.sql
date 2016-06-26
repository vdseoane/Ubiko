-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-05-2016 a las 16:14:13
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

--
-- Volcado de datos para la tabla `cama`
--

INSERT INTO `cama` (`Localizacion_idLocalizacion`, `numeroCama`, `Paciente_NHCPaciente`) VALUES
('BOX', 1, NULL),
('BOX', 3, NULL),
('BOX', 4, NULL),
('BOX', 7, NULL),
('BOX', 8, NULL),
('BOX', 9, NULL),
('BOX', 11, NULL),
('BOX', 12, NULL),
('BOX', 14, NULL),
('BOX', 16, NULL),
('BOX', 18, NULL),
('BOX', 19, NULL),
('BOX', 20, NULL),
('BOX', 22, NULL),
('BOX', 23, NULL),
('BOX', 25, NULL),
('BOX', 26, NULL),
('BOX', 24, NULL),
('BOX', 10, NULL),
('BOX', 2, NULL),
('BOX', 6, NULL),
('BOX', 21, NULL),
('BOX', 13, NULL),
('BOX', 5, NULL),
('BOX', 15, NULL),
('BOX', 17, NULL);

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `localizacion`
--

INSERT INTO `localizacion` (`idLocalizacion`, `numeroPlanta`, `nombreLocalizacion`) VALUES
('AD', NULL, 'Admision'),
('ALTA', NULL, 'Alta'),
('BOX', 1, 'BOX'),
('ECO', 2, 'Ecografia'),
('EXITUS', NULL, 'Exitus'),
('QUI', 4, 'Quirofano'),
('RX', -2, 'Rayos X'),
('SALA A', 0, 'Sala A'),
('SALA B', 1, 'Sala B'),
('SALA OBS', 0, 'Sala de Ob'),
('SALA TRA', 3, 'Sala TRA'),
('TAC', -1, 'Tac'),
('TR', 0, 'Triaje');

-- --------------------------------------------------------

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `Password`) VALUES
('usuario', 'usuario'),
('vdseoane', 'vdseoane');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
