-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 31, 2021 at 05:51 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parking`
--

-- --------------------------------------------------------

--
-- Table structure for table `master_inventory`
--

CREATE TABLE `master_inventory` (
  `id` int(11) NOT NULL,
  `ref_no` varchar(80) NOT NULL,
  `master_parking_id` int(11) NOT NULL,
  `master_sub_parking_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `from_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `to_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `final_amount` float NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_inventory`
--

INSERT INTO `master_inventory` (`id`, `ref_no`, `master_parking_id`, `master_sub_parking_id`, `user_id`, `from_date`, `to_date`, `final_amount`, `status`) VALUES
(1, 'BB_1001', 1, 2, 1, '2021-10-30 16:09:20', '2021-10-29 18:30:00', 100, '1'),
(2, 'BB_1002', 1, 2, 1, '2021-10-30 16:09:26', '2021-10-29 18:30:00', 100, '0'),
(3, 'BB_1003', 1, 2, 1, '2021-10-30 16:09:31', '2021-10-29 18:30:00', 100, '0');

-- --------------------------------------------------------

--
-- Table structure for table `master_parking`
--

CREATE TABLE `master_parking` (
  `id` int(11) NOT NULL,
  `location_name` varchar(100) NOT NULL,
  `no_of_slots` int(11) NOT NULL,
  `location_address` text NOT NULL,
  `mobile_no` int(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `amount` float NOT NULL,
  `status` enum('0','1') NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_parking`
--

INSERT INTO `master_parking` (`id`, `location_name`, `no_of_slots`, `location_address`, `mobile_no`, `email`, `amount`, `status`, `updated_at`) VALUES
(1, 'Freedom Parking', 100, 'Freedom parking, vizag', 111111111, 'test@test.com', 1000, '1', '2021-10-30 12:05:43'),
(3, 'Freedom Parking', 100, 'Bangalore\r\nBangalore', 1111111111, 'jeeva@gmail.com', 100, '1', '2021-10-31 03:05:53'),
(4, 'tctx', 50, 'Vizag', 1111111111, 'jeeva@gmail.com', 50, '0', '2021-10-31 03:06:08');

-- --------------------------------------------------------

--
-- Table structure for table `master_parking_sub_location`
--

CREATE TABLE `master_parking_sub_location` (
  `id` int(11) NOT NULL,
  `master_parking_id` int(11) NOT NULL,
  `master_table_id` int(11) NOT NULL,
  `distance` float NOT NULL,
  `status` enum('0','1') NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_parking_sub_location`
--

INSERT INTO `master_parking_sub_location` (`id`, `master_parking_id`, `master_table_id`, `distance`, `status`, `updated_at`) VALUES
(1, 2, 4, 1, '1', '2021-10-30 15:53:54'),
(2, 2, 5, 0.2, '1', '2021-10-30 15:54:04'),
(3, 4, 6, 1, '1', '2021-10-31 06:37:39');

-- --------------------------------------------------------

--
-- Table structure for table `master_table`
--

CREATE TABLE `master_table` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `city_name` varchar(35) NOT NULL,
  `location_name` varchar(45) NOT NULL,
  `location_type` enum('Railway','Airport','Public','Private') NOT NULL,
  `status` enum('0','1') NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_table`
--

INSERT INTO `master_table` (`id`, `city_id`, `city_name`, `location_name`, `location_type`, `status`, `updated_at`) VALUES
(1, 1, 'Vizag', 'city center', 'Private', '1', '2021-10-30 12:05:00'),
(5, 1, 'Vizag', 'city center', 'Railway', '1', '2021-10-30 09:48:54'),
(6, 1, 'Vizag', 'Shopping Mall', 'Private', '1', '2021-10-31 02:05:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(60) NOT NULL,
  `lastname` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `mobileno` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `usertype` enum('1','2') NOT NULL,
  `status` enum('0','1') NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_dob` date NOT NULL,
  `address` text NOT NULL,
  `car_reg` varchar(60) NOT NULL,
  `car_color` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `mobileno`, `password`, `usertype`, `status`, `updated_time`, `user_dob`, `address`, `car_reg`, `car_color`) VALUES
(1, 'test', 'user', 'test@test.com', '9999999999', '123456', '2', '1', '2021-10-30 08:39:50', '0000-00-00', '', '', ''),
(2, 'anusha', 's', 'anusha@gmail.com', '9999999999', '123456', '1', '1', '2021-10-31 02:23:12', '0000-00-00', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_inventory`
--
ALTER TABLE `master_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_parking`
--
ALTER TABLE `master_parking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_parking_sub_location`
--
ALTER TABLE `master_parking_sub_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_table`
--
ALTER TABLE `master_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_inventory`
--
ALTER TABLE `master_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_parking`
--
ALTER TABLE `master_parking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_parking_sub_location`
--
ALTER TABLE `master_parking_sub_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `master_table`
--
ALTER TABLE `master_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
