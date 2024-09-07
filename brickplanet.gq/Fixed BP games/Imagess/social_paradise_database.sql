-- phpMyAdmin SQL Dump
-- version 4.0.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 05, 2013 at 06:26 PM
-- Server version: 5.1.70-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `avaworld_dbTOCLEAR`
--

-- --------------------------------------------------------

--
-- Table structure for table `Ads`
--

CREATE TABLE IF NOT EXISTS `Ads` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Image` longtext NOT NULL,
  `Link` longtext NOT NULL,
  `TimeRun` longtext NOT NULL,
  `Active` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Badges`
--

CREATE TABLE IF NOT EXISTS `Badges` (
  `UserID` int(11) NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Position` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Banner`
--

CREATE TABLE IF NOT EXISTS `Banner` (
  `Text` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Banner`
--

INSERT INTO `Banner` (`Text`) VALUES
('');

-- --------------------------------------------------------

--
-- Table structure for table `BlogPosts`
--

CREATE TABLE IF NOT EXISTS `BlogPosts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` longtext NOT NULL,
  `Body` longtext NOT NULL,
  `Poster` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Configuration`
--

CREATE TABLE IF NOT EXISTS `Configuration` (
  `Register` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Configuration`
--

INSERT INTO `Configuration` (`Register`) VALUES
('true');

-- --------------------------------------------------------

--
-- Table structure for table `down`
--

CREATE TABLE IF NOT EXISTS `down` (
  `down` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `forumtags`
--

CREATE TABLE IF NOT EXISTS `forumtags` (
  `id` varchar(50) NOT NULL,
  `text` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `userid` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `FRs`
--

CREATE TABLE IF NOT EXISTS `FRs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SenderID` int(11) NOT NULL,
  `ReceiveID` int(11) NOT NULL,
  `Active` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `GroupAllies`
--

CREATE TABLE IF NOT EXISTS `GroupAllies` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupID` int(11) NOT NULL,
  `OtherGroupID` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=102 ;

-- --------------------------------------------------------

--
-- Table structure for table `GroupEnemies`
--

CREATE TABLE IF NOT EXISTS `GroupEnemies` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupID` int(11) NOT NULL,
  `OtherGroupID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Table structure for table `GroupMembers`
--

CREATE TABLE IF NOT EXISTS `GroupMembers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Groups`
--

CREATE TABLE IF NOT EXISTS `Groups` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` longtext NOT NULL,
  `Description` longtext NOT NULL,
  `OwnerID` int(11) NOT NULL,
  `Logo` longtext NOT NULL,
  `LogoActive` int(11) NOT NULL DEFAULT '0',
  `GroupMembers` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `GroupsLogo`
--

CREATE TABLE IF NOT EXISTS `GroupsLogo` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupID` int(11) NOT NULL,
  `Logo` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

-- --------------------------------------------------------

--
-- Table structure for table `GroupsPending`
--

CREATE TABLE IF NOT EXISTS `GroupsPending` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` longtext NOT NULL,
  `Description` longtext NOT NULL,
  `OwnerID` int(11) NOT NULL,
  `Logo` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=149 ;

-- --------------------------------------------------------

--
-- Table structure for table `GroupWall`
--

CREATE TABLE IF NOT EXISTS `GroupWall` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GroupID` int(11) NOT NULL,
  `PosterID` int(11) NOT NULL,
  `Message` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Inventory`
--

CREATE TABLE IF NOT EXISTS `Inventory` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `GameID` int(11) NOT NULL,
  `File` longtext NOT NULL,
  `Type` longtext NOT NULL,
  `code1` longtext NOT NULL,
  `code2` longtext NOT NULL,
  `SerialNum` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `IPBans`
--

CREATE TABLE IF NOT EXISTS `IPBans` (
  `IP` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `IPBans`
--

INSERT INTO `IPBans` (`IP`) VALUES
('');

-- --------------------------------------------------------

--
-- Table structure for table `GameComments`
--

CREATE TABLE IF NOT EXISTS `GameComments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `GameID` int(11) NOT NULL,
  `Post` longtext NOT NULL,
  `time` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `GameDrafts`
--

CREATE TABLE IF NOT EXISTS `GameDrafts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` longtext NOT NULL,
  `File` longtext NOT NULL,
  `Type` longtext NOT NULL,
  `Price` longtext NOT NULL,
  `CreatorID` int(11) NOT NULL,
  `saletype` varchar(1337) NOT NULL,
  `numbersales` int(11) NOT NULL,
  `numberstock` int(11) NOT NULL,
  `sell` varchar(1337) NOT NULL DEFAULT 'yes',
  `Description` longtext NOT NULL,
  `CreationTime` longtext NOT NULL,
  `store` varchar(1337) NOT NULL DEFAULT 'regular',
  `timemake` longtext NOT NULL,
  `ItemDeleted` int(11) NOT NULL,
  `SalePrices` int(11) NOT NULL,
  `NumberSold` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1591 ;

-- --------------------------------------------------------

--
-- Table structure for table `Games`
--

CREATE TABLE IF NOT EXISTS `Games` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` longtext NOT NULL,
  `File` longtext NOT NULL,
  `Type` longtext NOT NULL,
  `Price` longtext NOT NULL,
  `saletype` varchar(1337) NOT NULL,
  `numbersales` int(11) NOT NULL,
  `numberstock` int(11) NOT NULL,
  `sell` varchar(1337) NOT NULL DEFAULT 'yes',
  `Description` longtext NOT NULL,
  `CreationTime` longtext NOT NULL,
  `store` varchar(1337) NOT NULL DEFAULT 'regular',
  `timemake` longtext NOT NULL,
  `GameDeleted` int(11) NOT NULL DEFAULT '0',
  `SalePrices` int(11) NOT NULL DEFAULT '0',
  `NumberSold` int(11) NOT NULL,
  `CreatorID` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Logs`
--

CREATE TABLE IF NOT EXISTS `Logs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Message` longtext NOT NULL,
  `Page` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Maintenance`
--

CREATE TABLE IF NOT EXISTS `Maintenance` (
  `Status` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Maintenance`
--

INSERT INTO `Maintenance` (`Status`) VALUES
('false');

-- --------------------------------------------------------

--
-- Table structure for table `News`
--

CREATE TABLE IF NOT EXISTS `News` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` longtext NOT NULL,
  `Title` longtext NOT NULL,
  `body` longtext NOT NULL,
  `PosterID` int(11) NOT NULL,
  `Viewed` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `objectlist`
--

CREATE TABLE IF NOT EXISTS `objectlist` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `height` varchar(50) NOT NULL,
  `width` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `objectlist`
--

INSERT INTO `objectlist` (`id`, `name`, `image`, `height`, `width`) VALUES
(1, 'Brick', 'brick.png', '30', '30'),
(2, 'UA Flag', 'uaflag.png', '149', '108');

-- --------------------------------------------------------

--
-- Table structure for table `PMs`
--

CREATE TABLE IF NOT EXISTS `PMs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SenderID` int(11) NOT NULL,
  `ReceiveID` int(11) NOT NULL,
  `Title` longtext NOT NULL,
  `Body` longtext NOT NULL,
  `time` int(11) NOT NULL,
  `LookMessage` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `PurchaseLog`
--

CREATE TABLE IF NOT EXISTS `PurchaseLog` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Game` longtext NOT NULL,
  `TypeStore` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Referrals`
--

CREATE TABLE IF NOT EXISTS `Referrals` (
  `ReferredID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Replies`
--

CREATE TABLE IF NOT EXISTS `Replies` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Body` longtext NOT NULL,
  `PosterID` int(11) NOT NULL,
  `tid` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Reports`
--

CREATE TABLE IF NOT EXISTS `Reports` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Message` longtext NOT NULL,
  `OffenseID` longtext NOT NULL,
  `Link` longtext NOT NULL,
  `IP` longtext NOT NULL,
  `Content` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=117 ;

-- --------------------------------------------------------

--
-- Table structure for table `Sales`
--

CREATE TABLE IF NOT EXISTS `Sales` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `Amount` int(11) NOT NULL,
  `GameID` int(11) NOT NULL,
  `SerialNum` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2721 ;

--
-- Dumping data for table `Sales`
--

INSERT INTO `Sales` (`ID`, `UserID`, `Amount`, `GameID`, `SerialNum`) VALUES
(2684, 3325, 2147483647, 2474, 4),
(2683, 3325, 2147483647, 2475, 3),
(2682, 3324, 666666666, 2474, 5),
(2679, 3325, 2147483647, 2473, 7),
(2678, 3325, 2147483647, 2456, 4),
(2677, 3325, 2147483647, 2453, 2),
(2676, 3325, 2147483647, 2447, 4),
(2675, 3325, 2147483647, 2472, 5),
(2674, 3325, 2147483647, 2450, 4),
(2673, 3320, 350000, 2447, 2),
(2672, 3320, 30000, 2459, 1),
(2671, 3320, 100000, 2458, 1),
(2687, 3360, 25000, 2483, 5),
(2688, 3373, 90, 2542, 5),
(2689, 3373, 600, 2536, 5),
(2703, 4, 13333337, 2605, 0),
(2720, 3382, 9999999, 2629, 1),
(2697, 3385, 300000, 2590, 3),
(2701, 3427, 10000, 2590, 0),
(2707, 3426, 5000, 2612, 5),
(2708, 3402, 5000, 2612, 2),
(2712, 3414, 5000, 2613, 3),
(2719, 3408, 5000, 2582, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Staff`
--

CREATE TABLE IF NOT EXISTS `Staff` (
  `Username` text NOT NULL,
  `Rank` int(11) NOT NULL AUTO_INCREMENT,
  `Job` text NOT NULL,
  PRIMARY KEY (`Rank`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Threads`
--

CREATE TABLE IF NOT EXISTS `Threads` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` longtext NOT NULL,
  `Body` longtext NOT NULL,
  `PosterID` int(11) NOT NULL,
  `OriginalTitle` longtext NOT NULL,
  `OriginalBody` int(11) NOT NULL,
  `Locked` int(11) NOT NULL DEFAULT '0',
  `Type` varchar(1337) NOT NULL DEFAULT 'regular',
  `tid` int(11) NOT NULL,
  `bump` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tools`
--

CREATE TABLE IF NOT EXISTS `tools` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tools`
--

INSERT INTO `tools` (`id`, `name`, `image`) VALUES
(1, 'Build Tool', 'build.png');

-- --------------------------------------------------------

--
-- Table structure for table `Topics`
--

CREATE TABLE IF NOT EXISTS `Topics` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TopicName` longtext NOT NULL,
  `TopicDescription` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `TradeDrafts`
--

CREATE TABLE IF NOT EXISTS `TradeDrafts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SenderID` int(11) NOT NULL,
  `ReceiveID` int(11) NOT NULL,
  `GetID1` int(11) NOT NULL,
  `GetID2` int(11) NOT NULL,
  `GetID3` int(11) NOT NULL,
  `GetID4` int(11) NOT NULL,
  `GetID5` int(11) NOT NULL,
  `LoseID1` int(11) NOT NULL,
  `LoseID2` int(11) NOT NULL,
  `LoseID3` int(11) NOT NULL,
  `LoseID4` int(11) NOT NULL,
  `LoseID5` int(11) NOT NULL,
  `tradeExpire` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `TradeRequests`
--

CREATE TABLE IF NOT EXISTS `TradeRequests` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SendorID` int(11) NOT NULL,
  `RecieverID` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Bux` int(11) NOT NULL,
  `RequestedGame` longtext COLLATE utf8_unicode_ci NOT NULL,
  `RequestedFile` int(11) NOT NULL,
  `Gems` int(11) NOT NULL,
  `Discount` int(11) NOT NULL,
  `TradeFile` int(11) NOT NULL,
  `TradeGame` int(11) NOT NULL,
  `Read` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `UserIPs`
--

CREATE TABLE IF NOT EXISTS `UserIPs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `IP` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `UserGameComments`
--

CREATE TABLE IF NOT EXISTS `UserGameComments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserID` int(11) NOT NULL,
  `GameID` int(11) NOT NULL,
  `Post` longtext NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `Username` longtext NOT NULL,
  `Password` longtext NOT NULL,
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Rank` int(11) NOT NULL DEFAULT '0',
  `PowerAdmin` varchar(1337) NOT NULL DEFAULT 'false',
  `Description` varchar(20000) NOT NULL DEFAULT 'none',
  `Email` longtext NOT NULL,
  `IP` longtext NOT NULL,
  `visitTick` longtext NOT NULL,
  `expireTime` longtext NOT NULL,
  `PowerGame` varchar(1337) NOT NULL DEFAULT 'false',
  `PowerImageModerator` varchar(1337) NOT NULL DEFAULT 'false',
  `PowerForumModerator` varchar(1337) NOT NULL DEFAULT 'false',
  `PowerArtist` varchar(1337) NOT NULL DEFAULT 'false',
  `PowerMegaModerator` varchar(1337) NOT NULL DEFAULT 'false',
  `OriginalName` longtext NOT NULL,
  `Eyes` varchar(1337) NOT NULL,
  `Mouth` varchar(1337) NOT NULL,
  `Hair` varchar(1337) NOT NULL,
  `Bottom` varchar(1337) NOT NULL,
  `Top` varchar(1337) NOT NULL,
  `Hat` varchar(1337) NOT NULL,
  `Shoes` varchar(1337) NOT NULL,
  `Accessory` varchar(1337) NOT NULL,
  `forumflood` longtext NOT NULL,
  `Bux` varchar(1337) NOT NULL DEFAULT '15',
  `Rubies` varchar(1337) NOT NULL DEFAULT '10',
  `Background` longtext NOT NULL,
  `Body` varchar(1337) NOT NULL DEFAULT 'Avatar.png',
  `Ban` int(11) NOT NULL DEFAULT '0',
  `BanType` longtext NOT NULL,
  `BanTime` longtext NOT NULL,
  `BanDescription` longtext NOT NULL,
  `BanLength` longtext NOT NULL,
  `Hash` longtext NOT NULL,
  `SuccessReferrer` int(11) NOT NULL DEFAULT '0',
  `Premium` int(11) NOT NULL DEFAULT '0',
  `PremiumExpire` longtext NOT NULL,
  `isTester` int(11) NOT NULL DEFAULT '0',
  `pviews` int(11) NOT NULL DEFAULT '0',
  `BanContent` longtext NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '0',
  `PowerTop` varchar(1337) NOT NULL DEFAULT '0',
  `vipStart` varchar(1000) NOT NULL DEFAULT '0',
  `vipEnd` varchar(100) NOT NULL DEFAULT '0',
  `vipsubscrid` varchar(50) NOT NULL DEFAULT '0',
  `adminID` varchar(3) NOT NULL DEFAULT '0',
  `room` varchar(50) NOT NULL,
  `myroomID` varchar(250) NOT NULL,
  `myroomIMG` varchar(250) NOT NULL DEFAULT 'templates/default/background.jpg	',
  `roomaccess` varchar(3) NOT NULL DEFAULT '1',
  `roomname` varchar(32) NOT NULL,
  `roommax` varchar(4) NOT NULL DEFAULT '5',
  `roomMaxStart` varchar(100) NOT NULL DEFAULT '0',
  `roomMaxEnd` varchar(100) NOT NULL DEFAULT '0',
  `roommaxsubscrid` varchar(20) NOT NULL DEFAULT '0',
  `startX` varchar(3) NOT NULL DEFAULT '100',
  `startY` varchar(3) NOT NULL DEFAULT '180',
  `music` varchar(255) NOT NULL DEFAULT 'music/index.php',
  `avatar` varchar(1000) NOT NULL,
  `avatara` varchar(250) NOT NULL,
  `avatarb` varchar(250) NOT NULL,
  `avatarc` varchar(250) NOT NULL,
  `avatar_x` varchar(10) NOT NULL,
  `avatar_y` varchar(10) NOT NULL,
  `online_time` varchar(50) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'nopic.jpg',
  `WallFlood` int(11) NOT NULL,
  `MainGroupID` int(11) NOT NULL,
  `userx` int(50) NOT NULL DEFAULT '5',
  `usery` int(50) NOT NULL DEFAULT '5',
  `gameid` int(50) NOT NULL,
  `CommentFlood` int(11) NOT NULL,
  `getBux` int(11) NOT NULL,
  `ingamenum` varchar(5) NOT NULL,
  `chatid` varchar(50) NOT NULL,
  `chatstatus` varchar(50) NOT NULL,
  `ingame` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `UserStore`
--

CREATE TABLE IF NOT EXISTS `UserStore` (
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
  `GameDeleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------







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
  `GameDeleted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
--
-- Table structure for table `Wall`
--

CREATE TABLE IF NOT EXISTS `Wall` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PosterID` int(11) NOT NULL,
  `Body` longtext NOT NULL,
  `time` longtext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
         