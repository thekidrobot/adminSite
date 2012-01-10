# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.5.12
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2012-01-10 17:56:13
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


# Dumping structure for table lfg.currencies
DROP TABLE IF EXISTS `currencies`;
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(4) DEFAULT NULL,
  `name` varbinary(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

# Dumping data for table lfg.currencies: 3 rows
DELETE FROM `currencies`;
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` (`id`, `code`, `name`) VALUES
	(1, 'COP', _binary 0x436F6C6F6D6269616E205065736F73),
	(2, 'USD', _binary 0x555320446F6C6C617273),
	(3, 'BRZ', _binary 0x4272617A696C69616E205265616C);
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;


# Dumping structure for table lfg.grid_live
DROP TABLE IF EXISTS `grid_live`;
CREATE TABLE IF NOT EXISTS `grid_live` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `channel_id` bigint(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='Programming grid for live channels';

# Dumping data for table lfg.grid_live: 1 rows
DELETE FROM `grid_live`;
/*!40000 ALTER TABLE `grid_live` DISABLE KEYS */;
INSERT INTO `grid_live` (`id`, `channel_id`, `name`, `description`, `start_date`, `end_date`) VALUES
	(146, 13, 'Canal Caracol', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(147, 11, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(148, 12, 'blah', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(149, 14, 'Canal Caracol', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(150, 15, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(151, 16, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(152, 17, '', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(153, 18, 'blah', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(154, 19, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(155, 20, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(156, 21, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(157, 22, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(158, 26, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(159, 27, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(160, 28, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(161, 29, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(162, 30, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(163, 31, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(164, 32, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(165, 33, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(166, 34, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(167, 35, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(168, 36, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(169, 37, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(170, 38, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(171, 39, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(172, 40, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(173, 41, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(174, 42, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(175, 43, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(176, 44, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(177, 45, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(178, 46, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(179, 47, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(180, 48, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(181, 49, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(182, 50, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(183, 51, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(184, 52, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(185, 53, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(186, 54, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(187, 55, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(188, 56, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(189, 57, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(190, 58, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(191, 59, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(192, 60, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(193, 61, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(194, 62, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(195, 63, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(196, 64, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(197, 65, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(198, 66, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(199, 67, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(200, 68, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(201, 69, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(202, 70, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(203, 71, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(204, 72, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(205, 73, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(206, 74, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(207, 75, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(208, 76, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(209, 77, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(210, 78, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(211, 79, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(212, 80, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(213, 81, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(214, 82, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(215, 83, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(216, 84, 'Canal RCN', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50'),
	(217, 85, 'Andres', 'Provide a description', '2012-01-10 16:04:50', '2012-01-10 16:04:50');
/*!40000 ALTER TABLE `grid_live` ENABLE KEYS */;


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
  `currency` int(2) DEFAULT NULL,
  `rating` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=latin1 COMMENT='Table for live content';

# Dumping data for table lfg.livechannels: 72 rows
DELETE FROM `livechannels`;
/*!40000 ALTER TABLE `livechannels` DISABLE KEYS */;
INSERT INTO `livechannels` (`id`, `pic`, `name`, `number`, `description`, `url`, `price`, `currency`, `rating`) VALUES
	(13, 'Blue hills274_big.jpg', 'Canal Caracol', 1, '', '', 0, 1, 1),
	(11, 'Water lilies739_big.jpg', 'Canal RCN', 5, 'Canal Caracol', 'www.caracol.com.co', 0, 1, 1),
	(12, 'Sunset219_big.jpg', 'blah', 1, 'blah', '', 0, 1, 1),
	(14, 'Winter_big.jpg', 'Canal Caracol', 5, '', '', 0, 1, 1),
	(15, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(16, 'Water lilies600_big.jpg', 'Canal RCN', 0, '', '', 0, 1, 1),
	(17, 'Sunset165_big.jpg', '', 1, '', '', 0, 1, 1),
	(18, 'Sunset219_big.jpg', 'blah', 1, 'blah', '', 0, 1, 1),
	(19, 'Water lilies600_big.jpg', 'Canal RCN', 0, '', '', 0, 1, 1),
	(20, 'Water lilies600_big.jpg', 'Canal RCN', 0, '', '', 0, 1, 1),
	(21, 'Water lilies600_big.jpg', 'Canal RCN', 0, '', '', 0, 1, 1),
	(22, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(26, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(27, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(28, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(29, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(30, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(31, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(32, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(33, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(34, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(35, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(36, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(37, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(38, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(39, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(40, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(41, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(42, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(43, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(44, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(45, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(46, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(47, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(48, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(49, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(50, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(51, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(52, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(53, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(54, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(55, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(56, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(57, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(58, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(59, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(60, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(61, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(62, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(63, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(64, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(65, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(66, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(67, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(68, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(69, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(70, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(71, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(72, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(73, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(74, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(75, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(76, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(77, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(78, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(79, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(80, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(81, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(82, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(83, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(84, 'Water lilies600_big.jpg', 'Canal RCN', 5, '', '', 0, 1, 1),
	(85, 'wile339_big.jpg', 'Andres', 11, 'test', 'test', 1500, 1, 1);
/*!40000 ALTER TABLE `livechannels` ENABLE KEYS */;


# Dumping structure for table lfg.packages
DROP TABLE IF EXISTS `packages`;
CREATE TABLE IF NOT EXISTS `packages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `price` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

# Dumping data for table lfg.packages: 2 rows
DELETE FROM `packages`;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` (`id`, `name`, `description`, `duration`, `price`) VALUES
	(5, 'Andres', 'andres', 'andres', 0),
	(4, 'dummy', 'dummy', 'dummy', 0);
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;


# Dumping structure for table lfg.packages_livechannels
DROP TABLE IF EXISTS `packages_livechannels`;
CREATE TABLE IF NOT EXISTS `packages_livechannels` (
  `package_id` bigint(20) NOT NULL,
  `resource_id` bigint(20) NOT NULL,
  PRIMARY KEY (`package_id`,`resource_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

# Dumping data for table lfg.packages_livechannels: 6 rows
DELETE FROM `packages_livechannels`;
/*!40000 ALTER TABLE `packages_livechannels` DISABLE KEYS */;
INSERT INTO `packages_livechannels` (`package_id`, `resource_id`) VALUES
	(4, 11),
	(4, 12),
	(5, 1),
	(5, 11),
	(5, 12),
	(5, 14);
/*!40000 ALTER TABLE `packages_livechannels` ENABLE KEYS */;


# Dumping structure for table lfg.packages_vodchannels
DROP TABLE IF EXISTS `packages_vodchannels`;
CREATE TABLE IF NOT EXISTS `packages_vodchannels` (
  `package_id` bigint(20) NOT NULL,
  `resource_id` bigint(20) NOT NULL,
  PRIMARY KEY (`package_id`,`resource_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

# Dumping data for table lfg.packages_vodchannels: 1 rows
DELETE FROM `packages_vodchannels`;
/*!40000 ALTER TABLE `packages_vodchannels` DISABLE KEYS */;
/*!40000 ALTER TABLE `packages_vodchannels` ENABLE KEYS */;


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


# Dumping structure for table lfg.ratings
DROP TABLE IF EXISTS `ratings`;
CREATE TABLE IF NOT EXISTS `ratings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

# Dumping data for table lfg.ratings: 5 rows
DELETE FROM `ratings`;
/*!40000 ALTER TABLE `ratings` DISABLE KEYS */;
INSERT INTO `ratings` (`id`, `code`, `name`) VALUES
	(1, 'G', 'All Audiences'),
	(2, 'PG', 'Parental Guidance Suggested'),
	(3, 'PG13', 'Parents Strongly Cautioned'),
	(4, 'R', 'Restricted'),
	(5, 'NC17', 'No Children Under 17');
/*!40000 ALTER TABLE `ratings` ENABLE KEYS */;


# Dumping structure for table lfg.subscribers
DROP TABLE IF EXISTS `subscribers`;
CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `serial` varchar(150) DEFAULT NULL,
  `mac` varchar(100) DEFAULT NULL,
  `license` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

# Dumping data for table lfg.subscribers: 1 rows
DELETE FROM `subscribers`;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
INSERT INTO `subscribers` (`id`, `name`, `username`, `password`, `description`, `serial`, `mac`, `license`) VALUES
	(4, 'Andres', 'Andres', 'andres', 'andres', 'andres', 'andres', 'andres');
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;


# Dumping structure for table lfg.subscribers_packages
DROP TABLE IF EXISTS `subscribers_packages`;
CREATE TABLE IF NOT EXISTS `subscribers_packages` (
  `subscriber_id` bigint(20) NOT NULL,
  `package_id` bigint(20) NOT NULL,
  PRIMARY KEY (`subscriber_id`,`package_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

# Dumping data for table lfg.subscribers_packages: 1 rows
DELETE FROM `subscribers_packages`;
/*!40000 ALTER TABLE `subscribers_packages` DISABLE KEYS */;
INSERT INTO `subscribers_packages` (`subscriber_id`, `package_id`) VALUES
	(4, 4);
/*!40000 ALTER TABLE `subscribers_packages` ENABLE KEYS */;


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
  `rating` int(2) DEFAULT NULL,
  `price` int(100) DEFAULT NULL,
  `currency` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='Channels on demand';

# Dumping data for table lfg.vodchannels: 1 rows
DELETE FROM `vodchannels`;
/*!40000 ALTER TABLE `vodchannels` DISABLE KEYS */;
INSERT INTO `vodchannels` (`id`, `pic`, `name`, `description`, `stb_url`, `download_url`, `pc_url`, `trainer`, `date_release`, `keywords`, `rating`, `price`, `currency`) VALUES
	(1, 'Blue hills274_small.jpg', 'Andres', 'andres', 'andres', 'andres', 'andres', 'andres', '2012-01-09 17:27:20', 'comics,animation', 1, 0, 1);
/*!40000 ALTER TABLE `vodchannels` ENABLE KEYS */;


# Dumping structure for table lfg.vod_channels_categories
DROP TABLE IF EXISTS `vod_channels_categories`;
CREATE TABLE IF NOT EXISTS `vod_channels_categories` (
  `channel_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  PRIMARY KEY (`channel_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

# Dumping data for table lfg.vod_channels_categories: 0 rows
DELETE FROM `vod_channels_categories`;
/*!40000 ALTER TABLE `vod_channels_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `vod_channels_categories` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
