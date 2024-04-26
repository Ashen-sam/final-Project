-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 29, 2024 at 07:34 AM
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
-- Database: `useraccount`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(195) NOT NULL,
  `phone` int(195) NOT NULL,
  `password` varchar(195) NOT NULL,
  `gender` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `phone`, `password`, `gender`) VALUES
(1, 'Ted_TD', 'tr@gmail.com', 3434, '345', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `bookingdata`
--

DROP TABLE IF EXISTS `bookingdata`;
CREATE TABLE IF NOT EXISTS `bookingdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setLoc` varchar(225) NOT NULL,
  `arrLoc` varchar(225) NOT NULL,
  `startdate` date NOT NULL,
  `returndate` date DEFAULT NULL,
  `trainClass` varchar(255) NOT NULL,
  `people` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookingdata`
--

INSERT INTO `bookingdata` (`id`, `setLoc`, `arrLoc`, `startdate`, `returndate`, `trainClass`, `people`) VALUES
(1, 'Aluthgama', 'Bambalapitiya', '2024-03-28', '2024-03-29', 'First Class', 4),
(2, 'Batticaloa', 'Chilaw', '2024-03-28', NULL, 'First Class', 3),
(3, 'Ahangama', 'Ambewela', '2024-03-12', NULL, 'First Class', 3),
(4, 'Angulana', 'Aluthgama', '2024-03-26', NULL, 'First Class', 4),
(5, 'Colombo', 'Batticaloa', '2024-03-29', NULL, 'First Class', 2),
(6, 'Colombo', 'Batticaloa', '2024-03-27', NULL, 'First Class', 3),
(7, 'Ambewela', 'Ambalangoda', '2024-03-12', NULL, 'First Class', 4);

-- --------------------------------------------------------

--
-- Table structure for table `traindetails`
--

DROP TABLE IF EXISTS `traindetails`;
CREATE TABLE IF NOT EXISTS `traindetails` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `image` varchar(100) NOT NULL,
  `train` varchar(100) NOT NULL,
  `datetime` datetime(6) NOT NULL,
  `start_station` varchar(200) NOT NULL,
  `end_station` varchar(200) NOT NULL,
  `train_class` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `seats` int(20) NOT NULL,
  `price` int(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `traindetails`
--

INSERT INTO `traindetails` (`id`, `image`, `train`, `datetime`, `start_station`, `end_station`, `train_class`, `status`, `seats`, `price`) VALUES
(1, 'nahil-naseer-xljtGZ2-P3Y-unsplash.jpg', 'train3', '2024-02-27 19:07:00.000000', 'station2', 'station3', 'class1', 'status1', 0, 0),
(6, 'Cool wallpaper.jpg', 'train2', '2024-03-07 04:16:00.000000', 'station2', 'station1', 'class1,class2', 'status2', 0, 0),
(7, '', 'Senkadagala Menike', '2024-03-29 21:29:00.000000', 'Ambalangoda', 'Ambalangoda', 'class1,class2,class3', 'Available', 25, 2500),
(9, 'Cool wallpaper.jpg', 'Udaya Devi', '2024-03-20 09:55:00.000000', 'Colombo', 'Batticaloa', 'class1,class2,class3', 'Available', 35, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(195) NOT NULL,
  `phone` varchar(195) NOT NULL,
  `password` varchar(195) NOT NULL,
  `verify_token` varchar(195) NOT NULL,
  `verify_status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `verify_token`, `verify_status`, `created_at`) VALUES
(1, 'Ted_TD', 'thiwankadissanayake42@gmail.com', '343', '123456', '3d283ea97a55c02aa3a75a114e763764funda', 1, '2024-02-13 15:53:28');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
