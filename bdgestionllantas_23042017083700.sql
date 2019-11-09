-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-04-2017 a las 15:35:57
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bdgestionllanta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbbajallanta`
--

CREATE TABLE IF NOT EXISTS `tbbajallanta` (
  `codbajlla` int(11) NOT NULL AUTO_INCREMENT,
  `codperbajlla` int(11) DEFAULT NULL,
  `codibajlla` int(11) NOT NULL,
  `motbajlla` int(11) NOT NULL,
  `descbajlla` varchar(45) NOT NULL,
  `usucrbajlla` int(11) NOT NULL,
  `fcrbajlla` timestamp NULL DEFAULT NULL,
  `usumdbajlla` int(11) DEFAULT NULL,
  `fmdbajlla` datetime DEFAULT NULL,
  `estregbajlla` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`codbajlla`),
  KEY `codibajlla_idx` (`codibajlla`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcomprallanta`
--

CREATE TABLE IF NOT EXISTS `tbcomprallanta` (
  `codicmp` int(11) NOT NULL AUTO_INCREMENT,
  `codempcmp` int(11) NOT NULL,
  `codcmp` char(10) NOT NULL,
  `codcmpprv` int(11) NOT NULL,
  `codcbtcmp` int(11) NOT NULL,
  `nrodoccmp` varchar(20) NOT NULL,
  `fcmp` datetime DEFAULT NULL,
  `subtotacmp` decimal(8,2) NOT NULL,
  `igvcmp` decimal(8,2) NOT NULL,
  `totacmp` decimal(8,2) NOT NULL,
  `usucrcmp` int(11) NOT NULL,
  `fcrcmp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usumdcmp` int(11) NOT NULL,
  `fmdcmp` datetime NOT NULL,
  `estrgcmp` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`codicmp`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `tbcomprallanta`
--

INSERT INTO `tbcomprallanta` (`codicmp`, `codempcmp`, `codcmp`, `codcmpprv`, `codcbtcmp`, `nrodoccmp`, `fcmp`, `subtotacmp`, `igvcmp`, `totacmp`, `usucrcmp`, `fcrcmp`, `usumdcmp`, `fmdcmp`, `estrgcmp`) VALUES
(6, 1, '0000000001', 3, 24, '12_4356', '2016-12-11 00:00:00', '507.99', '111.51', '619.50', 1, '2016-12-11 20:37:22', 0, '0000-00-00 00:00:00', 'A'),
(7, 1, '0000000002', 3, 24, '', '2016-12-11 00:00:00', '767.52', '168.48', '936.00', 1, '2016-12-11 20:42:35', 0, '0000-00-00 00:00:00', 'A'),
(9, 1, '0000000003', 3, 24, '0001_124356', '2016-12-11 00:00:00', '882.40', '193.70', '1076.10', 1, '2016-12-11 20:48:34', 0, '0000-00-00 00:00:00', 'A'),
(12, 1, '0000000004', 3, 24, '12356', '2016-12-11 00:00:00', '1264.44', '277.56', '1542.00', 1, '2016-12-11 21:14:56', 0, '0000-00-00 00:00:00', 'A'),
(13, 1, '0000000005', 3, 24, '0001-26381245', '2016-12-17 00:00:00', '573.74', '125.94', '699.68', 1, '2016-12-17 01:48:07', 0, '0000-00-00 00:00:00', 'A'),
(14, 1, '0000000006', 3, 24, 'F11 1234567890', '2017-03-23 00:00:00', '256.82', '56.38', '313.20', 1, '2017-03-23 11:03:30', 0, '0000-00-00 00:00:00', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbcomprallantadetalle`
--

CREATE TABLE IF NOT EXISTS `tbcomprallantadetalle` (
  `codcplldt` int(11) NOT NULL AUTO_INCREMENT,
  `codiempcplldt` int(11) NOT NULL,
  `codicplldt` int(11) NOT NULL,
  `condicplldt` char(1) NOT NULL,
  `codimrkcplldt` int(11) NOT NULL,
  `codimodcplldt` int(11) NOT NULL,
  `codimedcplldt` int(11) NOT NULL,
  `ctdcplldt` int(11) NOT NULL,
  `pucplldt` decimal(18,2) NOT NULL,
  `impcplldt` decimal(18,2) NOT NULL,
  `estcplldt` char(1) NOT NULL DEFAULT 'A',
  `usucrcplldt` int(11) NOT NULL,
  `fcrcplldt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usumdcplldt` int(11) DEFAULT NULL,
  `fmdcplldt` datetime DEFAULT NULL,
  `estrgcplldt` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`codcplldt`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `tbcomprallantadetalle`
--

INSERT INTO `tbcomprallantadetalle` (`codcplldt`, `codiempcplldt`, `codicplldt`, `condicplldt`, `codimrkcplldt`, `codimodcplldt`, `codimedcplldt`, `ctdcplldt`, `pucplldt`, `impcplldt`, `estcplldt`, `usucrcplldt`, `fcrcplldt`, `usumdcplldt`, `fmdcplldt`, `estrgcplldt`) VALUES
(3, 1, 6, 'N', 13, 2, 3, 2, '124.50', '249.00', 'A', 1, '2016-12-11 20:37:22', NULL, NULL, 'A'),
(4, 1, 6, 'N', 13, 2, 3, 3, '123.50', '370.50', 'A', 1, '2016-12-11 20:37:22', NULL, NULL, 'A'),
(5, 1, 7, 'N', 13, 1, 1, 2, '234.00', '468.00', 'A', 1, '2016-12-11 20:42:35', NULL, NULL, 'A'),
(6, 1, 7, 'N', 13, 2, 3, 2, '234.00', '468.00', 'A', 1, '2016-12-11 20:42:35', NULL, NULL, 'A'),
(9, 1, 9, 'N', 13, 1, 1, 3, '123.50', '370.50', 'A', 1, '2016-12-11 20:48:34', NULL, NULL, 'A'),
(10, 1, 9, 'N', 13, 2, 3, 3, '235.20', '705.60', 'A', 1, '2016-12-11 20:48:34', NULL, NULL, 'A'),
(15, 1, 12, 'N', 13, 1, 2, 2, '123.00', '246.00', 'A', 1, '2016-12-11 21:14:56', NULL, NULL, 'A'),
(16, 1, 12, 'N', 13, 2, 3, 3, '432.00', '1296.00', 'A', 1, '2016-12-11 21:14:56', NULL, NULL, 'A'),
(17, 1, 13, 'N', 13, 1, 1, 2, '124.30', '248.60', 'A', 1, '2016-12-17 01:48:07', NULL, NULL, 'A'),
(18, 1, 13, 'R', 13, 2, 4, 3, '150.36', '451.08', 'A', 1, '2016-12-17 01:48:07', NULL, NULL, 'A'),
(19, 1, 14, 'N', 13, 1, 1, 2, '156.60', '313.20', 'A', 1, '2017-03-23 11:03:30', NULL, NULL, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbempresa`
--

CREATE TABLE IF NOT EXISTS `tbempresa` (
  `codemp` int(11) NOT NULL AUTO_INCREMENT,
  `nomemp` varchar(80) NOT NULL,
  `rucemp` varchar(15) DEFAULT NULL,
  `logoemp` varchar(80) DEFAULT NULL,
  `usucremp` int(11) DEFAULT NULL,
  `fcremp` datetime DEFAULT NULL,
  `usumdemp` int(11) DEFAULT NULL,
  `fmdemp` datetime DEFAULT NULL,
  `estrgemp` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`codemp`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbempresa`
--

INSERT INTO `tbempresa` (`codemp`, `nomemp`, `rucemp`, `logoemp`, `usucremp`, `fcremp`, `usumdemp`, `fmdemp`, `estrgemp`) VALUES
(1, 'Van llantas', NULL, NULL, 1, NULL, NULL, NULL, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbflota`
--

CREATE TABLE IF NOT EXISTS `tbflota` (
  `codflt` int(11) NOT NULL AUTO_INCREMENT,
  `codempflt` int(11) DEFAULT NULL,
  `plaflt` varchar(15) CHARACTER SET utf8 NOT NULL,
  `cdintflt` varchar(6) CHARACTER SET utf8 NOT NULL,
  `tipflt` smallint(1) NOT NULL,
  `marflt` int(11) NOT NULL,
  `modflt` int(11) NOT NULL,
  `cfgflt` varchar(6) CHARACTER SET utf8 NOT NULL,
  `kmflt` decimal(10,2) NOT NULL,
  `mtrflt` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `serflt` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `aniflt` year(4) DEFAULT NULL,
  `ubiflt` int(11) DEFAULT NULL,
  `codchflt` int(11) DEFAULT NULL COMMENT 'Chofer Flota',
  `imgflt` varchar(60) DEFAULT NULL COMMENT 'Floto vehiculo',
  `chasflt` varchar(30) DEFAULT NULL COMMENT 'Chasis',
  `psoflt` int(11) DEFAULT NULL COMMENT 'Pisos',
  `dnogcmflt` int(11) DEFAULT NULL COMMENT 'Dueño Grupo Comercial flota',
  `estflt` int(11) NOT NULL,
  `estrgflt` char(1) NOT NULL DEFAULT 'A',
  `usucrflt` int(11) NOT NULL,
  `fcrflt` timestamp NULL DEFAULT NULL,
  `usumdflt` int(11) DEFAULT NULL,
  `fmdflt` datetime DEFAULT NULL,
  PRIMARY KEY (`codflt`),
  UNIQUE KEY `codflt` (`codflt`),
  KEY `marflt_idx` (`marflt`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tbflota`
--

INSERT INTO `tbflota` (`codflt`, `codempflt`, `plaflt`, `cdintflt`, `tipflt`, `marflt`, `modflt`, `cfgflt`, `kmflt`, `mtrflt`, `serflt`, `aniflt`, `ubiflt`, `codchflt`, `imgflt`, `chasflt`, `psoflt`, `dnogcmflt`, `estflt`, `estrgflt`, `usucrflt`, `fcrflt`, `usumdflt`, `fmdflt`) VALUES
(1, 1, 'dfk-lu', '', 12, 1, 1, '2x4', '1000.00', '', '', 0000, NULL, NULL, NULL, NULL, NULL, NULL, 37, 'A', 1, NULL, NULL, NULL),
(2, 1, 'PL-234', '201', 16, 1, 1, '2x3', '2100.00', '1245SD', '1245SDSF', 2010, NULL, NULL, NULL, NULL, NULL, NULL, 37, 'A', 1, NULL, NULL, NULL),
(3, 1, '1245DFDF', '200', 16, 4, 4, '2x4', '0.00', '233EFFGGRTR', 'DFDFDFDFDFDF', 2009, NULL, NULL, NULL, NULL, NULL, NULL, 37, 'A', 1, NULL, NULL, NULL),
(4, 1, 'UC 1236', '201', 16, 1, 6, '2x3', '100.00', 'GHCVB2345671', 'FGR987654321', 2008, NULL, NULL, NULL, NULL, NULL, NULL, 37, 'A', 1, NULL, NULL, NULL),
(5, 1, 'C8V-955', '1020', 14, 1, 7, '6x2', '20.00', 'FDFDFDF', 'DFDFDF', 2012, NULL, NULL, NULL, NULL, NULL, NULL, 37, 'A', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbflotadetalle`
--

CREATE TABLE IF NOT EXISTS `tbflotadetalle` (
  `codfltd` int(11) NOT NULL AUTO_INCREMENT,
  `codperfltd` int(11) DEFAULT NULL,
  `codiflt` int(11) NOT NULL,
  `codillan` int(11) NOT NULL,
  `poslland` int(11) NOT NULL,
  `flglland` char(1) DEFAULT 'P' COMMENT 'P Principal, R Repuestos',
  `fmonlland` datetime DEFAULT NULL,
  `motmonlland` int(11) DEFAULT NULL,
  `fdsmonlland` datetime DEFAULT NULL,
  `motdsmonlland` int(11) DEFAULT NULL,
  `kmlland` decimal(8,2) NOT NULL,
  `prsnlland` decimal(18,2) DEFAULT NULL,
  `remallan` decimal(6,2) NOT NULL,
  `obslland` varchar(80) DEFAULT NULL,
  `fcrdfltd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usucrfltd` int(11) DEFAULT NULL,
  `fmdfltd` datetime DEFAULT NULL,
  `usumdfltd` varchar(45) DEFAULT NULL,
  `estrgfltd` char(1) DEFAULT 'A',
  PRIMARY KEY (`codfltd`),
  KEY `codiflt_idx` (`codiflt`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tbflotadetalle`
--

INSERT INTO `tbflotadetalle` (`codfltd`, `codperfltd`, `codiflt`, `codillan`, `poslland`, `flglland`, `fmonlland`, `motmonlland`, `fdsmonlland`, `motdsmonlland`, `kmlland`, `prsnlland`, `remallan`, `obslland`, `fcrdfltd`, `usucrfltd`, `fmdfltd`, `usumdfltd`, `estrgfltd`) VALUES
(1, 1, 1, 1, 1, 'P', '2017-04-16 23:32:05', NULL, NULL, NULL, '231.00', '124.00', '0.00', NULL, '2017-04-17 04:35:45', 1, NULL, NULL, 'A'),
(2, 1, 1, 2, 2, 'P', '2017-04-16 23:32:05', NULL, NULL, NULL, '231.00', '124.00', '0.00', NULL, '2017-04-17 04:36:50', 1, NULL, NULL, 'A'),
(3, 1, 1, 8, 3, 'P', '2017-04-16 23:32:05', NULL, NULL, NULL, '54321.00', '123.00', '0.00', NULL, '2017-04-17 04:39:42', 1, NULL, NULL, 'A'),
(4, 1, 1, 9, 4, 'P', '2017-04-16 23:32:05', NULL, '2017-04-16 23:32:05', 44, '1235.00', '4321.00', '0.00', NULL, '2017-04-17 04:40:32', 1, '2017-04-16 23:46:33', '1', 'I'),
(5, 1, 1, 7, 4, 'P', '2017-04-18 21:21:31', NULL, NULL, NULL, '2341.00', '231.00', '0.00', NULL, '2017-04-19 02:22:05', 1, NULL, NULL, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbflotadisenio`
--

CREATE TABLE IF NOT EXISTS `tbflotadisenio` (
  `coddsn` int(11) NOT NULL AUTO_INCREMENT,
  `nomdsn` varchar(120) NOT NULL,
  `adjdsn` varchar(120) NOT NULL,
  `nroejedsn` int(11) NOT NULL,
  `nrolladsn` int(11) NOT NULL,
  `nrorpsts` int(11) DEFAULT '0',
  `usucrdsn` int(11) NOT NULL,
  `fcrdsn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usumddsn` int(11) DEFAULT NULL,
  `fmddsn` datetime DEFAULT NULL,
  `estrgdsn` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`coddsn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tbflotadisenio`
--

INSERT INTO `tbflotadisenio` (`coddsn`, `nomdsn`, `adjdsn`, `nroejedsn`, `nrolladsn`, `nrorpsts`, `usucrdsn`, `fcrdsn`, `usumddsn`, `fmddsn`, `estrgdsn`) VALUES
(1, '2 Ejes, 4 llantas ', 'auto_camioneta_2_4.jpg', 2, 4, NULL, 1, '2017-03-18 23:38:33', NULL, NULL, 'A'),
(2, '2 Ejes, 6 Llantas', 'camion_bus_2_6.jpg', 2, 6, NULL, 1, '2017-03-18 23:38:33', NULL, NULL, 'A'),
(3, '4 Ejes, 10 llantas ', 'camion_bus_4_10.jpg', 4, 10, NULL, 1, '2017-03-18 23:38:33', NULL, NULL, 'A'),
(4, '3 Ejes, 10 llantas ', 'camion_bus_3_10.jpg', 3, 10, NULL, 1, '2017-03-18 23:38:33', NULL, NULL, 'A'),
(5, '3 Ejes, 10 llantas ', 'camion_bus_3_10.jpg', 3, 10, 1, 1, '2017-03-18 23:38:33', NULL, NULL, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbflotamodelo`
--

CREATE TABLE IF NOT EXISTS `tbflotamodelo` (
  `codmod` int(11) NOT NULL AUTO_INCREMENT,
  `codmarmod` int(11) NOT NULL,
  `coddsnmod` int(11) NOT NULL COMMENT 'Codigo Diseño llanta',
  `nommod` varchar(45) NOT NULL,
  `usucrmod` int(11) NOT NULL,
  `fcrmod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usumdmod` int(11) DEFAULT NULL,
  `fmdmod` datetime DEFAULT NULL,
  `estrgmod` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`codmod`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `tbflotamodelo`
--

INSERT INTO `tbflotamodelo` (`codmod`, `codmarmod`, `coddsnmod`, `nommod`, `usucrmod`, `fcrmod`, `usumdmod`, `fmdmod`, `estrgmod`) VALUES
(1, 1, 0, 'xc70', 1, '2017-04-19 06:00:25', NULL, NULL, 'A'),
(2, 1, 0, 'fh', 1, '2017-04-19 06:00:25', NULL, NULL, 'A'),
(3, 19, 0, 'atego', 1, '2017-04-19 06:00:25', NULL, NULL, 'A'),
(4, 4, 0, 'K410', 1, '2017-04-19 06:00:25', NULL, NULL, 'A'),
(5, 4, 0, 'F250', 1, '2017-04-19 06:00:25', NULL, NULL, 'A'),
(6, 1, 0, 'fh10', 1, '2017-04-19 06:04:08', NULL, NULL, 'A'),
(7, 1, 0, 'fh12', 1, '2017-04-19 06:04:08', NULL, NULL, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbllanta`
--

CREATE TABLE IF NOT EXISTS `tbllanta` (
  `codllan` int(11) NOT NULL AUTO_INCREMENT,
  `codempllan` int(11) DEFAULT NULL,
  `codcmpllan` int(11) DEFAULT NULL,
  `condillan` char(1) DEFAULT 'N',
  `codillan` varchar(10) NOT NULL,
  `codfgollan` varchar(15) NOT NULL COMMENT 'Codigo de fuego',
  `nrosrllan` varchar(30) NOT NULL,
  `nroprtllan` varchar(25) NOT NULL,
  `codmarllan` int(11) NOT NULL,
  `modllan` int(11) DEFAULT NULL,
  `medillan` int(11) DEFAULT NULL,
  `imallan` varchar(50) DEFAULT NULL,
  `remallan` decimal(18,2) DEFAULT '0.00',
  `precllan` decimal(18,2) DEFAULT NULL,
  `garallan` int(11) DEFAULT NULL,
  `fcmpllan` datetime DEFAULT NULL,
  `nrorenllan` int(11) DEFAULT NULL,
  `frenollan` datetime DEFAULT NULL,
  `aplvhllan` int(11) NOT NULL,
  `ubillan` int(11) DEFAULT NULL COMMENT 'Ubicacion (Almacen,flota)',
  `estrullan` int(11) DEFAULT NULL COMMENT 'Estructura',
  `nrolonllan` int(11) DEFAULT NULL COMMENT 'Nro Lonas',
  `cpdtrpllan` int(11) DEFAULT NULL COMMENT 'Capacidad Transporte',
  `prforillan` decimal(18,2) DEFAULT NULL COMMENT 'Profundiad Original',
  `prfminllan` decimal(18,2) DEFAULT NULL COMMENT 'Profundidad Minima',
  `estllan` char(1) NOT NULL DEFAULT 'D',
  `usucrllan` int(11) NOT NULL,
  `fcrllan` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usumdllan` int(11) DEFAULT NULL,
  `fmdllan` datetime DEFAULT NULL,
  `estregllan` char(1) DEFAULT 'A',
  PRIMARY KEY (`codllan`),
  UNIQUE KEY `codllan` (`codllan`),
  KEY `codmarllan_idx` (`codmarllan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `tbllanta`
--

INSERT INTO `tbllanta` (`codllan`, `codempllan`, `codcmpllan`, `condillan`, `codillan`, `codfgollan`, `nrosrllan`, `nroprtllan`, `codmarllan`, `modllan`, `medillan`, `imallan`, `remallan`, `precllan`, `garallan`, `fcmpllan`, `nrorenllan`, `frenollan`, `aplvhllan`, `ubillan`, `estrullan`, `nrolonllan`, `cpdtrpllan`, `prforillan`, `prfminllan`, `estllan`, `usucrllan`, `fcrllan`, `usumdllan`, `fmdllan`, `estregllan`) VALUES
(1, 1, 12, 'N', '0000000001', '', 'dfgrt', '', 13, 1, 2, NULL, '0.00', '123.00', NULL, '2016-12-11 00:00:00', NULL, NULL, 14, NULL, NULL, NULL, NULL, NULL, NULL, 'M', 1, NULL, 1, '2017-04-07 06:34:20', 'A'),
(2, 1, 12, 'N', '0000000002', '', 'dfggh', '', 13, 1, 2, NULL, '0.00', '123.00', NULL, '2016-12-11 00:00:00', NULL, NULL, 14, NULL, NULL, NULL, NULL, NULL, NULL, 'M', 1, NULL, 1, '2017-04-16 21:48:27', 'A'),
(3, 1, 12, 'N', '0000000003', '', 'fghjhj1204', '', 13, 2, 3, NULL, '0.00', '432.00', NULL, '2016-12-11 00:00:00', NULL, NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, 'D', 1, NULL, NULL, NULL, 'A'),
(4, 1, 12, 'N', '0000000004', '', 'sdsdfgh', '', 13, 2, 3, NULL, '0.00', '432.00', NULL, '2016-12-11 00:00:00', NULL, NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, 'D', 1, NULL, 1, '2017-04-03 06:01:05', 'A'),
(5, 1, 12, 'N', '0000000005', '', 'sdsd', '', 13, 2, 3, NULL, '0.00', '432.00', NULL, '2016-12-11 00:00:00', NULL, NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, 'D', 1, NULL, 1, '2017-04-03 06:03:35', 'A'),
(6, 1, 13, 'N', '0000000006', '', 'sdsd', '', 13, 1, 1, NULL, '0.00', '124.30', NULL, '2016-12-17 00:00:00', NULL, NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, 'D', 1, '2016-12-17 01:48:07', 1, '2017-04-03 06:03:32', 'A'),
(7, 1, 13, 'N', '0000000007', '', 'fdf', '', 13, 1, 1, NULL, '0.00', '124.30', NULL, '2016-12-17 00:00:00', NULL, NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, 'M', 1, '2016-12-17 01:48:07', 1, '2017-04-03 06:03:30', 'A'),
(8, 1, 13, 'R', '0000000008', '', 'fgfg', '', 13, 2, 4, NULL, '0.00', '150.36', NULL, '2016-12-17 00:00:00', NULL, NULL, 14, NULL, NULL, NULL, NULL, NULL, NULL, 'M', 1, '2016-12-17 01:48:07', 1, '2017-04-03 06:02:44', 'A'),
(9, 1, 13, 'R', '0000000009', '', 'dfgrth', '', 13, 2, 4, NULL, '0.00', '150.36', NULL, '2016-12-17 00:00:00', NULL, NULL, 14, NULL, NULL, NULL, NULL, NULL, NULL, 'D', 1, '2016-12-17 01:48:07', 1, '2017-04-16 23:46:33', 'A'),
(10, 1, 13, 'R', '0000000010', '', 'dfgrt', '', 13, 2, 4, NULL, '0.00', '150.36', NULL, '2016-12-17 00:00:00', NULL, NULL, 14, NULL, NULL, NULL, NULL, NULL, NULL, 'D', 1, '2016-12-17 01:48:07', 1, '2017-04-03 05:57:07', 'A'),
(11, 1, 14, 'N', '0000000011', '', 'sdsdg', '', 13, 1, 1, NULL, '0.00', '156.60', NULL, '2017-03-23 00:00:00', NULL, NULL, 14, NULL, NULL, NULL, NULL, NULL, NULL, 'D', 1, '2017-03-23 11:03:30', 1, '2017-04-16 21:46:11', 'A'),
(12, 1, 14, 'N', '0000000012', '', 'dfgr', '', 13, 1, 1, NULL, '0.00', '156.60', NULL, '2017-03-23 00:00:00', NULL, NULL, 16, NULL, NULL, NULL, NULL, NULL, NULL, 'D', 1, '2017-03-23 11:03:31', 1, '2017-04-03 05:53:12', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbllantamedida`
--

CREATE TABLE IF NOT EXISTS `tbllantamedida` (
  `codmedi` int(11) NOT NULL AUTO_INCREMENT,
  `nommedi` varchar(80) NOT NULL,
  `codmark` int(11) NOT NULL,
  `codmode` int(11) NOT NULL,
  `usucrmedi` int(11) NOT NULL,
  `fcrmedi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usumdmedi` int(11) DEFAULT NULL,
  `fmdmedi` date DEFAULT NULL,
  `estregnedi` char(1) DEFAULT 'A',
  PRIMARY KEY (`codmedi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbllantamedida`
--

INSERT INTO `tbllantamedida` (`codmedi`, `nommedi`, `codmark`, `codmode`, `usucrmedi`, `fcrmedi`, `usumdmedi`, `fmdmedi`, `estregnedi`) VALUES
(1, '195/60', 13, 1, 1, '2016-08-07 13:22:51', NULL, NULL, 'A'),
(2, '295/80', 13, 1, 1, '2016-08-07 13:22:51', NULL, NULL, 'A'),
(3, '315/80', 13, 2, 1, '2016-08-08 00:59:29', NULL, NULL, 'A'),
(4, '315/70', 13, 2, 0, '2016-08-08 00:59:29', NULL, NULL, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbllantamodelo`
--

CREATE TABLE IF NOT EXISTS `tbllantamodelo` (
  `codmod` int(11) NOT NULL AUTO_INCREMENT,
  `nommod` varchar(60) NOT NULL,
  `codmrk` int(11) NOT NULL,
  `ucrmod` int(11) NOT NULL,
  `fcrmod` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `umdmod` int(11) DEFAULT NULL,
  `fmdmod` time DEFAULT NULL,
  `estrgmod` char(1) DEFAULT 'A',
  PRIMARY KEY (`codmod`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `tbllantamodelo`
--

INSERT INTO `tbllantamodelo` (`codmod`, `nommod`, `codmrk`, `ucrmod`, `fcrmod`, `umdmod`, `fmdmod`, `estrgmod`) VALUES
(1, 'X MULTI Z', 13, 1, '2016-07-31 20:03:45', NULL, NULL, 'A'),
(2, 'X MULTI D', 13, 1, '2016-07-31 20:03:45', NULL, NULL, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmarca`
--

CREATE TABLE IF NOT EXISTS `tbmarca` (
  `codmar` int(11) NOT NULL AUTO_INCREMENT,
  `idmarc` int(11) NOT NULL COMMENT '1 flota, 2 llanta',
  `nommar` varchar(45) NOT NULL,
  `estregmar` char(1) DEFAULT 'A',
  `usucrmar` int(11) NOT NULL,
  `fcrmar` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usumdmar` int(11) DEFAULT NULL,
  `fmdmar` datetime DEFAULT NULL,
  PRIMARY KEY (`codmar`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `tbmarca`
--

INSERT INTO `tbmarca` (`codmar`, `idmarc`, `nommar`, `estregmar`, `usucrmar`, `fcrmar`, `usumdmar`, `fmdmar`) VALUES
(1, 1, 'volvo', 'A', 1, NULL, 1, '2016-03-27 16:08:24'),
(2, 1, 'man', 'A', 1, '2016-03-28 02:08:32', 1, '2016-03-27 16:50:11'),
(3, 1, 'International', 'A', 1, '2016-03-28 02:45:40', 1, '2016-03-27 16:49:57'),
(4, 1, 'scania', 'A', 1, '2016-03-28 02:49:02', 1, '2016-03-27 16:49:17'),
(5, 1, 'kenwor', 'A', 1, '2016-03-28 04:24:48', 1, '2016-03-27 21:06:54'),
(6, 1, 'kia', 'A', 1, '2016-03-28 04:25:27', 1, '2016-03-27 21:10:45'),
(7, 1, 'toyota', 'A', 1, '2016-03-28 04:36:52', 1, '2016-03-27 21:07:20'),
(8, 1, 'nissan', 'A', 1, '2016-03-28 04:37:16', 1, '2016-03-27 21:07:34'),
(9, 1, 'huidai', 'A', 1, '2016-03-28 06:07:03', 1, '2016-03-27 21:14:30'),
(10, 1, 'fiat', 'A', 1, '2016-03-28 06:19:01', 1, '2016-03-27 21:14:48'),
(11, 1, 'chevrolet', 'A', 1, '2016-03-28 06:19:12', 1, '2016-03-27 21:15:28'),
(12, 2, 'goodyear', 'A', 1, '2016-03-28 08:16:59', NULL, NULL),
(13, 2, 'michelin', 'A', 1, '2016-03-28 08:20:23', NULL, NULL),
(14, 2, 'pirelli', 'A', 1, '2016-03-28 08:42:02', NULL, NULL),
(15, 2, 'dunlop', 'A', 1, '2016-03-28 08:42:12', NULL, NULL),
(16, 2, 'kumho', 'A', 1, '2016-03-28 08:42:22', NULL, NULL),
(17, 2, 'bridgestone', 'A', 1, '2016-03-28 08:42:30', NULL, NULL),
(18, 2, 'hankook', 'A', 1, '2016-03-28 08:42:40', NULL, NULL),
(19, 1, 'mercedes-benz', 'A', 1, '2017-04-14 14:56:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmenu`
--

CREATE TABLE IF NOT EXISTS `tbmenu` (
  `codmenu` int(11) NOT NULL AUTO_INCREMENT,
  `codimenu` int(11) NOT NULL,
  `paremenu` int(11) NOT NULL,
  `nommenu` varchar(45) NOT NULL,
  `linkmenu` varchar(150) NOT NULL,
  `altmenu` varchar(45) DEFAULT NULL,
  `icomenu` varchar(45) DEFAULT NULL,
  `estrgmenu` char(1) NOT NULL DEFAULT 'A',
  `usucrmenu` int(11) NOT NULL,
  `fcrmenu` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usumdmenu` int(11) DEFAULT NULL,
  `fmdmenu` datetime DEFAULT NULL,
  PRIMARY KEY (`codmenu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `tbmenu`
--

INSERT INTO `tbmenu` (`codmenu`, `codimenu`, `paremenu`, `nommenu`, `linkmenu`, `altmenu`, `icomenu`, `estrgmenu`, `usucrmenu`, `fcrmenu`, `usumdmenu`, `fmdmenu`) VALUES
(1, 1, 0, 'Inicio', '#', NULL, NULL, 'I', 1, '2016-03-12 10:00:00', NULL, NULL),
(2, 1, 0, 'Flota', '#', NULL, NULL, 'A', 1, '2016-03-12 10:00:00', NULL, NULL),
(3, 1, 0, 'Llanta', '#', NULL, NULL, 'A', 1, '2016-03-12 10:00:00', NULL, NULL),
(4, 1, 0, 'Gestión', '#', NULL, NULL, 'A', 1, '2016-03-12 10:00:00', NULL, NULL),
(5, 1, 0, 'Informacion', '#', NULL, NULL, 'A', 1, '2016-03-12 10:00:00', NULL, NULL),
(6, 1, 0, 'Grafico', '#', NULL, NULL, 'A', 1, '2016-03-12 10:00:00', NULL, NULL),
(7, 1, 2, 'Flota', 'rgtflota', NULL, NULL, 'A', 1, '2016-03-13 09:51:15', NULL, NULL),
(8, 1, 2, 'Tipo flota', 'regtipoflota', NULL, NULL, 'A', 1, '2016-03-13 09:51:15', NULL, NULL),
(9, 1, 0, 'Configuracion', '#', NULL, NULL, 'A', 1, '2016-03-24 16:50:25', NULL, NULL),
(10, 1, 9, 'Perfil', 'regperfil', NULL, NULL, 'A', 1, '2016-03-24 16:50:25', NULL, NULL),
(11, 1, 9, 'Tabla general', 'regtabgnrl', NULL, NULL, 'A', 1, '2016-03-24 16:54:55', NULL, NULL),
(12, 1, 3, 'Tipo llanta', 'regtipollan', NULL, NULL, 'A', 1, '2016-03-24 16:54:55', NULL, NULL),
(13, 1, 9, 'Usuario', 'regtabgnrl', NULL, NULL, 'A', 1, '2016-03-24 16:56:13', NULL, NULL),
(14, 1, 5, 'flota', 'regflt', NULL, NULL, 'A', 1, '2016-03-24 16:56:13', NULL, NULL),
(15, 1, 3, 'Llanta', 'rgstllan', NULL, NULL, 'A', 1, '2016-03-24 17:08:51', NULL, NULL),
(16, 1, 2, 'Marca Flota', 'regmrkflt', NULL, NULL, 'A', 1, '2016-03-24 17:08:51', NULL, NULL),
(17, 1, 3, 'Marca llanta', 'regmrklnt', NULL, NULL, 'A', 1, '2016-03-24 17:16:51', NULL, NULL),
(18, 1, 9, 'Cliente', 'regclllan', NULL, NULL, 'A', 1, '2016-03-24 17:16:51', NULL, NULL),
(19, 1, 4, 'Montar-Desmontar', 'regmntdsmt', NULL, NULL, 'A', 1, '2016-03-24 17:20:55', NULL, NULL),
(20, 1, 4, 'Control remanente', 'regctlrem', NULL, NULL, 'A', 1, '2016-03-24 17:20:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmovimiento`
--

CREATE TABLE IF NOT EXISTS `tbmovimiento` (
  `codmovi` int(11) NOT NULL AUTO_INCREMENT,
  `codempmovi` int(11) DEFAULT NULL,
  `iomovi` smallint(11) NOT NULL COMMENT '0 entrada,1 salida',
  `codtipmovi` int(11) NOT NULL,
  `codllanmovi` int(11) NOT NULL,
  `mtvmovi` int(11) NOT NULL,
  `estregmovi` char(1) NOT NULL DEFAULT 'A',
  `usucrmovi` int(11) NOT NULL,
  `fregmovi` timestamp NULL DEFAULT NULL,
  `usumdmovi` int(11) DEFAULT NULL,
  `fmdmovi` datetime DEFAULT NULL,
  PRIMARY KEY (`codmovi`),
  KEY `codlland_idx` (`codllanmovi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `tbmovimiento`
--

INSERT INTO `tbmovimiento` (`codmovi`, `codempmovi`, `iomovi`, `codtipmovi`, `codllanmovi`, `mtvmovi`, `estregmovi`, `usucrmovi`, `fregmovi`, `usumdmovi`, `fmdmovi`) VALUES
(1, 1, 1, 31, 1, 0, 'A', 1, NULL, NULL, NULL),
(2, 1, 1, 31, 2, 0, 'A', 1, NULL, NULL, NULL),
(3, 1, 1, 31, 8, 0, 'A', 1, NULL, NULL, NULL),
(4, 1, 1, 31, 9, 0, 'A', 1, NULL, NULL, NULL),
(5, 1, 0, 32, 9, 44, 'A', 1, NULL, NULL, NULL),
(6, 1, 1, 31, 7, 0, 'A', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbmultitabla`
--

CREATE TABLE IF NOT EXISTS `tbmultitabla` (
  `codmlttb` int(11) NOT NULL AUTO_INCREMENT,
  `codimlttb` int(11) NOT NULL,
  `nommlttb` varchar(45) NOT NULL,
  `estrgmlttb` char(1) NOT NULL DEFAULT 'A',
  `usucrmlttb` int(11) NOT NULL,
  `fcrmlttb` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usumdmlttb` int(11) DEFAULT NULL,
  `fmdmlttb` datetime DEFAULT NULL,
  PRIMARY KEY (`codmlttb`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

--
-- Volcado de datos para la tabla `tbmultitabla`
--

INSERT INTO `tbmultitabla` (`codmlttb`, `codimlttb`, `nommlttb`, `estrgmlttb`, `usucrmlttb`, `fcrmlttb`, `usumdmlttb`, `fmdmlttb`) VALUES
(1, 0, 'Tipo persona', 'A', 1, NULL, NULL, NULL),
(2, 1, 'Proveedor', 'A', 1, NULL, NULL, NULL),
(3, 1, 'Cliente', 'A', 1, NULL, NULL, NULL),
(4, 1, 'Empleado', 'A', 1, NULL, NULL, NULL),
(5, 0, 'Perfiles', 'A', 1, '2016-03-15 08:41:59', NULL, NULL),
(6, 5, 'Administrador', 'A', 1, '2016-03-15 08:43:31', NULL, NULL),
(7, 5, 'Supervisor', 'A', 1, '2016-03-15 08:43:31', NULL, NULL),
(8, 0, 'tipodocumento', 'A', 1, '2016-03-25 10:23:58', NULL, NULL),
(9, 8, 'RUC', 'A', 1, '2016-03-25 10:24:45', NULL, NULL),
(10, 8, 'DNI', 'A', 1, '2016-03-25 10:24:45', NULL, NULL),
(11, 0, 'tipo flota', 'A', 1, '2016-03-28 10:31:45', NULL, NULL),
(12, 11, 'automovil', 'A', 1, '2016-03-28 10:31:45', NULL, NULL),
(13, 11, 'tracto camion', 'A', 1, '2016-03-29 10:08:10', NULL, NULL),
(14, 11, 'bus', 'A', 1, '2016-03-29 10:08:31', NULL, NULL),
(15, 11, 'remolque', 'A', 1, '2016-03-29 10:08:54', NULL, NULL),
(16, 11, 'camion', 'A', 1, '2016-03-29 10:09:14', NULL, NULL),
(17, 11, 'camioneta', 'A', 1, '2016-03-29 10:09:37', NULL, NULL),
(18, 11, 'volquete', 'A', 1, '2016-03-29 10:12:39', 1, NULL),
(19, 11, 'semiremolque', 'A', 1, '2016-03-29 10:10:37', NULL, NULL),
(20, 0, 'impuetos General ventas IGV', 'A', 1, '2016-11-21 05:07:02', NULL, NULL),
(21, 20, '18.00', 'A', 1, '2016-11-21 05:08:01', NULL, NULL),
(22, 0, 'Comprobantes de Pago', 'A', 1, '2016-11-27 02:51:28', NULL, NULL),
(23, 22, 'Otros', 'A', 1, '2016-11-27 02:58:53', NULL, NULL),
(24, 22, 'Factura', 'A', 1, '2016-11-27 02:58:53', NULL, NULL),
(25, 22, 'Boleta', 'A', 1, '2016-11-27 02:58:53', NULL, NULL),
(26, 22, 'Recibo por honorario', 'A', 1, '2016-11-27 02:58:53', NULL, NULL),
(27, 22, 'Nota de credito', 'A', 1, '2016-11-27 02:58:53', NULL, NULL),
(28, 22, 'Guia Remision', 'A', 1, '2016-11-27 03:08:32', NULL, NULL),
(29, 0, 'tipomovimientollanta', 'A', 1, '2016-11-27 14:11:31', NULL, NULL),
(30, 29, 'Compra', 'A', 1, '2016-12-11 12:58:53', NULL, NULL),
(31, 29, 'Montaje', 'A', 1, '2016-12-11 12:58:53', NULL, NULL),
(32, 29, 'Desmotaje', 'A', 1, '2016-12-11 13:11:57', NULL, NULL),
(33, 29, 'Rencauche', 'A', 1, '2016-12-11 13:11:57', NULL, NULL),
(34, 29, 'Rencauchado', 'A', 1, '2016-12-11 13:11:57', NULL, NULL),
(35, 0, 'Estado de Flota', 'A', 1, '2017-04-04 04:10:23', NULL, NULL),
(36, 35, 'Mantiniento', 'A', 1, '2017-04-04 04:15:42', NULL, NULL),
(37, 35, 'Operativo', 'A', 1, '2017-04-04 04:15:42', NULL, NULL),
(38, 11, 'furgoneta', 'A', 1, '2017-04-13 14:24:16', NULL, NULL),
(39, 0, 'Motivo Desmotaje', 'A', 1, '2017-04-16 13:07:50', NULL, NULL),
(40, 39, 'Chipotes', 'A', 1, '2017-04-16 13:10:59', NULL, NULL),
(41, 39, 'Seccionado', 'A', 1, '2017-04-16 13:10:59', NULL, NULL),
(42, 39, 'Rajaduras', 'A', 1, '2017-04-16 13:10:59', NULL, NULL),
(43, 39, 'Prof.Minima', 'A', 1, '2017-04-16 13:10:59', NULL, NULL),
(44, 39, 'Rotacion', 'A', 1, '2017-04-16 13:10:59', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbperfilmenu`
--

CREATE TABLE IF NOT EXISTS `tbperfilmenu` (
  `codpfmn` int(11) NOT NULL AUTO_INCREMENT,
  `codiprfmn` int(11) NOT NULL,
  `codimenmn` int(11) NOT NULL,
  `llavpfmn` tinyint(1) DEFAULT NULL,
  `usucrpfmn` int(11) NOT NULL,
  `fcrpfmn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `usumdpfmn` int(11) DEFAULT NULL,
  `fmdpfmn` timestamp NULL DEFAULT NULL,
  `estrgpfmn` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`codpfmn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `tbperfilmenu`
--

INSERT INTO `tbperfilmenu` (`codpfmn`, `codiprfmn`, `codimenmn`, `llavpfmn`, `usucrpfmn`, `fcrpfmn`, `usumdpfmn`, `fmdpfmn`, `estrgpfmn`) VALUES
(1, 6, 1, 1, 1, '2016-03-24 06:36:57', 0, '2016-03-24 06:36:57', 'I'),
(2, 6, 2, 1, 1, '2016-03-24 06:36:57', 0, '2016-03-24 06:36:57', 'A'),
(3, 6, 3, 1, 1, '2016-03-24 06:36:57', 0, '2016-03-24 06:36:57', 'A'),
(4, 6, 4, 1, 1, '2016-03-24 06:36:57', 0, '2016-03-24 06:36:57', 'A'),
(5, 6, 5, 1, 1, '2016-03-24 06:36:57', 0, '2016-03-24 06:36:57', 'A'),
(6, 6, 6, 1, 1, '2016-03-24 06:38:52', NULL, NULL, 'A'),
(7, 6, 7, 1, 1, '2016-03-24 06:38:52', NULL, NULL, 'A'),
(8, 6, 8, 1, 1, '2016-03-24 06:40:38', NULL, NULL, 'A'),
(9, 7, 1, 1, 1, '2016-03-24 06:43:14', 0, '0000-00-00 00:00:00', 'I'),
(10, 7, 2, 1, 1, '2016-03-24 06:43:33', 0, '2016-03-24 06:36:57', 'A'),
(11, 7, 3, 1, 1, '2016-03-24 06:43:46', 0, '2016-03-24 06:36:57', 'A'),
(12, 7, 4, 1, 1, '2016-03-24 06:43:57', 0, '2016-03-24 06:36:57', 'A'),
(13, 7, 5, 1, 1, '2016-03-24 06:44:08', 0, '2016-03-24 06:36:57', 'A'),
(14, 7, 7, 1, 1, '2016-03-24 06:44:27', NULL, NULL, 'A'),
(15, 6, 15, 1, 1, '2016-03-24 17:01:10', NULL, NULL, 'A'),
(16, 6, 9, 1, 1, '2016-03-24 17:01:10', NULL, NULL, 'A'),
(17, 6, 10, 1, 1, '2016-03-24 17:01:10', NULL, NULL, 'A'),
(18, 6, 12, 1, 1, '2016-03-24 17:01:10', NULL, NULL, 'A'),
(19, 6, 13, 1, 1, '2016-03-24 17:01:10', NULL, NULL, 'A'),
(20, 6, 14, 1, 1, '2016-03-24 17:02:31', NULL, NULL, 'A'),
(21, 6, 16, 1, 1, '2016-03-24 17:02:31', NULL, NULL, 'A'),
(22, 6, 17, 1, 1, '2016-03-24 17:02:31', NULL, NULL, 'A'),
(23, 6, 18, 1, 1, '2016-03-24 17:02:31', NULL, NULL, 'A'),
(24, 6, 19, 1, 1, '2016-03-24 17:02:31', NULL, NULL, 'A'),
(25, 6, 11, 1, 1, '2016-03-24 17:26:05', NULL, NULL, 'A'),
(26, 6, 20, 1, 1, '2016-03-24 17:27:54', NULL, NULL, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbpersona`
--

CREATE TABLE IF NOT EXISTS `tbpersona` (
  `codper` int(11) NOT NULL AUTO_INCREMENT,
  `tipper` int(11) NOT NULL,
  `tipdocper` int(11) DEFAULT NULL,
  `codiper` varchar(15) NOT NULL,
  `jurper` char(1) NOT NULL,
  `nrodocper` varchar(15) DEFAULT NULL,
  `codempper` int(11) DEFAULT NULL,
  `rassocper` varchar(45) NOT NULL,
  `apaper` varchar(35) DEFAULT NULL,
  `amaper` varchar(45) DEFAULT NULL,
  `pnoper` varchar(45) DEFAULT NULL,
  `snoper` varchar(45) DEFAULT NULL,
  `dirper` varchar(50) DEFAULT NULL,
  `telper` varchar(10) DEFAULT NULL,
  `movper` varchar(10) DEFAULT NULL,
  `maiper` varchar(45) DEFAULT NULL,
  `contper` varchar(45) DEFAULT NULL,
  `estrgper` char(1) NOT NULL DEFAULT 'A',
  `usucrper` int(11) NOT NULL,
  `fcrper` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usumdper` int(11) DEFAULT NULL,
  `fmdper` datetime DEFAULT NULL,
  PRIMARY KEY (`codper`),
  UNIQUE KEY `codiper` (`codiper`),
  UNIQUE KEY `nrodocper` (`nrodocper`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `tbpersona`
--

INSERT INTO `tbpersona` (`codper`, `tipper`, `tipdocper`, `codiper`, `jurper`, `nrodocper`, `codempper`, `rassocper`, `apaper`, `amaper`, `pnoper`, `snoper`, `dirper`, `telper`, `movper`, `maiper`, `contper`, `estrgper`, `usucrper`, `fcrper`, `usumdper`, `fmdper`) VALUES
(1, 3, 9, '12345678901', 'J', '12345678901', 1, 'RONALD RAMOS GUTIERREZ', 'RAMOS', 'GUTIERREZ', 'RONALD', NULL, '', NULL, NULL, NULL, NULL, 'A', 1, '2016-08-20 05:00:00', NULL, NULL),
(3, 2, 9, '12345678911', 'J', '12345678911', 1, 'Van Llantas', '', '', '', NULL, '', NULL, NULL, NULL, NULL, 'A', 1, '2016-08-20 05:00:00', NULL, NULL),
(4, 4, 10, '42264935', 'N', '42264935', 1, '', 'Saul', 'Santillan', 'Saul', NULL, '42264935', NULL, NULL, NULL, NULL, 'A', 1, '2016-08-20 05:00:00', NULL, NULL),
(6, 3, 9, '20422649351', 'j', '20422649351', 1, ' Saul Salas', NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, 'A', 1, '2016-08-20 05:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbremanente`
--

CREATE TABLE IF NOT EXISTS `tbremanente` (
  `codrem` int(11) NOT NULL AUTO_INCREMENT,
  `codperrem` int(11) DEFAULT NULL,
  `codillanrem` int(11) NOT NULL,
  `numrem` decimal(8,3) NOT NULL,
  `prfintllanrem` decimal(18,2) NOT NULL,
  `prfcntllanrem` decimal(18,2) DEFAULT NULL,
  `prfextllanrem` decimal(18,2) DEFAULT NULL,
  `prellanrem` decimal(8,3) NOT NULL,
  `kmllanrem` decimal(18,2) NOT NULL,
  `fispllanrem` datetime DEFAULT NULL,
  `imllanrem` varchar(80) DEFAULT NULL,
  `obsllanrem` varchar(200) DEFAULT NULL,
  `usuregrem` int(11) NOT NULL,
  `fregrem` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usumdrem` int(11) DEFAULT NULL,
  `fmdrem` datetime DEFAULT NULL,
  `estregrem` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`codrem`),
  KEY `codillanrem_idx` (`codillanrem`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `tbremanente`
--

INSERT INTO `tbremanente` (`codrem`, `codperrem`, `codillanrem`, `numrem`, `prfintllanrem`, `prfcntllanrem`, `prfextllanrem`, `prellanrem`, `kmllanrem`, `fispllanrem`, `imllanrem`, `obsllanrem`, `usuregrem`, `fregrem`, `usumdrem`, `fmdrem`, `estregrem`) VALUES
(1, 1, 1, '0.000', '12.00', '11.00', '10.00', '124.000', '231.00', NULL, NULL, NULL, 1, '2017-04-17 04:35:45', NULL, NULL, 'A'),
(2, 1, 2, '0.000', '12.00', '11.00', '10.00', '124.000', '231.00', NULL, NULL, NULL, 1, '2017-04-17 04:36:50', NULL, NULL, 'A'),
(3, 1, 8, '0.000', '12.00', '11.00', '11.00', '123.000', '54321.00', NULL, NULL, NULL, 1, '2017-04-17 04:39:42', NULL, NULL, 'A'),
(4, 1, 9, '0.000', '11.00', '10.00', '9.00', '4321.000', '543.00', NULL, NULL, NULL, 1, '2017-04-17 04:40:31', NULL, NULL, 'A'),
(5, 1, 9, '0.000', '10.00', '11.00', '10.00', '0.000', '1235.00', NULL, NULL, NULL, 1, '2017-04-17 04:46:32', NULL, NULL, 'A'),
(6, 1, 8, '0.000', '11.00', NULL, '10.00', '0.000', '1234.00', '2017-04-17 01:00:37', NULL, NULL, 1, '2017-04-17 06:00:37', NULL, NULL, 'A'),
(7, 1, 2, '0.000', '8.00', NULL, '9.00', '0.000', '1236.00', '2017-04-17 01:03:14', NULL, NULL, 1, '2017-04-17 06:03:14', NULL, NULL, 'A'),
(8, 1, 1, '0.000', '11.00', '11.00', '12.00', '0.000', '23.00', '2017-04-17 01:06:45', NULL, NULL, 1, '2017-04-17 06:06:45', NULL, NULL, 'A'),
(9, 1, 7, '0.000', '2.00', '3.00', '3.00', '231.000', '2341.00', NULL, NULL, NULL, 1, '2017-04-19 02:22:03', NULL, NULL, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbrenovacion`
--

CREATE TABLE IF NOT EXISTS `tbrenovacion` (
  `codreno` int(11) NOT NULL AUTO_INCREMENT,
  `codempreno` int(11) DEFAULT NULL,
  `codireno` char(10) NOT NULL,
  `codproveren` int(11) NOT NULL,
  `tipdocuren` int(11) NOT NULL,
  `nroducren` varchar(25) NOT NULL,
  `imptren` decimal(8,2) NOT NULL,
  `estren` int(11) NOT NULL,
  `usucrren` int(11) NOT NULL,
  `fcrren` timestamp NULL DEFAULT NULL,
  `usumdren` int(11) DEFAULT NULL,
  `fmdren` datetime DEFAULT NULL,
  PRIMARY KEY (`codreno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbrenovaciondetalle`
--

CREATE TABLE IF NOT EXISTS `tbrenovaciondetalle` (
  `codrenod` int(11) NOT NULL,
  `codperrenod` int(11) DEFAULT NULL,
  `codirenod` int(11) NOT NULL,
  `codilland` int(11) NOT NULL,
  `motilland` int(11) NOT NULL,
  `fecenvd` datetime DEFAULT NULL,
  `renolland` tinyint(1) NOT NULL,
  `costrend` decimal(8,2) NOT NULL,
  `fecrecd` datetime DEFAULT NULL,
  `estrgrenod` char(1) NOT NULL DEFAULT 'A',
  `usucrmrend` int(11) NOT NULL,
  `fcrrend` timestamp NULL DEFAULT NULL,
  `usumdrend` int(11) DEFAULT NULL,
  `fmdrend` datetime DEFAULT NULL,
  PRIMARY KEY (`codrenod`),
  KEY `codirenod_idx` (`codirenod`),
  KEY `codilland_idx` (`codilland`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbusuario`
--

CREATE TABLE IF NOT EXISTS `tbusuario` (
  `codusua` int(11) NOT NULL AUTO_INCREMENT,
  `usuausua` varchar(35) DEFAULT NULL,
  `correusua` varchar(80) NOT NULL,
  `passusua` char(32) NOT NULL,
  `nombape` varchar(45) DEFAULT NULL,
  `perfilusua` smallint(1) DEFAULT NULL,
  `codiperusua` int(11) DEFAULT NULL,
  `codempusua` int(11) NOT NULL,
  `campas` int(11) DEFAULT '0',
  `fcrusua` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usucrusua` int(11) DEFAULT NULL,
  `usumdusua` int(11) DEFAULT NULL,
  `fmdusua` datetime DEFAULT NULL,
  `estrgusua` char(1) DEFAULT NULL,
  PRIMARY KEY (`codusua`),
  UNIQUE KEY `usuausua` (`usuausua`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `tbusuario`
--

INSERT INTO `tbusuario` (`codusua`, `usuausua`, `correusua`, `passusua`, `nombape`, `perfilusua`, `codiperusua`, `codempusua`, `campas`, `fcrusua`, `usucrusua`, `usumdusua`, `fmdusua`, `estrgusua`) VALUES
(1, 'ronald1781', 'ronald1781@gmail.com', '62cc2d8b4bf2d8728120d052163a77df', 'Ronald Ramos', 6, 1, 1, 0, '2016-03-05 10:00:00', NULL, NULL, NULL, 'A');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vtcliente`
--
CREATE TABLE IF NOT EXISTS `vtcliente` (
`codper` int(11)
,`tipper` int(11)
,`tipdocper` int(11)
,`codiper` varchar(15)
,`jurper` char(1)
,`nrodocper` varchar(15)
,`codempper` int(11)
,`rassocper` varchar(45)
,`apaper` varchar(35)
,`amaper` varchar(45)
,`pnoper` varchar(45)
,`snoper` varchar(45)
,`dirper` varchar(50)
,`telper` varchar(10)
,`movper` varchar(10)
,`maiper` varchar(45)
,`contper` varchar(45)
,`estrgper` char(1)
,`usucrper` int(11)
,`fcrper` timestamp
,`usumdper` int(11)
,`fmdper` datetime
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vtcomprobante`
--
CREATE TABLE IF NOT EXISTS `vtcomprobante` (
`codmlttb` int(11)
,`codimlttb` int(11)
,`nommlttb` varchar(45)
,`estrgmlttb` char(1)
,`usucrmlttb` int(11)
,`fcrmlttb` timestamp
,`usumdmlttb` int(11)
,`fmdmlttb` datetime
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vtempleado`
--
CREATE TABLE IF NOT EXISTS `vtempleado` (
`codper` int(11)
,`tipper` int(11)
,`tipdocper` int(11)
,`codiper` varchar(15)
,`jurper` char(1)
,`nrodocper` varchar(15)
,`codempper` int(11)
,`rassocper` varchar(45)
,`apaper` varchar(35)
,`amaper` varchar(45)
,`pnoper` varchar(45)
,`snoper` varchar(45)
,`dirper` varchar(50)
,`telper` varchar(10)
,`movper` varchar(10)
,`maiper` varchar(45)
,`contper` varchar(45)
,`estrgper` char(1)
,`usucrper` int(11)
,`fcrper` timestamp
,`usumdper` int(11)
,`fmdper` datetime
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vtestaflota`
--
CREATE TABLE IF NOT EXISTS `vtestaflota` (
`codmlttb` int(11)
,`codimlttb` int(11)
,`nommlttb` varchar(45)
,`estrgmlttb` char(1)
,`usucrmlttb` int(11)
,`fcrmlttb` timestamp
,`usumdmlttb` int(11)
,`fmdmlttb` datetime
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vtmarcaflota`
--
CREATE TABLE IF NOT EXISTS `vtmarcaflota` (
`codmar` int(11)
,`idmarc` int(11)
,`nommar` varchar(45)
,`estregmar` char(1)
,`usucrmar` int(11)
,`fcrmar` timestamp
,`usumdmar` int(11)
,`fmdmar` datetime
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vtmarcallanta`
--
CREATE TABLE IF NOT EXISTS `vtmarcallanta` (
`codmrkllan` int(11)
,`nommrkllan` varchar(45)
,`estmrllan` char(1)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vtmenu`
--
CREATE TABLE IF NOT EXISTS `vtmenu` (
`codmenu` int(11)
,`codimenu` int(11)
,`paremenu` int(11)
,`nommenu` varchar(45)
,`linkmenu` varchar(150)
,`altmenu` varchar(45)
,`icomenu` varchar(45)
,`estrgmenu` char(1)
,`usucrmenu` int(11)
,`fcrmenu` timestamp
,`usumdmenu` int(11)
,`fmdmenu` datetime
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vtmenua1`
--
CREATE TABLE IF NOT EXISTS `vtmenua1` (
`codmenu` int(11)
,`codimenu` int(11)
,`paremenu` int(11)
,`nommenu` varchar(45)
,`linkmenu` varchar(150)
,`altmenu` varchar(45)
,`icomenu` varchar(45)
,`estrgmenu` char(1)
,`usucrmenu` int(11)
,`fcrmenu` timestamp
,`usumdmenu` int(11)
,`fmdmenu` datetime
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vtmotivodesmontaje`
--
CREATE TABLE IF NOT EXISTS `vtmotivodesmontaje` (
`codmlttb` int(11)
,`codimlttb` int(11)
,`nommlttb` varchar(45)
,`estrgmlttb` char(1)
,`usucrmlttb` int(11)
,`fcrmlttb` timestamp
,`usumdmlttb` int(11)
,`fmdmlttb` datetime
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vtperfil`
--
CREATE TABLE IF NOT EXISTS `vtperfil` (
`codmlttb` int(11)
,`codimlttb` int(11)
,`nommlttb` varchar(45)
,`estrgmlttb` char(1)
,`usucrmlttb` int(11)
,`fcrmlttb` timestamp
,`usumdmlttb` int(11)
,`fmdmlttb` datetime
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vtperfilmenua`
--
CREATE TABLE IF NOT EXISTS `vtperfilmenua` (
`codpfmn` int(11)
,`codiprfmn` int(11)
,`codimenmn` int(11)
,`llavpfmn` tinyint(1)
,`usucrpfmn` int(11)
,`fcrpfmn` timestamp
,`usumdpfmn` int(11)
,`fmdpfmn` timestamp
,`estrgpfmn` char(1)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vtperfilmenulist`
--
CREATE TABLE IF NOT EXISTS `vtperfilmenulist` (
`codpfmn` int(11)
,`codiprfmn` int(11)
,`codimenmn` int(11)
,`nommlttb` varchar(45)
,`nommenu` varchar(45)
,`estrgpfmn` char(1)
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vtpersona`
--
CREATE TABLE IF NOT EXISTS `vtpersona` (
`codper` int(11)
,`tipper` int(11)
,`tipdocper` int(11)
,`codiper` varchar(15)
,`jurper` char(1)
,`nrodocper` varchar(15)
,`codempper` int(11)
,`rassocper` varchar(45)
,`apaper` varchar(35)
,`amaper` varchar(45)
,`pnoper` varchar(45)
,`snoper` varchar(45)
,`dirper` varchar(50)
,`telper` varchar(10)
,`movper` varchar(10)
,`maiper` varchar(45)
,`contper` varchar(45)
,`estrgper` char(1)
,`usucrper` int(11)
,`fcrper` timestamp
,`usumdper` int(11)
,`fmdper` datetime
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vtproveedor`
--
CREATE TABLE IF NOT EXISTS `vtproveedor` (
`codper` int(11)
,`tipper` int(11)
,`tipdocper` int(11)
,`codiper` varchar(15)
,`jurper` char(1)
,`nrodocper` varchar(15)
,`codempper` int(11)
,`rassocper` varchar(45)
,`apaper` varchar(35)
,`amaper` varchar(45)
,`pnoper` varchar(45)
,`snoper` varchar(45)
,`dirper` varchar(50)
,`telper` varchar(10)
,`movper` varchar(10)
,`maiper` varchar(45)
,`contper` varchar(45)
,`estrgper` char(1)
,`usucrper` int(11)
,`fcrper` timestamp
,`usumdper` int(11)
,`fmdper` datetime
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vttipoflota`
--
CREATE TABLE IF NOT EXISTS `vttipoflota` (
`codmlttb` int(11)
,`codimlttb` int(11)
,`nommlttb` varchar(45)
,`estrgmlttb` char(1)
,`usucrmlttb` int(11)
,`fcrmlttb` timestamp
,`usumdmlttb` int(11)
,`fmdmlttb` datetime
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vttipomovimientollanta`
--
CREATE TABLE IF NOT EXISTS `vttipomovimientollanta` (
`codmlttb` int(11)
,`codimlttb` int(11)
,`nommlttb` varchar(45)
,`estrgmlttb` char(1)
,`usucrmlttb` int(11)
,`fcrmlttb` timestamp
,`usumdmlttb` int(11)
,`fmdmlttb` datetime
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vttipopersona`
--
CREATE TABLE IF NOT EXISTS `vttipopersona` (
`codmlttb` int(11)
,`codimlttb` int(11)
,`nommlttb` varchar(45)
,`estrgmlttb` char(1)
,`usucrmlttb` int(11)
,`fcrmlttb` timestamp
,`usumdmlttb` int(11)
,`fmdmlttb` datetime
);
-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `vtusuario`
--
CREATE TABLE IF NOT EXISTS `vtusuario` (
);
-- --------------------------------------------------------

--
-- Estructura para la vista `vtcliente`
--
DROP TABLE IF EXISTS `vtcliente`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vtcliente` AS select `tbpersona`.`codper` AS `codper`,`tbpersona`.`tipper` AS `tipper`,`tbpersona`.`tipdocper` AS `tipdocper`,`tbpersona`.`codiper` AS `codiper`,`tbpersona`.`jurper` AS `jurper`,`tbpersona`.`nrodocper` AS `nrodocper`,`tbpersona`.`codempper` AS `codempper`,`tbpersona`.`rassocper` AS `rassocper`,`tbpersona`.`apaper` AS `apaper`,`tbpersona`.`amaper` AS `amaper`,`tbpersona`.`pnoper` AS `pnoper`,`tbpersona`.`snoper` AS `snoper`,`tbpersona`.`dirper` AS `dirper`,`tbpersona`.`telper` AS `telper`,`tbpersona`.`movper` AS `movper`,`tbpersona`.`maiper` AS `maiper`,`tbpersona`.`contper` AS `contper`,`tbpersona`.`estrgper` AS `estrgper`,`tbpersona`.`usucrper` AS `usucrper`,`tbpersona`.`fcrper` AS `fcrper`,`tbpersona`.`usumdper` AS `usumdper`,`tbpersona`.`fmdper` AS `fmdper` from `tbpersona` where ((`tbpersona`.`tipper` = '3') and (`tbpersona`.`estrgper` = 'A'));

-- --------------------------------------------------------

--
-- Estructura para la vista `vtcomprobante`
--
DROP TABLE IF EXISTS `vtcomprobante`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vtcomprobante` AS select `tbmultitabla`.`codmlttb` AS `codmlttb`,`tbmultitabla`.`codimlttb` AS `codimlttb`,`tbmultitabla`.`nommlttb` AS `nommlttb`,`tbmultitabla`.`estrgmlttb` AS `estrgmlttb`,`tbmultitabla`.`usucrmlttb` AS `usucrmlttb`,`tbmultitabla`.`fcrmlttb` AS `fcrmlttb`,`tbmultitabla`.`usumdmlttb` AS `usumdmlttb`,`tbmultitabla`.`fmdmlttb` AS `fmdmlttb` from `tbmultitabla` where (`tbmultitabla`.`codimlttb` = 22);

-- --------------------------------------------------------

--
-- Estructura para la vista `vtempleado`
--
DROP TABLE IF EXISTS `vtempleado`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vtempleado` AS select `tbpersona`.`codper` AS `codper`,`tbpersona`.`tipper` AS `tipper`,`tbpersona`.`tipdocper` AS `tipdocper`,`tbpersona`.`codiper` AS `codiper`,`tbpersona`.`jurper` AS `jurper`,`tbpersona`.`nrodocper` AS `nrodocper`,`tbpersona`.`codempper` AS `codempper`,`tbpersona`.`rassocper` AS `rassocper`,`tbpersona`.`apaper` AS `apaper`,`tbpersona`.`amaper` AS `amaper`,`tbpersona`.`pnoper` AS `pnoper`,`tbpersona`.`snoper` AS `snoper`,`tbpersona`.`dirper` AS `dirper`,`tbpersona`.`telper` AS `telper`,`tbpersona`.`movper` AS `movper`,`tbpersona`.`maiper` AS `maiper`,`tbpersona`.`contper` AS `contper`,`tbpersona`.`estrgper` AS `estrgper`,`tbpersona`.`usucrper` AS `usucrper`,`tbpersona`.`fcrper` AS `fcrper`,`tbpersona`.`usumdper` AS `usumdper`,`tbpersona`.`fmdper` AS `fmdper` from `tbpersona` where ((`tbpersona`.`tipper` = '4') and (`tbpersona`.`estrgper` = 'A'));

-- --------------------------------------------------------

--
-- Estructura para la vista `vtestaflota`
--
DROP TABLE IF EXISTS `vtestaflota`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vtestaflota` AS select `tbmultitabla`.`codmlttb` AS `codmlttb`,`tbmultitabla`.`codimlttb` AS `codimlttb`,`tbmultitabla`.`nommlttb` AS `nommlttb`,`tbmultitabla`.`estrgmlttb` AS `estrgmlttb`,`tbmultitabla`.`usucrmlttb` AS `usucrmlttb`,`tbmultitabla`.`fcrmlttb` AS `fcrmlttb`,`tbmultitabla`.`usumdmlttb` AS `usumdmlttb`,`tbmultitabla`.`fmdmlttb` AS `fmdmlttb` from `tbmultitabla` where ((`tbmultitabla`.`codimlttb` = '35') and (`tbmultitabla`.`estrgmlttb` = 'A'));

-- --------------------------------------------------------

--
-- Estructura para la vista `vtmarcaflota`
--
DROP TABLE IF EXISTS `vtmarcaflota`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vtmarcaflota` AS select `tbmarca`.`codmar` AS `codmar`,`tbmarca`.`idmarc` AS `idmarc`,`tbmarca`.`nommar` AS `nommar`,`tbmarca`.`estregmar` AS `estregmar`,`tbmarca`.`usucrmar` AS `usucrmar`,`tbmarca`.`fcrmar` AS `fcrmar`,`tbmarca`.`usumdmar` AS `usumdmar`,`tbmarca`.`fmdmar` AS `fmdmar` from `tbmarca` where ((`tbmarca`.`idmarc` = 1) and (`tbmarca`.`estregmar` = 'A'));

-- --------------------------------------------------------

--
-- Estructura para la vista `vtmarcallanta`
--
DROP TABLE IF EXISTS `vtmarcallanta`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vtmarcallanta` AS select `tbmarca`.`codmar` AS `codmrkllan`,`tbmarca`.`nommar` AS `nommrkllan`,`tbmarca`.`estregmar` AS `estmrllan` from `tbmarca` where ((`tbmarca`.`idmarc` = '2') and (`tbmarca`.`estregmar` = 'A'));

-- --------------------------------------------------------

--
-- Estructura para la vista `vtmenu`
--
DROP TABLE IF EXISTS `vtmenu`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vtmenu` AS select `tbmenu`.`codmenu` AS `codmenu`,`tbmenu`.`codimenu` AS `codimenu`,`tbmenu`.`paremenu` AS `paremenu`,`tbmenu`.`nommenu` AS `nommenu`,`tbmenu`.`linkmenu` AS `linkmenu`,`tbmenu`.`altmenu` AS `altmenu`,`tbmenu`.`icomenu` AS `icomenu`,`tbmenu`.`estrgmenu` AS `estrgmenu`,`tbmenu`.`usucrmenu` AS `usucrmenu`,`tbmenu`.`fcrmenu` AS `fcrmenu`,`tbmenu`.`usumdmenu` AS `usumdmenu`,`tbmenu`.`fmdmenu` AS `fmdmenu` from `tbmenu`;

-- --------------------------------------------------------

--
-- Estructura para la vista `vtmenua1`
--
DROP TABLE IF EXISTS `vtmenua1`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vtmenua1` AS select `tbmenu`.`codmenu` AS `codmenu`,`tbmenu`.`codimenu` AS `codimenu`,`tbmenu`.`paremenu` AS `paremenu`,`tbmenu`.`nommenu` AS `nommenu`,`tbmenu`.`linkmenu` AS `linkmenu`,`tbmenu`.`altmenu` AS `altmenu`,`tbmenu`.`icomenu` AS `icomenu`,`tbmenu`.`estrgmenu` AS `estrgmenu`,`tbmenu`.`usucrmenu` AS `usucrmenu`,`tbmenu`.`fcrmenu` AS `fcrmenu`,`tbmenu`.`usumdmenu` AS `usumdmenu`,`tbmenu`.`fmdmenu` AS `fmdmenu` from `tbmenu` where ((`tbmenu`.`estrgmenu` = 'A') and (`tbmenu`.`codimenu` = 1));

-- --------------------------------------------------------

--
-- Estructura para la vista `vtmotivodesmontaje`
--
DROP TABLE IF EXISTS `vtmotivodesmontaje`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vtmotivodesmontaje` AS select `tbmultitabla`.`codmlttb` AS `codmlttb`,`tbmultitabla`.`codimlttb` AS `codimlttb`,`tbmultitabla`.`nommlttb` AS `nommlttb`,`tbmultitabla`.`estrgmlttb` AS `estrgmlttb`,`tbmultitabla`.`usucrmlttb` AS `usucrmlttb`,`tbmultitabla`.`fcrmlttb` AS `fcrmlttb`,`tbmultitabla`.`usumdmlttb` AS `usumdmlttb`,`tbmultitabla`.`fmdmlttb` AS `fmdmlttb` from `tbmultitabla` where ((`tbmultitabla`.`codimlttb` = '39') and (`tbmultitabla`.`estrgmlttb` = 'A'));

-- --------------------------------------------------------

--
-- Estructura para la vista `vtperfil`
--
DROP TABLE IF EXISTS `vtperfil`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vtperfil` AS select `tbmultitabla`.`codmlttb` AS `codmlttb`,`tbmultitabla`.`codimlttb` AS `codimlttb`,`tbmultitabla`.`nommlttb` AS `nommlttb`,`tbmultitabla`.`estrgmlttb` AS `estrgmlttb`,`tbmultitabla`.`usucrmlttb` AS `usucrmlttb`,`tbmultitabla`.`fcrmlttb` AS `fcrmlttb`,`tbmultitabla`.`usumdmlttb` AS `usumdmlttb`,`tbmultitabla`.`fmdmlttb` AS `fmdmlttb` from `tbmultitabla` where ((`tbmultitabla`.`codimlttb` = 5) and (`tbmultitabla`.`estrgmlttb` = 'A'));

-- --------------------------------------------------------

--
-- Estructura para la vista `vtperfilmenua`
--
DROP TABLE IF EXISTS `vtperfilmenua`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vtperfilmenua` AS select `tbperfilmenu`.`codpfmn` AS `codpfmn`,`tbperfilmenu`.`codiprfmn` AS `codiprfmn`,`tbperfilmenu`.`codimenmn` AS `codimenmn`,`tbperfilmenu`.`llavpfmn` AS `llavpfmn`,`tbperfilmenu`.`usucrpfmn` AS `usucrpfmn`,`tbperfilmenu`.`fcrpfmn` AS `fcrpfmn`,`tbperfilmenu`.`usumdpfmn` AS `usumdpfmn`,`tbperfilmenu`.`fmdpfmn` AS `fmdpfmn`,`tbperfilmenu`.`estrgpfmn` AS `estrgpfmn` from `tbperfilmenu` where (`tbperfilmenu`.`estrgpfmn` = 'A');

-- --------------------------------------------------------

--
-- Estructura para la vista `vtperfilmenulist`
--
DROP TABLE IF EXISTS `vtperfilmenulist`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vtperfilmenulist` AS select `vpm`.`codpfmn` AS `codpfmn`,`vpm`.`codiprfmn` AS `codiprfmn`,`vpm`.`codimenmn` AS `codimenmn`,`vpf`.`nommlttb` AS `nommlttb`,`vtm`.`nommenu` AS `nommenu`,`vpm`.`estrgpfmn` AS `estrgpfmn` from ((`vtperfilmenua` `vpm` join `vtperfil` `vpf` on((`vpm`.`codiprfmn` = `vpf`.`codmlttb`))) join `vtmenua1` `vtm` on((`vpm`.`codimenmn` = `vtm`.`codmenu`))) order by `vpf`.`nommlttb`;

-- --------------------------------------------------------

--
-- Estructura para la vista `vtpersona`
--
DROP TABLE IF EXISTS `vtpersona`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vtpersona` AS select `tbpersona`.`codper` AS `codper`,`tbpersona`.`tipper` AS `tipper`,`tbpersona`.`tipdocper` AS `tipdocper`,`tbpersona`.`codiper` AS `codiper`,`tbpersona`.`jurper` AS `jurper`,`tbpersona`.`nrodocper` AS `nrodocper`,`tbpersona`.`codempper` AS `codempper`,`tbpersona`.`rassocper` AS `rassocper`,`tbpersona`.`apaper` AS `apaper`,`tbpersona`.`amaper` AS `amaper`,`tbpersona`.`pnoper` AS `pnoper`,`tbpersona`.`snoper` AS `snoper`,`tbpersona`.`dirper` AS `dirper`,`tbpersona`.`telper` AS `telper`,`tbpersona`.`movper` AS `movper`,`tbpersona`.`maiper` AS `maiper`,`tbpersona`.`contper` AS `contper`,`tbpersona`.`estrgper` AS `estrgper`,`tbpersona`.`usucrper` AS `usucrper`,`tbpersona`.`fcrper` AS `fcrper`,`tbpersona`.`usumdper` AS `usumdper`,`tbpersona`.`fmdper` AS `fmdper` from `tbpersona` where (`tbpersona`.`estrgper` = 'A');

-- --------------------------------------------------------

--
-- Estructura para la vista `vtproveedor`
--
DROP TABLE IF EXISTS `vtproveedor`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vtproveedor` AS select `tbpersona`.`codper` AS `codper`,`tbpersona`.`tipper` AS `tipper`,`tbpersona`.`tipdocper` AS `tipdocper`,`tbpersona`.`codiper` AS `codiper`,`tbpersona`.`jurper` AS `jurper`,`tbpersona`.`nrodocper` AS `nrodocper`,`tbpersona`.`codempper` AS `codempper`,`tbpersona`.`rassocper` AS `rassocper`,`tbpersona`.`apaper` AS `apaper`,`tbpersona`.`amaper` AS `amaper`,`tbpersona`.`pnoper` AS `pnoper`,`tbpersona`.`snoper` AS `snoper`,`tbpersona`.`dirper` AS `dirper`,`tbpersona`.`telper` AS `telper`,`tbpersona`.`movper` AS `movper`,`tbpersona`.`maiper` AS `maiper`,`tbpersona`.`contper` AS `contper`,`tbpersona`.`estrgper` AS `estrgper`,`tbpersona`.`usucrper` AS `usucrper`,`tbpersona`.`fcrper` AS `fcrper`,`tbpersona`.`usumdper` AS `usumdper`,`tbpersona`.`fmdper` AS `fmdper` from `tbpersona` where ((`tbpersona`.`tipper` = '2') and (`tbpersona`.`estrgper` = 'A'));

-- --------------------------------------------------------

--
-- Estructura para la vista `vttipoflota`
--
DROP TABLE IF EXISTS `vttipoflota`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vttipoflota` AS select `tbmultitabla`.`codmlttb` AS `codmlttb`,`tbmultitabla`.`codimlttb` AS `codimlttb`,`tbmultitabla`.`nommlttb` AS `nommlttb`,`tbmultitabla`.`estrgmlttb` AS `estrgmlttb`,`tbmultitabla`.`usucrmlttb` AS `usucrmlttb`,`tbmultitabla`.`fcrmlttb` AS `fcrmlttb`,`tbmultitabla`.`usumdmlttb` AS `usumdmlttb`,`tbmultitabla`.`fmdmlttb` AS `fmdmlttb` from `tbmultitabla` where ((`tbmultitabla`.`codimlttb` = '11') and (`tbmultitabla`.`estrgmlttb` = 'A'));

-- --------------------------------------------------------

--
-- Estructura para la vista `vttipomovimientollanta`
--
DROP TABLE IF EXISTS `vttipomovimientollanta`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vttipomovimientollanta` AS select `tbmultitabla`.`codmlttb` AS `codmlttb`,`tbmultitabla`.`codimlttb` AS `codimlttb`,`tbmultitabla`.`nommlttb` AS `nommlttb`,`tbmultitabla`.`estrgmlttb` AS `estrgmlttb`,`tbmultitabla`.`usucrmlttb` AS `usucrmlttb`,`tbmultitabla`.`fcrmlttb` AS `fcrmlttb`,`tbmultitabla`.`usumdmlttb` AS `usumdmlttb`,`tbmultitabla`.`fmdmlttb` AS `fmdmlttb` from `tbmultitabla` where ((`tbmultitabla`.`codimlttb` = 29) and (`tbmultitabla`.`estrgmlttb` = 'A'));

-- --------------------------------------------------------

--
-- Estructura para la vista `vttipopersona`
--
DROP TABLE IF EXISTS `vttipopersona`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vttipopersona` AS select `tbmultitabla`.`codmlttb` AS `codmlttb`,`tbmultitabla`.`codimlttb` AS `codimlttb`,`tbmultitabla`.`nommlttb` AS `nommlttb`,`tbmultitabla`.`estrgmlttb` AS `estrgmlttb`,`tbmultitabla`.`usucrmlttb` AS `usucrmlttb`,`tbmultitabla`.`fcrmlttb` AS `fcrmlttb`,`tbmultitabla`.`usumdmlttb` AS `usumdmlttb`,`tbmultitabla`.`fmdmlttb` AS `fmdmlttb` from `tbmultitabla` where ((`tbmultitabla`.`codimlttb` = 8) and (`tbmultitabla`.`estrgmlttb` = 'A'));

-- --------------------------------------------------------

--
-- Estructura para la vista `vtusuario`
--
DROP TABLE IF EXISTS `vtusuario`;
-- en uso(#1356 - View 'bdgestionllanta.vtusuario' references invalid table(s) or column(s) or function(s) or definer/invoker of view lack rights to use them)

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbbajallanta`
--
ALTER TABLE `tbbajallanta`
  ADD CONSTRAINT `codibajlla` FOREIGN KEY (`codibajlla`) REFERENCES `tbllanta` (`codllan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbflota`
--
ALTER TABLE `tbflota`
  ADD CONSTRAINT `marflt` FOREIGN KEY (`marflt`) REFERENCES `tbmarca` (`codmar`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbflotadetalle`
--
ALTER TABLE `tbflotadetalle`
  ADD CONSTRAINT `codiflt` FOREIGN KEY (`codiflt`) REFERENCES `tbflota` (`codflt`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbllanta`
--
ALTER TABLE `tbllanta`
  ADD CONSTRAINT `codmarllan` FOREIGN KEY (`codmarllan`) REFERENCES `tbmarca` (`codmar`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbmovimiento`
--
ALTER TABLE `tbmovimiento`
  ADD CONSTRAINT `codlland` FOREIGN KEY (`codllanmovi`) REFERENCES `tbllanta` (`codllan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbremanente`
--
ALTER TABLE `tbremanente`
  ADD CONSTRAINT `codillanrem` FOREIGN KEY (`codillanrem`) REFERENCES `tbllanta` (`codllan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbrenovaciondetalle`
--
ALTER TABLE `tbrenovaciondetalle`
  ADD CONSTRAINT `codilland` FOREIGN KEY (`codilland`) REFERENCES `tbllanta` (`codllan`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `codirenod` FOREIGN KEY (`codirenod`) REFERENCES `tbrenovacion` (`codreno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
