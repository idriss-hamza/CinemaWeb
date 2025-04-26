-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 04:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `rating` varchar(10) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `director` varchar(20) NOT NULL,
  `cast` varchar(100) NOT NULL,
  `dates` varchar(300) NOT NULL,
  `times` varchar(200) NOT NULL,
  `theater` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `description`, `image_url`, `duration`, `rating`, `genre`, `director`, `cast`, `dates`, `times`, `theater`) VALUES
(1, 'Interstellar', 'When Earth becomes uninhabitable in the future, a farmer and ex-NASA pilot, Joseph Cooper, is tasked to pilot a spacecraft, along with a team of researchers, to find a new planet for humans.', 'https://m.media-amazon.com/images/M/MV5BZjdkOTU3MDktN2IxOS00OGEyLWFmMjktY2FiMmZkNWIyODZiXkEyXkFqcGdeQXVyMTMxODk2OTU@._V1_.jpg', 169, '8.7', 'Sci-Fi, Adventure, Drama', 'Christopher Nolan', 'Matthew McConaughey, Anne Hathaway, Jessica Chastain, Bill Irwin', 'Mon7April,Tue8April,Wed9April,Thu10April,Fri11April,Sat12April,Sun13April', '10:30 AM,1:00 PM,3:30 PM,6:00 PM,8:30 PM,11:00 PM', 2),
(2, 'The Dark Knight', 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.', 'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_.jpg', 152, '9.0', 'Action, Crime, Drama', 'Christopher Nolan', 'Christian Bale, Heath Ledger, Aaron Eckhart, Michael Caine', 'Mon7April,Tue8April,Wed9April,Thu10April,Fri11April,Sat12April,Sun13April', '10:30 AM,1:00 PM,3:30 PM,6:00 PM,8:30 PM,11:00 PM', 3),
(3, 'Sahbek Rajel', 'Two cops - one reckless, one family-oriented and honest - become partners, leading to action-packed and comedic situations.', 'https://m.media-amazon.com/images/M/MV5BNjZhNTM2YWMtZWFiMy00YmFkLTg3N2UtMGNlNzhlNmY5NWY1XkEyXkFqcGc@._V1_QL75_UX1212_.jpg', 154, '8.9', 'Drama, Comedy, Action', 'Kais Chekir', 'Yassine Ben Gamra, Dorra Zarrouk, Karim Al Gharbi', 'Mon7April,Tue8April,Wed9April,Thu10April,Fri11April,Sat12April,Sun13April', '10:30 AM,1:00 PM,3:30 PM,6:00 PM,8:30 PM,11:00 PM', 5),
(4, 'Oppenheimer', 'A dramatization of the life story of J. Robert Oppenheimer, the physicist who had a large hand in the development of the atomic bombs that brought an end to World War II.', 'https://m.media-amazon.com/images/M/MV5BYjhjN2E2Y2YtYjA5Mi00ODZiLTgzZmUtMmVlNTc5Zjk1MDYwXkEyXkFqcGc@._V1_QL75_UX204_.jpg', 142, '8.8', 'Drama, Romance', 'Christopher Nolan', 'Cillian Murphy, Emily Blunt', 'Mon7April,Tue8April,Wed9April,Thu10April,Fri11April,Sat12April,Sun13April', '10:30 AM,1:00 PM,3:30 PM,6:00 PM,8:30 PM,11:00 PM', 3),
(5, 'The Matrix', 'A computer hacker learns from mysterious rebels about the true nature of his reality and his role in the war against its controllers.', 'https://m.media-amazon.com/images/M/MV5BNzQzOTk3OTAtNDQ0Zi00ZTVkLWI0MTEtMDllZjNkYzNjNTc4L2ltYWdlXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_.jpg', 136, '8.7', 'Action, Sci-Fi', 'Lana Wachowski', 'Keanu Reeves, Laurence Fishburne, Carrie-Anne Moss, Hugo Weaving', 'Mon7April,Tue8April,Wed9April,Thu10April,Fri11April,Sat12April,Sun13April', '10:30 AM,1:00 PM,3:30 PM,6:00 PM,8:30 PM,11:00 PM', 8),
(6, 'The Godfather', 'The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.', 'https://m.media-amazon.com/images/M/MV5BMWMwMGQzZTItY2JlNC00OWZiLWIyMDctNDk2ZDQ2YjRjMWQ0XkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_.jpg', 175, '9.2', 'Crime, Drama', 'Francis Ford Coppola', 'Marlon Brando, Al Pacino, James Caan, Diane Keaton', 'Mon7April,Tue8April,Wed9April,Thu10April,Fri11April,Sat12April,Sun13April', '10:30 AM,1:00 PM,3:30 PM,6:00 PM,8:30 PM,11:00 PM', 7);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `time` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL,
  `seat_number` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `movie_id`, `time`, `date`, `seat_number`, `user_id`, `created_at`) VALUES
(1, 1, '10:30 AM', 'Mon7April', 'D6,D5,E5,E6', 1, '2025-04-26 11:37:31'),
(2, 1, '10:30 AM', 'Mon7April', 'G6,G7,H6,H7', 1, '2025-04-26 14:15:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `phone`, `created_at`) VALUES
(1, 'idrisshamza4', 'idrisshamza44@gmail.com', '$2y$10$QXEoMoojgeIMxinviSsgUe9iD/uvKYbShyZ8bVYz9wvGChqyrefxe', '99777207', '2025-04-22 16:40:52');

--
-- Indexes for dumped tables
--

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
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`),
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
