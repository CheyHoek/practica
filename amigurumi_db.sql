-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2023 a las 22:14:25
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `amigurumi_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `amigurumi`
--

CREATE TABLE `amigurumi` (
  `id` int(11) NOT NULL,
  `nombre` text DEFAULT NULL,
  `altura` double DEFAULT NULL,
  `ancho` double DEFAULT NULL,
  `descripcion` text NOT NULL,
  `costoMateriales` double DEFAULT NULL,
  `horasTrabajo` double DEFAULT NULL,
  `tarifaHora` double DEFAULT NULL,
  `factorGanancia` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `amigurumi`
--

INSERT INTO `amigurumi` (`id`, `nombre`, `altura`, `ancho`, `descripcion`, `costoMateriales`, `horasTrabajo`, `tarifaHora`, `factorGanancia`) VALUES
(1, 'corazon', 4, 4, 'Llavero de corazón elaborado con algodón', 25, 4, 50, 1),
(5, '', 0, 0, '0', 0, 0, 0, 0),
(6, '', 0, 0, '', 0, 0, 0, 0),
(7, '', 0, 0, '', 0, 0, 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `amigurumi`
--
ALTER TABLE `amigurumi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `amigurumi`
--
ALTER TABLE `amigurumi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
