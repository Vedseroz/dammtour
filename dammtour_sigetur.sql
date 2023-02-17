-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220707.a5d60f5698
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 17-02-2023 a las 04:44:37
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.0.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dammtour_sigetur`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chofer`
--

CREATE TABLE `chofer` (
  `id_chofer` bigint(20) UNSIGNED NOT NULL,
  `nombre_chofer` text DEFAULT NULL,
  `apellido_chofer` text DEFAULT NULL,
  `rut_chofer` text DEFAULT NULL,
  `telefono_chofer` text DEFAULT '\'0\'',
  `direccion_chofer` text DEFAULT '\'no especificado\''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `chofer`
--

INSERT INTO `chofer` (`id_chofer`, `nombre_chofer`, `apellido_chofer`, `rut_chofer`, `telefono_chofer`, `direccion_chofer`) VALUES
(1, 'Rodrigo Esteban', 'Mesa Barrios', '23452344542', '983648236', 'avda. Peru #1234'),
(4, 'Nombre de prueba', 'Apellido de prueba', '199237847', '987648737', 'Avda Siempre Viva 4334');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costo`
--

CREATE TABLE `costo` (
  `id_costo` int(11) NOT NULL,
  `costo_total` varchar(100) DEFAULT NULL,
  `pagado_damm` varchar(20) DEFAULT NULL,
  `pagado_i4` varchar(20) DEFAULT NULL,
  `enviado_i4` varchar(20) DEFAULT NULL,
  `recibido_i4` varchar(20) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `costo`
--

INSERT INTO `costo` (`id_costo`, `costo_total`, `pagado_damm`, `pagado_i4`, `enviado_i4`, `recibido_i4`, `estado_id`) VALUES
(10, '450', '405', '45', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_costo`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `datos_costo` (
`post_content` longtext
,`pasajero_id` int(11)
,`costo_id` int(11)
,`costo_total` varchar(100)
,`pagado_damm` varchar(20)
,`pagado_i4` varchar(20)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_hospedaje`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `datos_hospedaje` (
`fechallegada` date
,`horallegada` time
,`fechasalida` date
,`horasalida` time
,`pasajero_id` int(11)
,`hospedaje_id` int(11)
,`nombre_hospedaje` varchar(45)
,`pais` text
,`ciudad` text
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_pasajeros`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `datos_pasajeros` (
`ID` bigint(20) unsigned
,`post_content` longtext
,`id_pasajero` int(11)
,`estado` int(11)
,`costo_id` int(11)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_tour`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `datos_tour` (
`fechallegada` date
,`horallegada` time
,`fechasalida` date
,`horasalida` time
,`pasajero_id` int(11)
,`tour_id` int(11)
,`nombre_tour` varchar(100)
,`pais` text
,`ciudad` text
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `datos_transfer`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `datos_transfer` (
`id_transfer` int(11)
,`cant_adultos` int(11)
,`cant_ninos` int(11)
,`cant_maletas` int(11)
,`chofer_id` int(11)
,`vehiculo_id` int(11)
,`id_pasajero_transfer` int(11)
,`pasajero_id` int(11)
,`transfer_id` int(11)
,`fechallegada` date
,`horallegada` time
,`fechasalida` date
,`horasalida` time
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `estado_pasajeros`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `estado_pasajeros` (
`id_pasajero` int(11)
,`pasajero_id` int(11)
,`estado` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fecha`
--

CREATE TABLE `fecha` (
  `id_fecha` int(11) NOT NULL,
  `fechallegada` date DEFAULT NULL,
  `horallegada` time DEFAULT NULL,
  `fechasalida` date DEFAULT NULL,
  `horasalida` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `fecha`
--

INSERT INTO `fecha` (`id_fecha`, `fechallegada`, `horallegada`, `fechasalida`, `horasalida`) VALUES
(1, '2021-11-22', '15:30:00', '2021-11-27', '16:30:00'),
(8, '2022-05-25', '23:20:00', '2022-05-28', '00:21:00'),
(10, '2022-09-15', '20:42:00', '2022-09-30', '20:42:00'),
(11, '2022-06-18', '23:11:00', '2022-07-02', '01:14:00'),
(12, '2022-10-15', '18:37:00', '2022-10-20', '19:40:00'),
(13, '2022-10-15', '20:34:00', '2022-10-17', '23:38:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hospedaje`
--

CREATE TABLE `hospedaje` (
  `id_hospedaje` int(11) NOT NULL,
  `nombre_hospedaje` varchar(45) DEFAULT NULL,
  `localidad_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `hospedaje`
--

INSERT INTO `hospedaje` (`id_hospedaje`, `nombre_hospedaje`, `localidad_id`) VALUES
(7, 'AMANCAY', 2),
(8, 'COSTA DO SOL', 2),
(9, 'MIRATLANTICO', 2);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `hospedaje_localidad`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `hospedaje_localidad` (
`id_hospedaje` int(11)
,`nombre_hospedaje` varchar(45)
,`pais` text
,`ciudad` text
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `localidad`
--

CREATE TABLE `localidad` (
  `id_localidad` int(11) NOT NULL,
  `pais` text DEFAULT NULL,
  `ciudad` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `localidad`
--

INSERT INTO `localidad` (`id_localidad`, `pais`, `ciudad`) VALUES
(1, 'BRASIL', 'ARRAIAL DO CABO'),
(2, 'BRASIL', 'BUZIOS'),
(3, 'BRASIL', 'ISLA GRANDE'),
(4, 'BRASIL', 'RIO DE JANEIRO'),
(5, 'CHILE', 'VIÑA DEL MAR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasajero`
--

CREATE TABLE `pasajero` (
  `id_pasajero` int(11) NOT NULL,
  `estado` int(11) DEFAULT 0,
  `costo_id` int(11) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `hospedaje_id` int(11) DEFAULT NULL,
  `fecha_id` int(11) DEFAULT NULL,
  `pasajero_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pasajero`
--

INSERT INTO `pasajero` (`id_pasajero`, `estado`, `costo_id`, `estado_id`, `hospedaje_id`, `fecha_id`, `pasajero_id`) VALUES
(42, 0, NULL, NULL, NULL, NULL, 40),
(43, 0, NULL, NULL, NULL, NULL, 42),
(68, 1, 10, NULL, NULL, NULL, 44);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasajero_hospedaje`
--

CREATE TABLE `pasajero_hospedaje` (
  `id_pasajero_hospedaje` int(11) NOT NULL,
  `fechallegada` date DEFAULT NULL,
  `horallegada` time DEFAULT NULL,
  `fechasalida` date DEFAULT NULL,
  `horasalida` time DEFAULT NULL,
  `pasajero_id` int(11) DEFAULT NULL,
  `hospedaje_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pasajero_hospedaje`
--

INSERT INTO `pasajero_hospedaje` (`id_pasajero_hospedaje`, `fechallegada`, `horallegada`, `fechasalida`, `horasalida`, `pasajero_id`, `hospedaje_id`) VALUES
(3, '2023-02-15', '01:31:00', '2023-02-21', '01:32:00', 44, 9),
(4, '2023-02-16', '02:36:00', '2023-02-16', '18:37:00', 42, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasajero_tour`
--

CREATE TABLE `pasajero_tour` (
  `id_pasajero_tour` int(11) NOT NULL,
  `fechallegada` date NOT NULL,
  `horallegada` time NOT NULL,
  `fechasalida` date NOT NULL,
  `horasalida` time NOT NULL,
  `pasajero_id` int(11) DEFAULT NULL,
  `tour_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pasajero_tour`
--

INSERT INTO `pasajero_tour` (`id_pasajero_tour`, `fechallegada`, `horallegada`, `fechasalida`, `horasalida`, `pasajero_id`, `tour_id`) VALUES
(1, '2023-02-16', '00:29:00', '2023-03-01', '02:31:00', 44, 1),
(3, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 44, NULL),
(4, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 44, NULL),
(5, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 44, NULL),
(6, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 44, NULL),
(7, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 44, NULL),
(8, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 44, NULL),
(9, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 44, NULL),
(10, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 44, NULL),
(11, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 44, NULL),
(12, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 44, NULL),
(13, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 44, NULL),
(14, '0000-00-00', '00:00:00', '0000-00-00', '00:00:00', 44, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasajero_transfer`
--

CREATE TABLE `pasajero_transfer` (
  `id_pasajero_transfer` int(11) NOT NULL,
  `pasajero_id` int(11) DEFAULT NULL,
  `transfer_id` int(11) DEFAULT NULL,
  `fechallegada` date DEFAULT NULL,
  `horallegada` time DEFAULT NULL,
  `fechasalida` date DEFAULT NULL,
  `horasalida` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pasajero_transfer`
--

INSERT INTO `pasajero_transfer` (`id_pasajero_transfer`, `pasajero_id`, `transfer_id`, `fechallegada`, `horallegada`, `fechasalida`, `horasalida`) VALUES
(6, 44, 24, '2023-01-31', '18:10:00', '2023-02-03', '19:11:00'),
(7, 44, 25, '2023-02-02', '19:14:00', '2023-02-03', '19:18:00'),
(15, 44, 33, '2023-02-17', '18:37:00', '2023-02-17', '20:39:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tour`
--

CREATE TABLE `tour` (
  `id_tour` int(11) NOT NULL,
  `localidad_id` int(11) DEFAULT NULL,
  `nombre_tour` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tour`
--

INSERT INTO `tour` (`id_tour`, `localidad_id`, `nombre_tour`) VALUES
(1, 4, 'CITY TOUR RIO DE JANEIRO'),
(2, 1, 'EXCURSION ARRAIAL DO CABO'),
(3, 2, 'EXCURSION BUZIOS'),
(4, 3, 'EXCURSION ISLA GRANDE');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `tour_localidad`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `tour_localidad` (
`id_tour` int(11)
,`nombre_tour` varchar(100)
,`pais` text
,`ciudad` text
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transfer`
--

CREATE TABLE `transfer` (
  `id_transfer` int(11) NOT NULL,
  `cant_adultos` int(11) DEFAULT NULL,
  `cant_ninos` int(11) DEFAULT NULL,
  `cant_maletas` int(11) DEFAULT NULL,
  `chofer_id` int(11) DEFAULT NULL,
  `vehiculo_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `transfer`
--

INSERT INTO `transfer` (`id_transfer`, `cant_adultos`, `cant_ninos`, `cant_maletas`, `chofer_id`, `vehiculo_id`) VALUES
(21, 2, 2, 4, NULL, NULL),
(22, 2, 2, 2, NULL, NULL),
(23, 3, 4, 5, NULL, NULL),
(24, 3, 4, 5, NULL, NULL),
(25, 3, 4, 4, NULL, NULL),
(26, 0, 0, 0, NULL, NULL),
(27, 0, 0, 0, NULL, NULL),
(28, 0, 0, 0, NULL, NULL),
(29, NULL, NULL, NULL, NULL, NULL),
(30, NULL, NULL, NULL, NULL, NULL),
(31, NULL, NULL, NULL, NULL, NULL),
(32, NULL, NULL, NULL, NULL, NULL),
(33, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$10$ls9Fii3Suh15DLpP4uxF/ubTXSKd431iFzbW65bc3fSUoTnNifJ8i', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1676594025, 1, 'Admin', 'istrator', 'ADMIN', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`) VALUES
(4, 'correo@correo.com', '$2y$10$hTmrtz47NzQI5EQyW96jMengRqnPSCKMaDzfcrbYV3F8Qmq47YIGa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `id_vehiculo` bigint(20) UNSIGNED NOT NULL,
  `marca` text DEFAULT NULL,
  `modelo` text DEFAULT NULL,
  `tipo` text DEFAULT NULL,
  `patente` text DEFAULT NULL,
  `cant_pasajeros` int(11) DEFAULT 0,
  `estado` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`id_vehiculo`, `marca`, `modelo`, `tipo`, `patente`, `cant_pasajeros`, `estado`) VALUES
(3, 'Nissan', 'V16', 'Sedan', 'TK9798', 2, 1),
(4, 'Nissan', 'V16', 'Van', 'TK9798', 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `voucher`
--

CREATE TABLE `voucher` (
  `id_voucher` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `origen` text DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `destino` text DEFAULT NULL,
  `hora_finalizacion` time DEFAULT NULL,
  `detalles` text DEFAULT NULL,
  `pasajero_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `voucher`
--

INSERT INTO `voucher` (`id_voucher`, `fecha`, `origen`, `hora_inicio`, `destino`, `hora_finalizacion`, `detalles`, `pasajero_id`) VALUES
(1, '2022-12-20', 'Arad', '19:42:00', 'oradea', '21:45:00', 'aaaaa', 18),
(2, '2022-12-22', 'Hotel A', '09:15:00', 'Tour A', '20:30:00', 'Observacion cambiada', 18),
(3, '2022-12-21', 'Aeropuerto de Santiago', '00:00:00', 'Hotel B', '01:25:00', 'El pasajero tiene problemas con los pasajes', 31);

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_costo`
--
DROP TABLE IF EXISTS `datos_costo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `datos_costo`  AS SELECT `dammtour_wp75`.`wp5g_posts`.`post_content` AS `post_content`, `pasajero`.`pasajero_id` AS `pasajero_id`, `pasajero`.`costo_id` AS `costo_id`, `costo`.`costo_total` AS `costo_total`, `costo`.`pagado_damm` AS `pagado_damm`, `costo`.`pagado_i4` AS `pagado_i4` FROM ((`dammtour_wp75`.`wp5g_posts` join `pasajero` on(`pasajero`.`pasajero_id` = `dammtour_wp75`.`wp5g_posts`.`ID`)) join `costo` on(`costo`.`id_costo` = `pasajero`.`costo_id`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_hospedaje`
--
DROP TABLE IF EXISTS `datos_hospedaje`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `datos_hospedaje`  AS SELECT `pasajero_hospedaje`.`fechallegada` AS `fechallegada`, `pasajero_hospedaje`.`horallegada` AS `horallegada`, `pasajero_hospedaje`.`fechasalida` AS `fechasalida`, `pasajero_hospedaje`.`horasalida` AS `horasalida`, `pasajero_hospedaje`.`pasajero_id` AS `pasajero_id`, `pasajero_hospedaje`.`hospedaje_id` AS `hospedaje_id`, `hospedaje`.`nombre_hospedaje` AS `nombre_hospedaje`, `localidad`.`pais` AS `pais`, `localidad`.`ciudad` AS `ciudad` FROM ((`pasajero_hospedaje` join `hospedaje` on(`hospedaje`.`id_hospedaje` = `pasajero_hospedaje`.`hospedaje_id`)) join `localidad` on(`localidad`.`id_localidad` = `hospedaje`.`localidad_id`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_pasajeros`
--
DROP TABLE IF EXISTS `datos_pasajeros`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `datos_pasajeros`  AS SELECT `dammtour_wp75`.`wp5g_posts`.`ID` AS `ID`, `dammtour_wp75`.`wp5g_posts`.`post_content` AS `post_content`, `pasajero`.`id_pasajero` AS `id_pasajero`, `pasajero`.`estado` AS `estado`, `pasajero`.`costo_id` AS `costo_id` FROM (`dammtour_wp75`.`wp5g_posts` join `pasajero` on(`pasajero`.`pasajero_id` = `dammtour_wp75`.`wp5g_posts`.`ID`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_tour`
--
DROP TABLE IF EXISTS `datos_tour`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `datos_tour`  AS SELECT `pasajero_tour`.`fechallegada` AS `fechallegada`, `pasajero_tour`.`horallegada` AS `horallegada`, `pasajero_tour`.`fechasalida` AS `fechasalida`, `pasajero_tour`.`horasalida` AS `horasalida`, `pasajero_tour`.`pasajero_id` AS `pasajero_id`, `pasajero_tour`.`tour_id` AS `tour_id`, `tour`.`nombre_tour` AS `nombre_tour`, `localidad`.`pais` AS `pais`, `localidad`.`ciudad` AS `ciudad` FROM ((`pasajero_tour` join `tour` on(`tour`.`id_tour` = `pasajero_tour`.`tour_id`)) join `localidad` on(`localidad`.`id_localidad` = `tour`.`localidad_id`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `datos_transfer`
--
DROP TABLE IF EXISTS `datos_transfer`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `datos_transfer`  AS SELECT `transfer`.`id_transfer` AS `id_transfer`, `transfer`.`cant_adultos` AS `cant_adultos`, `transfer`.`cant_ninos` AS `cant_ninos`, `transfer`.`cant_maletas` AS `cant_maletas`, `transfer`.`chofer_id` AS `chofer_id`, `transfer`.`vehiculo_id` AS `vehiculo_id`, `pasajero_transfer`.`id_pasajero_transfer` AS `id_pasajero_transfer`, `pasajero_transfer`.`pasajero_id` AS `pasajero_id`, `pasajero_transfer`.`transfer_id` AS `transfer_id`, `pasajero_transfer`.`fechallegada` AS `fechallegada`, `pasajero_transfer`.`horallegada` AS `horallegada`, `pasajero_transfer`.`fechasalida` AS `fechasalida`, `pasajero_transfer`.`horasalida` AS `horasalida` FROM (`transfer` join `pasajero_transfer` on(`transfer`.`id_transfer` = `pasajero_transfer`.`transfer_id`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `estado_pasajeros`
--
DROP TABLE IF EXISTS `estado_pasajeros`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `estado_pasajeros`  AS SELECT `pasajero`.`id_pasajero` AS `id_pasajero`, `pasajero`.`pasajero_id` AS `pasajero_id`, `pasajero`.`estado` AS `estado` FROM (`pasajero` join `dammtour_wp75`.`wp5g_posts` on(`pasajero`.`pasajero_id` = `dammtour_wp75`.`wp5g_posts`.`ID`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `hospedaje_localidad`
--
DROP TABLE IF EXISTS `hospedaje_localidad`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `hospedaje_localidad`  AS SELECT `hospedaje`.`id_hospedaje` AS `id_hospedaje`, `hospedaje`.`nombre_hospedaje` AS `nombre_hospedaje`, `localidad`.`pais` AS `pais`, `localidad`.`ciudad` AS `ciudad` FROM (`hospedaje` join `localidad` on(`localidad`.`id_localidad` = `hospedaje`.`localidad_id`))  ;

-- --------------------------------------------------------

--
-- Estructura para la vista `tour_localidad`
--
DROP TABLE IF EXISTS `tour_localidad`;

CREATE ALGORITHM=UNDEFINED DEFINER=`` SQL SECURITY DEFINER VIEW `tour_localidad`  AS SELECT `tour`.`id_tour` AS `id_tour`, `tour`.`nombre_tour` AS `nombre_tour`, `localidad`.`pais` AS `pais`, `localidad`.`ciudad` AS `ciudad` FROM (`tour` join `localidad` on(`localidad`.`id_localidad` = `tour`.`localidad_id`))  ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chofer`
--
ALTER TABLE `chofer`
  ADD UNIQUE KEY `id_chofer` (`id_chofer`);

--
-- Indices de la tabla `costo`
--
ALTER TABLE `costo`
  ADD PRIMARY KEY (`id_costo`);

--
-- Indices de la tabla `fecha`
--
ALTER TABLE `fecha`
  ADD PRIMARY KEY (`id_fecha`);

--
-- Indices de la tabla `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `hospedaje`
--
ALTER TABLE `hospedaje`
  ADD PRIMARY KEY (`id_hospedaje`);

--
-- Indices de la tabla `localidad`
--
ALTER TABLE `localidad`
  ADD PRIMARY KEY (`id_localidad`);

--
-- Indices de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pasajero`
--
ALTER TABLE `pasajero`
  ADD PRIMARY KEY (`id_pasajero`),
  ADD KEY `fk_Pasajero_Costo1_idx` (`costo_id`),
  ADD KEY `fk_pasajero_estado1_idx` (`estado_id`),
  ADD KEY `fk_pasajero_hospedaje` (`hospedaje_id`);

--
-- Indices de la tabla `pasajero_hospedaje`
--
ALTER TABLE `pasajero_hospedaje`
  ADD PRIMARY KEY (`id_pasajero_hospedaje`);

--
-- Indices de la tabla `pasajero_tour`
--
ALTER TABLE `pasajero_tour`
  ADD PRIMARY KEY (`id_pasajero_tour`);

--
-- Indices de la tabla `pasajero_transfer`
--
ALTER TABLE `pasajero_transfer`
  ADD PRIMARY KEY (`id_pasajero_transfer`);

--
-- Indices de la tabla `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`id_tour`);

--
-- Indices de la tabla `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id_transfer`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`);

--
-- Indices de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD UNIQUE KEY `id_vehiculo` (`id_vehiculo`);

--
-- Indices de la tabla `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`id_voucher`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chofer`
--
ALTER TABLE `chofer`
  MODIFY `id_chofer` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `costo`
--
ALTER TABLE `costo`
  MODIFY `id_costo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `fecha`
--
ALTER TABLE `fecha`
  MODIFY `id_fecha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `hospedaje`
--
ALTER TABLE `hospedaje`
  MODIFY `id_hospedaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `localidad`
--
ALTER TABLE `localidad`
  MODIFY `id_localidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `pasajero`
--
ALTER TABLE `pasajero`
  MODIFY `id_pasajero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `pasajero_hospedaje`
--
ALTER TABLE `pasajero_hospedaje`
  MODIFY `id_pasajero_hospedaje` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pasajero_tour`
--
ALTER TABLE `pasajero_tour`
  MODIFY `id_pasajero_tour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `pasajero_transfer`
--
ALTER TABLE `pasajero_transfer`
  MODIFY `id_pasajero_transfer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tour`
--
ALTER TABLE `tour`
  MODIFY `id_tour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id_transfer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  MODIFY `id_vehiculo` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `voucher`
--
ALTER TABLE `voucher`
  MODIFY `id_voucher` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pasajero`
--
ALTER TABLE `pasajero`
  ADD CONSTRAINT `fk_costo_pasajero` FOREIGN KEY (`costo_id`) REFERENCES `costo` (`id_costo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pasajero_estado` FOREIGN KEY (`estado_id`) REFERENCES `estado` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pasajero_fecha` FOREIGN KEY (`fecha_id`) REFERENCES `fecha` (`id_fecha`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pasajero_hospedaje` FOREIGN KEY (`hospedaje_id`) REFERENCES `hospedaje` (`id_hospedaje`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



