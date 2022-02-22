-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 22, 2022 at 01:31 PM
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
  `name` text,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`) VALUES
(1, 'zeeshan', 'zeeshanawan1998@gmail.com', '12345678');

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
(8, 'Cineplex', 'Chakwal', 'Tehseel Talagang dist. Chakwal', 60),
(9, 'Silver screen', 'Rawalpindi', 'Punjab, Pakistan', 60),
(10, 'cinestar', 'lahore', 'fovara chowk lahore', 80);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `genre` text NOT NULL,
  `imdb_ratings` float NOT NULL DEFAULT '0',
  `is_upcoming` tinyint(1) NOT NULL DEFAULT '0',
  `release_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `name`, `image`, `genre`, `imdb_ratings`, `is_upcoming`, `release_date`) VALUES
(4, 'No time to die', 'No-time-to-die1644684286.jpg', 'Action, Adventure', 9.5, 1, '2022-02-16'),
(6, 'Red Notice', 'Red-notice1644834373.jpg', 'Action, Adventure, Thriller', 6.8, 0, '2022-02-08');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `cinema_id` int(11) NOT NULL,
  `play_slot` timestamp NOT NULL,
  `seat_id` int(11) NOT NULL,
  `seat_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `cinema_id` int(11) NOT NULL,
  `play_slot1` timestamp NOT NULL,
  `play_slot2` timestamp NOT NULL,
  `play_slot3` timestamp NOT NULL,
  `play_slot4` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `movie_id`, `cinema_id`, `play_slot1`, `play_slot2`, `play_slot3`, `play_slot4`) VALUES
(5, 6, 8, '2022-02-19 10:54:00', '2022-02-23 10:54:00', '2022-02-28 10:54:00', '2022-02-15 10:54:00');

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
(1, 'A', 1, 10),
(2, 'A', 2, 10),
(3, 'A', 3, 10),
(4, 'A', 4, 10),
(5, 'A', 5, 10),
(6, 'A', 6, 10),
(7, 'A', 7, 10),
(8, 'A', 8, 10),
(9, 'A', 9, 10),
(10, 'A', 10, 10),
(11, 'B', 1, 10),
(12, 'B', 2, 10),
(13, 'B', 3, 10),
(14, 'B', 4, 10),
(15, 'B', 5, 10),
(16, 'B', 6, 10),
(17, 'B', 7, 10),
(18, 'B', 8, 10),
(19, 'B', 9, 10),
(20, 'B', 10, 10),
(21, 'C', 1, 10),
(22, 'C', 2, 10),
(23, 'C', 3, 10),
(24, 'C', 4, 10),
(25, 'C', 5, 10),
(26, 'C', 6, 10),
(27, 'C', 7, 10),
(28, 'C', 8, 10),
(29, 'C', 9, 10),
(30, 'C', 10, 10),
(31, 'D', 1, 10),
(32, 'D', 2, 10),
(33, 'D', 3, 10),
(34, 'D', 4, 10),
(35, 'D', 5, 10),
(36, 'D', 6, 10),
(37, 'D', 7, 10),
(38, 'D', 8, 10),
(39, 'D', 9, 10),
(40, 'D', 10, 10),
(41, 'E', 1, 10),
(42, 'E', 2, 10),
(43, 'E', 3, 10),
(44, 'E', 4, 10),
(45, 'E', 5, 10),
(46, 'E', 6, 10),
(47, 'E', 7, 10),
(48, 'E', 8, 10),
(49, 'E', 9, 10),
(50, 'E', 10, 10),
(51, 'F', 1, 10),
(52, 'F', 2, 10),
(53, 'F', 3, 10),
(54, 'F', 4, 10),
(55, 'F', 5, 10),
(56, 'F', 6, 10),
(57, 'F', 7, 10),
(58, 'F', 8, 10),
(59, 'F', 9, 10),
(60, 'F', 10, 10),
(61, 'G', 1, 10),
(62, 'G', 2, 10),
(63, 'G', 3, 10),
(64, 'G', 4, 10),
(65, 'G', 5, 10),
(66, 'G', 6, 10),
(67, 'G', 7, 10),
(68, 'G', 8, 10),
(69, 'G', 9, 10),
(70, 'G', 10, 10),
(71, 'H', 1, 10),
(72, 'H', 2, 10),
(73, 'H', 3, 10),
(74, 'H', 4, 10),
(75, 'H', 5, 10),
(76, 'H', 6, 10),
(77, 'H', 7, 10),
(78, 'H', 8, 10),
(79, 'H', 9, 10),
(80, 'H', 10, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` text,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_approved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `age`, `gender`, `address`, `phone_number`, `password`, `is_approved`) VALUES
(2, 'muhammad Shani', 'sikanderawan1998@gmail.com', 0, '0', '', '0', '12345678', 1),
(3, 'MUHAMMAD ZEESHAN', 'zeeshanawan1998@gmail.com', 23, 'male', 'ward no. 8 muhalla madina town near haidri masjid tehseel talagang district chakwal', '+92-348-5420607', '12345678', 0);

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
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cinema_cinema_id` (`cinema_id`),
  ADD KEY `reservation_movie_id_movies` (`movie_id`),
  ADD KEY `user_user_id` (`user_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movies_movie_id` (`movie_id`),
  ADD KEY `cinemas_cinema_id` (`cinema_id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seats_cinema_id` (`cinema_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `cinema_cinema_id` FOREIGN KEY (`cinema_id`) REFERENCES `cinemas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_movie_id_movies` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `cinemas_cinema_id` FOREIGN KEY (`cinema_id`) REFERENCES `cinemas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `movies_movie_id` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `seats`
--
ALTER TABLE `seats`
  ADD CONSTRAINT `seats_cinema_id` FOREIGN KEY (`cinema_id`) REFERENCES `cinemas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
