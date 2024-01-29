-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 01, 2021 at 01:10 AM
-- Server version: 5.6.49-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `karavali_parrothink_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bank_info`
--

CREATE TABLE `tbl_bank_info` (
  `row_id` bigint(20) NOT NULL,
  `bank_name` varchar(55) NOT NULL,
  `bank_account_number` varchar(55) NOT NULL,
  `branch_name` varchar(100) NOT NULL,
  `account_type` varchar(55) NOT NULL,
  `IFSC_code` varchar(55) NOT NULL,
  `bank_contact` varchar(55) NOT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `company_id` varchar(55) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_bank_info`
--

INSERT INTO `tbl_bank_info` (`row_id`, `bank_name`, `bank_account_number`, `branch_name`, `account_type`, `IFSC_code`, `bank_contact`, `created_by`, `created_date_time`, `updated_by`, `updated_date_time`, `company_id`, `is_deleted`) VALUES
(16, 'Karnataka Bank Od', '5137000600002201', 'Mangalore-575002', 'O/D Account', 'KARB0000513', '0824 222 9', '1000', '2019-11-12 08:12:16', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(17, 'Karnataka Bank Ca', '513700008956', 'H.O Complex,Mangalore-575002', 'Current A/C', 'KAR45656', ' 082422298', '1000', '2019-11-12 08:43:46', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(18, 'Karnataka Bank Sb', '5132500100515701', 'H.O Complex,Mangalore-575002', 'Savings A/C', 'KAR45656', '0824222984', '1000', '2019-11-12 08:48:01', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(19, 'Opening Balance', '0', '0', 'Savings A/C', '0', '0', '1000', '2019-11-16 06:54:32', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(20, 'State Bank Of India', '30182729145', '0', 'Savings A/C', '0', '0', '1000', '2019-11-29 08:30:05', '1000', '2019-12-09 07:39:34', 'PRR5ZT', 1),
(21, 'State Bank Of India', '30182729145', '0', 'Savings A/C', '0', '0', '1000', '2019-11-29 08:30:05', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(22, 'Commision', '254158425', 'MANGALORE', 'Savings A/C', '152757', '2558489875', '1000', '2019-11-29 10:17:44', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(23, 'Ideal ', '900008345501', 'Citypoint ,Kodialbail', 'Savings A/C', 'PBN100004', '8722289465', '1000', '2020-01-23 09:37:21', '', '0000-00-00 00:00:00', 'PRR5ZT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cash_account`
--

CREATE TABLE `tbl_cash_account` (
  `row_id` bigint(20) NOT NULL,
  `cash_account_name` varchar(55) NOT NULL,
  `cash_account_type` varchar(55) NOT NULL,
  `account_balance` double(10,2) DEFAULT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `company_id` varchar(55) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cash_account`
--

INSERT INTO `tbl_cash_account` (`row_id`, `cash_account_name`, `cash_account_type`, `account_balance`, `created_by`, `created_date_time`, `updated_by`, `updated_date_time`, `company_id`, `is_deleted`) VALUES
(104, 'Parrophins Cash Book', 'Other', 66000.00, '1000', '2020-01-24 02:20:56', '1000', '2020-01-24 11:12:18', 'PRR5ZT', 0),
(105, 'Prasthutha H', 'Other', 67000.00, '1000', '2020-01-23 11:26:31', '1000', '2020-01-23 11:32:45', 'PRR5ZT', 0),
(106, 'Schoolphins ', 'Other', 113800.00, '1000', '2020-01-22 06:56:14', '1000', '2020-01-23 06:38:45', 'PRR5ZT', 0),
(107, 'Swasthika', 'Company', 61500.00, '1000', '2020-01-24 09:48:10', '1000', '2020-01-24 11:12:18', 'PRR5ZT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cash_account_transfer_info`
--

CREATE TABLE `tbl_cash_account_transfer_info` (
  `row_id` bigint(20) NOT NULL,
  `transfer_cash_date` date NOT NULL,
  `transfer_cash_amount` double NOT NULL,
  `from_cash_account_rowid` bigint(20) NOT NULL,
  `to_cash_account_rowid` bigint(20) NOT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `company_id` varchar(55) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `comments` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cash_account_transfer_info`
--

INSERT INTO `tbl_cash_account_transfer_info` (`row_id`, `transfer_cash_date`, `transfer_cash_amount`, `from_cash_account_rowid`, `to_cash_account_rowid`, `created_by`, `created_date_time`, `updated_by`, `updated_date_time`, `company_id`, `is_deleted`, `comments`) VALUES
(60, '2020-02-05', 1000, 105, 104, '1000', '2020-01-17 07:25:19', '1000', '2020-01-18 05:01:08', 'PRR5ZT', 1, 'test transfer'),
(61, '2020-02-13', 8650, 105, 104, '1000', '2020-01-18 05:02:27', '1000', '2020-01-18 05:03:03', 'PRR5ZT', 1, 'transfers'),
(62, '2020-02-12', 12500, 106, 104, '1000', '2020-01-18 07:59:07', '1000', '2020-01-18 08:10:31', 'PRR5ZT', 1, 'testing the transfers'),
(63, '2020-02-12', 2000, 105, 104, '1000', '2020-01-18 09:49:39', '', '0000-00-00 00:00:00', 'PRR5ZT', 0, 'transfering tests'),
(64, '2020-02-06', 500, 104, 107, '1000', '2020-01-24 11:12:18', '', '0000-00-00 00:00:00', 'PRR5ZT', 0, 'gtyuyui');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cash_details`
--

CREATE TABLE `tbl_cash_details` (
  `row_id` bigint(20) NOT NULL,
  `cash_account_rowid` bigint(20) NOT NULL,
  `cash_date` date NOT NULL,
  `cash_amount` double(10,2) NOT NULL,
  `comments` varchar(3000) NOT NULL,
  `bank_rowid` bigint(20) DEFAULT NULL,
  `cash_transfer_row_id` int(11) DEFAULT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `company_id` varchar(55) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cash_details`
--

INSERT INTO `tbl_cash_details` (`row_id`, `cash_account_rowid`, `cash_date`, `cash_amount`, `comments`, `bank_rowid`, `cash_transfer_row_id`, `created_by`, `created_date_time`, `updated_by`, `updated_date_time`, `company_id`, `is_deleted`) VALUES
(413, 105, '2020-02-01', 75000.00, 'Account Opening', 19, NULL, '1000', '2020-01-17 06:04:04', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(414, 104, '2020-02-03', 45000.00, 'opening amount', 19, NULL, '1000', '2020-01-17 07:16:02', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(415, 104, '2020-02-05', 1000.00, 'test transfer', NULL, 60, '1000', '2020-01-17 07:25:19', '1000', '2020-01-18 05:01:08', 'PRR5ZT', 1),
(416, 104, '2020-02-19', 1000.00, 'bank transfer', 18, NULL, '1000', '2020-01-18 04:59:26', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(417, 104, '2020-02-13', 8650.00, 'transfers', NULL, 61, '1000', '2020-01-18 05:02:27', '1000', '2020-01-18 05:03:03', 'PRR5ZT', 1),
(418, 106, '2020-02-10', 92000.00, 'Transaction open', 21, NULL, '1000', '2020-01-18 07:56:22', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(419, 104, '2020-02-12', 12500.00, 'testing the transfers', NULL, 62, '1000', '2020-01-18 07:59:07', '1000', '2020-01-18 08:10:31', 'PRR5ZT', 1),
(420, 106, '2020-02-19', 23000.00, 'banking ', 18, NULL, '1000', '2020-01-18 09:48:09', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(421, 104, '2020-02-12', 2000.00, 'transfering tests', NULL, 63, '1000', '2020-01-18 09:49:39', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(422, 104, '2020-02-12', 1500.00, 'addition ', 21, NULL, '1000', '2020-01-22 09:21:20', '1000', '2020-01-22 09:25:05', 'PRR5ZT', 1),
(423, 105, '2020-02-13', 3300.00, 'QWERTYUI', 21, NULL, '1000', '2020-01-22 09:48:03', '1000', '2020-01-22 09:57:16', 'PRR5ZT', 1),
(424, 105, '2020-02-13', 1300.00, 'addition', 21, NULL, '1000', '2020-01-22 10:00:55', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(425, 104, '2020-02-13', 7500.00, 'bvtrsetryti', 21, NULL, '1000', '2020-01-22 10:12:02', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(426, 104, '2020-02-01', 3500.00, 'transfer by karnataka', 16, NULL, '1000', '2020-01-23 06:11:25', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(427, 104, '2020-02-11', 10500.00, 'transferable idea', 23, NULL, '1000', '2020-01-23 09:46:16', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(428, 105, '2020-02-05', 1500.00, 'asdfghj', 23, NULL, '1000', '2020-01-23 11:26:31', '1000', '2020-01-23 11:32:45', 'PRR5ZT', 1),
(429, 104, '2020-02-06', 1000.00, 'banks', 23, NULL, '1000', '2020-01-24 02:20:56', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(430, 107, '2020-02-10', 55000.00, 'The New Transfer', 23, NULL, '1000', '2020-01-24 05:37:03', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(431, 107, '2020-02-06', 5000.00, 'ghjkl', 16, NULL, '1000', '2020-01-24 09:39:51', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(432, 107, '2020-02-13', 1000.00, 'Karnataka transfer', 16, NULL, '1000', '2020-01-24 09:48:10', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(433, 107, '2020-02-06', 500.00, 'gtyuyui', NULL, 64, '1000', '2020-01-24 11:12:18', '', '0000-00-00 00:00:00', 'PRR5ZT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cash_expenses`
--

CREATE TABLE `tbl_cash_expenses` (
  `row_id` bigint(20) NOT NULL,
  `transport_rowid` bigint(20) DEFAULT NULL,
  `cash_details_rowid` bigint(20) DEFAULT NULL,
  `cashLedger_rowid` bigint(20) DEFAULT NULL,
  `transaction_type` varchar(55) DEFAULT NULL,
  `cash_account_rowid` varchar(55) NOT NULL,
  `cash_transfer_rowid` bigint(20) DEFAULT NULL,
  `vehicle_number` varchar(55) DEFAULT NULL,
  `loaded_date` date DEFAULT NULL,
  `destination` varchar(55) DEFAULT NULL,
  `fuel_cash_info_row_id` int(11) DEFAULT NULL,
  `comments` text,
  `advance` double DEFAULT NULL,
  `received_ponch` double DEFAULT NULL,
  `cash_date` date DEFAULT NULL,
  `bank_date` date DEFAULT NULL,
  `debit` double(10,2) DEFAULT NULL,
  `credit` double(10,2) DEFAULT NULL,
  `ponch_cleared_row_id` int(11) DEFAULT NULL,
  `bank_account_row_id` int(11) DEFAULT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date_time` date NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `company_id` varchar(55) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cash_expenses`
--

INSERT INTO `tbl_cash_expenses` (`row_id`, `transport_rowid`, `cash_details_rowid`, `cashLedger_rowid`, `transaction_type`, `cash_account_rowid`, `cash_transfer_rowid`, `vehicle_number`, `loaded_date`, `destination`, `fuel_cash_info_row_id`, `comments`, `advance`, `received_ponch`, `cash_date`, `bank_date`, `debit`, `credit`, `ponch_cleared_row_id`, `bank_account_row_id`, `created_by`, `created_date_time`, `updated_by`, `updated_date_time`, `company_id`, `is_deleted`) VALUES
(1643, NULL, 413, NULL, 'Bank', '105', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-01', NULL, 75000.00, NULL, NULL, NULL, '1000', '2020-01-17', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1644, NULL, 414, NULL, 'Bank', '104', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-03', NULL, 45000.00, NULL, NULL, NULL, '1000', '2020-01-17', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1645, NULL, NULL, NULL, 'Cash', '104 ', 60, NULL, NULL, NULL, NULL, 'test transfer', NULL, NULL, '2020-02-05', NULL, 1000.00, NULL, NULL, NULL, '1000', '2020-01-17', '1000', '2020-01-18 05:01:08', 'PRR5ZT', 1),
(1646, NULL, NULL, NULL, 'Cash', '105 ', 60, NULL, NULL, NULL, NULL, 'test transfer', NULL, NULL, '2020-02-05', NULL, NULL, 1000.00, NULL, NULL, '1000', '2020-01-17', '1000', '2020-01-18 05:01:08', 'PRR5ZT', 1),
(1647, NULL, NULL, 208, 'Cash', '107 ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10', NULL, NULL, 1500.00, NULL, NULL, '1000', '2020-01-17', '1000', '2020-01-24 10:31:21', 'PRR5ZT', 1),
(1648, NULL, NULL, 209, 'Cash', '105 ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-16', NULL, NULL, 4550.00, NULL, NULL, '1000', '2020-01-17', '1000', '2020-01-18 09:38:18', 'PRR5ZT', 1),
(1649, NULL, NULL, NULL, 'Cash', '104', NULL, NULL, NULL, NULL, 51, 'test', NULL, NULL, '2020-02-27', NULL, NULL, 500.00, NULL, NULL, '1000', '2020-01-17', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1650, NULL, NULL, NULL, 'Cash', '105', NULL, NULL, NULL, NULL, 53, 'fuel test', NULL, NULL, '2020-02-14', NULL, NULL, 1800.00, NULL, NULL, '1000', '2020-01-17', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1651, NULL, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, 55, 'bank transfer', NULL, NULL, '2020-02-18', NULL, NULL, 2000.00, NULL, 21, '1000', '2020-01-17', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1652, NULL, 416, NULL, 'Bank', '104', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-19', NULL, 1000.00, NULL, NULL, NULL, '1000', '2020-01-18', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1653, NULL, NULL, NULL, 'Cash', '104 ', 61, NULL, NULL, NULL, NULL, 'transfers', NULL, NULL, '2020-02-13', NULL, 8650.00, NULL, NULL, NULL, '1000', '2020-01-18', '1000', '2020-01-18 05:03:03', 'PRR5ZT', 1),
(1654, NULL, NULL, NULL, 'Cash', '105 ', 61, NULL, NULL, NULL, NULL, 'transfers', NULL, NULL, '2020-02-13', NULL, NULL, 8650.00, NULL, NULL, '1000', '2020-01-18', '1000', '2020-01-18 05:03:03', 'PRR5ZT', 1),
(1655, NULL, 418, NULL, 'Bank', '106', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10', NULL, 92000.00, NULL, NULL, NULL, '1000', '2020-01-18', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1656, NULL, NULL, NULL, 'Cash', '104 ', 62, NULL, NULL, NULL, NULL, 'testing the transfers', NULL, NULL, '2020-02-12', NULL, 12500.00, NULL, NULL, NULL, '1000', '2020-01-18', '1000', '2020-01-18 08:10:31', 'PRR5ZT', 1),
(1657, NULL, NULL, NULL, 'Cash', '106 ', 62, NULL, NULL, NULL, NULL, 'testing the transfers', NULL, NULL, '2020-02-12', NULL, NULL, 12500.00, NULL, NULL, '1000', '2020-01-18', '1000', '2020-01-18 08:10:31', 'PRR5ZT', 1),
(1658, NULL, 420, NULL, 'Bank', '106', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-19', NULL, 23000.00, NULL, NULL, NULL, '1000', '2020-01-18', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1659, NULL, NULL, NULL, 'Cash', '104 ', 63, NULL, NULL, NULL, NULL, 'transfering tests', NULL, NULL, '2020-02-12', NULL, 2000.00, NULL, NULL, NULL, '1000', '2020-01-18', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1660, NULL, NULL, NULL, 'Cash', '105 ', 63, NULL, NULL, NULL, NULL, 'transfering tests', NULL, NULL, '2020-02-12', NULL, NULL, 2000.00, NULL, NULL, '1000', '2020-01-18', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1661, NULL, NULL, NULL, 'Cash', '106', NULL, NULL, NULL, NULL, 56, 'first addition', NULL, NULL, '2020-01-18', NULL, NULL, 6000.00, NULL, NULL, '1000', '2020-01-18', '1000', '2020-01-22 06:59:50', 'PRR5ZT', 1),
(1662, 364, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, NULL, 'New Transport test', NULL, NULL, '2020-02-12', NULL, NULL, 600.00, NULL, 21, '1000', '2020-01-21', '1000', '2020-01-21 07:37:35', 'PRR5ZT', 1),
(1663, 364, NULL, NULL, 'Cash', '105 ', NULL, NULL, NULL, NULL, NULL, 'New Transport test', NULL, NULL, '2020-02-12', NULL, NULL, 600.00, NULL, NULL, '1000', '2020-01-21', '1000', '2020-01-21 07:37:35', 'PRR5ZT', 1),
(1664, 364, NULL, NULL, 'Cash', '105 ', NULL, NULL, NULL, NULL, NULL, 'qwety', NULL, NULL, '2020-01-21', NULL, NULL, 350.00, 281, NULL, '1000', '2020-01-21', '1000', '2020-01-21 07:37:35', 'PRR5ZT', 1),
(1665, 365, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, NULL, 'Ponch pending transport', NULL, NULL, '2020-02-05', NULL, NULL, 0.00, NULL, 0, '1000', '2020-01-21', '1000', '2020-01-23 06:38:45', 'PRR5ZT', 0),
(1666, 365, NULL, NULL, 'Cash', '106', NULL, NULL, NULL, NULL, NULL, 'Ponch pending transport', NULL, NULL, '2020-02-05', NULL, NULL, 1800.00, NULL, NULL, '1000', '2020-01-21', '1000', '2020-01-23 06:38:45', 'PRR5ZT', 0),
(1667, 366, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, NULL, 'aklaredtgh l,;mnk', NULL, NULL, '2020-02-14', NULL, NULL, 240.00, NULL, 16, '1000', '2020-01-21', '1000', '2020-01-23 07:20:43', 'PRR5ZT', 1),
(1668, 366, NULL, NULL, 'Cash', '104 ', NULL, NULL, NULL, NULL, NULL, 'aklaredtgh l,;mnk', NULL, NULL, '2020-02-14', NULL, NULL, 2000.00, NULL, NULL, '1000', '2020-01-21', '1000', '2020-01-23 07:20:43', 'PRR5ZT', 1),
(1669, 367, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, NULL, 'dra34tyu', NULL, NULL, '2020-02-13', NULL, NULL, 0.00, NULL, 21, '1000', '2020-01-21', '1000', '2020-01-21 12:22:18', 'PRR5ZT', 1),
(1670, 367, NULL, NULL, 'Cash', '106', NULL, NULL, NULL, NULL, NULL, 'dra34tyu', NULL, NULL, '2020-02-13', NULL, NULL, 3000.00, NULL, NULL, '1000', '2020-01-21', '1000', '2020-01-21 12:22:18', 'PRR5ZT', 1),
(1671, 367, NULL, NULL, 'Cash', '105 ', NULL, NULL, NULL, NULL, NULL, 'hcertfygh', NULL, NULL, '2020-01-21', NULL, NULL, 200.00, 282, NULL, '1000', '2020-01-21', '1000', '2020-01-21 12:22:18', 'PRR5ZT', 1),
(1672, 367, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, NULL, 'ggdfguhj', NULL, NULL, '2020-02-12', NULL, NULL, 50.00, 283, 16, '1000', '2020-01-21', '1000', '2020-01-21 12:22:18', 'PRR5ZT', 1),
(1673, 367, NULL, NULL, 'Cash', '106 ', NULL, NULL, NULL, NULL, NULL, 'ggdfguhj', NULL, NULL, '2020-02-12', NULL, NULL, 100.00, 284, NULL, '1000', '2020-01-21', '1000', '2020-01-21 12:22:18', 'PRR5ZT', 1),
(1674, 368, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, NULL, 'thank you', NULL, NULL, '2020-02-02', NULL, NULL, 0.00, NULL, 0, '1000', '2020-01-21', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1675, 368, NULL, NULL, 'Cash', '104 ', NULL, NULL, NULL, NULL, NULL, 'thank you', NULL, NULL, '2020-02-02', NULL, NULL, 1500.00, NULL, NULL, '1000', '2020-01-21', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1676, 368, NULL, NULL, 'Cash', '104 ', NULL, NULL, NULL, NULL, NULL, 'pending clearence', NULL, NULL, '2020-02-10', NULL, NULL, 1500.00, 285, NULL, '1000', '2020-01-21', '1000', '2020-01-21 11:25:29', 'PRR5ZT', 1),
(1677, 368, NULL, NULL, 'Cash', '105 ', NULL, NULL, NULL, NULL, NULL, 'klnjhgra', NULL, NULL, '2020-02-13', NULL, NULL, 2500.00, 286, NULL, '1000', '2020-01-21', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1678, 368, NULL, NULL, 'Cash', '105 ', NULL, NULL, NULL, NULL, NULL, 'final clearence', NULL, NULL, '2020-01-21', NULL, NULL, 4000.00, 287, NULL, '1000', '2020-01-21', '1000', '2020-01-21 11:44:56', 'PRR5ZT', 1),
(1679, 368, NULL, NULL, 'Cash', '106 ', NULL, NULL, NULL, NULL, NULL, 'tytsewyuu', NULL, NULL, '2020-02-15', NULL, NULL, 4000.00, 288, NULL, '1000', '2020-01-21', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1680, 367, NULL, NULL, 'Cash', '105 ', NULL, NULL, NULL, NULL, NULL, 'ddadjkkl', NULL, NULL, '2020-02-06', NULL, NULL, 450.00, 289, NULL, '1000', '2020-01-21', '1000', '2020-01-21 12:22:18', 'PRR5ZT', 1),
(1681, 369, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, NULL, 'ponch test', NULL, NULL, '2020-02-04', NULL, NULL, 0.00, NULL, 0, '1000', '2020-01-22', '1000', '2020-01-22 05:54:22', 'PRR5ZT', 1),
(1682, 369, NULL, NULL, 'Cash', '106 ', NULL, NULL, NULL, NULL, NULL, 'ponch test', NULL, NULL, '2020-02-04', NULL, NULL, 1200.00, NULL, NULL, '1000', '2020-01-22', '1000', '2020-01-22 05:54:22', 'PRR5ZT', 1),
(1683, 369, NULL, NULL, 'Cash', '106 ', NULL, NULL, NULL, NULL, NULL, 'clear ponch by school', NULL, NULL, '2020-02-12', NULL, NULL, 1200.00, 290, NULL, '1000', '2020-01-22', '1000', '2020-01-22 05:54:22', 'PRR5ZT', 1),
(1684, 369, NULL, NULL, 'Cash', '104 ', NULL, NULL, NULL, NULL, NULL, 'clear by parro', NULL, NULL, '2020-02-14', NULL, NULL, 700.00, 291, NULL, '1000', '2020-01-22', '1000', '2020-01-22 05:54:22', 'PRR5ZT', 1),
(1685, 370, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, NULL, 'test fuel by ocean ', NULL, NULL, '2020-02-06', NULL, NULL, 0.00, NULL, 0, '1000', '2020-01-22', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1686, 370, NULL, NULL, 'Cash', '106 ', NULL, NULL, NULL, NULL, NULL, 'test fuel by ocean ', NULL, NULL, '2020-02-06', NULL, NULL, 1400.00, NULL, NULL, '1000', '2020-01-22', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1687, 371, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '2020-02-03', NULL, NULL, 0.00, NULL, 0, '1000', '2020-01-22', '1000', '2020-01-22 07:08:05', 'PRR5ZT', 1),
(1688, 371, NULL, NULL, 'Cash', '106 ', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '2020-02-03', NULL, NULL, 400.00, NULL, NULL, '1000', '2020-01-22', '1000', '2020-01-22 07:08:05', 'PRR5ZT', 1),
(1689, NULL, NULL, NULL, 'Cash', '105', NULL, NULL, NULL, NULL, 57, 'transfersable', NULL, NULL, '2020-02-05', NULL, NULL, 2700.00, NULL, NULL, '1000', '2020-01-22', '1000', '2020-01-22 07:13:03', 'PRR5ZT', 1),
(1690, NULL, NULL, NULL, 'Cash', '105', NULL, NULL, NULL, NULL, 58, 'hgshj', NULL, NULL, '2020-02-12', NULL, NULL, 1700.00, NULL, NULL, '1000', '2020-01-22', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1691, NULL, NULL, NULL, 'Cash', '104', NULL, NULL, NULL, NULL, 59, 'fsdfgh', NULL, NULL, '2020-02-05', NULL, NULL, 1000.00, NULL, NULL, '1000', '2020-01-22', '1000', '2020-01-22 07:33:41', 'PRR5ZT', 1),
(1692, NULL, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, 60, 'banking', NULL, NULL, '2020-02-11', NULL, NULL, 1000.00, NULL, 21, '1000', '2020-01-22', '1000', '2020-01-22 07:43:14', 'PRR5ZT', 1),
(1693, NULL, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, 61, 'gssjhkl', NULL, NULL, '2020-02-06', NULL, NULL, 1000.00, NULL, 18, '1000', '2020-01-22', '1000', '2020-01-22 07:46:27', 'PRR5ZT', 1),
(1694, NULL, 422, NULL, 'Bank', '104', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-12', NULL, 1500.00, NULL, NULL, NULL, '1000', '2020-01-22', '1000', '2020-01-22 09:25:05', 'PRR5ZT', 1),
(1695, NULL, 423, NULL, 'Bank', '105', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-13', NULL, 3300.00, NULL, NULL, NULL, '1000', '2020-01-22', '1000', '2020-01-22 09:57:16', 'PRR5ZT', 1),
(1696, NULL, 424, NULL, 'Bank', '105', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-13', NULL, 1300.00, NULL, NULL, NULL, '1000', '2020-01-22', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1697, NULL, 425, NULL, 'Bank', '104', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-13', NULL, 7500.00, NULL, NULL, NULL, '1000', '2020-01-22', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1698, 372, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, NULL, 'New Ponch Addition', NULL, NULL, '2020-02-02', NULL, NULL, 0.00, NULL, 0, '1000', '2020-01-22', '1000', '2020-01-23 06:25:13', 'PRR5ZT', 0),
(1699, 372, NULL, NULL, 'Cash', '105', NULL, NULL, NULL, NULL, NULL, 'New Ponch Addition', NULL, NULL, '2020-02-02', NULL, NULL, 3000.00, NULL, NULL, '1000', '2020-01-22', '1000', '2020-01-23 06:25:13', 'PRR5ZT', 0),
(1700, 373, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, NULL, 'fffkkiocu', NULL, NULL, '2020-02-06', NULL, NULL, 0.00, NULL, 0, '1000', '2020-01-22', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1701, 373, NULL, NULL, 'Cash', '', NULL, NULL, NULL, NULL, NULL, 'fffkkiocu', NULL, NULL, '2020-02-06', NULL, NULL, 0.00, NULL, NULL, '1000', '2020-01-22', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1702, 374, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, NULL, 'arnodyas', NULL, NULL, '2020-02-16', NULL, NULL, 0.00, NULL, 0, '1000', '2020-01-22', '1000', '2020-01-23 11:43:11', 'PRR5ZT', 0),
(1703, 374, NULL, NULL, 'Cash', '0', NULL, NULL, NULL, NULL, NULL, 'arnodyas', NULL, NULL, '2020-02-16', NULL, NULL, 0.00, NULL, NULL, '1000', '2020-01-22', '1000', '2020-01-23 11:43:11', 'PRR5ZT', 0),
(1704, 372, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, NULL, 'clear by Karnataka Bank', NULL, NULL, '2020-02-06', NULL, NULL, 2000.00, 292, 18, '1000', '2020-01-23', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1705, 373, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, NULL, 'Ponch clear by two accounts', NULL, NULL, '2020-02-08', NULL, NULL, 1680.00, 293, 16, '1000', '2020-01-23', '1000', '2020-01-23 06:06:22', 'PRR5ZT', 1),
(1706, 373, NULL, NULL, 'Cash', '104 ', NULL, NULL, NULL, NULL, NULL, 'Ponch clear by two accounts', NULL, NULL, '2020-02-08', NULL, NULL, 2000.00, 294, NULL, '1000', '2020-01-23', '1000', '2020-01-23 05:46:55', 'PRR5ZT', 1),
(1707, NULL, 426, NULL, 'Bank', '104', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-01', NULL, 3500.00, NULL, NULL, NULL, '1000', '2020-01-23', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1708, NULL, 427, NULL, 'Bank', '104', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-11', NULL, 10500.00, NULL, NULL, NULL, '1000', '2020-01-23', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1709, NULL, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, 62, 'sb transfer', NULL, NULL, '2020-02-16', NULL, NULL, 100.00, NULL, 18, '1000', '2020-01-23', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1710, NULL, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, 63, 'ideal addition', NULL, NULL, '2020-02-06', NULL, NULL, 1000.00, NULL, 23, '1000', '2020-01-23', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1711, NULL, 428, NULL, 'Bank', '105', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-05', NULL, 1500.00, NULL, NULL, NULL, '1000', '2020-01-23', '1000', '2020-01-23 11:32:45', 'PRR5ZT', 1),
(1712, 375, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '2020-02-08', NULL, NULL, 0.00, NULL, 0, '1000', '2020-01-23', '1000', '2020-01-24 06:13:08', 'PRR5ZT', 0),
(1713, 375, NULL, NULL, 'Cash', '104', NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, '2020-02-08', NULL, NULL, 0.00, NULL, NULL, '1000', '2020-01-23', '1000', '2020-01-24 06:13:08', 'PRR5ZT', 0),
(1714, NULL, NULL, NULL, 'Cash', '104', NULL, NULL, NULL, NULL, 65, 'kyra transfer', NULL, NULL, '2020-02-06', NULL, NULL, 2000.00, NULL, NULL, '1000', '2020-01-23', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1715, 376, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, NULL, 'Tanav transports', NULL, NULL, '2020-02-09', NULL, NULL, 2500.00, NULL, 23, '1000', '2020-01-24', '1000', '2020-01-24 06:24:13', 'PRR5ZT', 0),
(1716, 376, NULL, NULL, 'Cash', '0', NULL, NULL, NULL, NULL, NULL, 'Tanav transports', NULL, NULL, '2020-02-09', NULL, NULL, 0.00, NULL, NULL, '1000', '2020-01-24', '1000', '2020-01-24 06:24:13', 'PRR5ZT', 0),
(1717, NULL, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, 66, 'jhgfd', NULL, NULL, '2020-02-10', NULL, NULL, 1700.00, NULL, 23, '1000', '2020-01-24', '1000', '2020-01-24 02:15:39', 'PRR5ZT', 1),
(1718, NULL, 429, NULL, 'Bank', '104', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-06', NULL, 1000.00, NULL, NULL, NULL, '1000', '2020-01-24', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1719, NULL, 430, NULL, 'Bank', '107', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-02-10', NULL, 55000.00, NULL, NULL, NULL, '1000', '2020-01-24', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1720, NULL, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, 67, 'Transfering to KyRA', NULL, NULL, '2020-02-12', NULL, NULL, 15500.00, NULL, 23, '1000', '2020-01-24', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1721, 375, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, NULL, 'PENDING TRANSFER', NULL, NULL, '2020-02-08', NULL, NULL, 2100.00, 295, 16, '1000', '2020-01-24', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1722, NULL, 431, NULL, 'Bank', '107', NULL, NULL, NULL, NULL, NULL, 'ghjkl', NULL, NULL, '2020-02-06', NULL, 5000.00, NULL, NULL, 16, '1000', '2020-01-24', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1723, NULL, 432, NULL, 'Bank', '107', NULL, NULL, NULL, NULL, NULL, 'Karnataka transfer', NULL, NULL, '2020-02-13', NULL, 1000.00, NULL, NULL, 16, '1000', '2020-01-24', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1724, 370, NULL, NULL, 'Bank', '', NULL, NULL, NULL, NULL, NULL, 'ponch by karnataka', NULL, NULL, '2020-02-20', NULL, NULL, 1300.00, 296, 18, '1000', '2020-01-24', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1725, NULL, NULL, NULL, 'Cash', '107 ', 64, NULL, NULL, NULL, NULL, 'gtyuyui', NULL, NULL, '2020-02-06', NULL, 500.00, NULL, NULL, NULL, '1000', '2020-01-24', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(1726, NULL, NULL, NULL, 'Cash', '104 ', 64, NULL, NULL, NULL, NULL, 'gtyuyui', NULL, NULL, '2020-02-06', NULL, NULL, 500.00, NULL, NULL, '1000', '2020-01-24', '', '0000-00-00 00:00:00', 'PRR5ZT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cash_ledger`
--

CREATE TABLE `tbl_cash_ledger` (
  `row_id` bigint(20) NOT NULL,
  `cash_ledger_date` date NOT NULL,
  `cash_amount` double(10,2) NOT NULL,
  `party_rowid` bigint(20) NOT NULL,
  `reason` varchar(3000) DEFAULT NULL,
  `cash_account_rowid` bigint(20) NOT NULL,
  `type` int(11) NOT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `company_id` varchar(55) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_cash_ledger`
--

INSERT INTO `tbl_cash_ledger` (`row_id`, `cash_ledger_date`, `cash_amount`, `party_rowid`, `reason`, `cash_account_rowid`, `type`, `created_by`, `created_date_time`, `updated_by`, `updated_date_time`, `company_id`, `is_deleted`) VALUES
(208, '2020-02-10', 1500.00, 230, 'Expense', 104, 0, '1000', '2020-01-17 07:43:31', '1000', '2020-01-24 10:31:21', 'PRR5ZT', 1),
(209, '2020-02-16', 4550.00, 230, 'testing', 105, 0, '1000', '2020-01-17 07:59:28', '1000', '2020-01-18 09:38:18', 'PRR5ZT', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_company_profile`
--

CREATE TABLE `tbl_company_profile` (
  `row_id` int(11) NOT NULL,
  `company_id` varchar(55) NOT NULL,
  `company_name` varchar(55) NOT NULL,
  `company_logo` varchar(3000) DEFAULT NULL,
  `company_website_url` varchar(3000) NOT NULL,
  `cgst` varchar(55) DEFAULT NULL,
  `sgst` varchar(55) DEFAULT NULL,
  `igst` varchar(55) DEFAULT NULL,
  `utgst` varchar(55) DEFAULT NULL,
  `company_gst_number` varchar(55) DEFAULT NULL,
  `company_pan_number` varchar(55) NOT NULL,
  `founder_name` varchar(55) NOT NULL,
  `company_address` varchar(3000) NOT NULL,
  `company_contact_number_one` varchar(55) NOT NULL,
  `company_contact_number_two` varchar(55) DEFAULT NULL,
  `company_email` varchar(128) NOT NULL,
  `total_employee` varchar(55) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `created_by` varchar(55) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `updated_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_company_profile`
--

INSERT INTO `tbl_company_profile` (`row_id`, `company_id`, `company_name`, `company_logo`, `company_website_url`, `cgst`, `sgst`, `igst`, `utgst`, `company_gst_number`, `company_pan_number`, `founder_name`, `company_address`, `company_contact_number_one`, `company_contact_number_two`, `company_email`, `total_employee`, `is_deleted`, `created_by`, `created_date_time`, `updated_by`, `updated_date_time`) VALUES
(14, 'PRR5ZT', 'Karavali Transport', 'http://karavali.parrothink.com/upload/kt-1-logo-png-transparent.png', 'info@karavalitransport.com', '', '', '', '', '', '9983927', 'Karavali', 'mangalore', '9887327382', '8382738263', 'karavali@gmail.com', '67', 0, '1', '2019-09-12 08:50:17', '1000', '2020-01-02 05:59:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `customer_id` bigint(20) NOT NULL,
  `company_id` varchar(55) NOT NULL,
  `customer_name` varchar(128) NOT NULL,
  `customer_code` varchar(55) NOT NULL,
  `gender` varchar(55) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `contact_number` varchar(55) DEFAULT NULL,
  `alternative_contact_number` varchar(55) DEFAULT NULL,
  `customer_address` varchar(3000) NOT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `is_deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`customer_id`, `company_id`, `customer_name`, `customer_code`, `gender`, `email`, `contact_number`, `alternative_contact_number`, `customer_address`, `created_by`, `created_date_time`, `updated_by`, `updated_date_time`, `is_deleted`) VALUES
(33, 'PRR5ZT', 'Test', '1234566', NULL, NULL, '9481611667', NULL, 'Mangalore', '1000', '2019-12-27 05:00:19', '', '0000-00-00 00:00:00', 0),
(34, 'PRR5ZT', 'Anson Lasrado', '49001685', NULL, NULL, '7760239909', NULL, 'Kulshekar\r\nAnston', '1000', '2019-12-27 05:06:47', '1000', '2019-12-27 06:31:58', 1),
(35, 'PRR5ZT', 'S J Petrochemicals', '42006712  / 54000934', NULL, NULL, '9326378880', NULL, 'S J PETROCHEMICALS , THANE GODOWN NO3/4,LAXMI DARSHAN EAST DROPADI CHHAYA COMPOUND , BEHIND PRITI PETROL PUMP,BHIWANDI,421302 MAHARASHTRA', 'KT1004', '2020-01-03 05:53:25', '', '0000-00-00 00:00:00', 0),
(36, 'PRR5ZT', 'Heliokem', '42004694', NULL, NULL, '9890207008', NULL, 'HELIOKEM\r\nNAGPUR PLOT NO 36 FIRST FLOOR SARIPUTRA CO-OPERATIVE  SOCIETY, KHADGAON  ROAD, WADI 440023 MAHARASHTRA', 'KT1004', '2020-01-02 11:46:07', '', '0000-00-00 00:00:00', 0),
(37, 'PRR5ZT', 'Mrpl Kasargod', 'DP-01', NULL, NULL, '7090034300', NULL, 'MRPL KASARGOD\r\n\r\nMangalore\r\nAl Mac Cot', 'KT1004', '2020-01-02 11:54:48', 'KT1004', '2020-01-02 11:55:00', 1),
(38, 'PRR5ZT', 'K B Plast', '42006384 / 54000848', NULL, NULL, '9833512863', NULL, 'K B PLAST\r\nBHIWANDI,THANE GALA NO .7, BHAMARE  COMPOUND , VALGAV DAPODA ROAD, BHIWANDI THANE 421302 MAHARASHTRA ', 'KT1004', '2020-01-03 05:42:49', '', '0000-00-00 00:00:00', 0),
(39, 'PRR5ZT', 'Mahavir Poly Plast', '42006230', NULL, NULL, '9422408125', NULL, 'MAHAVIR POLY PLAST\r\nc/s. Mehta agency\r\nsomwar pet, Madhavnagar dist\r\nSangli, maharashtra\r\n', 'KT1004', '2020-01-03 05:56:17', '', '0000-00-00 00:00:00', 0),
(40, 'PRR5ZT', 'R.s. Overseas Private Limited', '49001367', NULL, NULL, '8800601705', NULL, 'R. S. OVERSEAS PRIVATE LIMITED\r\n I-150, 1st Floor, \r\n Kirti Nagar\r\n New Delhi-110015\r\n Mob: 09310025902,\r\n', 'KT1004', '2020-01-03 05:55:04', '', '0000-00-00 00:00:00', 0),
(41, 'PRR5ZT', 'Kamal Polypack', '42006195', NULL, NULL, '9970850150', NULL, 'KAMAL POLYPACK\r\nplot.no-8 khasra no.70/2 70/3 70/5, \r\nJabalpur highway NH7\r\nbehind Anand weigh brigde,\r\nKapsi (bujurg)\r\nNagpur - 441104\r\n', 'KT1004', '2020-01-03 10:25:48', '', '0000-00-00 00:00:00', 0),
(42, 'PRR5ZT', 'Central India Plastofab Pvt Ltd', '49001830', NULL, NULL, '9860706616', NULL, 'CENTRAL INDIA PLASTOFAB PVT LTD\r\nD-37, MIDC Butibori, \r\nNagpur - 441122. \r\nPhone – 09860706616, 09423521947\r\n', 'KT1004', '2020-01-03 10:31:20', '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fuel_account`
--

CREATE TABLE `tbl_fuel_account` (
  `row_id` bigint(20) NOT NULL,
  `fuel_account_name` varchar(55) NOT NULL,
  `fuel_account_type` varchar(55) NOT NULL,
  `account_balance` double(10,2) DEFAULT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `company_id` varchar(55) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_fuel_account`
--

INSERT INTO `tbl_fuel_account` (`row_id`, `fuel_account_name`, `fuel_account_type`, `account_balance`, `created_by`, `created_date_time`, `updated_by`, `updated_date_time`, `company_id`, `is_deleted`) VALUES
(42, 'City Point', 'Company', 87900.00, '1000', '2020-01-23 09:57:53', '1000', '2020-01-23 11:43:11', 'PRR5ZT', 0),
(43, 'Ocean Pearl', 'Company', 69400.00, '1000', '2020-01-23 11:24:28', '1000', '2020-01-24 06:24:13', 'PRR5ZT', 0),
(44, 'Pranamya', 'Company', 17300.00, '1000', '2020-01-24 02:15:39', '1000', '2020-01-22 07:08:05', 'PRR5ZT', 0),
(45, 'Kyra', 'Company', 59000.00, '1000', '2020-01-24 05:59:49', '1000', '2020-01-24 06:13:08', 'PRR5ZT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fuel_cash_info`
--

CREATE TABLE `tbl_fuel_cash_info` (
  `row_id` int(11) NOT NULL,
  `fuel_account_rowid` bigint(20) NOT NULL,
  `cash_date` date NOT NULL,
  `cash_amount` double(10,2) NOT NULL,
  `cash_type` varchar(55) NOT NULL,
  `comments` text,
  `bank_row_id` int(11) DEFAULT NULL,
  `cash_row_id` int(11) DEFAULT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `company_id` varchar(55) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_fuel_cash_info`
--

INSERT INTO `tbl_fuel_cash_info` (`row_id`, `fuel_account_rowid`, `cash_date`, `cash_amount`, `cash_type`, `comments`, `bank_row_id`, `cash_row_id`, `created_by`, `created_date_time`, `updated_by`, `updated_date_time`, `company_id`, `is_deleted`) VALUES
(50, 42, '2020-01-17', 86000.00, 'Cash', 'Opening Balance', NULL, NULL, '1000', '2020-01-17 06:12:23', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(51, 42, '2020-02-27', 500.00, 'Cash', 'test', NULL, 104, '1000', '2020-01-17 09:22:05', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(52, 43, '2020-01-17', 60000.00, 'Cash', 'Opening Balance', NULL, NULL, '1000', '2020-01-17 10:02:59', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(53, 42, '2020-02-14', 1800.00, 'Cash', 'fuel test', NULL, 105, '1000', '2020-01-17 10:18:19', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(54, 44, '2020-01-17', 18000.00, 'Cash', 'Opening Balance', NULL, NULL, '1000', '2020-01-17 11:11:26', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(55, 44, '2020-02-18', 2000.00, 'Bank', 'bank transfer', 21, NULL, '1000', '2020-01-17 11:41:49', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(56, 44, '2020-01-18', 6000.00, 'Cash', 'first addition', NULL, 106, '1000', '2020-01-18 11:57:06', '1000', '2020-01-22 06:59:50', 'PRR5ZT', 1),
(57, 44, '2020-02-05', 2700.00, 'Cash', 'transfersable', NULL, 105, '1000', '2020-01-22 07:10:50', '1000', '2020-01-22 07:13:03', 'PRR5ZT', 1),
(58, 44, '2020-02-12', 1700.00, 'Cash', 'hgshj', NULL, 105, '1000', '2020-01-22 07:20:43', '1000', '2020-01-22 07:21:59', 'PRR5ZT', 1),
(59, 44, '2020-02-05', 1000.00, 'Cash', 'fsdfgh', NULL, 104, '1000', '2020-01-22 07:32:10', '1000', '2020-01-22 07:33:41', 'PRR5ZT', 1),
(60, 44, '2020-02-11', 1000.00, 'Bank', 'banking', 21, NULL, '1000', '2020-01-22 07:37:29', '1000', '2020-01-22 07:43:14', 'PRR5ZT', 1),
(61, 44, '2020-02-06', 1000.00, 'Bank', 'gssjhkl', 18, NULL, '1000', '2020-01-22 07:45:34', '1000', '2020-01-22 07:46:27', 'PRR5ZT', 1),
(62, 42, '2020-02-16', 100.00, 'Bank', 'sb transfer', 18, NULL, '1000', '2020-01-23 09:57:53', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(63, 43, '2020-02-06', 1000.00, 'Bank', 'ideal addition', 23, NULL, '1000', '2020-01-23 11:24:28', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(64, 45, '2020-01-23', 75000.00, 'Cash', 'Opening Balance', NULL, NULL, '1000', '2020-01-23 11:48:23', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(65, 45, '2020-02-06', 2000.00, 'Cash', 'kyra transfer', NULL, 104, '1000', '2020-01-23 12:09:39', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(66, 44, '2020-02-10', 1700.00, 'Bank', 'jhgfd', 23, NULL, '1000', '2020-01-24 02:14:11', '1000', '2020-01-24 02:15:39', 'PRR5ZT', 1),
(67, 45, '2020-02-12', 15500.00, 'Bank', 'Transfering to KyRA', 23, NULL, '1000', '2020-01-24 05:59:49', '', '0000-00-00 00:00:00', 'PRR5ZT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_fuel_expenses`
--

CREATE TABLE `tbl_fuel_expenses` (
  `row_id` int(11) NOT NULL,
  `cash_date` date NOT NULL,
  `fuel_account_row_id` int(11) DEFAULT NULL,
  `fuel_cash_info_row_id` int(11) DEFAULT NULL,
  `transaction_type` varchar(55) NOT NULL,
  `debit` double(10,2) DEFAULT NULL,
  `credit` double(10,2) DEFAULT NULL,
  `bank_account_row_id` int(11) DEFAULT NULL,
  `cash_account_row_id` int(11) DEFAULT NULL,
  `vehicle_no` varchar(55) DEFAULT NULL,
  `transport_row_id` int(11) DEFAULT NULL,
  `vehicle_type` varchar(55) DEFAULT 'Cash',
  `created_by` varchar(55) NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `fuel_info_row_id` int(11) DEFAULT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `company_id` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_fuel_expenses`
--

INSERT INTO `tbl_fuel_expenses` (`row_id`, `cash_date`, `fuel_account_row_id`, `fuel_cash_info_row_id`, `transaction_type`, `debit`, `credit`, `bank_account_row_id`, `cash_account_row_id`, `vehicle_no`, `transport_row_id`, `vehicle_type`, `created_by`, `updated_by`, `fuel_info_row_id`, `created_date_time`, `updated_date_time`, `is_deleted`, `company_id`) VALUES
(404, '2020-01-17', 42, 50, 'Cash', 86000.00, NULL, NULL, NULL, NULL, NULL, 'Cash', '1000', '', NULL, '2020-01-17 06:12:23', '0000-00-00 00:00:00', 0, 'PRR5ZT'),
(405, '2020-02-04', 42, NULL, 'Cash', 1200.00, NULL, NULL, NULL, 'KA 12 MJ 1851', NULL, 'Own', '1000', '', 355, '2020-01-17 06:27:31', '0000-00-00 00:00:00', 0, 'PRR5ZT'),
(406, '2020-02-27', 42, 51, 'Cash', NULL, 500.00, NULL, 104, NULL, NULL, 'Cash', '1000', '', NULL, '2020-01-17 09:22:05', '0000-00-00 00:00:00', 0, 'PRR5ZT'),
(407, '2020-01-17', 43, 52, 'Cash', 60000.00, NULL, NULL, NULL, NULL, NULL, 'Cash', '1000', '', NULL, '2020-01-17 10:02:59', '0000-00-00 00:00:00', 0, 'PRR5ZT'),
(408, '2020-02-14', 42, 53, 'Cash', NULL, 1800.00, NULL, 105, NULL, NULL, 'Cash', '1000', '', NULL, '2020-01-17 10:18:19', '0000-00-00 00:00:00', 0, 'PRR5ZT'),
(409, '2020-01-17', 44, 54, 'Cash', 18000.00, NULL, NULL, NULL, NULL, NULL, 'Cash', '1000', '', NULL, '2020-01-17 11:11:26', '0000-00-00 00:00:00', 0, 'PRR5ZT'),
(410, '2020-02-18', 44, 55, 'Bank', NULL, 2000.00, 21, NULL, NULL, NULL, 'Cash', '1000', '', NULL, '2020-01-17 11:41:49', '0000-00-00 00:00:00', 0, 'PRR5ZT'),
(411, '2020-02-11', 44, NULL, 'Cash', 1300.00, NULL, NULL, NULL, 'KA 18 2015', NULL, 'Own', '1000', '', 356, '2020-01-18 04:37:25', '0000-00-00 00:00:00', 0, 'PRR5ZT'),
(412, '2020-02-05', 42, NULL, 'Cash', 950.00, NULL, NULL, NULL, 'KA 20 C 4474', NULL, 'Own', '1000', '', 357, '2020-01-18 05:12:33', '0000-00-00 00:00:00', 1, 'PRR5ZT'),
(413, '2020-02-13', 42, NULL, 'Cash', 2000.00, NULL, NULL, NULL, 'KA 20 C 4474', NULL, 'Own', '1000', '', 358, '2020-01-18 04:57:20', '0000-00-00 00:00:00', 1, 'PRR5ZT'),
(414, '2020-02-20', 43, NULL, 'Cash', 1250.00, NULL, NULL, NULL, 'KA 20 C 4474', NULL, 'Own', '1000', '', 359, '2020-01-18 05:12:28', '0000-00-00 00:00:00', 1, 'PRR5ZT'),
(415, '2020-02-12', 43, NULL, 'Cash', 500.00, NULL, NULL, NULL, 'KA 20 C 4474', NULL, 'Own', '1000', '', 360, '2020-01-18 05:12:21', '0000-00-00 00:00:00', 1, 'PRR5ZT'),
(416, '2020-02-12', 43, NULL, 'Cash', 850.00, NULL, NULL, NULL, 'KA 20 C 4474', NULL, 'Own', '1000', '', 361, '2020-01-18 05:24:18', '0000-00-00 00:00:00', 1, 'PRR5ZT'),
(417, '2020-02-12', 43, NULL, 'Cash', 1250.00, NULL, NULL, NULL, 'KA 20 C 4474', NULL, 'Own', '1000', '', 362, '2020-01-18 05:46:46', '0000-00-00 00:00:00', 1, 'PRR5ZT'),
(418, '2020-02-03', 43, NULL, 'Cash', 1100.00, NULL, NULL, NULL, 'KA 20 C 4474', NULL, 'Own', '1000', '', 363, '2020-01-18 05:26:41', '0000-00-00 00:00:00', 0, 'PRR5ZT'),
(419, '2020-02-12', 43, NULL, 'Cash', 400.00, NULL, NULL, NULL, 'KA 18 1234', NULL, 'Own', '1000', '', 364, '2020-01-18 06:47:44', '0000-00-00 00:00:00', 0, 'PRR5ZT'),
(420, '2020-01-18', 44, 56, 'Cash', NULL, 6000.00, NULL, 106, NULL, NULL, 'Cash', '1000', '', NULL, '2020-01-18 11:57:06', '0000-00-00 00:00:00', 1, 'PRR5ZT'),
(421, '2020-02-05', 43, NULL, 'Cash', 500.00, NULL, NULL, NULL, 'KA 19 1234', 364, 'Lease', '1000', '1000', NULL, '2020-01-21 06:30:31', '2020-01-21 07:37:35', 1, 'PRR5ZT'),
(422, '2020-02-11', 43, NULL, 'Cash', 1500.00, NULL, NULL, NULL, 'KA 19 1234', 365, 'Lease', '1000', '1000', NULL, '2020-01-21 07:44:45', '2020-01-23 06:38:45', 0, 'PRR5ZT'),
(423, '2020-02-09', 43, NULL, 'Cash', 600.00, NULL, NULL, NULL, 'KA 18 7865', 366, 'Lease', '1000', '1000', NULL, '2020-01-21 09:15:26', '2020-01-23 07:20:43', 1, 'PRR5ZT'),
(424, '0000-00-00', 42, NULL, 'Cash', 1800.00, NULL, NULL, NULL, 'KA 18 7865', 367, 'Lease', '1000', '1000', NULL, '2020-01-21 09:50:39', '2020-01-21 12:22:18', 1, 'PRR5ZT'),
(425, '2020-02-05', 42, NULL, 'Cash', 1000.00, NULL, NULL, NULL, 'KA 19 1234', 368, 'Lease', '1000', '', NULL, '2020-01-21 10:55:32', '0000-00-00 00:00:00', 0, 'PRR5ZT'),
(426, '2020-02-06', 42, NULL, 'Cash', 2400.00, NULL, NULL, NULL, 'KL 14 2419', 369, 'Lease', '1000', '1000', NULL, '2020-01-22 05:10:12', '2020-01-22 05:54:22', 1, 'PRR5ZT'),
(427, '2020-02-08', 43, NULL, 'Cash', 2800.00, NULL, NULL, NULL, 'KA 18 7865', 370, 'Lease', '1000', '', NULL, '2020-01-22 06:42:31', '0000-00-00 00:00:00', 0, 'PRR5ZT'),
(428, '2020-02-06', 44, NULL, 'Cash', 800.00, NULL, NULL, NULL, 'KL 14 2419', 371, 'Lease', '1000', '1000', NULL, '2020-01-22 06:56:14', '2020-01-22 07:08:05', 1, 'PRR5ZT'),
(429, '2020-02-05', 44, 57, 'Cash', NULL, 2700.00, NULL, 105, NULL, NULL, 'Cash', '1000', '', NULL, '2020-01-22 07:10:50', '0000-00-00 00:00:00', 1, 'PRR5ZT'),
(430, '2020-02-12', 44, 58, 'Cash', NULL, 1700.00, NULL, 105, NULL, NULL, 'Cash', '1000', '', NULL, '2020-01-22 07:20:43', '0000-00-00 00:00:00', 1, 'PRR5ZT'),
(431, '2020-02-05', 44, 59, 'Cash', NULL, 1000.00, NULL, 104, NULL, NULL, 'Cash', '1000', '1000', NULL, '2020-01-22 07:32:10', '2020-01-22 07:33:41', 1, 'PRR5ZT'),
(432, '2020-02-11', 44, 60, 'Bank', NULL, 1000.00, 21, NULL, NULL, NULL, 'Cash', '1000', '', NULL, '2020-01-22 07:37:29', '0000-00-00 00:00:00', 1, 'PRR5ZT'),
(433, '2020-02-06', 44, 61, 'Bank', NULL, 1000.00, 18, NULL, NULL, NULL, 'Cash', '1000', '1000', NULL, '2020-01-22 07:45:34', '2020-01-22 07:46:27', 1, 'PRR5ZT'),
(434, '2020-01-09', 43, NULL, 'Cash', 3900.00, NULL, NULL, NULL, 'KA 19 1234', 373, 'Lease', '1000', '', NULL, '2020-01-22 11:38:59', '0000-00-00 00:00:00', 0, 'PRR5ZT'),
(435, '2020-02-16', 42, 62, 'Bank', NULL, 100.00, 18, NULL, NULL, NULL, 'Cash', '1000', '', NULL, '2020-01-23 09:57:53', '0000-00-00 00:00:00', 0, 'PRR5ZT'),
(436, '2020-02-06', 43, 63, 'Bank', NULL, 1000.00, 23, NULL, NULL, NULL, 'Cash', '1000', '', NULL, '2020-01-23 11:24:28', '0000-00-00 00:00:00', 0, 'PRR5ZT'),
(437, '2020-01-23', 45, 64, 'Cash', 75000.00, NULL, NULL, NULL, NULL, NULL, 'Cash', '1000', '', NULL, '2020-01-23 11:48:23', '0000-00-00 00:00:00', 0, 'PRR5ZT'),
(438, '2020-02-06', 45, 65, 'Cash', NULL, 2000.00, NULL, 104, NULL, NULL, 'Cash', '1000', '', NULL, '2020-01-23 12:09:39', '0000-00-00 00:00:00', 0, 'PRR5ZT'),
(439, '2020-02-08', 43, NULL, 'Cash', 700.00, NULL, NULL, NULL, 'KA 19 1234', 1, 'Lease', '1000', '', NULL, '2020-01-24 02:08:03', '0000-00-00 00:00:00', 0, 'PRR5ZT'),
(440, '2020-02-10', 44, 66, 'Bank', NULL, 1700.00, 23, NULL, NULL, NULL, 'Cash', '1000', '1000', NULL, '2020-01-24 02:14:11', '2020-01-24 02:15:39', 1, 'PRR5ZT'),
(441, '2020-02-12', 45, 67, 'Bank', NULL, 15500.00, 23, NULL, NULL, NULL, 'Cash', '1000', '', NULL, '2020-01-24 05:59:49', '0000-00-00 00:00:00', 0, 'PRR5ZT');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_last_login`
--

CREATE TABLE `tbl_last_login` (
  `id` bigint(20) NOT NULL,
  `employee_id` bigint(20) NOT NULL,
  `sessionData` varchar(2048) NOT NULL,
  `machineIp` varchar(1024) NOT NULL,
  `userAgent` varchar(128) NOT NULL,
  `agentString` varchar(1024) NOT NULL,
  `platform` varchar(128) NOT NULL,
  `createdDtm` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_last_login`
--

INSERT INTO `tbl_last_login` (`id`, `employee_id`, `sessionData`, `machineIp`, `userAgent`, `agentString`, `platform`, `createdDtm`) VALUES
(192, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '122.171.203.161', 'Chrome 79.0.3945.117', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', 'Windows 10', '2020-01-16 21:31:58'),
(193, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '122.171.203.161', 'Chrome 79.0.3945.117', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', 'Windows 10', '2020-01-17 02:16:44'),
(194, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '122.171.155.98', 'Chrome 79.0.3945.117', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', 'Windows 10', '2020-01-17 21:29:25'),
(195, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '122.171.155.98', 'Chrome 79.0.3945.117', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', 'Windows 10', '2020-01-17 21:54:34'),
(196, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '122.167.159.41', 'Chrome 79.0.3945.117', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', 'Windows 10', '2020-01-20 21:38:45'),
(197, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '122.172.190.128', 'Chrome 79.0.3945.117', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', 'Windows 10', '2020-01-21 21:44:02'),
(198, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '122.172.190.128', 'Chrome 79.0.3945.117', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', 'Windows 10', '2020-01-22 02:59:33'),
(199, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '122.167.152.188', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-01-22 21:52:28'),
(200, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '122.167.152.188', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-01-23 03:21:33'),
(201, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '157.49.134.87', 'Chrome 79.0.3945.117', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36', 'Windows 10', '2020-01-23 08:18:37'),
(202, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '157.49.212.230', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-01-23 18:57:38'),
(203, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '157.49.212.230', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-01-23 21:55:26'),
(204, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '122.179.55.219', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-01-24 21:52:02'),
(205, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '122.171.183.208', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 7', '2020-02-05 03:44:01'),
(206, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '117.230.133.94', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 10', '2020-02-05 11:36:05'),
(207, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '122.171.50.250', 'Chrome 79.0.3945.130', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 'Windows 7', '2020-02-13 04:48:45'),
(208, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '223.186.45.92', 'Chrome 83.0.4103.61', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'Windows 10', '2020-05-30 01:31:42'),
(209, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '223.186.45.92', 'Chrome 83.0.4103.61', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'Windows 10', '2020-05-30 01:34:06'),
(210, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '137.97.47.199', 'Chrome 83.0.4103.61', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'Windows 10', '2020-05-30 22:51:34'),
(211, 1000, '{\"role\":\"1\",\"roleText\":\"Administrator\",\"employee_name\":\"Admin\",\"contact_number\":\"\",\"company_id\":\"PRR5ZT\",\"company_logo\":\"http:\\/\\/karavali.parrothink.com\\/upload\\/kt-1-logo-png-transparent.png\",\"profile_image\":\"\",\"company_name\":\"Karavali Transport\"}', '137.97.246.116', 'Chrome 83.0.4103.61', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.61 Safari/537.36', 'Windows 10', '2020-06-01 00:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lease_vehicle_info`
--

CREATE TABLE `tbl_lease_vehicle_info` (
  `row_id` bigint(20) NOT NULL,
  `vehicle_number` varchar(55) NOT NULL,
  `transporter_rowid` bigint(20) NOT NULL,
  `contact_number_one` varchar(55) NOT NULL,
  `contact_number_two` varchar(55) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `vehicle_condition` varchar(55) DEFAULT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `company_id` varchar(55) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_lease_vehicle_info`
--

INSERT INTO `tbl_lease_vehicle_info` (`row_id`, `vehicle_number`, `transporter_rowid`, `contact_number_one`, `contact_number_two`, `email`, `vehicle_condition`, `created_by`, `created_date_time`, `updated_by`, `updated_date_time`, `company_id`, `is_deleted`) VALUES
(328, 'KA 19 1234', 43, '9876854320', '8978867000', 'ddetdsa89@yahoo.com', 'Bad', '1000', '2020-01-17 06:59:22', '1000', '2020-01-17 07:05:40', 'PRR5ZT', 0),
(329, 'KA 18 7865', 44, '8787564434', '8640545111', 'klfestrs32@gmail.com', 'Good', '1000', '2020-01-17 07:02:16', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(330, 'KL 14 8766', 43, '8766440321', '', 'indian54@yahoo.com', '', '1000', '2020-01-18 07:27:51', '1000', '2020-01-18 07:29:37', 'PRR5ZT', 1),
(331, 'KL 14 2419', 43, '9888221365', '', '', 'Bad', '1000', '2020-01-21 09:29:32', '', '0000-00-00 00:00:00', 'PRR5ZT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_own_vehicle_info`
--

CREATE TABLE `tbl_own_vehicle_info` (
  `row_id` bigint(20) NOT NULL,
  `vehicle_number` varchar(55) NOT NULL,
  `fc_date` date DEFAULT NULL,
  `road_tax_date` date DEFAULT NULL,
  `insurance_date` date DEFAULT NULL,
  `karnataka_permit_date` date DEFAULT NULL,
  `national_permit_date` date DEFAULT NULL,
  `emission_date` date DEFAULT NULL,
  `last_service_date` date DEFAULT NULL,
  `vehicle_condition` varchar(55) DEFAULT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `company_id` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_own_vehicle_info`
--

INSERT INTO `tbl_own_vehicle_info` (`row_id`, `vehicle_number`, `fc_date`, `road_tax_date`, `insurance_date`, `karnataka_permit_date`, `national_permit_date`, `emission_date`, `last_service_date`, `vehicle_condition`, `created_by`, `created_date_time`, `updated_by`, `updated_date_time`, `is_deleted`, `company_id`) VALUES
(37, 'KA 12 MJ 1851', '2020-02-05', '2021-02-10', '2020-02-07', '2020-02-08', '2020-02-07', '2020-02-01', '2020-02-02', 'Good', '1000', '2020-01-17 06:20:56', '1000', '2020-02-05 10:48:01', 0, 'PRR5ZT'),
(38, 'KA 20 C 4474', '2020-01-22', '0000-00-00', '2020-02-10', '2020-03-09', '2020-02-09', '2020-04-01', '2020-01-05', 'Normal', '1000', '2020-01-17 06:33:27', '1000', '2020-02-05 10:46:12', 0, 'PRR5ZT'),
(39, 'KA 18 2015', '2020-02-28', '2020-01-30', '2020-04-28', '2020-02-23', '2020-03-25', '2020-01-31', '2020-01-10', 'Good', '1000', '2020-01-18 04:32:27', '1000', '2020-01-18 06:42:58', 1, 'PRR5ZT'),
(40, 'KA 18 1234', '2020-02-12', '2020-01-14', '2020-02-01', '2020-05-15', '2020-01-31', '2020-01-25', '2019-12-18', 'Good', '1000', '2020-01-18 06:46:46', '1000', '2020-01-18 06:49:07', 1, 'PRR5ZT'),
(41, 'KL 14 5344', '2020-02-10', '0000-00-00', '2020-02-13', '2020-02-13', '2020-02-08', '2020-02-11', '0000-00-00', '', '1000', '2020-02-05 10:55:42', '', '0000-00-00 00:00:00', 0, 'PRR5ZT');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_own_vehicle_service_info`
--

CREATE TABLE `tbl_own_vehicle_service_info` (
  `row_id` bigint(20) NOT NULL,
  `own_vehicle_rowid` bigint(20) NOT NULL,
  `fuel_rowid` bigint(20) NOT NULL,
  `vehicle_number` varchar(55) NOT NULL,
  `service_date` date NOT NULL,
  `place` varchar(200) NOT NULL,
  `total_trip` bigint(20) NOT NULL,
  `trip_amount` double(10,2) NOT NULL,
  `comments` varchar(3000) NOT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `company_id` varchar(55) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_own_vehicle_service_info`
--

INSERT INTO `tbl_own_vehicle_service_info` (`row_id`, `own_vehicle_rowid`, `fuel_rowid`, `vehicle_number`, `service_date`, `place`, `total_trip`, `trip_amount`, `comments`, `created_by`, `created_date_time`, `updated_by`, `updated_date_time`, `company_id`, `is_deleted`) VALUES
(182, 37, 355, 'KA 12 MJ 1851', '2020-02-14', 'Udupi', 3, 2000.00, 'Test', '1000', '2020-01-17 06:31:09', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(183, 39, 356, 'KA 18 2015', '2020-02-14', 'Puttur', 2, 800.00, 'test trip', '1000', '2020-01-18 04:39:43', '1000', '2020-01-18 06:42:58', 'PRR5ZT', 1),
(184, 38, 363, 'KA 20 C 4474', '2020-02-12', 'Surathkal', 4, 2000.00, 'trips testing', '1000', '2020-01-18 05:28:22', '1000', '2020-01-18 06:07:42', 'PRR5ZT', 1),
(185, 38, 363, 'KA 20 C 4474', '2020-02-12', 'Mangalore', 5, 500.00, 'Trips', '1000', '2020-01-18 06:26:56', '', '0000-00-00 00:00:00', 'PRR5ZT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_own_vehicle_wheel_info`
--

CREATE TABLE `tbl_own_vehicle_wheel_info` (
  `row_id` bigint(20) NOT NULL,
  `own_vehicle_rowid` bigint(20) NOT NULL,
  `vehicle_number` varchar(55) NOT NULL,
  `wheel_number` varchar(55) NOT NULL,
  `wheel_type` varchar(55) NOT NULL,
  `wheel_position` varchar(55) NOT NULL,
  `comments` varchar(3000) NOT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `company_id` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_own_vehicle_wheel_info`
--

INSERT INTO `tbl_own_vehicle_wheel_info` (`row_id`, `own_vehicle_rowid`, `vehicle_number`, `wheel_number`, `wheel_type`, `wheel_position`, `comments`, `created_by`, `created_date_time`, `updated_by`, `updated_date_time`, `company_id`, `is_deleted`) VALUES
(9, 38, 'KA 20 C 4474', '4', 'LIFT', 'Right Left', 'sfm xtful khtui', '1000', '2020-01-17 06:38:24', '1000', '2020-01-18 06:20:11', 0, 1),
(10, 39, 'KA 18 2015', '54', 'FRONT', 'Right Right', 'positioning', '1000', '2020-01-18 04:41:26', '1000', '2020-01-18 06:42:58', 0, 1),
(11, 38, 'KA 20 C 4474', '32', 'DUMMY', 'Left Right', 'Testing Wheel', '1000', '2020-01-18 06:25:56', '', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_party_info`
--

CREATE TABLE `tbl_party_info` (
  `row_id` bigint(20) NOT NULL,
  `party_name` varchar(55) NOT NULL,
  `contact_number_one` varchar(55) NOT NULL,
  `contact_number_two` varchar(55) NOT NULL,
  `email` varchar(128) NOT NULL,
  `party_address` varchar(3000) NOT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `company_id` varchar(55) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_party_info`
--

INSERT INTO `tbl_party_info` (`row_id`, `party_name`, `contact_number_one`, `contact_number_two`, `email`, `party_address`, `created_by`, `created_date_time`, `updated_by`, `updated_date_time`, `company_id`, `is_deleted`) VALUES
(230, 'Paridhi', '9535546350', '', 'stranger21@gmail.com', 'Kottara , Mangalore', '1000', '2020-01-17 05:15:07', '', '2020-01-17 05:30:33', 'PRR5ZT', 0),
(231, 'Asd', '9867765533', '', '', 'uydtepo', '1000', '2020-01-17 05:38:02', '1000', '2020-01-17 05:38:40', 'PRR5ZT', 1),
(232, 'Tanav', '9844321762', '', 'tanu543@gmail.com', 'sfdghjkl', '1000', '2020-01-17 05:39:35', '', '2020-01-17 05:40:01', 'PRR5ZT', 0),
(233, 'Sharath ', '9986854376', '', 'cbsharath@gmail.com', 'Bangalore', '1000', '2020-01-18 04:45:17', '', '0000-00-00 00:00:00', 'PRR5ZT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ponch_cleared_info`
--

CREATE TABLE `tbl_ponch_cleared_info` (
  `row_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` double(10,2) NOT NULL,
  `transport_row_id` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `type` varchar(55) NOT NULL,
  `cash_account_row_id` int(11) DEFAULT NULL,
  `bank_account_row_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_ponch_cleared_info`
--

INSERT INTO `tbl_ponch_cleared_info` (`row_id`, `date`, `amount`, `transport_row_id`, `is_deleted`, `type`, `cash_account_row_id`, `bank_account_row_id`) VALUES
(281, '2020-01-21', 350.00, 364, 0, 'Cash', 105, NULL),
(282, '2020-01-21', 200.00, 367, 1, 'Cash', 105, NULL),
(283, '2020-02-12', 50.00, 367, 0, 'Bank', NULL, 16),
(284, '2020-02-12', 100.00, 367, 1, 'Cash', 106, NULL),
(285, '2020-02-10', 1500.00, 368, 1, 'Cash', 104, NULL),
(286, '2020-02-13', 2500.00, 368, 0, 'Cash', 105, NULL),
(287, '2020-01-21', 4000.00, 368, 1, 'Cash', 105, NULL),
(288, '2020-02-15', 4000.00, 368, 0, 'Cash', 106, NULL),
(289, '2020-02-06', 450.00, 367, 0, 'Cash', 105, NULL),
(290, '2020-02-12', 1200.00, 369, 1, 'Cash', 106, NULL),
(291, '2020-02-14', 700.00, 369, 0, 'Cash', 104, NULL),
(292, '2020-02-06', 2000.00, 372, 0, 'Bank', NULL, 18),
(293, '2020-02-08', 1680.00, 373, 1, 'Bank', NULL, 16),
(294, '2020-02-08', 2000.00, 373, 1, 'Cash', 104, NULL),
(295, '2020-02-08', 2100.00, 375, 0, 'Bank', NULL, 16),
(296, '2020-02-20', 1300.00, 370, 0, 'Bank', NULL, 18);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_indent_info`
--

CREATE TABLE `tbl_product_indent_info` (
  `row_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `contract_number` varchar(155) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_code` varchar(155) NOT NULL,
  `qty_unit` varchar(55) DEFAULT NULL,
  `destination_km` varchar(155) DEFAULT NULL,
  `lr_number` varchar(55) DEFAULT NULL,
  `tank_truck_number` varchar(55) DEFAULT NULL,
  `driver_name` varchar(155) DEFAULT NULL,
  `dl_num_validity` varchar(155) DEFAULT NULL,
  `cleaner_name` varchar(155) DEFAULT NULL,
  `fitness_cert_valid_date` date DEFAULT NULL,
  `created_date_time` datetime NOT NULL,
  `created_by` varchar(55) NOT NULL,
  `updated_date_time` int(11) DEFAULT NULL,
  `updated_by` varchar(55) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product_indent_info`
--

INSERT INTO `tbl_product_indent_info` (`row_id`, `date`, `contract_number`, `customer_id`, `product_code`, `qty_unit`, `destination_km`, `lr_number`, `tank_truck_number`, `driver_name`, `dl_num_validity`, `cleaner_name`, `fitness_cert_valid_date`, `created_date_time`, `created_by`, `updated_date_time`, `updated_by`, `is_deleted`) VALUES
(3, '2019-12-27', '321`3', 33, '234423', '2332 / 123713', 'weffee / 10km', '4234r', 'dve424324', 'svsvdfvfdvd  rvv', '3343', 'fddwfef', '2019-12-06', '2019-12-27 05:01:01', '1000', 2019, '1000', 1),
(4, '2019-12-27', '5332952/110621724', 33, 'POP011', '800 BAGS / 20MT', 'THANE -(M.H)', '125', 'KA  19 AA 9972', 'SURESH', '4785/2020', 'NAGESH', NULL, '2019-12-27 06:47:11', '1000', 2019, '1000', 1),
(7000, '2019-12-27', '5332952 / 110621724', 35, 'POP011', '800 BAGS/  20MT', 'THANE -(M.H)', '125', 'KA 19 AA 8588', 'SURESH', '4785/2020', 'NAGESH', NULL, '2019-12-27 09:14:44', '1000', NULL, NULL, 0),
(7001, '2020-01-03', '5332525', 39, 'POP013', '800 BAGS / 20 MT', 'SANGLI  (M.H)', '256', 'MH 26 AR 2568', 'SURESH', '2587/2020', 'MANU', NULL, '2020-01-03 05:58:32', 'KT1004', NULL, NULL, 0),
(7002, '2020-02-13', '987654221456', 42, '123', '21', 'manglore', '', '134', '', '', '', NULL, '2020-02-13 11:49:52', '1000', 2020, '1000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE `tbl_roles` (
  `role_id` tinyint(4) NOT NULL COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `tbl_roles` (`role_id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Director'),
(3, 'Manager'),
(4, 'Employee');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transporter`
--

CREATE TABLE `tbl_transporter` (
  `row_id` bigint(20) NOT NULL,
  `transporter_name` varchar(55) NOT NULL,
  `contact_number` varchar(55) NOT NULL,
  `email` varchar(128) NOT NULL,
  `transporter_address` varchar(3000) NOT NULL,
  `comments` text NOT NULL,
  `transporter_account_number` varchar(55) NOT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `company_id` varchar(55) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transporter`
--

INSERT INTO `tbl_transporter` (`row_id`, `transporter_name`, `contact_number`, `email`, `transporter_address`, `comments`, `transporter_account_number`, `created_by`, `created_date_time`, `updated_by`, `updated_date_time`, `company_id`, `is_deleted`) VALUES
(43, 'Shri Laxmi', '9123456780', '', 'Mangalore', 'New Transporter', '8874', '1000', '2020-01-17 06:52:01', '', '0000-00-00 00:00:00', 'PRR5ZT', 0),
(44, 'Sai Ram', '8733324176', 'wetrode6@gmail.com', 'Puttur', 'wertr nhjuj wer', '1235', '1000', '2020-01-17 06:54:43', '1000', '2020-01-17 07:11:57', 'PRR5ZT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transport_details_karavali`
--

CREATE TABLE `tbl_transport_details_karavali` (
  `row_id` bigint(20) NOT NULL,
  `date` date NOT NULL,
  `invoice_number` varchar(55) NOT NULL,
  `transporter_rowid` bigint(20) DEFAULT NULL,
  `vehicle_number` varchar(55) NOT NULL,
  `LR_no` varchar(55) NOT NULL,
  `party_rowid` bigint(20) NOT NULL,
  `bags` varchar(55) NOT NULL,
  `mt` double(10,2) NOT NULL,
  `destination` varchar(55) NOT NULL,
  `rate` double(10,2) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `cash_account_rowid` bigint(20) NOT NULL,
  `cash_amount` double(10,2) NOT NULL,
  `diesel_pump` varchar(55) NOT NULL,
  `diesel_amount` double(10,2) NOT NULL,
  `diesel_date` date DEFAULT NULL,
  `discount_amount` double(10,2) NOT NULL,
  `loading_charge` double(10,2) NOT NULL,
  `unloading_charge` double(10,2) NOT NULL,
  `ponch_amount` double(10,2) NOT NULL,
  `roro` double(10,2) NOT NULL,
  `bank_rowid` bigint(20) NOT NULL,
  `party_amount` double(10,2) NOT NULL,
  `narration` varchar(3000) NOT NULL,
  `ponch_pending` varchar(55) NOT NULL,
  `ponch_date` date NOT NULL,
  `ponch_clear_amount_by_bank` double(10,2) NOT NULL,
  `ponch_clear_amount_by_cash` double(10,2) NOT NULL,
  `ponch_clear_bank_account` bigint(20) NOT NULL,
  `ponch_clear_cash_account` bigint(20) NOT NULL,
  `fuel_account_row_id` int(11) DEFAULT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `company_id` varchar(55) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_transport_details_karavali`
--

INSERT INTO `tbl_transport_details_karavali` (`row_id`, `date`, `invoice_number`, `transporter_rowid`, `vehicle_number`, `LR_no`, `party_rowid`, `bags`, `mt`, `destination`, `rate`, `amount`, `cash_account_rowid`, `cash_amount`, `diesel_pump`, `diesel_amount`, `diesel_date`, `discount_amount`, `loading_charge`, `unloading_charge`, `ponch_amount`, `roro`, `bank_rowid`, `party_amount`, `narration`, `ponch_pending`, `ponch_date`, `ponch_clear_amount_by_bank`, `ponch_clear_amount_by_cash`, `ponch_clear_bank_account`, `ponch_clear_cash_account`, `fuel_account_row_id`, `created_by`, `created_date_time`, `updated_by`, `updated_date_time`, `company_id`, `is_deleted`) VALUES
(364, '2020-02-12', '123456', 43, 'KA 19 1234', '32', 233, '50', 25.00, 'Mysuru', 100.00, 2500.00, 105, 600.00, '', 500.00, '2020-02-05', 100.00, 100.00, 100.00, 0.00, 150.00, 21, 600.00, 'New Transport test', 'No', '2020-01-21', 0.00, 350.00, 0, 105, 43, '1000', '2020-01-21 06:30:31', '1000', '2020-01-21 07:37:35', 'PRR5ZT', 1),
(365, '2020-02-05', '22445', 43, 'KA 19 1234', '21', 233, '50', 20.00, 'Mysuru', 200.00, 4000.00, 106, 1800.00, '', 1500.00, '2020-02-11', 0.00, 100.00, 100.00, 450.00, 50.00, 0, 0.00, 'Ponch pending transport', 'Yes', '0000-00-00', 0.00, 0.00, 0, 0, 43, '1000', '2020-01-21 07:44:45', '1000', '2020-01-23 06:38:45', 'PRR5ZT', 0),
(366, '2020-02-14', '98765', 44, 'KA 18 7865', '89', 232, '40', 32.00, 'ujire', 120.00, 3840.00, 104, 2000.00, '', 600.00, '2020-02-09', 250.00, 250.00, 250.00, 0.00, 250.00, 16, 240.00, 'aklaredtgh l,;mnk', 'No', '0000-00-00', 0.00, 0.00, 0, 0, 43, '1000', '2020-01-21 09:15:26', '1000', '2020-01-23 07:20:43', 'PRR5ZT', 1),
(367, '2020-02-13', '5443', 44, 'KA 18 7865', '73', 230, '35', 48.00, 'Madikeri', 125.00, 6000.00, 106, 3000.00, '', 1800.00, '0000-00-00', 0.00, 0.00, 0.00, 700.00, 0.00, 21, 0.00, 'dra34tyu', 'Yes', '2020-02-06', 50.00, 750.00, 16, 105, 42, '1000', '2020-01-21 09:50:39', '1000', '2020-01-21 12:22:18', 'PRR5ZT', 1),
(368, '2020-02-02', '9982', 44, 'KA 19 1234', '55', 230, '45', 45.00, 'Puttur', 200.00, 9000.00, 104, 1500.00, '', 1000.00, '2020-02-05', 0.00, 0.00, 0.00, 0.00, 0.00, 0, 0.00, 'thank you', 'No', '2020-02-15', 0.00, 12000.00, 0, 106, 42, '1000', '2020-01-21 10:55:32', '1000', '2020-01-21 11:59:32', 'PRR5ZT', 0),
(369, '2020-02-04', '5521', 43, 'KL 14 2419', '43', 233, '60', 35.00, 'Surathkal', 230.00, 8050.00, 106, 1200.00, '', 2400.00, '2020-02-06', 0.00, 100.00, 100.00, 3500.00, 50.00, 0, 0.00, 'ponch test', 'Yes', '2020-02-14', 0.00, 1900.00, 0, 104, 42, '1000', '2020-01-22 05:10:12', '1000', '2020-01-22 05:54:22', 'PRR5ZT', 1),
(370, '2020-02-06', '3201', 43, 'KA 18 7865', '20', 233, '52', 68.00, 'Ujire', 150.00, 10200.00, 106, 1400.00, '', 2800.00, '2020-02-08', 50.00, 250.00, 250.00, 4000.00, 150.00, 0, 0.00, 'test fuel by ocean ', 'Yes', '2020-02-20', 1300.00, 0.00, 18, 0, 43, '1000', '2020-01-22 06:42:31', '1000', '2020-01-24 09:54:48', 'PRR5ZT', 0),
(371, '2020-02-03', '7600', 44, 'KL 14 2419', '44', 232, '75', 40.00, 'Surathkal', 180.00, 7200.00, 106, 400.00, '', 800.00, '2020-02-06', 0.00, 0.00, 0.00, 6000.00, 0.00, 0, 0.00, '', 'Yes', '0000-00-00', 0.00, 0.00, 0, 0, 44, '1000', '2020-01-22 06:56:14', '1000', '2020-01-22 07:08:05', 'PRR5ZT', 1),
(372, '2020-02-02', '8831', 43, 'KA 18 7865', '74', 230, '78', 75.00, 'Bangalore', 180.00, 13500.00, 105, 3000.00, '', 0.00, '0000-00-00', 0.00, 0.00, 0.00, 8500.00, 0.00, 0, 0.00, 'New Ponch Addition', 'Yes', '2020-02-06', 2000.00, 0.00, 18, 0, 0, '1000', '2020-01-22 11:19:06', '1000', '2020-01-23 06:25:13', 'PRR5ZT', 0),
(373, '2020-02-06', '988001', 44, 'KA 19 1234', '96', 233, '25', 89.00, 'Bangalore', 220.00, 19580.00, 0, 0.00, '', 3900.00, '2020-01-09', 0.00, 0.00, 0.00, 15680.00, 0.00, 0, 0.00, 'fffkkiocu', 'Yes', '2020-02-08', 1680.00, 2000.00, 16, 104, 43, '1000', '2020-01-22 11:38:59', '1000', '2020-01-23 06:06:22', 'PRR5ZT', 0),
(374, '2020-02-16', '111021', 43, 'KL 14 2419', '9801', 230, '85', 49.00, 'Coorg', 125.00, 6125.00, 0, 0.00, '', 500.00, '2020-02-05', 450.00, 500.00, 500.00, 4050.00, 125.00, 0, 0.00, 'arnodyas', 'Yes', '0000-00-00', 0.00, 0.00, 0, 0, 42, '1000', '2020-01-22 12:08:24', '1000', '2020-01-23 11:43:11', 'PRR5ZT', 0),
(375, '2020-02-08', '7654', 43, 'KA 19 1234', '2216', 233, '55', 68.00, 'Bangalore', 200.00, 13600.00, 104, 0.00, '', 1500.00, '2020-02-11', 0.00, 0.00, 0.00, 10000.00, 0.00, 0, 0.00, '', 'Yes', '2020-02-08', 2100.00, 0.00, 16, 0, 45, '1000', '2020-01-23 11:50:00', '1000', '2020-01-24 07:00:41', 'PRR5ZT', 0),
(376, '2020-02-09', '59102', 44, 'KA 19 1234', '109', 232, '54', 75.00, 'Puttur', 150.00, 11250.00, 0, 0.00, '', 700.00, '2020-02-08', 0.00, 0.00, 0.00, 8050.00, 0.00, 23, 2500.00, 'Tanav transports', 'Yes', '0000-00-00', 0.00, 0.00, 0, 0, 43, '1000', '2020-01-24 02:04:59', '1000', '2020-01-24 06:24:13', 'PRR5ZT', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `row_id` int(11) NOT NULL,
  `company_id` varchar(55) NOT NULL,
  `employee_id` varchar(55) CHARACTER SET latin1 NOT NULL,
  `employee_name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `gender` varchar(55) NOT NULL,
  `dob` date NOT NULL,
  `contact_number` varchar(55) NOT NULL,
  `alternative_contact_number` varchar(55) DEFAULT NULL,
  `employee_address` varchar(3000) NOT NULL,
  `role_id` tinyint(4) NOT NULL,
  `profile_image` varchar(2000) NOT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_by` varchar(55) DEFAULT NULL,
  `updated_date_time` datetime DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`row_id`, `company_id`, `employee_id`, `employee_name`, `email`, `password`, `gender`, `dob`, `contact_number`, `alternative_contact_number`, `employee_address`, `role_id`, `profile_image`, `created_by`, `created_date_time`, `updated_by`, `updated_date_time`, `is_deleted`) VALUES
(2, 'PRR5ZT', '1000', 'Admin', 'admin@karavali.com', '$2y$10$JAjX95oRd2Xdj6g2VkePOOkpn8qRW594MQVUyul.k2xf1bRHEGUye', 'male', '1990-06-12', '', '', '', 1, '', '', '0000-00-00 00:00:00', '1', '2019-09-12 09:31:19', 0),
(36, 'PRR5ZT', 'KT1001', 'Parrophins', '', '$2y$10$kVEpTI0AWH/9H.SEyZtgEe0mvKjeKCkfomcBpRLIqXK65A2vAs7DG', 'Male', '2019-12-11', '9481611667', '', 'test', 4, '', '1000', '2019-12-16 05:49:51', NULL, NULL, 0),
(37, 'PRR5ZT', 'KT1003', 'Shobhitha', '', '$2y$10$fLs2et49AGyBsBvKvGvw3OmjQldyVBzJuS8Wl1gWPxz5frwyBMsG6', 'Female', '1992-11-21', '1234567891', '', '0', 4, '', '1000', '2019-12-19 05:41:37', NULL, NULL, 0),
(38, 'PRR5ZT', 'KT1004', 'Shubha Rekha', '', '$2y$10$QfqB2qG1zd5pF0pR8lwOAeqDQ.zaU2jH/NSFg.SoviMeIn9KDXfkK', 'Female', '1991-06-01', '1212121212', '', ' 0', 4, '', 'KT1003', '2019-12-19 05:45:29', 'KT1004', '2019-12-19 06:04:36', 0),
(39, 'PRR5ZT', 'KT1005', 'Raksha Roopesh', '', '$2y$10$9LiQRRNV5RuSvRrQks2DbuFp3/tBvayqdDESWo3w754.sTBxnyOPG', 'Female', '1991-05-26', '2222222222', '', '0', 4, '', 'KT1003', '2019-12-19 05:46:18', NULL, NULL, 0),
(40, 'PRR5ZT', 'KT1006', 'Shilpa Dinesh', '', '$2y$10$JduE4QpK84fCGpl9te0TvuD/W3fKfzLAE1lQpsEM4O.6gViFiVF0O', 'Female', '1993-09-28', '3333333333', '', '0', 4, '', 'KT1003', '2019-12-19 05:49:20', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_vehicle_fuel_info`
--

CREATE TABLE `tbl_vehicle_fuel_info` (
  `row_id` bigint(20) NOT NULL,
  `ownVehicleRow_Id` bigint(20) DEFAULT NULL,
  `transport_rowid` bigint(20) DEFAULT NULL,
  `fuel_date` date DEFAULT NULL,
  `liter` double(10,2) DEFAULT NULL,
  `fuel_amount` double(10,2) NOT NULL,
  `vehicle_number` varchar(55) NOT NULL,
  `diesel_pump` varchar(55) NOT NULL,
  `fuel_pump_id` int(11) DEFAULT NULL,
  `vehicle_type` varchar(55) NOT NULL,
  `fuel_account_row_id` int(11) DEFAULT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `updated_date_time` datetime NOT NULL,
  `company_id` varchar(55) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT '0',
  `fuel_type` varchar(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_vehicle_fuel_info`
--

INSERT INTO `tbl_vehicle_fuel_info` (`row_id`, `ownVehicleRow_Id`, `transport_rowid`, `fuel_date`, `liter`, `fuel_amount`, `vehicle_number`, `diesel_pump`, `fuel_pump_id`, `vehicle_type`, `fuel_account_row_id`, `created_by`, `created_date_time`, `updated_by`, `updated_date_time`, `company_id`, `is_deleted`, `fuel_type`) VALUES
(355, 37, NULL, '2020-02-04', 15.00, 1200.00, 'KA 12 MJ 1851', '', NULL, 'Own', 42, '1000', '2020-01-17 06:27:31', '', '0000-00-00 00:00:00', 'PRR5ZT', 0, 'Diesel'),
(356, 39, NULL, '2020-02-11', 19.00, 1300.00, 'KA 18 2015', '', NULL, 'Own', 44, '1000', '2020-01-18 04:37:25', '1000', '2020-01-18 06:42:58', 'PRR5ZT', 1, 'Diesel'),
(357, 38, NULL, '2020-02-05', 12.00, 950.00, 'KA 20 C 4474', '', NULL, 'Own', 42, '1000', '2020-01-18 04:47:50', '1000', '2020-01-18 05:12:33', 'PRR5ZT', 1, 'Petrol'),
(358, 38, NULL, '2020-02-13', 18.00, 2000.00, 'KA 20 C 4474', '', NULL, 'Own', 42, '1000', '2020-01-18 04:55:23', '1000', '2020-01-18 04:57:20', 'PRR5ZT', 1, 'Diesel'),
(359, 38, NULL, '2020-02-20', 16.00, 1250.00, 'KA 20 C 4474', '', NULL, 'Own', 43, '1000', '2020-01-18 05:07:41', '1000', '2020-01-18 05:12:28', 'PRR5ZT', 1, 'Oil'),
(360, 38, NULL, '2020-02-12', 23.00, 500.00, 'KA 20 C 4474', '', NULL, 'Own', 43, '1000', '2020-01-18 05:08:45', '1000', '2020-01-18 05:12:21', 'PRR5ZT', 1, 'Waste'),
(361, 38, NULL, '2020-02-12', 8.00, 850.00, 'KA 20 C 4474', '', NULL, 'Own', 43, '1000', '2020-01-18 05:21:52', '1000', '2020-01-18 05:24:18', 'PRR5ZT', 1, 'Petrol'),
(362, 38, NULL, '2020-02-12', 19.00, 1250.00, 'KA 20 C 4474', '', NULL, 'Own', 43, '1000', '2020-01-18 05:25:40', '1000', '2020-01-18 05:46:46', 'PRR5ZT', 1, 'Diesel'),
(363, 38, NULL, '2020-02-03', 13.00, 1100.00, 'KA 20 C 4474', '', NULL, 'Own', 43, '1000', '2020-01-18 05:26:41', '', '0000-00-00 00:00:00', 'PRR5ZT', 0, 'Diesel'),
(364, 40, NULL, '2020-02-12', 6.00, 400.00, 'KA 18 1234', '', NULL, 'Own', 43, '1000', '2020-01-18 06:47:44', '1000', '2020-01-18 06:49:07', 'PRR5ZT', 1, 'Diesel'),
(365, NULL, 364, '2020-02-05', NULL, 500.00, 'KA 19 1234', '', NULL, 'Lease', 43, '1000', '2020-01-21 06:30:31', '1000', '2020-01-21 07:37:35', 'PRR5ZT', 1, NULL),
(366, NULL, 365, '2020-02-11', NULL, 1500.00, 'KA 19 1234', '', NULL, 'Lease', 42, '1000', '2020-01-21 07:44:45', '1000', '2020-01-23 06:38:45', 'PRR5ZT', 0, NULL),
(367, NULL, 366, '2020-02-09', NULL, 600.00, 'KA 18 7865', '', NULL, 'Lease', 43, '1000', '2020-01-21 09:15:26', '1000', '2020-01-23 07:20:43', 'PRR5ZT', 1, NULL),
(368, NULL, 367, '0000-00-00', NULL, 1800.00, 'KA 18 7865', '', NULL, 'Lease', 42, '1000', '2020-01-21 09:50:39', '1000', '2020-01-21 12:22:18', 'PRR5ZT', 1, NULL),
(369, NULL, 368, '2020-02-05', NULL, 1000.00, 'KA 19 1234', '', NULL, 'Lease', 42, '1000', '2020-01-21 10:55:32', '', '0000-00-00 00:00:00', 'PRR5ZT', 0, NULL),
(370, NULL, 369, '2020-02-06', NULL, 2400.00, 'KL 14 2419', '', NULL, 'Lease', 42, '1000', '2020-01-22 05:10:12', '1000', '2020-01-22 05:54:22', 'PRR5ZT', 1, NULL),
(371, NULL, 370, '2020-02-08', NULL, 2800.00, 'KA 18 7865', '', NULL, 'Lease', 43, '1000', '2020-01-22 06:42:31', '', '0000-00-00 00:00:00', 'PRR5ZT', 0, NULL),
(372, NULL, 371, '2020-02-06', NULL, 800.00, 'KL 14 2419', '', NULL, 'Lease', 44, '1000', '2020-01-22 06:56:14', '1000', '2020-01-22 07:08:05', 'PRR5ZT', 1, NULL),
(373, NULL, 373, '2020-01-09', NULL, 3900.00, 'KA 19 1234', '', NULL, 'Lease', 43, '1000', '2020-01-22 11:38:59', '', '0000-00-00 00:00:00', 'PRR5ZT', 0, NULL),
(374, NULL, 374, '2020-02-05', NULL, 500.00, 'KL 14 2419', '', NULL, 'Lease', 42, '1000', '2020-01-23 11:43:11', '', '0000-00-00 00:00:00', 'PRR5ZT', 0, NULL),
(375, NULL, 375, '2020-02-11', NULL, 1500.00, 'KA 19 1234', '', NULL, 'Lease', 45, '1000', '2020-01-23 11:53:18', '1000', '2020-01-24 06:13:08', 'PRR5ZT', 0, NULL),
(376, NULL, 376, '2020-02-08', NULL, 700.00, 'KA 19 1234', '', NULL, 'Lease', 43, '1000', '2020-01-24 02:08:03', '1000', '2020-01-24 06:24:13', 'PRR5ZT', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bank_info`
--
ALTER TABLE `tbl_bank_info`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `tbl_cash_account`
--
ALTER TABLE `tbl_cash_account`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `tbl_cash_account_transfer_info`
--
ALTER TABLE `tbl_cash_account_transfer_info`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `tbl_cash_details`
--
ALTER TABLE `tbl_cash_details`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `cash_account_rowid` (`cash_account_rowid`);

--
-- Indexes for table `tbl_cash_expenses`
--
ALTER TABLE `tbl_cash_expenses`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `tbl_cash_ledger`
--
ALTER TABLE `tbl_cash_ledger`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `party_rowid` (`party_rowid`);

--
-- Indexes for table `tbl_company_profile`
--
ALTER TABLE `tbl_company_profile`
  ADD PRIMARY KEY (`company_id`),
  ADD UNIQUE KEY `row_id` (`row_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `tbl_fuel_account`
--
ALTER TABLE `tbl_fuel_account`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `tbl_fuel_cash_info`
--
ALTER TABLE `tbl_fuel_cash_info`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `tbl_fuel_expenses`
--
ALTER TABLE `tbl_fuel_expenses`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lease_vehicle_info`
--
ALTER TABLE `tbl_lease_vehicle_info`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `tbl_own_vehicle_info`
--
ALTER TABLE `tbl_own_vehicle_info`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `tbl_own_vehicle_service_info`
--
ALTER TABLE `tbl_own_vehicle_service_info`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `tbl_own_vehicle_wheel_info`
--
ALTER TABLE `tbl_own_vehicle_wheel_info`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `tbl_party_info`
--
ALTER TABLE `tbl_party_info`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `tbl_ponch_cleared_info`
--
ALTER TABLE `tbl_ponch_cleared_info`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `tbl_product_indent_info`
--
ALTER TABLE `tbl_product_indent_info`
  ADD PRIMARY KEY (`row_id`);

--
-- Indexes for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tbl_transporter`
--
ALTER TABLE `tbl_transporter`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `tbl_transport_details_karavali`
--
ALTER TABLE `tbl_transport_details_karavali`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`row_id`),
  ADD UNIQUE KEY `userId` (`employee_id`),
  ADD UNIQUE KEY `row_id` (`row_id`);

--
-- Indexes for table `tbl_vehicle_fuel_info`
--
ALTER TABLE `tbl_vehicle_fuel_info`
  ADD PRIMARY KEY (`row_id`),
  ADD KEY `company_id` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bank_info`
--
ALTER TABLE `tbl_bank_info`
  MODIFY `row_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_cash_account`
--
ALTER TABLE `tbl_cash_account`
  MODIFY `row_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `tbl_cash_account_transfer_info`
--
ALTER TABLE `tbl_cash_account_transfer_info`
  MODIFY `row_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `tbl_cash_details`
--
ALTER TABLE `tbl_cash_details`
  MODIFY `row_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=434;

--
-- AUTO_INCREMENT for table `tbl_cash_expenses`
--
ALTER TABLE `tbl_cash_expenses`
  MODIFY `row_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1727;

--
-- AUTO_INCREMENT for table `tbl_cash_ledger`
--
ALTER TABLE `tbl_cash_ledger`
  MODIFY `row_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `tbl_company_profile`
--
ALTER TABLE `tbl_company_profile`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `customer_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbl_fuel_account`
--
ALTER TABLE `tbl_fuel_account`
  MODIFY `row_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_fuel_cash_info`
--
ALTER TABLE `tbl_fuel_cash_info`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `tbl_fuel_expenses`
--
ALTER TABLE `tbl_fuel_expenses`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=442;

--
-- AUTO_INCREMENT for table `tbl_last_login`
--
ALTER TABLE `tbl_last_login`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=212;

--
-- AUTO_INCREMENT for table `tbl_lease_vehicle_info`
--
ALTER TABLE `tbl_lease_vehicle_info`
  MODIFY `row_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;

--
-- AUTO_INCREMENT for table `tbl_own_vehicle_info`
--
ALTER TABLE `tbl_own_vehicle_info`
  MODIFY `row_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `tbl_own_vehicle_service_info`
--
ALTER TABLE `tbl_own_vehicle_service_info`
  MODIFY `row_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT for table `tbl_own_vehicle_wheel_info`
--
ALTER TABLE `tbl_own_vehicle_wheel_info`
  MODIFY `row_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_party_info`
--
ALTER TABLE `tbl_party_info`
  MODIFY `row_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=234;

--
-- AUTO_INCREMENT for table `tbl_ponch_cleared_info`
--
ALTER TABLE `tbl_ponch_cleared_info`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;

--
-- AUTO_INCREMENT for table `tbl_product_indent_info`
--
ALTER TABLE `tbl_product_indent_info`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7003;

--
-- AUTO_INCREMENT for table `tbl_roles`
--
ALTER TABLE `tbl_roles`
  MODIFY `role_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_transporter`
--
ALTER TABLE `tbl_transporter`
  MODIFY `row_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `tbl_transport_details_karavali`
--
ALTER TABLE `tbl_transport_details_karavali`
  MODIFY `row_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=377;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tbl_vehicle_fuel_info`
--
ALTER TABLE `tbl_vehicle_fuel_info`
  MODIFY `row_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=377;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bank_info`
--
ALTER TABLE `tbl_bank_info`
  ADD CONSTRAINT `tbl_bank_info_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tbl_company_profile` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_cash_account`
--
ALTER TABLE `tbl_cash_account`
  ADD CONSTRAINT `tbl_cash_account_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tbl_company_profile` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_cash_details`
--
ALTER TABLE `tbl_cash_details`
  ADD CONSTRAINT `tbl_cash_details_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tbl_company_profile` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_cash_details_ibfk_2` FOREIGN KEY (`cash_account_rowid`) REFERENCES `tbl_cash_account` (`row_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_cash_ledger`
--
ALTER TABLE `tbl_cash_ledger`
  ADD CONSTRAINT `tbl_cash_ledger_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tbl_company_profile` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_cash_ledger_ibfk_2` FOREIGN KEY (`party_rowid`) REFERENCES `tbl_party_info` (`row_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_lease_vehicle_info`
--
ALTER TABLE `tbl_lease_vehicle_info`
  ADD CONSTRAINT `tbl_lease_vehicle_info_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tbl_company_profile` (`company_id`);

--
-- Constraints for table `tbl_own_vehicle_info`
--
ALTER TABLE `tbl_own_vehicle_info`
  ADD CONSTRAINT `tbl_own_vehicle_info_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tbl_company_profile` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_own_vehicle_service_info`
--
ALTER TABLE `tbl_own_vehicle_service_info`
  ADD CONSTRAINT `tbl_own_vehicle_service_info_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tbl_company_profile` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_party_info`
--
ALTER TABLE `tbl_party_info`
  ADD CONSTRAINT `tbl_party_info_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tbl_company_profile` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_transporter`
--
ALTER TABLE `tbl_transporter`
  ADD CONSTRAINT `tbl_transporter_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tbl_company_profile` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_transport_details_karavali`
--
ALTER TABLE `tbl_transport_details_karavali`
  ADD CONSTRAINT `tbl_transport_details_karavali_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tbl_company_profile` (`company_id`);

--
-- Constraints for table `tbl_vehicle_fuel_info`
--
ALTER TABLE `tbl_vehicle_fuel_info`
  ADD CONSTRAINT `tbl_vehicle_fuel_info_ibfk_1` FOREIGN KEY (`company_id`) REFERENCES `tbl_company_profile` (`company_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
