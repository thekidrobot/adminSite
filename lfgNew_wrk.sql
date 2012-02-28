# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.5.12
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2012-02-28 17:57:24
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


# Dumping structure for table lfg.countries
DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

# Dumping data for table lfg.countries: 252 rows
DELETE FROM `countries`;
/*!40000 ALTER TABLE `countries` DISABLE KEYS */;
INSERT INTO `countries` (`id`, `name`) VALUES
	(1, 'Afghanistan'),
	(2, 'Albania'),
	(3, 'Algeria'),
	(4, 'American Samoa'),
	(5, 'Andorra'),
	(6, 'Angola'),
	(7, 'Anguilla'),
	(8, 'Antarctica'),
	(9, 'Antigua and Barbuda'),
	(10, 'Argentina'),
	(11, 'Armenia'),
	(12, 'Armenia'),
	(13, 'Aruba'),
	(14, 'Australia'),
	(15, 'Austria'),
	(16, 'Azerbaijan'),
	(17, 'Azerbaijan'),
	(18, 'Bahamas'),
	(19, 'Bahrain'),
	(20, 'Bangladesh'),
	(21, 'Barbados'),
	(22, 'Belarus'),
	(23, 'Belgium'),
	(24, 'Belize'),
	(25, 'Benin'),
	(26, 'Bermuda'),
	(27, 'Bhutan'),
	(28, 'Bolivia'),
	(29, 'Bosnia and Herzegovina'),
	(30, 'Botswana'),
	(31, 'Bouvet Island'),
	(32, 'Brazil'),
	(33, 'British Indian Ocean Territory'),
	(34, 'Brunei Darussalam'),
	(35, 'Bulgaria'),
	(36, 'Burkina Faso'),
	(37, 'Burundi'),
	(38, 'Cambodia'),
	(39, 'Cameroon'),
	(40, 'Canada'),
	(41, 'Cape Verde'),
	(42, 'Cayman Islands'),
	(43, 'Central African Republic'),
	(44, 'Chad'),
	(45, 'Chile'),
	(46, 'China'),
	(47, 'Christmas Island'),
	(48, 'Cocos (Keeling) Islands'),
	(49, 'Colombia'),
	(50, 'Comoros'),
	(51, 'Congo'),
	(52, 'Congo, The Democratic Republic of The'),
	(53, 'Cook Islands'),
	(54, 'Costa Rica'),
	(55, 'Cote D\'ivoire'),
	(56, 'Croatia'),
	(57, 'Cuba'),
	(58, 'Cyprus'),
	(59, 'Cyprus'),
	(60, 'Czech Republic'),
	(61, 'Denmark'),
	(62, 'Djibouti'),
	(63, 'Dominica'),
	(64, 'Dominican Republic'),
	(65, 'Easter Island'),
	(66, 'Ecuador'),
	(67, 'Egypt'),
	(68, 'El Salvador'),
	(69, 'Equatorial Guinea'),
	(70, 'Eritrea'),
	(71, 'Estonia'),
	(72, 'Ethiopia'),
	(73, 'Falkland Islands (Malvinas)'),
	(74, 'Faroe Islands'),
	(75, 'Fiji'),
	(76, 'Finland'),
	(77, 'France'),
	(78, 'French Guiana'),
	(79, 'French Polynesia'),
	(80, 'French Southern Territories'),
	(81, 'Gabon'),
	(82, 'Gambia'),
	(83, 'Georgia'),
	(84, 'Georgia'),
	(85, 'Germany'),
	(86, 'Ghana'),
	(87, 'Gibraltar'),
	(88, 'Greece'),
	(89, 'Greenland'),
	(90, 'Greenland'),
	(91, 'Grenada'),
	(92, 'Guadeloupe'),
	(93, 'Guam'),
	(94, 'Guatemala'),
	(95, 'Guinea'),
	(96, 'Guinea-bissau'),
	(97, 'Guyana'),
	(98, 'Haiti'),
	(99, 'Heard Island and Mcdonald Islands'),
	(100, 'Honduras'),
	(101, 'Hong Kong'),
	(102, 'Hungary'),
	(103, 'Iceland'),
	(104, 'India'),
	(105, 'Indonesia'),
	(106, 'Indonesia'),
	(107, 'Iran'),
	(108, 'Iraq'),
	(109, 'Ireland'),
	(110, 'Israel'),
	(111, 'Italy'),
	(112, 'Jamaica'),
	(113, 'Japan'),
	(114, 'Jordan'),
	(115, 'Kazakhstan'),
	(116, 'Kazakhstan'),
	(117, 'Kenya'),
	(118, 'Kiribati'),
	(119, 'Korea, North'),
	(120, 'Korea, South'),
	(121, 'Kosovo'),
	(122, 'Kuwait'),
	(123, 'Kyrgyzstan'),
	(124, 'Laos'),
	(125, 'Latvia'),
	(126, 'Lebanon'),
	(127, 'Lesotho'),
	(128, 'Liberia'),
	(129, 'Libyan Arab Jamahiriya'),
	(130, 'Liechtenstein'),
	(131, 'Lithuania'),
	(132, 'Luxembourg'),
	(133, 'Macau'),
	(134, 'Macedonia'),
	(135, 'Madagascar'),
	(136, 'Malawi'),
	(137, 'Malaysia'),
	(138, 'Maldives'),
	(139, 'Mali'),
	(140, 'Malta'),
	(141, 'Marshall Islands'),
	(142, 'Martinique'),
	(143, 'Mauritania'),
	(144, 'Mauritius'),
	(145, 'Mayotte'),
	(146, 'Mexico'),
	(147, 'Micronesia, Federated States of'),
	(148, 'Moldova, Republic of'),
	(149, 'Monaco'),
	(150, 'Mongolia'),
	(151, 'Montenegro'),
	(152, 'Montserrat'),
	(153, 'Morocco'),
	(154, 'Mozambique'),
	(155, 'Myanmar'),
	(156, 'Namibia'),
	(157, 'Nauru'),
	(158, 'Nepal'),
	(159, 'Netherlands'),
	(160, 'Netherlands Antilles'),
	(161, 'New Caledonia'),
	(162, 'New Zealand'),
	(163, 'Nicaragua'),
	(164, 'Niger'),
	(165, 'Nigeria'),
	(166, 'Niue'),
	(167, 'Norfolk Island'),
	(168, 'Northern Mariana Islands'),
	(169, 'Norway'),
	(170, 'Oman'),
	(171, 'Pakistan'),
	(172, 'Palau'),
	(173, 'Palestinian Territory'),
	(174, 'Panama'),
	(175, 'Papua New Guinea'),
	(176, 'Paraguay'),
	(177, 'Peru'),
	(178, 'Philippines'),
	(179, 'Pitcairn'),
	(180, 'Poland'),
	(181, 'Portugal'),
	(182, 'Puerto Rico'),
	(183, 'Qatar'),
	(184, 'Reunion'),
	(185, 'Romania'),
	(186, 'Russia'),
	(187, 'Russia'),
	(188, 'Rwanda'),
	(189, 'Saint Helena'),
	(190, 'Saint Kitts and Nevis'),
	(191, 'Saint Lucia'),
	(192, 'Saint Pierre and Miquelon'),
	(193, 'Saint Vincent and The Grenadines'),
	(194, 'Samoa'),
	(195, 'San Marino'),
	(196, 'Sao Tome and Principe'),
	(197, 'Saudi Arabia'),
	(198, 'Senegal'),
	(199, 'Serbia and Montenegro'),
	(200, 'Seychelles'),
	(201, 'Sierra Leone'),
	(202, 'Singapore'),
	(203, 'Slovakia'),
	(204, 'Slovenia'),
	(205, 'Solomon Islands'),
	(206, 'Somalia'),
	(207, 'South Africa'),
	(208, 'South Georgia and The South Sandwich Islands'),
	(209, 'Spain'),
	(210, 'Sri Lanka'),
	(211, 'Sudan'),
	(212, 'Suriname'),
	(213, 'Svalbard and Jan Mayen'),
	(214, 'Swaziland'),
	(215, 'Sweden'),
	(216, 'Switzerland'),
	(217, 'Syria'),
	(218, 'Taiwan'),
	(219, 'Tajikistan'),
	(220, 'Tanzania, United Republic of'),
	(221, 'Thailand'),
	(222, 'Timor-leste'),
	(223, 'Togo'),
	(224, 'Tokelau'),
	(225, 'Tonga'),
	(226, 'Trinidad and Tobago'),
	(227, 'Tunisia'),
	(228, 'Turkey'),
	(229, 'Turkey'),
	(230, 'Turkmenistan'),
	(231, 'Turks and Caicos Islands'),
	(232, 'Tuvalu'),
	(233, 'Uganda'),
	(234, 'Ukraine'),
	(235, 'United Arab Emirates'),
	(236, 'United Kingdom'),
	(237, 'United States'),
	(238, 'United States Minor Outlying Islands'),
	(239, 'Uruguay'),
	(240, 'Uzbekistan'),
	(241, 'Vanuatu'),
	(242, 'Vatican City'),
	(243, 'Venezuela'),
	(244, 'Vietnam'),
	(245, 'Virgin Islands, British'),
	(246, 'Virgin Islands, U.S.'),
	(247, 'Wallis and Futuna'),
	(248, 'Western Sahara'),
	(249, 'Yemen'),
	(250, 'Yemen'),
	(251, 'Zambia'),
	(252, 'Zimbabwe');
/*!40000 ALTER TABLE `countries` ENABLE KEYS */;


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
  `channel_id` bigint(20) DEFAULT NULL COMMENT 'Channel Id',
  `channel_name` varchar(100) DEFAULT NULL COMMENT 'Channel Name',
  `grid_name` varchar(100) DEFAULT NULL COMMENT 'Name of the grid',
  `grid_description` varchar(500) DEFAULT NULL COMMENT 'Description of the grid',
  `rating` int(1) DEFAULT NULL COMMENT 'Numerical code of the rating',
  `start_date` date DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=575 DEFAULT CHARSET=latin1 COMMENT='Programming grid for live channels';

# Dumping data for table lfg.grid_live: 71 rows
DELETE FROM `grid_live`;
/*!40000 ALTER TABLE `grid_live` DISABLE KEYS */;
INSERT INTO `grid_live` (`id`, `channel_id`, `channel_name`, `grid_name`, `grid_description`, `rating`, `start_date`, `start_time`, `end_date`, `end_time`) VALUES
	(504, 1, 'CANAL FMB 1', 'Programa FMB 2', 'Descripción programa FMB 2', 1, '0000-00-00', '13:00:00', '0000-00-00', '17:59:00'),
	(505, 1, 'CANAL FMB 1', 'Programa FMB 3', 'Descripción programa FMB 3', 1, '0000-00-00', '18:00:00', '0000-00-00', '21:59:00'),
	(506, 1, 'CANAL FMB 1', 'Programa FMB 4', 'Descripción programa FMB 4', 1, '0000-00-00', '22:00:00', '0000-00-00', '23:59:00'),
	(507, 1, 'CANAL FMB 1', 'Programa FMB 1', 'Descripción programa FMB 1', 1, '0000-00-00', '00:00:00', '0000-00-00', '12:59:00'),
	(508, 1, 'CANAL FMB 1', 'Programa FMB 2', 'Descripción programa FMB 2', 1, '0000-00-00', '13:00:00', '0000-00-00', '17:59:00'),
	(509, 1, 'CANAL FMB 1', 'Programa FMB 3', 'Descripción programa FMB 3', 1, '0000-00-00', '18:00:00', '0000-00-00', '21:59:00'),
	(510, 1, 'CANAL FMB 1', 'Programa FMB 4', 'Descripción programa FMB 4', 1, '0000-00-00', '22:00:00', '0000-00-00', '23:59:00'),
	(511, 1, 'CANAL FMB 1', 'Programa FMB 1', 'Descripción programa FMB 1', 1, '0000-00-00', '00:00:00', '0000-00-00', '12:59:00'),
	(512, 1, 'CANAL FMB 1', 'Programa FMB 2', 'Descripción programa FMB 2', 1, '0000-00-00', '13:00:00', '0000-00-00', '17:59:00'),
	(513, 1, 'CANAL FMB 1', 'Programa FMB 3', 'Descripción programa FMB 3', 1, '0000-00-00', '18:00:00', '0000-00-00', '21:59:00'),
	(514, 1, 'CANAL FMB 1', 'Programa FMB 4', 'Descripción programa FMB 4', 1, '0000-00-00', '22:00:00', '0000-00-00', '23:59:00'),
	(515, 1, 'CANAL FMB 1', 'Programa FMB 1', 'Descripción programa FMB 1', 1, '0000-00-00', '00:00:00', '0000-00-00', '12:59:00'),
	(516, 1, 'CANAL FMB 1', 'Programa FMB 2', 'Descripción programa FMB 2', 1, '0000-00-00', '13:00:00', '0000-00-00', '17:59:00'),
	(517, 1, 'CANAL FMB 1', 'Programa FMB 3', 'Descripción programa FMB 3', 1, '0000-00-00', '18:00:00', '0000-00-00', '21:59:00'),
	(518, 1, 'CANAL FMB 1', 'Programa FMB 4', 'Descripción programa FMB 4', 1, '0000-00-00', '22:00:00', '0000-00-00', '23:59:00'),
	(519, 1, 'CANAL FMB 1', 'Programa FMB 1', 'Descripción programa FMB 1', 1, '0000-00-00', '00:00:00', '0000-00-00', '12:59:00'),
	(520, 1, 'CANAL FMB 1', 'Programa FMB 2', 'Descripción programa FMB 2', 1, '0000-00-00', '13:00:00', '0000-00-00', '17:59:00'),
	(521, 1, 'CANAL FMB 1', 'Programa FMB 3', 'Descripción programa FMB 3', 1, '0000-00-00', '18:00:00', '0000-00-00', '21:59:00'),
	(522, 1, 'CANAL FMB 1', 'Programa FMB 4', 'Descripción programa FMB 4', 1, '0000-00-00', '22:00:00', '0000-00-00', '23:59:00'),
	(523, 1, 'CANAL FMB 1', 'Programa FMB 1', 'Descripción programa FMB 1', 1, '0000-00-00', '00:00:00', '0000-00-00', '12:59:00'),
	(524, 1, 'CANAL FMB 1', 'Programa FMB 2', 'Descripción programa FMB 2', 1, '0000-00-00', '13:00:00', '0000-00-00', '17:59:00'),
	(525, 1, 'CANAL FMB 1', 'Programa FMB 3', 'Descripción programa FMB 3', 1, '0000-00-00', '18:00:00', '0000-00-00', '21:59:00'),
	(526, 1, 'CANAL FMB 1', 'Programa FMB 4', 'Descripción programa FMB 4', 1, '0000-00-00', '22:00:00', '0000-00-00', '23:59:00'),
	(527, 1, 'CANAL FMB 1', 'Programa FMB 1', 'Descripción programa FMB 1', 1, '0000-00-00', '00:00:00', '0000-00-00', '12:59:00'),
	(528, 1, 'CANAL FMB 1', 'Programa FMB 2', 'Descripción programa FMB 2', 1, '0000-00-00', '13:00:00', '0000-00-00', '17:59:00'),
	(529, 1, 'CANAL FMB 1', 'Programa FMB 3', 'Descripción programa FMB 3', 1, '0000-00-00', '18:00:00', '0000-00-00', '21:59:00'),
	(530, 1, 'CANAL FMB 1', 'Programa FMB 4', 'Descripción programa FMB 4', 1, '0000-00-00', '22:00:00', '0000-00-00', '23:59:00'),
	(531, 1, 'CANAL FMB 1', 'Programa FMB 1', 'Descripción programa FMB 1', 1, '0000-00-00', '00:00:00', '0000-00-00', '12:59:00'),
	(532, 1, 'CANAL FMB 1', 'Programa FMB 2', 'Descripción programa FMB 2', 1, '0000-00-00', '13:00:00', '0000-00-00', '17:59:00'),
	(533, 1, 'CANAL FMB 1', 'Programa FMB 3', 'Descripción programa FMB 3', 1, '0000-00-00', '18:00:00', '0000-00-00', '21:59:00'),
	(534, 1, 'CANAL FMB 1', 'Programa FMB 4', 'Descripción programa FMB 4', 1, '0000-00-00', '22:00:00', '0000-00-00', '23:59:00'),
	(535, 1, 'CANAL FMB 1', 'Programa FMB 1', 'Descripción programa FMB 1', 1, '0000-00-00', '00:00:00', '0000-00-00', '12:59:00'),
	(536, 1, 'CANAL FMB 1', 'Programa FMB 2', 'Descripción programa FMB 2', 1, '0000-00-00', '13:00:00', '0000-00-00', '17:59:00'),
	(537, 1, 'CANAL FMB 1', 'Programa FMB 3', 'Descripción programa FMB 3', 1, '0000-00-00', '18:00:00', '0000-00-00', '21:59:00'),
	(538, 1, 'CANAL FMB 1', 'Programa FMB 4', 'Descripción programa FMB 4', 1, '0000-00-00', '22:00:00', '0000-00-00', '23:59:00'),
	(539, 2, 'Canal FMB 2', 'Programa FMB 1', 'Descripción programa FMB 1', 1, '0000-00-00', '00:00:00', '0000-00-00', '12:59:00'),
	(540, 2, 'Canal FMB 2', 'Programa FMB 2', 'Descripción programa FMB 2', 1, '0000-00-00', '13:00:00', '0000-00-00', '17:59:00'),
	(541, 2, 'Canal FMB 2', 'Programa FMB 3', 'Descripción programa FMB 3', 1, '0000-00-00', '18:00:00', '0000-00-00', '21:59:00'),
	(542, 2, 'Canal FMB 2', 'Programa FMB 4', 'Descripción programa FMB 4', 1, '0000-00-00', '22:00:00', '0000-00-00', '23:59:00'),
	(543, 2, 'Canal FMB 2', 'Programa FMB 1', 'Descripción programa FMB 1', 1, '0000-00-00', '00:00:00', '0000-00-00', '12:59:00'),
	(544, 2, 'Canal FMB 2', 'Programa FMB 2', 'Descripción programa FMB 2', 1, '0000-00-00', '13:00:00', '0000-00-00', '17:59:00'),
	(545, 2, 'Canal FMB 2', 'Programa FMB 3', 'Descripción programa FMB 3', 1, '0000-00-00', '18:00:00', '0000-00-00', '21:59:00'),
	(546, 2, 'Canal FMB 2', 'Programa FMB 4', 'Descripción programa FMB 4', 1, '0000-00-00', '22:00:00', '0000-00-00', '23:59:00'),
	(547, 2, 'Canal FMB 2', 'Programa FMB 1', 'Descripción programa FMB 1', 1, '0000-00-00', '00:00:00', '0000-00-00', '12:59:00'),
	(548, 2, 'Canal FMB 2', 'Programa FMB 2', 'Descripción programa FMB 2', 1, '0000-00-00', '13:00:00', '0000-00-00', '17:59:00'),
	(549, 2, 'Canal FMB 2', 'Programa FMB 3', 'Descripción programa FMB 3', 1, '0000-00-00', '18:00:00', '0000-00-00', '21:59:00'),
	(550, 2, 'Canal FMB 2', 'Programa FMB 4', 'Descripción programa FMB 4', 1, '0000-00-00', '22:00:00', '0000-00-00', '23:59:00'),
	(551, 2, 'Canal FMB 2', 'Programa FMB 1', 'Descripción programa FMB 1', 1, '0000-00-00', '00:00:00', '0000-00-00', '12:59:00'),
	(552, 2, 'Canal FMB 2', 'Programa FMB 2', 'Descripción programa FMB 2', 1, '0000-00-00', '13:00:00', '0000-00-00', '17:59:00'),
	(553, 2, 'Canal FMB 2', 'Programa FMB 3', 'Descripción programa FMB 3', 1, '0000-00-00', '18:00:00', '0000-00-00', '21:59:00'),
	(554, 2, 'Canal FMB 2', 'Programa FMB 4', 'Descripción programa FMB 4', 1, '0000-00-00', '22:00:00', '0000-00-00', '23:59:00'),
	(555, 2, 'Canal FMB 2', 'Programa FMB 1', 'Descripción programa FMB 1', 1, '0000-00-00', '00:00:00', '0000-00-00', '12:59:00'),
	(556, 2, 'Canal FMB 2', 'Programa FMB 2', 'Descripción programa FMB 2', 1, '0000-00-00', '13:00:00', '0000-00-00', '17:59:00'),
	(557, 2, 'Canal FMB 2', 'Programa FMB 3', 'Descripción programa FMB 3', 1, '0000-00-00', '18:00:00', '0000-00-00', '21:59:00'),
	(558, 2, 'Canal FMB 2', 'Programa FMB 4', 'Descripción programa FMB 4', 1, '0000-00-00', '22:00:00', '0000-00-00', '23:59:00'),
	(559, 2, 'Canal FMB 2', 'Programa FMB 1', 'Descripción programa FMB 1', 1, '0000-00-00', '00:00:00', '0000-00-00', '12:59:00'),
	(560, 2, 'Canal FMB 2', 'Programa FMB 2', 'Descripción programa FMB 2', 1, '0000-00-00', '13:00:00', '0000-00-00', '17:59:00'),
	(561, 2, 'Canal FMB 2', 'Programa FMB 3', 'Descripción programa FMB 3', 1, '0000-00-00', '18:00:00', '0000-00-00', '21:59:00'),
	(562, 2, 'Canal FMB 2', 'Programa FMB 4', 'Descripción programa FMB 4', 1, '0000-00-00', '22:00:00', '0000-00-00', '23:59:00'),
	(563, 2, 'Canal FMB 2', 'Programa FMB 1', 'Descripción programa FMB 1', 1, '0000-00-00', '00:00:00', '0000-00-00', '12:59:00'),
	(564, 2, 'Canal FMB 2', 'Programa FMB 2', 'Descripción programa FMB 2', 1, '0000-00-00', '13:00:00', '0000-00-00', '17:59:00'),
	(565, 2, 'Canal FMB 2', 'Programa FMB 3', 'Descripción programa FMB 3', 1, '0000-00-00', '18:00:00', '0000-00-00', '21:59:00'),
	(566, 2, 'Canal FMB 2', 'Programa FMB 4', 'Descripción programa FMB 4', 1, '0000-00-00', '22:00:00', '0000-00-00', '23:59:00'),
	(567, 2, 'Canal FMB 2', 'Programa FMB 1', 'Descripción programa FMB 1', 1, '0000-00-00', '00:00:00', '0000-00-00', '12:59:00'),
	(568, 2, 'Canal FMB 2', 'Programa FMB 2', 'Descripción programa FMB 2', 1, '0000-00-00', '13:00:00', '0000-00-00', '17:59:00'),
	(569, 2, 'Canal FMB 2', 'Programa FMB 3', 'Descripción programa FMB 3', 1, '0000-00-00', '18:00:00', '0000-00-00', '21:59:00'),
	(570, 2, 'Canal FMB 2', 'Programa FMB 4', 'Descripción programa FMB 4', 1, '0000-00-00', '22:00:00', '0000-00-00', '23:59:00'),
	(571, 2, 'Canal FMB 2', 'Programa FMB 1', 'Descripción programa FMB 1', 1, '0000-00-00', '00:00:00', '0000-00-00', '12:59:00'),
	(572, 2, 'Canal FMB 2', 'Programa FMB 2', 'Descripción programa FMB 2', 1, '0000-00-00', '13:00:00', '0000-00-00', '17:59:00'),
	(573, 2, 'Canal FMB 2', 'Programa FMB 3', 'Descripción programa FMB 3', 1, '0000-00-00', '18:00:00', '0000-00-00', '21:59:00'),
	(574, 2, 'Canal FMB 2', 'Programa FMB 4', 'Descripción programa FMB 4', 1, '0000-00-00', '22:00:00', '0000-00-00', '23:59:00');
/*!40000 ALTER TABLE `grid_live` ENABLE KEYS */;


# Dumping structure for table lfg.livechannels
DROP TABLE IF EXISTS `livechannels`;
CREATE TABLE IF NOT EXISTS `livechannels` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `big_pic` varchar(100) DEFAULT NULL COMMENT 'profile picture in big size',
  `small_pic` varchar(100) DEFAULT NULL COMMENT 'profile picture in small size',
  `name` varchar(150) DEFAULT NULL COMMENT 'channel name',
  `number` int(10) DEFAULT NULL COMMENT 'channel number, should be unique.',
  `description` varchar(500) DEFAULT NULL COMMENT 'channel description',
  `url` varchar(200) DEFAULT NULL COMMENT 'channel url',
  `pc_url` varchar(200) DEFAULT NULL COMMENT 'channel url',
  `price` int(100) DEFAULT '0' COMMENT 'channel price',
  `currency` int(2) DEFAULT NULL COMMENT 'currency code',
  `rating` int(2) DEFAULT NULL COMMENT 'rating code',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='Table for live content';

# Dumping data for table lfg.livechannels: 5 rows
DELETE FROM `livechannels`;
/*!40000 ALTER TABLE `livechannels` DISABLE KEYS */;
INSERT INTO `livechannels` (`id`, `big_pic`, `small_pic`, `name`, `number`, `description`, `url`, `pc_url`, `price`, `currency`, `rating`) VALUES
	(1, '', '', 'Canal FMB 2', 2, 'Canal FMB 2', 'http://fms.rampms.com/fmb.m3u8', NULL, 0, 1, 1),
	(2, 'canal_big.jpg', 'canal_small.jpg', 'Canal FMB 1', 1, 'Canal FMB 1', 'http://iptv.rampms.com:1935/fmblive/smil:fmb2.smil/playlist.m3u8', NULL, 0, 2, 1),
	(3, '', '', 'CANAL ADOBE', 3, 'This is a test using Adobe FMS 4.5', 'http://fms.rampms.com/test.m3u8', NULL, 0, 1, 1),
	(4, '', '', 'CANAL ASHEVILLE', 4, 'TEST FROM WOWZA ASHEVILLE', 'http://oab.rampms.com:1935/live/smil:ramp.smil/playlist.m3u8', NULL, 0, 1, 1),
	(5, '', '', 'CANAL TEST', 5, 'CANAL 5 ', 'http://fms.rampms.com/hls-live/livepkgr/_definst_/liveevent/alagoas.m3u8', '', 0, 1, 1);
/*!40000 ALTER TABLE `livechannels` ENABLE KEYS */;


# Dumping structure for table lfg.packages
DROP TABLE IF EXISTS `packages`;
CREATE TABLE IF NOT EXISTS `packages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT 'package name',
  `description` varchar(500) DEFAULT NULL COMMENT 'package description',
  `duration` varchar(50) DEFAULT NULL COMMENT 'package duration (in days)',
  `price` int(20) DEFAULT NULL COMMENT 'package price',
  `currency` int(2) DEFAULT NULL COMMENT 'currency code',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='package info';

# Dumping data for table lfg.packages: 1 rows
DELETE FROM `packages`;
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` (`id`, `name`, `description`, `duration`, `price`, `currency`) VALUES
	(1, 'Live and VOD', 'Live and VOD', '0', 0, 1);
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;


# Dumping structure for table lfg.packages_livechannels
DROP TABLE IF EXISTS `packages_livechannels`;
CREATE TABLE IF NOT EXISTS `packages_livechannels` (
  `package_id` bigint(20) NOT NULL COMMENT 'Package ID',
  `resource_id` bigint(20) NOT NULL COMMENT 'Video ID (from livechannels)',
  PRIMARY KEY (`package_id`,`resource_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Link table between packages and live videos';

# Dumping data for table lfg.packages_livechannels: 7 rows
DELETE FROM `packages_livechannels`;
/*!40000 ALTER TABLE `packages_livechannels` DISABLE KEYS */;
INSERT INTO `packages_livechannels` (`package_id`, `resource_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(1, 4),
	(1, 5),
	(2, 1),
	(2, 2);
/*!40000 ALTER TABLE `packages_livechannels` ENABLE KEYS */;


# Dumping structure for table lfg.packages_vodchannels
DROP TABLE IF EXISTS `packages_vodchannels`;
CREATE TABLE IF NOT EXISTS `packages_vodchannels` (
  `package_id` bigint(20) NOT NULL COMMENT 'package ID',
  `resource_id` bigint(20) NOT NULL COMMENT 'video ID (from vodchannels)',
  PRIMARY KEY (`package_id`,`resource_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Link table between packages and VOD videos';

# Dumping data for table lfg.packages_vodchannels: 10 rows
DELETE FROM `packages_vodchannels`;
/*!40000 ALTER TABLE `packages_vodchannels` DISABLE KEYS */;
INSERT INTO `packages_vodchannels` (`package_id`, `resource_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(1, 5),
	(1, 6),
	(2, 1),
	(2, 2),
	(2, 3),
	(2, 5),
	(2, 6);
/*!40000 ALTER TABLE `packages_vodchannels` ENABLE KEYS */;


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


# Dumping structure for table lfg.restrictions
DROP TABLE IF EXISTS `restrictions`;
CREATE TABLE IF NOT EXISTS `restrictions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL COMMENT 'Rule name',
  `price` int(20) DEFAULT NULL COMMENT 'Rule price',
  `currency` int(2) DEFAULT NULL COMMENT 'Currency code',
  `duration` int(10) DEFAULT NULL COMMENT 'Rule duration (in days)',
  `max_views` int(10) DEFAULT NULL COMMENT 'Max number of views (zero for infinite)',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Rules table, used for tickets. ';

# Dumping data for table lfg.restrictions: 0 rows
DELETE FROM `restrictions`;
/*!40000 ALTER TABLE `restrictions` DISABLE KEYS */;
/*!40000 ALTER TABLE `restrictions` ENABLE KEYS */;


# Dumping structure for table lfg.subscribers
DROP TABLE IF EXISTS `subscribers`;
CREATE TABLE IF NOT EXISTS `subscribers` (
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

# Dumping data for table lfg.subscribers: 5 rows
DELETE FROM `subscribers`;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
INSERT INTO `subscribers` (`id`, `name`, `username`, `password`, `address`, `email`, `account`, `phone`, `country`, `city`, `zip`, `serial`, `mac`, `license`, `last_login`, `pin`) VALUES
	(1, 'victor zambrano', 'cosmeFulanito', '16d7a4fca7442dda3ad93c9a726597e4', 'calle 83 22a 18', 'vzdconline@gmail.com', '1234567890', '57-318712982', '49', 'bogota', '0000', '691611237127871', '00:07:67:99:F3:7F', '1234567890', '2012-02-26 16:02:21', '17ec1t1mus5ci0f'),
	(2, 'Evgeny Kaiko', 'ekaiko', 'cde00107f5abe053a660c703501a5877', 'calle 83 22a 18', 'evgeni@kaikoweb.com', '1234567890', '57-318712982', '49', 'bogota', '0000', '691611237127874', '00:07:67:99:F3:82', '1234567890', '2012-02-24 16:01:39', 'u4kqhps1oflade3'),
	(3, 'Evgeny Kaiko 2', 'ekaiko', '575a35f556fa6713c2eaacff9e137b89', 'calle 83 22a 18', 'evgeni@kaikoweb.com', '123456', '57-318712982', '40', 'bogota', '0000', '691611020063531', '00:07:67:98:F8:2B', '1234567890', '2012-02-24 11:26:22', 'nsikz0rs1khdbwm'),
	(4, 'viczambrano', 'viczambrano', 'c5a98d81529199f0470a907081536177', 'calle 83', 'vzdconline@gmail.com', '123456', '12345678', '49', 'bogota', '57', '691611237127873', '00:07:67:99:F3:81', '123456', '2012-02-26 18:19:33', 've9dajqdm70vqdu'),
	(5, 'Daniel Crepaldi', 'Daniel', '25d55ad283aa400af464c76d713c07ad', '5647 NW 40th Ave', 'daniel@ramprm.com', '32456', '3056060013', '32', 'Boca Raton', '33496', '691611480240953', '00:07:67:9B:AD:39', '098765', '2012-02-26 16:03:23', 'tmp3nwsbwu5iy8e');
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;


# Dumping structure for table lfg.subscribers_packages
DROP TABLE IF EXISTS `subscribers_packages`;
CREATE TABLE IF NOT EXISTS `subscribers_packages` (
  `subscriber_id` bigint(20) NOT NULL,
  `package_id` bigint(20) NOT NULL,
  PRIMARY KEY (`subscriber_id`,`package_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Link table between subscribers and packages';

# Dumping data for table lfg.subscribers_packages: 9 rows
DELETE FROM `subscribers_packages`;
/*!40000 ALTER TABLE `subscribers_packages` DISABLE KEYS */;
INSERT INTO `subscribers_packages` (`subscriber_id`, `package_id`) VALUES
	(1, 1),
	(1, 2),
	(2, 1),
	(2, 2),
	(3, 1),
	(3, 2),
	(4, 1),
	(4, 2),
	(5, 1);
/*!40000 ALTER TABLE `subscribers_packages` ENABLE KEYS */;


# Dumping structure for table lfg.support_tickets
DROP TABLE IF EXISTS `support_tickets`;
CREATE TABLE IF NOT EXISTS `support_tickets` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` int(10) DEFAULT NULL,
  `enquiry_type` varchar(50) DEFAULT NULL,
  `enquiry_text` varchar(500) DEFAULT NULL,
  `date_opened` timestamp NULL DEFAULT NULL,
  `date_closed` timestamp NULL DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Table for support Tickets';

# Dumping data for table lfg.support_tickets: 0 rows
DELETE FROM `support_tickets`;
/*!40000 ALTER TABLE `support_tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `support_tickets` ENABLE KEYS */;


# Dumping structure for table lfg.tickets
DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
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

# Dumping data for table lfg.tickets: 0 rows
DELETE FROM `tickets`;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;


# Dumping structure for table lfg.trainers
DROP TABLE IF EXISTS `trainers`;
CREATE TABLE IF NOT EXISTS `trainers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `big_pic` varchar(100) DEFAULT NULL,
  `small_pic` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

# Dumping data for table lfg.trainers: 1 rows
DELETE FROM `trainers`;
/*!40000 ALTER TABLE `trainers` DISABLE KEYS */;
INSERT INTO `trainers` (`id`, `name`, `description`, `big_pic`, `small_pic`) VALUES
	(1, 'Barack Obama', 'He is a very mondation person. Victor is mondation', 'BarackObama_big.jpg', 'BarackObama_small.jpg');
/*!40000 ALTER TABLE `trainers` ENABLE KEYS */;


# Dumping structure for table lfg.vodcategories
DROP TABLE IF EXISTS `vodcategories`;
CREATE TABLE IF NOT EXISTS `vodcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) DEFAULT NULL COMMENT 'Group name',
  `parent` int(11) NOT NULL COMMENT 'Parent branch ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

# Dumping data for table lfg.vodcategories: 3 rows
DELETE FROM `vodcategories`;
/*!40000 ALTER TABLE `vodcategories` DISABLE KEYS */;
INSERT INTO `vodcategories` (`id`, `name`, `parent`) VALUES
	(2, 'Animation', 0),
	(3, 'Action', 0),
	(4, 'Music, Concerts', 0);
/*!40000 ALTER TABLE `vodcategories` ENABLE KEYS */;


# Dumping structure for table lfg.vodchannels
DROP TABLE IF EXISTS `vodchannels`;
CREATE TABLE IF NOT EXISTS `vodchannels` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `big_pic` varchar(100) NOT NULL DEFAULT '0',
  `small_pic` varchar(100) NOT NULL DEFAULT '0',
  `name` varchar(150) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `stb_url` varchar(200) DEFAULT NULL,
  `download_url` varchar(200) DEFAULT NULL,
  `pc_url` varchar(200) DEFAULT NULL,
  `local_url` varchar(200) DEFAULT NULL,
  `trainer` int(10) DEFAULT NULL,
  `date_release` timestamp NULL DEFAULT NULL,
  `keywords` varchar(250) DEFAULT NULL,
  `rating` int(2) DEFAULT NULL,
  `price` int(100) DEFAULT NULL,
  `currency` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COMMENT='Channels on demand';

# Dumping data for table lfg.vodchannels: 5 rows
DELETE FROM `vodchannels`;
/*!40000 ALTER TABLE `vodchannels` DISABLE KEYS */;
INSERT INTO `vodchannels` (`id`, `big_pic`, `small_pic`, `name`, `description`, `stb_url`, `download_url`, `pc_url`, `local_url`, `trainer`, `date_release`, `keywords`, `rating`, `price`, `currency`) VALUES
	(1, '255px-Big_buck_bunny_poster_big_big.jpg', '255px-Big_buck_bunny_poster_big_small.jpg', 'Big Buck Bunny', 'This is the VOD movie!', 'http://iptv.rampms.com:1935/vod/smil:bigbuckbunny.smil/playlist.m3u8', '--', '--', 'http://localserver/videos/mp4test.mp4', 1, '2012-02-11 23:56:40', 'Movies-Animation', 1, 0, 2),
	(2, 'poster24__5_big.jpg', 'poster24__5_small.jpg', '24', '24 Jack Powell!', 'http://iptv.rampms.com:1935/vod/smil:24.smil/playlist.m3u8', '--', '--', '--', 1, '2012-02-12 00:06:03', 'Action - Heros', 1, 0, 1),
	(3, 'bee_big.jpg', 'bee_small.jpg', 'Bee Movie', 'Bee Movie!', 'http://iptv.rampms.com:1935/vod/smil:beemovie.smil/playlist.m3u8', '--', '--', '--', 1, '2012-02-12 00:08:39', 'Tramas chimbas', 1, 0, 1),
	(5, 'eagles_big.jpg', 'eagles_small.jpg', 'Eagles', 'Eagles concert!', 'http://iptv.rampms.com:1935/vod/smil:eagles.smil/playlist.m3u8', '--', '--', 'http://localserver/videos/evgeny.mp4', 1, '2012-02-12 00:14:48', 'Music, Concerts', 1, 0, 1),
	(6, 'black_big.jpg', 'black_small.jpg', 'BlackEyedPeas', 'BlackEyedPeas', 'http://iptv.rampms.com:1935/vod/smil:blackeye.smil/playlist.m3u8', '--', '--', 'http://localserver/videos/evgeny.mp4', 1, '2012-02-12 00:18:07', 'Music, Concerts', 1, 0, 1);
/*!40000 ALTER TABLE `vodchannels` ENABLE KEYS */;


# Dumping structure for table lfg.vodchannels_resources
DROP TABLE IF EXISTS `vodchannels_resources`;
CREATE TABLE IF NOT EXISTS `vodchannels_resources` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `channel_id` bigint(20) DEFAULT NULL,
  `resource_path` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

# Dumping data for table lfg.vodchannels_resources: 0 rows
DELETE FROM `vodchannels_resources`;
/*!40000 ALTER TABLE `vodchannels_resources` DISABLE KEYS */;
/*!40000 ALTER TABLE `vodchannels_resources` ENABLE KEYS */;


# Dumping structure for table lfg.vod_channels_categories
DROP TABLE IF EXISTS `vod_channels_categories`;
CREATE TABLE IF NOT EXISTS `vod_channels_categories` (
  `channel_id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL,
  PRIMARY KEY (`channel_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

# Dumping data for table lfg.vod_channels_categories: 5 rows
DELETE FROM `vod_channels_categories`;
/*!40000 ALTER TABLE `vod_channels_categories` DISABLE KEYS */;
INSERT INTO `vod_channels_categories` (`channel_id`, `category_id`) VALUES
	(1, 2),
	(2, 3),
	(3, 2),
	(5, 4),
	(6, 4);
/*!40000 ALTER TABLE `vod_channels_categories` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
