-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 04, 2018 at 09:28 PM
-- Server version: 5.6.39
-- PHP Version: 7.2.2-3+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updates_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `created_at`, `updates_at`) VALUES
(1, 'Electrical', NULL, NULL),
(2, 'Plumbing', NULL, NULL),
(3, 'Paint Work', NULL, NULL),
(4, 'Wood Work', NULL, NULL),
(5, 'Building Materials', NULL, NULL),
(6, 'Hardware General', NULL, '2018-02-21 10:53:04'),
(7, 'Hardware Kitchen', NULL, '2018-02-21 10:53:13');

-- --------------------------------------------------------

--
-- Table structure for table `logsite_stock`
--

CREATE TABLE IF NOT EXISTS `logsite_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `rate` float NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` float NOT NULL,
  `comment` varchar(55) DEFAULT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  UNIQUE KEY `id_2` (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `logsite_stock`
--

INSERT INTO `logsite_stock` (`id`, `site_id`, `subcategory_id`, `rate`, `qty`, `amount`, `comment`, `date`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 2, 2, 1, 2, 2, 'com', '0012-11-10', 2, '2018-03-04 08:34:58', '2018-03-04 08:34:58'),
(3, 2, 2, 1, 2, 2, 'com', '0012-11-10', 2, '2018-03-04 08:35:05', '2018-03-04 08:35:05'),
(4, 2, 23, 12, 5, 60, NULL, '0010-10-10', 2, '2018-03-04 10:23:29', '2018-03-04 10:23:29'),
(5, 3, 10, 12, 1, 12, '132', '0010-10-10', 2, '2018-03-04 10:25:42', '2018-03-04 10:25:42');

-- --------------------------------------------------------

--
-- Table structure for table `logwarehouse_stock`
--

CREATE TABLE IF NOT EXISTS `logwarehouse_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subcategory_id` int(11) NOT NULL,
  `rate` float NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` float NOT NULL,
  `comment` varchar(1000) DEFAULT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `logwarehouse_stock`
--

INSERT INTO `logwarehouse_stock` (`id`, `subcategory_id`, `rate`, `qty`, `amount`, `comment`, `date`, `user_id`, `created_at`, `updated_at`) VALUES
(12, 2, 1, 13, 13, '1', '0012-12-12', 2, '2018-03-04 04:44:38', '2018-03-03 23:14:38'),
(13, 2, 2, 2, 4, '2', '0012-12-12', 2, '2018-03-03 23:14:05', '2018-03-03 23:14:05'),
(14, 2, 2, 12, 24, '12', '0012-12-12', 2, '2018-03-03 23:17:28', '2018-03-03 23:17:28'),
(15, 10, 12, 12, 144, '122', '0022-11-12', 2, '2018-03-03 23:29:25', '2018-03-03 23:29:25'),
(16, 23, 12, 10, 120, 'Hello', '0010-10-10', 2, '2018-03-04 10:23:01', '2018-03-04 10:23:01'),
(17, 13, 10, 1, 10, '10', '0101-10-10', 2, '2018-03-04 10:25:04', '2018-03-04 10:25:04');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE IF NOT EXISTS `sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(55) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_user_id` int(11) NOT NULL,
  `deleted_user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `site_name`, `status`, `created_user_id`, `deleted_user_id`, `created_at`, `updated_at`) VALUES
(1, 'Hello', 0, 2, 2, '2018-03-03 14:42:01', '2018-03-03 09:12:01'),
(2, 'Hello2', 1, 2, NULL, '2018-03-03 09:12:22', '2018-03-03 09:12:22'),
(3, 'Hello3', 1, 2, NULL, '2018-03-03 23:03:49', '2018-03-03 23:03:49'),
(4, 'Hello4', 1, 2, NULL, '2018-03-03 23:03:52', '2018-03-03 23:03:52');

-- --------------------------------------------------------

--
-- Table structure for table `site_stock`
--

CREATE TABLE IF NOT EXISTS `site_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `rate` float NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` float NOT NULL,
  `comment` varchar(55) DEFAULT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  UNIQUE KEY `id` (`id`),
  KEY `fk_site_stock_1_idx` (`subcategory_id`),
  KEY `fk_site_stock_2_idx` (`site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `site_stock`
--

INSERT INTO `site_stock` (`id`, `site_id`, `subcategory_id`, `rate`, `qty`, `amount`, `comment`, `date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 1, 4, 4, 'com', '0012-11-10', 2, '2018-03-04 14:05:05', '2018-03-04 08:35:05'),
(2, 2, 23, 12, 5, 60, NULL, '0010-10-10', 2, '2018-03-04 10:23:29', '2018-03-04 10:23:29'),
(3, 3, 10, 12, 1, 12, '132', '0010-10-10', 2, '2018-03-04 10:25:42', '2018-03-04 10:25:42');

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subcategory` varchar(55) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_subcategories_1_idx` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `subcategory`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Switches', 1, '2018-02-21 10:56:02', '2018-02-21 10:56:02'),
(2, 'Wires', 1, '2018-02-21 10:56:02', '2018-02-21 10:56:02'),
(3, 'MCB', 1, '2018-02-21 10:56:02', '2018-02-21 10:56:02'),
(4, 'LED', 1, '2018-02-21 10:56:02', '2018-02-21 10:56:02'),
(5, 'Strip Lights', 1, '2018-02-21 10:56:02', '2018-02-21 10:56:02'),
(6, 'Niche Lights (Spot Lights)', 1, '2018-02-21 10:56:02', '2018-02-21 10:56:02'),
(7, 'Miscellaneous', 1, '2018-02-21 10:56:02', '2018-02-21 10:56:02'),
(8, 'Flush Tanks', 2, '2018-02-21 11:00:05', '2018-02-21 11:00:05'),
(9, 'W.C. (Seat)', 2, '2018-02-21 11:00:05', '2018-02-21 11:00:05'),
(10, 'WashBasin', 2, '2018-02-21 11:00:05', '2018-02-21 11:00:05'),
(11, 'Diverter', 2, '2018-02-21 11:00:05', '2018-02-21 11:00:05'),
(12, 'Sink Mixture', 2, '2018-02-21 11:00:05', '2018-02-21 11:00:05'),
(13, 'Basin Diverter', 2, '2018-02-21 11:00:05', '2018-02-21 11:00:05'),
(14, 'Angle Value', 2, '2018-02-21 11:00:05', '2018-02-21 11:00:05'),
(15, 'Health Faucet', 2, '2018-02-21 11:00:05', '2018-02-21 11:00:05'),
(16, 'Battle Trap', 2, '2018-02-21 11:00:05', '2018-02-21 11:00:05'),
(17, 'Spout', 2, '2018-02-21 11:00:05', '2018-02-21 11:00:05'),
(18, 'Rain Shower', 2, '2018-02-21 11:00:05', '2018-02-21 11:00:05'),
(19, 'Miscellaneous', 2, '2018-02-21 11:00:05', '2018-02-21 11:00:05'),
(20, 'Paint', 3, '2018-02-21 11:09:25', '2018-02-21 11:09:25'),
(21, 'P.U', 3, '2018-02-21 11:09:25', '2018-02-21 11:09:25'),
(22, 'Wood Polish', 3, '2018-02-21 11:09:25', '2018-02-21 11:09:25'),
(23, 'Putty', 3, '2018-02-21 11:09:25', '2018-02-21 11:09:25'),
(24, 'Wood Base', 3, '2018-02-21 11:09:25', '2018-02-21 11:09:25'),
(25, 'Sealer', 3, '2018-02-21 11:09:25', '2018-02-21 11:09:25'),
(26, 'Miscellaneous', 3, '2018-02-21 11:09:25', '2018-02-21 11:09:25'),
(27, 'Ply', 4, '2018-02-21 11:10:14', '2018-02-21 11:10:14'),
(28, 'Board', 4, '2018-02-21 11:10:14', '2018-02-21 11:10:14'),
(29, 'Veneen', 4, '2018-02-21 11:10:14', '2018-02-21 11:10:14'),
(30, 'Mica', 4, '2018-02-21 11:10:14', '2018-02-21 11:10:14'),
(31, 'MDF', 4, '2018-02-21 11:10:14', '2018-02-21 11:10:14'),
(32, 'Charcoal Sheet', 4, '2018-02-21 11:10:14', '2018-02-21 11:10:14'),
(33, 'Miscellaneous', 4, '2018-02-21 11:10:14', '2018-02-21 11:10:14'),
(34, 'Dust', 5, '2018-02-21 11:11:07', '2018-02-21 11:11:07'),
(35, 'Bricks', 5, '2018-02-21 11:11:07', '2018-02-21 11:11:07'),
(36, 'Cement', 5, '2018-02-21 11:11:07', '2018-02-21 11:11:07'),
(37, 'Peta', 5, '2018-02-21 11:11:07', '2018-02-21 11:11:07'),
(38, 'Rodi', 5, '2018-02-21 11:11:07', '2018-02-21 11:11:07'),
(39, 'Miscellaneous', 5, '2018-02-21 11:11:07', '2018-02-21 11:11:07'),
(40, 'Hinges (Soft Doors)', 6, '2018-02-21 11:19:44', '2018-02-21 11:19:44'),
(41, 'Hinges Doors', 6, '2018-02-21 11:19:44', '2018-02-21 11:19:44'),
(42, 'Channel', 6, '2018-02-21 11:19:44', '2018-02-21 11:19:44'),
(43, 'Handle Locks', 6, '2018-02-21 11:19:44', '2018-02-21 11:19:44'),
(44, 'Tower Bolt', 6, '2018-02-21 11:19:44', '2018-02-21 11:19:44'),
(45, 'Jalli Palla Handles', 6, '2018-02-21 11:19:44', '2018-02-21 11:19:44'),
(46, 'Drawer Locks', 6, '2018-02-21 11:19:44', '2018-02-21 11:19:44'),
(47, 'Wardrobe Locks', 6, '2018-02-21 11:19:44', '2018-02-21 11:19:44'),
(48, 'Wardrobe Handles', 6, '2018-02-21 11:19:44', '2018-02-21 11:19:44'),
(49, 'Locks', 6, '2018-02-21 11:19:44', '2018-02-21 11:19:44'),
(50, 'Knobs', 6, '2018-02-21 11:19:44', '2018-02-21 11:19:44'),
(51, 'Miscellaneous', 6, '2018-02-21 11:19:44', '2018-02-21 11:19:44'),
(52, 'Hinges', 7, '2018-02-21 11:23:28', '2018-02-21 11:23:28'),
(53, 'Innotech(Without Railing)', 7, '2018-02-21 11:23:28', '2018-02-21 11:23:28'),
(54, 'Innotech(With Railing)', 7, '2018-02-21 11:23:28', '2018-02-21 11:23:28'),
(55, 'S. Chausel', 7, '2018-02-21 11:23:28', '2018-02-21 11:23:28'),
(56, 'Pantry', 7, '2018-02-21 11:23:28', '2018-02-21 11:23:28'),
(57, 'Bottle Pullout', 7, '2018-02-21 11:23:28', '2018-02-21 11:23:28'),
(58, 'Rolling Shutter', 7, '2018-02-21 11:23:28', '2018-02-21 11:23:28'),
(59, 'Lift Ups', 7, '2018-02-21 11:23:28', '2018-02-21 11:23:28'),
(60, 'Cutlery', 7, '2018-02-21 11:23:28', '2018-02-21 11:23:28'),
(61, 'Miscellaneous', 7, '2018-02-21 11:23:28', '2018-02-21 11:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '0',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'user', 'user@sukhmani.com', 0, '$2y$10$br9lul/EQJ8AxIF7ikDakufp3ykPgoEZmCReJmElwJoTVPhpn9El6', 'ie3HQDwb6ietj9OPmYSGxLVNMoiSzQgBAmLL7Px7iuw5sN3DwJeCN4HG6fbj', '2018-02-28 13:44:31', '2018-02-28 13:44:31'),
(2, 'admin', 'admin@sukhmani.com', 1, '$2y$10$LYALxkbON/L5OAlypQCmrOGYTyslwXQzw6lziZ0hon/i9BO0EfXfO', NULL, '2018-02-28 13:44:49', '2018-02-28 13:44:49');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_stock`
--

CREATE TABLE IF NOT EXISTS `warehouse_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subcategory_id` int(11) NOT NULL,
  `rate` float NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` float NOT NULL,
  `comment` varchar(1000) DEFAULT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `fk_warehouse_stock_1_idx` (`subcategory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `warehouse_stock`
--

INSERT INTO `warehouse_stock` (`id`, `subcategory_id`, `rate`, `qty`, `amount`, `comment`, `date`, `user_id`, `created_at`, `updated_at`) VALUES
(12, 2, 1, 1, 1, '1', '0012-11-10', 2, '2018-03-04 14:05:05', '2018-03-04 08:35:05'),
(13, 2, 2, 14, 28, '12', '0012-12-12', 2, '2018-03-04 04:47:28', '2018-03-03 23:17:28'),
(14, 10, 12, 11, 132, '122', '0010-10-10', 2, '2018-03-04 15:55:42', '2018-03-04 10:25:42'),
(15, 23, 12, 5, 60, 'Hello', '0010-10-10', 2, '2018-03-04 15:53:29', '2018-03-04 10:23:29'),
(16, 13, 10, 1, 10, '10', '0101-10-10', 2, '2018-03-04 10:25:04', '2018-03-04 10:25:04');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `site_stock`
--
ALTER TABLE `site_stock`
  ADD CONSTRAINT `fk_site_stock_1` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_site_stock_2` FOREIGN KEY (`site_id`) REFERENCES `sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `fk_subcategories_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `warehouse_stock`
--
ALTER TABLE `warehouse_stock`
  ADD CONSTRAINT `fk_warehouse_stock_1` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
