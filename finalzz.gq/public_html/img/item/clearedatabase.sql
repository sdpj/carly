-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql302.byetcluster.com
-- Generation Time: May 30, 2021 at 06:12 PM
-- Server version: 5.6.48-88.0
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hp_28747590_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `threadId` int(11) NOT NULL,
  `postBy` text NOT NULL,
  `postText` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`threadId`, `postBy`, `postText`) VALUES
(39, 'test', 'Me pls'),
(36, 'Wow', 'This is a clear copy..'),
(54, 'MegaDrive', 'brick planet remake thingy'),
(54, 'Wow', 'This isnt even needed and is pretty much clearly copied'),
(54, 'Warlord', 'i think this is the start of blox city, we went back in time bois'),
(56, 'Wow', 'me too'),
(56, 'Wow', 'me too'),
(56, 'Warlord', ''),
(74, 'niceguy1000', 'yessssss'),
(2, 'drifttwo', '<script>alert(\"subscribe to SkateAlert on YouTube\")</script>'),
(2, 'drifttwo', 'I used his same xss and it still works...'),
(3, 'drifttwo', '<script>alert(\"Please fix this xss.\")</script>'),
(2, 'ihascancer', 'Yesh, Im mlg'),
(6, 'niceguy1000', 'lol'),
(13, 'Babyhamsta', 'testr');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
