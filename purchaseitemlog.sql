-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 15, 2018 at 10:40 AM
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
-- Table structure for table `purchaseitemlog`
--

DROP TABLE IF EXISTS `purchaseitemlog`;
CREATE TABLE IF NOT EXISTS `purchaseitemlog` (
  `id` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT,
  `logid` varchar(20) DEFAULT NULL,
  `itemcode` varchar(50) NOT NULL,
  `itemname` varchar(100) NOT NULL,
  `oldpriceqty` decimal(10,1) DEFAULT NULL,
  `newpriceqty` decimal(10,1) NOT NULL,
  `oldpriceuom` decimal(10,1) DEFAULT NULL,
  `newpriceuom` decimal(10,1) NOT NULL,
  `notes` varchar(500) NOT NULL,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` varchar(100) NOT NULL,
  `updatedby` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaseitemlog`
--

INSERT INTO `purchaseitemlog` (`id`, `logid`, `itemcode`, `itemname`, `oldpriceqty`, `newpriceqty`, `oldpriceuom`, `newpriceuom`, `notes`, `updatedon`, `createdon`, `createdby`, `updatedby`) VALUES
(0001, '', '', 'Bottles', '1.0', '0.0', '1.0', '0.0', 'dfdsfs', '0000-00-00 00:00:00', '2018-12-01 00:00:00', 'demo', ''),
(0002, '', '', '', '1.0', '0.0', '1.0', '0.0', 'dfdsfs', '0000-00-00 00:00:00', '2018-12-01 00:00:00', 'demo', ''),
(0003, '', '', 'g', '1.0', '0.0', '1.0', '0.0', 'dsfdsg', '0000-00-00 00:00:00', '0017-01-01 00:00:00', 'demo', ''),
(0004, '', '', 'demo', '0.0', '1.0', '0.0', '1.0', 'adaf', '0000-00-00 00:00:00', '2000-01-01 00:00:00', 'demo', ''),
(0005, '', '', 'fsdms', '0.0', '1.0', '0.0', '1.0', 'asdsad', '0000-00-00 00:00:00', '2011-01-01 00:00:00', 'Janessha', ''),
(0006, '', '', 'asjaneshh', '0.0', '1.0', '0.0', '1.0', 'dfdsfdsfs', '0000-00-00 00:00:00', '2019-12-01 00:00:00', 'Janessha', ''),
(0007, '', '', '500ML Bottle', '0.0', '1.0', '0.0', '1.0', 'Log table issues Solved', '0000-00-00 00:00:00', '2012-01-01 00:00:00', 'Janessha', ''),
(0008, '', 'DAPL500ML/007', '500ML Bottle', '0.0', '1.0', '0.0', '1.0', ' Supplier Name has been edited', '2012-01-01 00:00:00', '2018-04-11 16:32:30', '', 'demo'),
(0009, '', 'DAPL500ML/007', '500ML Bottle', '0.0', '1.0', '0.0', '1.0', ' suppliet Hitesh', '2012-01-01 00:00:00', '2018-04-11 16:33:47', '', 'demo'),
(0010, '', 'DAPL500ML/007', '500ML Bottle', '0.0', '1.0', '0.0', '1.0', ' changed to meghana', '2012-01-01 00:00:00', '2018-04-11 16:34:50', '', 'demo'),
(0011, '', 'DAPL500ML/007', '500ML Bottle', '0.0', '1.0', '0.0', '1.0', ' meghu', '2012-01-01 00:00:00', '2018-04-11 16:36:42', '', 'demo'),
(0012, '', 'DAPL500ML/007', '500ML Bottle', '0.0', '1.0', '0.0', '1.0', ' meghu', '2012-01-01 00:00:00', '2018-04-11 16:36:42', '', 'demo'),
(0013, '', '', 'Demo', '0.0', '0.0', '0.0', '11.0', 'sdsadsa', '0000-00-00 00:00:00', '2019-01-02 00:00:00', 'demo3', ''),
(0014, '', '', 'jj', '0.0', '4.0', '0.0', '4.0', 'kkkk', '0000-00-00 00:00:00', '2000-04-04 00:00:00', 'Janessha', ''),
(0015, '', '', 'Plastics', '0.0', '11.0', '0.0', '11.0', 'sadsd', '0000-00-00 00:00:00', '1999-12-12 00:00:00', 'Janessha', ''),
(0016, '', '', 'gg', '0.0', '1.0', '0.0', '1.0', 'hhh', '0000-00-00 00:00:00', '2000-11-11 00:00:00', 'Select Username', ''),
(0017, '', '', 'gg', '0.0', '1.0', '0.0', '1.0', 'hhh', '0000-00-00 00:00:00', '2000-11-11 00:00:00', 'Select Username', ''),
(0018, '', '', '', '0.0', '0.0', '0.0', '0.0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Select Username', ''),
(0019, '', '', '', '0.0', '0.0', '0.0', '0.0', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Select Username', ''),
(0020, '', '', 'sadsa', '0.0', '11.0', '0.0', '21312.0', 'sadsa', '0000-00-00 00:00:00', '2018-04-11 00:00:00', 'Select Username', ''),
(0021, NULL, 'DAPL10', 'adgagg', NULL, '1.0', NULL, '1.0', 'dafdsfds', '2018-04-15 15:44:40', '2019-02-02 00:00:00', 'Bhairava', NULL),
(0022, NULL, 'DAPL11', '35LTRS', NULL, '10.0', NULL, '10.0', 'Item added by Bhairava', '2018-04-15 15:45:48', '2018-01-31 00:00:00', 'Bhairava', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
