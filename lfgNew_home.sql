/*
SQLyog Community v9.31 GA
MySQL - 5.1.58-1ubuntu1 : Database - lfg
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lfg` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `lfg`;

/*Table structure for table `administrador` */

DROP TABLE IF EXISTS `administrador`;

CREATE TABLE `administrador` (
  `IdAdministrador` int(11) NOT NULL AUTO_INCREMENT,
  `Login` varchar(100) DEFAULT NULL,
  `Clave` longtext,
  PRIMARY KEY (`IdAdministrador`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Table structure for table `countries` */

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `currencies` */

DROP TABLE IF EXISTS `currencies`;

CREATE TABLE `currencies` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(4) DEFAULT NULL,
  `name` varbinary(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Table structure for table `grid_live` */

DROP TABLE IF EXISTS `grid_live`;

CREATE TABLE `grid_live` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `channel_id` bigint(20) DEFAULT NULL,
  `channel_name` varchar(100) DEFAULT NULL,
  `grid_name` varchar(100) DEFAULT NULL,
  `grid_description` varchar(500) DEFAULT NULL,
  `rating` int(10) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=290 DEFAULT CHARSET=latin1 COMMENT='Programming grid for live channels';

/*Table structure for table `livechannels` */

DROP TABLE IF EXISTS `livechannels`;

CREATE TABLE `livechannels` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `big_pic` varchar(100) DEFAULT NULL,
  `small_pic` varchar(100) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `number` int(10) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `price` int(100) DEFAULT '0',
  `currency` int(2) DEFAULT NULL,
  `rating` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=latin1 COMMENT='Table for live content';

/*Table structure for table `packages` */

DROP TABLE IF EXISTS `packages`;

CREATE TABLE `packages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `price` int(20) DEFAULT NULL,
  `currency` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Table structure for table `packages_livechannels` */

DROP TABLE IF EXISTS `packages_livechannels`;

CREATE TABLE `packages_livechannels` (
  `package_id` bigint(20) NOT NULL,
  `resource_id` bigint(20) NOT NULL,
  PRIMARY KEY (`package_id`,`resource_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `packages_vodchannels` */

DROP TABLE IF EXISTS `packages_vodchannels`;

CREATE TABLE `packages_vodchannels` (
  `package_id` bigint(20) NOT NULL,
  `resource_id` bigint(20) NOT NULL,
  PRIMARY KEY (`package_id`,`resource_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `programacion` */

DROP TABLE IF EXISTS `programacion`;

CREATE TABLE `programacion` (
  `id_prog` bigint(20) NOT NULL AUTO_INCREMENT,
  `prog_video` int(11) NOT NULL,
  `prog_fecha_ini` datetime NOT NULL,
  `prog_fecha_fin` datetime NOT NULL,
  `prog_canal` int(11) NOT NULL,
  PRIMARY KEY (`id_prog`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Table structure for table `ratings` */

DROP TABLE IF EXISTS `ratings`;

CREATE TABLE `ratings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Table structure for table `subscribers` */

DROP TABLE IF EXISTS `subscribers`;

CREATE TABLE `subscribers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `account` varchar(500) DEFAULT NULL,
  `phone` varchar(500) DEFAULT NULL,
  `country` varchar(500) DEFAULT NULL,
  `city` varchar(500) DEFAULT NULL,
  `zip` varchar(500) DEFAULT NULL,
  `serial` varchar(150) DEFAULT NULL,
  `mac` varchar(100) DEFAULT NULL,
  `license` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Table structure for table `subscribers_packages` */

DROP TABLE IF EXISTS `subscribers_packages`;

CREATE TABLE `subscribers_packages` (
  `subscriber_id` bigint(20) NOT NULL,
  `package_id` bigint(20) NOT NULL,
  PRIMARY KEY (`subscriber_id`,`package_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `vod_channels_categories` */

DROP TABLE IF EXISTS `vod_channels_categories`;

CREATE TABLE `vod_channels_categories` (
  `channel_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  PRIMARY KEY (`channel_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `vodcategories` */

DROP TABLE IF EXISTS `vodcategories`;

CREATE TABLE `vodcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador interno',
  `name` varchar(500) DEFAULT NULL COMMENT 'Nombre del grupo',
  `parent` int(11) NOT NULL COMMENT 'registro padre de esta misma tabla',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Table structure for table `vodchannels` */

DROP TABLE IF EXISTS `vodchannels`;

CREATE TABLE `vodchannels` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `big_pic` varchar(100) NOT NULL DEFAULT '0',
  `small_pic` varchar(100) NOT NULL DEFAULT '0',
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

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
