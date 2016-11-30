-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2015 a las 13:31:38
-- Versión del servidor: 5.5.39
-- Versión de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ec_aceite`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_analisis`
--

CREATE TABLE IF NOT EXISTS `tbl_analisis` (
`idAnalisis` int(11) NOT NULL,
  `Nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `Producto` varchar(35) COLLATE latin1_spanish_ci NOT NULL,
  `FechaAnalisis` date NOT NULL,
  `FechaMuestra` date NOT NULL,
  `idMotor` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `HorometroMaquina` int(11) NOT NULL,
  `HorometroProducto` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tbl_analisis`
--

INSERT INTO `tbl_analisis` (`idAnalisis`, `Nombre`, `Producto`, `FechaAnalisis`, `FechaMuestra`, `idMotor`, `idProveedor`, `HorometroMaquina`, `HorometroProducto`) VALUES
(1, 'V-10-000876', ' EURODIESEL E-4 15W40 CI-4 PLUS', '2010-03-12', '2010-02-09', 1, 1, 6561, 353),
(2, 'V-10-002519', 'EURODIESEL E-4 15W40 CI-4 PLUS', '2010-08-22', '2010-04-21', 1, 1, 6891, 300),
(3, 'V-10-005125', 'EURODIESEL E-4 15W40 CI-4 PLUS', '2011-01-06', '2010-09-22', 1, 1, 7467, 280);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_central`
--

CREATE TABLE IF NOT EXISTS `tbl_central` (
`idCentral` int(10) unsigned NOT NULL,
  `Descripcion` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `Ubicacion` varchar(20) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbl_central`
--

INSERT INTO `tbl_central` (`idCentral`, `Descripcion`, `Ubicacion`) VALUES
(1, 'Zofri', 'Iquique'),
(2, 'Estandartes', 'Iquique'),
(3, 'Esperanza', 'Rancagua'),
(4, 'Mantos Blancos', 'Antofagasta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_item`
--

CREATE TABLE IF NOT EXISTS `tbl_item` (
`idItem` int(10) unsigned NOT NULL,
  `Descripcion` varchar(35) COLLATE latin1_spanish_ci NOT NULL,
  `Unidad` varchar(15) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `tbl_item`
--

INSERT INTO `tbl_item` (`idItem`, `Descripcion`, `Unidad`) VALUES
(1, 'Viscosidad @ 100°C (cSt)', NULL),
(2, 'TBN mg KOH/gramo', NULL),
(3, 'Contaminación x Agua %', NULL),
(4, 'Aluminio (Al)', NULL),
(5, 'Cromo (Cr)', NULL),
(6, 'Cobre (Cu)', NULL),
(7, 'Plomo (Pb)', NULL),
(8, 'Silice (Si)', NULL),
(9, 'Estaño (Sn)', NULL),
(10, 'Molibdeno (Mb)', 'ppm'),
(11, 'Sodio (Na)', NULL),
(12, 'Calcio (Ca)', 'ppm'),
(13, 'Fósforo (P)', NULL),
(14, 'Hollín % (peso)', NULL),
(15, 'Magnesio (Mg)', NULL),
(16, 'Hierro (Fe)', NULL),
(17, 'Zinc (Zn)', NULL),
(18, 'Sulfatación', 'Abs/cm'),
(19, 'Oxidación', 'Abs/cm'),
(20, 'Índice PQ', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_itemsanalisis`
--

CREATE TABLE IF NOT EXISTS `tbl_itemsanalisis` (
  `idAnalisis` int(11) NOT NULL,
  `idItem` int(11) NOT NULL,
  `Valor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_itemsanalisis`
--

INSERT INTO `tbl_itemsanalisis` (`idAnalisis`, `idItem`, `Valor`) VALUES
(1, 1, 16.16),
(1, 3, 0),
(1, 4, 1),
(1, 5, 4),
(1, 6, 3),
(1, 7, 4),
(1, 8, 5),
(1, 9, 1),
(1, 11, 1),
(1, 14, 0.8),
(1, 15, 10),
(1, 16, 17),
(1, 17, 1029),
(2, 1, 17.52),
(2, 3, 0),
(2, 4, 2),
(2, 5, 2),
(2, 6, 6),
(2, 7, 12),
(2, 8, 4),
(2, 9, 1),
(2, 11, 1),
(2, 14, 0.7),
(2, 15, 10),
(2, 16, 18),
(2, 17, 1235),
(3, 1, 15.24),
(3, 3, 0),
(3, 4, 1),
(3, 5, 1),
(3, 6, 4),
(3, 7, 6),
(3, 8, 7),
(3, 9, 1),
(3, 11, 1),
(3, 14, 0.5),
(3, 15, 38),
(3, 16, 17),
(3, 17, 1261);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_motor`
--

CREATE TABLE IF NOT EXISTS `tbl_motor` (
`idMotor` int(11) NOT NULL,
  `Codigo` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `idCentral` int(11) NOT NULL,
  `Marca` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `Modelo` varchar(30) COLLATE latin1_spanish_ci NOT NULL,
  `NSerie` varchar(30) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `tbl_motor`
--

INSERT INTO `tbl_motor` (`idMotor`, `Codigo`, `idCentral`, `Marca`, `Modelo`, `NSerie`) VALUES
(1, 'G01', 1, 'Cummings', 'KTA 19', ''),
(2, 'G02', 1, 'Cummings', '', ''),
(3, 'G03', 1, 'Cummings', '', ''),
(4, 'G04', 1, 'Cummings', '', ''),
(5, 'G05', 1, 'Cummings', '', ''),
(6, 'G06', 1, 'Cummings', '', ''),
(7, 'G07', 2, 'Caterpillar', '', ''),
(8, 'G08', 2, 'Caterpillar', '', ''),
(9, 'G09', 2, 'Caterpillar', '', ''),
(10, 'G10', 2, 'Caterpillar', '', ''),
(11, 'G11', 2, 'Caterpillar', '', ''),
(12, 'G12', 2, 'Caterpillar', '', ''),
(13, 'G13', 2, 'Caterpillar', '', ''),
(14, 'DS1', 3, 'Caterpillar', '', ''),
(15, 'DS1', 3, 'Caterpillar', '', ''),
(16, 'TG1', 3, 'Hitachi', '', ''),
(17, '101', 4, 'Mirrlees Blackstone', '', ''),
(18, '102', 4, 'Mirrlees Blackstone', '', ''),
(19, '103', 4, 'Mirrlees Blackstone', '', ''),
(20, '104', 4, 'Mirrlees Blackstone', '', ''),
(21, '105', 4, 'Mirrlees Blackstone', '', ''),
(22, '106', 4, 'Mirrlees Blackstone', '', ''),
(23, '107', 4, 'Mirrlees Blackstone', '', ''),
(24, '108', 4, 'Mirrlees Blackstone', '', ''),
(25, '109', 4, 'Mirrlees Blackstone', '', ''),
(26, '110', 4, 'Mirrlees Blackstone', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_proveedor`
--

CREATE TABLE IF NOT EXISTS `tbl_proveedor` (
`idProveedor` int(11) NOT NULL,
  `Nombre` varchar(20) COLLATE latin1_spanish_ci NOT NULL,
  `Descripcion` varchar(20) COLLATE latin1_spanish_ci DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbl_proveedor`
--

INSERT INTO `tbl_proveedor` (`idProveedor`, `Nombre`, `Descripcion`) VALUES
(1, 'Luval', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_analisis`
--
ALTER TABLE `tbl_analisis`
 ADD PRIMARY KEY (`idAnalisis`);

--
-- Indices de la tabla `tbl_central`
--
ALTER TABLE `tbl_central`
 ADD PRIMARY KEY (`idCentral`);

--
-- Indices de la tabla `tbl_item`
--
ALTER TABLE `tbl_item`
 ADD PRIMARY KEY (`idItem`);

--
-- Indices de la tabla `tbl_itemsanalisis`
--
ALTER TABLE `tbl_itemsanalisis`
 ADD PRIMARY KEY (`idAnalisis`,`idItem`);

--
-- Indices de la tabla `tbl_motor`
--
ALTER TABLE `tbl_motor`
 ADD PRIMARY KEY (`idMotor`);

--
-- Indices de la tabla `tbl_proveedor`
--
ALTER TABLE `tbl_proveedor`
 ADD PRIMARY KEY (`idProveedor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_analisis`
--
ALTER TABLE `tbl_analisis`
MODIFY `idAnalisis` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tbl_central`
--
ALTER TABLE `tbl_central`
MODIFY `idCentral` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tbl_item`
--
ALTER TABLE `tbl_item`
MODIFY `idItem` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de la tabla `tbl_motor`
--
ALTER TABLE `tbl_motor`
MODIFY `idMotor` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `tbl_proveedor`
--
ALTER TABLE `tbl_proveedor`
MODIFY `idProveedor` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
