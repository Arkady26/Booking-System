-- phpMyAdmin SQL Dump
-- version 3.4.10.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 04, 2012 at 06:47 AM
-- Server version: 5.1.63
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mpivelve_cocoon`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `cid` bigint(20) NOT NULL AUTO_INCREMENT,
  `cno` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ctelephone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cpname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cptelephone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cweddingdate` date NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cid`, `cno`, `cname`, `ctelephone`, `cpname`, `cptelephone`, `cweddingdate`) VALUES
(5, 'C123456788', 'Wicky Yeung', '', '', '95487965', '2012-12-18'),
(4, 'C123456789', 'Joshua Chow', '95467894', '', '', '2012-12-10'),
(6, 'C123456787', 'Michael Mak', '93458754', 'Michelle Yiu', '95467896', '2013-01-18'),
(8, 'C123456785', 'Michael Tseng', '', 'Lee Ting', '95887614', '2013-01-12'),
(9, 'C123456784', '&#40654;&#35582;&#25087; (Katy)', '987663415', 'Ken Wong', '85465877', '2013-01-16'),
(10, 'C123456783', 'Sherry Chen', '', '', '966653245', '2013-01-10'),
(11, 'C123456782', 'Yee Man Lee', '', '', '96636356', '2013-02-02'),
(12, 'C123456781', 'Rebecca Zhu', '', '', '95554578', '2013-01-07'),
(13, 'C123456780', 'Louis Koo', '98645871', '', '', '2013-01-14'),
(14, 'C123456779', 'Elaine Jin', '96998745', '', '', '2013-02-05'),
(15, 'C123456778', 'Teresa Mo', '', '', '96852212', '2013-02-08');

-- --------------------------------------------------------

--
-- Table structure for table `dress_booking`
--

DROP TABLE IF EXISTS `dress_booking`;
CREATE TABLE IF NOT EXISTS `dress_booking` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `customer_no` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `staff_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `dress_booking`
--

INSERT INTO `dress_booking` (`id`, `cname`, `customer_no`, `staff_name`, `remarks`) VALUES
(1, '', 'C123456789', 'wtwong', ''),
(6, '', 'C123456788', 'wtwong', ''),
(7, '', 'C123456787', 'wtwong', 'Overseas'),
(10, '', 'C123456784', 'wtwong3', ''),
(11, '', 'C123456782', 'wtwong3', '');

-- --------------------------------------------------------

--
-- Table structure for table `dress_booking_detail`
--

DROP TABLE IF EXISTS `dress_booking_detail`;
CREATE TABLE IF NOT EXISTS `dress_booking_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `dbid` bigint(20) NOT NULL,
  `type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `style` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `sdate` date NOT NULL,
  `edate` date NOT NULL,
  `7dayrule` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `datebefore` date NOT NULL,
  `dateafter` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `dress_booking_detail`
--

INSERT INTO `dress_booking_detail` (`id`, `dbid`, `type`, `style`, `status`, `sdate`, `edate`, `7dayrule`, `datebefore`, `dateafter`) VALUES
(1, 1, '1', '8', '1', '2012-08-15', '2012-08-20', '1', '2012-08-15', '2012-08-20'),
(14, 7, '1', '10', '1', '2012-09-24', '2012-09-30', '1', '2012-09-24', '2012-09-30'),
(13, 6, '1', '9', '1', '2012-08-02', '2012-08-07', '0', '2012-08-02', '2012-08-07'),
(17, 10, '3', '21', '1', '2012-09-26', '2012-10-08', '1', '2012-09-26', '2012-10-08'),
(18, 10, '1', '11', '1', '2012-09-26', '2012-10-08', '1', '2012-09-26', '2012-10-08'),
(19, 11, '1', '8', '1', '2012-11-01', '2012-12-10', '1', '2012-11-01', '2012-12-10'),
(20, 11, '1', '9', '1', '2012-11-01', '2012-11-10', '1', '2012-11-01', '2012-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `dress_status`
--

DROP TABLE IF EXISTS `dress_status`;
CREATE TABLE IF NOT EXISTS `dress_status` (
  `did` bigint(20) NOT NULL AUTO_INCREMENT,
  `status` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `setdefault` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`did`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `dress_status`
--

INSERT INTO `dress_status` (`did`, `status`, `setdefault`) VALUES
(1, 'In Use', '1'),
(2, 'Fitting', '0'),
(3, 'Washing', '0');

-- --------------------------------------------------------

--
-- Table structure for table `dress_style`
--

DROP TABLE IF EXISTS `dress_style`;
CREATE TABLE IF NOT EXISTS `dress_style` (
  `did` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` bigint(20) NOT NULL,
  `styleno` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`did`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=61 ;

--
-- Dumping data for table `dress_style`
--

INSERT INTO `dress_style` (`did`, `type`, `styleno`, `description`) VALUES
(14, 1, 'AC-HP-006', ''),
(13, 1, 'AC-HP-005', ''),
(8, 1, 'AC-HP-001', 'Style 2011-2012'),
(9, 1, 'AC-HP-002A', ''),
(10, 1, 'AC-HP-002B', ''),
(11, 1, 'AC-HP-003', ''),
(12, 1, 'AC-HP-004', ''),
(15, 1, 'AC-HP-007', ''),
(16, 1, 'AC-HP-008', ''),
(17, 1, 'AC-HP-009', ''),
(18, 1, 'AC-HP-010', ''),
(19, 1, 'AC-HP-011', 'New Piece'),
(20, 1, 'AC-HP-012', ''),
(21, 3, 'CE-6001', ''),
(22, 3, 'CE-6003', 'Replacement'),
(23, 3, 'CE-6004', ''),
(24, 3, 'CE-6007', ''),
(25, 3, 'CE-6015', ''),
(26, 3, 'CE-6017', ''),
(27, 3, 'CE-6018', ''),
(28, 3, 'CE-6019', ''),
(29, 3, 'CE-6020', ''),
(30, 4, 'CH-001', ''),
(31, 4, 'CH-002', ''),
(32, 4, 'CH-003', ''),
(33, 4, 'CH-004', ''),
(34, 4, 'CH-004N', ''),
(35, 4, 'CH-005', ''),
(36, 4, 'CH-006', ''),
(37, 4, 'CH-007', ''),
(38, 4, 'CH-008', ''),
(39, 4, 'CH-009', ''),
(40, 4, 'CH-010A', ''),
(41, 4, 'CH-010B', ''),
(42, 4, 'CH-010C', ''),
(43, 4, 'CH-011', ''),
(44, 4, 'CH-012', ''),
(45, 8, 'ED-002 COCKTAIL DRESS', ''),
(46, 8, 'ED-003 COCKTAIL DRESS', ''),
(47, 8, 'ED-004 COCKTAIL DRESS', ''),
(48, 8, 'ED-005 COCKTAIL DRESS', ''),
(49, 8, 'ED-006 COCKTAIL DRESS', ''),
(50, 8, 'ED-007 PHOTO', ''),
(51, 8, 'ED-008', ''),
(52, 8, 'ED-009', ''),
(53, 8, 'ED-010 PHOTO', ''),
(54, 8, 'ED-011', ''),
(55, 8, 'ED-012 COCKTAIL DRESS', ''),
(56, 8, 'ED-013 COCKTAIL DRESS', ''),
(57, 8, 'ED-015 PHOTO', ''),
(60, 3, 'CE-7001', '');

-- --------------------------------------------------------

--
-- Table structure for table `dress_type`
--

DROP TABLE IF EXISTS `dress_type`;
CREATE TABLE IF NOT EXISTS `dress_type` (
  `did` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`did`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `dress_type`
--

INSERT INTO `dress_type` (`did`, `type`) VALUES
(1, 'AC-HP Head Pieces &#38957;&#39166;'),
(2, 'AC-NL Necklace &#38968;&#37706;'),
(3, 'CE - Couture Evening Gown'),
(4, 'CH - Chinese Wedding Gown &#35074;'),
(5, 'CHM - Mens Chinese Gown &#30007;&#35074;'),
(6, 'CHQP-Qi Pao &#31098;&#34957;'),
(7, 'CW - Couture Wedding Gown'),
(8, 'ED - Evening Gown'),
(9, 'FUR-Fur &#27611;&#27611;&#25259;&#32937;'),
(10, 'MS - Mens Tuxedo'),
(11, 'MST-Stripe Trousers &#26781;&#23376;&#35122;'),
(12, 'MV - Mens Vest &#32972;&#24515;'),
(13, 'T - Tie'),
(14, 'TR-Long Train &#38263;&#25302;&#23614;'),
(15, 'VL-Long Veil &#38263;&#38957;&#32023;'),
(16, 'WD - Wedding Gown');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

DROP TABLE IF EXISTS `signup`;
CREATE TABLE IF NOT EXISTS `signup` (
  `uid` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `phoneno` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `security_level` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `flag` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`uid`, `username`, `password`, `fname`, `lname`, `phoneno`, `email`, `security_level`, `flag`) VALUES
(8, 'level1', '43d3810c065f4bf3550fac648d605fcb', '', '', '', '', '1', 'a'),
(12, 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '3', 'a'),
(13, 'demo testing', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '1', 'a'),
(4, 'demo@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '2', 'u'),
(7, 'wtwong3', 'd440d1a4c6cea855aa9084e57dd8700b', '', '', '', '', '3', 'u'),
(14, 'demo testing user', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '2', 'u'),
(15, 'Katy', '3225d24edf6b0aecf7e58f22c4219d93', '', '', '', '', '1', 'a'),
(16, 'wtwong1', '4e8bd6f44a8a872707e4cfb8e150179b', '', '', '', '', '1', 'a'),
(17, 'wtwong2', 'c096ae2b7a9993c1ebc9974c3e2691d2', '', '', '', '', '2', 'u');

-- --------------------------------------------------------

--
-- Table structure for table `walkincustomer`
--

DROP TABLE IF EXISTS `walkincustomer`;
CREATE TABLE IF NOT EXISTS `walkincustomer` (
  `wcid` bigint(20) NOT NULL AUTO_INCREMENT,
  `wname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `wtelephone` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `wremarks` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `staffname` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `wdate` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `weddingdate` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`wcid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `walkincustomer`
--

INSERT INTO `walkincustomer` (`wcid`, `wname`, `wtelephone`, `wremarks`, `staffname`, `wdate`, `weddingdate`) VALUES
(1, 'Walk In 1', '1234345', 'Demo Remarks..', '', '2012-06-16', ''),
(2, 'Richard', '2345675', 'Demo', '', '2012-06-18', ''),
(4, 'Michelle', '18524587', '', '', '2012-06-19', ''),
(5, 'Katy', '154687458', '', '', '2012-06-19', ''),
(6, 'Cindy', '154684578', '', '', '2012-06-19', ''),
(7, 'Tanya', '15468798', '', '', '2012-06-19', ''),
(8, 'Sugar', '14567845', '', '', '2012-06-19', ''),
(9, 'Apple', '14567489', '', '', '2012-06-19', ''),
(10, 'Orange', '154845785', '', '', '2012-06-19', ''),
(11, 'Amanda', '145874587', '', '', '2012-06-19', ''),
(12, 'Demo', '145874454', 'nbnbn', 'admin@gmail.com', '2012-07-04', '2013-02-14'),
(13, 'Micky Chan', '98754685', '', 'wtwong', '2012-07-10', '2012-08-10'),
(14, 'Test', '43243243', '', 'wtwong', '2012-07-11', '0-0-0'),
(15, 'Apple Li', '95845687', '', 'wtwong', '2012-07-15', '0-0-0'),
(16, 'Aida', '95847854', '', 'wtwong3', '2012-07-27', '0-0-0');

-- --------------------------------------------------------

--
-- Table structure for table `walkincustomer_detail`
--

DROP TABLE IF EXISTS `walkincustomer_detail`;
CREATE TABLE IF NOT EXISTS `walkincustomer_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `wcid` bigint(20) NOT NULL DEFAULT '0',
  `wdstyle` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `wdtype` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `walkincustomer_detail`
--

INSERT INTO `walkincustomer_detail` (`id`, `wcid`, `wdstyle`, `wdtype`) VALUES
(4, 1, '7', '2'),
(3, 1, '1', '1'),
(5, 2, '4', '1'),
(6, 2, '3', '4'),
(7, 2, '5', '5'),
(8, 4, '1', '1'),
(9, 5, '1', '1'),
(10, 6, '7', '2'),
(11, 7, '7', '2'),
(12, 8, '1', '1'),
(13, 9, '4', '1'),
(14, 10, '1', '1'),
(15, 11, '1', '1'),
(16, 12, '30', '4'),
(18, 16, '8', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
