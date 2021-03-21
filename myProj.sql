-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 02, 2018 at 07:17 PM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myProj`
--

-- --------------------------------------------------------

--
-- Table structure for table `bankdeposit`
--

CREATE TABLE `bankdeposit` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `transid` varchar(20) NOT NULL,
  `depositdate` date NOT NULL,
  `compcode` varchar(100) NOT NULL,
  `bankname` varchar(100) NOT NULL,
  `acctno` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `paymethod` varchar(50) NOT NULL,
  `paytype` varchar(50) NOT NULL,
  `referenceno` varchar(100) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `createdby` varchar(100) NOT NULL,
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bankdeposit`
--

INSERT INTO `bankdeposit` (`id`, `transid`, `depositdate`, `compcode`, `bankname`, `acctno`, `amount`, `paymethod`, `paytype`, `referenceno`, `notes`, `createdby`, `createdon`) VALUES
(001, '00001', '2018-07-26', 'LAF001', 'Indian Bank', '92324327428', '1000.00', 'Cash', 'Sales', '989898', 'hhh', 'Bhairava', '2018-07-27 18:46:57'),
(002, '00002', '2018-07-27', 'LAF001', 'HDFC Bank', '1234567890', '2000.00', 'Cash', 'Sales', '212123', 'sadsa', 'Bhairava', '2018-07-27 06:40:17'),
(003, '00003', '2018-08-01', 'LAF001', 'HDFC Bank', '1234567890', '1000.00', 'Cash', 'Sales', 'asdas', 'sadsa', 'Bhairava', '2018-08-01 09:04:48');

-- --------------------------------------------------------

--
-- Table structure for table `cashmemos`
--

CREATE TABLE `cashmemos` (
  `id` int(10) NOT NULL,
  `cashmem_code` varchar(100) DEFAULT NULL,
  `cashmem_owner` varchar(255) DEFAULT NULL,
  `cashmem_customer` varchar(100) DEFAULT NULL,
  `cashmem_comp_code` varchar(100) DEFAULT NULL,
  `cashmem_vendor` varchar(255) DEFAULT NULL,
  `cashmem_receipt_no` varchar(100) DEFAULT NULL,
  `cashmem_cust_ref_phno` varchar(30) DEFAULT NULL,
  `cashmem_date` varchar(100) DEFAULT NULL,
  `cashmem_paymentmode` varchar(255) DEFAULT NULL,
  `cashmem_deliveryat` varchar(100) DEFAULT NULL,
  `cashmem_status` varchar(15) DEFAULT NULL,
  `cashmem_value` varchar(100) DEFAULT NULL,
  `cashmem_tc` varchar(255) DEFAULT NULL,
  `cashmem_notes` varchar(255) DEFAULT NULL,
  `cashmem_items` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `compbank`
--

CREATE TABLE `compbank` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `orgid` varchar(25) NOT NULL,
  `name` varchar(40) DEFAULT NULL,
  `ctype` varchar(25) DEFAULT NULL,
  `location` varchar(30) DEFAULT NULL,
  `bankname` varchar(25) DEFAULT NULL,
  `acctno` varchar(20) NOT NULL,
  `acctname` varchar(40) NOT NULL,
  `acctype` varchar(20) NOT NULL,
  `branch` varchar(30) NOT NULL,
  `ifsc` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compbank`
--

INSERT INTO `compbank` (`id`, `orgid`, `name`, `ctype`, `location`, `bankname`, `acctno`, `acctname`, `acctype`, `branch`, `ifsc`) VALUES
(006, 'DAPL001', NULL, NULL, NULL, 'HDFC', '214321423', 'Dhiraj Agro Private Limited', 'Current', 'Kalastri', 'HDFC9990123');

-- --------------------------------------------------------

--
-- Table structure for table `comprofile`
--

CREATE TABLE `comprofile` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `orgid` varchar(15) NOT NULL,
  `prefix` varchar(15) DEFAULT 'DAPL',
  `title` varchar(50) NOT NULL,
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
  `panno` varchar(50) NOT NULL,
  `openbalance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `balasofdate` date NOT NULL,
  `primaryflag` int(20) NOT NULL DEFAULT '0',
  `image` varchar(155) DEFAULT NULL,
  `tandc` varchar(500) DEFAULT NULL,
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP,
  `createdby` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedby` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comprofile`
--

INSERT INTO `comprofile` (`id`, `orgid`, `prefix`, `title`, `orgname`, `portal`, `orgtype`, `blocation`, `industry`, `address`, `city`, `country`, `state`, `zip`, `workphone`, `mobile`, `email`, `web`, `gstin`, `gstregdate`, `panno`, `openbalance`, `balasofdate`, `primaryflag`, `image`, `tandc`, `createdon`, `createdby`, `updatedon`, `updatedby`) VALUES
(003, 'DAPL001', 'DAPL', 'MS.', 'Dhiraj Agro Private Limited', 'http://e-schoolz.in/dhiraj', '1', 'Andhra', '1', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'IN', 'AP', '517640', '', '9677573737', 'rasaafactory@gmail.com', '', '37AAECD0073D1Z3', '2017-07-01', '', '0.00', '2018-08-17', 1, 'upload/image-temple.jpg', NULL, '2018-08-17 14:14:19', '2018-08-17 14:14:19', '2018-08-17 14:14:19', '2018-08-17 14:14:19');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
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

CREATE TABLE `country_lookups` (
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
-- Table structure for table `creditnotes`
--

CREATE TABLE `creditnotes` (
  `id` int(10) NOT NULL,
  `creditnote_id` varchar(100) DEFAULT NULL,
  `creditnote_owner` varchar(255) DEFAULT NULL,
  `creditnote_customer` varchar(20) DEFAULT NULL,
  `creditnote_comp_code` varchar(100) DEFAULT NULL,
  `creditnote_inv_code` varchar(50) DEFAULT NULL,
  `creditnote_cust_ref_no` varchar(30) DEFAULT NULL,
  `creditnote_paymentdate` varchar(20) DEFAULT NULL,
  `creditnote_paymentmode` varchar(20) DEFAULT NULL,
  `creditnote_status` varchar(15) DEFAULT NULL,
  `creditnote_shipping_street` varchar(255) DEFAULT NULL,
  `creditnote_shipping_city` varchar(255) DEFAULT NULL,
  `creditnote_shipping_state` varchar(255) DEFAULT NULL,
  `creditnote_shipping_country` varchar(255) DEFAULT NULL,
  `creditnote_shipping_zip` varchar(255) DEFAULT NULL,
  `creditnote_shipping_phone` varchar(255) DEFAULT NULL,
  `creditnote_shipping_gstin` varchar(255) DEFAULT NULL,
  `creditnote_billing_street` varchar(255) DEFAULT NULL,
  `creditnote_billing_city` varchar(255) DEFAULT NULL,
  `creditnote_billing_state` varchar(255) DEFAULT NULL,
  `creditnote_billing_country` varchar(255) DEFAULT NULL,
  `creditnote_billing_zip` varchar(255) DEFAULT NULL,
  `creditnote_billing_phone` varchar(255) DEFAULT NULL,
  `creditnote_billing_gstin` varchar(255) DEFAULT NULL,
  `creditnote_value` varchar(100) DEFAULT NULL,
  `creditnote_tc` varchar(255) DEFAULT NULL,
  `creditnote_notes` varchar(255) DEFAULT NULL,
  `creditnote_email_notification` varchar(10) DEFAULT NULL,
  `creditnote_items` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customerprofile`
--

CREATE TABLE `customerprofile` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `custid` varchar(50) NOT NULL,
  `cust_opening_bal` varchar(100) DEFAULT NULL,
  `prefix` varchar(15) DEFAULT 'DAPL',
  `postfix` varchar(50) NOT NULL DEFAULT '/',
  `title` varchar(6) NOT NULL,
  `custname` varchar(50) NOT NULL,
  `portal` varchar(100) DEFAULT NULL,
  `custype` varchar(50) NOT NULL,
  `blocation` varchar(100) DEFAULT NULL,
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
  `obasofdate` datetime DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(155) DEFAULT NULL,
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP,
  `createdby` varchar(100) DEFAULT NULL,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedby` varchar(100) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT '1',
  `handler` varchar(100) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customerprofile`
--

INSERT INTO `customerprofile` (`id`, `custid`, `cust_opening_bal`, `prefix`, `postfix`, `title`, `custname`, `portal`, `custype`, `blocation`, `industry`, `address`, `city`, `country`, `state`, `zip`, `workphone`, `mobile`, `email`, `web`, `gstin`, `gstregdate`, `primaryflag`, `openbalance`, `obasofdate`, `image`, `createdon`, `createdby`, `updatedon`, `updatedby`, `status`, `handler`, `notes`) VALUES
(003, '00001', '0', 'DAPL', '/', 'Mr.', 'Saravanakumar', NULL, 'Wholesalers', 'Tamil Nadu', NULL, '125-Old Hall Street', 'Krishnagiri', 'IN', 'TN', '777', '', '98999988', 'saravanas.office@gmail.com', '', '112343434343434', NULL, 0, '0.00', '2018-07-26 00:00:00', NULL, '2018-07-26 00:44:23', NULL, '2018-07-26 00:44:23', NULL, '1', 'Bhairava', 'jjhhh');

-- --------------------------------------------------------

--
-- Table structure for table `customer_payments`
--

CREATE TABLE `customer_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `cust_payment_id` varchar(30) NOT NULL,
  `cust_payment_customer` varchar(45) DEFAULT NULL,
  `cust_payment_invoice_no` varchar(45) DEFAULT NULL,
  `cust_payment_amount` varchar(100) DEFAULT NULL,
  `cust_payment_credits_used` varchar(100) DEFAULT NULL,
  `cust_payment_date` varchar(45) DEFAULT NULL,
  `cust_payment_mode` varchar(45) DEFAULT NULL,
  `cust_payment_ref_no` varchar(45) DEFAULT NULL,
  `cust_payment_so_code` varchar(45) DEFAULT NULL,
  `cust_payment_inv_id` varchar(45) DEFAULT NULL,
  `cust_payment_user` varchar(100) DEFAULT NULL,
  `cust_payment_notes` varchar(255) DEFAULT NULL,
  `cust_payment_file` varchar(255) DEFAULT NULL,
  `cust_payment_notify` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_payments`
--

INSERT INTO `customer_payments` (`id`, `cust_payment_id`, `cust_payment_customer`, `cust_payment_invoice_no`, `cust_payment_amount`, `cust_payment_credits_used`, `cust_payment_date`, `cust_payment_mode`, `cust_payment_ref_no`, `cust_payment_so_code`, `cust_payment_inv_id`, `cust_payment_user`, `cust_payment_notes`, `cust_payment_file`, `cust_payment_notify`) VALUES
(1, 'CUSTPAY-00001', '00001', 'INV-00001', '1560', NULL, '2018-08-26', 'Cash', 'INV-00001', '', 'INV-00001', 'Bhairava', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `custype`
--

CREATE TABLE `custype` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `custype` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custype`
--

INSERT INTO `custype` (`id`, `custype`, `description`) VALUES
(003, 'Wholesalers', 'Remarks'),
(005, 'Distributor', 'Distributor'),
(006, 'Retailer', 'Retailer'),
(007, 'Marketing agent', 'Marketting Agent'),
(013, '', ''),
(014, 'Retailer', ''),
(015, 'xyz', ''),
(016, 'zer', ''),
(017, 'ad', 'das'),
(018, 'Supervisor', ''),
(019, 'dettt', ''),
(020, 'fsfsfsfsfs', ''),
(021, 'Wholesaler', ''),
(022, 'kkkk', ''),
(023, 'ffff', ''),
(024, 'juke', ''),
(025, 'super', ''),
(026, 'Distributors', ''),
(027, 'ffger', 'dd'),
(028, 'upper', ''),
(029, 'demos', ''),
(030, 'Clerk', '');

-- --------------------------------------------------------

--
-- Table structure for table `debitnotes`
--

CREATE TABLE `debitnotes` (
  `id` int(10) NOT NULL,
  `debitnote_id` varchar(100) DEFAULT NULL,
  `debitnote_owner` varchar(255) DEFAULT NULL,
  `debitnote_vendor` varchar(20) DEFAULT NULL,
  `debitnote_comp_code` varchar(100) DEFAULT NULL,
  `debitnote_grn_id` varchar(50) DEFAULT NULL,
  `debitnote_vendor_ref_no` varchar(30) DEFAULT NULL,
  `debitnote_paymentdate` varchar(20) DEFAULT NULL,
  `debitnote_paymentmode` varchar(20) DEFAULT NULL,
  `debitnote_status` varchar(15) DEFAULT NULL,
  `debitnote_shipping_street` varchar(255) DEFAULT NULL,
  `debitnote_shipping_city` varchar(255) DEFAULT NULL,
  `debitnote_shipping_state` varchar(255) DEFAULT NULL,
  `debitnote_shipping_country` varchar(255) DEFAULT NULL,
  `debitnote_shipping_zip` varchar(255) DEFAULT NULL,
  `debitnote_shipping_phone` varchar(255) DEFAULT NULL,
  `debitnote_shipping_gstin` varchar(255) DEFAULT NULL,
  `debitnote_billing_street` varchar(255) DEFAULT NULL,
  `debitnote_billing_city` varchar(255) DEFAULT NULL,
  `debitnote_billing_state` varchar(255) DEFAULT NULL,
  `debitnote_billing_country` varchar(255) DEFAULT NULL,
  `debitnote_billing_zip` varchar(255) DEFAULT NULL,
  `debitnote_billing_phone` varchar(255) DEFAULT NULL,
  `debitnote_billing_gstin` varchar(255) DEFAULT NULL,
  `debitnote_value` varchar(100) DEFAULT NULL,
  `debitnote_tc` varchar(255) DEFAULT NULL,
  `debitnote_notes` varchar(255) DEFAULT NULL,
  `debitnote_email_notification` varchar(10) DEFAULT NULL,
  `debitnote_items` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `debitnotes`
--

INSERT INTO `debitnotes` (`id`, `debitnote_id`, `debitnote_owner`, `debitnote_vendor`, `debitnote_comp_code`, `debitnote_grn_id`, `debitnote_vendor_ref_no`, `debitnote_paymentdate`, `debitnote_paymentmode`, `debitnote_status`, `debitnote_shipping_street`, `debitnote_shipping_city`, `debitnote_shipping_state`, `debitnote_shipping_country`, `debitnote_shipping_zip`, `debitnote_shipping_phone`, `debitnote_shipping_gstin`, `debitnote_billing_street`, `debitnote_billing_city`, `debitnote_billing_state`, `debitnote_billing_country`, `debitnote_billing_zip`, `debitnote_billing_phone`, `debitnote_billing_gstin`, `debitnote_value`, `debitnote_tc`, `debitnote_notes`, `debitnote_email_notification`, `debitnote_items`) VALUES
(1, 'DBN-00001', 'Bhairava', '00001', 'DAPL001', 'GRN-000005', '4356789', '2018-07-21', 'Cash', NULL, '125,PalacodeMain Road', 'Kaveripattinam', 'NL', 'AZ', '606767', '9677573737', '1234567890', '125,PalacodeMain Road', 'Kaveripattinam', 'NL', 'AZ', '606767', '9677573737', '1234567890', '10.00', NULL, 'nnj', 'no', '[{\"itemdetails\":\"[DAPL001] 500ML Pulp\",\"itemcode\":\"1\",\"hsncode\":\"\",\"rwqty\":\"1\",\"tax_val\":\"5.0\",\"tax_method\":\"1\",\"rwprice\":\"9.5\",\"rwprice_org\":\"10.00\",\"rwamt\":\"9.5\",\"podiscount\":\"\",\"poadjustmentval\":\"\",\"uom\":\"BTL\"}]'),
(2, 'DBN-00002', 'Bhairava', '00001', 'DAPL001', 'GRN-000006', '657890-', '2018-07-23', 'Cash', NULL, '125,PalacodeMain Road', 'Kaveripattinam', 'AP', 'AT', '606767', '9677573737', '1234567890', '125,PalacodeMain Road', 'Kaveripattinam', 'AP', 'AT', '606767', '9677573737', '1234567890', '130.00', NULL, 'kmk', 'no', '[{\"itemdetails\":\"[DAPL001] 500ML Pulp\",\"itemcode\":\"1\",\"hsncode\":\"\",\"rwqty\":\"1\",\"tax_val\":\"5.0\",\"tax_method\":\"1\",\"rwprice\":\"9.5\",\"rwprice_org\":\"10.00\",\"rwamt\":\"9.5\",\"podiscount\":\"\",\"poadjustmentval\":\"\",\"uom\":\"BTL\"},{\"itemdetails\":\"[DAPL001] 500ML Pulp\",\"itemcode\":\"1\",\"hsncode\":\"\",\"rwqty\":\"12\",\"tax_val\":\"5.0\",\"tax_method\":\"1\",\"rwprice\":\"9.5\",\"rwprice_org\":\"10.00\",\"rwamt\":\"114\",\"podiscount\":\"\",\"poadjustmentval\":\"\",\"uom\":\"BTL\"}]'),
(3, 'DBN-00003', 'Bhairava', '00001', 'LAF001', 'GRN-000002', 'tyt467890', '2018-07-26', 'Cash', NULL, '125,PalacodeMain Road', 'Kaveripattinam', 'AR', 'DZ', '606767', '9677573737', '1234567890', '125,PalacodeMain Road', 'Kaveripattinam', 'AR', 'DZ', '606767', '9677573737', '1234567890', '10.00', NULL, 'sssss', 'no', '[{\"itemdetails\":\"[DAPL001] 500ML Pulp mango\",\"itemcode\":\"1\",\"hsncode\":\"\",\"rwqty\":\"1\",\"tax_val\":\"5.0\",\"tax_method\":\"1\",\"rwprice\":\"9.5\",\"rwprice_org\":\"10.00\",\"rwamt\":\"9.5\",\"podiscount\":\"\",\"poadjustmentval\":\"\",\"uom\":\"BTL\"}]'),
(4, 'DBN-00004', 'Bhairava', '00001', 'LAF001', 'GRN-000008', '67890', '2018-07-26', 'Cheque', NULL, '125,PalacodeMain Road', 'Kaveripattinam', 'AS', 'BD', '606767', '9677573737', '1234567890', '125,PalacodeMain Road', 'Kaveripattinam', 'AS', 'BD', '606767', '9677573737', '1234567890', '10811.25', NULL, 'sss', 'no', '[{\"itemdetails\":\"[DAPL001] 500ML Pulp mango\",\"itemcode\":\"1\",\"hsncode\":\"\",\"rwqty\":\"961\",\"tax_val\":\"12.5\",\"tax_method\":\"0\",\"rwprice\":\"10.00\",\"rwprice_org\":\"10.00\",\"rwamt\":\"9610\",\"podiscount\":\"\",\"poadjustmentval\":\"\",\"uom\":\"BTL\"}]'),
(5, 'DBN-00005', 'Bhairava', '00001', 'LAF001', 'GRN-000009', '9000', '2018-07-26', '', NULL, '125,PalacodeMain Road', 'Kaveripattinam', 'TN', 'IN', '606767', '9677573737', '1234567890', '125,PalacodeMain Road', 'Kaveripattinam', 'TN', 'IN', '606767', '9677573737', '1234567890', '210.00', NULL, 'reduced', 'no', '[{\"itemdetails\":\"[DAPL005] 20LTRS Can\",\"itemcode\":\"5\",\"hsncode\":\"\",\"rwqty\":\"3\",\"tax_val\":\"11.0\",\"tax_method\":\"1\",\"rwprice\":\"62.3\",\"rwprice_org\":\"70.00\",\"rwamt\":\"186.89999999999998\",\"podiscount\":\"\",\"poadjustmentval\":\"\",\"uom\":\"CAN\"}]'),
(6, 'DBN-00006', 'Bhairava', '00002', 'LAF001', 'GRN-0000010', '65789', '2018-07-27', NULL, NULL, 'no. 910, 3rd block, alliance orchid springs ,, koratturnorth , chennai - 600080', 'chennai', 'TN', 'AF', '600080', '8908900987', '12345678987654', 'no. 910, 3rd block, alliance orchid springs ,, koratturnorth , chennai - 600080', 'chennai', 'TN', 'AF', '600080', '8908900987', '12345678987654', '1290.00', NULL, 'm;m;', 'no', '[{\"itemdetails\":\"[DAPL002] item 2\",\"itemcode\":\"2\",\"hsncode\":\"\",\"rwqty\":\"8\",\"tax_val\":\"5.0\",\"tax_method\":\"0\",\"rwprice\":\"100.00\",\"rwprice_org\":\"100.00\",\"rwamt\":\"800\",\"podiscount\":\"\",\"poadjustmentval\":\"\",\"uom\":\"IN\"},{\"itemdetails\":\"[DAPL003] Alphanoso 500ml\",\"itemcode\":\"3\",\"hsncode\":\"\",\"rwqty\":\"2\",\"tax_val\":\"12.5\",\"tax_method\":\"0\",\"rwprice\":\"200.00\",\"rwprice_org\":\"200.00\",\"rwamt\":\"400\",\"podiscount\":\"\",\"poadjustmentval\":\"\",\"uom\":\"BKT\"}]'),
(7, 'DBN-00007', 'Bhairava', '00001', 'LAF001', 'GRN-0000011', '9001', '2018-07-27', NULL, NULL, '125,PalacodeMain Road', 'Kaveripattinam', 'TN', 'IN', '606767', '9677573737', '1234567890', '125,PalacodeMain Road', 'Kaveripattinam', 'TN', 'IN', '606767', '9677573737', '1234567890', '150.00', NULL, '67676767', 'no', '[{\"itemdetails\":\"[DAPL001] 1LTR Mango\",\"itemcode\":\"6\",\"hsncode\":\"\",\"rwqty\":\"10\",\"tax_val\":\"5.0\",\"tax_method\":\"1\",\"rwprice\":\"14.25\",\"rwprice_org\":\"15.00\",\"rwamt\":\"142.5\",\"podiscount\":\"100\",\"poadjustmentval\":\"100\",\"uom\":\"BTL\"}]'),
(8, 'DBN-00008', 'Bhairava', '00001', 'LAF001', 'GRN-0000014', '123123', '2018-07-29', NULL, NULL, '125,PalacodeMain Road', 'Kaveripattinam', 'TN', 'IN', '606767', '9677573737', '1234567890', '125,PalacodeMain Road', 'Kaveripattinam', 'TN', 'IN', '606767', '9677573737', '1234567890', '500.00', NULL, 'sada', 'no', '[{\"itemdetails\":\"[DAPL009] DemoProd\",\"itemcode\":\"9\",\"hsncode\":\"\",\"rwqty\":\"5\",\"tax_val\":\"11.00\",\"tax_method\":\"1\",\"rwprice\":\"89\",\"rwprice_org\":\"100.00\",\"rwamt\":\"445\",\"podiscount\":\"\",\"poadjustmentval\":\"\",\"uom\":\"BAG\"}]'),
(9, 'DBN-00009', 'Bhairava', '00005', 'LAF001', 'GRN-0000015', '7899', '2018-08-02', NULL, NULL, '125', 'Velampatti', 'TN', 'IN', '898878', '9677573737', '123456678909000', '125', 'Velampatti', 'TN', 'IN', '898878', '9677573737', '123456678909000', '11049.00', NULL, 'return', 'no', '[{\"itemdetails\":\"[LAF00012] Paradiso\",\"itemcode\":\"12\",\"hsncode\":\"\",\"rwqty\":\"1\",\"tax_val\":\"18.00\",\"tax_method\":\"1\",\"rwprice\":\"8750\",\"rwprice_org\":\"10000.00\",\"rwamt\":\"8750\",\"podiscount\":\"1\",\"poadjustmentval\":\"500\",\"uom\":\"CM\"}]'),
(10, 'DBN-000010', 'Bhairava', '00002', 'LAF002', 'GRN-0000017', '2354354', '2018-08-14', NULL, NULL, 'no. 910, 3rd block, alliance orchid springs ,, koratturnorth , chennai - 600080', 'chennai', 'TN', 'AF', '600080', '8908900987', '12345678987654', 'no. 910, 3rd block, alliance orchid springs ,, koratturnorth , chennai - 600080', 'chennai', 'TN', 'AF', '600080', '8908900987', '12345678987654', '5250.00', NULL, 'dfsfsd', 'no', '[{\"itemdetails\":\"[LAF00013] 20s cloth\",\"itemcode\":\"13\",\"hsncode\":\"\",\"rwqty\":\"100\",\"tax_val\":\"5.00\",\"tax_method\":\"0\",\"rwprice\":\"50.00\",\"rwprice_org\":\"50.00\",\"rwamt\":\"5000\",\"podiscount\":\"\",\"poadjustmentval\":\"\",\"uom\":\"M\"}]'),
(11, 'DBN-000011', 'Bhairava', '00001', 'DAPL001', 'GRN-000001', '3333', '2018-08-25', NULL, NULL, '206, Acme Indl. Park,  Off. I.B. Patel Rd, Goregaon (E)', 'Mumbai', 'MH', 'IN', '400 063', '967787777', '37AAECD0073D1Z3', '206, Acme Indl. Park,  Off. I.B. Patel Rd, Goregaon (E)', 'Mumbai', 'MH', 'IN', '400 063', '967787777', '37AAECD0073D1Z3', '337.00', NULL, 'fdfs', 'no', '[{\"itemdetails\":\"[DAPL005] 20LTR\",\"itemcode\":\"5\",\"hsncode\":\"\",\"rwqty\":\"12\",\"tax_val\":\"18.50\",\"tax_type\":\"single\",\"tax_method\":\"1\",\"rwprice\":\"16.3\",\"rwprice_org\":\"20.00\",\"rwamt\":\"195.60000000000002\",\"podiscount\":\"2.906\",\"poadjustmentval\":\"-.09\",\"uom\":\"CAN\"},{\"itemdetails\":\"[DAPL003] 5LTR\",\"itemcode\":\"3\",\"hsncode\":\"\",\"rwqty\":\"1\",\"tax_val\":\"5.00\",\"tax_type\":\"split\",\"tax_method\":\"1\",\"rwprice\":\"95\",\"rwprice_org\":\"100.00\",\"rwamt\":\"95\",\"podiscount\":\"2.906\",\"poadjustmentval\":\"-.09\",\"uom\":\"BND\"}]'),
(12, 'DBN-000012', 'Bhairava', '00001', 'DAPL001', 'GRN-000005', '97897', '2018-08-25', NULL, NULL, '206, Acme Indl. Park,  Off. I.B. Patel Rd, Goregaon (E)', 'Mumbai', 'MH', 'IN', '400 063', '967787777', '37AAECD0073D1Z3', '206, Acme Indl. Park,  Off. I.B. Patel Rd, Goregaon (E)', 'Mumbai', 'MH', 'IN', '400 063', '967787777', '37AAECD0073D1Z3', '9.00', NULL, 'asdas', 'no', '[{\"itemdetails\":\"[DAPL001] 1LTR Bailey\",\"itemcode\":\"1\",\"hsncode\":\"\",\"rwqty\":\"1\",\"tax_val\":\"5.00\",\"tax_type\":\"split\",\"tax_method\":\"1\",\"rwprice\":\"9.5\",\"rwprice_org\":\"10.00\",\"rwamt\":\"9.5\",\"podiscount\":0.095,\"poadjustmentval\":\"-.90\",\"podiscount_method\":\"percent\",\"uom\":\"BTL\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `estimates`
--

CREATE TABLE `estimates` (
  `id` int(10) NOT NULL,
  `est_code` varchar(100) DEFAULT NULL,
  `est_owner` varchar(255) DEFAULT NULL,
  `est_customer` varchar(20) DEFAULT NULL,
  `est_comp_code` varchar(100) DEFAULT NULL,
  `est_cust_ref_no` varchar(30) DEFAULT NULL,
  `est_date` varchar(20) DEFAULT NULL,
  `est_expdate` varchar(20) DEFAULT NULL,
  `est_status` varchar(15) DEFAULT NULL,
  `est_cust_shipping_street` varchar(255) DEFAULT NULL,
  `est_cust_shipping_city` varchar(255) DEFAULT NULL,
  `est_cust_shipping_state` varchar(255) DEFAULT NULL,
  `est_cust_shipping_country` varchar(255) DEFAULT NULL,
  `est_cust_shipping_zip` varchar(255) DEFAULT NULL,
  `est_cust_shipping_phone` varchar(255) DEFAULT NULL,
  `est_cust_shipping_gstin` varchar(255) DEFAULT NULL,
  `est_cust_billing_street` varchar(255) DEFAULT NULL,
  `est_cust_billing_city` varchar(255) DEFAULT NULL,
  `est_cust_billing_state` varchar(255) DEFAULT NULL,
  `est_cust_billing_country` varchar(255) DEFAULT NULL,
  `est_cust_billing_zip` varchar(255) DEFAULT NULL,
  `est_cust_billing_phone` varchar(255) DEFAULT NULL,
  `est_cust_billing_gstin` varchar(255) DEFAULT NULL,
  `est_value` varchar(100) DEFAULT NULL,
  `est_tc` varchar(255) DEFAULT NULL,
  `est_cust_notes` varchar(255) DEFAULT NULL,
  `est_items` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `estimates`
--

INSERT INTO `estimates` (`id`, `est_code`, `est_owner`, `est_customer`, `est_comp_code`, `est_cust_ref_no`, `est_date`, `est_expdate`, `est_status`, `est_cust_shipping_street`, `est_cust_shipping_city`, `est_cust_shipping_state`, `est_cust_shipping_country`, `est_cust_shipping_zip`, `est_cust_shipping_phone`, `est_cust_shipping_gstin`, `est_cust_billing_street`, `est_cust_billing_city`, `est_cust_billing_state`, `est_cust_billing_country`, `est_cust_billing_zip`, `est_cust_billing_phone`, `est_cust_billing_gstin`, `est_value`, `est_tc`, `est_cust_notes`, `est_items`) VALUES
(1, 'EST-00001', 'Bhairava', '00001', 'DAPL001', '123', '2018-08-26', '2018-08-26', 'Accepted', '125-Old Hall Street', 'Krishnagiri', 'TN', 'IN', '777', '98999988', '112343434343434', '125-Old Hall Street', 'Krishnagiri', 'TN', 'IN', '777', '98999988', '112343434343434', '1560.00', 'dsadsd', 'sdfds', '[{\"itemdetails\":\"[000001] Bailey Packaged Dwater 500ML \",\"itemcode\":\"1\",\"hsncode\":\"1233333\",\"rwqty\":\"10\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"1\",\"rwprice\":\"127.92\",\"rwprice_org\":\"156.00\",\"rwamt\":\"1279.2\",\"podiscount\":0,\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `expenseacctmaster`
--

CREATE TABLE `expenseacctmaster` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `accountname` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `expensenoteslog` (
  `id` int(11) NOT NULL,
  `voucherid` varchar(100) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `createdby` varchar(100) NOT NULL,
  `updatedby` varchar(100) DEFAULT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `grn_notes`
--

CREATE TABLE `grn_notes` (
  `id` int(10) NOT NULL,
  `grn_id` varchar(100) DEFAULT NULL,
  `grn_comp_code` varchar(50) DEFAULT NULL,
  `grn_owner` varchar(100) DEFAULT NULL,
  `grn_po_code` varchar(100) DEFAULT NULL,
  `grn_po_value` varchar(100) DEFAULT NULL,
  `grn_po_vendor` varchar(50) DEFAULT NULL,
  `grn_payterm` varchar(50) DEFAULT NULL,
  `grn_po_payterm` varchar(50) DEFAULT NULL,
  `grn_po_date` varchar(10) DEFAULT NULL,
  `grn_po_deliveryat` varchar(100) DEFAULT NULL,
  `grn_po_shippingvia` varchar(255) DEFAULT NULL,
  `grn_balance` varchar(45) DEFAULT NULL,
  `grn_date` varchar(45) DEFAULT NULL,
  `grn_due_date` varchar(45) DEFAULT NULL,
  `grn_payment_status` varchar(45) DEFAULT NULL,
  `grn_invoice_no` varchar(45) DEFAULT NULL,
  `grn_invoice_date` varchar(45) DEFAULT NULL,
  `grn_delivery_on` varchar(45) DEFAULT NULL,
  `grn_status` varchar(45) DEFAULT NULL,
  `grn_notes` varchar(255) DEFAULT NULL,
  `grn_po_items` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grn_notes`
--

INSERT INTO `grn_notes` (`id`, `grn_id`, `grn_comp_code`, `grn_owner`, `grn_po_code`, `grn_po_value`, `grn_po_vendor`, `grn_payterm`, `grn_po_payterm`, `grn_po_date`, `grn_po_deliveryat`, `grn_po_shippingvia`, `grn_balance`, `grn_date`, `grn_due_date`, `grn_payment_status`, `grn_invoice_no`, `grn_invoice_date`, `grn_delivery_on`, `grn_status`, `grn_notes`, `grn_po_items`) VALUES
(1, 'GRN-000001', 'DAPL001', 'Bhairava', 'PO-000001', '231660.00', '00001', NULL, '1', '2018-08-26', 'ARC â€“ Sullurpeta / Renigunta', 'ARC Parcel Services', '0', '2018-08-26', NULL, 'Paid', '56667', '2018-08-24', '2018-08-26', 'Approved', 'as per PO 100 received 90', '[{\"itemdetails\":\"[DAPL001] Preforms-1000ML\",\"itemcode\":\"1\",\"rwqty\":\"90\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"0\",\"rwprice\":\"2200.00\",\"rwprice_org\":\"2200.00\",\"rwamt\":\"198000\",\"podiscount\":1980,\"poadjustmentval\":\"\",\"podiscount_method\":\"percent\",\"uom\":\"BX\"}]'),
(2, 'GRN-000002', 'DAPL001', 'Bhairava', '', '31152.00', '00001', NULL, '1', '2018-08-31', 'Location', 'ARC Parcel Services', '31152.00', '2018-09-01', NULL, 'Unpaid', '67890', '2018-09-20', '2018-09-21', 'Approved', 'ad', '[{\"itemdetails\":\"[DAPL001] Preforms-1000ML\",\"itemcode\":\"1\",\"rwqty\":\"12\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"0\",\"rwprice\":\"2200.00\",\"rwprice_org\":\"2200.00\",\"rwamt\":\"26400\",\"podiscount\":0,\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]'),
(4, 'GRN-000003', 'DAPL001', 'Bhairava', 'PO-000002', '259600.00', '00001', NULL, '1', '2018-09-01', 'ARC â€“ Sullurpeta / Renigunta', 'ARC Parcel Services', '0', '2018-09-01', NULL, 'Paid', '56777', '2018-09-01', '2018-09-01', 'Approved', 'jjk', '[{\"itemdetails\":\"[DAPL001] Preforms-1000ML\",\"itemcode\":\"1\",\"rwqty\":\"100\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"0\",\"rwprice\":\"2200.00\",\"rwprice_org\":\"2200.00\",\"rwamt\":\"220000\",\"podiscount\":\"0\",\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]'),
(5, 'GRN-000005', 'DAPL001', 'Bhairava', 'PO-000003', '259600.00', '00001', NULL, '1', '2018-09-01', 'ARC â€“ Sullurpeta / Renigunta', 'ARC Parcel Services', '259600.00', '2018-09-01', NULL, 'Unpaid', '6578', '2018-09-01', '2018-09-01', 'Approved', 'safdsa', '[{\"itemdetails\":\"[DAPL001] Preforms-1000ML\",\"itemcode\":\"1\",\"rwqty\":\"100\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"0\",\"rwprice\":\"2200.00\",\"rwprice_org\":\"2200.00\",\"rwamt\":\"220000\",\"podiscount\":\"0\",\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(1) UNSIGNED NOT NULL,
  `groupname` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) NOT NULL,
  `inv_code` varchar(100) DEFAULT NULL,
  `inv_type` varchar(30) DEFAULT NULL,
  `inv_owner` varchar(255) DEFAULT NULL,
  `inv_customer` varchar(100) DEFAULT NULL,
  `inv_comp_code` varchar(100) DEFAULT NULL,
  `inv_vendor` varchar(255) DEFAULT NULL,
  `inv_so_code` varchar(100) DEFAULT NULL,
  `inv_description` varchar(255) DEFAULT NULL,
  `inv_date` varchar(100) DEFAULT NULL,
  `inv_duedate` varchar(100) DEFAULT NULL,
  `inv_cust_ref_phno` varchar(100) DEFAULT NULL,
  `inv_paymentmode` varchar(100) DEFAULT NULL,
  `inv_receipt_no` varchar(100) DEFAULT NULL,
  `inv_payterm` varchar(255) DEFAULT NULL,
  `inv_shippingvia` varchar(100) DEFAULT NULL,
  `inv_deliveryat` varchar(100) DEFAULT NULL,
  `inv_deliverydate` varchar(100) DEFAULT NULL,
  `inv_status` varchar(15) DEFAULT NULL,
  `inv_freight` varchar(255) DEFAULT NULL,
  `inv_shipping_street` varchar(255) DEFAULT NULL,
  `inv_shipping_city` varchar(255) DEFAULT NULL,
  `inv_shipping_state` varchar(255) DEFAULT NULL,
  `inv_shipping_country` varchar(255) DEFAULT NULL,
  `inv_shipping_zip` varchar(255) DEFAULT NULL,
  `inv_shipping_phone` varchar(255) DEFAULT NULL,
  `inv_shipping_gstin` varchar(255) DEFAULT NULL,
  `inv_billing_street` varchar(255) DEFAULT NULL,
  `inv_billing_city` varchar(255) DEFAULT NULL,
  `inv_billing_state` varchar(255) DEFAULT NULL,
  `inv_billing_country` varchar(255) DEFAULT NULL,
  `inv_billing_zip` varchar(255) DEFAULT NULL,
  `inv_billing_phone` varchar(255) DEFAULT NULL,
  `inv_billing_gstin` varchar(255) DEFAULT NULL,
  `inv_value` varchar(100) DEFAULT NULL,
  `inv_balance_amt` varchar(30) DEFAULT NULL,
  `inv_payment_status` varchar(30) DEFAULT NULL,
  `inv_tc` varchar(255) DEFAULT NULL,
  `inv_notes` varchar(255) DEFAULT NULL,
  `inv_items` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `inv_code`, `inv_type`, `inv_owner`, `inv_customer`, `inv_comp_code`, `inv_vendor`, `inv_so_code`, `inv_description`, `inv_date`, `inv_duedate`, `inv_cust_ref_phno`, `inv_paymentmode`, `inv_receipt_no`, `inv_payterm`, `inv_shippingvia`, `inv_deliveryat`, `inv_deliverydate`, `inv_status`, `inv_freight`, `inv_shipping_street`, `inv_shipping_city`, `inv_shipping_state`, `inv_shipping_country`, `inv_shipping_zip`, `inv_shipping_phone`, `inv_shipping_gstin`, `inv_billing_street`, `inv_billing_city`, `inv_billing_state`, `inv_billing_country`, `inv_billing_zip`, `inv_billing_phone`, `inv_billing_gstin`, `inv_value`, `inv_balance_amt`, `inv_payment_status`, `inv_tc`, `inv_notes`, `inv_items`) VALUES
(1, 'INV-00001', 'Credit Invoice', 'Bhairava', '00001', 'DAPL001', NULL, 'EST-00001', NULL, '2018-08-26', '2018-08-26', NULL, NULL, NULL, '1', NULL, 'TN', NULL, 'Closed', NULL, '125-Old Hall Street', 'Krishnagiri', 'TN', 'IN', '777', '98999988', '112343434343434', '125-Old Hall Street', 'Krishnagiri', 'TN', 'IN', '777', '98999988', '112343434343434', '1560.00', '0', 'Paid', 'sfsdfs', 'dsfds', '[{\"itemdetails\":\"[000001] Bailey Packaged Dwater 500ML \",\"itemcode\":\"1\",\"hsncode\":\"1233333\",\"rwqty\":\"10\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"1\",\"rwprice\":\"127.92\",\"rwprice_org\":\"156.00\",\"rwamt\":\"1279.2\",\"podiscount\":\"0\",\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]'),
(2, 'INV-00002', 'Credit Invoice', 'Bhairava', '00001', 'DAPL001', NULL, '67890', NULL, '2018-09-02', '2018-09-02', NULL, NULL, NULL, '1', NULL, 'NL', NULL, 'Created', NULL, '125-Old Hall Street', 'Krishnagiri', 'TN', 'IN', '777', '98999988', '112343434343434', '125-Old Hall Street', 'Krishnagiri', 'TN', 'IN', '777', '98999988', '112343434343434', '468.00', '468.00', 'Unpaid', 'knk', 'knk', '[{\"itemdetails\":\"[000001] Bailey Packaged Dwater 500ML \",\"itemcode\":\"1\",\"hsncode\":\"1233333\",\"rwqty\":\"3\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"1\",\"rwprice\":\"127.92\",\"rwprice_org\":\"156.00\",\"rwamt\":\"383.76\",\"podiscount\":0,\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]'),
(3, 'INV-00003', 'Retail Invoice', 'Bhairava', '00001', 'DAPL001', NULL, NULL, NULL, '2018-09-02', NULL, '989999', 'Cash', NULL, NULL, NULL, 'TN', NULL, 'Closed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1560.00', '1560.00', 'Paid', 'hhjhj', 'hhjjh', '[{\"itemdetails\":\"[000001] Bailey Packaged Dwater 500ML \",\"itemcode\":\"1\",\"hsncode\":\"1233333\",\"rwqty\":\"10\",\"tax_val\":\"18.00\",\"tax_method\":\"1\",\"rwprice\":\"127.92\",\"rwprice_org\":\"156.00\",\"rwamt\":\"1279.2\",\"podiscount\":0,\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `itemcategory`
--

CREATE TABLE `itemcategory` (
  `id` int(11) NOT NULL,
  `code` varchar(30) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemcategory`
--

INSERT INTO `itemcategory` (`id`, `code`, `category`, `description`) VALUES
(1, 'CAT001', '500ML Bottles', '500ML Bottles'),
(2, 'CAT002', '1LTR Bottles', '1LTR Bottles'),
(3, 'CAT003', 'Packing Materials', 'Packing Materials'),
(4, 'CAT004', '5LTR Bottles', '5LTR Bottles'),
(5, 'CAT005', '20LTR Bottles', '20LTR Bottles'),
(6, 'CAT006', '2LTR Bottles', '2LTR Bottles');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(2) UNSIGNED ZEROFILL NOT NULL,
  `locname` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `locname`, `description`) VALUES
(31, 'Andhra', 'Andhra'),
(32, 'ARC â€“ Sullurpeta / Renigunta', 'ARC â€“ Sullurpeta / Renigunta');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `payment_id` varchar(12) NOT NULL,
  `payment_vendor` varchar(45) DEFAULT NULL,
  `payment_invoice_no` varchar(45) DEFAULT NULL,
  `payment_amount` varchar(100) DEFAULT NULL,
  `payment_credits_used` varchar(100) DEFAULT NULL,
  `payment_date` varchar(45) DEFAULT NULL,
  `payment_mode` varchar(45) DEFAULT NULL,
  `payment_ref_no` varchar(45) DEFAULT NULL,
  `payment_po_code` varchar(45) DEFAULT NULL,
  `payment_grn_id` varchar(45) DEFAULT NULL,
  `payment_user` varchar(100) DEFAULT NULL,
  `payment_notes` varchar(255) DEFAULT NULL,
  `payment_file` varchar(255) DEFAULT NULL,
  `payment_notify` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_id`, `payment_vendor`, `payment_invoice_no`, `payment_amount`, `payment_credits_used`, `payment_date`, `payment_mode`, `payment_ref_no`, `payment_po_code`, `payment_grn_id`, `payment_user`, `payment_notes`, `payment_file`, `payment_notify`) VALUES
(1, 'DAPPAY001', '00001', '56667', '200000', NULL, '2018-08-26', 'Bank Remittance', '1232323', 'PO-000001', 'GRN-000001', 'Bhairava', 'asdsdsdfsd', NULL, NULL),
(2, 'DAPPAY002', '00001', '56667', '31660', NULL, '2018-08-26', 'Cash', '2131231', 'PO-000001', 'GRN-000001', 'Bhairava', 'asdsd', NULL, NULL),
(3, 'DAPPAY003', '00001', '56777', '10000', NULL, '2018-09-01', 'Cash', 'kk', 'PO-000002', 'GRN-000003', 'Bhairava', 'jkjk', NULL, NULL),
(4, 'DAPPAY004', '00001', '56777', '249600', NULL, '2018-09-01', 'Cash', '', 'PO-000002', 'GRN-000003', 'Bhairava', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `paymentterm`
--

CREATE TABLE `paymentterm` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `paymentterm` varchar(40) NOT NULL,
  `noofdays` varchar(50) NOT NULL,
  `description` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymentterm`
--

INSERT INTO `paymentterm` (`id`, `paymentterm`, `noofdays`, `description`) VALUES
(031, 'Advance', '1', 'Advance Payment'),
(032, 'Immediate', '1', 'Immediate Payment'),
(033, 'Due 60 Days', '60', 'Due on 60 Days '),
(034, 'Due on Receipt', '1', 'Due on Receipt'),
(035, 'Due 30 Days', '30', 'Due 30 Days'),
(036, 'Due 15 Days', '15', 'Due on 15 Days'),
(037, 'Due 7 Days', '7', 'Due 7 Days');

-- --------------------------------------------------------

--
-- Table structure for table `purchaseitemaster`
--

CREATE TABLE `purchaseitemaster` (
  `id` int(10) NOT NULL,
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
  `taxrate` decimal(10,2) NOT NULL,
  `taxamount` decimal(10,2) NOT NULL,
  `itemcost` decimal(10,2) NOT NULL,
  `taxableprice` decimal(10,2) NOT NULL,
  `pricedatefrom` date NOT NULL,
  `stockinqty` int(20) NOT NULL,
  `stockinuom` int(20) NOT NULL,
  `lowstockalert` varchar(50) NOT NULL,
  `stockasofdate` date NOT NULL,
  `usageunit` varchar(30) DEFAULT NULL,
  `handler` varchar(30) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(155) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaseitemaster`
--

INSERT INTO `purchaseitemaster` (`id`, `itemcode`, `itemname`, `category`, `description`, `vendor`, `hsncode`, `status`, `priceperqty`, `salespriceperqty`, `uom`, `taxmethod`, `taxname`, `taxrate`, `taxamount`, `itemcost`, `taxableprice`, `pricedatefrom`, `stockinqty`, `stockinuom`, `lowstockalert`, `stockasofdate`, `usageunit`, `handler`, `notes`, `updatedon`, `image`) VALUES
(1, 'DAPL001', 'Preforms-1000ML', 'CAT003', 'Preforms-1000ML', '00001', '1234567890', '1', '2200.00', NULL, 'BX', '0', '220000', '18.00', '360.00', '2000.00', '2200.00', '2018-08-26', 3401, 200, '1000', '2018-08-26', NULL, 'Bhairava', 'test', '2018-08-26 03:57:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchaseitemlog`
--

CREATE TABLE `purchaseitemlog` (
  `id` int(4) UNSIGNED ZEROFILL NOT NULL,
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
  `newtaxrate` decimal(10,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaseitemlog`
--

INSERT INTO `purchaseitemlog` (`id`, `itemcode`, `itemname`, `category`, `oldpriceqty`, `newpriceqty`, `olduom`, `newuom`, `oldstock`, `newstock`, `taxmethod`, `taxrate`, `stockasofdate`, `newstockasofdate`, `notes`, `updatedon`, `createdon`, `createdby`, `updatedby`, `taxname`, `newtaxamount`, `taxamount`, `newitemcost`, `itemcost`, `newtaxableprice`, `newpriceasofdate`, `taxableprice`, `hsncode`, `newtaxrate`) VALUES
(0001, 'DAPL001', 'Alphanso', 'CAT004', '10.0', NULL, 'KGS', NULL, '100', NULL, '1', '12.5', '2018-05-15', NULL, 'ddsfs', '2018-05-15 21:08:44', '2018-05-15 00:00:00', 'Bhairava', NULL, '12.5', NULL, '1.3', NULL, '8.8', NULL, '2018-05-15 21:08:44', '10.0', '213232', NULL),
(0002, 'DAPL002', 'Totapuri', 'CAT004', '10.0', NULL, 'KGS', NULL, '1500', NULL, '0', '0.0', '2018-05-16', NULL, 'Item added', '2018-05-16 12:06:01', '2018-05-16 00:00:00', 'Bhairava', NULL, '0', NULL, '0.0', NULL, '10.0', NULL, '2018-05-16 12:06:01', '10.0', '1212121', NULL),
(0003, 'DAPL003', 'sample one', 'CAT001', '200.0', NULL, 'BKT', NULL, '10', NULL, '1', '18.0', '2018-05-21', NULL, 'sddd', '2018-05-21 21:40:15', '2018-05-21 00:00:00', 'Bhairava', NULL, '18.0', NULL, '36.0', NULL, '164.0', NULL, '2018-05-21 21:40:15', '200.0', 'hsn345', NULL),
(0004, 'DAPL004', '500ML Bottle', 'CAT001', '5.0', NULL, 'BTL', NULL, '0', NULL, '1', '12.5', '2018-05-26', NULL, 'added', '2018-05-26 21:39:59', '2018-05-26 00:00:00', 'Bhairava', NULL, '12.5', NULL, '0.6', NULL, '4.4', NULL, '2018-05-26 21:39:59', '5.0', '123456', NULL),
(0005, 'DAPL005', '1LtrBottle', 'CAT001', '10.0', NULL, 'BTL', NULL, '0', NULL, '1', '12.5', '2018-05-26', NULL, '', '2018-05-26 21:40:56', '2018-05-26 00:00:00', 'Bhairava', NULL, '12.5', NULL, '1.3', NULL, '8.8', NULL, '2018-05-26 21:40:56', '10.0', '656546', NULL),
(0006, 'DAPL004', '500ML Bottle', '', '0.0', '5.0', '', 'BTL', '', '0', '', '0.0', '0000-00-00', '2018-05-26', '', '2018-05-26 21:41:14', '2018-05-26 21:41:14', '', 'Bhairava', NULL, NULL, '0.0', NULL, '0.0', NULL, '2018-05-26 00:00:00', '0.0', '', NULL),
(0007, 'DAPL004', '500ML Bottle', '', '0.0', '5.0', '', 'BTL', '', '200', '', '0.0', '0000-00-00', '2018-05-26', '', '2018-05-26 23:03:32', '2018-05-26 23:03:32', '', 'Bhairava', NULL, NULL, '0.0', NULL, '0.0', NULL, '2018-05-26 00:00:00', '0.0', '', NULL),
(0008, 'DAPL001', '500ML Bottle', 'CAT001', '5.0', NULL, 'BTL', NULL, '0', NULL, '1', '12.5', '2018-05-27', NULL, 'asdsadas', '2018-05-27 10:57:37', '2018-05-27 00:00:00', 'Janessha', NULL, '12.5', NULL, '0.6', NULL, '4.4', NULL, '2018-05-27 10:57:37', '5.0', '345345', NULL),
(0009, 'DAPL007', '1LTR Bottle', 'CAT001', '10.0', NULL, 'BTL', NULL, '100', NULL, '1', '18.0', '2018-05-27', NULL, 'added', '2018-05-27 10:58:31', '2018-05-27 00:00:00', 'Janessha', NULL, '18.0', NULL, '1.8', NULL, '8.2', NULL, '2018-05-27 10:58:31', '10.0', '324324', NULL),
(0010, 'DAPL001', 'T shirts', 'CAT003', '100.0', NULL, 'KIT', NULL, '80', NULL, '1', '12.5', '2018-07-08', NULL, 'notes', '2018-07-08 08:46:53', '2018-07-08 00:00:00', 'Bhairava', NULL, '12.5', NULL, '12.5', NULL, '87.5', NULL, '2018-07-08 08:46:53', '100.0', 'hsn245', NULL),
(0011, 'DAPL002', 'googles', 'CAT002', '200.0', NULL, 'GROSS', NULL, '50', NULL, '1', '12.5', '2018-07-08', NULL, '', '2018-07-08 08:47:46', '2018-07-08 00:00:00', 'Bhairava', NULL, '12.5', NULL, '25.0', NULL, '175.0', NULL, '2018-07-08 08:47:46', '200.0', 'hsn67890', NULL),
(0012, 'DAPL001', 'iiitem', 'CAT001', '100.0', NULL, 'BAG', NULL, '20', NULL, '0', '18.0', '2018-07-13', NULL, 'jbj', '2018-07-13 23:11:53', '2018-07-13 00:00:00', 'Bhairava', NULL, '18.0', NULL, '18.0', NULL, '100.0', NULL, '2018-07-13 23:11:53', '118.0', '6789', NULL),
(0013, 'DAPL002', 'nnnnn', 'CAT002', '120.0', NULL, 'KIT', NULL, '200', NULL, '1', '18.0', '2018-07-14', NULL, 'ss', '2018-07-14 12:26:15', '2018-07-14 00:00:00', 'Bhairava', NULL, '18.0', NULL, '21.6', NULL, '98.4', NULL, '2018-07-14 12:26:15', '120.0', '576890', NULL),
(0014, 'DAPL001', 'p item inc', 'CAT001', '100.0', NULL, 'KIT', NULL, '100', NULL, '1', '12.5', '2018-07-15', NULL, 'notes', '2018-07-15 11:52:01', '2018-07-15 00:00:00', 'Bhairava', NULL, '12.5', NULL, '12.5', NULL, '87.5', NULL, '2018-07-15 11:52:01', '100.0', 'hsn678', NULL),
(0015, 'DAPL002', 'inclusive', 'CAT003', '100.0', NULL, 'BND', NULL, '1000', NULL, '1', '18.0', '2018-07-15', NULL, '', '2018-07-15 16:05:29', '2018-07-15 00:00:00', 'Bhairava', NULL, '18.0', NULL, '18.0', NULL, '82.0', NULL, '2018-07-15 16:05:29', '100.0', '', NULL),
(0016, 'DAPL001', 'alphanso Pulp', 'CAT0012', '100.0', NULL, 'CAN', NULL, '1', NULL, '1', '5.0', '2018-07-18', NULL, 'Notes', '2018-07-18 21:19:30', '2018-07-18 00:00:00', 'Bhairava', NULL, '5.0', NULL, '5.0', NULL, '95.0', NULL, '2018-07-18 21:19:30', '100.0', '12312312', NULL),
(0017, 'DAPL001', '500ML Pulp', 'CAT0012', '10.0', NULL, 'BTL', NULL, '0', NULL, '1', '5.0', '2018-07-20', NULL, 'no stock', '2018-07-20 10:58:49', '2018-07-20 00:00:00', 'Bhairava', NULL, '5.0', NULL, '0.5', NULL, '9.5', NULL, '2018-07-20 10:58:49', '10.0', '12345', NULL),
(0018, 'DAPL002', 'item 2', 'CAT001', '100.0', NULL, 'IN', NULL, '100', NULL, '0', '5.0', '2018-07-25', NULL, 'zfdvs', '2018-07-25 08:51:43', '2018-07-25 00:00:00', 'Bhairava', NULL, '5.0', NULL, '5.0', NULL, '100.0', NULL, '2018-07-25 08:51:43', '105.0', 'hsnoasd0s0ff', NULL),
(0019, 'DAPL003', 'item three', 'CAT001', '200.0', NULL, 'BKT', NULL, '100', NULL, '0', '12.5', '2018-07-25', NULL, 'nnin', '2018-07-25 10:13:53', '2018-07-25 00:00:00', 'Bhairava', NULL, '12.5', NULL, '25.0', NULL, '200.0', NULL, '2018-07-25 10:13:53', '225.0', 'hsn890987', NULL),
(0020, 'DAPL001', '500ML Pulp', '', '0.0', '10.0', '', 'BTL', '', '497', '', '0.0', '0000-00-00', '2018-07-20', '', '2018-07-25 02:48:02', '2018-07-25 02:48:02', '', 'Bhairava', NULL, NULL, '0.0', NULL, '0.0', NULL, '2018-07-20 00:00:00', '0.0', '', NULL),
(0021, 'DAPL001', '500ML Pulp mango', '', '0.0', '10.0', '', 'BTL', '', '497', '', '0.0', '0000-00-00', '2018-07-20', '', '2018-07-25 04:20:58', '2018-07-25 04:20:58', '', 'Bhairava', NULL, NULL, '0.0', NULL, '0.0', NULL, '2018-07-20 00:00:00', '0.0', '', NULL),
(0022, 'DAPL003', 'Alphanoso 500ml', '', '0.0', '200.0', '', 'BKT', '', '100', '', '0.0', '0000-00-00', '2018-07-25', '', '2018-07-25 04:29:01', '2018-07-25 04:29:01', '', 'Bhairava', NULL, NULL, '0.0', NULL, '0.0', NULL, '2018-07-25 00:00:00', '0.0', '', NULL),
(0023, 'DAPL004', '5LTRS Pulp', 'juice', '100.0', NULL, 'CAN', NULL, '0', NULL, '1', '11.0', '2018-07-26', NULL, 'sss', '2018-07-25 18:13:52', '2018-07-26 00:00:00', 'Bhairava', NULL, '11.0', NULL, '11.0', NULL, '89.0', NULL, '2018-07-25 18:13:52', '100.0', '', NULL),
(0024, 'DAPL005', '20LTRS Can', 'CAT001', '70.0', NULL, 'CAN', NULL, '100', NULL, '1', '11.0', '2018-07-26', NULL, 'gghgh', '2018-07-25 23:37:02', '2018-07-26 00:00:00', 'Bhairava', NULL, '11.0', NULL, '7.7', NULL, '62.3', NULL, '2018-07-25 23:37:02', '70.0', '7787', NULL),
(0025, 'DAPL002', 'item 2', '', '0.0', '100.0', '', 'IN', '', '100', '', '0.0', '0000-00-00', '2018-07-25', '', '2018-07-26 18:50:42', '2018-07-26 18:50:42', '', 'Bhairava', NULL, NULL, '0.0', NULL, '0.0', NULL, '2018-07-25 00:00:00', '0.0', '', NULL),
(0026, 'DAPL001', '1LTR Mango', 'CAT0014', '15.0', NULL, 'BTL', NULL, '0', NULL, '1', '5.0', '2018-07-27', NULL, 'jhjhjhjh', '2018-07-26 21:31:39', '2018-07-27 00:00:00', 'Bhairava', NULL, '5.0', NULL, '0.8', NULL, '14.3', NULL, '2018-07-26 21:31:39', '15.0', '7777878787', NULL),
(0027, 'DAPL007', 'Arrow Shirts', 'CAT0015', '1000.0', NULL, 'PC', NULL, '0', NULL, '1', '6.0', '2018-07-29', NULL, 'ggg', '2018-07-28 20:09:24', '2018-07-29 00:00:00', 'Bhairava', NULL, '6', NULL, '60.0', NULL, '940.0', NULL, '2018-07-28 20:09:24', '1000.0', '', NULL),
(0028, 'DAPL008', 'Peter England', 'CAT001', '1000.0', NULL, 'PC', NULL, '0', NULL, '1', '23.0', '2018-07-29', NULL, 'gghgh', '2018-07-28 20:11:50', '2018-07-29 00:00:00', 'Bhairava', NULL, '23', NULL, '230.0', NULL, '770.0', NULL, '2018-07-28 20:11:50', '1000.0', '', NULL),
(0029, 'DAPL008', 'Peter England', '', '0.0', '1000.0', '', 'PC', '', '0', '', '0.0', '0000-00-00', '2018-07-29', '', '2018-07-28 20:13:15', '2018-07-28 20:13:15', '', 'Bhairava', NULL, NULL, '0.0', NULL, '0.0', NULL, '2018-07-29 00:00:00', '0.0', '', NULL),
(0030, 'DAPL009', 'DemoProd', 'CAT001', '100.0', NULL, 'BAG', NULL, '10', NULL, '1', '11.0', '2018-07-29', NULL, 'sadsad', '2018-07-28 20:33:52', '2018-07-29 00:00:00', 'Bhairava', NULL, '11', NULL, '11.0', NULL, '89.0', NULL, '2018-07-28 20:33:52', '100.0', '', NULL),
(0031, 'DAPL0010', '200ml bottle', 'CAT001', '7.0', NULL, 'BTL', NULL, '0', NULL, '1', '5.0', '2018-08-02', NULL, 'asdsadfsd', '2018-08-01 19:33:46', '2018-08-02 00:00:00', 'Bhairava', NULL, '5.00', NULL, '0.4', NULL, '6.7', NULL, '2018-08-01 19:33:46', '7.0', '1`321312312', NULL),
(0032, 'LAF00011', 'sadasdas', 'CAT001', '11.0', NULL, 'KIT', NULL, '100', NULL, '1', '5.0', '2018-08-02', NULL, 'ddf', '2018-08-01 19:35:47', '2018-08-02 00:00:00', 'Bhairava', NULL, '5.00', NULL, '0.6', NULL, '10.5', NULL, '2018-08-01 19:35:47', '11.0', '1`21`321', NULL),
(0033, 'LAF00012', 'Paradiso', 'CAT0017', '10000.0', NULL, 'CM', NULL, '0', NULL, '1', '12.5', '2018-08-02', NULL, 'sadasda', '2018-08-02 03:30:25', '2018-08-02 00:00:00', 'Bhairava', NULL, '12.50', NULL, '1250.0', NULL, '8750.0', NULL, '2018-08-02 03:30:25', '10000.0', '2516100200', NULL),
(0034, 'LAF00013', '20s cloth', 'CAT0013', '50.0', NULL, 'M', NULL, '100', NULL, '0', '5.0', '2018-08-14', NULL, 'sadasdas', '2018-08-13 21:12:45', '2018-08-14 00:00:00', 'Bhairava', NULL, '5.00', NULL, '2.5', NULL, '50.0', NULL, '2018-08-13 21:12:45', '52.5', '321312', NULL),
(0035, 'LAF00013', '20s cloth', '', '0.0', '50.0', '', 'M', '', '100', '', '0.0', '0000-00-00', '2018-08-14', '', '2018-08-13 21:20:18', '2018-08-13 21:20:18', '', 'Bhairava', NULL, NULL, '0.0', NULL, '0.0', NULL, '2018-08-14 00:00:00', '0.0', '', NULL),
(0036, 'DAPL001', '500ML Water Bottle', 'CAT001', '1000.0', NULL, 'BND', NULL, '100', NULL, '1', '12.5', '2018-08-25', NULL, 'asdsa', '2018-08-25 00:20:45', '2018-08-25 00:00:00', 'Bhairava', NULL, '12.50', NULL, '125.0', NULL, '875.0', NULL, '2018-08-25 00:20:45', '1000.0', '21312', NULL),
(0037, 'DAPL002', '1LTR', 'CAT001', '2000.0', NULL, 'BND', NULL, '100', NULL, '0', '5.0', '2018-08-25', NULL, 'asds', '2018-08-25 00:21:33', '2018-08-25 00:00:00', 'Bhairava', NULL, '5.00', NULL, '100.0', NULL, '2000.0', NULL, '2018-08-25 00:21:33', '2100.0', '1232131', NULL),
(0038, 'DAPL003', '5LTR', 'CAT001', '100.0', NULL, 'BND', NULL, '100', NULL, '1', '5.0', '2018-08-25', NULL, 'sadsd', '2018-08-25 00:33:45', '2018-08-25 00:00:00', 'Bhairava', NULL, '5.00', NULL, '5.0', NULL, '95.0', NULL, '2018-08-25 00:33:45', '100.0', '213123', NULL),
(0039, 'DAPL004', '1LTR', 'CAT001', '200.0', NULL, 'BND', NULL, '100', NULL, '0', '5.0', '2018-08-25', NULL, 'asdsad', '2018-08-25 00:34:47', '2018-08-25 00:00:00', 'Bhairava', NULL, '5.00', NULL, '10.0', NULL, '200.0', NULL, '2018-08-25 00:34:47', '210.0', '12121', NULL),
(0040, 'DAPL005', '20LTR', 'CAT001', '20.0', NULL, 'CAN', NULL, '10', NULL, '1', '5.0', '2018-08-25', NULL, 'sadsa', '2018-08-25 00:35:49', '2018-08-25 00:00:00', 'Bhairava', NULL, '5.00', NULL, '1.0', NULL, '19.0', NULL, '2018-08-25 00:35:49', '20.0', '122131', NULL),
(0041, 'DAPL004', '1LTR', '', '0.0', '200.0', '', 'BND', '', '100', '', '0.0', '0000-00-00', '2018-08-25', '', '2018-08-25 01:07:12', '2018-08-25 01:07:12', '', 'Bhairava', NULL, NULL, '0.0', NULL, '0.0', NULL, '2018-08-25 00:00:00', '0.0', '', NULL),
(0042, 'DAPL006', '2LTR', 'CAT001', '100.0', NULL, 'BND', NULL, '899', NULL, '0', '18.0', '2018-08-25', NULL, 'jhj', '2018-08-25 01:07:24', '2018-08-25 00:00:00', 'Bhairava', NULL, '18.00', NULL, '18.0', NULL, '100.0', NULL, '2018-08-25 01:07:24', '118.0', '8888', NULL),
(0043, 'DAPL005', '20LTR', '', '0.0', '20.0', '', 'CAN', '', '10', '', '0.0', '0000-00-00', '2018-08-25', '', '2018-08-25 01:09:16', '2018-08-25 01:09:16', '', 'Bhairava', NULL, NULL, '0.0', NULL, '0.0', NULL, '2018-08-25 00:00:00', '0.0', '', NULL),
(0044, 'DAPL001', '1LTR Bailey', 'CAT0011', '10.0', NULL, 'BTL', NULL, '100', NULL, '1', '5.0', '2018-08-25', NULL, 'asdsfds', '2018-08-25 04:41:34', '2018-08-25 00:00:00', 'Bhairava', NULL, '5.00', NULL, '0.5', NULL, '9.5', NULL, '2018-08-25 04:41:34', '10.0', '123213', NULL),
(0045, 'DAPL002', '2LTR Bottle', 'CAT001', '15.0', NULL, 'BTL', NULL, '100', NULL, '0', '5.0', '2018-08-25', NULL, 'asdsadsa', '2018-08-25 04:42:22', '2018-08-25 00:00:00', 'Bhairava', NULL, '5.00', NULL, '0.8', NULL, '15.0', NULL, '2018-08-25 04:42:22', '15.8', '12312', NULL),
(0046, 'DAPL001', 'Preforms-1000ML', 'CAT003', '2000.0', NULL, 'BX', NULL, '3000', NULL, '0', '18.0', '2018-08-26', NULL, 'test', '2018-08-25 20:57:07', '2018-08-26 00:00:00', 'Bhairava', NULL, '18.00', NULL, '360.0', NULL, '2000.0', NULL, '2018-08-25 20:57:07', '2360.0', '1234567890', NULL),
(0047, 'DAPL001', 'Preforms-1000ML', '', '0.0', '2200.0', '', 'BX', '', '3100', '', '0.0', '0000-00-00', '2018-08-26', '', '2018-08-25 21:00:08', '2018-08-25 21:00:08', '', 'Bhairava', NULL, NULL, '0.0', NULL, '0.0', NULL, '2018-08-26 00:00:00', '0.0', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchaseorders`
--

CREATE TABLE `purchaseorders` (
  `id` int(10) NOT NULL,
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
  `po_items` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaseorders`
--

INSERT INTO `purchaseorders` (`id`, `po_code`, `po_owner`, `po_comp_code`, `po_vendor`, `po_description`, `po_date`, `po_payterm`, `po_shippingvia`, `po_deliveryat`, `po_deliverydate`, `po_status`, `po_freight`, `po_shipping_street`, `po_shipping_city`, `po_shipping_state`, `po_shipping_country`, `po_shipping_zip`, `po_shipping_phone`, `po_shipping_gstin`, `po_billing_street`, `po_billing_city`, `po_billing_state`, `po_billing_country`, `po_billing_zip`, `po_billing_phone`, `po_billing_gstin`, `po_value`, `po_tc`, `po_notes`, `po_items`) VALUES
(1, 'PO-000001', 'Bhairava', 'DAPL001', '00001', 'Closure', '2018-08-26', '1', 'ARC Parcel Services', 'ARC â€“ Sullurpeta / Renigunta', '2018-08-31', 'Delivered', 'to-pay', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'AP', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'AP', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', '257400.00', 'Terms &Condtitions', 'Thanks for your business', '[{\"itemdetails\":\"[DAPL001] Preforms-1000ML\",\"itemcode\":\"1\",\"hsncode\":\"1234567890\",\"rwqty\":\"100\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"0\",\"rwprice\":\"2200.00\",\"rwprice_org\":\"2200.00\",\"rwamt\":\"220000\",\"podiscount\":2200,\"poadjustmentval\":\"\",\"podiscount_method\":\"percent\",\"uom\":\"BX\"}]'),
(2, 'PO-000002', 'Bhairava', 'DAPL001', '00001', 'asdasda', '2018-09-01', '1', 'ARC Parcel Services', 'ARC â€“ Sullurpeta / Renigunta', '2018-09-23', 'Closed', 'to-pay', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'TN', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'TN', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', '259600.00', 'Terms &Condtitions', 'sadas', '[{\"itemdetails\":\"[DAPL001] Preforms-1000ML\",\"itemcode\":\"1\",\"hsncode\":\"1234567890\",\"rwqty\":\"100\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"0\",\"rwprice\":\"2200.00\",\"rwprice_org\":\"2200.00\",\"rwamt\":\"220000\",\"podiscount\":0,\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]'),
(3, 'PO-000003', 'Bhairava', 'DAPL001', '00001', 'asdasda', '2018-09-01', '1', 'ARC Parcel Services', 'ARC â€“ Sullurpeta / Renigunta', '2018-09-23', 'Billed', 'to-pay', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'TN', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'TN', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', '259600.00', 'Terms &Condtitions', 'sadas', '[{\"itemdetails\":\"[DAPL001] Preforms-1000ML\",\"itemcode\":\"1\",\"hsncode\":\"1234567890\",\"rwqty\":\"100\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"0\",\"rwprice\":\"2200.00\",\"rwprice_org\":\"2200.00\",\"rwamt\":\"220000\",\"podiscount\":0,\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]'),
(4, 'PO-000004', 'Bhairava', 'DAPL001', '00001', '', '2018-09-01', '1', 'ARC Parcel Services', 'ARC â€“ Sullurpeta / Renigunta', '2018-09-16', 'Delivered', 'to-pay', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'TN', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'TN', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', '259600.00', 'Terms &Condtitions', 'sadas', '[{\"itemdetails\":\"[DAPL001] Preforms-1000ML\",\"itemcode\":\"1\",\"hsncode\":\"1234567890\",\"rwqty\":\"100\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"0\",\"rwprice\":\"2200.00\",\"rwprice_org\":\"2200.00\",\"rwamt\":\"220000\",\"podiscount\":0,\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]'),
(5, 'PO-000005', 'Bhairava', 'DAPL001', '00007', '', '2018-09-02', '1', 'ARC Parcel Services', 'ARC â€“ Sullurpeta / Renigunta', '2018-09-02', 'Created', 'to-pay', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'AP', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'AP', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', '25960.00', 'Terms &Condtitions', 'sfsdfsd', '[{\"itemdetails\":\"[DAPL001] Preforms-1000ML\",\"itemcode\":\"1\",\"hsncode\":\"1234567890\",\"rwqty\":\"10\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"0\",\"rwprice\":\"2200.00\",\"rwprice_org\":\"2200.00\",\"rwamt\":\"22000\",\"podiscount\":0,\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]'),
(6, 'PO-000006', 'Bhairava', 'DAPL001', '00007', '', '2018-09-02', '1', 'ARC Parcel Services', 'ARC â€“ Sullurpeta / Renigunta', '2018-09-02', 'Created', 'to-pay', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'AP', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'AP', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', '25960.00', 'Terms &Condtitions', 'sfsdfsd', '[{\"itemdetails\":\"[DAPL001] Preforms-1000ML\",\"itemcode\":\"1\",\"hsncode\":\"1234567890\",\"rwqty\":\"10\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"0\",\"rwprice\":\"2200.00\",\"rwprice_org\":\"2200.00\",\"rwamt\":\"22000\",\"podiscount\":0,\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]'),
(7, 'PO-000007', 'Bhairava', 'DAPL001', '00007', 'asdasd', '2018-09-02', '1', 'ARC Parcel Services', 'Andhra', '2018-09-19', 'Created', 'to-pay', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'AP', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'AP', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', '2596.00', 'Terms &dasdCondtitions', 'asd', '[{\"itemdetails\":\"[DAPL001] Preforms-1000ML\",\"itemcode\":\"1\",\"hsncode\":\"1234567890\",\"rwqty\":\"1\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"0\",\"rwprice\":\"2200.00\",\"rwprice_org\":\"2200.00\",\"rwamt\":\"2200\",\"podiscount\":0,\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]'),
(8, 'PO-000008', 'Bhairava', 'DAPL001', '00007', 'asdasd', '2018-09-02', '1', 'ARC Parcel Services', 'Andhra', '2018-09-19', 'Created', 'to-pay', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'AP', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'AP', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', '2596.00', 'Terms &dasdCondtitions', 'asd', '[{\"itemdetails\":\"[DAPL001] Preforms-1000ML\",\"itemcode\":\"1\",\"hsncode\":\"1234567890\",\"rwqty\":\"1\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"0\",\"rwprice\":\"2200.00\",\"rwprice_org\":\"2200.00\",\"rwamt\":\"2200\",\"podiscount\":0,\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]'),
(9, 'PO-000009', 'Bhairava', 'DAPL001', '00007', 'asdasd', '2018-09-02', '1', 'ARC Parcel Services', 'Andhra', '2018-09-19', 'Created', 'to-pay', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'AP', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'AP', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', '2596.00', 'Terms &dasdCondtitions', 'asd', '[{\"itemdetails\":\"[DAPL001] Preforms-1000ML\",\"itemcode\":\"1\",\"hsncode\":\"1234567890\",\"rwqty\":\"1\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"0\",\"rwprice\":\"2200.00\",\"rwprice_org\":\"2200.00\",\"rwamt\":\"2200\",\"podiscount\":0,\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]'),
(10, 'PO-0000010', 'Bhairava', 'DAPL001', '00007', 'asdasd', '2018-09-02', '1', 'ARC Parcel Services', 'Andhra', '2018-09-19', 'Created', 'to-pay', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'AP', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'AP', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', '2596.00', 'Terms &dasdCondtitions', 'asd', '[{\"itemdetails\":\"[DAPL001] Preforms-1000ML\",\"itemcode\":\"1\",\"hsncode\":\"1234567890\",\"rwqty\":\"1\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"0\",\"rwprice\":\"2200.00\",\"rwprice_org\":\"2200.00\",\"rwamt\":\"2200\",\"podiscount\":0,\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]'),
(11, 'PO-0000011', 'Bhairava', 'DAPL001', '00001', 'gfhjk', '2018-09-02', '60', 'ARC Parcel Services', 'ARC â€“ Sullurpeta / Renigunta', '2018-09-27', 'Created', 'to-pay', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'AP', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'AP', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', '31152.00', 'Terms &dasdCondtitions', 'sdsd', '[{\"itemdetails\":\"[DAPL001] Preforms-1000ML\",\"itemcode\":\"1\",\"hsncode\":\"1234567890\",\"rwqty\":\"12\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"0\",\"rwprice\":\"2200.00\",\"rwprice_org\":\"2200.00\",\"rwamt\":\"26400\",\"podiscount\":0,\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]'),
(12, 'PO-0000012', 'Bhairava', 'DAPL001', '00001', 'rtyu', '2018-09-02', '1', 'ARC Parcel Services', 'Andhra', '2018-09-07', 'Created', 'to-pay', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'AP', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', 'S. No: 8 & 25, Gajulapellur Village & Post, B.N. Kandriga Mandal,  Near Srikalahasti', 'Chittoor-DT', 'AP', 'IN', '517640', '9677573737', '37AAECD0073D1Z3', '2596.00', 'Terms &dasdCondtitions', 'ini', '[{\"itemdetails\":\"[DAPL001] Preforms-1000ML\",\"itemcode\":\"1\",\"hsncode\":\"1234567890\",\"rwqty\":\"1\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"0\",\"rwprice\":\"2200.00\",\"rwprice_org\":\"2200.00\",\"rwamt\":\"2200\",\"podiscount\":0,\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `purpricemaster`
--

CREATE TABLE `purpricemaster` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `itemcode` varchar(30) NOT NULL,
  `taxmethod` varchar(30) NOT NULL,
  `taxrate` decimal(10,1) NOT NULL,
  `priceperqty` decimal(10,1) NOT NULL,
  `priceperuom` decimal(10,1) NOT NULL,
  `datefrom` date NOT NULL,
  `notes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `recordexpense` (
  `id` int(11) NOT NULL,
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
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salesitemaster`
--

CREATE TABLE `salesitemaster` (
  `id` int(10) NOT NULL,
  `itemcode` varchar(40) NOT NULL,
  `itemname` varchar(255) NOT NULL,
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
  `image` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `salesitemaster2`
--

CREATE TABLE `salesitemaster2` (
  `id` int(10) NOT NULL,
  `itemcode` varchar(100) NOT NULL,
  `itemname` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `sales_vendorid` varchar(20) DEFAULT NULL,
  `hsncode` varchar(100) DEFAULT NULL,
  `sales_priceperqty` decimal(10,2) DEFAULT NULL,
  `priceperqty` decimal(10,2) DEFAULT NULL,
  `sales_uom` varchar(100) DEFAULT NULL,
  `uom` varchar(100) DEFAULT NULL,
  `sales_taxmethod` varchar(20) DEFAULT '0',
  `taxmethod` varchar(20) DEFAULT '0',
  `sales_taxname` varchar(100) DEFAULT NULL,
  `taxname` varchar(100) DEFAULT NULL,
  `sales_taxrate` decimal(10,1) DEFAULT NULL,
  `taxrate` decimal(10,1) DEFAULT NULL,
  `sales_taxamount` decimal(10,1) DEFAULT NULL,
  `taxamount` decimal(10,1) DEFAULT NULL,
  `itemcost` decimal(10,1) DEFAULT NULL,
  `taxableprice` decimal(10,1) DEFAULT NULL,
  `sales_pricedatefrom` date DEFAULT NULL,
  `pricedatefrom` date DEFAULT NULL,
  `stockinqty` int(20) DEFAULT NULL,
  `stockinqty_date` varchar(30) DEFAULT NULL,
  `stockinuom` int(20) DEFAULT NULL,
  `lowstockalert` varchar(50) DEFAULT NULL,
  `stockasofdate` date DEFAULT NULL,
  `usageunit` varchar(30) DEFAULT NULL,
  `handler` varchar(30) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `updatedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(155) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesitemaster2`
--

INSERT INTO `salesitemaster2` (`id`, `itemcode`, `itemname`, `category`, `description`, `sales_vendorid`, `hsncode`, `sales_priceperqty`, `priceperqty`, `sales_uom`, `uom`, `sales_taxmethod`, `taxmethod`, `sales_taxname`, `taxname`, `sales_taxrate`, `taxrate`, `sales_taxamount`, `taxamount`, `itemcost`, `taxableprice`, `sales_pricedatefrom`, `pricedatefrom`, `stockinqty`, `stockinqty_date`, `stockinuom`, `lowstockalert`, `stockasofdate`, `usageunit`, `handler`, `notes`, `updatedon`, `image`) VALUES
(1, '000001', 'Bailey Packaged Dwater 500ML ', 'CAT001', NULL, '00001', '1233333', '156.00', '156.00', 'BX', '0', '1', '1', '18.00', '18.00', '18.0', '18.0', '28.1', '28.1', NULL, NULL, '2018-08-26', '2018-08-26', 1487, '2018-08-26', NULL, '100', NULL, NULL, 'Bhairava', 'sadsdsd', '2018-08-26 05:04:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salesitemlog`
--

CREATE TABLE `salesitemlog` (
  `id` int(15) NOT NULL,
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
  `newtaxrate` decimal(10,1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesitemlog`
--

INSERT INTO `salesitemlog` (`id`, `itemcode`, `itemname`, `category`, `oldpriceqty`, `newpriceqty`, `olduom`, `newuom`, `oldstock`, `newstock`, `taxmethod`, `taxrate`, `stockasofdate`, `newstockasofdate`, `notes`, `updatedon`, `createdon`, `createdby`, `updatedby`, `taxname`, `newtaxamount`, `taxamount`, `newitemcost`, `itemcost`, `newtaxableprice`, `newpriceasofdate`, `taxableprice`, `hsncode`, `newtaxrate`) VALUES
(1, 'DAPL001', '500ML Bottle', 'CAT004', '10.0', '0.0', 'BND', '', '100', '', '1', '12.5', '2018-05-12', '0000-00-00', 'Added record', '2018-05-12 11:03:03', '2018-05-12 00:00:00', 'Bhairava', '', '12.5', '0.0', '1.3', '0.0', '8.8', '0.0', '2018-05-12 11:03:03', '10.0', '212121', NULL),
(2, 'DAPL001', 'fruits', 'CAT004', '100.0', '0.0', 'BAG', '', '100', '', '1', '12.5', '2018-05-12', '0000-00-00', 'fdsfdsg', '2018-05-12 11:11:52', '2018-05-12 00:00:00', 'Bhairava', '', '12.5', '0.0', '12.5', '0.0', '87.5', '0.0', '2018-05-12 11:11:52', '100.0', '123132', NULL),
(3, 'DAPL001', 'Fruits', 'CAT001', '444.0', '0.0', 'BAG', '', '100', '', '1', '12.5', '2018-05-12', '0000-00-00', 'adadf', '2018-05-12 11:23:41', '2018-05-12 00:00:00', 'Bhairava', '', '12.5', '0.0', '55.5', '0.0', '388.5', '0.0', '2018-05-12 11:23:41', '444.0', '2321', NULL),
(4, 'DAPL001', 'fruits', 'CAT001', '10.0', '0.0', 'BKT', '', '100', '', '1', '12.5', '2018-05-12', '0000-00-00', 'adasd', '2018-05-12 11:26:12', '2018-05-12 00:00:00', 'Bhairava', '', '12.5', '0.0', '1.3', '0.0', '8.8', '0.0', '2018-05-12 11:26:12', '10.0', '12313', NULL),
(5, 'DAPL001', 'fruits', '', '0.0', '12.0', '', 'BKT', '', '110', '', '0.0', '0000-00-00', '2018-05-12', '', '2018-05-12 11:33:19', '2018-05-12 11:33:19', '', 'Bhairava', NULL, '0.0', '0.0', '0.0', '0.0', '0.0', '2018-05-12 00:00:00', '0.0', '', NULL),
(6, 'DAPL001', 'fruits', '', '0.0', '12.0', '', 'BKT', '', '110', '', '0.0', '0000-00-00', '2018-05-12', 'asdsadsa', '2018-05-13 16:56:40', '2018-05-13 16:56:40', '', 'Janessha', NULL, '0.0', '0.0', '0.0', '0.0', '0.0', '2018-05-12 00:00:00', '0.0', '', NULL),
(7, 'DAPL002', '500ml Bottle', 'CAT001', '10.0', '0.0', 'BTL', '', '10', '', '1', '12.5', '2018-05-30', '0000-00-00', 'sadsadas', '2018-05-30 12:13:31', '2018-05-30 00:00:00', 'Bhairava', '', '12.5', '0.0', '1.3', '0.0', '8.8', '0.0', '2018-05-30 12:13:31', '10.0', '435435', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salesorders`
--

CREATE TABLE `salesorders` (
  `id` int(10) NOT NULL,
  `so_code` varchar(100) DEFAULT NULL,
  `so_owner` varchar(255) DEFAULT NULL,
  `so_comp_code` varchar(100) DEFAULT NULL,
  `so_customer` varchar(100) DEFAULT NULL,
  `so_cust_ref_no` varchar(20) DEFAULT NULL,
  `so_vendor` varchar(255) DEFAULT NULL,
  `so_description` varchar(255) DEFAULT NULL,
  `so_date` varchar(100) DEFAULT NULL,
  `so_payterm` varchar(255) DEFAULT NULL,
  `so_shippingvia` varchar(100) DEFAULT NULL,
  `so_deliveryat` varchar(100) DEFAULT NULL,
  `so_deliverydate` varchar(100) DEFAULT NULL,
  `so_status` varchar(15) DEFAULT NULL,
  `so_freight` varchar(255) DEFAULT NULL,
  `so_cust_shipping_street` varchar(255) DEFAULT NULL,
  `so_cust_shipping_city` varchar(255) DEFAULT NULL,
  `so_cust_shipping_state` varchar(255) DEFAULT NULL,
  `so_cust_shipping_country` varchar(255) DEFAULT NULL,
  `so_cust_shipping_zip` varchar(255) DEFAULT NULL,
  `so_cust_shipping_phone` varchar(255) DEFAULT NULL,
  `so_cust_shipping_gstin` varchar(255) DEFAULT NULL,
  `so_cust_billing_street` varchar(255) DEFAULT NULL,
  `so_cust_billing_city` varchar(255) DEFAULT NULL,
  `so_cust_billing_state` varchar(255) DEFAULT NULL,
  `so_cust_billing_country` varchar(255) DEFAULT NULL,
  `so_cust_billing_zip` varchar(255) DEFAULT NULL,
  `so_cust_billing_phone` varchar(255) DEFAULT NULL,
  `so_cust_billing_gstin` varchar(255) DEFAULT NULL,
  `so_value` varchar(100) DEFAULT NULL,
  `so_tc` varchar(255) DEFAULT NULL,
  `so_notes` varchar(255) DEFAULT NULL,
  `so_items` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salesorders`
--

INSERT INTO `salesorders` (`id`, `so_code`, `so_owner`, `so_comp_code`, `so_customer`, `so_cust_ref_no`, `so_vendor`, `so_description`, `so_date`, `so_payterm`, `so_shippingvia`, `so_deliveryat`, `so_deliverydate`, `so_status`, `so_freight`, `so_cust_shipping_street`, `so_cust_shipping_city`, `so_cust_shipping_state`, `so_cust_shipping_country`, `so_cust_shipping_zip`, `so_cust_shipping_phone`, `so_cust_shipping_gstin`, `so_cust_billing_street`, `so_cust_billing_city`, `so_cust_billing_state`, `so_cust_billing_country`, `so_cust_billing_zip`, `so_cust_billing_phone`, `so_cust_billing_gstin`, `so_value`, `so_tc`, `so_notes`, `so_items`) VALUES
(1, 'SO-00001', 'Bhairava', 'DAPL001', '00001', 'tyfugihuo', NULL, NULL, '2018-09-02', '15', 'ARC Parcel Services', 'MN', '2018-09-08', 'Created', NULL, '125-Old Hall Street', 'Krishnagiri', 'TN', 'IN', '777', '98999988', '112343434343434', '125-Old Hall Street', 'Krishnagiri', 'TN', 'IN', '777', '98999988', '112343434343434', '1872.00', 'k', 'no', '[{\"itemdetails\":\"[000001] Bailey Packaged Dwater 500ML \",\"itemcode\":\"1\",\"hsncode\":\"1233333\",\"rwqty\":\"12\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"1\",\"rwprice\":\"127.92\",\"rwprice_org\":\"156.00\",\"rwamt\":\"1535.04\",\"podiscount\":0,\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]'),
(2, 'SO-00002', 'Bhairava', 'DAPL001', '00001', '4565789hjhk', NULL, NULL, '2018-09-02', '30', 'ARC Parcel Services', 'ML', '2018-09-26', 'Created', NULL, '125-Old Hall Street', 'Krishnagiri', 'TN', 'IN', '777', '98999988', '112343434343434', '125-Old Hall Street', 'Krishnagiri', 'TN', 'IN', '777', '98999988', '112343434343434', '156.00', 'jnk', 'knlk', '[{\"itemdetails\":\"[000001] Bailey Packaged Dwater 500ML \",\"itemcode\":\"1\",\"hsncode\":\"1233333\",\"rwqty\":\"1\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"1\",\"rwprice\":\"127.92\",\"rwprice_org\":\"156.00\",\"rwamt\":\"127.92\",\"podiscount\":0,\"poadjustmentval\":\"\",\"podiscount_method\":\"flat\",\"uom\":\"BX\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
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

CREATE TABLE `state_lookups` (
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
-- Table structure for table `stock_movement`
--

CREATE TABLE `stock_movement` (
  `id` int(10) NOT NULL,
  `stk_mov_id` varchar(15) DEFAULT NULL,
  `stk_mov_type` varchar(10) DEFAULT NULL,
  `stk_mov_owner` varchar(100) DEFAULT NULL,
  `stk_mov_req_date` varchar(10) DEFAULT NULL,
  `stk_mov_location` varchar(255) DEFAULT NULL,
  `stk_value` varchar(100) DEFAULT NULL,
  `stk_mov_category` varchar(100) DEFAULT NULL,
  `stk_mov_docref` varchar(255) DEFAULT NULL,
  `stk_mov_status` varchar(100) DEFAULT NULL,
  `stk_mov_items` longtext,
  `stk_mov_notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_movement`
--

INSERT INTO `stock_movement` (`id`, `stk_mov_id`, `stk_mov_type`, `stk_mov_owner`, `stk_mov_req_date`, `stk_mov_location`, `stk_value`, `stk_mov_category`, `stk_mov_docref`, `stk_mov_status`, `stk_mov_items`, `stk_mov_notes`) VALUES
(1, 'STKMOV001', 'Inward', 'Bhairava', '2018-08-26', 'LOC004', '2596.00', 'CAT003', '1231', 'Open', '[{\"itemdetails\":\"[DAPL001] Preforms-1000ML\",\"itemcode\":\"1\",\"rwqty\":\"1\",\"tax_val\":\"18.00\",\"tax_type\":\"single\",\"tax_method\":\"0\",\"rwprice\":\"2200.00\",\"rwprice_org\":\"2200.00\",\"uom\":\"BX\",\"rwamt\":\"2200\",\"stock_value\":\"2200.00\"}]', '123123');

-- --------------------------------------------------------

--
-- Table structure for table `suppbank`
--

CREATE TABLE `suppbank` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `supcode` varchar(25) NOT NULL,
  `bankname` varchar(25) DEFAULT NULL,
  `acctno` varchar(20) NOT NULL,
  `acctname` varchar(40) NOT NULL,
  `acctype` varchar(20) NOT NULL,
  `branch` varchar(30) NOT NULL,
  `ifsc` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppbank`
--

INSERT INTO `suppbank` (`id`, `supcode`, `bankname`, `acctno`, `acctname`, `acctype`, `branch`, `ifsc`) VALUES
(001, 'DAPL/GST009/001', 'Indian', '12312312', 'dsfdsfsd', 'Savings', 'sdfsdf', '123324'),
(003, 'DAPL/GST3434342/003', 'Indian Bank', '121212', 'asdas`', 'Savings', 'sfdf', '21432423'),
(004, 'DAPL/1234567890/001', 'HDFC Bank', '1234567890', 'Hitesh Plastics', 'Savings', 'Vellore', '98999'),
(005, '00001', 'HDFC Bank', '1234567890', 'Capricord Food Produts', 'Current', 'Krishnagiri', 'HDFC9897001');

-- --------------------------------------------------------

--
-- Table structure for table `suptype`
--

CREATE TABLE `suptype` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `suptype` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suptype`
--

INSERT INTO `suptype` (`id`, `suptype`, `description`) VALUES
(001, 'Distributor', 'Distributor'),
(002, 'Material Supplier', 'Material Supplier'),
(003, 'Wholesaler', 'Wholesaler'),
(004, 'Retailer', 'Retailer');

-- --------------------------------------------------------

--
-- Table structure for table `taxmaster`
--

CREATE TABLE `taxmaster` (
  `id` int(3) NOT NULL,
  `prefix` varchar(10) DEFAULT NULL,
  `postfix` varchar(10) DEFAULT NULL,
  `taxname` varchar(100) NOT NULL,
  `description` varchar(40) NOT NULL,
  `taxtype` varchar(50) NOT NULL,
  `taxrate` decimal(10,2) NOT NULL,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taxmaster`
--

INSERT INTO `taxmaster` (`id`, `prefix`, `postfix`, `taxname`, `description`, `taxtype`, `taxrate`, `createdon`, `updatedon`) VALUES
(3, NULL, NULL, '5%GST', '', 'split', '5.00', '2018-08-25 00:32:42', '2018-08-25 00:32:42'),
(5, NULL, NULL, '18%(IGST)', '', 'single', '18.00', '2018-08-25 20:42:06', '2018-08-25 20:42:06'),
(6, NULL, NULL, '28%(GST)', '', 'split', '28.00', '2018-08-25 20:42:59', '2018-08-25 20:42:59'),
(7, NULL, NULL, '18%(GST)', '', 'split', '18.00', '2018-08-25 20:43:25', '2018-08-25 20:43:25'),
(9, NULL, NULL, '28%(IGST)', '', 'single', '28.00', '2018-08-25 20:44:40', '2018-08-25 20:44:40');

-- --------------------------------------------------------

--
-- Table structure for table `transportmaster`
--

CREATE TABLE `transportmaster` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `transname` varchar(40) NOT NULL,
  `vtype` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transportmaster`
--

INSERT INTO `transportmaster` (`id`, `transname`, `vtype`) VALUES
(001, 'ARC Parcel Services', 'Truck');

-- --------------------------------------------------------

--
-- Table structure for table `uom`
--

CREATE TABLE `uom` (
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
(45, 'OTH', 'Others'),
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
(45, 'OTH', 'Others'),
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

CREATE TABLE `uom_lookups` (
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
(45, 'OTH', 'Others'),
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
(45, 'OTH', 'Others'),
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
(45, 'OTH', 'Others'),
(0, 'CVR', 'COVER'),
(46, 'CVR', 'COVER'),
(46, 'CVR', 'COVER'),
(0, 'CVR', 'COVER');

-- --------------------------------------------------------

--
-- Table structure for table `usergroups`
--

CREATE TABLE `usergroups` (
  `id` int(11) UNSIGNED NOT NULL,
  `userid` int(11) UNSIGNED NOT NULL,
  `groupid` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `id` int(1) UNSIGNED NOT NULL,
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
  `validtill` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`id`, `userid`, `username`, `firstname`, `lastname`, `gender`, `useremail`, `userpassword`, `repass`, `mobile`, `address`, `groupname`, `compcode`, `status`, `image_name`, `image`, `emailverified`, `createdon`, `createdby`, `validtill`) VALUES
(1, 'DAPL001', 'Bhairava', 'Sri', 'Kalabhairava', '1', 'bhairava@gmail.com', '123456', '123', '2018-05-31', '', 'test', 'DAPL001', '1', 'upload/Saravana-LatestPhoto.jpg', '', '1', '2018-05-06 13:00:23', '', '0000-00-00 00:00:00'),
(2, 'DAPL002', 'raghu_6', 'Raghu', 'Prasad', '', 'raghu.j.prasad@gmail.com', 'test123', 'test123', '8150950300', '', '', '', '1', '', NULL, '0', '2018-08-13 08:10:19', NULL, '2018-08-13 08:10:19'),
(3, 'DAPL003', 'demo', 'eschoolz', 'Demo', '', 'eschoolz@gmail.com', '123456', '123456', '9677573737', '', '', '', '1', '', NULL, '0', '2018-08-14 05:47:28', NULL, '2018-08-14 05:47:28'),
(4, 'DAPL004', 'DAPL', 'Dhiraj Agro', 'Pvt. Ltd.,', '', 'rasaafactory@gmail.com', '123456', '123456', '9010389944', '', '', '', '1', '', NULL, '0', '2018-08-31 02:06:53', NULL, '2018-08-31 02:06:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
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
  `user_createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendorcredits`
--

CREATE TABLE `vendorcredits` (
  `id` int(10) NOT NULL,
  `v_credits_id` varchar(20) DEFAULT NULL,
  `v_credits_suptype` varchar(100) DEFAULT NULL,
  `v_credits_vendorid` varchar(10) DEFAULT NULL,
  `v_credits_paymentmode` varchar(255) DEFAULT NULL,
  `v_credits_refno` varchar(100) DEFAULT NULL,
  `v_credits_paymentdate` varchar(10) DEFAULT NULL,
  `v_credits_amount` decimal(10,2) DEFAULT NULL,
  `v_credits_availcredits` decimal(10,2) DEFAULT NULL,
  `v_credits_handler` varchar(100) DEFAULT NULL,
  `v_credits_notes` varchar(255) DEFAULT NULL,
  `v_credits_image` varchar(155) DEFAULT NULL,
  `v_credits_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `v_credits_email_notification` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendorcredits_log`
--

CREATE TABLE `vendorcredits_log` (
  `id` int(10) NOT NULL,
  `creditrefno` varchar(50) NOT NULL,
  `vendorid` varchar(50) NOT NULL,
  `oldcredits` decimal(10,2) NOT NULL,
  `newcredits` decimal(10,2) NOT NULL,
  `dateofpayment` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `handler` varchar(100) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `image` varchar(155) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendorcredits_log`
--

INSERT INTO `vendorcredits_log` (`id`, `creditrefno`, `vendorid`, `oldcredits`, `newcredits`, `dateofpayment`, `handler`, `notes`, `image`) VALUES
(1, 'CN-00012', 'DAPL002Hitesh Plastics Pvt. Ltd', '567.00', '0.00', '2018-05-28 00:00:00', 'Bhairava', 'dfgdfg', 'upload/'),
(2, 'CN-00013', 'DAPL002Hitesh Plastics Pvt. Ltd', '567.00', '0.00', '2018-05-28 00:00:00', 'Bhairava', 'dfgdfg', 'upload/'),
(3, 'CN-00014', 'DAPL002Hitesh Plastics Pvt. Ltd', '567.00', '0.00', '2018-05-28 00:00:00', 'Bhairava', 'dfgdfg', 'upload/'),
(4, 'CN-00015', 'DAPL002Hitesh Plastics Pvt. Ltd', '567.00', '0.00', '2018-05-28 00:00:00', 'Bhairava', 'dfgdfg', 'upload/');

-- --------------------------------------------------------

--
-- Table structure for table `vendorprofile`
--

CREATE TABLE `vendorprofile` (
  `id` int(3) UNSIGNED ZEROFILL NOT NULL,
  `vendorid` varchar(50) NOT NULL,
  `vendor_opening_bal` varchar(100) DEFAULT NULL,
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
  `openbalance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `obasofdate` date DEFAULT NULL,
  `createdon` datetime DEFAULT CURRENT_TIMESTAMP,
  `createdby` varchar(100) DEFAULT NULL,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedby` varchar(100) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT '1',
  `handler` varchar(100) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendorprofile`
--

INSERT INTO `vendorprofile` (`id`, `vendorid`, `vendor_opening_bal`, `prefix`, `postfix`, `title`, `supname`, `portal`, `suptype`, `blocation`, `industry`, `address`, `city`, `country`, `state`, `zip`, `workphone`, `mobile`, `email`, `web`, `gstin`, `gstregdate`, `openbalance`, `obasofdate`, `createdon`, `createdby`, `updatedon`, `updatedby`, `status`, `handler`, `notes`) VALUES
(006, '00001', '290752', 'DAPL', '/', 'MS.', 'Hitesh Plastics Pvt Ltd.,', NULL, 'Distributor', 'Maharashtra', NULL, '206, Acme Indl. Park,  Off. I.B. Patel Rd, Goregaon (E)', 'Mumbai', 'IN', 'MH', '400 063', '', '967787777', 'hitesh@gmail.com', '', '37AAECD0073D1Z3', NULL, '0.00', '2018-09-02', '2018-08-17 14:20:12', NULL, '2018-08-17 14:20:12', NULL, '1', 'Bhairava', ''),
(008, '00007', NULL, 'DAPL', '/', 'M/S.', 'Meghana Plastics', NULL, 'Distributor', 'Tamil Nadu', NULL, '125-4, T r Naagr', 'Bargur', 'IN', 'TN', '767677', '', '9677574747', 'meghana@gmail.com', '', '12312312432432423', NULL, '0.00', NULL, '2018-09-01 23:59:30', NULL, '2018-09-01 23:59:30', NULL, '1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_refund`
--

CREATE TABLE `vendor_refund` (
  `id` int(10) NOT NULL,
  `v_refund_id` varchar(20) DEFAULT NULL,
  `v_refund_creditsid` varchar(20) DEFAULT NULL,
  `v_refund_refno` varchar(100) DEFAULT NULL,
  `v_refund_paymentmode` varchar(255) DEFAULT NULL,
  `v_refund_paymentdate` varchar(10) DEFAULT NULL,
  `v_refund_amount` decimal(10,2) DEFAULT NULL,
  `v_refund_handler` varchar(100) DEFAULT NULL,
  `v_refund_notes` varchar(255) DEFAULT NULL,
  `v_refund_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(10) NOT NULL,
  `location_id` varchar(20) NOT NULL,
  `warehousename` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `location_id`, `warehousename`, `description`) VALUES
(2, 'LOC001', 'Raw Material Store', 'Raw Material Store'),
(3, 'LOC003', 'Production Center', 'Production Center'),
(4, 'LOC004', 'Export Store', 'Export Store');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bankdeposit`
--
ALTER TABLE `bankdeposit`
  ADD UNIQUE KEY `depost` (`id`);

--
-- Indexes for table `cashmemos`
--
ALTER TABLE `cashmemos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `compbank`
--
ALTER TABLE `compbank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comprofile`
--
ALTER TABLE `comprofile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `creditnotes`
--
ALTER TABLE `creditnotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customerprofile`
--
ALTER TABLE `customerprofile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_payments`
--
ALTER TABLE `customer_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custype`
--
ALTER TABLE `custype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `debitnotes`
--
ALTER TABLE `debitnotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `estimates`
--
ALTER TABLE `estimates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenseacctmaster`
--
ALTER TABLE `expenseacctmaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expensenoteslog`
--
ALTER TABLE `expensenoteslog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grn_notes`
--
ALTER TABLE `grn_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemcategory`
--
ALTER TABLE `itemcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentterm`
--
ALTER TABLE `paymentterm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseitemaster`
--
ALTER TABLE `purchaseitemaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseitemlog`
--
ALTER TABLE `purchaseitemlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchaseorders`
--
ALTER TABLE `purchaseorders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purpricemaster`
--
ALTER TABLE `purpricemaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recordexpense`
--
ALTER TABLE `recordexpense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salesitemaster`
--
ALTER TABLE `salesitemaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salesitemaster2`
--
ALTER TABLE `salesitemaster2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salesitemlog`
--
ALTER TABLE `salesitemlog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salesorders`
--
ALTER TABLE `salesorders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_movement`
--
ALTER TABLE `stock_movement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppbank`
--
ALTER TABLE `suppbank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suptype`
--
ALTER TABLE `suptype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxmaster`
--
ALTER TABLE `taxmaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transportmaster`
--
ALTER TABLE `transportmaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usergroups`
--
ALTER TABLE `usergroups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_name`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `vendorcredits`
--
ALTER TABLE `vendorcredits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendorcredits_log`
--
ALTER TABLE `vendorcredits_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendorprofile`
--
ALTER TABLE `vendorprofile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_refund`
--
ALTER TABLE `vendor_refund`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bankdeposit`
--
ALTER TABLE `bankdeposit`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cashmemos`
--
ALTER TABLE `cashmemos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compbank`
--
ALTER TABLE `compbank`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comprofile`
--
ALTER TABLE `comprofile`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `creditnotes`
--
ALTER TABLE `creditnotes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customerprofile`
--
ALTER TABLE `customerprofile`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_payments`
--
ALTER TABLE `customer_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `custype`
--
ALTER TABLE `custype`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `debitnotes`
--
ALTER TABLE `debitnotes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `estimates`
--
ALTER TABLE `estimates`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expenseacctmaster`
--
ALTER TABLE `expenseacctmaster`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `expensenoteslog`
--
ALTER TABLE `expensenoteslog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `grn_notes`
--
ALTER TABLE `grn_notes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `itemcategory`
--
ALTER TABLE `itemcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(2) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paymentterm`
--
ALTER TABLE `paymentterm`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `purchaseitemaster`
--
ALTER TABLE `purchaseitemaster`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchaseitemlog`
--
ALTER TABLE `purchaseitemlog`
  MODIFY `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `purchaseorders`
--
ALTER TABLE `purchaseorders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `purpricemaster`
--
ALTER TABLE `purpricemaster`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `recordexpense`
--
ALTER TABLE `recordexpense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salesitemaster`
--
ALTER TABLE `salesitemaster`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salesitemaster2`
--
ALTER TABLE `salesitemaster2`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `salesitemlog`
--
ALTER TABLE `salesitemlog`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `salesorders`
--
ALTER TABLE `salesorders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_movement`
--
ALTER TABLE `stock_movement`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppbank`
--
ALTER TABLE `suppbank`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suptype`
--
ALTER TABLE `suptype`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `taxmaster`
--
ALTER TABLE `taxmaster`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transportmaster`
--
ALTER TABLE `transportmaster`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `usergroups`
--
ALTER TABLE `usergroups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `id` int(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendorcredits`
--
ALTER TABLE `vendorcredits`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendorcredits_log`
--
ALTER TABLE `vendorcredits_log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendorprofile`
--
ALTER TABLE `vendorprofile`
  MODIFY `id` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vendor_refund`
--
ALTER TABLE `vendor_refund`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
