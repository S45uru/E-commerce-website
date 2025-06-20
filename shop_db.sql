-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 08:35 AM
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
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cartt`
--

CREATE TABLE `cartt` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ordered`
--

CREATE TABLE `ordered` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `address_type` enum('home','office','other') NOT NULL DEFAULT 'home',
  `method` enum('COD','Credit Card','Debit Card','UPI','Net Banking') NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ordered`
--

INSERT INTO `ordered` (`id`, `user_id`, `name`, `number`, `email`, `address`, `address_type`, `method`, `product_id`, `price`, `qty`, `date`, `status`) VALUES
(4, 0, 'Anjali Rathore', '13', 'anjalisinghrathore25@gmail.com', 'Jagai purwa , lal Bangla , jajmau Sub metro city, jajmau sub metro city, Kanpur, India, 208007', 'home', '', 1, 120.00, 1, '2025-04-13 08:55:43', ''),
(7, 0, 'ragini', '8252240182', 'ragini@gmail.com', 'Jagai purwa , lal Bangla , jajmau Sub metro city, jajmau sub metro city, Kanpur, India, 208007', 'home', '', 1, 120.00, 1, '2025-04-12 10:48:13', ''),
(8, 0, 'ragini', '8252240182', 'ragini@gmail.com', 'Jagai purwa , lal Bangla , jajmau Sub metro city, jajmau sub metro city, Kanpur, India, 208007', 'home', '', 2, 280.00, 1, '2025-04-12 10:48:13', ''),
(9, 9, 'ragini', '8975654674', 'ragini@gmail.com', 'indrapuri, roadno.2, patna, india, 856945', 'home', '', 2, 280.00, 1, '2025-04-13 10:13:40', ''),
(10, 9, 'ragini', '8975654674', 'ragini@gmail.com', 'indrapuri, roadno.2, patna, india, 856945', 'home', '', 1, 120.00, 1, '2025-04-13 10:13:40', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `image`, `details`, `created_at`) VALUES
(1, 'lemon Tea', 120.00, 'lemon.jpg', '', '2025-04-10 16:59:18'),
(2, 'lemon_iced Tea', 280.00, 'lemon_iced.jpg', '', '2025-04-10 16:59:18'),
(3, 'longning Tea', 300.00, 'longning.jpg', '', '2025-04-10 16:59:18'),
(4, 'Minty Tea', 312.00, 'minty.jpg', '', '2025-04-10 16:59:18'),
(5, 'Sencha Tea', 320.00, 'sencha.jpg', '', '2025-04-10 16:59:18'),
(6, 'Verbena Tea', 260.00, 'verbena.jpg', '', '2025-04-10 16:59:18'),
(7, 'Gunpowder', 340.00, 'gunpowder.jpg', '', '2025-04-10 16:59:18'),
(8, 'Matcha Green Tea', 500.00, 'Matcha.jpg', '', '2025-04-10 16:59:18'),
(9, 'Golden Green Tea', 740.00, 'Golden_Tips.jpg', '', '2025-04-10 16:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `userss`
--

CREATE TABLE `userss` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin','customer') NOT NULL DEFAULT 'customer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userss`
--

INSERT INTO `userss` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(9, 'ragini', 'ragini@gmail.com', 'ragini', 'customer'),
(10, 'payal', 'payal@gmail.com', 'payal', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `price`) VALUES
(5, 9, 3, 300.00),
(7, 0, 1, 120.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cartt`
--
ALTER TABLE `cartt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered`
--
ALTER TABLE `ordered`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userss`
--
ALTER TABLE `userss`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cartt`
--
ALTER TABLE `cartt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ordered`
--
ALTER TABLE `ordered`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `userss`
--
ALTER TABLE `userss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
