-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2025 at 06:14 AM
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
-- Database: `hostel_repair_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `request_id` int(11) DEFAULT NULL,
  `uid` varchar(10) NOT NULL,
  `message` text NOT NULL,
  `seen` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `occupants`
--

CREATE TABLE `occupants` (
  `id` int(11) NOT NULL,
  `uid` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `room_no` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `occupants`
--

INSERT INTO `occupants` (`id`, `uid`, `name`, `room_no`, `password`) VALUES
(12, 'U2203123', 'Hanna', '415', '$2y$10$jmmamQl/7lgZN5RaJYcw5ONoT8sJbQy4U6P76RNUk/H5C4d8ZSVd.'),
(13, 'U2203080', 'Diya ', '415', '$2y$10$2nqxZQRPvlJgiLwxtNYN..Yclakds56tG9S52KijC4eElpqrRIb6i'),
(14, 'U2203046', 'Anjali', '415', '$2y$10$BI5WTy/dzqunkwNsUwlGseUjkK8kkv1T/ZPu0Ny2oq9VUHGjlPDJG'),
(15, 'U2203042', 'Reesa', '414', '$2y$10$N9fGU.L87AEkn4XEwDLyLeyIUZkUoIonzgueyX9BAc.HYnhk6cfkK'),
(19, 'U2203026', 'Aleena P', '431', '$2y$10$a7ohuBiqEhE86WK/zDlGpuh53CnNhmzAjBlgyD0vdvCcPoHQunllu'),
(20, 'U2203049', 'Angeline', '323', '$2y$10$snE9l4CB3M0gOM5KlEyPveOxw0wIrJte//XMcXP3HPqVBdQzfrGY6');

-- --------------------------------------------------------

--
-- Table structure for table `repair_requests`
--

CREATE TABLE `repair_requests` (
  `id` int(11) NOT NULL,
  `uid` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `category` enum('general','room-specific') NOT NULL,
  `type` enum('electrician','plumber','other') NOT NULL,
  `expected_date` date DEFAULT NULL,
  `status` enum('pending','approved','declined','completed') DEFAULT 'pending',
  `confirmed_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `repair_requests`
--

INSERT INTO `repair_requests` (`id`, `uid`, `description`, `image_url`, `category`, `type`, `expected_date`, `status`, `confirmed_date`, `created_at`) VALUES
(8, 'U2203123', 'Light is not working', '', 'room-specific', 'electrician', '2024-11-16', 'completed', '2024-11-14', '2024-11-14 19:25:25'),
(11, 'U2203026', 'fan does not have speed', '', 'room-specific', 'electrician', '2024-11-17', 'pending', NULL, '2024-11-15 09:31:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uid` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','student','staff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uid`, `name`, `email`, `password`, `role`) VALUES
(31, 'U2203123', 'Hanna', NULL, '$2y$10$jmmamQl/7lgZN5RaJYcw5ONoT8sJbQy4U6P76RNUk/H5C4d8ZSVd.', 'student'),
(32, 'U2203080', 'Diya ', NULL, '$2y$10$2nqxZQRPvlJgiLwxtNYN..Yclakds56tG9S52KijC4eElpqrRIb6i', 'student'),
(33, 'U2203046', 'Anjali', NULL, '$2y$10$BI5WTy/dzqunkwNsUwlGseUjkK8kkv1T/ZPu0Ny2oq9VUHGjlPDJG', 'student'),
(34, 'U2203042', 'Reesa', NULL, '$2y$10$N9fGU.L87AEkn4XEwDLyLeyIUZkUoIonzgueyX9BAc.HYnhk6cfkK', 'student'),
(50, 'S2203050', 'Ann Maria', NULL, '$2y$10$gRzM1j2JMOIN2w7dm4sjZOHDdyRf7Mo8uQ0ltA9G/aqevGLplGzg.', 'staff'),
(51, 'A2203034', 'Aparna', NULL, '$2y$10$l8UBMTQOsK27w.t63v6wzeWioPS.KKwE8quKJ/H6H9KM3QFotARFu', 'admin'),
(52, 'S2204056', 'Arushi', NULL, '$2y$10$ZlB.rmJcA0CBa2qxn1pcJeWJQGYUteBiYBtdINhusH9850pl7pTbG', 'staff'),
(53, 'U2203026', 'Aleena P', NULL, '$2y$10$a7ohuBiqEhE86WK/zDlGpuh53CnNhmzAjBlgyD0vdvCcPoHQunllu', 'student'),
(56, 'U2203049', 'Angeline', NULL, '$2y$10$snE9l4CB3M0gOM5KlEyPveOxw0wIrJte//XMcXP3HPqVBdQzfrGY6', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `occupants`
--
ALTER TABLE `occupants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `repair_requests`
--
ALTER TABLE `repair_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`),
  ADD UNIQUE KEY `uid_2` (`uid`),
  ADD UNIQUE KEY `uid_3` (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `occupants`
--
ALTER TABLE `occupants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `repair_requests`
--
ALTER TABLE `repair_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `repair_requests` (`id`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

--
-- Constraints for table `occupants`
--
ALTER TABLE `occupants`
  ADD CONSTRAINT `occupants_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`) ON DELETE CASCADE;

--
-- Constraints for table `repair_requests`
--
ALTER TABLE `repair_requests`
  ADD CONSTRAINT `repair_requests_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
