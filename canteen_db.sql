-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2026 at 03:06 PM
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
-- Database: `canteen_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `full_name`, `email`, `username`, `password`) VALUES
(1, 'rye', 'rsgfg@gmail.com', 'binod', '$2y$10$XaKp4l0xCfHvkgrJD3HhJ.XEg1tRiPgRqerlbK21k6NKKWIxn2RK2'),
(2, 'dsgf', 'boom@bhgf.gfhgf', 'boom', '$2y$10$V.eC8SoQxQyJST1wd1ynb.BlPv.Dde0/75eFcHCE9vD4UiqVjtr5q'),
(3, 'fgh', 'dsfgh@gmail.com', 'abc', '$2y$10$DMLQfkn42EPivCWTr5UsMucf0vPPUqjlihkeFEwhaAFFwbJUoCMfG'),
(4, 'fdgfdhg', 'fdgfd@gmail.com', 'AAbc', '$2y$10$fvG1UJ.HC3BvKFNiDDU8eO8B3aOqaRA2fvRhwEhiNfs2n1CDU7Q0u'),
(5, 'uiuy', 'yhuujy@gmail.com', 'ghg', '$2y$10$SRNjYJB2ijnf9lEmqic2puZxhkedFnv.Og/T3VQPP8QeiIpwnJHgu');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(9, 'bikash', 'binod@gmail.com', 'happy', '2025-12-01 03:59:38'),
(11, 'fdf', 'tgrtg', 'rgrgrg', '2026-01-01 13:46:32'),
(12, 'try', 'ytey', 'tyrty', '2026-01-01 13:46:56'),
(13, 'fvf', 'fdce', 'fedc', '2026-01-01 14:37:01'),
(14, 'ff', 'fhfgg@gmail.com', 'grg', '2026-01-01 14:47:03'),
(15, 'fveef', 'efvefv@gmail.com', 'rvefvfrv', '2026-01-01 14:56:24'),
(16, 'ghfhggf', 'fghgfhg@vcbc.gfgfd', 'kiului', '2026-01-04 12:41:29');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `item_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `availability` tinyint(1) DEFAULT 1,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`item_id`, `name`, `price`, `category`, `image`, `availability`, `stock`) VALUES
(1, 'Veg Chowmein', 80.00, 'Snacks', 'Veg Chowmein.jpg', 1, 0),
(2, 'Chicken Momo', 120.00, 'Snacks', 'Chicken Momo.jpg', 1, 0),
(5, 'Veg Thali', 150.00, 'Lunch', 'thali.png', 1, 0),
(6, 'chicken chowmein', 120.00, 'snack', 'chicken chowmein.jpg', 1, 0),
(8, 'samosa tarkali', 60.00, 'beverage', 'samosa tarkali.jpg', 1, 0),
(90, 'Tea', 25.00, 'Beverages', '1766064004_6934.jpg', 1, 0),
(93, 'yy', 56.00, 'Lunch', '1767535152_1173.png', 1, 54);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `table_address` varchar(150) NOT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `order_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Ongoing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `customer_name`, `table_address`, `total_amount`, `order_time`, `status`) VALUES
(1, NULL, 'binod', '', 160.00, '2025-10-30 12:41:42', 'Finished'),
(2, NULL, 'binod', '', 160.00, '2025-10-30 12:42:38', 'Finished'),
(3, NULL, 'binod', '', 120.00, '2025-10-30 13:11:26', 'Finished'),
(4, NULL, 'hero', '', 80.00, '2025-10-31 04:53:33', 'Finished'),
(5, NULL, 'hora', '', 120.00, '2025-10-31 05:28:39', 'Finished'),
(6, NULL, 'admin', '', 20.00, '2025-10-31 05:35:22', 'Finished'),
(7, NULL, 'admin1', '', 20.00, '2025-10-31 05:36:56', 'Finished'),
(8, NULL, 'hnh', '', 30.00, '2025-10-31 05:37:35', 'Finished'),
(9, NULL, 'jhmjhmj', '', 80.00, '2025-10-31 05:37:47', 'Finished'),
(10, NULL, 'hoora', '', 60.00, '2025-10-31 05:55:13', 'Finished'),
(11, NULL, 'tyt', '', 120.00, '2025-11-03 02:43:54', 'Finished'),
(12, NULL, 'hbgf', '', 20.00, '2025-11-03 02:47:19', 'Finished'),
(13, NULL, 'sadsa', '', 30.00, '2025-11-03 02:59:19', 'Finished'),
(14, NULL, 'hjhg', '', 30.00, '2025-11-03 03:56:10', 'Finished'),
(15, NULL, 'l;lk', '', 80.00, '2025-11-03 14:51:16', 'Finished'),
(16, NULL, 'sadcsa', '', 120.00, '2025-11-03 14:51:40', 'Finished'),
(17, NULL, 'ggkghk', '', 20.00, '2025-11-03 14:51:51', 'Finished'),
(18, NULL, 'kmj', '', 80.00, '2025-11-03 14:52:09', 'Finished'),
(19, NULL, 'vfgfd', '', 20.00, '2025-11-05 03:04:42', 'Finished'),
(20, NULL, 'Website User', '', 80.00, '2025-11-05 03:46:05', 'Finished'),
(21, NULL, 'Website User', '', 820.00, '2025-11-05 03:47:37', 'Finished'),
(22, NULL, 'Website User', '', 300.00, '2025-11-05 03:56:43', 'Finished'),
(23, NULL, 'Website User', '', 200.00, '2025-11-05 04:21:01', 'Finished'),
(24, NULL, 'Website User', '', 200.00, '2025-11-05 09:05:12', 'Finished'),
(25, NULL, 'Website User', '', 220.00, '2025-11-06 12:58:52', 'Finished'),
(26, NULL, 'Website User', '', 140.00, '2025-11-06 13:11:26', 'Finished'),
(27, NULL, 'Website User', '', 560.00, '2025-11-17 03:24:08', 'Finished'),
(28, NULL, 'Website User', '', 460.00, '2025-11-17 13:10:16', 'Finished'),
(29, NULL, 'Website User', '', 240.00, '2025-11-17 13:12:47', 'Finished'),
(30, NULL, 'Website User', '', 120.00, '2025-11-17 13:15:31', 'Finished'),
(31, NULL, 'Website User', '', 80.00, '2025-11-17 13:16:19', 'Finished'),
(32, NULL, 'Website User', '', 740.00, '2025-11-17 13:20:35', 'Finished'),
(33, NULL, 'Website User', '', 120.00, '2025-11-21 12:43:31', 'Finished'),
(34, NULL, 'Website User', '', 20.00, '2025-11-21 12:43:43', 'Finished'),
(35, NULL, 'Website User', '', 120.00, '2025-11-22 05:02:31', 'Finished'),
(36, NULL, 'Website User', '', 80.00, '2025-11-24 11:15:46', 'Finished'),
(37, NULL, 'Website User', '', 890.00, '2025-11-28 13:47:29', 'Finished'),
(38, NULL, 'Website User', '', 60.00, '2025-11-28 13:55:33', 'Finished'),
(39, NULL, 'Website User', '', 120.00, '2025-11-28 14:19:19', 'Finished'),
(40, NULL, 'Website User', '', 300.00, '2025-11-28 14:24:42', 'Finished'),
(41, NULL, 'Website User', '', 120.00, '2025-11-28 14:27:12', 'Finished'),
(42, NULL, 'Website User', '', 220.00, '2025-11-29 12:56:59', 'Finished'),
(43, NULL, 'Website User', '', 120.00, '2025-11-29 13:02:41', 'Finished'),
(44, NULL, 'Website User', '', 360.00, '2025-11-29 13:13:34', 'Finished'),
(45, NULL, 'Website User', '', 140.00, '2025-11-29 13:13:57', 'Finished'),
(46, NULL, 'Website User', '', 140.00, '2025-11-29 13:16:26', 'Finished'),
(47, NULL, 'Website User', '', 120.00, '2025-11-29 13:25:30', 'Finished'),
(48, NULL, 'Website User', '', 80.00, '2025-11-29 13:26:59', 'Finished'),
(49, NULL, 'Website User', '', 20.00, '2025-11-29 13:27:06', 'Finished'),
(50, NULL, 'Website User', '', 120.00, '2025-11-29 13:27:19', 'Finished'),
(51, NULL, 'Website User', '', 120.00, '2025-11-29 13:29:01', 'Finished'),
(52, NULL, 'Website User', '', 120.00, '2025-11-29 13:30:55', 'Finished'),
(53, NULL, 'Website User', '', 120.00, '2025-11-29 13:31:07', 'Finished'),
(54, NULL, 'Website User', '', 120.00, '2025-11-29 13:37:04', 'Finished'),
(55, NULL, 'Website User', '', 120.00, '2025-11-29 13:37:26', 'Finished'),
(56, NULL, 'Website User', '', 220.00, '2025-11-29 13:40:39', 'Finished'),
(57, NULL, 'Website User', '', 120.00, '2025-11-29 13:42:16', 'Finished'),
(58, NULL, 'Website User', '', 43.00, '2025-11-29 13:43:25', 'Finished'),
(59, NULL, 'Website User', '', 120.00, '2025-11-29 13:49:48', 'Finished'),
(60, NULL, 'Website User', '', 20.00, '2025-11-29 13:50:50', 'Finished'),
(61, NULL, 'Website User', '', 200.00, '2025-11-29 14:03:52', 'Finished'),
(62, NULL, 'Website User', '', 120.00, '2025-11-29 14:04:23', 'Finished'),
(63, NULL, 'Website User', '', 20.00, '2025-11-29 14:04:30', 'Finished'),
(64, NULL, 'Website User', '', 80.00, '2025-11-29 14:08:50', 'Finished'),
(65, NULL, 'Website User', '', 80.00, '2025-11-29 14:09:11', 'Finished'),
(66, NULL, 'Website User', '', 410.00, '2025-11-29 14:20:55', 'Finished'),
(67, NULL, 'Website User', '', 20.00, '2025-11-30 04:18:52', 'Finished'),
(68, NULL, 'binod', 'dfdf', 80.00, '2025-11-30 04:32:31', 'Finished'),
(69, NULL, 'binod', 'dfdf', 43.00, '2025-11-30 04:33:21', 'Finished'),
(70, NULL, 'don', '4', 120.00, '2025-11-30 04:37:06', 'Finished'),
(71, NULL, 'binod', '2', 390.00, '2025-12-01 04:02:17', 'Finished'),
(72, NULL, 'binod', '5', 260.00, '2025-12-01 13:28:24', 'Finished'),
(73, NULL, 'hero', '123', 200.00, '2025-12-01 13:29:21', 'Finished'),
(74, NULL, 'binod', '8', 380.00, '2025-12-01 14:03:59', 'Finished'),
(75, NULL, 'jhg', '7', 80.00, '2025-12-01 14:14:20', 'Finished'),
(76, NULL, 'hero', 'efref', 520.00, '2025-12-01 14:23:47', 'Finished'),
(77, NULL, 'admin', 'b', 260.00, '2025-12-01 14:46:51', 'Finished'),
(78, NULL, 'binod', 'gaindakot', 300.00, '2025-12-02 04:02:44', 'Finished'),
(79, NULL, 'dsf', '3', 190.00, '2025-12-03 13:02:24', 'Finished'),
(80, NULL, 'binod', 'gaindakot', 773.00, '2025-12-03 13:15:04', 'Finished'),
(81, NULL, 'binod', '2', 180.00, '2025-12-18 04:01:47', 'Finished'),
(82, NULL, 'binod', '2', 120.00, '2025-12-18 04:12:22', 'Finished'),
(83, NULL, 'binod', '2', 220.00, '2025-12-18 13:20:44', 'Finished'),
(84, NULL, 'binod', '1', 160.00, '2025-12-20 05:23:07', 'Finished'),
(85, NULL, '......', '.....', 200.00, '2025-12-20 05:27:10', 'Finished'),
(86, NULL, 'bmc', 'bmc', 6160.00, '2025-12-20 05:30:52', 'Finished'),
(87, NULL, 'binod', 'hh', 1200000.00, '2025-12-20 05:31:25', 'Finished'),
(88, NULL, 'hg', 'gh', 120.00, '2026-01-01 13:47:52', 'Finished'),
(89, NULL, 'hj', 'jhgh', 120.00, '2026-01-03 14:03:40', 'Finished'),
(90, NULL, 'rtre', 'retre', 460.00, '2026-01-03 14:22:12', 'Finished'),
(92, NULL, 'yrty', 'ry', 300.00, '2026-01-03 14:34:44', 'Finished'),
(93, 1, 'yujiuy', 'uiuy', 240.00, '2026-01-03 14:37:55', 'Finished'),
(94, 1, 'ytr', 'rytry', 50.00, '2026-01-03 14:54:13', 'Finished'),
(95, 1, 'hgjgh', 'ghjk', 400.00, '2026-01-04 03:35:31', 'Finished'),
(96, 1, 'rye', 'ghgf', 240.00, '2026-01-04 03:51:16', 'Finished'),
(97, 1, 'rye', '....', 480.00, '2026-01-04 03:51:32', 'Finished'),
(98, 1, 'rye', '1', 240.00, '2026-01-04 03:56:03', 'Finished'),
(99, 1, 'rye', '4', 246.00, '2026-01-04 04:44:26', 'Finished'),
(100, 1, 'rye', 'l', 123.00, '2026-01-04 12:15:42', 'Finished'),
(101, 1, 'rye', '5', 123.00, '2026-01-04 12:16:34', 'Finished'),
(102, 1, 'rye', '4', 30.00, '2026-01-04 13:23:59', 'Ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`order_item_id`, `order_id`, `item_id`, `quantity`, `subtotal`) VALUES
(1, 1, 1, 2, 160.00),
(2, 2, 1, 2, 160.00),
(3, 3, 2, 1, 120.00),
(5, 5, 2, 1, 120.00),
(6, 6, 3, 1, 20.00),
(7, 7, 3, 1, 20.00),
(8, 8, 4, 1, 30.00),
(9, 9, 1, 1, 80.00),
(10, 10, 8, 1, 60.00),
(11, 11, 2, 1, 120.00),
(12, 12, 3, 1, 20.00),
(13, 13, 4, 1, 30.00),
(14, 14, 4, 1, 30.00),
(15, 15, 1, 1, 80.00),
(16, 16, 2, 1, 120.00),
(17, 17, 3, 1, 20.00),
(18, 18, 1, 1, 80.00),
(19, 19, 3, 1, 20.00),
(20, 20, 1, 1, 80.00),
(21, 21, 1, 3, 240.00),
(22, 21, 3, 2, 40.00),
(23, 21, 8, 9, 540.00),
(25, 22, 2, 1, 120.00),
(26, 22, 3, 5, 100.00),
(27, 23, 1, 1, 80.00),
(28, 23, 2, 1, 120.00),
(29, 24, 1, 1, 80.00),
(30, 24, 2, 1, 120.00),
(31, 25, 1, 1, 80.00),
(32, 25, 2, 1, 120.00),
(33, 25, 3, 1, 20.00),
(34, 26, 3, 1, 20.00),
(35, 26, 2, 1, 120.00),
(36, 27, 1, 1, 80.00),
(37, 27, 2, 3, 360.00),
(38, 27, 3, 6, 120.00),
(39, 28, 2, 3, 360.00),
(40, 28, 1, 1, 80.00),
(41, 28, 3, 1, 20.00),
(42, 29, 1, 3, 240.00),
(43, 30, 2, 1, 120.00),
(44, 31, 1, 1, 80.00),
(45, 32, 2, 1, 120.00),
(46, 32, 3, 1, 20.00),
(47, 32, 6, 5, 600.00),
(48, 33, 2, 1, 120.00),
(49, 34, 3, 1, 20.00),
(50, 35, 2, 1, 120.00),
(51, 36, 1, 1, 80.00),
(52, 37, 2, 3, 360.00),
(53, 37, 1, 1, 80.00),
(54, 37, 4, 1, 30.00),
(55, 37, 5, 2, 300.00),
(56, 37, 6, 1, 120.00),
(57, 38, 8, 1, 60.00),
(58, 39, 2, 1, 120.00),
(59, 40, 1, 1, 80.00),
(60, 40, 2, 1, 120.00),
(61, 40, 3, 5, 100.00),
(62, 41, 2, 1, 120.00),
(63, 42, 2, 1, 120.00),
(64, 42, 3, 1, 20.00),
(65, 42, 1, 1, 80.00),
(66, 43, 2, 1, 120.00),
(67, 44, 2, 3, 360.00),
(68, 45, 2, 1, 120.00),
(69, 45, 3, 1, 20.00),
(70, 46, 2, 1, 120.00),
(71, 46, 3, 1, 20.00),
(72, 47, 2, 1, 120.00),
(73, 48, 1, 1, 80.00),
(74, 49, 3, 1, 20.00),
(75, 50, 2, 1, 120.00),
(76, 51, 2, 1, 120.00),
(77, 52, 2, 1, 120.00),
(78, 53, 2, 1, 120.00),
(79, 54, 2, 1, 120.00),
(80, 55, 2, 1, 120.00),
(81, 56, 1, 1, 80.00),
(82, 56, 2, 1, 120.00),
(83, 56, 3, 1, 20.00),
(84, 57, 2, 1, 120.00),
(85, 58, 70, 1, 43.00),
(86, 59, 2, 1, 120.00),
(87, 60, 3, 1, 20.00),
(88, 61, 2, 1, 120.00),
(89, 61, 1, 1, 80.00),
(90, 62, 2, 1, 120.00),
(91, 63, 3, 1, 20.00),
(92, 64, 1, 1, 80.00),
(93, 65, 1, 1, 80.00),
(94, 66, 2, 1, 120.00),
(95, 66, 3, 1, 20.00),
(96, 66, 6, 1, 120.00),
(97, 66, 5, 1, 150.00),
(98, 67, 3, 1, 20.00),
(99, 68, 1, 1, 80.00),
(100, 69, 70, 1, 43.00),
(101, 70, 2, 1, 120.00),
(102, 71, 2, 1, 120.00),
(103, 71, 3, 2, 40.00),
(104, 71, 1, 1, 80.00),
(105, 71, 4, 5, 150.00),
(106, 72, 2, 2, 240.00),
(107, 72, 3, 1, 20.00),
(108, 73, 1, 1, 80.00),
(109, 73, 2, 1, 120.00),
(110, 74, 2, 2, 240.00),
(111, 74, 3, 1, 20.00),
(112, 74, 6, 1, 120.00),
(113, 75, 1, 1, 80.00),
(114, 76, 1, 2, 160.00),
(115, 76, 2, 3, 360.00),
(116, 77, 2, 2, 240.00),
(117, 77, 3, 1, 20.00),
(118, 78, 5, 2, 300.00),
(119, 79, 3, 1, 20.00),
(120, 79, 6, 1, 120.00),
(121, 79, 85, 1, 50.00),
(122, 80, 2, 1, 120.00),
(123, 80, 5, 1, 150.00),
(124, 80, 85, 1, 50.00),
(125, 80, 87, 1, 453.00),
(126, 81, 1, 2, 160.00),
(127, 81, 3, 1, 20.00),
(128, 82, 2, 1, 120.00),
(129, 83, 1, 1, 80.00),
(130, 83, 2, 1, 120.00),
(131, 83, 3, 1, 20.00),
(132, 84, 1, 2, 160.00),
(133, 85, 1, 1, 80.00),
(134, 85, 2, 1, 120.00),
(135, 86, 1, 2, 160.00),
(136, 86, 2, 50, 6000.00),
(137, 87, 2, 10000, 1200000.00),
(138, 88, 2, 1, 120.00),
(139, 89, 2, 1, 120.00),
(140, 90, 5, 2, 300.00),
(141, 90, 1, 2, 160.00),
(142, 92, 5, 2, 300.00),
(143, 93, 2, 2, 240.00),
(144, 94, 90, 2, 50.00),
(145, 95, 1, 2, 160.00),
(146, 95, 2, 2, 240.00),
(147, 96, 2, 2, 240.00),
(148, 97, 2, 4, 480.00),
(149, 98, 2, 2, 240.00),
(150, 99, 91, 2, 246.00),
(151, 100, 91, 1, 123.00),
(152, 101, 91, 1, 123.00),
(153, 102, 92, 1, 30.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`) VALUES
(6, 'admin', 'admin123', 'admin'),
(8, 'staff', 'staff123', 'staff'),
(18, 'staff1', 'staff123', 'staff'),
(20, 'waiter', 'waiter123', 'staff'),
(21, 'cook', 'cook123', 'staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_orders_customer` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
