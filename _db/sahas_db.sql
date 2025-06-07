-- Adminer 4.8.1 MySQL 9.2.0 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `room_id` int NOT NULL,
  `room_title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `check_in` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `check_out` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `book` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `bookings` (`id`, `room_id`, `room_title`, `check_in`, `check_out`, `name`, `phone`, `email`, `message`, `book`, `created_at`) VALUES
(1,	3,	'Super Comfort',	'2025-04-07',	'2025-04-08',	'SMS',	'9849482482',	'swarna@longtail.info',	'booking',	'true',	'2025-04-04 18:46:35'),
(2,	3,	'Super Comfort',	'2025-04-07',	'2025-04-08',	'SMS',	'9849482482',	'swarna@longtail.info',	'booking',	'true',	'2025-04-04 18:48:41'),
(3,	3,	'Super Comfort',	'2025-04-07',	'2025-04-08',	'SMS',	'9849482482',	'swarna@longtail.info',	'booking',	'true',	'2025-04-04 18:49:00'),
(4,	2,	'Family',	'2025-04-15',	'2025-04-16',	'SMS',	'9849482482',	'swarna@longtail.info',	'wesdf',	'true',	'2025-04-04 18:51:35'),
(5,	3,	'Super Comfort',	'2025-04-14',	'2025-04-15',	'Evengila Shakya Tuladhar',	'9818514326',	'7evanzelina@gmail.com',	'this is test booking',	'true',	'2025-04-05 08:26:47'),
(6,	3,	'Super Comfort',	'2025-04-07',	'2025-04-08',	'Evengila Tuladhar',	'9818514326',	'7evanzelina@gmail.com',	'sfgd',	'true',	'2025-04-05 09:53:16'),
(7,	3,	'Super Comfort',	'2025-04-09',	'2025-04-10',	'Eve',	'9818514326',	'7evanzelina@gmail.com',	'cds',	'true',	'2025-04-06 19:11:22'),
(8,	3,	'Super Comfort',	'2025-04-17',	'2025-04-18',	'Evengila Tuladhar',	'9818514326',	'7evanzelina@gmail.com',	'Eve',	'true',	'2025-04-06 20:19:25'),
(9,	3,	'Super Comfort',	'2025-04-15',	'2025-04-16',	'Evengila Tuladhar',	'9818514326',	'7evanzelina@gmail.com',	'eve',	'true',	'2025-04-06 21:25:15'),
(10,	3,	'Super Comfort',	'2025-04-08',	'2025-04-09',	'Evengila Tuladhar',	'9818514326',	'7evanzelina@gmail.com',	'Test',	'true',	'2025-04-07 02:55:45'),
(11,	3,	'Super Comfort',	'2025-04-08',	'2025-04-09',	'Eve',	'9818514326',	'7evanzelina@gmail.com',	'Prep',	'true',	'2025-04-07 04:13:41'),
(12,	3,	'Super Comfort',	'2025-04-08',	'2025-04-09',	'Eve',	'9818514326',	'7evanzelina@gmail.com',	'test',	'true',	'2025-04-07 05:49:46'),
(13,	3,	'Super Comfort',	'2025-05-26',	'2025-05-27',	'Even',	'9818514326',	'7evanzelina@gmail.com',	'mail issue',	'true',	'2025-05-26 03:24:08'),
(14,	1,	'Duplex',	'2025-06-03',	'2025-06-04',	'sahas shakya',	'6019521325',	'statshakya@gmail.com',	'cvbnm,',	'true',	'2025-06-03 11:37:04'),
(15,	1,	'Duplex',	'2025-06-03',	'2025-06-04',	'sahas shakya',	'6019521325',	'statshakya@gmail.com',	'asdasdasd',	'true',	'2025-06-03 11:58:39'),
(16,	1,	'Duplex',	'2025-06-04',	'2025-06-05',	'sahas shakya',	'6019521325',	'statshakya@gmail.com',	'asdasd',	'true',	'2025-06-03 12:00:01'),
(17,	1,	'Duplex',	'2025-06-04',	'2025-06-06',	'sahas shakya',	'6019521325',	'statshakya@gmail.com',	'asdasd',	'true',	'2025-06-03 12:00:19'),
(18,	1,	'Duplex',	'2025-06-04',	'2025-06-05',	'sahas shakya',	'5553428400',	'statshakya@gmail.com',	'asdasd',	'true',	'2025-06-03 12:05:01'),
(19,	1,	'Duplex',	'2025-06-03',	'2025-06-04',	'sahas shakya',	'6019521325',	'statshakya@gmail.com',	'xxzszdas',	'true',	'2025-06-03 12:05:51'),
(20,	1,	'Duplex',	'2025-06-03',	'2025-06-04',	'sahas shakya',	'9861369900',	'statshakya@gmail.com',	'asdasd',	'true',	'2025-06-03 12:09:58'),
(21,	1,	'Duplex',	'2025-06-03',	'2025-06-04',	'sahas shakya',	'5553428400',	'statshakya@gmail.com',	'asdasd',	'true',	'2025-06-03 12:19:43'),
(22,	1,	'Duplex',	'2025-06-03',	'2025-06-04',	'sahas shakya',	'6019521325',	'statshakya@gmail.com',	'dsfa',	'true',	'2025-06-03 12:30:58'),
(23,	1,	'Duplex',	'2025-06-05',	'2025-06-06',	'sahas shakya',	'6019521325',	'statshakya@gmail.com',	'asdasdasd',	'true',	'2025-06-03 12:33:24');

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE `rooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `room_qnty` int NOT NULL,
  `available` int NOT NULL,
  `booked` int NOT NULL DEFAULT '0',
  `beds` int NOT NULL,
  `bed_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `content` text COLLATE utf8mb4_general_ci NOT NULL,
  `currency` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `price` float NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `updated_at` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `rooms` (`id`, `title`, `room_qnty`, `available`, `booked`, `beds`, `bed_type`, `content`, `currency`, `price`, `image`, `created_at`, `updated_at`) VALUES
(1,	'Duplex',	2,	2,	0,	2,	'single',	'very cozy room comes with AC, TV, Wifi',	'NPR',	1500,	'room1.jpg',	'',	''),
(2,	'Family',	5,	5,	0,	5,	'double',	'very nice room comes with Sofa, TV, WIFI, Balcony, AC.',	'NPR',	3500,	'room2.jpg',	'',	''),
(3,	'Super Comfort',	10,	10,	0,	2,	'double',	'very comfortable room comes with AC, TV, WIFI, room service',	'NPR',	2200,	'room3.jpg',	'',	'');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `pass_word` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `name`, `email`, `user_name`, `pass_word`, `created_at`, `updated_at`) VALUES
(1,	'Samikshya Shrestha',	'samikshya@gmail.com',	'samikshya',	'shrestha',	'2025-04-05 00:00:00',	'2025-04-05 00:00:00'),
(2,	'sahas',	'statshakya@gmail.com',	'sas',	'a8a64cef262a04de4872b68b63ab7cd8',	'2025-06-07 16:06:44',	'2025-06-07 16:06:44');

-- 2025-06-07 14:12:50