-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2025 at 08:13 AM
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
-- Database: `inventory_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `c_name` varchar(50) NOT NULL,
  `created_at` varchar(30) NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `c_name`, `created_at`, `status`) VALUES
(2, 'Anime', '2025-01-22 09:30:43', 1),
(3, 'Animal', '2025-01-22 09:30:46', 1),
(4, 'Pens', '2025-01-22 09:30:48', 1),
(5, 'Mobiles', '2025-01-22 09:30:51', 1),
(6, 'Health Care', '2025-01-22 09:30:54', 1),
(7, 'Human', '2025-01-22 09:31:12', 1),
(8, 'Electronics', '2025-01-22 13:03:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_mail` varchar(100) DEFAULT NULL,
  `customer_address` varchar(100) DEFAULT NULL,
  `customer_bdate` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `customer_contact` bigint(15) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `customer_mail`, `customer_address`, `customer_bdate`, `created_at`, `customer_contact`, `status`) VALUES
(4, 'Aafreen Shaikh', 'aafreenshaikh046@gmail.com', 'Khadgoan Road, Sambhaji Nagar, Latur', '2025-02-15', '2025-02-05 09:37:36', 9503135000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` decimal(10,0) NOT NULL,
  `product_description` varchar(100) DEFAULT NULL,
  `manufacture_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `subcategory_id`, `product_name`, `product_price`, `product_description`, `manufacture_date`, `expiry_date`, `status`) VALUES
(1, 3, 29, 'Naruto Statue', 10000, '17 cm and 12 cm', '0000-00-00', '2025-11-07', 1),
(19, 7, 31, 'Saliha', 100000000, 'with 2 legs and 2 hands and one hesd', '2004-05-24', '2070-05-24', 1),
(20, 2, 33, 'Gojo Doll', 10000, '17 cm height and 12 cm width', '2020-02-01', '0000-00-00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `sub_category_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sc_name` varchar(50) NOT NULL,
  `created_at` varchar(50) NOT NULL DEFAULT current_timestamp(),
  `status` int(2) NOT NULL DEFAULT 1,
  `sc_description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`sub_category_id`, `category_id`, `sc_name`, `created_at`, `status`, `sc_description`) VALUES
(5, 2, 'Naruto', '2025-01-22 10:11:00', 0, 'Statue'),
(28, 2, 'Rorito', '2025-01-31 09:23:46', 1, 'Ball and Gel Pens'),
(29, 5, 'Oppo A78 5G', '2025-01-31 09:29:09', 1, 'for 17000/-'),
(30, 3, 'Dogs', '2025-02-03 09:18:17', 1, 'with 4 legs and 1 head'),
(31, 7, 'Good ones', '2025-02-03 09:28:16', 1, ''),
(32, 5, 'Oppo', '2025-02-04 09:40:25', 1, ''),
(33, 2, 'Jujutsu Kaisan', '2025-02-04 09:44:00', 1, 'A anime from japan'),
(34, 3, 'Cat', '2025-02-04 12:20:26', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(20) NOT NULL,
  `user_full_name` longtext NOT NULL,
  `user_name` varchar(10) NOT NULL,
  `user_pass` varchar(10) NOT NULL,
  `user_email` mediumtext NOT NULL,
  `user_phone` bigint(15) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `country_code` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `user_full_name`, `user_name`, `user_pass`, `user_email`, `user_phone`, `status`, `created_at`, `country_code`) VALUES
(1, 'Afreenneha Iftekharahmad Shaikh', 'KeresAlala', 'Keres@2003', 'aafreenshaikh046@gmail.com', 9503135906, 0, '2025-01-16 04:39:54', 91),
(2, 'Afreenneha Iftekharahmad Shaikh', 'KeresAlala', 'Keres@2003', 'aafreenshaikh046@gmail.com', 9503135906, 0, '2025-01-16 04:41:26', 91),
(3, 'Afreenneha Iftekharahmad Shaikh', 'KeresAlala', 'Keres@2003', 'aafreenshaikh046@gmail.com', 9503135906, 0, '2025-01-16 04:51:25', 91),
(4, 'Afreenneha Iftekharahmad Shaikh', 'KeresAlala', 'Keresalala', 'aafreenshaikh046@gmail.com', 9503135906, 0, '2025-01-17 05:33:45', 91),
(5, 'Rutuja Dadge', 'rutu', 'affurutu', 'aafreenshaikh046@gmail.com', 9503135906, 0, '2025-01-20 05:48:22', 91),
(6, 'Obito Uchiha', 'obitotin', 'Samreen123', 'keresalala@gmail.com', 9665142068, 0, '2025-01-21 07:53:49', 91),
(7, 'Itchai', 'uchiha', 'uchiha123', 'keresalala@gmail.com', 9665142068, 0, '2025-01-22 07:33:02', 91),
(8, 'Afreenneha Iftekharahmad Shaikh', 'keresalala', 'ILove@2003', 'aafreenshaikh046@gmail.com', 9503135906, 0, '2025-01-30 11:22:33', 91);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `vendor_id` int(11) NOT NULL,
  `v_name` varchar(100) NOT NULL,
  `country_code` int(5) NOT NULL,
  `v_phone` bigint(15) NOT NULL,
  `v_email` varchar(100) DEFAULT NULL,
  `v_address` varchar(100) DEFAULT NULL,
  `v_category` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` varchar(100) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`vendor_id`, `v_name`, `country_code`, `v_phone`, `v_email`, `v_address`, `v_category`, `status`, `created_at`) VALUES
(7, 'Aafreen Pvt. Limited', 91, 9665142068, 'keresalala@gmail.com', 'Khadgoan Road', 2, 1, '2025-02-07 10:20:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `pro_c` (`category_id`),
  ADD KEY `pro_sc` (`subcategory_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`sub_category_id`),
  ADD KEY `FK_SC` (`category_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`vendor_id`),
  ADD KEY `FK_VC` (`v_category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `pro_c` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pro_sc` FOREIGN KEY (`subcategory_id`) REFERENCES `sub_categories` (`sub_category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `FK_SC` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `vendors`
--
ALTER TABLE `vendors`
  ADD CONSTRAINT `FK_VC` FOREIGN KEY (`v_category`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
