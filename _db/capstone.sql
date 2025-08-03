-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2025 at 10:37 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `room_qnty` int(11) NOT NULL,
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

INSERT INTO `rooms` (`id`, `title`, `room_qnty`, `beds`, `bed_type`, `content`, `currency`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Duplex Room', 2, 2, 'Single', 'Cozy duplex room with AC, TV, WiFi, and two single beds — perfect for a relaxed and comfortable stay.', 'NPR', 1500, '688f08eac91b7_duplex.JPG', '', '2025-08-03 09:05:56'),
(2, 'Family Room', 5, 5, 'Double', 'Your family’s space: sofa seating, TV entertainment, reliable WiFi, cooling AC, and a balcony to step out and breathe.', 'NPR', 3500, '688f077caaf6e_image3.JPG', '', '2025-08-03 09:05:43'),
(3, 'Premier Room', 10, 2, 'Double', 'A very comfortable room featuring air conditioning, TV, free WiFi, and room service — everything you need for a relaxed and hassle-free stay.', 'NPR', 2200, '688f0a29674af_premier.JPG', '', '2025-08-03 09:05:13');

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
(1, 'Samikshya Shrestha', 'samikshya@gmail.com', 'Samikshya', '5f4dcc3b5aa765d61d8327deb882cf99', '2025-04-05', '2025-04-05'),
(2, 'Evengila Tuladhar', 'evengila@gmail.com', 'Evengila', '5f4dcc3b5aa765d61d8327deb882cf99', '2025-04-05', '2025-04-05'),
(3, 'Arbin Shrestha', 'arbin@gmail.com', 'Arbin', '5f4dcc3b5aa765d61d8327deb882cf99', '2025-04-05', '2025-04-05'),
(4, 'Yabesh Lama', 'yabesh@gmail.com', 'Yabesh', '5f4dcc3b5aa765d61d8327deb882cf99', '2025-04-05', '2025-04-05');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
