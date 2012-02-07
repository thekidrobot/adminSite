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

/*Data for the table `administrador` */

insert  into `administrador`(`IdAdministrador`,`Login`,`Clave`) values (2,'admin','admin123');

/*Table structure for table `countries` */

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `countries` */

insert  into `countries`(`id`,`name`) values (1,'Afghanistan'),(2,'Albania'),(3,'Algeria'),(4,'American Samoa'),(5,'Andorra'),(6,'Angola'),(7,'Anguilla'),(8,'Antarctica'),(9,'Antigua and Barbuda'),(10,'Argentina'),(11,'Armenia'),(12,'Armenia'),(13,'Aruba'),(14,'Australia'),(15,'Austria'),(16,'Azerbaijan'),(17,'Azerbaijan'),(18,'Bahamas'),(19,'Bahrain'),(20,'Bangladesh'),(21,'Barbados'),(22,'Belarus'),(23,'Belgium'),(24,'Belize'),(25,'Benin'),(26,'Bermuda'),(27,'Bhutan'),(28,'Bolivia'),(29,'Bosnia and Herzegovina'),(30,'Botswana'),(31,'Bouvet Island'),(32,'Brazil'),(33,'British Indian Ocean Territory'),(34,'Brunei Darussalam'),(35,'Bulgaria'),(36,'Burkina Faso'),(37,'Burundi'),(38,'Cambodia'),(39,'Cameroon'),(40,'Canada'),(41,'Cape Verde'),(42,'Cayman Islands'),(43,'Central African Republic'),(44,'Chad'),(45,'Chile'),(46,'China'),(47,'Christmas Island'),(48,'Cocos (Keeling) Islands'),(49,'Colombia'),(50,'Comoros'),(51,'Congo'),(52,'Congo, The Democratic Republic of The'),(53,'Cook Islands'),(54,'Costa Rica'),(55,'Cote D\'ivoire'),(56,'Croatia'),(57,'Cuba'),(58,'Cyprus'),(59,'Cyprus'),(60,'Czech Republic'),(61,'Denmark'),(62,'Djibouti'),(63,'Dominica'),(64,'Dominican Republic'),(65,'Easter Island'),(66,'Ecuador'),(67,'Egypt'),(68,'El Salvador'),(69,'Equatorial Guinea'),(70,'Eritrea'),(71,'Estonia'),(72,'Ethiopia'),(73,'Falkland Islands (Malvinas)'),(74,'Faroe Islands'),(75,'Fiji'),(76,'Finland'),(77,'France'),(78,'French Guiana'),(79,'French Polynesia'),(80,'French Southern Territories'),(81,'Gabon'),(82,'Gambia'),(83,'Georgia'),(84,'Georgia'),(85,'Germany'),(86,'Ghana'),(87,'Gibraltar'),(88,'Greece'),(89,'Greenland'),(90,'Greenland'),(91,'Grenada'),(92,'Guadeloupe'),(93,'Guam'),(94,'Guatemala'),(95,'Guinea'),(96,'Guinea-bissau'),(97,'Guyana'),(98,'Haiti'),(99,'Heard Island and Mcdonald Islands'),(100,'Honduras'),(101,'Hong Kong'),(102,'Hungary'),(103,'Iceland'),(104,'India'),(105,'Indonesia'),(106,'Indonesia'),(107,'Iran'),(108,'Iraq'),(109,'Ireland'),(110,'Israel'),(111,'Italy'),(112,'Jamaica'),(113,'Japan'),(114,'Jordan'),(115,'Kazakhstan'),(116,'Kazakhstan'),(117,'Kenya'),(118,'Kiribati'),(119,'Korea, North'),(120,'Korea, South'),(121,'Kosovo'),(122,'Kuwait'),(123,'Kyrgyzstan'),(124,'Laos'),(125,'Latvia'),(126,'Lebanon'),(127,'Lesotho'),(128,'Liberia'),(129,'Libyan Arab Jamahiriya'),(130,'Liechtenstein'),(131,'Lithuania'),(132,'Luxembourg'),(133,'Macau'),(134,'Macedonia'),(135,'Madagascar'),(136,'Malawi'),(137,'Malaysia'),(138,'Maldives'),(139,'Mali'),(140,'Malta'),(141,'Marshall Islands'),(142,'Martinique'),(143,'Mauritania'),(144,'Mauritius'),(145,'Mayotte'),(146,'Mexico'),(147,'Micronesia, Federated States of'),(148,'Moldova, Republic of'),(149,'Monaco'),(150,'Mongolia'),(151,'Montenegro'),(152,'Montserrat'),(153,'Morocco'),(154,'Mozambique'),(155,'Myanmar'),(156,'Namibia'),(157,'Nauru'),(158,'Nepal'),(159,'Netherlands'),(160,'Netherlands Antilles'),(161,'New Caledonia'),(162,'New Zealand'),(163,'Nicaragua'),(164,'Niger'),(165,'Nigeria'),(166,'Niue'),(167,'Norfolk Island'),(168,'Northern Mariana Islands'),(169,'Norway'),(170,'Oman'),(171,'Pakistan'),(172,'Palau'),(173,'Palestinian Territory'),(174,'Panama'),(175,'Papua New Guinea'),(176,'Paraguay'),(177,'Peru'),(178,'Philippines'),(179,'Pitcairn'),(180,'Poland'),(181,'Portugal'),(182,'Puerto Rico'),(183,'Qatar'),(184,'Reunion'),(185,'Romania'),(186,'Russia'),(187,'Russia'),(188,'Rwanda'),(189,'Saint Helena'),(190,'Saint Kitts and Nevis'),(191,'Saint Lucia'),(192,'Saint Pierre and Miquelon'),(193,'Saint Vincent and The Grenadines'),(194,'Samoa'),(195,'San Marino'),(196,'Sao Tome and Principe'),(197,'Saudi Arabia'),(198,'Senegal'),(199,'Serbia and Montenegro'),(200,'Seychelles'),(201,'Sierra Leone'),(202,'Singapore'),(203,'Slovakia'),(204,'Slovenia'),(205,'Solomon Islands'),(206,'Somalia'),(207,'South Africa'),(208,'South Georgia and The South Sandwich Islands'),(209,'Spain'),(210,'Sri Lanka'),(211,'Sudan'),(212,'Suriname'),(213,'Svalbard and Jan Mayen'),(214,'Swaziland'),(215,'Sweden'),(216,'Switzerland'),(217,'Syria'),(218,'Taiwan'),(219,'Tajikistan'),(220,'Tanzania, United Republic of'),(221,'Thailand'),(222,'Timor-leste'),(223,'Togo'),(224,'Tokelau'),(225,'Tonga'),(226,'Trinidad and Tobago'),(227,'Tunisia'),(228,'Turkey'),(229,'Turkey'),(230,'Turkmenistan'),(231,'Turks and Caicos Islands'),(232,'Tuvalu'),(233,'Uganda'),(234,'Ukraine'),(235,'United Arab Emirates'),(236,'United Kingdom'),(237,'United States'),(238,'United States Minor Outlying Islands'),(239,'Uruguay'),(240,'Uzbekistan'),(241,'Vanuatu'),(242,'Vatican City'),(243,'Venezuela'),(244,'Vietnam'),(245,'Virgin Islands, British'),(246,'Virgin Islands, U.S.'),(247,'Wallis and Futuna'),(248,'Western Sahara'),(249,'Yemen'),(250,'Yemen'),(251,'Zambia'),(252,'Zimbabwe');

/*Table structure for table `currencies` */

DROP TABLE IF EXISTS `currencies`;

CREATE TABLE `currencies` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(4) DEFAULT NULL,
  `name` varbinary(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `currencies` */

insert  into `currencies`(`id`,`code`,`name`) values (1,'COP','Colombian Pesos'),(2,'USD','US Dollars'),(3,'BRZ','Brazilian Real');

/*Table structure for table `grid_live` */

DROP TABLE IF EXISTS `grid_live`;

CREATE TABLE `grid_live` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `channel_id` bigint(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=218 DEFAULT CHARSET=latin1 COMMENT='Programming grid for live channels';

/*Data for the table `grid_live` */

insert  into `grid_live`(`id`,`channel_id`,`name`,`description`,`start_date`,`end_date`) values (146,13,'Canal Caracol','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(147,11,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(148,12,'blah','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(149,14,'Canal Caracol','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(150,15,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(151,16,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(152,17,'','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(153,18,'blah','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(154,19,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(155,20,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(156,21,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(157,22,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(158,26,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(159,27,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(160,28,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(161,29,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(162,30,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(163,31,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(164,32,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(165,33,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(166,34,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(167,35,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(168,36,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(169,37,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(170,38,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(171,39,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(172,40,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(173,41,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(174,42,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(175,43,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(176,44,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(177,45,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(178,46,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(179,47,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(180,48,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(181,49,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(182,50,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(183,51,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(184,52,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(185,53,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(186,54,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(187,55,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(188,56,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(189,57,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(190,58,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(191,59,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(192,60,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(193,61,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(194,62,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(195,63,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(196,64,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(197,65,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(198,66,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(199,67,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(200,68,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(201,69,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(202,70,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(203,71,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(204,72,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(205,73,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(206,74,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(207,75,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(208,76,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(209,77,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(210,78,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(211,79,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(212,80,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(213,81,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(214,82,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(215,83,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(216,84,'Canal RCN','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50'),(217,85,'Andres','Provide a description','2012-01-10 16:04:50','2012-01-10 16:04:50');

/*Table structure for table `livechannels` */

DROP TABLE IF EXISTS `livechannels`;

CREATE TABLE `livechannels` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `big_pic` varchar(100) DEFAULT NULL COMMENT 'profile picture in big size',
  `small_pic` varchar(100) DEFAULT NULL COMMENT 'profile picture in small size',
  `name` varchar(150) DEFAULT NULL COMMENT 'channel name',
  `number` int(10) DEFAULT NULL COMMENT 'channel number, should be unique.',
  `description` varchar(500) DEFAULT NULL COMMENT 'channel description',
  `url` varchar(200) DEFAULT NULL COMMENT 'channel url',
  `price` int(100) DEFAULT '0' COMMENT 'channel price',
  `currency` int(2) DEFAULT NULL COMMENT 'currency code',
  `rating` int(2) DEFAULT NULL COMMENT 'rating code',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=89 DEFAULT CHARSET=latin1 COMMENT='Table for live content';

/*Data for the table `livechannels` */

insert  into `livechannels`(`id`,`big_pic`,`small_pic`,`name`,`number`,`description`,`url`,`price`,`currency`,`rating`) values (13,'Blue hills274_big.jpg',NULL,'Canal Caracol',1,'','',0,1,1),(11,'Water lilies739_big.jpg',NULL,'Canal RCN',5,'Canal Caracol','www.caracol.com.co',0,1,1),(12,'Sunset219_big.jpg',NULL,'blah',1,'blah','',0,1,1),(14,'Winter_big.jpg',NULL,'Canal Caracol',5,'','',0,1,1),(15,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(16,'Water lilies600_big.jpg',NULL,'Canal RCN',0,'','',0,1,1),(17,'Sunset165_big.jpg',NULL,'',1,'','',0,1,1),(18,'Sunset219_big.jpg',NULL,'blah',1,'blah','',0,1,1),(19,'Water lilies600_big.jpg',NULL,'Canal RCN',0,'','',0,1,1),(20,'Water lilies600_big.jpg',NULL,'Canal RCN',0,'','',0,1,1),(21,'Water lilies600_big.jpg',NULL,'Canal RCN',0,'','',0,1,1),(22,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(26,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(27,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(28,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(29,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(30,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(31,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(32,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(33,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(34,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(35,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(36,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(37,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(38,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(39,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(40,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(41,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(42,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(43,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(44,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(45,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(46,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(47,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(48,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(49,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(50,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(51,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(52,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(53,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(54,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(55,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(56,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(57,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(58,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(59,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(60,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(61,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(62,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(63,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(64,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(65,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(66,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(67,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(68,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(69,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(70,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(71,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(72,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(73,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(74,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(75,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(76,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(77,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(78,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(79,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(80,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(81,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(82,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(84,'Water lilies444_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(85,'wile339_big.jpg',NULL,'Andres',11,'test','test',1500,3,1),(88,'Winter696_big.jpg','Winter696_small.jpg','Cosme Fulanito',112,'Cosme Fulanito','',0,2,1);

/*Table structure for table `packages` */

DROP TABLE IF EXISTS `packages`;

CREATE TABLE `packages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT 'package name',
  `description` varchar(500) DEFAULT NULL COMMENT 'package description',
  `duration` varchar(50) DEFAULT NULL COMMENT 'package duration (in days)',
  `price` int(20) DEFAULT NULL COMMENT 'package price',
  `currency` int(2) DEFAULT NULL COMMENT 'currency code',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='package info';

/*Data for the table `packages` */

insert  into `packages`(`id`,`name`,`description`,`duration`,`price`,`currency`) values (5,'Andres','andres','100',111,3),(4,'dummy','dummy','dummy',0,2),(6,'Canal Caracol','','11',111,3);

/*Table structure for table `packages_livechannels` */

DROP TABLE IF EXISTS `packages_livechannels`;

CREATE TABLE `packages_livechannels` (
  `package_id` bigint(20) NOT NULL COMMENT 'Package ID',
  `resource_id` bigint(20) NOT NULL COMMENT 'Video ID (from livechannels)',
  PRIMARY KEY (`package_id`,`resource_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Link table between packages and live videos';

/*Data for the table `packages_livechannels` */

insert  into `packages_livechannels`(`package_id`,`resource_id`) values (4,11),(4,12),(5,1),(5,11),(5,12),(5,14);

/*Table structure for table `packages_vodchannels` */

DROP TABLE IF EXISTS `packages_vodchannels`;

CREATE TABLE `packages_vodchannels` (
  `package_id` bigint(20) NOT NULL COMMENT 'package ID',
  `resource_id` bigint(20) NOT NULL COMMENT 'video ID (from vodchannels)',
  PRIMARY KEY (`package_id`,`resource_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Link table between packages and VOD videos';

/*Data for the table `packages_vodchannels` */

insert  into `packages_vodchannels`(`package_id`,`resource_id`) values (5,1),(6,1),(6,2);

/*Table structure for table `ratings` */

DROP TABLE IF EXISTS `ratings`;

CREATE TABLE `ratings` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `ratings` */

insert  into `ratings`(`id`,`code`,`name`) values (1,'G','All Audiences'),(2,'PG','Parental Guidance Suggested'),(3,'PG13','Parents Strongly Cautioned'),(4,'R','Restricted'),(5,'NC17','No Children Under 17');

/*Table structure for table `restrictions` */

DROP TABLE IF EXISTS `restrictions`;

CREATE TABLE `restrictions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT 'Rule name',
  `price` int(20) DEFAULT NULL COMMENT 'Rule price',
  `currency` int(2) DEFAULT NULL COMMENT 'Currency code',
  `duration` int(10) DEFAULT NULL COMMENT 'Rule duration (in days)',
  `max_views` int(10) DEFAULT NULL COMMENT 'Max number of views (zero for infinite)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='Rules table, used for tickets. ';

/*Data for the table `restrictions` */

insert  into `restrictions`(`id`,`name`,`price`,`currency`,`duration`,`max_views`) values (2,'Rule 1',2000,10,3,1),(3,'Rule 2',1,1,1,0);

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
  `last_login` datetime DEFAULT NULL,
  `pin` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `subscribers` */

insert  into `subscribers`(`id`,`name`,`username`,`password`,`address`,`email`,`account`,`phone`,`country`,`city`,`zip`,`serial`,`mac`,`license`,`last_login`,`pin`) values (7,'Cosme Fulanito','cosmeFulanito','16d7a4fca7442dda3ad93c9a726597e4','Test','my@email.com','test','test','39','Mumbai','111','S3R1AL','MM:AA:CC:AA:DD:RR:EE:SS','','2012-02-01 23:49:25','r406gfgl2xda2w');

/*Table structure for table `subscribers_packages` */

DROP TABLE IF EXISTS `subscribers_packages`;

CREATE TABLE `subscribers_packages` (
  `subscriber_id` bigint(20) NOT NULL,
  `package_id` bigint(20) NOT NULL,
  PRIMARY KEY (`subscriber_id`,`package_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Link table between subscribers and packages';

/*Data for the table `subscribers_packages` */

insert  into `subscribers_packages`(`subscriber_id`,`package_id`) values (7,4),(7,5),(7,6);

/*Table structure for table `tickets` */

DROP TABLE IF EXISTS `tickets`;

CREATE TABLE `tickets` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Ticket ID',
  `subscriber_id` bigint(20) NOT NULL COMMENT 'Subscriber ID',
  `resource_id` bigint(20) NOT NULL COMMENT 'Video ID (from VOD)',
  `current_views` int(20) DEFAULT NULL COMMENT 'Number of views from the user',
  `restriction_id` bigint(20) DEFAULT NULL COMMENT 'Rule ID (from restrictions table)',
  `ticket_number` varchar(250) DEFAULT NULL COMMENT 'autogenerated ticket number',
  `creation_date` datetime DEFAULT NULL COMMENT 'ticket creation timestamp',
  `status` int(1) DEFAULT NULL COMMENT 'status (0 = inactive / 1=active)',
  PRIMARY KEY (`subscriber_id`,`resource_id`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Tickets table, define restrictions per user and video. ';

/*Data for the table `tickets` */

insert  into `tickets`(`id`,`subscriber_id`,`resource_id`,`current_views`,`restriction_id`,`ticket_number`,`creation_date`,`status`) values (1,7,2,0,2,'g8uh2im3s3ww','2012-01-21 11:21:07',1),(1,7,1,0,2,'reltj1u64ve','2012-01-21 11:20:53',1);

/*Table structure for table `trainers` */

DROP TABLE IF EXISTS `trainers`;

CREATE TABLE `trainers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `big_pic` varchar(100) DEFAULT NULL,
  `small_pic` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `trainers` */

insert  into `trainers`(`id`,`name`,`description`,`big_pic`,`small_pic`) values (1,'Michael Jackson','The king of pop','oh_big.jpg','oh_small.jpg');

/*Table structure for table `vod_channels_categories` */

DROP TABLE IF EXISTS `vod_channels_categories`;

CREATE TABLE `vod_channels_categories` (
  `channel_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  PRIMARY KEY (`channel_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `vod_channels_categories` */

insert  into `vod_channels_categories`(`channel_id`,`category_id`) values (1,21);

/*Table structure for table `vodcategories` */

DROP TABLE IF EXISTS `vodcategories`;

CREATE TABLE `vodcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) DEFAULT NULL COMMENT 'Group name',
  `parent` int(11) NOT NULL COMMENT 'Parent branch ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

/*Data for the table `vodcategories` */

insert  into `vodcategories`(`id`,`name`,`parent`) values (1,'LIVE',0),(2,'ONDEMAND',0),(3,'LOCAL',0),(6,'ingles',2),(15,'test3',2),(7,'frances',2),(8,'aleman',1),(9,'ingles',6),(10,'test',2),(11,'este si es ',2),(13,'teste',2),(14,'test2',2),(16,'test4',2),(17,'test5',2),(18,'test6',2),(19,'test7',2),(21,'otrop',2),(22,'verimatrix',2),(24,'adf',1),(27,'asdf',11);

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
  `trainer` int(10) DEFAULT NULL,
  `date_release` timestamp NULL DEFAULT NULL,
  `keywords` varchar(250) DEFAULT NULL,
  `rating` int(2) DEFAULT NULL,
  `price` int(100) DEFAULT NULL,
  `currency` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='Channels on demand';

/*Data for the table `vodchannels` */

insert  into `vodchannels`(`id`,`big_pic`,`small_pic`,`name`,`description`,`stb_url`,`download_url`,`pc_url`,`trainer`,`date_release`,`keywords`,`rating`,`price`,`currency`) values (1,'Water lilies378_big.jpg','Water lilies378_small.jpg','Andres','andres','andres','andres','andres',1,'2012-01-09 17:27:20','comics,animation',1,0,1),(2,'moto_pix_big.jpg','moto_pix_small.jpg','Moto','Moto','www.moto.com','www.moto.com','www.moto.com',1,'2012-01-17 14:22:59','moto,movie',1,0,1),(3,'515px-Treehouse_of_Horror_XIIIa_big.jpg','515px-Treehouse_of_Horror_XIIIa_small.jpg','simpsons','simpsons','simpsons','simpsons','simpsons',1,'2012-01-17 22:05:38','simpsons',1,0,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
