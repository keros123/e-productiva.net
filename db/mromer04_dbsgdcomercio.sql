-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-07-2026 a las 03:34:22
-- Versión del servidor: 10.11.18-MariaDB-log
-- Versión de PHP: 8.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mromer04_dbsgdcomercio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprendices_certificados`
--

CREATE TABLE `aprendices_certificados` (
  `idaprendices_certificados` int(11) NOT NULL,
  `nombres` varchar(100) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `documento` varchar(15) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `foto` varchar(200) NOT NULL,
  `numero_ficha` varchar(20) NOT NULL,
  `caracterizacion` varchar(300) NOT NULL,
  `modalidad` varchar(255) NOT NULL,
  `fin_practica` varchar(15) NOT NULL,
  `fecha_certificacion` date NOT NULL,
  `password_aprendiz` varchar(50) NOT NULL,
  `nombre_empresa` varchar(100) NOT NULL,
  `direccion_empresa` varchar(100) NOT NULL,
  `municipio` varchar(45) NOT NULL,
  `departamento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `aprendices_certificados`
--

INSERT INTO `aprendices_certificados` (`idaprendices_certificados`, `nombres`, `apellidos`, `documento`, `telefono`, `email`, `foto`, `numero_ficha`, `caracterizacion`, `modalidad`, `fin_practica`, `fecha_certificacion`, `password_aprendiz`, `nombre_empresa`, `direccion_empresa`, `municipio`, `departamento`) VALUES
(1, 'KAROL YULIANNA', 'SANABRIA ROJAS', '1232460825', '3112106441', 'jcmp.marcos@gmail.com', 'assets/img/interface/profile.png', '22222', 'Transporte Fluvial', ' C. Aprendizaje', '2026-06-02', '2026-06-03', '123', 'SERVICIO NACIONAL DE APRENDIZAJE, SENA', 'Carrera 9 71N-60', '	CARTAGENA	', '	Bolivar	'),
(2, 'JULIAN ALEJANDRO', 'AVENDAÑO SIERRA', '1232460819', '3223158974', 'jcmp.marcos@gmail.com', 'assets/img/interface/profile.png', '22222', 'Transporte Fluvial', ' C. Aprendizaje', '2026-06-03', '2026-06-05', '1n3s900731', 'AGENCIA DE ADUANAS REPRESENTACIONES J. GUTIERREZ SAS. NIVEL 1', 'CL 22 N AV CAMILO DAZA 12 85 ZN INDUSTRIAL', '	CUCUTA	', '	Norte de Santander	');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aprendiz`
--

CREATE TABLE `aprendiz` (
  `idaprendiz` int(11) NOT NULL,
  `ficha_idficha` int(11) NOT NULL,
  `tipo_documento_idtipo_documento` int(11) NOT NULL,
  `documento` varchar(20) DEFAULT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `password_aprendiz` varchar(45) DEFAULT NULL,
  `url_foto` varchar(100) DEFAULT NULL,
  `aval` varchar(15) DEFAULT NULL,
  `estado_aprendiz_idestado_aprendiz` int(11) NOT NULL,
  `etapa_practica` varchar(1) NOT NULL,
  `novedad` varchar(900) NOT NULL,
  `url_archivoFormato` varchar(900) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `aprendiz`
--

INSERT INTO `aprendiz` (`idaprendiz`, `ficha_idficha`, `tipo_documento_idtipo_documento`, `documento`, `nombres`, `apellidos`, `telefono`, `email`, `password_aprendiz`, `url_foto`, `aval`, `estado_aprendiz_idestado_aprendiz`, `etapa_practica`, `novedad`, `url_archivoFormato`) VALUES
(2, 6, 1, '1000789354', 'LAURA SOFIA', 'RINCON RODRIGUEZ', '3168664643', 'laurarinconr258@gmail.com', '1000789354', NULL, NULL, 3, '', '', ''),
(3, 6, 1, '777777', 'EMILEN ANDREA', 'ARREDONDO ACOSTA', '3226527788', 'emilenandrea22@hotmail.com', '1001144237', NULL, NULL, 2, '2', '', ''),
(5, 6, 1, '888888', 'ERIKA JOHANNA', 'LOZANO VELASCO', '3158096409', 'erikalozano584@hotmail.com', '1003689584', NULL, NULL, 2, '2', '', ''),
(6, 6, 1, '1004136153', 'KATHERIN DAYANA', 'YAQUENO MERCHANCANO', '3148869152', 'dayanayaqueno023@gmail.com', '1004136153', NULL, NULL, 3, '', '', ''),
(7, 6, 1, '999999', 'YULIANA PAOLA', 'ROMO GUTIERREZ', '3012048603', 'yulianaromogutierrez@hotmail.com', '1004271269', NULL, NULL, 3, '', '', ''),
(8, 6, 1, '1005281671', 'LAURA DANIELA', 'GUERRERO RODRIGUEZ', '3219437663', 'ladaguero711@gmail.com', '1005281671', NULL, NULL, 2, '', '', ''),
(9, 6, 1, '1005825583', 'ANYI CAROLINA', 'QUICENO JIMENEZ', '3202131184', 'anyicarolinajimenez@gmail.com', '1005825583', NULL, NULL, 2, '', '', ''),
(10, 6, 1, '1006053440', 'PAOLA ANDREA', 'VARGAS ZULETA', '3027495770', 'paola.3987057@gmail.com', '1006053440', NULL, NULL, 2, '', '', ''),
(11, 6, 1, '1007071368', 'LUIS ENRIQUE', 'RIVERA MALDONADO', '3042821731', 'lrmaldonado1999@gmail.com', '1007071368', NULL, NULL, 2, '', '', ''),
(12, 6, 1, '1007396032', 'CRISTIAN GIOVANY', 'ORTIZ RICO', '3003222289', 'cristian222.co18@gmail.com', '1007396032', NULL, NULL, 2, '', '', ''),
(13, 6, 1, '1007768460', 'SARA MELISA', 'BARRIOS POSADA', '3148464094', 'mely.posada03@gmail.com', '1007768460', NULL, NULL, 2, '', '', ''),
(14, 6, 1, '1007825372', 'MARLING DAYANA', 'BERMUDEZ ARBOLEDA', '3001514901', 'marlingb280@gmail.com', '1007825372', NULL, NULL, 2, '', '', ''),
(15, 6, 1, '1016013192', 'STEPHAN GIOVANI', 'GONZALEZ CASTELLANOS', '3132755545', 'giogonzalez0210@hotmail.com', '1016013192', NULL, NULL, 2, '', '', ''),
(16, 6, 1, '1020102925', 'STEFANNY', 'ALZATE PIEDRAHITA', '3012935485', 'stefannyalzate01@gmail.com', '1020102925', NULL, NULL, 3, '', '', ''),
(17, 6, 1, '1020740213', 'DIANA MARCELA', 'CASTRO RAMIREZ', '3144568058', 'nanacastro0127@gmail.com', '1020740213', NULL, NULL, 2, '', '', ''),
(18, 6, 1, '1021398377', 'DIDIER SANTIAGO', 'CASTRO RICAURTE', '3132635318', 'sc05569223@gmail.com', '1021398377', NULL, NULL, 2, '', '', ''),
(19, 6, 1, '1022146113', 'SHARON AELYN', 'RIVAS COUTIN', '3235189881', 'sharonaelyn@gmail.com', '1022146113', NULL, NULL, 3, '', '', ''),
(20, 6, 1, '1026575795', 'LUISA FERNANDA', 'GUTIERREZ SANCHEZ', '3102037599', 'auxiliarwindows@hotmail.com', '1026575795', NULL, NULL, 3, '', '', ''),
(21, 6, 1, '1028032532', 'YULIANA', 'GONZALEZ RESTREPO', '3023872088', 'yuliana.gonzalez970@gmail.com', '1028032532', NULL, NULL, 2, '', '', ''),
(22, 6, 1, '1032411817', 'ANGELA PATRICIA', 'TORRES', '', 'angelitatorres219@gmail.com', '1032411817', NULL, NULL, 3, '', '', ''),
(23, 6, 1, '1034656199', 'PAULA ANDREA', 'CRUZ HERNANDEZ', '3118251784', 'paulaandrea1034@gmail.com', '1034656199', NULL, NULL, 2, '', '', ''),
(24, 6, 1, '1035851952', 'ALBA JULIET', 'ARENAS SALDARRIAGA', '3002111028', 'julietharenas040@gmail.com', '1035851952', NULL, NULL, 2, '', '', ''),
(25, 6, 1, '1035855173', 'FRANCI ALEJANDRA', 'CASAS VELASQUEZ', '3007334616', 'alejandravelasquez899@gmail.com', '1035855173', NULL, NULL, 6, '', '', ''),
(26, 6, 1, '1036671098', 'MANUELA ANDREA', 'OCHOA ALZATE', '3205173231', 'ochoa8880@gmail.com', '1036671098', NULL, NULL, 2, '', '', ''),
(27, 6, 1, '1039465643', 'VALENTINA', 'MONTOYA HOYOS', '', 'valentinamontoyahoyos@gmail.com', '1039465643', NULL, NULL, 2, '', '', ''),
(28, 6, 1, '1042421149', 'JORGE LUIS', 'RODRIGUEZ CONTRERAS', '3054367112', 'rodriguezjorge634@gmail.com', '1042421149', NULL, NULL, 2, '', '', ''),
(29, 6, 1, '1044618567', 'PAULA ANDREA', 'ACUÑA FERNANDEZ', '3003695650', 'acunafernandezpaulaandrea@gmail.com', '1044618567', NULL, NULL, 2, '', '', ''),
(30, 6, 1, '1052399017', 'MARIA ANTONIA', 'ESLAVA NIÑO', '3203235921', 'antonela_090710@hotmail.com', '1052399017', NULL, NULL, 3, '', '', ''),
(31, 6, 1, '1054541818', 'MARIA JENIFER', 'RODRIGUEZ CAÑON', '3107951224', 'mariajeniferodriguez2018@gmail.com', '1054541818', NULL, NULL, 2, '', '', ''),
(32, 6, 1, '1062527397', 'GERALDINE', 'GUERRA RAMOS', '3004541768', 'geraldinguerraramos@gmail.com', '1062527397', NULL, NULL, 3, '', '', ''),
(33, 6, 1, '1069494251', 'ANGIE LISSETH', 'ROMERO DIAZ', '3008292280', 'lissethdiaz1417@gmail.com', '1069494251', NULL, NULL, 2, '', '', ''),
(34, 6, 1, '1072421310', 'ERIKA MARIA', 'VARON OVALLE', '3142916488', 'varonerika66@gmail.com', '1072421310', NULL, NULL, 3, '', '', ''),
(35, 6, 1, '1079654713', 'SILENA MARIA', 'TORRIJO BARRERA', '3103507097', 'silebarre06@gmail.com', '1079654713', NULL, NULL, 2, '', '', ''),
(36, 6, 1, '1082156284', 'ANGELA PATRICIA', 'CHARRY MESA', '', 'angelitacharry@outlook.com', '1082156284', NULL, NULL, 2, '', '', ''),
(37, 6, 1, '1082408900', 'MADELEY', 'BLANCO ROMERO', '3113937082', 'madejuli300@gmail.com', '1082408900', NULL, NULL, 2, '', '', ''),
(38, 6, 1, '1085263025', 'XIMENA DEL CARMEN', 'POTOSI CRIOLLO', '3217927611', 'ximenatp1896@gmail.com', '1085263025', NULL, NULL, 3, '', '', ''),
(39, 6, 1, '1085304942', 'VANESSA ALEXANDRA', 'BRAVO GUACALES', '3185274004', 'cbattery07@gmail.com', '1085304942', NULL, NULL, 2, '', '', ''),
(40, 6, 1, '1085324585', 'INGRID TATIANA', 'ROSERO MORALES', '3104732440', 'tatianaroseromorales@gmail.com', '1085324585', NULL, NULL, 2, '', '', ''),
(41, 6, 1, '1086103514', 'DEICY PAOLA', 'COLIMBA GUACHA', '3177640467', 'colimbaguachadeycipaola@gmail.com', '1086103514', NULL, NULL, 3, '', '', ''),
(42, 6, 1, '1087046523', 'WILMER ELYAN', 'CASTRO RODRIGUEZ', '3226518230', 'wcr2503@gmail.com', '1087046523', NULL, NULL, 3, '', '', ''),
(43, 6, 1, '1088322031', 'JEISON DAVID', 'QUICENO PATIÑO', '3103610646', 'jeikson.10@gmail.com', '1088322031', NULL, NULL, 2, '', '', ''),
(44, 6, 1, '1088338216', 'LUISA FERNANDA', 'GARCIA ARDILA', '3127446597', 'luisafernandagarcia1003@gmail.com', '1088338216', NULL, NULL, 2, '', '', ''),
(45, 6, 1, '1089905355', 'MARITZA YULEIDY', 'ERASO YELA', '3215308600', 'maritzaeraso0@gmail.com', '1089905355', NULL, NULL, 3, '', '', ''),
(46, 6, 1, '1094169391', 'JOSE MANUEL', 'GOMEZ RODRIGUEZ', '', 'anuelgr18@gmail.com', '1094169391', NULL, NULL, 3, '', '', ''),
(47, 6, 1, '1100246416', 'YULIANA', 'CUELLO ARCIA', '', 'yulianacuelloarcia@gmail.com', '1100246416', NULL, NULL, 2, '', '', ''),
(48, 6, 1, '1100622908', 'LUISA FERNANDA', 'PEREZ RUBIO', '3176494911', 'lurubio03@gmail.com', '1100622908', NULL, NULL, 2, '', '', ''),
(49, 6, 1, '1101076331', 'GIOVANNI', 'SARMIENTO ROMERO', '3133480263', 'giosaro96@hotmail.com', '1101076331', NULL, NULL, 3, '', '', ''),
(50, 6, 1, '1117016718', 'VALENTINA', 'ANDRADE NOREÑA', '3154412750', 'andradevalentina678@gmail.com', '1117016718', NULL, NULL, 2, '', '', ''),
(51, 6, 1, '1118308834', 'JHON SEBASTIAN', 'HERNANDEZ ORDOÑEZ', '3107202120', 'johnsebastian1208@hotmail.com', '1118308834', NULL, NULL, 2, '', '', ''),
(52, 6, 1, '1118561658', 'LINA MARISOL', 'CALDERON BALCARCEL', '3123893244', 'alexlincldrn1619@gmail.com', '1118561658', NULL, NULL, 2, '', '', ''),
(53, 6, 1, '1118568074', 'MARIA CAROLINA', 'CARO MONTAÑA', '3209784399', 'caritomontana_1997@hotmail.com', '1118568074', NULL, NULL, 2, '', '', ''),
(54, 6, 1, '1128106592', 'MARYLUZ', 'ALVAREZ ZARATE', '3226121850', 'marialvarez1712@gmail.com', '1128106592', NULL, NULL, 2, '', '', ''),
(55, 6, 1, '1143159410', 'JUAN DIEGO', 'MENDEZ HERRERA', '3042422099', 'jd.mendez136@gmail.com', '1143159410', NULL, NULL, 2, '', '', ''),
(56, 6, 1, '1143970564', 'KELLY JOHANNA', 'SANCHEZ GUERRERO', '3137365711', 'kjohana0126@outlook.com', '1143970564', NULL, NULL, 1, '', '', ''),
(57, 6, 1, '1144058585', 'JUAN CAMILO', 'GARCIA GIRALDO', '3146276043', 'juang.giraldo93@gmail.com', '1144058585', NULL, NULL, 2, '', '', ''),
(58, 6, 1, '1193200650', 'JULIETH FERNANDA', 'BELTRAN CASANOVA', '3004422685', 'beltranf614@gmail.com', '1193200650', NULL, NULL, 2, '', '', ''),
(59, 6, 1, '1193271849', 'JOHANA ESTEFANIA', 'VILLOTA CORDOBA', '3136315651', 'estefita1111@gmail.com', '1193271849', NULL, NULL, 3, '', '', ''),
(60, 6, 1, '1193513969', 'MICHEL DAYANA', 'DURAN OLARTE', '3115291395', 'michelduran263@hotmail.com', '1193513969', NULL, NULL, 2, '', '', ''),
(61, 6, 1, '222222', 'LUIS FELIPE', 'VELASCO REYES', '3154031534', 'pipo1218@gmail.com', '14651925', NULL, NULL, 2, '2', '', ''),
(62, 6, 1, '333333', 'ANA DOLORES', 'SAUCEDO JIMENEZ', '3114137141', 'osialina@gmail.com', '22591984', NULL, NULL, 2, '2', '', ''),
(63, 6, 1, '444444', 'YENNY YULIETH', 'RIVERA ARIAS', '3023408809', 'yeyu2111@gmail.com', '38644412', NULL, NULL, 2, '2', '', ''),
(64, 6, 1, '555555', 'MARIA NAIDU', 'BEJARANO MONTAÑEZ', '3206510690', 'mariabejarano806@hotmail.com', '52966055', NULL, NULL, 2, '2', '', ''),
(65, 6, 1, '666666', 'RICARDO ABAD', 'GUERRERO GOMEZ', '3112836797', 'abadtqacin@hotmail.com', '80913398', NULL, NULL, 2, '2', '', ''),
(67, 6, 2, '1011323426', 'GABRIELA', 'ESCOBAR BRICEÑO', '3209227960', 'gabriela.escobarbriceno07@gmail.com', '1011323426', NULL, NULL, 2, '', '', ''),
(68, 6, 2, '1083467570', 'DIANA MARCELA', 'FUENTES RAMIREZ', '', 'nanafuentes1503@gmail.com', '1083467570', NULL, NULL, 2, '', '', ''),
(69, 6, 2, '1089076994', 'SHARIK VALENTINA', 'ORTIIZ NARVAEZ', '3147642530', 'maldo1089076994@gmail.com', '1089076994', NULL, NULL, 2, '', '', ''),
(70, 6, 2, '1122515498', 'ABNER ISAAC', 'OBANDO FORERO', '3134101081', 'abnerobando07@gmail.com', '1122515498', NULL, NULL, 2, '', '', ''),
(71, 6, 2, '1188963797', 'JEISSON ALEXSANDER', 'VASQUEZ SANCHEZ', '3009828524', 'sanchezjeisson71@gmail.com', '1188963797', NULL, NULL, 3, '', '', ''),
(72, 7, 1, '1007855309', 'valentina', 'orozco nieves', '3174169433', 'orozco05valentina@gmail.com', '1007855309V', NULL, NULL, 2, '2', '', ''),
(73, 6, 1, '111111', 'MARTIN ', 'LOPEZ PEREZ', '3111111111', 'maipalmettne@gmail.com', 'Sena2026*', NULL, NULL, 2, '2', '', ''),
(76, 8, 1, '1232460800', 'JOHAN CAMILO', 'CABRA CELY', '3146540949', 'jcmp.marcos@gmail.com', '1232460800', NULL, NULL, 2, '', '', ''),
(77, 8, 1, '1232460801', 'NICOLAS ALBEIRO', 'BUITRAGO RODRIGUEZ', '3204794712', 'jcmp.marcos@gmail.com', '1232460801', NULL, NULL, 2, '', '', ''),
(78, 8, 1, '1232460802', 'YEISON JAVIER', 'CUADROS MORALES', '3203150314', 'jcmp.marcos@gmail.com', '1232460802', NULL, NULL, 2, '2', '', ''),
(79, 8, 1, '1232460803', 'DAYBER', 'PEREZ AMAYA', '3133138688', 'jcmp.marcos@gmail.com', '1232460803', NULL, NULL, 2, '', '', ''),
(80, 8, 1, '1232460804', 'YONATAN DAVID', 'GOMEZ BOLIVAR', '3114510822', 'jcmp.marcos@gmail.com', '1232460804', NULL, NULL, 2, '', '', ''),
(81, 8, 1, '1232460805', 'JUAN DAVID', 'JAIMES GALLEGO', '3228388579', 'jcmp.marcos@gmail.com', '1232460805', NULL, NULL, 2, '2', '', ''),
(82, 8, 1, '1232460806', 'NICOLAS', 'VASQUEZ MAHECHA', '3115019848', 'jcmp.marcos@gmail.com', '1232460806', NULL, NULL, 2, '', '', ''),
(83, 8, 1, '1232460807', 'SEBASTIAN RICARDO', 'AREVALO RINCON', '3113442987', 'jcmp.marcos@gmail.com', '1232460807', NULL, NULL, 2, '2', '', ''),
(84, 8, 1, '1232460808', 'DANIEL ESTEBAN', 'CUSVA TORRES', '3184729234', 'jcmp.marcos@gmail.com', '1232460808', NULL, NULL, 2, '', '', ''),
(85, 8, 1, '1232460809', 'SANTIAGO ALEJANDRO', 'TAVERA TUNAROSA', '3228146416', 'jcmp.marcos@gmail.com', '1232460809', NULL, NULL, 2, '', '', ''),
(86, 8, 1, '1232460810', 'JHOAN SEBASTIAN', 'MEDINA MALAGON', '3112969375', 'jcmp.marcos@gmail.com', '1232460810', NULL, NULL, 2, '', '', ''),
(87, 8, 1, '1232460811', 'ANDRES RODOLFO', 'CORREDOR DIAZ', '3138671623', 'jcmp.marcos@gmail.com', '1232460811', NULL, NULL, 2, '2', '', ''),
(88, 8, 1, '1232460812', 'JOSE LUIS', 'CRISTIANO CORREDOR', '3138070134', 'jcmp.marcos@gmail.com', '1232460812', NULL, NULL, 2, '', '', ''),
(89, 8, 1, '1232460813', 'CESAR ALEXANDER', 'ALVAREZ NOSSA', '3001234567', 'jcmp.marcos@gmail.com', '1232460813', NULL, NULL, 2, '', '', ''),
(90, 8, 1, '1232460814', 'BRAYAN DAVID', 'RODRIGUEZ MERCHAN', '3054089836', 'jcmp.marcos@gmail.com', '1232460814', NULL, NULL, 2, '', '', ''),
(91, 8, 1, '1232460815', 'JULIAN JAVIER', 'JIMENEZ PEÑA', '3143544693', 'jcmp.marcos@gmail.com', '1232460815', NULL, NULL, 2, '', '', ''),
(92, 8, 1, '1232460816', 'CRISTIAN CAMILO', 'PARRA MUÑOZ', '3106196885', 'jcmp.marcos@gmail.com', '1232460816', NULL, NULL, 2, '', '', ''),
(93, 8, 1, '1232460817', 'GIOVANI ESTEBAN', 'HERRERA PEDRAZA', '3232390017', 'jcmp.marcos@gmail.com', '1232460817', NULL, NULL, 2, '', '', ''),
(94, 8, 1, '1232460818', 'OSMAN FERNEY', 'RODRIGUEZ PEÑA', '3015193572', 'jcmp.marcos@gmail.com', '1232460818', NULL, NULL, 2, '', '', ''),
(95, 8, 1, '1232460819', 'JULIAN ALEJANDRO', 'AVENDAÑO SIERRA', '3223158974', 'jcmp.marcos@gmail.com', '1n3s900731', NULL, NULL, 1, '2', '', ''),
(96, 8, 1, '1232460820', 'EDWIN STIVEN', 'AREVALO ALARCON', '3104487717', 'jcmp.marcos@gmail.com', '1232460820', NULL, NULL, 2, '', '', ''),
(97, 8, 1, '1232460821', 'DAVID SANTIAGO', 'FIGUEREDO RINCON', '3223281410', 'jcmp.marcos@gmail.com', '1232460821', NULL, NULL, 2, '', '', ''),
(98, 8, 1, '1232460822', 'WILSON FERNANDO', 'ACEVEDO CEPEDA', '3214820089', 'jcmp.marcos@gmail.com', '1232460822', NULL, NULL, 2, '', '', ''),
(99, 8, 1, '1232460823', 'KEINER ESTEBAN', 'GUERRERO CRUZ', '3125812244', 'jcmp.marcos@gmail.com', '1232460823', NULL, NULL, 2, '', '', ''),
(100, 8, 1, '1232460824', 'ANDRES FELIPE', 'RINCON MACHADO', '3114457442', 'jcmp.marcos@gmail.com', '1232460824', NULL, NULL, 2, '', '', ''),
(101, 8, 1, '1232460825', 'KAROL YULIANNA', 'SANABRIA ROJAS', '3112106441', 'jcmp.marcos@gmail.com', '123', NULL, NULL, 1, '2', '', ''),
(102, 8, 1, '1232460826', 'TANIA JIMENA', 'PEDRAZA CUBIDES', '3229487114', 'jcmp.marcos@gmail.com', '1232460826', NULL, NULL, 10, '', '', ''),
(103, 8, 4, '1232460827', 'FREDY ALEXANDER', 'AYURE FULA', '3203730450', 'jcmp.marcos@gmail.com', '1232460827', NULL, NULL, 8, '', '', ''),
(104, 9, 1, '1002460000', 'ROBERT STIVEN', 'BECERRA BECERRA', '3219933605', 'jcmp.marcos@gmail.com', '1002460000', NULL, NULL, 5, '', '', ''),
(105, 9, 1, '1232460800', 'JOHAN CAMILO', 'CABRA CELY', '3146540949', 'jcmp.marcos@gmail.com', '1232460800', NULL, NULL, 2, '', '', ''),
(106, 9, 1, '1232460801', 'NICOLAS ALBEIRO', 'BUITRAGO RODRIGUEZ', '3204794712', 'jcmp.marcos@gmail.com', '1232460801', NULL, NULL, 2, '', '', ''),
(107, 9, 1, '1232460802', 'YEISON JAVIER', 'CUADROS MORALES', '3203150314', 'jcmp.marcos@gmail.com', '1232460802', NULL, NULL, 2, '', '', ''),
(108, 9, 1, '1232460803', 'DAYBER', 'PEREZ AMAYA', '3133138688', 'jcmp.marcos@gmail.com', '1232460803', NULL, NULL, 2, '', '', ''),
(109, 9, 1, '1232460804', 'YONATAN DAVID', 'GOMEZ BOLIVAR', '3114510822', 'jcmp.marcos@gmail.com', '1232460804', NULL, NULL, 2, '', '', ''),
(110, 9, 1, '1232460805', 'JUAN DAVID', 'JAIMES GALLEGO', '3228388579', 'jcmp.marcos@gmail.com', '1232460805', NULL, NULL, 2, '', '', ''),
(111, 9, 1, '1232460806', 'NICOLAS', 'VASQUEZ MAHECHA', '3115019848', 'jcmp.marcos@gmail.com', '1232460806', NULL, NULL, 2, '', '', ''),
(112, 9, 1, '1232460807', 'SEBASTIAN RICARDO', 'AREVALO RINCON', '3113442987', 'jcmp.marcos@gmail.com', '1232460807', NULL, NULL, 2, '', '', ''),
(113, 9, 1, '1232460808', 'DANIEL ESTEBAN', 'CUSVA TORRES', '3184729234', 'jcmp.marcos@gmail.com', '1232460808', NULL, NULL, 2, '', '', ''),
(114, 9, 1, '1232460809', 'SANTIAGO ALEJANDRO', 'TAVERA TUNAROSA', '3228146416', 'jcmp.marcos@gmail.com', '1232460809', NULL, NULL, 2, '', '', ''),
(115, 9, 1, '1232460810', 'JHOAN SEBASTIAN', 'MEDINA MALAGON', '3112969375', 'jcmp.marcos@gmail.com', '1232460810', NULL, NULL, 2, '', '', ''),
(116, 9, 1, '1232460811', 'ANDRES RODOLFO', 'CORREDOR DIAZ', '3138671623', 'jcmp.marcos@gmail.com', '1232460811', NULL, NULL, 2, '', '', ''),
(117, 9, 1, '1232460812', 'JOSE LUIS', 'CRISTIANO CORREDOR', '3138070134', 'jcmp.marcos@gmail.com', '1232460812', NULL, NULL, 2, '', '', ''),
(118, 9, 1, '1232460813', 'CESAR ALEXANDER', 'ALVAREZ NOSSA', '3001234567', 'jcmp.marcos@gmail.com', '1232460813', NULL, NULL, 2, '', '', ''),
(119, 9, 1, '1232460814', 'BRAYAN DAVID', 'RODRIGUEZ MERCHAN', '3054089836', 'jcmp.marcos@gmail.com', '1232460814', NULL, NULL, 2, '', '', ''),
(120, 9, 1, '1232460815', 'JULIAN JAVIER', 'JIMENEZ PEÑA', '3143544693', 'jcmp.marcos@gmail.com', '1232460815', NULL, NULL, 2, '', '', ''),
(121, 9, 1, '1232460816', 'CRISTIAN CAMILO', 'PARRA MUÑOZ', '3106196885', 'jcmp.marcos@gmail.com', '1232460816', NULL, NULL, 2, '', '', ''),
(122, 9, 1, '1232460817', 'GIOVANI ESTEBAN', 'HERRERA PEDRAZA', '3232390017', 'jcmp.marcos@gmail.com', '1232460817', NULL, NULL, 2, '', '', ''),
(123, 9, 1, '1232460818', 'OSMAN FERNEY', 'RODRIGUEZ PEÑA', '3015193572', 'jcmp.marcos@gmail.com', '1232460818', NULL, NULL, 2, '', '', ''),
(124, 9, 1, '1232460819', 'JULIAN ALEJANDRO', 'AVENDAÑO SIERRA', '3223158974', 'jcmp.marcos@gmail.com', '1232460819', NULL, NULL, 2, '', '', ''),
(125, 9, 1, '1232460820', 'EDWIN STIVEN', 'AREVALO ALARCON', '3104487717', 'jcmp.marcos@gmail.com', '1232460820', NULL, NULL, 2, '', '', ''),
(126, 9, 1, '1232460821', 'DAVID SANTIAGO', 'FIGUEREDO RINCON', '3223281410', 'jcmp.marcos@gmail.com', '1232460821', NULL, NULL, 2, '', '', ''),
(127, 9, 1, '1232460822', 'WILSON FERNANDO', 'ACEVEDO CEPEDA', '3214820089', 'jcmp.marcos@gmail.com', '1232460822', NULL, NULL, 2, '', '', ''),
(128, 9, 1, '1232460823', 'KEINER ESTEBAN', 'GUERRERO CRUZ', '3125812244', 'jcmp.marcos@gmail.com', '1232460823', NULL, NULL, 2, '', '', ''),
(129, 9, 1, '1232460824', 'ANDRES FELIPE', 'RINCON MACHADO', '3114457442', 'jcmp.marcos@gmail.com', '1232460824', NULL, NULL, 2, '', '', ''),
(130, 9, 1, '1232460825', 'KAROL YULIANNA', 'SANABRIA ROJAS', '3112106441', 'jcmp.marcos@gmail.com', '1232460825', NULL, NULL, 2, '', '', ''),
(131, 9, 1, '1232460826', 'TANIA JIMENA', 'PEDRAZA CUBIDES', '3229487114', 'jcmp.marcos@gmail.com', '1232460826', NULL, NULL, 10, '', '', ''),
(132, 9, 4, '1232460827', 'FREDY ALEXANDER', 'AYURE FULA', '3203730450', 'jcmp.marcos@gmail.com', '1232460827', NULL, NULL, 8, '', '', ''),
(133, 10, 1, '1002248368', 'LUZ MERIS', 'OTERO SIMANCA', '3053074044', 'luzmerisotero09@gmail.com', '1002248368', NULL, NULL, 2, '', '', ''),
(134, 10, 1, '1002248457', 'MICHEL ALEXANDRA', 'BOLAÑO LAMBRAÑO', '3042568657', 'michellbolano14@gmail.com', '1002248457', NULL, NULL, 5, '', '', ''),
(135, 10, 1, '1002392716', 'BRANDY YULEISY', 'PINO IRIARTE', '3004962579', 'brandypino17@gmail.com', '1002392716', NULL, NULL, 2, '', '', ''),
(136, 10, 1, '1007170658', 'YURANIS PAOLA', 'RUIZ URBINA', '3014179315', 'Yuraruizurbina85@gmail.com', '1007170658', NULL, NULL, 2, '', '', ''),
(137, 10, 1, '1007313839', 'JAIRA MARIA', 'BARBERO MURILLO', '3242169468', 'murillojaira@hotmail.com', '1007313839', NULL, NULL, 2, '', '', ''),
(138, 10, 1, '1007980232', 'ANDREA CAROLINA', 'MENDOZA FERIA', '3023832907', 'andrea.carolina24031@gmail.com', '1007980232', NULL, NULL, 2, '', '', ''),
(139, 10, 1, '1007983074', 'SUSANA MARIA', 'VALENCIA PEREZ', '3004741722', 'valenciasusy96@gmail.com', '1007983074', NULL, NULL, 2, '', '', ''),
(140, 10, 1, '1041970811', 'MARIA FERNANDA', 'GAVIRIA VILORIA', '3003014662', 'Mafegaviria2023@gmail.com', '1041970811', NULL, NULL, 2, '', '', ''),
(141, 10, 1, '1043294186', 'ROSARIO', 'RODRIGUEZ ARENILLA', '3184931583', 'rosariorodriguezarenilla01@gmail.com', '1043294186', NULL, NULL, 2, '', '', ''),
(142, 10, 1, '1043961101', 'JAVIER ENRIQUE', 'SANTOS BARRIOS', '3145251281', 'javiersantosbarrios8@gmail.com', '1043961101', NULL, NULL, 2, '', '', ''),
(143, 10, 1, '1043971946', 'YUSUKE', 'SUZUKI MARTELO', '3145197846', 'koyukiyuki96@gmail.com', '1043971946', NULL, NULL, 3, '', '', ''),
(144, 10, 1, '1047432349', 'NORELYS', 'QUIROGA SIMANCA', '3006558766', 'norelysquirogasimancad@gmail.com', '1047432349', NULL, NULL, 2, '', '', ''),
(145, 10, 1, '1047449002', 'ROSED JANINA', 'AGRESOTT MERCADO', '3008514758', 'janina0714@gmail.com', '1047449002', NULL, NULL, 2, '', '', ''),
(146, 10, 1, '1047497640', 'SUSANA ESTHER', 'DIZ JINETE', '3233914522', 'susanajinete-14@hotmail.com', '1047497640', NULL, NULL, 2, '', '', ''),
(147, 10, 1, '1047501159', 'MAYER LEIVIS', 'GUTIERREZ ALVAREZ', '3023060936', 'mayergutierrez98@gmail.com', '1047501159', NULL, NULL, 2, '', '', ''),
(148, 10, 1, '1048436241', 'JOEL DE JESUS', 'HURTADO BRAVO', '3243519752', 'asney0414@hotmail.com', '1048436241', NULL, NULL, 5, '', '', ''),
(149, 10, 1, '1048439689', 'FRANYELIS', 'MIRANDA MIRANDA', '3207498159', 'carolainmiranda96@gmail.com', '1048439689', NULL, NULL, 5, '', '', ''),
(150, 10, 1, '1137219846', 'LICET', 'CONTRERA CORTES', '', 'licethcontrera402@gmail.com', '1137219846', NULL, NULL, 2, '', '', ''),
(151, 10, 1, '1193596810', 'LUIS ANGEL', 'MIRANDA GARIZABAL', '3023638275', 'luisangel211003@gmail.com', '1193596810', NULL, NULL, 5, '', '', ''),
(152, 10, 1, '38793515', 'LAURA', 'GONZALEZ TRIVIÑO', '323888244', 'lumagon-0203@hotmail.com', '38793515', NULL, NULL, 2, '', '', ''),
(153, 10, 1, '45547564', 'PAOLA VIVIANA', 'GARCIA APONTE', '3024388500', 'Paogarcia1983@outlook.com', '45547564', NULL, NULL, 5, '', '', ''),
(154, 10, 1, '45686431', 'NOHEMI', 'PUELLO MEZA', '3135739365', 'nopume@hotmail.com', '45686431', NULL, NULL, 6, '', '', ''),
(155, 10, 4, '5209217', 'ANGEL GABRIEL', 'ROMERO BLANCO', '', 'arblanco685@gmail.com', '5209217', NULL, NULL, 2, '', '', ''),
(156, 10, 4, '6236942', 'YOLIMAR', 'PEREZ MADERO', '3017585644', 'yolimarperezmadero.312007@gmail.com', '6236942', NULL, NULL, 2, '', '', ''),
(157, 10, 2, '1043974613', 'ANGEL GABRIEL', 'MAURY BERNATE', '3007654013', 'angelgmauryb@gmail.com', '1043974613', NULL, NULL, 5, '', '', ''),
(158, 10, 2, '1043977078', 'DIEGO ANDRES', 'ROA BUSTILLO', '3023122893', 'roabustillodiego@gmail.com', '1043977078', NULL, NULL, 2, '', '', ''),
(159, 10, 2, '1050953685', 'ANGIE PAOLA', 'BABILONIA BATISTA', '3013813785', 'batistangie1313@gmail.com', '1050953685', NULL, NULL, 2, '', '', ''),
(160, 10, 2, '1100335979', 'YORDAN ANDRES', 'RODRIGUEZ DE LA CRUZ', '3235283433', 'yordan2024rodriguez@gmail.com', '1100335979', NULL, NULL, 2, '', '', ''),
(161, 10, 2, '1137526762', 'DANIEL DE JESUS', 'PADILLA MUENTES', '3002402515', 'padilladanieldejesus006@gmail.com', '1137526762', NULL, NULL, 2, '', '', ''),
(162, 11, 1, '1002192821', 'SAMARA CAROLINA', 'CANTILLO TORRES', '3008917889', 'Cantillotorresxamara@gmail.com', 'O7931899r', NULL, NULL, 2, '2', '', ''),
(163, 11, 1, '1002201800', 'AURA MARGARITA', 'CARDENAS OLIVERA', '3014926686', 'adricom80@hotmail.com', '1002201800', NULL, NULL, 2, '', '', ''),
(164, 11, 1, '1002243322', 'ANDERSON', 'ARRIETA ROMERO', '3247925894', 'arrietaromeroanderson@gmail.com', '1002243322', NULL, NULL, 2, '', '', ''),
(165, 11, 1, '1007120022', 'ELIANIS', 'NAVARRO SIMARRA', '3054430014', 'Navarrosimarraelianis@gmail.com', '1007120022', NULL, NULL, 2, '', '', ''),
(166, 11, 1, '1007314172', 'YINETH PATRICIA', 'CASTRO SIARRA', '3008782665', 'castrosiarrayineth@gmail.com', '1007314172', NULL, NULL, 2, '', '', ''),
(167, 11, 1, '1010093219', 'IVAN CAMILO', 'MONROY VILLADIEGO', '3054339523', 'ivanmonroy235@gmail.com', '1010093219', NULL, NULL, 2, '', '', ''),
(168, 11, 1, '1041974350', 'SANTIAGO', 'HERNANDEZ MENDRALES', '3215614467', 'santiagohernandezmendrales@gmail.com', '1041974350', NULL, NULL, 2, '', '', ''),
(169, 11, 1, '1041981472', 'SAMUEL ANDRES', 'JIMENEZ CONSUEGRA', '3216916325', 'jimenezconsuegrasamuel@gmail.com', '1041981472', NULL, NULL, 2, '', '', ''),
(170, 11, 1, '1042583963', 'ISABELA', 'HOYOS PUELLO', '3043875631', 'isabelapuello86@gmail.com', '1042583963', NULL, NULL, 2, '', '', ''),
(171, 11, 1, '1042607495', 'MARYELIS PATRICIA', 'FLOREZ AVILA', '3013920542', 'maryelisflorez38@gmail.com', '1042607495', NULL, NULL, 2, '', '', ''),
(172, 11, 1, '1043300039', 'PABLO ANDRES', 'CASSIANI PADILLA', '3013512790', 'pablocassiani66@gmail.com', '1043300039', NULL, NULL, 2, '', '', ''),
(173, 11, 1, '1043302540', 'SEBASTIAN ANDRES', 'DE LA ROSA PEREZ', '3218701468', 'delarosaperezsebastianandres5@gmail.com', '1043302540', NULL, NULL, 2, '', '', ''),
(174, 11, 1, '1043642897', 'ROXANNA SOFIA', 'ARTEAGA PAJARO', '3004784034', 'daya.30012@gmail.com', '1043642897', NULL, NULL, 2, '', '', ''),
(175, 11, 1, '1043976349', 'KEVIN', 'PITALUA CESAR', '3145354417', 'pitaluakevin3@gmail.com', '1043976349', NULL, NULL, 2, '', '', ''),
(176, 11, 1, '1049583447', 'MARIA ANGEL', 'GOMEZ ACUÑA', '', 'gomzacu09@gmail.com', '1049583447', NULL, NULL, 2, '', '', ''),
(177, 11, 1, '1050006397', 'JOSE DAVID', 'ORTIZ PEÑA', '3045658645', 'ortizjosedavid456789@gmail.com', '1050006397', NULL, NULL, 2, '', '', ''),
(178, 11, 1, '1050953584', 'NATALIA MARIA', 'PEREZ LADEUS', '3233710056', 'iamnatyperez@gmail.com', '1050953584', NULL, NULL, 2, '', '', ''),
(179, 11, 1, '1052068798', 'FRANCISCO ALBERTO', 'GONZALEZ VALDES', '3128408093', 'franciscoalberto88@hotmail.com', '1052068798', NULL, NULL, 2, '', '', ''),
(180, 11, 1, '1052080125', 'ERNESTO LUIS', 'CABRERA PIÑEREZ', '', 'erlucapi901@gmail.com', '1052080125', NULL, NULL, 2, '', '', ''),
(181, 11, 1, '1052944146', 'SEBASTIAN', 'MARTINEZ TAPIA', '3245740717', 'martineztapiassebastian@gmail.com', '1052944146', NULL, NULL, 2, '', '', ''),
(182, 11, 1, '1073994712', 'LEIDIS DANIELA', 'HERNANDEZ BANQUETH', '3006873892', 'leidish82@gmail.com', '1073994712', NULL, NULL, 2, '', '', ''),
(183, 11, 1, '1100394637', 'JEISON ANDRES', 'ALVAREZ ATENCIA', '3226060744', 'jeysonalvarez.2006@gmail.com', '1100394637', NULL, NULL, 2, '', '', ''),
(184, 11, 1, '1124026811', 'SHERLEAN', 'VALERO PUERTA', '3008457492', 'sherleanvaleropuerta@gmail.com', '1124026811', NULL, NULL, 2, '', '', ''),
(185, 11, 1, '1128052940', 'STIVEN JOSE', 'SANCHEZ GOMEZ', '', 'stivenjosesg@gmail.com', '1128052940', NULL, NULL, 2, '', '', ''),
(186, 11, 1, '1143396224', 'ALAN JOSE', 'SANDON CONSUEGRA', '3216799766', 'alanjosesandon@gmail.com', '1143396224', NULL, NULL, 2, '', '', ''),
(187, 11, 1, '1143406740', 'MARIA JOSE', 'PITALUA PADILLA', '3006397248', 'pauttjaime03@gmail.com', '1143406740', NULL, NULL, 2, '', '', ''),
(188, 11, 1, '64582808', 'SHIRLEY PAOLA', 'PARRA IRIARTE', '', 'sparrairiarte@gmail.com', '64582808', NULL, NULL, 2, '', '', ''),
(189, 11, 1, '73205075', 'YAN CARLOS', 'GUARDO SANCHEZ', '3126514385', 'inebero1987@gmail.com', '73205075', NULL, NULL, 2, '', '', ''),
(190, 11, 4, '5289574', 'LORENA DEL CARMEN', 'GONZALEZ URDANETA', '', 'lurdaneta738@gmail.com', '5289574', NULL, NULL, 2, '', '', ''),
(191, 11, 2, '1142923815', 'KEIVIC MANUEL', 'RAMOS ZUÑIGA', '3014195441', 'ramoszunigakeivicmanuel@gmail.com', '1142923815', NULL, NULL, 2, '', '', ''),
(192, 13, 1, '1042582128', 'HELEN SOFIA', 'QUINTANA PEREIRA', '3152534962', 'helenquintanapereira1@gmail.com', '1042582128', NULL, NULL, 2, '2', '', ''),
(193, 13, 1, '1043302082', 'JAVIER JESUS', 'ORTIZ MARRUGO', '3012478986', 'jo6925191@gmail.com', '1043302082', NULL, NULL, 2, '', '', ''),
(194, 13, 1, '1043303223', 'CHELSEA PAOLA', 'SIMANCAS CASTRO', '3012933090', 'chelseapaolamagdanielscastro@gmail.com', '1043303223', NULL, NULL, 2, '', '', ''),
(195, 13, 1, '1043975467', 'VALERIN ALEJANDRA', 'DE AVILA CASTELLAR', '3242054743', 'valerideavila17@gmail.com', '1043975467', NULL, NULL, 2, '', '', ''),
(196, 13, 1, '1047403722', 'XILENA MARGARITA', 'MONTERO MENDOZA', '3008889534', 'xilenamontero09@gmail.com', '1047403722', NULL, NULL, 2, '', '', ''),
(197, 13, 1, '1101385915', 'ARIANIS', 'CHAVEZ CENTENO', '3245771532', 'centenoarianis@gmail.com', '1101385915', NULL, NULL, 2, '', '', ''),
(198, 13, 1, '1127608483', 'ADRIANA CRISTINA', 'FERIA PATERNINA', '3171306400', 'adrianaferiapaternina@gmail.com', '1127608483', NULL, NULL, 2, '', '', ''),
(199, 13, 1, '1142915717', 'CAMILO ANDRES', 'OVIEDO ESCOBAR', '3233760711', 'camiloandresoviedoescobar15@gmail.com', '1142915717', NULL, NULL, 2, '', '', ''),
(200, 13, 1, '1142916882', 'SIRLI YOHANA', 'AGAMEZ JIMENEZ', '3217194167', 'sirlyagamezjimen@gmail.com', '1142916882', NULL, NULL, 2, '', '', ''),
(201, 13, 1, '1147484470', 'ESTEBAN', 'CANTILLO TORRES', '3107130164', 'kren.8512@hotmail.com', '1147484470', NULL, NULL, 2, '', '', ''),
(202, 13, 1, '1237439574', 'DAVID GABRIEL', 'FERRAZZANO PORRAS', '3016295205', 'ferrazzadavidgabriel@gmail.com', '1237439574', NULL, NULL, 2, '', '', ''),
(203, 13, 1, '1237442605', 'ADRIANGELIS ANDREA', 'MARIN RAMOS', '3015915492', 'adriangelismarinramos@gmail.com', '1237442605', NULL, NULL, 2, '', '', ''),
(204, 13, 1, '1249071159', 'JEANNY YARAY DE LA CONCEPCION', 'INFANTE CHAVEZ', '3241624954', 'jinfantechavez3@gmail.com', '1249071159', NULL, NULL, 2, '', '', ''),
(205, 13, 4, '6577246', 'JHOJANA PATRICIA', 'PEREZ MARTINEZ', '3163027908', 'perezjhojana0@gmail.com', '6577246', NULL, NULL, 2, '', '', ''),
(206, 13, 2, '1028785474', 'MARIELA ALEJANDRA', 'ROJAS ALCAZAR', '3215863702', 'mararojas6617@gmail.com', '1028785474', NULL, NULL, 2, '', '', ''),
(207, 13, 2, '1043305002', 'THALIANA', 'MARTINEZ PEREZ', '3126244295', 'martinezperezthaliana41@gmail.com', '1043305002', NULL, NULL, 2, '', '', ''),
(208, 13, 2, '1043305108', 'NEREIDIS DEL CARMEN', 'GONZALEZ BALDIRIS', '3017835810', 'neregonzalezbaldiris@gmail.com', '1043305108', NULL, NULL, 2, '', '', ''),
(209, 13, 2, '1043978186', 'VERONICA MARIA', 'RODRIGUEZ MENDOZA', '3172244002', 'veronicamariarodriguezmendoza@gmail.com', '1043978186', NULL, NULL, 2, '', '', ''),
(210, 13, 2, '1043980576', 'NATALY MICHELL', 'MADERA ALVAREZ', '3242841507', 'michellnataly42@gmail.com', '1043980576', NULL, NULL, 2, '', '', ''),
(211, 13, 2, '1047428926', 'ALVARO ENRIQUE', 'DE AVILA DIAZ', '3028361813', 'alvaro.deavila@nuestrasenoradelcarmen.edu.co', '1047428926', NULL, NULL, 2, '', '', ''),
(212, 13, 2, '1051888102', 'SHARIT PATRICIA', 'ANGULO MEZA', '3012944241', 'sharitpatriciaangulomeza@gmail.com', '1051888102', NULL, NULL, 2, '', '', ''),
(213, 13, 2, '1051888143', 'YULIANA PATRICIA', 'MENDOZA CONEO', '3011495557', 'mendozaconeoyulianapatricia@gmail.com', '1051888143', NULL, NULL, 2, '', '', ''),
(214, 13, 2, '1051888491', 'EYDEEN', 'PEREZ GONZALEZ', '3244765251', 'eydeenperez305@gmail.com', '1051888491', NULL, NULL, 2, '', '', ''),
(215, 13, 2, '1051888833', 'ANDREA CAROLINA', 'CAMPO HERNANDEZ', '3003046760', 'andreacamposhernandez4@gmail.com', '1051888833', NULL, NULL, 2, '', '', ''),
(216, 13, 2, '1137528451', 'SHARIK MILENA', 'VEGA MELENDEZ', '3165876218', 'vsharikmilena@gmail.com', '1137528451', NULL, NULL, 2, '', '', ''),
(217, 13, 2, '1137528591', 'JUAN GABRIEL', 'ORTEGA MAZA', '3244467891', 'juangabrielortega48@gmail.com', '1137528591', NULL, NULL, 2, '', '', ''),
(218, 13, 2, '1142922944', 'LUISA ALEXANDRA', 'ROMERO VEGA', '3022664336', 'luisaromerovega14@gmail.com', '1142922944', NULL, NULL, 2, '', '', ''),
(219, 13, 2, '1142924305', 'NATHALIA', 'ALVAREZ PALOMINO', '3044093688', 'nathaliaalvarezpalomino78@gmail.com', '1142924305', NULL, NULL, 2, '', '', ''),
(220, 13, 2, '1142925830', 'SHAIS ELI', 'DIAZ CABRERA', '573135988994', 'dshaiseli@gmail.com', '1142925830', NULL, NULL, 2, '', '', ''),
(221, 13, 2, '1175713108', 'JHOANDRY', 'VALDES GONZALEZ', '3205828734', 'jhoandryvaldez02@gmail.com', '1175713108', NULL, NULL, 2, '', '', ''),
(222, 14, 1, '1007264369', 'MARIA JOSE', 'ZABALETA BELTRAN', '3003944443', 'zabaletabeltranmariajose@gmail.com', '1007264369', NULL, NULL, 1, '', '', ''),
(223, 14, 1, '1007987513', 'ANGIE PAOLA', 'MILLAN FIGUEROA', '3046834058', 'angiepaolamillan76@gmail.com', '1007987513', NULL, NULL, 6, '', '', ''),
(224, 14, 1, '1041975635', 'SAMUEL DE JESUS', 'RAMOS SANCHEZ', '3006235729', 'sramossanchez48@gmail.com', '1041975635', NULL, NULL, 1, '', '', ''),
(225, 14, 1, '1042579570', 'JOSE DAVID', 'GARCIA ARRIETA', '3052304527', 'garciaarrietajosedavid@gmail.com', '1042579570', NULL, NULL, 5, '', '', ''),
(226, 14, 1, '1042583931', 'DANIELA', 'RODRIGUEZ ORTEGA', '', 'rodriguezortegadaniela9@gmail.com', '1042583931', NULL, NULL, 1, '', '', ''),
(227, 14, 1, '1042607304', 'GENESIS SHADAY', 'MARTINEZ GARCIA', '3107412702', 'gm7125195@gmail.com', '1042607304', NULL, NULL, 1, '', '', ''),
(228, 14, 1, '1043302741', 'VANESSA ALEXANDRA', 'GONZALEZ HERRERA', '3106852251', 'vgonzalezh07@gmail.com', '1043302741', NULL, NULL, 1, '', '', ''),
(229, 14, 1, '1043654150', 'WILSON', 'TORRES CASTELLANO', '3226696822', 'wilsontorrescastellano63@gmail.com', '1043654150', NULL, NULL, 6, '', '', ''),
(230, 14, 1, '1043969853', 'SILVANA CAMILA', 'VIGOYA PEREZ', '3116092980', 'sicavipe237@gmail.com', '1043969853', NULL, NULL, 2, '2', '', ''),
(231, 14, 1, '1043973866', 'JHOSTIN JOSE', 'TORRES DIAZ', '3046279144', 'jhostintorresdiaz08@gmail.com', '1043973866', NULL, NULL, 3, '', '', ''),
(232, 14, 1, '1044911242', 'CARMEN CECILIA', 'PACHECO POLO', '3233127479', 'pachecodina889@gmail.com', '1044911242', NULL, NULL, 2, '', '', ''),
(233, 14, 1, '1047440362', 'GELEN PATRICIA', 'PUERTA SANCHEZ', '3014011564', 'helenpuertasanchez2011@gmail.com', '1047440362', NULL, NULL, 5, '', '', ''),
(234, 14, 1, '1047489062', 'JUAN CAMILO', 'PALENCIA CALVO', '3246490611', 'juanpalencia95@hotmail.com', '1047489062', NULL, NULL, 1, '', '', ''),
(235, 14, 1, '1048442383', 'YULIANA MARLEN', 'JULIO DIAZ', '3243485076', 'yulianamarlenjulio@gmail.com', '1048442383', NULL, NULL, 1, '', '', ''),
(236, 14, 1, '1049582724', 'ANDRES FELIPE', 'CASTILLO ALCALA', '3148278891', 'alcalasuareztatiana@gmail.com', '1049582724', NULL, NULL, 2, '', '', ''),
(237, 14, 1, '1051818250', 'YOLEIDIS PAOLA', 'SANCHEZ BALLESTERO', '3005555555', 'verchara_132@hotmail.com', '1051818250', NULL, NULL, 2, '', '', ''),
(238, 14, 1, '1127655561', 'MARY INES', 'SALGADO VILLADIEGO', '3001206775', 'maryinessalgado092@gmail.com', '1127655561', NULL, NULL, 6, '', '', ''),
(239, 14, 1, '1143337214', 'HELIDA ISABEL', 'ARNEDO SALAS', '3205782440', 'harnedosalas@gmail.com', '1143337214', NULL, NULL, 2, '', '', ''),
(240, 14, 1, '1143352547', 'AYDA MARIA', 'MORA TOBINSON', '3016727454', 'ammorat27@gmail.com', '1143352547', NULL, NULL, 6, '', '', ''),
(241, 14, 1, '1143366034', 'EVELIN ELENA', 'ROMERO MERCADO', '3155700841', 'romeroevelin1993@gmail.com', '1143366034', NULL, NULL, 6, '', '', ''),
(242, 14, 1, '1143384352', 'OLGA LUCIA', 'MACEA CANEDA', '3243475817', 'olgaluciamaceacaneda9525@hotmail.com', '1143384352', NULL, NULL, 1, '', '', ''),
(243, 14, 1, '1143408500', 'JUAN PABLO', 'MARTELO CASTRO', '3005501960', 'juanpablo19431@hotmail.com', '1143408500', NULL, NULL, 1, '', '', ''),
(244, 14, 1, '1235040963', 'JOHANA ALESSANDRA', 'TORRES FANDIÑO', '3127496718', 'johaletorref1909@gmail.com', '1235040963', NULL, NULL, 5, '', '', ''),
(245, 14, 1, '1235046830', 'ANGIE', 'CANDELARIO COMENDADOR', '3147279017', 'angiecandelario11@hotmail.com', '1235046830', NULL, NULL, 1, '', '', ''),
(246, 14, 1, '1238338384', 'KAROLISETH', 'JULIO TIJERA', '3217169082', 'Karol.julio.23.99@gmail.com', '1238338384', NULL, NULL, 1, '', '', ''),
(247, 14, 2, '1043655057', 'BRIANDA ESTHER', 'VILLAFAÑE VIANA', '3105985457', 'briandaviana1@gmail.com', '1043655057', NULL, NULL, 2, '', '', ''),
(248, 14, 2, '1047428897', 'ANNA GABRIELLE', 'OLASCOAGA GELIZ', '3052338950', 'annagog2008@gmail.com', '1047428897', NULL, NULL, 5, '', '', ''),
(249, 14, 2, '1049932535', 'JEISSY LILIANA', 'GUARDO PEREZ', '3005458646', 'Jeissiguardo@gmail.com', '1049932535', NULL, NULL, 2, '', '', ''),
(250, 14, 2, '1051888003', 'VALENTINA MARIA', 'AMADOR FONTALVO', '3008851721', 'Val.amador2008@gmail.com', '1051888003', NULL, NULL, 6, '', '', ''),
(251, 14, 2, '1068138762', 'ALEJANDRO', 'GUZMAN GIL', '3001104150', 'alejandroguzmangil98@gmail.com', '1068138762', NULL, NULL, 2, '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `idbitacora` int(11) NOT NULL,
  `razon_social` varchar(100) DEFAULT NULL,
  `direccion_empresa` varchar(90) DEFAULT NULL,
  `telefono_empresa` varchar(15) DEFAULT NULL,
  `email_empresa` varchar(90) DEFAULT NULL,
  `nombre_jefe` varchar(45) DEFAULT NULL,
  `apellido_jefe` varchar(45) DEFAULT NULL,
  `telefono_jefe` varchar(15) DEFAULT NULL,
  `email_jefe` varchar(80) NOT NULL,
  `fecha_inicio_practica` date DEFAULT NULL,
  `fecha_final_practica` date DEFAULT NULL,
  `url_bitacora` varchar(200) DEFAULT NULL,
  `codigo_bitacora` varchar(2) DEFAULT NULL,
  `estado` int(11) NOT NULL COMMENT '0=sin entregar, 1=entregado, 2=aprobado, 3=rechazado',
  `novedad` varchar(1000) NOT NULL,
  `aprendiz_idaprendiz` int(11) NOT NULL,
  `nombre_funcionario` varchar(90) NOT NULL,
  `documento_funcionario` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `bitacora`
--

INSERT INTO `bitacora` (`idbitacora`, `razon_social`, `direccion_empresa`, `telefono_empresa`, `email_empresa`, `nombre_jefe`, `apellido_jefe`, `telefono_jefe`, `email_jefe`, `fecha_inicio_practica`, `fecha_final_practica`, `url_bitacora`, `codigo_bitacora`, `estado`, `novedad`, `aprendiz_idaprendiz`, `nombre_funcionario`, `documento_funcionario`) VALUES
(1, 'Servicio Nacional De Aprendizaje, Sena', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-03', '2026-06-02', 'archivos/aprendices/22222/1232460825/bitacoras/DOC-6a20c944a8f83.pdf', '01', 2, '', 101, 'Gustavo Jimenez', '74371061'),
(2, 'Servicio Nacional De Aprendizaje, Sena', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-03', '2026-06-02', 'archivos/aprendices/22222/1232460825/bitacoras/DOC-6a20c95a10f80.pdf', '02', 2, '', 101, 'Gustavo Jimenez', '74371061'),
(3, 'Servicio Nacional De Aprendizaje, Sena', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-03', '2026-06-02', 'archivos/aprendices/22222/1232460825/bitacoras/DOC-6a20c9630c232.pdf', '03', 2, '', 101, 'Gustavo Jimenez', '74371061'),
(4, 'Servicio Nacional De Aprendizaje, Sena', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-03', '2026-06-02', 'archivos/aprendices/22222/1232460825/bitacoras/DOC-6a20c96cd894d.pdf', '04', 2, '', 101, 'Gustavo Jimenez', '74371061'),
(5, 'Servicio Nacional De Aprendizaje, Sena', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-03', '2026-06-02', 'archivos/aprendices/22222/1232460825/bitacoras/DOC-6a20c98311536.pdf', '05', 2, '', 101, 'Gustavo Jimenez', '74371061'),
(6, 'Servicio Nacional De Aprendizaje, Sena', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-03', '2026-06-02', 'archivos/aprendices/22222/1232460825/bitacoras/DOC-6a20c9ede8f2e.pdf', '06', 2, 'Fechas Incorrectas', 101, 'Gustavo Jimenez', '74371061'),
(7, 'Servicio Nacional De Aprendizaje, Sena', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-03', '2026-06-02', 'archivos/aprendices/22222/1232460825/bitacoras/DOC-6a20c9d0585e2.pdf', '07', 2, '', 101, 'Gustavo Jimenez', '74371061'),
(8, 'Servicio Nacional De Aprendizaje, Sena', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-03', '2026-06-02', 'archivos/aprendices/22222/1232460825/bitacoras/DOC-6a20c9e3927f4.pdf', '08', 2, '', 101, 'Gustavo Jimenez', '74371061'),
(9, 'Servicio Nacional De Aprendizaje, Sena', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-03', '2026-06-02', 'archivos/aprendices/22222/1232460825/bitacoras/DOC-6a20c9fab9797.pdf', '09', 2, '', 101, 'Gustavo Jimenez', '74371061'),
(10, 'Servicio Nacional De Aprendizaje, Sena', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-03', '2026-06-02', 'archivos/aprendices/22222/1232460825/bitacoras/DOC-6a20ca0635194.pdf', '10', 2, '', 101, 'Gustavo Jimenez', '74371061'),
(11, 'Servicio Nacional De Aprendizaje, Sena', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-03', '2026-06-02', 'archivos/aprendices/22222/1232460825/bitacoras/DOC-6a20ca216b664.pdf', '11', 2, '', 101, 'Gustavo Jimenez', '74371061'),
(12, 'Servicio Nacional De Aprendizaje, Sena', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-03', '2026-06-02', 'archivos/aprendices/22222/1232460825/bitacoras/DOC-6a20ca4026a6d.pdf', '12', 2, '', 101, 'Gustavo Jimenez', '74371061'),
(13, 'SERVICIO DE NACIONAL DE APRENDIZAJE SENA', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-04', '2026-06-04', 'archivos/aprendices/22222/1232460819/bitacoras/DOC-6a2197eda3a23.pdf', '01', 2, '', 95, 'Jaime Andres Garcia Gomez', '92694359'),
(14, 'SERVICIO DE NACIONAL DE APRENDIZAJE SENA', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-04', '2026-06-04', 'archivos/aprendices/22222/1232460819/bitacoras/DOC-6a21af7b9a403.pdf', '02', 2, 'el archivo no es legible', 95, 'Jaime Andres Garcia Gomez', '92694359'),
(15, 'SERVICIO DE NACIONAL DE APRENDIZAJE SENA', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-04', '2026-06-04', 'archivos/aprendices/22222/1232460819/bitacoras/DOC-6a21ae2596a05.pdf', '03', 2, '', 95, 'Jaime Andres Garcia Gomez', '92694359'),
(16, 'SERVICIO DE NACIONAL DE APRENDIZAJE SENA', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-04', '2026-06-04', 'archivos/aprendices/22222/1232460819/bitacoras/DOC-6a21ae4ec65fa.pdf', '04', 2, '', 95, 'Jaime Andres Garcia Gomez', '92694359'),
(17, 'SERVICIO DE NACIONAL DE APRENDIZAJE SENA', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-04', '2026-06-04', 'archivos/aprendices/22222/1232460819/bitacoras/DOC-6a21ae8f2ce14.pdf', '05', 2, '', 95, 'Jaime Andres Garcia Gomez', '92694359'),
(18, 'SERVICIO DE NACIONAL DE APRENDIZAJE SENA', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-04', '2026-06-04', 'archivos/aprendices/22222/1232460819/bitacoras/DOC-6a21aeafb476b.pdf', '06', 2, '', 95, 'Jaime Andres Garcia Gomez', '92694359'),
(19, 'SERVICIO DE NACIONAL DE APRENDIZAJE SENA', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-04', '2026-06-04', 'archivos/aprendices/22222/1232460819/bitacoras/DOC-6a21aec6083c2.pdf', '07', 2, '', 95, 'Jaime Andres Garcia Gomez', '92694359'),
(20, 'SERVICIO DE NACIONAL DE APRENDIZAJE SENA', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-04', '2026-06-04', 'archivos/aprendices/22222/1232460819/bitacoras/DOC-6a21aecf94a29.pdf', '08', 2, '', 95, 'Jaime Andres Garcia Gomez', '92694359'),
(21, 'SERVICIO DE NACIONAL DE APRENDIZAJE SENA', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-04', '2026-06-04', 'archivos/aprendices/22222/1232460819/bitacoras/DOC-6a21aeda6ee97.pdf', '09', 2, '', 95, 'Jaime Andres Garcia Gomez', '92694359'),
(22, 'SERVICIO DE NACIONAL DE APRENDIZAJE SENA', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-04', '2026-06-04', 'archivos/aprendices/22222/1232460819/bitacoras/DOC-6a21aeeb01fa3.pdf', '10', 2, '', 95, 'Jaime Andres Garcia Gomez', '92694359'),
(23, 'SERVICIO DE NACIONAL DE APRENDIZAJE SENA', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-04', '2026-06-04', 'archivos/aprendices/22222/1232460819/bitacoras/DOC-6a21aef4c6a03.pdf', '11', 2, '', 95, 'Jaime Andres Garcia Gomez', '92694359'),
(24, 'SERVICIO DE NACIONAL DE APRENDIZAJE SENA', 'Carrera 12 No. 55A 51.', '3138882266', 'jcmp.marcos@gmail.com', 'marco', 'arbelaez', '1245645687', 'jcmp.marcos@gmail.com', '2025-12-04', '2026-06-04', 'archivos/aprendices/22222/1232460819/bitacoras/DOC-6a21aefeca11e.pdf', '12', 2, '', 95, 'Jaime Andres Garcia Gomez', '92694359'),
(25, 'Nam Construciones', 'barrio ternera', '3042932071', 'orodelo@sena.edu.co', 'omer', 'rodelo', '3042932071', 'orodelo@sena.edu.co', '2026-10-23', '2027-04-22', NULL, '01', 0, '', 162, '', ''),
(26, 'Nam Construciones', 'barrio ternera', '3042932071', 'orodelo@sena.edu.co', 'omer', 'rodelo', '3042932071', 'orodelo@sena.edu.co', '2026-10-23', '2027-04-22', NULL, '02', 0, '', 162, '', ''),
(27, 'Nam Construciones', 'barrio ternera', '3042932071', 'orodelo@sena.edu.co', 'omer', 'rodelo', '3042932071', 'orodelo@sena.edu.co', '2026-10-23', '2027-04-22', NULL, '03', 0, '', 162, '', ''),
(28, 'Nam Construciones', 'barrio ternera', '3042932071', 'orodelo@sena.edu.co', 'omer', 'rodelo', '3042932071', 'orodelo@sena.edu.co', '2026-10-23', '2027-04-22', NULL, '04', 0, '', 162, '', ''),
(29, 'Nam Construciones', 'barrio ternera', '3042932071', 'orodelo@sena.edu.co', 'omer', 'rodelo', '3042932071', 'orodelo@sena.edu.co', '2026-10-23', '2027-04-22', NULL, '05', 0, '', 162, '', ''),
(30, 'Nam Construciones', 'barrio ternera', '3042932071', 'orodelo@sena.edu.co', 'omer', 'rodelo', '3042932071', 'orodelo@sena.edu.co', '2026-10-23', '2027-04-22', NULL, '06', 0, '', 162, '', ''),
(31, 'Nam Construciones', 'barrio ternera', '3042932071', 'orodelo@sena.edu.co', 'omer', 'rodelo', '3042932071', 'orodelo@sena.edu.co', '2026-10-23', '2027-04-22', NULL, '07', 0, '', 162, '', ''),
(32, 'Nam Construciones', 'barrio ternera', '3042932071', 'orodelo@sena.edu.co', 'omer', 'rodelo', '3042932071', 'orodelo@sena.edu.co', '2026-10-23', '2027-04-22', NULL, '08', 0, '', 162, '', ''),
(33, 'Nam Construciones', 'barrio ternera', '3042932071', 'orodelo@sena.edu.co', 'omer', 'rodelo', '3042932071', 'orodelo@sena.edu.co', '2026-10-23', '2027-04-22', NULL, '09', 0, '', 162, '', ''),
(34, 'Nam Construciones', 'barrio ternera', '3042932071', 'orodelo@sena.edu.co', 'omer', 'rodelo', '3042932071', 'orodelo@sena.edu.co', '2026-10-23', '2027-04-22', NULL, '10', 0, '', 162, '', ''),
(35, 'Nam Construciones', 'barrio ternera', '3042932071', 'orodelo@sena.edu.co', 'omer', 'rodelo', '3042932071', 'orodelo@sena.edu.co', '2026-10-23', '2027-04-22', NULL, '11', 0, '', 162, '', ''),
(36, 'Nam Construciones', 'barrio ternera', '3042932071', 'orodelo@sena.edu.co', 'omer', 'rodelo', '3042932071', 'orodelo@sena.edu.co', '2026-10-23', '2027-04-22', NULL, '12', 0, '', 162, '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificacion`
--

CREATE TABLE `certificacion` (
  `idcertificacion` int(11) NOT NULL,
  `titulo_documento` varchar(100) DEFAULT NULL,
  `url_documento` varchar(255) DEFAULT NULL,
  `estado_archivo` varchar(1) NOT NULL COMMENT 'vacio o null= sin radicar\\r\\n1= radicado\\r\\n2= aprobado\\r\\n3= rechazado',
  `novedad_archivo` varchar(500) NOT NULL,
  `aprendiz_idaprendiz` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `certificacion`
--

INSERT INTO `certificacion` (`idcertificacion`, `titulo_documento`, `url_documento`, `estado_archivo`, `novedad_archivo`, `aprendiz_idaprendiz`) VALUES
(1, 'Certificado laboral', 'archivos/aprendices/22222/1232460825/certificacion/DOC-6a20ca6ece429.pdf', '2', '', 101),
(2, 'Copia documento de identidad', 'archivos/aprendices/22222/1232460825/certificacion/DOC-6a20ca835ce79.pdf', '2', '', 101),
(3, 'Evidencia destruccion carnet', 'archivos/aprendices/22222/1232460825/certificacion/DOC-6a20cace984bc.pdf', '2', '', 101),
(4, 'Certificado de validacion agencia publica de empleo', 'archivos/aprendices/22222/1232460825/certificacion/DOC-6a20ca651af4e.pdf', '2', '', 101),
(5, 'Certificado asistencia pruebas TyT', 'archivos/aprendices/22222/1232460825/certificacion/DOC-6a20e66facfcb.pdf', '2', '', 101),
(6, 'Certificado laboral', 'archivos/aprendices/22222/1232460819/certificacion/DOC-6a2199237d852.pdf', '2', '', 95),
(7, 'Copia documento de identidad', 'archivos/aprendices/22222/1232460819/certificacion/DOC-6a2199301eae1.pdf', '2', '', 95),
(8, 'Evidencia destruccion carnet', 'archivos/aprendices/22222/1232460819/certificacion/DOC-6a21993adb47f.pdf', '2', '', 95),
(9, 'Certificado de validacion agencia publica de empleo', 'archivos/aprendices/22222/1232460819/certificacion/DOC-6a22d5303e50b.pdf', '2', '', 95),
(10, 'Certificado asistencia pruebas TyT', 'archivos/aprendices/22222/1232460819/certificacion/DOC-6a21990219cc3.pdf', '2', '', 95),
(11, 'Certificado laboral', '', '', '', 162),
(12, 'Copia documento de identidad', '', '', '', 162),
(13, 'Evidencia destruccion carnet', '', '', '', 162),
(14, 'Certificado de validacion agencia publica de empleo', '', '', '', 162),
(15, 'Certificado laboral', '', '', '', 73),
(16, 'Copia documento de identidad', '', '', '', 73),
(17, 'Evidencia destruccion carnet', '', '', '', 73),
(18, 'Certificado de validacion agencia publica de empleo', '', '', '', 73),
(19, 'Certificado laboral', '', '', '', 72),
(20, 'Copia documento de identidad', '', '', '', 72),
(21, 'Evidencia destruccion carnet', '', '', '', 72),
(22, 'Certificado de validacion agencia publica de empleo', '', '', '', 72);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `codi_depa` int(11) NOT NULL,
  `nomb_depa` varchar(45) DEFAULT NULL,
  `paises_codi_pais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`codi_depa`, `nomb_depa`, `paises_codi_pais`) VALUES
(5, 'Antioquia', 169),
(8, '	Atlantico	', 169),
(11, '	Bogota D.C	', 169),
(13, '	Bolivar	', 169),
(15, '	Boyaca	', 169),
(17, '	Caldas	', 169),
(18, '	Caqueta	', 169),
(19, '	Cauca	', 169),
(20, '	Cesar	', 169),
(23, '	Cordoba	', 169),
(25, '	Cundinamarca	', 169),
(27, '	Choco	', 169),
(41, '	Huila	', 169),
(44, '	La Guajira	', 169),
(47, '	Magdalena	', 169),
(50, '	Meta	', 169),
(52, '	Nariño	', 169),
(54, '	Norte de Santander	', 169),
(63, '	Quindio	', 169),
(66, '	Risaralda	', 169),
(68, '	Santander	', 169),
(70, '	Sucre	', 169),
(73, '	Tolima	', 169),
(76, '	Valle del Cauca	', 169),
(81, '	Arauca	', 169),
(85, '	Casanare	', 169),
(86, '	Putumayo	', 169),
(88, '	Archipielago de San	', 169),
(91, '	Amazonas	', 169),
(94, '	Guainia	', 169),
(95, '	Guaviare	', 169),
(97, '	Vaupes	', 169),
(99, '	Vichada	', 169);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `idempresa` int(11) NOT NULL,
  `nit_empresa` varchar(20) NOT NULL,
  `nombre_empresa` varchar(100) DEFAULT NULL,
  `direccion_empresa` varchar(100) NOT NULL,
  `telefono_empresa` varchar(15) NOT NULL,
  `municipios_codi_muni` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`idempresa`, `nit_empresa`, `nombre_empresa`, `direccion_empresa`, `telefono_empresa`, `municipios_codi_muni`) VALUES
(1, '901097443', 'A & A EQUIPOS Y SOLUCIONES EN CONTENEDORES S.A.S', 'cra 56 2s 67 km 2 albornos', '3215417879', 13001),
(2, '900266813', 'A L ALIANZA LOGISTICA SAS', 'Diagonal 83 Bis No. 81 A 29', '5364440 - 31879', 13838),
(3, '901185682', 'A.R. FACTORY S.A.S', 'olaya herrera', '3004864872', 13001),
(4, '860049210', 'A.W. FABER-CASTELL COLOMBIA LTDA', 'calle 17 a n 68-70', '3237150635', 13001),
(5, '900072035', 'ABSORBENTES DE COLOMBIA  S.A', 'vereda chachafruto zona franca bodega 213-214', '5626199', 13001),
(6, '900340559', 'ACASI COLOMBIA ZF SAS', 'ZONA FRANCA PARQUE CENTRAL BODEGA 100 VARIANTE TURBACO SECTOR AGUAS PRIETAS', '3158102344', 13001),
(7, '800110980', 'ACCENTURE LTDA', 'Carrera 7 No. 71 - 52 Torre A Piso 10', '3242279222', 13001),
(8, '900324446', 'ACCURACY BRAIN LOGISTICS S.A A.B', 'VIA MAMONAL KM 9 ZONA FRANCA LA CANDELARIA LOTE 4 Y 11', '3203926182', 13052),
(9, '900406436', 'ACERTEK SAS', 'Zona Franca Parque Central bodega 67', '3175936659', 13001),
(10, '800249192', 'ACI CARGO SIA LTDA', 'calle 10 39 06', '3107276495', 13001),
(11, '900064780', 'ACUECAR SA ESP', 'carrera52#25-43 Barrio centro', '6862822', 13052),
(12, '806016735', 'ACUEDUCTOS Y ALCANTARILLADOS DE COLOMBIA S.A. E.S.P.', 'arjona avenida simon bossa 1-01', '3022350062', 13052),
(13, '900837214', 'ADEGA SAS', 'VIA MAMONAL KILOMETRO 11', '3005373072', 13001),
(14, '800138188', 'ADMINISTRADORA DE FONDO DE PENSIONES Y CESANTÍAS  PROTECCIÓN S.A.', 'Calle 49 # 63 - 100', '3183660795', 13433),
(15, '800254033', 'ADOLFREDO ZUÑIGA E HIJOS S EN C', 'lo amador calle 34#20B-15', '3158057262', 13052),
(16, '890403012', 'AFA CONSULTORES Y CONSTRUCTORES S.A', 'cabrero Nº 43-164', '3205499130', 13836),
(17, '901172570', 'AFFINITY BPO S.A.S.', 'cra 49 #30A-33 barrio Armenia', '3185406296', 13873),
(18, '860062053', 'AGENCIA DE ADUANA LIBREXPORT LTDA NIVEL 1', 'Carrera 49 No. 93 - 23', '3157338273', 13001),
(19, '860536003', 'AGENCIA DE ADUANAS ABC REPECEV S.A.S. NIVEL 1', 'Avenida Calle 24 No. 95 - 12 Bodega 45 Parque Industrail Portos', '3222494744', 13838),
(20, '860508649', 'AGENCIA DE ADUANAS ADUAMAR DE COLOMBIA Y CIA SAS NIVEL 1', 'Avenida Calle 26 No. 96J-03 PISO 5', '3204124167', 13001),
(21, '830032263', 'AGENCIA DE ADUANAS ADUANAMIENTOS IMPORTACIONES Y EXPORTACIONES S.A.S NIVEL 2', 'calle 25 d 97 -57', '4132710', 13657),
(22, '860028026', 'AGENCIA DE ADUANAS ADUANERA GRANCOLOMBIANA S.A. NIVEL 1', 'Avenida el Dorado No. 85 D - 55 Local 215', '6017429050', 13001),
(23, '800143377', 'AGENCIA DE ADUANAS ADUANIMEX S.A.  NIVEL 1', 'carrera 48# 20-.34', '3102859732', 13001),
(24, '890404619', 'AGENCIA DE ADUANAS ASERCOL S.A. NIVEL 1.', 'Transversal 33A # 19-21, Barrio Martínez Martelo', '3183470625', 13001),
(25, '830002571', 'AGENCIA DE ADUANAS AVIATUR S.A.S. NIVEL 1', 'Calle 24B No. 102 - 22', '3158525988', 13001),
(26, '800240972', 'AGENCIA DE ADUANAS CARGO ADUANA S.A.S. NIVEL 2', 'Calle 25c 102 34', '3213111868', 13001),
(27, '800241367', 'AGENCIA DE ADUANAS CARGO FLASH S.A.S.', 'Calle 64 No 65 - 48', '3443340', 13001),
(28, '890504820', 'AGENCIA DE ADUANAS COMERCIO EXTERIOR DEL NORTE S.A. NIVEL 1', 'av 7 N 17 N 92 Parque industrial del oriente bodega N2 B5', '3143970349', 13001),
(29, '800254476', 'AGENCIA DE ADUANAS CORAL VISION S.A.S. NIVEL 1', 'Avenida 4b norte No. 37A - 46', '3166545694', 13001),
(30, '890309238', 'AGENCIA DE ADUANAS FEDEGAL S.A.S NIVEL II', 'CALLE 20N 5BN 38', '3157254180', 13001),
(31, '900036951', 'AGENCIA DE ADUANAS FENIX S A S NIVEL 2', 'cl 49 a # 74 31', '3176363818', 13001),
(32, '900536415', 'AGENCIA DE ADUANAS G5 SAS NIVEL 2', 'Calle 25 No. 99 - 34 Oficina 402', '3132730706', 13001),
(33, '890404190', 'AGENCIA DE ADUANAS GAMA S.A. NIVEL 1', 'Av. del Arsenla No 8B-39', '6502600', 13001),
(34, '890403077', 'AGENCIA DE ADUANAS HUBEMAR S.A.S. NIVEL 1', 'Bosque, Transversal 54 # 21A-120', '3054277002', 13052),
(35, '830098132', 'AGENCIA DE ADUANAS INTERLOGISTICA S A NIVEL 1', 'Carrera 106 No. 15 - 25 Bodega 32 - 33', '3115610490  601', 13001),
(36, '830074208', 'AGENCIA DE ADUANAS KN COLOMBIA S.A.S. NIVEL 2', 'Calle 24 A No. 59 - 42 Torre 3 Oficina 701', '3134682870', 13001),
(37, '890921974', 'AGENCIA DE ADUANAS MARIANO ROLDAN S.A. NIVEL 1', 'cra 43a 34-155 piso 9  torre norte', '3014372600-3202', 13001),
(38, '800227414', 'AGENCIA DE ADUANAS MERCO S.A.S NIVEL 1', 'Carrera 53 No 106-280 Of 8A Piso 8 Torre B Centro Empresaril Buenavista', '385521', 13001),
(39, '900081359', 'AGENCIA DE ADUANAS ML S.A. NIVEL 1', 'Calle 16 41-210 Ed la Compañia of 405', '3226532808', 13001),
(40, '860061308', 'AGENCIA DE ADUANAS PASAR LTDA NIVEL 1', 'CRA 102 A #25 H 45 OFICINA 206', '4148000 - 32045', 13001),
(41, '830003079', 'AGENCIA DE ADUANAS PROFESIONAL S.A.S NIVEL 1 - SIAP', 'Calle 25 G No. 100 - 24', '9156610', 13001),
(42, '806000830', 'AGENCIA DE ADUANAS REHOBOT S.A.S.NIVEL 2', 'carrera 24 numero 28-59 manga', '6447600', 13001),
(43, '811001259', 'AGENCIA DE ADUANAS ROLDAN S.A.S. NIVEL 1', 'Cra 100 #25 b - 40', '3104960731', 13001),
(44, '890322590', 'AGENCIA DE ADUANAS SERVICIOS INTEGRADOS DE COMERCIO EXTERIOR S.A.S, NIVEL 1', 'CALLE 50 NORTE #5N-91', '6662566', 13001),
(45, '900199057', 'AGENCIA DE ADUANAS SUCOMEX S.A. NIVEL 2', 'Carrera 43 B 16-41 oficina 504 Edificio Staff', '3136305568-4484', 13001),
(46, '890902266', 'AGENCIA DE ADUANAS TCC S.A.S NIVEL 1', 'CARRERA 64 67 B 35 BLOQUE 3 PISO 2', '444 48 88 Ext 1', 13001),
(47, '805001632', 'AGENCIA DE ADUANAS VALLEY CUSTOMS S.A.S NIVEL 1', 'calle 28 norte no. 2bisn75', '3152398697', 13001),
(48, '830011100', 'AGENCIA DE CARGA AVIATUR S A', 'Calle 24 B No. 102 - 22', '3158525988', 13001),
(49, '860000018', 'AGENCIA DE VIAJES Y TURISMO AVIATUR S.A.S. - AVIATUR', 'Avenida 19 No. 4 - 62', '3160101984', 13001),
(50, '800181561', 'AGENCIA MARITIMA ALTAMAR LTDA', 'BOCAGRANDE CRA 36A-100 TORRE EMPRESARIAL PROTECCION OFICINA 1101', '6650505-6640000', 13001),
(51, '800116249', 'AGENCIA MARITIMA TRANSMARES S.A.S.', 'CRA. 106 No. 15 a 25 Man. 15 Lotes 100 Cas. 151 (BOGOTA)', '3182200264', 13001),
(52, '800170690', 'AGENCIAS DE ADUANAS MOUKARZEL SAS NIVEL 2', 'BOSQUE DIAGONAL 21A 40 27', '3106378416', 13001),
(53, '830035850', 'AGENTES PORTUARIOS S.A.S. - AGP', 'Carrera 7 No. 80 - 49 Oficina 902', '7430446', 13001),
(54, '800186313', 'AGM DESARROLLOS S.A.S', 'CRR AGUAS PRIETAS KM 6 VIA CAMPAÑA LT B MZ 1 LT 1 Municipio: TURBACO, BOLIVAR, COLOMBIA', '3166913529', 13052),
(55, '800216499', 'AGOFER S A S', 'Calle 12 a No 38-45', '7434444 - 32136', 13001),
(56, '890400514', 'AGRINAL COLOMBIA S.A.S', 'TRV 54 # 22-36', '6625659', 13838),
(57, '900466939', 'AGROJEMUR S.A.S', 'Variante Mamonal Gambote Km 20 Finca 3', '3218232606', 13001),
(58, '900271702', 'AGROPECUARIA DEL NILO SAS', 'ED. TORRE DEL PUERTO, OFICINA 2201', '3157775693', 13433),
(59, '900263608', 'AGUAS DE BOLIVAR S.A. E.S.P.', 'Marbella CRA 3ra A #46-57 EDIFICIO LAGUNA 46 OFICINA 1701', '6925222', 13001),
(60, '800252396', 'AGUAS DE CARTAGENA S.A E.S.P.SIGLA ACUACAR', 'Chambacu Edificio Inteligente Cra 13B # 26 -78, 2do Piso', '3014839911', 13052),
(61, '823004006', 'AGUAS DE LA SABANA S.A. E.S.P.', 'KM 1 Via a Corozal', '3213680809', 13430),
(62, '860031615', 'AGUNSA COLOMBIA S.A.S', 'Calle 73 # 7 - 31 Piso 7 Torre B', '3146223', 13001),
(63, '901117804', 'AIRES PLAY SAS', 'LOS GIRASOLES', '3042154412', 13873),
(64, '860013771', 'AJOVER DARNEL S.A.S', 'Calle 65 Bis No. 91 - 82', '3005373072', 13001),
(65, '9091056', 'ALBERTO VICTOR MARENCO MENDOZA/ NOTARIA TERCERA DE CARTAGENA', 'PIE DE LA POPA CALLE 29D # 21D-20', '3205679679', 13052),
(66, '891780054', 'ALCALDÍA DE SAN SEBASTIÁN DE BUENAVISTA - MAGDALENA', 'CALLE 5 PALACIO MUNICIPAL', '3145306667', 47692),
(67, '890406946', 'ALEJANDRO MUÑOZ SAS', 'variante gambote mamonal km 23', '3106988032', 13001),
(68, '900369627', 'ALEMANA AUTOMOTRIZ S.A.S', 'via 40 no.77b-59', '3008680227', 13433),
(69, '890907797', 'ALGAMAR S.A.', 'CLL.54 46-15', '3184665360-3721', 13001),
(70, '900675394', 'ALGAR TECNOLOGIA S.A.S.', 'CL 49 SUR 45 A 300', '3022995887', 13657),
(71, '860053976', 'ALGRANEL S A', 'Calle 67 No. 7 - 35 Oficina 1203', '3165757807', 13001),
(72, '901266264', 'ALIA2 DISTRIBUCIONES S.A.S', 'Diagonal 29D-N°56 72 Centro Comercial Mamonal Local 16', '3152592612', 13433),
(73, '830053812', 'ALIANZA FIDUCIARIA S.A FIDEICOMISOS', 'CRA 15 88 99', '6447700', 13001),
(74, '860500480', 'ALMACENES CORONA S.A.S.', 'Calle 100 No. 8 A - 55 Torre C Piso 9', '3115724314', 13001),
(75, '890900608', 'ALMACENES EXITO S.A.', 'Medellin', '6024860612', 13001),
(76, '860002153', 'ALMACENES GENERALES DE DEPOSITO ALMAVIVA S A', 'Carrera 47 No. 12 B - 50', '3113069364', 13001),
(77, '860010973', 'ALMACENES GENERALES DE DEPOSITO DE CAFE S.A. ALMACAFE', 'Calle 73 No. 8 -13 Piso 6', '3137200', 13001),
(78, '900305709', 'ALSERTEC SAS', 'Avenida Americas No. 42A-21', '3142451275', 13001),
(79, '901551416', 'AMASA RESTAURANTE S.A.S.', 'CARRERA 2 35 28 EDF SANTO DOMINGO OF 106 BR CENTRO', '3135601629', 13001),
(80, '900199343', 'AMERICAS STYRENICS DE COLOMBIA LTDA', 'Carrera 7 No. 76 - 35 Oficina 501', '6056700500 - 60', 13001),
(81, '900314855', 'AMIAGRO PALMA S.A.S.', 'CALLE 7 6B- 8 REGIDOR', '3145410699', 13042),
(82, '900214450', 'AMSPEC DE COLOMBIA S.A.S.', 'DIAG 23A #54-07, BRR EL BOSQUE, SECTOR BAJOS DE SAN ISIDRO', '3205747063', 13001),
(83, '57300075', 'ANA DOLORES MEZA CABALLERO, NOTARIA SEGUNDA DEL CIRCULO DE BARRANQUILLA', 'CALLE 38 45 -68', '3017541330', 13001),
(84, '826000346', 'ANALIZAR LABORATORIO FISICOQUIMICO LIMITADA', 'Kra 33 16-27', '3126655127', 13052),
(85, '890903310', 'ANHIDRIDOS Y DERIVADOS DE COLOMBIA S.A.S', 'CL 19 A 43B 41', '6043567003', 13001),
(86, '800247491', 'ANSI SAS', 'Centro Comercial Mamonal plaza', '3135091183', 13001),
(87, '890406136', 'ANTONIO SPATH Y CIA S.A.', 'calle 30 # 19a 11 barrio pie de la popa', '3205492128', 13001),
(88, '890402766', 'APARTA HOTEL DON BLAS S.A.', 'BOCAGRANDE, KRA1, N°10-10', '6932215', 13873),
(89, '700004683', 'APARTA HOTEL PARAISO DEL CONDE', 'Dg 32 # 78 - 35 las pameras', '3332284295', 13001),
(90, '900421863', 'APC FRIGORIFICOS S.A.S.', 'CARRERA  37 # 10-303', '3223668624', 13001),
(91, '901034165', 'APIX LOGÍSTICA ESPECIALIZADA S.A.S.', 'calle 15 # 22 207', '3173807046', 13001),
(92, '802020308', 'APORTES SAN ISIDRO S.A.S. ASI S.A.S', 'CARRERA 53 No 82 - 86 oficina 805 edificio Ocean Tower Business Center', '3261238 - 31141', 13580),
(93, '830513773', 'APPLUS NORCONTROL COLOMBIA LIMITADA', 'DIAGONAL CALLE 71 A BIS # 20- 69', '3218248407', 13001),
(94, '901153034', 'APROREC SAS', 'Calle 15 No. 59- 18', '3123776215', 11001),
(95, '890400048', 'ARAUJO & SEGOVIA S.A.', 'matuna edif concasa p 2', '323540699', 13001),
(96, '800244387', 'ARCOS DORADOS COLOMBIA S.A.S. - ADC S.A.S.', 'Cl. 116 #7-15, Usaquén', '3164088841', 13001),
(97, '890480104', 'ARQUIDIOCESIS DE CARTAGENA', 'Centro calle del Arzobispado  cra 5 No. 34-55', '3024439297', 13001),
(98, '800212301', 'ARQUITECTOS INGENIEROS ECONOMISTAS CONSULTORES LTDA AIEC LTDA', 'cabrero calle real edificio afa consultores piso 2', '3017552702', 13001),
(99, '901531403', 'ARQUIVIDRIOS Y ALUMINIOS DEL CARIBE S.A.S.', 'CR 71 MZ 6 LT 9 EL CARMELO', '3174422239', 13001),
(100, '901589834', 'ARTE Y CREACIONES S.A.S.', 'LAS PALMERAS MZ 45 LT 35', '3013663150', 13001),
(101, '900341622', 'ASESORIAS FINANCIERAS DE CREDITO S.A.S. - ASFICREDITO S.A.S.', 'Cra 7 76 35 piso 8', '3219739873', 13001),
(102, '860506531', 'ASESORIAS, REPRESENTACIONES, ADMINISTRACION Y SERVICIOS SAS - ARAS SAS', 'Carrera 10 No. 28 - 49 Piso 15', '3177486113', 13001),
(103, '900075456', 'ASIGNAR S.A.S.', 'Carrera 19 N 44 27', '3115293190', 13001),
(104, '802002279', 'ASISTENCIA MEDICA INMEDIATA- SERVICIO DE AMBULANCIA PREPAGADA S.A.', 'CARRERA 58 NO. 68-160 BARRIO PRADO', '3114131262', 13838),
(105, '830079895', 'ASOCIACION ALIANZA EDUCATIVA', 'Calle 16 # 6 - 66 Piso 9', '3125478871 - 60', 13001),
(106, '806007709', 'ASOCIACION COLEGIO MILITAR ALMIRANTE COLON', 'URB ALMIRANTE COLON MZ Y LT 1 ETAPA 2', '3186238223', 13001),
(107, '829004199', 'ASOCIACIÓN DE PRODUCTORES DE CACAO - APROCASUR', 'CRA 11 N°7*59 BARRIO EL CARMEN', '3118047004', 13744),
(108, '800099778', 'ASOCIACION NIÑOS DE PAPEL  COLOMBIA', 'Canapote Calle 59A Sector Las Rosas # 16-44', '3182816950', 13001),
(109, '860019021', '\"ASOCIACION PARA LA ENSEÑANZA \"\"ASPAEN\"\"\"', 'Calle 69 No. 7 A - 50', '2177590', 13001),
(110, '860013779', 'ASOCIACION PROBIENESTAR DE LA FAMILIA COLOMBIANA PROFAMILIA', 'Calle 34 No.14-52', '3105616924', 13442),
(111, '800138514', 'ASTILLEROS E INDUSTRIAS DE LOS HIDROCARBUROS Y ENERGETICOS LTDA', 'pasacaballos calle 18#4-35', '3046095493-3103', 13001),
(112, '890112870', 'ASYCO S.A.S.', 'km4 anillo vial', '3144704253', 13001),
(113, '800208660', 'ATIEMPO SERVICIOS SAS. SERVIATIEMPO S.A.S.', 'pie del cerro', '3233104816', 13001),
(114, '900040299', 'ATLANTIC FS  S.A.S.', 'CR 52 No 1 - 42', '3233971766', 13001),
(115, '900614423', 'ATLANTIC MARINE FUELS S.A.S', 'Bocagrande Cr 3 N 9 30 EDIF PRODEGI OF 1604', '3173799621', 23672),
(116, '816001182', 'AUDIFARMA S.A', 'Audifarma', '3134094966', 13001),
(117, '901515242', 'AUTOPISTAS DEL CARIBE S.A.S', 'Transversal 54 # 31i-99', '3108018359', 13001),
(118, '890900317', 'AUTOTECNICA COLOMBIANA S.A.S.', 'CR 43 44 60', '3216405015', 13001),
(119, '830040343', 'AUTOVARDI SAS', 'calle 13 # 50 69', '3214350226', 13001),
(120, '901306420', 'AVANTE GLOBAL SCHOOL SAS', 'Zona norte, anillo vial km 12', '3017109309', 13654),
(121, '901207734', 'AVANZAR IPS SERVICIOS INTEGRALES DE SALUD  SAS', 'CALL 23 57 - 28', '3137969269', 13244),
(122, '800000276', 'AVICOLA EL MADROÑO S.A.', 'Calle 7 # 16-119', '3183745541', 13836),
(123, '900871479', 'AVISTA COLOMBIA S.A.S BIC', 'Carrera 10 No. 64 - 44', '3204185994', 13468),
(124, '890201881', 'AVSA S.A - AVSA', 'Carrera 34 No. 19A - 69', '3160189445', 13244),
(125, '900640334', 'AXA COLPATRIA MEDICINA PREPAGADA S.A.', 'Cra. 7 No. 24-89', '3219279250', 11001),
(126, '860002183', 'AXA COLPATRIA SEGUROS DE VIDA S.A', 'Cra 7 No. 24-89', '3107868676- 601', 11001),
(127, '806015323', 'AZEMBLA S.A.S', 'Mamonal Km 5', '3166838171', 13001),
(128, '900869003', 'B BRAUN SURGICAL S.A.S.', 'CR 19 100 45', '3144279336', 11001),
(129, '830146543', 'B&S GROUP S.A.S', 'PARQUE INDUSTRIAL SAN JORGE BOD 51', '3177777564', 13001),
(130, '860003020', 'BANCO BILBAO VIZCAYA ARGENTARIA COLOMBIA S A - BBVA COLOMBIA', 'Carrera 9 No. 72 - 21 Piso 4', '3168763151', 13001),
(131, '901702583', 'BANCO CONTACTAR S.A.', 'Carrera 6 No 22 - 90  Barrio Ejido', '3108991008', 13673),
(132, '860034313', 'BANCO DAVIVIENDA S.A.', 'avenida el dorado #68b 85', '3300000', 13430),
(133, '890300279', 'BANCO DE OCCIDENTE', 'CARRERA 4 # 7-61. PISO 15. Edificio Principal Banco de Occidente DG Cali – Torre 1.', '60-2-4850707 Ex', 13836),
(134, '900768933', 'BANCO MUNDO MUJER SA O MUNDO MUJER EL BANCO DE LA COMUNIDAD O MUNDO MUJER', 'cra 11 5 56', '3103611772', 52001),
(135, '890903938', 'BANCOLOMBIA S.A.', 'Carrera 48 # 26-85', '4042458', 13001),
(136, '900380147', 'BANDA ECOAMBIENTAL SAS', 'campestre mz59 lt 6 etapa 7', '3234675880', 13001),
(137, '900475484', 'BC HOTELES S A', 'Avenida Carrera 9 N. 113 - 52 OF 2001', '651 7477 ext 51', 13001),
(138, '800118334', 'BELLEZA EXPRESS S.A', 'Calle 36 No. 134-201 Km 6 Va Cali - Jamund', '3128775742', 13836),
(139, '900180801', 'BELLTECH COLOMBIA SA', 'Carrera 7 No. 155 C - 30 Piso 25 Oficina 25 - 03', '3182431405', 13001),
(140, '900998497', 'BENCHMARK GENETICS COLOMBIA S.A.S', 'Cra 2 N 11 41 Oficina 1002', '3108285388', 13001),
(141, '901835085', 'BERRY LIFE SAS', 'Calle 92 No. 11 - 51 OF 302', '3115140724', 13001),
(142, '806015606', 'BESPOKE COLOMBIA S.A.S.', 'Carrera 7 (Cll 2da de Badillo) #36-125', '3053628902', 13838),
(143, '901081283', 'BICODE SAS', 'Calle 87 No. 15 - 23 Oficina 301', '3192273966', 11001),
(144, '800223206', 'BIENESTAR IPS S.A.S', 'Cra 57  # 72-107', '3182415131', 13052),
(145, '901469364', 'BIOCIRCULO 2 S.A.S', 'DIAGONAL 16 # 115 - 25', '315 2799145', 13001),
(146, '806006669', 'BIOGER SA ESP', 'C EMPRESARIAL VLL ESMERALDA CLL 27 #26-335 BRR PLAN PAREJO', '3118591889', 13468),
(147, '900775399', 'BOUTIQUE CARTAGENA S.A.S', 'CALLE DEL CURATO,  # 38 - 99', '322398900', 13001),
(148, '900199424', 'BPO CONSULTING S A S', 'Avenida Calle 116 No. 70 D - 86', '3212413936', 13001),
(149, '860350234', 'BRINK\'S DE COLOMBIA S.A.', 'Calle 21 No. 68 D - 08', '7449400', 13001),
(150, '900462511', 'BRITISH AMERICAN TOBACCO COLOMBIA S A S', 'Carrera 9 No. 78-31', '601- 4262000', 13001),
(151, '800205227', 'BSI COLOMBIA S.A.', 'Carrera 50 No. 102 A - 90', '3208510400', 11001),
(152, '901522452', 'BUENAS IDEAS DEL CARIBE SAS', 'CENTRO CALLE DEL COLEGIO', '3002468146', 13001),
(153, '800184195', 'BUREAU VERITAS COLOMBIA LIMITADA', 'Carrera 16 No. 97 – 40 Torre 1 Oficina 401 Edificio Torre 97', '3112245963  601', 13052),
(154, '900477127', 'BUSINESS AND QUALITY SERVICES S A S - BQS S A S', 'calle 36 No 15 73', '3160168005', 13001),
(155, '901068876', 'C&C REDES E INGENIERIA S.A.S', 'Diagonal 32  32 84 Barrio Ternera Diagonal a la Universidad de San Buenaventura al lado de', '3145349617 - 32', 13001),
(156, '901567168', 'C&Y GROUP SAS', 'CHIPRE', '3004408211', 13001),
(157, '890403515', 'C.I DISTRICANDELARIA S.A.S.', 'KM 6 DE MAMONAL CENTRO EMPRESARIAL PARQUIAMERICA OFI 107', '3126452674', 13001),
(158, '900328914', 'C.I. CARIBBEAN BUNKERS S.A.S.', 'CENTRO EMPRESARIAL BOSQUE EJECUTIVO TV. 54 21 A 104', '3167416540', 13001),
(159, '806000553', 'CABLEMAG TELECOMUNICCIONES LTDA', 'barrio centro', '3218815639', 13430),
(160, '890400080', 'CABOT COLOMBIANA S.A.', 'mamonal km. 12', '3126311700', 13001),
(161, '860007336', 'CAJA COLOMBIANA DE SUBSIDIO FAMILIAR COLSUBSIDIO', 'Calle 26 # 25-50', '7420100', 13001),
(162, '860013570', 'CAJA DE COMPENSACION FAMILIAR CAFAM', 'Avenida 68 No. 90 - 88 Bloque 4 Piso 2', '3054275698', 13001),
(163, '890480110', 'CAJA DE COMPENSACION FAMILIAR DE CGENA-COMFAMILIAR', 'CENTRO, EDIFICIO BANCO DE BOGOTA PISO 4', '3135642529', 13430),
(164, '890480023', '\"CAJA DE COMPENSACION FAMILIAR DE FENALCO-ANDI \"\"COMFENALCO\"\"\"', 'zaragocilla, diag 30 #50-187', '6938000 ext 212', 13001),
(165, '806005089', 'CALZAMOS SAS', 'Carrera 41 No 14-40', '3136959212', 13001),
(166, '805004875', 'CALZATODO S.A.', 'Carrera 34 13 A 253', '8823044', 13001),
(167, '890481080', 'CAMARA DE COMERCIO DE MAGANGUE', 'cra 4 #12-12', '5846175 -109', 13468),
(168, '900300779', 'CAMIN CARGO CONTROL COLOMBIA S A S', 'Calle 120 A No. 7 - 62 Oficina 304', '6426793', 13001),
(169, '901111348', 'CAMINOS IPS SAS', 'La Consolata Mz.H Lt.4', '3183519486', 13001),
(170, '806013065', 'CANTECO S.A.', 'turbaco', '3138358632', 13838),
(171, '900009890', 'CAR CENTER DE COLOMBIA S A', 'Carrera 7 # 156 - 68 Torre 3 Oficina 2501 Edificio. NORTH POINT', '6015800276  - 6', 13654),
(172, '860006853', 'CARBOQUIMICA S.A.S.', 'Mamonal Km 12 via Pasacaballos  Cartagena', '3174402593', 13001),
(173, '891903333', 'CARCAFE LTDA', 'Calle 72 10-07', '3103078038', 13001),
(174, '800237677', 'CARGA Y PAQUETES S.A.', 'CR 43 44 60', '3006361940', 13001),
(175, '900699545', 'CARGODEPOT SAS', 'Km 1 Vía Siberia Funza Zona Franca Permanente Intexona Bodega 11B', '8237720- 402', 13001),
(176, '901156735', 'CARIBE FOOD GROUP SAS', 'Calle del Espritu Santo Cra 10 C # 29-200 Barrio Getsemani', '3007663735', 13001),
(177, '900801256', 'CARIBE HOTELES & SUITES SAS', 'marbella cra 2 # 47 - 10', '3044564734', 13001),
(178, '900233968', 'CARIBE PLAZA CENTRO COMERCIAL', 'PIE DE LA POPA CALLE 29D #22-108', '6692332-EXT-11', 13001),
(179, '901380949', 'CARIBEMAR DE LA COSTA SAS ESP', 'Carrera 13 B No. 26-78 EDIFICIO CHAMBACU PISO 3', '3611000', 13430),
(180, '8711095', 'CARLOS MARIO PELAEZ DANGOND', 'CALLE 68 50 97', '53609096', 13442),
(181, '901673971', 'CARMENSACHA S.A.S.', 'CRA 63 23 104', '3106945602', 13244),
(182, '900912827', 'CARTAGENA COMPLEMENTARIA SOCIAL Y DE INDIAS SAS', 'Urb. Anita, Diag.32 No.71-77 Operador 2 - Patio Portal Transcaribe', '3045634121', 13001),
(183, '900915647', 'CARTAGENA CONTAINER TERMINAL OPERATOR  S.A.S.', 'BOSQUE', '6724250', 13001),
(184, '901091178', 'CARTAGENA DUBAI BEACH RESORT & SPA SAS', 'br. bocagrande cr 1 calle 9 82', '3175431632', 13001),
(185, '900099991', 'CASA DEL EMBOBINADOR  S.A.S.', 'Transversal 49 #21-46 Barrio el Bosque Cartagena de Indias', '3177494674', 13001),
(186, '901471477', 'CASA DON LUIS HOTEL S.A.S.', 'Bocagrande Cra 4ta #6 - 148', '3102018357', 13836),
(187, '900226553', 'CASATEX SPORT S.A.S', 'AV PEDRO DE HEREDIA', '3234642030', 13001),
(188, '900433159', 'CASTILIFT SERVIEQUIPOS SAS', 'Transversal 54#28-25', '3108255876', 13836),
(189, '811033997', 'CDEM & CDEB  S.A.', 'Cra 52 # 34-09', '232 12 80 Ext. ', 13838),
(190, '900154535', 'CDF COLOMBIA S.A.', 'Bocagrande Cra 3 6A-100, Torre Empresarial Proteccion', '3106151546', 13244),
(191, '890406520', 'CELLUX COLOMBIANA S.A.', 'via mamonal km 4', '3165294200', 13001),
(192, '800249860', 'CELSIA COLOMBIA S.A.  E.S.P.', 'Cali', '(602) 6046398  ', 13001),
(193, '900155107', 'CENCOSUD COLOMBIA S.A.', 'Avenida 9  No. 125 - 30 piso 7', '3203820921', 13001),
(194, '900531210', 'CENIT TRANSPORTE Y LOGISTICA DE HIDROCARBUROS S.A.S.', 'Calle 113 No. 7 - 80 Pisos 12 y 13', '3198800', 13683),
(195, '800149226', '\"CENTRAL COOPERATIVA DE SERVICIOS FUNERARIOS DE CARTAGENA \"\"CARTAFUN\"\"\"', 'carretera la cordialidad trnv 54 31J-27', '3168734161', 13620),
(196, '806003755', 'CENTRO COMERCIAL PASEO DE LA CASTELLANA', 'Avenida Pedro Heredia, Barrio Villa Sandra, Calle 30  #30 -31', '6531950, 653384', 13001),
(197, '800180176', 'CENTRO DE DIAGNOSTICO Y TRATAMIENTO CENDIATRA SOCIEDAD POR ACCIONES SIMPLIFICADA - CENDIATRA S.A.S.', 'CALLE 19 # 3-50', '313 3416782', 13001),
(198, '900215151', 'CENTRO DE ESPECIALISTAS IPS LOGROS S.A.S', 'Avenida carrera 14 nmero 39-18 edificio Soho la 39, local 2 y 3 primer piso. Barrio sagra', '3153688472', 13001),
(199, '900482242', 'CENTRO HOSPITALARIO SERENA DEL MAR S.A.', 'Km 8 via al mar', '3233585287', 13683),
(200, '806016225', 'CENTRO MEDICO BUENOS AIRES SAS', 'TRANSV. 54 N°49-45 SECTOR BUENOS AIRES', '3183483706', 13001),
(201, '806004548', 'CENTRO MEDICO CRECER LTDA', 'Cartagena Avenida Pedro de Heredia calle 30 #34-22', '3114071194', 13001),
(202, '900042824', 'CENTRO OFTALMOLOGICO EBENEZER SAS', 'Manga, av lacides segovia #16-60', '3177371669', 13001),
(203, '806007650', 'CENTRO RADIO ONCOLOGICO DEL CARIBE SAS', 'BARRIO ARMENIA CRA 48 # 30 - 60', '318 7899749', 13001),
(204, '901041691', 'CENTROS MEDICOS COLSANITAS S.A.S.', 'Calle 100 No. 11 B - 67', '3212424360', 13052),
(205, '890503314', 'CERAMICA ITALIA S.A.', 'AVENIDA 3 CL 23 AN ZONA INDUSTRIA', '3205209973', 13001),
(206, '900799452', 'CEVIMAKER SAS', 'BRR MARBELLA, EDIFICIO TORRE DE CADIZ, KR 2 #48-04', '6056514630', 13001),
(207, '900371573', 'CHEMIWORLD SAS', 'carrera 7#156-10', '3154598505', 13001),
(208, '890403628', 'CIMACO SAS', 'km 8 sector loma de piedra', '3008224921', 13836),
(209, '901118234', 'CK DISTRIBUIDORA SAS', 'Transv 54 Mz 43 L4 Carretera La Cordialidad', '3006446825', 13001),
(210, '890400693', 'CLINICA BLAS DE LEZO S.A.S.', 'TRANSV 54 #47 - 57', '6931315', 13001),
(211, '806008439', 'CLINICA CARTAGENA DEL MAR S.A.S.', 'Pie de la Popa Calle 30 N°20-71', '6939274 - 69392', 13001),
(212, '800149384', 'CLINICA COLSANITAS S A', 'Calle 100 No. 11 B - 67', '3185929461', 13001),
(213, '900027397', 'CLINICA HIGEA IPS SA', 'amberes cra. 41 #27-92', '3113418410', 13001),
(214, '900491883', 'CLINICA LA ERMITA DE CARTAGENA S.A.S.', 'Calle 29D # 20A-18 Pie de la popa', '3168545068', 13001),
(215, '900496641', 'CLINICOS PROGRAMAS DE ATENCION INTEGRAL SAS IPS - CLINICOS P', 'Carrera 49 D No. 91 - 56', '3003099711', 11001),
(216, '890400482', 'CLUB DE PESCA DE CARTAGENA', 'manga', '6605578', 13001),
(217, '890404531', 'CLUB NAUTICO CARTAGENA LTDA', 'Avenidad miramar calle 24 n° 19 - 50, manga', '3236974718', 13001),
(218, '900352085', 'CLUB NAVAL DE SUBOFICIALES', 'CRESPO KM 1 VIA A LA BOQUILLA', '6666190', 13001),
(219, '823000097', 'CM DE COLOMBIA S.A.S.- MULTIDROGAS', 'MZ D BODEGA 4 Y 5 SAN JERONIMO', '3244307452', 13001),
(220, '806005826', 'CODIS COLOMBIANA DE DISTRIBUCIONES Y SERVICIOS C.I. S.A.', 'PASACABALLOS', '3216799977', 13001),
(221, '900244455', 'COFRACO S.A.S.', 'cra 8B #25-100 Getsemani - centro', '6503030', 13001),
(222, '900684333', 'COLEGIO GIMNASIO DEL VALLE SAS', 'Turbaco, urbanización El Valla No. 5-49 Kra 29', '6556234-3145329', 13836),
(223, '890480079', 'COLEGIO JORGE WASHINGTON', 'anillo vial km 12', '3013622537', 13442),
(224, '900827987', 'COLEGIO LA CANDELARIA', 'KRA 17 CALLE 18 BARRIO FLORIDA', '3023898018-3013', 13430),
(225, '890401881', 'COLEGIO MONTESSORI SAS', 'CALLE 26 No. 18 86 AVENIDA JIMENEZ BARRIO MANGA', '6545254', 13001),
(226, '891800269', 'COLEGIO SEMINARIO DIOCESANO DE DUITAMA', 'Tv 14 9 65', '6087614778', 13001),
(227, '830122566', 'COLOMBIA TELECOMUNICACIONES S.A E.S.P BIC', 'Transversal 60 No. 114 A - 55', '3157582587', 13001),
(228, '900873786', 'COLOMBIAN SHIP SUPPLIER S A S - COSS SAS', 'Carrera 11 No. 93 - 53 Oficina 503', '7431434', 13001),
(229, '800209179', 'COLOMBIANA DE ENCOMIENDAS S.A.', 'PARQUE INDUSTRIAL CELTA BODEGA 126', '3108590333', 13442),
(230, '860037943', 'COLOMBIANA DE INCUBACION S.A.S. INCUBACOL', 'CARRERA 9 #21-21 BALMORAL', '3132326603', 13430),
(231, '900496469', 'COLOMBIANA DE SERVICIOS LOGISTICOS S.A.S - COLSERLOG S.A.S', 'Avenida calle 17 N 82-67', '9156194', 13222),
(232, '860040576', 'COLTANQUES S.A.S.', 'Carrera 88 No. 17 B - 40', '3108664064', 13001),
(233, '900485260', 'COLTUGS SAS', 'Calle 81 No. 11 - 55 Torre Norte Oficina 401', '3212001531', 13001),
(234, '860090721', 'COLVISEG COLOMBIANA DE VIGILANCIA Y SEGURIDAD LIMITADA', 'Carrera 20 No. 66 - 15', '3144743023', 13001),
(235, '900139412', 'COMBUGAS SAS', 'TERNERA DIAG 31D #32A', '3245525984', 13001),
(236, '900341086', 'COMERCIAL NUTRESA S.A.S.', 'CARRERA 52 20 124', '3148445908', 13052),
(237, '900107227', 'COMERCIALIZADORA AGREGADOS DEL CARIBE S.A.', 'tercera av del cabrero edif laguna 46 piso 13', '3216799775', 13052),
(238, '890908822', 'COMERCIALIZADORA DE HIELOS IGLU S.A.', 'Cll 86#51 a -31', '3188341524', 13001),
(239, '900713171', 'COMERCIALIZADORA DE SERVICIOS DE BOLIVAR  S.A.S', 'Manga Calle 28 N 27 32, Edificio SeaPort 3 - Piso 21', '3128994232', 13001),
(240, '806008176', 'COMERCIALIZADORA EL CONSTRUCTOR SA', 'Av Pedro Heredia Sector El Rubí', '3145961251', 13001),
(241, '900481902', 'COMERCIALIZADORA FRESMAR S.A.S', 'Carrera 16 numero 79-34 la romelia', '3288989', 13001),
(242, '890925215', 'COMERCIALIZADORA INTERNACIONAL PRODUCTOS AUTOADHESIVOS  ARCLAD S.A.', 'Autopista Medellin Bogota Kilomtero 34 Vereda La Playa', '4480530', 13836),
(243, '806000058', 'COMERPES S.A', 'dg 20 #45 A 71', '3145964216', 13001),
(244, '890908493', 'COMESTIBLES DAN S.A.', 'CRA 41 # 46 - 81', '3122715493', 13836),
(245, '860070374', 'COMPAÑIA ASEGURADORA DE FIANZAS S.A. - SEGUROS CONFIANZA S.A.', 'CALLE 82#11-37', '3157771267', 13001),
(246, '800034825', 'COMPAÑIA DE ALIMENTOS ANTILLANA S.A.S.', 'Albornoz km 3 Nro 1 - 174, via mamonal', '3126691449 - 31', 13052),
(247, '860007627', 'COMPAÑIA DE JESUS', 'Carrera 25 No. 39 - 79', '6013314560', 13836),
(248, '860078828', 'COMPAÑIA DE MEDICINA PREPAGADA COLSANITAS S A', 'Calle 100 No. 11 B - 67', '3212424360', 13052),
(249, '800156044', 'COMPAÑIA DE PUERTOS ASOCIADOS S.A. - COMPAS S.A.', 'Calle 93 A No. 11 - 36 Edificio Correcol Oficina 201', '6724250', 13001),
(250, '806013873', 'COMPAÑIA ESTIBADORA COLOMBIANA SAS', 'manga terminal maritimo', '6607781', 13001),
(251, '890401427', 'COMPAÑIA HOTELERA DE CARTAGENA DE INDIAS S.A.', 'Avenida Almirante Brion, Carrera 1, El Laguito, Cartagena de Indias 130015', '3102234085', 13001),
(252, '901029762', 'COMPAÑIA MINA WALTER S.A.S.', 'Diagonal 11 # 9-73', '3145153901', 13042),
(253, '860037013', 'COMPAÑIA MUNDIAL DE SEGUROS S A - SEGUROS MUNDIAL', 'Calle 33 No. 6 B -24', '3208321053', 13683),
(254, '901003701', 'COMPAÑIA NACIONAL DE INTELIGENCIA VIAL S.A.S.', 'variante mamonal gambote sect llave de oro', '3022796340', 13001),
(255, '900639810', 'COMPAÑIA NACIONAL DE LOGISTICA CONALOG S.A.S.', 'CL 19 # 68 D - 73', '3182524769', 13001),
(256, '800247852', 'COMPAÑIA OPERADORA PORTUARIA  CAFETERA S.A.', 'TER MARITIMO SPB ED ALCAZAR BG 2 Y 3', '3106211848', 13001),
(257, '806006847', 'COMPLEMENTOS INDUSTRIALES SAS', 'Brr Campestre Cl 10 56B 211', '3205427608', 13001),
(258, '806015647', 'COMPULAGO SAS', 'CHIPRE, CALLE 30 C N° 60 G 45', '3203803022', 13001),
(259, '830049916', 'COMPUTEL SYSTEM SAS', 'Carrera 16 A No. 80 - 15', '3161000', 13001),
(260, '900923095', 'COMUNICACIONES REDES Y ENLACES SAS', 'Turbaco, Barrio Plan Pareja Cr 15', '3001632731', 13001),
(261, '830092461', 'CONALTRA S A', 'Calle 15 No. 68 D - 88', '6013288290', 13001),
(262, '900787317', 'CONARES DEL CARIBE S.A.S', 'SOCORRO PLAN 220 MZA13 L 6', '3145246324', 13001),
(263, '802003123', 'CONDOMINIO ISLARENA', 'k 44 via al mar cartagena barranquilla condominio Islarena', '3174327081 -321', 13673),
(264, '806009721', 'CONDOR LABS SAS', 'Bocagrande Cra. 3 #9-30  Torre empresarial Prodegi piso 18', '3167144267', 13248),
(265, '900145394', 'CONEXIONES TECNOLOGICAS Y COMUNICACIÓN S.A.S.', 'CLLE 16 42 210', '3336160984', 13001),
(266, '860028947', 'CONGREGACION DE HERMANAS FRANCISCANAS MISIONERAS DE MARIA AUXILIADORA', 'VEREDA SIETE TROJES SECTOR EL PAPAYO CASA DE ORACION SAN FRANCISCO', '3107981837-3214', 13001),
(267, '860009985', 'CONGREGACION DE LOS HERMANOS DE LAS ESCUELAS CRISTIANAS', 'Calle 71 No 11 - 10 piso 5', '3434300', 13001),
(268, '830099025', 'CONSOLCARGO S.A.S.', 'Avenida Calle 26 No. 96J - 66 Oficina 401', '2637122', 13001),
(269, '800197527', 'CONSTRUCCIONES METALICAS DEL CARIBE S.A.S', 'Bayunca Cra La Cordialidad Km 16', '3153026079', 13001),
(270, '900324784', 'CONSULTEC INTERNATIONAL SUCURSAL COLOMBIA', 'carrera 9a No 99-02', '3160174997', 13670),
(271, '901309777', 'CONSUMER SALES SERVICES COLOMBIA S.A.S.', 'CARRERA 46 No. 70-115', '3600270-3600274', 13001),
(272, '802011154', 'CONUTRIR S.A.S.', 'calle 59 No. 53-33', '3682626', 13001),
(273, '901417124', 'COOMEVA EMERGENCIA MÉDICA SERVICIO DE AMBULANCIA PREPAGADA S.A.S.', 'Calle 13 #57 – 50 (piso 2 puerta 4)', '3166925364', 13836),
(274, '890904478', 'COOPERATIVA  COLANTA', 'Carrera 64 C # 72 – 160 Edificio Tulio Ospina Colanta Piso 2', '4455555', 13001),
(275, '860014397', 'COOPERATIVA DE LOS TRABAJADORES DEL INSTITUTO DE SEGUROS SOCIALES-COOPTRAISS', 'Calle 24 No. 26 - 70', '3214613754', 13001),
(276, '800068455', 'COOPERATIVA INTEGRAL DE TRANSPORTE DE CARTAGENA COOINTRACAR', 'Carretera Troncal de Occidente Sector Bajo Miranda KM 1 Vía Turbaco', '3246803248', 13001),
(277, '890300625', 'COOPERATIVA MEDICA DEL VALLE Y DE PROFESIONALES DE COLOMBIA - COOMEVA', 'Calle 13 # 57 50', '3330000', 13001),
(278, '830011670', 'COOPERATIVA MULTIACTIVA DE SERVICIOS SOLIDARIOS - EN TOMA DE POSESIÓN - COPSERVIR', 'Calle 13 No. 42 - 10', '3502461181', 13001),
(279, '890904713', 'COORDINADORA MERCANTIL S.A.', 'Calle 5A 39 194 Ed Torre Dinners Club Piso 8', '3017599923', 13442),
(280, '806009427', 'COPRESALUD S.A IPS', 'OLAYA HERRERA SECTOR LA MAGDALENA CALLE 32 D', '3142361816', 13001),
(281, '806015984', 'CORPORACION EDUCATIVA LA SAGRADA FAMILIA', 'Barrio Los Corales Mza Q Lote 8', '3176986685', 13001),
(282, '800161338', 'CORPORACION EDUCATIVA LOS ANGELES', 'URB LOS ANGELES CLL 30A # 62-83', '3006577869 - 30', 13001),
(283, '806003168', 'CORPORACIÓN GESTIÓN Y ACCIÓN POR COLOMBIA', 'Blas de Lezo Etapa 3 Mz 27 Cs 1', '3155326120', 13001),
(284, '806014430', 'CORPORACIÓN INSTITUTO SOLEDAD VIVES DE JOLY', 'terrazas de calicanto', '3012597471', 13001),
(285, '900976844', 'CORPORACIÓN MATIMBA CLUB & SPA', 'BARU CL 5 513', '3218063861', 13001),
(286, '860403751', 'CORPORACION UNIVERSITARIA ADVENTISTA', 'Cr 84 #33AA - 01', '3187076442', 13657),
(287, '890481276', 'CORPORACION UNIVERSITARIA RAFAEL NUÑEZ', 'CENTRO, AV. CARLOS ESCALLON #8-59 PASAJE LA MONEDA L-111', '6056439499', 13001),
(288, '901295223', 'COSCO SHIPPING LINES COLOMBIA S.A.S', 'CALLE 97 23 60', '3213076808', 13001),
(289, '806008873', 'COTECMAR', 'Mamonal km 9', '6439491', 13001),
(290, '830088574', 'CRAFT COLOMBIA S.A.S.', 'calle 100 # 7-33', '5525151', 13836),
(291, '860032909', 'CREDIBANCO S.A. - CREDIBANCO', 'Avenida Carrera 68 No. 75A - 50', '3204281117', 13001),
(292, '806014415', 'CREPES CARTAGENA S.A.', 'Canapote, cra 16 #65 esq', '3182753669', 13001),
(293, '900252181', 'CRN LTDA CONSTRUCCINES Y REPARACIONES NAVALES', 'BELLA VISTA CRA 56B 7A-30', '3001360484', 13001),
(294, '806006601', 'CY DE COLOMBIA SAS', 'MANGA CALLE 26', '6455090', 13838),
(295, '900359321', 'DAPASOS S.A.S', 'VEREDA BOITIVA FINCA EL ZARZAL', '3103524632', 13873),
(296, '900532504', 'DAVITA S.A.S.', 'Av. Cra 45 # 108-27 T.3 Piso 22', '+57 315 4716533', 13001),
(297, '901066786', 'DECEUNINCK SAS', 'ZONA FRANCA BODEGA 15', '3183454264', 13001),
(298, '900657493', 'DELIVERANCE  SHIPPING  LINE  S.A.S', 'CRA. 5 SUR NO. 16-38 DIAGONAL DE TEXACO', '3138662065', 13001),
(299, '900262908', 'DEMCA S.A.S', 'Bosque avenidad crisanto luque diag 22 N 44-36', '3176171497', 13838),
(300, '901202570', 'DEMEQUIPOS S.A.S.', 'BARRIO EL RECREO URBANIZACION CIUDAD  SEVILLA MNA B LTE 10 PISO1', '3245940349', 13001),
(301, '806001247', 'DEPOTRANS TANK CONTAINER CARTAGENA S.A.S.', 'MAMONAL KM 9', '6056687269', 13001),
(302, '860068121', 'DESPACHADORA INTERNACIONAL DE COLOMBIA SAS', 'Carr Briceño - Sopo Km 2', '3115724314', 13001),
(303, '860502609', 'DHL EXPRESS COLOMBIA LTDA', 'cra 85d # 46a- 38', '3226849687', 13001),
(304, '891800111', 'DIACO S A', 'CALLE 93 B # 98-12', '3143592886', 15491),
(305, '830006051', 'DIAGEO COLOMBIA S A PUDIENDO TAMBIEN GIRAR BAJO LA DENOMINACIÓN SOCIAL DIAGEO DE COLOMBIA S.A.', 'Calle 100 No. 13 - 21 Oficina 502', '3176395590 - 31', 70713),
(306, '901404451', 'DIEVALPOS S A S - DIEVALPOS S A S', 'CALLE 45#09-02', '3144290796', 11001),
(307, '830085336', 'DIGITAL MTX S.A.S', 'Aut Medellín Km 3 Bg 41 Md 2 CC Metropolitano', '3154593112', 25214),
(308, '900560774', 'DISAN AGRO SAS', 'Kilometro 1.6 via cota', '3183660418', 13001),
(309, '860048867', 'DISAN COLOMBIA S.A.', 'Kilometro 1.6 via cota', '3183660418', 13001),
(310, '901176567', 'DISEINS S.A.S', 'Calle 4 80 G 48 Barrio el Recreo', '3203017742', 13001),
(311, '806006017', 'DISEÑOS Y CONSTRUCCIONES DE COLOMBIA S.A.S.', 'Transv 40 #22 – 39', '3017665994', 70233),
(312, '900580962', 'DISFARMA GC SAS', 'SAN JORGE, BODEGA 93', '3163317043', 13683),
(313, '800089872', 'DISMEL LTDA', 'Centro Industrial Ternera N 1 bg 3B', '3145813569', 13001),
(314, '860028580', 'DISPAPELES S.A.S', 'Calle 103 No. 69 - 53', '6016439030', 13001),
(315, '901142940', 'DISRIVERA SAS', 'Calle San Clemente No. 2 -126', '3145409098', 13430),
(316, '811009788', 'DISTRACOM S.A.', 'CALLE 51 # 64 B 57  MEDELLIN', '3108968476', 70708),
(317, '806013303', 'DISTRIALIADOS LTDA', 'Centro Industrial Ternera No.2 Bodega I 13 Dg.31  No.107 75', '3145060922', 13442),
(318, '900202182', 'DISTRIBOLIVAR JR SAS', 'barrio España calle 30 No 46-08', '3008077445', 13433),
(319, '901434576', 'DISTRIBUCIONES ACOLAGUITO LIMITADA', 'VIA 40 73 290 OFI 422', '3046776350', 13001),
(320, '900121594', 'DISTRIBUCIONES ESPECIALIZADAS R & G SAS', 'Barrio el prado diagonal 22 # 25-220', '6552162  101', 13001),
(321, '806016023', 'DISTRIBUCIONES IMPORTACIONES Y CONSTRUCCIONES OGA LTDA', 'cra 3a n 17-185 b la candelaria', '3244061172', 13430),
(322, '830142051', 'DISTRIBUCIONES Y PRODUCCIONES SION SAS', 'km 2.5 Autopista Bogota- Medellin', '3145612544', 11001),
(323, '806001906', 'DISTRIBUIDORA ANCLA S.A. S', 'Bosque, Dg 21 No. 48-09', '605 653 9665', 13001),
(324, '890403753', 'DISTRIBUIDORA COLOMBIA LTDA', 'Bosque Diag.21A #53-115', '3114189082', 13052),
(325, '900327769', 'DISTRIBUIDORA DE JESUS SAS', 'Clle 29 12B - 29 Brr. Bellavista', '3043165494', 13001),
(326, '890916575', 'DISTRIBUIDORA DE VINOS Y LICORES S.A.S', 'CRA 43A #25A 45', '3116179348', 13001),
(327, '900472799', 'DISTRIBUIDORA EL CORRALITO DE PIEDRAS SAS', 'SAN JOSE LOS CAMPANOS CRA 100 N 33A', '3153359233', 13001),
(328, '800043910', 'DISTRIBUIDORA TROPICAL DE BOLIVAR S.A.', 'BOSQUE DIAG 21 B NO 53 74', '3114216433', 13052),
(329, '900700078', 'DISTRIBUIONES RCT SAS', 'Escallon cll 30F No 54-35', '3114063682', 13001),
(330, '830033723', 'DISTRICARGO OPERATIONS S A COLOMBIA', 'Carrera 106 # 15 a 25 bod 134 c', '3143347969', 13001),
(331, '900520488', 'DISTRIMOTOS DE COLOMBIA S.A.S', 'CL 11 24 51', '314 2326155', 15491),
(332, '830076368', 'DISTRISERVICES S.A', 'Carrera 106 # 15 a 25 bod 134 c', '3143347969', 13001),
(333, '900984690', 'DIVITIAS SAS', 'getsemani calle sierpe con san juan esquina 9A-08', '3177252388', 13001),
(334, '901289601', 'DREAMS COLOMBIA S.A.S', 'Avenida Carrera 97 No. 24C - 51 Bodega 13', '2901685 ext 10-', 13001),
(335, '900745332', 'DRINK LAB SAS', 'Centro calle de las carretas #34-84', '3216714993', 13001),
(336, '901417410', 'DRINK THE TIME S.A.S.', 'CENTRO,  PLAZA DE LOS COCHES, CRA 34 #7-33', '3174255259', 13001),
(337, '890101063', 'DROGUERIAS JULIAO S.A.', 'Via 40 No 51 - 163', '6549990 - 30140', 13001),
(338, '800149695', 'DROGUERIAS Y FARMACIAS CRUZ VERDE S.A.S. - DROGUERIAS CRUZ VERDE O FARMACIAS CRUZ VERDE', 'Carrera 12 No. 96-32', '3185163208', 13001),
(339, '830080649', 'DUANA Y CIA LTDA', 'CALLE 15 # 36A-223 YUMBO', '3185682109', 13222),
(340, '900992359', 'ECOBEL GLAMPING S.A.S', 'CLL 32 5 09 EDIF ANDIAN OF. 609 BRR. CENTRO', '3025145964', 13001),
(341, '899999068', 'ECOPETROL S A', 'Carrera 13 No. 36 - 24 Piso 12', '2344000', 13001),
(342, '900761374', 'ECOVIDA INTEGRAL  S.A.S.', 'km 1.5 via cerritos la virginia centro logistico los Angeles bodega 03', '3142264814', 13838),
(343, '890404273', 'EDITORA DEL MAR S.A.', 'PIE DEL CERRO CLL30 # 17-36', '6499090  290', 13001),
(344, '900385056', 'EDITORIAL ENCUENTRO SAS', 'Calle 4 Sur # 19-64', '3203939284', 11001),
(345, '890900082', 'EDUARDOÑO S.A.S', 'EDIFICIO PORVENIR. Cra 43A # 1 Sur 220. Oficina 606. Medelln, Antioquia.', '3163610013', 13001),
(346, '900582731', 'EGA- KAT LOGISTICA S.A.S', 'Calle 100 No. 9 A - 45 Torre 1 Oficina 602', '3502986623', 13001),
(347, '900857441', 'EGA- KAT ZONA FRANCA SAS', 'Vereda la Punta Autopista Medelln Kilmetro 5 + 759 Costado Sur  Kilmetro 0 + 920 entr', '3502986623', 13001),
(348, '901073587', 'EL BALUARTE DISTRIBUIDORA SAS', 'Diag 31 100-115 Centro Industrial Ternera 1 bod 36 San Jose de los Campanos', '3008116971 - 31', 13001),
(349, '806005423', 'EL CONSTRUCTOR INVERSIONES S.A.', 'Av Pedro Heredia Sector El Rubí', '3145961251', 13001),
(350, '900375454', 'EL VIAJERO HOSTELS SAS', 'Calle 85 # 15-36', '3233927011', 13001),
(351, '806010814', 'ELECTRICOS FERNANDO VELEZ & CIA LTDA', 'AV CRISANTO LUQUE DIAG 22 44B 12', '3186298504', 13001),
(352, '890401375', 'ELECTRONICA MARITIMA ITEC SAS', 'centro logistico bloc port bodega 51', '3046785289', 13052),
(353, '800185496', 'ELECTROREYES LIMITADA.', 'Carrera 45 No 35 - 57', '3158734951 - 31', 13001),
(354, '900545229', 'ELEPHANT IMPORT & EXPORT S.A.S.', 'Calle 10 No. 59 - 120 Lote 19 Piso 2 Carretera Cordialidad Km 5 Parque Industrial Los Volc', '3022544593', 13836),
(355, '900756617', 'ELIS CARIBE SAS', 'Variante Turbaco, Sector Aguas Prietas Calle 1 Cra. 2 – 5 DUP 1', '3164333996', 13838),
(356, '901236507', 'ELITE BLU S.A.S.', 'Calle 97 No. 23 - 60 Oficia 702 Torre Proksol', '3212278079', 13001),
(357, '809009050', 'EMBOTELLADORA DE BEBIDAS DEL TOLIMA S.A. - EMBEBIDAS S.A.', 'Carrera 13 No. 93-24', '310 2951882', 13001),
(358, '890915475', 'EMPAQUETADURAS Y EMPAQUES S.A.', 'Carrera 52 # 23-54', '6043505000', 13001),
(359, '800113955', 'EMPRESA DE SERVICIO ESPECIAL DE TRANSPORTE MAMONAL SAS', 'San Jose de los Campanos Kra 100 No 34 B 50', '3218960044', 13001),
(360, '900455224', 'EMPRESA DE TRANSITO Y TRANSPORTE DE TURBACO SAS', 'PLA PLAREJO CALLE 25 #27-336', '3106504077', 13001),
(361, '890401570', 'EMPRESA DE TRANSPORTE RAPIDO EL CARMEN  SA', 'TERMINAL DE TRASNPORTE', '3135550265', 13001),
(362, '806013532', 'EMPRESA INTERMUNICIPAL DE SERVICIOS PÚBLICOS DOMICILIARIOS DE ACUEDUCTO Y ALCANTARILLADO S.A.  E.S.P', 'santa rosa bolivar', '3216600720', 13001),
(363, '900277518', 'EMSIC SAS', 'Cartagena, Variante Pozón Policarpa Km 2-20', '3145065275-3205', 13052),
(364, '900313913', 'ENGINEERING PROJECTS AND SERVICES SAS', 'CALLE 29C #19-31', '3167426859', 13001),
(365, '830003564', 'ENTIDAD PROMOTORA DE SALUD FAMISANAR S.A.S - EPS FAMISANAR SAS', 'Cr 13a #77a-63', '6500200 EXT 341', 25269),
(366, '800251440', 'ENTIDAD PROMOTORA DE SALUD SANITAS S.A.S - E.P.S. SANITAS S.A.S', 'Autopista Norte No. 109 - 20', '3212424360', 13001),
(367, '806008394', 'ENTIDAD PROMOTORA DE SALUD. MUTUAL SER EPS', 'Barrio la concepcin carretera troncal # 71 B 105', '00000', 13001),
(368, '901543761', 'EPS FAMILIAR DE COLOMBIA S.A.S.', 'Carrera 59 B # 77-70 Barrio Villa Country', '3148348478', 13001),
(369, '900192698', 'EQUIPOS Y LOGISTICA S.A', 'Dirección: Mamonal km 1, BLOC PORT, oficina 28 segundo piso.', '3205133998-6583', 13001),
(370, '900953218', 'EQUIPOS Y SOLUCIONES DE LUBRICACION S.A.S', 'Via Mamonal Km 1 - Centro Logístico Bloc Port Bodega  22', '3124986766', 13836),
(371, '806009551', 'EQUITERRA S.A.S', 'Parque Industrial Carlos Velez Pombo lote 24 KM1', '3145410717', 13001),
(372, '816001000', 'ESCUELA DE AVIACION INEC S.A.S.', 'BODEGA 3 ENTRADA 1 AEROPUERTO MATECAÑA', '3166963684-3401', 45),
(373, '800059470', 'ESENTTIA SA', 'Mamonal km 8', '3215692389', 13001),
(374, '806014779', 'ESTACION DE SERVICIOS CODIS S.A.S.', 'PASACABALLOS', '3216799977', 13001),
(375, '830054581', 'ESTELAR EXPRESS S A S', 'Calle 24 F No. 102 A - 23', '3506139057', 13001),
(376, '806007578', 'ESTIBAS DE EXPORTACION SAS', 'VARIANTE MAMONAL KM 5', '3205667078 - 31', 13001),
(377, '811020038', 'ESTIBAS RETORNABLES DE COLOMBIA LTDA', 'Cra. 61 #34c51 itagui', '3163235568', 13001),
(378, '900356487', 'ESTRTOPOGRAFIA EU', 'MANGA CARRERA 27#29-141', '3107212760', 13001),
(379, '900237590', 'ESTRUCTURAS Y MONTAJES DE COLOMBIA LTDA', 'Bosque Diag 21 Nro 49 - 121 Local 1', '3004970875 6581', 13001),
(380, '890926803', 'ESTUDIO DE MODA S.A', 'carrera 35 15  143', '3227157486', 13001),
(381, '890406589', 'ETEC S.A.S.', 'Albornoz via mamonal km 4', '3183118635', 13001),
(382, '800167869', 'ETRANS LTDA', 'Terminal de Transportes 2 piso oficina 207', '3183601090', 13001),
(383, '830098240', 'EUROSTYLE SAS', 'Centro Industrial Ternera 1 Bodega 41', '3205216743', 13838),
(384, '800010866', 'EXPERTOS SEGURIDAD LTDA', 'Circular 4 Laureles', '321 4908445', 13001),
(385, '830133643', 'EXTRUSA DE COLOMBIA S.A.S.', 'Calle 65 Bis No. 91 - 82', '5949999', 13001),
(386, '900399741', 'FACTURE S.A.S.', 'Carrera 26 No. 28 - 45 Edificio Torre Del Puerto Oficina 2205 - Cartagena / Bolivar', '3173708900', 13001),
(387, '800232356', 'FAJOBE S A S', 'CLIS SIBERIA BODEGA 28', '8763950 - 31750', 25175),
(388, '830093741', 'FANTASY FLOWERS S A S', 'Calle 97 No. 23 - 60 Oficina 702 Torre Proksol', '8910444 ext. 12', 13001),
(389, '900265692', 'FAVICA SAS', 'BRR CHINO CALLE 22A 74', '6692460', 13001),
(390, '830001114', 'FEPCO ZONA FRANCA S A S', 'Zona Franca', '3184017284', 13052),
(391, '890401842', 'FERROCEM-ALQUIMAR S.A.S  FERROALQUIMAR S.A.S', 'KM3 VIA MAMONAL SECTOR ALBORNOZ', '3218098106', 13001),
(392, '890936354', 'FERROCORTES G.M. Y CIA  SOCIEDAD POR ACCIONES SIMPLIFICADA', 'calle 8 sur 50 ff 123', '4484340', 13001),
(393, '901479733', 'FIABLE S.A.S', 'Carrera  46 No 43 - 53', '3118671496', 13001),
(394, '901558549', 'FIBRAZO SAS', 'Kilometro 1 Vía Turbaco Centro Industrial Ternera 2 Local D5', '541168936133 - ', 13001),
(395, '800141235', 'FIDUCIARIA POPULAR S.A. - FIDUCIAR S.A', 'Carrera 13 A No. 29-24 Piso 21', '6079977 Ext. 41', 13001),
(396, '30770995', 'FIGUEROA AYOLA EUNICE FERRETERIA CENTENARIO Y CONSTRULIDER', 'bosque tv 51 c 21b59', '3114101639', 13001),
(397, '890270045', 'FINANCIERA COAGROSUR', 'Cll 13 9 36', '3176577570', 13688),
(398, '900688066', 'FINANCIERA JURISCOOP SA COMPAÑIA DE FINANCIAMIENTO-FINANCIERA JURISCOOP C F', 'Calle 26 No. 69 D - 91', '3167433186', 13001),
(399, '830098375', 'FLORES IPANEMA S.A.S.', 'km 1 via el rosal subachoque', '6577575', 13244),
(400, '860046201', 'FORTOX S.A.', 'Avenida 5C Norte No.47N-22', '4874747', 13001),
(401, '805030046', 'FOTO CARIBE S.A.S. - FOCAR S.A.S.', 'CALLE 72 No. 47 30', '3456312, 316257', 13836),
(402, '900390641', 'FREDINNO HELADOS S.A.S.', 'calle 22a # 132-72', '3173314246', 11001),
(403, '890103697', 'FRIGORIFICO LA PARISIENNE S.A.', 'Carrera 52 No. 75-152', '3770777', 13001),
(404, '800144813', 'FRIGORIFICO METROPOLITANO S.A.S', 'Anillo vial Florida Giron KM 3.6', '3160269243', 13052),
(405, '900736914', 'FRIO ALIMENTARIA SAS', 'VARIANTE CARTAGENA-TURBACO  CLL 1  CRA 2  ZONA FRANCA PARQUE CENTRAL LOTE 69', '6424342', 13838),
(406, '891408584', 'FRISBY S.A. BIC', 'CARRERA 7 NRO. 24 74', '3301300', 13001),
(407, '900134817', 'FUNDACION AVIARIO NACIONAL DE COLOMBIA', 'Km 14.5 via isla barú', '3225529134   31', 13001),
(408, '900269029', 'FUNDACION CENTRO COLOMBIANO DE EPILEPSIA Y ENFERMEDADES NEUROLOGICAS', 'barrio ternera, calle 1', '3153455143', 13052),
(409, '811024803', 'FUNDACIÓN EMPRESAS PÚBLICAS DE MEDELLÍN', 'Calle 47A #53-51', '3017307985', 13001),
(410, '806009307', 'FUNDACION MADRE ELFRIDE', 'Nelson Mandela Sector las Vegas Mza Q L1', '3158817931', 13001),
(411, '800241770', 'FUNDACION NUEVO PERIODISMO IBEROAMERICANO', 'BRR CENTRO CLL SAN JUAN DIOS 3 121', '3183022405', 13001),
(412, '900097588', 'FUNDACION PLAN', 'Carrera 13 No. 93 - 19 Edificio Contesa P.H Oficina 401 Y 402', '3212742503', 13001),
(413, '802022886', 'FUNDACION PROYECTO TITI-SIGLA PROYECTO TITI', 'Calle 77 No 65 - 37 Local 208', '3217323315', 13657),
(414, '890480381', 'FUNDACION REI PARA LA REHABILITACION INTEGRAL IPS', 'cra 50 a nro. 31 b 12', '3215229396', 13001),
(415, '830123731', 'FUNDACION RENAL DE COLOMBIA', 'Carrera 11 Nº 71 - 41, Oficina 406', '3173647906', 13430),
(416, '890102129', 'FUNDACION SANTO DOMINGO - FSD', 'Carrera 55 No 75 - 163', '3710707', 13001),
(417, '806012960', 'FUNDACION SER', 'calle23 cra 56-32 br, montecarmelo', '3102301617', 13244),
(418, '900453926', 'FUNDACION SERENA DEL MAR', 'SERENA DEL MAR VIA AL MAR KM 8', '3104132627', 13001),
(419, '900422757', 'FUNDACION SERSOCIAL', 'AVE. SANTANDER KRA. 1 No. 41-56  BARRIO EL CABRERO', '6931547', 13001),
(420, '806011962', 'FUNDACION SOCIAL INTEGRAL FAMYSALUD', 'CHIPRE CALLE 31 No. 62-57', '3218153343', 13001),
(421, '900223749', 'FUNDACION UNIDAD DE CUIDADOS INTENSIVOS DOÑA PILAR', 'Amberes', '3145177355', 13052),
(422, '890481264', 'FUNDACION UNIVERSITARIA ANTONIO DE AREVALO - UNITECNAR', 'AV PEDRO DE HEREDIA SECTOR TESCA', '3008788760', 13001),
(423, '860517302', 'FUNDACION UNIVERSITARIA DEL AREA ANDINA', 'Cl. 24 #8-55', '3007711463', 11001),
(424, '860507903', 'FUNDACION UNIVERSITARIA LOS LIBERTADORES', 'carrera 16 63a 68', '2544750', 13001),
(425, '890481183', 'FUNDACION UNIVERSITARIA TECNOLOGICO COMFENALCO', 'Barrio España Cr 44 D N° 30A - 91, Cartagena de Indias', '6723700', 13836),
(426, '860013951', 'G4S- SECURE SOLUTIONS COLOMBIA S.A. - G4S', 'CALLE 100 NO. 19A-30', '3114721611', 13062),
(427, '800215227', 'G4S TECHNOLOGY COLOMBIA S.A.S - G4S TECH S.A.S', 'calle 100 No. 19a-30 Ecotower 100', '3114721611', 13001),
(428, '900963038', 'GALAVANTA TRAVEL S.A.S', 'CALLE SEGUNDA DE BADILLO N 36 149', '3054663022', 13001),
(429, '900603397', 'GANADERIA LA FLORIDA SAS', 'cr 2a 11 85 brr centro', '3016592373', 13430),
(430, '901629510', 'GELP MX S.A.S.', 'Carrera 19 bis No. 117 - 26', '3104919415', 25126),
(431, '900067444', 'GENSER POWER COLOMBIA', 'Calle 100 No. 13 - 31 Bogota', '601 7455060', 13244),
(432, '830055467', 'GEODIS COLOMBIA LTDA', 'Av. El Dorado 69B - 53, Ac. 26 #26', '3176431529', 13001),
(433, '860005101', 'GERLEINCO S.A.S.', 'Carrera 10 No. 28 - 49 Piso 15', '3177486113', 13001),
(434, '900258110', 'GESTION CARGO ZONA FRANCA S.A.S', 'Km 12 via al puerto zona franca Tayrona', '3162077319', 13001),
(435, '806015162', 'GESTION PHARMA S.A.S.', 'Barrio Amberes Carrera 40 numero 27 49', '3126600863', 13836),
(436, '901067786', 'GESTION Y OPERACION DE LA COSTA S.A.S. SIGLA GESTICA S.A.S.', 'Carrera 14E N44-25', '3015014002', 13001),
(437, '800029591', 'GIMNASIO ALTAIR DE CARTAGENA S.A.S.', 'Anillo vial km 14 Pontezuela', '3135121259 - 69', 13657),
(438, '900825900', 'GIMNASIO AMERICANO HOWARD GARDNER playing is learning', 'manga cra 20 No 2/-37', '3006083730', 13001),
(439, '900009162', 'GIMNASIO BILINGUE ALTAMAR DE CARTAGENA', 'Manga calle real', '3052099152', 13001),
(440, '900430148', 'GODDARD CATERING GROUP COLOMBIA S.A.S.', 'Cra. 48 # 14-120', '4441323', 13001),
(441, '900500517', 'GPC TUGS S.A.S', 'manga terminal maritimo', '3044831999', 13001),
(442, '830098031', 'GRAN ANDINA DE PLASTICOS S.A.S', 'carrera 65 b No 12 - 19', '7024757', 11001),
(443, '800084003', 'GRANELES Y CARGA S.A.', 'CRA 10 VIA PANORAMA # 9 - 16', '3155819582', 13001),
(444, '860002585', 'GRANITOS Y MARMOLES S.A.   - GRAMAR', 'CRA 73 No. 60A - 41 SUR', '3502956234', 13001),
(445, '890106814', 'GRANOS Y CEREALES DE COLOMBIA S.A.', 'Calle 18 CARRETERA A SOLEDAD', '3186000013', 13001),
(446, '806012349', 'GRANUPLAS S.A', 'membrillal calle 12 #6-216', '3205489917', 13001),
(447, '802003363', 'GRUAS Y MANIOBRAS Y MONTAJES LTDA.', 'Vía 40 No 53-57', '3145160601', 13001),
(448, '901275377', 'GRUPO BUENA VIDA', 'Centro Calle Primera de Badillo N0 35-85', '3125056585', 13001),
(449, '900795612', 'GRUPO DEFA SAS', 'calle 36 #27-75', '6610705', 13001),
(450, '900360261', 'GRUPO HEROICA SAS', 'calle 24 #8A-344', '3173750677', 13001),
(451, '901656957', 'GRUPO HOTELES SHWE S.A.S', 'CR 20 ·16-80', '3022205420', 13001),
(452, '900561259', 'GRUPO OP S.A.S.', 'Centro Calle Vicente García #6-33', '3016422873-3215', 13001),
(453, '901079882', 'GRUPO PERCAS SAS', 'Centro cra 7  32-77', '3127052050', 13001),
(454, '901512109', 'GRUPO ROSALES LOGISTICA 24/7 S.A.S.', 'BOSQUE DIAGONAL 20 NO. 52-41', '3045943989', 13006),
(455, '900176548', 'GRUPO S & M OPERACIONES INTEGRALES S.A.S.', 'Calle 110 No 37 - 42', '3821818', 13001),
(456, '901776348', 'HACEMOS BUENOS MOMENTOS S.A.S.', 'DIAGONAL 21 # 53 - 103 BARRIO: BOSQUE', '3054715527', 13001),
(457, '900298043', 'HAPAG LLOYD COLOMBIA LTDA', 'Calle 127A No. 53A-45 Torre 3 Piso 5', '3232092753', 13001),
(458, '890405519', 'HB Y CIA LTDA', 'MEMBRILLAL MZ U LOTE 5', '3183515377', 13001),
(459, '900604519', 'HC TANKOL SAS', 'pasacaballos', '3174335091', 13838);
INSERT INTO `empresa` (`idempresa`, `nit_empresa`, `nombre_empresa`, `direccion_empresa`, `telefono_empresa`, `municipios_codi_muni`) VALUES
(460, '900958115', 'HEALTH CARS SAS', 'PIEDRA BOLIVAR CRA 49 #29-122', '3183326460', 13001),
(461, '900592759', 'HEEDSALUD DEL CARIBE S..AS', 'CALLE CENTRAL COLOMBIA # 49-69', '3126237354', 13001),
(462, '860010535', 'HERMANAS MERCEDARIAS DEL SANTISIMO SACRAMENTO', 'Cl. 170 #17A-32, Usaquén, Bogotá', '6722328', 13001),
(463, '900760531', 'HIZ TELECOMUNICACIONES S. A. S.', 'Calle Portobelo (Carrera 37) # 47-26 - Segundo Piso, Arjona, Bolívar', '3228138812', 13052),
(464, '900583745', 'HOLCREST S.A.S.', 'Calle 60B Sur # 44-100 Edificio Latitud Sur', '3209800', 13001),
(465, '890480135', 'HOSPITAL INFANTIL NAPOLEON FRANCO PAREJA', 'Bruselas Tz 36 # 36-33', '3007749143', 13683),
(466, '900902431', 'HOTEL CARTAGENA PLAZA DE LA ADUANA SAS', 'Centro, Plaza de la Aduana', '3014774116', 13001),
(467, '900249602', 'HOTEL CASA LOLA S.A.S.', 'getsemani calle del guerrero N 29-108', '3218097933', 13836),
(468, '900275396', 'HOTEL PARADOR TROPICAL DEL CARIBE S.A.S.', 'VARIANTE MAMONAL GAMBOTE KM 10', '3008565558', 13001),
(469, '800157788', 'HOTEL PUERTA DEL SOL S.A.', 'Calle 75 #41d -79', '3102018357', 13468),
(470, '800020023', 'HOTEL SANTA CLARA S.A.', 'centro calle del torno cra 8 no 39 114', '6504700', 13052),
(471, '830032945', 'HOTELES CHARLESTON SAS', 'centro cra 3a No. 31-23', '6056501000', 13001),
(472, '900344389', 'HOTELES DE CONVENIENCIA S.A.S', 'CRA 22A # 85 A 33', '3188858557', 13836),
(473, '900635048', 'HOTELES DE CRESPO SAS', 'Carrera 1 No 62-198, Crespo', '6810512 -160', 13001),
(474, '900698474', 'HOTELES DE LA ANTIGUA SAS', 'Calle Sargento Mayor # 6-87', '6424100', 13001),
(475, '806000179', 'HOTELES DECAMERON COLOMBIA S.A.S. SIGLA HODECOL S.A.S.', 'Km 17 via Cienaga Sector Don Jaca', '4237200', 13001),
(476, '901403268', 'HOTELES DORADO PLAZA COLOMBIA S.A.S', 'cra 2 # 4 - 41', '3145966922', 13001),
(477, '890304099', 'HOTELES ESTELAR  S.A.', 'AVENIDA COLOMBIA 2-72', '8913213', 13001),
(478, '900477154', '\"HOTELES, PARQUEADEROS Y SERVICENTROS \"\"HOPA\"\" S.A.S.\"', 'CALLE 51 # 64 B 57 MEDELLIN', '3145814801', 13001),
(479, '830092061', 'HRC DE COLOMBIA S.A.S', 'Calle 108 No 14B-55 Piso 3', '4574753', 13001),
(480, '901158134', 'HUESPEDIA SAS', 'BOCAGRANDE CRA 3 CLLE 6', '3157397840', 13001),
(481, '900429498', 'IKAMCA ENERGY S.A.S', 'Cra 56 Km 12 # 02 100', '3112487674', 13001),
(482, '901367494', 'ILN CONSULTING S.A.S.', 'Edificio BRP Business Tower, Cl. 29c #19-3, OF1402', '3225058626', 13001),
(483, '800192507', 'IMETALES SAS', 'Bosque Transversal 55 N 22 30', '3126230687', 13001),
(484, '900439562', 'IMPALA TERMINALS COLOMBIA S.A.S.', 'Impala Terminals Barrancabermeja', '3850537', 13001),
(485, '800188083', 'IMPOTARJA SA', 'Barrio Martinez Martelo, Transv 33 a # 19-100', '6810333', 13001),
(486, '901021029', 'IN WORK SAS', 'Alto Bosque Trv 52A Dg 21D 05', '315 2670876', 13001),
(487, '800078608', 'INARCON SA', 'Calle 36 # 31-39 ofc. 228', '3127814337-3174', 13647),
(488, '900916121', 'INDUSTRIA AMBIENTAL S.A.S', 'CARRERA 74B # 65A - 55', '3126600409', 13001),
(489, '890903858', 'INDUSTRIA NACIONAL DE GASEOSAS S.A. - INDEGA S.A.', 'Calle 25 D No. 95 A - 85 Porteria 2', '3102257704', 25307),
(490, '900567060', 'INDUSTRIAS AND SERVICES FREE ZONE SAS', 'mamonal km 6', '3217997928', 13001),
(491, '890401608', 'INDUSTRIAS ASTIVIK S.A.', 'KM 3 MAMONAL', '3045763846', 13001),
(492, '860001767', 'INDUSTRIAS COLOMBIA INDUCOL S.A.S.', 'aut aeropuerto km 7 calle 30', '3106009183', 8758),
(493, '890900281', 'INDUSTRIAS HACEB S.A.', 'Avenida 30 de agosto, carrera 13 #19-18', '3116214216', 13001),
(494, '800182498', 'INDUSTRIAS KATORI S.A.S.', 'MAMONAL KM 3 SECTOR ALBORNOZ', '3176689820', 13001),
(495, '901336876', 'INDUSTRIAS METALICAS VASQUEZ S.A.S.', 'BARRIO SOCORRO PLAN 554 MZ. 91 LOTE  6 2do. PISO', '3113781317-3102', 13001),
(496, '900293608', 'INDUSTRIAS POWERCOM S.A..S', 'BRR SAN FERNANDO KRA 81B N 24 246', '3204987473', 13001),
(497, '890104719', 'INDUSTRIAS PUROPOLLO S.A.S.', 'CALLE 30 # 9-02', '3185864580', 13657),
(498, '890405995', 'ING INGENIERIA SAS', 'CALLE 114 A No. 53 - 94 CASA OFICINA BR ALHAMBRA', '3134780716', 13001),
(499, '900386516', 'INGENIERIA Y GESTIONES DE COLOMBIA SAS', 'MAMONAL KL 6 CLC BD 10', '3165289184', 13001),
(500, '900413588', 'INGENIERIA Y SOLUCIONES ESPECIALIZADAS S.A.S. (ISES S.A.S.)', 'Cra 57 # 72-25 piso 10', '3135288148', 13001),
(501, '900561761', 'INGRAM MICRO S.A.S.', 'AK 7 155 C 20 EDIFICIO NORT POINT PISO 39', '3208337240', 11001),
(502, '901173275', 'INKA FOOD CARTAGENA S.A.S.', 'Carrera 6 # 32 - 62 Centro historico', '3117870168', 13001),
(503, '900684274', 'INNOVA EXPRESS MULTISERVICIOS S.A.S.', 'CALLE 25 # 6 - 24 LA ESPERANZA', '3143512651', 13001),
(504, '900627081', 'INNOVACIÓN EN CUIDADO AMBULATORIO Y DOMICILIARIO SAS - ICAD SAS', 'Cra 45 N 84-97', '3160183485', 13001),
(505, '900466375', 'INNOVACION Y SERVICIOS   S.A.S.', 'calle 64 # 50 - 03', '3004063301', 13001),
(506, '900485142', 'INSEP SERVICIOS GENERALES S.A.S', 'BR MANGA CLL 29 NO 28 44', '3503336688', 13001),
(507, '900673015', 'INSPEGAS SAS', 'carrera 62 # 66- 74', '3043993307', 13001),
(508, '900980728', 'INSTITUCIÓN PRESTADORA DE SERVICIOS DE SALUD CUIDADO SEGURO EN CASA SA', 'BRR ARMENIA', '3107309087', 13001),
(509, '806012958', 'INSTITUCION PRESTADORA DE SERVICIOS DE SALUD DEL CARIBE S.A.', 'Santa Lucía calle 31 A 69-115', '6932177, 321584', 13001),
(510, '900574083', 'INSTITUTO DE EVALUACIÓN TECNOLÓGICA EN SALUD  - IETS', 'Cra. 45 #108a-50', '3174294197', 13052),
(511, '806015479', 'INSTITUTO SAN ISIDRO LABRADOR', 'San isidro cll 1ra 52-18', '6056376339', 13001),
(512, '900005007', 'INSTITUTO TECNICO CULTURAL DIOCESANO', 'Calle 10E # 16A - 25', '3222560774', 13430),
(513, '901555265', 'INTEGRADORES LOGISTICOS DEL CARIBE INLOGCAR S.A.S.', 'Km 12 via manzanillo complejo Karibana Cartagena Bolivar', '6056517227', 13052),
(514, '901365915', 'INTEGRAL SERVICE GROUP L&L S.A.S - INSERGROUP L&L S.A.S', 'Calle 12 B No. 8 - 39 Oficina 315', '3182319614', 19532),
(515, '900638867', 'INTEGRALES HEALTH', 'CC SAN FELIPE', '3008860487', 13430),
(516, '900036695', 'INTENSIVISTAS MATERNIDAD RAFAEL CALVO C IPS SA', 'amberes cra 39 26c-48', '3187076900', 13001),
(517, '800251569', 'INTER RAPIDISIMO S A', 'Calle 18 No. 65A - 03', '3105683473', 13001),
(518, '890903501', 'INTERANDINA DE TRANSPORTES S A INANTRA', 'AV TRONCAL OCC 1-59 ESTE CEN LOG EMP EL PORTAL BDG 39', '3202340092', 13001),
(519, '819000939', 'INTERASEO S.A.  E.S.P.', 'CARRERA 38 # 10 -36', '314592108 - 573', 13160),
(520, '811017000', 'INTERNACIONAL DE DISTRIBUCIONES DE VESTUARIO DE MODA SOCIEDAD POR ACCIONES SIMPLIFICADA', 'Cra 48 # 98A SUR 367 Km 4 Variante Caldas', '3196722610', 13001),
(521, '900019337', 'INTERNATIONAL FUELS ZF S.A S', 'calle 77b #59-61 oficina 1101 c las americas2', '3002003054', 13001),
(522, '900370573', 'INTERNATIONAL TOURISM GROUP SAS', 'DG 21 # 53-20', '3154536927', 13836),
(523, '830002655', 'INTERWORLD FREIGHT S.A.S', 'Calle 26 No. 69 - 63 Oficina 409', '3274747', 13001),
(524, '900295606', 'INTERWORLD LAND TRANSPORT S.A.S.', 'Carretera de Occidente Km 19 Bod 13 Parque Industrial San Jorge', '313 4570947', 13001),
(525, '900383385', 'INVERCOMER DEL CARIBE SAS', 'diagonal 21 n 30 238', '3205962136', 13001),
(526, '900312145', 'INVERIANA SAS', 'VILLA OLIMPICA', '3143314616', 13001),
(527, '890401198', 'INVERMAS SA', 'CENTRO CALLE DE LA UNIVERSIDAD EDIIFCIO SALOMON GANEM OFCINA 201', '6646886 - 31065', 13052),
(528, '800242482', 'INVERNAC & CIA S.A.S.', 'Calle 75 No. 5 - 59', '7560809', 13001),
(529, '900233616', 'INVERSIONES AGRORIOS S.A.', 'Carrera 54 75-45', '3001786066', 13442),
(530, '900474225', 'INVERSIONES BUENA FORTUNA SAS', 'Bocagrande cra. 2 #8-20', '3183513290', 13001),
(531, '900128836', 'INVERSIONES CALLE DEL CUARTEL SAS', 'Centro Cll del Cuartel Cra 5 #36-77-Hotel Ananda', '3052839129-3175', 13001),
(532, '900750656', 'INVERSIONES CESAR PINEDA RAMIREZ SAS', 'cra 13 c # 14-45', '3218278081', 13001),
(533, '901528537', 'INVERSIONES COLOMBO AMERICANAS S.A.S.', 'Carrera 1 No. 9 82 BR BOCAGRANDE', '3163398654', 13001),
(534, '900143784', 'INVERSIONES EL GIGANTE SAS', 'BRR CHINO CL 30 N° 24 -58', '3147567528-3106', 13001),
(535, '830033206', 'INVERSIONES EN RECREACION DEPORTE Y SALUD S.A. - BODYTECH S.A.', 'CLL 75 #22 10 Brr. San Felipe', '7442222   30077', 13001),
(536, '806015055', 'INVERSIONES FASAR LTDA', 'Bocagrande carrera 3 # 8-83', '3156530507', 13001),
(537, '900023685', 'INVERSIONES GERA S.A.S.', 'CL 31 4-13 CENTRO', '3116971228', 13001),
(538, '900335279', 'INVERSIONES GLP SAS E S P', 'Calle 110 No. 9 - 25 Oficina 508', '3212059868', 13001),
(539, '901506903', 'INVERSIONES HOTELERAS WG CARTAGENA S.A.S', 'Crespo', '3167763543', 13001),
(540, '900439301', 'INVERSIONES INT COLOMBIA SOCIEDAD POR ACCIONES SIMPLIFICADA - INVERSIONES INT COLOMBIA S.A.S.', 'Calle 86A No. 13 - 42 Piso 5', '321 2241136', 13001),
(541, '901657377', 'INVERSIONES JUAN DEL MAR S.A.S', 'CL COCHERA DEL HOBO N 38-120 BARRIO SAN DIEGO', '3204416856', 13001),
(542, '900594137', 'INVERSIONES M S.A.S.', 'bocagrande calle 6 # 3 - 24', '3046048010', 13873),
(543, '901079616', 'INVERSIONES MUNDO MUCURA SAS', 'Isla Múcura', '3503709014', 13001),
(544, '9011334374', 'INVERSIONES P&T S.A.S', 'cr 47 55 05 san jose de turbaquito', '314-6297570 - 3', 13052),
(545, '901858550', 'INVERSIONES PASMUN', 'GETSEMANI CALLE 24 #8A-334', '3209090783', 13001),
(546, '900648983', 'INVERSIONES SOL DEL NORTE S.A.S.', 'CALLE 33 No 80 A 05', '4085372', 13650),
(547, '900298207', 'INVERSIONES SOLO MODAS S.A.S', 'cl 30 #25-04 brr chino', '3173663200', 13442),
(548, '900559826', 'INVERSIONES TELEMEDIC SAS', 'URBANIZACION CONTADORA CRA.69 #31A55 CASA 8', '3102265114', 13873),
(549, '890401617', 'INVERSIONES TURISTICAS DEL CARIBE LTDA. & CIA S. C. A.', 'Bocagrande Cra. 1 No. 8-12', '3173318146 - 66', 13001),
(550, '901639035', 'INVERSIONES VIENESA SAS', 'CR 16 P # 75 B 28 SUR', '3164934126 - 32', 13001),
(551, '901233749', 'INVESTMENTS GROUP S.A.S.', 'transv 54 N 22-72 carretera la cordialidad', '3209744228-3126', 13001),
(552, '901434501', 'IPS INTEGRAL CLINICAL CARE S.A.S', 'BARRIO PIE DE LA POPA', '3107893404', 13001),
(553, '900886719', 'IPS MEDICAL MOVIL S.A.S.', 'CARRERA 14 15A 7', '3103561389', 13244),
(554, '901563708', 'IQOR COLOMBIA S.A.S.', 'CR 48 32 B SUR 139 TORRE OFICINAS P 11 OF 1102', '3006628853', 88),
(555, '901485165', 'ITALCOL ZONA FRANCA SAS', 'KM 9 VIA MAMONAL ZONA FRANCA LA CANDELARIA II', '317 4413697', 13001),
(556, '901205536', 'IVC PRODUCCIONES SAS', 'BRR NUEVO BOSQUE MZ 65 LOTE 20 ETAPA 7', '3017484309', 13001),
(557, '830122432', 'J. A. BELTRAN RECICLAJE ECOLOGICO AMBIENTAL, S. EN C. - RECOLAM S. EN C.', 'calle 15 59 40', '4204900', 13001),
(558, '830103085', 'JARDINERIA PULIDO S.A.S.', 'CRA 2 N 56 62', '3234392086', 13838),
(559, '901403644', 'JE PROYECTOS S.A.S', 'MZ E LOTE # 4 URB BELLAVISTA', '3207068983', 13001),
(560, '900480569', 'JERONIMO MARTINS COLOMBIA SAS', 'Calle 100 No. 7 - 33 Piso 10', '3233253782', 13836),
(561, '900041235', 'JIN Y CIA LTDA', 'Santa Ana 2-28 Turbaco, Bolívar.', '5,73152E+11', 13838),
(562, '70693508', 'JOHN EDGAR GOMEZ ALZATE  ARROCERA LA RIBEREÑA', 'Cra. 3 No. 17-80 barrio La Candelaria', '3052570161 - 30', 13430),
(563, '890400719', 'JONAN S.A.', 'avenida pedro heredia n 49B15', '3165272801', 13001),
(564, '900405809', 'JORGE PUENTES Y CIA S.A.S', 'Callejon ramiro vargas', '3106606468', 13657),
(565, '806006435', 'JUANAUTOS EL CERRO S.A.S', 'Pie del Cerro Calle 30 No. 18 a 104', '3003122252', 13001),
(566, '900086124', 'JURIDICA DE SEGUROS DEL CARIBE S.A.S JURIDICARIBE S.A.S.', 'Calle 32A No. 8A-50 Edificio Concasa Oficina 403', '6687520', 13001),
(567, '901586889', 'KANGURO SEGURO S.A.S', 'Carrera 14 No. 93 A -30 P 3', '3162536441', 11001),
(568, '900968793', 'KARGO SAFE S.A.S.', 'MAMONAL KILOMETRO 1 CRA 56 NO.  5-69', '6570008', 13838),
(569, '900447906', 'KINGSPAN PANELES AISLADOS S.A.S', 'CLL 1 KRA 2 ZF PARQUE CENTRAL LT 66', '317 6570685', 13001),
(570, '900488297', 'KNAUF DE COLOMBIA SAS', 'KM 12 MAMONAL ZONA FRANCA LA CANDELARIA', '3017769779', 13001),
(571, '900343567', 'KRIAMOS SAS', 'KM 4 Vía Mamonal Termocartagena, Barrio Albornoz - Cartagena, Bolívar', '3133952721', 13433),
(572, '900905610', 'KUBRICK SAS', 'Centro calle del colegio #34-25', '3012191089', 13001),
(573, '800194600', 'LA CORPORACION COLOMBIANA DE INVESTIGACION AGROPECUARIA - AGROSAVIA', 'KM 14 VIA MOSQUERA', '3183061502', 13244),
(574, '860028415', 'LA EQUIDAD SEGUROS GENERALES ORGANISMO COOPERATIVO - LA EQUIDAD SEGUROS GENERALES', 'Carrera 9 A No. 99 - 07 Torre 3 Piso 14', '3212454930', 13001),
(575, '860002400', 'LA PREVISORA S.A. COMPAÑIA DE SEGUROS - LA PREVISORA S.A.', 'Calle 57 No. 9 - 07', '3485757', 13001),
(576, '901211918', 'LA PROVINCIA AGRICOLA S.A.S', 'Troncal del caribe Km 2 vía a Gaira', '4209964', 13001),
(577, '900277236', 'LA SOCIEDAD FANTASTICA S A S', 'Manga Cra 20 #24-18', '3146648130', 13001),
(578, '900033521', 'LABORATORIO BIOCLINICO LUIS CARLOS ANDRADE CASTILLO E.U.', 'Colombia', '3183677998', 13001),
(579, '900434332', 'LABORATORIO CLINICO SANTA LUCIA IPS S.A.S.', 'cra 71 N 31-263', '6424310 ext 116', 13001),
(580, '890400284', 'LABORATORIOS GERCO S.A.S', 'MAMONAL KM 1 CALLE 10 57-14', '3133496572', 13001),
(581, '806001942', 'LABORES DE COLOMBIA LTDA.', 'BOSQUE TRANSVERSAL 44 # 21 A20', '3005386249-3005', 13001),
(582, '800141533', 'LABVANTAGE LATINOAM S.A.S.', 'barrio los alpes Tr71a 31e-54', '3174204197', 13001),
(583, '800025379', 'LADRILLERA LA CLAY S.A.S', 'mamonal carretera dolores poste 90', '3106754228', 13001),
(584, '800135342', 'LAGOBO DISTRIBUCIONES S.A.S.', 'CARRERA 8 NO. 20 53', '3183535558', 13430),
(585, '800220021', 'LAGUNA ENCANTADA S.A.S.', 'MANGA AVENIDA MIRAMAR No 23-83', '6056930987', 13052),
(586, '860522056', 'LAMITECH S.A.S.', 'Mamonal KM 13', '(601)7435767', 13001),
(587, '800166763', 'LASER  S.A.', 'CARRERA 7A # 23 - 65', '3127115706', 76001),
(588, '800218101', 'LAVAMEJOR S.A.', 'Bocagrande Cra. 1 No. 8-12', '3173318146 - 66', 13001),
(589, '806003042', 'LECTURA DE CONTADORES Y SERVICIOS COMPLEMENTARIOS ATIEMPO LTDA. LECTA LTDA', 'pie del cerro calle 30 17 220', '605 6943360', 76147),
(590, '811033374', 'LEGUMBRES HERIBERTO MONTES BEDOYA S.A.S.', 'CL 84 A 47 50 BLOQUE 10 LOCAL 16', '3116917415', 13001),
(591, '890908884', 'LEMUR 700 S.A.', 'cll 72 # 64 c 54', '3137499889', 13430),
(592, '900428195', 'LHOIST COLOMBIA SAS', 'Zona Franca La Candelaria Km 9 Lt R 141', '3152561633', 13001),
(593, '900569187', 'LINEXPERTS CONSULTORIA EMPRESARIAL SAS', 'Carrera 7 B No. 123 - 46', '3015805152', 13001),
(594, '800234860', 'LITOTRICIA S.A', 'cra 6 no 5-15', '3173755184', 13001),
(595, '900167320', 'LJPROPCENTER LTDA', 'mamonal Km.3 Cra.56 No.1-340', '3205651086', 13001),
(596, '900828654', 'LODGING S A S', 'cra 1ra', '3022234914', 13836),
(597, '900828851', 'LOGISTIC SERVICES FREE ZONE SAS', 'Carrera 100 No. 25 B - 40', '8644803   31538', 13001),
(598, '900457367', 'LOGISTIC SUPPORT SAS', 'CARRERA 99 # 25C 31 OFICINA 401', '3133470563', 13001),
(599, '830110689', 'LOGISTICA 3T S A', 'AV 6 #47-38 Puente Aranda', '3208523838', 13001),
(600, '901115861', 'LOGISTICA INTEGRAL CONSULTORIA Y SERVICIOS S.A.S', 'CR 4 F 40 07 MZ B LO 6 parque industrial', '3227689638', 13244),
(601, '901271970', 'LOGISTICA INTEGRAL SG SAS', 'CALLE 8 # 36 47', '3142967167', 25899),
(602, '805027877', 'LOGISTICA INTERNACIONAL SAS', 'CR 27 A 12 212', '3154122299', 13001),
(603, '830108355', 'LOGISTICA TOTAL S A S', 'cra 73 # 48-46', '3175482049', 13001),
(604, '900218311', 'LOGISTICA Y CARGA LTDA', 'calle 10 # 57-74 barrio campestre', '3106210213', 13001),
(605, '901112446', 'LOGISTICA Y TRASPORTE TODO FRIO S.A.S', 'KILÓMETRO 6 SECTOR PARQUEAMERICA EDS LAS AMERICAS BARRIO MAMONAL', '3023994698', 13838),
(606, '900648058', 'LONG HANG S.A.S', 'MZ F CASA 6 LC 3 edificio mirasierra', '3003613086 - 30', 13001),
(607, '900053309', 'LONGPORT AIRPORT SERVICES S A S', 'Carrera 9 No. 80 - 45 Oficina 401', '3203337034', 13001),
(608, '800215562', 'LUBRIRETENES Y RODAMIENTOS S.A.S.', 'Carrera  9 No.  123 - 86 Oficina 501', '3124453908', 13001),
(609, '804004233', 'LUBRYESP SAS', 'CRA 3 NO. 2-105 CHIMITA', '3126600409', 13836),
(610, '901406407', 'LUM LOGISTIC SAS', 'Cr 46 # 14 -140', '3245958385', 13001),
(611, '890801748', 'MABE COLOMBIA S.A.S.', 'Carrera 21 # 74-100', '3136313116', 13001),
(612, '900715189', 'MACC HOLDINGS DE COLOMBIA S.A.S.', 'CALLE 31 NO 52-76 BRR ESCALLON VILLA FRENTE A PLAZA DE TOROS', '3006880895', 13052),
(613, '900055058', 'MADISSON INN HOTEL CARTAGENA SAS', 'BOCAGRANDE CR 2 AV 7', '3205495342', 13001),
(614, '830080634', 'MAERSK LOGISTICS & SERVICES COLOMBIA LTDA.', 'Calle 127 A No. 53 A - 45 Edificio Centro Empresarial Colpatria Torre 2 Oficina 401 B', '6013000', 13001),
(615, '800159856', 'MAHE NEUTRAL SHIPPING S.A.S - MAHE', 'AV CALLE 26 #85D - 55 MODULO 1 OFICINA 220', '3212769595', 13001),
(616, '900059238', 'MAKRO SUPERMAYORISTA S.A.S.', 'Calle 192 No.19 - 12', '3114812753', 13001),
(617, '901120943', 'MALLPLAZA SERVICIOS S A S', 'Carrera 7 N 75-66, Oficina 701 - Bogota', '3173695365 - 31', 13001),
(618, '891700037', 'MAPFRE SEGUROS GENERALES DE COLOMBIA S.A. - MAPFRE SEGUROS.', 'Avenida Carrera 70 No. 99 - 72', '3107544437', 13001),
(619, '811018771', 'MARKETING PERSONAL S.A.', 'calle 10 sur n 51 c 77', '3114313577 - 31', 1),
(620, '900491889', 'MASSER S.A.S.', 'calle 94 51b 43', '3669530', 13873),
(621, '830090773', 'MASSY ENERGY COLOMBIA S.A.S.', 'Carrera 45A No. 93 - 64', '3212872219', 13001),
(622, '900675714', 'MATAGUA S.A.S.', 'KM 2 VIA LA CORDIALIDAD EDS MATORRAL', '3012074025', 13001),
(623, '901118236', 'MC DEVINS SAS', 'CR 51 # 9 C SUR 85', '3177660679', 13433),
(624, '860001584', 'MECANELECTRO S.A.S.', 'Calle 127D No. 45 - 46', '3176595669', 11001),
(625, '891102723', 'MECANICOS ASOCIADOS S.A.S.', 'Carrera 7 No. 156 - 10 piso 25', '3015762992', 13160),
(626, '900721565', 'MEDICAL FOODS SAS', 'Cra 26 n 28-45 Manga, edificio torre del puerto ofi 1301', '3246826570', 13001),
(627, '900682543', 'MEDICALL TALENTO HUMANO  S.A.S. - MEDICALL TH S.A.S.', 'Calle 4 G No. 66 A - 08', '3015774656', 13001),
(628, '900219866', 'MEDICARTE S.A.S.', 'Carrera 43 A # 34-95', '4484250 - 32130', 13873),
(629, '830066626', 'MEDIHELP SERVICES COLOMBIA', 'Bocagrande Cra 6#5-101', '3186815629', 13001),
(630, '900178724', 'MEDPLUS MEDICINA PREPAGADA  S.A. - MEDPLUS', 'Carrera 14 No. 93 B - 15', '7477222', 13001),
(631, '900648909', 'MEGADYNE COLOMBIA SAS', 'BOSQUE DIAGONAL 22 56-112 CARTAGENA', '3102084944', 13001),
(632, '1140831173', 'MELENDEZ OBREDOR EUGENIO ROBERTO', 'CC LA SERREZUELA, PISO BAJO, BS10 FRENTE A ZONA BANCARIA', '3164960821', 13001),
(633, '900062619', 'MERCY CORPS', 'Carrera 13 No. 90 - 17 Piso 3', '3136144038', 13001),
(634, '860007277', 'MEXICHEM RESINAS COLOMBIA S.A.S.', 'MAMONAL KM 8', '3208796242', 13001),
(635, '900042784', 'MEXICHEM SERVICIOS COLOMBIA S A S', 'AUT SUR NO. 71 75', '3208796242 - 78', 13001),
(636, '901149930', 'MINEROS DEL CARIBONA GOLD SAS', 'Cr 11 No. 10-27 P2', '3153296817', 13688),
(637, '800211365', 'MINERVA MEDICAL S A S', 'Carrera 72 No. 127 C - 91', '3214698879', 13001),
(638, '860528235', 'MINIBARES S.A.S.', 'Carrera 12 No. 79 - 43 Oficina 506', '3174423856', 13838),
(639, '901646534', 'MODA ELITE BAZURTO SAS', 'PIE DE LA POPA CALLE 32', '3152965980', 13001),
(640, '890403284', 'MONTACAR LOGISTIC SOCIEDAD POR ACCIONES  SIMPLIFICADA', 'Barrio bosque', '3108692050', 13001),
(641, '900501238', 'MOTOREPUESTOS MI VAQUITA SAS', 'BARRIO SAN FERNANDO', '3178757204', 13001),
(642, '900038521', 'MSL DE COLOMBIA LTDA', 'Carrera71 a  51 30', '7481010', 13001),
(643, '806001692', 'MULTICENTRO LA PLAZUELA', 'dig 31 no 71 130', '3006244771', 13001),
(644, '830506584', 'MULTIPORT EU', 'Carrera 1 # 22 - 58 Oficina 602 Edificio Bahía Centro', '3160187516', 13001),
(645, '806003158', 'MULTISERVICIOS LA GRAN VÍA SA.', 'Variante Mamonal Gambote KM 1', '3135288398', 13673),
(646, '830124718', 'MULTISERVICIOS TECNICOS Y JURIDICOS, MULTISERTEC LIMITADA', 'Carrera 8 No. 38 - 33 Oficina 1004', '3006575466', 13001),
(647, '901316353', 'MUSEO DEL CHOCOLATE COLOMBIA SAS', 'cra 9 11 55', '3158062962', 13001),
(648, '900590106', 'MUSTIQUE SAS', 'Calle cochera del  gobernador Cra5 33-15, Piso 4', '6517181', 13001),
(649, '806012429', 'NAUTIAGRO S.A.', 'cra 4 30 24', '3007527062', 13001),
(650, '900193371', 'NAUTICA INTEGRAL S.A.S.', 'Km 3 vía Mamonal Cra. 56 n.º 1 - 340', '3215647901', 13001),
(651, '829000980', 'NAVIERA RIO GRANDE S.A.S', 'Carrera 55 No 100-51 Oficina 913', '3123512095', 13001),
(652, '900925006', 'NEGOCIOS E INVERSIONES MONTESUR  S.A.S', 'cra. 25 25 269', '2714922', 13001),
(653, '900407235', 'NEO DOMUS, SUCURSAL COLOMBIA', 'Serena del Mar Km 8 vía al mar Zona Norte', '3104132627', 13001),
(654, '900169608', 'NEORIS COLOMBIA S.A.S.', 'Calle 110 No. 9 - 25 Oficina 708', '3245979251', 13001),
(655, '806016411', 'NERY GHISAYS & COMPAÑIA S.A.S.', 'Bosque tvs 54 A Nº 21-90', '3102076178 - 30', 70713),
(656, '808001297', 'NEWREST CATERING COLOMBIA S.A.S', 'Calle 58 B No. 17 - 35', '3102539792', 13001),
(657, '900062596', 'NEXOS CARGO S.A.S.', 'Calle 23 No. 116 - 31 oficina 210', '3182648979', 13001),
(658, '73130818', 'NORDMANN OCHOA CARLOS ALBERTO', 'Barrio el Recreo Mz 19 calle 31 G casa 222b', '6388342', 13001),
(659, '45426273', 'NOTARIA SEGUNDA DE CARTAGENA', 'BRR CENTRO CLL VELEZ DANIES 4 21', '6646405', 13654),
(660, '900226838', 'NOUVELLE COLOMBIA E.U', 'VIA MAMONAL KILOMETRO 11', '6930062', 13001),
(661, '900749094', 'NOVASUIN S.A.S', 'MAMONAL KM6 PARQUIAMERICA', '3014052453', 13052),
(662, '901401005', 'NR-V FACADE SAS', 'CLL 1 N° 2-05 ZONA FRANCA PARQUE CENTRAL BG 76A', '3108146591', 13001),
(663, '900156264', 'NUEVA EMPRESA PROMOTORA DE SALUD S.A. - NUEVA EPS S.A.', 'Carrera 85K No. 46 A - 66, piso 2', '3185356704', 13001),
(664, '806005346', 'O.T.M OPERACIONES TECNICAS MARINAS', 'Bajos de San Isidro Dg 23 N 22-160 Calle el Pirata', '6424470', 13001),
(665, '901288398', 'OCA GLOBAL COLOMBIA S.A.S.', 'Carrera 11 No 82 - 76 Oficina 701', '3108589524', 13683),
(666, '890931654', 'OCEANOS S.A.', 'mamonal km1 - 504', '3135992764', 13001),
(667, '823002800', 'OFTALMOLOGOS ASOCIADOS DE LA COSTA SAS', 'KR  25B  No. 25 - 152  Avenida Okala', '2771018', 13430),
(668, '890102110', 'OLEOFLORES S.A.S.', 'KM 5 VÍA CODAZZI', '3185159218', 13442),
(669, '900229170', 'OPERACION LOGISTICA JDF S.A.S.', 'BELLAVISTA CLL 7B N° 57A 71', '6475640', 13001),
(670, '900828558', 'OPERACIONES PORTUARIAS CARTAGENA S.A.S', 'Brr. Albornoz Cll. 5A No. 48-18', '3002347431', 13001),
(671, '900668722', 'OPERACIONES TECNOLOGICAS Y COMERCIALES SOCIEDAD POR ACCIONES SIMPLIFICADA SIGLA OPTECOM S.A.S.', 'Calle 74 No 57 - 35 PI 2', '3770050  - +57 ', 68001),
(672, '901685080', 'OPERADORA CLUB CK S.A.S', 'KM 12 anillo vial entre manzanillo del mar y punta canoa', '3108487293', 13001),
(673, '900843241', 'OPERADORA SAN AGUSTIN S.A.S', 'centro calle de la universidad', '6810000', 13001),
(674, '900068426', 'OPERADORES LOGISTICOS DE CARGA S.A.S. OPL CARGA S.A.S.', 'AUTOPISTA FLORIDABLANCA TORRE 2 OFICINA 803 ANILLO VIAL KILOMETRO 2176 CENTRO NATURA', '3223996174 - 31', 13001),
(675, '860076646', 'OPT S.A   EN REORGANIZACION EMPRESARIAL', 'MAMONAL KM 7', '3116609411', 13001),
(676, '891100445', 'ORF S.A - O R F', 'CARRERA 10 # 97 A13 PISO 4 TORRE B BOGOTA', '6449420', 13001),
(677, '890102768', 'ORGANIZACION CLINICA GENERAL DEL NORTE S.A.S', 'Carrera 48 No 70 - 38', '3091999-11093', 13001),
(678, '830095213', 'ORGANIZACION TERPEL S A', 'CARRERA 7 # 75-51', '3183238397', 13647),
(679, '901645415', 'OSHPITALITY GROUP S.A.S.', 'Cl. 31 #10 - 77, Getsemaní', '3187701988', 13001),
(680, '900839078', 'O-TEK CENTRAL SAS', 'VT ZONA FRANCA PARQUE CENTRAL L T 27 0,', '6940183', 13683),
(681, '830005448', 'OTIS ELEVATOR COMPANY COLOMBIA S.A.S', 'Calle 140 No. 12 B - 25 Piso 5', '3125071944', 13001),
(682, '900748621', 'OXO HOTEL CARTAGENA SAS', 'BOCAGRANDE AV SAN MARTIN CLL 9', '3245438956', 13001),
(683, '900074102', 'PACARIBE S.A. E.S.P.', 'ALPES TRANSVERSAL 73 N 31 I 140', '6455480', 13001),
(684, '900315764', 'PALMAS DE MAHATES S.A.S.', 'calle 76 54 11 of 407', '3091428', 13052),
(685, '900119188', 'PALMAS DEL RIO SANTODOMINGO S.A. - PALMARISA S.A', 'CRA 105 N° 16H 19', '3164833579', 13670),
(686, '860009787', 'PALMAS OLEAGINOSAS BUCARELIA S.A.S.', 'CALLE 20 # 29 - 71 BARRIO SAN ALONSO', '3143593567', 13160),
(687, '900064216', 'PALMERAS DE PUERTO LIBRE S.A.', 'Carrera 59 No 64 - 185', '3145953286', 13042),
(688, '900825389', 'PANIFICADORA MIPAN COLOMBIA S.A.S.', 'CC E INDUSTRIAL TERNERA 2 KM 1 VIA TURBACO', '3023510311', 13001),
(689, '860039726', 'PARAMEDICOS S A', 'Calle 99 No. 49- 38 Oficina 503', '3102439380   31', 13001),
(690, '900110597', 'PASABOCAS PATTY S.A.S', 'CALLE 19 CARRERA 28A ESQUINA SAN ROQUE ZONA VERDE', '3117534005', 13001),
(691, '890920304', 'PEPSICO ALIMENTOS COLOMBIA LTDA - PEPCOL LTDA.', 'Calle 110 No. 9 - 25 Piso 4', '5895111', 13001),
(692, '3985324', 'PEREZ PEREZ WALTER DAVID AUTO SERVICIO SU EXITO', 'CRA 10 Nº 10-11 ESQUINA BARRIO COMUNEROS', '3102670959', 13001),
(693, '900592737', 'PERFILES Y SOLUCIONES LOGISTICAS S.A.S.', 'Carrera 51B No. 94', '3042123612', 13001),
(694, '901449464', 'PERSEPOLIS GASTRO BAR S.A.S.', 'GETSEMANI CALLE DEL CARRETERO CALLE 29 No.10B08', '3157754516', 13001),
(695, '901226014', 'PESCADERIA PERLAMAR DEL CARIBE SAS', 'crespo cll 70 n° 6-142 loc 1', '3174048078', 13001),
(696, '819001667', 'PETROLEOS DEL MILENIO S.A.S. SIGLA PETROMIL S.A.S.', 'Carrera 53 No 82 - 86', '3008248510', 13442),
(697, '890905980', 'PIA SOCIEDAD SALESIANA INSPECTORIA SAN LUIS BELTRÁN', 'CARRERA 87A NUMERO 32A 101', '3103745677', 13836),
(698, '900511135', 'PISOS & ENCHAPES RYL SAS', 'CL 62 17F 08 BR LA CEIBA', '3214022536-3229', 13001),
(699, '900423087', 'PITICOL SAS', 'VIA MAMONAL KILOMETRO 11', '6930062', 13001),
(700, '890907406', 'PLASTICOS TRUHER S.A.', 'Calle 67 sur # 48 b 95', '3176383485', 13001),
(701, '901255019', 'PLAYA CABRERO SAS', 'el cabrero', '3223989900', 13836),
(702, '900363618', 'PLAYAS DEL CARIBE SAS', 'bocagrande av. san martin #4-87', '3005398328', 13001),
(703, '901249695', 'PLAZA LA SERREZUELA SAS', 'CR 11 #39-21', '3146359939', 13001),
(704, '860515802', 'PLEXA SAS ESP', 'Calle 113 No. 7 - 21 Torre A oficina 903', '6202926', 13001),
(705, '800197463', 'POLLOS EL BUCANERO S.A', 'Calle 35 norte N°6A Bis 100', '3113010951', 13052),
(706, '800048191', 'POLYBAN INTERNACIONAL S.A.S', 'MAMONAL KM 13 ZOFRANCA INDUSTRIAL ISLA 1 BODEGA 10', '3167408849', 13001),
(707, '800229172', 'POLYBOL S.A. S', 'MAMONAL KM 5 SECTOR PUERTA DE HIERRO', '3176491778-3104', 13001),
(708, '900943374', 'POLYMER CONTRACTORS CARTAGENA SAS', 'Planta Mexichem, Mamonal km8', '3233666649', 13001),
(709, '860011153', 'POSITIVA COMPAÑIA DE SEGUROS SA', 'Carrera 45 No. 94 - 72', '3118937525', 13001),
(710, '890903939', 'POSTOBON S.A.', 'carrera 20a no 24-65', '3124567479', 13001),
(711, '901418933', 'POWER ENERGY SERVICES S.A.S', 'santa rosa lima km 1', '3106218303', 13001),
(712, '811042792', 'PRODUCTOS RIKATAS S.A.S', 'CRA 40# 49-45', '3184145557', 13001),
(713, '890315540', 'PRODUCTOS YUPI  S.A.S.', 'cr50 a # 43-13', '3113318867', 13442),
(714, '890401484', 'PROFESIONALES MARITIMOS LIMITADA PROMAR', 'centro plazoleta telecom edificio comodoro oficina 1206', '6600655', 23672),
(715, '900764970', 'PROMOTORA ALTAMAR SAS', 'EL BOSQUE TRANSVERSAL 54 N. 21 B - 57', '3103741341', 13001),
(716, '806016284', 'PROMOTORA AMIN BAJAIRE & CIA S.C.A.', 'El Pozon', '3185568239', 70429),
(717, '900279660', 'PROMOTORA BOCAGRANDE S.A. PROBOCA S.A.', 'Castillogrande Cl. 5 #6-49', '3205438311', 13001),
(718, '800149537', 'PROMOTORA DE ENERGÍA ELÉCTRICA DE CARTAGENA S.A.S E.S.P. - PROELÉCTRICA S.A.S E.S.P.', 'Calle 100 No. 13 - 21 Piso 12', '3233996578', 13052),
(719, '802013061', 'PROMOTORA HACIENDA LAS FLORES S.A.', 'cra 58 N 64 - 82', '3127371117', 13442),
(720, '900501126', 'PROMOTORA HOTELERA SANTOS DE PIEDRA SAS', 'gestemani Calle del Guerrero No 29-69', '3245050625', 13001),
(721, '890404389', 'PROMOTORA TURISTICA DEL CARIBE S.A - PROTUCARIBE S.A', 'Anillo Vial Sector Cielo Mar', '3043323322', 13001),
(722, '830051455', 'PROTEKTO SAS - PROTEKTO SAS', 'Calle 73 No. 7 - 06 Piso 12', '3107569661-3133', 13001),
(723, '860001963', 'PROTELA S.A.', 'trasversal 93 # 65a 82', '3153332177', 13042),
(724, '901191158', 'PROVENSAS S.A.S.', 'Diagonal 21 BIS 53 119 BARRIO BOSQUE', '3136494634', 13001),
(725, '901262996', 'PROVISION L&M S.A.S', 'VIA TURBACO KM1 CIAT #2 OFICINA #1', '3187164612', 13001),
(726, '800096464', 'PUERTO DE MAMONAL S.A.', 'MAMONAL KM 7', '3116609411', 13836),
(727, '802020334', 'QUIMIOSALUD S.A.S.', 'Carrera 49C N 84 160', '3184246366', 8758),
(728, '860009323', 'QUINTERO HERMANOS S.A.S', 'Carrera 29 No. 39 A - 22', '6540674', 13001),
(729, '900413219', 'RADAR S.A.S.', 'Cr 50 g 10 B sur 59', '3166884172', 13001),
(730, '890400372', 'RAFAEL DEL CASTILLO Y CIA S.A.', 'Bosque Avenida Pedro Velez # 20 65', '3106822826', 13836),
(731, '800202447', 'RAFAEL ESPINOSA G. & CIA. SAS', 'Aeropuerto Rafael Nuñez Piso 2', '3014783731', 13001),
(732, '804010418', 'RANSA CARGO SAS', 'cra 116 # 22 h 31', '3176418568', 13001),
(733, '900843898', 'RAPPI S.A.S.', 'Giraldo', '3122567696', 68655),
(734, '901746786', 'READY TO ANSWER SAS', 'DG 31 A 71 57 PROVIDENCIA SECTOR BIFFI', '3008121756', 13001),
(735, '901051587', 'RECICLAJE CARTAGENA DE INDIAS S.A.S.', 'CEBALLOS D 30 N 56 A 66', '3002383653', 13001),
(736, '806011019', 'RECUPERACIONES NARANJO RECYCLING SAS', 'MAMONAL KM 1 CL 10 56B 128', '6676086', 13001),
(737, '901155508', 'REDCOL HOLDING S.A.S.', 'Centro Empresarial Natura Torre2 Oficina 804', '3045207589', 13001),
(738, '806002770', 'REDECAR LTDA', 'Bellavista cra 56A #5A-25', '3008152514-3008', 13001),
(739, '800104013', 'REFRICONFORT S.A.S.', 'PIE DE LA POPA CRA. 20 # 30-102', '3182542490', 13052),
(740, '901075358', 'REPOSTERIA ELY SAS', 'bocagrande calle 7 #3-50', '3162719625', 13001),
(741, '901040402', 'RESITER S A S', 'Km 3.5 Parque Industrial Galicia', '3164648029', 23672),
(742, '890404848', 'RESTAURANTE BAR FUERTE DE SAN SEBASTIAN DEL PASTELILLO S.A', 'Manga ave Miramar Fuerte del Pastelillo', '3145972376', 13001),
(743, '901630365', 'RESTAURANTE CAN CHOW S.A.S.', 'Carrera 56 #6-33 Via MAMONAL Barrio BELLAVISTA', '3126392069', 13001),
(744, '900980439', 'RESTAURANTE EL BURLADOR DE SEVILLA SAS', 'Carrera 3 # 33-88, Calle Santo Domingo, Provincia de Cartagena, Bolívar', '6600866', 13001),
(745, '900142908', 'RIMORCHIATORI RIUNITI COLOMBIA S.A.S', 'Calle 11 1C 23 Centro Edificio Posihueica, Oficina 610', '3174325755, 315', 13001),
(746, '900165889', 'RIO PRETO LTDA.', 'CARTAGENA BAZURTO CENTRO COMERCIAL COLMENAR LOCAL 4D', '3243450071', 13001),
(747, '830027231', 'ROCSA COLOMBIA S A', 'AUT MED KM 5.7 COSTADO SUR', '3212824369', 13052),
(748, '806013381', 'RODIL BOUTROUS S.A.S.', 'Bocagrande Centro Comercial NAO', '3225235810', 13001),
(749, '79393999', 'RODRIGUEZ CUBIDES WILLIAM', 'centro comercial los ejecutivos local 38', '3103992121', 13001),
(750, '901274491', 'ROOMS FOUR YOU S.A.S', 'CENTRO CALLE DEL COLEGIO', '3012191089', 13001),
(751, '901511157', 'RTA DESIGN ZONA FRANCA S.A.S.', 'VTE TURBACO SEC AGUAS PRIETAS CR 1 2 05 BG 73', '3146621955', 13001),
(752, '805011262', 'RTS S.A.S.', 'Calle 45N # 4N - 32', '3174023611', 13001),
(753, '800248617', 'RUQUIM S.A.S', 'BGA 8 Lo. 01 GRANABASTOS', '3225064', 13836),
(754, '800203642', 'SAAM TOWAGE COLOMBIA S.A.S', 'Manga Av miramar', '3208336018', 13001),
(755, '901275415', 'SAFEDATA SERVICIOS Y SOLUCIONES INTEGRADAS PARA NEGOCIOS INTERNACIONALES', 'BRR LOS ALPES TV 71 B 31 L 26', '6613783', 13001),
(756, '901206622', 'SAI TUGS S.A.S', 'av newball mz 3 casa 11', '5130828', 13001),
(757, '802021430', 'SALUD FAMILIAR S.A. IPS', 'CALLE 66 No. 50 84', '5,73136E+11', 13001),
(758, '800130907', 'SALUD TOTAL ENTIDAD PROMOTORA DE SALUD DEL REGIMEN CONTRIBUTIVO Y DEL REGIMEN SUBSIDIADO  S.A.', 'CLL 4 G NO 66 A 08', '7425770', 13052),
(759, '900674295', 'SALUD Y BIENESTAR DEL CARIBE I.P.S. SAS', 'Recreo mz 2 lt 27', '3022024975', 13836),
(760, '37725855', 'SANDRA LIZETH FERNANDEZ MORENO', 'calle 12 No 11-06 esquina', '3214793047-3164', 13688),
(761, '900167617', 'SANEAMIENTO AMBIENTAL Y SANITARIO S A S - SAMSA S A S', 'Carrera 129 No. 22 F - 70', '3123644594', 13001),
(762, '901188381', 'SANTA CATALINA DE INDIAS SAS', 'calle del candilejo', '3202600429', 13001),
(763, '900167656', 'SANTA ELENA EL DORADO S.A.', 'Carrera 43A 8-36', '3008848040', 13001),
(764, '900415769', 'SAVIA SERVICIOS S.A.S E.S.P', 'carrera 79 45 d 137', '3052123133', 23466),
(765, '860014873', 'SAYBOLT DE COLOMBIA  S.A.S', 'Carrera 19 B No 166 - 40', '3132093890 - 67', 13001),
(766, '800210526', 'SCHRYVER DE COLOMBIA  S.A.S', 'Carrera 85 D # 46 A - 65 L-27', '3148890025,3103', 13001),
(767, '900939907', 'SCIENCE AND MEDICAL SOLUTIONS INC SAS', 'AVENIDA PEDRO DE HEREDIA CALLE 30', '3232921446', 13001),
(768, '860034594', 'SCOTIABANK COLPATRIA S.A - BANCO COLPATRIA, SCOTIABANK', 'Carrera 7 No. 24 - 89 Piso 32', '7456300 ext 444', 13001),
(769, '901168843', 'SEA SHORE LOGISTIC S.A.S.', 'CL 29 21A 07 Edificio manuela', '302 6903324', 13001),
(770, '800250763', 'SEABOARD DE COLOMBIA S.A.S.', 'Carrera 11 - 77 A 49 Oficina 702', '3123860073', 13001),
(771, '890914711', 'SEALCO S.A.', 'AV 37B # 38A - 12', '4243000', 13001),
(772, '800072556', 'SEATECH INTERNACIONAL  INC.', 'Mamonal KM 8', '6778900', 13001),
(773, '804011536', 'SEGURIDAD ACROPOLIS LTDA', 'Cra 29 #19-04', '3102117741', 13650),
(774, '860074752', 'SEGURIDAD ATEMPI LIMITADA', 'CALLE 20A N 44 80', '3107668802', 13001),
(775, '890312749', 'SEGURIDAD ATLAS LTDA', 'Cra 2 # 31-41', '3167670923', 13001),
(776, '860066946', 'SEGURIDAD SUPERIOR LTDA.', 'Carrera 50 #96-35', '3124074708', 13001),
(777, '890903407', 'SEGUROS GENERALES SURAMERICANA S.A.', 'Edificio Sura', '2602100 ext 709', 13836),
(778, '901219048', 'SEINM S.A.S.', 'Diagonal 31 F No. 70-20 Local 1-01 Barrio Santa Lucia', '3015816601', 13001),
(779, '800175608', 'SER RED  S.A', 'calle 15 # 15-15', '3008162517', 44430),
(780, '900269583', 'SERLOGISTICA OTM S.A.S.', 'CRA 52 A # 10-65', '3228935154', 13001),
(781, '800198796', 'SERPOMAR SAS', 'Mamonal Km 6 Parquiamerica B-4', '3006324441-3163', 13001),
(782, '901292561', 'SERVICE BAR S.A.S.', 'Carrera 68 B No. 96 - 70 Interior 1 903', '3188217097', 13001),
(783, '890406430', 'SERVICIO DE MANTENIMIENTO Y MONTAJES  SERVIMANT DEL CARIBE S.A.S. (SERVIMANT  S.A.S.)', 'BALLAVISTA CARRERA 57A # 7A-32', '3176644688-3013', 13001),
(784, '899999034', 'SERVICIO NACIONAL DE APRENDIZAJE, SENA', 'Carrera 9 71N-60', '3107056945', 13001),
(785, '900217784', 'SERVICIOS DE DISTRIBUCION ALMACENAMIENTO Y LOGISTICA S.A.', 'km 2 via Briceno- Zipaquira parque tibitoc', '3164820228', 13430),
(786, '901526779', 'SERVICIOS DE SOPORTE HIGHER EDUCATION COLOMBIA SAS - SSHE COLOMBIA SAS', 'Carrera 13 No. 83 - 19 PISO 5 OFICINA E 91', '3145661922', 615),
(787, '800148290', 'SERVICIOS ESPECIALES PARA EMPRESAS S.A.S. (SESPEM S.A.S.)', 'barrio pie de la popa cll 29c n°19-43', '3226532996', 13657),
(788, '900392968', 'SERVICIOS INDUSTRIALES Y MARITIMOS S.A.S', '1 MAMONAL, BLOC PORT OFICINA 43 P2', '3046192108', 13001),
(789, '806000735', '\"SERVICIOS INDUSTRIALES Y PORTUARIOS S.A.S \"\"SIPOR\"\"    S.A.S\"', 'mamonal k6 parqueamerica oficina 315', '3205650392', 13052),
(790, '900394396', 'SERVICIOS INTEGRALES MARITIMOS SAS - SIMARITIMA SAS', 'AV CL 26 # 69-63 TORRE 26 OFICINA 207', '3114491041', 13001),
(791, '901362940', 'SERVICIOS LOGÍSTICOS CARTAGENA SAS', 'CR 26 28 45 ED TORRE DEL PUERTO OF 1501 BRR MANGA', '3228634518', 13001),
(792, '900348440', 'SERVICIOS LOGISTICOS INTEGRALES DE COLOMBIA S.A.S', 'Ceballos Diagonal 30 #51-348', '3103585978', 13001),
(793, '901158596', 'SERVICIOS MEDICOS Y TERAPEUTICOS IPS S.A.S', 'MANGA 4TA AVENIDA N 23-64', '3142030043', 13001),
(794, '819000976', 'SERVICIOS PORTUARIOS S.A.S. SERPORT  S.A.S.', 'Bosque Diagonal 21 E Calle Cauca No. 54 A - 86', '6176434105', 13001),
(795, '900455156', 'SERVICIOS Y SUMINISTROS CJVN SAS', 'KRA 21 A N 21 06 JARDIN SANTA MARATA', '301 3612555-430', 13836),
(796, '860512330', 'SERVIENTREGA S.A.', 'Avenida Calle 6 No. 34 A - 11', '3164539821', 13001),
(797, '901418135', 'SERVIHOTELES COLOMBIA S.A.S.', 'BOCAGRANDE Cra. 1 #2–87,', '3104423886', 13001),
(798, '900706773', 'SERVILOGISTICS ADVANCED SAS', 'ZONA FRANCA PARQUE CENTRAL LOTE 44 - 45', '3012857709', 13836),
(799, '800230546', 'SERVINCLUIDOS  LTDA', 'Av Colombia #1-19', '3013455321', 13001),
(800, '892301629', 'SERVIPAN  S.A.', 'Kilómetro 5 Cordialidad Vía Galapa Centro      Industrial los volcanes  bodega  46', '5717122 - 31072', 13001),
(801, '890116102', 'SERVIPARAMO S.A.S.', 'VIA 40 75-95', '3134358750', 13001),
(802, '800172330', 'SERVIPORTUARIOS S.A.S', 'Bosque Sector San Isidro Transv 54 #28-25 Edificio Movisol oficina 101', '3188370801', 13001),
(803, '901258714', 'SERVIREPARAR SAS', 'AV 6 F 498C-098', '3046481730', 13430),
(804, '890406972', 'SES SAS', 'bella vista Mz K lote 9', '3126600552', 13838),
(805, '806000913', 'SESCARIBE SAS', 'Centro Logstico Bloc Port, Km 1 Va Mamonal, piso 2 of. 27', '6932416 - 31055', 13001),
(806, '860049921', 'SGS COLOMBIA S.A.S - SGS', 'Carrera 100 No. 25 C - 11 Bogotá', '318 6497822', 13212),
(807, '800053508', 'SIA SUDECO DE COLOMBIA S.A.', 'martinez martelo trav 34 #19-85', '6926146', 13838),
(808, '830048145', 'SIIGO S.A.S.', 'NA', 'NA', 13001),
(809, '901436284', 'SKY FRIEND SAS', 'Calle 98 No. 9 A  - 41 Edificio AB Proyectos Oficina 701', '3193167120', 13001),
(810, '830078450', 'SMARTINFO SAS', 'BOCAGRANDE CRA 3 #8-96', '3174344783 - 31', 13001),
(811, '900799138', 'SMS ELECTRONIC SAS', 'bocagrande Kra 3a #8-125', '3178074305', 13836),
(812, '811022981', 'SOBERANA S.A.S.', 'cra 57 # 74 - 80', '3228894659', 13001),
(813, '800144331', 'SOCIEDAD ADMINISTRADORA DE FONDOS DE PENSIONES Y CESANTIAS PORVENIR S A', 'Carrera 13 A No. 26 A  - 65', '7434441 . 75513', 13001),
(814, '900500024', 'SOCIEDAD AGROGANADERA SAS', 'BOCAGRANDE CR3 #6-100 TORREM EMPRESARIAL PROTECCION OFICINA 1201', '6551771', 13442),
(815, '890405769', 'SERVIPORT S.A', 'bocagrande Av San Martin N8-146', '3157312393', 13001),
(816, '806006237', 'SOCIEDAD DE CANCEROLOGIA DE LA COSTA SAS', 'Cra 82 No 31-320 Calle el eden', '3218953158-6911', 13001),
(817, '900126421', 'SOCIEDAD JOYERIA CARIBE S A', 'Bocagrande Calle 5 # 2-51', '6654625', 13001),
(818, '805023423', 'SOCIEDAD N.S.D.R. S.A.S.', 'colseguro calle 10 #33-51', '3218444989', 8758),
(819, '900298305', 'SOCIEDAD OPERADORA DE TRANSPORTE MASIVO DE CARTAGENA SOTRAMAC SAS', 'Analista.nomina@sotramac.com.co', 'Analista.nomina', 13001),
(820, '860009873', 'SOCIEDAD PORTUARIA PUERTO BAHIA S.A.', 'Bar Calle 7 Cra 5-608 Sector La Pulga. Cartagena, Colombia', '3206130735', 13894),
(821, '800200969', 'SOCIEDAD PORTUARIA REGIONAL DE CARTAGENA S.A.', 'Manga, Terminal Marítimo', '6607781', 13248),
(822, '806016841', 'SOCIEDAD PORTUARIA TRANSMARSYP S.A', 'albornoz cr. 49 N 2-112', '3045236690', 13001),
(823, '900304958', 'SOCIEDAD SAN JOSE DE TORICES S.A.S', 'TORICES CRA 14 N  43-66', '6930531', 13001),
(824, '800230447', 'SODEXO S.A.S.', 'Edificio Torre Sigma Bogota piso 26', '3155438756', 13001),
(825, '800242106', 'SODIMAC COLOMBIA S A', 'Cra 68 d No. 80-70', '3228167529', 13836),
(826, '900241655', 'SOLÉ SOLUCIONES EMPRESARIALES S.A.S', 'Dosquebradas, Risaralda, La Macarena. Carrera 9A bis N 15-49 bodega 10 A(2)', '3232865071', 13001),
(827, '830512495', 'SOLMEX COLOMBIA S.A.S.', 'ALCIBIA SECTOR CAMINO DEL MEDIO', '3183481929', 13001),
(828, '824006522', 'SOLUCIONES AMBIENTALES DEL CARIBE S.A  E.S.P', 'Tv 51 diagonal  19 -158', '3138130568', 13052),
(829, '901083077', 'SOLUCIONES GENERALES DEL CARIBE S.A.S', 'Marina Portobello, barrio bosque', '3007524411', 13001),
(830, '901458968', 'SOLUCIONES PLÁSTICAS CARIBE SAS', 'KM 6 VIA MAMONAL PARQUIAMERICA MZ F LOTE 01', '6933008', 13001),
(831, '901241784', 'SOLUCIONES TECNOLOGICAS EN RECUBRIMIENTOS S.A.S.', 'Carrera 43 #44-60', '3046698433', 13001),
(832, '901297639', 'SOLUCIONES TERCERIZADAS S.A.S.', 'Carrera 49C 85-17 p3', '3187155955', 13052),
(833, '806016797', 'SOMEDYT  I.P.S. SAS SERVICIOS MEDICOS DE DIAGNOSTICO Y  TERAPIA I.P.S. S.A.S.', 'libano  calle 49c -55', '6421240', 13001),
(834, '901813365', 'SOMOS MELT SAS', 'CARRERA 2 NORTE # 7 NORTE - 148 CENTRO COMERCIAL BOCAGRANDE BOCAGRANDE', '3249515770', 13001),
(835, '901039094', 'SONDA SERVICIOS S A S', 'autopista norte 118-68', '3143192103', 11001),
(836, '890302609', 'SONOCO DE COLOMBIA LTDA.', 'Cra 7A # 34A 25', '4853630', 13001),
(837, '901047435', 'SPU COMPANY SAS', 'Calle 152a No 14a-36 Apto 903', '3173701598', 13001),
(838, '900399868', 'STIL CARTAGENA S.A.S.', 'centro', '6056687531', 13001),
(839, '806005943', 'SUCCION & CARGA S.A.S', 'CR 56 04 30 ARROZ BARATO', '3104417690', 13001),
(840, '890800718', 'SUCESORES  DE JOSE JESUS RESTREPO & CIA S.A. (CASA LUKER S.A.)', 'cl 30 # 1-165', '3136635502', 13001),
(841, '890800788', 'SUMATEC S.A.S BIC', 'CRA 23 NO 64B 33', '3136701615', 13001),
(842, '806009848', 'SUMINISTRADORA DE MEDICAMENTOS DEL CARIBE S.A.', 'Pie de la popa cra 21 # 29B - 70', '3187416001', 13001),
(843, '900325227', 'SUNDANCER SAS', 'Anillo Vial', '6931000', 13001),
(844, '900842071', 'SUPERMASTICK S.A.S.', 'Calle 17 No. 132 - 18 Bodega 3', '3183627261', 13001),
(845, '890107487', 'SUPERTIENDAS Y DROGUERIAS OLIMPICA S.A.- OLIMPICA S.A.', 'Calle 53 No 46 - 192 Local 3-01', '6053710384', 13244),
(846, '890903295', 'SUPPLA  S.A. - SUPPLA', 'Av cra 60 # 22 – 50', '322 8545963', 13001),
(847, '900943243', 'SURAMERICA COMERCIAL S.A.S.', 'Cra 43a #38sur-37', '3235764125', 13001),
(848, '890400869', 'SURTIDORA DE GAS DEL CARIBE S.A.  E.S.P.', 'CALLE 31 #41-57', '3229451349', 13001),
(849, '891410137', 'SUZUKI MOTOR DE COLOMBIA  S.A.', 'KM 15 VIA PEREIRA CERRITOS', '3234842059', 13683),
(850, '800133032', 'SYNERJOY BPO S.A.S.', 'Av Estacion No. 5BN 107', '4855858', 13001),
(851, '830074222', 'SYNGENTA S A', 'Carrera 9 No. 115 - 52', '5804877', 13001),
(852, '900118221', 'T.S.A. Y ASOCIADOS S.A.', 'calle 29  N° 21-45 barrio manga', '3174008611', 23672),
(853, '800092024', 'TANQUES DEL NORDESTE S.A.', 'calle 84 # 48 - 54', '3107789061 - 31', 13001),
(854, '800246302', 'TANQUES Y CAMIONES S.A.S', 'CARRERA 52 A NO. 10 - 75', '3137590713', 13836),
(855, '830096047', 'TARSON Y CIA S A S', 'Calle 98 No. 70 - 91 Oficina 201 Centro Empresarial Pontevedra', '7430991-3158463', 13001),
(856, '900311634', 'TECHNOMEDICAL S.A.S.', 'centro logisto block port technomedical bodega 44 y 43', '3218758315', 13222),
(857, '901343057', 'TECLOGI CARGO S.A.S.', 'Calle 26 No. 96 J - 66', '3160272526', 13001),
(858, '890402206', 'TECNICOS MARINOS ASOCIADOS S.A.S TECNIMAR   S.A.S', 'manga cra 27 # 27-05', '3135254375', 13001),
(859, '830072922', 'TECNICRYO LTDA', 'Calle 72 A No. 68 C 55', '3192190575', 13001),
(860, '806008859', 'TECNILAN S.A.S', 'manga cra 27 # 27-05', '3135254375', 13836),
(861, '900257204', 'TELARES MEDELLIN HOGAR S.A.S', 'CALLE 9 NO 14 - 33 SEGUNDO PISO', '3184634805', 13001),
(862, '844000518', 'TELEMATICA S.A.S', 'CRA 57 #94B 25 BRR. RIONEGRO', '3138566085', 13001),
(863, '800011987', 'TENARIS TUBOCARIBE LTDA', 'Parque Industrial Carlos Velez Pombo KM1 Via Turbaco', '3137744687', 13001),
(864, '890401779', 'TERMINAL DE TRANSPORTES DE CARTAGENA S.A.', 'carretera la coordialidad diagonal 56 # 54 - 236', '3002740037', 13001),
(865, '900447550', 'TGS TRANSPORT GLOBAL SUPPLIERS S.A.S.', 'km 9 via mamonal zona franca de la cancelaria, etapa 1', '6429900', 13001),
(866, '800141506', 'THE ELITE FLOWER S A S C I', 'Calle 19 No. 5 - 30 Oficina 2201 Edificio BD Bacata', '3212278079  -  ', 25269),
(867, '800248701', 'TIBA COLOMBIA S.A.S.', 'Transversal 93 No. 51 - 98 Edificio  Prana 26 Oficina 401', '4291800', 13001),
(868, '901443274', 'TITOS CARNES FRIAS SAS', 'calle 57 sur #104-21', '3192223721', 13222),
(869, '860072876', 'TK ELEVADORES COLOMBIA S A', 'cra 85 k # 46a-66', '3164687291', 8001),
(870, '806003144', 'TODOMAR CHL S.A.S.', 'BOCAGRANDE CARRERA 2 # 5-364', '3215536007', 13001),
(871, '900503325', 'TRACTOCAR LOGISTICS S.A.S.', 'Variante Mamonal Gambote Km 26', '312 4058503', 13001),
(872, '800241469', 'TRANSBORDER S.A.S.', 'Carrera 11 No. 64 - 47', '6013275330 - 32', 13001),
(873, '806014488', 'TRANSCARIBE S.A.', 'Urbanizacion Anita Diag. 35 No.71-77', '322 5320831', 13836),
(874, '890106493', 'TRANSPETROL LTDA', 'BOSQUE, Dg. 21 No. 56A-36', '605 6694132', 13052),
(875, '901046333', 'TRANSPORMAX SAS', 'Mz C. Lt2.', '3164473399', 13001),
(876, '890322294', 'TRANSPORTADORA DE VALORES ATLAS LTDA', 'Carrera 32 No.14-31', '3222739259', 13001),
(877, '900637363', 'TRANSPORTE DE CARGA SOLIDA Y LIQUIDA DE COLOMBIA S.A.S.', 'KM2 ANILLO VIAL ECOPARQUE NATURA TORRE 2 OFICINA 228 - FLORIDABLANCA', '3159263848', 13001),
(878, '800013029', 'TRANSPORTE LA ESTRELLA SAS', 'BARRIO BOSQUE CALLE SENA TRANSVERSAL 49 #21-71', '3205651032', 13001),
(879, '900259102', 'TRANSPORTE Y LOGISTICA PORTUARIA SA', 'MAMONAL KM 3', '3004941075', 13001),
(880, '900114539', 'TRANSPORTES ACUATICOS PROMAR LTDA', 'Barrio Centro carrera 10º No. 35-53 Edificio Comodoro piso 12 oficina 12-06', '3145608327', 70221),
(881, '800118986', 'TRANSPORTES DEL MAR S.A.S.', 'Cra 26 #28-45, of 1502. Manga', '6478917', 13001),
(882, '800128245', 'TRANSPORTES SARVI SAS - SARVI LOGISTICA', 'Calle 17 No. 69 - 94', '4116644', 13001),
(883, '800042210', 'TRANSPORTES VIGIA S.A.S E.S.P.', 'Calle 17 No. 21 - 65', '3222716734', 13001),
(884, '860015624', 'TRANSPORTES Y TURISMO BERLINAS DEL FONCE S.A BERLINASTUR S.A. - BERLINASTUR', 'carrera 68d No. 15 - 15', '3156022690', 13222),
(885, '900649430', 'TRANZUL S.A.S.', 'calle 78 · 48-61', '3208977025', 13836),
(886, '901285259', 'TRASCENDER GLOBAL SAS', 'Calle 32  32 - 24', '3008623280 - 30', 8001),
(887, '805029498', 'TRATAMIENTOS QUIMICOS INDUSTRIALES S.A.S. BIC', 'Cra 36 #15-97', '3167666560', 13001),
(888, '806008582', 'TRIPLEX Y ACCESORIOS SAS', 'santa lucia diag 31 # 71-15', '3245133759', 13052),
(889, '806016321', 'TUBOS Y METALES S.A.S', 'BOSQUE TV 54 No. 23-35', '3104049896', 13001),
(890, '806014553', 'TUVACOL S.A.', 'VIA 40 # 67 - 240', '3137413461', 13001),
(891, '900314598', 'UETA INC SUCURSAL COLOMBIA', 'Calle 127 A No. 53 A - 45 Oficina 304', '3173712773', 13001),
(892, '800008240', 'UNIDAD OFTALMOLOGICA DE CARTAGENA  SAS', 'Pie de la popa', '3005567759', 13222),
(893, '860007229', 'UNIMAQ S A', 'Calle 13 No. 68 A - 45 / 55', '3204599547', 13683),
(894, '890208788', 'UNION DE DROGUISTAS S.A.S. UNIDROGAS S.A.S', 'ZONA FRANCA SANTANDER', '3153323595', 13433),
(895, '860056070', 'UNIVERSIDAD ANTONIO NARIÑO', 'Calle 58 A BIS # 37 - 94', '3108013558', 13001),
(896, '890985189', 'UNIVERSIDAD CATOLICA LUIS AMIGO', 'Transversal 51A #67B 90 Medellín', '4487666 EXT 950', 13430),
(897, '891000692', 'UNIVERSIDAD DEL SINU ELIAS BECHARA ZAINUM- UNISINU', 'calle 31 No. 3-06 centro', '3145304444', 13001),
(898, '860013798', 'UNIVERSIDAD LIBRE', 'Calle 8 # 5 - 80', '3821000', 13001),
(899, '890401962', 'UNIVERSIDAD TECNOLOGICA DE BOLIVAR', 'Turbaco, K1', '6535200', 13001),
(900, '901514130', 'VALIDATECH SAS', 'CRA 15 # 12-37', '3125772150', 13001),
(901, '860525156', 'VALREX SAS', 'Kilometro 19 - 20 Via Mosquera - Madrid Mosquera (Cundinamarca)', '3174303866', 25269),
(902, '900139232', 'VANGUARD LOGISTICS SERVICES COLOMBIA S A', 'Calle 78 No. 9-57 Oficina 1102', '6012121822', 13001),
(903, '890403068', 'VEHICULOS DE LA COSTA S.A.S.', 'PIE DEL CERRRO CLL 30', '3135016999', 13001),
(904, '900019737', 'VENEPLAST LTDA', 'BAZURTO C CIAL BAZURTICO LOCAL 8 Y 9', '3218133059', 13001),
(905, '900130529', 'VENTURAS FOODS S.A.', 'Bosque Tv. 48 # 21-79 Calle Nilo', '3135285462-6629', 13001),
(906, '805001538', 'VEOLIA SERVICIOS INDUSTRIALES COLOMBIA S.A.S. E.S.P.', 'Calle 96 No. 10 - 72 Piso 3 Edificio Box XI', '3112139770', 13001),
(907, '900072664', 'VIACARGO S.A.S', 'Cl 85 #48-01', '3228811803 - 44', 13001),
(908, '900470526', 'VIALTRUCK SAS', 'Cr 42 # 72 81 Itaguí Antioquía', '3245525984', 13838),
(909, '806003082', 'VIDEOCOM S.A.S', 'BOCAGRANDE K2 NRO 11-41 EDF TORRE GRUPO AREA', '6810990 - 30135', 13001),
(910, '830015680', 'VIMARCO LTDA INVESTIGACIONES Y SEGURIDAD PRIVADA', 'BR MANGA CLL 29 NO 28 44', '3503336688', 13001),
(911, '860507033', 'VISE LTDA', 'Calle 6 D No. 4-42', '3143596658', 13001),
(912, '900827631', 'VITAL CARIBE SAS', 'CRA 14 N 16-42 BRR SAN JOSE', '3024105346', 13430),
(913, '901307719', 'VITELSA CARIBE SAS', 'zona franca parque central l13', '3112043260', 13810),
(914, '901205817', 'VIYALOG ZOMAC S.A.S', 'Carrera 2 n 17-33 Barrio La Libertad', '3173696628', 13160),
(915, '901030945', 'VOLCAN GOLD S.A.S.', 'CALLE 10 12 28', '3186512175', 13688),
(916, '901295650', 'WG TURF SERVICES SAS', 'Calle 145 No. 7-31', '3133051177', 13001),
(917, '70695929', 'WILMAR DE JESUS GIRALDO GOMEZ', 'CALLE 25-26 KR 51', '3205713505', 13244),
(918, '900760134', 'WIN 33 S.A.S', 'LA PROVIDENCIA DIAGONAL 31 #71-39 LOCAL 4', '3155748511', 13440),
(919, '830037843', 'WINNER GROUP S A', 'Calle 90 No. 19C32', '5896000  1096', 13001),
(920, '830085844', 'WOOD ENGINEERING & CONSULTANCY COLOMBIA S.A.S.', 'Carrera 11A No. 96 - 51', '7494987', 13001),
(921, '900223161', 'WPD INGENIERIA LTDA', 'Bocagrande Cra 4 No 7 - 115', '3215398479 3016', 13001),
(922, '860006333', 'YARA COLOMBIA S.A.', 'MAMONAL KM 11', '6931200-3104114', 13001),
(923, '900056319', 'YARI E.S. INMOBILIARIA LTDA', 'centro calle primera de badillo #35-74', '6647270 - 31167', 13001),
(924, '800256605', 'ZABALETA GARCIA & CIA. S. EN C.', 'PLAN PAREJO CRA 15 NO 27-106', '3017049998', 13838),
(925, '76043651', 'ZAPATA TRUJILLO HECTOR FABIO CARNECOL 13 DE JUNIO', '13 DE JUNIO DG 32 # 71 - 30 LOS ALPES', '3043695349', 68406),
(926, '900464667', 'ZIMA SEGURIDAD LTDA', 'Barrio Manga, carrera 19 # 26-34', '3002920983', 13001),
(927, '901492017', 'ZISTAKI COCINA SAS', 'La Boquilla, Anillo Vial Cra. 9 No. 34-276', '3176471154', 13001),
(928, '900324294', 'ZONA DE ACTIVIDAD LOGISTICA S A S', 'Carrera 16 No. 93 A - 36 Edificio Business Center Oficina 804', '3168748512', 13001),
(929, '900164755', 'ZONA FRANCA ARGOS S.A.S', 'CARTAGENA', '3198700  64259', 13001),
(930, '800178052', 'ZONA FRANCA DE LA CANDELARIA S.A   USUARIO OPERADOR', 'Mamonal Km 9', '6723630 Ext: 66', 13001),
(931, '900301268', 'ZONA FRANCA PARQUE CENTRAL S.A.S.   USUARIO OPERADOR DE ZONA FRANCA', 'variante de Turbaco sector aguas prietas cll 1 carrera 2-5', '3162338297', 13001),
(932, '900220423', 'ZONA LOGISTICA S.A.S.', 'Carrera 41 # 32 - 30', '3168750266', 13001);
INSERT INTO `empresa` (`idempresa`, `nit_empresa`, `nombre_empresa`, `direccion_empresa`, `telefono_empresa`, `municipios_codi_muni`) VALUES
(933, '890307400', 'UNIVERSIDAD DE SAN BUENAVENTURA', 'Carrera 8H # 172 -20', '6016671090-6024', 11001),
(934, '806013944', 'IMÁGENES & RADIOLOGIA S.A.S.', 'BOCAGRANDE, CALLE 5 No. 3-47', '3005756479', 13001),
(935, '806002513', 'SUPERCENTRO LOS EJECUTIVOS', 'avenida pedro de heredia, calle 31 numero 57-106', '3058207347-3007', 13001),
(936, '800197268', 'DIAN', 'Cra. 7 # 6C - 54 - Piso 8° - Edifício Sendas', '6017428973', 66001),
(937, '806016505', 'SERVICIOS REMOLCOSTA S.A.S', 'CLL 7 CRA 5 N 580', '3232850224', 13001),
(938, '900353873', 'SCANIA COLOMBIA S.A.S.', 'Calle 17 No. 68 - 24', '3219377952', 11001),
(940, '813004147', 'TRANSPORTES DEL HUILA S.A. - T D H SOLUCIONES EN LOGISTICA', 'Carrera 71 No. 21 - 19 Oficina 28', '3102896684', 11001),
(941, '800036052', 'TRANSPORTES CHEVALIER LIMITADA', 'carrera 46 57-57', '3160493219	', 8001),
(942, '900463029', 'ALTEA FARMACEUTICA S.A.', 'Calle 10 No. 65 - 28', '7477222', 11001),
(943, '900225704   ', 'AUTO BERLIN S.A.', 'VIA 40 #69-19', '	3205244771', 8001),
(944, '806009227   ', 'FUNDACION JUAN FELIPE GOMEZ ESCOBAR', 'calle 31n 91 80', '3145871869', 13001),
(945, '860001307   ', 'DISTRIBUIDORA NISSAN S.A.', 'calle 13 # 50 69', '3214350226', 11001),
(946, '900915647', 'CARTAGENA CONTAINER TERMINAL OPERATOR  S.A.S.', 'BOSQUE', '6724250', 13001),
(947, '900262186', 'INVERSIONES VIA TROPICAL S.A.S.', 'PARQUIAMERICA KM 6 VIA MAMONAL MZ E BODEGA 1', '6700031', 13001),
(948, '900943243', 'SURAMERICA COMERCIAL S.A.S.', 'Cra 43a #38sur-37', '3235764125', 13001),
(949, '800197456', 'FRIMAC S..A', 'zona franca santander', '3153359065', 13001),
(950, '806016920', 'I.P.S. VIDA PLENA S.A.S', 'CARRERA 36 #30 - 03', '310 6659193', 13001),
(951, '806007912', 'SIPORT TECNICO SAS', 'Mamonal Km 6', '3205650392', 13001),
(952, '900118693   ', 'CONGREGACION RELIGIOSA HERMANITAS DE LA ANUNCIACION PROVINCIA DEL ROSARIO', 'BARRIO PARAGUAY', '3134990756', 13001),
(953, '900118693', 'CONGREGACION RELIGIOSA HERMANITAS DE LA ANUNCIACION PROVINCIA DEL ROSARIO', 'AVENIDA CARRERA', '3134990756', 11001),
(954, '806015096', 'COMERCIALIZADORA INTERNACIONAL MAMBO SAS', 'Calle 30 Av pedro Heredia #22 28', '6056625545', 13001),
(955, '900882602', 'PROGAN DEL CARIBE SAS', 'Zona franca, Mamonal Km 9', '3126812555', 13001),
(956, '901317582', 'JNVERSIONES 1806 S.A.S', 'Mamonal Km 5', '3134415031', 13001),
(957, '900017447', 'FALABELLA DE COLOMBIA', 'B/quilla - Falabella', '3218479506', 11001),
(958, '800101399', 'DOMESA DE COLOMBIA S.A. - DOMESA S.A.', 'Bosque avenida pedro Vélez #51-119', '6930017', 13001),
(959, '900260940', 'TOTAL SERVICES DE COLOMBIA SAS', 'Cra24 No. 75-35 La Libertad', '3223079328', 68081),
(960, '806003308', 'DISTRIBUIDORA MARTELO OSPINO SAS', 'K1 bodega 4 centro industrial ternera', '7434444 - 32136', 13001),
(961, '830066626', 'CLINICA MEDIHELP', 'Carrera 6 # 5-101 Bocagrande', '(605) 6939877', 13001),
(962, '901899007', 'Il Capriccio Restaurante y Pizzaria S.A.S', 'calle 30 # 63-32', 'n.n', 13001),
(963, '800.102.315', 'PROQUCOL SAS', 'carrera 83 C24 25 P1 Ternera', '314 5975444', 13001),
(964, '900347831', 'MADOCO XXI S.A.S', 'via mamonal Km 6 clc local 13', '302 2630374', 13001),
(965, '890481177', 'ALCALDIA DE ZAMBRANO', 'Barrio el Amparo calle 8 N° 15 - 51', '(575)4853059', 13894),
(966, 'INVIMA', '830000167', 'Carrerra 10 #64 - 28', '6012425000', 11001),
(967, 'BPM BOLIVAR S.A.S. B', '900978712', 'Carrera 17 #30 100 Transbahia local 2', 'N.N', 13001),
(968, '900094188', 'FUTURISTICO GROUP S.A', 'CARRERA 2 8 20', '	6056659023', 13001),
(969, '900792498', 'QUALITY INGENIERIAB6Y SERVICIOS S.A.S', 'Bosque Transversal 54 #21A-55', ' 6056939845', 13001),
(970, '806015535', 'TECNO CALIDAD LTDA', 'MANGA 4ta. AVE. No. 21A-16  APTO. 202', 'N.N', 13001),
(971, '901378335', 'ALIANZAS  TECNICA FENIX SAS', 'CARRERA 66 MZ 11 19 APTO 4 BR BLAS DE LEZO', '3008762734', 13001),
(972, '900090638', 'NUTRIMOS Y SERVIMOS', 'Amberes Carrera 40 N° 28-147', '6056621444', 13001),
(973, '900393798-9', 'ECOPETROL CARTAGENA SAS', 'variante mamonal ', '01-800-0918418', 13001),
(974, '901028296', 'ASESORIAS, CONSTRUCCIONES, INGENIERIA, SERVICIOS Y SOLUCIONES DE COLOMBIA SAS', 'CONJUNTO RESIDENCIAL TACARIGUA III APTO 202 BLOQUE 1, BRR TACARIGUA', '3043800848', 13001),
(975, '8685243', 'FRIOSERVICIOS', 'Cra 7 35 A 41', '6056663100', 13001),
(976, '890901321', 'EDUARDO BOTERO SOTO S.A  ', ' Crr 42 # 75 – 63, autopista sur, Itagüí, Antioquia', '(4) 576 55 55', 1),
(977, '9003812076', 'INHOMAR S.A.S', 'BARRIO ALBORNOZ CRA 56 N 3 A LOTE 02 SECTOR VILLA BARRAZA', '3182185217', 13001),
(978, '9004752721', 'MALAI S.A.S      ', 'TRANSVERSAL 32 SUR 32 13', '6043223713', 266),
(979, '800082770', 'AGUAS & AGUAS S.A.S ', '	BARRIO EL BOSQUE TRANSVERSAL 54 CENTRO EJECUTIVO EL BOSQUE OFICIN', '3116007120', 13001),
(980, '899999439', 'INSTITUTO EDUCATIVO DEPARTAMENTAL SAN ANTONIO DEL TEQUENDAMA CUNDINAMARCA', 'Turbaco Km 3 sector el cortijo', '56710304', 13001),
(981, '900468599', 'MACHINERY & SERVICES SAS', 'LUGAR MAMONAL KM 6 PARQUEADERO TRIPLE A NO 7 19', '3188372111', 13001),
(982, '890300225', 'COEXITO S.A.S.                                                                                      ', 'Carrera 32 #21 141', 'N.N', 13001),
(983, '806001427', 'COMBUSTIBLES Y SERVICIOS LAS MURALLAS S.A.S.                                                        ', 'TRANSVERSAL 54 30 100 BOSQUE', '	6056375951', 13001),
(984, '811028981', 'MALCO CARGO S.A', 'Calle 8B No. 65-191 Oficina 511', ' (574) 352-1313', 1),
(985, '860506204', 'AGENCIA DE ADUANAS CEVA LOGISTICS S.A.S NIVEL 2', 'Cra. 26 #28-45', '3183593917', 13001),
(986, '900848236', 'ANAVA LOGISTICS S.A.S.', 'Central Bodega 73, Variante Turbaco, Sector Aguas Prietas', '57 (60) (5) 642', 13001),
(987, '806005070', 'SERBUCYC S.A.S', 'Barrio Bosque  AV Pedro Velez DG 20 # 51-90', 'N.N', 13001),
(988, '9 0 1 1 1 5 9 4 8', 'HOTYEL LA ISLA', 'Isla Barú', 'N.N', 13001),
(989, '901281861', 'SERLOGISTICA / Exclusive Travel Services', 'Provincia de Cartagena', '300 3487355', 13001),
(990, '9001145392', 'TRANSPORTERS ACUATICOS  PROMAR ', 'DIAGONAL 19 51 37 SEC MANZANILLO', '3005491905', 13001),
(991, '830053812', 'HOTEL INTERCONTINENTAL  ALIANZA FIDUCIARIA S.A FIDEICOMISOS', 'Cra 1 #5 - 01', '3103523392', 13001),
(992, '890400482-2', 'CLUB DE PESCA Y VELA DE CARTAGENA', 'Manga calle 2A # 16 - 18', '3145500169', 13001),
(993, '800240218', 'REFRILITORAL CASASBUENAS CORTES &CIA LTDA', 'Refrilitoral l. 43 #43-73, Nte. Centro Historico', '53794872', 13001),
(994, '901490438', 'MAR TRES ', 'MAR 3 Transversal 38 20 - 70 MARINA ROSALES', '56626880', 13001),
(995, '\"901444366						\"', 'ORBIA', 'ORBIA Mamonal Km 12', ' 311 6539122', 13001),
(996, '900440054', 'IPS DELTA CARTAGENA S.A.S', 'Carrera 49 #30-104', '3024243534', 13001),
(997, '901503315', 'INVERSIONES SOLUCIONES Y SUMINISTRO SAS', 'AVENIDA BUENOS AIRES DIAGONAL 21 A 46 13 BARRIO BOSQUE', '3106596500', 13001),
(998, '900639810', 'Compañía Nacional de Logística CONALOG S.A.S', 'CALLE 19 68 D 73', '	6017561099', 11001),
(999, '830.027.231-3', 'AZELIS COLOMBIA S.A', 'AUTOPISTA MEDELLIN 7 BG 1 PAR IND LOGIKA II', '6019156373', 25799),
(1000, '8 3 0 0 2 7 2 3 1 3 ', 'Azelis sas', 'AUT MED KM 5.7 COSTADO SUR', '3212824369', 25001),
(1001, '830.035.850-6', 'FAM TEAM', 'Manga. 25th St. 24A-16. Of.1403', '3212824369', 13001),
(1002, '901645415', 'OSHPITALITY GROUP SAS', 'Cl. 31 #10 - 77, Getsemaní', '3187701988', 13001),
(1003, '901.046.830-3', 'OBEN DISTRIBUIDORA COLOMBIA LTDA', 'CUNDINAMARCA	FUNZA	zona franca zofia	', '3187352994', 25286),
(1004, '900.582.731-7', 'EGA-KAT LOGISTICA SAS', 'CARRERA 71 19 70 BOGOTA', '3164646182', 11001),
(1005, '8060007314', 'MYD SAS', 'CARRERA 78 J 60 A 70 SUR', 'N.N', 11001),
(1006, '901303618', ' REFRICEDEÑO SAS', 'Mz 7, Lote 1, Plan 554 Barrio el Socorro', '3216167886', 13001),
(1007, '900262186-1', 'INVERSIONES VIA TROPICAL SAS', 'Via Mamonal Km 6 Manz E Bdg 1 Cartagena, Bolívar', '6056700031', 13001),
(1008, '901069982', 'PLEXAPORT SAS', 'ZONA FRANCA DE CARTAGENA KILOMETRO 13 MAMONAL VIA A PASACABALLOS LOTE 1, 2 Y 3', '3205745208', 13001),
(1009, '900557954', 'Procargo zona franca la candelaria', 'LUGAR MAMONAL KM 9 ZONA FRANCA LA CANDELARIA ETAPA 2 BODEGA 9 B ', '3124832932', 13001),
(1010, '86000735', 'SIPOR S.A.S', '20 DE JULIO CLLE#28', '6056475690', 13001),
(1011, '1047500773', 'MODELO LOGISTICO DE SERVICIO DE TRANSPORTE DE CONTENEDORES', 'Cartagena ', '3008662282', 13001),
(1012, '1137220108', 'Descripción de la exportación de carne bovina en el marco de la asociación estratégica de Colombia y', 'CARTAGENA DE INDIAS', '3217243632', 13001),
(1013, '1047366131', 'Descripción de la exportación de carne bovina', 'CARTAGENA DE INDIAS', '3005515585', 13001),
(1014, '890406589', 'ETEC SAS', 'VIA MAMONAL KM 4 ALBORNOZ', '3183118635', 13001),
(1015, '901201814', 'REPARACIONES TECNICA MARITIMAS SAS', 'LIBANO CLL 1 SECTOR ALCAPULCO #49-29', '3017438060', 13001),
(1016, '900189239', 'IMEIM LTDA', 'Barrio Bellavista Calle 6 56 B #57', '3212354242', 13001),
(1017, '800087565', 'SYNLAB COLOMBIA S.A.S.', 'Carrera 14 A No. 101 - 73', '3217482776', 11001),
(1018, '901301324', 'TERANING SAS', 'Avenida el bosque Dg 23#TV53a-45 oficina 2 y 3', '3006871073', 13001),
(1019, '901211634', 'INDUSTRIAS PALMIRA  S.A.S', 'dg65t numero 44a 64', '3203332430', 68081),
(1020, '900237590', 'ESTRUCTURAS Y MONTAJES DE COLOMBIA S.A.S.', 'Bosque Diag 21 Nro 49 - 121 Local 1', '6581002', 13001),
(1021, '900171728', 'NAVALTEC SAS', 'BARRIO BELLAVISTA 7a 36', 'N.N', 13001),
(1022, '900771059', 'IMI INGENIERÍA MONTAJES Y MANTENIMIENTO INDUSTRIAL SAS', 'TRANVERSAL 54 321 A-120, EDIFICIO BOSQUE EJECUTIVO, OFICINA 711', '3216714413', 13001),
(1024, '800047781', 'ENECON SAS', 'CARRERA 56 N°  72A-94 CIUDADELA DEL VALLE', 'N.N', 190),
(1025, '9012111779', 'Tecnipartes Diesel Mafer S.A.S', 'Calle 3 B # 56 - 270 Barrio Libertador', 'N.N', 13001),
(1026, '860019021', 'ASOCIACIÓN PARA LA ENSEÑANZA ASPAEN', 'Calle 69 No. 7 A - 50', '2177590', 11001),
(1027, '901483306', 'REDES DE ACCESO GLOBAL SAS', 'centro comercial bocagrande oficina 204 ', '3107108985 - 31', 13001),
(1028, '900112515', 'REFINERIA DE CARTAGENA S.A.S.', 'Cartagena Km 10 vía Mamonal - Pasacaballos', '3002117100', 13001),
(1030, '900622152', 'COMERCIALIZADORA LA ELITE SAS', 'BOSQUE TRANSV 52 #21A-108', '3205289742', 13001),
(1031, '806005516', 'SERVICIOS INDUSTRIALES Y METALMECANICOS SAS', 'BOSQUE TRV 54 No 25-53', '3153941365', 13001),
(1032, '901281572', 'BOLD.CO S.A.S', 'Calle 93 A No. 10 - 54 Oficina 601', '3138422995', 11001),
(1033, '900466154', 'AUTO TROPICAL CARTAGENA SAS', 'MANGA CARRERA 25 #26-65', '3014695941', 13001),
(1034, '9016327387', 'PRODUCTOS CARNICOS CARNES & CARNES S.A.S', 'DIAGONAL 21 22 18 BARRIO EL PRADO', '3163845317', 13001),
(1035, '901275377', 'GRUPO BUENA VIDA S.A.S', 'Centro H calle badillo', '3125056585', 13001),
(1036, '9016834904', 'Industria De Alimentos Everest S A S', 'BARRIO BOSQUE AV PEDRO VELEZ N 48 14', '3042029507', 13001),
(1037, '9012314912', 'Personal Suministro Sas', 'CALLE 29 25 13 EDF BRP BUSINESS TOWER P 7 BR MANGA', '6056431772', 13001),
(1038, '9004401602', 'IMBERA COLOMBIA SAS', 'CARRERA 132 22 A 39', '3207270628', 11001),
(1039, '901231491', 'PERSONAL DE SUMINISTRO', 'CALLE 29 25 13 EDF BRP BUSINESS TOWER P 7 BR MANGA', '6056431772', 13001),
(1040, '901275377', 'GRUPO BUENA VIDA S.A.S.', 'CALLE DE LA SOLEDAD 5 90 Y CALLE DEL PORVENIR CRA 6 35 85 ESQ', '3125056585', 13001),
(1041, '1147479008', 'NNOCAUTE', 'CARTAGENA DE INDIAS - BOLIVAR', '300 4906532', 13001),
(1042, '1047416769', 'LISTA DE CHEQUEO IMPLEMENTACION Y FORTALECIMIENTO DE CONTROL DE CALIDAD E INOCUIDAD ALIMENTARIA EN R', 'CARTAGENA DE INDIAS - BOLIVAR', '3016471813', 13001),
(1043, '1047416769', 'LISTA DE CHEQUEO IMPLEMENTACION Y FORTALECIMIENTO DE CONTROL DE CALIDAD E INOCUIDAD ALIMENTARIA EN R', 'CARTAGENA DE INDIAS - BOLIVAR', '3016471813', 13001),
(1044, '1047416769', 'CHEQUEO IMPLEMENTACION Y FORTALECIMIENTO			', 'CARTAGENA DE INDIAS - BOLIVAR', '3016471813', 13001),
(1045, '806009307', 'Institución educativa Bertha Suttner', 'CARTAGENA DE INDIAS - BOLIVAR', '3243014609', 13001),
(1046, '1128062136', 'SODAS CARBONADAS CON FRUTAS', 'CARTAGENA DE INDIAS - BOLIVAR', '3043340584', 13001),
(1047, '1149445868', 'DISTRIBUCION DE CALZADO DESDE BUCARAMANGA', 'CARTAGENA DE INDIAS - BOLIVAR', '310 4066302', 13001),
(1048, '1051356714', 'DISEÑO CURRICULAR TALLER DE FORMACION', 'CARTAGENA DE INDIAS - BOLIVAR', '3026468074', 13001),
(1049, '901313783', 'ARIZA POLO', 'Carrera 7A C 161', 'N.N', 8001),
(1050, '899999034', 'Centro internacional Náutico, fluvial, y portuario', 'Mamonal Km 5', '56685519', 13001),
(1051, '901013799', 'APC FRIGORIFICOS ZFC SAS', '	VIA MAMONAL LA CANDELARIA MAMONAL', '3113650119', 13001),
(1052, '800065590', 'DELTA INGENIERIA S.A', 'CALLE 31 C CARRERA 50 66 BARRIO TESCA NUEVA', '6056753086', 13001),
(1053, '901205231', 'CONSTRUSOLUTIONS GROUP S.A.S.', 'BARRIO EL PRADO 34 22 SEDE ADMINISTRATIVA DE CLINICA CREC', '3042901787', 13001),
(1054, '860508791', 'DONUCOL S.A.', 'CALLE 63 C 28 A 65', '3143595964', 11001),
(1055, '890313036', 'AGENCIA DE ADUANAS CONTINENTAL DE ADUANAS  S.A.S. NIVEL I', 'CALLE 7 3 11 ED PACIFIC TRADE CENTER OF 1503', 'N.N', 76109),
(1056, '900548752', 'TV COLOMBIA DIGITAL SAS', 'CALLE 108 21 10 BARRIO PROVENZA BARRIO PROVENZA', 'N.N', 68001),
(1057, '900768978', 'ROSDEL SAS                                                                                          ', 'CALLE 64 CR 65 48 65', '6052786946', 8001),
(1058, '901045892', 'LOGISTIC SERVICES AND SOLUTIONS SAS', 'ALAMEDA LA VICTORIA MZ D LOTE 3', '3156684372', 13001),
(1059, '1043635227', 'M&B Coffee Export', 'Cartagena', '3046776710', 13001),
(1060, '1001975213', 'AGUACATES SULGAB SA.S', 'cartagena', '3181114524', 13001),
(1061, '1047401153', ' NATURÑAME', 'Cartagena', '3052754794', 13001),
(1062, '1019034489', 'EcoGen', 'Cartagena', '3028318238', 13001),
(1063, '1048435879', 'ANFRION NAUTICO', 'Cartagena', '3008930898', 13001),
(1064, '900625532', 'DIESELECTRICOS SAS', 'DG 31 107 75 BG I3', '3123565064', 13836),
(1065, '819001498', 'INVERSIONES PADORNELO S.A.S.', 'Carrera 1C 22 58 Oficina 507 Edificio Bahía Centro', '3128730288', 47001),
(1066, '806015945', 'ESCALERAS DE COLOMBIA DEL CARIBE LTDA', 'BOSQUE # 47A-25', '3194902154', 13001),
(1067, '890480635', 'COOPERATIVA DE TRANSPORTADORES URBANOS DE CARTAGENA LIMITADA SIGLA COOTRANSURB', 'VARIANTE MAMONAL TURBACO CAMINO A AGUAS PRIETAS ENTRE EL KILOMETRO 6 Y 7', '3166916014', 13001),
(1068, '900675394', 'POSITIVO S+ IT SOLUTIONS S.A.S', 'CL 49 SUR 45 A 300', '3022995887', 1),
(1069, '901730677', 'LENTES GALILEO COLOMBIA SAS', 'Avenida Calle  116 No. 23 - 06 Oficina 408', '3208150963', 11001),
(1070, '901936391', 'ALIANZA OPERADORA TURISTICA S.A.S', 'CL 93 B #17 - 25', '3164163657', 11001),
(1071, '900468473', 'MCD DESIGN S.A.S', 'Cl 98 Sur 48 270 Bod 22  San Sebastin', '3383197', 1),
(1072, '800141644', 'ARMADA NACIONAL', 'KILOMETRO 2 TRONCAL DE OCCIDENTE0', '3126866760', 70215),
(1073, '891801450', 'TRANSPORTES LOS MUISCAS S.A.S', 'AVENIDA ORIENTAL 14-54', '3134245196', 15001),
(1074, '860511071', 'Ministerio de relaciones exteriores', 'Cl. 10 #5-51', '3814000', 11001),
(1075, '900178466', 'MECANICA PORTUARIA E.U', 'La Princesa Mz 12 L15', '6612650', 13001),
(1076, '811023331', 'GESTION Y SERVICIOS AMBIENTALES S.A.S', 'Calle 32D # 65D - 07', '4165511', 1),
(1077, '900.142.908-6', 'RIMORCHIATORI RIUNITI COLOMBIA S.A.S.', '610, Edificio Posihueica. Santa Marta, Colombia', 'N.N', 47001),
(1078, '1052987578-0', 'MARINA AZUL IMPORT', 'CL. 20 NRO. 101 A - 67 APART. 120 TO. 5 ', 'N.N', 76001),
(1079, '901135333-6', ' NAM CONSTRUCCIONES', 'BARRIO ZARAGOCILLA AV PEDRO HEREDIA CLL 31 N 50 122 ED SIO OF 303', 'N.N', 13001),
(1080, '900124477', 'TRANSMIDEIESEL SAS', 'Diagonal 22 # 37 – 54 Av Crisanto Luque – Barrio El Bosque', 'N.N', 13001),
(1081, '9009509376', 'SOLUMEC S.A', 'CARRERA 53 106 280 PI 4 OF 4 B', 'N.N', 8001),
(1082, '800251163', 'ULTRATUG COLOMBIA', 'Calle 81 No 11-55, Edificio Ochenta 81, Torre Norte, Oficina', 'N.N', 11001),
(1083, '890403064', 'HOTELES Y TURISMO SAS', 'CL 25 BIS NO. 31 A 35 OF 202', 'N.N', 11001),
(1084, '8050097102', 'COMPAÑÍA DE INGENIERIA Y MONTAJE SAS', 'CRA 8 N° 37-02', '4457968', 13001),
(1085, '890480041', 'CAMARA DE COMERCIO DE CARTAGENA', 'Calle 28 No. 27-23. Edificio Seaport 3', '3014497607', 13001),
(1086, '804000044', 'DELTHAC 1 SEGURIDAD LTDA.', 'CALLE36 31-39', '3102366919', 11001),
(1087, '901089241', 'CULTIVOS LA PLANICIE SAS', 'Calle 97 No. 23 - 60 Torre Proksol Oficina 702', '3102737935', 11001),
(1088, '900393742', 'TRANSPORTES CI S.A.S', 'MEMBRILLAL', '3173790618', 266),
(1089, '901074681', 'Sibarita del mar S.A.S', 'Cl 26 #18 A 43 MANGA', '3205012469', 13001),
(1090, '900977113', '4 PAJAROS', 'CALLE 2 # 6A - 28, PUNTA ARENA', 'N.N', 13001),
(1091, '73153214', 'AMD REFRIGERACION INNOVACION EN CLIMATIZACION', 'Ciudadela Bonanza Mz 11 Lote 88', 'N.N', 13001),
(1092, '89999934', 'POLLOS BUCANEROS SA', 'VIA GAMBOTE', 'N.N', 13052),
(1093, '890480069', 'Alcaldía Santa Catalina', 'Santa Catalina', 'N.N', 13673),
(1094, '899999086', 'Servicios Postales Nacionales S.A', 'MANGA CRA 27 #28-39', '6931511-Ext 650', 13001),
(1095, '890480184-4', 'Alcaldía Mayor de Cartagena de Indias', 'Cra. 2 # 36-86, Centro Histórico', '3145412203', 13001),
(1096, '900980728', 'ips cuidado seguro en casa ', 'BARRIO ARMENIA', '3107197765', 13001),
(1097, '800123655-4', 'Grupo Resurgir ', 'Cl. 73 #51D- 71, Aranjuez', '301 6680852', 1),
(1098, '900485260-4', 'ULTRATUG SA', ' Dirección: Calle 81 No. 11 - 55 Torre Norte Oficina 401', 'N.N', 13001),
(1099, '1137524133', 'AGENDI PLUS', 'CAMPETRE Calle 1 ', '3215475753', 13001),
(1100, '800203984', 'SIMONIZ SA', 'Carrera 127 N° 15 B - 60', '3105626997', 11001),
(1101, '890102018-1', 'ALCALDIA DE BARRANQUILLA', 'CALLE 34 #43 -31', '57 (605) 401 02', 8001),
(1102, '9015426146', 'TECNINDUSTRIALES DEL CARIBE SAS', 'SAN FERNANDO CRA 82 NO. 24 120', '3235897165', 13001),
(1103, '901002713', 'TALLER 4JS INGENIERIA S.A.S', 'Bosque, av. Buenos aires No 49- 48', '3009049077', 13001),
(1104, '860005080', 'THOMAS GREG & SONS DE COLOMBIA S A', 'Carrera 42 Bis No. 17 A - 75', '3184666145', 11001),
(1105, '830078644', 'OBEN DISTRIBUIDORA COLOMBIA LTDA', 'zona franca zofia', '3187352994', 13001),
(1106, '9009423255', 'EMARES LOGISTIC SAS', 'CRA 25 25A 32 OF 205', '3003039136', 13001),
(1107, '901157863', 'MULTIREPUESTOS H&H SAS', 'turbaco', '3046554821', 13836),
(1108, '800254610', 'AGENCIA DE ADUANAS AGECOLDEX S.A. NIVEL 1', 'Calle 41 norte  4n - 11', '3214432459', 76001),
(1109, '890933171', 'AGENCIA DE ADUANAS COMERCIO EXTERIOR ASESORES S.A.S. NIVEL 1', 'calle 47d 70-133', '6052505', 1),
(1110, '900649118', 'MANGLA DEL GOLFO COMBUSTIBLES S.A.S', 'Cra. 13 #91-23', '3115933843', 837),
(1111, '800187070', 'FRIO COSTA S.A', 'Dg. 21 #42-62, El Bosque', '304 67150', 13001),
(1112, '901009764', 'INGENIERA Y SUMINISTROS DE SISTEMAS INTELIGENTES (ISSI) S.A.S', 'CARRERA 15 D 77 22', '3168183630', 8758),
(1113, '900277236', 'Navega Colombia o La sociedad fantástica S.A.S', 'CARRERA 20 24 22 LOCAL 1 SEGUNDO PISO BARRIO MANGA', '3175153149', 13001),
(1114, '806016505', 'REMOLCOSRA SAS', 'Cll 7 Cra 5-580 Bolívar', 'N.N', 13001),
(1115, '900621981', 'INVERSIONES ONE PIECE S.A.S', 'Av Newball Edif Cámara de Comercio P-4 Of 407 San Andrés', 'N.N', 13001),
(1116, '805028671', 'LOGISTICA INTERNACIONAL-   SERVADE S.A', 'CL 6 N 15 54 OFC 300', '3154929677', 76001),
(1117, '860.008.067', 'Frigorifico Guadalupe S.A.S', 'Autopista Sur No 66-78', '601-7104200', 11001),
(1118, '800070993', 'EMPRESA INTERNACIONAL DE SOLUCIONES DE ENERGIA ELECTR TEMPORAL S.A.S', 'Bogota', '3117707310', 11001),
(1119, '890401435', 'SOCIEDAD PORTUARIA OPERADORA INTERNACIONAL S.A', 'manga terminal maritimo', '6607781-EXT 271', 13001),
(1120, '800214243', 'INTERCARGUEROS ANDINOS S.A.S', 'Cl. 27A #54-40', '3163655278', 1),
(1121, '860001560', 'NAVEMAR S.A.S', 'Calle  100 No. 8A -  55 Of 1015 T.C. World Trade Center', '2966304', 11001),
(1122, '890504820', 'AGENCIA DE ADUANAS COMERCIO EXTERIOR DEL NORTE S.A', 'av 7 N 17 N 92 Parque industrial del oriente bodega N2 B5', '3180648961', 54001),
(1123, '802000259', 'AGENCIA DE ADUANAS MOVIADUANAS SAS - NIVEL 1', 'CR 53 64 72 OF 306                                                                        ', 'N.N', 8001),
(1124, '890481324', 'ALCALDIA MUNICIPAL DE TURBANA', 'CALLE TAMARINDO CRA 16 14 B-73', '3505362740', 13838),
(1125, '900374792  ', 'INSTITUTO NACIONAL DE OFTALMOLOGIA SA - 	INO COLOMBI', 'Calle 127 A No. 7 - 53 CS 5001 5002 5003 5004 5005 5006', '3176484779', 11001),
(1126, '900381207', 'INHOMAR SAS', 'BARRIO ALBORNOZ MZ 537 LOTE 16', '3022489315,6570', 13001),
(1127, '800199453', 'SOLUCIONES INMEDIATAS S.A.S', 'Carrera 6 No. 27 - 20 Oficina 601 Edificio Antares', '6017420777-322 ', 11001),
(1128, '900835661', 'SERVICIOS Y SUMINISTROS JULMAR S.A.S', 'Bellavista Cll 7A Cra 57-27', '3008658011', 13001),
(1129, '890505268', 'AGENCIA DE ADUANAS REPRESENTACIONES J. GUTIERREZ SAS. NIVEL 1', 'CL 22 N AV CAMILO DAZA 12 85 ZN INDUSTRIAL', '3214079917', 54001),
(1130, '901365136', 'IMPORTACIONES JS TOOLS SAS', 'BOSQUE TRANVERSAL 54 #21Ba-91', '3135079596', 13001),
(1131, '830096590', 'SAPIA CI SAS', 'Aeropuerto Rafael Núñez', 'N.N', 13001),
(1132, '900300002', 'AGENCIA DE ADUANAS SECURITYS S A S NIVEL 2', 'Calle 94 A No. 11 A - 53 Piso 6', '3208322320', 11001),
(1133, '800140239', 'CRISTIAN CABRALES Y CIA S.A.S.', 'calle 44 #3-50', '3508033638', 23001),
(1134, '806013568', 'NEURODINAMIA S.A', 'Bosque transversal 54 # 75 -21a', '3156292461', 13001),
(1135, '830009686', 'AGENCIA DE ADUANAS MIRCANA LOGISTICS SAS NIVEL 1', 'Calle 52 B No. 72 B - 50 / 52', '3158008513', 11001),
(1136, '900335140', 'LA OKA SAS', 'Carrera 102 A No. 25 H - 45 Oficina 314', '3183455860', 11001),
(1137, '901312900-1', 'Cartagena plastic & reconstructive surgery institute sas', 'km 12 puertas de las americas, edificio AED clinica capri', '3028587619', 13001),
(1138, '829004079-7', 'Corporación Paso a Paso', 'BARRIO PALMIRA', '3124036429', 68081),
(1139, '901380322', 'CARDIOVIDA SANTA MARTA', 'Carrera 14 No. 23-42', '3004773111', 47001),
(1140, '900171369-1', 'Corporacion Red Somos', 'Cra 16A # 30-90', '3023221368', 11001),
(1141, '830039329', 'IMAGE QUALITY OUTSOURCING S.A.S', 'Calle 28 No. 13-22 Piso 5 ', '3042930164', 11001),
(1142, '901228024', 'GIMNASIO CERVANTES DE CARTAGENA', 'Amberes 3er callejon cra27-86', '3135441808', 13001),
(1143, '901272594', 'BACKOOM SAS', 'DIAGONAL 21 CARRETERA EL BOSQUE 52 147', '3160170630', 13001),
(1144, '900744167', 'GESYCOBRO S.A.S.', 'CLL 36A NORTE 3G-57', '3232248179', 13001),
(1145, '900629065', 'SOLUCIONES INTEGRALES O.B S.A.S.', 'CRA 42H # 90 99', '3118671496', 8001),
(1146, '901862311', 'CALAMO SAS', 'CL 5 14 100 BARRIO GALILEA', '3233840745', 23001),
(1147, '900200960', 'BANCIEN S.A. Y/O BAN100 S.A', 'Carrera 7 No.76 - 35 piso 9', '3219739873', 11001),
(1148, '900105915', 'BELT CO S.A.S', 'Kilometro 5 Via Suba - Cota Finca Santa Ana', '3112069234', 11001),
(1149, '901155508', 'REDCOL HOLDING S.A.S', 'Carrera 9 No. 80 - 45 Oficina 601', '3167426570', 11001),
(1150, '900497746', 'Proyeingeneria SAS', 'Dg 45G Tv 54-2, Ap 201 #Bl 2, Cartagena de Indias, Bolívar	', 'N.N', 13001),
(1151, '806008859', 'TÉCNILAN S.A.S', ' Carrera 24, Cl. 24 #23-87, Manga, Cartagena de Indias, Bolívar	', 'N.N', 13001),
(1152, '9004162506', 'DMARS', 'Tv. 44d #21a-71, El Bosque, Cartagena de Indias ', 'N.N', 13001),
(1153, '900346416', 'SITECSA', 'Cra 58A #7a-131 a 7a-1,&nbsp, Cra 58A #7a62', 'N.N', 13001),
(1154, '900404671', 'MEGATIENDAS', 'Cra. 5 #3-29, Cartagena de Indias, Bolívarv', 'N.N', 13001),
(1155, '890404970', 'GRUPO HOTELERO MAR Y SOL S.A.S', 'BRR BOCAGRANDE CRA 1A 2 8', 'N.N', 13001),
(1156, '900828654', 'HOTEL Hyatt regency', 'Cra. 1 #12-118, Cartagena de Indias', 'N.N', 13001),
(1157, '900303634', 'TRANSPORTES DE LA SIERRA SAS', 'CL 4 SUR 43A 195 OF 214', 'N.N', 13001),
(1158, '900497746', 'PROYEINGENIERIA SAS', 'Calle 23 Sur No. 68 H - 54 Piso 3', '5332326-3183678', 13001),
(1159, '900095335', 'OUTSOURSING KARGO LTDA', 'TRANS. 72 F NO 42 C 40 SUR', 'N.N', 13001),
(1160, '860002576', 'GECOLSA - GECOLSA', 'Calle 6 No. 42 A - 21', 'N.N', 13001),
(1161, '890101138', 'PELAEZ HERMANOS', 'Carrera 32 No. 17 - 09', 'N.N', 13001),
(1162, '860025792', 'RENAULT SOCIEDAD DE FABRICACION DE AUTOMOTORES S.A.S', 'Cra 49 # 39 Sur - 100', 'N.N', 13001),
(1163, '890500726', 'COLGAS S.A. E.S.P', 'Diagonal 92 No. 17 A - 42 Edificio Brickell Center Piso 4', '3022362659', 11001),
(1164, '901056434', 'GRUPO EMPRESARIAL PAPIS S.A.S', 'BÓDEGA TURBANA B, LOTE  B PREDIO #6', 'N.N', 13001),
(1165, '900425072', 'COMERCIALIZADORA MARCAS Y ESTILOS S.A.S', 'cra 10 32 a 50 mezzanine', 'N.N', 13001),
(1166, '892200273', 'CLINICA LAS PEÑITAS SAS', 'Carrera 25 No. 23-26', '3145407294', 70001),
(1167, '901138297   ', 'CUIDAR SALUD BQ SAS', 'CRA 24 #1A - 24', '3851881', 8573),
(1168, '900345005', 'CENTRO DE DIAGNOSTICO POR LA IMAGEN SAS', 'castillogrande calle 6 #9-100 ap 12b', '3017384059', 13001),
(1169, '806 003 655-1', 'INSTITUCIÓN EDUCATIVA MANUELA VERGARA DE CURI', 'LA GAITANA MZA E LOTE 5', '3014728020', 13001),
(1170, '901848285', 'INVERSIONES CONTRERAS SERVICES SAS', 'MZ 16 LT 35 SECT. LA UNION', '3245911591', 13001),
(1171, '830113629', 'I.E Inter Eléctricas S.A.S', 'Car 12 # 13-46', '322 3712879', 11001),
(1172, '901675136', 'Comercializadora y distribuidora calcol', 'El pozon', 'N.N', 13001),
(1173, '900625129', 'H&S OCCUPATIONAL S.A.S', 'TV 54 21 A 91', 'N.N', 13001),
(1174, '901403483', 'ARANY SAS', 'CALLE 49 SUR #88 C50 - INTERIOR 84', 'N.N', 11001),
(1175, '900284600', 'FERDEL', 'Cr2 11-41 Of 24 1 Cartagena, Bolívar.', ' N.N', 13001),
(1176, '901222050', 'CI FUEL AN BÚNKER', 'CI 12 BIS #71G-53, BOGOTA ', '3148739323', 11001),
(1177, '9015667829', 'SALVADOR DE BAHIA DESARROLLOS INMOBILIARIOS SAS BOLIVAR', 'transversal 54', 'N.N', 13001),
(1178, '900771273', 'TRANSAMBIENTAL SAS', 'Urb.Anita, Diag.35 No.71-77', 'N.N', 13001),
(1179, '800249704', 'COLWAGEN S.A.S', 'Calle 127 No. 54 A -50', 'n', 13001),
(1180, '901537660', 'CEMENTO PAÍS S.A.S', 'ZONA FRANCA CRISTALINA KM 6 VEREDA AGUAS PRIETAS VIA CAMPAÑA LOTE B MZ 5 LT 1', 'N.N', 13836),
(1181, '900871515', 'SERVICIOS INDUSTRIALES Y ASESORÍAS AMBIENTALES SAS ESP', 'CARRERA 38 # 10 -36', 'N.N', 47001),
(1182, '800182498', 'INDUSTRIAS KATORI S.A.S. - INDUKATORI S.A.S.', 'Calle 17 No. 10 - 11 Piso 7', 'n', 11001),
(1183, '1044909902', 'ASOCIACIÓN ACUÍCOLA: Cosecha y Siembra de Tilapia y Cachama', 'Barrio Villas de la Candelaria Mz 25- Lt12 ', '3106477865', 13001),
(1184, '1047432074', 'SEÑAS DE SABOR: Panadería Artesanal e Inclusiva', 'PONTEZUELA CRA 7 # 1 - 62', '302 4251746', 13001),
(1185, '73169473', 'DON HOJALDRE: Panadería Saludable y Funcional', 'Urbanización Puerta de los Alpes Mz. B Lt.7', '3104756328', 13001),
(1186, '1109293326', 'System Efficiency: Implementación de Sistemas de Autogeneración Fotovoltaica para el Comercio.', 'Brrio Villa Maria M.4 C.#5', '3182500558', 73283),
(1187, '1044935756', 'MASTER-PORT COMPLIANCE: Ecosistema de Asistencia Técnica Especializada', 'ARJONA BOLIVAR, BARRIO SUEÑOS DE LIBERTAD', '1044935756', 13001),
(1188, '1042211568', 'E-FORTALEZA SOLAR: Autogeneración Residencial y Movilidad', 'Calle 6c sur No 83a-09, Urb. Colinas del Rodeo', '3014169562', 1),
(1189, '1002203141', 'CargoSync Bolívar', 'san jose de los campanos crra 101b 39 i45', '3024264241', 13001),
(1190, '1050950303', 'LOGÍSTICA AGROTURBOL: Optimización de la Cadena de Suministro Ruralg', 'TURBANA CLL 1', '3135986615', 13838),
(1191, '1128062408', 'Visual.content_media - Agencia de Contenido Audiovisual y Automatización Digital', 'Barrio la esperanza calle cubero los niños #31-05', 'N.N', 13001),
(1192, '1048610795', 'CargoSync Bolívar', 'KRA 30 C20 - 20 Santa Rosa Bolivar', 'N.N', 13683),
(1193, '1002190445', 'SGA-RESIDENCIAL: Auditoría y Control de Impactos en Propiedad Horizontal', 'CARTAGENA', 'N.N', 13001),
(1194, '1002195177', 'NHIMPO Import & Logistics', 'Nelson Mandela sector los deseos', 'N.N', 13001),
(1195, '1002202539', 'SHOE-PORT: Gestión Logística e Importación de Calzado', '\"Pasacaballos  Sector madre Herlinda Moisés  M b Lt 7\"', 'N.N', 13001),
(1196, '1104257130', 'ECO-AUDITORÍA CINAFLUP:', 'CEBALLOS SEC. NUEVO ORIENTE', 'N.N', 13001),
(1197, '901683490', 'INDUSTRIAS DE ALIMETOS EVEREST SAS', 'BOSQUE  av. PEDRO VELEZ No 48-28', 'N.N', 13001),
(1198, '901477201', 'OKEINANUS', 'Cartagena', 'N.N', 13001),
(1199, '900873623', 'Franco y Giraldo gold sas', 'Cr 65 cl 8 b 91 lc 329 ter sur', 'N.N', 1),
(1200, '901854660', 'Inversiones ganaderas SAS', 'Calle 54 no 20 32', 'N.N', 68081),
(1201, '901172720', 'Tendencys Innovations SAS', 'Calle 94A #13-72', 'N.N', 11001),
(1202, '900744408', 'Éxitos industria S. A. S', 'Carrera 48 # 32b sur - 139 piso 3 Didetexco', 'N.N', 266),
(1203, '800.186.960', 'Altipal SAS', 'Calle 18 #69b -73 Bogotá', 'N.N', 25286),
(1204, '890101897', 'Coolechera', 'Bosque, transversal 51 #21-36', 'N.N', 13001),
(1205, '900706955', 'TRANSPORTES MULTIMODALES ITUANGO S.A.S', 'CARRERA SANTANDER - Local 205- Plaza de Mercado Ernesto Gómez Echeverry Loca ITUANGO, ANTIOQUIA', 'N.N', 361),
(1206, '901.067.786', 'Gestión y Operación de la Costa S.A.S', 'CALLE 76 CR 49 8 OF 103, BARRANQUILLA, ATLANTICO', 'N.N', 8001),
(1207, '890107487', 'OLIMPICA S.A.S', 'Centro comercial plaza 90', 'N.N', 13836),
(1208, '900236520', 'CADENA COMERCIAL OXXO COLOMBIA S.A.S', 'CRA 19 N° 89 - 21', 'N.N', 11001),
(1209, '900747073', 'COMERCIALIZADORA CENTER SAS', 'via 40 # 85 - 470 local 33', '3850656', 13001),
(1210, '806006113', 'DISTRIBUCIONES UNIVERSAL LTDA', 'Dg. 22 # 51A-53', '3205216918', 13001),
(1211, '890106278', 'CASA DE LA VALVULA S.A.S. SIGLA CASAVAL S.A.S.', 'Parque industrial Clis, Bloque B, Bodega 40 Cota  Cundinamarca  Cerca a la glorieta de S', 'N.N', 8001),
(1212, '800030412', 'AKITA MOTOS S.A.', 'MEDELLIN EDIFICIO FORUM OF 2013 EL POBLADO', 'N.N', 1),
(1213, '830053812', 'CENTRAL TERMOCARTAGENA S.A.S.', 'Kilómetro 4 Vía Mamonal', 'N.N', 13001),
(1214, '900056797', 'QUIMICAS QUIMBAYA S.A.S', 'cra 18   10 76', 'N.N', 8001),
(1215, '901608343', 'SEA WOLF BARGES S.A.S', 'n.n', 'N.N', 13001),
(1216, '890480033', 'CRUZ ROJA COLOMBIANA SECCIONAL BOLIVAR', 'Barrio España Cl 30 No. 44D-71', '3168691301', 13001),
(1217, '901101733', 'ALTA MED I.P.S S.A.S', 'Carrera 49c N.º 85-17', 'N.N', 8001),
(1218, '890402556', 'JORGE GHISAYS R.E HIJOS LTDA', 'TURBACO CRA 14 A NRO 28 45', 'N.N', 13836),
(1219, '890480059', 'GOBERNACION DE BOLIVAR', 'KM 3 SECTOR EL CORTIJO', 'N.N', 13836),
(1220, '901032853-1', 'Avit Caribe SAS', 'Barrio bellavista carrera 56b 7A-30', 'N.N', 13001),
(1221, '890404531', 'CLUB NAUTICO CARTAGENA SAS', 'MANGA', 'N.N', 13001),
(1222, '800170433', 'JAY CARGO SAS', 'Calle 23N # 4-18, Barrio Versalles', 'N.N', 13001),
(1223, '900389900', 'SOLUCIONES INTEGRALES AMBIENTALES DE  COLOMBIA SIACO S.A.S.', 'BARRIO EL BOSQUE TRANSVERSAL 55 21 80 ANTIGUA ARROCERA NER', 'N.N', 13001),
(1224, '900733789', 'Cruceros y eventos de colombia', 'Calle 106 # 50-67, Local 33', 'N.N', 8001),
(1225, '860050097', 'AGENCIA DE ADUANAS ANDINOS SAS NIVEL 1                                                              ', 'Cl 84 # 42c - 50', 'N.N', 8001),
(1226, '890878989', 'INTER ASEO', 'CRESPO CRA 23', 'N.N', 13001),
(1227, '8000000', 'MAITHER LTDA', 'CARRERA 8 N 23-38 APTO 1', '30000000000', 13001);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_aprendiz`
--

CREATE TABLE `estado_aprendiz` (
  `idestado_aprendiz` int(11) NOT NULL,
  `nombre_estado_aprendiz` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `estado_aprendiz`
--

INSERT INTO `estado_aprendiz` (`idestado_aprendiz`, `nombre_estado_aprendiz`) VALUES
(1, 'CERTIFICADO'),
(2, 'EN FORMACION'),
(3, 'RETIRO VOLUNTARIO'),
(4, 'TRASLADADO'),
(5, 'CANCELADO'),
(6, 'POR CERTIFICAR'),
(7, 'CONDICIONADO'),
(8, 'APLAZADO'),
(9, 'EN PROCESO DE CERTIFICACIÓN'),
(10, 'INDUCCION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_ficha`
--

CREATE TABLE `estado_ficha` (
  `idestado_ficha` int(11) NOT NULL,
  `nombre_estado_ficha` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `estado_ficha`
--

INSERT INTO `estado_ficha` (`idestado_ficha`, `nombre_estado_ficha`) VALUES
(1, 'TERMINADA POR FECHA'),
(2, 'INDUCCIÓN'),
(3, 'EJECUCIÓN'),
(4, 'TERMINADA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_visita_seguimiento`
--

CREATE TABLE `estado_visita_seguimiento` (
  `idestado_visita_seguimiento` int(11) NOT NULL,
  `nombre_estado_visita_seguimiento` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `estado_visita_seguimiento`
--

INSERT INTO `estado_visita_seguimiento` (`idestado_visita_seguimiento`, `nombre_estado_visita_seguimiento`) VALUES
(1, 'en proceso'),
(2, 'realizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `idficha` int(11) NOT NULL,
  `numero_ficha` varchar(15) DEFAULT NULL,
  `caracterizacion` varchar(159) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin_lectiva` date DEFAULT NULL,
  `fecha_fin_practica` date DEFAULT NULL,
  `estado_ficha_idestado_ficha` int(11) NOT NULL,
  `tipo_programa_idtipo_programa` int(11) NOT NULL,
  `red_tecnologica_idred_tecnologica` int(11) NOT NULL,
  `	url_archivo_formato_165` varchar(900) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`idficha`, `numero_ficha`, `caracterizacion`, `fecha_inicio`, `fecha_fin_lectiva`, `fecha_fin_practica`, `estado_ficha_idestado_ficha`, `tipo_programa_idtipo_programa`, `red_tecnologica_idred_tecnologica`, `	url_archivo_formato_165`) VALUES
(6, '3185861', 'CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS', '2025-03-31', '2025-12-30', '2026-06-30', 3, 4, 34, ''),
(7, '2660182', 'COCINA.', '2022-10-24', '2023-07-24', '2024-01-24', 3, 5, 32, ''),
(8, '22222', 'Transporte Fluvial', '2026-06-03', '2028-09-03', '2029-03-03', 3, 3, 33, ''),
(9, '4444', 'ADSO', '2026-06-01', '2027-09-23', '2028-03-23', 3, 2, 34, ''),
(10, '3231231', 'SERVICIOS DE ALOJAMIENTO', '2025-07-25', '2026-07-24', '2027-01-24', 3, 5, 35, ''),
(11, '3231178', 'COCINA.', '2025-07-25', '2026-10-24', '2027-04-24', 3, 4, 32, ''),
(13, '3415243', 'COORDINACION DE SERVICIOS HOTELEROS', '2026-02-23', '2028-05-23', '2028-11-23', 3, 3, 36, ''),
(14, '3147643', 'ASISTENCIA ADMINISTRATIVA .', '2025-02-11', '2026-05-11', '2026-11-11', 3, 4, 37, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha_has_funcionario`
--

CREATE TABLE `ficha_has_funcionario` (
  `ficha_idficha` int(11) NOT NULL,
  `funcionario_idfuncionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funcionario`
--

CREATE TABLE `funcionario` (
  `idfuncionario` int(11) NOT NULL,
  `documento` varchar(15) DEFAULT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `direccion` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `url_foto` varchar(100) DEFAULT NULL,
  `tipo_funcionario_idtipo_funcionario` int(11) NOT NULL,
  `tipo_documento_idtipo_documento` int(11) NOT NULL,
  `municipios_codi_muni` int(11) NOT NULL,
  `ingreso` varchar(1) NOT NULL COMMENT '1 o vacio = hablilitado 2= inhabilitado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `funcionario`
--

INSERT INTO `funcionario` (`idfuncionario`, `documento`, `nombres`, `apellidos`, `direccion`, `email`, `telefono`, `password`, `url_foto`, `tipo_funcionario_idtipo_funcionario`, `tipo_documento_idtipo_documento`, `municipios_codi_muni`, `ingreso`) VALUES
(1, '1052391445', 'Marco Antonio', 'Cipagauta Arbelaez', 'Tibasosa, Boyacá ', 'jcmp.marcos@hotmail.com', '3107645964', '1n3s900731', NULL, 2, 1, 15759, '1'),
(3, '74371061', 'Gustavo', 'Jimenez', 'Carrera 12', 'gjimenezs@sena.edu.co', '3112284828', '123', NULL, 5, 1, 15759, '1'),
(5, '7931899', 'Omer Enrique', 'Rodelo Buelvas', 'barrio ternera km 1 ', 'orodelo@sena.edu.co', '3042932071', 'O7931899r', NULL, 4, 1, 13001, ''),
(6, '1065373587', 'Maither', ' Palmett  Negrete', 'Carrera 8 n 23-38 apto 1', 'mpalmett@sena.edu.co', '3005310133', 'Sena2026*', 'archivos/funcionarios/1065373587/WhatsApp Image 2026-06-03 at 9.31.02 AM.jpeg', 4, 1, 44001, ''),
(8, '9097850', 'Leandro ', 'Chavez Dumcan', 'Turbaco', 'lchavezd@sena.edu.co', '3015113645', '123321', NULL, 1, 1, 13001, '1'),
(9, '32685696', 'Clara', 'Aleman Herrera', 'Barrio ternera km1 ', 'cealeman@sena.edu.co', '3153847998', 'O7931899r', NULL, 1, 1, 13001, ''),
(10, '45526217', 'Tatiana Margarita', 'Ortega Peinado', 'Barrio ternera km1 ', 'tmortega@sena.edu.co', '3205256240', 'tati1829', NULL, 1, 1, 13001, ''),
(11, '45466075', 'Patricia', 'Jimenez Hernandez', 'Barrio ternera km1 ', 'pjimenezh@sena.edu.co', '3106019879', '45466075', NULL, 1, 1, 13001, ''),
(12, '92694359', 'Jaime Andres', 'Garcia Gomez', 'Barrio ternera km1 ', 'andgarciag@sena.edu.co', '3175171710', 'Jimycarter1#', 'archivos/funcionarios/92694359/FOTO JAIME.jpg', 1, 1, 13001, ''),
(13, '73569720', 'Eduardo', 'Villanueva Orozco', 'Barrio ternera km1 ', 'evillanueva@sena.edu.co', '3003193509', 'Evo12345678901$', 'archivos/funcionarios/73569720/3 FOTOEDUARDO VILLANUEVA OROZCO.jpg', 1, 1, 13001, ''),
(14, '73201424', 'Jose Manuel', 'Chiquillo Cortes', 'Barrio ternera km1 ', 'jmchiquillo@sena.edu.co', '3188563011', '@Daniel2020', 'archivos/funcionarios/73201424/Foto-jose jpg.png', 1, 1, 13001, ''),
(15, '23234824', 'Zulma ', 'Elles', 'Barrio ternera km1 ', 'zelles@sena.edu.co', '3103692762', 'Soporte2026.**', NULL, 1, 1, 13001, ''),
(16, '9292852', 'Jorge Luis', 'Pinedo Cabarcas', 'Barrio ternera km1 ', 'jpinedo@sena.edu.co', '3024012301', '9292852*+', NULL, 1, 1, 13001, ''),
(17, '15030258', 'Jorge Eduardo', 'Regino Lugo', 'Barrio ternera km1 ', 'jeregino@sena.edu.co', '3145495636', 'Joker1970', NULL, 1, 1, 13001, ''),
(18, '45451855', 'Sandra', 'Martinez', 'Barrio ternera km1 ', 'smartinez@sena.edu.co', '3108236767', '45451855', NULL, 1, 1, 13001, ''),
(19, '73086568', 'Juan', 'Atencio Atencio', 'Barrio ternera km1 ', 'juatencio@sena.edu.co', '3157605905', 'Juan73086568', NULL, 1, 1, 13001, ''),
(20, '45460092', 'Marelbi', 'Sarabia Serrano', 'Barrio ternera km1', 'msarabias@sena.edu.co', '3215117111', '45448000', NULL, 1, 1, 13001, ''),
(21, '73129610', 'Fidias Antonio', 'Manyoma Ledezma', 'Barrio ternera km1', 'famanyoma@sena.edu.co', '3104133591', 'Fm73129610*', NULL, 1, 1, 13001, ''),
(22, '1052391446', 'Jose Luis', 'Cipagauta ', 'Carrera 12 55-20', 'jcmp.marcos@gmail.com', '3107645965', '1n3s900731', NULL, 5, 1, 15759, ''),
(23, '1067927502', 'Adrián Esteban ', 'Fabra Diaz ', 'TERNERA CARTAGENA ', 'afabra@sena.edu.co', '3207754276', '1526347896321As@#', NULL, 1, 1, 13001, ''),
(24, '735446089', 'Bladimir José ', 'Lamadrid Sánchez', 'TERNERA CARTAGENA ', 'blamadrid@sena.edu.co', '3145772729', '735446089', NULL, 1, 1, 13001, ''),
(25, '1143380866', 'Carlos Federico ', 'Gomez Díaz ', 'TERNERA CARTAGENA ', 'Cgomezd@sena.edu.co', '1143380866', '1143380866', NULL, 1, 1, 13001, ''),
(26, '1050945862', 'Hilda ', 'Cantillo Devoz ', 'TERNERA CARTAGENA ', 'Hbcantillo@sena.edu.co', '3005091232', '1050945862', NULL, 1, 1, 13001, ''),
(27, '39621436', 'Liliana Patricia ', 'Vargas Escobar', 'TERNERA CARTAGENA', 'lipvargas@sena.edu.co', '3102530133', 'Patric&&&88888888888', 'archivos/funcionarios/39621436/VARGAS ESCOBAR LILIANA PATRICIA FOTOGRAFIA.jpg', 1, 1, 13001, ''),
(28, '73190306', 'Marco Antonio ', 'Almanza Ibarra', 'TERNERA CARTAGENA', 'malmanza@sena.edu.co', '3008086815', '73190306', NULL, 1, 1, 13001, ''),
(29, '1047399810', 'Yina Marcela ', 'Guzman Bustillo', 'TERNERA CARTAGENA', 'ymguzman@sena.edu.co', '3008810512', '1047399810', NULL, 1, 1, 13001, ''),
(30, '1047493840', 'Sebastian ', 'Diaz Fuentes', 'TERNERA CARTAGENA', 'sdiazfu@sena.edu.co', '3136532647', '1047493840', NULL, 1, 1, 13001, ''),
(31, '1007855309', 'VALENTINA ANDREA', 'OROZCO NIEVES', '54 D 1', 'orozco05valentina@gmail.com', '3174169433', '1007855309', NULL, 1, 1, 13001, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_tecnologica`
--

CREATE TABLE `linea_tecnologica` (
  `idlinea_tecnologica` int(11) NOT NULL,
  `nombre_linea_tecnologica` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `linea_tecnologica`
--

INSERT INTO `linea_tecnologica` (`idlinea_tecnologica`, `nombre_linea_tecnologica`) VALUES
(10, 'GESTION ADMINISTRATIVA Y FINANCIERA'),
(11, 'Red de Hotelería y turismo'),
(12, 'LOGISTICA Y TRANSPORTE'),
(15, 'TÉCNICO-ASISTENCIA ADMINISTRATIVA .'),
(16, 'TÉCNICO-ASESORIA COMERCIAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidad`
--

CREATE TABLE `modalidad` (
  `idmodalidad` int(11) NOT NULL,
  `nombre_modalidad` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `modalidad`
--

INSERT INTO `modalidad` (`idmodalidad`, `nombre_modalidad`) VALUES
(1, ' C. Aprendizaje'),
(2, 'Vinculo Laboral'),
(3, ' Contrato Vinculo Formativo'),
(4, 'Proyecto Productivo'),
(5, 'Monitoria');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `codi_muni` int(11) NOT NULL,
  `nomb_muni` varchar(45) DEFAULT NULL,
  `departamentos_codi_depa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`codi_muni`, `nomb_muni`, `departamentos_codi_depa`) VALUES
(1, '	MEDELLIN	', 5),
(2, '	ABEJORRAL	', 5),
(4, '	ABRIAQUI	', 5),
(21, '	ALEJANDRIA	', 5),
(30, '	AMAGA	', 5),
(31, '	AMALFI	', 5),
(34, '	ANDES	', 5),
(36, '	ANGELOPOLIS	', 5),
(38, '	ANGOSTURA	', 5),
(40, '	ANORI	', 5),
(42, '	SANTAFE DE ANTIOQUIA	', 5),
(44, '	ANZA	', 5),
(45, '	APARTADO	', 5),
(51, '	ARBOLETES	', 5),
(55, '	ARGELIA	', 5),
(59, '	ARMENIA	', 5),
(79, '	BARBOSA	', 5),
(86, '	BELMIRA	', 5),
(88, '	BELLO	', 5),
(91, '	BETANIA	', 5),
(93, '	BETULIA	', 5),
(101, '	CIUDAD BOLIVAR	', 5),
(107, '	BRICEÑO	', 5),
(113, '	BURITICA	', 5),
(120, '	CACERES	', 5),
(125, '	CAICEDO	', 5),
(129, '	CALDAS	', 5),
(134, '	CAMPAMENTO	', 5),
(138, '	CAÑASGORDAS	', 5),
(142, '	CARACOLI	', 5),
(145, '	CARAMANTA	', 5),
(147, '	CAREPA	', 5),
(148, '	EL CARMEN DE VIBORAL	', 5),
(150, '	CAROLINA	', 5),
(154, '	CAUCASIA	', 5),
(172, '	CHIGORODO	', 5),
(190, '	CISNEROS	', 5),
(197, '	COCORNA	', 5),
(206, '	CONCEPCION	', 5),
(209, '	CONCORDIA	', 5),
(212, '	COPACABANA	', 5),
(234, '	DABEIBA	', 5),
(237, '	DON MATIAS	', 5),
(240, '	EBEJICO	', 5),
(250, '	EL BAGRE	', 5),
(264, '	ENTRERRIOS	', 5),
(266, '	ENVIGADO	', 5),
(282, '	FREDONIA	', 5),
(284, '	FRONTINO	', 5),
(306, '	GIRALDO	', 5),
(308, '	GIRARDOTA	', 5),
(310, '	GOMEZ PLATA	', 5),
(313, '	GRANADA	', 5),
(315, '	GUADALUPE	', 5),
(318, '	GUARNE	', 5),
(321, '	GUATAPE	', 5),
(347, '	HELICONIA	', 5),
(353, '	HISPANIA	', 5),
(360, '	ITAGUI	', 5),
(361, '	ITUANGO	', 5),
(364, '	JARDIN	', 5),
(368, '	JERICO	', 5),
(376, '	LA CEJA	', 5),
(380, '	LA ESTRELLA	', 5),
(390, '	LA PINTADA	', 5),
(400, '	LA UNION	', 5),
(411, '	LIBORINA	', 5),
(425, '	MACEO	', 5),
(440, '	MARINILLA	', 5),
(467, '	MONTEBELLO	', 5),
(475, '	MURINDO	', 5),
(480, '	MUTATA	', 5),
(483, '	NARIÑO	', 5),
(490, '	NECOCLI	', 5),
(495, '	NECHI	', 5),
(501, '	OLAYA	', 5),
(541, '	PEÑOL	', 5),
(543, '	PEQUE	', 5),
(576, '	PUEBLORRICO	', 5),
(579, '	PUERTO BERRIO	', 5),
(585, '	PUERTO NARE	', 5),
(591, '	PUERTO TRIUNFO	', 5),
(604, '	REMEDIOS	', 5),
(607, '	RETIRO	', 5),
(615, '	RIONEGRO	', 5),
(628, '	SABANALARGA	', 5),
(631, '	SABANETA	', 5),
(642, '	SALGAR	', 5),
(647, '	SAN ANDRES	', 5),
(649, '	SAN CARLOS	', 5),
(652, '	SAN FRANCISCO	', 5),
(656, '	SAN JERONIMO	', 5),
(658, '	SAN JOSE DE LA MONTA	', 5),
(659, '	SAN JUAN DE URABA	', 5),
(660, '	SAN LUIS	', 5),
(664, '	SAN PEDRO	', 5),
(665, '	SAN PEDRO DE URABA	', 5),
(667, '	SAN RAFAEL	', 5),
(670, '	SAN ROQUE	', 5),
(674, '	SAN VICENTE	', 5),
(679, '	SANTA BARBARA	', 5),
(686, '	SANTA ROSA DE OSOS	', 5),
(690, '	SANTO DOMINGO	', 5),
(697, '	EL SANTUARIO	', 5),
(736, '	SEGOVIA	', 5),
(756, '	SONSON	', 5),
(761, '	SOPETRAN	', 5),
(789, '	TAMESIS	', 5),
(790, '	TARAZA	', 5),
(792, '	TARSO	', 5),
(809, '	TITIRIBI	', 5),
(819, '	TOLEDO	', 5),
(837, '	TURBO	', 5),
(842, '	URAMITA	', 5),
(847, '	URRAO	', 5),
(854, '	VALDIVIA	', 5),
(856, '	VALPARAISO	', 5),
(858, '	VEGACHI	', 5),
(861, '	VENECIA	', 5),
(873, '	VIGIA DEL FUERTE	', 5),
(885, '	YALI	', 5),
(887, '	YARUMAL	', 5),
(890, '	YOLOMBO	', 5),
(893, '	YONDO	', 5),
(895, '	ZARAGOZA	', 5),
(8001, '	BARRANQUILLA	', 8),
(8078, '	BARANOA	', 8),
(8137, '	CAMPO DE LA CRUZ	', 8),
(8141, '	CANDELARIA	', 8),
(8296, '	GALAPA	', 8),
(8372, '	JUAN DE ACOSTA	', 8),
(8421, '	LURUACO	', 8),
(8433, '	MALAMBO	', 8),
(8436, '	MANATI	', 8),
(8520, '	PALMAR DE VARELA	', 8),
(8549, '	PIOJO	', 8),
(8558, '	POLONUEVO	', 8),
(8560, '	PONEDERA	', 8),
(8573, '	PUERTO COLOMBIA	', 8),
(8606, '	REPELON	', 8),
(8634, '	SABANAGRANDE	', 8),
(8638, '	SABANALARGA	', 8),
(8675, '	SANTA LUCIA	', 8),
(8685, '	SANTO TOMAS	', 8),
(8758, '	SOLEDAD	', 8),
(8770, '	SUAN	', 8),
(8832, '	TUBARA	', 8),
(8849, '	USIACURI	', 8),
(11001, '	BOGOTA	', 11),
(13001, '	CARTAGENA	', 13),
(13006, '	ACHI	', 13),
(13030, '	ALTOS DEL ROSARIO	', 13),
(13042, '	ARENAL	', 13),
(13052, '	ARJONA	', 13),
(13062, '	ARROYOHONDO	', 13),
(13074, '	BARRANCO DE LOBA	', 13),
(13140, '	CALAMAR	', 13),
(13160, '	CANTAGALLO	', 13),
(13188, '	CICUCO	', 13),
(13212, '	Cordoba	', 13),
(13222, '	CLEMENCIA	', 13),
(13244, '	EL CARMEN DE BOLIVAR	', 13),
(13248, '	EL GUAMO	', 13),
(13268, '	EL PEÑON	', 13),
(13300, '	HATILLO DE LOBA	', 13),
(13430, '	MAGANGUE	', 13),
(13433, '	MAHATES	', 13),
(13440, '	MARGARITA	', 13),
(13442, '	MARIA LA BAJA	', 13),
(13458, '	MONTECRISTO	', 13),
(13468, '	MOMPOS	', 13),
(13473, '	MORALES	', 13),
(13549, '	PINILLOS	', 13),
(13580, '	REGIDOR	', 13),
(13600, '	RIO VIEJO	', 13),
(13620, '	SAN CRISTOBAL	', 13),
(13647, '	SAN ESTANISLAO	', 13),
(13650, '	SAN FERNANDO	', 13),
(13654, '	SAN JACINTO	', 13),
(13655, '	SAN JACINTO DEL CAUCA	', 13),
(13657, '	SAN JUAN NEPOMUCENO	', 13),
(13667, '	SAN MARTIN DE LOBA	', 13),
(13670, '	SAN PABLO	', 13),
(13673, '	SANTA CATALINA	', 13),
(13683, '	SANTA ROSA	', 13),
(13688, '	SANTA ROSA DEL SUR	', 13),
(13744, '	SIMITI	', 13),
(13760, '	SOPLAVIENTO	', 13),
(13780, '	TALAIGUA NUEVO	', 13),
(13810, '	TIQUISIO	', 13),
(13836, '	TURBACO	', 13),
(13838, '	TURBANA	', 13),
(13873, '	VILLANUEVA	', 13),
(13894, '	ZAMBRANO	', 13),
(15001, '	TUNJA	', 15),
(15022, '	ALMEIDA	', 15),
(15047, '	AQUITANIA	', 15),
(15051, '	ARCABUCO	', 15),
(15087, '	BELEN	', 15),
(15090, '	BERBEO	', 15),
(15092, '	BETEITIVA	', 15),
(15097, '	BOAVITA	', 15),
(15104, '	BOYACA	', 15),
(15106, '	BRICEÑO	', 15),
(15109, '	BUENAVISTA	', 15),
(15114, '	BUSBANZA	', 15),
(15131, '	CALDAS	', 15),
(15135, '	CAMPOHERMOSO	', 15),
(15162, '	CERINZA	', 15),
(15172, '	CHINAVITA	', 15),
(15176, '	CHIQUINQUIRA	', 15),
(15180, '	CHISCAS	', 15),
(15183, '	CHITA	', 15),
(15185, '	CHITARAQUE	', 15),
(15187, '	CHIVATA	', 15),
(15189, '	CIENEGA	', 15),
(15204, '	COMBITA	', 15),
(15212, '	COPER	', 15),
(15215, '	CORRALES	', 15),
(15218, '	COVARACHIA	', 15),
(15223, '	CUBARA	', 15),
(15224, '	CUCAITA	', 15),
(15226, '	CUITIVA	', 15),
(15232, '	CHIQUIZA	', 15),
(15236, '	CHIVOR	', 15),
(15238, '	DUITAMA	', 15),
(15244, '	EL COCUY	', 15),
(15248, '	EL ESPINO	', 15),
(15272, '	FIRAVITOBA	', 15),
(15276, '	FLORESTA	', 15),
(15293, '	GACHANTIVA	', 15),
(15296, '	GAMEZA	', 15),
(15299, '	GARAGOA	', 15),
(15317, '	GUACAMAYAS	', 15),
(15322, '	GUATEQUE	', 15),
(15325, '	GUAYATA	', 15),
(15332, '	GÜICAN	', 15),
(15362, '	IZA	', 15),
(15367, '	JENESANO	', 15),
(15368, '	JERICO	', 15),
(15377, '	LABRANZAGRANDE	', 15),
(15380, '	LA CAPILLA	', 15),
(15401, '	LA VICTORIA	', 15),
(15403, '	LA UVITA	', 15),
(15407, '	VILLA DE LEYVA	', 15),
(15425, '	MACANAL	', 15),
(15442, '	MARIPI	', 15),
(15455, '	MIRAFLORES	', 15),
(15464, '	MONGUA	', 15),
(15466, '	MONGUI	', 15),
(15469, '	MONIQUIRA	', 15),
(15476, '	MOTAVITA	', 15),
(15480, '	MUZO	', 15),
(15491, '	NOBSA	', 15),
(15494, '	NUEVO COLON	', 15),
(15500, '	OICATA	', 15),
(15507, '	OTANCHE	', 15),
(15511, '	PACHAVITA	', 15),
(15514, '	PAEZ	', 15),
(15516, '	PAIPA	', 15),
(15518, '	PAJARITO	', 15),
(15522, '	PANQUEBA	', 15),
(15531, '	PAUNA	', 15),
(15533, '	PAYA	', 15),
(15537, '	PAZ DE RIO	', 15),
(15542, '	PESCA	', 15),
(15550, '	PISBA	', 15),
(15572, '	PUERTO BOYACA	', 15),
(15580, '	QUIPAMA	', 15),
(15599, '	RAMIRIQUI	', 15),
(15600, '	RAQUIRA	', 15),
(15621, '	RONDON	', 15),
(15632, '	SABOYA	', 15),
(15638, '	SACHICA	', 15),
(15646, '	SAMACA	', 15),
(15660, '	SAN EDUARDO	', 15),
(15664, '	SAN JOSE DE PARE	', 15),
(15667, '	SAN LUIS DE GACENO	', 15),
(15673, '	SAN MATEO	', 15),
(15676, '	SAN MIGUEL DE SEMA	', 15),
(15681, '	SAN PABLO DE BORBUR	', 15),
(15686, '	SANTANA	', 15),
(15690, '	SANTA MARIA	', 15),
(15693, '	SANTA ROSA DE VITERBO	', 15),
(15696, '	SANTA SOFIA	', 15),
(15720, '	SATIVANORTE	', 15),
(15723, '	SATIVASUR	', 15),
(15740, '	SIACHOQUE	', 15),
(15753, '	SOATA	', 15),
(15755, '	SOCOTA	', 15),
(15757, '	SOCHA	', 15),
(15759, '	SOGAMOSO	', 15),
(15761, '	SOMONDOCO	', 15),
(15762, '	SORA	', 15),
(15763, '	SOTAQUIRA	', 15),
(15764, '	SORACA	', 15),
(15774, '	SUSACON	', 15),
(15776, '	SUTAMARCHAN	', 15),
(15778, '	SUTATENZA	', 15),
(15790, '	TASCO	', 15),
(15798, '	TENZA	', 15),
(15804, '	TIBANA	', 15),
(15806, '	TIBASOSA	', 15),
(15808, '	TINJACA	', 15),
(15810, '	TIPACOQUE	', 15),
(15814, '	TOCA	', 15),
(15816, '	TOGÜI	', 15),
(15820, '	TOPAGA	', 15),
(15822, '	TOTA	', 15),
(15832, '	TUNUNGUA	', 15),
(15835, '	TURMEQUE	', 15),
(15837, '	TUTA	', 15),
(15839, '	TUTAZA	', 15),
(15842, '	UMBITA	', 15),
(15861, '	VENTAQUEMADA	', 15),
(15879, '	VIRACACHA	', 15),
(15897, '	ZETAQUIRA	', 15),
(17001, '	MANIZALES	', 17),
(17013, '	AGUADAS	', 17),
(17042, '	ANSERMA	', 17),
(17050, '	ARANZAZU	', 17),
(17088, '	BELALCAZAR	', 17),
(17174, '	CHINCHINA	', 17),
(17272, '	FILADELFIA	', 17),
(17380, '	LA DORADA	', 17),
(17388, '	LA MERCED	', 17),
(17433, '	MANZANARES	', 17),
(17442, '	MARMATO	', 17),
(17444, '	MARQUETALIA	', 17),
(17446, '	MARULANDA	', 17),
(17486, '	NEIRA	', 17),
(17495, '	NORCASIA	', 17),
(17513, '	PACORA	', 17),
(17524, '	PALESTINA	', 17),
(17541, '	PENSILVANIA	', 17),
(17614, '	RIOSUCIO	', 17),
(17616, '	RISARALDA	', 17),
(17653, '	SALAMINA	', 17),
(17662, '	SAMANA	', 17),
(17665, '	SAN JOSE	', 17),
(17777, '	SUPIA	', 17),
(17867, '	VICTORIA	', 17),
(17873, '	VILLAMARIA	', 17),
(17877, '	VITERBO	', 17),
(18001, '	FLORENCIA	', 18),
(18029, '	ALBANIA	', 18),
(18094, '	BELEN DE LOS ANDAQUI	', 18),
(18150, '	CARTAGENA DEL CHAIRA	', 18),
(18205, '	CURILLO	', 18),
(18247, '	EL DONCELLO	', 18),
(18256, '	EL PAUJIL	', 18),
(18410, '	LA MONTAÑITA	', 18),
(18460, '	MILAN	', 18),
(18479, '	MORELIA	', 18),
(18592, '	PUERTO RICO	', 18),
(18610, '	SAN JOSE DEL FRAGUA	', 18),
(18753, '	SAN VICENTE DEL CAGUAN	', 18),
(18756, '	SOLANO	', 18),
(18785, '	SOLITA	', 18),
(18860, '	VALPARAISO	', 18),
(19001, '	POPAYAN	', 19),
(19022, '	ALMAGUER	', 19),
(19050, '	ARGELIA	', 19),
(19075, '	BALBOA	', 19),
(19100, '	BOLIVAR	', 19),
(19110, '	BUENOS AIRES	', 19),
(19130, '	CAJIBIO	', 19),
(19137, '	CALDONO	', 19),
(19142, '	CALOTO	', 19),
(19212, '	CORINTO	', 19),
(19256, '	EL TAMBO	', 19),
(19290, '	FLORENCIA	', 19),
(19318, '	GUAPI	', 19),
(19355, '	INZA	', 19),
(19364, '	JAMBALO	', 19),
(19392, '	LA SIERRA	', 19),
(19397, '	LA VEGA	', 19),
(19418, '	LOPEZ	', 19),
(19450, '	MERCADERES	', 19),
(19455, '	MIRANDA	', 19),
(19473, '	MORALES	', 19),
(19513, '	PADILLA	', 19),
(19517, '	PAEZ	', 19),
(19532, '	PATIA	', 19),
(19533, '	PIAMONTE	', 19),
(19548, '	PIENDAMO	', 19),
(19573, '	PUERTO TEJADA	', 19),
(19585, '	PURACE	', 19),
(19622, '	ROSAS	', 19),
(19693, '	SAN SEBASTIAN	', 19),
(19698, '	SANTANDER DE QUILICHAO	', 19),
(19701, '	SANTA ROSA	', 19),
(19743, '	SILVIA	', 19),
(19760, '	SOTARA	', 19),
(19780, '	SUAREZ	', 19),
(19785, '	SUCRE	', 19),
(19807, '	TIMBIO	', 19),
(19809, '	TIMBIQUI	', 19),
(19821, '	TORIBIO	', 19),
(19824, '	TOTORO	', 19),
(19845, '	VILLA RICA	', 19),
(20001, '	VALLEDUPAR	', 20),
(20011, '	AGUACHICA	', 20),
(20013, '	AGUSTIN CODAZZI	', 20),
(20032, '	ASTREA	', 20),
(20045, '	BECERRIL	', 20),
(20060, '	BOSCONIA	', 20),
(20175, '	CHIMICHAGUA	', 20),
(20178, '	CHIRIGUANA	', 20),
(20228, '	CURUMANI	', 20),
(20238, '	EL COPEY	', 20),
(20250, '	EL PASO	', 20),
(20295, '	GAMARRA	', 20),
(20310, '	GONZALEZ	', 20),
(20383, '	LA GLORIA	', 20),
(20400, '	LA JAGUA DE IBIRICO	', 20),
(20443, '	MANAURE	', 20),
(20517, '	PAILITAS	', 20),
(20550, '	PELAYA	', 20),
(20570, '	PUEBLO BELLO	', 20),
(20614, '	RIO DE ORO	', 20),
(20621, '	LA PAZ	', 20),
(20710, '	SAN ALBERTO	', 20),
(20750, '	SAN DIEGO	', 20),
(20770, '	SAN MARTIN	', 20),
(20787, '	TAMALAMEQUE	', 20),
(23001, '	MONTERIA	', 23),
(23068, '	AYAPEL	', 23),
(23079, '	BUENAVISTA	', 23),
(23090, '	CANALETE	', 23),
(23162, '	CERETE	', 23),
(23168, '	CHIMA	', 23),
(23182, '	CHINU	', 23),
(23189, '	CIENAGA DE ORO	', 23),
(23300, '	COTORRA	', 23),
(23350, '	LA APARTADA	', 23),
(23417, '	LORICA	', 23),
(23419, '	LOS CordobaS	', 23),
(23464, '	MOMIL	', 23),
(23466, '	MONTELIBANO	', 23),
(23500, '	MOÑITOS	', 23),
(23555, '	PLANETA RICA	', 23),
(23570, '	PUEBLO NUEVO	', 23),
(23574, '	PUERTO ESCONDIDO	', 23),
(23580, '	PUERTO LIBERTADOR	', 23),
(23586, '	PURISIMA	', 23),
(23660, '	SAHAGUN	', 23),
(23670, '	SAN ANDRES SOTAVENTO	', 23),
(23672, '	SAN ANTERO	', 23),
(23675, '	SAN BERNARDO DEL VIENTO	', 23),
(23678, '	SAN CARLOS	', 23),
(23686, '	SAN PELAYO	', 23),
(23807, '	TIERRALTA	', 23),
(23855, '	VALENCIA	', 23),
(25001, '	AGUA DE DIOS	', 25),
(25019, '	ALBAN	', 25),
(25035, '	ANAPOIMA	', 25),
(25040, '	ANOLAIMA	', 25),
(25053, '	ARBELAEZ	', 25),
(25086, '	BELTRAN	', 25),
(25095, '	BITUIMA	', 25),
(25099, '	BOJACA	', 25),
(25120, '	CABRERA	', 25),
(25123, '	CACHIPAY	', 25),
(25126, '	CAJICA	', 25),
(25148, '	CAPARRAPI	', 25),
(25151, '	CAQUEZA	', 25),
(25154, '	CARMEN DE CARUPA	', 25),
(25168, '	CHAGUANI	', 25),
(25175, '	CHIA	', 25),
(25178, '	CHIPAQUE	', 25),
(25181, '	CHOACHI	', 25),
(25183, '	ChocoNTA	', 25),
(25200, '	COGUA	', 25),
(25214, '	COTA	', 25),
(25224, '	CUCUNUBA	', 25),
(25245, '	EL COLEGIO	', 25),
(25258, '	EL PEÑON	', 25),
(25260, '	EL ROSAL	', 25),
(25269, '	FACATATIVA	', 25),
(25279, '	FOMEQUE	', 25),
(25281, '	FOSCA	', 25),
(25286, '	FUNZA	', 25),
(25288, '	FUQUENE	', 25),
(25290, '	FUSAGASUGA	', 25),
(25293, '	GACHALA	', 25),
(25295, '	GACHANCIPA	', 25),
(25297, '	GACHETA	', 25),
(25299, '	GAMA	', 25),
(25307, '	GIRARDOT	', 25),
(25312, '	GRANADA	', 25),
(25317, '	GUACHETA	', 25),
(25320, '	GUADUAS	', 25),
(25322, '	GUASCA	', 25),
(25324, '	GUATAQUI	', 25),
(25326, '	GUATAVITA	', 25),
(25328, '	GUAYABAL DE SIQUIMA	', 25),
(25335, '	GUAYABETAL	', 25),
(25339, '	GUTIERREZ	', 25),
(25368, '	JERUSALEN	', 25),
(25372, '	JUNIN	', 25),
(25377, '	LA CALERA	', 25),
(25386, '	LA MESA	', 25),
(25394, '	LA PALMA	', 25),
(25398, '	LA PEÑA	', 25),
(25402, '	LA VEGA	', 25),
(25407, '	LENGUAZAQUE	', 25),
(25426, '	MACHETA	', 25),
(25430, '	MADRID	', 25),
(25436, '	MANTA	', 25),
(25438, '	MEDINA	', 25),
(25473, '	MOSQUERA	', 25),
(25483, '	NARIÑO	', 25),
(25486, '	NEMOCON	', 25),
(25488, '	NILO	', 25),
(25489, '	NIMAIMA	', 25),
(25491, '	NOCAIMA	', 25),
(25506, '	VENECIA	', 25),
(25513, '	PACHO	', 25),
(25518, '	PAIME	', 25),
(25524, '	PANDI	', 25),
(25530, '	PARATEBUENO	', 25),
(25535, '	PASCA	', 25),
(25572, '	PUERTO SALGAR	', 25),
(25580, '	PULI	', 25),
(25592, '	QUEBRADANEGRA	', 25),
(25594, '	QUETAME	', 25),
(25596, '	QUIPILE	', 25),
(25599, '	APULO	', 25),
(25612, '	RICAURTE	', 25),
(25645, '	SAN ANTONIO DEL TEQUENDAMA	', 25),
(25649, '	SAN BERNARDO	', 25),
(25653, '	SAN CAYETANO	', 25),
(25658, '	SAN FRANCISCO	', 25),
(25662, '	SAN JUAN DE RIO SECO	', 25),
(25718, '	SASAIMA	', 25),
(25736, '	SESQUILE	', 25),
(25740, '	SIBATE	', 25),
(25743, '	SILVANIA	', 25),
(25745, '	SIMIJACA	', 25),
(25754, '	SOACHA	', 25),
(25758, '	SOPO	', 25),
(25769, '	SUBACHOQUE	', 25),
(25772, '	SUESCA	', 25),
(25777, '	SUPATA	', 25),
(25779, '	SUSA	', 25),
(25781, '	SUTATAUSA	', 25),
(25785, '	TABIO	', 25),
(25793, '	TAUSA	', 25),
(25797, '	TENA	', 25),
(25799, '	TENJO	', 25),
(25805, '	TIBACUY	', 25),
(25807, '	TIBIRITA	', 25),
(25815, '	TOCAIMA	', 25),
(25817, '	TOCANCIPA	', 25),
(25823, '	TOPAIPI	', 25),
(25839, '	UBALA	', 25),
(25841, '	UBAQUE	', 25),
(25843, '	VILLA DE SAN DIEGO DE UBATE	', 25),
(25845, '	UNE	', 25),
(25851, '	UTICA	', 25),
(25862, '	VERGARA	', 25),
(25867, '	VIANI	', 25),
(25871, '	VILLAGOMEZ	', 25),
(25873, '	VILLAPINZON	', 25),
(25875, '	VILLETA	', 25),
(25878, '	VIOTA	', 25),
(25885, '	YACOPI	', 25),
(25898, '	ZIPACON	', 25),
(25899, '	ZIPAQUIRA	', 25),
(27001, '	QUIBDO	', 27),
(27006, '	ACANDI	', 27),
(27025, '	ALTO BAUDO	', 27),
(27050, '	ATRATO	', 27),
(27073, '	BAGADO	', 27),
(27075, '	BAHIA SOLANO	', 27),
(27077, '	BAJO BAUDO	', 27),
(27086, '	BELEN DE BAJIRA	', 27),
(27099, '	BOJAYA	', 27),
(27135, '	EL CANTON DEL SAN PABLO	', 27),
(27150, '	CARMEN DEL DARIEN	', 27),
(27160, '	CERTEGUI	', 27),
(27205, '	CONDOTO	', 27),
(27245, '	EL CARMEN DE ATRATO	', 27),
(27250, '	EL LITORAL DEL SAN JUAN	', 27),
(27361, '	ISTMINA	', 27),
(27372, '	JURADO	', 27),
(27413, '	LLORO	', 27),
(27425, '	MEDIO ATRATO	', 27),
(27430, '	MEDIO BAUDO	', 27),
(27450, '	MEDIO SAN JUAN	', 27),
(27491, '	NOVITA	', 27),
(27495, '	NUQUI	', 27),
(27580, '	RIO IRO	', 27),
(27600, '	RIO QUITO	', 27),
(27615, '	RIOSUCIO	', 27),
(27660, '	SAN JOSE DEL PALMAR	', 27),
(27745, '	SIPI	', 27),
(27787, '	TADO	', 27),
(27800, '	UNGUIA	', 27),
(27810, '	UNION PANAMERICANA	', 27),
(41001, '	NEIVA	', 41),
(41006, '	ACEVEDO	', 41),
(41013, '	AGRADO	', 41),
(41016, '	AIPE	', 41),
(41020, '	ALGECIRAS	', 41),
(41026, '	ALTAMIRA	', 41),
(41078, '	BARAYA	', 41),
(41132, '	CAMPOALEG ', 41),
(41206, '	COLOMBIA	', 41),
(41244, '	ELIAS	', 41),
(41298, '	GARZON	', 41),
(41306, '	GIGANTE	', 41),
(41319, '	GUADALUPE	', 41),
(41349, '	HOBO	', 41),
(41357, '	IQUIRA	', 41),
(41359, '	ISNOS	', 41),
(41378, '	LA ARGENTINA	', 41),
(41396, '	LA PLATA	', 41),
(41483, '	NATAGA	', 41),
(41503, '	OPORAPA	', 41),
(41518, '	PAICOL	', 41),
(41524, '	PALERMO	', 41),
(41530, '	PALESTINA	', 41),
(41548, '	PITAL	', 41),
(41551, '	PITALITO	', 41),
(41615, '	RIVERA	', 41),
(41660, '	SALADOBLANCO	', 41),
(41668, '	SAN AGUSTIN	', 41),
(41676, '	SANTA MARIA	', 41),
(41770, '	SUAZA	', 41),
(41791, '	TARQUI	', 41),
(41797, '	TESALIA	', 41),
(41799, '	TELLO	', 41),
(41801, '	TERUEL	', 41),
(41807, '	TIMANA	', 41),
(41872, '	VILLAVIEJA	', 41),
(41885, '	YAGUARA	', 41),
(44001, '	RIOHACHA	', 44),
(44035, '	ALBANIA	', 44),
(44078, '	BARRANCAS	', 44),
(44090, '	DIBULLA	', 44),
(44098, '	DISTRACCION	', 44),
(44110, '	EL MOLINO	', 44),
(44279, '	FONSECA	', 44),
(44378, '	HATONUEVO	', 44),
(44420, '	LA JAGUA DEL PILAR	', 44),
(44430, '	MAICAO	', 44),
(44560, '	MANAURE	', 44),
(44650, '	SAN JUAN DEL CESAR	', 44),
(44847, '	URIBIA	', 44),
(44855, '	URUMITA	', 44),
(44874, '	VILLANUEVA	', 44),
(47001, '	SANTA MARTA	', 47),
(47030, '	ALGARROBO	', 47),
(47053, '	ARACATACA	', 47),
(47058, '	ARIGUANI	', 47),
(47161, '	CERRO SAN ANTONIO	', 47),
(47170, '	CHIBOLO	', 47),
(47189, '	CIENAGA	', 47),
(47205, '	CONCORDIA	', 47),
(47245, '	EL BANCO	', 47),
(47258, '	EL PIÑON	', 47),
(47268, '	EL RETEN	', 47),
(47288, '	FUNDACION	', 47),
(47318, '	GUAMAL	', 47),
(47460, '	NUEVA GRANADA	', 47),
(47541, '	PEDRAZA	', 47),
(47545, '	PIJIÑO DEL CARMEN	', 47),
(47551, '	PIVIJAY	', 47),
(47555, '	PLATO	', 47),
(47570, '	PUEBLOVIEJO	', 47),
(47605, '	REMOLINO	', 47),
(47660, '	SABANAS DE SAN ANGEL	', 47),
(47675, '	SALAMINA	', 47),
(47692, '	SAN SEBASTIAN DE BUENAVISTA	', 47),
(47703, '	SAN ZENON	', 47),
(47707, '	SANTA ANA	', 47),
(47720, '	SANTA BARBARA DE PINTO	', 47),
(47745, '	SITIONUEVO	', 47),
(47798, '	TENERIFE	', 47),
(47960, '	ZAPAYAN	', 47),
(47980, '	ZONA BANANERA	', 47),
(50001, '	VILLAVICENCIO	', 50),
(50006, '	ACACIAS	', 50),
(50110, '	BARRANCA DE UPIA	', 50),
(50124, '	CABUYARO	', 50),
(50150, '	CASTILLA LA NUEVA	', 50),
(50223, '	CUBARRAL	', 50),
(50226, '	CUMARAL	', 50),
(50245, '	EL CALVARIO	', 50),
(50251, '	EL CASTILLO	', 50),
(50270, '	EL DORADO	', 50),
(50287, '	FUENTE DE ORO	', 50),
(50313, '	GRANADA	', 50),
(50318, '	GUAMAL	', 50),
(50325, '	MAPIRIPAN	', 50),
(50330, '	MESETAS	', 50),
(50350, '	LA MACARENA	', 50),
(50370, '	URIBE	', 50),
(50400, '	LEJANIAS	', 50),
(50450, '	PUERTO CONCORDIA	', 50),
(50568, '	PUERTO GAITAN	', 50),
(50573, '	PUERTO LOPEZ	', 50),
(50577, '	PUERTO LLERAS	', 50),
(50590, '	PUERTO RICO	', 50),
(50606, '	RESTREPO	', 50),
(50680, '	SAN CARLOS DE GUAROA	', 50),
(50683, '	SAN JUAN DE ARAMA	', 50),
(50686, '	SAN JUANITO	', 50),
(50689, '	SAN MARTIN	', 50),
(50711, '	VISTAHERMOSA	', 50),
(52001, '	PASTO	', 52),
(52019, '	ALBAN	', 52),
(52022, '	ALDANA	', 52),
(52036, '	ANCUYA	', 52),
(52051, '	ARBOLEDA	', 52),
(52079, '	BARBACOAS	', 52),
(52083, '	BELEN	', 52),
(52110, '	BUESACO	', 52),
(52203, '	COLON	', 52),
(52207, '	CONSACA	', 52),
(52210, '	CONTADERO	', 52),
(52215, '	Cordoba	', 52),
(52224, '	CUASPUD	', 52),
(52227, '	CUMBAL	', 52),
(52233, '	CUMBITARA	', 52),
(52240, '	CHACHAGÜI	', 52),
(52250, '	EL CHARCO	', 52),
(52254, '	EL PEÑOL	', 52),
(52256, '	EL ROSARIO	', 52),
(52258, '	EL TABLON DE GOMEZ	', 52),
(52260, '	EL TAMBO	', 52),
(52287, '	FUNES	', 52),
(52317, '	GUACHUCAL	', 52),
(52320, '	GUAITARILLA	', 52),
(52323, '	GUALMATAN	', 52),
(52352, '	ILES	', 52),
(52354, '	IMUES	', 52),
(52356, '	IPIALES	', 52),
(52378, '	LA CRUZ	', 52),
(52381, '	LA FLORIDA	', 52),
(52385, '	LA LLANADA	', 52),
(52390, '	LA TOLA	', 52),
(52399, '	LA UNION	', 52),
(52405, '	LEIVA	', 52),
(52411, '	LINARES	', 52),
(52418, '	LOS ANDES	', 52),
(52427, '	MAGÜI	', 52),
(52435, '	MALLAMA	', 52),
(52473, '	MOSQUERA	', 52),
(52480, '	NARIÑO	', 52),
(52490, '	OLAYA HERRERA	', 52),
(52506, '	OSPINA	', 52),
(52520, '	FRANCISCO PIZARRO	', 52),
(52540, '	POLICARPA	', 52),
(52560, '	POTOSI	', 52),
(52565, '	PROVIDENCIA	', 52),
(52573, '	PUERRES	', 52),
(52585, '	PUPIALES	', 52),
(52612, '	RICAURTE	', 52),
(52621, '	ROBERTO PAYAN	', 52),
(52678, '	SAMANIEGO	', 52),
(52683, '	SANDONA	', 52),
(52685, '	SAN BERNARDO	', 52),
(52687, '	SAN LORENZO	', 52),
(52693, '	SAN PABLO	', 52),
(52694, '	SAN PEDRO DE CARTAGO	', 52),
(52696, '	SANTA BARBARA	', 52),
(52699, '	SANTACRUZ	', 52),
(52720, '	SAPUYES	', 52),
(52786, '	TAMINANGO	', 52),
(52788, '	TANGUA	', 52),
(52835, '	TUMACO	', 52),
(52838, '	TUQUERRES	', 52),
(52885, '	YACUANQUER	', 52),
(54001, '	CUCUTA	', 54),
(54003, '	ABREGO	', 54),
(54051, '	ARBOLEDAS	', 54),
(54099, '	BOCHALEMA	', 54),
(54109, '	BUCARASICA	', 54),
(54125, '	CACOTA	', 54),
(54128, '	CACHIRA	', 54),
(54172, '	CHINACOTA	', 54),
(54174, '	CHITAGA	', 54),
(54206, '	CONVENCION	', 54),
(54223, '	CUCUTILLA	', 54),
(54239, '	DURANIA	', 54),
(54245, '	EL CARMEN	', 54),
(54250, '	EL TARRA	', 54),
(54261, '	EL ZULIA	', 54),
(54313, '	GRAMALOTE	', 54),
(54344, '	HACARI	', 54),
(54347, '	HERRAN	', 54),
(54377, '	LABATECA	', 54),
(54385, '	LA ESPERANZA	', 54),
(54398, '	LA PLAYA	', 54),
(54405, '	LOS PATIOS	', 54),
(54418, '	LOURDES	', 54),
(54480, '	MUTISCUA	', 54),
(54498, '	OCAÑA	', 54),
(54518, '	PAMPLONA	', 54),
(54520, '	PAMPLONITA	', 54),
(54553, '	PUERTO SANTANDER	', 54),
(54599, '	RAGONVALIA	', 54),
(54660, '	SALAZAR	', 54),
(54670, '	SAN CALIXTO	', 54),
(54673, '	SAN CAYETANO	', 54),
(54680, '	SANTIAGO	', 54),
(54720, '	SARDINATA	', 54),
(54743, '	SILOS	', 54),
(54800, '	TEORAMA	', 54),
(54810, '	TIBU	', 54),
(54820, '	TOLEDO	', 54),
(54871, '	VILLA CARO	', 54),
(54874, '	VILLA DEL ROSARIO	', 54),
(63001, '	ARMENIA	', 63),
(63111, '	BUENAVISTA	', 63),
(63130, '	CALARCA	', 63),
(63190, '	CIRCASIA	', 63),
(63212, '	Cordoba	', 63),
(63272, '	FILANDIA	', 63),
(63302, '	GENOVA	', 63),
(63401, '	LA TEBAIDA	', 63),
(63470, '	MONTENEGRO	', 63),
(63548, '	PIJAO	', 63),
(63594, '	QUIMBAYA	', 63),
(63690, '	SALENTO	', 63),
(66001, '	PEREIRA	', 66),
(66045, '	APIA	', 66),
(66075, '	BALBOA	', 66),
(66088, '	BELEN DE UMBRIA	', 66),
(66170, '	DOSQUEBRADAS	', 66),
(66318, '	GUATICA	', 66),
(66383, '	LA CELIA	', 66),
(66400, '	LA VIRGINIA	', 66),
(66440, '	MARSELLA	', 66),
(66456, '	MISTRATO	', 66),
(66572, '	PUEBLO RICO	', 66),
(66594, '	QUINCHIA	', 66),
(66682, '	SANTA ROSA DE CABAL	', 66),
(66687, '	SANTUARIO	', 66),
(68001, '	BUCARAMANGA	', 68),
(68013, '	AGUADA	', 68),
(68020, '	ALBANIA	', 68),
(68051, '	ARATOCA	', 68),
(68077, '	BARBOSA	', 68),
(68079, '	BARICHARA	', 68),
(68081, '	BARRANCABERMEJA	', 68),
(68092, '	BETULIA	', 68),
(68101, '	BOLIVAR	', 68),
(68121, '	CABRERA	', 68),
(68132, '	CALIFORNIA	', 68),
(68147, '	CAPITANEJO	', 68),
(68152, '	CARCASI	', 68),
(68160, '	CEPITA	', 68),
(68162, '	CERRITO	', 68),
(68167, '	CHARALA	', 68),
(68169, '	CHARTA	', 68),
(68176, '	CHIMA	', 68),
(68179, '	CHIPATA	', 68),
(68190, '	CIMITARRA	', 68),
(68207, '	CONCEPCION	', 68),
(68209, '	CONFINES	', 68),
(68211, '	CONTRATACION	', 68),
(68217, '	COROMORO	', 68),
(68229, '	CURITI	', 68),
(68235, '	EL CARMEN DE CHUCURI	', 68),
(68245, '	EL GUACAMAYO	', 68),
(68250, '	EL PEÑON	', 68),
(68255, '	EL PLAYON	', 68),
(68264, '	ENCINO	', 68),
(68266, '	ENCISO	', 68),
(68271, '	FLORIAN	', 68),
(68276, '	FLORIDABLANCA	', 68),
(68296, '	GALAN	', 68),
(68298, '	GAMBITA	', 68),
(68307, '	GIRON	', 68),
(68318, '	GUACA	', 68),
(68320, '	GUADALUPE	', 68),
(68322, '	GUAPOTA	', 68),
(68324, '	GUAVATA	', 68),
(68327, '	GÜEPSA	', 68),
(68344, '	HATO	', 68),
(68368, '	JESUS MARIA	', 68),
(68370, '	JORDAN	', 68),
(68377, '	LA BELLEZA	', 68),
(68385, '	LANDAZURI	', 68),
(68397, '	LA PAZ	', 68),
(68406, '	LEBRIJA	', 68),
(68418, '	LOS SANTOS	', 68),
(68425, '	MACARAVITA	', 68),
(68432, '	MALAGA	', 68),
(68444, '	MATANZA	', 68),
(68464, '	MOGOTES	', 68),
(68468, '	MOLAGAVITA	', 68),
(68498, '	OCAMONTE	', 68),
(68500, '	OIBA	', 68),
(68502, '	ONZAGA	', 68),
(68522, '	PALMAR	', 68),
(68524, '	PALMAS DEL SOCORRO	', 68),
(68533, '	PARAMO	', 68),
(68547, '	PIEDECUESTA	', 68),
(68549, '	PINCHOTE	', 68),
(68572, '	PUENTE NACIONAL	', 68),
(68573, '	PUERTO PARRA	', 68),
(68575, '	PUERTO WILCHES	', 68),
(68615, '	RIONEGRO	', 68),
(68655, '	SABANA DE TORRES	', 68),
(68669, '	SAN ANDRES	', 68),
(68673, '	SAN BENITO	', 68),
(68679, '	SAN GIL	', 68),
(68682, '	SAN JOAQUIN	', 68),
(68684, '	SAN JOSE DE MIRANDA	', 68),
(68686, '	SAN MIGUEL	', 68),
(68689, '	SAN VICENTE DE CHUCU	', 68),
(68705, '	SANTA BARBARA	', 68),
(68720, '	SANTA HELENA DEL OPON	', 68),
(68745, '	SIMACOTA	', 68),
(68755, '	SOCORRO	', 68),
(68770, '	SUAITA	', 68),
(68773, '	SUCRE	', 68),
(68780, '	SURATA	', 68),
(68820, '	TONA	', 68),
(68855, '	VALLE DE SAN JOSE	', 68),
(68861, '	VELEZ	', 68),
(68867, '	VETAS	', 68),
(68872, '	VILLANUEVA	', 68),
(68895, '	ZAPATOCA	', 68),
(70001, '	SINCELEJO	', 70),
(70110, '	BUENAVISTA	', 70),
(70124, '	CAIMITO	', 70),
(70204, '	COLOSO	', 70),
(70215, '	COROZAL	', 70),
(70221, '	COVEÑAS	', 70),
(70230, '	CHALAN	', 70),
(70233, '	EL ROBLE	', 70),
(70235, '	GALERAS	', 70),
(70265, '	GUARANDA	', 70),
(70400, '	LA UNION	', 70),
(70418, '	LOS PALMITOS	', 70),
(70429, '	MAJAGUAL	', 70),
(70473, '	MORROA	', 70),
(70508, '	OVEJAS	', 70),
(70523, '	PALMITO	', 70),
(70670, '	SAMPUES	', 70),
(70678, '	SAN BENITO ABAD	', 70),
(70702, '	SAN JUAN DE BETULIA	', 70),
(70708, '	SAN MARCOS	', 70),
(70713, '	SAN ONOFRE	', 70),
(70717, '	SAN PEDRO	', 70),
(70742, '	SINCE	', 70),
(70771, '	SUCRE	', 70),
(70820, '	SANTIAGO DE TOLU	', 70),
(70823, '	TOLU VIEJO	', 70),
(73001, '	IBAGUE	', 73),
(73024, '	ALPUJARRA	', 73),
(73026, '	ALVARADO	', 73),
(73030, '	AMBALEMA	', 73),
(73043, '	ANZOATEGUI	', 73),
(73055, '	ARMERO	', 73),
(73067, '	ATACO	', 73),
(73124, '	CAJAMARCA	', 73),
(73148, '	CARMEN DE APICALA	', 73),
(73152, '	CASABIANCA	', 73),
(73168, '	CHAPARRAL	', 73),
(73200, '	COELLO	', 73),
(73217, '	COYAIMA	', 73),
(73226, '	CUNDAY	', 73),
(73236, '	DOLORES	', 73),
(73268, '	ESPINAL	', 73),
(73270, '	FALAN	', 73),
(73275, '	FLANDES	', 73),
(73283, '	FRESNO	', 73),
(73319, '	GUAMO	', 73),
(73347, '	HERVEO	', 73),
(73349, '	HONDA	', 73),
(73352, '	ICONONZO	', 73),
(73408, '	LERIDA	', 73),
(73411, '	LIBANO	', 73),
(73443, '	MARIQUITA	', 73),
(73449, '	MELGAR	', 73),
(73461, '	MURILLO	', 73),
(73483, '	NATAGAIMA	', 73),
(73504, '	ORTEGA	', 73),
(73520, '	PALOCABILDO	', 73),
(73547, '	PIEDRAS	', 73),
(73555, '	PLANADAS	', 73),
(73563, '	PRADO	', 73),
(73585, '	PURIFICACION	', 73),
(73616, '	RIOBLANCO	', 73),
(73622, '	RONCESVALLES	', 73),
(73624, '	ROVIRA	', 73),
(73671, '	SALDAÑA	', 73),
(73675, '	SAN ANTONIO	', 73),
(73678, '	SAN LUIS	', 73),
(73686, '	SANTA ISABEL	', 73),
(73770, '	SUAREZ	', 73),
(73854, '	VALLE DE SAN JUAN	', 73),
(73861, '	VENADILLO	', 73),
(73870, '	VILLAHERMOSA	', 73),
(73873, '	VILLARRICA	', 73),
(76001, '	CALI	', 76),
(76020, '	ALCALA	', 76),
(76036, '	ANDALUCIA	', 76),
(76041, '	ANSERMANUEVO	', 76),
(76054, '	ARGELIA	', 76),
(76100, '	BOLIVAR	', 76),
(76109, '	BUENAVENTURA	', 76),
(76111, '	GUADALAJARA DE BUGA	', 76),
(76113, '	BUGALAGRANDE	', 76),
(76122, '	CAICEDONIA	', 76),
(76126, '	CALIMA	', 76),
(76130, '	CANDELARIA	', 76),
(76147, '	CARTAGO	', 76),
(76233, '	DAGUA	', 76),
(76243, '	EL AGUILA	', 76),
(76246, '	EL CAIRO	', 76),
(76248, '	EL CERRITO	', 76),
(76250, '	EL DOVIO	', 76),
(76275, '	FLORIDA	', 76),
(76306, '	GINEBRA	', 76),
(76318, '	GUACARI	', 76),
(76364, '	JAMUNDI	', 76),
(76377, '	LA CUMBRE	', 76),
(76400, '	LA UNION	', 76),
(76403, '	LA VICTORIA	', 76),
(76497, '	OBANDO	', 76),
(76520, '	PALMIRA	', 76),
(76563, '	PRADERA	', 76),
(76606, '	RESTREPO	', 76),
(76616, '	RIOFRIO	', 76),
(76622, '	ROLDANILLO	', 76),
(76670, '	SAN PEDRO	', 76),
(76736, '	SEVILLA	', 76),
(76823, '	TORO	', 76),
(76828, '	TRUJILLO	', 76),
(76834, '	TULUA	', 76),
(76845, '	ULLOA	', 76),
(76863, '	VERSALLES	', 76),
(76869, '	VIJES	', 76),
(76890, '	YOTOCO	', 76),
(76892, '	YUMBO	', 76),
(76895, '	ZARZAL	', 76),
(81001, '	ARAUCA	', 81),
(81065, '	ARAUQUITA	', 81),
(81220, '	CRAVO NORTE	', 81),
(81300, '	FORTUL	', 81),
(81591, '	PUERTO RONDON	', 81),
(81736, '	SARAVENA	', 81),
(81794, '	TAME	', 81),
(85001, '	YOPAL	', 85),
(85010, '	AGUAZUL	', 85),
(85015, '	CHAMEZA	', 85),
(85125, '	HATO COROZAL	', 85),
(85136, '	LA SALINA	', 85),
(85139, '	MANI	', 85),
(85162, '	MONTERREY	', 85),
(85225, '	NUNCHIA	', 85),
(85230, '	OROCUE	', 85),
(85250, '	PAZ DE ARIPORO	', 85),
(85263, '	PORE	', 85),
(85279, '	RECETOR	', 85),
(85300, '	SABANALARGA	', 85),
(85315, '	SACAMA	', 85),
(85325, '	SAN LUIS DE PALENQUE	', 85),
(85400, '	TAMARA	', 85),
(85410, '	TAURAMENA	', 85),
(85430, '	TRINIDAD	', 85),
(85440, '	VILLANUEVA	', 85),
(86001, '	MOCOA	', 86),
(86219, '	COLON	', 86),
(86320, '	ORITO	', 86),
(86568, '	PUERTO ASIS	', 86),
(86569, '	PUERTO CAICEDO	', 86),
(86571, '	PUERTO GUZMAN	', 86),
(86573, '	LEGUIZAMO	', 86),
(86749, '	SIBUNDOY	', 86),
(86755, '	SAN FRANCISCO	', 86),
(86757, '	SAN MIGUEL	', 86),
(86760, '	SANTIAGO	', 86),
(86865, '	VALLE DEL GUAMUEZ	', 86),
(86885, '	VILLAGARZON	', 86),
(88001, '	SAN ANDRES	', 88),
(88564, '	PROVIDENCIA	', 88),
(91001, '	LETICIA	', 91),
(91263, '	EL ENCANTO	', 91),
(91405, '	LA CHORRERA	', 91),
(91407, '	LA PEDRERA	', 91),
(91430, '	LA VICTORIA	', 91),
(91460, '	MIRITI - PARANA	', 91),
(91530, '	PUERTO ALEGRIA	', 91),
(91536, '	PUERTO ARICA	', 91),
(91540, '	PUERTO NARIÑO	', 91),
(91669, '	PUERTO SANTANDER	', 91),
(91798, '	TARAPACA	', 91),
(94001, '	INIRIDA	', 94),
(94343, '	BARRANCO MINAS	', 94),
(94663, '	MAPIRIPANA	', 94),
(94883, '	SAN FELIPE	', 94),
(94884, '	PUERTO COLOMBIA	', 94),
(94885, '	LA GUADALUPE	', 94),
(94886, '	CACAHUAL	', 94),
(94887, '	PANA PANA	', 94),
(94888, '	MORICHAL	', 94),
(95001, '	SAN JOSE DEL GUAVIARE	', 95),
(95015, '	CALAMAR	', 95),
(95025, '	EL RETORNO	', 95),
(95200, '	MIRAFLORES	', 95),
(97001, '	MITU	', 95),
(97161, '	CARURU	', 95),
(97511, '	PACOA	', 95),
(97666, '	TARAIRA	', 95),
(97777, '	PAPUNAUA	', 95),
(97889, '	YAVARATE	', 95),
(99001, '	PUERTO CARREÑO	', 95),
(99524, '	LA PRIMAVERA	', 95),
(99624, '	SANTA ROSALIA	', 95),
(99773, '	CUMARIBO	', 95);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `novedad_visita_seguimiento`
--

CREATE TABLE `novedad_visita_seguimiento` (
  `idnovedad_visita_seguimiento` int(11) NOT NULL,
  `fecha_hora_novedad` datetime NOT NULL,
  `autor` varchar(80) NOT NULL,
  `novedad` varchar(400) NOT NULL,
  `visita_seguimiento_idvisita_seguimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `codi_pais` int(11) NOT NULL,
  `nomb_pais` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`codi_pais`, `nomb_pais`) VALUES
(1, '	NIVE ISLA	'),
(13, '	AFGANISTAN	'),
(17, '	ALBANIA	'),
(23, '	ALEMANIA	'),
(26, '	ARMENIA	'),
(27, '	ARUBA	'),
(29, '	BOSNIA-HERZEGOVINA	'),
(31, '	BURKINA FASSO	'),
(37, '	ANDORRA	'),
(40, '	ANGOLA	'),
(41, '	ANGUILLA	'),
(43, '	ANTIGUA Y BARBUDA	'),
(47, '	ANTILLAS HOLANDESAS	'),
(53, '	ARABIA SAUDITA	'),
(59, '	ARGELIA	'),
(63, '	ARGENTINA	'),
(69, '	AUSTRALIA	'),
(72, '	AUSTRIA	'),
(74, '	AZERBAIJAN	'),
(77, '	BAHAMAS	'),
(80, '	BAHREIN	'),
(81, '	BANGLADESH	'),
(83, '	BARBADOS	'),
(87, '	BELGICA	'),
(88, '	BELICE	'),
(90, '	BERMUDAS	'),
(91, '	BELORUS	'),
(93, '	BIRMANIA (MYANMAR)	'),
(97, '	BOLIVIA	'),
(101, '	BOTSWANA	'),
(105, '	BRASIL	'),
(108, '	BRUNEI DARUSSALAM	'),
(111, '	BULGARIA	'),
(115, '	BURUNDI	'),
(119, '	BUTAN	'),
(127, '	CABO VERDE	'),
(137, '	CAIMAN, ISLAS	'),
(141, '	KAMPUCHEA (CAMBOYA)	'),
(145, '	CAMERUN, REPUBLICA U	'),
(149, '	CANADA	'),
(155, '	CANAL(NORMANDAS),ISL	'),
(157, '	CANTON ENDERBURY,ISL	'),
(159, '	CIUDAD DEL VATICANO	'),
(165, '	COCOS (KEELING), ISL	'),
(169, '	COLOMBIA	'),
(173, '	COMORAS	'),
(177, '	CONGO	'),
(183, '	COOK, ISLAS	'),
(187, '	COREA DEL NORTE,REPU	'),
(190, '	COREA DEL SUR, REPUB	'),
(193, '	COSTA DE MARFIL	'),
(196, '	COSTA RICA	'),
(198, '	CROACIA	'),
(199, '	CUBA	'),
(203, '	CHAD	'),
(211, '	CHILE	'),
(215, '	CHINA	'),
(218, '	TAIWAN (FORMOSA)	'),
(221, '	CHIPRE	'),
(229, '	BENIN	'),
(232, '	DINAMARCA	'),
(235, '	DOMINICA	'),
(239, '	ECUADOR	'),
(240, '	EGIPTO	'),
(242, '	EL SALVADOR	'),
(243, '	ERITREA	'),
(244, '	EMIRATOS ARABES UNID	'),
(245, '	ESPAÑA	'),
(246, '	ESLOVAQUIA	'),
(247, '	ESLOVENIA	'),
(249, '	ESTADOS UNIDOS	'),
(251, '	ESTONIA	'),
(253, '	ETIOPIA	'),
(259, '	FEROE, ISLAS	'),
(267, '	FILIPINAS	'),
(271, '	FINLANDIA	'),
(275, '	FRANCIA	'),
(281, '	GABON	'),
(285, '	GAMBIA	'),
(286, '	GAZA Y JERICO	'),
(287, '	GEORGIA	'),
(289, '	GHANA	'),
(293, '	GIBRALTAR	'),
(297, '	GRANADA	'),
(301, '	GRECIA	'),
(305, '	GROENLANDIA	'),
(309, '	GUADALUPE	'),
(313, '	GUAM	'),
(317, '	GUATEMALA	'),
(325, '	GUAYANA FRANCESA	'),
(329, '	GUINEA	'),
(331, '	GUINEA ECUATORIAL	'),
(334, '	GUINEA - BISSAU	'),
(337, '	GUYANA	'),
(341, '	HAITI	'),
(345, '	HONDURAS	'),
(351, '	HONG KONG	'),
(355, '	HUNGRIA	'),
(361, '	INDIA	'),
(365, '	INDONESIA	'),
(369, '	IRAK	'),
(372, '	IRAN, REPUBLICA ISLA	'),
(375, '	IRLANDA (EIRE)	'),
(379, '	ISLANDIA	'),
(383, '	ISRAEL	'),
(386, '	ITALIA	'),
(391, '	JAMAICA	'),
(395, '	JOHNSTON,ISLA	'),
(399, '	JAPON	'),
(403, '	JORDANIA	'),
(406, '	KAZAJSTAN	'),
(410, '	KENYA	'),
(411, '	KIRIBATI	'),
(412, '	KIRGUIZISTAN	'),
(413, '	KUWAIT	'),
(420, '	LAOS,REPUBLICA POPUL	'),
(426, '	LESOTHO	'),
(429, '	LETONIA	'),
(431, '	LIBANO	'),
(434, '	LIBERIA	'),
(438, '	LIBIA(INCLUYE FEZZAN	'),
(440, '	LIECHTENSTEIN	'),
(443, '	LITUANIA	'),
(445, '	LUXEMBURGO	'),
(447, '	MACAO	'),
(448, '	MACEDONIA	'),
(450, '	MADAGASCAR	'),
(455, '	MALASIA	'),
(458, '	MALAWI	'),
(461, '	MALDIVAS	'),
(464, '	MALI	'),
(467, '	MALTA	'),
(469, '	MARIANAS DEL NORTE,I	'),
(472, '	MARSHALL, ISLAS	'),
(474, '	MARRUECOS	'),
(477, '	MARTINICA	'),
(485, '	MAURICIO	'),
(488, '	MAURITANIA	'),
(493, '	MEXICO	'),
(494, '	MICRONESIA,ESTADOS F	'),
(495, '	MIDWAY, ISLAS	'),
(496, '	MOLDAVIA	'),
(497, '	MONGOLIA	'),
(498, '	MONACO	'),
(501, '	MONSERRAT, ISLA	'),
(505, '	MOZAMBIQUE	'),
(507, '	NAMIBIA	'),
(508, '	NAURU	'),
(511, '	NAVIDAD (CHRISTMAS)	'),
(517, '	NEPAL	'),
(521, '	NICARAGUA	'),
(525, '	NIGER	'),
(528, '	NIGERIA	'),
(531, '	NIUE, ISLA	'),
(535, '	NORFOLK, ISLA	'),
(538, '	NORUEGA	'),
(542, '	NUEVA CALEDONIA	'),
(545, '	PAPUASIA NUEV GUINEA	'),
(548, '	NUEVA ZELANDIA	'),
(551, '	VANUATU	'),
(556, '	OMAN	'),
(566, '	PACIFICO, ISLAS DEL	'),
(573, '	PAISES BAJOS(HOLANDA	'),
(576, '	PAKISTAN	'),
(578, '	PALAU, ISLAS	'),
(580, '	PANAMA	'),
(586, '	PARAGUAY	'),
(589, '	PERU	'),
(593, '	PITCAIRN, ISLA	'),
(599, '	POLINESIA FRANCESA	'),
(603, '	POLONIA	'),
(607, '	PORTUGAL	'),
(611, '	PUERTO RICO	'),
(618, '	QATAR	'),
(628, '	REINO UNIDO	'),
(640, '	REPUBLICA CENTROAFRI	'),
(644, '	REPUBLICA CHECA	'),
(647, '	REPUBLICA DOMINICANA	'),
(660, '	REUNION	'),
(665, '	ZIMBABWE	'),
(670, '	RUMANIA	'),
(675, '	RWANDA	'),
(676, '	RUSIA	'),
(677, '	SALOMSN, ISLAS	'),
(685, '	SAHARA OCCIDENTAL	'),
(687, '	SAMOA	'),
(690, '	SAMOA NORTEAMERICANA	'),
(695, '	SAN CRISTOBAL NIEVE	'),
(697, '	SAN MARINO	'),
(700, '	SAN PEDRO Y MIGUELON	'),
(705, '	SAN VICENTE Y LAS GR	'),
(710, '	SANTA ELENA	'),
(715, '	SANTA LUCIA	'),
(720, '	SANTO TOME Y PRINCIP	'),
(728, '	SENEGAL	'),
(731, '	SEYCHELLES	'),
(735, '	SIERRA LEONA	'),
(741, '	SINGAPUR	'),
(744, '	SIRIA,REPUBLICA ARAB	'),
(748, '	SOMALIA	'),
(750, '	SRI LANKA	'),
(756, '	SUDAFRICA,REPUBLICA	'),
(759, '	SUDAN	'),
(764, '	SUECIA	'),
(767, '	SUIZA	'),
(770, '	SURINAM	'),
(773, '	SWAZILANDIA	'),
(774, '	TADJIKISTAN	'),
(776, '	TAILANDIA	'),
(780, '	TANZANIA,REPUBLICA U	'),
(783, '	DJIBOUTI	'),
(786, '	TERRI ANTARTICO BRIT	'),
(787, '	TERRITORI BRITANICO	'),
(788, '	TIMOR DEL ESTE	'),
(800, '	TOGO	'),
(805, '	TOKELAU	'),
(810, '	TONGA	'),
(815, '	TRINIDAD Y TOBAGO	'),
(820, '	TUNICIA	'),
(823, '	TURCAS Y CAICOS,ISLA	'),
(825, '	TURKMENISTAN	'),
(827, '	TURQUIA	'),
(828, '	TUVALU	'),
(830, '	UCRANIA	'),
(833, '	UGANDA	'),
(845, '	URUGUAY	'),
(847, '	UZBEKISTAN	'),
(850, '	VENEZUELA	'),
(855, '	VIETNAM	'),
(863, '	VIRGENES,ISLAS(BRITA	'),
(866, '	VIRGENES,ISLAS(NORTE	'),
(870, '	FIJI	'),
(873, '	WAKE, ISLA	'),
(875, '	WALLIS Y FORTUNA,ISL	'),
(880, '	YEMEN	'),
(885, '	YUGOSLAVIA	'),
(888, '	ZAIRE	'),
(890, '	ZAMBIA	'),
(895, '	ZONA CANAL DE PANAMA	'),
(897, '	ZONA NEUTRAL(PALESTA	'),
(998, '	COMUNIDAD EUROPEA	'),
(999, '	NO DECLARADOS	');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos_aprendices`
--

CREATE TABLE `procesos_aprendices` (
  `idproceso` int(11) NOT NULL,
  `fecha_hora_proceso` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `responsable` varchar(80) NOT NULL,
  `proceso` varchar(25) NOT NULL,
  `descripcion_proceso` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `procesos_aprendices`
--

INSERT INTO `procesos_aprendices` (`idproceso`, `fecha_hora_proceso`, `responsable`, `proceso`, `descripcion_proceso`) VALUES
(0, '2026-06-02 16:31:09', 'Gustavo Jimenez', 'Creo aprendiz', 'Se creo el aprendiz Pedro Perez con numero de identificación 111 en la ficha 22222 - ADSO Operario'),
(0, '2026-06-02 16:33:55', 'Gustavo Jimenez', 'Edito aprendiz', 'Se editó el aprendiz Pedro Perez de la ficha 22222-ADSO Operario. Cambios: Email - Antes: pedro@sena.edu.co, Ahora: gustavojimenezs@gmail.com. '),
(0, '2026-06-03 06:48:21', 'Maither  Palmett  Negrete', 'Registro Masivo', 'Se registraron masivamente 70 aprendices. en la ficha 3185861'),
(0, '2026-06-03 07:03:01', 'Maither  Palmett  Negrete', 'Edito aprendiz', 'Se editó el aprendiz PABLO ANTONIO FAJARDO HERNANDEZ de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS. Cambios: Teléfono - Antes: 3017070869, Ahora: 3111011111. Email - Antes: potecito91@gmail.com, Ahora: mmmmmm@gmail.com. '),
(0, '2026-06-03 07:04:03', 'Omer Enrique Rodelo Buelvas', 'Creo aprendiz', 'Se creo el aprendiz valentina orozco nieves con numero de identificación 1007855309 en la ficha 2660182 - COCINA.'),
(0, '2026-06-03 07:05:09', 'Maither  Palmett  Negrete', 'Creo aprendiz', 'Se creo el aprendiz MARTIN  LOPEZ PEREZ con numero de identificación 11111111 en la ficha 3185861 - CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS'),
(0, '2026-06-03 07:05:10', 'Maither  Palmett  Negrete', 'Creo aprendiz', 'Se creo el aprendiz MARTIN  LOPEZ PEREZ con numero de identificación 11111111 en la ficha 3185861 - CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS'),
(0, '2026-06-03 07:05:21', 'Maither  Palmett  Negrete', 'Elimino aprendiz', 'Se elimino el aprendiz MARTIN  LOPEZ PEREZ con numero de identificación 11111111 de la ficha 3185861 - CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS'),
(0, '2026-06-03 07:05:24', 'Marco Antonio Cipagauta Arbelaez', 'Registro Masivo', 'Se registraron masivamente 29 aprendices. en la ficha 22222'),
(0, '2026-06-03 07:06:33', 'Marco Antonio Cipagauta Arbelaez', 'Elimino aprendiz', 'Se elimino el aprendiz ROBERT STIVEN BECERRA BECERRA con numero de identificación 1002460000 de la ficha 22222 - Transporte Fluvial'),
(0, '2026-06-03 07:08:07', 'Marco Antonio Cipagauta Arbelaez', 'Edito aprendiz', 'Se editó el aprendiz PABLO ANTONIO FAJARDO HERNANDEZ de la ficha undefined. Cambios: Estado reasignado automáticamente de 4 a 2. Se agregó novedad: cambio de ficha. '),
(0, '2026-06-03 11:13:28', 'Maither  Palmett  Negrete', 'Edito aprendiz', 'Se editó el aprendiz MARTIN  LOPEZ PEREZ de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS. Cambios: Email - Antes: martin@gmail.com, Ahora: maipalmettne@gmail.com. '),
(0, '2026-06-05 06:02:50', 'Marco Antonio Cipagauta Arbelaez', 'Registro Masivo', 'Se registraron masivamente 29 aprendices. en la ficha 4444'),
(0, '2026-06-09 07:55:23', 'Omer Enrique Rodelo Buelvas', 'Registro Masivo', 'Se registraron masivamente 29 aprendices. en la ficha 3231231'),
(0, '2026-06-09 07:59:18', 'Omer Enrique Rodelo Buelvas', 'Registro Masivo', 'Se registraron masivamente 30 aprendices. en la ficha 3231178'),
(0, '2026-06-12 05:39:17', 'Omer Enrique Rodelo Buelvas', 'Registro Masivo', 'Se registraron masivamente 30 aprendices. en la ficha 3415243'),
(0, '2026-06-12 07:15:37', 'Maither  Palmett  Negrete', 'Edito aprendiz', 'Se editó el aprendiz LUIS FELIPE VELASCO REYES de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS. Cambios: Documento - Antes: 14651925, Ahora: 222222. Email - Antes: pipo1218@hotmail.com, Ahora: pipo1218@gmail.com. '),
(0, '2026-06-12 07:15:59', 'Maither  Palmett  Negrete', 'Edito aprendiz', 'Se editó el aprendiz ANA DOLORES SAUCEDO JIMENEZ de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS. Cambios: Documento - Antes: 22591984, Ahora: 333333. Email - Antes: osialina@hotmail.com, Ahora: osialina@gmail.com. '),
(0, '2026-06-12 07:16:20', 'Maither  Palmett  Negrete', 'Edito aprendiz', 'Se editó el aprendiz YENNY YULIETH RIVERA ARIAS de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS. Cambios: Documento - Antes: 38644412, Ahora: 444444. Email - Antes: yeyu2111@hotmail.com, Ahora: yeyu2111@gmail.com. '),
(0, '2026-06-12 07:16:41', 'Maither  Palmett  Negrete', 'Edito aprendiz', 'Se editó el aprendiz MARIA NAIDU BEJARANO MONTAÑEZ de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS. Cambios: Documento - Antes: 52966055, Ahora: 555555. Email - Antes: mariabejarano806@gmail.com, Ahora: mariabejarano806@hotmail.com. '),
(0, '2026-06-12 07:16:56', 'Maither  Palmett  Negrete', 'Edito aprendiz', 'Se editó el aprendiz RICARDO ABAD GUERRERO GOMEZ de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS. Cambios: Documento - Antes: 80913398, Ahora: 666666. Email - Antes: abadtqacin@gmail.com, Ahora: abadtqacin@hotmail.com. '),
(0, '2026-06-12 07:17:16', 'Maither  Palmett  Negrete', 'Edito aprendiz', 'Se editó el aprendiz MARTIN  LOPEZ PEREZ de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS. Cambios: Documento - Antes: 11111111, Ahora: 111111. '),
(0, '2026-06-12 07:17:34', 'Maither  Palmett  Negrete', 'Edito aprendiz', 'Se editó el aprendiz EMILEN ANDREA ARREDONDO ACOSTA de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS. Cambios: Documento - Antes: 1001144237, Ahora: 777777. Email - Antes: emilenandrea22@gmail.com, Ahora: emilenandrea22@hotmail.com. '),
(0, '2026-06-12 07:17:52', 'Maither  Palmett  Negrete', 'Edito aprendiz', 'Se editó el aprendiz ERIKA JOHANNA LOZANO VELASCO de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS. Cambios: Documento - Antes: 1003689584, Ahora: 888888. Email - Antes: erikalozano584@gmail.com, Ahora: erikalozano584@hotmail.com. '),
(0, '2026-06-12 07:18:13', 'Maither  Palmett  Negrete', 'Edito aprendiz', 'Se editó el aprendiz YULIANA PAOLA ROMO GUTIERREZ de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS. Cambios: Documento - Antes: 1004271269, Ahora: 999999. Email - Antes: yulianaromogutierrez@gmail.com, Ahora: yulianaromogutierrez@hotmail.com. '),
(0, '2026-06-12 07:26:12', 'Maither  Palmett  Negrete', 'Edito aprendiz', 'Se editó el aprendiz LUIS FELIPE VELASCO REYES de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS. No hay cambios'),
(0, '2026-07-03 06:58:54', 'Omer Enrique Rodelo Buelvas', 'Registro Masivo', 'Se registraron masivamente 30 aprendices. en la ficha 3147643');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos_empresas`
--

CREATE TABLE `procesos_empresas` (
  `idproceso` int(11) NOT NULL,
  `fecha_hora_proceso` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `responsable` varchar(80) NOT NULL,
  `proceso` varchar(25) NOT NULL,
  `descripcion_proceso` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `procesos_empresas`
--

INSERT INTO `procesos_empresas` (`idproceso`, `fecha_hora_proceso`, `responsable`, `proceso`, `descripcion_proceso`) VALUES
(1, '2026-06-03 07:51:14', 'Maither  Palmett  Negrete', 'Creo empresa', 'Se creo la empresa MAITHER LTDA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos_fichas`
--

CREATE TABLE `procesos_fichas` (
  `idproceso` int(11) NOT NULL,
  `fecha_hora_proceso` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `responsable` varchar(80) NOT NULL,
  `proceso` varchar(25) NOT NULL,
  `descripcion_proceso` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `procesos_fichas`
--

INSERT INTO `procesos_fichas` (`idproceso`, `fecha_hora_proceso`, `responsable`, `proceso`, `descripcion_proceso`) VALUES
(0, '2026-06-02 06:28:43', 'Marco Antonio Cipagauta Arbelaez', 'Creo ficha', 'Se creo la ficha 22222 - ADSO'),
(0, '2026-06-02 06:29:44', 'Marco Antonio Cipagauta Arbelaez', 'Creo ficha', 'Se creo la ficha 22222 - ADSO'),
(0, '2026-06-02 07:20:24', 'Marco Antonio Cipagauta Arbelaez', 'Creo ficha', 'Se creo la ficha 252525 - Ventas'),
(0, '2026-06-02 08:22:32', 'Marco Antonio Cipagauta Arbelaez', 'Creo ficha', 'Se creo la ficha 2827150 - Ficha Prueba ProduccionLimpia'),
(0, '2026-06-02 10:57:58', 'Marco Antonio Cipagauta Arbelaez', 'Elimino ficha', 'Se elimino la ficha 22222 - ADSO'),
(0, '2026-06-02 16:29:37', 'Gustavo Jimenez', 'Edito ficha', 'Se edito la ficha Numero 22222, Caracterización ADSO. cambios: Antes ADSO, Ahora ADSO Operario.Antes 2026-07-25, Ahora 2026-11-30.Antes 2027-01-25, Ahora 2027-03-02.Antes TERMINADA POR FECHA. Antes . Antes MATERIALES HERRAMIENTAS - MATERIALES PARA LA INDUSTRIA .'),
(0, '2026-06-03 06:46:33', 'Maither  Palmett  Negrete', 'Creo ficha', 'Se creo la ficha 3185861 - CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS'),
(0, '2026-06-03 06:52:06', 'Omer Enrique Rodelo Buelvas', 'Creo ficha', 'Se creo la ficha 2660182 - COCINA.'),
(0, '2026-06-03 06:55:42', 'Marco Antonio Cipagauta Arbelaez', 'Creo ficha', 'Se creo la ficha 22222 - Transporte Fluvial'),
(0, '2026-06-03 06:55:44', 'Omer Enrique Rodelo Buelvas', 'Edito ficha', 'Se edito la ficha Numero 2660182, Caracterización COCINA.. cambios: Antes 2024-01-24, Ahora 2023-07-24.Antes 2024-07-24, Ahora 2024-01-24.'),
(0, '2026-06-03 06:56:27', 'Omer Enrique Rodelo Buelvas', 'Edito ficha', 'Se edito la ficha Numero 2660182, Caracterización COCINA.. No hay cambios'),
(0, '2026-06-03 06:56:54', 'Omer Enrique Rodelo Buelvas', 'Edito ficha', 'Se edito la ficha Numero 2660182, Caracterización COCINA.. cambios: Antes TERMINADA POR FECHA. '),
(0, '2026-06-05 06:00:12', 'Marco Antonio Cipagauta Arbelaez', 'Creo ficha', 'Se creo la ficha 4444 - ADSO'),
(0, '2026-06-09 07:54:37', 'Omer Enrique Rodelo Buelvas', 'Creo ficha', 'Se creo la ficha 3231231 - SERVICIOS DE ALOJAMIENTO'),
(0, '2026-06-09 07:58:49', 'Omer Enrique Rodelo Buelvas', 'Creo ficha', 'Se creo la ficha 3231178 - COCINA.'),
(0, '2026-06-12 05:30:15', 'Omer Enrique Rodelo Buelvas', 'Creo ficha', 'Se creo la ficha 2618188 - COORDINACION DE SERVICIOS HOTELEROS'),
(0, '2026-06-12 05:31:41', 'Omer Enrique Rodelo Buelvas', 'Elimino ficha', 'Se elimino la ficha 2618188 - COORDINACION DE SERVICIOS HOTELEROS'),
(0, '2026-06-12 05:38:34', 'Omer Enrique Rodelo Buelvas', 'Creo ficha', 'Se creo la ficha 3415243 - COORDINACION DE SERVICIOS HOTELEROS'),
(0, '2026-06-12 05:38:54', 'Omer Enrique Rodelo Buelvas', 'Edito ficha', 'Se edito la ficha Numero 3415243, Caracterización COORDINACION DE SERVICIOS HOTELEROS. cambios: Antes TERMINADA POR FECHA. '),
(0, '2026-07-03 06:56:07', 'Omer Enrique Rodelo Buelvas', 'Creo ficha', 'Se creo la ficha 3147643 - ASISTENCIA ADMINISTRATIVA .'),
(0, '2026-07-06 06:57:19', 'Omer Enrique Rodelo Buelvas', 'Edito ficha', 'Se edito la ficha Numero 4444, Caracterización ADSO. No hay cambios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos_funcionarios`
--

CREATE TABLE `procesos_funcionarios` (
  `idproceso` int(11) NOT NULL,
  `fecha_hora_proceso` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `responsable` varchar(80) NOT NULL,
  `proceso` varchar(25) NOT NULL,
  `descripcion_proceso` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `procesos_funcionarios`
--

INSERT INTO `procesos_funcionarios` (`idproceso`, `fecha_hora_proceso`, `responsable`, `proceso`, `descripcion_proceso`) VALUES
(0, '2026-06-02 16:38:39', 'Gustavo Jimenez', 'Creo funcionario', 'Se creo el funcionario David Jimenez con numero de identificación 112'),
(0, '2026-06-03 06:12:25', 'Marco Antonio Cipagauta Arbelaez', 'Creo funcionario', 'Se creo el funcionario Omer Enrique Rodelo Buelvas con numero de identificación 7931899'),
(0, '2026-06-03 06:15:39', 'Marco Antonio Cipagauta Arbelaez', 'Creo funcionario', 'Se creo el funcionario Maither  Palmett  Negrete con numero de identificación 1065373587'),
(0, '2026-06-03 06:19:56', 'Omer Enrique Rodelo Buelvas', 'Creo funcionario', 'Se creo el funcionario VALENTINA ANDREA OROZCO NIEVES con numero de identificación 1007855309'),
(0, '2026-06-03 06:20:36', 'Maither  Palmett  Negrete', 'Creo funcionario', 'Se creo el funcionario Leandro  Chavez Dumcan con numero de identificación 9097850'),
(0, '2026-06-03 06:27:59', 'Omer Enrique Rodelo Buelvas', 'Edito funcionario', 'Se editó el funcionario VALENTINA ANDREA OROZCO NIEVES con numero de identificación 1007855309. Cambios: Antes Instructor.'),
(0, '2026-06-04 05:24:15', 'Omer Enrique Rodelo Buelvas', 'Creo funcionario', 'Se creo el funcionario Clara Aleman Herrera con numero de identificación 32685696'),
(0, '2026-06-04 05:26:17', 'Omer Enrique Rodelo Buelvas', 'Creo funcionario', 'Se creo el funcionario Tatiana Margarita Ortega Peinado con numero de identificación 45526217'),
(0, '2026-06-04 05:27:43', 'Omer Enrique Rodelo Buelvas', 'Creo funcionario', 'Se creo el funcionario Patricia Jimenez Hernandez con numero de identificación 45466075'),
(0, '2026-06-04 05:29:11', 'Omer Enrique Rodelo Buelvas', 'Creo funcionario', 'Se creo el funcionario Jaime Andres Garcia Gomez con numero de identificación 92694359'),
(0, '2026-06-04 05:47:16', 'Omer Enrique Rodelo Buelvas', 'Creo funcionario', 'Se creo el funcionario Eduardo Villanueva Orozco con numero de identificación 73569720'),
(0, '2026-06-04 06:08:51', 'Omer Enrique Rodelo Buelvas', 'Creo funcionario', 'Se creo el funcionario Jose Manuel Chiquillo Cortes con numero de identificación 73201424'),
(0, '2026-06-04 06:09:58', 'Omer Enrique Rodelo Buelvas', 'Creo funcionario', 'Se creo el funcionario Zulma  Elles con numero de identificación 23234824'),
(0, '2026-06-04 06:11:06', 'Omer Enrique Rodelo Buelvas', 'Creo funcionario', 'Se creo el funcionario Jorge Luis Pinedo Cabarcas con numero de identificación 9292852'),
(0, '2026-06-04 06:13:31', 'Omer Enrique Rodelo Buelvas', 'Creo funcionario', 'Se creo el funcionario Jorge Eduardo Regino Lugo con numero de identificación 15030258'),
(0, '2026-06-04 06:14:31', 'Omer Enrique Rodelo Buelvas', 'Creo funcionario', 'Se creo el funcionario Sandra Martinez con numero de identificación 45451855'),
(0, '2026-06-04 06:15:31', 'Omer Enrique Rodelo Buelvas', 'Creo funcionario', 'Se creo el funcionario Juan Atencio Atencio con numero de identificación 73086568'),
(0, '2026-06-04 06:17:11', 'Omer Enrique Rodelo Buelvas', 'Creo funcionario', 'Se creo el funcionario Marelvi Sarabia Serrano con numero de identificación 45460092'),
(0, '2026-06-04 06:18:48', 'Omer Enrique Rodelo Buelvas', 'Creo funcionario', 'Se creo el funcionario Fidias Antonio Manyoma Ledezma con numero de identificación 73129610'),
(0, '2026-06-04 06:35:27', 'Omer Enrique Rodelo Buelvas', 'Edito funcionario', 'Se editó el funcionario Marelvi Sarabia Serrano con numero de identificación 45460092. Cambios: Antes Marelvi, Ahora Marelbi.'),
(0, '2026-06-05 05:41:59', 'Marco Antonio Cipagauta Arbelaez', 'Creo funcionario', 'Se creo el funcionario Jose Luis Cipagauta  con numero de identificación 1052391446'),
(0, '2026-06-09 07:51:34', 'Omer Enrique Rodelo Buelvas', 'Elimino funcionario', 'Se Elimino el funcionario VALENTINA ANDREA OROZCO NIEVES con numero de identificación 1007855309'),
(0, '2026-06-09 17:15:36', 'Maither  Palmett  Negrete', 'Creo funcionario', 'Se creo el funcionario Adrián Esteban  Fabra Diaz  con numero de identificación 1067927502'),
(0, '2026-06-12 06:22:35', 'Maither  Palmett  Negrete', 'Creo funcionario', 'Se creo el funcionario Bladimir José  Lamadrid Sánchez con numero de identificación 735446089'),
(0, '2026-06-12 06:23:34', 'Maither  Palmett  Negrete', 'Creo funcionario', 'Se creo el funcionario Carlos Federico  Gomez Díaz  con numero de identificación 1143380866'),
(0, '2026-06-12 06:24:18', 'Maither  Palmett  Negrete', 'Creo funcionario', 'Se creo el funcionario Hilda  Cantillo Devoz  con numero de identificación 1050945862'),
(0, '2026-06-12 06:25:24', 'Maither  Palmett  Negrete', 'Creo funcionario', 'Se creo el funcionario Liliana Patricia  Vargas Escobar con numero de identificación 39621436'),
(0, '2026-06-12 06:26:16', 'Maither  Palmett  Negrete', 'Creo funcionario', 'Se creo el funcionario Marco Antonio  Almanza Ibarra con numero de identificación 73190306'),
(0, '2026-06-12 06:27:11', 'Maither  Palmett  Negrete', 'Creo funcionario', 'Se creo el funcionario Yina Marcela  Guzman Bustillo con numero de identificación 1047399810'),
(0, '2026-06-12 06:28:10', 'Maither  Palmett  Negrete', 'Creo funcionario', 'Se creo el funcionario Sebastian  Diaz Fuentes con numero de identificación 1047493840'),
(0, '2026-07-03 07:07:58', 'Omer Enrique Rodelo Buelvas', 'Creo funcionario', 'Se creo el funcionario VALENTINA ANDREA OROZCO NIEVES con numero de identificación 1007855309');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos_linea_red_tecnologica`
--

CREATE TABLE `procesos_linea_red_tecnologica` (
  `idproceso` int(11) NOT NULL,
  `fecha_hora_proceso` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `responsable` varchar(80) NOT NULL,
  `proceso` varchar(25) NOT NULL,
  `descripcion_proceso` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `procesos_linea_red_tecnologica`
--

INSERT INTO `procesos_linea_red_tecnologica` (`idproceso`, `fecha_hora_proceso`, `responsable`, `proceso`, `descripcion_proceso`) VALUES
(0, '2026-06-02 06:25:06', 'Marco Antonio Cipagauta Arbelaez', 'Creo línea tecnológica', 'Se creo la línea tecnológica prueba1'),
(0, '2026-06-02 06:25:22', 'Marco Antonio Cipagauta Arbelaez', 'Creo red tecnológica', 'Se creo la red tecnológica linea de prueba 1 en la línea tecnológica prueba1'),
(0, '2026-06-02 06:25:38', 'Marco Antonio Cipagauta Arbelaez', 'Edito red tecnológica', 'Se edito el nombre de la red tecnológica linea de prueba 1 en la línea tecnológica prueba1 por linea de prueba 2'),
(0, '2026-06-02 06:25:46', 'Marco Antonio Cipagauta Arbelaez', 'Elimino red tecnológica', 'Se Elimino la red tecnológica linea de prueba 2 en la línea tecnológica prueba1'),
(0, '2026-06-02 06:26:00', 'Marco Antonio Cipagauta Arbelaez', 'Edito línea tecnológica', 'Se edito el nombre de la línea tecnológica prueba1 por prueba 1'),
(0, '2026-06-02 06:26:04', 'Marco Antonio Cipagauta Arbelaez', 'Elimino línea tecnológica', 'Se elimino la línea tecnológica prueba 1'),
(0, '2026-06-02 16:15:56', 'Gustavo Jimenez', 'Creo línea tecnológica', 'Se creo la línea tecnológica Linea de Software'),
(0, '2026-06-02 16:26:05', 'Gustavo Jimenez', 'Creo red tecnológica', 'Se creo la red tecnológica Software 1 en la línea tecnológica Linea de Software'),
(0, '2026-06-02 16:26:28', 'Gustavo Jimenez', 'Creo red tecnológica', 'Se creo la red tecnológica Software 2 en la línea tecnológica Linea de Software'),
(0, '2026-06-03 06:36:00', 'Maither  Palmett  Negrete', 'Creo línea tecnológica', 'Se creo la línea tecnológica Salud'),
(0, '2026-06-03 06:36:57', 'Maither  Palmett  Negrete', 'Edito línea tecnológica', 'Se edito el nombre de la línea tecnológica Salud por GESTION ADMINISTRATIVA Y FINANCIERA'),
(0, '2026-06-03 06:38:10', 'Omer Enrique Rodelo Buelvas', 'Creo línea tecnológica', 'Se creo la línea tecnológica Red de Hotelería y turismo'),
(0, '2026-06-03 06:38:13', 'Marco Antonio Cipagauta Arbelaez', 'Creo línea tecnológica', 'Se creo la línea tecnológica LOGISTICA Y TRANSPORTE'),
(0, '2026-06-03 06:40:00', 'Omer Enrique Rodelo Buelvas', 'Creo red tecnológica', 'Se creo la red tecnológica Red de Hotelería y turismo en la línea tecnológica Red de Hotelería y turismo'),
(0, '2026-06-03 06:40:10', 'Marco Antonio Cipagauta Arbelaez', 'Creo red tecnológica', 'Se creo la red tecnológica LOGISTICA Y TRANSPORTE en la línea tecnológica LOGISTICA Y TRANSPORTE'),
(0, '2026-06-03 06:43:41', 'Maither  Palmett  Negrete', 'Creo red tecnológica', 'Se creo la red tecnológica GESTION ADMINISTRATIVA Y FINANCIERA en la línea tecnológica GESTION ADMINISTRATIVA Y FINANCIERA'),
(0, '2026-06-09 07:13:52', 'Omer Enrique Rodelo Buelvas', 'Creo red tecnológica', 'Se creo la red tecnológica SERVICIOS DE ALOJAMIENTO en la línea tecnológica Red de Hotelería y turismo'),
(0, '2026-06-12 05:37:35', 'Omer Enrique Rodelo Buelvas', 'Creo red tecnológica', 'Se creo la red tecnológica COORDINACION DE SERVICIOS HOTELEROS en la línea tecnológica Red de Hotelería y turismo'),
(0, '2026-07-03 06:47:43', 'Omer Enrique Rodelo Buelvas', 'Creo línea tecnológica', 'Se creo la línea tecnológica AUXILIAR-SERVICIO DE ARREGLO DE HABITACIONES'),
(0, '2026-07-03 06:48:21', 'Omer Enrique Rodelo Buelvas', 'Elimino línea tecnológica', 'Se elimino la línea tecnológica AUXILIAR-SERVICIO DE ARREGLO DE HABITACIONES'),
(0, '2026-07-03 06:49:13', 'Omer Enrique Rodelo Buelvas', 'Creo línea tecnológica', 'Se creo la línea tecnológica Red de Gestión administrativa y financiera'),
(0, '2026-07-03 06:52:13', 'Omer Enrique Rodelo Buelvas', 'Elimino línea tecnológica', 'Se elimino la línea tecnológica Red de Gestión administrativa y financiera'),
(0, '2026-07-03 06:52:35', 'Omer Enrique Rodelo Buelvas', 'Creo línea tecnológica', 'Se creo la línea tecnológica TÉCNICO-ASISTENCIA ADMINISTRATIVA .'),
(0, '2026-07-03 06:52:58', 'Omer Enrique Rodelo Buelvas', 'Creo red tecnológica', 'Se creo la red tecnológica Red de Gestión administrativa y financiera en la línea tecnológica TÉCNICO-ASISTENCIA ADMINISTRATIVA .'),
(0, '2026-07-06 06:52:01', 'Omer Enrique Rodelo Buelvas', 'Creo línea tecnológica', 'Se creo la línea tecnológica TÉCNICO-ASESORIA COMERCIAL'),
(0, '2026-07-06 06:52:39', 'Omer Enrique Rodelo Buelvas', 'Creo red tecnológica', 'Se creo la red tecnológica Red de Comercio y ventas en la línea tecnológica TÉCNICO-ASESORIA COMERCIAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos_seguimientos`
--

CREATE TABLE `procesos_seguimientos` (
  `idproceso` int(11) NOT NULL,
  `fecha_hora_proceso` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `responsable` varchar(80) NOT NULL,
  `proceso` varchar(25) NOT NULL,
  `descripcion_proceso` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `procesos_seguimientos`
--

INSERT INTO `procesos_seguimientos` (`idproceso`, `fecha_hora_proceso`, `responsable`, `proceso`, `descripcion_proceso`) VALUES
(1, '2026-06-03 07:56:16', 'Maither  Palmett  Negrete', 'Creo etapa practica', 'Se creo etapa practica al aprendiz MARTIN  LOPEZ PEREZ de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS en la empresa MAITHER LTDA bajo la modalidad de  C. Aprendizaje'),
(2, '2026-06-03 08:07:02', 'Maither  Palmett  Negrete', 'Edito etapa practica', 'Se edito la etapa practica del aprendiz MARTIN  LOPEZ PEREZ con numero de identificación 11111111 de la ficha 3185861 CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS. cambios: Antes , Ahora null.'),
(3, '2026-06-03 08:08:20', 'Marco Antonio Cipagauta Arbelaez', 'Creo etapa practica', 'Se creo etapa practica al aprendiz valentina orozco nieves de la ficha 2660182-COCINA. en la empresa SERVICIO NACIONAL DE APRENDIZAJE, SENA bajo la modalidad de  C. Aprendizaje'),
(4, '2026-06-03 10:44:42', 'Marco Antonio Cipagauta Arbelaez', 'Creo etapa practica', 'Se creo etapa practica al aprendiz SEBASTIAN RICARDO AREVALO RINCON de la ficha 22222-Transporte Fluvial en la empresa  NAM CONSTRUCCIONES bajo la modalidad de  C. Aprendizaje'),
(5, '2026-06-03 11:18:55', 'Marco Antonio Cipagauta Arbelaez', 'Creo etapa practica', 'Se creo etapa practica al aprendiz JUAN DAVID JAIMES GALLEGO de la ficha 22222-Transporte Fluvial en la empresa 4 PAJAROS bajo la modalidad de  C. Aprendizaje'),
(6, '2026-06-03 11:22:12', 'Marco Antonio Cipagauta Arbelaez', 'Creo etapa practica', 'Se creo etapa practica al aprendiz ANDRES RODOLFO CORREDOR DIAZ de la ficha 22222-Transporte Fluvial en la empresa SERVICIO NACIONAL DE APRENDIZAJE, SENA bajo la modalidad de  C. Aprendizaje'),
(7, '2026-06-03 12:15:18', 'Marco Antonio Cipagauta Arbelaez', 'Edito etapa practica', 'Se edito la etapa practica del aprendiz valentina orozco nieves con numero de identificaci??n 1007855309 de la ficha 2660182 COCINA.. cambios: Antes , Ahora se cambio por que el trabajo no era relacionado con el programa de formacion.'),
(8, '2026-06-03 12:18:03', 'Marco Antonio Cipagauta Arbelaez', 'Creo etapa practica', 'Se creo etapa practica al aprendiz valentina orozco nieves de la ficha 2660182-COCINA. en la empresa  NAM CONSTRUCCIONES bajo la modalidad de  Contrato Vinculo Formativo'),
(9, '2026-06-03 16:30:14', 'Marco Antonio Cipagauta Arbelaez', 'Creo etapa practica', 'Se creo etapa practica al aprendiz KAROL YULIANNA SANABRIA ROJAS de la ficha 22222-Transporte Fluvial en la empresa SERVICIO NACIONAL DE APRENDIZAJE, SENA bajo la modalidad de  C. Aprendizaje'),
(10, '2026-06-03 16:31:50', 'Marco Antonio Cipagauta Arbelaez', 'Edito etapa practica', 'Se edito la etapa practica del aprendiz KAROL YULIANNA SANABRIA ROJAS con numero de identificaci??n 1232460825 de la ficha 22222 Transporte Fluvial. cambios: Antes 2026-06-03, Ahora 2026-06-02.Antes , Ahora cambio de ficha.'),
(11, '2026-06-03 17:16:25', 'Marco Antonio Cipagauta Arbelaez', 'Creo etapa practica', 'Se creo etapa practica al aprendiz YEISON JAVIER CUADROS MORALES de la ficha 22222-Transporte Fluvial en la empresa 830000167 bajo la modalidad de  C. Aprendizaje'),
(12, '2026-06-04 06:38:05', 'Marco Antonio Cipagauta Arbelaez', 'Creo etapa practica', 'Se creo etapa practica al aprendiz JULIAN ALEJANDRO AVENDAÑO SIERRA de la ficha 22222-Transporte Fluvial en la empresa AGENCIA DE ADUANAS REPRESENTACIONES J. GUTIERREZ SAS. NIVEL 1 bajo la modalidad de  C. Aprendizaje'),
(13, '2026-06-09 08:02:53', 'Omer Enrique Rodelo Buelvas', 'Creo etapa practica', 'Se creo etapa practica al aprendiz SAMARA CAROLINA CANTILLO TORRES de la ficha 3231178-COCINA. en la empresa  NAM CONSTRUCCIONES bajo la modalidad de  C. Aprendizaje'),
(14, '2026-06-12 05:48:43', 'Omer Enrique Rodelo Buelvas', 'Creo etapa practica', 'Se creo etapa practica al aprendiz HELEN SOFIA QUINTANA PEREIRA de la ficha 3415243-COORDINACION DE SERVICIOS HOTELEROS en la empresa SERVICIO NACIONAL DE APRENDIZAJE, SENA bajo la modalidad de  C. Aprendizaje'),
(15, '2026-06-12 06:16:24', 'Omer Enrique Rodelo Buelvas', 'Edito etapa practica', 'Se edito la etapa practica del aprendiz SAMARA CAROLINA CANTILLO TORRES con numero de identificaci??n 1002192821 de la ficha 3231178 COCINA.. cambios: Antes , Ahora null.'),
(16, '2026-06-12 07:28:04', 'Maither  Palmett  Negrete', 'Edito etapa practica', 'Se edito la etapa practica del aprendiz MARTIN  LOPEZ PEREZ con numero de identificaci??n 111111 de la ficha 3185861 CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS. No hay cambios'),
(17, '2026-06-12 07:29:23', 'Maither  Palmett  Negrete', 'Creo etapa practica', 'Se creo etapa practica al aprendiz LUIS FELIPE VELASCO REYES de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS en la empresa  NAM CONSTRUCCIONES bajo la modalidad de  C. Aprendizaje'),
(18, '2026-06-12 07:30:04', 'Maither  Palmett  Negrete', 'Creo etapa practica', 'Se creo etapa practica al aprendiz ANA DOLORES SAUCEDO JIMENEZ de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS en la empresa  NATURÑAME bajo la modalidad de  C. Aprendizaje'),
(19, '2026-06-12 07:30:29', 'Maither  Palmett  Negrete', 'Creo etapa practica', 'Se creo etapa practica al aprendiz YENNY YULIETH RIVERA ARIAS de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS en la empresa  NAM CONSTRUCCIONES bajo la modalidad de  C. Aprendizaje'),
(20, '2026-06-12 07:31:01', 'Maither  Palmett  Negrete', 'Creo etapa practica', 'Se creo etapa practica al aprendiz MARIA NAIDU BEJARANO MONTAÑEZ de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS en la empresa  NATURÑAME bajo la modalidad de  C. Aprendizaje'),
(21, '2026-06-12 07:31:45', 'Maither  Palmett  Negrete', 'Creo etapa practica', 'Se creo etapa practica al aprendiz RICARDO ABAD GUERRERO GOMEZ de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS en la empresa  NAM CONSTRUCCIONES bajo la modalidad de  C. Aprendizaje'),
(22, '2026-06-12 07:32:17', 'Maither  Palmett  Negrete', 'Creo etapa practica', 'Se creo etapa practica al aprendiz EMILEN ANDREA ARREDONDO ACOSTA de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS en la empresa  NAM CONSTRUCCIONES bajo la modalidad de  C. Aprendizaje'),
(23, '2026-06-12 07:32:38', 'Maither  Palmett  Negrete', 'Creo etapa practica', 'Se creo etapa practica al aprendiz ERIKA JOHANNA LOZANO VELASCO de la ficha 3185861-CONTABILIZACION DE OPERACIONES COMERCIALES Y FINANCIERAS en la empresa  NAM CONSTRUCCIONES bajo la modalidad de  C. Aprendizaje'),
(24, '2026-07-03 07:01:57', 'Omer Enrique Rodelo Buelvas', 'Creo etapa practica', 'Se creo etapa practica al aprendiz SILVANA CAMILA VIGOYA PEREZ de la ficha 3147643-ASISTENCIA ADMINISTRATIVA . en la empresa  NAM CONSTRUCCIONES bajo la modalidad de  C. Aprendizaje');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperacion_contrasena`
--

CREATE TABLE `recuperacion_contrasena` (
  `id_recuperacion` int(11) NOT NULL,
  `codigo_recuperacion` varchar(20) DEFAULT NULL,
  `fecha_hora_creacion` timestamp NULL DEFAULT NULL,
  `funcionario_idfuncionario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `recuperacion_contrasena`
--

INSERT INTO `recuperacion_contrasena` (`id_recuperacion`, `codigo_recuperacion`, `fecha_hora_creacion`, `funcionario_idfuncionario`) VALUES
(1, 'Y75040K7', '2026-06-24 16:51:26', 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuperacion_contrasena_aprendiz`
--

CREATE TABLE `recuperacion_contrasena_aprendiz` (
  `id_recuperacion` int(11) NOT NULL,
  `codigo_recuperacion` varchar(20) DEFAULT NULL,
  `fecha_hora_creacion` timestamp NULL DEFAULT NULL,
  `aprendiz_idaprendiz` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `red_tecnologica`
--

CREATE TABLE `red_tecnologica` (
  `idred_tecnologica` int(11) NOT NULL,
  `nombre_red_tecnologica` varchar(255) DEFAULT NULL,
  `linea_tecnologica_idlinea_tecnologica` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `red_tecnologica`
--

INSERT INTO `red_tecnologica` (`idred_tecnologica`, `nombre_red_tecnologica`, `linea_tecnologica_idlinea_tecnologica`) VALUES
(32, 'Red de Hotelería y turismo', 11),
(33, 'LOGISTICA Y TRANSPORTE', 12),
(34, 'GESTION ADMINISTRATIVA Y FINANCIERA', 10),
(35, 'SERVICIOS DE ALOJAMIENTO', 11),
(36, 'COORDINACION DE SERVICIOS HOTELEROS', 11),
(37, 'Red de Gestión administrativa y financiera', 15),
(38, 'Red de Comercio y ventas', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguimiento`
--

CREATE TABLE `seguimiento` (
  `idseguimiento` int(11) NOT NULL,
  `fecha_radicado` date DEFAULT NULL,
  `fecha_inicio_practica` date DEFAULT NULL,
  `fecha_fin_practica_seguimiento` date DEFAULT NULL,
  `modalidad_idmodalidad` int(11) NOT NULL,
  `aprendiz_idaprendiz` int(11) NOT NULL,
  `empresa_idempresa` int(11) NOT NULL,
  `estado_etapa` varchar(1) NOT NULL COMMENT '1 = parcial 2= final vacio = sin asignar',
  `estado_etapa_practica` varchar(25) NOT NULL COMMENT ' 	1 = cerrado, 2 = abierto 	',
  `etapa_fragmentada` varchar(25) DEFAULT NULL COMMENT 'vacio = no, 1 = si ',
  `observacion_seguimiento` varchar(900) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `seguimiento`
--

INSERT INTO `seguimiento` (`idseguimiento`, `fecha_radicado`, `fecha_inicio_practica`, `fecha_fin_practica_seguimiento`, `modalidad_idmodalidad`, `aprendiz_idaprendiz`, `empresa_idempresa`, `estado_etapa`, `estado_etapa_practica`, `etapa_fragmentada`, `observacion_seguimiento`) VALUES
(1, '2026-06-02', '2026-03-01', '2026-08-31', 2, 1, 1, '', '1', NULL, NULL),
(2, '2026-06-12', '2026-06-01', '2026-11-30', 1, 73, 1227, '4', '1', NULL, 'null'),
(3, '2026-06-03', '2026-06-03', '2026-12-03', 1, 72, 784, '3', '1', '1', 'se cambio por que el trabajo no era relacionado con el programa de formacion'),
(4, '2026-06-03', '2026-06-03', '2027-01-04', 1, 83, 1079, '4', '1', NULL, NULL),
(5, '2026-06-03', '2026-06-03', '2027-01-03', 1, 81, 1090, '3', '1', NULL, NULL),
(6, '2026-06-03', '2026-05-03', '2026-06-03', 1, 87, 784, '3', '1', NULL, NULL),
(7, '2026-06-03', '2026-08-03', '2026-10-08', 3, 72, 1079, '6', '1', NULL, NULL),
(8, '2026-06-03', '2025-06-03', '2026-06-02', 1, 101, 784, '3', '1', NULL, 'cambio de ficha'),
(9, '2026-06-03', '2026-06-06', '2026-11-07', 1, 78, 966, '3', '1', NULL, NULL),
(10, '2026-06-04', '2025-12-04', '2026-06-03', 1, 95, 1129, '5', '1', NULL, NULL),
(11, '2026-06-12', '2026-10-23', '2027-04-22', 1, 162, 1079, '4', '1', NULL, 'null'),
(12, '2026-06-12', '2027-11-24', '2028-05-23', 1, 192, 784, '3', '1', NULL, NULL),
(13, '2026-06-12', '2026-06-01', '2026-11-30', 1, 61, 1079, '', '1', NULL, NULL),
(14, '2026-06-12', '2026-06-01', '2026-11-30', 1, 62, 1061, '', '1', NULL, NULL),
(15, '2026-06-12', '2026-06-01', '2026-11-30', 1, 63, 1079, '', '1', NULL, NULL),
(16, '2026-06-12', '2026-06-01', '2026-11-30', 1, 64, 1061, '', '1', NULL, NULL),
(17, '2026-06-12', '2026-06-01', '2026-11-30', 1, 65, 1079, '', '1', NULL, NULL),
(18, '2026-06-12', '2026-06-01', '2026-11-30', 1, 3, 1079, '', '1', NULL, NULL),
(19, '2026-06-12', '2026-06-01', '2026-06-30', 1, 5, 1079, '3', '1', NULL, NULL),
(20, '2026-07-03', '2026-07-03', '2026-12-03', 1, 230, 1079, '', '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `idtipo_documento` int(11) NOT NULL,
  `nombre_tipo_documento` varchar(45) DEFAULT NULL,
  `abreviatura_tipo_documento` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`idtipo_documento`, `nombre_tipo_documento`, `abreviatura_tipo_documento`) VALUES
(1, 'Cedula Ciudadanía', 'CC'),
(2, 'Tarjeta de Identidad', 'TI'),
(3, 'Cedula Extranjería', 'CE'),
(4, 'PPT', 'PPT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_funcionario`
--

CREATE TABLE `tipo_funcionario` (
  `idtipo_funcionario` int(11) NOT NULL,
  `nombre_tipo_funcionario` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `tipo_funcionario`
--

INSERT INTO `tipo_funcionario` (`idtipo_funcionario`, `nombre_tipo_funcionario`) VALUES
(1, 'Instructor'),
(2, 'Administrativo'),
(3, 'Caprendizaje'),
(4, 'Admin Seguimientos'),
(5, 'Certificación'),
(6, 'Coordinación Académica'),
(7, 'Formato 165');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_programa`
--

CREATE TABLE `tipo_programa` (
  `idtipo_programa` int(11) NOT NULL,
  `nombre_programa` varchar(80) DEFAULT NULL,
  `duracion_programa` int(11) DEFAULT NULL,
  `descripcion_programa` varchar(150) DEFAULT NULL,
  `duracion_practica` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `tipo_programa`
--

INSERT INTO `tipo_programa` (`idtipo_programa`, `nombre_programa`, `duracion_programa`, `descripcion_programa`, `duracion_practica`) VALUES
(1, 'Tecnólogo', 18, 'Tecnólogo 18 meses antiguo', '6'),
(2, 'Tecnólogo', 24, 'Tecnólogo 24 meses nuevo', '6'),
(3, 'Tecnólogo', 27, 'Tecnólogo de 27 meses', '6'),
(4, 'Técnico', 15, 'Técnico de 15 meses', '6'),
(5, 'Técnico', 12, 'Técnico de 12 meses', '6'),
(6, 'Operario', 6, 'Operario 6 meses', '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_seguimiento`
--

CREATE TABLE `tipo_seguimiento` (
  `idtipo_seguimiento` int(11) NOT NULL,
  `nombre_tipo_seguimiento` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `tipo_seguimiento`
--

INSERT INTO `tipo_seguimiento` (`idtipo_seguimiento`, `nombre_tipo_seguimiento`) VALUES
(1, 'Parcial'),
(2, 'Final'),
(3, 'Seguimiento momento 1'),
(4, 'Seguimiento momento 2'),
(5, 'Seguimiento momento 3'),
(6, 'Seguimiento extraordinario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita_seguimiento`
--

CREATE TABLE `visita_seguimiento` (
  `idvisita_seguimiento` int(11) NOT NULL,
  `url_documento` varchar(250) DEFAULT NULL,
  `url_juicio_evaluativo` varchar(300) DEFAULT NULL,
  `seguimiento_idseguimiento` int(11) NOT NULL,
  `funcionario_idfuncionario` int(11) NOT NULL,
  `tipo_seguimiento_idtipo_seguimiento` int(11) NOT NULL,
  `fecha_radicado` date DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `estado_visita_seguimiento_idestado_visita_seguimiento` int(11) NOT NULL,
  `asignacion` varchar(1) NOT NULL COMMENT '1 o vacio = preAsignado 2= Asignado',
  `instructor_notificado` varchar(2) DEFAULT NULL COMMENT '1= notificado 2 sin notificar',
  `estado_reporte` varchar(2) NOT NULL COMMENT 'vacio = sin documento\\r\\n0 = entregado\\r\\n1 = Aprovado\\r\\n2 = rechazado',
  `direccion_visita` varchar(100) NOT NULL,
  `ubicacion_seguimiento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;

--
-- Volcado de datos para la tabla `visita_seguimiento`
--

INSERT INTO `visita_seguimiento` (`idvisita_seguimiento`, `url_documento`, `url_juicio_evaluativo`, `seguimiento_idseguimiento`, `funcionario_idfuncionario`, `tipo_seguimiento_idtipo_seguimiento`, `fecha_radicado`, `fecha_vencimiento`, `fecha_entrega`, `estado_visita_seguimiento_idestado_visita_seguimiento`, `asignacion`, `instructor_notificado`, `estado_reporte`, `direccion_visita`, `ubicacion_seguimiento`) VALUES
(2, NULL, NULL, 4, 3, 3, '2026-06-03', '2026-06-25', NULL, 1, '2', '1', '', '', 'Presencial'),
(7, NULL, NULL, 4, 3, 4, '2026-06-03', '2026-08-03', NULL, 1, '2', '1', '', '', 'Presencial'),
(9, NULL, NULL, 5, 3, 3, '2026-06-03', '2026-06-30', NULL, 1, '2', '1', '', '', 'Presencial'),
(10, 'archivos/aprendices/2660182/1007855309/seguimiento/Seguimiento-6a208a4b63fe3.pdf', '', 3, 3, 3, '2026-06-03', '2026-06-30', '2026-06-03', 2, '2', '1', '1', '', 'Presencial'),
(11, 'archivos/aprendices/2660182/1007855309/seguimiento/Seguimiento-6a208bfbd93a2.pdf', NULL, 7, 8, 3, '2026-06-03', '2026-06-03', '2026-06-03', 2, '2', '1', '1', '', ''),
(12, NULL, NULL, 7, 3, 6, '2026-06-03', '2026-06-25', NULL, 1, '2', '1', '', '', 'Presencial'),
(13, 'archivos/aprendices/22222/1232460825/seguimiento/Seguimiento-6a20c8d36f0c7.pdf', '', 8, 3, 3, '2026-06-03', '2026-06-03', '2026-06-03', 2, '2', '1', '1', 'cartagena calle 12', 'Presencial'),
(14, 'archivos/aprendices/22222/1232460825/seguimiento/Seguimiento-6a20cd233d122.pdf', '', 8, 3, 4, '2026-06-03', '2026-06-04', '2026-06-03', 2, '2', '1', '1', 'cartagena calle 12', 'Presencial'),
(15, 'archivos/aprendices/22222/1232460825/seguimiento/Seguimiento-6a20cd451cb06.pdf', 'archivos/aprendices/22222/1232460825/seguimiento/Juicio-6a20cd451d033.jpg', 8, 3, 5, '2026-06-03', '2026-06-05', '2026-06-03', 2, '2', '1', '1', 'cartagena calle 12', 'Presencial'),
(16, NULL, NULL, 9, 3, 3, '2026-06-03', '2026-06-25', NULL, 1, '2', '1', '', '', 'Presencial'),
(18, 'archivos/aprendices/22222/1232460819/seguimiento/Seguimiento-6a21943864c3b.pdf', '', 10, 12, 3, '2026-06-04', '2026-06-30', '2026-06-04', 2, '2', '1', '1', 'calle 23 # 14-23', 'Presencial'),
(19, NULL, NULL, 6, 12, 3, '2026-06-04', '2026-06-11', NULL, 1, '2', '1', '', '', 'Presencial'),
(20, 'archivos/aprendices/22222/1232460819/seguimiento/Seguimiento-6a21b286d490a.pdf', '', 10, 12, 4, '2026-06-04', '2026-06-04', '2026-06-04', 2, '2', '1', '1', '', 'Presencial'),
(21, 'archivos/aprendices/22222/1232460819/seguimiento/Seguimiento-6a21b5ee67607.pdf', 'archivos/aprendices/22222/1232460819/seguimiento/Juicio-6a21b5ee677bb.png', 10, 12, 5, '2026-06-04', '2026-06-04', '2026-06-04', 2, '2', '1', '1', '', 'Presencial'),
(22, 'archivos/aprendices/3231178/1002192821/seguimiento/Seguimiento-6a2840e5caa64.xls', '', 11, 9, 3, '2026-06-09', '2026-11-15', '2026-06-09', 2, '2', '1', '2', '', 'Presencial'),
(23, NULL, NULL, 11, 9, 4, '2026-06-09', '2027-02-02', NULL, 1, '2', '1', '', '', 'Presencial'),
(24, NULL, NULL, 2, 23, 4, '2026-06-11', '2026-06-30', NULL, 1, '2', '1', '', '', 'Virtual'),
(26, NULL, NULL, 12, 8, 3, '2026-06-12', '2028-06-23', NULL, 1, '2', '1', '', '', 'Presencial'),
(28, 'archivos/aprendices/3185861/888888/seguimiento/Seguimiento-6a4bbed4baadb.xlsx', '', 19, 16, 3, '2026-07-03', '2026-08-03', '2026-07-06', 2, '2', '1', '0', '', 'Presencial'),
(29, 'archivos/aprendices/22222/1232460825/seguimiento/Seguimiento-6a4bcda5114ba.pdf', '', 8, 16, 3, '2026-07-06', '2026-08-06', '2026-07-06', 2, '2', '1', '0', '', 'Presencial');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aprendices_certificados`
--
ALTER TABLE `aprendices_certificados`
  ADD PRIMARY KEY (`idaprendices_certificados`);

--
-- Indices de la tabla `aprendiz`
--
ALTER TABLE `aprendiz`
  ADD PRIMARY KEY (`idaprendiz`),
  ADD KEY `fk_aprendiz_ficha_idx` (`ficha_idficha`),
  ADD KEY `fk_aprendiz_tipo_documento1_idx` (`tipo_documento_idtipo_documento`),
  ADD KEY `fk_aprendiz_estado_aprendiz1_idx` (`estado_aprendiz_idestado_aprendiz`);

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`idbitacora`),
  ADD KEY `fk_bitacora_aprendiz1_idx` (`aprendiz_idaprendiz`);

--
-- Indices de la tabla `certificacion`
--
ALTER TABLE `certificacion`
  ADD PRIMARY KEY (`idcertificacion`),
  ADD KEY `fk_seguimiento_aprendiz1_idx` (`aprendiz_idaprendiz`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`codi_depa`),
  ADD KEY `fk_departamentos_paises1_idx` (`paises_codi_pais`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`idempresa`),
  ADD KEY `fk_empresa_municipios1_idx` (`municipios_codi_muni`);

--
-- Indices de la tabla `estado_aprendiz`
--
ALTER TABLE `estado_aprendiz`
  ADD PRIMARY KEY (`idestado_aprendiz`);

--
-- Indices de la tabla `estado_ficha`
--
ALTER TABLE `estado_ficha`
  ADD PRIMARY KEY (`idestado_ficha`);

--
-- Indices de la tabla `estado_visita_seguimiento`
--
ALTER TABLE `estado_visita_seguimiento`
  ADD PRIMARY KEY (`idestado_visita_seguimiento`);

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`idficha`),
  ADD KEY `fk_ficha_estado_ficha1_idx` (`estado_ficha_idestado_ficha`),
  ADD KEY `fk_ficha_tipo_programa1_idx` (`tipo_programa_idtipo_programa`),
  ADD KEY `fk_ficha_red_tecnologica1_idx` (`red_tecnologica_idred_tecnologica`);

--
-- Indices de la tabla `ficha_has_funcionario`
--
ALTER TABLE `ficha_has_funcionario`
  ADD PRIMARY KEY (`ficha_idficha`,`funcionario_idfuncionario`),
  ADD KEY `fk_ficha_has_funcionario_funcionario1_idx` (`funcionario_idfuncionario`),
  ADD KEY `fk_ficha_has_funcionario_ficha1_idx` (`ficha_idficha`);

--
-- Indices de la tabla `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`idfuncionario`),
  ADD KEY `fk_funcionario_tipo_funcionario1_idx` (`tipo_funcionario_idtipo_funcionario`),
  ADD KEY `fk_funcionario_tipo_documento1_idx` (`tipo_documento_idtipo_documento`),
  ADD KEY `fk_funcionario_municipios1_idx` (`municipios_codi_muni`);

--
-- Indices de la tabla `linea_tecnologica`
--
ALTER TABLE `linea_tecnologica`
  ADD PRIMARY KEY (`idlinea_tecnologica`);

--
-- Indices de la tabla `modalidad`
--
ALTER TABLE `modalidad`
  ADD PRIMARY KEY (`idmodalidad`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`codi_muni`),
  ADD KEY `fk_municipios_departamentos1_idx` (`departamentos_codi_depa`);

--
-- Indices de la tabla `novedad_visita_seguimiento`
--
ALTER TABLE `novedad_visita_seguimiento`
  ADD PRIMARY KEY (`idnovedad_visita_seguimiento`),
  ADD KEY `visita_seguimiento_idvisita_seguimiento` (`visita_seguimiento_idvisita_seguimiento`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`codi_pais`);

--
-- Indices de la tabla `procesos_empresas`
--
ALTER TABLE `procesos_empresas`
  ADD PRIMARY KEY (`idproceso`);

--
-- Indices de la tabla `procesos_seguimientos`
--
ALTER TABLE `procesos_seguimientos`
  ADD PRIMARY KEY (`idproceso`);

--
-- Indices de la tabla `recuperacion_contrasena`
--
ALTER TABLE `recuperacion_contrasena`
  ADD PRIMARY KEY (`id_recuperacion`),
  ADD KEY `fk_recuperacion_contrasena_funcionario1_idx` (`funcionario_idfuncionario`);

--
-- Indices de la tabla `recuperacion_contrasena_aprendiz`
--
ALTER TABLE `recuperacion_contrasena_aprendiz`
  ADD PRIMARY KEY (`id_recuperacion`),
  ADD KEY `fk_recuperacion_contrasena_aprendiz_aprendiz1_idx` (`aprendiz_idaprendiz`);

--
-- Indices de la tabla `red_tecnologica`
--
ALTER TABLE `red_tecnologica`
  ADD PRIMARY KEY (`idred_tecnologica`),
  ADD KEY `fk_red_tecnologica_linea_tecnologica1_idx` (`linea_tecnologica_idlinea_tecnologica`);

--
-- Indices de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  ADD PRIMARY KEY (`idseguimiento`),
  ADD KEY `fk_seguimiento_modalidad1_idx` (`modalidad_idmodalidad`),
  ADD KEY `fk_seguimiento_aprendiz1_idx` (`aprendiz_idaprendiz`),
  ADD KEY `fk_seguimiento_empresa1_idx` (`empresa_idempresa`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`idtipo_documento`);

--
-- Indices de la tabla `tipo_funcionario`
--
ALTER TABLE `tipo_funcionario`
  ADD PRIMARY KEY (`idtipo_funcionario`);

--
-- Indices de la tabla `tipo_programa`
--
ALTER TABLE `tipo_programa`
  ADD PRIMARY KEY (`idtipo_programa`);

--
-- Indices de la tabla `tipo_seguimiento`
--
ALTER TABLE `tipo_seguimiento`
  ADD PRIMARY KEY (`idtipo_seguimiento`);

--
-- Indices de la tabla `visita_seguimiento`
--
ALTER TABLE `visita_seguimiento`
  ADD PRIMARY KEY (`idvisita_seguimiento`),
  ADD KEY `fk_visita_seguimiento_seguimiento1_idx` (`seguimiento_idseguimiento`),
  ADD KEY `fk_visita_seguimiento_funcionario1_idx` (`funcionario_idfuncionario`),
  ADD KEY `fk_visita_seguimiento_tipo_seguimiento1_idx` (`tipo_seguimiento_idtipo_seguimiento`),
  ADD KEY `fk_visita_seguimiento_estado_visita_seguimiento1_idx` (`estado_visita_seguimiento_idestado_visita_seguimiento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aprendices_certificados`
--
ALTER TABLE `aprendices_certificados`
  MODIFY `idaprendices_certificados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `aprendiz`
--
ALTER TABLE `aprendiz`
  MODIFY `idaprendiz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=252;

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `idbitacora` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `certificacion`
--
ALTER TABLE `certificacion`
  MODIFY `idcertificacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `idempresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1228;

--
-- AUTO_INCREMENT de la tabla `estado_aprendiz`
--
ALTER TABLE `estado_aprendiz`
  MODIFY `idestado_aprendiz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `estado_ficha`
--
ALTER TABLE `estado_ficha`
  MODIFY `idestado_ficha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estado_visita_seguimiento`
--
ALTER TABLE `estado_visita_seguimiento`
  MODIFY `idestado_visita_seguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ficha`
--
ALTER TABLE `ficha`
  MODIFY `idficha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `idfuncionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `linea_tecnologica`
--
ALTER TABLE `linea_tecnologica`
  MODIFY `idlinea_tecnologica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `modalidad`
--
ALTER TABLE `modalidad`
  MODIFY `idmodalidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `novedad_visita_seguimiento`
--
ALTER TABLE `novedad_visita_seguimiento`
  MODIFY `idnovedad_visita_seguimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `procesos_empresas`
--
ALTER TABLE `procesos_empresas`
  MODIFY `idproceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `procesos_seguimientos`
--
ALTER TABLE `procesos_seguimientos`
  MODIFY `idproceso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `recuperacion_contrasena`
--
ALTER TABLE `recuperacion_contrasena`
  MODIFY `id_recuperacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `recuperacion_contrasena_aprendiz`
--
ALTER TABLE `recuperacion_contrasena_aprendiz`
  MODIFY `id_recuperacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `red_tecnologica`
--
ALTER TABLE `red_tecnologica`
  MODIFY `idred_tecnologica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  MODIFY `idseguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `idtipo_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_funcionario`
--
ALTER TABLE `tipo_funcionario`
  MODIFY `idtipo_funcionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tipo_programa`
--
ALTER TABLE `tipo_programa`
  MODIFY `idtipo_programa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_seguimiento`
--
ALTER TABLE `tipo_seguimiento`
  MODIFY `idtipo_seguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `visita_seguimiento`
--
ALTER TABLE `visita_seguimiento`
  MODIFY `idvisita_seguimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `aprendiz`
--
ALTER TABLE `aprendiz`
  ADD CONSTRAINT `fk_aprendiz_estado_aprendiz1` FOREIGN KEY (`estado_aprendiz_idestado_aprendiz`) REFERENCES `estado_aprendiz` (`idestado_aprendiz`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_aprendiz_ficha` FOREIGN KEY (`ficha_idficha`) REFERENCES `ficha` (`idficha`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_aprendiz_tipo_documento1` FOREIGN KEY (`tipo_documento_idtipo_documento`) REFERENCES `tipo_documento` (`idtipo_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `fk-aprendiz-bitacora` FOREIGN KEY (`aprendiz_idaprendiz`) REFERENCES `aprendiz` (`idaprendiz`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `certificacion`
--
ALTER TABLE `certificacion`
  ADD CONSTRAINT `certificacion_ibfk_1` FOREIGN KEY (`aprendiz_idaprendiz`) REFERENCES `aprendiz` (`idaprendiz`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD CONSTRAINT `fk-pais-dept` FOREIGN KEY (`paises_codi_pais`) REFERENCES `paises` (`codi_pais`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD CONSTRAINT `fk-estado-ficha` FOREIGN KEY (`estado_ficha_idestado_ficha`) REFERENCES `estado_ficha` (`idestado_ficha`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-red-ficha` FOREIGN KEY (`red_tecnologica_idred_tecnologica`) REFERENCES `red_tecnologica` (`idred_tecnologica`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-tipopro-ficha` FOREIGN KEY (`tipo_programa_idtipo_programa`) REFERENCES `tipo_programa` (`idtipo_programa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ficha_has_funcionario`
--
ALTER TABLE `ficha_has_funcionario`
  ADD CONSTRAINT `fk-ficha-fhf` FOREIGN KEY (`ficha_idficha`) REFERENCES `ficha` (`idficha`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-funcionario-fufi` FOREIGN KEY (`funcionario_idfuncionario`) REFERENCES `funcionario` (`idfuncionario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `fk-municipio-funcionario` FOREIGN KEY (`municipios_codi_muni`) REFERENCES `municipios` (`codi_muni`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-tipodoc-funcionario` FOREIGN KEY (`tipo_documento_idtipo_documento`) REFERENCES `tipo_documento` (`idtipo_documento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-tipofuncio-funcionario` FOREIGN KEY (`tipo_funcionario_idtipo_funcionario`) REFERENCES `tipo_funcionario` (`idtipo_funcionario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `fk-dep-muni` FOREIGN KEY (`departamentos_codi_depa`) REFERENCES `departamentos` (`codi_depa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `novedad_visita_seguimiento`
--
ALTER TABLE `novedad_visita_seguimiento`
  ADD CONSTRAINT `fk-visitaseg-novedadvisseg` FOREIGN KEY (`visita_seguimiento_idvisita_seguimiento`) REFERENCES `visita_seguimiento` (`idvisita_seguimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recuperacion_contrasena`
--
ALTER TABLE `recuperacion_contrasena`
  ADD CONSTRAINT `fk-funcionario-recuperacion` FOREIGN KEY (`funcionario_idfuncionario`) REFERENCES `funcionario` (`idfuncionario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `recuperacion_contrasena_aprendiz`
--
ALTER TABLE `recuperacion_contrasena_aprendiz`
  ADD CONSTRAINT `fk-aprendiz-recuperacion` FOREIGN KEY (`aprendiz_idaprendiz`) REFERENCES `aprendiz` (`idaprendiz`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `red_tecnologica`
--
ALTER TABLE `red_tecnologica`
  ADD CONSTRAINT `fk_red_tecnologica_linea_tecnologica1` FOREIGN KEY (`linea_tecnologica_idlinea_tecnologica`) REFERENCES `linea_tecnologica` (`idlinea_tecnologica`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `seguimiento`
--
ALTER TABLE `seguimiento`
  ADD CONSTRAINT `fk-aprendiz-seguimiento` FOREIGN KEY (`aprendiz_idaprendiz`) REFERENCES `aprendiz` (`idaprendiz`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-empresa-seguimiento` FOREIGN KEY (`empresa_idempresa`) REFERENCES `empresa` (`idempresa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-modalidad-seguimiento` FOREIGN KEY (`modalidad_idmodalidad`) REFERENCES `modalidad` (`idmodalidad`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `visita_seguimiento`
--
ALTER TABLE `visita_seguimiento`
  ADD CONSTRAINT `fk-estadovisita-visitasegui` FOREIGN KEY (`estado_visita_seguimiento_idestado_visita_seguimiento`) REFERENCES `estado_visita_seguimiento` (`idestado_visita_seguimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-funcionario-visitasegu` FOREIGN KEY (`funcionario_idfuncionario`) REFERENCES `funcionario` (`idfuncionario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-seguimiento-visitaseguimiento` FOREIGN KEY (`seguimiento_idseguimiento`) REFERENCES `seguimiento` (`idseguimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk-tiposeg-visitaseg` FOREIGN KEY (`tipo_seguimiento_idtipo_seguimiento`) REFERENCES `tipo_seguimiento` (`idtipo_seguimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
