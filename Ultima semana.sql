-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-02-2018 a las 18:23:07
-- Versión del servidor: 5.6.25
-- Versión de PHP: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `n`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE IF NOT EXISTS `articulo` (
  `id` int(11) NOT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio_venta` decimal(10,2) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `tiempoespera` int(11) DEFAULT NULL,
  `costoorden` int(11) DEFAULT NULL,
  `costoinventario` int(11) DEFAULT NULL,
  `puntonuevopedido` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`id`, `id_empresa`, `nombre`, `descripcion`, `cantidad`, `precio_venta`, `id_categoria`, `tiempoespera`, `costoorden`, `costoinventario`, `puntonuevopedido`) VALUES
(1, 1, 'as', 'asa', 12, '123.00', NULL, NULL, NULL, NULL, NULL),
(2, 2, 'Leche', 'sadsad', 56, '32.00', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL,
  `id_tipocategoria` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `text` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `id_tipocategoria`, `text`, `descripcion`, `id_empresa`) VALUES
(1, '#', 'Categorias', NULL, 0),
(2, '1', 'yo', NULL, 1),
(4, '2', 'asdasf', 'asdsad', 1),
(5, '4', 'asdsad', 'asdsad', 1),
(6, '4', 'asdsad', 'asdsad', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante`
--

CREATE TABLE IF NOT EXISTS `comprobante` (
  `id` int(11) NOT NULL,
  `serie` int(100) DEFAULT NULL,
  `glosa` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_tipocomprobante` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `tipocambio` decimal(10,2) DEFAULT NULL,
  `id_moneda` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `id_periodo` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comprobante`
--

INSERT INTO `comprobante` (`id`, `serie`, `glosa`, `id_tipocomprobante`, `fecha`, `tipocambio`, `id_moneda`, `id_estado`, `id_empresa`, `id_periodo`) VALUES
(1, 1, 'Depsreciacion', 6, '2018-01-01', '6.96', 1, 4, 1, 14),
(2, 2, 'you', 6, '2018-02-05', '6.96', 1, 4, 1, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concepto`
--

CREATE TABLE IF NOT EXISTS `concepto` (
  `id` int(11) NOT NULL,
  `prefijo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `correlativo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `abreviatura` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `concepto`
--

INSERT INTO `concepto` (`id`, `prefijo`, `correlativo`, `descripcion`, `abreviatura`) VALUES
(1, NULL, NULL, 'BOLIVIANOS', 'BS'),
(2, NULL, NULL, 'DOLARES', '$'),
(3, NULL, NULL, 'ANULADO', 'BT'),
(4, NULL, NULL, 'ABIERTO', NULL),
(5, NULL, NULL, 'CERRADO', NULL),
(6, NULL, NULL, 'Ingreso', NULL),
(7, NULL, NULL, 'Egreso', NULL),
(8, NULL, NULL, 'Traspaso', NULL),
(9, NULL, NULL, 'Apertura', NULL),
(10, NULL, NULL, 'Ajuste', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE IF NOT EXISTS `cuenta` (
  `id` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_tipocuenta` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigo` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `text` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nivel` int(3) DEFAULT NULL,
  `correlativo` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`id`, `id_empresa`, `id_tipocuenta`, `codigo`, `text`, `nivel`, `correlativo`) VALUES
(1, 0, '#', NULL, 'Cuentas Contables', NULL, NULL),
(2, 1, '1', '1.0.0', 'Activo', 1, 1),
(3, 1, '1', '2.0.0', 'Pasivo', 1, 2),
(4, 1, '1', '3.0.0', 'Patrimonio', 1, 3),
(5, 1, '1', '4.0.0', 'Ingresos', 1, 4),
(6, 1, '1', '5.0.0', 'Egresos', 1, 5),
(7, 1, '2', '1.1.0', 'Activo Corriente', 2, 1),
(8, 1, '2', '1.2.0', 'Activo No Corriente', 2, 2),
(9, 1, '3', '2.1.0', 'Pasivo Corriente', 2, 1),
(10, 1, '3', '2.2.0', 'Pasivo No Corriente', 2, 2),
(11, 1, '4', '3.1.0', 'Patrimonio', 2, 1),
(12, 1, '5', '4.1.0', 'Ingresos', 2, 1),
(13, 1, '6', '5.1.0', 'Costos', 2, 1),
(14, 1, '6', '5.2.0', 'Gastos', 2, 2),
(15, 1, '7', '1.1.1', 'Caja Chica', 3, 1),
(16, 1, '7', '1.1.2', 'Caja M/N', 3, 2),
(17, 1, '8', '1.2.1', 'Edificio', 3, 1),
(18, 1, '8', '1.2.2', 'Vehiculo', 3, 2),
(19, 1, '8', '1.2.3', 'Mobiliario', 3, 3),
(20, 1, '9', '2.1.1', 'Cuentas por Pagar', 3, 1),
(21, 1, '9', '2.1.2', 'Intereses por Pagar', 3, 2),
(22, 1, '9', '2.1.3', 'Alquileres por Pagar', 3, 3),
(23, 1, '10', '2.2.1', 'Hipoteca por pagar', 3, 1),
(24, 1, '11', '3.1.1', 'Capital', 3, 1),
(25, 1, '11', '3.1.2', 'Ajuste global al patrimonio', 3, 2),
(26, 1, '12', '4.1.1', 'Ventas', 3, 1),
(27, 1, '12', '4.1.2', 'Recargo sobre ventas', 3, 2),
(28, 1, '12', '4.1.3', 'Intereses ganados', 3, 3),
(29, 1, '13', '5.1.1', 'Inventario Inicial', 3, 1),
(30, 1, '13', '5.1.2', 'Compras', 3, 2),
(31, 1, '14', '5.2.1', 'intereses pagados', 3, 1),
(32, 1, '14', '5.2.2', 'Alquileres pagados', 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_comprobante`
--

CREATE TABLE IF NOT EXISTS `detalle_comprobante` (
  `id` int(11) NOT NULL,
  `numero` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `glosa` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `debe` decimal(10,2) DEFAULT '0.00',
  `haber` decimal(10,2) DEFAULT '0.00',
  `debe_dol` decimal(10,2) DEFAULT '0.00',
  `haber_dol` decimal(10,2) DEFAULT '0.00',
  `id_cuenta` int(100) DEFAULT NULL,
  `id_comprobante` int(10) DEFAULT NULL,
  `monto_bol` decimal(10,2) DEFAULT NULL,
  `monto_dol` decimal(10,2) DEFAULT NULL,
  `id_periodo` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_comprobante`
--

INSERT INTO `detalle_comprobante` (`id`, `numero`, `glosa`, `debe`, `haber`, `debe_dol`, `haber_dol`, `id_cuenta`, `id_comprobante`, `monto_bol`, `monto_dol`, `id_periodo`) VALUES
(1, NULL, 'Depsreciacion', '12.00', '0.00', '0.00', '0.00', 17, 1, NULL, NULL, 14),
(2, NULL, 'Depsreciacion', '0.00', '12.00', '0.00', '0.00', 20, 1, NULL, NULL, 14),
(3, NULL, 'Depsreciacion', '0.00', '53.00', '0.00', '0.00', 18, 1, NULL, NULL, 14),
(4, NULL, 'Depsreciacion', '14.00', '0.00', '0.00', '0.00', 15, 1, NULL, NULL, 14),
(5, NULL, 'Depsreciacion', '29.00', '0.00', '0.00', '0.00', 30, 1, NULL, NULL, 14),
(6, NULL, 'Depsreciacion', '10.00', '0.00', '0.00', '0.00', 22, 1, NULL, NULL, 14),
(7, NULL, 'you', '6.00', '0.00', '0.00', '0.00', 20, 2, NULL, NULL, 15),
(8, NULL, 'you', '0.00', '6.00', '0.00', '0.00', 22, 2, NULL, NULL, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_nota`
--

CREATE TABLE IF NOT EXISTS `detalle_nota` (
  `id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `id_nota` int(11) DEFAULT NULL,
  `id_articulo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE IF NOT EXISTS `empresa` (
  `id` int(11) NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nit` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `razon_social` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sigla` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nivel` int(2) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `correo`, `nit`, `razon_social`, `sigla`, `direccion`, `nivel`, `id_usuario`) VALUES
(1, 'livees@livees.com', '56323478', 'Livees', 'LIV', 'calle Roca #92', 3, 1),
(2, 'bon@bon.com', '57324578', 'B-On2', 'BON2', 'calle Renega #2', 3, 1),
(5, 'no@no.com', '213213', 'asd', 'asd', 'asdsad', 2, 1),
(6, 'prueba@prueba.com', '8767868', 'TERCER PARCIAL2', 'TERCER2', 'sadasd', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion`
--

CREATE TABLE IF NOT EXISTS `gestion` (
  `id` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `gestion`
--

INSERT INTO `gestion` (`id`, `id_empresa`, `nombre`, `fecha_inicio`, `fecha_fin`, `estado`) VALUES
(1, 1, 'Gestion 2018', '2018-01-01', '2018-12-31', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE IF NOT EXISTS `lote` (
  `id` int(11) NOT NULL,
  `id_articulo` int(11) DEFAULT NULL,
  `nro_lote` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fecha_ing` date DEFAULT NULL,
  `fecha_ven` date DEFAULT NULL,
  `precio_compra` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`id`, `id_articulo`, `nro_lote`, `cantidad`, `fecha_ing`, `fecha_ven`, `precio_compra`) VALUES
(1, 1, 1, 20, '2017-11-09', '2017-11-22', '25.00'),
(2, 2, 1, 745, '2017-11-07', '2017-11-23', '45.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mayor`
--

CREATE TABLE IF NOT EXISTS `mayor` (
  `id` int(11) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `id_d` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `mayor`
--

INSERT INTO `mayor` (`id`, `total`, `id_d`) VALUES
(1, '-14', 4),
(2, '-12', 1),
(3, '53', 3),
(4, '12', 2),
(5, '6', 7),
(6, '-10', 6),
(7, '-4', 8),
(8, '-29', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nota`
--

CREATE TABLE IF NOT EXISTS `nota` (
  `id` int(11) NOT NULL,
  `nro_nota` int(11) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `id_comprobante` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE IF NOT EXISTS `periodo` (
  `id` int(11) NOT NULL,
  `id_gestion` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '1',
  `id_empresa` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`id`, `id_gestion`, `nombre`, `fecha_inicio`, `fecha_fin`, `estado`, `id_empresa`) VALUES
(14, 1, 'Enero', '2018-01-01', '2018-01-31', 1, 1),
(15, 1, 'Febrero', '2018-02-01', '2018-02-28', 1, 1),
(16, 1, 'Marzo', '2018-03-01', '2018-03-31', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cambio`
--

CREATE TABLE IF NOT EXISTS `tipo_cambio` (
  `id` int(11) NOT NULL,
  `cambio` decimal(10,2) DEFAULT NULL,
  `activo` int(100) DEFAULT '0',
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_cambio`
--

INSERT INTO `tipo_cambio` (`id`, `cambio`, `activo`, `fecha`) VALUES
(1, '6.96', 1, '2017-10-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contra` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `logo` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'images/user.jpg',
  `ci` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `visita` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `correo`, `contra`, `nombre`, `apellido`, `logo`, `ci`, `visita`) VALUES
(1, 'no@no.com', '123', 'Pepe', 'Botellas', 'images/user.jpg', '4566321lp', '2018-02-05 17:41:11'),
(2, 'yo@yo.com', '123', 'Jose', '12121', 'images/user.jpg', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `concepto`
--
ALTER TABLE `concepto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_comprobante`
--
ALTER TABLE `detalle_comprobante`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_nota`
--
ALTER TABLE `detalle_nota`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nit` (`nit`),
  ADD UNIQUE KEY `razon_social` (`razon_social`),
  ADD UNIQUE KEY `sigla` (`sigla`);

--
-- Indices de la tabla `gestion`
--
ALTER TABLE `gestion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mayor`
--
ALTER TABLE `mayor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_cambio`
--
ALTER TABLE `tipo_cambio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `comprobante`
--
ALTER TABLE `comprobante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `concepto`
--
ALTER TABLE `concepto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT de la tabla `detalle_comprobante`
--
ALTER TABLE `detalle_comprobante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `detalle_nota`
--
ALTER TABLE `detalle_nota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `gestion`
--
ALTER TABLE `gestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `mayor`
--
ALTER TABLE `mayor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `nota`
--
ALTER TABLE `nota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `tipo_cambio`
--
ALTER TABLE `tipo_cambio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
