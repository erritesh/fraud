-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2021 at 07:25 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ml_fraud_detection`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicant_details`
--

CREATE TABLE `applicant_details` (
  `id` int(6) NOT NULL,
  `app_start_time` datetime NOT NULL,
  `app_submission_time` datetime NOT NULL,
  `applicant_name` varchar(30) NOT NULL,
  `app_email` varchar(40) NOT NULL,
  `app_onphone` varchar(15) NOT NULL,
  `app_ssn` varchar(10) NOT NULL,
  `app_mailing` varchar(255) NOT NULL,
  `landlord_name` varchar(30) NOT NULL,
  `landlord_address` varchar(255) NOT NULL,
  `renter` int(20) NOT NULL,
  `unit_type` varchar(20) NOT NULL,
  `requested_amount` int(6) NOT NULL,
  `classification` varchar(20) DEFAULT NULL,
  `AI_prediction` decimal(4,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applicant_details`
--

INSERT INTO `applicant_details` (`id`, `app_start_time`, `app_submission_time`, `applicant_name`, `app_email`, `app_onphone`, `app_ssn`, `app_mailing`, `landlord_name`, `landlord_address`, `renter`, `unit_type`, `requested_amount`, `classification`, `AI_prediction`) VALUES
(4, '2021-11-24 18:08:09', '2021-11-24 18:08:49', 'Akshay kumar jha', 'rayan@gmailcom', '87654321', '8', 'patna', 'Jopseph', 'paris', 42, 'Multi-Family', 9879, 'Fraud', '0.800'),
(7, '2021-11-26 00:37:09', '2021-11-26 00:37:40', 'Sunil Dutt', 'sunil@gmail.com', '89786798', '73333', 'Haryana', 'Guru dutt', 'mumbai kolaba', 1, 'Single-Family', 7890, 'Not Fraud', '0.200'),
(15, '2021-11-27 15:23:06', '2021-11-27 10:53:46', 'Arun', 'arun@gmail.com', '897678', '76567', 'Godda', 'Madhu', 'Deklhi', 1, 'Single-Family', 1200, 'Fraud', '0.900'),
(16, '2021-11-27 18:06:19', '2021-11-27 18:06:50', 'Barun Dhawan', 'barun@gmail.com', '897878999', '5467', 'mumbai', 'david ', 'mumbai', 1, 'Single-Family', 2000, 'Not Fraud', '0.200'),
(18, '2021-11-27 22:28:45', '2021-11-27 22:29:25', 'abc', 'abc@gmail.com', '9878767898', '111', 'abcnagar', 'xyz', 'xyznagar', 2, 'Single-Family', 3444, 'Not Fraud', '0.200');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicant_details`
--
ALTER TABLE `applicant_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicant_details`
--
ALTER TABLE `applicant_details`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
