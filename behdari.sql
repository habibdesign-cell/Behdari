-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2025 at 06:49 PM
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
-- Database: `behdari`
--

-- --------------------------------------------------------

--
-- Table structure for table `drugs`
--

CREATE TABLE `drugs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` int(11) NOT NULL,
  `organization_number` int(11) NOT NULL,
  `real_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `drugs`
--

INSERT INTO `drugs` (`id`, `name`, `code`, `organization_number`, `real_number`) VALUES
(1, 'کلونفلاک', 97328, 1200, 80),
(2, 'امپرازول 500', 97846, 1200, 23),
(3, 'دیاسپام', 97584, 1200, 899),
(4, 'آنتی هیستامین', 7498452, 1205, 25),
(9, 'ژلوفن', 8516198, 511, 36),
(10, 'چرک خشک کن 500', 981747, 68, 13),
(11, 'چرک خشک کن 250', 9819871, 100, 22),
(12, 'پرگابالین', 874877, 500, 150),
(13, 'استامینوفن', 81987, 1500, 1700);

-- --------------------------------------------------------

--
-- Table structure for table `drugs_reports`
--

CREATE TABLE `drugs_reports` (
  `id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `date` varchar(11) NOT NULL,
  `number` varchar(11) NOT NULL,
  `old_number` varchar(11) NOT NULL,
  `user_id` varchar(12) NOT NULL,
  `status` enum('active','leave','edit') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `drugs_reports`
--

INSERT INTO `drugs_reports` (`id`, `code`, `name`, `date`, `number`, `old_number`, `user_id`, `status`) VALUES
(21, 97328, 'امپرازول 300', '1404/7/22', '26', '25', '371819849', 'edit'),
(23, 97328, 'کلونفلاک', '1404/7/22', '32', '13', '371819849', 'edit'),
(24, 846, 'دیاسپام', '1404/7/22', '25', '0', '371819849', 'leave'),
(25, 97846, 'امپرازول 300', '1404/7/22', '33', '0', '371819849', 'edit'),
(26, 97846, 'امپرازول 300', '1404/7/22', '33', '0', '371819849', 'edit'),
(27, 97846, 'امپرازول 500', '1404/7/22', '36', '0', '371819849', 'edit'),
(28, 97584, '', '1404/7/22', '900', '0', '371819849', 'active'),
(29, 97584, 'دیاسپام', '1404/7/23', '899', '0', '371819849', 'edit'),
(30, 7498452, '', '1404/7/23', '65', '0', '371819849', 'active'),
(31, 8576, '', '1404/7/23', '45', '0', '371819849', 'active'),
(32, 8576, 'امپرازول 500', '1404/7/23', '45', '0', '371819849', 'leave'),
(33, 566534, 'امپرازول 500', '1404/7/23', '53', '0', '371819849', 'active'),
(34, 97846, 'امپرازول 500', '1404/7/23', '0', '0', '371819849', 'edit'),
(35, 97846, 'امپرازول 500', '1404/7/23', '0', '0', '371819849', 'edit'),
(36, 97846, 'امپرازول 500', '1404/7/23', '0', '0', '371819849', 'edit'),
(37, 566534, 'امپرازول 500', '1404/7/23', '0', '0', '371819849', 'edit'),
(38, 566534, 'امپرازول 500', '1404/7/23', '0', '0', '371819849', 'edit'),
(39, 7498452, 'آنتی هیستامین', '1404/7/23', '0', '0', '371819849', 'edit'),
(40, 97846, 'امپرازول 500', '1404/7/23', '0', '0', '371819849', 'edit'),
(41, 97846, 'امپرازول 500', '1404/7/23', '100', '0', '371819849', 'edit'),
(42, 97846, 'امپرازول 500', '1404/7/23', '1', '0', '371819849', 'edit'),
(43, 97846, 'امپرازول 500', '1404/7/23', '0', '0', '371819849', 'edit'),
(44, 97846, 'امپرازول 500', '1404/7/23', '0', '0', '371819849', 'edit'),
(45, 7498452, 'آنتی هیستامین', '1404/7/23', '0', '0', '371819849', 'edit'),
(46, 34543, 'dfsgfa', '1404/7/23', '54354', '99', '0371819849', 'active'),
(47, 34543, 'dfsgfa', '1404/7/23', '0', '0', '371819849', 'edit'),
(48, 97846, 'امپرازول 500', '1404/7/23', '0', '0', '371819849', 'edit'),
(49, 34543, 'dfsgfa', '1404/7/23', '0', '0', '371819849', 'edit'),
(50, 34543, 'dfsgfa', '1404/7/23', '0', '0', '371819849', 'edit'),
(51, 34543, 'dfsgfa', '1404/7/23', '0', '0', '371819849', 'edit'),
(52, 34543, 'dfsgfa', '1404/7/23', '10', '0', '371819849', 'edit'),
(53, 7498452, 'آنتی هیستامین', '1404/7/23', '0', '0', '371819849', 'edit'),
(54, 97846, 'امپرازول 500', '1404/7/23', '23', '0', '371819849', 'edit'),
(55, 7498452, 'آنتی هیستامین', '1404/7/23', '0', '0', '371819849', 'edit'),
(56, 34543, 'dfsgfa', '1404/7/23', '0', '13', '371819849', 'edit'),
(57, 34543, 'dfsgfa', '1404/7/26', '2', '0', '371819849', 'edit'),
(58, 34543, 'dfsgfa', '1404/7/26', '3', '2', '371819849', 'edit'),
(59, 4563, 'آنتی هیستامین2', '1404/7/26', '22', '', '371819849', 'active'),
(60, 8516198, 'ژلوفن', '1404/7/28', '36', '', '0371819849', 'active'),
(61, 981747, 'چرک خشک کن 500', '1404/7/28', '13', '', '0371819849', 'active'),
(62, 9819871, 'چرک خشک کن 250', '1404/7/28', '22', '', '0371819849', 'active'),
(63, 874877, 'پرگابالین', '1404/7/28', '150', '', '0371819849', 'active'),
(64, 81987, 'استامینوفن', '1404/7/28', '1700', '', '0371819849', 'active'),
(65, 97328, 'کلونفلاک', '1404/8/2', '0', '32', '0371819849', 'edit'),
(66, 97328, 'کلونفلاک', '1404/8/2', '80', '0', '0371819849', 'edit'),
(67, 4563, 'آنتی هیستامین2', '1404/8/4', '22', '', '', 'leave'),
(68, 34543, 'dfsgfa', '1404/8/4', '3', '', '', 'leave'),
(69, 0, '', '1404/8/4', '', '', '0371819849', 'leave'),
(70, 7498452, 'آنتی هیستامین', '1404/8/4', '25', '0', '58198747', 'edit');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `user_id` varchar(11) DEFAULT NULL,
  `dashboard` tinyint(1) NOT NULL,
  `personnel` tinyint(1) NOT NULL,
  `psichology` tinyint(1) NOT NULL,
  `pharmacy` tinyint(1) NOT NULL,
  `repository` tinyint(1) NOT NULL,
  `setting` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `user_id`, `dashboard`, `personnel`, `psichology`, `pharmacy`, `repository`, `setting`) VALUES
(1, '0371819849', 1, 1, 1, 1, 1, 1),
(4, '58198747', 0, 1, 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE `personnel` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `medal` int(11) NOT NULL,
  `code` varchar(11) NOT NULL,
  `personnel_code` varchar(13) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `birth` varchar(12) NOT NULL,
  `dispatch` varchar(12) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `type` enum('cadre','soldier') NOT NULL,
  `status` enum('active','leave','mission') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`id`, `name`, `medal`, `code`, `personnel_code`, `city`, `birth`, `dispatch`, `phone`, `type`, `status`) VALUES
(1, 'حبیب بهرامی', 1, '0371819849', '45', 'قم', '2025-02-03', '2025-02-02', 2147483647, 'soldier', 'active'),
(24, 'محمد پورقلی', 6, '58198747', '564165', 'مریوان', '۱۴۰۴/۰۷/۱۶', '۱۴۰۴/۰۷/۰۹', 889419841, 'cadre', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `psichology`
--

CREATE TABLE `psichology` (
  `id` int(11) NOT NULL,
  `date` varchar(10) DEFAULT NULL,
  `guards` text DEFAULT NULL,
  `cadre_interview` text DEFAULT NULL,
  `soldier_interview` text DEFAULT NULL,
  `drivers` text DEFAULT NULL,
  `dispatch` text DEFAULT NULL,
  `groupb` text DEFAULT NULL,
  `newbie` text DEFAULT NULL,
  `education` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `psichology`
--

INSERT INTO `psichology` (`id`, `date`, `guards`, `cadre_interview`, `soldier_interview`, `drivers`, `dispatch`, `groupb`, `newbie`, `education`) VALUES
(1, '۱۴۰۳/۱۲/۰۱', '25', '45', '45', '25', '25', '25', '25', 25),
(4, '۱۴۰۴/۰۷/۰۹', '514', '515', '154', '154', '154', '15', '555', 415),
(5, '۱۴۰۴/۰۷/۰۱', '25', '166', '154', '36', '154', '25', '4563', 564);

-- --------------------------------------------------------

--
-- Table structure for table `repository`
--

CREATE TABLE `repository` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` int(11) NOT NULL,
  `organization_number` int(11) NOT NULL,
  `real_number` int(11) NOT NULL,
  `burrow_number` int(11) NOT NULL,
  `repository` enum('1','2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `repository`
--

INSERT INTO `repository` (`id`, `name`, `code`, `organization_number`, `real_number`, `burrow_number`, `repository`) VALUES
(2, 'ویلچر', 97329, 1200, 21, 3, '1'),
(3, 'برانکارد', 97328, 534, 25, 3, '2');

-- --------------------------------------------------------

--
-- Table structure for table `repository_reports`
--

CREATE TABLE `repository_reports` (
  `id` int(11) NOT NULL,
  `code` varchar(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` varchar(12) NOT NULL,
  `number` int(11) NOT NULL,
  `old_number` int(11) NOT NULL,
  `burrow_number` int(11) NOT NULL,
  `user_id` varchar(12) NOT NULL,
  `status` enum('active','leave','edit') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `repository_reports`
--

INSERT INTO `repository_reports` (`id`, `code`, `name`, `date`, `number`, `old_number`, `burrow_number`, `user_id`, `status`) VALUES
(6, '97328', '', '2025-02-16', 0, 0, 0, '0371819849', 'leave'),
(9, '45354', '', '0000-00-00', 25, 25, 3, '0371819849', 'leave'),
(11, '97328', '', '0000-00-00', 34, 33, 600, '0371819849', 'edit'),
(17, '97329', 'ویلچر', '1404/8/3', 21, 25, 3, '0371819849', 'edit'),
(18, '97328', 'برانکارد', '1404/8/4', 33, 32, 600, '0371819849', 'edit'),
(19, '97328', '', '1404/8/4', 33, 0, 600, '0371819849', 'leave'),
(20, '97328', 'برانکارد', '1404/8/4', 25, 0, 3, '0371819849', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `code` varchar(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `code`, `username`, `password_hash`) VALUES
(1, '0371819849', 'system', '21232f297a57a5a743894a0e4a801fc3'),
(4, '58198747', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `user_login_details`
--

CREATE TABLE `user_login_details` (
  `id` int(11) NOT NULL,
  `code` varchar(12) NOT NULL,
  `login_date` varchar(11) NOT NULL,
  `login_time` time NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `user_login_details`
--

INSERT INTO `user_login_details` (`id`, `code`, `login_date`, `login_time`, `ip_address`, `user_agent`) VALUES
(1, '371819849', '2025-02-10', '09:11:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36'),
(2, '371819849', '2025-02-11', '05:05:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36'),
(3, '371819849', '2025-02-13', '09:20:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36'),
(4, '371819849', '2025-02-14', '08:50:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36'),
(5, '371819849', '2025-02-15', '08:10:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(6, '371819849', '2025-02-16', '10:38:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(7, '371819849', '2025-02-17', '05:50:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(8, '371819849', '2025-02-28', '05:02:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(9, '371819849', '2025-02-28', '05:03:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(10, '371819849', '2025-03-01', '10:24:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36'),
(11, '371819849', '2025-10-12', '11:26:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(12, '371819849', '2025-10-12', '11:27:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(13, '371819849', '2025-10-12', '19:18:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(14, '371819849', '2025-10-13', '16:19:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(15, '371819849', '2025-10-13', '16:21:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(16, '371819849', '2025-10-13', '16:22:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(17, '371819849', '2025-10-13', '16:23:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(18, '371819849', '2025-10-13', '16:23:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(19, '371819849', '2025-10-13', '16:23:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(20, '371819849', '2025-10-13', '16:23:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(21, '371819849', '2025-10-13', '16:25:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(22, '371819849', '2025-10-13', '16:41:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(23, '371819849', '2025-10-13', '16:41:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(24, '371819849', '2025-10-13', '16:42:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(25, '371819849', '2025-10-13', '16:43:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(26, '371819849', '2025-10-13', '16:44:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(27, '371819849', '2025-10-13', '16:47:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(28, '371819849', '2025-10-13', '16:47:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(29, '371819849', '2025-10-13', '16:48:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(30, '371819849', '2025-10-13', '16:48:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(31, '371819849', '2025-10-13', '16:50:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(32, '371819849', '2025-10-13', '16:52:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(33, '371819849', '2025-10-13', '16:52:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(34, '371819849', '2025-10-13', '16:53:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(35, '371819849', '2025-10-13', '16:53:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(36, '371819849', '2025-10-13', '16:54:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(37, '371819849', '2025-10-13', '16:54:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(38, '371819849', '2025-10-13', '16:54:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(39, '371819849', '2025-10-13', '16:54:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(40, '371819849', '2025-10-13', '16:54:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(41, '371819849', '2025-10-13', '16:55:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(42, '371819849', '2025-10-13', '16:56:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(43, '371819849', '2025-10-13', '16:56:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(44, '371819849', '2025-10-13', '16:56:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(45, '371819849', '2025-10-13', '16:56:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(46, '371819849', '2025-10-13', '16:57:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(47, '371819849', '2025-10-13', '16:57:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(48, '371819849', '2025-10-13', '16:58:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(49, '371819849', '2025-10-13', '16:58:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(50, '371819849', '2025-10-13', '16:59:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(51, '371819849', '2025-10-13', '16:59:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(52, '371819849', '2025-10-13', '16:59:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(53, '371819849', '2025-10-13', '16:59:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(54, '371819849', '2025-10-13', '16:59:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(55, '371819849', '2025-10-13', '16:59:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(56, '371819849', '2025-10-13', '16:59:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(57, '371819849', '2025-10-13', '17:00:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(58, '371819849', '2025-10-13', '17:01:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(59, '371819849', '2025-10-13', '17:02:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(60, '371819849', '2025-10-13', '17:02:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(61, '371819849', '2025-10-13', '17:03:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(62, '371819849', '2025-10-13', '17:03:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(63, '371819849', '2025-10-13', '17:04:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(64, '371819849', '2025-10-13', '17:08:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(65, '371819849', '2025-10-13', '17:08:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(66, '371819849', '2025-10-13', '17:10:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(67, '371819849', '2025-10-13', '17:11:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(68, '371819849', '2025-10-13', '17:11:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(69, '371819849', '2025-10-13', '17:11:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(70, '371819849', '2025-10-13', '17:12:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(71, '371819849', '2025-10-13', '17:13:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(72, '371819849', '2025-10-13', '17:13:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(73, '371819849', '2025-10-13', '17:13:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(74, '371819849', '2025-10-13', '17:14:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(75, '371819849', '2025-10-13', '17:14:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(76, '371819849', '2025-10-13', '17:14:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(77, '371819849', '2025-10-13', '17:15:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(78, '371819849', '2025-10-13', '17:16:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(79, '371819849', '2025-10-13', '17:17:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(80, '371819849', '2025-10-13', '17:17:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(81, '371819849', '2025-10-13', '17:17:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(82, '371819849', '2025-10-13', '17:17:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(83, '371819849', '2025-10-13', '17:21:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(84, '371819849', '2025-10-13', '17:21:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(85, '371819849', '2025-10-13', '17:21:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(86, '371819849', '2025-10-13', '17:22:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(87, '371819849', '2025-10-13', '17:22:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(88, '371819849', '2025-10-13', '17:24:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(89, '371819849', '2025-10-13', '17:25:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(90, '371819849', '2025-10-13', '17:25:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(91, '371819849', '2025-10-13', '17:26:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(92, '371819849', '2025-10-13', '17:28:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(93, '371819849', '2025-10-13', '17:31:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(94, '371819849', '2025-10-13', '17:31:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(95, '371819849', '2025-10-13', '17:31:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(96, '371819849', '2025-10-13', '17:32:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(97, '371819849', '2025-10-13', '17:32:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(98, '371819849', '2025-10-13', '17:33:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(99, '371819849', '2025-10-13', '17:33:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(100, '371819849', '2025-10-13', '17:33:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(101, '371819849', '2025-10-13', '17:34:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(102, '371819849', '2025-10-13', '17:34:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(103, '371819849', '2025-10-13', '17:35:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(104, '371819849', '2025-10-13', '17:35:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(105, '371819849', '2025-10-13', '17:35:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(106, '371819849', '2025-10-13', '17:36:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(107, '371819849', '2025-10-13', '17:36:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(108, '371819849', '2025-10-13', '17:36:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(109, '371819849', '2025-10-13', '17:36:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(110, '371819849', '2025-10-13', '17:37:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(111, '371819849', '2025-10-13', '17:38:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(112, '371819849', '2025-10-13', '17:57:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(113, '371819849', '2025-10-13', '17:58:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(114, '371819849', '2025-10-13', '17:59:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(115, '371819849', '2025-10-13', '17:59:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(116, '371819849', '2025-10-13', '17:59:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(117, '371819849', '2025-10-13', '18:00:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(118, '371819849', '2025-10-13', '18:00:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(119, '371819849', '2025-10-13', '18:00:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(120, '371819849', '2025-10-13', '18:01:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(121, '371819849', '2025-10-13', '18:05:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(122, '371819849', '2025-10-13', '18:14:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(123, '371819849', '2025-10-13', '19:05:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(124, '371819849', '1404/7/21', '19:44:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(125, '371819849', '1404/7/22', '01:02:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(126, '371819849', '1404/7/22', '01:10:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(127, '371819849', '1404/7/22', '12:57:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(128, '371819849', '1404/7/22', '12:58:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(129, '371819849', '1404/7/22', '20:43:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(130, '371819849', '1404/7/22', '20:56:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(131, '371819849', '1404/7/25', '15:25:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(132, '371819849', '1404/7/26', '15:38:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(133, '371819849', '1404/7/27', '20:38:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(134, '371819849', '1404/7/28', '10:26:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(135, '371819849', '1404/7/28', '10:28:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(136, '0371819849', '1404/7/28', '10:59:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(137, '0371819849', '1404/7/28', '11:02:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(138, '0371819849', '1404/7/28', '11:07:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(139, '0371819849', '1404/7/28', '12:00:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(140, '0371819849', '1404/7/29', '23:40:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(141, '0371819849', '1404/7/29', '23:58:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(142, '0371819849', '1404/8/1', '16:45:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(143, '0371819849', '1404/8/2', '00:02:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(144, '0371819849', '1404/8/2', '00:26:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(145, '0371819849', '1404/8/3', '05:31:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(146, '0371819849', '1404/8/3', '07:57:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(147, '0371819849', '1404/8/3', '22:27:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(148, '0371819849', '1404/8/4', '13:08:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(149, '0371819849', '1404/8/4', '14:18:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(150, '0371819849', '1404/8/4', '14:18:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(151, '0371819849', '1404/8/4', '14:23:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(152, '0371819849', '1404/8/4', '14:23:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(153, '0371819849', '1404/8/4', '14:23:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(154, '0371819849', '1404/8/4', '14:39:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(155, '0371819849', '1404/8/4', '14:39:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(156, '0371819849', '1404/8/4', '14:43:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(157, '0371819849', '1404/8/4', '14:44:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(158, '0371819849', '1404/8/4', '14:49:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(159, '0371819849', '1404/8/4', '14:50:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(160, '58198747', '1404/8/4', '14:51:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(161, '0371819849', '1404/8/4', '14:51:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(162, '0371819849', '1404/8/4', '15:04:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(163, '0371819849', '1404/8/4', '15:36:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(164, '0371819849', '1404/8/4', '18:07:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(165, '58198747', '1404/8/4', '18:44:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(166, '58198747', '1404/8/4', '18:46:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(167, '0371819849', '1404/8/4', '18:47:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36'),
(168, '58198747', '1404/8/4', '18:48:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/141.0.0.0 Safari/537.36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drugs`
--
ALTER TABLE `drugs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drugs_reports`
--
ALTER TABLE `drugs_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `psichology`
--
ALTER TABLE `psichology`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repository`
--
ALTER TABLE `repository`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repository_reports`
--
ALTER TABLE `repository_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_login_details`
--
ALTER TABLE `user_login_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drugs`
--
ALTER TABLE `drugs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `drugs_reports`
--
ALTER TABLE `drugs_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `psichology`
--
ALTER TABLE `psichology`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `repository`
--
ALTER TABLE `repository`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `repository_reports`
--
ALTER TABLE `repository_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_login_details`
--
ALTER TABLE `user_login_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
