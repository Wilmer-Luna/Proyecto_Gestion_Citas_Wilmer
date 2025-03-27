-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-03-2025 a las 03:34:35
-- Versión del servidor: 11.4.5-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `citas_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `servicio` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `usuario_id`, `nombre`, `servicio`, `fecha`, `hora`) VALUES
(43, 15, 'Wilmer Luna', 'MÃ©dico General', '2025-03-27', '08:00:00'),
(44, 15, 'Wilmer Luna', 'OdontologÃ­a', '2025-03-30', '09:00:00'),
(45, 15, 'Wilmer Luna', 'OtorrinolaringÃ³logo', '2025-03-28', '09:00:00'),
(46, 16, 'Mateo Trujillo', 'MÃ©dico General', '2025-03-31', '10:00:00'),
(47, 16, 'Mateo Trujillo', 'OftalmÃ³logo', '2025-04-01', '12:00:00'),
(48, 16, 'Mateo Trujillo', 'OtorrinolaringÃ³logo', '2025-03-31', '11:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('Paciente','Administrador') DEFAULT 'Paciente'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `rol`) VALUES
(14, 'Administrador', 'admin@gmail.com', '$2y$10$hRdstyD8Yl2KxwzPFyqkpe/3Mr1mYKUnsqx/l6C/cMEFBAKGA04h2', 'Administrador'),
(15, 'Wilmer Luna', 'wilmer@gmail.com', '$2y$10$Wr5G6f3klne2g9QrQZbpmuMGP4.q.O6pNqMON2iLAeQnXbqzf.mHi', 'Paciente'),
(16, 'Mateo Trujillo', 'mateo@gmail.com', '$2y$10$dTf9wVM2.zpzyWHF/cWrLezv83/2nrgTTq2UnJHAk2sVsQHcPNbne', 'Paciente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
