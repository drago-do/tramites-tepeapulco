-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-09-2022 a las 18:27:51
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `predial`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta_consulta`
--

CREATE TABLE `respuesta_consulta` (
  `id_respuesta` int(11) NOT NULL,
  `folio_de_consulta` varchar(18) NOT NULL,
  `respuesta` varchar(500) NOT NULL,
  `adjunto` tinyint(1) NOT NULL,
  `extension` varchar(4) NOT NULL,
  `folio_archivo_adjunto` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `respuesta_consulta`
--

INSERT INTO `respuesta_consulta` (`id_respuesta`, `folio_de_consulta`, `respuesta`, `adjunto`, `extension`, `folio_archivo_adjunto`) VALUES
(1, '20220914180216', '8000000', 0, '', '20220914111141'),
(2, '20220914180411', '900000', 0, '', '20220914111224'),
(3, '20220914180411', 'aqui esta tu factura', 0, '', '20220914111433'),
(4, '20220914182221', 'Debes $5000', 1, 'png', '20220914112502');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuesta_pago`
--

CREATE TABLE `respuesta_pago` (
  `id_respuesta` int(11) NOT NULL,
  `folio_de_consulta` varchar(18) NOT NULL,
  `respuesta` varchar(500) NOT NULL,
  `adjunto` tinyint(1) NOT NULL,
  `extension` varchar(4) NOT NULL,
  `folio_archivo_adjunto` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_consulta`
--

CREATE TABLE `solicitud_consulta` (
  `id` int(20) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `apellido-p` varchar(100) NOT NULL,
  `apellido-m` varchar(100) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `calle` varchar(100) NOT NULL,
  `colonia` varchar(100) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `folio` varchar(18) NOT NULL,
  `extencion` varchar(5) NOT NULL,
  `adjunto` tinyint(1) NOT NULL,
  `cuenta_predial` varchar(50) NOT NULL,
  `comentario` varchar(500) NOT NULL,
  `respuesta_enviada` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitud_consulta`
--

INSERT INTO `solicitud_consulta` (`id`, `correo`, `apellido-p`, `apellido-m`, `nombre`, `calle`, `colonia`, `municipio`, `folio`, `extencion`, `adjunto`, `cuenta_predial`, `comentario`, `respuesta_enviada`) VALUES
(1, 'mike@mail.com', 'Vera', 'd', 'mike', 'ponce', 'Sidena', 'Tepeapulco', '20220914180216', '', 0, 'U-686', 'GFH', 1),
(2, 'mike@mail.com', 'Vera', 'd', 'Mike', 'ponce', 'Centro', 't', '20220914180411', '', 0, 'u97879', 'jhj', 1),
(3, 'dragodominguezfb@gmail.com', 'Dominguez', 'Ruiz', 'Serguei Drago', 'Centro', 'Centro', 'Tepeapulco', '20220914182221', 'png', 1, 'CT-32194', 'Hola', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_pago`
--

CREATE TABLE `solicitud_pago` (
  `id_pago` int(50) NOT NULL,
  `folio_a_pagar` varchar(50) NOT NULL,
  `nombre_comprobante` varchar(50) NOT NULL,
  `extencion` varchar(50) NOT NULL,
  `pago_validado` tinyint(1) NOT NULL,
  `mensaje` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitud_pago`
--

INSERT INTO `solicitud_pago` (`id_pago`, `folio_a_pagar`, `nombre_comprobante`, `extencion`, `pago_validado`, `mensaje`) VALUES
(1, '20220914180411', '14111331', 'png', 0, 'ahora si pague');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `respuesta_consulta`
--
ALTER TABLE `respuesta_consulta`
  ADD PRIMARY KEY (`id_respuesta`);

--
-- Indices de la tabla `respuesta_pago`
--
ALTER TABLE `respuesta_pago`
  ADD PRIMARY KEY (`id_respuesta`);

--
-- Indices de la tabla `solicitud_consulta`
--
ALTER TABLE `solicitud_consulta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud_pago`
--
ALTER TABLE `solicitud_pago`
  ADD PRIMARY KEY (`id_pago`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `respuesta_consulta`
--
ALTER TABLE `respuesta_consulta`
  MODIFY `id_respuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `respuesta_pago`
--
ALTER TABLE `respuesta_pago`
  MODIFY `id_respuesta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_consulta`
--
ALTER TABLE `solicitud_consulta`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitud_pago`
--
ALTER TABLE `solicitud_pago`
  MODIFY `id_pago` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
