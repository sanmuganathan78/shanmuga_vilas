-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.27 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table shanmuga_vilas.additem
CREATE TABLE IF NOT EXISTS `additem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `uom` varchar(255) DEFAULT NULL,
  `hsnno` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `taxtype` varchar(225) DEFAULT NULL,
  `sgst` varchar(255) DEFAULT NULL,
  `cgst` varchar(255) DEFAULT NULL,
  `igst` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `priceType` varchar(10) NOT NULL,
  `itemtype` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.additem: ~11 rows (approximately)
/*!40000 ALTER TABLE `additem` DISABLE KEYS */;
INSERT INTO `additem` (`id`, `date`, `uom`, `hsnno`, `itemname`, `price`, `taxtype`, `sgst`, `cgst`, `igst`, `status`, `priceType`, `itemtype`) VALUES
	(1, '2019-02-22', '2', '0', 'teak wood', '1000', '1', '6', '6', '12', '1', 'Exclusive', ''),
	(2, '2019-02-22', '1', '23454', 'gtv body paatern', '23000', '1', '6', '6', '12', '1', 'Exclusive', ''),
	(3, '2019-02-22', '2', '101', 'Grap Board', '150', '1', '6', '6', '12', '1', 'Exclusive', ''),
	(4, '2019-02-22', '1', '1503', 'Chart card', '0', '1', '6', '6', '12', '1', 'Exclusive', ''),
	(5, '2019-02-25', '3', '0', 'bio power 100', '100', '1', '6', '6', '12', '1', 'Exclusive', ''),
	(6, '2019-03-01', '2', '0', 'bio gas', '0', '1', '6', '6', '12', '1', 'Exclusive', ''),
	(7, '2019-03-21', '1', '452', 'Tissues Paper', '150', '1', '6', '6', '12', '1', 'Exclusive', ''),
	(8, '2019-03-21', '1', '6510', 'fliter paper', '0', '1', '6', '6', '12', '1', 'Exclusive', ''),
	(9, '2019-03-29', '5', '8414', 'Sullube Oil - 250025-669', '26681', '4', '9', '9', '18', '1', 'Exclusive', ''),
	(10, '2019-06-05', '1', '0', 'WATER BOTTEL', '50', '1', '6', '6', '12', '1', 'Exclusive', ''),
	(11, '2019-06-14', '7', '1254', 'Pos Device', '5000', '6', '15', '15', '30', '1', 'Exclusive', '');
/*!40000 ALTER TABLE `additem` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.backup_details
CREATE TABLE IF NOT EXISTS `backup_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` longtext,
  `date_created` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.backup_details: ~0 rows (approximately)
/*!40000 ALTER TABLE `backup_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `backup_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.bed_details
CREATE TABLE IF NOT EXISTS `bed_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `bed` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.bed_details: ~0 rows (approximately)
/*!40000 ALTER TABLE `bed_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `bed_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.card
CREATE TABLE IF NOT EXISTS `card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.card: ~2 rows (approximately)
/*!40000 ALTER TABLE `card` DISABLE KEYS */;
INSERT INTO `card` (`id`, `name`, `date`, `status`) VALUES
	(1, 'Credit Card', '0000-00-00', 1),
	(2, 'Debit Card', '0000-00-00', 1);
/*!40000 ALTER TABLE `card` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.cashbill_details
CREATE TABLE IF NOT EXISTS `cashbill_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(225) DEFAULT NULL,
  `cust_mobno` varchar(255) NOT NULL,
  `address` varchar(225) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `hsnno` longtext,
  `itemname` longtext,
  `uom` longtext,
  `rate` longtext,
  `qty` longtext,
  `amount` longtext,
  `discount` longtext,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightamount` varchar(225) DEFAULT NULL,
  `freightcgst` varchar(225) DEFAULT NULL,
  `freightcgstamount` varchar(225) DEFAULT NULL,
  `freightsgst` varchar(225) DEFAULT NULL,
  `freightsgstamount` varchar(225) DEFAULT NULL,
  `freightigst` varchar(255) NOT NULL,
  `freightigstamount` varchar(225) DEFAULT NULL,
  `freighttotal` varchar(225) DEFAULT NULL,
  `loadingamount` varchar(225) DEFAULT NULL,
  `loadingcgst` varchar(225) DEFAULT NULL,
  `loadingcgstamount` varchar(225) DEFAULT NULL,
  `loadingsgst` varchar(225) DEFAULT NULL,
  `loadingsgstamount` varchar(225) DEFAULT NULL,
  `loadingigst` varchar(225) DEFAULT NULL,
  `loadingigstamount` varchar(225) DEFAULT NULL,
  `loadingtotal` varchar(225) DEFAULT NULL,
  `roundOff` varchar(255) NOT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `invoicenodate` varchar(225) DEFAULT NULL,
  `invoicenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL,
  `systemDate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.cashbill_details: ~9 rows (approximately)
/*!40000 ALTER TABLE `cashbill_details` DISABLE KEYS */;
INSERT INTO `cashbill_details` (`id`, `date`, `invoicedate`, `invoiceno`, `customerId`, `customername`, `cust_mobno`, `address`, `gsttype`, `typesgst`, `typecgst`, `typeigst`, `hsnno`, `itemname`, `uom`, `rate`, `qty`, `amount`, `discount`, `discountBy`, `discountamount`, `taxableamount`, `sgst`, `sgstamount`, `cgst`, `cgstamount`, `igst`, `igstamount`, `total`, `subtotal`, `freightamount`, `freightcgst`, `freightcgstamount`, `freightsgst`, `freightsgstamount`, `freightigst`, `freightigstamount`, `freighttotal`, `loadingamount`, `loadingcgst`, `loadingcgstamount`, `loadingsgst`, `loadingsgstamount`, `loadingigst`, `loadingigstamount`, `loadingtotal`, `roundOff`, `othercharges`, `return_status`, `grandtotal`, `invoicenodate`, `invoicenoyear`, `status`, `edit_status`, `systemDate`) VALUES
	(2, '2019-06-05', '2019-06-05', '', 2, 'cash', '', '', 'intrastate', 'sgst', 'cgst', '', '0', 'WATER BOTTEL', 'nos', '50', '4', '200.00', '0', 'percent_wise', '0.00', '200.00', '6', '12.00', '6', '12.00', '12', '0', '224.00', '224.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '224.00', '050619', '-2019', 1, 1, '0000-00-00'),
	(3, '2019-08-01', '2019-08-01', '1', 3, '', '', '', NULL, NULL, NULL, NULL, NULL, 'Grap Board', 'kgs', '150', '1', '150.00', '0', 'percent_wise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '150.00', '150.00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, '150.00', '1010819', '1-2019', 1, 1, '0000-00-00'),
	(4, '2019-08-01', '2019-08-01', '2', 4, 'cash', '9876543210', '', NULL, NULL, NULL, NULL, NULL, 'gtv body paatern', 'nos', '23000', '1', '20700.00', '10', 'percent_wise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '20700.00', '20700.00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, '20700.00', '2010819', '2-2019', 1, 1, '0000-00-00'),
	(5, '2019-08-01', '2019-08-01', '3', 5, '', '', '', NULL, NULL, NULL, NULL, NULL, 'bio gas||Grap Board', 'kgs||kgs', '0||150', '1||1', '0.00||150.00', '0||0', 'percent_wise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0.00||150.00', '150.00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, '150.00', '3010819', '3-2019', 1, 1, '0000-00-00'),
	(6, '2019-08-03', '2019-08-03', '4', 6, '', '', '', NULL, NULL, NULL, NULL, NULL, 'bio power 100', 'ltr', '100', '1', NULL, '0', 'percent_wise', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '100.00', '150.00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, '150.00', '4030819', '4-2019', 1, 1, '0000-00-00'),
	(7, '2019-08-03', '2019-08-03', '5', 7, '', '', '', NULL, NULL, NULL, NULL, NULL, 'teak wood', 'kgs', '1000', '7', NULL, '0', 'percent_wise', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7000.00', '7000.00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, '7000.00', '5030819', '5-2019', 1, 1, '0000-00-00'),
	(8, '2019-08-03', '2019-08-03', '6', 8, '', '', '', NULL, NULL, NULL, NULL, NULL, 'Sullube Oil - 250025-669||teak wood', 'Pail||kgs', '26681||1000', '13||5', NULL, '0', 'percent_wise', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '346853.00||5000.00', '351853.00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, '351853.00', '6030819', '6-2019', 1, 1, '0000-00-00'),
	(9, '2019-08-03', '2019-08-03', '7', 9, '', '', '', NULL, NULL, NULL, NULL, NULL, 'teak wood', 'kgs', '1000', '.50', NULL, '0', 'percent_wise', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '500.00', '500.00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, '500.00', '7030819', '7-2019', 1, 1, '0000-00-00'),
	(10, '2019-08-03', '2019-08-03', '8', 10, '', '', '', NULL, NULL, NULL, NULL, NULL, 'teak wood', 'kgs', '1000', '.750', NULL, '0', 'percent_wise', '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '750.00', '750.00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, '750.00', '8030819', '8-2019', 1, 1, '0000-00-00');
/*!40000 ALTER TABLE `cashbill_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.cashbill_reports
CREATE TABLE IF NOT EXISTS `cashbill_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `systemDate` date DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `invoicedate` varchar(255) DEFAULT NULL,
  `paymenttype` varchar(255) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(255) DEFAULT NULL,
  `mobileno` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gsttype` varchar(255) DEFAULT NULL,
  `hsnno` varchar(255) DEFAULT NULL,
  `itemno` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `totalamount` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `disamount` varchar(255) DEFAULT NULL,
  `grandtotal` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `invoicenoyear` varchar(255) DEFAULT NULL,
  `invoicenodate` varchar(255) DEFAULT NULL,
  `invoiceid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.cashbill_reports: ~11 rows (approximately)
/*!40000 ALTER TABLE `cashbill_reports` DISABLE KEYS */;
INSERT INTO `cashbill_reports` (`id`, `date`, `systemDate`, `invoiceno`, `invoicedate`, `paymenttype`, `customerId`, `customername`, `mobileno`, `address`, `gsttype`, `hsnno`, `itemno`, `itemname`, `rate`, `qty`, `total`, `totalamount`, `subtotal`, `discount`, `disamount`, `grandtotal`, `paid`, `balance`, `status`, `invoicenoyear`, `invoicenodate`, `invoiceid`) VALUES
	(2, '0000-00-00', '2019-06-05', '', '2019-06-05', NULL, 0, 'cash', '', '', 'intrastate', '0', NULL, 'WATER BOTTEL', '50', '4', '224.00', NULL, '224.00', NULL, NULL, '224.00', NULL, NULL, '1', '-2019', '050619', '2'),
	(3, '0000-00-00', '2019-08-01', '1', '2019-08-01', NULL, 0, '', '', NULL, NULL, NULL, NULL, 'Grap Board', '150', '1', '150.00', NULL, '150.00', NULL, NULL, '150.00', NULL, NULL, '1', '1-2019', '1010819', '3'),
	(4, '0000-00-00', '2019-08-01', '2', '2019-08-01', NULL, 0, 'cash', '9876543210', NULL, NULL, NULL, NULL, 'gtv body paatern', '23000', '1', '20700.00', NULL, '20700.00', NULL, NULL, '20700.00', NULL, NULL, '1', '2-2019', '2010819', '4'),
	(5, '0000-00-00', '2019-08-01', '3', '2019-08-01', NULL, 0, '', '', NULL, NULL, NULL, NULL, 'bio gas', '0', '1', '0.00', NULL, '150.00', NULL, NULL, '150.00', NULL, NULL, '1', '3-2019', '3010819', '5'),
	(6, '0000-00-00', '2019-08-01', '3', '2019-08-01', NULL, 0, '', '', NULL, NULL, NULL, NULL, 'Grap Board', '150', '1', '150.00', NULL, '150.00', NULL, NULL, '150.00', NULL, NULL, '1', '3-2019', '3010819', '5'),
	(7, '0000-00-00', '2019-08-03', '4', '2019-08-03', NULL, 0, '', '', NULL, NULL, NULL, NULL, 'bio power 100', '100', '1', '100.00', NULL, '150.00', NULL, NULL, '150.00', NULL, NULL, '1', '4-2019', '4030819', '6'),
	(8, '0000-00-00', '2019-08-03', '5', '2019-08-03', NULL, 0, '', '', NULL, NULL, NULL, NULL, 'teak wood', '1000', '7', '7000.00', NULL, '7000.00', NULL, NULL, '7000.00', NULL, NULL, '1', '5-2019', '5030819', '7'),
	(9, '0000-00-00', '2019-08-03', '6', '2019-08-03', NULL, 0, '', '', NULL, NULL, NULL, NULL, 'Sullube Oil - 250025-669', '26681', '13', '346853.00', NULL, '351853.00', NULL, NULL, '351853.00', NULL, NULL, '1', '6-2019', '6030819', '8'),
	(10, '0000-00-00', '2019-08-03', '6', '2019-08-03', NULL, 0, '', '', NULL, NULL, NULL, NULL, 'teak wood', '1000', '5', '5000.00', NULL, '351853.00', NULL, NULL, '351853.00', NULL, NULL, '1', '6-2019', '6030819', '8'),
	(11, '0000-00-00', '2019-08-03', '7', '2019-08-03', NULL, 0, '', '', NULL, NULL, NULL, NULL, 'teak wood', '1000', '.50', '500.00', NULL, '500.00', NULL, NULL, '500.00', NULL, NULL, '1', '7-2019', '7030819', '9'),
	(12, '0000-00-00', '2019-08-03', '8', '2019-08-03', NULL, 0, '', '', NULL, NULL, NULL, NULL, 'teak wood', '1000', '.750', '750.00', NULL, '750.00', NULL, NULL, '750.00', NULL, NULL, '1', '8-2019', '8030819', '10');
/*!40000 ALTER TABLE `cashbill_reports` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.cash_bill
CREATE TABLE IF NOT EXISTS `cash_bill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `orderno` varchar(255) DEFAULT NULL,
  `orderdate` date DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `invoicetype` varchar(225) DEFAULT NULL,
  `dcno` longtext,
  `customername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `deliveryat` varchar(225) DEFAULT NULL,
  `transportmode` varchar(255) DEFAULT NULL,
  `vehicleno` varchar(225) DEFAULT NULL,
  `billtype` varchar(255) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `dcnos` longtext,
  `insertid` varchar(225) DEFAULT NULL,
  `deliveryid` longtext,
  `hsnno` longtext,
  `itemname` longtext,
  `uom` longtext,
  `rate` longtext,
  `qty` longtext,
  `amount` longtext,
  `discount` longtext,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightcharges` varchar(225) DEFAULT NULL,
  `packingcharges` varchar(225) DEFAULT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `invoicenodate` varchar(225) DEFAULT NULL,
  `invoicenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.cash_bill: ~0 rows (approximately)
/*!40000 ALTER TABLE `cash_bill` DISABLE KEYS */;
/*!40000 ALTER TABLE `cash_bill` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `category` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table shanmuga_vilas.category: ~0 rows (approximately)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.collection_details
CREATE TABLE IF NOT EXISTS `collection_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `receiptdate` date DEFAULT NULL,
  `throughcheck` varchar(255) DEFAULT NULL,
  `receiptno` varchar(255) DEFAULT NULL,
  `customername` varchar(255) DEFAULT NULL,
  `mobileno` varchar(255) DEFAULT NULL,
  `totalamount` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `alreadypaid` varchar(255) DEFAULT NULL,
  `alreadybalance` varchar(255) DEFAULT NULL,
  `chamount` varchar(255) DEFAULT NULL,
  `banktransfer` varchar(255) DEFAULT NULL,
  `bankamount` varchar(255) DEFAULT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `paymentmode` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `paymentdetails` varchar(255) DEFAULT NULL,
  `overallamount` varchar(255) DEFAULT NULL,
  `receiptamt` varchar(255) DEFAULT NULL,
  `invoiceamt` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `invoicenoyear` varchar(255) DEFAULT NULL,
  `invoicenodate` varchar(255) DEFAULT NULL,
  `invoiceid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.collection_details: ~4 rows (approximately)
/*!40000 ALTER TABLE `collection_details` DISABLE KEYS */;
INSERT INTO `collection_details` (`id`, `date`, `invoicedate`, `receiptdate`, `throughcheck`, `receiptno`, `customername`, `mobileno`, `totalamount`, `purpose`, `alreadypaid`, `alreadybalance`, `chamount`, `banktransfer`, `bankamount`, `chequeno`, `paymentmode`, `amount`, `invoiceno`, `balance`, `status`, `paymentdetails`, `overallamount`, `receiptamt`, `invoiceamt`, `payment`, `paid`, `invoicenoyear`, `invoicenodate`, `invoiceid`) VALUES
	(1, '2019-06-05', NULL, '2019-06-05', NULL, 'R', 'Ragul kumar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'Cash', NULL, NULL, NULL, NULL, '50000', NULL, NULL, NULL),
	(2, '2019-06-05', NULL, '2019-06-05', NULL, 'R1', 'Ragul kumar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'Cheque SOUTH INDIAN 00000', NULL, NULL, NULL, NULL, '25000', NULL, NULL, NULL),
	(3, '2019-06-14', NULL, '2019-06-14', NULL, 'R2', 'Ramesh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'Cash', NULL, NULL, NULL, NULL, '10000', NULL, NULL, NULL),
	(4, '2019-06-28', NULL, '2019-06-28', NULL, 'R3', 'Karikaliamman Spinning Mills Pvt Ltd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', 'Cheque INDIAN BANK 2222222', NULL, NULL, NULL, NULL, '50000', NULL, NULL, NULL);
/*!40000 ALTER TABLE `collection_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.company_logo
CREATE TABLE IF NOT EXISTS `company_logo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.company_logo: ~1 rows (approximately)
/*!40000 ALTER TABLE `company_logo` DISABLE KEYS */;
INSERT INTO `company_logo` (`id`, `date`, `image`, `status`) VALUES
	(1, '2017-12-27', 'images.png', '1');
/*!40000 ALTER TABLE `company_logo` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.customerpo_details
CREATE TABLE IF NOT EXISTS `customerpo_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `pono` varchar(255) DEFAULT NULL,
  `cuspodate` date DEFAULT NULL,
  `invoicetype` varchar(255) DEFAULT NULL,
  `paymenttype` varchar(255) DEFAULT NULL,
  `customername` varchar(255) DEFAULT NULL,
  `cuspono` varchar(255) DEFAULT NULL,
  `transport` varchar(255) DEFAULT NULL,
  `customerpodate` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `itemno` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `disamount` varchar(255) DEFAULT NULL,
  `taxname` varchar(255) DEFAULT NULL,
  `taxamount` varchar(255) DEFAULT NULL,
  `cstname` varchar(255) DEFAULT NULL,
  `cstamount` varchar(255) DEFAULT NULL,
  `pf` varchar(255) DEFAULT NULL,
  `freight` varchar(255) DEFAULT NULL,
  `adjustment` varchar(255) DEFAULT NULL,
  `grandtotal` varchar(255) DEFAULT NULL,
  `taxtotal` varchar(255) DEFAULT NULL,
  `adjus` varchar(255) DEFAULT NULL,
  `vatadjus` varchar(255) DEFAULT NULL,
  `cstadjus` varchar(255) DEFAULT NULL,
  `pfadjus` varchar(255) DEFAULT NULL,
  `freightadjus` varchar(255) DEFAULT NULL,
  `roundoff` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.customerpo_details: ~0 rows (approximately)
/*!40000 ALTER TABLE `customerpo_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `customerpo_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.customer_details
CREATE TABLE IF NOT EXISTS `customer_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phoneno` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `contactperson` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `tinno` varchar(255) DEFAULT NULL,
  `cstno` varchar(255) DEFAULT NULL,
  `creditdays` varchar(255) DEFAULT NULL,
  `openingbal` varchar(255) DEFAULT NULL,
  `salesamount` varchar(255) DEFAULT NULL,
  `paidamount` varchar(255) DEFAULT NULL,
  `balanceamount` varchar(255) DEFAULT NULL,
  `returnamount` varchar(255) DEFAULT NULL,
  `panno` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `eccno` varchar(255) DEFAULT NULL,
  `range` varchar(255) DEFAULT NULL,
  `division` varchar(255) DEFAULT NULL,
  `commissionerate` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `accountname` varchar(100) NOT NULL,
  `printname` varchar(100) NOT NULL,
  `statecode` varchar(255) NOT NULL,
  `gstno` varchar(255) NOT NULL,
  `adharno` varchar(255) NOT NULL,
  `bankname` varchar(100) NOT NULL,
  `accountno` varchar(100) NOT NULL,
  `chequeno` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.customer_details: ~8 rows (approximately)
/*!40000 ALTER TABLE `customer_details` DISABLE KEYS */;
INSERT INTO `customer_details` (`id`, `date`, `type`, `name`, `phoneno`, `email`, `address1`, `address2`, `contactperson`, `state`, `city`, `tinno`, `cstno`, `creditdays`, `openingbal`, `salesamount`, `paidamount`, `balanceamount`, `returnamount`, `panno`, `location`, `pincode`, `eccno`, `range`, `division`, `commissionerate`, `remarks`, `status`, `accountname`, `printname`, `statecode`, `gstno`, `adharno`, `bankname`, `accountno`, `chequeno`) VALUES
	(1, '2019-02-22', 'Intra customer', 'vincent', '', '', 'CMC medical College', 'Coimbatore', '', 'Kerala', 'coimbatore', '', '', NULL, '0.00', '-248108.8', '80944', '-80892', '24.80', '', NULL, '641014', NULL, NULL, NULL, NULL, NULL, '1', '', '', '32', '', '', '', '', ''),
	(2, '2019-03-21', 'Intra customer', 'Ragul kumar', '', '', '91 Dr.jaganthan  nagar', 'RAJA STREET, TRICHY ROAD', 'lakshmi', 'Tamil Nadu', 'TRICHY', '', '', NULL, '50000', '3930305.52', '25000', '3745305.52', NULL, '', NULL, '641014', NULL, NULL, NULL, NULL, NULL, '1', '584211', '584211', '33', '', '', '', '', ''),
	(3, '2019-02-22', 'Intra supplier', 'krishna', '', '', '91 Dr.jaganthan  nagar', 'RAJA STREET, TRICHY ROAD', '', 'Tamil Nadu', 'TRICHY', '', '', NULL, '10000', '165670.4', '5000', '156110.4', '9792', '', NULL, '641014', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '', '', '', '', ''),
	(4, '2019-03-21', 'Intra supplier', 'Logesh 10', '', '', '12 th street, Ramanagar', 'Trichy road', '', 'Tamil Nadu', 'coimbatore', '', '', NULL, '0.00', NULL, NULL, '0.00', NULL, '', NULL, '615401', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '', '', '', '', ''),
	(5, '2019-03-21', 'Intra customer', 'Ramesh', '', '', 'Kamaraj Nagar,Kovilpalyaum', 'near  by lala sweets shop,', '', 'Tamil Nadu', 'coimbatore.', '', '', NULL, '0.00', '818826.96', '10000', '442004', NULL, '', NULL, '6541001', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '', '', '', '', ''),
	(6, '2019-03-29', 'Intra customer', 'Karikaliamman Spinning Mills Pvt Ltd', '9865919851', 'kasmstores@gmail.com', 'Elumathur To Poondurai Road', 'Elumathur, Modakurichi (Via)', 'Mr.Kandasamy', 'Tamil Nadu', 'Erode', '', '', NULL, '0.00', '198782.16', '50000', '148782.16', NULL, '', NULL, '638001', NULL, NULL, NULL, NULL, NULL, '1', 'Karikaliamman Spinning Mills Pvt Ltd', 'Karikaliamman Spinning Mills Pvt Ltd', '33', '33AAACK8617L1ZD', '', '', '', ''),
	(7, '2019-06-14', 'Intra customer', 'SANMUGANTHAN', '', '', '12/78 GANDHI STREET', '25/78 NEHRU STREET', '', 'Tamil Nadu', 'MADURAI', '', '', NULL, '0.00', '1000.00', NULL, '1000', NULL, '', NULL, '125487', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '', '', '', '', ''),
	(8, '2019-06-24', 'Intra customer', 'Kumar Kumar', '', '', 'Coimbatore', 'Coimbatore', '', 'Tamil Nadu', 'Coimbatore', '', '', NULL, '0.00', '9432.00', NULL, '9432', NULL, '', NULL, '641014', NULL, NULL, NULL, NULL, NULL, '1', '', '', '33', '', '', '', '', '');
/*!40000 ALTER TABLE `customer_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.dcbill_details
CREATE TABLE IF NOT EXISTS `dcbill_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `dctype` varchar(225) DEFAULT NULL,
  `dcno` varchar(225) DEFAULT NULL,
  `dcdate` date DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `cusname` varchar(225) DEFAULT NULL,
  `dispatchthrough` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `inwardno` longtext,
  `customerdcno` longtext,
  `customerdcdate` longtext,
  `itemname` longtext,
  `item_desc` text NOT NULL,
  `qty` longtext,
  `remarks` longtext,
  `hsnno` longtext,
  `uom` longtext,
  `dcnoyear` varchar(225) DEFAULT NULL,
  `dcnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `billtype` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.dcbill_details: ~6 rows (approximately)
/*!40000 ALTER TABLE `dcbill_details` DISABLE KEYS */;
INSERT INTO `dcbill_details` (`id`, `date`, `dctype`, `dcno`, `dcdate`, `customerId`, `cusname`, `dispatchthrough`, `address`, `inwardno`, `customerdcno`, `customerdcdate`, `itemname`, `item_desc`, `qty`, `remarks`, `hsnno`, `uom`, `dcnoyear`, `dcnodate`, `status`, `delete_status`, `billtype`) VALUES
	(1, '2019-05-31', 'Direct DC', 'D', '2019-05-31', 6, 'Karikaliamman Spinning Mills Pvt Ltd', '', 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via)', NULL, NULL, NULL, 'Chart card', '', '15', '', '1503', 'nos', 'D-19', 'D310519', 1, 1, ''),
	(2, '2019-05-31', 'Direct DC', 'D1', '2019-05-31', 6, 'Karikaliamman Spinning Mills Pvt Ltd', '', 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via)', NULL, NULL, NULL, 'Chart card', '', '15', '', '1503', 'nos', 'D1-19', 'D1310519', 1, 0, ''),
	(3, '2019-06-28', 'Against Inward', 'D2', '2019-06-28', 6, 'Karikaliamman Spinning Mills Pvt Ltd', '', 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via)', 'I', '12333333||12333333', '2019-06-28||2019-06-28', 'fliter paper||Sullube Oil - 250025-669', '||', '20||5', '||', '6510||8414', 'nos||Pail', 'D2-19', 'D2280619', 1, 0, ''),
	(4, '2019-08-01', NULL, 'D3', '2019-08-01', 0, 'ravi', '', '', NULL, NULL, NULL, 'gtv body paatern', '', '1', 'f', NULL, 'nos', '3-19', '3010819', 1, 1, ''),
	(5, '2019-08-01', NULL, 'D4', '2019-08-01', 0, 'ravi', '', '', NULL, NULL, NULL, 'gtv body paatern', '', '1', 'f', NULL, 'nos', '3-19', '3010819', 1, 1, ''),
	(6, '2019-08-01', NULL, 'D5', '2019-08-01', 0, 'ravi', '', '', NULL, NULL, NULL, 'bio power 100', '', '1', '', NULL, 'ltr', '5-19', '5010819', 1, 1, '');
/*!40000 ALTER TABLE `dcbill_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.dc_delivery
CREATE TABLE IF NOT EXISTS `dc_delivery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `insertid` int(11) NOT NULL,
  `inwardid` int(11) DEFAULT NULL,
  `dctype` varchar(225) NOT NULL,
  `dcno` varchar(225) NOT NULL,
  `dcdate` varchar(225) NOT NULL,
  `customerId` int(11) NOT NULL,
  `cusname` varchar(225) NOT NULL,
  `dispatchthrough` varchar(225) NOT NULL,
  `address` varchar(225) NOT NULL,
  `inwardno` longtext,
  `customerdcno` varchar(225) DEFAULT NULL,
  `customerdcdate` varchar(225) DEFAULT NULL,
  `itemname` longtext NOT NULL,
  `item_desc` text NOT NULL,
  `qty` longtext NOT NULL,
  `balanceqty` varchar(225) DEFAULT NULL,
  `remarks` longtext NOT NULL,
  `hsnno` longtext NOT NULL,
  `uom` longtext NOT NULL,
  `dcnoyear` varchar(225) NOT NULL,
  `dcnodate` varchar(225) NOT NULL,
  `status` int(11) NOT NULL,
  `dc_status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.dc_delivery: ~2 rows (approximately)
/*!40000 ALTER TABLE `dc_delivery` DISABLE KEYS */;
INSERT INTO `dc_delivery` (`id`, `date`, `insertid`, `inwardid`, `dctype`, `dcno`, `dcdate`, `customerId`, `cusname`, `dispatchthrough`, `address`, `inwardno`, `customerdcno`, `customerdcdate`, `itemname`, `item_desc`, `qty`, `balanceqty`, `remarks`, `hsnno`, `uom`, `dcnoyear`, `dcnodate`, `status`, `dc_status`) VALUES
	(3, '2019-06-28', 3, 1, 'Against Inward', 'D2', '2019-06-28', 6, 'Karikaliamman Spinning Mills Pvt Ltd', '', 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via)', 'I', '12333333', '2019-06-28', 'fliter paper', '', '20', '0', '', '6510', 'nos', 'D2-19', 'D2280619', 1, 0),
	(4, '2019-06-28', 3, 2, 'Against Inward', 'D2', '2019-06-28', 6, 'Karikaliamman Spinning Mills Pvt Ltd', '', 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via)', 'I', '12333333', '2019-06-28', 'Sullube Oil - 250025-669', '', '5', '0', '', '8414', 'Pail', 'D2-19', 'D2280619', 1, 0);
/*!40000 ALTER TABLE `dc_delivery` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.expenses
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `expensesid` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `expensesdate` date DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `paymentmode` varchar(255) DEFAULT NULL,
  `throughcheck` varchar(255) DEFAULT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `chamount` varchar(255) DEFAULT NULL,
  `banktransfer` varchar(255) DEFAULT NULL,
  `bamount` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `cardtype` varchar(255) DEFAULT NULL,
  `paymentdetails` varchar(255) DEFAULT NULL,
  `overallamount` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `headers` varchar(255) NOT NULL,
  `transactionid` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.expenses: ~0 rows (approximately)
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.headers
CREATE TABLE IF NOT EXISTS `headers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.headers: ~4 rows (approximately)
/*!40000 ALTER TABLE `headers` DISABLE KEYS */;
INSERT INTO `headers` (`id`, `date`, `status`, `name`) VALUES
	(1, '2019-02-22', 1, 'worker'),
	(2, '2019-03-01', 1, 'tea exp'),
	(3, '2019-03-01', 1, 'sallery'),
	(4, '2019-03-01', 1, 'vincent ');
/*!40000 ALTER TABLE `headers` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.invoice_details
CREATE TABLE IF NOT EXISTS `invoice_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `orderno` varchar(255) DEFAULT NULL,
  `orderdate` date DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `dcno` longtext,
  `pono` varchar(255) DEFAULT NULL,
  `bill_type` varchar(255) NOT NULL,
  `invoicetype` varchar(225) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `deliveryat` varchar(225) DEFAULT NULL,
  `transportmode` varchar(255) DEFAULT NULL,
  `vehicleno` varchar(225) DEFAULT NULL,
  `billtype` varchar(255) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `dcnos` longtext,
  `insertid` varchar(225) DEFAULT NULL,
  `deliveryid` longtext,
  `hsnno` longtext,
  `itemname` longtext,
  `item_desc` text NOT NULL,
  `uom` longtext,
  `rate` longtext,
  `qty` longtext,
  `amount` longtext,
  `discount` longtext,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightamount` varchar(225) DEFAULT NULL,
  `freightcgst` varchar(225) DEFAULT NULL,
  `freightcgstamount` varchar(225) DEFAULT NULL,
  `freightsgst` varchar(225) DEFAULT NULL,
  `freightsgstamount` varchar(225) DEFAULT NULL,
  `freightigst` varchar(225) DEFAULT NULL,
  `freightigstamount` varchar(225) DEFAULT NULL,
  `freighttotal` varchar(225) DEFAULT NULL,
  `loadingamount` varchar(225) DEFAULT NULL,
  `loadingcgst` varchar(225) DEFAULT NULL,
  `loadingcgstamount` varchar(225) DEFAULT NULL,
  `loadingsgst` varchar(225) DEFAULT NULL,
  `loadingsgstamount` varchar(225) DEFAULT NULL,
  `loadingigst` varchar(225) DEFAULT NULL,
  `loadingigstamount` varchar(225) DEFAULT NULL,
  `loadingtotal` varchar(225) DEFAULT NULL,
  `roundOff` varchar(255) NOT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `invoicenodate` varchar(225) DEFAULT NULL,
  `invoicenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.invoice_details: ~18 rows (approximately)
/*!40000 ALTER TABLE `invoice_details` DISABLE KEYS */;
INSERT INTO `invoice_details` (`id`, `date`, `invoicedate`, `orderno`, `orderdate`, `invoiceno`, `dcno`, `pono`, `bill_type`, `invoicetype`, `customerId`, `customername`, `address`, `deliveryat`, `transportmode`, `vehicleno`, `billtype`, `gsttype`, `typesgst`, `typecgst`, `typeigst`, `dcnos`, `insertid`, `deliveryid`, `hsnno`, `itemname`, `item_desc`, `uom`, `rate`, `qty`, `amount`, `discount`, `discountBy`, `discountamount`, `taxableamount`, `sgst`, `sgstamount`, `cgst`, `cgstamount`, `igst`, `igstamount`, `total`, `subtotal`, `freightamount`, `freightcgst`, `freightcgstamount`, `freightsgst`, `freightsgstamount`, `freightigst`, `freightigstamount`, `freighttotal`, `loadingamount`, `loadingcgst`, `loadingcgstamount`, `loadingsgst`, `loadingsgstamount`, `loadingigst`, `loadingigstamount`, `loadingtotal`, `roundOff`, `othercharges`, `return_status`, `grandtotal`, `invoicenodate`, `invoicenoyear`, `status`, `edit_status`) VALUES
	(1, '2019-05-19', '2019-05-19', '', '1970-01-01', 'INV', NULL, NULL, 'Sales Invoice', 'Direct Invoice', 5, 'Ramesh', 'Kamaraj Nagar,Kovilpalyaum, near  by lala sweets shop,, coimbatore., Tamil Nadu', '', '', '', 'intrastate', 'intrastate', 'sgst', 'cgst', '', NULL, '0', NULL, '1503||0', 'Chart card||bio gas', '||', 'nos||kgs', '1500||200', '1||12', '1500.00||2400.00', '0||0', 'percent_wise', '0.00||0.00', '1500.00||2400.00', '6||6', '90.00||144.00', '6||6', '90.00||144.00', '12||12', '180.00||288.00', '1680.00||2688.00', '4368.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1||1', '4368.00', 'INV190519', 'INV-2019', 1, 1),
	(2, '2019-05-22', '2019-05-22', '1245', '2019-05-13', 'INV1', NULL, NULL, 'Sales Invoice', 'Direct Invoice', 2, 'Ragul kumar', '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', '', '', '', 'intrastate', 'intrastate', 'sgst', 'cgst', '', NULL, '0', NULL, '6510', 'fliter paper', '', 'nos', '0', '2', '0.00', '0', 'percent_wise', '0.00', '0.00', '6', '0.00', '6', '0.00', '12', '0.00', '0.00', '0.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '0.00', 'INV1220519', 'INV1-2019', 1, 1),
	(3, '2019-05-31', '2019-05-31', '', '1970-01-01', 'INV2', NULL, NULL, 'Sales Invoice', 'Direct Invoice', 6, 'Karikaliamman Spinning Mills Pvt Ltd', 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via), Erode, Tamil Nadu', '', '', '', 'interstate', 'interstate', '', '', 'igst', NULL, '0', NULL, '1503', 'Chart card', '', 'nos', '2500', '10', '25000.00', '0', 'percent_wise', '0.00', '25000.00', '6', '1500.00', '6', '1500.00', '12', '3000.00', '28000.00', '28000.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '28000.00', 'INV2310519', 'INV2-2019', 1, 1),
	(4, '2019-05-31', '2019-05-31', '', '1970-01-01', 'INV3', 'D||D1', NULL, 'Sales Invoice', 'Against DC', 6, 'Karikaliamman Spinning Mills Pvt Ltd', 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via), Erode, Tamil Nadu', '', '', '', 'intrastate', 'intrastate', 'sgst', 'cgst', '', 'D||D1', '2', '1||2', '1503||1503', 'Chart card||Chart card', '||', 'nos||nos', '2500||2500', '15||15', '37500.00||37500.00', '0||0', 'percent_wise', '||', '37500.00||37500.00', '6||6', '2250.00||2250.00', '6||6', '2250.00||2250.00', '12||12', '||', '42000.00||42000.00', '84000.00', '', '', '', '', '', '', '', '0', '', '', '', '', '', '', '', '0', '0', '0', '1||1', '84000.00', 'INV3310519', 'INV3-2019', 1, 1),
	(5, '2019-06-01', '2019-06-01', '', '1970-01-01', 'INV4', NULL, NULL, 'Sales Invoice', 'Direct Invoice', 2, 'Ragul kumar', '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', '', '', '', 'intrastate', 'intrastate', 'sgst', 'cgst', '', NULL, '0', NULL, '0', 'teak wood', '', 'kgs', '1500', '5', '7500.00', '0', 'percent_wise', '0.00', '7500.00', '6', '450.00', '6', '450.00', '12', '900.00', '8400.00', '8400.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '8400.00', 'INV4010619', 'INV4-2019', 1, 1),
	(6, '2019-06-01', '2019-06-01', '', '1970-01-01', 'INV5', NULL, NULL, 'Sales Invoice', 'Direct Invoice', 2, 'Ragul kumar', '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', '', '', '', 'intrastate', 'intrastate', 'sgst', 'cgst', '', NULL, '0', NULL, '23454', 'gtv body paatern', '', 'nos', '23000', '100', '2300000.00', '0', 'percent_wise', '0.00', '2300000.00', '6', '138000.00', '6', '138000.00', '12', '276000.00', '2576000.00', '2576000.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '2576000.00', 'INV5010619', 'INV5-2019', 1, 1),
	(7, '2019-06-14', '2019-06-14', '', '1970-01-01', 'INV6', NULL, NULL, 'Sales Invoice', 'Direct Invoice', 5, 'Ramesh', 'Kamaraj Nagar,Kovilpalyaum, near  by lala sweets shop,, coimbatore., Tamil Nadu', '', '', '', 'intrastate', 'intrastate', 'sgst', 'cgst', '', NULL, '0', NULL, '1254||0', 'Pos Device||teak wood', '||', 'pair||kgs', '5000||1000', '1||2', '5000.00||2000.00', '0||0', 'percent_wise', '0.00||0.00', '5000.00||2000.00', '15||6', '750.00||120.00', '15||6', '750.00||120.00', '30||12', '1500.00||240.00', '6500.00||2240.00', '8740.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1||1', '8740.00', NULL, NULL, 1, 1),
	(8, '2019-06-24', '2019-06-24', '', '1970-01-01', 'INV7', NULL, NULL, 'Sales Invoice', 'Direct Invoice', 8, 'Kumar Kumar', 'Coimbatore, Coimbatore, Coimbatore, Tamil Nadu', '', '', 'Tn 38 bj 5989', 'intrastate', 'intrastate', 'sgst', 'cgst', '', NULL, '0', NULL, '8414', 'Sullube Oil - 250025-669', '', 'Pail', '1000', '2', '2000.00', '0', 'percent_wise', '0.00', '2000.00', '9', '180.00', '9', '180.00', '18', '360.00', '2360.00', '9432.00', '5000', '18', '900.00', '18', '900.00', '36', '1800.00', '6800.00', '200', '18', '36.00', '18', '36.00', '36', '72.00', '272.00', '0', '0', '1', '9432.00', 'INV7240619', 'INV7-2019', 1, 1),
	(9, '2019-06-28', '2019-06-28', '', '1970-01-01', 'INV8', 'D2', NULL, 'Sales Invoice', 'Against DC', 6, 'Karikaliamman Spinning Mills Pvt Ltd', 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via), Erode, Tamil Nadu', '', '', '', 'intrastate', 'intrastate', 'sgst', 'cgst', '', 'D2||D2', '3', '3||4', '6510||8414', 'fliter paper||Sullube Oil - 250025-669', '||', 'nos||Pail', '50||50', '20||5', '1000.00||250.00', '0||0', 'percent_wise', '||', '1000.00||250.00', '6||9', '60.00||22.50', '6||9', '60.00||22.50', '12||18', '||', '1120.00||295.00', '1415.00', '', '', '', '', '', '', '', '0', '', '', '', '', '', '', '', '0', '0', '0', '1||1', '1415.00', 'INV8280619', 'INV8-2019', 1, 1),
	(10, '2019-07-16', '2019-07-16', '', '1970-01-01', 'INV9', NULL, NULL, 'Sales Invoice', 'Direct Invoice', 6, 'Karikaliamman Spinning Mills Pvt Ltd', 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via), Erode, Tamil Nadu', '', '', '', 'intrastate', 'intrastate', 'sgst', 'cgst', '', NULL, '0', NULL, '452', 'Tissues Paper', '', 'nos', '150', '120', '18000.00', '0', 'percent_wise', '0.00', '18000.00', '6', '1080.00', '6', '1080.00', '12', '2160.00', '20160.00', '20160.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '20160.00', 'INV9160719', 'INV9-2019', 1, 1),
	(11, '2019-08-01', '2019-08-01', '', '1970-01-01', 'INV', NULL, NULL, 'Sales Invoice', 'Direct Invoice', 5, 'Ramesh', 'Kamaraj Nagar,Kovilpalyaum, near  by lala sweets shop,, coimbatore., Tamil Nadu', '', '', '', 'intrastate', 'intrastate', 'sgst', 'cgst', '', NULL, '0', NULL, NULL, 'bio power 100||Grap Board', '||', 'ltr||kgs', '100||150', '1||1', '100.00||150.00', '0||0', 'percent_wise', '0.00', '100.00', NULL, NULL, NULL, NULL, NULL, NULL, 'NaN', 'NaN', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, 'NaN', 'INV10010819', 'INV10-2019', 1, 1),
	(12, '2019-08-03', '2019-08-03', NULL, '1970-01-01', 'INV', NULL, NULL, 'Sales Invoice', 'Direct Invoice', 1, 'vincent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 'WATER BOTTEL', '', 'nos', '50', '1', NULL, NULL, 'percent_wise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '50.00', '50.00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '1', '1', NULL, '52.00', 'INV1030819', 'INV1-2019', 1, 1),
	(13, '2019-08-03', '2019-08-03', NULL, '1970-01-01', 'INV', NULL, NULL, 'Sales Invoice', 'Direct Invoice', 5, 'Ramesh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 'teak wood||Sullube Oil - 250025-669', '||', 'kgs||Pail', '1000||26681', '6||8', NULL, NULL, 'percent_wise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6000.00||213448.00', '219448.00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, '219448.00', 'INV1030819', 'INV1-2019', 1, 1),
	(14, '2019-08-03', '2019-08-03', NULL, '1970-01-01', 'INV', NULL, NULL, 'Sales Invoice', 'Direct Invoice', 5, 'Ramesh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 'teak wood||Sullube Oil - 250025-669', '||', 'kgs||Pail', '1000||26681', '6||8', NULL, NULL, 'percent_wise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6000.00||213448.00', '219448.00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, '219448.00', 'INV1030819', 'INV1-2019', 1, 1),
	(15, '2019-08-03', '2019-08-03', NULL, '1970-01-01', 'INV', NULL, NULL, 'Sales Invoice', 'Direct Invoice', 2, 'Ragul kumar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 'Sullube Oil - 250025-669||teak wood', '||', 'Pail||kgs', '26681||1000', '2||3', NULL, NULL, 'percent_wise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '53362.00||3000.00', '56362.00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, '56362.00', 'INV1030819', 'INV1-2019', 1, 1),
	(16, '2019-08-03', '2019-08-03', NULL, '1970-01-01', 'INV', NULL, NULL, 'Sales Invoice', 'Direct Invoice', 7, 'SANMUGANTHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 'teak wood', '', 'kgs', '1000', '1', NULL, NULL, 'percent_wise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1000.00', '1000.00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, '1000.00', 'INV1030819', 'INV1-2019', 1, 1),
	(17, '2019-08-03', '2019-08-03', NULL, '1970-01-01', 'INV', NULL, NULL, 'Sales Invoice', 'Direct Invoice', 2, 'Ragul kumar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 'Grap Board', '', 'kgs', '150', '1', NULL, NULL, 'percent_wise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '150.00', '150.00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, '150.00', 'INV1030819', 'INV1-2019', 1, 1),
	(18, '2019-08-03', '2019-08-03', NULL, '1970-01-01', 'INV1', NULL, NULL, 'Sales Invoice', 'Direct Invoice', 2, 'Ragul kumar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, 'teak wood', '', 'kgs', '1000', '1', NULL, NULL, 'percent_wise', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1000.00', '1000.00', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', NULL, '1000.00', 'INV1030819', 'INV1-2019', 1, 1);
/*!40000 ALTER TABLE `invoice_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.invoice_party_statement
CREATE TABLE IF NOT EXISTS `invoice_party_statement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiptno` varchar(255) DEFAULT NULL,
  `paid` varchar(255) NOT NULL,
  `receiptid` varchar(100) DEFAULT NULL,
  `date` date NOT NULL,
  `invoiceno` varchar(255) NOT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(255) NOT NULL,
  `cstno` varchar(255) NOT NULL,
  `phoneno` varchar(255) NOT NULL,
  `tinno` varchar(255) NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `item_desc` text NOT NULL,
  `rate` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `credit` varchar(255) DEFAULT NULL,
  `debit` varchar(255) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `receiptdate` date NOT NULL,
  `invoicedate` date NOT NULL,
  `totalamount` varchar(255) NOT NULL,
  `payment` varchar(100) NOT NULL,
  `throughcheck` varchar(255) DEFAULT NULL,
  `balanceamount` varchar(255) NOT NULL,
  `payamount` varchar(255) NOT NULL,
  `paymentmode` varchar(255) DEFAULT NULL,
  `chamount` varchar(255) DEFAULT NULL,
  `paidamount` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `banktransfer` varchar(255) DEFAULT NULL,
  `bankamount` varchar(255) DEFAULT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `paymentdetails` varchar(255) DEFAULT NULL,
  `overallamount` varchar(255) DEFAULT NULL,
  `receiptamt` varchar(255) DEFAULT NULL,
  `invoiceamt` varchar(255) DEFAULT NULL,
  `returnamount` varchar(255) DEFAULT NULL,
  `formtype` varchar(255) DEFAULT NULL,
  `invoicenoyear` varchar(255) DEFAULT NULL,
  `invoicenodate` varchar(255) DEFAULT NULL,
  `invoiceid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.invoice_party_statement: ~21 rows (approximately)
/*!40000 ALTER TABLE `invoice_party_statement` DISABLE KEYS */;
INSERT INTO `invoice_party_statement` (`id`, `receiptno`, `paid`, `receiptid`, `date`, `invoiceno`, `customerId`, `customername`, `cstno`, `phoneno`, `tinno`, `itemname`, `item_desc`, `rate`, `qty`, `credit`, `debit`, `amount`, `total`, `status`, `receiptdate`, `invoicedate`, `totalamount`, `payment`, `throughcheck`, `balanceamount`, `payamount`, `paymentmode`, `chamount`, `paidamount`, `balance`, `banktransfer`, `bankamount`, `chequeno`, `paymentdetails`, `overallamount`, `receiptamt`, `invoiceamt`, `returnamount`, `formtype`, `invoicenoyear`, `invoicenodate`, `invoiceid`) VALUES
	(1, '-', '-', NULL, '2019-05-19', 'INV', 5, 'Ramesh', '', '', '', 'Chart card||bio gas', '||', '', '', NULL, NULL, '', '', '1', '2019-05-19', '2019-05-19', '4368.00', '-', '-', '', '', '-', '-', NULL, '4368', '-', '-', '-', '-', '4368.00', '-', '4368.00', NULL, NULL, 'INV-2019', 'INV190519', '1'),
	(2, '-', '-', NULL, '2019-05-22', 'INV1', 2, 'Ragul kumar', '', '', '', 'fliter paper', '', '', '', NULL, NULL, '', '', '1', '2019-05-22', '2019-05-22', '0.00', '-', '-', '', '', '-', '-', NULL, '1178393.52', '-', '-', '-', '-', '0.00', '-', '0.00', NULL, NULL, 'INV1-2019', 'INV1220519', '2'),
	(3, '-', '-', NULL, '2019-05-31', 'INV2', 6, 'Karikaliamman Spinning Mills Pvt Ltd', '', '', '', 'Chart card', '', '', '', NULL, NULL, '', '', '1', '2019-05-31', '2019-05-31', '28000.00', '-', '-', '', '', '-', '-', NULL, '93207.16', '-', '-', '-', '-', '28000.00', '-', '28000.00', NULL, NULL, 'INV2-2019', 'INV2310519', '3'),
	(4, '-', '-', NULL, '2019-05-31', 'INV3', 6, 'Karikaliamman Spinning Mills Pvt Ltd', '', '', '', 'Chart card||Chart card', '||', '', '', NULL, NULL, '', '', '1', '2019-05-31', '2019-05-31', '84000.00', '-', '-', '', '', '-', '-', NULL, '177207.16', '-', '-', '-', '-', '84000.00', '-', '84000.00', NULL, NULL, 'INV3-2019', 'INV3310519', '4'),
	(5, '-', '-', NULL, '2019-06-01', 'INV4', 2, 'Ragul kumar', '', '', '', 'teak wood', '', '', '', NULL, NULL, '', '', '1', '2019-06-01', '2019-06-01', '8400.00', '-', '-', '', '', '-', '-', NULL, '1186793.52', '-', '-', '-', '-', '8400.00', '-', '8400.00', NULL, NULL, 'INV4-2019', 'INV4010619', '5'),
	(6, '-', '-', NULL, '2019-06-01', 'INV5', 2, 'Ragul kumar', '', '', '', 'gtv body paatern', '', '', '', NULL, NULL, '', '', '1', '2019-06-01', '2019-06-01', '2576000.00', '-', '-', '', '', '-', '-', NULL, '3762793.52', '-', '-', '-', '-', '2576000.00', '-', '2576000.00', NULL, NULL, 'INV5-2019', 'INV5010619', '6'),
	(7, 'R', '', NULL, '2019-06-05', '-', 0, 'Ragul kumar', '', '', '', '', '', '', '', NULL, NULL, '', '', '1', '2019-06-05', '0000-00-00', '', '', NULL, '', '', NULL, NULL, NULL, '3712793.52', NULL, NULL, NULL, 'Cash', NULL, '50000', '-', NULL, NULL, NULL, NULL, NULL),
	(8, 'R1', '', NULL, '2019-06-05', '-', 0, 'Ragul kumar', '', '', '', '', '', '', '', NULL, NULL, '', '', '1', '2019-06-05', '0000-00-00', '', '', NULL, '', '', NULL, NULL, NULL, '3687793.52', NULL, NULL, NULL, 'Cheque SOUTH INDIAN 00000', NULL, '25000', '-', NULL, NULL, NULL, NULL, NULL),
	(10, '-', '-', NULL, '2019-06-14', 'INV6', 5, 'Ramesh', '', '', '', 'Pos Device||teak wood', '||', '', '', NULL, NULL, '', '', '1', '2019-06-14', '2019-06-14', '8740.00', '-', '-', '', '', '-', '-', NULL, '13108', '-', '-', '-', '-', '8740.00', '-', '8740.00', NULL, NULL, NULL, NULL, '7'),
	(11, 'R2', '', NULL, '2019-06-14', '-', 0, 'Ramesh', '', '', '', '', '', '', '', NULL, NULL, '', '', '1', '2019-06-14', '0000-00-00', '', '', NULL, '', '', NULL, NULL, NULL, '3108', NULL, NULL, NULL, 'Cash', NULL, '10000', '-', NULL, NULL, NULL, NULL, NULL),
	(12, '-', '-', NULL, '2019-06-24', 'INV7', 8, 'Kumar Kumar', '', '', '', 'Sullube Oil - 250025-669', '', '', '', NULL, NULL, '', '', '1', '2019-06-24', '2019-06-24', '9432.00', '-', '-', '', '', '-', '-', NULL, '9432', '-', '-', '-', '-', '9432.00', '-', '9432.00', NULL, NULL, 'INV7-2019', 'INV7240619', '8'),
	(13, '-', '-', NULL, '2019-06-28', 'INV8', 6, 'Karikaliamman Spinning Mills Pvt Ltd', '', '', '', 'fliter paper||Sullube Oil - 250025-669', '||', '', '', NULL, NULL, '', '', '1', '2019-06-28', '2019-06-28', '1415.00', '-', '-', '', '', '-', '-', NULL, '178622.16', '-', '-', '-', '-', '1415.00', '-', '1415.00', NULL, NULL, 'INV8-2019', 'INV8280619', '9'),
	(14, 'R3', '', NULL, '2019-06-28', '-', 0, 'Karikaliamman Spinning Mills Pvt Ltd', '', '', '', '', '', '', '', NULL, NULL, '', '', '1', '2019-06-28', '0000-00-00', '', '', NULL, '', '', NULL, NULL, NULL, '128622.16', NULL, NULL, NULL, 'Cheque INDIAN BANK 2222222', NULL, '50000', '-', NULL, NULL, NULL, NULL, NULL),
	(15, '-', '-', NULL, '2019-07-16', 'INV9', 6, 'Karikaliamman Spinning Mills Pvt Ltd', '', '', '', 'Tissues Paper', '', '', '', NULL, NULL, '', '', '1', '2019-07-16', '2019-07-16', '20160.00', '-', '-', '', '', '-', '-', NULL, '148782.16', '-', '-', '-', '-', '20160.00', '-', '20160.00', NULL, NULL, 'INV9-2019', 'INV9160719', '10'),
	(16, '-', '-', NULL, '2019-08-01', 'INV10', 5, 'Ramesh', '', '', '', 'bio power 100||Grap Board', '||', '', '', NULL, NULL, '', '', '1', '2019-08-01', '2019-08-01', 'NaN', '-', '-', '', '', '-', '-', NULL, '3108', '-', '-', '-', '-', 'NaN', '-', 'NaN', NULL, NULL, 'INV10-2019', 'INV10010819', '11'),
	(17, '-', '-', NULL, '2019-08-03', 'INV1', 1, 'vincent', '', '', '', 'WATER BOTTEL', '', '', '', NULL, NULL, '', '', '1', '2019-08-03', '2019-08-03', '52.00', '-', '-', '', '', '-', '-', NULL, '-80892', '-', '-', '-', '-', '52.00', '-', '52.00', NULL, NULL, 'INV1-2019', 'INV1030819', '12'),
	(18, '-', '-', NULL, '2019-08-03', 'INV1', 5, 'Ramesh', '', '', '', 'teak wood||Sullube Oil - 250025-669', '||', '', '', NULL, NULL, '', '', '1', '2019-08-03', '2019-08-03', '219448.00', '-', '-', '', '', '-', '-', NULL, '442004', '-', '-', '-', '-', '219448.00', '-', '219448.00', NULL, NULL, 'INV1-2019', 'INV1030819', '14'),
	(19, '-', '-', NULL, '2019-08-03', 'INV1', 2, 'Ragul kumar', '', '', '', 'Sullube Oil - 250025-669||teak wood', '||', '', '', NULL, NULL, '', '', '1', '2019-08-03', '2019-08-03', '56362.00', '-', '-', '', '', '-', '-', NULL, '3744155.52', '-', '-', '-', '-', '56362.00', '-', '56362.00', NULL, NULL, 'INV1-2019', 'INV1030819', '15'),
	(20, '-', '-', NULL, '2019-08-03', 'INV1', 7, 'SANMUGANTHAN', '', '', '', 'teak wood', '', '', '', NULL, NULL, '', '', '1', '2019-08-03', '2019-08-03', '1000.00', '-', '-', '', '', '-', '-', NULL, '1000', '-', '-', '-', '-', '1000.00', '-', '1000.00', NULL, NULL, 'INV1-2019', 'INV1030819', '16'),
	(21, '-', '-', NULL, '2019-08-03', 'INV1', 2, 'Ragul kumar', '', '', '', 'Grap Board', '', '', '', NULL, NULL, '', '', '1', '2019-08-03', '2019-08-03', '150.00', '-', '-', '', '', '-', '-', NULL, '3744305.52', '-', '-', '-', '-', '150.00', '-', '150.00', NULL, NULL, 'INV1-2019', 'INV1030819', '17'),
	(22, '-', '-', NULL, '2019-08-03', 'INV1', 2, 'Ragul kumar', '', '', '', 'teak wood', '', '', '', NULL, NULL, '', '', '1', '2019-08-03', '2019-08-03', '1000.00', '-', '-', '', '', '-', '-', NULL, '3745305.52', '-', '-', '-', '-', '1000.00', '-', '1000.00', NULL, NULL, 'INV1-2019', 'INV1030819', '18');
/*!40000 ALTER TABLE `invoice_party_statement` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.invoice_reports
CREATE TABLE IF NOT EXISTS `invoice_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `invoicedate` varchar(255) DEFAULT NULL,
  `paymenttype` varchar(255) DEFAULT NULL,
  `dcdate` date DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(255) DEFAULT NULL,
  `mobileno` varchar(255) DEFAULT NULL,
  `tinno` varchar(255) DEFAULT NULL,
  `cstno` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gsttype` varchar(255) DEFAULT NULL,
  `billtype` varchar(255) DEFAULT NULL,
  `deliveryat` varchar(255) DEFAULT NULL,
  `vehicleno` varchar(255) DEFAULT NULL,
  `dcno` varchar(255) DEFAULT NULL,
  `orderdate` date DEFAULT NULL,
  `orderno` varchar(255) DEFAULT NULL,
  `despatch` varchar(255) DEFAULT NULL,
  `hsnno` varchar(255) DEFAULT NULL,
  `itemno` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `item_desc` text NOT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `totalamount` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `disamount` varchar(255) DEFAULT NULL,
  `grandtotal` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `invoicenoyear` varchar(255) DEFAULT NULL,
  `invoicenodate` varchar(255) DEFAULT NULL,
  `invoiceid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.invoice_reports: ~24 rows (approximately)
/*!40000 ALTER TABLE `invoice_reports` DISABLE KEYS */;
INSERT INTO `invoice_reports` (`id`, `date`, `invoiceno`, `invoicedate`, `paymenttype`, `dcdate`, `customerId`, `customername`, `mobileno`, `tinno`, `cstno`, `address`, `gsttype`, `billtype`, `deliveryat`, `vehicleno`, `dcno`, `orderdate`, `orderno`, `despatch`, `hsnno`, `itemno`, `itemname`, `item_desc`, `rate`, `qty`, `total`, `totalamount`, `subtotal`, `discount`, `disamount`, `grandtotal`, `paid`, `balance`, `status`, `invoicenoyear`, `invoicenodate`, `invoiceid`) VALUES
	(1, '2019-05-19', 'INV', '2019-05-19', NULL, NULL, 5, 'Ramesh', NULL, NULL, NULL, 'Kamaraj Nagar,Kovilpalyaum, near  by lala sweets shop,, coimbatore., Tamil Nadu', 'intrastate', 'intrastate', '', '', NULL, '1970-01-01', '', NULL, '1503', NULL, 'Chart card', '', '1', '1', '1', NULL, '4368.00', NULL, NULL, '4368.00', NULL, NULL, '1', 'INV-2019', 'INV190519', '1'),
	(2, '2019-05-19', 'INV', '2019-05-19', NULL, NULL, 5, 'Ramesh', NULL, NULL, NULL, 'Kamaraj Nagar,Kovilpalyaum, near  by lala sweets shop,, coimbatore., Tamil Nadu', 'intrastate', 'intrastate', '', '', NULL, '1970-01-01', '', NULL, '0', NULL, 'bio gas', '', '5', '12', '6', NULL, '4368.00', NULL, NULL, '4368.00', NULL, NULL, '1', 'INV-2019', 'INV190519', '1'),
	(3, '2019-05-22', 'INV1', '2019-05-22', NULL, NULL, 2, 'Ragul kumar', NULL, NULL, NULL, '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', 'intrastate', 'intrastate', '', '', NULL, '2019-05-13', '1245', NULL, '6510', NULL, 'fliter paper', '', '0', '2', '0', NULL, '0.00', NULL, NULL, '0.00', NULL, NULL, '1', 'INV1-2019', 'INV1220519', '2'),
	(4, '2019-05-31', 'INV2', '2019-05-31', NULL, NULL, 6, 'Karikaliamman Spinning Mills Pvt Ltd', NULL, NULL, NULL, 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via), Erode, Tamil Nadu', 'interstate', 'interstate', '', '', NULL, '1970-01-01', '', NULL, '1503', NULL, 'Chart card', '', '2', '10', '2', NULL, '28000.00', NULL, NULL, '28000.00', NULL, NULL, '1', 'INV2-2019', 'INV2310519', '3'),
	(5, '2019-05-31', 'INV3', '2019-05-31', NULL, NULL, 6, 'Karikaliamman Spinning Mills Pvt Ltd', NULL, NULL, NULL, 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via), Erode, Tamil Nadu', 'intrastate', 'intrastate', '', '', NULL, '1970-01-01', '', NULL, '1503', NULL, 'Chart card', '', '2', '15', '4', NULL, '84000.00', NULL, NULL, '84000.00', NULL, NULL, '1', 'INV3-2019', 'INV3310519', '4'),
	(6, '2019-05-31', 'INV3', '2019-05-31', NULL, NULL, 6, 'Karikaliamman Spinning Mills Pvt Ltd', NULL, NULL, NULL, 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via), Erode, Tamil Nadu', 'intrastate', 'intrastate', '', '', NULL, '1970-01-01', '', NULL, '1503', NULL, 'Chart card', '', '5', '15', '2', NULL, '84000.00', NULL, NULL, '84000.00', NULL, NULL, '1', 'INV3-2019', 'INV3310519', '4'),
	(7, '2019-06-01', 'INV4', '2019-06-01', NULL, NULL, 2, 'Ragul kumar', NULL, NULL, NULL, '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', 'intrastate', 'intrastate', '', '', NULL, '1970-01-01', '', NULL, '0', NULL, 'teak wood', '', '1', '5', '8', NULL, '8400.00', NULL, NULL, '8400.00', NULL, NULL, '1', 'INV4-2019', 'INV4010619', '5'),
	(8, '2019-06-01', 'INV5', '2019-06-01', NULL, NULL, 2, 'Ragul kumar', NULL, NULL, NULL, '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', 'intrastate', 'intrastate', '', '', NULL, '1970-01-01', '', NULL, '23454', NULL, 'gtv body paatern', '', '2', '100', '2', NULL, '2576000.00', NULL, NULL, '2576000.00', NULL, NULL, '1', 'INV5-2019', 'INV5010619', '6'),
	(10, '2019-06-14', 'INV6', '2019-06-14', NULL, NULL, 0, 'Ramesh', NULL, NULL, NULL, 'Kamaraj Nagar,Kovilpalyaum, near  by lala sweets shop,, coimbatore., Tamil Nadu', 'intrastate', 'intrastate', '', '', NULL, '1970-01-01', '', NULL, '1254', NULL, 'Pos Device', '', '5000', '1', '6500.00', NULL, '8740.00', NULL, NULL, '8740.00', NULL, NULL, '1', NULL, NULL, '7'),
	(11, '2019-06-14', 'INV6', '2019-06-14', NULL, NULL, 0, 'Ramesh', NULL, NULL, NULL, 'Kamaraj Nagar,Kovilpalyaum, near  by lala sweets shop,, coimbatore., Tamil Nadu', 'intrastate', 'intrastate', '', '', NULL, '1970-01-01', '', NULL, '0', NULL, 'teak wood', '', '1000', '2', '2240.00', NULL, '8740.00', NULL, NULL, '8740.00', NULL, NULL, '1', NULL, NULL, '7'),
	(12, '2019-06-24', 'INV7', '2019-06-24', NULL, NULL, 8, 'Kumar Kumar', NULL, NULL, NULL, 'Coimbatore, Coimbatore, Coimbatore, Tamil Nadu', 'intrastate', 'intrastate', '', 'Tn 38 bj 5989', NULL, '1970-01-01', '', NULL, '8414', NULL, 'Sullube Oil - 250025-669', '', '1', '2', '2', NULL, '9432.00', NULL, NULL, '9432.00', NULL, NULL, '1', 'INV7-2019', 'INV7240619', '8'),
	(13, '2019-06-28', 'INV8', '2019-06-28', NULL, NULL, 6, 'Karikaliamman Spinning Mills Pvt Ltd', NULL, NULL, NULL, 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via), Erode, Tamil Nadu', 'intrastate', 'intrastate', '', '', NULL, '1970-01-01', '', NULL, '6510', NULL, 'fliter paper', '', '5', '20', '1', NULL, '1415.00', NULL, NULL, '1415.00', NULL, NULL, '1', 'INV8-2019', 'INV8280619', '9'),
	(14, '2019-06-28', 'INV8', '2019-06-28', NULL, NULL, 6, 'Karikaliamman Spinning Mills Pvt Ltd', NULL, NULL, NULL, 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via), Erode, Tamil Nadu', 'intrastate', 'intrastate', '', '', NULL, '1970-01-01', '', NULL, '8414', NULL, 'Sullube Oil - 250025-669', '', '0', '5', '1', NULL, '1415.00', NULL, NULL, '1415.00', NULL, NULL, '1', 'INV8-2019', 'INV8280619', '9'),
	(15, '2019-07-16', 'INV9', '2019-07-16', NULL, NULL, 6, 'Karikaliamman Spinning Mills Pvt Ltd', NULL, NULL, NULL, 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via), Erode, Tamil Nadu', 'intrastate', 'intrastate', '', '', NULL, '1970-01-01', '', NULL, '452', NULL, 'Tissues Paper', '', '1', '120', '2', NULL, '20160.00', NULL, NULL, '20160.00', NULL, NULL, '1', 'INV9-2019', 'INV9160719', '10'),
	(16, '2019-08-01', 'INV10', '2019-08-01', NULL, NULL, 5, 'Ramesh', NULL, NULL, NULL, 'Kamaraj Nagar,Kovilpalyaum, near  by lala sweets shop,, coimbatore., Tamil Nadu', 'intrastate', 'intrastate', '', '', NULL, '1970-01-01', '', NULL, NULL, NULL, 'bio power 100', '', '1', '1', 'N', NULL, 'NaN', NULL, NULL, 'NaN', NULL, NULL, '1', 'INV10-2019', 'INV10010819', '11'),
	(17, '2019-08-01', 'INV10', '2019-08-01', NULL, NULL, 5, 'Ramesh', NULL, NULL, NULL, 'Kamaraj Nagar,Kovilpalyaum, near  by lala sweets shop,, coimbatore., Tamil Nadu', 'intrastate', 'intrastate', '', '', NULL, '1970-01-01', '', NULL, NULL, NULL, 'Grap Board', '', '0', '1', 'a', NULL, 'NaN', NULL, NULL, 'NaN', NULL, NULL, '1', 'INV10-2019', 'INV10010819', '11'),
	(18, '2019-08-03', 'INV1', '2019-08-03', NULL, NULL, 1, 'vincent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'WATER BOTTEL', '', '5', '1', '5', NULL, '50.00', NULL, NULL, '52.00', NULL, NULL, '1', 'INV1-2019', 'INV1030819', '12'),
	(19, '2019-08-03', 'INV1', '2019-08-03', NULL, NULL, 5, 'Ramesh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'teak wood', '', '1', '6', '6', NULL, '219448.00', NULL, NULL, '219448.00', NULL, NULL, '1', 'INV1-2019', 'INV1030819', '14'),
	(20, '2019-08-03', 'INV1', '2019-08-03', NULL, NULL, 5, 'Ramesh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'Sullube Oil - 250025-669', '', '0', '8', '0', NULL, '219448.00', NULL, NULL, '219448.00', NULL, NULL, '1', 'INV1-2019', 'INV1030819', '14'),
	(21, '2019-08-03', 'INV1', '2019-08-03', NULL, NULL, 2, 'Ragul kumar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'Sullube Oil - 250025-669', '', '2', '2', '5', NULL, '56362.00', NULL, NULL, '56362.00', NULL, NULL, '1', 'INV1-2019', 'INV1030819', '15'),
	(22, '2019-08-03', 'INV1', '2019-08-03', NULL, NULL, 2, 'Ragul kumar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'teak wood', '', '6', '3', '3', NULL, '56362.00', NULL, NULL, '56362.00', NULL, NULL, '1', 'INV1-2019', 'INV1030819', '15'),
	(23, '2019-08-03', 'INV1', '2019-08-03', NULL, NULL, 7, 'SANMUGANTHAN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'teak wood', '', '1', '1', '1', NULL, '1000.00', NULL, NULL, '1000.00', NULL, NULL, '1', 'INV1-2019', 'INV1030819', '16'),
	(24, '2019-08-03', 'INV1', '2019-08-03', NULL, NULL, 2, 'Ragul kumar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'Grap Board', '', '1', '1', '1', NULL, '150.00', NULL, NULL, '150.00', NULL, NULL, '1', 'INV1-2019', 'INV1030819', '17'),
	(25, '2019-08-03', 'INV1', '2019-08-03', NULL, NULL, 2, 'Ragul kumar', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1970-01-01', NULL, NULL, NULL, NULL, 'teak wood', '', '1', '1', '1', NULL, '1000.00', NULL, NULL, '1000.00', NULL, NULL, '1', 'INV1-2019', 'INV1030819', '18');
/*!40000 ALTER TABLE `invoice_reports` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.inward_delivery
CREATE TABLE IF NOT EXISTS `inward_delivery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `insertid` int(11) NOT NULL,
  `date` date NOT NULL,
  `inwardno` varchar(255) NOT NULL,
  `inwarddate` date NOT NULL,
  `cusname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `customerdcno` varchar(255) NOT NULL,
  `customerdcdate` date NOT NULL,
  `itemname` longtext NOT NULL,
  `item_desc` text NOT NULL,
  `qty` longtext NOT NULL,
  `balanceqty` varchar(225) DEFAULT NULL,
  `remarks` longtext NOT NULL,
  `hsnno` longtext,
  `uom` longtext,
  `inwardnoyear` varchar(225) DEFAULT NULL,
  `inwardnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `inward_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table shanmuga_vilas.inward_delivery: ~3 rows (approximately)
/*!40000 ALTER TABLE `inward_delivery` DISABLE KEYS */;
INSERT INTO `inward_delivery` (`id`, `insertid`, `date`, `inwardno`, `inwarddate`, `cusname`, `address`, `customerdcno`, `customerdcdate`, `itemname`, `item_desc`, `qty`, `balanceqty`, `remarks`, `hsnno`, `uom`, `inwardnoyear`, `inwardnodate`, `status`, `inward_status`) VALUES
	(1, 1, '2019-08-03', 'I', '2019-08-03', 'Karikaliamman Spinning Mills Pvt Ltd', 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via)', '12333333', '2019-06-28', '', '', '', '5', '', '6510', NULL, 'I1-19', 'I1030819', 1, 1),
	(2, 1, '2019-08-03', 'I', '2019-08-03', 'Karikaliamman Spinning Mills Pvt Ltd', 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via)', '12333333', '2019-06-28', 'Sullube Oil - 250025-669', '', '2', '89', '', '8414', 'Pail', 'I2-19', 'I2030819', 1, 1),
	(3, 0, '2019-08-03', '', '2019-08-03', '', '', '', '0000-00-00', 'teak wood', '', '1', '84.75', '', NULL, 'kgs', 'I2-19', 'I2030819', 1, 1);
/*!40000 ALTER TABLE `inward_delivery` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.inward_details
CREATE TABLE IF NOT EXISTS `inward_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `inwardno` varchar(255) NOT NULL,
  `inwarddate` date NOT NULL,
  `cusname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `customerdcno` varchar(255) NOT NULL,
  `customerdcdate` date NOT NULL,
  `itemname` longtext NOT NULL,
  `item_desc` text NOT NULL,
  `qty` longtext NOT NULL,
  `remarks` longtext NOT NULL,
  `hsnno` longtext,
  `uom` longtext,
  `inwardnoyear` varchar(225) DEFAULT NULL,
  `inwardnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `inward_delivery_id` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.inward_details: ~2 rows (approximately)
/*!40000 ALTER TABLE `inward_details` DISABLE KEYS */;
INSERT INTO `inward_details` (`id`, `date`, `inwardno`, `inwarddate`, `cusname`, `address`, `customerdcno`, `customerdcdate`, `itemname`, `item_desc`, `qty`, `remarks`, `hsnno`, `uom`, `inwardnoyear`, `inwardnodate`, `status`, `delete_status`, `inward_delivery_id`) VALUES
	(1, '2019-06-28', 'I', '2019-06-28', 'Karikaliamman Spinning Mills Pvt Ltd', 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via)', '12333333', '2019-06-28', 'fliter paper||Sullube Oil - 250025-669', '', '25||25', '', '6510||8414', 'nos||Pail', 'I-19', 'I280619', 1, 0, '1,2'),
	(2, '2019-08-03', 'I1', '2019-08-03', '', '', '', '0000-00-00', 'fliter paper', '', '100', '', NULL, 'nos', 'I1-19', 'I1030819', 1, 1, '');
/*!40000 ALTER TABLE `inward_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.jobinward_data
CREATE TABLE IF NOT EXISTS `jobinward_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `insertid` int(11) DEFAULT NULL,
  `jobinwardno` varchar(225) DEFAULT NULL,
  `joborderno` varchar(225) DEFAULT NULL,
  `itemname` varchar(225) DEFAULT NULL,
  `qty` varchar(225) DEFAULT NULL,
  `joborderqty` varchar(225) DEFAULT NULL,
  `hsnno` varchar(225) DEFAULT NULL,
  `uom` varchar(225) DEFAULT NULL,
  `returnitemname` varchar(225) DEFAULT NULL,
  `returnqty` varchar(225) DEFAULT NULL,
  `scrap` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `job_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table shanmuga_vilas.jobinward_data: ~0 rows (approximately)
/*!40000 ALTER TABLE `jobinward_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobinward_data` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.jobinward_details
CREATE TABLE IF NOT EXISTS `jobinward_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `jobtype` varchar(225) DEFAULT NULL,
  `jobinwardno` varchar(225) DEFAULT NULL,
  `jobinwarddate` date DEFAULT NULL,
  `dateofcompletion` date DEFAULT NULL,
  `operatorname` varchar(225) DEFAULT NULL,
  `vendors` varchar(225) DEFAULT NULL,
  `vendordetails` longtext,
  `joborderno` varchar(225) DEFAULT NULL,
  `category` longtext,
  `jobdescription` longtext,
  `issueby` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table shanmuga_vilas.jobinward_details: ~0 rows (approximately)
/*!40000 ALTER TABLE `jobinward_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobinward_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.job_data
CREATE TABLE IF NOT EXISTS `job_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `insertid` int(11) DEFAULT NULL,
  `joborderno` varchar(225) DEFAULT NULL,
  `itemname` varchar(225) DEFAULT NULL,
  `qty` varchar(225) DEFAULT NULL,
  `hsnno` varchar(225) DEFAULT NULL,
  `uom` varchar(225) DEFAULT NULL,
  `returnitemname` varchar(225) DEFAULT NULL,
  `returnqty` varchar(225) DEFAULT NULL,
  `scrap` varchar(225) DEFAULT NULL,
  `balanceqty` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `job_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.job_data: ~0 rows (approximately)
/*!40000 ALTER TABLE `job_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_data` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.job_details
CREATE TABLE IF NOT EXISTS `job_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `jobtype` varchar(225) DEFAULT NULL,
  `joborderno` varchar(225) DEFAULT NULL,
  `joborderdate` date DEFAULT NULL,
  `dateofcompletion` date DEFAULT NULL,
  `operatorname` varchar(225) DEFAULT NULL,
  `vendors` varchar(225) DEFAULT NULL,
  `vendordetails` longtext,
  `category` longtext,
  `jobdescription` longtext,
  `issueby` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.job_details: ~0 rows (approximately)
/*!40000 ALTER TABLE `job_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.login_details
CREATE TABLE IF NOT EXISTS `login_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userType` char(1) NOT NULL,
  `date` date DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phoneno` varchar(255) DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `sub_menu_link` text,
  `selectedMainMenu` text NOT NULL,
  `selectedSubMenu` text NOT NULL,
  `add_party` int(11) DEFAULT NULL,
  `add_expenses` int(11) DEFAULT NULL,
  `add_quotation` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.login_details: ~5 rows (approximately)
/*!40000 ALTER TABLE `login_details` DISABLE KEYS */;
INSERT INTO `login_details` (`id`, `userType`, `date`, `name`, `designation`, `email`, `phoneno`, `doj`, `username`, `password`, `status`, `sub_menu_link`, `selectedMainMenu`, `selectedSubMenu`, `add_party`, `add_expenses`, `add_quotation`) VALUES
	(1, 'A', '2017-01-26', 'admin', '', 'test@gmail.com', '876049652', '0000-00-00', 'admin', 'Myoffice!@#$%', '1', '', '', '', NULL, NULL, NULL),
	(5, 'U', '2018-05-02', 'purchase', 'Purchase Team', '', '', '1970-01-01', 'purchase', '123456', '1', 'purchase,inward,inward/view,inward/pending,stockmaster,daily_stockreports,customer/view', 'Purchase,Inward,Inward,Inward,Stock,Stock,Reports', 'Purchase Receipt,Add Inward,Inward Reports,Inward Pending,Add Stock,Daily Stock Reports,Party Reports', 1, 0, 0),
	(6, 'U', '2018-05-02', 'Accounts', 'Accounts Team', '', '', '1970-01-01', 'Accounts', '123456', '1', 'invoice_statement/view,tax/view,cashbill/listing,purchase_statement/view,purchasetax/view,voucher,voucher/reports,stockmaster,daily_stockreports,itemwise_report,expenses/reports,quotation/view', 'Sales Invoice,Sales Invoice,Cash Bill,Purchase,Purchase,Voucher,Voucher,Stock,Stock,Stock,Reports,Reports', 'Invoice Party Statement,Invoice Tax Reports,Cash Bill Reports,Purchase Party Statement,Purchase Tax Reports,Add Voucher,Voucher Reports,Add Stock,Daily Stock Reports,Itemwise Reports,Expenses Reports,Quotation Reports', 0, 0, 0),
	(7, 'U', '2019-03-08', 'ramesh', 'developer', '', '', '1970-01-01', 'ramesh', '123456', '1', 'dashboard,invoice,invoice/view,invoice_statement/view,tax/view,proforma_invoice,purchase,purchase_statement/view,purchasetax/view,stockmaster,itemmaster', 'dashboard,Sales Invoice,Sales Invoice,Sales Invoice,Sales Invoice,Sales Invoice,Purchase,Purchase,Purchase,Stock,Settings', 'Dashboard,Add Invoice,Invoice Reports,Invoice Party Statement,Invoice Tax Reports,Add Proforma Invoice,Purchase Receipt,Purchase Party Statement,Purchase Tax Reports,Add Stock,Add Item', 0, 0, 0),
	(8, 'U', '2019-03-01', 'tester1', 'testing', '', '', '1970-01-01', 'tester1', '123456', '1', 'dashboard,invoice,invoice/view,invoice_statement/view,tax/view,proforma_invoice,purchase,purchase/view,purchase_statement/view,purchasetax/view,taxtype,uom', 'dashboard,Sales Invoice,Sales Invoice,Sales Invoice,Sales Invoice,Sales Invoice,Purchase,Purchase,Purchase,Purchase,Settings,Settings', 'Dashboard,Add Invoice,Invoice Reports,Invoice Party Statement,Invoice Tax Reports,Add Proforma Invoice,Purchase Receipt,Purchase Reports,Purchase Party Statement,Purchase Tax Reports,Tax Type,Add UOM', 1, 0, 0);
/*!40000 ALTER TABLE `login_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.material_details
CREATE TABLE IF NOT EXISTS `material_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `stocktype` varchar(225) DEFAULT NULL,
  `dcno` varchar(225) DEFAULT NULL,
  `dcdate` date DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `cusname` varchar(225) DEFAULT NULL,
  `dispatchthrough` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `inwardno` longtext,
  `customerdcno` longtext,
  `customerdcdate` longtext,
  `itemname` longtext,
  `item_desc` text NOT NULL,
  `qty` longtext,
  `remarks` longtext,
  `hsnno` longtext,
  `uom` longtext,
  `dcnoyear` varchar(225) DEFAULT NULL,
  `dcnodate` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_status` int(11) DEFAULT NULL,
  `billtype` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.material_details: ~6 rows (approximately)
/*!40000 ALTER TABLE `material_details` DISABLE KEYS */;
INSERT INTO `material_details` (`id`, `date`, `stocktype`, `dcno`, `dcdate`, `customerId`, `cusname`, `dispatchthrough`, `address`, `inwardno`, `customerdcno`, `customerdcdate`, `itemname`, `item_desc`, `qty`, `remarks`, `hsnno`, `uom`, `dcnoyear`, `dcnodate`, `status`, `delete_status`, `billtype`) VALUES
	(3, '2019-08-01', 'SWEETS', '2', '2019-08-01', 0, 'ravi', '', '', NULL, NULL, NULL, 'gtv body paatern', '', '1', 'new', NULL, 'nos', '2-19', '2010819', 1, 1, ''),
	(4, '2019-08-01', 'SWEETS', '3', '2019-08-01', 0, '', '', '', NULL, NULL, NULL, 'gtv body paatern||Chart card', '||', '1||1', '||', NULL, 'nos||nos', '3-19', '3010819', 1, 1, ''),
	(5, '2019-08-01', '', '4', '2019-08-01', 0, '', '', '', NULL, NULL, NULL, 'gtv body paatern', '', '1', '', NULL, 'nos', '4-19', '4010819', 1, 1, ''),
	(6, '2019-08-01', '', '5', '2019-08-01', 0, '', '', '', NULL, NULL, NULL, 'gtv body paatern', '', '1', '', NULL, 'nos', '4-19', '4010819', 1, 1, ''),
	(7, '2019-08-01', '', '6', '2019-08-01', 0, '', '', '', NULL, NULL, NULL, 'WATER BOTTEL', '', '100', '', NULL, 'nos', '6-19', '6010819', 1, 1, ''),
	(8, '2019-08-01', 'SWEETS', '7', '2019-08-01', 0, '', '', '', NULL, NULL, NULL, 'gtv body paatern||Chart card', '||', '10||10', '||', NULL, 'nos||nos', '3-19', '3010819', 1, 1, '');
/*!40000 ALTER TABLE `material_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.po_party_statements
CREATE TABLE IF NOT EXISTS `po_party_statements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `purchasedate` date DEFAULT NULL,
  `receiptno` varchar(255) DEFAULT NULL,
  `purchaseno` varchar(255) DEFAULT NULL,
  `supplierId` int(11) NOT NULL,
  `suppliername` varchar(255) DEFAULT NULL,
  `mobileno` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `currentpaid` varchar(255) NOT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `paidamount` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `paymentmode` varchar(255) DEFAULT NULL,
  `throughcheck` varchar(255) DEFAULT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `chamount` varchar(255) DEFAULT NULL,
  `banktransfer` varchar(255) DEFAULT NULL,
  `bankamount` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `paymentdetails` varchar(255) DEFAULT NULL,
  `openingbalance` varchar(225) DEFAULT NULL,
  `receiptamt` varchar(255) DEFAULT NULL,
  `returnamount` varchar(255) DEFAULT NULL,
  `purchaseamt` varchar(255) DEFAULT NULL,
  `formtype` varchar(255) DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `purchasenodate` varchar(255) DEFAULT NULL,
  `purchasenoyear` varchar(255) DEFAULT NULL,
  `purchaseid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.po_party_statements: ~2 rows (approximately)
/*!40000 ALTER TABLE `po_party_statements` DISABLE KEYS */;
INSERT INTO `po_party_statements` (`id`, `date`, `purchasedate`, `receiptno`, `purchaseno`, `supplierId`, `suppliername`, `mobileno`, `address`, `itemname`, `qty`, `total`, `currentpaid`, `purpose`, `payment`, `paid`, `paidamount`, `balance`, `paymentmode`, `throughcheck`, `chequeno`, `chamount`, `banktransfer`, `bankamount`, `amount`, `paymentdetails`, `openingbalance`, `receiptamt`, `returnamount`, `purchaseamt`, `formtype`, `invoiceno`, `invoicedate`, `status`, `purchasenodate`, `purchasenoyear`, `purchaseid`) VALUES
	(1, '2019-05-20', '2019-05-22', '-', 'P', 3, 'krishna', NULL, NULL, 'fliter paper', NULL, '1680.00', '-', '-', '-', NULL, '-', '100110.4', NULL, '-', '-', '-', '-', '-', '1680.00', '-', NULL, '-', NULL, '1680.00', NULL, '5879', '2019-05-20', '1', 'P220519', 'P-2019', '1'),
	(2, '2019-06-01', '2019-06-01', '-', 'P1', 3, 'krishna', NULL, NULL, 'teak wood', NULL, '56000.00', '-', '-', '-', NULL, '-', '156110.4', NULL, '-', '-', '-', '-', '-', '56000.00', '-', NULL, '-', NULL, '56000.00', NULL, '455', '2019-06-01', '1', 'P1010619', 'P1-2019', '2');
/*!40000 ALTER TABLE `po_party_statements` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.preference_details
CREATE TABLE IF NOT EXISTS `preference_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `sed` varchar(255) DEFAULT NULL,
  `edc` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.preference_details: ~0 rows (approximately)
/*!40000 ALTER TABLE `preference_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `preference_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.preference_settings
CREATE TABLE IF NOT EXISTS `preference_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation` varchar(255) NOT NULL,
  `expenses` varchar(255) NOT NULL,
  `dc` varchar(255) NOT NULL,
  `voucher` varchar(255) NOT NULL,
  `debit` varchar(255) NOT NULL,
  `credit` varchar(255) NOT NULL,
  `purchase` varchar(255) NOT NULL,
  `invoicePrefix` varchar(255) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `proforma_invoicePrefix` varchar(255) NOT NULL,
  `proforma_invoice` varchar(255) NOT NULL,
  `inward` varchar(255) NOT NULL,
  `cashbill_invoice` varchar(255) NOT NULL,
  `purchaseorder` varchar(255) NOT NULL,
  `cmp_companyname` varchar(255) NOT NULL,
  `cmp_phoneno` varchar(255) NOT NULL,
  `cmp_mobileno` varchar(255) NOT NULL,
  `cmp_address1` varchar(255) NOT NULL,
  `cmp_address2` varchar(255) NOT NULL,
  `cmp_city` varchar(255) NOT NULL,
  `cmp_pincode` varchar(255) NOT NULL,
  `cmp_stateCode` varchar(255) NOT NULL,
  `cmp_website` varchar(255) NOT NULL,
  `cmp_emailid` varchar(255) NOT NULL,
  `cmp_logo` varchar(255) NOT NULL,
  `cont_companyname` varchar(255) NOT NULL,
  `cont_phoneno` varchar(255) NOT NULL,
  `cont_mobileno` varchar(255) NOT NULL,
  `cont_address1` varchar(255) NOT NULL,
  `cont_address2` varchar(255) NOT NULL,
  `cont_city` varchar(255) NOT NULL,
  `cont_pincode` varchar(255) NOT NULL,
  `cont_stateCode` varchar(255) NOT NULL,
  `cont_website` varchar(255) NOT NULL,
  `cont_emailid` varchar(255) NOT NULL,
  `cont_logo` varchar(255) NOT NULL,
  `discountBy` varchar(255) NOT NULL,
  `invoiceBy` varchar(255) NOT NULL,
  `itemType` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.preference_settings: ~1 rows (approximately)
/*!40000 ALTER TABLE `preference_settings` DISABLE KEYS */;
INSERT INTO `preference_settings` (`id`, `quotation`, `expenses`, `dc`, `voucher`, `debit`, `credit`, `purchase`, `invoicePrefix`, `invoice`, `proforma_invoicePrefix`, `proforma_invoice`, `inward`, `cashbill_invoice`, `purchaseorder`, `cmp_companyname`, `cmp_phoneno`, `cmp_mobileno`, `cmp_address1`, `cmp_address2`, `cmp_city`, `cmp_pincode`, `cmp_stateCode`, `cmp_website`, `cmp_emailid`, `cmp_logo`, `cont_companyname`, `cont_phoneno`, `cont_mobileno`, `cont_address1`, `cont_address2`, `cont_city`, `cont_pincode`, `cont_stateCode`, `cont_website`, `cont_emailid`, `cont_logo`, `discountBy`, `invoiceBy`, `itemType`) VALUES
	(1, '', '', '', '', '', '', '', 'INV', '', 'P', '', '', '', '', 'Myoffice Solutions', '04222570103', '8608701222', '#91, Dr. Jaganathan Nagar, ', 'Civil Aerodrome Post', 'Coimbatore', '641 014', '33', 'www.idreamdevelopers.org', 'info@idreamdevelopers.com', '12832299_1579401915712151_5416626780361493206_n.png', 'IDREAMDEVELOPERS', '04222570103', '8608701333', '#91, Dr. Jaganathan Nagar, ', 'Civil Aerodrome Post', 'Coimbatore', '641 014', '33', 'www.idreamdevelopers.com', 'info@idreamdevelopers.com', 'idream_logo.PNG', 'percent_wise', 'without_stock', 'with_item');
/*!40000 ALTER TABLE `preference_settings` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.profile
CREATE TABLE IF NOT EXISTS `profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `companyname` varchar(255) DEFAULT NULL,
  `softwarename` varchar(255) DEFAULT NULL,
  `mobileno` varchar(255) DEFAULT NULL,
  `phoneno` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `stateCode` varchar(255) NOT NULL,
  `emailid` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `tinno` varchar(255) DEFAULT NULL,
  `cstno` varchar(255) DEFAULT NULL,
  `gstin` varchar(225) DEFAULT NULL,
  `aadharno` varchar(225) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `bankname` varchar(255) DEFAULT NULL,
  `accountno` varchar(255) DEFAULT NULL,
  `bankbranch` varchar(255) DEFAULT NULL,
  `ifsccode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.profile: ~1 rows (approximately)
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` (`id`, `date`, `companyname`, `softwarename`, `mobileno`, `phoneno`, `address1`, `address2`, `city`, `pincode`, `stateCode`, `emailid`, `website`, `tinno`, `cstno`, `gstin`, `aadharno`, `status`, `username`, `password`, `bankname`, `accountno`, `bankbranch`, `ifsccode`) VALUES
	(1, NULL, 'Myoffice BILLING', 'Myoffice BILLING', '9943744177', '0422-2668244', ' #91, Dr, Jaganathan Nagar CMC opp', 'Civil Aerodrome Post', 'Dharmapuri', '641035', 'Tamil Nadu', 'info@idreamdevelopers.com', 'www.idreamdevelopers.org', '12345', '54321', '33AFYPV3340K1ZT', '', '1', 'admin', 'Myoffice!@#$%', 'THE KARUR VYSYA BANK LTD.,', '1748115000002961', 'SARAVANAMPATTI', 'KVBL0001748');
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.proforma_invoice_details
CREATE TABLE IF NOT EXISTS `proforma_invoice_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `orderno` varchar(255) DEFAULT NULL,
  `orderdate` date DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `dcno` longtext,
  `bill_type` varchar(255) NOT NULL,
  `invoicetype` varchar(225) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `deliveryat` varchar(225) DEFAULT NULL,
  `transportmode` varchar(255) DEFAULT NULL,
  `vehicleno` varchar(225) DEFAULT NULL,
  `billtype` varchar(255) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `dcnos` longtext,
  `insertid` varchar(225) DEFAULT NULL,
  `deliveryid` longtext,
  `hsnno` longtext,
  `itemname` longtext,
  `item_desc` text NOT NULL,
  `uom` longtext,
  `rate` longtext,
  `qty` longtext,
  `amount` longtext,
  `discount` longtext,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightamount` varchar(225) DEFAULT NULL,
  `freightcgst` varchar(225) DEFAULT NULL,
  `freightcgstamount` varchar(225) DEFAULT NULL,
  `freightsgst` varchar(225) DEFAULT NULL,
  `freightsgstamount` varchar(225) DEFAULT NULL,
  `freightigst` varchar(225) DEFAULT NULL,
  `freightigstamount` varchar(225) DEFAULT NULL,
  `freighttotal` varchar(225) DEFAULT NULL,
  `loadingamount` varchar(225) DEFAULT NULL,
  `loadingcgst` varchar(225) DEFAULT NULL,
  `loadingcgstamount` varchar(225) DEFAULT NULL,
  `loadingsgst` varchar(225) DEFAULT NULL,
  `loadingsgstamount` varchar(225) DEFAULT NULL,
  `loadingigst` varchar(225) DEFAULT NULL,
  `loadingigstamount` varchar(225) DEFAULT NULL,
  `loadingtotal` varchar(225) DEFAULT NULL,
  `roundOff` varchar(255) NOT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `invoicenodate` varchar(225) DEFAULT NULL,
  `invoicenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.proforma_invoice_details: ~3 rows (approximately)
/*!40000 ALTER TABLE `proforma_invoice_details` DISABLE KEYS */;
INSERT INTO `proforma_invoice_details` (`id`, `date`, `invoicedate`, `orderno`, `orderdate`, `invoiceno`, `dcno`, `bill_type`, `invoicetype`, `customerId`, `customername`, `address`, `deliveryat`, `transportmode`, `vehicleno`, `billtype`, `gsttype`, `typesgst`, `typecgst`, `typeigst`, `dcnos`, `insertid`, `deliveryid`, `hsnno`, `itemname`, `item_desc`, `uom`, `rate`, `qty`, `amount`, `discount`, `discountBy`, `discountamount`, `taxableamount`, `sgst`, `sgstamount`, `cgst`, `cgstamount`, `igst`, `igstamount`, `total`, `subtotal`, `freightamount`, `freightcgst`, `freightcgstamount`, `freightsgst`, `freightsgstamount`, `freightigst`, `freightigstamount`, `freighttotal`, `loadingamount`, `loadingcgst`, `loadingcgstamount`, `loadingsgst`, `loadingsgstamount`, `loadingigst`, `loadingigstamount`, `loadingtotal`, `roundOff`, `othercharges`, `return_status`, `grandtotal`, `invoicenodate`, `invoicenoyear`, `status`, `edit_status`) VALUES
	(1, '2019-02-22', '2019-02-22', '4101', '2019-02-22', 'P', NULL, 'Sales Invoice', '0', 2, 'Ragul kumar', '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', 'Erode', '', 'TN 48 DC 2104', 'intrastate', 'intrastate', 'sgst', 'cgst', '', NULL, '0', NULL, '0', 'teak wood', '', 'kgs', '1000', '10', '10000.00', '0', 'percent_wise', '0.00', '10000.00', '6', '600.00', '6', '600.00', '12', '1200.00', '11200.00', '11200.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '11200.00', 'P220219', 'P-2019', 1, 1),
	(2, '2019-02-22', '2019-02-22', '10112', '2019-02-22', 'P1', NULL, 'Sales Invoice', '0', 2, 'Ragul kumar', '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', 'Vellore', '', 'TN 48 DC 2104', 'intrastate', 'intrastate', 'sgst', 'cgst', '', NULL, '0', NULL, '0', 'teak wood', '', 'kgs', '1000', '1', '1000.00', '0', 'percent_wise', '0.00', '1000.00', '6', '60.00', '6', '60.00', '12', '120.00', '1120.00', '1120.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '1120.00', 'P1220219', 'P1-2019', 1, 1),
	(3, '2019-03-29', '2019-03-29', 'L800', '2019-03-29', 'P2', NULL, 'Sales Invoice', '0', 6, 'Karikaliamman Spinning Mills Pvt Ltd', 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via), Erode, Tamil Nadu', '', '', '', 'intrastate', 'intrastate', 'sgst', 'cgst', '', NULL, '0', NULL, '8414', 'Sullube Oil - 250025-669', '', 'Pail', '26681', '1', '26681.00', '0', 'percent_wise', '0.00', '26681.00', '9', '2401.29', '9', '2401.29', '18', '4802.58', '31483.58', '31483.58', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '31483.58', 'P2290319', 'P2-2019', 1, 1);
/*!40000 ALTER TABLE `proforma_invoice_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.proforma_invoice_reports
CREATE TABLE IF NOT EXISTS `proforma_invoice_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `invoicedate` varchar(255) DEFAULT NULL,
  `paymenttype` varchar(255) DEFAULT NULL,
  `dcdate` date DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(255) DEFAULT NULL,
  `mobileno` varchar(255) DEFAULT NULL,
  `tinno` varchar(255) DEFAULT NULL,
  `cstno` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gsttype` varchar(255) DEFAULT NULL,
  `billtype` varchar(255) DEFAULT NULL,
  `deliveryat` varchar(255) DEFAULT NULL,
  `vehicleno` varchar(255) DEFAULT NULL,
  `dcno` varchar(255) DEFAULT NULL,
  `orderdate` date DEFAULT NULL,
  `orderno` varchar(255) DEFAULT NULL,
  `despatch` varchar(255) DEFAULT NULL,
  `hsnno` varchar(255) DEFAULT NULL,
  `itemno` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `item_desc` text NOT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `totalamount` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `disamount` varchar(255) DEFAULT NULL,
  `grandtotal` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `invoicenoyear` varchar(255) DEFAULT NULL,
  `invoicenodate` varchar(255) DEFAULT NULL,
  `invoiceid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.proforma_invoice_reports: ~3 rows (approximately)
/*!40000 ALTER TABLE `proforma_invoice_reports` DISABLE KEYS */;
INSERT INTO `proforma_invoice_reports` (`id`, `date`, `invoiceno`, `invoicedate`, `paymenttype`, `dcdate`, `customerId`, `customername`, `mobileno`, `tinno`, `cstno`, `address`, `gsttype`, `billtype`, `deliveryat`, `vehicleno`, `dcno`, `orderdate`, `orderno`, `despatch`, `hsnno`, `itemno`, `itemname`, `item_desc`, `rate`, `qty`, `total`, `totalamount`, `subtotal`, `discount`, `disamount`, `grandtotal`, `paid`, `balance`, `status`, `invoicenoyear`, `invoicenodate`, `invoiceid`) VALUES
	(1, '2019-02-22', 'P', '2019-02-22', NULL, NULL, 2, 'Ragul kumar', NULL, NULL, NULL, '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', 'intrastate', 'intrastate', 'Erode', 'TN 48 DC 2104', NULL, '2019-02-22', '4101', NULL, '0', NULL, 'teak wood', '', '1', '10', '1', NULL, '11200.00', NULL, NULL, '11200.00', NULL, NULL, '1', 'P-2019', 'P220219', '1'),
	(2, '2019-02-22', 'P1', '2019-02-22', NULL, NULL, 2, 'Ragul kumar', NULL, NULL, NULL, '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', 'intrastate', 'intrastate', 'Vellore', 'TN 48 DC 2104', NULL, '2019-02-22', '10112', NULL, '0', NULL, 'teak wood', '', '1', '1', '1', NULL, '1120.00', NULL, NULL, '1120.00', NULL, NULL, '1', 'P1-2019', 'P1220219', '2'),
	(3, '2019-03-29', 'P2', '2019-03-29', NULL, NULL, 6, 'Karikaliamman Spinning Mills Pvt Ltd', NULL, NULL, NULL, 'Elumathur To Poondurai Road, Elumathur, Modakurichi (Via), Erode, Tamil Nadu', 'intrastate', 'intrastate', '', '', NULL, '2019-03-29', 'L800', NULL, '8414', NULL, 'Sullube Oil - 250025-669', '', '2', '1', '3', NULL, '31483.58', NULL, NULL, '31483.58', NULL, NULL, '1', 'P2-2019', 'P2290319', '3');
/*!40000 ALTER TABLE `proforma_invoice_reports` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.proinvoice_party_statement
CREATE TABLE IF NOT EXISTS `proinvoice_party_statement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiptno` varchar(255) DEFAULT NULL,
  `paid` varchar(255) NOT NULL,
  `receiptid` varchar(100) DEFAULT NULL,
  `date` date NOT NULL,
  `invoiceno` varchar(255) NOT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(255) NOT NULL,
  `cstno` varchar(255) NOT NULL,
  `phoneno` varchar(255) NOT NULL,
  `tinno` varchar(255) NOT NULL,
  `itemname` varchar(255) NOT NULL,
  `item_desc` text NOT NULL,
  `rate` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `credit` varchar(255) DEFAULT NULL,
  `debit` varchar(255) DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `receiptdate` date NOT NULL,
  `invoicedate` date NOT NULL,
  `totalamount` varchar(255) NOT NULL,
  `payment` varchar(100) NOT NULL,
  `throughcheck` varchar(255) DEFAULT NULL,
  `balanceamount` varchar(255) NOT NULL,
  `payamount` varchar(255) NOT NULL,
  `paymentmode` varchar(255) DEFAULT NULL,
  `chamount` varchar(255) DEFAULT NULL,
  `paidamount` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `banktransfer` varchar(255) DEFAULT NULL,
  `bankamount` varchar(255) DEFAULT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `paymentdetails` varchar(255) DEFAULT NULL,
  `overallamount` varchar(255) DEFAULT NULL,
  `receiptamt` varchar(255) DEFAULT NULL,
  `invoiceamt` varchar(255) DEFAULT NULL,
  `returnamount` varchar(255) DEFAULT NULL,
  `formtype` varchar(255) DEFAULT NULL,
  `invoicenoyear` varchar(255) DEFAULT NULL,
  `invoicenodate` varchar(255) DEFAULT NULL,
  `invoiceid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.proinvoice_party_statement: ~3 rows (approximately)
/*!40000 ALTER TABLE `proinvoice_party_statement` DISABLE KEYS */;
INSERT INTO `proinvoice_party_statement` (`id`, `receiptno`, `paid`, `receiptid`, `date`, `invoiceno`, `customerId`, `customername`, `cstno`, `phoneno`, `tinno`, `itemname`, `item_desc`, `rate`, `qty`, `credit`, `debit`, `amount`, `total`, `status`, `receiptdate`, `invoicedate`, `totalamount`, `payment`, `throughcheck`, `balanceamount`, `payamount`, `paymentmode`, `chamount`, `paidamount`, `balance`, `banktransfer`, `bankamount`, `chequeno`, `paymentdetails`, `overallamount`, `receiptamt`, `invoiceamt`, `returnamount`, `formtype`, `invoicenoyear`, `invoicenodate`, `invoiceid`) VALUES
	(1, '-', '-', NULL, '2019-02-22', 'P', 2, 'Ragul kumar', '', '', '', 'teak wood', '', '', '', NULL, NULL, '', '', '1', '2019-02-22', '2019-02-22', '11200.00', '-', '-', '', '', '-', '-', NULL, '63760', '-', '-', '-', '-', '11200.00', '-', '11200.00', NULL, NULL, 'P-2019', 'P220219', '1'),
	(2, '-', '-', NULL, '2019-02-22', 'P1', 2, 'Ragul kumar', '', '', '', 'teak wood', '', '', '', NULL, NULL, '', '', '1', '2019-02-22', '2019-02-22', '1120.00', '-', '-', '', '', '-', '-', NULL, '64880', '-', '-', '-', '-', '1120.00', '-', '1120.00', NULL, NULL, 'P1-2019', 'P1220219', '2'),
	(3, '-', '-', NULL, '2019-03-29', 'P2', 6, 'Karikaliamman Spinning Mills Pvt Ltd', '', '', '', 'Sullube Oil - 250025-669', '', '', '', NULL, NULL, '', '', '1', '2019-03-29', '2019-03-29', '31483.58', '-', '-', '', '', '-', '-', NULL, '62967.16', '-', '-', '-', '-', '31483.58', '-', '31483.58', NULL, NULL, 'P2-2019', 'P2290319', '3');
/*!40000 ALTER TABLE `proinvoice_party_statement` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.purchaseorder_details
CREATE TABLE IF NOT EXISTS `purchaseorder_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `purchasedate` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `potype` varchar(255) NOT NULL,
  `purchaseorderno` varchar(225) DEFAULT NULL,
  `purchaseorder` varchar(255) DEFAULT NULL,
  `selected_bom` varchar(255) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `billtype` varchar(225) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `hsnno` longtext,
  `itemname` longtext,
  `uom` longtext,
  `rate` longtext,
  `qty` longtext,
  `balanceqty` varchar(255) DEFAULT NULL,
  `bom_qty` varchar(255) NOT NULL,
  `amount` longtext,
  `discount` longtext,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightamount` varchar(225) DEFAULT NULL,
  `freightcgst` varchar(225) DEFAULT NULL,
  `freightcgstamount` varchar(225) DEFAULT NULL,
  `freightsgst` varchar(225) DEFAULT NULL,
  `freightsgstamount` varchar(225) DEFAULT NULL,
  `freightigst` varchar(225) DEFAULT NULL,
  `freightigstamount` varchar(225) DEFAULT NULL,
  `freighttotal` varchar(225) DEFAULT NULL,
  `loadingamount` varchar(225) DEFAULT NULL,
  `loadingcgst` varchar(225) DEFAULT NULL,
  `loadingcgstamount` varchar(225) DEFAULT NULL,
  `loadingsgst` varchar(225) DEFAULT NULL,
  `loadingsgstamount` varchar(225) DEFAULT NULL,
  `loadingigst` varchar(225) DEFAULT NULL,
  `loadingigstamount` varchar(225) DEFAULT NULL,
  `loadingtotal` varchar(225) DEFAULT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `roundOff` varchar(255) NOT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `purchasenodate` varchar(225) DEFAULT NULL,
  `purchasenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.purchaseorder_details: ~5 rows (approximately)
/*!40000 ALTER TABLE `purchaseorder_details` DISABLE KEYS */;
INSERT INTO `purchaseorder_details` (`id`, `date`, `purchasedate`, `invoicedate`, `potype`, `purchaseorderno`, `purchaseorder`, `selected_bom`, `customerId`, `customername`, `address`, `invoiceno`, `billtype`, `gsttype`, `typesgst`, `typecgst`, `typeigst`, `hsnno`, `itemname`, `uom`, `rate`, `qty`, `balanceqty`, `bom_qty`, `amount`, `discount`, `discountBy`, `discountamount`, `taxableamount`, `sgst`, `sgstamount`, `cgst`, `cgstamount`, `igst`, `igstamount`, `total`, `subtotal`, `freightamount`, `freightcgst`, `freightcgstamount`, `freightsgst`, `freightsgstamount`, `freightigst`, `freightigstamount`, `freighttotal`, `loadingamount`, `loadingcgst`, `loadingcgstamount`, `loadingsgst`, `loadingsgstamount`, `loadingigst`, `loadingigstamount`, `loadingtotal`, `othercharges`, `roundOff`, `return_status`, `grandtotal`, `purchasenodate`, `purchasenoyear`, `status`, `edit_status`) VALUES
	(1, '2019-02-22', '2019-02-22', '2019-02-22', 'Direct PO', 'P', '5101', NULL, 0, 'Ragul kumar', '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', '0', 'intrastate', 'intrastate', 'sgst', 'cgst', '', '0', 'teak wood', 'kgs', '1000', '10', '10', '0', '10000.00', '0', 'percent_wise', '0.00', '10000.00', '6', '600.00', '6', '600.00', '0', '0', '11200.00', '11200.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '11200.00', 'P220219', 'P-2019', 1, 0),
	(2, '2019-02-22', '2019-02-22', '2019-02-22', 'Direct PO', 'P1', '1012', NULL, 2, 'Ragul kumar', '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', '0', 'intrastate', 'intrastate', 'sgst', 'cgst', '', '0', 'teak wood', 'kgs', '1000', '10', '10', '0', '10000.00', '0', 'percent_wise', '0.00', '10000.00', '6', '600.00', '6', '600.00', '0', '0', '11200.00', '11200.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '11200.00', 'P1220219', 'P1-2019', 1, 0),
	(4, '2019-03-21', '2019-03-21', '2019-03-21', 'Direct PO', 'P2', '8541', NULL, 0, 'Ramesh', 'Kamaraj Nagar,Kovilpalyaum, near  by lala sweets shop,, coimbatore., Tamil Nadu', '0', 'intrastate', 'intrastate', 'sgst', 'cgst', '', '23454||452', 'gtv body paatern||Tissues Paper', 'nos||nos', '23000||150', '10||12', '10||12', '0||0', '230000.00||1800.00', '0||0', 'percent_wise', '||', '230000.00||1800.00', '6||6', '13800.00||108.00', '6||6', '13800.00||108.00', '0||0', '0||0', '257600.00||2016.00', '259616.00', '', '0', '', '0', '', '0', '0', '', '', '0', '', '0', '', '0', '0', '', '0', '0', '1||1', '259616.00', 'P2210319', 'P2-2019', 1, 1),
	(5, '2019-03-29', '2019-03-29', '2019-03-29', 'Direct PO', 'P3', '798', NULL, 2, 'Ragul kumar', '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', '0', 'intrastate', 'intrastate', 'sgst', 'cgst', '', '1503', 'Chart card', 'nos', '10', '10', '10', '0', '100.00', '0', 'percent_wise', '0.00', '100.00', '6', '6.00', '6', '6.00', '0', '0', '112.00', '112.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '112.00', 'P3290319', 'P3-2019', 1, 0),
	(6, '2019-06-11', '2019-06-11', '2019-06-10', 'Direct PO', 'P4', '4562', NULL, 5, 'Ramesh', 'Kamaraj Nagar,Kovilpalyaum, near  by lala sweets shop,, coimbatore., Tamil Nadu', '0', 'intrastate', 'intrastate', 'sgst', 'cgst', '', '0||101||1503', 'teak wood||Grap Board||Chart card', 'kgs||kgs||nos', '1000||150||0', '5||2||1', '5||2||1', '0||0||0', '5000.00||300.00||0.00', '0||0||0', 'percent_wise', '0.00||0.00||0.00', '5000.00||300.00||0.00', '6||6||6', '300.00||18.00||0.00', '6||6||6', '300.00||18.00||0.00', '0||0||0', '0||0||0', '5600.00||336.00||0.00', '5936.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1||1||1', '5936.00', 'P4110619', 'P4-2019', 1, 1);
/*!40000 ALTER TABLE `purchaseorder_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.purchaseorder_reports
CREATE TABLE IF NOT EXISTS `purchaseorder_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchaseid` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `potype` varchar(255) NOT NULL,
  `purchaseorderno` varchar(255) DEFAULT NULL,
  `purchaseorder` varchar(255) DEFAULT NULL,
  `selected_bom` varchar(255) DEFAULT NULL,
  `purchasedate` varchar(255) DEFAULT NULL,
  `paymenttype` varchar(255) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `batchno` varchar(255) DEFAULT NULL,
  `itemno` varchar(255) DEFAULT NULL,
  `hsnno` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `uom` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `balaceqty` varchar(255) DEFAULT NULL,
  `bom_qty` varchar(255) NOT NULL,
  `total` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `disamount` varchar(255) DEFAULT NULL,
  `taxname` varchar(255) DEFAULT NULL,
  `taxamount` varchar(255) DEFAULT NULL,
  `adjustment` varchar(255) DEFAULT NULL,
  `grandtotal` varchar(255) DEFAULT NULL,
  `taxtotal` varchar(255) DEFAULT NULL,
  `adjus` varchar(255) DEFAULT NULL,
  `vatadjus` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `bedadjs` varchar(200) DEFAULT NULL,
  `edcadjus` varchar(255) DEFAULT NULL,
  `sedadjus` varchar(255) DEFAULT NULL,
  `cstadjus` varchar(255) DEFAULT NULL,
  `taxpercentage` varchar(255) DEFAULT NULL,
  `purchasenoyear` varchar(255) DEFAULT NULL,
  `purchasenodate` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.purchaseorder_reports: ~8 rows (approximately)
/*!40000 ALTER TABLE `purchaseorder_reports` DISABLE KEYS */;
INSERT INTO `purchaseorder_reports` (`id`, `purchaseid`, `date`, `potype`, `purchaseorderno`, `purchaseorder`, `selected_bom`, `purchasedate`, `paymenttype`, `customerId`, `customername`, `address`, `invoiceno`, `invoicedate`, `batchno`, `itemno`, `hsnno`, `itemname`, `uom`, `rate`, `qty`, `balaceqty`, `bom_qty`, `total`, `subtotal`, `discount`, `disamount`, `taxname`, `taxamount`, `adjustment`, `grandtotal`, `taxtotal`, `adjus`, `vatadjus`, `paid`, `balance`, `status`, `bedadjs`, `edcadjus`, `sedadjus`, `cstadjus`, `taxpercentage`, `purchasenoyear`, `purchasenodate`) VALUES
	(1, '1', '2019-02-22', 'Direct PO', 'P', '5101', NULL, '2019-02-22', NULL, 0, 'Ragul kumar', '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', '0', '2019-02-22', NULL, NULL, '0', 'teak wood', 'kgs', '1', '10', '0', '0', '11200.00', '11200.00', NULL, NULL, NULL, NULL, NULL, '11200.00', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, 'P-2019', 'P220219'),
	(2, '2', '2019-02-22', 'Direct PO', 'P1', '1012', NULL, '2019-02-22', NULL, 2, 'Ragul kumar', '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', '0', '2019-02-22', NULL, NULL, '0', 'teak wood', 'kgs', '1', '10', '0', '0', '11200.00', '11200.00', NULL, NULL, NULL, NULL, NULL, '11200.00', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, 'P1-2019', 'P1220219'),
	(9, '4', '2019-03-21', '', 'P2', '8541', NULL, '2019-03-21', NULL, 5, 'Ramesh', 'Kamaraj Nagar,Kovilpalyaum, near  by lala sweets shop,, coimbatore., Tamil Nadu', NULL, '2019-03-21', NULL, NULL, '23454', 'gtv body paatern', 'nos', '2', '10', NULL, '', '257600.00', '259616.00', NULL, NULL, NULL, NULL, NULL, '259616.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'P2-2019', 'P2210319'),
	(10, '4', '2019-03-21', '', 'P2', '8541', NULL, '2019-03-21', NULL, 5, 'Ramesh', 'Kamaraj Nagar,Kovilpalyaum, near  by lala sweets shop,, coimbatore., Tamil Nadu', NULL, '2019-03-21', NULL, NULL, '452', 'Tissues Paper', 'nos', '3', '12', NULL, '', '2016.00', '259616.00', NULL, NULL, NULL, NULL, NULL, '259616.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'P2-2019', 'P2210319'),
	(11, '5', '2019-03-29', 'Direct PO', 'P3', '798', NULL, '2019-03-29', NULL, 2, 'Ragul kumar', '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', '0', '2019-03-29', NULL, NULL, '1503', 'Chart card', 'nos', '1', '10', '0', '0', '112.00', '112.00', NULL, NULL, NULL, NULL, NULL, '112.00', NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, 'P3-2019', 'P3290319'),
	(12, '6', '2019-06-11', 'Direct PO', 'P4', '4562', NULL, '2019-06-11', NULL, 5, 'Ramesh', 'Kamaraj Nagar,Kovilpalyaum, near  by lala sweets shop,, coimbatore., Tamil Nadu', '0', '2019-06-10', NULL, NULL, '0', 'teak wood', 'kgs', '1', '5', '5', '0', '5600.00', '5936.00', NULL, NULL, NULL, NULL, NULL, '5936.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'P4-2019', 'P4110619'),
	(13, '6', '2019-06-11', 'Direct PO', 'P4', '4562', NULL, '2019-06-11', NULL, 5, 'Ramesh', 'Kamaraj Nagar,Kovilpalyaum, near  by lala sweets shop,, coimbatore., Tamil Nadu', '0', '2019-06-10', NULL, NULL, '101', 'Grap Board', 'kgs', '0', '2', '2', '0', '336.00', '5936.00', NULL, NULL, NULL, NULL, NULL, '5936.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'P4-2019', 'P4110619'),
	(14, '6', '2019-06-11', 'Direct PO', 'P4', '4562', NULL, '2019-06-11', NULL, 5, 'Ramesh', 'Kamaraj Nagar,Kovilpalyaum, near  by lala sweets shop,, coimbatore., Tamil Nadu', '0', '2019-06-10', NULL, NULL, '1503', 'Chart card', 'nos', '0', '1', '1', '0', '0.00', '5936.00', NULL, NULL, NULL, NULL, NULL, '5936.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'P4-2019', 'P4110619');
/*!40000 ALTER TABLE `purchaseorder_reports` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.purchase_collection
CREATE TABLE IF NOT EXISTS `purchase_collection` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `date_po` date NOT NULL,
  `purchasedate` date DEFAULT NULL,
  `invoicedate` varchar(255) DEFAULT NULL,
  `receiptdate` date DEFAULT NULL,
  `throughcheck` varchar(255) DEFAULT NULL,
  `receiptno` varchar(255) DEFAULT NULL,
  `suppliername` varchar(255) DEFAULT NULL,
  `mobileno` varchar(255) DEFAULT NULL,
  `totalamount` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `alreadypaid` varchar(255) DEFAULT NULL,
  `alreadybalance` varchar(255) DEFAULT NULL,
  `chamount` varchar(255) DEFAULT NULL,
  `banktransfer` varchar(255) DEFAULT NULL,
  `bamount` varchar(255) DEFAULT NULL,
  `bankamount` varchar(255) NOT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `paymentmode` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `purchaseno` varchar(255) DEFAULT NULL,
  `currentlypaid` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `paymentdetails` varchar(255) DEFAULT NULL,
  `overallamount` varchar(255) DEFAULT NULL,
  `receiptamt` varchar(255) DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `invoiceamt` varchar(255) DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `purchasenodate` varchar(255) DEFAULT NULL,
  `purchasenoyear` varchar(255) DEFAULT NULL,
  `purchaseid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.purchase_collection: ~0 rows (approximately)
/*!40000 ALTER TABLE `purchase_collection` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_collection` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.purchase_details
CREATE TABLE IF NOT EXISTS `purchase_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `purchasedate` date DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `purchaseno` varchar(225) DEFAULT NULL,
  `supplierId` int(11) NOT NULL,
  `suppliername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `billtype` varchar(225) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `hsnno` longtext,
  `itemname` longtext,
  `uom` longtext,
  `rate` longtext,
  `qty` longtext,
  `amount` longtext,
  `discount` longtext,
  `discountBy` varchar(255) NOT NULL,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightamount` varchar(225) DEFAULT NULL,
  `freightcgst` varchar(225) DEFAULT NULL,
  `freightcgstamount` varchar(225) DEFAULT NULL,
  `freightsgst` varchar(225) DEFAULT NULL,
  `freightsgstamount` varchar(225) DEFAULT NULL,
  `freightigst` varchar(225) DEFAULT NULL,
  `freightigstamount` varchar(225) DEFAULT NULL,
  `freighttotal` varchar(225) DEFAULT NULL,
  `loadingamount` varchar(225) DEFAULT NULL,
  `loadingcgst` varchar(225) DEFAULT NULL,
  `loadingcgstamount` varchar(225) DEFAULT NULL,
  `loadingsgst` varchar(225) DEFAULT NULL,
  `loadingsgstamount` varchar(225) DEFAULT NULL,
  `loadingigst` varchar(225) DEFAULT NULL,
  `loadingigstamount` varchar(225) DEFAULT NULL,
  `loadingtotal` varchar(225) DEFAULT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `roundOff` varchar(255) NOT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `purchasenodate` varchar(225) DEFAULT NULL,
  `purchasenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.purchase_details: ~2 rows (approximately)
/*!40000 ALTER TABLE `purchase_details` DISABLE KEYS */;
INSERT INTO `purchase_details` (`id`, `date`, `purchasedate`, `invoicedate`, `purchaseno`, `supplierId`, `suppliername`, `address`, `invoiceno`, `billtype`, `gsttype`, `typesgst`, `typecgst`, `typeigst`, `hsnno`, `itemname`, `uom`, `rate`, `qty`, `amount`, `discount`, `discountBy`, `discountamount`, `taxableamount`, `sgst`, `sgstamount`, `cgst`, `cgstamount`, `igst`, `igstamount`, `total`, `subtotal`, `freightamount`, `freightcgst`, `freightcgstamount`, `freightsgst`, `freightsgstamount`, `freightigst`, `freightigstamount`, `freighttotal`, `loadingamount`, `loadingcgst`, `loadingcgstamount`, `loadingsgst`, `loadingsgstamount`, `loadingigst`, `loadingigstamount`, `loadingtotal`, `othercharges`, `roundOff`, `return_status`, `grandtotal`, `purchasenodate`, `purchasenoyear`, `status`, `edit_status`) VALUES
	(1, '2019-05-22', '2019-05-22', '2019-05-20', 'P', 3, 'krishna', '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', '5879', 'intrastate', 'intrastate', 'sgst', 'cgst', '', '6510', 'fliter paper', 'nos', '150', '10', '1500.00', '0', 'percent_wise', '0.00', '1500.00', '6', '90.00', '6', '90.00', '12', '180.00', '1680.00', '1680.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '1680.00', 'P220519', 'P-2019', 1, 1),
	(2, '2019-06-01', '2019-06-01', '2019-06-01', 'P1', 3, 'krishna', '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', '455', 'intrastate', 'intrastate', 'sgst', 'cgst', '', '0', 'teak wood', 'kgs', '1000', '50', '50000.00', '0', 'percent_wise', '0.00', '50000.00', '6', '3000.00', '6', '3000.00', '12', '6000.00', '56000.00', '56000.00', '', '0', '', '0', '', '0', '', '', '', '0', '', '0', '', '0', '', '', '0', '0', '1', '56000.00', 'P1010619', 'P1-2019', 1, 1);
/*!40000 ALTER TABLE `purchase_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.purchase_reports
CREATE TABLE IF NOT EXISTS `purchase_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchaseid` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `purchaseno` varchar(255) DEFAULT NULL,
  `purchasedate` varchar(255) DEFAULT NULL,
  `paymenttype` varchar(255) DEFAULT NULL,
  `supplierId` int(11) NOT NULL,
  `suppliername` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `batchno` varchar(255) DEFAULT NULL,
  `itemno` varchar(255) DEFAULT NULL,
  `hsnno` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `rate` varchar(255) DEFAULT NULL,
  `qty` varchar(255) DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `subtotal` varchar(255) DEFAULT NULL,
  `discount` varchar(255) DEFAULT NULL,
  `disamount` varchar(255) DEFAULT NULL,
  `taxname` varchar(255) DEFAULT NULL,
  `taxamount` varchar(255) DEFAULT NULL,
  `adjustment` varchar(255) DEFAULT NULL,
  `grandtotal` varchar(255) DEFAULT NULL,
  `taxtotal` varchar(255) DEFAULT NULL,
  `adjus` varchar(255) DEFAULT NULL,
  `vatadjus` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `balance` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `bedadjs` varchar(200) DEFAULT NULL,
  `edcadjus` varchar(255) DEFAULT NULL,
  `sedadjus` varchar(255) DEFAULT NULL,
  `cstadjus` varchar(255) DEFAULT NULL,
  `taxpercentage` varchar(255) DEFAULT NULL,
  `purchasenoyear` varchar(255) DEFAULT NULL,
  `purchasenodate` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.purchase_reports: ~2 rows (approximately)
/*!40000 ALTER TABLE `purchase_reports` DISABLE KEYS */;
INSERT INTO `purchase_reports` (`id`, `purchaseid`, `date`, `purchaseno`, `purchasedate`, `paymenttype`, `supplierId`, `suppliername`, `address`, `invoiceno`, `invoicedate`, `batchno`, `itemno`, `hsnno`, `itemname`, `rate`, `qty`, `total`, `subtotal`, `discount`, `disamount`, `taxname`, `taxamount`, `adjustment`, `grandtotal`, `taxtotal`, `adjus`, `vatadjus`, `paid`, `balance`, `status`, `bedadjs`, `edcadjus`, `sedadjus`, `cstadjus`, `taxpercentage`, `purchasenoyear`, `purchasenodate`) VALUES
	(1, '1', '2019-05-22', 'P', '2019-05-22', NULL, 3, 'krishna', '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', '5879', '2019-05-20', NULL, NULL, '6510', 'fliter paper', '1', '10', '1', '1680.00', NULL, NULL, NULL, NULL, NULL, '1680.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'P-2019', 'P220519'),
	(2, '2', '2019-06-01', 'P1', '2019-06-01', NULL, 3, 'krishna', '91 Dr.jaganthan  nagar, RAJA STREET, TRICHY ROAD, TRICHY, Tamil Nadu', '455', '2019-06-01', NULL, NULL, '0', 'teak wood', '1', '50', '5', '56000.00', NULL, NULL, NULL, NULL, NULL, '56000.00', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 'P1-2019', 'P1010619');
/*!40000 ALTER TABLE `purchase_reports` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.quotation_details
CREATE TABLE IF NOT EXISTS `quotation_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `quotationdate` date DEFAULT NULL,
  `gstinno` varchar(255) DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `quotationno` varchar(225) DEFAULT NULL,
  `customerId` int(11) NOT NULL,
  `customername` varchar(225) DEFAULT NULL,
  `address` varchar(225) DEFAULT NULL,
  `invoiceno` varchar(225) DEFAULT NULL,
  `billtype` varchar(225) DEFAULT NULL,
  `gsttype` varchar(225) DEFAULT NULL,
  `typesgst` longtext,
  `typecgst` longtext,
  `typeigst` longtext,
  `hsnno` longtext,
  `itemname` longtext,
  `description` longtext,
  `uom` longtext,
  `rate` longtext,
  `qty` longtext,
  `amount` longtext,
  `discount` longtext,
  `discountamount` longtext,
  `taxableamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(225) DEFAULT NULL,
  `freightcharges` varchar(225) DEFAULT NULL,
  `packingcharges` varchar(225) DEFAULT NULL,
  `othercharges` varchar(225) DEFAULT NULL,
  `return_status` longtext,
  `grandtotal` varchar(225) DEFAULT NULL,
  `purchasenodate` varchar(225) DEFAULT NULL,
  `purchasenoyear` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `edit_status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.quotation_details: ~0 rows (approximately)
/*!40000 ALTER TABLE `quotation_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotation_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.sales_return
CREATE TABLE IF NOT EXISTS `sales_return` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) DEFAULT NULL,
  `returndate` varchar(255) DEFAULT NULL,
  `types` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `dateofissue` date DEFAULT NULL,
  `customername` varchar(255) DEFAULT NULL,
  `customerid` varchar(255) DEFAULT NULL,
  `supplierid` varchar(255) DEFAULT NULL,
  `gsttype` varchar(255) DEFAULT NULL,
  `suppliername` varchar(255) DEFAULT NULL,
  `openingbal` varchar(255) DEFAULT NULL,
  `outstandingamount` int(255) DEFAULT NULL,
  `returnno` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `invoiceno` varchar(255) DEFAULT NULL,
  `purchaseno` varchar(255) DEFAULT NULL,
  `itemno` varchar(255) DEFAULT NULL,
  `hsnno` longtext,
  `itemname` longtext,
  `rate` longtext,
  `qty` longtext,
  `uom` longtext,
  `amount` longtext,
  `discount` longtext,
  `taxableamount` longtext,
  `discountamount` longtext,
  `cgst` longtext,
  `cgstamount` longtext,
  `sgst` longtext,
  `sgstamount` longtext,
  `igst` longtext,
  `igstamount` longtext,
  `total` longtext,
  `subtotal` varchar(255) DEFAULT NULL,
  `freightamount` varchar(255) NOT NULL,
  `freightcgst` varchar(255) NOT NULL,
  `freightcgstamount` varchar(255) NOT NULL,
  `freightsgst` varchar(255) NOT NULL,
  `freightsgstamount` varchar(255) NOT NULL,
  `freightigst` varchar(255) NOT NULL,
  `freightigstamount` varchar(255) NOT NULL,
  `freighttotal` varchar(255) NOT NULL,
  `loadingamount` varchar(255) NOT NULL,
  `loadingcgst` varchar(255) NOT NULL,
  `loadingcgstamount` varchar(255) NOT NULL,
  `loadingsgst` varchar(255) NOT NULL,
  `loadingsgstamount` varchar(255) NOT NULL,
  `loadingigst` varchar(255) NOT NULL,
  `loadingigstamount` varchar(255) NOT NULL,
  `loadingtotal` varchar(255) NOT NULL,
  `othercharges` varchar(255) DEFAULT NULL,
  `grandtotal` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.sales_return: ~0 rows (approximately)
/*!40000 ALTER TABLE `sales_return` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_return` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.statecode
CREATE TABLE IF NOT EXISTS `statecode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(255) NOT NULL,
  `stateCode` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.statecode: ~37 rows (approximately)
/*!40000 ALTER TABLE `statecode` DISABLE KEYS */;
INSERT INTO `statecode` (`id`, `state`, `stateCode`, `status`) VALUES
	(1, 'Jammu & Kashmir', '01', 1),
	(2, 'Himachal Pradesh', '02', 1),
	(3, 'Punjab', '03', 1),
	(4, 'Chandigarh', '04', 1),
	(5, 'Uttarakhand', '05', 1),
	(6, 'Haryana', '06', 1),
	(7, 'Delhi', '07', 1),
	(8, 'Rajasthan', '08', 1),
	(9, 'Uttar Pradesh', '09', 1),
	(10, 'Bihar', '10', 1),
	(11, 'Sikkim', '11', 1),
	(12, 'Arunachal Pradesh', '12', 1),
	(13, 'Nagaland', '13', 1),
	(14, 'Manipur', '14', 1),
	(15, 'Mizoram', '15', 1),
	(16, 'Tripura', '16', 1),
	(17, 'Meghalaya', '17', 1),
	(18, 'Assam', '18', 1),
	(19, 'West Bengal', '19', 1),
	(20, 'Jharkhand', '20', 1),
	(21, 'odisha', '21', 1),
	(22, 'Chattisgarh', '22', 1),
	(23, 'Madhya Pradesh', '23', 1),
	(24, 'Daman & Diu', '25', 1),
	(25, 'Gujarat', '24', 1),
	(26, 'Dadra & Nagar Haveli', '26', 1),
	(27, 'Maharashtra', '27', 1),
	(28, 'Andhra Pradesh', '28', 1),
	(29, 'Karnataka', '29', 1),
	(30, 'Goa', '30', 1),
	(31, 'Lakshadweep', '31', 1),
	(32, 'Kerala', '32', 1),
	(33, 'Tamil Nadu', '33', 1),
	(34, 'Puducherry', '34', 1),
	(35, 'Andaman & Nicobar Islands', '35', 1),
	(36, 'Telengana', '36', 1),
	(37, 'Andrapradesh(New)', '37', 1);
/*!40000 ALTER TABLE `statecode` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.stock
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `hsnno` varchar(255) DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `sgst` varchar(255) DEFAULT NULL,
  `cgst` varchar(255) DEFAULT NULL,
  `igst` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `updatestock` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `balance` varchar(255) NOT NULL,
  `oldqty` varchar(255) DEFAULT NULL,
  `currentstock` varchar(255) DEFAULT NULL,
  `stat` varchar(255) NOT NULL,
  `stockdate` date DEFAULT NULL,
  `priceType` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.stock: ~8 rows (approximately)
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;
INSERT INTO `stock` (`id`, `date`, `hsnno`, `itemcode`, `sgst`, `cgst`, `igst`, `itemname`, `quantity`, `rate`, `updatestock`, `total`, `status`, `balance`, `oldqty`, `currentstock`, `stat`, `stockdate`, `priceType`) VALUES
	(1, '2019-06-14', '0', NULL, '6', '6', '12', 'teak wood', '50', '1000', '50', '', '1', '54', NULL, NULL, '', '2019-06-01', 'Exclusive'),
	(2, '2019-08-01', '23454', NULL, '6', '6', '12', 'gtv body paatern', '2', '23000', '56', '', '1', '-84', NULL, NULL, '', '2019-06-01', 'Exclusive'),
	(3, '2019-08-01', '1503', NULL, '6', '6', '12', 'Chart card', '3', '0', '250', '', '1', '311', NULL, NULL, '', '2019-05-31', 'Exclusive'),
	(4, '2019-05-19', '0', NULL, '6', '6', '12', 'bio gas', '10', '150', '10', '', '', '-4', NULL, NULL, '', '2019-03-21', 'Exclusive'),
	(5, '2019-03-29', '0', NULL, '6', '6', '12', 'bio power 100', '15', '100', '15', '', '', '7', NULL, NULL, '', '2019-03-21', 'Exclusive'),
	(6, '2019-04-04', '101', NULL, '6', '6', '12', 'Grap Board', '23', '150', '23', '', '1', '23', NULL, NULL, '', '2019-04-04', 'Exclusive'),
	(7, '2019-06-28', '6510', NULL, '6', '6', '12', 'fliter paper', '10', '150', '10', '', '', '-12', NULL, NULL, '', '2019-05-22', 'Exclusive'),
	(8, '2019-08-01', '0', NULL, '6', '6', '12', 'WATER BOTTEL', '200', '50', '50.', '', '1', '171', NULL, NULL, '', '2019-06-05', 'Exclusive');
/*!40000 ALTER TABLE `stock` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.stock_reports
CREATE TABLE IF NOT EXISTS `stock_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `hsnno` varchar(255) DEFAULT NULL,
  `itemcode` varchar(255) DEFAULT NULL,
  `itemname` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `updatestock` varchar(255) DEFAULT NULL,
  `stat` varchar(255) NOT NULL,
  `stockdate` date DEFAULT NULL,
  `purchaseid` varchar(255) DEFAULT NULL,
  `balance` varchar(225) DEFAULT NULL,
  `priceType` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.stock_reports: ~18 rows (approximately)
/*!40000 ALTER TABLE `stock_reports` DISABLE KEYS */;
INSERT INTO `stock_reports` (`id`, `date`, `hsnno`, `itemcode`, `itemname`, `status`, `updatestock`, `stat`, `stockdate`, `purchaseid`, `balance`, `priceType`) VALUES
	(2, '2019-02-22', '0', NULL, 'teak wood', NULL, '10', '', '2019-02-22', '1', NULL, 'Exclusive'),
	(3, '2019-02-22', '23454', NULL, 'gtv body paatern', NULL, '1', '', '2019-02-22', '1', NULL, 'Exclusive'),
	(4, '2019-02-22', '23454', NULL, 'gtv body paatern', NULL, '2', '', NULL, '2', NULL, 'Exclusive'),
	(5, '2019-03-14', '0', NULL, 'teak wood', '1', '50', '', '2019-03-14', NULL, NULL, 'Exclusive'),
	(6, '2019-03-14', '1503', NULL, 'Chart card', '1', '23', 'FromAddStock', '2019-03-14', NULL, NULL, 'Exclusive'),
	(9, '2019-03-21', '0', NULL, 'bio gas', NULL, '10', '', '2019-03-21', '3', NULL, 'Exclusive'),
	(10, '2019-03-21', '0', NULL, 'bio power 100', NULL, '15', '', '2019-03-21', '3', NULL, 'Exclusive'),
	(11, '2019-03-21', '0', NULL, 'teak wood', NULL, '10', '', '2019-03-21', '3', NULL, 'Exclusive'),
	(12, '2019-03-29', '1503', NULL, 'Chart card', NULL, '3', '', NULL, '4', NULL, 'Exclusive'),
	(13, '2019-04-04', '101', NULL, 'Grap Board', '1', '23', 'FromAddStock', '2019-04-04', NULL, NULL, 'Exclusive'),
	(14, '2019-05-22', '6510', NULL, 'fliter paper', NULL, '10', '', '2019-05-22', '1', NULL, 'Exclusive'),
	(15, '2019-05-31', '1503', NULL, 'Chart card', '1', '100', '', '2019-05-31', NULL, NULL, 'Exclusive'),
	(16, '2019-05-31', '1503', NULL, 'Chart card', '1', '250', '', '2019-05-31', NULL, NULL, 'Exclusive'),
	(17, '2019-06-01', '0', NULL, 'teak wood', NULL, '50', '', NULL, '2', NULL, 'Exclusive'),
	(18, '2019-06-01', '23454', NULL, 'gtv body paatern', '1', '56', '', '2019-06-01', NULL, NULL, 'Exclusive'),
	(19, '2019-06-05', '0', NULL, 'WATER BOTTEL', '1', '200', 'FromAddStock', '2019-06-05', NULL, NULL, 'Exclusive'),
	(20, '2019-06-05', '0', NULL, 'WATER BOTTEL', '1', '25', '', '2019-06-05', NULL, NULL, 'Exclusive'),
	(21, '2019-06-05', '0', NULL, 'WATER BOTTEL', '1', '50.', '', '2019-06-05', NULL, NULL, 'Exclusive');
/*!40000 ALTER TABLE `stock_reports` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.tbl_person
CREATE TABLE IF NOT EXISTS `tbl_person` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.tbl_person: ~0 rows (approximately)
/*!40000 ALTER TABLE `tbl_person` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_person` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.uom
CREATE TABLE IF NOT EXISTS `uom` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `uom` varchar(225) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.uom: ~7 rows (approximately)
/*!40000 ALTER TABLE `uom` DISABLE KEYS */;
INSERT INTO `uom` (`id`, `date`, `uom`, `status`) VALUES
	(1, '2019-02-22', 'nos', 1),
	(2, '2019-02-22', 'kgs', 1),
	(3, '2019-02-25', 'ltr', 1),
	(4, '2019-03-27', 'SET', 1),
	(5, '2019-03-29', 'Pail', 1),
	(6, '2019-03-29', 'metre', 1),
	(7, '2019-06-14', 'pair', 1);
/*!40000 ALTER TABLE `uom` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.user_menu
CREATE TABLE IF NOT EXISTS `user_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_id` int(11) NOT NULL,
  `main_menu` varchar(255) NOT NULL,
  `sub_menu` varchar(255) NOT NULL,
  `sub_menu_link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.user_menu: ~23 rows (approximately)
/*!40000 ALTER TABLE `user_menu` DISABLE KEYS */;
INSERT INTO `user_menu` (`id`, `login_id`, `main_menu`, `sub_menu`, `sub_menu_link`) VALUES
	(1, 8, 'dashboard', 'Dashboard', 'dashboard'),
	(2, 8, 'Sales Invoice', 'Add Invoice', 'invoice'),
	(3, 8, 'Sales Invoice', 'Invoice Reports', 'invoice/view'),
	(4, 8, 'Sales Invoice', 'Invoice Party Statement', 'invoice_statement/view'),
	(5, 8, 'Sales Invoice', 'Invoice Tax Reports', 'tax/view'),
	(6, 8, 'Sales Invoice', 'Add Proforma Invoice', 'proforma_invoice'),
	(7, 8, 'Purchase', 'Purchase Receipt', 'purchase'),
	(8, 8, 'Purchase', 'Purchase Reports', 'purchase/view'),
	(9, 8, 'Purchase', 'Purchase Party Statement', 'purchase_statement/view'),
	(10, 8, 'Purchase', 'Purchase Tax Reports', 'purchasetax/view'),
	(11, 8, 'Settings', 'Tax Type', 'taxtype'),
	(12, 8, 'Settings', 'Add UOM', 'uom'),
	(13, 7, 'dashboard', 'Dashboard', 'dashboard'),
	(14, 7, 'Sales Invoice', 'Add Invoice', 'invoice'),
	(15, 7, 'Sales Invoice', 'Invoice Reports', 'invoice/view'),
	(16, 7, 'Sales Invoice', 'Invoice Party Statement', 'invoice_statement/view'),
	(17, 7, 'Sales Invoice', 'Invoice Tax Reports', 'tax/view'),
	(18, 7, 'Sales Invoice', 'Add Proforma Invoice', 'proforma_invoice'),
	(19, 7, 'Purchase', 'Purchase Receipt', 'purchase'),
	(20, 7, 'Purchase', 'Purchase Party Statement', 'purchase_statement/view'),
	(21, 7, 'Purchase', 'Purchase Tax Reports', 'purchasetax/view'),
	(22, 7, 'Stock', 'Add Stock', 'stockmaster'),
	(23, 7, 'Settings', 'Add Item', 'itemmaster');
/*!40000 ALTER TABLE `user_menu` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.vat_details
CREATE TABLE IF NOT EXISTS `vat_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `taxtype` varchar(255) DEFAULT NULL,
  `taxname` varchar(255) DEFAULT NULL,
  `taxpercentage` varchar(255) DEFAULT NULL,
  `sgst` varchar(225) DEFAULT NULL,
  `cgst` varchar(225) DEFAULT NULL,
  `igst` varchar(225) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.vat_details: ~5 rows (approximately)
/*!40000 ALTER TABLE `vat_details` DISABLE KEYS */;
INSERT INTO `vat_details` (`id`, `date`, `taxtype`, `taxname`, `taxpercentage`, `sgst`, `cgst`, `igst`, `status`) VALUES
	(1, '2019-02-22', 'gst', '12', 'gst @ 12 %', '6', '6', '12', '1'),
	(2, '2019-02-22', 'GST', '24', 'GST @ 24 %', '12', '12', '24', '1'),
	(4, '2019-03-29', 'GST', '18', 'GST @ 18 %', '9', '9', '18', '1'),
	(5, '2019-03-29', 'gst', '15', 'gst @ 15 %', '7.5', '7.5', '15', '1'),
	(6, '2019-06-14', 'gst', '30', 'gst @ 30 %', '15', '15', '30', '1');
/*!40000 ALTER TABLE `vat_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.vendor_details
CREATE TABLE IF NOT EXISTS `vendor_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `vendorname` varchar(255) DEFAULT NULL,
  `phoneno` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `tinno` varchar(255) DEFAULT NULL,
  `cstno` varchar(255) DEFAULT NULL,
  `creditdays` varchar(255) DEFAULT NULL,
  `panno` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `eccno` varchar(255) DEFAULT NULL,
  `range` varchar(255) DEFAULT NULL,
  `division` varchar(255) DEFAULT NULL,
  `commissionerate` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `accountname` varchar(100) NOT NULL,
  `printname` varchar(100) NOT NULL,
  `statecode` varchar(255) NOT NULL,
  `gstno` varchar(255) NOT NULL,
  `adharno` varchar(255) NOT NULL,
  `bankname` varchar(100) NOT NULL,
  `accountno` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table shanmuga_vilas.vendor_details: ~0 rows (approximately)
/*!40000 ALTER TABLE `vendor_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `vendor_details` ENABLE KEYS */;

-- Dumping structure for table shanmuga_vilas.voucher
CREATE TABLE IF NOT EXISTS `voucher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `voucherid` varchar(255) DEFAULT NULL,
  `cus_suppId` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `voucherdate` date DEFAULT NULL,
  `vouchertype` varchar(255) DEFAULT NULL,
  `purpose` varchar(255) DEFAULT NULL,
  `paymentmode` varchar(255) DEFAULT NULL,
  `throughcheck` varchar(255) DEFAULT NULL,
  `chequeno` varchar(255) DEFAULT NULL,
  `chamount` varchar(255) DEFAULT NULL,
  `banktransfer` varchar(255) DEFAULT NULL,
  `bamount` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `paymentdetails` varchar(255) DEFAULT NULL,
  `transactionid` varchar(225) DEFAULT NULL,
  `chequedate` varchar(225) DEFAULT NULL,
  `overallamount` varchar(255) DEFAULT NULL,
  `voucheramount` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `otherBank` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table shanmuga_vilas.voucher: ~4 rows (approximately)
/*!40000 ALTER TABLE `voucher` DISABLE KEYS */;
INSERT INTO `voucher` (`id`, `date`, `voucherid`, `cus_suppId`, `name`, `voucherdate`, `vouchertype`, `purpose`, `paymentmode`, `throughcheck`, `chequeno`, `chamount`, `banktransfer`, `bamount`, `amount`, `paymentdetails`, `transactionid`, `chequedate`, `overallamount`, `voucheramount`, `status`, `otherBank`) VALUES
	(1, '2019-06-05', 'R', 2, 'Ragul kumar', '2019-06-05', 'payment', '', 'Cash', '0', '', '', '0', '', '50000', 'Cash', NULL, NULL, '50000', '50000', '1', 0),
	(2, '2019-06-05', 'R1', 2, 'Ragul kumar', '2019-06-05', 'payment', '', 'Cheque', 'SOUTH INDIAN', '00000', '25000', '0', '', '', 'Cheque SOUTH INDIAN 00000', NULL, '12-06-2019', '25000', '25000', '1', 0),
	(3, '2019-06-14', 'R2', 5, 'Ramesh', '2019-06-14', 'payment', '', 'Cash', '0', '', '', '0', '', '10000', 'Cash', NULL, NULL, '10000', '10000', '1', 0),
	(4, '2019-06-28', 'R3', 6, 'Karikaliamman Spinning Mills Pvt Ltd', '2019-06-28', 'payment', '', 'Cheque', 'INDIAN BANK', '2222222', '50000', '0', '', '', 'Cheque INDIAN BANK 2222222', NULL, '25-06-2019', '50000', '50000', '1', 0);
/*!40000 ALTER TABLE `voucher` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
