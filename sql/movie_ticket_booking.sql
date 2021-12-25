-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 25, 2021 at 12:58 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_ticket_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`) VALUES
(1, 'zeeshanawan1998@gmail.com', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `cinemas`
--

CREATE TABLE `cinemas` (
  `id` int(11) NOT NULL,
  `name` text,
  `city` text,
  `address` text,
  `seats` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cinemas`
--

INSERT INTO `cinemas` (`id`, `name`, `city`, `address`, `seats`) VALUES
(8, 'cineplex', 'chakwal', 'tehseel talagang dist.chakwal', 60);

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `id` int(11) NOT NULL,
  `row` char(1) NOT NULL,
  `number` int(11) NOT NULL,
  `cinema_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`id`, `row`, `number`, `cinema_id`) VALUES
(1, 'A', 1, 8),
(2, 'A', 2, 8),
(3, 'A', 3, 8),
(4, 'A', 4, 8),
(5, 'A', 5, 8),
(6, 'A', 6, 8),
(7, 'A', 7, 8),
(8, 'A', 8, 8),
(9, 'A', 9, 8),
(10, 'A', 10, 8),
(11, 'B', 11, 8),
(12, 'B', 12, 8),
(13, 'B', 13, 8),
(14, 'B', 14, 8),
(15, 'B', 15, 8),
(16, 'B', 16, 8),
(17, 'B', 17, 8),
(18, 'B', 18, 8),
(19, 'B', 19, 8),
(20, 'B', 20, 8),
(21, 'C', 21, 8),
(22, 'C', 22, 8),
(23, 'C', 23, 8),
(24, 'C', 24, 8),
(25, 'C', 25, 8),
(26, 'C', 26, 8),
(27, 'C', 27, 8),
(28, 'C', 28, 8),
(29, 'C', 29, 8),
(30, 'C', 30, 8),
(31, 'D', 31, 8),
(32, 'D', 32, 8),
(33, 'D', 33, 8),
(34, 'D', 34, 8),
(35, 'D', 35, 8),
(36, 'D', 36, 8),
(37, 'D', 37, 8),
(38, 'D', 38, 8),
(39, 'D', 39, 8),
(40, 'D', 40, 8),
(41, 'E', 41, 8),
(42, 'E', 42, 8),
(43, 'E', 43, 8),
(44, 'E', 44, 8),
(45, 'E', 45, 8),
(46, 'E', 46, 8),
(47, 'E', 47, 8),
(48, 'E', 48, 8),
(49, 'E', 49, 8),
(50, 'E', 50, 8),
(51, 'F', 51, 8),
(52, 'F', 52, 8),
(53, 'F', 53, 8),
(54, 'F', 54, 8),
(55, 'F', 55, 8),
(56, 'F', 56, 8),
(57, 'F', 57, 8),
(58, 'F', 58, 8),
(59, 'F', 59, 8),
(60, 'F', 60, 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cinemas`
--
ALTER TABLE `cinemas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seats_cinema_id` (`cinema_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cinemas`
--
ALTER TABLE `cinemas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_cinema_id` FOREIGN KEY (`cinema_id`) REFERENCES `cinemas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
