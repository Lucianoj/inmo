-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 08-10-2016 a las 17:33:03
-- Versión del servidor: 10.0.26-MariaDB-0+deb8u1
-- Versión de PHP: 5.6.24-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `inmobiliaria`
--
CREATE DATABASE IF NOT EXISTS `inmobiliaria` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `inmobiliaria`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aviso`
--

DROP TABLE IF EXISTS `aviso`;
CREATE TABLE IF NOT EXISTS `aviso` (
`id` bigint(19) NOT NULL,
  `tipo_aviso_id` smallint(5) NOT NULL,
  `estado_aviso_id` smallint(5) NOT NULL,
  `created_by` bigint(19) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `inmueble_id` bigint(19) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` bigint(19) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_aviso`
--

DROP TABLE IF EXISTS `estado_aviso`;
CREATE TABLE IF NOT EXISTS `estado_aviso` (
`id` smallint(5) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `valor` smallint(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estado_aviso`
--

INSERT INTO `estado_aviso` (`id`, `nombre`, `valor`) VALUES
(1, 'Habilitado', 10),
(2, 'Deshabilitado', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_imagen`
--

DROP TABLE IF EXISTS `estado_imagen`;
CREATE TABLE IF NOT EXISTS `estado_imagen` (
`id` smallint(5) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estado_imagen`
--

INSERT INTO `estado_imagen` (`id`, `nombre`) VALUES
(1, 'Habilitada'),
(2, 'Deshabilitada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_user`
--

DROP TABLE IF EXISTS `estado_user`;
CREATE TABLE IF NOT EXISTS `estado_user` (
`id` smallint(5) NOT NULL,
  `estado_nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `estado_valor` smallint(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estado_user`
--

INSERT INTO `estado_user` (`id`, `estado_nombre`, `estado_valor`) VALUES
(1, 'habilitado', 10),
(2, 'deshabilitado', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

DROP TABLE IF EXISTS `imagen`;
CREATE TABLE IF NOT EXISTS `imagen` (
`id` bigint(19) NOT NULL,
  `inmueble_id` bigint(19) NOT NULL,
  `estado_imagen_id` smallint(5) NOT NULL DEFAULT '1',
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ruta` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subtitulo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` bigint(19) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` bigint(19) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmueble`
--

DROP TABLE IF EXISTS `inmueble`;
CREATE TABLE IF NOT EXISTS `inmueble` (
`id` bigint(19) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `latitud` float DEFAULT NULL,
  `longitud` float DEFAULT NULL,
  `tipo_inmueble_id` smallint(5) NOT NULL,
  `direccion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad_habitaciones` tinyint(2) NOT NULL,
  `tiene_garage` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
`id` smallint(5) NOT NULL,
  `rol_nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `rol_valor` smallint(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `rol_nombre`, `rol_valor`) VALUES
(1, 'usuario', 10),
(2, 'admin', 20),
(3, 'root', 30),
(4, 'auditor', 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_aviso`
--

DROP TABLE IF EXISTS `tipo_aviso`;
CREATE TABLE IF NOT EXISTS `tipo_aviso` (
`id` smallint(5) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_inmueble`
--

DROP TABLE IF EXISTS `tipo_inmueble`;
CREATE TABLE IF NOT EXISTS `tipo_inmueble` (
`id` smallint(5) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_inmueble`
--

INSERT INTO `tipo_inmueble` (`id`, `nombre`) VALUES
(6, ''),
(2, 'Casa'),
(3, 'Chacra'),
(1, 'Departamento'),
(4, 'Propiedad Horizontal'),
(5, 'Terreno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
CREATE TABLE IF NOT EXISTS `tipo_usuario` (
`id` smallint(5) NOT NULL,
  `tipo_usuario_nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_usuario_valor` int(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `tipo_usuario_nombre`, `tipo_usuario_valor`) VALUES
(1, 'gratuito', 10),
(2, 'pago', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
`id` bigint(19) NOT NULL,
  `username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` int(10) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `rol_id` smallint(5) NOT NULL DEFAULT '1',
  `estado_user_id` smallint(5) NOT NULL DEFAULT '1',
  `tipo_usuario_id` smallint(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `telefono`, `email`, `auth_key`, `password_hash`, `password_reset_token`, `rol_id`, `estado_user_id`, `tipo_usuario_id`, `created_at`, `updated_at`) VALUES
(1, 'luciano', 155800069, 'jauregui79@gmail.com', 'kCai-5ckxMLzSmRrEQuAtdyAxbBTbdOr', '$2y$13$xVVTFRFwXvwd9EU0xIMsNePBrlRT.06RsXHCbaN6IHSloDXUGHvBy', NULL, 3, 1, 1, '2016-09-16 22:34:23', '2016-09-01 18:35:52');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aviso`
--
ALTER TABLE `aviso`
 ADD PRIMARY KEY (`id`), ADD KEY `FKaviso41529` (`created_by`), ADD KEY `FKaviso104635` (`updated_by`), ADD KEY `FKaviso500203` (`estado_aviso_id`), ADD KEY `FKaviso48388` (`tipo_aviso_id`), ADD KEY `FKaviso7154` (`inmueble_id`);

--
-- Indices de la tabla `estado_aviso`
--
ALTER TABLE `estado_aviso`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre` (`nombre`), ADD UNIQUE KEY `valor` (`valor`);

--
-- Indices de la tabla `estado_imagen`
--
ALTER TABLE `estado_imagen`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado_user`
--
ALTER TABLE `estado_user`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre` (`estado_nombre`), ADD UNIQUE KEY `valor` (`estado_valor`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
 ADD PRIMARY KEY (`id`), ADD KEY `FKimagen553718` (`inmueble_id`), ADD KEY `FKimagen588093` (`created_by`), ADD KEY `FKimagen558070` (`updated_by`), ADD KEY `FKimagen823804` (`estado_imagen_id`);

--
-- Indices de la tabla `inmueble`
--
ALTER TABLE `inmueble`
 ADD PRIMARY KEY (`id`), ADD KEY `FKinmueble42491` (`tipo_inmueble_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre` (`rol_nombre`), ADD UNIQUE KEY `valor` (`rol_valor`);

--
-- Indices de la tabla `tipo_aviso`
--
ALTER TABLE `tipo_aviso`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_inmueble`
--
ALTER TABLE `tipo_inmueble`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre` (`tipo_usuario_nombre`), ADD UNIQUE KEY `valor` (`tipo_usuario_valor`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD KEY `user_tiene_rol` (`rol_id`), ADD KEY `user_tiene_estado` (`estado_user_id`), ADD KEY `FKusuario679380` (`tipo_usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aviso`
--
ALTER TABLE `aviso`
MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `estado_aviso`
--
ALTER TABLE `estado_aviso`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `estado_imagen`
--
ALTER TABLE `estado_imagen`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `estado_user`
--
ALTER TABLE `estado_user`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `inmueble`
--
ALTER TABLE `inmueble`
MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `tipo_aviso`
--
ALTER TABLE `tipo_aviso`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `tipo_inmueble`
--
ALTER TABLE `tipo_inmueble`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
MODIFY `id` bigint(19) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aviso`
--
ALTER TABLE `aviso`
ADD CONSTRAINT `FKaviso104635` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`),
ADD CONSTRAINT `FKaviso41529` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
ADD CONSTRAINT `FKaviso48388` FOREIGN KEY (`tipo_aviso_id`) REFERENCES `tipo_aviso` (`id`),
ADD CONSTRAINT `FKaviso500203` FOREIGN KEY (`estado_aviso_id`) REFERENCES `estado_aviso` (`id`),
ADD CONSTRAINT `FKaviso7154` FOREIGN KEY (`inmueble_id`) REFERENCES `inmueble` (`id`);

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
ADD CONSTRAINT `FKimagen553718` FOREIGN KEY (`inmueble_id`) REFERENCES `inmueble` (`id`),
ADD CONSTRAINT `FKimagen558070` FOREIGN KEY (`updated_by`) REFERENCES `user` (`id`),
ADD CONSTRAINT `FKimagen588093` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`),
ADD CONSTRAINT `FKimagen823804` FOREIGN KEY (`estado_imagen_id`) REFERENCES `estado_imagen` (`id`);

--
-- Filtros para la tabla `inmueble`
--
ALTER TABLE `inmueble`
ADD CONSTRAINT `FKinmueble42491` FOREIGN KEY (`tipo_inmueble_id`) REFERENCES `tipo_inmueble` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `FKusuario679380` FOREIGN KEY (`tipo_usuario_id`) REFERENCES `tipo_usuario` (`id`),
ADD CONSTRAINT `user_tiene_estado` FOREIGN KEY (`estado_user_id`) REFERENCES `estado_user` (`id`),
ADD CONSTRAINT `user_tiene_rol` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
