# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.5.12
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2012-01-05 20:43:54
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping structure for table lfg.administrador
DROP TABLE IF EXISTS `administrador`;
CREATE TABLE IF NOT EXISTS `administrador` (
  `IdAdministrador` int(11) NOT NULL AUTO_INCREMENT,
  `Login` varchar(100) DEFAULT NULL,
  `Clave` longtext,
  PRIMARY KEY (`IdAdministrador`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

# Dumping data for table lfg.administrador: 1 rows
DELETE FROM `administrador`;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT INTO `administrador` (`IdAdministrador`, `Login`, `Clave`) VALUES
	(2, 'admin', 'admin123');
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;


# Dumping structure for table lfg.archivos
DROP TABLE IF EXISTS `archivos`;
CREATE TABLE IF NOT EXISTS `archivos` (
  `id_archivo` int(11) NOT NULL AUTO_INCREMENT,
  `carpeta` varchar(150) DEFAULT NULL,
  `nombreArchivo` varchar(200) DEFAULT NULL,
  `texto` varchar(400) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `cant_descarga` decimal(2,0) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `speaker` varchar(30) DEFAULT NULL,
  `estado` int(1) DEFAULT '1',
  `archivo1` varchar(100) DEFAULT NULL,
  `archivo2` varchar(100) DEFAULT NULL,
  `archivo3` varchar(100) DEFAULT NULL,
  `TIPO_TRANSMISION` varchar(10) DEFAULT NULL,
  `FECHA_HORA_TRANSMISION` timestamp NULL DEFAULT NULL COMMENT 'si es un video live',
  `visualizaciones` int(7) NOT NULL DEFAULT '0' COMMENT 'conteo de visualizaciones',
  `tema` varchar(150) DEFAULT NULL,
  `fechaLanzamiento` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_archivo`),
  KEY `nombreArchivo` (`nombreArchivo`)
) ENGINE=MyISAM AUTO_INCREMENT=3177 DEFAULT CHARSET=utf8;

# Dumping data for table lfg.archivos: 24 rows
DELETE FROM `archivos`;
/*!40000 ALTER TABLE `archivos` DISABLE KEYS */;
INSERT INTO `archivos` (`id_archivo`, `carpeta`, `nombreArchivo`, `texto`, `titulo`, `cant_descarga`, `imagen`, `speaker`, `estado`, `archivo1`, `archivo2`, `archivo3`, `TIPO_TRANSMISION`, `FECHA_HORA_TRANSMISION`, `visualizaciones`, `tema`, `fechaLanzamiento`) VALUES
	(3126, 'http://tvclass.rampms.com/tvclass/', 'pas1_11.wmv', 'Aula 11', 'Pasaporte 1 - Aula 11', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 99, NULL, NULL),
	(3127, 'http://tvclass.rampms.com/tvclass/', 'pas1_12.wmv', 'Aula 12', 'Pasaporte 1 - Aula 12', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 10, NULL, NULL),
	(3128, 'http://tvclass.rampms.com/tvclass/', 'lat1_11.wmv', 'Aula 11', 'Latitudes 1 - Aula 11', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 9, NULL, NULL),
	(3129, 'http://tvclass.rampms.com/tvclass/', 'lat1_12.wmv', 'Aula 12', 'Latitudes 1 - Aula 12', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 9, NULL, NULL),
	(3130, 'rtmp://iptv.rampms.com:8082/vod/', 'MP4:bigbuckbunny_750.mp4', 'Flash', 'Flash', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, NULL, NULL, 257, NULL, NULL),
	(3131, 'http://tvclass.rampms.com/tvclass/', 'intro_3-1.wmv', 'Aula 3.1', 'Intro - Aula 3.1', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', '2010-05-04 14:00:00', 24, NULL, NULL),
	(3132, 'http://tvclass.rampms.com/tvclass/', 'intro_3-2.wmv', 'Aula 3.2', 'Intro - Aula 3.2', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 2, NULL, NULL),
	(3133, 'http://tvclass.rampms.com/tvclass/', 'intro_3-3.wmv', 'Aula 3.3', 'Intro - Aula 3.3', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 3, NULL, NULL),
	(3134, 'http://tvclass.rampms.com/tvclass/', 'ts1_3-1.wmv', 'Aula 3.1', 'TouchStone 1 - Aula 3.1', NULL, '../speakers/Picture0001.jpg', 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', '2010-06-30 00:00:00', 181, NULL, NULL),
	(3135, 'http://tvclass.rampms.com/tvclass/', 'ts1_3-2.wmv', 'Aula 3.2', 'TouchStone 1 - Aula 3.2', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 84, NULL, NULL),
	(3136, 'http://tvclass.rampms.com/tvclass/', 'ts1_3-3.wmv', 'Aula 3.3', 'TouchStone 1 - Aula 3.3', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 47, NULL, NULL),
	(3137, 'http://tvclass.rampms.com/tvclass/', 'ts1_3-4.wmv', 'Aula 3.4', 'TouchStone 1 - Aula 3.4', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 23, NULL, NULL),
	(3138, 'http://tvclass.rampms.com/tvclass/', 'ts2_2-5.wmv', 'Aula 2.5', 'TouchStone 2 - Aula 2.5', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 23, NULL, NULL),
	(3139, 'http://tvclass.rampms.com/tvclass/', 'ts2_3-1.wmv', 'Aula 3.1', 'TouchStone 2 - Aula 3.1', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 71, NULL, NULL),
	(3140, 'http://tvclass.rampms.com/tvclass/', 'ts2_3-2.wmv', 'Aula 3.2', 'TouchStone 2 - Aula 3.2', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 53, NULL, NULL),
	(3141, 'http://tvclass.rampms.com/tvclass/', 'ts2_3-3.wmv', 'Aula 3.3', 'TouchStone 2 - Aula 3.3', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 16, NULL, NULL),
	(3142, 'http://tvclass.rampms.com/tvclass/', 'ts3_3-1.wmv', 'Aula 3.1', 'TouchStone 3 - Aula 3.1', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 5, NULL, NULL),
	(3143, 'http://tvclass.rampms.com/tvclass/', 'ts3_3-2.wmv', 'Aula 3.2', 'TouchStone 3 - Aula 3.2', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 5, NULL, NULL),
	(3144, 'http://tvclass.rampms.com/tvclass/', 'ts4_2-5.wmv', 'Aula 2.5', 'TouchStone 4 - Aula 2.5', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 0, NULL, NULL),
	(3145, 'http://tvclass.rampms.com/tvclass/', 'ts4_3-1.wmv', 'Aula 3.1', 'TouchStone 4 - Aula 3.1', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 0, NULL, NULL),
	(3146, 'http://tvclass.rampms.com/tvclass/', 'more1_2-1.wmv', 'Aula 2.1', 'More - Aula 2.1', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 3, NULL, NULL),
	(3147, 'http://tvclass.rampms.com/tvclass/', 'more1_2-2.wmv', 'Aula 2.2', 'More - Aula 2.2', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 8, NULL, NULL),
	(3148, 'http://tvclass.rampms.com/tvclass/', 'kb1_4-2.wmv', 'Aula 4.1', 'capitan lento', NULL, NULL, 'TV Class', 1, NULL, NULL, NULL, 'ONDEMAND', NULL, 8, NULL, NULL),
	(3153, 'http://webcenter.rampms.com/', 'vic.flv', 'teste', 'teste', NULL, NULL, 'teste', 1, NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL);
/*!40000 ALTER TABLE `archivos` ENABLE KEYS */;


# Dumping structure for table lfg.archivos_grupo
DROP TABLE IF EXISTS `archivos_grupo`;
CREATE TABLE IF NOT EXISTS `archivos_grupo` (
  `id_interno` int(11) NOT NULL AUTO_INCREMENT,
  `id_grupo` int(11) DEFAULT NULL,
  `id_archivo` int(11) DEFAULT NULL,
  `fecha_inserta` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_interno`),
  UNIQUE KEY `idxnegocio` (`id_grupo`,`id_archivo`)
) ENGINE=MyISAM AUTO_INCREMENT=2927 DEFAULT CHARSET=utf8;

# Dumping data for table lfg.archivos_grupo: 83 rows
DELETE FROM `archivos_grupo`;
/*!40000 ALTER TABLE `archivos_grupo` DISABLE KEYS */;
INSERT INTO `archivos_grupo` (`id_interno`, `id_grupo`, `id_archivo`, `fecha_inserta`) VALUES
	(2761, 9, 3132, '2011-03-13 23:01:22'),
	(2850, 11, 3127, '2011-12-21 14:09:07'),
	(2752, 10, 3133, '2010-12-13 10:43:03'),
	(2760, 9, 3131, '2011-03-13 23:01:21'),
	(2749, 10, 3151, '2010-07-19 11:30:32'),
	(2751, 10, 3128, '2010-12-13 10:42:41'),
	(2753, 14, 3150, '2011-03-13 21:34:06'),
	(2756, 9, 3127, '2011-03-13 23:01:19'),
	(2744, 9, 3126, '2010-07-18 10:41:04'),
	(2755, 9, 3149, '2011-03-13 22:56:39'),
	(2757, 9, 3128, '2011-03-13 23:01:20'),
	(2759, 9, 3130, '2011-03-13 23:01:21'),
	(2758, 9, 3129, '2011-03-13 23:01:20'),
	(2762, 9, 3133, '2011-03-13 23:01:22'),
	(2763, 9, 3134, '2011-03-13 23:01:23'),
	(2764, 22, 3151, '2011-03-15 18:11:30'),
	(2765, 9, 3153, '2011-03-22 18:03:39'),
	(2810, 2, 3126, '2011-12-09 16:03:08'),
	(2811, 2, 3127, '2011-12-09 16:03:08'),
	(2768, 2, 3129, '2011-12-09 14:08:43'),
	(2806, 2, 3128, '2011-12-09 15:59:27'),
	(2812, 2, 3130, '2011-12-09 16:03:16'),
	(2771, 2, 3131, '2011-12-09 14:08:53'),
	(2772, 2, 3132, '2011-12-09 14:08:53'),
	(2885, 1, 3138, '2011-12-29 19:59:06'),
	(2907, 10, 3153, '2011-12-29 20:14:33'),
	(2883, 1, 3136, '2011-12-29 19:59:06'),
	(2908, 10, 3150, '2011-12-29 20:14:35'),
	(2912, 10, 3152, '2011-12-29 20:14:42'),
	(2909, 10, 3148, '2011-12-29 20:14:36'),
	(2910, 10, 3149, '2011-12-29 20:14:39'),
	(2922, 7, 3126, '2012-01-02 17:19:16'),
	(2867, 3, 3127, '2011-12-28 17:24:24'),
	(2866, 3, 3128, '2011-12-28 17:24:17'),
	(2865, 3, 3126, '2011-12-28 17:24:13'),
	(2903, 1, 3129, '2011-12-29 20:01:11'),
	(2901, 1, 3127, '2011-12-29 20:01:11'),
	(2911, 10, 3146, '2011-12-29 20:14:40'),
	(2879, 1, 3132, '2011-12-29 19:59:06'),
	(2860, 11, 3153, '2011-12-21 14:11:40'),
	(2859, 11, 3152, '2011-12-21 14:11:39'),
	(2858, 11, 3151, '2011-12-21 14:11:36'),
	(2857, 11, 3128, '2011-12-21 14:11:18'),
	(2856, 11, 3131, '2011-12-21 14:11:09'),
	(2855, 11, 3129, '2011-12-21 14:11:07'),
	(2854, 11, 3133, '2011-12-21 14:11:05'),
	(2853, 11, 3132, '2011-12-21 14:11:03'),
	(2816, 2, 3140, '2011-12-15 18:32:11'),
	(2815, 2, 3142, '2011-12-15 18:32:11'),
	(2880, 1, 3133, '2011-12-29 19:59:06'),
	(2852, 11, 3126, '2011-12-21 14:09:10'),
	(2809, 2, 3133, '2011-12-09 15:59:27'),
	(2851, 11, 3130, '2011-12-21 14:09:09'),
	(2849, 8, 3130, '2011-12-19 16:48:14'),
	(2848, 8, 3127, '2011-12-19 16:48:12'),
	(2847, 8, 3126, '2011-12-19 16:48:12'),
	(2886, 1, 3139, '2011-12-29 19:59:06'),
	(2887, 1, 3140, '2011-12-29 19:59:06'),
	(2888, 1, 3141, '2011-12-29 19:59:06'),
	(2889, 1, 3142, '2011-12-29 19:59:06'),
	(2890, 1, 3143, '2011-12-29 19:59:06'),
	(2891, 1, 3144, '2011-12-29 19:59:06'),
	(2892, 1, 3145, '2011-12-29 19:59:06'),
	(2893, 1, 3146, '2011-12-29 19:59:06'),
	(2894, 1, 3147, '2011-12-29 19:59:06'),
	(2895, 1, 3148, '2011-12-29 19:59:06'),
	(2896, 1, 3149, '2011-12-29 19:59:06'),
	(2897, 1, 3150, '2011-12-29 19:59:06'),
	(2898, 1, 3151, '2011-12-29 19:59:06'),
	(2899, 1, 3152, '2011-12-29 19:59:06'),
	(2906, 10, 3129, '2011-12-29 20:14:29'),
	(2913, 1, 3126, '2011-12-29 20:44:56'),
	(2915, 24, 3176, '2012-01-02 16:46:20'),
	(2916, 24, 3149, '2012-01-02 16:46:23'),
	(2917, 24, 3153, '2012-01-02 16:46:26'),
	(2918, 24, 3148, '2012-01-02 16:46:33'),
	(2919, 24, 3147, '2012-01-02 16:46:36'),
	(2920, 24, 3131, '2012-01-02 16:46:41'),
	(2921, 24, 3132, '2012-01-02 16:46:43'),
	(2923, 7, 3128, '2012-01-02 17:19:18'),
	(2924, 7, 3131, '2012-01-02 17:19:19'),
	(2925, 7, 3129, '2012-01-02 17:19:38'),
	(2926, 7, 3130, '2012-01-02 17:19:49');
/*!40000 ALTER TABLE `archivos_grupo` ENABLE KEYS */;


# Dumping structure for table lfg.gruposdeusuarios
DROP TABLE IF EXISTS `gruposdeusuarios`;
CREATE TABLE IF NOT EXISTS `gruposdeusuarios` (
  `idGrupoDeUsuario` int(10) NOT NULL AUTO_INCREMENT,
  `nomGrupoDeUsuario` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idGrupoDeUsuario`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='Tabla para relacionar usuarios con grupos de usuarios';

# Dumping data for table lfg.gruposdeusuarios: 4 rows
DELETE FROM `gruposdeusuarios`;
/*!40000 ALTER TABLE `gruposdeusuarios` DISABLE KEYS */;
INSERT INTO `gruposdeusuarios` (`idGrupoDeUsuario`, `nomGrupoDeUsuario`) VALUES
	(1, 'Grupo 1'),
	(2, 'Grupo 2'),
	(3, 'Grupo 3'),
	(4, 'Grupo 4');
/*!40000 ALTER TABLE `gruposdeusuarios` ENABLE KEYS */;


# Dumping structure for table lfg.gruposusuariospaquetes
DROP TABLE IF EXISTS `gruposusuariospaquetes`;
CREATE TABLE IF NOT EXISTS `gruposusuariospaquetes` (
  `idGrupoDeUsuario` int(10) NOT NULL DEFAULT '0',
  `idPaquete` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idGrupoDeUsuario`,`idPaquete`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tabla puente - gruposDeUsuario - Paquetes';

# Dumping data for table lfg.gruposusuariospaquetes: 3 rows
DELETE FROM `gruposusuariospaquetes`;
/*!40000 ALTER TABLE `gruposusuariospaquetes` DISABLE KEYS */;
INSERT INTO `gruposusuariospaquetes` (`idGrupoDeUsuario`, `idPaquete`) VALUES
	(1, 1),
	(1, 2),
	(2, 1);
/*!40000 ALTER TABLE `gruposusuariospaquetes` ENABLE KEYS */;


# Dumping structure for table lfg.grupos_usuario
DROP TABLE IF EXISTS `grupos_usuario`;
CREATE TABLE IF NOT EXISTS `grupos_usuario` (
  `IdGruposUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) DEFAULT NULL,
  `IdGrupos` int(11) DEFAULT NULL,
  `ramp_cant_descargas` int(3) DEFAULT NULL COMMENT 'define el numero de descargas o visualizaciones del usuario',
  `tipoHerencia` varchar(2) DEFAULT NULL COMMENT 'Herencia HU herencia up , HD herencia down',
  `grupoHijo` int(10) DEFAULT '0',
  PRIMARY KEY (`IdGruposUsuario`),
  UNIQUE KEY `IdUsuario` (`IdUsuario`,`IdGrupos`)
) ENGINE=MyISAM AUTO_INCREMENT=722 DEFAULT CHARSET=utf8;

# Dumping data for table lfg.grupos_usuario: 21 rows
DELETE FROM `grupos_usuario`;
/*!40000 ALTER TABLE `grupos_usuario` DISABLE KEYS */;
INSERT INTO `grupos_usuario` (`IdGruposUsuario`, `IdUsuario`, `IdGrupos`, `ramp_cant_descargas`, `tipoHerencia`, `grupoHijo`) VALUES
	(704, 92, 2, 0, 'HU', 6),
	(711, 91, 2, 50, 'HU', 6),
	(710, 91, 6, 50, 'HU', 9),
	(709, 91, 9, 50, NULL, 0),
	(701, 91, 11, 50, NULL, 0),
	(702, 92, 9, 0, NULL, 0),
	(703, 92, 6, 0, 'HU', 9),
	(688, 93, 9, 50, NULL, 0),
	(689, 93, 6, 50, 'HU', 9),
	(690, 93, 2, 50, 'HU', 6),
	(714, 91, 13, 50, NULL, 0),
	(713, 91, 10, 50, NULL, 0),
	(712, 91, 7, 50, NULL, 0),
	(705, 92, 10, 50, NULL, 0),
	(717, 91, 16, 50, NULL, 0),
	(716, 91, 15, 50, NULL, 0),
	(715, 91, 14, 50, NULL, 0),
	(718, 91, 17, 50, NULL, 0),
	(719, 91, 18, 50, NULL, 0),
	(720, 91, 19, 50, NULL, 0),
	(721, 91, 22, 50, NULL, 0);
/*!40000 ALTER TABLE `grupos_usuario` ENABLE KEYS */;


# Dumping structure for table lfg.livechannels
DROP TABLE IF EXISTS `livechannels`;
CREATE TABLE IF NOT EXISTS `livechannels` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pic` varchar(50) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `number` int(10) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `price` int(100) DEFAULT '0',
  `rating` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='Table for live content';

# Dumping data for table lfg.livechannels: 0 rows
DELETE FROM `livechannels`;
/*!40000 ALTER TABLE `livechannels` DISABLE KEYS */;
INSERT INTO `livechannels` (`id`, `pic`, `name`, `number`, `description`, `url`, `price`, `rating`) VALUES
	(13, 'Blue hills274_big.jpg', 'Canal Caracol', 1, '', '', 0, 0),
	(11, 'Water lilies739_big.jpg', 'Canal RCN', 5, 'Canal Caracol', 'www.caracol.com.co', 0, 1),
	(12, 'Sunset219_big.jpg', 'blah', 1, 'blah', '', 0, 0),
	(14, 'Winter_big.jpg', 'Canal Caracol', 5, '', '', 0, 0),
	(15, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(16, 'Water lilies600_big.jpg', 'Canal RCN', 0, '', '', 0, 0),
	(17, 'Sunset165_big.jpg', '', 1, '', '', 0, 0),
	(18, 'Sunset219_big.jpg', 'blah', 1, 'blah', '', 0, 0),
	(19, 'Water lilies600_big.jpg', 'Canal RCN', 0, '', '', 0, 0),
	(20, 'Water lilies600_big.jpg', 'Canal RCN', 0, '', '', 0, 0),
	(21, 'Water lilies600_big.jpg', 'Canal RCN', 0, '', '', 0, 0),
	(22, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(26, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(27, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(28, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(29, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(30, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(31, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(32, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(33, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(34, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(35, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(36, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(37, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(38, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(39, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(40, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(41, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(42, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(43, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(44, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(45, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(46, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(47, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(48, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(49, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(50, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(51, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(52, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(53, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(54, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(55, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(56, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(57, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(58, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(59, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(60, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(61, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(62, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(63, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(64, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(65, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(66, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(67, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(68, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(69, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(70, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(71, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(72, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(73, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(74, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(75, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(76, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(77, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(78, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(79, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(80, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(81, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(82, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(83, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0),
	(84, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 0);
/*!40000 ALTER TABLE `livechannels` ENABLE KEYS */;


# Dumping structure for table lfg.paquetes
DROP TABLE IF EXISTS `paquetes`;
CREATE TABLE IF NOT EXISTS `paquetes` (
  `idPaquete` int(10) NOT NULL AUTO_INCREMENT,
  `nomPaquete` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`idPaquete`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='Tabla para relacionar grupos con paquetes de grupos';

# Dumping data for table lfg.paquetes: 4 rows
DELETE FROM `paquetes`;
/*!40000 ALTER TABLE `paquetes` DISABLE KEYS */;
INSERT INTO `paquetes` (`idPaquete`, `nomPaquete`) VALUES
	(1, 'Premium'),
	(2, 'Arts'),
	(4, 'Movies'),
	(5, 'Education');
/*!40000 ALTER TABLE `paquetes` ENABLE KEYS */;


# Dumping structure for table lfg.paquetesgrupos
DROP TABLE IF EXISTS `paquetesgrupos`;
CREATE TABLE IF NOT EXISTS `paquetesgrupos` (
  `idPaquete` int(10) NOT NULL DEFAULT '0',
  `idGrupos` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idPaquete`,`idGrupos`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tabla puente - Paquetes - Grupos';

# Dumping data for table lfg.paquetesgrupos: 7 rows
DELETE FROM `paquetesgrupos`;
/*!40000 ALTER TABLE `paquetesgrupos` DISABLE KEYS */;
INSERT INTO `paquetesgrupos` (`idPaquete`, `idGrupos`) VALUES
	(1, 1),
	(1, 3),
	(1, 7),
	(2, 1),
	(2, 2),
	(2, 3),
	(2, 7);
/*!40000 ALTER TABLE `paquetesgrupos` ENABLE KEYS */;


# Dumping structure for table lfg.programacion
DROP TABLE IF EXISTS `programacion`;
CREATE TABLE IF NOT EXISTS `programacion` (
  `id_prog` bigint(20) NOT NULL AUTO_INCREMENT,
  `prog_video` int(11) NOT NULL,
  `prog_fecha_ini` datetime NOT NULL,
  `prog_fecha_fin` datetime NOT NULL,
  `prog_canal` int(11) NOT NULL,
  PRIMARY KEY (`id_prog`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

# Dumping data for table lfg.programacion: 3 rows
DELETE FROM `programacion`;
/*!40000 ALTER TABLE `programacion` DISABLE KEYS */;
INSERT INTO `programacion` (`id_prog`, `prog_video`, `prog_fecha_ini`, `prog_fecha_fin`, `prog_canal`) VALUES
	(1, 3150, '2010-05-11 22:00:00', '2010-05-11 22:30:00', 123),
	(2, 3149, '2010-05-11 22:30:00', '2010-05-11 23:30:00', 123),
	(3, 3148, '2010-05-11 23:30:00', '2010-05-11 00:00:00', 123);
/*!40000 ALTER TABLE `programacion` ENABLE KEYS */;


# Dumping structure for table lfg.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `IdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario` varchar(100) DEFAULT NULL,
  `Password` longtext,
  `NombreCompleto` varchar(255) DEFAULT NULL,
  `activo` int(1) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `mail` varchar(50) DEFAULT NULL,
  `Fecha inscripcion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `MAC_ID` varchar(50) DEFAULT NULL,
  `DIRECCION_LOCAL` varchar(120) DEFAULT NULL,
  `ID_PLUGIN` varchar(150) DEFAULT NULL,
  `pcrampkey` varchar(60) DEFAULT NULL,
  `serial` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IdUsuario`),
  UNIQUE KEY `Usuario` (`Usuario`),
  UNIQUE KEY `MAC_ID` (`MAC_ID`),
  UNIQUE KEY `mail` (`mail`),
  UNIQUE KEY `pcrampKey` (`pcrampkey`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

# Dumping data for table lfg.usuarios: 8 rows
DELETE FROM `usuarios`;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`IdUsuario`, `Usuario`, `Password`, `NombreCompleto`, `activo`, `apellidos`, `mail`, `Fecha inscripcion`, `MAC_ID`, `DIRECCION_LOCAL`, `ID_PLUGIN`, `pcrampkey`, `serial`) VALUES
	(91, 'v', 'b', 'v', 1, '', NULL, '2011-10-20 01:48:38', '00:1c:a8:a0:6e:21', '', 'vzx-wsde-wsdfr-548h', '08O42G-VSST9U-CNRB13-FESXEG-TYK0CP', 'S3R1AL'),
	(92, 'marvin', 'marvin', 'marvin', 1, '', NULL, '2011-10-20 01:48:38', '00:1c:a8:a0:a6:07', '', '', '00HXXC-V3UGML-N8ESZP-VFTC3B-GU7RWD', 'S3R1AL'),
	(93, 'nonosa', 'nono', 'nono', 1, '', NULL, '2011-10-20 01:48:38', '00:1c:a8:a0:a4:c9 ', '', '', '053HZC-V5J7M2-HM4E88-4JOV0J-LMIF7Z', 'S3R1AL'),
	(94, '2', '2', '2', 1, '', NULL, '2011-12-12 19:59:41', 'mm:aa:cc:aa:dd:rr:ee:sssss', '', '', '05H7VV-HIEG6C-NZ2E86-2HPFN9-740UUK', 'S3R1AL'),
	(95, 'vvv3', 'vvv3', 'vvv3', 1, '', NULL, '2011-10-20 01:48:38', NULL, NULL, NULL, NULL, 'S3R1AL'),
	(96, 'zzz', 'zzz', 'zzz', 1, '', NULL, '2011-10-20 01:48:38', NULL, NULL, NULL, NULL, 'S3R1AL'),
	(97, '1', '1', 'nono lai', 1, '', NULL, '2011-10-20 01:48:38', NULL, NULL, '', '', 'S3R1AL'),
	(98, 'Andres', 'gonzalez', 'Andres', 1, 'Gonzalez', NULL, '2011-10-20 01:48:38', 'MM:AA:CC:AA:DD:RR:EE:SS', NULL, NULL, NULL, 'S3R1AL');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;


# Dumping structure for table lfg.usuariosgruposusuarios
DROP TABLE IF EXISTS `usuariosgruposusuarios`;
CREATE TABLE IF NOT EXISTS `usuariosgruposusuarios` (
  `idGrupoDeUsuario` int(10) NOT NULL DEFAULT '0',
  `IdUsuario` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idGrupoDeUsuario`,`IdUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tabla puente usuarios - GruposDeUsuarios';

# Dumping data for table lfg.usuariosgruposusuarios: 10 rows
DELETE FROM `usuariosgruposusuarios`;
/*!40000 ALTER TABLE `usuariosgruposusuarios` DISABLE KEYS */;
INSERT INTO `usuariosgruposusuarios` (`idGrupoDeUsuario`, `IdUsuario`) VALUES
	(1, 93),
	(1, 94),
	(1, 96),
	(1, 97),
	(1, 98),
	(2, 92),
	(2, 93),
	(2, 96),
	(2, 97),
	(2, 98);
/*!40000 ALTER TABLE `usuariosgruposusuarios` ENABLE KEYS */;


# Dumping structure for table lfg.usvsgrupovsvideo
DROP TABLE IF EXISTS `usvsgrupovsvideo`;
CREATE TABLE IF NOT EXISTS `usvsgrupovsvideo` (
  `UGD_USUARIO` int(11) NOT NULL,
  `UGD_GRUPO` int(11) NOT NULL,
  `UGD_VIDEO` int(11) NOT NULL,
  `UGD_DESCARGAS` int(11) NOT NULL,
  `UGD_ESTADO` int(11) NOT NULL,
  `FECHA` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UGD_CONSECUTIVO` bigint(20) NOT NULL AUTO_INCREMENT,
  `visitas` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UGD_CONSECUTIVO`),
  UNIQUE KEY `UGD_USUARIO` (`UGD_USUARIO`,`UGD_GRUPO`,`UGD_VIDEO`)
) ENGINE=MyISAM AUTO_INCREMENT=172 DEFAULT CHARSET=utf8;

# Dumping data for table lfg.usvsgrupovsvideo: 42 rows
DELETE FROM `usvsgrupovsvideo`;
/*!40000 ALTER TABLE `usvsgrupovsvideo` DISABLE KEYS */;
INSERT INTO `usvsgrupovsvideo` (`UGD_USUARIO`, `UGD_GRUPO`, `UGD_VIDEO`, `UGD_DESCARGAS`, `UGD_ESTADO`, `FECHA`, `UGD_CONSECUTIVO`, `visitas`) VALUES
	(91, 9, 3130, 1, 1, '2011-03-13 23:01:21', 153, 1),
	(93, 9, 3129, 1, 1, '2011-03-13 23:01:20', 152, 0),
	(92, 9, 3129, 1, 1, '2011-03-13 23:01:20', 151, 0),
	(93, 9, 3132, 1, 1, '2011-03-13 23:01:22', 161, 0),
	(91, 9, 3134, 1, 1, '2011-03-13 23:01:23', 165, 1),
	(91, 9, 3126, 50, 1, '2011-02-03 12:29:03', 133, 50),
	(91, 10, 3128, 50, 1, '2011-03-05 22:18:23', 134, 2),
	(93, 9, 3128, 1, 1, '2011-03-13 23:01:20', 149, 0),
	(93, 9, 3149, 1, 1, '2011-03-13 22:56:39', 143, 0),
	(91, 14, 3150, 10, 1, '2011-03-13 21:34:06', 137, 6),
	(91, 10, 3151, 50, 1, '2011-03-05 22:18:23', 136, 1),
	(92, 9, 3128, 1, 1, '2011-03-13 23:01:20', 148, 0),
	(91, 9, 3128, 1, 1, '2011-03-13 23:01:20', 147, 1),
	(93, 9, 3126, 10, 1, '2010-07-18 10:41:04', 105, 0),
	(93, 9, 3133, 1, 1, '2011-03-13 23:01:22', 164, 0),
	(92, 9, 3127, 1, 1, '2011-03-13 23:01:19', 145, 0),
	(92, 9, 3132, 1, 1, '2011-03-13 23:01:22', 160, 0),
	(92, 9, 3131, 1, 1, '2011-03-13 23:01:21', 157, 0),
	(91, 9, 3127, 1, 1, '2011-03-13 23:01:19', 144, 1),
	(92, 9, 3149, 1, 1, '2011-03-13 22:56:39', 142, 0),
	(92, 9, 3126, 0, 1, '2010-12-07 17:20:03', 121, 0),
	(91, 11, 3130, 10, 1, '2010-12-06 20:59:05', 120, 5),
	(91, 10, 3133, 50, 1, '2011-03-05 22:18:23', 135, 0),
	(91, 9, 3131, 1, 1, '2011-03-13 23:01:21', 156, 1),
	(92, 9, 3133, 1, 1, '2011-03-13 23:01:22', 163, 0),
	(93, 9, 3130, 1, 1, '2011-03-13 23:01:21', 155, 0),
	(91, 9, 3132, 1, 1, '2011-03-13 23:01:22', 159, 1),
	(91, 9, 3149, 1, 1, '2011-03-13 22:56:39', 141, 1),
	(93, 9, 3127, 1, 1, '2011-03-13 23:01:19', 146, 0),
	(91, 9, 3129, 1, 1, '2011-03-13 23:01:20', 150, 0),
	(92, 9, 3130, 1, 1, '2011-03-13 23:01:21', 154, 0),
	(93, 9, 3131, 1, 1, '2011-03-13 23:01:21', 158, 0),
	(91, 9, 3133, 1, 1, '2011-03-13 23:01:22', 162, 1),
	(92, 10, 3151, 10, 1, '2010-12-13 10:41:37', 129, 0),
	(92, 10, 3128, 10, 1, '2010-12-13 10:42:41', 130, 0),
	(92, 10, 3133, 60, 1, '2010-12-13 10:43:03', 131, 0),
	(92, 9, 3134, 1, 1, '2011-03-13 23:01:23', 166, 0),
	(93, 9, 3134, 1, 1, '2011-03-13 23:01:23', 167, 0),
	(91, 22, 3151, 50, 1, '2011-03-15 18:11:40', 168, 12),
	(91, 9, 3153, 10, 1, '2011-03-22 18:03:39', 169, 6),
	(92, 9, 3153, 1, 1, '2011-03-22 18:03:39', 170, 0),
	(93, 9, 3153, 1, 1, '2011-03-22 18:03:39', 171, 0);
/*!40000 ALTER TABLE `usvsgrupovsvideo` ENABLE KEYS */;


# Dumping structure for table lfg.vodcategories
DROP TABLE IF EXISTS `vodcategories`;
CREATE TABLE IF NOT EXISTS `vodcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador interno',
  `name` varchar(500) DEFAULT NULL COMMENT 'Nombre del grupo',
  `parent` int(11) NOT NULL COMMENT 'registro padre de esta misma tabla',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

# Dumping data for table lfg.vodcategories: 20 rows
DELETE FROM `vodcategories`;
/*!40000 ALTER TABLE `vodcategories` DISABLE KEYS */;
INSERT INTO `vodcategories` (`id`, `name`, `parent`) VALUES
	(1, 'LIVE', 0),
	(2, 'ONDEMAND', 0),
	(3, 'LOCAL', 0),
	(6, 'ingles', 2),
	(15, 'test3', 2),
	(7, 'frances', 2),
	(8, 'aleman', 1),
	(9, 'ingles', 6),
	(10, 'test', 2),
	(11, 'este si es ', 2),
	(13, 'teste', 2),
	(14, 'test2', 2),
	(16, 'test4', 2),
	(17, 'test5', 2),
	(18, 'test6', 2),
	(19, 'test7', 2),
	(21, 'otrop', 2),
	(22, 'verimatrix', 2),
	(24, 'adf', 1),
	(27, 'asdf', 11);
/*!40000 ALTER TABLE `vodcategories` ENABLE KEYS */;


# Dumping structure for table lfg.vodchannels
DROP TABLE IF EXISTS `vodchannels`;
CREATE TABLE IF NOT EXISTS `vodchannels` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `pic` varchar(50) NOT NULL DEFAULT '0',
  `name` varchar(150) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `stb_url` varchar(200) DEFAULT NULL,
  `download_url` varchar(200) DEFAULT NULL,
  `pc_url` varchar(200) DEFAULT NULL,
  `trainer` varchar(100) DEFAULT NULL,
  `date_release` timestamp NULL DEFAULT NULL,
  `keywords` varchar(250) DEFAULT NULL,
  `rating` bigint(20) DEFAULT NULL,
  `price` int(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Channels on demand';

# Dumping data for table lfg.vodchannels: 0 rows
DELETE FROM `vodchannels`;
/*!40000 ALTER TABLE `vodchannels` DISABLE KEYS */;
/*!40000 ALTER TABLE `vodchannels` ENABLE KEYS */;


# Dumping structure for table lfg.v_subgrupos
DROP TABLE IF EXISTS `v_subgrupos`;
CREATE TABLE IF NOT EXISTS `v_subgrupos` (
  `cuenta` bigint(21) DEFAULT NULL,
  `PADRE` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

# Dumping data for table lfg.v_subgrupos: 0 rows
DELETE FROM `v_subgrupos`;
/*!40000 ALTER TABLE `v_subgrupos` DISABLE KEYS */;
/*!40000 ALTER TABLE `v_subgrupos` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
