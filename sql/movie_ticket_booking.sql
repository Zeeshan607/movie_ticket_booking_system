-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2023 at 06:30 PM
-- Server version: 5.7.24
-- PHP Version: 8.2.2

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
(1, 'Admin', 'admin786@gmail.com', '12345678');

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
(10, 'cinestar', 'lahore', 'fovara chowk lahore', 80),
(11, 'Cineplex', 'Chakwal', 'tehseel talagang dist.chakwal', 70),
(12, '5star cinema', 'Maxico', 'st.5  block 3 4200', 40);

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
(4, 'No time to die', 'No-time-to-die1644684286.jpg', 'Action, Adventure', 7.3, 0, '2023-09-30'),
(6, 'Red Notice', 'Red-notice1644834373.jpg', 'Action, Adventure, Thriller', 6.8, 0, '2022-02-08'),
(7, 'Venom', 'venom1645689764.jpg', 'Action, Adventure, Thriller', 6.4, 0, '2021-10-15'),
(8, 'Expendables 4', 'Expandables-41700292365.jpg', 'Action, Adventure, Thriller', 4.8, 0, '2023-09-22'),
(9, 'The little mermaid', 'the_little-mermaid1700293333.jpg', 'Adventure, Family, Fantasy', 7.2, 0, '2023-05-26'),
(10, 'The Creator', 'The-creator1700293454.jpg', 'Action, Adventure, Drama', 7, 0, '2023-09-29'),
(11, 'The Equalizer #', 'THe-equilizer-31700295375.jpg', 'Action, Crime, Thriller', 6.9, 0, '2023-09-01'),
(12, 'A Million Miles Away', 'A_million_miles_away1700296033.jpg', 'Biography, Drama', 7.3, 0, '2023-09-15'),
(13, 'Dungeons & Dragons: Honor Among Thieves', 'dungeons_and_dragons1700296148.jpg', 'Action, Adventure, Comedy', 7.3, 0, '2023-03-31'),
(14, 'Emancipation', 'Emancipation1700296557.jpg', 'Action, Thriller ', 6.2, 0, '2022-12-02'),
(15, 'The Woman King', 'The_woman_king1700298006.jpg', 'Action, Drama, History', 6.9, 0, '2022-09-16'),
(16, 'The Kings of the World', 'the_king_of_the_world1700298742.jpg', 'Adventure, Drama', 7, 0, '2022-10-13'),
(17, 'Narvik Hitler\'s First Defeat', 'Narvik_Hitler\'s_First_Defeat1700328029.jpg', 'History, War,  Drama', 6.3, 0, '2022-12-25'),
(18, 'Top Gun: Maverick', 'top_gun_mererick1700329673.jpg', 'Action, Drama', 8.3, 0, '2022-05-27'),
(19, 'Mission: Impossible - Dead Reckoning Part One', 'mission_impossible_dead_reckoning1700329766.jpg', 'Action, Adventure, Thriller', 7.8, 0, '2023-07-12'),
(20, 'Accused', 'accused1700329878.jpg', 'Thriller', 6.4, 0, '2023-10-26'),
(21, 'From the Ashes', 'From_the_ashes1700330301.jpg', 'Crime, Drama, mystrey', 1, 1, '2023-12-01'),
(22, 'Silent Night', 'silent_night1700330472.jpg', 'Action', 1, 0, '2023-12-01'),
(23, 'The Shift', 'The_shift1700330596.jpg', 'Scifi', 9, 1, '2023-12-01'),
(24, 'Crypt of Evil', 'Crypt_of_Evil1700330735.jpg', 'Horror', 1, 1, '2023-11-30'),
(25, 'The Vengeance of Dracula', 'vengence_of_dracula1700330812.jpg', 'Horror', 1, 1, '2023-11-30'),
(26, 'Napoleon', 'Nepoleon1700377204.jpg', 'Action, Adventure, Biography', 1, 1, '2023-11-22'),
(27, 'The Oath', 'The_Oath1700377316.jpg', 'Action, Adventure, Drama', 1, 1, '2023-12-08'),
(28, 'Eileen', 'Eileen1700377443.jpg', 'Drama, MyStrey, Thriller', 6.3, 1, '2023-12-01'),
(29, 'Aquaman and the Lost Kingdom', 'The_aquaman_and_the_lost_kingdom1700377839.jpg', 'Action, Adventure,  Fantasy', 1, 1, '2023-12-22'),
(30, 'Target Number One', 'Target_Number_One1700378054.jpg', 'Action, Thriller', 1, 1, '2023-12-25'),
(31, 'The Beekeeper', 'The_Beekeeper1700378190.jpg', 'Action, Thriller', 1, 1, '2024-01-12');

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
  `payment_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `movie_id`, `cinema_id`, `play_slot`, `payment_status`, `created_at`) VALUES
(1, 3, 6, 11, '2022-02-25 07:18:00', 1, '2022-04-25 13:35:32'),
(2, 3, 6, 11, '2022-02-25 09:18:00', 1, '2022-05-02 12:06:18'),
(3, 3, 6, 11, '2022-02-25 09:18:00', 1, '2022-05-02 12:07:37'),
(4, 3, 6, 11, '2022-02-25 07:18:00', 1, '2022-05-03 11:48:56'),
(5, 3, 6, 11, '2022-02-25 09:18:00', 1, '2023-09-07 11:47:54'),
(6, 3, 6, 11, '2022-02-25 07:18:00', 1, '2023-11-20 12:25:50'),
(7, 5, 18, 11, '2023-12-07 11:00:00', 1, '2023-11-22 11:35:13');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `cinema_id` int(11) NOT NULL,
  `play_date` date NOT NULL,
  `play_slot1` time NOT NULL,
  `play_slot2` time NOT NULL,
  `play_slot3` time NOT NULL,
  `price_per_seat` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `movie_id`, `cinema_id`, `play_date`, `play_slot1`, `play_slot2`, `play_slot3`, `price_per_seat`) VALUES
(1, 6, 11, '2022-02-25', '10:18:00', '12:18:00', '14:18:00', 300),
(2, 10, 11, '2023-12-20', '10:51:00', '12:00:00', '15:00:00', 450),
(3, 18, 10, '2023-12-20', '10:00:00', '14:00:00', '16:00:00', 500),
(4, 18, 11, '2023-12-07', '09:00:00', '13:30:00', '16:00:00', 300),
(5, 18, 12, '2023-12-07', '10:00:00', '14:01:00', '17:00:00', 150);

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
(80, 'H', 10, 10),
(81, 'A', 1, 11),
(82, 'A', 2, 11),
(83, 'A', 3, 11),
(84, 'A', 4, 11),
(85, 'A', 5, 11),
(86, 'A', 6, 11),
(87, 'A', 7, 11),
(88, 'A', 8, 11),
(89, 'A', 9, 11),
(90, 'A', 10, 11),
(91, 'B', 1, 11),
(92, 'B', 2, 11),
(93, 'B', 3, 11),
(94, 'B', 4, 11),
(95, 'B', 5, 11),
(96, 'B', 6, 11),
(97, 'B', 7, 11),
(98, 'B', 8, 11),
(99, 'B', 9, 11),
(100, 'B', 10, 11),
(101, 'C', 1, 11),
(102, 'C', 2, 11),
(103, 'C', 3, 11),
(104, 'C', 4, 11),
(105, 'C', 5, 11),
(106, 'C', 6, 11),
(107, 'C', 7, 11),
(108, 'C', 8, 11),
(109, 'C', 9, 11),
(110, 'C', 10, 11),
(111, 'D', 1, 11),
(112, 'D', 2, 11),
(113, 'D', 3, 11),
(114, 'D', 4, 11),
(115, 'D', 5, 11),
(116, 'D', 6, 11),
(117, 'D', 7, 11),
(118, 'D', 8, 11),
(119, 'D', 9, 11),
(120, 'D', 10, 11),
(121, 'E', 1, 11),
(122, 'E', 2, 11),
(123, 'E', 3, 11),
(124, 'E', 4, 11),
(125, 'E', 5, 11),
(126, 'E', 6, 11),
(127, 'E', 7, 11),
(128, 'E', 8, 11),
(129, 'E', 9, 11),
(130, 'E', 10, 11),
(131, 'F', 1, 11),
(132, 'F', 2, 11),
(133, 'F', 3, 11),
(134, 'F', 4, 11),
(135, 'F', 5, 11),
(136, 'F', 6, 11),
(137, 'F', 7, 11),
(138, 'F', 8, 11),
(139, 'F', 9, 11),
(140, 'F', 10, 11),
(141, 'G', 1, 11),
(142, 'G', 2, 11),
(143, 'G', 3, 11),
(144, 'G', 4, 11),
(145, 'G', 5, 11),
(146, 'G', 6, 11),
(147, 'G', 7, 11),
(148, 'G', 8, 11),
(149, 'G', 9, 11),
(150, 'G', 10, 11),
(151, 'A', 1, 12),
(152, 'A', 2, 12),
(153, 'A', 3, 12),
(154, 'A', 4, 12),
(155, 'A', 5, 12),
(156, 'A', 6, 12),
(157, 'A', 7, 12),
(158, 'A', 8, 12),
(159, 'A', 9, 12),
(160, 'A', 10, 12),
(161, 'B', 1, 12),
(162, 'B', 2, 12),
(163, 'B', 3, 12),
(164, 'B', 4, 12),
(165, 'B', 5, 12),
(166, 'B', 6, 12),
(167, 'B', 7, 12),
(168, 'B', 8, 12),
(169, 'B', 9, 12),
(170, 'B', 10, 12),
(171, 'C', 1, 12),
(172, 'C', 2, 12),
(173, 'C', 3, 12),
(174, 'C', 4, 12),
(175, 'C', 5, 12),
(176, 'C', 6, 12),
(177, 'C', 7, 12),
(178, 'C', 8, 12),
(179, 'C', 9, 12),
(180, 'C', 10, 12),
(181, 'D', 1, 12),
(182, 'D', 2, 12),
(183, 'D', 3, 12),
(184, 'D', 4, 12),
(185, 'D', 5, 12),
(186, 'D', 6, 12),
(187, 'D', 7, 12),
(188, 'D', 8, 12),
(189, 'D', 9, 12),
(190, 'D', 10, 12);

-- --------------------------------------------------------

--
-- Table structure for table `seats_reserved`
--

CREATE TABLE `seats_reserved` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `seat_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seats_reserved`
--

INSERT INTO `seats_reserved` (`id`, `reservation_id`, `seat_id`) VALUES
(1, 1, 86),
(2, 1, 87),
(3, 1, 88),
(4, 2, 103),
(5, 2, 147),
(6, 3, 97),
(7, 3, 110),
(8, 3, 125),
(9, 4, 104),
(10, 4, 123),
(11, 4, 124),
(12, 4, 125),
(13, 5, 105),
(14, 5, 106),
(15, 5, 107),
(16, 6, 84),
(17, 6, 85),
(18, 7, 85),
(19, 7, 86);

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
(3, 'Primary_User', 'user@test.com', 23, 'male', 'i8 sector 7 islamabad pakistan', '+92-308-8523136', '12345678', 1),
(5, 'john doe', 'user@test.com', 33, 'male', 'i8 sector 7 islamabad pakistan', '+92-365-7616615', '87654321', 1);

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
-- Indexes for table `seats_reserved`
--
ALTER TABLE `seats_reserved`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservations_seat_id` (`reservation_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `seats`
--
ALTER TABLE `seats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `seats_reserved`
--
ALTER TABLE `seats_reserved`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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

--
-- Constraints for table `seats_reserved`
--
ALTER TABLE `seats_reserved`
  ADD CONSTRAINT `reservations_seat_id` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
