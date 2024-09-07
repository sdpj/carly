-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql201.byetcluster.com
-- Generation Time: Feb 05, 2017 at 07:07 PM
-- Server version: 5.6.34-79.1
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rfgd_19602460_db`
--

-- Table structure for table `Games`
--

CREATE TABLE IF NOT EXISTS `Games` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` longtext NOT NULL,
  `File` longtext NOT NULL,
  `Type` longtext NOT NULL,
  `Price` int(11) NOT NULL,
  `CreatorID` int(11) NOT NULL,
  `saletype` varchar(1337) NOT NULL DEFAULT 'regular',
  `numbersales` varchar(50) NOT NULL DEFAULT 'regular',
  `numberstock` varchar(50) NOT NULL DEFAULT 'regular',
  `sell` varchar(50) NOT NULL DEFAULT 'yes',
  `ns` varchar(100) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `code1` longtext NOT NULL,
  `code2` longtext NOT NULL,
  `Description` longtext NOT NULL,
  `CreationTime` longtext NOT NULL,
  `store` varchar(1337) NOT NULL DEFAULT 'user',
  `itemDeleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
