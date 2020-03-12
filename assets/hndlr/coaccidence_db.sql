-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2020 at 04:36 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coaccidence_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `list`
--

CREATE TABLE `list` (
  `ls_id` int(11) NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `list`
--

INSERT INTO `list` (`ls_id`, `title`, `created_at`) VALUES
(1, 'BSIT-4', '2020-03-05 20:12:28'),
(35, 'CSV Test', '2020-03-09 14:41:49');

-- --------------------------------------------------------

--
-- Table structure for table `names`
--

CREATE TABLE `names` (
  `nm_id` int(11) NOT NULL,
  `ls_id` int(11) DEFAULT NULL,
  `given` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `names`
--

INSERT INTO `names` (`nm_id`, `ls_id`, `given`, `surname`, `status`) VALUES
(7, 35, 'Aidan', 'Miranda', '0'),
(8, 35, 'Bert', 'Hurley', '0'),
(9, 35, 'Flynn', 'Campos', '0'),
(10, 35, 'Tanya', 'Beasley', '0'),
(11, 35, 'Edan', 'Schroeder', '0'),
(12, 35, 'Freya', 'Price', '0'),
(13, 35, 'Phoebe', 'Hudson', '0'),
(14, 35, 'Keefe', 'Wells', '0'),
(15, 35, 'Orla', 'Blair', '0'),
(16, 35, 'Camden', 'Watson', '0'),
(17, 1, 'Neil Francis', 'Bayna', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `list`
--
ALTER TABLE `list`
  ADD PRIMARY KEY (`ls_id`);

--
-- Indexes for table `names`
--
ALTER TABLE `names`
  ADD PRIMARY KEY (`nm_id`),
  ADD KEY `ls_id` (`ls_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `list`
--
ALTER TABLE `list`
  MODIFY `ls_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `names`
--
ALTER TABLE `names`
  MODIFY `nm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `names`
--
ALTER TABLE `names`
  ADD CONSTRAINT `ls_id_ref_list` FOREIGN KEY (`ls_id`) REFERENCES `list` (`ls_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
