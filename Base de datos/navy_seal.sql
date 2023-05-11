-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-03-2021 a las 17:41:15
-- Versión del servidor: 5.6.17-log
-- Versión de PHP: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `navy seal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE IF NOT EXISTS `administradores` (
  `idAdministrador` int(11) NOT NULL AUTO_INCREMENT,
  `nombreAdmin` varchar(60) NOT NULL,
  `apellidosAdmin` varchar(60) NOT NULL,
  `cargo` varchar(20) NOT NULL,
  `nickAdmin` varchar(50) NOT NULL,
  `passwordAdmin` varchar(150) NOT NULL,
  `privilegiosAdmin` tinyint(4) NOT NULL,
  PRIMARY KEY (`idAdministrador`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`idAdministrador`, `nombreAdmin`, `apellidosAdmin`, `cargo`, `nickAdmin`, `passwordAdmin`, `privilegiosAdmin`) VALUES
(1, 'Super', 'Administrador', 'TI', 'SNSADMIN01', '12345', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombreC` varchar(100) NOT NULL,
  `rSocial` varchar(100) NOT NULL,
  `tipo` varchar(8) NOT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinas`
--

CREATE TABLE IF NOT EXISTS `maquinas` (
  `idMaquina` int(11) NOT NULL AUTO_INCREMENT,
  `maquina` varchar(20) NOT NULL,
  `modelo` varchar(20) NOT NULL,
  `estadoM` int(11) NOT NULL,
  `sistemasT` varchar(50) NOT NULL,
  PRIMARY KEY (`idMaquina`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE IF NOT EXISTS `materiales` (
  `idMaterial` int(11) NOT NULL AUTO_INCREMENT,
  `material` varchar(40) NOT NULL,
  `torcion` varchar(40) NOT NULL,
  `calibre` varchar(40) NOT NULL,
  `cantidad` int(11) NOT NULL,
  PRIMARY KEY (`idMaterial`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
--

CREATE TABLE IF NOT EXISTS `modelos` (
  `idModelo` int(11) NOT NULL AUTO_INCREMENT,
  `imgModelo` varchar(150) NOT NULL,
  `modelo` varchar(60) NOT NULL,
  `talla` varchar(20) NOT NULL,
  `materiales` varchar(250) NOT NULL,
  `guiaHilo` varchar(150) NOT NULL,
  `sistemasN` varchar(150) NOT NULL,
  `codigo` varchar(15) NOT NULL,
  PRIMARY KEY (`idModelo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operadores`
--

CREATE TABLE IF NOT EXISTS `operadores` (
  `idOperador` int(11) NOT NULL AUTO_INCREMENT,
  `nombreOperador` varchar(60) NOT NULL,
  `apellidosOperador` varchar(60) NOT NULL,
  `turnoOperador` varchar(20) NOT NULL,
  `nickOperador` varchar(40) NOT NULL,
  `passwordOperador` varchar(150) NOT NULL,
  `privilegiosOperador` tinyint(4) NOT NULL DEFAULT '4',
  PRIMARY KEY (`idOperador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `idPedido` int(11) NOT NULL AUTO_INCREMENT,
  `idModelo` int(11) NOT NULL,
  `IdCliente` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `anchoI` varchar(15) NOT NULL,
  `largoI` varchar(15) NOT NULL,
  `estatusA` tinyint(4) NOT NULL,
  `estatusB` tinyint(4) NOT NULL,
  `estadoPedido` tinyint(4) NOT NULL,
  PRIMARY KEY (`idPedido`),
  KEY `IdModelo` (`idModelo`,`IdCliente`),
  KEY `IdModelo_2` (`idModelo`),
  KEY `IdCliente` (`IdCliente`),
  KEY `idModelo_3` (`idModelo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
  `idProducto` int(11) NOT NULL AUTO_INCREMENT,
  `idPedido` int(11) NOT NULL,
  `idMaquina` int(11) NOT NULL,
  `idOperador` int(11) NOT NULL,
  `folio` int(100) NOT NULL,
  `fechas` varchar(100) NOT NULL,
  `lotes` varchar(100) NOT NULL,
  `piezas` varchar(100) NOT NULL,
  `acumulado` int(100) NOT NULL,
  `observaciones` varchar(200) NOT NULL,
  `TPP` varchar(20) NOT NULL,
  `TOPP` varchar(20) NOT NULL,
  `operadores` varchar(200) NOT NULL,
  `turnos` varchar(200) NOT NULL,
  `anchoH` varchar(20) NOT NULL,
  `largoH` varchar(20) NOT NULL,
  PRIMARY KEY (`idProducto`),
  KEY `idPedido` (`idPedido`),
  KEY `idMaquina` (`idMaquina`),
  KEY `idOperador` (`idOperador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`idModelo`) REFERENCES `modelos` (`idModelo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_ibfk_4` FOREIGN KEY (`IdCliente`) REFERENCES `clientes` (`idCliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idPedido`) REFERENCES `pedidos` (`idPedido`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`idMaquina`) REFERENCES `maquinas` (`idMaquina`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_ibfk_3` FOREIGN KEY (`idOperador`) REFERENCES `operadores` (`idOperador`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
