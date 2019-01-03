-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 30-11-2017 a las 02:17:28
-- Versión del servidor: 5.6.36-cll-lve
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `resetdb_1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bibliotecas`
--

CREATE TABLE IF NOT EXISTS `bibliotecas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL DEFAULT '0',
  `src` varchar(250) NOT NULL DEFAULT '0',
  `categ` int(11) NOT NULL DEFAULT '0',
  `creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_bibliotecas_cate_biblio` (`categ`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Volcado de datos para la tabla `bibliotecas`
--

INSERT INTO `bibliotecas` (`id`, `nombre`, `src`, `categ`, `creacion`) VALUES
(45, 'biblio1.pdf', '../biblio/NCInBOGFeUi.pdf', 4, '2017-10-27 12:41:18'),
(46, 'vue.js', '../biblio/lDjtpVkCAzYR.js', 3, '2017-11-01 12:50:00'),
(47, 'iPnajdbdB3mL.jpeg', '../biblio/m3NDYvjGZDGi.jpeg', 3, '2017-11-09 16:26:04'),
(49, 'Actividades de apropiaciÃ³n del conocimiento IMPLA(..)', '../biblio/RWyjjhsmsPnM.docx', 6, '2017-11-12 22:31:09'),
(50, 'MER.png', '../biblio/jgihishkVCgx.png', 5, '2017-11-13 00:02:54'),
(52, 'SOLUCIÃ“N TALLER SQL AV(..)', '../biblio/4U5Wf4jgxSRr.pdf', 3, '2017-11-16 17:08:23'),
(53, '', '../biblio/aunSB8aSZUcm.', 3, '2017-11-16 18:42:57'),
(54, 'logo sena.jpg', '../biblio/IsMmXx18nsx8.jpg', 3, '2017-11-16 18:43:12'),
(55, 'Logo_SENA_imagen-5(..)', '../biblio/Mq8k2JqtrsRo.jpg', 3, '2017-11-16 18:43:21'),
(56, 'Jellyfish.jpg', '../biblio/a3J2lwInsj6.jpg', 3, '2017-11-16 18:43:44'),
(57, 'Lighthouse.jpg', '../biblio/FcGIHErZguPC.jpg', 3, '2017-11-16 18:44:32'),
(58, 'Tulips.jpg', '../biblio/H4WtJT4V0z61.jpg', 3, '2017-11-16 18:44:45'),
(59, 'Hydrangeas.jpg', '../biblio/dWHZf1mGMY7I.jpg', 3, '2017-11-16 18:45:11'),
(60, 'Chrysanthemum.jpg', '../biblio/zTRPKaFvMOY5.jpg', 3, '2017-11-16 18:45:28'),
(61, 'Politicas de Uso(..)', '../biblio/HFi660g0aOkl.pdf', 4, '2017-11-17 12:32:50'),
(62, 'mensajes.php', '../biblio/QddEhEfxBSX.php', 3, '2017-11-20 11:30:24'),
(63, 'mongodb.docx', '../biblio/fmxNNzeokzq.docx', 3, '2017-11-20 17:44:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `biblioteca_grupos`
--

CREATE TABLE IF NOT EXISTS `biblioteca_grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL DEFAULT '0',
  `id_grupo` int(11) NOT NULL DEFAULT '0',
  `id_biblioteca` int(11) DEFAULT NULL,
  `creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_biblioteca_grupos_usuario` (`id_usuario`),
  KEY `FK_biblioteca_grupos_bibliotecas` (`id_grupo`),
  KEY `FK_biblioteca_grupos_bibliotecas_2` (`id_biblioteca`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Volcado de datos para la tabla `biblioteca_grupos`
--

INSERT INTO `biblioteca_grupos` (`id`, `id_usuario`, `id_grupo`, `id_biblioteca`, `creacion`) VALUES
(34, 43, 1, 45, '2017-10-27 12:41:18'),
(35, 47, 2, 46, '2017-11-01 12:50:00'),
(36, 52, 1, 47, '2017-11-09 16:26:04'),
(38, 43, 2, 49, '2017-11-12 22:31:09'),
(39, 43, 1, 50, '2017-11-13 00:02:54'),
(41, 63, 2, 52, '2017-11-16 17:08:23'),
(42, 47, 1, 53, '2017-11-16 18:42:57'),
(43, 47, 1, 54, '2017-11-16 18:43:12'),
(44, 47, 1, 55, '2017-11-16 18:43:21'),
(45, 47, 1, 56, '2017-11-16 18:43:44'),
(46, 47, 1, 57, '2017-11-16 18:44:32'),
(47, 47, 1, 58, '2017-11-16 18:44:45'),
(48, 47, 1, 59, '2017-11-16 18:45:11'),
(49, 47, 1, 60, '2017-11-16 18:45:28'),
(50, 54, 1, 61, '2017-11-17 12:32:50'),
(51, 43, 2, 62, '2017-11-20 11:30:24'),
(52, 68, 3, 63, '2017-11-20 17:44:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cate_biblio`
--

CREATE TABLE IF NOT EXISTS `cate_biblio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) DEFAULT NULL,
  `creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `cate_biblio`
--

INSERT INTO `cate_biblio` (`id`, `nombre`, `creacion`) VALUES
(3, 'Programacion', '2017-10-24 20:41:55'),
(4, 'Frontend', '2017-10-24 20:41:55'),
(5, 'Poo', '2017-10-24 20:43:28'),
(6, 'Estructuras', '2017-10-24 20:43:28'),
(7, 'Diseno', '2017-10-24 20:43:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE IF NOT EXISTS `ciudades` (
  `idCiudad` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `idDepartamento` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCiudad`),
  KEY `FK_ciudades_departamento` (`idDepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`idCiudad`, `nombre`, `idDepartamento`) VALUES
(1, 'Bello', 1),
(2, 'Caldas', 1),
(3, 'Copacabana', 1),
(4, 'Envigado', 1),
(5, 'Guarne', 1),
(6, 'Itagui', 1),
(7, 'La Ceja', 1),
(8, 'La Estrella', 1),
(9, 'La Tablaza', 1),
(10, 'Marinilla', 1),
(11, 'Medellín', 1),
(12, 'Rionegro', 1),
(13, 'Sabaneta', 1),
(14, 'San Antonio de Prado', 1),
(15, 'San Cristóbal', 1),
(16, 'Caucasia', 1),
(17, 'Barranquilla', 2),
(18, 'Malambo', 2),
(19, 'Puerto Colombia', 2),
(20, 'Soledad', 2),
(21, 'Arjona', 3),
(22, 'Bayunca', 3),
(23, 'Carmen de Bolívar', 3),
(24, 'Cartagena', 3),
(25, 'Turbaco', 3),
(26, 'Arcabuco', 4),
(27, 'Belencito', 4),
(28, 'Chiquinquirá', 4),
(29, 'Combita', 4),
(30, 'Cucaita', 4),
(31, 'Duitama', 4),
(32, 'Mongui', 4),
(33, 'Nobsa', 4),
(34, 'Paipa', 4),
(35, 'Puerto Boyacá', 4),
(36, 'Ráquira', 4),
(37, 'Samaca', 4),
(38, 'Santa Rosa de Viterbo', 4),
(39, 'Sogamoso', 4),
(40, 'Sutamerchán', 4),
(41, 'Tibasosa', 4),
(42, 'Tinjaca', 4),
(43, 'Tunja', 4),
(44, 'Ventaquemada', 4),
(45, 'Villa de Leiva', 4),
(46, 'La Dorada', 5),
(47, 'Manizales', 5),
(48, 'Villamaria', 5),
(49, 'Caloto', 6),
(50, 'Ortigal', 6),
(51, 'Piendamo', 6),
(52, 'Popayán', 6),
(53, 'Puerto Tejada', 6),
(54, 'Santander Quilichao', 6),
(55, 'Tunia', 6),
(56, 'Villarica', 6),
(57, 'Valledupar', 7),
(58, 'Cerete', 8),
(59, 'Montería', 8),
(60, 'Planeta Rica', 8),
(61, 'Alban', 9),
(62, 'Bogotá', 9),
(63, 'Bojaca', 9),
(64, 'Bosa', 9),
(65, 'Briceño', 9),
(66, 'Cajicá', 9),
(67, 'Chía', 9),
(68, 'Chinauta', 9),
(69, 'Choconta', 9),
(70, 'Cota', 9),
(71, 'El Muña', 9),
(72, 'El Rosal', 9),
(73, 'Engativá', 9),
(74, 'Facatativa', 9),
(75, 'Fontibón', 9),
(76, 'Funza', 9),
(77, 'Fusagasuga', 9),
(78, 'Gachancipá', 9),
(79, 'Girardot', 9),
(80, 'Guaduas', 9),
(81, 'Guayavetal', 9),
(82, 'La Calera', 9),
(83, 'La Caro', 9),
(84, 'Madrid', 9),
(85, 'Mosquera', 9),
(86, 'Nemocón', 9),
(87, 'Puente Piedra', 9),
(88, 'Puente Quetame', 9),
(89, 'Puerto Bogotá', 9),
(90, 'Puerto Salgar', 9),
(91, 'Quetame', 9),
(92, 'Sasaima', 9),
(93, 'Sesquile', 9),
(94, 'Sibaté', 9),
(95, 'Silvania', 9),
(96, 'Simijaca', 9),
(97, 'Soacha', 9),
(98, 'Sopo', 9),
(99, 'Suba', 9),
(100, 'Subachoque', 9),
(101, 'Susa', 9),
(102, 'Tabio', 9),
(103, 'Tenjo', 9),
(104, 'Tocancipa', 9),
(105, 'Ubaté', 9),
(106, 'Usaquén', 9),
(107, 'Usme', 9),
(108, 'Villapinzón', 9),
(109, 'Villeta', 9),
(110, 'Zipaquirá', 9),
(111, 'Maicao', 10),
(112, 'Riohacha', 10),
(113, 'Aipe', 11),
(114, 'Neiva', 11),
(115, 'Cienaga', 12),
(116, 'Gaira', 12),
(117, 'Rodadero', 12),
(118, 'Santa Marta', 12),
(119, 'Taganga', 12),
(120, 'Villavicencio', 13),
(121, 'Ipiales', 14),
(122, 'Pasto', 14),
(123, 'Cúcuta', 15),
(124, 'El Zulia', 15),
(125, 'La Parada', 15),
(126, 'Los Patios', 15),
(127, 'Villa del Rosario', 15),
(128, 'Armenia', 16),
(129, 'Calarcá', 16),
(130, 'Circasia', 16),
(131, 'La Tebaida', 16),
(132, 'Montenegro', 16),
(133, 'Quimbaya', 16),
(134, 'Dosquebradas', 17),
(135, 'Pereira', 17),
(136, 'Aratoca', 18),
(137, 'Barbosa', 18),
(138, 'Bucaramanga', 18),
(139, 'Floridablanca', 18),
(140, 'Girón', 18),
(141, 'Lebrija', 18),
(142, 'Oiba', 18),
(143, 'Piedecuesta', 18),
(144, 'Pinchote', 18),
(145, 'San Gil', 18),
(146, 'Socorro', 18),
(147, 'Sincelejo', 19),
(148, 'Armero', 20),
(149, 'Buenos Aires', 20),
(150, 'Castilla', 20),
(151, 'Espinal', 20),
(152, 'Flandes', 20),
(153, 'Guamo', 20),
(154, 'Honda', 20),
(155, 'Ibagué', 20),
(156, 'Mariquita', 20),
(157, 'Melgar', 20),
(158, 'Natagaima', 20),
(159, 'Payande', 20),
(160, 'Purificación', 20),
(161, 'Saldaña', 20),
(162, 'Tolemaida', 20),
(163, 'Amaime', 21),
(164, 'Andalucía', 21),
(165, 'Buenaventura', 21),
(166, 'Buga', 21),
(167, 'Buga La Grande', 21),
(168, 'Caicedonia', 21),
(169, 'Cali', 21),
(170, 'Candelaria', 21),
(171, 'Cartago', 21),
(172, 'Cavasa', 21),
(173, 'Costa Rica', 21),
(174, 'Dagua', 21),
(175, 'El Carmelo', 21),
(176, 'El Cerrito', 21),
(177, 'El Placer', 21),
(178, 'Florida', 21),
(179, 'Ginebra', 21),
(180, 'Guacarí', 21),
(181, 'Jamundi', 21),
(182, 'La Paila', 21),
(183, 'La Unión', 21),
(184, 'La Victoria', 21),
(185, 'Loboguerrero', 21),
(186, 'Palmira', 21),
(187, 'Pradera', 21),
(188, 'Roldanillo', 21),
(189, 'Rozo', 21),
(190, 'San Pedro', 21),
(191, 'Sevilla', 21),
(192, 'Sonso', 21),
(193, 'Tulúa', 21),
(194, 'Vijes', 21),
(195, 'Villa Gorgona', 21),
(196, 'Yotoco', 21),
(197, 'Yumbo', 21),
(198, 'Zarzal', 21),
(199, 'No ingresado', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `idDepartamento` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idDepartamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`idDepartamento`, `nombre`) VALUES
(0, 'actualizar departamento'),
(1, 'Antioquia'),
(2, 'Atlántico'),
(3, 'Bolívar'),
(4, 'Boyacá'),
(5, 'Caldas'),
(6, 'Cauca'),
(7, 'Cesar'),
(8, 'Córdoba'),
(9, 'Cundinamarca'),
(10, 'Guajira'),
(11, 'Huila'),
(12, 'Magdalena'),
(13, 'Meta'),
(14, 'Nariño'),
(15, 'Norte de Santander'),
(16, 'Quindío'),
(17, 'Risaralda'),
(18, 'Santander'),
(19, 'Sucre'),
(20, 'Tolima'),
(21, 'Valle del Cauca'),
(22, 'No ingresado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE IF NOT EXISTS `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL DEFAULT '0',
  `slug` varchar(50) NOT NULL DEFAULT '0',
  `descripcion` varchar(50) NOT NULL DEFAULT '0',
  `imagen` varchar(50) NOT NULL DEFAULT '0',
  `principal` int(11) NOT NULL DEFAULT '1',
  `creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `nombre`, `slug`, `descripcion`, `imagen`, `principal`, `creacion`) VALUES
(1, 'ADSI', 'ADSI', 'Grupo principal', 'url/image.jpg', 1, '2017-10-09 15:49:50'),
(2, 'ADSI129', 'ADSI129', 'Grupo enfocado', 'url/image', 2, '2017-10-09 15:50:43'),
(3, 'TPS', 'tps', 'Grupo principal', 'url/imagen.jpg', 1, '2017-10-09 22:36:48'),
(4, 'ADSI131', 'adsi131', 'Grupo enfocado', 'url/image', 2, '2017-10-11 00:55:12'),
(5, 'TPS116', 'tps116', 'Grupo enfocado', 'url/image', 2, '2017-10-11 00:55:45'),
(6, 'ADSI124', 'adsi-124', 'Grupo enfocado', '../img/img.jpg', 2, '2017-10-24 14:44:54'),
(8, 'ADSI130', 'adsi-130', 'Grupo enfocado', 'url/img.jpg', 2, '2017-10-24 14:47:03'),
(9, 'ADSI132', 'adsi-132', 'Grupo enfocado', 'img/img.jpg', 2, '2017-10-24 14:47:03'),
(10, 'TPS114', 'tps-114', 'Grupo enfocado', 'img/img.jpg', 2, '2017-10-24 14:50:56'),
(11, 'Adsi140', 'adsi-140', 'Grupo enfocado', 'img/img.jpg', 2, '2017-10-24 14:50:56'),
(12, 'Instructores', 'intructores', 'Grupo des instructores', '0', 1, '2017-11-30 02:13:53'),
(13, 'CEAI(para instructores)', 'ceai', 'Centro de automatizacion', '0', 2, '2017-11-30 02:14:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE IF NOT EXISTS `mensajes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto` text,
  `est_in` int(11) DEFAULT '1' COMMENT 'id  del usuario que le entra el mensaje',
  `est_out` int(11) DEFAULT '1' COMMENT 'id  del usuario que le envio el mensaje',
  `visto` int(11) DEFAULT '1',
  `creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`id`, `texto`, `est_in`, `est_out`, `visto`, `creacion`) VALUES
(2, 'y el proyecto que ', 47, 43, 1, '2017-11-27 21:34:06'),
(3, 'Prueba ', 51, 43, 1, '2017-11-27 21:38:50'),
(4, 'otra prueba ', 47, 43, 1, '2017-11-27 21:40:03'),
(5, 'Mensaje de prueba ', 55, 43, 1, '2017-11-27 21:41:51'),
(6, 'Mensaje de prueba ', 54, 43, 1, '2017-11-27 21:42:08'),
(7, 'Una pruba', 51, 43, 1, '2017-11-27 23:40:42'),
(8, 'Otra prueba', 51, 43, 1, '2017-11-27 23:43:29'),
(9, 'Prueba de mensaje', 55, 43, 1, '2017-11-27 23:46:58'),
(10, 'Hola Alexis.', 43, 54, 1, '2017-11-28 17:36:54'),
(11, 've y el numero de celular no va funcionar o que ', 43, 45, 1, '2017-11-28 18:34:27'),
(12, 'aun no se ', 43, 51, 1, '2017-11-28 23:58:52'),
(13, 'Mas pruebas ', 43, 0, 1, '2017-11-29 00:31:02'),
(14, 'No se ois ', 43, 0, 1, '2017-11-29 00:33:12'),
(15, 'Y el proyecto que', 43, 0, 1, '2017-11-29 00:34:28'),
(16, 'Mas pruebas ', 43, 0, 1, '2017-11-29 00:35:23'),
(17, 'Pinches pruebas ', 43, 0, 1, '2017-11-29 00:35:53'),
(18, 'Y el proyecto que ', 43, 47, 1, '2017-11-29 00:37:47'),
(19, 'Una prueba ', 43, 47, 1, '2017-11-29 00:37:55'),
(20, 'Aun no se ', 43, 51, 1, '2017-11-29 00:38:07'),
(21, 'Aun no se ois ', 43, 45, 1, '2017-11-29 00:38:53'),
(22, 'hh', 45, 43, 1, '2017-11-29 00:42:53'),
(23, 'te mando un mensaje', 43, 45, 1, '2017-11-29 00:44:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `msj_user`
--

CREATE TABLE IF NOT EXISTS `msj_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_in` int(11) DEFAULT NULL,
  `user_out` int(11) DEFAULT NULL,
  `id_msj` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_msj_user_usuario` (`user_in`),
  KEY `FK_msj_user_usuario_2` (`user_out`),
  KEY `FK_msj_user_mensajes` (`id_msj`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `msj_user`
--

INSERT INTO `msj_user` (`id`, `user_in`, `user_out`, `id_msj`) VALUES
(2, 47, 43, 2),
(3, 51, 43, 3),
(4, 47, 43, 4),
(5, 55, 43, 5),
(6, 54, 43, 6),
(7, 51, 43, 7),
(8, 51, 43, 8),
(9, 55, 43, 9),
(10, 43, 54, 10),
(11, 45, 43, 11),
(12, 43, 51, 12),
(18, 43, 47, 18),
(19, 43, 47, 19),
(20, 43, 51, 20),
(21, 43, 45, 21),
(22, 45, 43, 22),
(23, 43, 45, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE IF NOT EXISTS `publicaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuarios` int(11) NOT NULL DEFAULT '0',
  `id_grupo` int(11) NOT NULL DEFAULT '0',
  `texto` varchar(500) NOT NULL DEFAULT '0',
  `creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_publicaciones_usuario` (`id_usuarios`),
  KEY `FK_publicaciones_grupos` (`id_grupo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=94 ;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`id`, `id_usuarios`, `id_grupo`, `texto`, `creacion`) VALUES
(49, 43, 2, 'Usen lo mas que puedan esto para identificar errores. Gracias', '2017-10-24 22:14:36'),
(52, 43, 1, '<iframe width="560" height="315" src="https://www.youtube.com/embed/do-RDvr9_Pc" frameborder="0" allowfullscreen></iframe>', '2017-10-26 14:10:23'),
(54, 48, 1, '', '2017-11-07 15:37:47'),
(55, 48, 1, 'styjgdhjdghjcghdj', '2017-11-07 15:37:58'),
(56, 48, 1, 'La imagem del gato no me deaj ver lo que escribo', '2017-11-07 15:38:14'),
(57, 48, 2, 'Sucede lo mismo aquÃ­ con el gato, noi puedo ver lo que escribop\r\n', '2017-11-07 15:38:42'),
(58, 52, 2, 'buena noche', '2017-11-09 16:23:28'),
(63, 43, 2, '<iframe width=''200'' height=''200'' src=''https://www.youtube.com/embed/xm41dHucxmM'' frameborder=''0'' allowfullscreen></iframe>', '2017-11-13 01:05:57'),
(65, 48, 1, 'Hola buenas noches. Vean mi canal\r\nhttps://www.youtube.com/channel/UCXIDIpLZLKZ1l8YpeUnBQSQ?\r\n', '2017-11-14 17:22:49'),
(66, 54, 1, 'Hola Victor\r\n', '2017-11-14 17:23:45'),
(67, 54, 1, 'Viniste el Veirnes\r\n', '2017-11-14 17:24:03'),
(68, 48, 2, 'https://www.youtube.com/channel/UCXIDIpLZLKZ1l8YpeUnBQSQ?', '2017-11-14 17:24:32'),
(69, 48, 2, 'probando ', '2017-11-14 17:24:55'),
(70, 48, 2, 'https://www.youtube.com/watch?time_continue=126&amp;v=aKOt8bqsqMY', '2017-11-14 17:24:58'),
(71, 48, 2, 'https://youtu.be/aKOt8bqsqMY\r\n\r\n\r\n', '2017-11-14 17:25:31'),
(73, 51, 1, 'https://www.instagram.com/full.locker/', '2017-11-15 17:51:59'),
(74, 61, 4, 'Hola. Camila te amo en secreto desde que te conocÃ­', '2017-11-15 17:56:35'),
(75, 57, 1, 'hola', '2017-11-15 17:57:12'),
(76, 57, 1, 'muchas faltas\r\n', '2017-11-15 17:57:42'),
(77, 62, 1, ':O', '2017-11-15 18:05:18'),
(78, 54, 1, 'Viernes 17 de Noviembrede2017, probando desde SENA BrtaÃ±a', '2017-11-17 17:25:39'),
(79, 66, 2, 'http://cibertest.com/examen-online/153/examen-de-informatica-basica', '2017-11-17 18:01:15'),
(80, 57, 1, 'poquitos el di de hoy\r\n', '2017-11-17 19:01:49'),
(82, 69, 2, 'asadito para despedida! quien dijo yo?', '2017-11-22 17:29:43'),
(83, 69, 1, 'quien quiere asadito de despedida? ', '2017-11-22 17:40:59'),
(85, 54, 1, 'Necesitamos el Manual de usuario para subirlo maÃ±ana a la plataforma\r\n', '2017-11-25 20:56:01'),
(86, 54, 1, 'Monica PavÃ³n y Esahir Ramirez son los responsables \r\n', '2017-11-25 20:57:02'),
(87, 55, 1, 'Panel Izquierdo red educativa estudiantil Reset', '2017-11-26 12:30:50'),
(88, 55, 1, 'Panel Izquierdo red educativa estudiantil Reset en la opciÃ³n de Grupos ADSI', '2017-11-26 12:37:27'),
(91, 55, 1, 'Explicando las opciones del panel izquierdo de la res social Reset, en la parte de los grupos.', '2017-11-26 14:18:15'),
(93, 45, 1, 'estamos haciendo el plan de capacitaciÃ³n ', '2017-11-29 18:42:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones_comentario`
--

CREATE TABLE IF NOT EXISTS `publicaciones_comentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `publicaciones_id` int(11) NOT NULL,
  `usuarios_id` int(11) NOT NULL,
  `comentario` varchar(500) NOT NULL,
  `creacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_publicaciones_comentario_publicaciones` (`publicaciones_id`),
  KEY `FK_publicaciones_comentario_usuario` (`usuarios_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=112 ;

--
-- Volcado de datos para la tabla `publicaciones_comentario`
--

INSERT INTO `publicaciones_comentario` (`id`, `publicaciones_id`, `usuarios_id`, `comentario`, `creacion`) VALUES
(47, 49, 45, 'en funcionalidad todo va bien  ', '2017-10-24 22:38:13'),
(67, 57, 52, '', '2017-11-09 16:21:28'),
(68, 57, 52, 'Catalina', '2017-11-09 16:22:02'),
(86, 71, 55, '\r\n\r\nVamos con toda muchachos, con el favor de Dios a terminar Ã©ste ADSI 129 EL MEJOR. Bendiciones', '2017-11-15 17:25:08'),
(88, 73, 61, 'Hola, soy yo', '2017-11-15 17:54:54'),
(89, 67, 61, 'SÃ­', '2017-11-15 17:55:11'),
(90, 65, 61, 'No, se ve que es aburrido, lo siento amiguito', '2017-11-15 17:55:33'),
(91, 74, 53, 'Jajajajaja Di algo Camila', '2017-11-15 18:02:50'),
(92, 76, 62, 'CÃ³mo la que ella te hizo\r\n', '2017-11-15 18:04:59'),
(93, 74, 60, 'Te amo &lt;3 ', '2017-11-15 18:06:20'),
(94, 80, 54, 'Martes 21 de Noviembre de 2017\r\n', '2017-11-21 16:13:59'),
(97, 80, 69, 'que dicen, armamos un asadito de despedida?\r\n', '2017-11-22 17:25:51'),
(98, 82, 64, 'en ese potrero???', '2017-11-22 17:30:23'),
(99, 82, 69, 'en el de tu casa no! en la mansion mia', '2017-11-22 17:38:32'),
(101, 86, 54, 'Estamos trabajando en la realizaciÃ³n del Manual de Usuario', '2017-11-25 21:00:30'),
(102, 86, 55, 'Panel Izquierdo red educativa estudiantil Reset', '2017-11-26 12:30:04'),
(103, 88, 43, 'Probando ? ', '2017-11-26 12:56:09'),
(105, 88, 55, 'Alexis Guillermo\r\n', '2017-11-26 14:08:48'),
(106, 88, 55, 'Panel Izquierdo red educativa estudiantil Reset en la opciÃ³n de Inicio', '2017-11-26 14:09:57'),
(107, 87, 55, 'Alexis la opciÃ³n de enviar mensajes directos a un usuario no funciona', '2017-11-26 14:11:37'),
(108, 91, 54, 'Los Comentarios en la red social tecnolÃ³gica Reset.', '2017-11-26 15:07:16'),
(109, 87, 43, 'A si todavia no funciona esperando a Jhor o cristian que hagan la interfaz de inbox', '2017-11-27 06:29:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recover`
--

CREATE TABLE IF NOT EXISTS `recover` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL DEFAULT '0',
  `token` varchar(150) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_recover_usuario` (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Tabla de tokens de contraseñas' AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `recover`
--

INSERT INTO `recover` (`id`, `id_user`, `token`) VALUES
(2, 43, 'eVY2qOEWSllaTUUuj2YHTy0f'),
(3, 43, 'GYbVcynCYDWtXFSNeZhRXBaA'),
(4, 43, 'qmDGTl3a0TvbGYefb1Ny6fBY');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
(1, 'Usuario'),
(2, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL DEFAULT '0',
  `pass` varchar(300) DEFAULT NULL,
  `nombre` varchar(250) NOT NULL DEFAULT '0',
  `apellido` varchar(250) NOT NULL DEFAULT '0',
  `p_profile` varchar(250) NOT NULL DEFAULT '../img/p_profile/foto.png',
  `programa` int(11) NOT NULL,
  `curso` int(11) DEFAULT NULL,
  `rol` int(11) NOT NULL DEFAULT '1',
  `ciudad` int(11) DEFAULT NULL,
  `creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `FK_usuario_rol` (`rol`),
  KEY `FK_usuario_ciudades` (`ciudad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `pass`, `nombre`, `apellido`, `p_profile`, `programa`, `curso`, `rol`, `ciudad`, `creacion`) VALUES
(43, 'alexxxxl1@gmail.com', '5c564d95535e171211d35e0d86cb4ac1', 'Alexis', 'Velez', '../img/p_profile/zzsIEsHCtQZh.png', 1, 2, 2, 169, '2017-10-24 19:34:39'),
(45, 'cristian@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'Cristian', 'BolaÃ±os', '../img/p_profile/foto.png', 1, 2, 1, 169, '2017-10-24 22:30:42'),
(46, 'linagrijalba00@gmail.com', '33c092fc5fb7a289c3bf8b58d955f8f8', 'lina marcela ', 'ocampo', '../img/p_profile/yvfk2GRTJSgn.jpeg', 1, 2, 1, 199, '2017-10-25 13:46:44'),
(47, 'jhorpama@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'jhor', 'pama', '../img/p_profile/IzeRLQogEX5r.jpeg', 1, 2, 1, 199, '2017-10-26 08:24:04'),
(48, 'vmmartinez64@misena.edu.co', 'ac88cdd829b9f93dca8e64d6262971b0', 'Victor', 'Martinez Sanchez', '../img/p_profile/iiF3RTlTrd1Q.jpeg', 1, 2, 1, 199, '2017-11-07 15:32:52'),
(51, 'kataestrada5@gmail.com', 'b9111abe448a5a694939743adaee520a', 'katalina', 'estrada', '../img/p_profile/N11nc08k7i95.jpeg', 1, 2, 1, 199, '2017-11-09 16:16:08'),
(52, 'bjba@hotmail.com', 'c33367701511b4f6020ec61ded352059', 'Billy Joel', 'jarro', '../img/p_profile/foto.png', 1, 2, 1, 199, '2017-11-09 16:20:21'),
(53, 'juliana.angel.salazar90@gmail.com', 'e6d86fbed9082a1129028c7a97475151', 'Juliana', 'Salazar', '../img/p_profile/msCdnJhKKcWP.jpeg', 1, 4, 1, 199, '2017-11-13 12:33:38'),
(54, 'gab@misena.edu.co', '0cd5c8e02ea85d96cf6b97b9c9aacf2c', 'Guillermo', 'Alarcon ', '../img/p_profile/xmsKWXIWuEVO.png', 1, 2, 1, 199, '2017-11-14 17:19:53'),
(55, 'mpavon@misena.edu.co', 'eb31b49875bf4582fad11fb9d3268063', 'MÃ³nica', 'PavÃ³n SuÃ¡rez', '../img/p_profile/2whllCNIdgGU.png', 1, 2, 1, 199, '2017-11-15 17:18:44'),
(57, 'esahira1008@gmail.com', 'f2a47e50ed4b61351473e7f3861225d6', 'esahir', 'ramirez', '../img/p_profile/NpHaCg0Wr7g8.jpeg', 1, 2, 1, 199, '2017-11-15 17:33:43'),
(58, 'jhonhols18@gmail.com', '6786fee8dd00220afc0ffc3f66f46e1a', 'john', 'holguin', '../img/p_profile/foto.png', 1, 2, 1, 199, '2017-11-15 17:45:22'),
(59, 'hescobar14@misena.edu.com', 'c62d929e7b7e7b6165923a5dfc60cb56', 'Hernando', 'Escobar', '../img/p_profile/foto.png', 1, 4, 1, 199, '2017-11-15 17:50:24'),
(60, 'cc01@misena.edu.co', 'f10690c6e2709bb9a6b226fda5842157', 'Camila', 'CerÃ³n', '../img/p_profile/b68mZIqQID1F.jpeg', 1, 4, 1, 199, '2017-11-15 17:50:40'),
(61, 'ccmedina@gmail.com', '5416d7cd6ef195a0f7622a9c56b55e84', 'Juliana', 'Guarangua Urrutia CerÃ³n Escobar ', '../img/p_profile/foto.png', 1, 4, 1, 199, '2017-11-15 17:53:58'),
(62, 'ccc@gmail.com', '46f94c8de14fb36680850768ff1b7f2a', 'Gina Camila Steven Angel Hernando Christian', 'Medina CerÃ³n Guaranguai Escobar Urrutia Salazar numero 2', '../img/p_profile/foto.png', 1, 2, 1, 199, '2017-11-15 18:04:11'),
(63, 'jeremyfb2009@gmail.com', 'efb563f62df2cba2d0bf90e76185382a', 'jeremy', 'alexander', '../img/p_profile/Se1nAPQDIWYv.jpeg', 1, 2, 1, 199, '2017-11-16 16:58:09'),
(64, 'win32h@hotmail.com', '202cb962ac59075b964b07152d234b70', 'tu mama', 'la tuya', '../img/p_profile/foto.png', 1, 2, 1, 169, '2017-11-16 17:32:48'),
(65, 'manual@misena.edu.co', '202cb962ac59075b964b07152d234b70', 'Manual', 'Reset', '../img/p_profile/foto.png', 1, 2, 1, 199, '2017-11-17 16:06:40'),
(66, 'yantovar48@yahoo.com.co', 'e10adc3949ba59abbe56e057f20f883e', 'Yan Albeiro', 'Tovar Cruz', '../img/p_profile/LzhQINHwtUq9.jpeg', 1, 2, 1, 199, '2017-11-17 16:39:52'),
(67, 'a@a.c', '202cb962ac59075b964b07152d234b70', 'bolanos', 'cristian', '../img/p_profile/foto.png', 3, 5, 1, 199, '2017-11-20 17:41:35'),
(68, 'a@a.com', '202cb962ac59075b964b07152d234b70', 'cristian', 'bolanos', '../img/p_profile/nWf1rwUIEpIE.jpeg', 3, 5, 1, 199, '2017-11-20 17:42:22'),
(69, 'elvergalarga@hotmail.com', '6967cabefd763ac1a1a88e11159957db', 'elverga', 'larga', '../img/p_profile/Stp0tRHa1Cfg.jpeg', 1, 2, 1, 199, '2017-11-22 17:23:11'),
(70, 'jespinal44@misena.edu.co', '1bf9e31961399a9af5fc9a6a94ec187e', 'Jeniffer', 'Espinal', '../img/p_profile/foto.png', 1, 2, 1, 199, '2017-11-22 17:35:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_grupo`
--

CREATE TABLE IF NOT EXISTS `usuario_grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_grupos` int(11) NOT NULL,
  `activo` int(11) NOT NULL,
  `creado` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_usuario_grupo_usuario` (`id_usuario`),
  KEY `FK_usuario_grupo_grupos` (`id_grupos`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=109 ;

--
-- Volcado de datos para la tabla `usuario_grupo`
--

INSERT INTO `usuario_grupo` (`id`, `id_usuario`, `id_grupos`, `activo`, `creado`) VALUES
(53, 43, 1, 1, '2017-10-24 19:34:39'),
(54, 43, 2, 1, '2017-10-24 19:34:39'),
(57, 45, 1, 1, '2017-10-24 22:30:42'),
(58, 45, 2, 1, '2017-10-24 22:30:42'),
(59, 46, 1, 1, '2017-10-25 13:46:44'),
(60, 46, 2, 1, '2017-10-25 13:46:44'),
(61, 47, 1, 1, '2017-10-26 08:24:04'),
(62, 47, 2, 1, '2017-10-26 08:24:04'),
(63, 48, 1, 1, '2017-11-07 15:32:52'),
(64, 48, 2, 1, '2017-11-07 15:32:52'),
(69, 51, 1, 1, '2017-11-09 16:16:08'),
(70, 51, 2, 1, '2017-11-09 16:16:08'),
(71, 52, 1, 1, '2017-11-09 16:20:21'),
(72, 52, 2, 1, '2017-11-09 16:20:21'),
(73, 53, 1, 1, '2017-11-13 12:33:38'),
(74, 53, 4, 1, '2017-11-13 12:33:38'),
(75, 54, 1, 1, '2017-11-14 17:19:53'),
(76, 54, 2, 1, '2017-11-14 17:19:53'),
(77, 55, 1, 1, '2017-11-15 17:18:44'),
(78, 55, 2, 1, '2017-11-15 17:18:44'),
(81, 57, 1, 1, '2017-11-15 17:33:43'),
(82, 57, 2, 1, '2017-11-15 17:33:43'),
(83, 58, 1, 1, '2017-11-15 17:45:22'),
(84, 58, 2, 1, '2017-11-15 17:45:22'),
(85, 59, 1, 1, '2017-11-15 17:50:24'),
(86, 59, 4, 1, '2017-11-15 17:50:24'),
(87, 60, 1, 1, '2017-11-15 17:50:40'),
(88, 60, 4, 1, '2017-11-15 17:50:40'),
(89, 61, 1, 1, '2017-11-15 17:53:58'),
(90, 61, 4, 1, '2017-11-15 17:53:58'),
(91, 62, 1, 1, '2017-11-15 18:04:11'),
(92, 62, 4, 1, '2017-11-15 18:04:11'),
(93, 63, 1, 1, '2017-11-16 16:58:09'),
(94, 63, 2, 1, '2017-11-16 16:58:09'),
(95, 64, 1, 1, '2017-11-16 17:32:48'),
(96, 64, 2, 1, '2017-11-16 17:32:48'),
(97, 65, 1, 1, '2017-11-17 16:06:40'),
(98, 65, 2, 1, '2017-11-17 16:06:40'),
(99, 66, 1, 1, '2017-11-17 16:39:52'),
(100, 66, 2, 1, '2017-11-17 16:39:52'),
(101, 67, 3, 1, '2017-11-20 17:41:35'),
(102, 67, 5, 1, '2017-11-20 17:41:35'),
(103, 68, 3, 1, '2017-11-20 17:42:22'),
(104, 68, 5, 1, '2017-11-20 17:42:22'),
(105, 69, 1, 1, '2017-11-22 17:23:11'),
(106, 69, 2, 1, '2017-11-22 17:23:11'),
(107, 70, 1, 1, '2017-11-22 17:35:25'),
(108, 70, 2, 1, '2017-11-22 17:35:25');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bibliotecas`
--
ALTER TABLE `bibliotecas`
  ADD CONSTRAINT `FK_bibliotecas_cate_biblio` FOREIGN KEY (`categ`) REFERENCES `cate_biblio` (`id`);

--
-- Filtros para la tabla `biblioteca_grupos`
--
ALTER TABLE `biblioteca_grupos`
  ADD CONSTRAINT `FK_biblioteca_grupos_bibliotecas` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id`),
  ADD CONSTRAINT `FK_biblioteca_grupos_bibliotecas_2` FOREIGN KEY (`id_biblioteca`) REFERENCES `bibliotecas` (`id`),
  ADD CONSTRAINT `FK_biblioteca_grupos_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD CONSTRAINT `FK_ciudades_departamento` FOREIGN KEY (`idDepartamento`) REFERENCES `departamento` (`idDepartamento`);

--
-- Filtros para la tabla `msj_user`
--
ALTER TABLE `msj_user`
  ADD CONSTRAINT `FK_msj_user_mensajes` FOREIGN KEY (`id_msj`) REFERENCES `mensajes` (`id`),
  ADD CONSTRAINT `FK_msj_user_usuario` FOREIGN KEY (`user_in`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `FK_msj_user_usuario_2` FOREIGN KEY (`user_out`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD CONSTRAINT `FK_publicaciones_grupos` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id`),
  ADD CONSTRAINT `FK_publicaciones_usuario` FOREIGN KEY (`id_usuarios`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `publicaciones_comentario`
--
ALTER TABLE `publicaciones_comentario`
  ADD CONSTRAINT `FK_publicaciones_comentario_publicaciones` FOREIGN KEY (`publicaciones_id`) REFERENCES `publicaciones` (`id`),
  ADD CONSTRAINT `FK_publicaciones_comentario_usuario` FOREIGN KEY (`usuarios_id`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `recover`
--
ALTER TABLE `recover`
  ADD CONSTRAINT `FK_recover_usuario` FOREIGN KEY (`id_user`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_usuario_ciudades` FOREIGN KEY (`ciudad`) REFERENCES `ciudades` (`idCiudad`),
  ADD CONSTRAINT `FK_usuario_rol` FOREIGN KEY (`rol`) REFERENCES `rol` (`id`);

--
-- Filtros para la tabla `usuario_grupo`
--
ALTER TABLE `usuario_grupo`
  ADD CONSTRAINT `FK_usuario_grupo_grupos` FOREIGN KEY (`id_grupos`) REFERENCES `grupos` (`id`),
  ADD CONSTRAINT `FK_usuario_grupo_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
