-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2021 at 11:33 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `tbl_billing_info`
--

CREATE TABLE `tbl_billing_info` (
  `row_id` int(11) NOT NULL,
  `bill_no` int(11) NOT NULL,
  `date` date NOT NULL,
  `ref_no` int(11) NOT NULL,
  `product` varchar(55) NOT NULL,
  `party_row_id` int(11) NOT NULL,
  `party_gst` varchar(55) NOT NULL,
  `party_state_code` int(11) NOT NULL,
  `total_amount` double(10,2) NOT NULL,
  `created_by` varchar(55) NOT NULL,
  `created_date_time` datetime NOT NULL,
  `updated_by` varchar(55) NOT NULL,
  `updated_date_time` datetime DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_billing_info`
--
ALTER TABLE `tbl_billing_info`
  ADD PRIMARY KEY (`row_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_billing_info`
--
ALTER TABLE `tbl_billing_info`
  MODIFY `row_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
