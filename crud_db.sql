-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2021 at 04:56 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crud_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products_200`
--

CREATE TABLE `products_200` (
  `id_200` int(11) NOT NULL,
  `name_200` varchar(255) DEFAULT NULL,
  `price_200` varchar(20) NOT NULL DEFAULT '0',
  `description_200` text DEFAULT NULL,
  `add_by_user_id_100_200` int(11) NOT NULL DEFAULT 0,
  `active_yn_200` varchar(5) NOT NULL DEFAULT '0',
  `ipaddress_200` varchar(255) DEFAULT NULL,
  `source_200` varchar(255) NOT NULL DEFAULT 'manual',
  `created_at_200` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at_200` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_100`
--

CREATE TABLE `user_100` (
  `id_100` int(11) NOT NULL,
  `first_name_100` varchar(255) DEFAULT NULL,
  `last_name_100` varchar(255) DEFAULT NULL,
  `full_name_100` varchar(255) DEFAULT NULL,
  `email_id_100` varchar(255) DEFAULT NULL,
  `phone_no_100` varchar(255) DEFAULT NULL,
  `password_100` varchar(255) DEFAULT NULL,
  `active_yn_100` varchar(5) NOT NULL DEFAULT '0',
  `created_on_100` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_on_100` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products_200`
--
ALTER TABLE `products_200`
  ADD PRIMARY KEY (`id_200`);

--
-- Indexes for table `user_100`
--
ALTER TABLE `user_100`
  ADD PRIMARY KEY (`id_100`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products_200`
--
ALTER TABLE `products_200`
  MODIFY `id_200` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_100`
--
ALTER TABLE `user_100`
  MODIFY `id_100` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
