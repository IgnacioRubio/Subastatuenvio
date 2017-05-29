-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-05-2017 a las 23:01:36
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `subastatuenvio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pujas`
--

CREATE TABLE `pujas` (
  `subasta` int(11) NOT NULL,
  `transportista` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `puja` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pujas`
--

INSERT INTO `pujas` (`subasta`, `transportista`, `puja`) VALUES
(2, 'ignacio@tusubasta.com', 300),
(2, 'transportista@transportista.com', 200),
(2, 'ignacio@tusubasta.com', 100),
(3, 'transportista@transportista.com', 200),
(3, 'transportista@transportista.com', 100),
(3, 'ignacio@tusubasta.com', 150),
(2, 'ignacio@tusubasta.com', 50),
(2, 'ignacio@tusubasta.com', 111);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `remitentes`
--

CREATE TABLE `remitentes` (
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `remitentes`
--

INSERT INTO `remitentes` (`nombre`, `apellidos`, `email`, `password`) VALUES
('Ignacio', 'Rubio Paredes', 'ignacio@tusubasta.com', '1'),
('Remitente', 'Remitente', 'remitente@remitente.com', 'remitente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subastas`
--

CREATE TABLE `subastas` (
  `id_subasta` int(11) NOT NULL,
  `titulo` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `medida` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `peso` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `origen` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `destino` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `duracion` int(3) NOT NULL,
  `descripcion` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creacion` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `remitente` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `subastas`
--

INSERT INTO `subastas` (`id_subasta`, `titulo`, `imagen`, `medida`, `peso`, `origen`, `destino`, `duracion`, `descripcion`, `fecha_creacion`, `categoria`, `remitente`) VALUES
(2, 'Peugeot 406', 'images/subastas/1495968882.jpg', '4555 mm', '1240 kg', 'Aviles', 'Alicante', 8, 'El Peugeot 406 es un automÃ³vil del segmento D producido por el fabricante franc', '1495968882', 'Carga Completa', 'ignacio@tusubasta.com'),
(3, 'PlayStation 4 nueva', 'images/subastas/1495973242.jpg', '-', '-', 'Aviles', 'Alicante', 4, 'PlayStation 4 nueva con garantÃ­a', '1495973242', 'Hogar', 'ignacio@tusubasta.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transportistas`
--

CREATE TABLE `transportistas` (
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `transportistas`
--

INSERT INTO `transportistas` (`nombre`, `apellidos`, `email`, `password`) VALUES
('Ignacio', 'Rubio Paredes', 'ignacio@tusubasta.com', '1'),
('Transportista', 'Hola', 'transportista@transportista.com', 'transportista');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `remitentes`
--
ALTER TABLE `remitentes`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `subastas`
--
ALTER TABLE `subastas`
  ADD PRIMARY KEY (`id_subasta`);

--
-- Indices de la tabla `transportistas`
--
ALTER TABLE `transportistas`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `subastas`
--
ALTER TABLE `subastas`
  MODIFY `id_subasta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
