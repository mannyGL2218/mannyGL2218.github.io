-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-01-2023 a las 13:19:17
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `idProducto` int(11) NOT NULL,
  `nombreProducto` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cantidadPorCaja` int(11) NOT NULL,
  `numCajasExisten` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`idProducto`, `nombreProducto`, `cantidadPorCaja`, `numCajasExisten`) VALUES
(1, 'Galletas María', 9, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `idFactura` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `rfc` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `correo` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `idVenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`idFactura`, `nombre`, `direccion`, `telefono`, `rfc`, `correo`, `idVenta`) VALUES
(1, 'Juan', 'casa', '55', 'pan', 'si@gmail.com', 1),
(2, 'juan', 'casa', '55', 'asd', 'si@gmail.com', 2),
(3, '1', '1', '1', '1', '1@1', 3),
(4, '2', '2', '2', '2', '2@2.com', 11),
(5, '2', '2', '2', '2', '2@2.com', 13),
(6, '2', '2', '2', '2', '2@2.com', 14),
(7, '2', '2', '2', '2', '2@2.com', 15),
(8, '2', '2', '2', '2', '2@2.com', 16),
(9, '2', '2', '2', '2', '2@2.com', 17),
(10, 'q', 'q', '1', 'q', 'q@q.com', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idProducto` int(11) NOT NULL,
  `nombreProducto` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `existenciasxCaja` int(11) NOT NULL,
  `productosxCaja` int(11) NOT NULL,
  `precio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idProducto`, `nombreProducto`, `existenciasxCaja`, `productosxCaja`, `precio`) VALUES
(1, 'Galletas María', 24, 9, 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productovendido`
--

CREATE TABLE `productovendido` (
  `idVendido` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idVenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `productovendido`
--

INSERT INTO `productovendido` (`idVendido`, `idProducto`, `cantidad`, `idVenta`) VALUES
(1, 1, 5, 1),
(2, 1, 5, 2),
(3, 1, 1, 3),
(4, 1, 1, 14),
(5, 1, 1, 15),
(6, 1, 1, 16),
(7, 1, 1, 17),
(8, 1, 1, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudtransferencia`
--

CREATE TABLE `solicitudtransferencia` (
  `idSolicitud` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidadcajas` int(11) NOT NULL,
  `estado` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `solicitudtransferencia`
--

INSERT INTO `solicitudtransferencia` (`idSolicitud`, `fecha`, `idProducto`, `cantidadcajas`, `estado`) VALUES
(6, '2023-01-09', 1, 1, 'Pendiente'),
(7, '2023-01-09', 1, 5, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transferencias`
--

CREATE TABLE `transferencias` (
  `idTransferencia` int(11) NOT NULL,
  `fechaTransferencia` date NOT NULL,
  `idSolicitud` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `usuario` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `contrasena` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `rol` varchar(45) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `usuario`, `contrasena`, `fecha`, `rol`) VALUES
(1, 'jonh', 'manny', '2023-01-06', 'Supervisor'),
(2, 'vendedor', 'vendedor', '2023-01-06', 'Vendedor'),
(3, 'supervisor', 'supervisor', '2023-01-06', 'Supervisor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idVenta` int(11) NOT NULL,
  `subTotal` int(20) NOT NULL,
  `total` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`idVenta`, `subTotal`, `total`) VALUES
(1, 225, 225),
(2, 225, 225),
(3, 45, 45),
(4, 45, 45),
(5, 45, 45),
(6, 45, 45),
(7, 45, 45),
(8, 45, 45),
(9, 45, 45),
(10, 45, 45),
(11, 45, 45),
(12, 45, 45),
(13, 45, 45),
(14, 45, 45),
(15, 45, 45),
(16, 45, 45),
(17, 45, 45),
(18, 45, 45);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `idVenta` (`idVenta`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idProducto`);

--
-- Indices de la tabla `productovendido`
--
ALTER TABLE `productovendido`
  ADD PRIMARY KEY (`idVendido`),
  ADD KEY `idProducto` (`idProducto`,`idVenta`),
  ADD KEY `idVenta` (`idVenta`);

--
-- Indices de la tabla `solicitudtransferencia`
--
ALTER TABLE `solicitudtransferencia`
  ADD PRIMARY KEY (`idSolicitud`),
  ADD KEY `idproducto` (`idProducto`);

--
-- Indices de la tabla `transferencias`
--
ALTER TABLE `transferencias`
  ADD PRIMARY KEY (`idTransferencia`),
  ADD KEY `idSolicitud` (`idSolicitud`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idVenta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `idFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idProducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productovendido`
--
ALTER TABLE `productovendido`
  MODIFY `idVendido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `solicitudtransferencia`
--
ALTER TABLE `solicitudtransferencia`
  MODIFY `idSolicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `transferencias`
--
ALTER TABLE `transferencias`
  MODIFY `idTransferencia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`idVenta`) REFERENCES `venta` (`idVenta`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `productovendido`
--
ALTER TABLE `productovendido`
  ADD CONSTRAINT `productovendido_ibfk_1` FOREIGN KEY (`idProducto`) REFERENCES `producto` (`idProducto`) ON UPDATE CASCADE,
  ADD CONSTRAINT `productovendido_ibfk_2` FOREIGN KEY (`idVenta`) REFERENCES `venta` (`idVenta`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitudtransferencia`
--
ALTER TABLE `solicitudtransferencia`
  ADD CONSTRAINT `solicitudtransferencia_ibfk_2` FOREIGN KEY (`idProducto`) REFERENCES `almacen` (`idProducto`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
