-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-01-2018 a las 02:10:45
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
  `id_tipocambio` int(11) DEFAULT NULL,
  `id_moneda` int(11) DEFAULT NULL,
  `id_estado` int(11) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `id_periodo` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `comprobante`
--

INSERT INTO `comprobante` (`id`, `serie`, `glosa`, `id_tipocomprobante`, `fecha`, `id_tipocambio`, `id_moneda`, `id_estado`, `id_empresa`, `id_periodo`) VALUES
(1, 1, 'POR DETERMINAR', 3, '2017-10-10', 1, 1, 4, 1, NULL),
(2, 2, 'otro', 6, '2017-10-09', 1, 2, 4, 1, NULL),
(3, 3, 'otro mas', 9, '2017-10-08', 1, 1, 5, 1, NULL),
(4, 1, 'fdgfdgfdg', 6, '1969-12-31', 1, 1, 3, 5, NULL),
(5, 2, 'fdgfdgfdg', 6, '2017-11-14', 1, 1, 3, 5, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`id`, `id_empresa`, `id_tipocuenta`, `codigo`, `text`, `nivel`, `correlativo`) VALUES
(1, 0, '#', NULL, 'Cuentas Contables', 0, NULL),
(19, 1, '1', '1.0.0', 'Derivados', 1, 1),
(23, 5, '1', '1.0.0', 'Activos Fijos', 1, 1),
(25, 6, '1', '1.0.0.0.0', 'Fijos', 1, 1),
(26, 6, '25', '1.1.0.0.0', 'ddfdf', 2, 1),
(27, 6, '26', '1.1.1.0.0', 'ewrewr', 3, 1),
(28, 6, '27', '1.1.1.1.0', 'fdgfdg', 4, 1),
(29, 6, '28', '1.1.1.1.1', 'fdgfdgfdg', 5, 1),
(32, 2, '1', '1.0.0', 'cuenta1', 1, 1),
(33, 2, '1', '2.0.0', 'cuenta2', 1, 2),
(34, 2, '1', '3.0.0', 'cuenta3', 1, 3),
(35, 2, '1', '4.0.0', 'cuenta4', 1, 4),
(36, 2, '1', '5.0.0', 'cuenta5', 1, 5),
(37, 2, '1', '6.0.0', 'cuenta6', 1, 6),
(38, 2, '1', '7.0.0', 'cuenta7', 1, 7),
(39, 2, '33', '2.1.0', 'dfdsf', 2, 1),
(62, 1, '19', '1.1.0', 'lacteo', 2, 1),
(63, 1, '62', '1.1.1', 'queso', 3, 1),
(64, 1, '19', '1.2.0', 'Embutido', 2, 2),
(65, 1, '1', '2.0.0', 'Carnes', 1, 2),
(66, 1, '64', '1.2.1', 'Jamon', 3, 1),
(67, 5, '23', '1.1', 'qsasa', 2, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_comprobante`
--

INSERT INTO `detalle_comprobante` (`id`, `numero`, `glosa`, `debe`, `haber`, `debe_dol`, `haber_dol`, `id_cuenta`, `id_comprobante`, `monto_bol`, `monto_dol`, `id_periodo`) VALUES
(1, '123', 'POR DETERMINAR', '0.00', '0.00', '0.00', '0.00', 22, 1, NULL, NULL, NULL),
(2, NULL, 'fedgfdg', '123.00', '0.00', '0.00', '0.00', 5, 4, NULL, NULL, NULL),
(3, NULL, 'dsfdsf', '45.00', '0.00', '0.00', '0.00', 20, 5, NULL, NULL, NULL),
(4, NULL, 'dsf', '456.00', '0.00', '0.00', '0.00', 35, 5, NULL, NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `correo`, `nit`, `razon_social`, `sigla`, `direccion`, `nivel`, `id_usuario`) VALUES
(1, 'livees@livees.com', '54345', 'Livees', 'LIV', 'calle Roca #92', 3, 1),
(2, 'bon@bon.com', '57324578', 'B-On2', 'BON2', 'calle Renega #2', 3, 1),
(7, 'prueba@prueba.com', '123123123123', 'Prueba', 'PRU', '', 3, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `gestion`
--

INSERT INTO `gestion` (`id`, `id_empresa`, `nombre`, `fecha_inicio`, `fecha_fin`, `estado`) VALUES
(1, 2, 'Gestion Mayo', '2017-09-05', '2017-09-13', 1),
(2, 1, 'zfdsad', '2017-11-30', '2017-12-05', 1),
(3, 2, 'weewe', '2017-09-07', '2017-09-08', 0),
(5, 6, 'Gestion 2016', '2016-01-01', '2016-12-31', 1),
(12, 1, 'juan', '2018-01-01', '2018-01-02', 0),
(13, 1, 'prueba', '2018-01-03', '2018-03-31', 1),
(14, 2, 'ert', '2018-01-03', '2018-01-12', 1),
(15, 5, 'ert', '2018-01-04', '2018-01-17', 1),
(16, 7, 'Gestion 2015', '2015-01-01', '2015-12-31', 1),
(17, 7, 'Gestion 2016', '2016-01-01', '2016-12-31', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `periodo`
--

INSERT INTO `periodo` (`id`, `id_gestion`, `nombre`, `fecha_inicio`, `fecha_fin`, `estado`, `id_empresa`) VALUES
(1, 1, 'Periodo', '2017-09-06', '2017-09-08', 1, NULL),
(2, 5, 'Enero', '2016-01-01', '2016-01-31', 1, NULL),
(3, 5, 'Febrero', '2016-02-01', '2016-02-29', 1, NULL),
(4, 5, 'Marzo', '2016-03-01', '2016-03-31', 1, 1),
(6, 11, 'yaaa', '2017-12-27', '2017-12-28', 1, NULL),
(7, 13, '1', '2018-01-03', '2018-01-04', 1, NULL),
(8, 13, '2', '2018-01-05', '2018-01-06', 1, NULL),
(9, 13, '2', '2018-01-07', '2018-01-08', 1, NULL),
(10, 14, '1', '2018-01-03', '2018-01-04', 1, 2),
(11, 14, '3', '2018-01-05', '2018-01-10', 1, 2),
(12, 15, 'yui', '2018-01-04', '2018-01-05', 1, 5),
(13, 16, 'ENERO', '2015-01-01', '2015-01-31', 1, 7),
(14, 16, 'FEBRERO', '2015-02-01', '2015-02-28', 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cambio`
--

CREATE TABLE IF NOT EXISTS `tipo_cambio` (
  `id` int(11) NOT NULL,
  `cambio` decimal(10,3) DEFAULT NULL,
  `activo` int(100) DEFAULT '0',
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_cambio`
--

INSERT INTO `tipo_cambio` (`id`, `cambio`, `activo`, `fecha`) VALUES
(1, '6.960', 1, '2017-10-09');

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
(1, 'no@no.com', '123', 'Pepe', 'Botellas', 'images/user.jpg', '4566321lp', '2018-01-23 19:44:42'),
(2, 'no@no.com', '12', '1212', '12121', 'images/user.jpg', NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `concepto`
--
ALTER TABLE `concepto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT de la tabla `detalle_comprobante`
--
ALTER TABLE `detalle_comprobante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `detalle_nota`
--
ALTER TABLE `detalle_nota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `gestion`
--
ALTER TABLE `gestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `nota`
--
ALTER TABLE `nota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
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
