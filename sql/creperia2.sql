-- phpMyAdmin SQL Dump
-- version 5.2.1-dev+20220514.2e4c69d7b4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-05-2022 a las 02:09:06
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `creperia2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `imagen`) VALUES
(4, 'Crepas', 'crepa.jpg'),
(5, 'Donas', 'donas.jpg'),
(6, 'Churros', 'churros.jpg'),
(7, 'Hot Cakes', 'hotcakes.jpg'),
(8, 'Pasteles', 'pasteles.jpg'),
(9, 'Waffles', 'waffles.jpg'),
(10, 'Galletas', 'galletas.jpg'),
(11, 'Marquesitas', 'marquesitas.jpg'),
(12, 'Bebidas', 'bebidas.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(255) NOT NULL,
  `cantidad` int(255) NOT NULL,
  `pedido_id` int(255) NOT NULL,
  `producto_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `cantidad`, `pedido_id`, `producto_id`) VALUES
(2, 1, 7, 10),
(3, 3, 8, 10),
(4, 3, 9, 7),
(5, 3, 10, 3),
(6, 2, 10, 9),
(7, 1, 11, 7),
(8, 3, 12, 3),
(9, 1, 13, 7),
(10, 1, 13, 5),
(11, 4, 14, 5),
(12, 4, 14, 10),
(13, 4, 14, 11),
(14, 2, 15, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(255) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `colonia` varchar(100) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `total` float(100,2) NOT NULL,
  `estatus` varchar(45) DEFAULT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `usuario_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `direccion`, `colonia`, `municipio`, `telefono`, `total`, `estatus`, `fecha`, `hora`, `usuario_id`) VALUES
(7, 'Bosque de Limoneros 18', 'Real del Bosque', 'Tultitlan', '5582018797', 45.00, 'confirm', '2022-05-13', '12:58:32', 6),
(8, 'Bosque de Limoneros 18', 'Real del Bosque', 'Tultitlan', '5530408788', 135.00, 'confirm', '2022-05-13', '13:00:31', 6),
(9, 'San Mateo 19', 'Solidaridad', 'Tuititlan', '5532614596', 180.00, 'preparation', '2022-05-13', '13:04:11', 6),
(10, 'Chalco 12', 'La providencia', 'Chalco', '6543219871', 160.00, 'ready', '2022-05-13', '13:34:46', 11),
(11, 'Chalco 12', 'La providencia', 'Chalco', '6543219871', 60.00, 'ready', '2022-05-13', '13:57:53', 6),
(12, 'San Mateo 19', 'Solidaridad', 'Tuititlan', '5532614596', 90.00, 'confirm', '2022-05-13', '14:03:44', 6),
(13, 'Bosque de Limoneros', 'Solidaridad', 'Tuititlan', '5532614596', 115.00, 'sended', '2022-05-13', '14:17:07', 17),
(14, 'San Mateo 19', 'Solidaridad', 'Tuititlan', '5532614596', 540.00, 'sended', '2022-05-15', '20:33:22', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` mediumtext DEFAULT NULL,
  `precio` float(100,2) NOT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `categoria_id` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `fecha`, `imagen`, `categoria_id`) VALUES
(1, 'Crepa Pincelada', 'Crepa de Fresa con crema batida y chocolate', 65.00, '2022-05-10', 'crepaFresa.jpg', 4),
(3, 'Dona de Chocolate', 'Dona Tradicional de Chocolate con chispas de colores.', 30.00, '2022-05-10', 'donaChocolate.jpg', 5),
(4, 'Churro Relleno de Chocolate', 'Churro Tradicional de azúcar relleno de chocolate.', 15.00, '2022-05-10', 'churrosChocolate.jpg', 6),
(5, 'Hot Cakes Lechera', 'Hot Cakes preparados con leche evaporada cubiertos con lechera, plátano, fresa y mora azul.', 55.00, '2022-05-10', 'hotcakesLechera.jpg', 7),
(6, 'Pastel de Chocolate', 'Rico Pastel Tradicional de Chocolate', 365.00, '2022-05-10', 'pastelChocolate.jpg', 8),
(7, 'Waffles Frutos Rojos', 'Crujientes waffles con salsa de frutos rojos acompañados de crema batida', 60.00, '2022-05-10', 'wafflesRojos.jpg', 9),
(8, 'Chispas de Chocolate', 'Galletas horneadas de Mantequilla con Chispas de Chocolate (12 pz.)', 50.00, '2022-05-10', 'galletasChispas.jpg', 10),
(9, 'Marquesita de Cajeta', 'Marquesita Tradicional de Cajeta', 35.00, '2022-05-10', 'marquesitaCajeta.jpg', 11),
(10, 'Frape de Oreo', 'Preparado con jarabe de chocolate, hielos, leche, galletas Oreo y crema Chantilly.', 45.00, '2022-05-10', 'frapeOreo.jpg', 12),
(11, 'Dona de Fresa', 'Dona Tradicional de Fresa con chispas de colores encima', 35.00, '2022-05-11', 'donaFresa.jpg', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(20) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `rol`, `imagen`) VALUES
(4, 'Admin', 'Admin', 'admin@admin.com', '$2y$04$Eni5dX6bjbCtWehx.8FdduNbDeB09u46GZ/UH2adLCMXuTrrFdrUS', 'admin', 'hombre.png'),
(6, 'Ivan', 'Hernandez', 'ivan@mail.com', '$2y$04$2qyfRzMZjb96vW0lH5s9t.lLjQjftDD3krFmwJj2846TaKE/42Bhq', 'user', NULL),
(11, 'Orlando', 'Maqueda', 'orlando@mail.com', '$2y$04$MeHChzU58kEj55NSBL2/beg8EpWFX/oc0zUs00vW.AQPp4nzVILxS', 'user', NULL),
(17, 'Antonia', 'Maqueda', 'antonia@mail.com', '$2y$04$sRuAjacoOtCXRtP3ZZ.RfuxNXBqBccNfvMhpm84hOG6O7POEGcDl2', 'user', 'mujer.png'),
(21, 'Emmanuel', 'Hernandez', 'emma@mail.com', '$2y$04$RgdVF.IZWI03si1LgO0.fOW1JrLgXi6smHAm7VKyzKXDqED1rmLme', 'admin', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_facturas_pedido` (`pedido_id`),
  ADD KEY `fk_facturas_producto` (`producto_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pedido_usuario` (`usuario_id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producto_categoria` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
