-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-10-2025 a las 20:20:51
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdsistema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tcliente`
--

CREATE TABLE `tcliente` (
  `idC` int(11) NOT NULL,
  `dni` char(8) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tcliente`
--

INSERT INTO `tcliente` (`idC`, `dni`, `nombre`, `correo`, `telefono`) VALUES
(1, '73621913', 'Jhonathan Prado', 'jpradoti@ucvvirtual.edu.pe', '924163796'),
(2, '60750468', 'Camila Espinoza', 'cespinozaan@ucvvirtual.edu.pe', '922145915'),
(3, '72738709', 'Joaquin Salgado', 'josalgadohi@ucvvirtual.edu.pe', '993910245'),
(4, '73118185', 'Juan Pablo Sanchez', 'jsanchezcahl@ucvvirtual.edu.pe', '992385373'),
(5, '72895897', 'Daniela Viclhez', 'dvilchezca@ucvvirtual.edu.pe', '997402024');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `treclamo`
--

CREATE TABLE `treclamo` (
  `idreclamo` int(11) NOT NULL,
  `dni_cliente` char(8) NOT NULL,
  `codigo_soli` char(4) NOT NULL,
  `descripcionR` text NOT NULL,
  `fecha_reclamo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `treclamo`
--

INSERT INTO `treclamo` (`idreclamo`, `dni_cliente`, `codigo_soli`, `descripcionR`, `fecha_reclamo`) VALUES
(1, '72895897', '0001', 'La tela llego en mal estado.', '2025-07-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `treporte`
--

CREATE TABLE `treporte` (
  `idR` int(11) NOT NULL,
  `codigoR` char(4) NOT NULL,
  `estadoR` varchar(20) NOT NULL,
  `observacion` text NOT NULL,
  `fecha_seguimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `treporte`
--

INSERT INTO `treporte` (`idR`, `codigoR`, `estadoR`, `observacion`, `fecha_seguimiento`) VALUES
(1, '0001', 'Almacenado', 'La solicitud esta en almacen para que el cliente lo recoja.', '2025-07-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tsolicitudes`
--

CREATE TABLE `tsolicitudes` (
  `idS` int(11) NOT NULL,
  `codigo` char(4) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_registro` date NOT NULL,
  `estado` varchar(20) NOT NULL,
  `cliente_dni` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tsolicitudes`
--

INSERT INTO `tsolicitudes` (`idS`, `codigo`, `descripcion`, `fecha_registro`, `estado`, `cliente_dni`) VALUES
(1, '0001', 'Tela seda para el dia de mañana.', '2025-07-14', 'En Proceso', '72895897');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tusers`
--

CREATE TABLE `tusers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tusers`
--

INSERT INTO `tusers` (`id`, `username`, `password`, `rol`) VALUES
(1, 'admin', '151123', 'Admin'),
(3, 'super123', '123456', 'Supervision');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tcliente`
--
ALTER TABLE `tcliente`
  ADD PRIMARY KEY (`idC`);

--
-- Indices de la tabla `treclamo`
--
ALTER TABLE `treclamo`
  ADD PRIMARY KEY (`idreclamo`);

--
-- Indices de la tabla `treporte`
--
ALTER TABLE `treporte`
  ADD PRIMARY KEY (`idR`);

--
-- Indices de la tabla `tsolicitudes`
--
ALTER TABLE `tsolicitudes`
  ADD PRIMARY KEY (`idS`);

--
-- Indices de la tabla `tusers`
--
ALTER TABLE `tusers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tcliente`
--
ALTER TABLE `tcliente`
  MODIFY `idC` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `treclamo`
--
ALTER TABLE `treclamo`
  MODIFY `idreclamo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `treporte`
--
ALTER TABLE `treporte`
  MODIFY `idR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tsolicitudes`
--
ALTER TABLE `tsolicitudes`
  MODIFY `idS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tusers`
--
ALTER TABLE `tusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
