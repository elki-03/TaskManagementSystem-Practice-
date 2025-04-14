-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2025 at 11:28 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task` text NOT NULL,
  `completed` tinyint(1) DEFAULT 0,
  `pending` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `user_id`, `task`, `completed`, `pending`) VALUES
(8, 1, 'Washing Dishes', 1, 0),
(9, 1, 'Garbage', 0, 1),
(10, 1, 'Cat toilet', 0, 1),
(11, 1, 'Filter system', 1, 0),
(12, 1, 'Filter Dropdown', 0, 1),
(13, 1, 'Roles', 0, 1),
(14, 1, 'Grocery', 0, 1),
(15, 1, 'Test', 1, 0),
(16, 1, 'Möhren kaufen', 0, 1),
(17, 2, 'Cleanup Code', 0, 1),
(18, 2, 'Roles', 0, 1),
(19, 2, 'Learn Dropdown-Filter', 0, 1),
(20, 2, 'Rhabarberkuchen', 0, 1),
(21, 3, 'ajfkhkdfh', 1, 0),
(22, 3, 'Comic', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `password` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `password`, `username`) VALUES
(1, '$2y$10$tElotFiX.0ZiwSn16J5f0uFhc6QP4HWs6oR3hbQAG1SnEDtBNIZW6', 'Katze'),
(2, '$2y$10$rzAuJHSppZPKgwnBmgqQP.eq9elPtG338ohmqKwpImHJRhxNNYGzq', 'Test'),
(3, '$2y$10$CL1aDij/ja2ApVFXmTlz.OCsFDFZueoEuOswSe7bP./Mxa/iURINO', 'rubberduck');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
