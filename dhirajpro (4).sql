-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 19, 2018 at 03:07 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dhirajpro`
--

-- --------------------------------------------------------

--
-- Table structure for table `compbank`
--

DROP TABLE IF EXISTS `compbank`;
CREATE TABLE IF NOT EXISTS `compbank` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `orgid` varchar(25) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `ctype` varchar(25) DEFAULT NULL,
  `location` varchar(30) DEFAULT NULL,
  `bankname` varchar(25) DEFAULT NULL,
  `acctno` varchar(20) NOT NULL,
  `acctname` varchar(40) NOT NULL,
  `acctype` varchar(20) NOT NULL,
  `branch` varchar(30) NOT NULL,
  `ifsc` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compbank`
--

INSERT INTO `compbank` (`id`, `orgid`, `name`, `ctype`, `location`, `bankname`, `acctno`, `acctname`, `acctype`, `branch`, `ifsc`) VALUES
(001, 'DAPL001', NULL, NULL, NULL, 'HDFC Bank', '213244444', 'Vishwam', 'Current', 'Kaveripattinam', 'HDFC003');

-- --------------------------------------------------------

--
-- Table structure for table `comprofile`
--

DROP TABLE IF EXISTS `comprofile`;
CREATE TABLE IF NOT EXISTS `comprofile` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `orgid` varchar(15) NOT NULL,
  `prefix` varchar(15) DEFAULT 'DAPL',
  `title` varchar(6) NOT NULL,
  `orgname` varchar(50) NOT NULL,
  `portal` varchar(100) NOT NULL,
  `orgtype` varchar(50) NOT NULL,
  `blocation` varchar(100) NOT NULL,
  `industry` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `workphone` varchar(30) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `email` varchar(40) NOT NULL,
  `web` varchar(40) NOT NULL,
  `gstin` varchar(25) NOT NULL,
  `gstregdate` date NOT NULL,
  `primaryflag` int(20) NOT NULL DEFAULT '0',
  `image` varchar(155) DEFAULT NULL,
  `tandc` varchar(500) DEFAULT NULL,
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP,
  `createdby` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedby` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comprofile`
--

INSERT INTO `comprofile` (`id`, `orgid`, `prefix`, `title`, `orgname`, `portal`, `orgtype`, `blocation`, `industry`, `address`, `city`, `country`, `state`, `zip`, `workphone`, `mobile`, `email`, `web`, `gstin`, `gstregdate`, `primaryflag`, `image`, `tandc`, `createdon`, `createdby`, `updatedon`, `updatedby`) VALUES
(001, 'DAPL001', 'DAPL', '', 'Vishwam Food Products Pvt. Ltd.,', 'Vishwam', '1', 'Kaveripattinam', '1', 'Kundalpatti Village,Kaveripattinam Road', 'Krishnagiri-Dt.', 'IN', 'TN', '635001', '', '9677573737', 'saravanas.office@gmail.com', '', '2113124', '2018-05-01', 1, 'upload/e-SchoolzLogo.jpg', NULL, '2018-05-15 20:21:56', '2018-05-15 20:21:56', '2018-05-15 20:21:56', '2018-05-15 20:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(10) NOT NULL DEFAULT '0',
  `code` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `code`, `description`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AX', 'Aland Islands'),
(3, 'AL', 'Albania'),
(4, 'DZ', 'Algeria'),
(5, 'AS', 'American Samoa'),
(6, 'AD', 'Andorra'),
(7, 'AO', 'Angola'),
(8, 'AI', 'Anguilla'),
(9, 'AQ', 'Antarctica'),
(10, 'AG', 'Antigua and Barbuda'),
(11, 'AR', 'Argentina'),
(12, 'AM', 'Armenia'),
(13, 'AW', 'Aruba'),
(14, 'AU', 'Australia'),
(15, 'AT', 'Austria'),
(16, 'AZ', 'Azerbaijan'),
(17, 'BS', 'Bahamas'),
(18, 'BH', 'Bahrain'),
(19, 'BD', 'Bangladesh'),
(20, 'BB', 'Barbados'),
(21, 'BY', 'Belarus'),
(22, 'BE', 'Belgium'),
(23, 'BZ', 'Belize'),
(24, 'BJ', 'Benin'),
(25, 'BM', 'Bermuda'),
(26, 'BT', 'Bhutan'),
(27, 'BO', 'Bolivia'),
(28, 'BQ', 'Bonaire, Saint Eustatius and Saba'),
(29, 'BA', 'Bosnia and Herzegovina'),
(30, 'BW', 'Botswana'),
(31, 'BV', 'Bouvet Island'),
(32, 'BR', 'Brazil'),
(33, 'IO', 'British Indian Ocean Territory'),
(34, 'VG', 'British Virgin Islands'),
(35, 'BN', 'Brunei'),
(36, 'BG', 'Bulgaria'),
(37, 'BF', 'Burkina Faso'),
(38, 'BI', 'Burundi'),
(39, 'KH', 'Cambodia'),
(40, 'CM', 'Cameroon'),
(41, 'CA', 'Canada'),
(42, 'CV', 'Cape Verde'),
(43, 'KY', 'Cayman Islands'),
(44, 'CF', 'Central African Republic'),
(45, 'TD', 'Chad'),
(46, 'CL', 'Chile'),
(47, 'CN', 'China'),
(48, 'CX', 'Christmas Island'),
(49, 'CC', 'Cocos Islands'),
(50, 'CO', 'Colombia'),
(51, 'KM', 'Comoros'),
(52, 'CK', 'Cook Islands'),
(53, 'CR', 'Costa Rica'),
(54, 'HR', 'Croatia'),
(55, 'CU', 'Cuba'),
(56, 'CW', 'Curacao'),
(57, 'CY', 'Cyprus'),
(58, 'CZ', 'Czech Republic'),
(59, 'CD', 'Democratic Republic of the Congo'),
(60, 'DK', 'Denmark'),
(61, 'DJ', 'Djibouti'),
(62, 'DM', 'Dominica'),
(63, 'DO', 'Dominican Republic'),
(64, 'TL', 'East Timor'),
(65, 'EC', 'Ecuador'),
(66, 'EG', 'Egypt'),
(67, 'SV', 'El Salvador'),
(68, 'GQ', 'Equatorial Guinea'),
(69, 'ER', 'Eritrea'),
(70, 'EE', 'Estonia'),
(71, 'ET', 'Ethiopia'),
(72, 'FK', 'Falkland Islands'),
(73, 'FO', 'Faroe Islands'),
(74, 'FJ', 'Fiji'),
(75, 'FI', 'Finland'),
(76, 'FR', 'France'),
(77, 'GF', 'French Guiana'),
(78, 'PF', 'French Polynesia'),
(79, 'TF', 'French Southern Territories'),
(80, 'GA', 'Gabon'),
(81, 'GM', 'Gambia'),
(82, 'GE', 'Georgia'),
(83, 'DE', 'Germany'),
(84, 'GH', 'Ghana'),
(85, 'GI', 'Gibraltar'),
(86, 'GR', 'Greece'),
(87, 'GL', 'Greenland'),
(88, 'GD', 'Grenada'),
(89, 'GP', 'Guadeloupe'),
(90, 'GU', 'Guam'),
(91, 'GT', 'Guatemala'),
(92, 'GG', 'Guernsey'),
(93, 'GN', 'Guinea'),
(94, 'GW', 'Guinea-Bissau'),
(95, 'GY', 'Guyana'),
(96, 'HT', 'Haiti'),
(97, 'HM', 'Heard Island and McDonald Islands'),
(98, 'HN', 'Honduras'),
(99, 'HK', 'Hong Kong'),
(100, 'HU', 'Hungary'),
(101, 'IS', 'Iceland'),
(102, 'IN', 'India'),
(103, 'ID', 'Indonesia'),
(104, 'IR', 'Iran'),
(105, 'IQ', 'Iraq'),
(106, 'IE', 'Ireland'),
(107, 'IM', 'Isle of Man'),
(108, 'IL', 'Israel'),
(109, 'IT', 'Italy'),
(110, 'CI', 'Ivory Coast'),
(111, 'JM', 'Jamaica'),
(112, 'JP', 'Japan'),
(113, 'JE', 'Jersey'),
(114, 'JO', 'Jordan'),
(115, 'KZ', 'Kazakhstan'),
(116, 'KE', 'Kenya'),
(117, 'KI', 'Kiribati'),
(118, 'XK', 'Kosovo'),
(119, 'KW', 'Kuwait'),
(120, 'KG', 'Kyrgyzstan'),
(121, 'LA', 'Laos'),
(122, 'LV', 'Latvia'),
(123, 'LB', 'Lebanon'),
(124, 'LS', 'Lesotho'),
(125, 'LR', 'Liberia'),
(126, 'LY', 'Libya'),
(127, 'LI', 'Liechtenstein'),
(128, 'LT', 'Lithuania'),
(129, 'LU', 'Luxembourg'),
(130, 'MO', 'Macao'),
(131, 'MK', 'Macedonia'),
(132, 'MG', 'Madagascar'),
(133, 'MW', 'Malawi'),
(134, 'MY', 'Malaysia'),
(135, 'MV', 'Maldives'),
(136, 'ML', 'Mali'),
(137, 'MT', 'Malta'),
(138, 'MH', 'Marshall Islands'),
(139, 'MQ', 'Martinique'),
(140, 'MR', 'Mauritania'),
(141, 'MU', 'Mauritius'),
(142, 'YT', 'Mayotte'),
(143, 'MX', 'Mexico'),
(144, 'FM', 'Micronesia'),
(145, 'MD', 'Moldova'),
(146, 'MC', 'Monaco'),
(147, 'MN', 'Mongolia'),
(148, 'ME', 'Montenegro'),
(149, 'MS', 'Montserrat'),
(150, 'MA', 'Morocco'),
(151, 'MZ', 'Mozambique'),
(152, 'MM', 'Myanmar'),
(153, 'NA', 'Namibia'),
(154, 'NR', 'Nauru'),
(155, 'NP', 'Nepal'),
(156, 'NL', 'Netherlands'),
(157, 'AN', 'Netherlands Antilles'),
(158, 'NC', 'New Caledonia'),
(159, 'NZ', 'New Zealand'),
(160, 'NI', 'Nicaragua'),
(161, 'NE', 'Niger'),
(162, 'NG', 'Nigeria'),
(163, 'NU', 'Niue'),
(164, 'NF', 'Norfolk Island'),
(165, 'KP', 'North Korea'),
(166, 'MP', 'Northern Mariana Islands'),
(167, 'NO', 'Norway'),
(168, 'OM', 'Oman'),
(169, 'PK', 'Pakistan'),
(170, 'PW', 'Palau'),
(171, 'PS', 'Palestinian Territory'),
(172, 'PA', 'Panama'),
(173, 'PG', 'Papua New Guinea'),
(174, 'PY', 'Paraguay'),
(175, 'PE', 'Peru'),
(176, 'PH', 'Philippines'),
(177, 'PN', 'Pitcairn'),
(178, 'PL', 'Poland'),
(179, 'PT', 'Portugal'),
(180, 'PR', 'Puerto Rico'),
(181, 'QA', 'Qatar'),
(182, 'CG', 'Republic of the Congo'),
(183, 'RE', 'Reunion'),
(184, 'RO', 'Romania'),
(185, 'RU', 'Russia'),
(186, 'RW', 'Rwanda'),
(187, 'BL', 'Saint Barthelemy'),
(188, 'SH', 'Saint Helena'),
(189, 'KN', 'Saint Kitts and Nevis'),
(190, 'LC', 'Saint Lucia'),
(191, 'MF', 'Saint Martin'),
(192, 'PM', 'Saint Pierre and Miquelon'),
(193, 'VC', 'Saint Vincent and the Grenadines'),
(194, 'WS', 'Samoa'),
(195, 'SM', 'San Marino'),
(196, 'ST', 'Sao Tome and Principe'),
(197, 'SA', 'Saudi Arabia'),
(198, 'SN', 'Senegal'),
(199, 'RS', 'Serbia'),
(200, 'CS', 'Serbia and Montenegro'),
(201, 'SC', 'Seychelles'),
(202, 'SL', 'Sierra Leone'),
(203, 'SG', 'Singapore'),
(204, 'SX', 'Sint Maarten'),
(205, 'SK', 'Slovakia'),
(206, 'SI', 'Slovenia'),
(207, 'SB', 'Solomon Islands'),
(208, 'SO', 'Somalia'),
(209, 'ZA', 'South Africa'),
(210, 'GS', 'South Georgia and the South Sandwich Islands'),
(211, 'KR', 'South Korea'),
(212, 'SS', 'South Sudan'),
(213, 'ES', 'Spain'),
(214, 'LK', 'Sri Lanka'),
(215, 'SD', 'Sudan'),
(216, 'SR', 'Suriname'),
(217, 'SJ', 'Svalbard and Jan Mayen'),
(218, 'SZ', 'Swaziland'),
(219, 'SE', 'Sweden'),
(220, 'CH', 'Switzerland'),
(221, 'SY', 'Syria'),
(222, 'TW', 'Taiwan'),
(223, 'TJ', 'Tajikistan'),
(224, 'TZ', 'Tanzania'),
(225, 'TH', 'Thailand'),
(226, 'TG', 'Togo'),
(227, 'TK', 'Tokelau'),
(228, 'TO', 'Tonga'),
(229, 'TT', 'Trinidad and Tobago'),
(230, 'TN', 'Tunisia'),
(231, 'TR', 'Turkey'),
(232, 'TM', 'Turkmenistan'),
(233, 'TC', 'Turks and Caicos Islands'),
(234, 'TV', 'Tuvalu'),
(235, 'VI', 'U.S. Virgin Islands'),
(236, 'UG', 'Uganda'),
(237, 'UA', 'Ukraine'),
(238, 'AE', 'United Arab Emirates'),
(239, 'GB', 'United Kingdom'),
(240, 'US', 'United States'),
(241, 'UM', 'United States Minor Outlying Islands'),
(242, 'UY', 'Uruguay'),
(243, 'UZ', 'Uzbekistan'),
(244, 'VU', 'Vanuatu'),
(245, 'VA', 'Vatican'),
(246, 'VE', 'Venezuela'),
(247, 'VN', 'Vietnam'),
(248, 'WF', 'Wallis and Futuna'),
(249, 'EH', 'Western Sahara'),
(250, 'YE', 'Yemen'),
(251, 'ZM', 'Zambia'),
(252, 'ZW', 'Zimbabwe'),
(1, 'AF', 'Afghanistan'),
(2, 'AX', 'Aland Islands'),
(3, 'AL', 'Albania'),
(4, 'DZ', 'Algeria'),
(5, 'AS', 'American Samoa'),
(6, 'AD', 'Andorra'),
(7, 'AO', 'Angola'),
(8, 'AI', 'Anguilla'),
(9, 'AQ', 'Antarctica'),
(10, 'AG', 'Antigua and Barbuda'),
(11, 'AR', 'Argentina'),
(12, 'AM', 'Armenia'),
(13, 'AW', 'Aruba'),
(14, 'AU', 'Australia'),
(15, 'AT', 'Austria'),
(16, 'AZ', 'Azerbaijan'),
(17, 'BS', 'Bahamas'),
(18, 'BH', 'Bahrain'),
(19, 'BD', 'Bangladesh'),
(20, 'BB', 'Barbados'),
(21, 'BY', 'Belarus'),
(22, 'BE', 'Belgium'),
(23, 'BZ', 'Belize'),
(24, 'BJ', 'Benin'),
(25, 'BM', 'Bermuda'),
(26, 'BT', 'Bhutan'),
(27, 'BO', 'Bolivia'),
(28, 'BQ', 'Bonaire, Saint Eustatius and Saba'),
(29, 'BA', 'Bosnia and Herzegovina'),
(30, 'BW', 'Botswana'),
(31, 'BV', 'Bouvet Island'),
(32, 'BR', 'Brazil'),
(33, 'IO', 'British Indian Ocean Territory'),
(34, 'VG', 'British Virgin Islands'),
(35, 'BN', 'Brunei'),
(36, 'BG', 'Bulgaria'),
(37, 'BF', 'Burkina Faso'),
(38, 'BI', 'Burundi'),
(39, 'KH', 'Cambodia'),
(40, 'CM', 'Cameroon'),
(41, 'CA', 'Canada'),
(42, 'CV', 'Cape Verde'),
(43, 'KY', 'Cayman Islands'),
(44, 'CF', 'Central African Republic'),
(45, 'TD', 'Chad'),
(46, 'CL', 'Chile'),
(47, 'CN', 'China'),
(48, 'CX', 'Christmas Island'),
(49, 'CC', 'Cocos Islands'),
(50, 'CO', 'Colombia'),
(51, 'KM', 'Comoros'),
(52, 'CK', 'Cook Islands'),
(53, 'CR', 'Costa Rica'),
(54, 'HR', 'Croatia'),
(55, 'CU', 'Cuba'),
(56, 'CW', 'Curacao'),
(57, 'CY', 'Cyprus'),
(58, 'CZ', 'Czech Republic'),
(59, 'CD', 'Democratic Republic of the Congo'),
(60, 'DK', 'Denmark'),
(61, 'DJ', 'Djibouti'),
(62, 'DM', 'Dominica'),
(63, 'DO', 'Dominican Republic'),
(64, 'TL', 'East Timor'),
(65, 'EC', 'Ecuador'),
(66, 'EG', 'Egypt'),
(67, 'SV', 'El Salvador'),
(68, 'GQ', 'Equatorial Guinea'),
(69, 'ER', 'Eritrea'),
(70, 'EE', 'Estonia'),
(71, 'ET', 'Ethiopia'),
(72, 'FK', 'Falkland Islands'),
(73, 'FO', 'Faroe Islands'),
(74, 'FJ', 'Fiji'),
(75, 'FI', 'Finland'),
(76, 'FR', 'France'),
(77, 'GF', 'French Guiana'),
(78, 'PF', 'French Polynesia'),
(79, 'TF', 'French Southern Territories'),
(80, 'GA', 'Gabon'),
(81, 'GM', 'Gambia'),
(82, 'GE', 'Georgia'),
(83, 'DE', 'Germany'),
(84, 'GH', 'Ghana'),
(85, 'GI', 'Gibraltar'),
(86, 'GR', 'Greece'),
(87, 'GL', 'Greenland'),
(88, 'GD', 'Grenada'),
(89, 'GP', 'Guadeloupe'),
(90, 'GU', 'Guam'),
(91, 'GT', 'Guatemala'),
(92, 'GG', 'Guernsey'),
(93, 'GN', 'Guinea'),
(94, 'GW', 'Guinea-Bissau'),
(95, 'GY', 'Guyana'),
(96, 'HT', 'Haiti'),
(97, 'HM', 'Heard Island and McDonald Islands'),
(98, 'HN', 'Honduras'),
(99, 'HK', 'Hong Kong'),
(100, 'HU', 'Hungary'),
(101, 'IS', 'Iceland'),
(102, 'IN', 'India'),
(103, 'ID', 'Indonesia'),
(104, 'IR', 'Iran'),
(105, 'IQ', 'Iraq'),
(106, 'IE', 'Ireland'),
(107, 'IM', 'Isle of Man'),
(108, 'IL', 'Israel'),
(109, 'IT', 'Italy'),
(110, 'CI', 'Ivory Coast'),
(111, 'JM', 'Jamaica'),
(112, 'JP', 'Japan'),
(113, 'JE', 'Jersey'),
(114, 'JO', 'Jordan'),
(115, 'KZ', 'Kazakhstan'),
(116, 'KE', 'Kenya'),
(117, 'KI', 'Kiribati'),
(118, 'XK', 'Kosovo'),
(119, 'KW', 'Kuwait'),
(120, 'KG', 'Kyrgyzstan'),
(121, 'LA', 'Laos'),
(122, 'LV', 'Latvia'),
(123, 'LB', 'Lebanon'),
(124, 'LS', 'Lesotho'),
(125, 'LR', 'Liberia'),
(126, 'LY', 'Libya'),
(127, 'LI', 'Liechtenstein'),
(128, 'LT', 'Lithuania'),
(129, 'LU', 'Luxembourg'),
(130, 'MO', 'Macao'),
(131, 'MK', 'Macedonia'),
(132, 'MG', 'Madagascar'),
(133, 'MW', 'Malawi'),
(134, 'MY', 'Malaysia'),
(135, 'MV', 'Maldives'),
(136, 'ML', 'Mali'),
(137, 'MT', 'Malta'),
(138, 'MH', 'Marshall Islands'),
(139, 'MQ', 'Martinique'),
(140, 'MR', 'Mauritania'),
(141, 'MU', 'Mauritius'),
(142, 'YT', 'Mayotte'),
(143, 'MX', 'Mexico'),
(144, 'FM', 'Micronesia'),
(145, 'MD', 'Moldova'),
(146, 'MC', 'Monaco'),
(147, 'MN', 'Mongolia'),
(148, 'ME', 'Montenegro'),
(149, 'MS', 'Montserrat'),
(150, 'MA', 'Morocco'),
(151, 'MZ', 'Mozambique'),
(152, 'MM', 'Myanmar'),
(153, 'NA', 'Namibia'),
(154, 'NR', 'Nauru'),
(155, 'NP', 'Nepal'),
(156, 'NL', 'Netherlands'),
(157, 'AN', 'Netherlands Antilles'),
(158, 'NC', 'New Caledonia'),
(159, 'NZ', 'New Zealand'),
(160, 'NI', 'Nicaragua'),
(161, 'NE', 'Niger'),
(162, 'NG', 'Nigeria'),
(163, 'NU', 'Niue'),
(164, 'NF', 'Norfolk Island'),
(165, 'KP', 'North Korea'),
(166, 'MP', 'Northern Mariana Islands'),
(167, 'NO', 'Norway'),
(168, 'OM', 'Oman'),
(169, 'PK', 'Pakistan'),
(170, 'PW', 'Palau'),
(171, 'PS', 'Palestinian Territory'),
(172, 'PA', 'Panama'),
(173, 'PG', 'Papua New Guinea'),
(174, 'PY', 'Paraguay'),
(175, 'PE', 'Peru'),
(176, 'PH', 'Philippines'),
(177, 'PN', 'Pitcairn'),
(178, 'PL', 'Poland'),
(179, 'PT', 'Portugal'),
(180, 'PR', 'Puerto Rico'),
(181, 'QA', 'Qatar'),
(182, 'CG', 'Republic of the Congo'),
(183, 'RE', 'Reunion'),
(184, 'RO', 'Romania'),
(185, 'RU', 'Russia'),
(186, 'RW', 'Rwanda'),
(187, 'BL', 'Saint Barthelemy'),
(188, 'SH', 'Saint Helena'),
(189, 'KN', 'Saint Kitts and Nevis'),
(190, 'LC', 'Saint Lucia'),
(191, 'MF', 'Saint Martin'),
(192, 'PM', 'Saint Pierre and Miquelon'),
(193, 'VC', 'Saint Vincent and the Grenadines'),
(194, 'WS', 'Samoa'),
(195, 'SM', 'San Marino'),
(196, 'ST', 'Sao Tome and Principe'),
(197, 'SA', 'Saudi Arabia'),
(198, 'SN', 'Senegal'),
(199, 'RS', 'Serbia'),
(200, 'CS', 'Serbia and Montenegro'),
(201, 'SC', 'Seychelles'),
(202, 'SL', 'Sierra Leone'),
(203, 'SG', 'Singapore'),
(204, 'SX', 'Sint Maarten'),
(205, 'SK', 'Slovakia'),
(206, 'SI', 'Slovenia'),
(207, 'SB', 'Solomon Islands'),
(208, 'SO', 'Somalia'),
(209, 'ZA', 'South Africa'),
(210, 'GS', 'South Georgia and the South Sandwich Islands'),
(211, 'KR', 'South Korea'),
(212, 'SS', 'South Sudan'),
(213, 'ES', 'Spain'),
(214, 'LK', 'Sri Lanka'),
(215, 'SD', 'Sudan'),
(216, 'SR', 'Suriname'),
(217, 'SJ', 'Svalbard and Jan Mayen'),
(218, 'SZ', 'Swaziland'),
(219, 'SE', 'Sweden'),
(220, 'CH', 'Switzerland'),
(221, 'SY', 'Syria'),
(222, 'TW', 'Taiwan'),
(223, 'TJ', 'Tajikistan'),
(224, 'TZ', 'Tanzania'),
(225, 'TH', 'Thailand'),
(226, 'TG', 'Togo'),
(227, 'TK', 'Tokelau'),
(228, 'TO', 'Tonga'),
(229, 'TT', 'Trinidad and Tobago'),
(230, 'TN', 'Tunisia'),
(231, 'TR', 'Turkey'),
(232, 'TM', 'Turkmenistan'),
(233, 'TC', 'Turks and Caicos Islands'),
(234, 'TV', 'Tuvalu'),
(235, 'VI', 'U.S. Virgin Islands'),
(236, 'UG', 'Uganda'),
(237, 'UA', 'Ukraine'),
(238, 'AE', 'United Arab Emirates'),
(239, 'GB', 'United Kingdom'),
(240, 'US', 'United States'),
(241, 'UM', 'United States Minor Outlying Islands'),
(242, 'UY', 'Uruguay'),
(243, 'UZ', 'Uzbekistan'),
(244, 'VU', 'Vanuatu'),
(245, 'VA', 'Vatican'),
(246, 'VE', 'Venezuela'),
(247, 'VN', 'Vietnam'),
(248, 'WF', 'Wallis and Futuna'),
(249, 'EH', 'Western Sahara'),
(250, 'YE', 'Yemen'),
(251, 'ZM', 'Zambia'),
(252, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `country_lookups`
--

DROP TABLE IF EXISTS `country_lookups`;
CREATE TABLE IF NOT EXISTS `country_lookups` (
  `id` int(10) NOT NULL DEFAULT '0',
  `code` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country_lookups`
--

INSERT INTO `country_lookups` (`id`, `code`, `description`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AX', 'Aland Islands'),
(3, 'AL', 'Albania'),
(4, 'DZ', 'Algeria'),
(5, 'AS', 'American Samoa'),
(6, 'AD', 'Andorra'),
(7, 'AO', 'Angola'),
(8, 'AI', 'Anguilla'),
(9, 'AQ', 'Antarctica'),
(10, 'AG', 'Antigua and Barbuda'),
(11, 'AR', 'Argentina'),
(12, 'AM', 'Armenia'),
(13, 'AW', 'Aruba'),
(14, 'AU', 'Australia'),
(15, 'AT', 'Austria'),
(16, 'AZ', 'Azerbaijan'),
(17, 'BS', 'Bahamas'),
(18, 'BH', 'Bahrain'),
(19, 'BD', 'Bangladesh'),
(20, 'BB', 'Barbados'),
(21, 'BY', 'Belarus'),
(22, 'BE', 'Belgium'),
(23, 'BZ', 'Belize'),
(24, 'BJ', 'Benin'),
(25, 'BM', 'Bermuda'),
(26, 'BT', 'Bhutan'),
(27, 'BO', 'Bolivia'),
(28, 'BQ', 'Bonaire, Saint Eustatius and Saba'),
(29, 'BA', 'Bosnia and Herzegovina'),
(30, 'BW', 'Botswana'),
(31, 'BV', 'Bouvet Island'),
(32, 'BR', 'Brazil'),
(33, 'IO', 'British Indian Ocean Territory'),
(34, 'VG', 'British Virgin Islands'),
(35, 'BN', 'Brunei'),
(36, 'BG', 'Bulgaria'),
(37, 'BF', 'Burkina Faso'),
(38, 'BI', 'Burundi'),
(39, 'KH', 'Cambodia'),
(40, 'CM', 'Cameroon'),
(41, 'CA', 'Canada'),
(42, 'CV', 'Cape Verde'),
(43, 'KY', 'Cayman Islands'),
(44, 'CF', 'Central African Republic'),
(45, 'TD', 'Chad'),
(46, 'CL', 'Chile'),
(47, 'CN', 'China'),
(48, 'CX', 'Christmas Island'),
(49, 'CC', 'Cocos Islands'),
(50, 'CO', 'Colombia'),
(51, 'KM', 'Comoros'),
(52, 'CK', 'Cook Islands'),
(53, 'CR', 'Costa Rica'),
(54, 'HR', 'Croatia'),
(55, 'CU', 'Cuba'),
(56, 'CW', 'Curacao'),
(57, 'CY', 'Cyprus'),
(58, 'CZ', 'Czech Republic'),
(59, 'CD', 'Democratic Republic of the Congo'),
(60, 'DK', 'Denmark'),
(61, 'DJ', 'Djibouti'),
(62, 'DM', 'Dominica'),
(63, 'DO', 'Dominican Republic'),
(64, 'TL', 'East Timor'),
(65, 'EC', 'Ecuador'),
(66, 'EG', 'Egypt'),
(67, 'SV', 'El Salvador'),
(68, 'GQ', 'Equatorial Guinea'),
(69, 'ER', 'Eritrea'),
(70, 'EE', 'Estonia'),
(71, 'ET', 'Ethiopia'),
(72, 'FK', 'Falkland Islands'),
(73, 'FO', 'Faroe Islands'),
(74, 'FJ', 'Fiji'),
(75, 'FI', 'Finland'),
(76, 'FR', 'France'),
(77, 'GF', 'French Guiana'),
(78, 'PF', 'French Polynesia'),
(79, 'TF', 'French Southern Territories'),
(80, 'GA', 'Gabon'),
(81, 'GM', 'Gambia'),
(82, 'GE', 'Georgia'),
(83, 'DE', 'Germany'),
(84, 'GH', 'Ghana'),
(85, 'GI', 'Gibraltar'),
(86, 'GR', 'Greece'),
(87, 'GL', 'Greenland'),
(88, 'GD', 'Grenada'),
(89, 'GP', 'Guadeloupe'),
(90, 'GU', 'Guam'),
(91, 'GT', 'Guatemala'),
(92, 'GG', 'Guernsey'),
(93, 'GN', 'Guinea'),
(94, 'GW', 'Guinea-Bissau'),
(95, 'GY', 'Guyana'),
(96, 'HT', 'Haiti'),
(97, 'HM', 'Heard Island and McDonald Islands'),
(98, 'HN', 'Honduras'),
(99, 'HK', 'Hong Kong'),
(100, 'HU', 'Hungary'),
(101, 'IS', 'Iceland'),
(102, 'IN', 'India'),
(103, 'ID', 'Indonesia'),
(104, 'IR', 'Iran'),
(105, 'IQ', 'Iraq'),
(106, 'IE', 'Ireland'),
(107, 'IM', 'Isle of Man'),
(108, 'IL', 'Israel'),
(109, 'IT', 'Italy'),
(110, 'CI', 'Ivory Coast'),
(111, 'JM', 'Jamaica'),
(112, 'JP', 'Japan'),
(113, 'JE', 'Jersey'),
(114, 'JO', 'Jordan'),
(115, 'KZ', 'Kazakhstan'),
(116, 'KE', 'Kenya'),
(117, 'KI', 'Kiribati'),
(118, 'XK', 'Kosovo'),
(119, 'KW', 'Kuwait'),
(120, 'KG', 'Kyrgyzstan'),
(121, 'LA', 'Laos'),
(122, 'LV', 'Latvia'),
(123, 'LB', 'Lebanon'),
(124, 'LS', 'Lesotho'),
(125, 'LR', 'Liberia'),
(126, 'LY', 'Libya'),
(127, 'LI', 'Liechtenstein'),
(128, 'LT', 'Lithuania'),
(129, 'LU', 'Luxembourg'),
(130, 'MO', 'Macao'),
(131, 'MK', 'Macedonia'),
(132, 'MG', 'Madagascar'),
(133, 'MW', 'Malawi'),
(134, 'MY', 'Malaysia'),
(135, 'MV', 'Maldives'),
(136, 'ML', 'Mali'),
(137, 'MT', 'Malta'),
(138, 'MH', 'Marshall Islands'),
(139, 'MQ', 'Martinique'),
(140, 'MR', 'Mauritania'),
(141, 'MU', 'Mauritius'),
(142, 'YT', 'Mayotte'),
(143, 'MX', 'Mexico'),
(144, 'FM', 'Micronesia'),
(145, 'MD', 'Moldova'),
(146, 'MC', 'Monaco'),
(147, 'MN', 'Mongolia'),
(148, 'ME', 'Montenegro'),
(149, 'MS', 'Montserrat'),
(150, 'MA', 'Morocco'),
(151, 'MZ', 'Mozambique'),
(152, 'MM', 'Myanmar'),
(153, 'NA', 'Namibia'),
(154, 'NR', 'Nauru'),
(155, 'NP', 'Nepal'),
(156, 'NL', 'Netherlands'),
(157, 'AN', 'Netherlands Antilles'),
(158, 'NC', 'New Caledonia'),
(159, 'NZ', 'New Zealand'),
(160, 'NI', 'Nicaragua'),
(161, 'NE', 'Niger'),
(162, 'NG', 'Nigeria'),
(163, 'NU', 'Niue'),
(164, 'NF', 'Norfolk Island'),
(165, 'KP', 'North Korea'),
(166, 'MP', 'Northern Mariana Islands'),
(167, 'NO', 'Norway'),
(168, 'OM', 'Oman'),
(169, 'PK', 'Pakistan'),
(170, 'PW', 'Palau'),
(171, 'PS', 'Palestinian Territory'),
(172, 'PA', 'Panama'),
(173, 'PG', 'Papua New Guinea'),
(174, 'PY', 'Paraguay'),
(175, 'PE', 'Peru'),
(176, 'PH', 'Philippines'),
(177, 'PN', 'Pitcairn'),
(178, 'PL', 'Poland'),
(179, 'PT', 'Portugal'),
(180, 'PR', 'Puerto Rico'),
(181, 'QA', 'Qatar'),
(182, 'CG', 'Republic of the Congo'),
(183, 'RE', 'Reunion'),
(184, 'RO', 'Romania'),
(185, 'RU', 'Russia'),
(186, 'RW', 'Rwanda'),
(187, 'BL', 'Saint Barthelemy'),
(188, 'SH', 'Saint Helena'),
(189, 'KN', 'Saint Kitts and Nevis'),
(190, 'LC', 'Saint Lucia'),
(191, 'MF', 'Saint Martin'),
(192, 'PM', 'Saint Pierre and Miquelon'),
(193, 'VC', 'Saint Vincent and the Grenadines'),
(194, 'WS', 'Samoa'),
(195, 'SM', 'San Marino'),
(196, 'ST', 'Sao Tome and Principe'),
(197, 'SA', 'Saudi Arabia'),
(198, 'SN', 'Senegal'),
(199, 'RS', 'Serbia'),
(200, 'CS', 'Serbia and Montenegro'),
(201, 'SC', 'Seychelles'),
(202, 'SL', 'Sierra Leone'),
(203, 'SG', 'Singapore'),
(204, 'SX', 'Sint Maarten'),
(205, 'SK', 'Slovakia'),
(206, 'SI', 'Slovenia'),
(207, 'SB', 'Solomon Islands'),
(208, 'SO', 'Somalia'),
(209, 'ZA', 'South Africa'),
(210, 'GS', 'South Georgia and the South Sandwich Islands'),
(211, 'KR', 'South Korea'),
(212, 'SS', 'South Sudan'),
(213, 'ES', 'Spain'),
(214, 'LK', 'Sri Lanka'),
(215, 'SD', 'Sudan'),
(216, 'SR', 'Suriname'),
(217, 'SJ', 'Svalbard and Jan Mayen'),
(218, 'SZ', 'Swaziland'),
(219, 'SE', 'Sweden'),
(220, 'CH', 'Switzerland'),
(221, 'SY', 'Syria'),
(222, 'TW', 'Taiwan'),
(223, 'TJ', 'Tajikistan'),
(224, 'TZ', 'Tanzania'),
(225, 'TH', 'Thailand'),
(226, 'TG', 'Togo'),
(227, 'TK', 'Tokelau'),
(228, 'TO', 'Tonga'),
(229, 'TT', 'Trinidad and Tobago'),
(230, 'TN', 'Tunisia'),
(231, 'TR', 'Turkey'),
(232, 'TM', 'Turkmenistan'),
(233, 'TC', 'Turks and Caicos Islands'),
(234, 'TV', 'Tuvalu'),
(235, 'VI', 'U.S. Virgin Islands'),
(236, 'UG', 'Uganda'),
(237, 'UA', 'Ukraine'),
(238, 'AE', 'United Arab Emirates'),
(239, 'GB', 'United Kingdom'),
(240, 'US', 'United States'),
(241, 'UM', 'United States Minor Outlying Islands'),
(242, 'UY', 'Uruguay'),
(243, 'UZ', 'Uzbekistan'),
(244, 'VU', 'Vanuatu'),
(245, 'VA', 'Vatican'),
(246, 'VE', 'Venezuela'),
(247, 'VN', 'Vietnam'),
(248, 'WF', 'Wallis and Futuna'),
(249, 'EH', 'Western Sahara'),
(250, 'YE', 'Yemen'),
(251, 'ZM', 'Zambia'),
(252, 'ZW', 'Zimbabwe'),
(1, 'AF', 'Afghanistan'),
(2, 'AX', 'Aland Islands'),
(3, 'AL', 'Albania'),
(4, 'DZ', 'Algeria'),
(5, 'AS', 'American Samoa'),
(6, 'AD', 'Andorra'),
(7, 'AO', 'Angola'),
(8, 'AI', 'Anguilla'),
(9, 'AQ', 'Antarctica'),
(10, 'AG', 'Antigua and Barbuda'),
(11, 'AR', 'Argentina'),
(12, 'AM', 'Armenia'),
(13, 'AW', 'Aruba'),
(14, 'AU', 'Australia'),
(15, 'AT', 'Austria'),
(16, 'AZ', 'Azerbaijan'),
(17, 'BS', 'Bahamas'),
(18, 'BH', 'Bahrain'),
(19, 'BD', 'Bangladesh'),
(20, 'BB', 'Barbados'),
(21, 'BY', 'Belarus'),
(22, 'BE', 'Belgium'),
(23, 'BZ', 'Belize'),
(24, 'BJ', 'Benin'),
(25, 'BM', 'Bermuda'),
(26, 'BT', 'Bhutan'),
(27, 'BO', 'Bolivia'),
(28, 'BQ', 'Bonaire, Saint Eustatius and Saba'),
(29, 'BA', 'Bosnia and Herzegovina'),
(30, 'BW', 'Botswana'),
(31, 'BV', 'Bouvet Island'),
(32, 'BR', 'Brazil'),
(33, 'IO', 'British Indian Ocean Territory'),
(34, 'VG', 'British Virgin Islands'),
(35, 'BN', 'Brunei'),
(36, 'BG', 'Bulgaria'),
(37, 'BF', 'Burkina Faso'),
(38, 'BI', 'Burundi'),
(39, 'KH', 'Cambodia'),
(40, 'CM', 'Cameroon'),
(41, 'CA', 'Canada'),
(42, 'CV', 'Cape Verde'),
(43, 'KY', 'Cayman Islands'),
(44, 'CF', 'Central African Republic'),
(45, 'TD', 'Chad'),
(46, 'CL', 'Chile'),
(47, 'CN', 'China'),
(48, 'CX', 'Christmas Island'),
(49, 'CC', 'Cocos Islands'),
(50, 'CO', 'Colombia'),
(51, 'KM', 'Comoros'),
(52, 'CK', 'Cook Islands'),
(53, 'CR', 'Costa Rica'),
(54, 'HR', 'Croatia'),
(55, 'CU', 'Cuba'),
(56, 'CW', 'Curacao'),
(57, 'CY', 'Cyprus'),
(58, 'CZ', 'Czech Republic'),
(59, 'CD', 'Democratic Republic of the Congo'),
(60, 'DK', 'Denmark'),
(61, 'DJ', 'Djibouti'),
(62, 'DM', 'Dominica'),
(63, 'DO', 'Dominican Republic'),
(64, 'TL', 'East Timor'),
(65, 'EC', 'Ecuador'),
(66, 'EG', 'Egypt'),
(67, 'SV', 'El Salvador'),
(68, 'GQ', 'Equatorial Guinea'),
(69, 'ER', 'Eritrea'),
(70, 'EE', 'Estonia'),
(71, 'ET', 'Ethiopia'),
(72, 'FK', 'Falkland Islands'),
(73, 'FO', 'Faroe Islands'),
(74, 'FJ', 'Fiji'),
(75, 'FI', 'Finland'),
(76, 'FR', 'France'),
(77, 'GF', 'French Guiana'),
(78, 'PF', 'French Polynesia'),
(79, 'TF', 'French Southern Territories'),
(80, 'GA', 'Gabon'),
(81, 'GM', 'Gambia'),
(82, 'GE', 'Georgia'),
(83, 'DE', 'Germany'),
(84, 'GH', 'Ghana'),
(85, 'GI', 'Gibraltar'),
(86, 'GR', 'Greece'),
(87, 'GL', 'Greenland'),
(88, 'GD', 'Grenada'),
(89, 'GP', 'Guadeloupe'),
(90, 'GU', 'Guam'),
(91, 'GT', 'Guatemala'),
(92, 'GG', 'Guernsey'),
(93, 'GN', 'Guinea'),
(94, 'GW', 'Guinea-Bissau'),
(95, 'GY', 'Guyana'),
(96, 'HT', 'Haiti'),
(97, 'HM', 'Heard Island and McDonald Islands'),
(98, 'HN', 'Honduras'),
(99, 'HK', 'Hong Kong'),
(100, 'HU', 'Hungary'),
(101, 'IS', 'Iceland'),
(102, 'IN', 'India'),
(103, 'ID', 'Indonesia'),
(104, 'IR', 'Iran'),
(105, 'IQ', 'Iraq'),
(106, 'IE', 'Ireland'),
(107, 'IM', 'Isle of Man'),
(108, 'IL', 'Israel'),
(109, 'IT', 'Italy'),
(110, 'CI', 'Ivory Coast'),
(111, 'JM', 'Jamaica'),
(112, 'JP', 'Japan'),
(113, 'JE', 'Jersey'),
(114, 'JO', 'Jordan'),
(115, 'KZ', 'Kazakhstan'),
(116, 'KE', 'Kenya'),
(117, 'KI', 'Kiribati'),
(118, 'XK', 'Kosovo'),
(119, 'KW', 'Kuwait'),
(120, 'KG', 'Kyrgyzstan'),
(121, 'LA', 'Laos'),
(122, 'LV', 'Latvia'),
(123, 'LB', 'Lebanon'),
(124, 'LS', 'Lesotho'),
(125, 'LR', 'Liberia'),
(126, 'LY', 'Libya'),
(127, 'LI', 'Liechtenstein'),
(128, 'LT', 'Lithuania'),
(129, 'LU', 'Luxembourg'),
(130, 'MO', 'Macao'),
(131, 'MK', 'Macedonia'),
(132, 'MG', 'Madagascar'),
(133, 'MW', 'Malawi'),
(134, 'MY', 'Malaysia'),
(135, 'MV', 'Maldives'),
(136, 'ML', 'Mali'),
(137, 'MT', 'Malta'),
(138, 'MH', 'Marshall Islands'),
(139, 'MQ', 'Martinique'),
(140, 'MR', 'Mauritania'),
(141, 'MU', 'Mauritius'),
(142, 'YT', 'Mayotte'),
(143, 'MX', 'Mexico'),
(144, 'FM', 'Micronesia'),
(145, 'MD', 'Moldova'),
(146, 'MC', 'Monaco'),
(147, 'MN', 'Mongolia'),
(148, 'ME', 'Montenegro'),
(149, 'MS', 'Montserrat'),
(150, 'MA', 'Morocco'),
(151, 'MZ', 'Mozambique'),
(152, 'MM', 'Myanmar'),
(153, 'NA', 'Namibia'),
(154, 'NR', 'Nauru'),
(155, 'NP', 'Nepal'),
(156, 'NL', 'Netherlands'),
(157, 'AN', 'Netherlands Antilles'),
(158, 'NC', 'New Caledonia'),
(159, 'NZ', 'New Zealand'),
(160, 'NI', 'Nicaragua'),
(161, 'NE', 'Niger'),
(162, 'NG', 'Nigeria'),
(163, 'NU', 'Niue'),
(164, 'NF', 'Norfolk Island'),
(165, 'KP', 'North Korea'),
(166, 'MP', 'Northern Mariana Islands'),
(167, 'NO', 'Norway'),
(168, 'OM', 'Oman'),
(169, 'PK', 'Pakistan'),
(170, 'PW', 'Palau'),
(171, 'PS', 'Palestinian Territory'),
(172, 'PA', 'Panama'),
(173, 'PG', 'Papua New Guinea'),
(174, 'PY', 'Paraguay'),
(175, 'PE', 'Peru'),
(176, 'PH', 'Philippines'),
(177, 'PN', 'Pitcairn'),
(178, 'PL', 'Poland'),
(179, 'PT', 'Portugal'),
(180, 'PR', 'Puerto Rico'),
(181, 'QA', 'Qatar'),
(182, 'CG', 'Republic of the Congo'),
(183, 'RE', 'Reunion'),
(184, 'RO', 'Romania'),
(185, 'RU', 'Russia'),
(186, 'RW', 'Rwanda'),
(187, 'BL', 'Saint Barthelemy'),
(188, 'SH', 'Saint Helena'),
(189, 'KN', 'Saint Kitts and Nevis'),
(190, 'LC', 'Saint Lucia'),
(191, 'MF', 'Saint Martin'),
(192, 'PM', 'Saint Pierre and Miquelon'),
(193, 'VC', 'Saint Vincent and the Grenadines'),
(194, 'WS', 'Samoa'),
(195, 'SM', 'San Marino'),
(196, 'ST', 'Sao Tome and Principe'),
(197, 'SA', 'Saudi Arabia'),
(198, 'SN', 'Senegal'),
(199, 'RS', 'Serbia'),
(200, 'CS', 'Serbia and Montenegro'),
(201, 'SC', 'Seychelles'),
(202, 'SL', 'Sierra Leone'),
(203, 'SG', 'Singapore'),
(204, 'SX', 'Sint Maarten'),
(205, 'SK', 'Slovakia'),
(206, 'SI', 'Slovenia'),
(207, 'SB', 'Solomon Islands'),
(208, 'SO', 'Somalia'),
(209, 'ZA', 'South Africa'),
(210, 'GS', 'South Georgia and the South Sandwich Islands'),
(211, 'KR', 'South Korea'),
(212, 'SS', 'South Sudan'),
(213, 'ES', 'Spain'),
(214, 'LK', 'Sri Lanka'),
(215, 'SD', 'Sudan'),
(216, 'SR', 'Suriname'),
(217, 'SJ', 'Svalbard and Jan Mayen'),
(218, 'SZ', 'Swaziland'),
(219, 'SE', 'Sweden'),
(220, 'CH', 'Switzerland'),
(221, 'SY', 'Syria'),
(222, 'TW', 'Taiwan'),
(223, 'TJ', 'Tajikistan'),
(224, 'TZ', 'Tanzania'),
(225, 'TH', 'Thailand'),
(226, 'TG', 'Togo'),
(227, 'TK', 'Tokelau'),
(228, 'TO', 'Tonga'),
(229, 'TT', 'Trinidad and Tobago'),
(230, 'TN', 'Tunisia'),
(231, 'TR', 'Turkey'),
(232, 'TM', 'Turkmenistan'),
(233, 'TC', 'Turks and Caicos Islands'),
(234, 'TV', 'Tuvalu'),
(235, 'VI', 'U.S. Virgin Islands'),
(236, 'UG', 'Uganda'),
(237, 'UA', 'Ukraine'),
(238, 'AE', 'United Arab Emirates'),
(239, 'GB', 'United Kingdom'),
(240, 'US', 'United States'),
(241, 'UM', 'United States Minor Outlying Islands'),
(242, 'UY', 'Uruguay'),
(243, 'UZ', 'Uzbekistan'),
(244, 'VU', 'Vanuatu'),
(245, 'VA', 'Vatican'),
(246, 'VE', 'Venezuela'),
(247, 'VN', 'Vietnam'),
(248, 'WF', 'Wallis and Futuna'),
(249, 'EH', 'Western Sahara'),
(250, 'YE', 'Yemen'),
(251, 'ZM', 'Zambia'),
(252, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `customerprofile`
--

DROP TABLE IF EXISTS `customerprofile`;
CREATE TABLE IF NOT EXISTS `customerprofile` (
  `id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `custid` varchar(30) NOT NULL,
  `prefix` varchar(15) DEFAULT 'DAPL',
  `postfix` varchar(50) NOT NULL DEFAULT '/',
  `title` varchar(10) NOT NULL,
  `custname` varchar(100) NOT NULL,
  `portal` varchar(100) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT '1',
  `custype` varchar(50) NOT NULL,
  `blocation` varchar(100) NOT NULL,
  `industry` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `workphone` varchar(30) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `email` varchar(40) NOT NULL,
  `web` varchar(40) NOT NULL,
  `gstin` varchar(25) NOT NULL,
  `gstregdate` date NOT NULL,
  `primaryflag` int(20) NOT NULL DEFAULT '0',
  `image` varchar(155) DEFAULT NULL,
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP,
  `createdby` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedby` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customerprofile`
--

INSERT INTO `customerprofile` (`id`, `custid`, `prefix`, `postfix`, `title`, `custname`, `portal`, `status`, `custype`, `blocation`, `industry`, `address`, `city`, `country`, `state`, `zip`, `workphone`, `mobile`, `email`, `web`, `gstin`, `gstregdate`, `primaryflag`, `image`, `createdon`, `createdby`, `updatedon`, `updatedby`) VALUES
(00007, 'DAPL001', 'DAPL', '/', 'MS.', 'Ragahav Agencis f', '', '1', 'Distributor', '', '', 'Chennai', 'Channi', 'IN', 'TN', '6566566', '', '9999', 'example@gmail.com', '', 'GST090000', '0000-00-00', 0, NULL, '2018-04-15 16:54:04', '2018-04-15 16:54:04', '2018-04-15 16:54:04', '2018-04-15 16:54:04');

-- --------------------------------------------------------

--
-- Table structure for table `custype`
--

DROP TABLE IF EXISTS `custype`;
CREATE TABLE IF NOT EXISTS `custype` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `custype` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custype`
--

INSERT INTO `custype` (`id`, `custype`, `description`) VALUES
(003, 'Wholesalers', 'Remarks'),
(005, 'Distributor', 'Distributor'),
(006, 'Retailer', 'Retailer'),
(007, 'Marketing agent', 'Marketting Agent'),
(013, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `expenseacctmaster`
--

DROP TABLE IF EXISTS `expenseacctmaster`;
CREATE TABLE IF NOT EXISTS `expenseacctmaster` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `accountname` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenseacctmaster`
--

INSERT INTO `expenseacctmaster` (`id`, `accountname`, `description`) VALUES
(001, 'Advertising & Marketing', 'Advertising & Marketing'),
(002, 'Automobile Expense', 'Automobile Expense'),
(003, 'Consultant Expense', 'Consultant Expense'),
(004, 'Credit Card Charges', 'Credit Card Charges'),
(005, 'IT & Internet Expense', 'IT & Internet Expense'),
(006, 'Lodging', 'Lodging'),
(007, 'Meals and Entertainment', 'Functions'),
(008, 'Office Supplies', 'office'),
(009, 'Other Expense', 'Other Expense'),
(010, 'Printing and Staionary', 'Printing and Staionary'),
(011, 'Rent Expense', 'Rent Expense'),
(012, 'Repairs & Maintenance', 'Repairs & Maintenance'),
(013, 'Salaries & Employee Wages', 'Salaries & Employee Wages'),
(014, 'Telephone Expense', 'Telephone Expense'),
(015, 'Travel Expense', 'Travel Expense'),
(016, 'Employee Reimbursement', 'Employee Reimbursement'),
(020, 'Employee Advance', 'Employee Advance');

-- --------------------------------------------------------

--
-- Table structure for table `expensenoteslog`
--

DROP TABLE IF EXISTS `expensenoteslog`;
CREATE TABLE IF NOT EXISTS `expensenoteslog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voucherid` varchar(100) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `createdby` varchar(100) NOT NULL,
  `updatedby` varchar(100) DEFAULT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expensenoteslog`
--

INSERT INTO `expensenoteslog` (`id`, `voucherid`, `notes`, `createdby`, `updatedby`, `createdon`, `updatedon`) VALUES
(1, '00002', 'sdfsdfsd', ' ', '0', '2018-05-05 00:00:00', '2018-05-05 08:26:39'),
(2, '', 'Updated on cash', '', '0', '2018-05-05 08:28:36', '2018-05-05 00:00:00'),
(3, '', 'repairs', '', '0', '2018-05-05 08:31:53', '2018-05-05 00:00:00'),
(4, '', 'travel expense', '', '0', '2018-05-05 08:33:13', '2018-05-01 00:00:00'),
(5, '', 'travel', '', '0', '2018-05-05 08:34:38', '2018-05-05 00:00:00'),
(6, '00003', 'fsdfsdfsd', ' ', '0', '2018-05-05 00:00:00', '2018-05-05 08:36:59'),
(7, '', 'afdaf', '', '0', '2018-05-05 08:37:13', '2018-05-05 00:00:00'),
(8, '', 'ffs', '', '0', '2018-05-05 08:38:55', '2018-05-05 00:00:00'),
(9, '', 'ffs', '', '0', '2018-05-05 08:42:49', '2018-05-05 00:00:00'),
(10, '', 'ffs', '', '0', '2018-05-05 08:44:07', '2018-05-05 00:00:00'),
(11, '', 'ffs', '', '0', '2018-05-05 08:48:59', '2018-05-05 00:00:00'),
(12, '', 'ffs', '', '0', '2018-05-05 08:49:45', '2018-05-05 00:00:00'),
(13, '00002', 'asfdfsd', '', '0', '2018-05-05 08:50:56', '2018-05-05 00:00:00'),
(14, '00002', 'asfdfsd', '', '0', '2018-05-05 08:51:40', '2018-05-05 00:00:00'),
(15, '00002', 'notes', '', '0', '2018-05-05 08:51:51', '2018-05-05 00:00:00'),
(16, '00002', 'notesdfgfdghfdg', '', '0', '2018-05-05 08:52:12', '2018-05-05 00:00:00'),
(17, '00004', 'etrtretre', 'Bhairava', '0', '2018-05-11 00:00:00', '2018-05-11 21:45:06'),
(18, '00004', '', '', '0', '2018-05-11 21:46:10', '2018-05-11 00:00:00'),
(19, '00004', '', '', '0', '2018-05-11 21:50:28', '2018-05-11 00:00:00'),
(20, '00004', '', '', '0', '2018-05-11 21:50:56', '2018-05-11 00:00:00'),
(21, '00002', 'adadas', '', 'Bhairava', '2018-05-12 21:05:46', '2018-05-05 00:00:00'),
(22, '00004', 'asdsada', '', 'Janessha', '2018-05-12 21:06:31', '2018-05-11 00:00:00'),
(23, '00004', 'aasdasdsa', '', 'Janessha', '2018-05-12 21:08:45', '2018-05-11 00:00:00'),
(24, '00004', '', '', 'Janessha', '2018-05-12 21:10:46', '2018-05-11 00:00:00'),
(25, '00005', 'sfsfsdfs', 'Janessha', NULL, '2018-05-12 00:00:00', '2018-05-12 21:11:19'),
(26, '00005', 'affdsfsd', '', 'Bhairava', '2018-05-12 21:11:45', '2018-05-12 00:00:00'),
(27, '00005', 'fgdgd', '', 'Bhairava', '2018-05-12 21:13:17', '2018-05-12 00:00:00'),
(28, '00005', '', '', 'Bhairava', '2018-05-12 21:13:34', '2018-05-12 00:00:00'),
(29, '00006', 'fsdfsd', 'Bhairava', NULL, '2018-05-12 00:00:00', '2018-05-12 21:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT,
  `groupname` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `groupname`, `description`) VALUES
(1, 'Admin', 'to gain access on all modules'),
(3, 'Staff', 'To access all except reports and accounts'),
(6, 'Manager', 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `itemcategory`
--

DROP TABLE IF EXISTS `itemcategory`;
CREATE TABLE IF NOT EXISTS `itemcategory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemcategory`
--

INSERT INTO `itemcategory` (`id`, `code`, `category`, `description`) VALUES
(1, 'CAT001', 'Packing Materials', 'Packing Materials'),
(2, 'CAT002', 'Plastics', 'Plastics'),
(3, 'CAT003', 'abc', ''),
(4, 'CAT004', 'Fruits', ''),
(5, 'CAT005', 'dfgdfhd', ''),
(6, 'CAT006', 'asdasda', '');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `id` int(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `locname` varchar(25) NOT NULL,
  `description` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `locname`, `description`) VALUES
(25, 'Kalastri', 'Plant'),
(26, 'Chennai', 'Registred/Head Office'),
(27, 'Krishnagiri', ''),
(28, 'Kaveripattinam', '');

-- --------------------------------------------------------

--
-- Table structure for table `paymentterm`
--

DROP TABLE IF EXISTS `paymentterm`;
CREATE TABLE IF NOT EXISTS `paymentterm` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `paymentterm` varchar(40) NOT NULL,
  `description` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymentterm`
--

INSERT INTO `paymentterm` (`id`, `paymentterm`, `description`) VALUES
(015, 'Advance', 'Advance Payment'),
(017, 'Due 60 Days', 'Payment Due 60 Days'),
(018, 'Immediate', 'Payment Immediate'),
(021, 'Due 15 Days', 'Due on 15 Days'),
(022, 'Due 30 Days', 'Due 30 Days'),
(024, 'Due on Receipt', 'Due on Receipt'),
(025, 'zsa', ''),
(026, 'dref', ''),
(027, 'ghjghkhj', 'fghjjhgjgh'),
(028, 'rtrtrt', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseitemaster`
--

DROP TABLE IF EXISTS `purchaseitemaster`;
CREATE TABLE IF NOT EXISTS `purchaseitemaster` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `itemcode` varchar(100) NOT NULL,
  `itemname` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `vendor` varchar(255) NOT NULL,
  `hsncode` varchar(100) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT '1',
  `priceperqty` decimal(10,2) NOT NULL,
  `salespriceperqty` decimal(10,2) DEFAULT NULL,
  `uom` varchar(100) NOT NULL,
  `taxmethod` varchar(20) NOT NULL DEFAULT '0',
  `taxname` varchar(100) NOT NULL,
  `taxrate` decimal(10,1) NOT NULL,
  `taxamount` decimal(10,1) NOT NULL,
  `itemcost` decimal(10,1) NOT NULL,
  `taxableprice` decimal(10,1) NOT NULL,
  `pricedatefrom` date NOT NULL,
  `stockinqty` int(20) NOT NULL,
  `stockinuom` int(20) NOT NULL,
  `lowstockalert` varchar(50) NOT NULL,
  `stockasofdate` date NOT NULL,
  `usageunit` varchar(30) DEFAULT NULL,
  `handler` varchar(30) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(155) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaseitemaster`
--

INSERT INTO `purchaseitemaster` (`id`, `itemcode`, `itemname`, `category`, `description`, `vendor`, `hsncode`, `status`, `priceperqty`, `salespriceperqty`, `uom`, `taxmethod`, `taxname`, `taxrate`, `taxamount`, `itemcost`, `taxableprice`, `pricedatefrom`, `stockinqty`, `stockinuom`, `lowstockalert`, `stockasofdate`, `usageunit`, `handler`, `notes`, `updatedon`, `image`) VALUES
(1, 'DAPL001', 'Alphanso', 'CAT004', 'alpahso', 'DAPL001', '213232', '1', '10.00', NULL, 'KGS', '1', '12.5', '12.5', '1.3', '8.8', '10.0', '2018-05-15', 100, 10, '5', '2018-05-15', NULL, 'Bhairava', 'ddsfs', '2018-05-15 15:38:44', NULL),
(2, 'DAPL002', 'Totapuri', 'CAT004', 'hhh', 'DAPL001', '1212121', '1', '12.00', NULL, 'KGS', '0', '12.5', '0.0', '0.0', '10.0', '12.0', '2018-05-16', 1600, 2, '200', '2018-05-16', NULL, 'Bhairava', 'Item added', '2018-05-16 06:36:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchaseitemlog`
--

DROP TABLE IF EXISTS `purchaseitemlog`;
CREATE TABLE IF NOT EXISTS `purchaseitemlog` (
  `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `itemcode` varchar(50) NOT NULL,
  `itemname` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `oldpriceqty` decimal(10,1) NOT NULL,
  `newpriceqty` decimal(10,1) DEFAULT NULL,
  `olduom` varchar(100) NOT NULL,
  `newuom` varchar(100) DEFAULT NULL,
  `oldstock` varchar(100) NOT NULL,
  `newstock` varchar(100) DEFAULT NULL,
  `taxmethod` varchar(100) NOT NULL,
  `taxrate` decimal(10,1) NOT NULL,
  `stockasofdate` date NOT NULL,
  `newstockasofdate` date DEFAULT NULL,
  `notes` varchar(500) NOT NULL,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` varchar(100) NOT NULL,
  `updatedby` varchar(100) DEFAULT NULL,
  `taxname` varchar(100) DEFAULT NULL,
  `newtaxamount` decimal(10,1) DEFAULT NULL,
  `taxamount` decimal(10,1) NOT NULL,
  `newitemcost` decimal(10,1) DEFAULT NULL,
  `itemcost` decimal(10,1) NOT NULL,
  `newtaxableprice` decimal(10,1) DEFAULT NULL,
  `newpriceasofdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `taxableprice` decimal(10,1) NOT NULL,
  `hsncode` varchar(100) NOT NULL,
  `newtaxrate` decimal(10,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaseitemlog`
--

INSERT INTO `purchaseitemlog` (`id`, `itemcode`, `itemname`, `category`, `oldpriceqty`, `newpriceqty`, `olduom`, `newuom`, `oldstock`, `newstock`, `taxmethod`, `taxrate`, `stockasofdate`, `newstockasofdate`, `notes`, `updatedon`, `createdon`, `createdby`, `updatedby`, `taxname`, `newtaxamount`, `taxamount`, `newitemcost`, `itemcost`, `newtaxableprice`, `newpriceasofdate`, `taxableprice`, `hsncode`, `newtaxrate`) VALUES
(0001, 'DAPL001', 'Alphanso', 'CAT004', '10.0', NULL, 'KGS', NULL, '100', NULL, '1', '12.5', '2018-05-15', NULL, 'ddsfs', '2018-05-15 21:08:44', '2018-05-15 00:00:00', 'Bhairava', NULL, '12.5', NULL, '1.3', NULL, '8.8', NULL, '2018-05-15 21:08:44', '10.0', '213232', NULL),
(0002, 'DAPL002', 'Totapuri', 'CAT004', '10.0', NULL, 'KGS', NULL, '1500', NULL, '0', '0.0', '2018-05-16', NULL, 'Item added', '2018-05-16 12:06:01', '2018-05-16 00:00:00', 'Bhairava', NULL, '0', NULL, '0.0', NULL, '10.0', NULL, '2018-05-16 12:06:01', '10.0', '1212121', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorders`
--

DROP TABLE IF EXISTS `purchaseorders`;
CREATE TABLE IF NOT EXISTS `purchaseorders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `po_code` varchar(100) DEFAULT NULL,
  `po_owner` varchar(255) DEFAULT NULL,
  `po_comp_code` varchar(100) DEFAULT NULL,
  `po_vendor` varchar(255) DEFAULT NULL,
  `po_description` varchar(255) DEFAULT NULL,
  `po_date` varchar(100) DEFAULT NULL,
  `po_payterm` varchar(255) DEFAULT NULL,
  `po_shippingvia` varchar(100) DEFAULT NULL,
  `po_deliveryat` varchar(100) DEFAULT NULL,
  `po_deliverydate` varchar(100) DEFAULT NULL,
  `po_status` varchar(15) DEFAULT NULL,
  `po_freight` varchar(255) DEFAULT NULL,
  `po_shipping_street` varchar(255) DEFAULT NULL,
  `po_shipping_city` varchar(255) DEFAULT NULL,
  `po_shipping_state` varchar(255) DEFAULT NULL,
  `po_shipping_country` varchar(255) DEFAULT NULL,
  `po_shipping_zip` varchar(255) DEFAULT NULL,
  `po_shipping_phone` varchar(255) DEFAULT NULL,
  `po_shipping_gstin` varchar(255) DEFAULT NULL,
  `po_billing_street` varchar(255) DEFAULT NULL,
  `po_billing_city` varchar(255) DEFAULT NULL,
  `po_billing_state` varchar(255) DEFAULT NULL,
  `po_billing_country` varchar(255) DEFAULT NULL,
  `po_billing_zip` varchar(255) DEFAULT NULL,
  `po_billing_phone` varchar(255) DEFAULT NULL,
  `po_billing_gstin` varchar(255) DEFAULT NULL,
  `po_value` varchar(100) DEFAULT NULL,
  `po_tc` varchar(255) DEFAULT NULL,
  `po_notes` varchar(255) DEFAULT NULL,
  `po_items` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaseorders`
--

INSERT INTO `purchaseorders` (`id`, `po_code`, `po_owner`, `po_comp_code`, `po_vendor`, `po_description`, `po_date`, `po_payterm`, `po_shippingvia`, `po_deliveryat`, `po_deliverydate`, `po_status`, `po_freight`, `po_shipping_street`, `po_shipping_city`, `po_shipping_state`, `po_shipping_country`, `po_shipping_zip`, `po_shipping_phone`, `po_shipping_gstin`, `po_billing_street`, `po_billing_city`, `po_billing_state`, `po_billing_country`, `po_billing_zip`, `po_billing_phone`, `po_billing_gstin`, `po_value`, `po_tc`, `po_notes`, `po_items`) VALUES
(11, 'DAPLPO001', NULL, 'DAPL002', 'DAPL001', 'dfdsfdsf', '2018-05-11', 'Due 60 Days', 'ARC Parcel Services', 'Kalastri', '2018-05-10', 'Created', 'ToPay', 'adadasda', 'chennai', 'TN', 'IN', '123213', '24234', '21321321', 'adadasda', 'chennai', 'TN', 'IN', '123213', '24234', '21321321', '102.65', NULL, 'asdasda', '[{\"itemcode\":\"1\",\"hsncode\":\"\",\"rwqty\":\"1\",\"tax_val\":\"5.0\",\"rwprice\":\"113.00\",\"rwamt\":\"113\",\"podiscount\":\"6\",\"poadjustmentval\":\"-10\",\"uom\":\"BAG\"}]'),
(12, 'DAPLPO0012', NULL, 'DAPL002', 'DAPL001', 'pu', '2018-05-11', 'Due 60 Days', 'ABC Parcel Services', 'Kalastri', '2018-05-02', 'Created', 'Paid', 'adadasda', 'chennai', 'TN', 'IN', '123213', '24234', '21321321', 'adadasda', 'chennai', 'TN', 'IN', '123213', '24234', '21321321', '218.65', NULL, 'Freight Charges Added in adjustments', '[{\"itemcode\":\"1\",\"hsncode\":\"\",\"rwqty\":\"1\",\"tax_val\":\"5.0\",\"rwprice\":\"113.00\",\"rwamt\":\"113\",\"podiscount\":\"\",\"poadjustmentval\":\"100\",\"uom\":\"BAG\"}]'),
(13, 'DAPLPO0013', NULL, 'DAPL002', 'DAPL004', 'asdafda', '2018-05-13', 'Due 60 Days', 'ARC Parcel Services', 'Kalastri', '2018-05-10', 'Created', 'Paid', 'adadasda', 'chennai', 'TN', 'IN', '123213', '24234', '21321321', 'adadasda', 'chennai', 'TN', 'IN', '123213', '24234', '21321321', '11.25', NULL, 'adasfda', '[{\"itemcode\":\"1\",\"hsncode\":\"213123\",\"rwqty\":\"1\",\"tax_val\":\"12.5\",\"rwprice\":\"10.00\",\"rwamt\":\"10\",\"podiscount\":\"\",\"poadjustmentval\":\"\",\"uom\":\"BAG\"}]'),
(14, 'DAPLPO0014', NULL, 'DAPL001', 'DAPL001', 'Purchase Order', '2018-05-15', 'Due 60 Days', 'ARC Parcel Services', 'Kaveripattinam', '2018-05-17', 'Created', 'Paid', 'Kundalpatti Village,Kaveripattinam Road', 'Krishnagiri-Dt.', 'TN', 'IN', '635001', '9677573737', '2113124', 'Kundalpatti Village,Kaveripattinam Road', 'Krishnagiri-Dt.', 'TN', 'IN', '635001', '9677573737', '2113124', '112005.00', NULL, 'dada', '[{\"itemcode\":\"1\",\"hsncode\":\"213232\",\"rwqty\":\"10000\",\"tax_val\":\"12.5\",\"rwprice\":\"10.00\",\"rwamt\":\"100000\",\"podiscount\":\".5\",\"poadjustmentval\":\"5\",\"uom\":\"KGS\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `purpricemaster`
--

DROP TABLE IF EXISTS `purpricemaster`;
CREATE TABLE IF NOT EXISTS `purpricemaster` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `itemcode` varchar(30) NOT NULL,
  `taxmethod` varchar(30) NOT NULL,
  `taxrate` decimal(10,1) NOT NULL,
  `priceperqty` decimal(10,1) NOT NULL,
  `priceperuom` decimal(10,1) NOT NULL,
  `datefrom` date NOT NULL,
  `notes` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purpricemaster`
--

INSERT INTO `purpricemaster` (`id`, `itemcode`, `taxmethod`, `taxrate`, `priceperqty`, `priceperuom`, `datefrom`, `notes`) VALUES
(003, 'DAPL/Cap/001', '0', '12.5', '12.2', '120.2', '2017-04-10', 'sadasda'),
(005, 'DAPL/Bott/005', '0', '18.5', '12.2', '120.8', '2017-04-18', 'Notes');

-- --------------------------------------------------------

--
-- Table structure for table `recordexpense`
--

DROP TABLE IF EXISTS `recordexpense`;
CREATE TABLE IF NOT EXISTS `recordexpense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voucherid` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `accountname` varchar(250) NOT NULL,
  `payee` varchar(100) NOT NULL,
  `payeetype` varchar(100) NOT NULL,
  `paymentype` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `image` varchar(155) DEFAULT NULL,
  `createdby` varchar(100) DEFAULT NULL,
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedby` varchar(100) NOT NULL,
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recordexpense`
--

INSERT INTO `recordexpense` (`id`, `voucherid`, `date`, `accountname`, `payee`, `payeetype`, `paymentype`, `amount`, `notes`, `image`, `createdby`, `createdon`, `updatedby`, `updatedon`) VALUES
(4, '00004', '2018-05-12', 'Advertising & Marketing', 'asdasda', '1', '2', '2121.00', '', 'upload/cancel.png', 'Bhairava', '2018-05-11 16:15:06', 'Bhairava', '2018-05-11 16:15:06'),
(5, '00005', '2018-05-12', 'Advertising & Marketing', 'adada', '2', '1', '100.00', '', 'upload/', 'Janessha', '2018-05-12 15:41:19', 'Janessha', '2018-05-12 15:41:19'),
(6, '00006', '2018-05-12', 'Employee Reimbursement', 'rakul', 'Vendor', '1', '100.00', 'fsdfsd', 'upload/', 'Bhairava', '2018-05-12 15:46:38', '', '2018-05-12 15:46:38');

-- --------------------------------------------------------

--
-- Table structure for table `salesitemaster`
--

DROP TABLE IF EXISTS `salesitemaster`;
CREATE TABLE IF NOT EXISTS `salesitemaster` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `itemcode` varchar(100) NOT NULL,
  `itemname` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL,
  `vendor` varchar(255) NOT NULL,
  `hsncode` varchar(100) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT '1',
  `priceperqty` decimal(10,2) NOT NULL,
  `salespriceperqty` decimal(10,2) NOT NULL,
  `uom` varchar(100) NOT NULL,
  `taxmethod` varchar(20) NOT NULL DEFAULT '0',
  `taxname` varchar(100) NOT NULL,
  `taxrate` decimal(10,1) NOT NULL,
  `taxamount` decimal(10,1) NOT NULL,
  `itemcost` decimal(10,1) NOT NULL,
  `taxableprice` decimal(10,1) NOT NULL,
  `pricedatefrom` date NOT NULL,
  `stockinqty` int(20) NOT NULL,
  `stockinuom` int(20) NOT NULL,
  `lowstockalert` varchar(50) NOT NULL,
  `stockasofdate` date NOT NULL,
  `usageunit` varchar(30) NOT NULL,
  `handler` varchar(30) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(155) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesitemaster`
--

INSERT INTO `salesitemaster` (`id`, `itemcode`, `itemname`, `category`, `description`, `vendor`, `hsncode`, `status`, `priceperqty`, `salespriceperqty`, `uom`, `taxmethod`, `taxname`, `taxrate`, `taxamount`, `itemcost`, `taxableprice`, `pricedatefrom`, `stockinqty`, `stockinuom`, `lowstockalert`, `stockasofdate`, `usageunit`, `handler`, `notes`, `updatedon`, `image`) VALUES
(1, 'DAPL001', 'fruits', 'CAT001', 'afsdf', '', '12313', '1', '12.00', '0.00', 'BKT', '1', '12.5', '12.5', '1.5', '10.5', '12.0', '2018-05-12', 110, 100, '10', '2018-05-12', '', 'Janessha', 'adasd', '2018-05-12 05:56:12', '');

-- --------------------------------------------------------

--
-- Table structure for table `salesitemlog`
--

DROP TABLE IF EXISTS `salesitemlog`;
CREATE TABLE IF NOT EXISTS `salesitemlog` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `itemcode` varchar(50) NOT NULL,
  `itemname` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `oldpriceqty` decimal(10,1) NOT NULL,
  `newpriceqty` decimal(10,1) NOT NULL,
  `olduom` varchar(100) NOT NULL,
  `newuom` varchar(100) NOT NULL,
  `oldstock` varchar(100) NOT NULL,
  `newstock` varchar(100) NOT NULL,
  `taxmethod` varchar(100) NOT NULL,
  `taxrate` decimal(10,1) NOT NULL,
  `stockasofdate` date NOT NULL,
  `newstockasofdate` date NOT NULL,
  `notes` varchar(500) NOT NULL,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` varchar(100) NOT NULL,
  `updatedby` varchar(100) NOT NULL,
  `taxname` varchar(100) DEFAULT NULL,
  `newtaxamount` decimal(10,1) NOT NULL,
  `taxamount` decimal(10,1) NOT NULL,
  `newitemcost` decimal(10,1) NOT NULL,
  `itemcost` decimal(10,1) NOT NULL,
  `newtaxableprice` decimal(10,1) NOT NULL,
  `newpriceasofdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `taxableprice` decimal(10,1) NOT NULL,
  `hsncode` varchar(100) NOT NULL,
  `newtaxrate` decimal(10,1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesitemlog`
--

INSERT INTO `salesitemlog` (`id`, `itemcode`, `itemname`, `category`, `oldpriceqty`, `newpriceqty`, `olduom`, `newuom`, `oldstock`, `newstock`, `taxmethod`, `taxrate`, `stockasofdate`, `newstockasofdate`, `notes`, `updatedon`, `createdon`, `createdby`, `updatedby`, `taxname`, `newtaxamount`, `taxamount`, `newitemcost`, `itemcost`, `newtaxableprice`, `newpriceasofdate`, `taxableprice`, `hsncode`, `newtaxrate`) VALUES
(1, 'DAPL001', '500ML Bottle', 'CAT004', '10.0', '0.0', 'BND', '', '100', '', '1', '12.5', '2018-05-12', '0000-00-00', 'Added record', '2018-05-12 11:03:03', '2018-05-12 00:00:00', 'Bhairava', '', '12.5', '0.0', '1.3', '0.0', '8.8', '0.0', '2018-05-12 11:03:03', '10.0', '212121', NULL),
(2, 'DAPL001', 'fruits', 'CAT004', '100.0', '0.0', 'BAG', '', '100', '', '1', '12.5', '2018-05-12', '0000-00-00', 'fdsfdsg', '2018-05-12 11:11:52', '2018-05-12 00:00:00', 'Bhairava', '', '12.5', '0.0', '12.5', '0.0', '87.5', '0.0', '2018-05-12 11:11:52', '100.0', '123132', NULL),
(3, 'DAPL001', 'Fruits', 'CAT001', '444.0', '0.0', 'BAG', '', '100', '', '1', '12.5', '2018-05-12', '0000-00-00', 'adadf', '2018-05-12 11:23:41', '2018-05-12 00:00:00', 'Bhairava', '', '12.5', '0.0', '55.5', '0.0', '388.5', '0.0', '2018-05-12 11:23:41', '444.0', '2321', NULL),
(4, 'DAPL001', 'fruits', 'CAT001', '10.0', '0.0', 'BKT', '', '100', '', '1', '12.5', '2018-05-12', '0000-00-00', 'adasd', '2018-05-12 11:26:12', '2018-05-12 00:00:00', 'Bhairava', '', '12.5', '0.0', '1.3', '0.0', '8.8', '0.0', '2018-05-12 11:26:12', '10.0', '12313', NULL),
(5, 'DAPL001', 'fruits', '', '0.0', '12.0', '', 'BKT', '', '110', '', '0.0', '0000-00-00', '2018-05-12', '', '2018-05-12 11:33:19', '2018-05-12 11:33:19', '', 'Bhairava', NULL, '0.0', '0.0', '0.0', '0.0', '0.0', '2018-05-12 00:00:00', '0.0', '', NULL),
(6, 'DAPL001', 'fruits', '', '0.0', '12.0', '', 'BKT', '', '110', '', '0.0', '0000-00-00', '2018-05-12', 'asdsadsa', '2018-05-13 16:56:40', '2018-05-13 16:56:40', '', 'Janessha', NULL, '0.0', '0.0', '0.0', '0.0', '0.0', '2018-05-12 00:00:00', '0.0', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `id` int(10) NOT NULL DEFAULT '0',
  `code` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `code`, `description`) VALUES
(1, 'AP', 'Andhra Pradesh'),
(2, 'AR', 'Arunachal Pradesh'),
(3, 'AS', 'Assam'),
(4, 'BR', 'Bihar'),
(5, 'CG', 'Chhattisgarh'),
(6, 'GA', 'Goa'),
(7, 'GJ', 'Gujarat'),
(8, 'HR', 'Haryana'),
(9, 'HP', 'Himachal Pradesh'),
(10, 'JK', 'Jammu and Kashmir'),
(11, 'JH', 'Jharkhand'),
(12, 'KA', 'Karnataka'),
(13, 'KL', 'Kerala'),
(14, 'MP', 'Madhya Pradesh'),
(15, 'MH', 'Maharashtra'),
(16, 'MN', 'Manipur'),
(17, 'ML', 'Meghalaya'),
(18, 'MZ', 'Mizoram'),
(19, 'NL', 'Nagaland'),
(20, 'OR', 'Orissa'),
(21, 'PB', 'Punjab'),
(22, 'RJ', 'Rajasthan'),
(23, 'SK', 'Sikkim'),
(24, 'TN', 'Tamil Nadu'),
(25, 'TR', 'Tripura'),
(26, 'UK', 'Uttarakhand'),
(27, 'UP', 'Uttar Pradesh'),
(28, 'WB', 'West Bengal'),
(29, 'TN', 'Tamil Nadu'),
(30, 'TR', 'Tripura'),
(31, 'AN', 'Andaman and Nicobar Islands'),
(32, 'CH', 'Chandigarh'),
(33, 'DH', 'Dadra and Nagar Haveli'),
(34, 'DD', 'Daman and Diu'),
(35, 'DL', 'Delhi'),
(36, 'LD', 'Lakshadweep'),
(37, 'PY', 'Pondicherry'),
(38, 'TG', 'Telangana'),
(1, 'AP', 'Andhra Pradesh'),
(2, 'AR', 'Arunachal Pradesh'),
(3, 'AS', 'Assam'),
(4, 'BR', 'Bihar'),
(5, 'CG', 'Chhattisgarh'),
(6, 'GA', 'Goa'),
(7, 'GJ', 'Gujarat'),
(8, 'HR', 'Haryana'),
(9, 'HP', 'Himachal Pradesh'),
(10, 'JK', 'Jammu and Kashmir'),
(11, 'JH', 'Jharkhand'),
(12, 'KA', 'Karnataka'),
(13, 'KL', 'Kerala'),
(14, 'MP', 'Madhya Pradesh'),
(15, 'MH', 'Maharashtra'),
(16, 'MN', 'Manipur'),
(17, 'ML', 'Meghalaya'),
(18, 'MZ', 'Mizoram'),
(19, 'NL', 'Nagaland'),
(20, 'OR', 'Orissa'),
(21, 'PB', 'Punjab'),
(22, 'RJ', 'Rajasthan'),
(23, 'SK', 'Sikkim'),
(24, 'TN', 'Tamil Nadu'),
(25, 'TR', 'Tripura'),
(26, 'UK', 'Uttarakhand'),
(27, 'UP', 'Uttar Pradesh'),
(28, 'WB', 'West Bengal'),
(29, 'TN', 'Tamil Nadu'),
(30, 'TR', 'Tripura'),
(31, 'AN', 'Andaman and Nicobar Islands'),
(32, 'CH', 'Chandigarh'),
(33, 'DH', 'Dadra and Nagar Haveli'),
(34, 'DD', 'Daman and Diu'),
(35, 'DL', 'Delhi'),
(36, 'LD', 'Lakshadweep'),
(37, 'PY', 'Pondicherry'),
(38, 'TG', 'Telangana');

-- --------------------------------------------------------

--
-- Table structure for table `state_lookups`
--

DROP TABLE IF EXISTS `state_lookups`;
CREATE TABLE IF NOT EXISTS `state_lookups` (
  `id` int(10) NOT NULL DEFAULT '0',
  `code` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state_lookups`
--

INSERT INTO `state_lookups` (`id`, `code`, `description`) VALUES
(1, 'AP', 'Andhra Pradesh'),
(2, 'AR', 'Arunachal Pradesh'),
(3, 'AS', 'Assam'),
(4, 'BR', 'Bihar'),
(5, 'CG', 'Chhattisgarh'),
(6, 'GA', 'Goa'),
(7, 'GJ', 'Gujarat'),
(8, 'HR', 'Haryana'),
(9, 'HP', 'Himachal Pradesh'),
(10, 'JK', 'Jammu and Kashmir'),
(11, 'JH', 'Jharkhand'),
(12, 'KA', 'Karnataka'),
(13, 'KL', 'Kerala'),
(14, 'MP', 'Madhya Pradesh'),
(15, 'MH', 'Maharashtra'),
(16, 'MN', 'Manipur'),
(17, 'ML', 'Meghalaya'),
(18, 'MZ', 'Mizoram'),
(19, 'NL', 'Nagaland'),
(20, 'OR', 'Orissa'),
(21, 'PB', 'Punjab'),
(22, 'RJ', 'Rajasthan'),
(23, 'SK', 'Sikkim'),
(24, 'TN', 'Tamil Nadu'),
(25, 'TR', 'Tripura'),
(26, 'UK', 'Uttarakhand'),
(27, 'UP', 'Uttar Pradesh'),
(28, 'WB', 'West Bengal'),
(29, 'TN', 'Tamil Nadu'),
(30, 'TR', 'Tripura'),
(31, 'AN', 'Andaman and Nicobar Islands'),
(32, 'CH', 'Chandigarh'),
(33, 'DH', 'Dadra and Nagar Haveli'),
(34, 'DD', 'Daman and Diu'),
(35, 'DL', 'Delhi'),
(36, 'LD', 'Lakshadweep'),
(37, 'PY', 'Pondicherry'),
(38, 'TG', 'Telangana'),
(1, 'AP', 'Andhra Pradesh'),
(2, 'AR', 'Arunachal Pradesh'),
(3, 'AS', 'Assam'),
(4, 'BR', 'Bihar'),
(5, 'CG', 'Chhattisgarh'),
(6, 'GA', 'Goa'),
(7, 'GJ', 'Gujarat'),
(8, 'HR', 'Haryana'),
(9, 'HP', 'Himachal Pradesh'),
(10, 'JK', 'Jammu and Kashmir'),
(11, 'JH', 'Jharkhand'),
(12, 'KA', 'Karnataka'),
(13, 'KL', 'Kerala'),
(14, 'MP', 'Madhya Pradesh'),
(15, 'MH', 'Maharashtra'),
(16, 'MN', 'Manipur'),
(17, 'ML', 'Meghalaya'),
(18, 'MZ', 'Mizoram'),
(19, 'NL', 'Nagaland'),
(20, 'OR', 'Orissa'),
(21, 'PB', 'Punjab'),
(22, 'RJ', 'Rajasthan'),
(23, 'SK', 'Sikkim'),
(24, 'TN', 'Tamil Nadu'),
(25, 'TR', 'Tripura'),
(26, 'UK', 'Uttarakhand'),
(27, 'UP', 'Uttar Pradesh'),
(28, 'WB', 'West Bengal'),
(29, 'TN', 'Tamil Nadu'),
(30, 'TR', 'Tripura'),
(31, 'AN', 'Andaman and Nicobar Islands'),
(32, 'CH', 'Chandigarh'),
(33, 'DH', 'Dadra and Nagar Haveli'),
(34, 'DD', 'Daman and Diu'),
(35, 'DL', 'Delhi'),
(36, 'LD', 'Lakshadweep'),
(37, 'PY', 'Pondicherry'),
(38, 'TG', 'Telangana');

-- --------------------------------------------------------

--
-- Table structure for table `suppbank`
--

DROP TABLE IF EXISTS `suppbank`;
CREATE TABLE IF NOT EXISTS `suppbank` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `supcode` varchar(25) NOT NULL,
  `bankname` varchar(25) DEFAULT NULL,
  `acctno` varchar(20) NOT NULL,
  `acctname` varchar(40) NOT NULL,
  `acctype` varchar(20) NOT NULL,
  `branch` varchar(30) NOT NULL,
  `ifsc` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppbank`
--

INSERT INTO `suppbank` (`id`, `supcode`, `bankname`, `acctno`, `acctname`, `acctype`, `branch`, `ifsc`) VALUES
(001, 'DAPL/GST009/001', 'Indian', '12312312', 'dsfdsfsd', 'Savings', 'sdfsdf', '123324'),
(003, 'DAPL/GST3434342/003', 'Indian Bank', '121212', 'asdas`', 'Savings', 'sfdf', '21432423');

-- --------------------------------------------------------

--
-- Table structure for table `suptype`
--

DROP TABLE IF EXISTS `suptype`;
CREATE TABLE IF NOT EXISTS `suptype` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `suptype` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suptype`
--

INSERT INTO `suptype` (`id`, `suptype`, `description`) VALUES
(005, 'Plastic Supplier', 'suppliesr of Water bottle'),
(009, 'demo', 'sdfdsf'),
(010, 'Sticker Supplier', 'Sticker Supplier'),
(011, 'Fruit Supplier', 'Alphanso'),
(012, 'dsadasd', 'sadsad'),
(013, 'fdafa', 'sdfdsfs'),
(014, 'fdsfdsfsdf', '');

-- --------------------------------------------------------

--
-- Table structure for table `taxmaster`
--

DROP TABLE IF EXISTS `taxmaster`;
CREATE TABLE IF NOT EXISTS `taxmaster` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(10) NOT NULL,
  `postfix` varchar(10) NOT NULL,
  `taxname` varchar(100) NOT NULL,
  `description` varchar(40) NOT NULL,
  `taxtype` varchar(50) NOT NULL,
  `taxrate` decimal(10,1) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxmaster`
--

INSERT INTO `taxmaster` (`id`, `prefix`, `postfix`, `taxname`, `description`, `taxtype`, `taxrate`, `createdon`, `updatedon`) VALUES
(1, '', '', '12.5%GST(12.5)', '12.5%GST(12.5)', '1', '12.5', '2018-05-11 14:34:22', '2018-05-11 14:34:22'),
(2, '', '', '18%GST(18%)', '18%GST(18%)', '1', '18.0', '2018-05-11 14:34:50', '2018-05-11 14:34:50'),
(3, '', '', '5%GST(5%)', '5%GST(5%)', '1', '5.0', '2018-05-11 14:35:29', '2018-05-11 14:35:29');

-- --------------------------------------------------------

--
-- Table structure for table `transportmaster`
--

DROP TABLE IF EXISTS `transportmaster`;
CREATE TABLE IF NOT EXISTS `transportmaster` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `transname` varchar(40) NOT NULL,
  `vtype` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transportmaster`
--

INSERT INTO `transportmaster` (`id`, `transname`, `vtype`) VALUES
(001, 'ARC Parcel Services', 'Truck'),
(003, 'ABC Parcel Services', 'Courier');

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

DROP TABLE IF EXISTS `uom`;
CREATE TABLE IF NOT EXISTS `uom` (
  `id` int(11) NOT NULL DEFAULT '0',
  `code` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uom`
--

INSERT INTO `uom` (`id`, `code`, `description`) VALUES
(1, 'BAG', 'Bag'),
(2, 'BKT', 'Bucket'),
(3, 'BND', 'Bundle'),
(4, 'BOWL', 'Bowl'),
(5, 'BX', 'Box'),
(6, 'CRD', 'Card'),
(7, 'CAN', 'Cans'),
(8, 'CM', 'Centimeters'),
(9, 'CS', 'Case'),
(10, 'CTN', 'Carton'),
(11, 'DZ', 'Dozen'),
(12, 'DRM', 'Drums'),
(13, 'EA', 'Each'),
(14, 'FT', 'Foot'),
(15, 'GAL', 'Gallon'),
(16, 'GROSS', 'Gross'),
(17, 'IN', 'Inches'),
(18, 'KIT', 'Kit'),
(19, 'LOT', 'Lot'),
(20, 'M', 'Meter'),
(21, 'MM', 'Millimeter'),
(22, 'PC', 'Piece'),
(23, 'PK', 'Pack'),
(24, 'PK100', 'Pack 100'),
(25, 'PK50', 'Pack 50'),
(26, 'PR', 'Pair'),
(27, 'RACK', 'Rack'),
(28, 'RL', 'Roll'),
(29, 'SET', 'Set'),
(30, 'SET3', 'Set of 3'),
(31, 'SET4', 'Set of 4'),
(32, 'SET5', 'Set of 5'),
(33, 'SGL', 'Single'),
(34, 'SHT', 'Sheet'),
(35, 'SQFT', 'Square ft'),
(36, 'TUBE', 'Tube'),
(37, 'YD', 'Yard'),
(38, 'KGS', 'Kiliograms'),
(39, 'KLR', 'Kilolitter'),
(40, 'NOS', 'Numbers'),
(41, 'TON ', 'Tonnes'),
(42, 'TUB ', 'Tubes'),
(43, 'BTL', 'Bottles'),
(44, 'UNT', 'Units'),
(45, 'OTH', 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `uom_lookups`
--

DROP TABLE IF EXISTS `uom_lookups`;
CREATE TABLE IF NOT EXISTS `uom_lookups` (
  `id` int(11) NOT NULL DEFAULT '0',
  `code` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uom_lookups`
--

INSERT INTO `uom_lookups` (`id`, `code`, `description`) VALUES
(1, 'BAG', 'Bag'),
(2, 'BKT', 'Bucket'),
(3, 'BND', 'Bundle'),
(4, 'BOWL', 'Bowl'),
(5, 'BX', 'Box'),
(6, 'CRD', 'Card'),
(7, 'CAN', 'Cans'),
(8, 'CM', 'Centimeters'),
(9, 'CS', 'Case'),
(10, 'CTN', 'Carton'),
(11, 'DZ', 'Dozen'),
(12, 'DRM', 'Drums'),
(13, 'EA', 'Each'),
(14, 'FT', 'Foot'),
(15, 'GAL', 'Gallon'),
(16, 'GROSS', 'Gross'),
(17, 'IN', 'Inches'),
(18, 'KIT', 'Kit'),
(19, 'LOT', 'Lot'),
(20, 'M', 'Meter'),
(21, 'MM', 'Millimeter'),
(22, 'PC', 'Piece'),
(23, 'PK', 'Pack'),
(24, 'PK100', 'Pack 100'),
(25, 'PK50', 'Pack 50'),
(26, 'PR', 'Pair'),
(27, 'RACK', 'Rack'),
(28, 'RL', 'Roll'),
(29, 'SET', 'Set'),
(30, 'SET3', 'Set of 3'),
(31, 'SET4', 'Set of 4'),
(32, 'SET5', 'Set of 5'),
(33, 'SGL', 'Single'),
(34, 'SHT', 'Sheet'),
(35, 'SQFT', 'Square ft'),
(36, 'TUBE', 'Tube'),
(37, 'YD', 'Yard'),
(38, 'KGS', 'Kiliograms'),
(39, 'KLR', 'Kilolitter'),
(40, 'NOS', 'Numbers'),
(41, 'TON ', 'Tonnes'),
(42, 'TUB ', 'Tubes'),
(43, 'BTL', 'Bottles'),
(44, 'UNT', 'Units'),
(45, 'OTH', 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `usergroups`
--

DROP TABLE IF EXISTS `usergroups`;
CREATE TABLE IF NOT EXISTS `usergroups` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userid` int(11) UNSIGNED NOT NULL,
  `groupid` mediumint(8) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

DROP TABLE IF EXISTS `userprofile`;
CREATE TABLE IF NOT EXISTS `userprofile` (
  `id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userid` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `userpassword` varchar(255) NOT NULL,
  `repass` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `groupname` varchar(35) NOT NULL,
  `compcode` varchar(40) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT '1',
  `image_name` varchar(155) NOT NULL,
  `image` longblob,
  `emailverified` varchar(10) NOT NULL DEFAULT '0',
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` varchar(30) DEFAULT NULL,
  `validtill` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`id`, `userid`, `username`, `firstname`, `lastname`, `gender`, `useremail`, `userpassword`, `repass`, `mobile`, `address`, `groupname`, `compcode`, `status`, `image_name`, `image`, `emailverified`, `createdon`, `createdby`, `validtill`) VALUES
(1, 'DAPL001', 'Bhairava', 'Srii', 'Kalabhairava', '1', 'bhairava@gmail.com', '12345', '123', '2018-05-31', '', 'test', 'DAPL001', '1', 'upload/Saravana-LatestPhoto.jpg', '', '1', '2018-05-06 13:00:23', '', '0000-00-00 00:00:00'),
(2, 'DAPL002', 'Janessha', 'Janessha Sri', 'S', '2', 'janessha@gmail.com', '12323', '123', '99999', 'hhhh', 'Admin', 'Open Org ID', '1', 'upload/Saravana-LatestPhoto.jpg', '', '0', '2018-05-06 13:01:47', '', '2018-05-06 13:01:47'),
(3, 'DAPL003', 'Hritish', 'Hritish', 'S', '1', 'hritish@gmail.com', '12345', '12345', '9677573737', 'krishnagiri', 'Staff', 'DAPL001', '1', 'upload/sample-image-1.jpg', NULL, '0', '2018-05-15 16:00:24', NULL, '2018-05-15 16:00:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_repass` varchar(255) NOT NULL,
  `user_mobile` varchar(15) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_role` varchar(25) NOT NULL,
  `user_status` varchar(10) NOT NULL DEFAULT '0',
  `image_name` varchar(155) NOT NULL,
  `image` longblob NOT NULL,
  `user_createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_name`),
  UNIQUE KEY `user_name` (`user_name`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendorprofile`
--

DROP TABLE IF EXISTS `vendorprofile`;
CREATE TABLE IF NOT EXISTS `vendorprofile` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `vendorid` varchar(50) NOT NULL,
  `prefix` varchar(15) DEFAULT 'DAPL',
  `postfix` varchar(50) NOT NULL DEFAULT '/',
  `title` varchar(6) NOT NULL,
  `supname` varchar(50) NOT NULL,
  `portal` varchar(100) DEFAULT NULL,
  `suptype` varchar(50) NOT NULL,
  `blocation` varchar(100) NOT NULL,
  `industry` varchar(50) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` varchar(30) NOT NULL,
  `workphone` varchar(30) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `email` varchar(40) NOT NULL,
  `web` varchar(40) NOT NULL,
  `gstin` varchar(25) NOT NULL,
  `gstregdate` date DEFAULT NULL,
  `primaryflag` int(20) NOT NULL DEFAULT '0',
  `openbalance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `obasofdate` date NOT NULL,
  `image` varchar(155) DEFAULT NULL,
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP,
  `createdby` varchar(100) DEFAULT NULL,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedby` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendorprofile`
--

INSERT INTO `vendorprofile` (`id`, `vendorid`, `prefix`, `postfix`, `title`, `supname`, `portal`, `suptype`, `blocation`, `industry`, `address`, `city`, `country`, `state`, `zip`, `workphone`, `mobile`, `email`, `web`, `gstin`, `gstregdate`, `primaryflag`, `openbalance`, `obasofdate`, `image`, `createdon`, `createdby`, `updatedon`, `updatedby`) VALUES
(001, 'DAPL001', 'DAPL', '/', 'MS.', 'Salim Mangos', NULL, 'Fruit Supplier', 'Krishnagiri', NULL, 'Kaveripattinam', 'Kaveripattinam', 'Afghanistan', 'Andhra Pradesh', '635002', '', '8787878787', 'saravanas.office@gmail.com', '', '312312312', NULL, 0, '1007.00', '2018-05-15', NULL, '2018-05-15 20:55:15', NULL, '2018-05-15 20:55:15', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
