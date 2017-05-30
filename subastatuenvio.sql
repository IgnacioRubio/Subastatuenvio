-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-05-2017 a las 22:07:07
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
('DIONISIO', 'RILLA', 'dionisio@rilla.edu', '1122'),
('Ignacio', 'Rubio Paredes', 'ignacio@tusubasta.com', '1'),
('JOSE CARLOS', 'ZURITA', 'jose.carlos@zurita.edu', '1122'),
('JUAN', 'FERNÁNDEZ', 'juan@fernandez.edu', '1122'),
('MATEO', 'GARCÍA', 'mateo@garcia.edu', '1122'),
('MIGUEL', 'SUÁREZ', 'miguel@suarez.edu', '1122'),
('OLGA', 'HEVIA', 'olga@hevia.edu', '1122'),
('Remitente', 'Remitente', 'remitente@remitente.com', 'remitente'),
('YOLANDA', 'AZCANO', 'yolanda@azcano.edu', '1122'),
('YOLANDA', 'IGLESIAS', 'yolanda@iglesias.edu', '1122');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subastas`
--

CREATE TABLE `subastas` (
  `id_subasta` int(11) NOT NULL,
  `titulo` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `medida` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `peso` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `origen` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `destino` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `duracion` int(3) NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_creacion` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `remitente` varchar(40) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `subastas`
--

INSERT INTO `subastas` (`id_subasta`, `titulo`, `imagen`, `medida`, `peso`, `origen`, `destino`, `duracion`, `descripcion`, `fecha_creacion`, `categoria`, `remitente`) VALUES
(2, 'Peugeot 406', 'images/subastas/1495968882.jpg', '4555 mm', '1240 kg', 'Aviles', 'Alicante', 8, 'El Peugeot 406 es un automÃ³vil del segmento D producido por el fabricante franc', '1496166953', 'Vehiculos', 'ignacio@tusubasta.com'),
(3, 'PlayStation 4 nueva', 'images/subastas/1495973242.jpg', '-', '-', 'Aviles', 'Alicante', 4, 'PlayStation 4 nueva con garantÃ­a', '1495973242', 'Hogar', 'ignacio@tusubasta.com'),
(4, 'Lenovo Ideapad 700-15ISK', 'images/subastas/1496172381.jpg', '-', '-', 'Vigo', 'Albacete', 48, 'PortÃ¡til de 15.6" FHD IPS (Intel Core I7-6700HQ, 8 GB de RAM, 1 TB de disco duro, Nvidia GeForce GTX 950M con 4 GB, sin sistema operativo) negro - teclado QWERTY espaÃ±ol', '1496172381', 'Industrial', 'ignacio@tusubasta.com'),
(5, 'Polti Vaporetto SV440_Double', 'images/subastas/1496172614.jpg', '32 x 20 x 112 cm', '2,4 Kg', 'Merida', 'Zaragoza', 72, 'Escoba a vapor de autonomÃ­a ilimitada apta para todo tipo de suelos\r\nMata y elimina el 99,99% de los gÃ©rmenes, bacterias y virus. Limpia e higieniza cualquier superficie sin necesidad de productos quÃ­micos\r\nLista para trabajar en solo 15 segundos\r\nFiltro anticalcareo integrado que permite la util', '1496172614', 'Hogar', 'jose.carlos@zurita.edu'),
(6, 'Avantree 40h de audic', 'images/subastas/1496172957.jpg', '18,2 x 19,7 x 8,2 cm', '181 g', 'Madrid', 'Teruel', 12, 'Modo DUAL Auriculares Over Ear Bluetooth con MicrÃ³fono, Super CÃ“MODO, InalÃ¡mbricos o con cable, Sonido de Alta Calidad aptX, NFC - Audition', '1496172957', 'Hogar', 'dionisio@rilla.edu'),
(7, 'Netgear EX3700-100PES', 'images/subastas/1496173108.jpg', '132 g', '5,5 x 6,7 x 3,9 cm', 'Barcelona', 'Alicante', 24, 'Extensor de red (Wi-Fi, Dual-Band, antenas externas), color blanco', '1496173108', 'Carga Parcial', 'juan@fernandez.edu'),
(8, 'BrÃ¼der Mannesmann Werkzeuge M 096-T - Carretilla', 'images/subastas/1496173307.jpg', '-', '-', 'Aviles', 'Santander', 8, 'BrÃ¼der Mannesmann Werkzeuge M 096-T - Carretilla', '1496173307', 'Industrial', 'mateo@garcia.edu'),
(9, 'KYG JJRC H36 Drone UFO 2.4G 4CH GirocompÃ¡s 6 Ejes ', 'images/subastas/1496173415.jpg', '14,4 x 11,6 x 8,8 cm', '181 g', 'Aviles', 'Valladolid', 72, 'KYG JJRC H36 Drone UFO 2.4G 4CH GirocompÃ¡s 6 Ejes Antiaplastamiento con Modo sin Cabeza Retorno Una Tecla 3D Flip Interruptor de Velocidad', '1496173415', 'Vehiculos', 'mateo@garcia.edu'),
(10, 'Litom 2 Packs LÃ¡mparas Solare', 'images/subastas/1496173561.jpg', '31,2 x 9,8 x 8,4 cm', '739 g', 'Palencia', 'Ponferrada', 48, 'Litom 2 Packs LÃ¡mparas Solares Gran Angular Impermeables SÃºper Potente de 800 lumenes en 270Â° con 54 LEDs FÃ¡cil de Instalar,2 Unidades de Luces Solares Exterior 800lm de Paredes con Sensor de Movimiento de 8 metros en 120Â° y 3 Modos de IluminaciÃ³n, 2 Luces LÃ¡mparas Focos Solares de Angulo Amp', '1496173561', 'Industrial', 'miguel@suarez.edu'),
(11, 'Fafada 35L Mochila de Senderismo Impermeable Viaje Mochila', 'images/subastas/1496173765.jpg', '-', '-', 'Lorca', 'Jerez', 4, 'Fafada 35L Mochila de Senderismo Impermeable Viaje Mochila', '1496173765', 'Carga Completa', 'olga@hevia.edu'),
(12, 'Etekcity Enchufes InalÃ¡mbricos Inteligentes', 'images/subastas/1496173919.jpg', '-', '-', 'Ciudad Real', 'Cordoba', 72, 'Etekcity Enchufes InalÃ¡mbricos Inteligentes con Control Remoto para ElectrodomÃ©sticos, Blanco (CÃ³digo de Aprendizaje, 3Rx-2Tx)', '1496173919', 'Hogar', 'yolanda@azcano.edu'),
(13, 'WindTook maleta de viaje', 'images/subastas/1496174043.jpg', '-', '-', 'Aviles', 'Madrid', 12, 'WindTook maleta de viaje equipaje de mano maleta, Maleta, Material Buena, 4 ruedas De tres piezas', '1496174043', 'Otros', 'yolanda@iglesias.edu');

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
('DIONISIO', 'RILLA', 'dionisio@rilla.edu', '1122'),
('Ignacio', 'Rubio Paredes', 'ignacio@tusubasta.com', '1'),
('JOSE CARLOS', 'ZURITA', 'jose.carlos@zurita.edu', '1122'),
('JUAN', 'FERNÁNDEZ', 'juan@fernandez.edu', '1122'),
('MATEO', 'GARCÍA', 'mateo@garcia.edu', '1122'),
('MIGUEL', 'SUÁREZ', 'miguel@suarez.edu', '1122'),
('OLGA', 'HEVIA', 'olga@hevia.edu', '1122'),
('Transportista', 'Hola', 'transportista@transportista.com', 'transportista'),
('YOLANDA', 'AZCANO', 'yolanda@azcano.edu', '1122'),
('YOLANDA', 'IGLESIAS', 'yolanda@iglesias.edu', '1122');

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
  MODIFY `id_subasta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
