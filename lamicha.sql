-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2024 a las 05:10:06
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lamicha`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descuento` tinyint(3) NOT NULL DEFAULT 0,
  `id_categoria` int(11) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `descuento`, `id_categoria`, `stock`, `activo`) VALUES
(1, 'Xbox Series S', 5899.00, 50, 1, 3, 1),
(2, 'Nintendo Switch', 5084.00, 30, 1, 1, 1),
(3, 'AirPods Pro', 4999.00, 25, 2, 2, 1),
(4, 'Audífonos Soundcore Life Series', 1799.00, 20, 2, 5, 1),
(5, 'iPhone 14 Pro (256GB)', 10679.00, 20, 3, 2, 1),
(6, 'Laptop HP 245 G9', 10349.00, 25, 3, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUser` int(11) NOT NULL,
  `user` text NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `telefono` text NOT NULL,
  `domicilio` text NOT NULL,
  `ciudad` text NOT NULL,
  `activo` int(11) NOT NULL DEFAULT 1,
  `iniciado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUser`, `user`, `password`, `email`, `telefono`, `domicilio`, `ciudad`, `activo`, `iniciado`) VALUES
(1, 'hacel', '$2y$10$WcPFT0Wf.pDYQ/pnPOjMdeQuXVFkTcISnGdqY4LGLod5ajPAkODoq', 'hacel1231@gmail.com', '3921364914', 'Porfirio Diaz 153', 'Jamay', 1, 0),
(2, 'renato', '$2y$10$OtXfi7H/iAECCHVJiwoQFeEvg8/TfkHFo07soSmZA35H5gGBLf8RO', 'hacelxcaly@hotmail.com', '3921231231', 'Porfirio Diaz 153', 'Jamay', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
