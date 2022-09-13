-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-09-2022 a las 03:06:25
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
(1, '20220909174402', 'Esta es mi respuesta.....', 1, 'png', '20220909110142');

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
  `comentario` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitud_consulta`
--

INSERT INTO `solicitud_consulta` (`id`, `correo`, `apellido-p`, `apellido-m`, `nombre`, `calle`, `colonia`, `municipio`, `folio`, `extencion`, `adjunto`, `cuenta_predial`, `comentario`) VALUES
(2, 'dragodominguezfb@gmail.com', 'Dominguez', 'Ruiz', 'Serguei Drago', 'Cuahutemoc', 'Centro', 'Tepeapulco', '20220909174402', 'png', 1, 'C-31413', 'Espero que los datos sean suficientes'),
(3, 'mike@mail.com', 'Vera', 'D', 'Mike', 'ponce', 'Sidena', 'Tepeapulco', '20220909180728', 'pdf', 1, 'U-686', ''),
(4, 'sakfnadsn@fdsmaf.fsda', 'kn', 'jkn', 'kjn', 'jknjkn', 'jknkjn', 'jnjk', '20220909184125', 'png', 1, 'aknn', 'dsfksdmakfmdsakf');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `respuesta_consulta`
--
ALTER TABLE `respuesta_consulta`
  ADD PRIMARY KEY (`id_respuesta`);

--
-- Indices de la tabla `solicitud_consulta`
--
ALTER TABLE `solicitud_consulta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `respuesta_consulta`
--
ALTER TABLE `respuesta_consulta`
  MODIFY `id_respuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `solicitud_consulta`
--
ALTER TABLE `solicitud_consulta`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
