-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2025 at 10:36 AM
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
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `room_title` varchar(255) NOT NULL,
  `check_in` varchar(255) NOT NULL,
  `check_out` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `book` text NOT NULL,
  `created_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `room_id`, `room_title`, `check_in`, `check_out`, `name`, `phone`, `email`, `message`, `book`, `created_at`) VALUES
(1, 3, 'Super Comfort', '2025-04-07', '2025-04-08', 'SMS', '9849482482', 'swarna@longtail.info', 'booking', 'true', '2025-04-04 18:46:35'),
(2, 3, 'Super Comfort', '2025-04-07', '2025-04-08', 'SMS', '9849482482', 'swarna@longtail.info', 'booking', 'true', '2025-04-04 18:48:41'),
(3, 3, 'Super Comfort', '2025-04-07', '2025-04-08', 'SMS', '9849482482', 'swarna@longtail.info', 'booking', 'true', '2025-04-04 18:49:00'),
(4, 2, 'Family', '2025-04-15', '2025-04-16', 'SMS', '9849482482', 'swarna@longtail.info', 'wesdf', 'true', '2025-04-04 18:51:35'),
(5, 3, 'Super Comfort', '2025-04-14', '2025-04-15', 'Evengila Shakya Tuladhar', '9818514326', '7evanzelina@gmail.com', 'this is test booking', 'true', '2025-04-05 08:26:47'),
(6, 3, 'Super Comfort', '2025-04-07', '2025-04-08', 'Evengila Tuladhar', '9818514326', '7evanzelina@gmail.com', 'sfgd', 'true', '2025-04-05 09:53:16'),
(7, 3, 'Super Comfort', '2025-04-09', '2025-04-10', 'Eve', '9818514326', '7evanzelina@gmail.com', 'cds', 'true', '2025-04-06 19:11:22'),
(8, 3, 'Super Comfort', '2025-04-17', '2025-04-18', 'Evengila Tuladhar', '9818514326', '7evanzelina@gmail.com', 'Eve', 'true', '2025-04-06 20:19:25'),
(9, 3, 'Super Comfort', '2025-04-15', '2025-04-16', 'Evengila Tuladhar', '9818514326', '7evanzelina@gmail.com', 'eve', 'true', '2025-04-06 21:25:15'),
(10, 3, 'Super Comfort', '2025-04-08', '2025-04-09', 'Evengila Tuladhar', '9818514326', '7evanzelina@gmail.com', 'Test', 'true', '2025-04-07 02:55:45'),
(11, 3, 'Super Comfort', '2025-04-08', '2025-04-09', 'Eve', '9818514326', '7evanzelina@gmail.com', 'Prep', 'true', '2025-04-07 04:13:41'),
(12, 3, 'Super Comfort', '2025-04-08', '2025-04-09', 'Eve', '9818514326', '7evanzelina@gmail.com', 'test', 'true', '2025-04-07 05:49:46'),
(13, 3, 'Super Comfort', '2025-05-26', '2025-05-27', 'Even', '9818514326', '7evanzelina@gmail.com', 'mail issue', 'true', '2025-05-26 03:24:08');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `room_qnty` int(11) NOT NULL,
  `available` int(11) NOT NULL,
  `booked` int(11) NOT NULL DEFAULT 0,
  `beds` int(11) NOT NULL,
  `bed_type` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `currency` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `title`, `room_qnty`, `available`, `booked`, `beds`, `bed_type`, `content`, `currency`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Duplex', 5, 5, 0, 2, 'single', 'very cozy room comes with AC, TV, Wifi', 'NPR', 1500, 'room1.jpg', '', ''),
(2, 'Family', 5, 5, 0, 5, 'double', 'very nice room comes with Sofa, TV, WIFI, Balcony, AC.', 'NPR', 3500, 'room2.jpg', '', ''),
(3, 'Super Comfort', 10, 10, 0, 2, 'double', 'very comfortable room comes with AC, TV, WIFI, room service', 'NPR', 2200, 'room3.jpg', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `pass_word` varchar(255) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_name`, `pass_word`, `created_at`, `updated_at`) VALUES
(1, 'Samikshya Shrestha', 'samikshya@gmail.com', 'samikshya', 'shrestha', '2025-04-05', '2025-04-05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
