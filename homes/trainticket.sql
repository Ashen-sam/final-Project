-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 04, 2024 at 07:29 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trainticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookingdata`
--

DROP TABLE IF EXISTS `bookingdata`;
CREATE TABLE IF NOT EXISTS `bookingdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `passenger` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `setLoc` varchar(255) NOT NULL,
  `arrLoc` varchar(255) NOT NULL,
  `startdate` date NOT NULL,
  `returndate` date DEFAULT NULL,
  `trainClass` varchar(255) NOT NULL,
  `people` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookingdata`
--

INSERT INTO `bookingdata` (`id`, `passenger`, `email`, `phone`, `setLoc`, `arrLoc`, `startdate`, `returndate`, `trainClass`, `people`) VALUES
(1, 'dfdfdf', 'thiwankadissanayake42@gmail.com', 3434344, 'Demodera', 'Ambewela', '2024-02-21', NULL, 'Second Class', 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
