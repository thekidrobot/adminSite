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
  `start_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=290 DEFAULT CHARSET=latin1 COMMENT='Programming grid for live channels';

/*Data for the table `grid_live` */

insert  into `grid_live`(`id`,`channel_id`,`name`,`description`,`start_date`,`start_time`,`end_date`,`end_time`) values (218,11,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(219,12,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(220,13,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(221,14,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(222,15,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(223,16,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(224,17,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(225,18,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(226,19,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(227,20,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(228,21,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(229,22,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(230,26,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(231,27,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(232,28,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(233,29,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(234,30,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(235,31,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(236,32,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(237,33,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(238,34,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(239,35,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(240,36,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(241,37,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(242,38,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(243,39,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(244,40,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(245,41,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(246,42,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(247,43,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(248,44,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(249,45,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(250,46,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(251,47,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(252,48,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(253,49,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(254,50,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(255,51,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(256,52,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(257,53,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(258,54,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(259,55,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(260,56,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(261,57,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(262,58,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(263,59,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(264,60,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(265,61,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(266,62,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(267,63,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(268,64,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(269,65,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(270,66,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(271,67,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(272,68,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(273,69,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(274,70,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(275,71,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(276,72,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(277,73,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(278,74,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(279,75,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(280,76,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(281,77,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(282,78,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(283,79,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(284,80,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(285,81,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(286,82,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(287,84,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(288,85,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23'),(289,88,'Provide a name','Provide a description','2012-01-12','22:53:23','2012-01-12','22:53:23');

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

/*Data for the table `livechannels` */

insert  into `livechannels`(`id`,`big_pic`,`small_pic`,`name`,`number`,`description`,`url`,`price`,`currency`,`rating`) values (13,'Blue hills274_big.jpg',NULL,'Canal Caracol',1,'','',0,1,1),(11,'Water lilies739_big.jpg',NULL,'Canal RCN',5,'Canal Caracol','www.caracol.com.co',0,1,1),(12,'Sunset219_big.jpg',NULL,'blah',1,'blah','',0,1,1),(14,'Winter_big.jpg',NULL,'Canal Caracol',5,'','',0,1,1),(15,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(16,'Water lilies600_big.jpg',NULL,'Canal RCN',0,'','',0,1,1),(17,'Sunset165_big.jpg',NULL,'',1,'','',0,1,1),(18,'Sunset219_big.jpg',NULL,'blah',1,'blah','',0,1,1),(19,'Water lilies600_big.jpg',NULL,'Canal RCN',0,'','',0,1,1),(20,'Water lilies600_big.jpg',NULL,'Canal RCN',0,'','',0,1,1),(21,'Water lilies600_big.jpg',NULL,'Canal RCN',0,'','',0,1,1),(22,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(26,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(27,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(28,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(29,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(30,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(31,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(32,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(33,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(34,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(35,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(36,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(37,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(38,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(39,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(40,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(41,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(42,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(43,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(44,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(45,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(46,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(47,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(48,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(49,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(50,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(51,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(52,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(53,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(54,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(55,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(56,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(57,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(58,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(59,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(60,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(61,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(62,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(63,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(64,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(65,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(66,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(67,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(68,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(69,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(70,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(71,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(72,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(73,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(74,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(75,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(76,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(77,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(78,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(79,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(80,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(81,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(82,'Water lilies600_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(84,'Water lilies444_big.jpg',NULL,'Canal RCN',5,'','',0,1,1),(85,'wile339_big.jpg',NULL,'Andres',11,'test','test',1500,3,1),(88,'Winter696_big.jpg','Winter696_small.jpg','Cosme Fulanito',112,'Cosme Fulanito','',0,2,1);

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

/*Data for the table `packages` */

insert  into `packages`(`id`,`name`,`description`,`duration`,`price`,`currency`) values (5,'Andres','andres','100',111,3),(4,'dummy','dummy','dummy',0,2),(6,'Canal Caracol','','11',111,3);

/*Table structure for table `packages_livechannels` */

DROP TABLE IF EXISTS `packages_livechannels`;

CREATE TABLE `packages_livechannels` (
  `package_id` bigint(20) NOT NULL,
  `resource_id` bigint(20) NOT NULL,
  PRIMARY KEY (`package_id`,`resource_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `packages_livechannels` */

insert  into `packages_livechannels`(`package_id`,`resource_id`) values (4,11),(4,12),(5,1),(5,11),(5,12),(5,14),(6,11),(6,20),(6,21),(6,22),(6,26),(6,27),(6,28),(6,29),(6,30),(6,31),(6,32),(6,33),(6,34),(6,35),(6,36),(6,37),(6,38),(6,39),(6,40),(6,41),(6,42),(6,43),(6,44),(6,45),(6,46),(6,47),(6,48),(6,49),(6,50),(6,51),(6,52),(6,53),(6,54),(6,55),(6,56),(6,57),(6,58),(6,59),(6,60),(6,61),(6,62),(6,63),(6,64),(6,65),(6,66),(6,67),(6,68),(6,69),(6,70),(6,71),(6,72),(6,73),(6,74),(6,75),(6,76),(6,77),(6,78),(6,79),(6,80),(6,81),(6,82),(6,84),(6,85),(6,88);

/*Table structure for table `packages_vodchannels` */

DROP TABLE IF EXISTS `packages_vodchannels`;

CREATE TABLE `packages_vodchannels` (
  `package_id` bigint(20) NOT NULL,
  `resource_id` bigint(20) NOT NULL,
  PRIMARY KEY (`package_id`,`resource_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `packages_vodchannels` */

insert  into `packages_vodchannels`(`package_id`,`resource_id`) values (5,1),(6,1);

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

/*Data for the table `programacion` */

insert  into `programacion`(`id_prog`,`prog_video`,`prog_fecha_ini`,`prog_fecha_fin`,`prog_canal`) values (1,3150,'2010-05-11 22:00:00','2010-05-11 22:30:00',123),(2,3149,'2010-05-11 22:30:00','2010-05-11 23:30:00',123),(3,3148,'2010-05-11 23:30:00','2010-05-11 00:00:00',123);

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

/*Data for the table `subscribers` */

insert  into `subscribers`(`id`,`name`,`username`,`password`,`address`,`email`,`account`,`phone`,`country`,`city`,`zip`,`serial`,`mac`,`license`) values (7,'Cosme Fulanito','cosmeFulanito','16d7a4fca7442dda3ad93c9a726597e4','Test','my@email.com','test','test','39','Mumbai','111','1112','111','');

/*Table structure for table `subscribers_packages` */

DROP TABLE IF EXISTS `subscribers_packages`;

CREATE TABLE `subscribers_packages` (
  `subscriber_id` bigint(20) NOT NULL,
  `package_id` bigint(20) NOT NULL,
  PRIMARY KEY (`subscriber_id`,`package_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `subscribers_packages` */

/*Table structure for table `vod_channels_categories` */

DROP TABLE IF EXISTS `vod_channels_categories`;

CREATE TABLE `vod_channels_categories` (
  `channel_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  PRIMARY KEY (`channel_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `vod_channels_categories` */

insert  into `vod_channels_categories`(`channel_id`,`category_id`) values (1,21),(1,27);

/*Table structure for table `vodcategories` */

DROP TABLE IF EXISTS `vodcategories`;

CREATE TABLE `vodcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificador interno',
  `name` varchar(500) DEFAULT NULL COMMENT 'Nombre del grupo',
  `parent` int(11) NOT NULL COMMENT 'registro padre de esta misma tabla',
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
  `trainer` varchar(100) DEFAULT NULL,
  `date_release` timestamp NULL DEFAULT NULL,
  `keywords` varchar(250) DEFAULT NULL,
  `rating` int(2) DEFAULT NULL,
  `price` int(100) DEFAULT NULL,
  `currency` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='Channels on demand';

/*Data for the table `vodchannels` */

insert  into `vodchannels`(`id`,`big_pic`,`small_pic`,`name`,`description`,`stb_url`,`download_url`,`pc_url`,`trainer`,`date_release`,`keywords`,`rating`,`price`,`currency`) values (1,'Water lilies378_big.jpg','Water lilies378_small.jpg','Andres','andres','andres','andres','andres','andres','2012-01-09 17:27:20','comics,animation',1,0,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
