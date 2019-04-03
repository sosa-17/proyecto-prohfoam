-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-03-2019 a las 07:32:11
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `basenueva123`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `name`) VALUES
(1, 'Mueble Dormitorio'),
(2, 'Mueble Oficina'),
(3, 'Mueble Sala');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datospersonales`
--

CREATE TABLE `datospersonales` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(60) NOT NULL,
  `direccion` varchar(60) NOT NULL,
  `usuarios_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `datospersonales`
--

INSERT INTO `datospersonales` (`id`, `email`, `direccion`, `usuarios_id`) VALUES
(16, 'samer@gmail.com', 'tgu, villa olimpica', 23),
(17, 'tito@gmail.com', 'tgu, Centro', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id_detalle` int(11) NOT NULL,
  `numero_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `costo` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id_detalle`, `numero_pedido`, `id_producto`, `cantidad`, `costo`) VALUES
(1, 2, 12, 1, 20),
(2, 2, 11, 1, 100),
(3, 2, 10, 1, 200),
(4, 3, 11, 1, 100),
(5, 3, 12, 1, 20),
(6, 3, 11, 1, 100),
(7, 3, 10, 1, 200),
(8, 4, 12, 1, 20),
(9, 4, 10, 1, 200),
(10, 4, 11, 1, 100),
(11, 5, 11, 1, 100),
(12, 5, 11, 1, 100),
(13, 5, 11, 1, 100),
(14, 6, 11, 1, 100),
(15, 6, 11, 1, 100),
(16, 6, 10, 1, 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `id_direccion` int(11) UNSIGNED NOT NULL,
  `Colonia` varchar(60) NOT NULL,
  `Ciudad` varchar(50) NOT NULL,
  `Bloque` varchar(25) NOT NULL,
  `Num_Casa` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`id_direccion`, `Colonia`, `Ciudad`, `Bloque`, `Num_Casa`) VALUES
(1, 'Trapiche', 'TGU', 'p', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `empresa_id` int(11) NOT NULL,
  `nombre` varchar(250) DEFAULT NULL,
  `RTN` int(11) DEFAULT NULL,
  `id_direccion` int(11) UNSIGNED NOT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`empresa_id`, `nombre`, `RTN`, `id_direccion`, `telefono`, `email`) VALUES
(1, 'PROH-FOAM', 8011995, 1, '+504 22758935', 'prohfoam@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `factura_id` int(11) NOT NULL,
  `numero_factura` int(11) DEFAULT NULL,
  `fecha_factura` datetime DEFAULT NULL,
  `usuarios_id` int(11) UNSIGNED NOT NULL,
  `id_empresa` varchar(45) DEFAULT NULL,
  `empresa_empresa_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_detalles`
--

CREATE TABLE `factura_detalles` (
  `factura_detalles_id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,0) DEFAULT NULL,
  `isv` decimal(10,0) DEFAULT NULL,
  `sub_total` decimal(10,0) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `productos_id` int(11) UNSIGNED NOT NULL,
  `factura_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_usuario`
--

CREATE TABLE `grupo_usuario` (
  `id` int(11) NOT NULL,
  `nombre_grupo` varchar(150) NOT NULL,
  `nivel_grupo` int(11) NOT NULL,
  `estado_grupo` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo_usuario`
--

INSERT INTO `grupo_usuario` (`id`, `nombre_grupo`, `nivel_grupo`, `estado_grupo`) VALUES
(1, 'Admin', 1, 1),
(12, 'Vendedor', 2, 1),
(13, 'Clientes', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_type`) VALUES
(1, '	\r\n6.jpg', 'image/jpeg'),
(2, '12.jpg', 'image/jpeg'),
(3, '18.jpg', 'image/jpeg'),
(4, '7.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `condiciones` varchar(255) NOT NULL,
  `comentarios` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `numero`, `fecha`, `id_usuario`, `condiciones`, `comentarios`) VALUES
(1, 1, '2019-03-30 07:12:20', 0, 'Contado', 'descuento'),
(2, 2, '2019-03-30 07:17:29', 23, 'Contado', 'descuento'),
(3, 3, '2019-03-30 07:18:24', 23, 'Contado', 'descuento'),
(4, 4, '2019-03-30 07:22:49', 23, 'Contado', ''),
(5, 5, '2019-03-30 07:23:57', 23, 'EFECTIVO', 'descuento'),
(6, 6, '2019-03-30 07:24:44', 23, 'Contado', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `id` int(11) NOT NULL,
  `nombre_comercial` varchar(255) NOT NULL,
  `propietario` varchar(255) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `email` varchar(64) NOT NULL,
  `iva` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`id`, `nombre_comercial`, `propietario`, `telefono`, `direccion`, `email`, `iva`) VALUES
(1, 'Sistema Web S.A. de C.V.', 'Obed Alvarado', '7058-7688', 'San Miguel, El Salvador', 'info@obedalvarado.pw', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `cantidad` varchar(50) DEFAULT NULL,
  `precio_compra` decimal(25,2) DEFAULT NULL,
  `precio_venta` decimal(25,2) NOT NULL,
  `categoria_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT '0',
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `name`, `cantidad`, `precio_compra`, `precio_venta`, `categoria_id`, `media_id`, `date`) VALUES
(10, 'Cama', '4', '147.00', '200.00', 1, 2, '2019-03-17 07:10:54'),
(11, 'Silla', '47', '78.00', '100.00', 2, 4, '2019-03-17 07:11:26'),
(12, 'Colchon', '4', '17.00', '20.00', 3, 1, '2019-03-17 07:12:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp`
--

CREATE TABLE `tmp` (
  `id_tmp` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_tmp` int(11) NOT NULL,
  `precio_tmp` double(8,2) DEFAULT NULL,
  `session_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nivel_usuario` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `estado` int(1) NOT NULL,
  `ultimo_acceso` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `name`, `nombre_usuario`, `password`, `nivel_usuario`, `image`, `estado`, `ultimo_acceso`) VALUES
(1, 'admin', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'no_image.jpg', 1, '2019-03-17 07:13:06'),
(23, 'Samer', 'Samer', 'd530ef8ba7401d025c6e5b5d791fb1ed03ad7de9', 2, 'no_image.jpg', 1, NULL),
(24, 'Tito', 'tito', '1a96f9437697ef43237868412d77b15991964f6e', 3, 'no_image.jpg', 1, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `datospersonales`
--
ALTER TABLE `datospersonales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `usuarios_id` (`usuarios_id`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `numero_cotizacion` (`numero_pedido`,`id_producto`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`id_direccion`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`empresa_id`,`id_direccion`),
  ADD KEY `fk_empresa_direccion1_idx` (`id_direccion`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`factura_id`),
  ADD KEY `fk_factura_usuarios1_idx` (`usuarios_id`),
  ADD KEY `fk_factura_empresa1_idx` (`empresa_empresa_id`);

--
-- Indices de la tabla `factura_detalles`
--
ALTER TABLE `factura_detalles`
  ADD PRIMARY KEY (`factura_detalles_id`),
  ADD KEY `fk_factura_detalles_productos1_idx` (`productos_id`),
  ADD KEY `fk_factura_detalles_detalle_idx` (`id_detalle`),
  ADD KEY `fk_factura_detalles_factura1_idx` (`factura_id`);

--
-- Indices de la tabla `grupo_usuario`
--
ALTER TABLE `grupo_usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nivel_grupo` (`nivel_grupo`);

--
-- Indices de la tabla `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD UNIQUE KEY `numero_cotizacion` (`numero`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_usuario` (`nombre_usuario`),
  ADD KEY `nivel_usuario` (`nivel_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `datospersonales`
--
ALTER TABLE `datospersonales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `id_direccion` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `empresa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `factura_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura_detalles`
--
ALTER TABLE `factura_detalles`
  MODIFY `factura_detalles_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
