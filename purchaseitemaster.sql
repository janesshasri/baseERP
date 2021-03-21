-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 15, 2018 at 10:39 AM
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
-- Table structure for table `purchaseitemaster`
--

DROP TABLE IF EXISTS `purchaseitemaster`;
CREATE TABLE IF NOT EXISTS `purchaseitemaster` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `prefix` varchar(30) NOT NULL DEFAULT 'DAPL00',
  `postfix` varchar(30) NOT NULL DEFAULT 'DAPL001',
  `itemcode` varchar(100) NOT NULL,
  `itemname` varchar(50) NOT NULL,
  `vendor` varchar(255) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT '1',
  `priceperqty` decimal(10,1) NOT NULL,
  `priceperuom` decimal(10,1) NOT NULL,
  `taxmethod` varchar(20) NOT NULL DEFAULT '0',
  `taxrate` decimal(10,1) NOT NULL,
  `pricedatefrom` date NOT NULL,
  `stockinqty` int(20) NOT NULL,
  `stockinuom` int(20) NOT NULL,
  `reorderlevel` varchar(30) NOT NULL,
  `qtyondemand` varchar(30) NOT NULL,
  `usageunit` varchar(30) DEFAULT NULL,
  `handler` varchar(30) NOT NULL,
  `description` varchar(100) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `notes` varchar(255) NOT NULL,
  `updatedon` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(155) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchaseitemaster`
--

INSERT INTO `purchaseitemaster` (`id`, `prefix`, `postfix`, `itemcode`, `itemname`, `vendor`, `status`, `priceperqty`, `priceperuom`, `taxmethod`, `taxrate`, `pricedatefrom`, `stockinqty`, `stockinuom`, `reorderlevel`, `qtyondemand`, `usageunit`, `handler`, `description`, `category`, `notes`, `updatedon`, `image`) VALUES
(4, 'DAPL00', 'DAPL001', 'DAPL001', 'adgagg', 'M/S. Hitesh Plastics', '1', '1.0', '1.0', '1', '12.5', '2019-02-02', 1, 1, '1', '1', NULL, 'Bhairava', 'ssss', NULL, 'dafdsfds', '2018-04-15 15:40:21', NULL),
(5, 'DAPL00', 'DAPL001', 'DAPL5', 'adgagg', 'M/S. Hitesh Plastics', '1', '1.0', '1.0', '1', '12.5', '2019-02-02', 1, 1, '1', '1', NULL, 'Bhairava', 'ssss', NULL, 'dafdsfds', '2018-04-15 15:41:36', NULL),
(6, 'DAPL00', 'DAPL001', 'DAPL6', 'adgagg', 'M/S. Hitesh Plastics', '1', '1.0', '1.0', '1', '12.5', '2019-02-02', 1, 1, '1', '1', NULL, 'Bhairava', 'ssss', NULL, 'dafdsfds', '2018-04-15 15:42:45', NULL),
(7, 'DAPL00', 'DAPL001', 'DAPL7', 'adgagg', 'M/S. Hitesh Plastics', '1', '1.0', '1.0', '1', '12.5', '2019-02-02', 1, 1, '1', '1', NULL, 'Bhairava', 'ssss', NULL, 'dafdsfds', '2018-04-15 15:43:21', NULL),
(8, 'DAPL00', 'DAPL001', 'DAPL8', 'adgagg', 'M/S. Hitesh Plastics', '1', '1.0', '1.0', '1', '12.5', '2019-02-02', 1, 1, '1', '1', NULL, 'Bhairava', 'ssss', NULL, 'dafdsfds', '2018-04-15 15:43:46', NULL),
(9, 'DAPL00', 'DAPL001', 'DAPL9', 'adgagg', 'M/S. Hitesh Plastics', '1', '1.0', '1.0', '1', '12.5', '2019-02-02', 1, 1, '1', '1', NULL, 'Bhairava', 'ssss', NULL, 'dafdsfds', '2018-04-15 15:44:14', NULL),
(10, 'DAPL00', 'DAPL001', 'DAPL10', 'adgagg', 'M/S. Hitesh Plastics', '1', '1.0', '1.0', '1', '12.5', '2019-02-02', 1, 1, '1', '1', NULL, 'Bhairava', 'ssss', NULL, 'dafdsfds', '2018-04-15 15:44:40', NULL),
(11, 'DAPL00', 'DAPL001', 'DAPL11', '35LTRS', 'M/S. Hitesh Plastics', '1', '10.0', '10.0', '0', '0.0', '2018-01-31', 10, 10, '10', '10', NULL, 'Bhairava', '35LTRS', NULL, 'Item added by Bhairava', '2018-04-15 15:45:48', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
