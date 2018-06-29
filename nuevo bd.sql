CREATE TABLE `cuenta` (
  `id` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `id_tipocuenta` int(11) NOT NULL,
  `codigo` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `text` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nivel` int(3)  DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--
INSERT INTO `cuenta` (`id`, `id_empresa`, `id_tipocuenta`,`codigo`, `text`, `nivel`) VALUES
(3, 1, 0,'1.0.0', 'Activos', '3'),
(4, 1, NULL,'1.1.0', 'Propiedades', '4'),
(5, 1, 3,'1.4', 'Activo Fijo', '4'),
(6, 1, 3,'1.2', 'Activo Variable', '3'),
(7, 1, 5,'1.3', 'asa', NULL),
(9, 1, 4,'1.5', 'dasds', NULL),
(10, 1, 9,'1.6', 'Inmuebles', NULL);

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nit` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `razon_social` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sigla` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nivel` int(2) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`id`, `correo`, `nit`, `razon_social`, `sigla`, `direccion`, `nivel`, `id_usuario`) VALUES
(1, 'livees@livees.com', '56323478', 'Livees', 'LIV', 'calle Roca #92', 3, 1),
(2, 'bon@bon.com', '57324578', 'B-On', 'BON', 'calle Renega #2', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gestion`
--

CREATE TABLE `gestion` (
  `id` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------
INSERT INTO `gestion` (`id`, `id_empresa`, `nombre`, `fecha_inicio`, `fecha_fin`, `estado`) VALUES
(2, 4, 'Gestion 2013', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(9, 1, '45', '2017-09-11 00:00:00', '2017-09-13 00:00:00', 0),
(10, 2, 'sd', '2017-09-11 00:00:00', '2017-09-14 00:00:00', 1),
(11, 5, 'Gestion 2016', '2016-01-01 00:00:00', '2016-12-31 00:00:00', 0),
(12, 5, '2017', '2017-01-01 00:00:00', '2017-12-31 00:00:00', 1);
--
-- Estructura de tabla para la tabla `periodo`
--

CREATE TABLE `periodo` (
  `id` int(11) NOT NULL,
  `id_gestion` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `estado` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--
INSERT INTO `periodo` (`id`, `id_gestion`, `nombre`, `fecha_inicio`, `fecha_fin`, `estado`) VALUES
(2, 9, '1212', '2017-09-11 00:00:00', '2017-09-13 00:00:00', 1),
(4, 12, 'Febrero', '2017-02-01 00:00:00', '2017-02-28 00:00:00', 1),
(5, 12, 'Marzito', '2017-03-01 00:00:00', '2017-03-31 00:00:00', 1); 

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contra` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `logo` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'images/user.jpg',
  `ci` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `visita` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
CREATE TABLE `comprobante` (
  `id` int(11) NOT NULL,
  `serie` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `glosa` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tc` int DEFAULT NULL,
  `visita` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
CREATE TABLE IF NOT EXISTS `detalle_comprobante` (
  `id` int(11) NOT NULL,
  `numero` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `glosa` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `monto` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tipo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_cuenta` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'images/user.jpg',
  `id_comprobante` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
CREATE TABLE IF NOT EXISTS `tipo_cambio` (
  `id` int(11) NOT NULL,
  `cambio` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `moneda` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  
  `activo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` date DEFAULT NULL

) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;
CREATE TABLE IF NOT EXISTS `concepto` (
  `id` int(11) NOT NULL,
  `correo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `contra` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `logo` varchar(100) COLLATE utf8_spanish_ci NOT NULL DEFAULT 'images/user.jpg',
  `ci` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `visita` date DEFAULT NULL,
  `nivel` int(11) NOT NULL DEFAULT '3'
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `correo`, `contra`, `nombre`, `apellido`, `logo`, `ci`, `visita`) VALUES
(1, 'no@no.com', '123', 'Pepe', 'Botellas', 'images/user.jpg', '4566321lp', '2017-08-21 18:07:51'),
(2, 'no@no.com', '12', '1212', '12121', 'images/user.jpg', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
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
-- Indices de la tabla `periodo`
--
ALTER TABLE `periodo`
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
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `gestion`
--
ALTER TABLE `gestion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `periodo`
--
ALTER TABLE `periodo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
