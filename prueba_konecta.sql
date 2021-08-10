-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 10-08-2021 a las 02:56:44
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba_konecta`
--
CREATE DATABASE IF NOT EXISTS `prueba_konecta` DEFAULT CHARACTER SET utf16 COLLATE utf16_general_ci;
USE `prueba_konecta`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

DROP TABLE IF EXISTS `empleado`;
CREATE TABLE IF NOT EXISTS `empleado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_ingreso` date NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `salario` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf16;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

DROP TABLE IF EXISTS `solicitud`;
CREATE TABLE IF NOT EXISTS `solicitud` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `resumen` varchar(50) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_solicitud_empleado` (`id_empleado`)
) ENGINE=MyISAM DEFAULT CHARSET=utf16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
