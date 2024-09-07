
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 20, 2015 at 05:35 PM
-- Server version: 10.0.11-MariaDB
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `u573660077_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--
CREATE TABLE IF NOT EXISTS `accounts` (
  `Username` mediumtext NOT NULL,
  `Password` mediumtext NOT NULL,
  `Email` mediumtext NOT NULL,
  `salt` mediumtext NOT NULL,
  `Reebs` bigint(255) NOT NULL,
  `online` int(11) NOT NULL,
  `lastOnline` mediumtext NOT NULL,
  `lastOnlineMinutes` mediumtext NOT NULL,
  `lastOnlineHours` mediumtext NOT NULL,
  `status` mediumtext NOT NULL,
  `blurb` mediumtext NOT NULL,
  `profileviews` int(11) NOT NULL,
  `ShirtPath` mediumtext NOT NULL,
  `PantsPath` mediumtext NOT NULL,
  `EyesPath` mediumtext NOT NULL,
  `ShoesPath` mediumtext NOT NULL,
  `HairPath` mediumtext NOT NULL,
  `MouthPath` mediumtext NOT NULL,
  `totalposts` int(11) NOT NULL,
  `moderator` int(11) NOT NULL,
  `theme` int(11) NOT NULL,
  `administrator` int(11) NOT NULL,
  `Signature` mediumtext NOT NULL,
  `banned` int(11) NOT NULL DEFAULT '0' COMMENT '0=no; 1=warning; 2=1 day; 3=3 days; 4=7 days; 5=deleted',
  `bannedUntilDay` int(11) NOT NULL,
  `bannedUntilMonth` int(11) NOT NULL,
  `bannedUntilYear` int(11) NOT NULL,
  `bannedReason` mediumtext NOT NULL,
  `bannedFor` mediumtext NOT NULL,
  `ip` mediumtext NOT NULL,
  `floodcheck` int(11) NOT NULL,
  `Accessories` mediumtext NOT NULL,
  `Background` mediumtext NOT NULL,
  `artist` int(11) NOT NULL,
  `manager` int(11) NOT NULL,
  `Bucks` int(11) NOT NULL DEFAULT '20',
  `powerArtist` int(11) NOT NULL,
  `powerCM` int(11) NOT NULL,
  `powerDev` int(11) NOT NULL,
  `powerForumMod` int(11) NOT NULL,
  `powerHeadMod` int(11) NOT NULL,
  `powerImageMod` int(11) NOT NULL,
  `Name` mediumtext NOT NULL,
  `joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Verified` int(11) NOT NULL DEFAULT '1',
  `color` int(11) NOT NULL,
  `powerAdmin` int(11) NOT NULL,
  `Membership` int(11) NOT NULL,
  `Expire` int(255) NOT NULL,
  `Reputation` int(11) NOT NULL DEFAULT '20',
  `lastBucks` int(11) NOT NULL,
  `lastReebs` int(11) NOT NULL,
  `bannedUntil` int(11) NOT NULL,
  `hide` int(11) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chat` int(11) NOT NULL,
  `streamer` int(11) NOT NULL,
  `limiteds` int(11) NOT NULL,
  `veteran` int(11) NOT NULL,
  `statusupdate` text NOT NULL,
  `bugreporter` int(11) NOT NULL,
  `lastposter` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`Username`, `Password`, `Email`, `salt`, `Reebs`, `online`, `lastOnline`, `lastOnlineMinutes`, `lastOnlineHours`, `status`, `blurb`, `profileviews`, `ShirtPath`, `PantsPath`, `EyesPath`, `ShoesPath`, `HairPath`, `MouthPath`, `totalposts`, `moderator`, `theme`, `administrator`, `Signature`, `banned`, `bannedUntilDay`, `bannedUntilMonth`, `bannedUntilYear`, `bannedReason`, `bannedFor`, `ip`, `floodcheck`, `Accessories`, `Background`, `artist`, `manager`, `Bucks`, `lastposter`, `powerArtist`, `powerCM`, `powerDev`, `powerForumMod`, `powerHeadMod`, `powerImageMod`, `Name`, `joined`, `Verified`, `color`, `powerAdmin`, `Membership`, `Expire`, `Reputation`, `lastBucks`, `lastReebs`, `bannedUntil`, `hide`, `id`, `streamer`, `limiteds`, `veteran`, `statusupdate`, `bugreporter`) VALUES
('AvatarLife', 'df3ed1ad53c4cc2f3b5c6bdf04d33a9f094df53b', 'fawrsnipng@gmail.com', 'jBqnW?Dk9Epzpg4', 9223372036854775807, 1, '205', '26', '13', '', 'Avatar Life is the only good life!', 72, 'Shirt/120053830f2a5d7e6f42ccac09276bb07d75d528', 'Pants/e7634b775e8cea0b87398b0ea477ef8ae1c65f65', 'Default Eyes.png', '', 'Hat/5613fd87d27fd0e314f9e47a09a9352704e5748b', 'Default Smile.png', 7, 1, 1, 1, 'Oneil ~ Founder', 0, 0, 0, 0, '', '', '78.151.157.169', 1432141178, 'Accessory/99307715571227637e1dec62d0ace4dbcebaac20', 'Background/a1fa9b824d5d840e7c79811f40cf3bd3472948b0', 1, 1, 2147475410, 1, 1, 1, 1, 1, 1, '', '2015-05-19 18:17:58', 1, 1, 1, 1, 2147483647, 202146, 1432059075, 1432059075, 0, 0, 1, 1, 0, 1, '', 1),
('God', 'aa8465428e3ec522c97eb8d9b0f86b725c11e2c3', 'ricanbulljuan@gmail.com', 'tNME4yX?F1QmxQj', 5, 0, '195', '23', '23', '', '', 85, 'Shirt/28dbaea4ff5d7d1eead379ac952341deec17ad00', 'Pants/e7634b775e8cea0b87398b0ea477ef8ae1c65f65', 'Default Eyes.png', '', 'Hat/85a380bc274fedcead15b16df580a2195dbd7338', 'Default Smile.png', 5, 1, 1, 1, '-God Was here-', 0, 0, 0, 0, '', '', '73.141.75.202', 1432082010, 'Accessory/0f1c0609b8034c454087d89f02863785fb2f1240', 'Background/ba502b75bf851c4ff3832f44fb7fe4a7f1928711', 1, 1, 1508, 11, 1, 1, 1, 1, 1, '', '2015-05-19 18:19:15', 1, 1, 1, 1, 2147483647, 44, 1432059153, 1432059153, 0, 0, 2, 1, 0, 1, '', 1),
('Exodite', 'a1ba31d3828f1f1e91c5e9ffc264c12ee76abc60', 'thestealthchaos@gmail.com', 'QG?4vD!AHyx?WYk', 5, 1, '205', '23', '13', '', 'Exodite | GFX Designer\r\n\r\nI''m a friendly typical user:\r\nI''ll accept via friend requests and if you wish for any requests feel free to via private message,\r\nI am also a good friend with the founder of the site.\r\n', 11, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Hat/975c538f01f648df326960a118548fac5daa94cb', 'Default Smile.png', 2, 0, 0, 0, '~Exodite', 0, 0, 0, 0, '', '', '86.168.70.178', 1432141278, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2015-05-19 18:19:21', 1, 0, 0, 0, 0, 20, 1432059160, 1432059160, 0, 0, 3, 0, 0, 0, 'Applied for moderation position awaiting the response.', 0),
('Admin', 'fe278c2118bc695383fbef383cc42e7a2c9f66d5', 'gavinsherer98@gmail.com', 'irq0k#VjTsE85nL', 5, 1, '205', '28', '13', '', '', 21, 'Shirt/4ad42ec5cd41001a6211eafb93ce929b85b47020', 'Pants/9a872d2c5938ea3f4512c45f976f58722935a967', 'Default Eyes.png', '', 'Hat/5613fd87d27fd0e314f9e47a09a9352704e5748b', 'Default Smile.png', 0, 1, 1, 1, '', 0, 0, 0, 0, '', '', '174.49.9.182', 0, 'Accessory/45df5a71d1443e4c132991cabca08b95c584fefa', '', 1, 1, 299895, 1, 1, 1, 1, 1, 1, '', '2015-05-19 18:25:20', 1, 1, 1, 1, 2147483647, 20235, 1432059520, 1432059520, 0, 0, 4, 1, 0, 1, '', 1),
('thissite', 'aa8465428e3ec522c97eb8d9b0f86b725c11e2c3', 'jiggiemarket@gmail.com', '?OiO9vk*kyp#i$D', 5, 0, '195', '49', '14', '', '', 8, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Hat/b228d2392a543424de32b49da7c23a854091a1e6', 'Default Smile.png', 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', '73.141.75.202', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2015-05-19 18:43:04', 1, 0, 0, 0, 0, 20, 1432060582, 1432060582, 0, 0, 5, 0, 0, 0, '', 0),
('Moderator', 'b5b854a2394898531ba9aabe6bb7bdf71e6227d5', 'NemzoAndNamzo@gmail.com', 'A$CaMvQ9Ojp2n?O', 5, 0, '195', '52', '14', '', '', 11, 'Shirt/61b5440bf618406081628812ac7fe0eb9f23937c', 'Default Pants.png', 'Default Eyes.png', '', 'Hat/975c538f01f648df326960a118548fac5daa94cb', 'Default Smile.png', 0, 1, 1, 1, '', 0, 0, 0, 0, '', '', '86.27.73.10', 0, '', '', 1, 1, 298688, 1, 1, 1, 1, 1, 1, '', '2015-05-19 18:48:09', 1, 1, 1, 0, 0, 20, 1432060888, 1432060888, 0, 0, 6, 0, 0, 1, '', 1),
('RandomGuy', '3928591db41f35e19cfd5d0cdb756808a9706598', 'dunnovagames@gmail.com', 'pZgkxOwlu5g!*tW', 5, 0, '195', '42', '14', '', '', 0, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Default Hat.png', 'Default Smile.png', 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', '83.251.120.25', 0, '', '', 0, 0, 30, 0, 0, 0, 0, 0, 0, '', '2015-05-19 18:49:00', 1, 0, 0, 0, 0, 20, 1432060940, 1432060940, 0, 0, 7, 0, 0, 0, '', 0),
('System', 'f51c9d06ed678b78d551cd71daa48d029983a0df', 'electricvalor@gmail.com', '%y@h?bWUpKrXA2N', 5, 0, '205', '20', '13', '', 'I am Sounds from avatar-hangout.tk\r\n\r\nMy ROBLOX is Abstains.\r\n\r\n', 43, 'Shirt/28dbaea4ff5d7d1eead379ac952341deec17ad00', 'Pants/e7634b775e8cea0b87398b0ea477ef8ae1c65f65', 'Default Eyes.png', 'Shoe/064e83c10b3f15e55962b258e35e7d63e94964c3', 'Hat/468f8919f835983bd5da9e680ed911ba7c37aa16', 'Default Smile.png', 16, 0, 0, 0, '-Sounds', 0, 0, 0, 0, '', '', '205.151.163.28', 1432142105, '', '', 1, 0, 178, 1, 0, 0, 1, 0, 1, '', '2015-05-19 19:30:48', 1, 1, 1, 1, 2147483647, 20, 1432063447, 1432063447, 0, 0, 8, 1, 0, 1, '', 1),
('Mudkipz', '5817eaa6ddd1e92236781da6e0e7e6bb44004ee6', 'lambentlightz@gmail.com', '9WEoj?J&?78!9ZX', 5, 0, '205', '4', '13', '', '', 66, 'Shirt/120053830f2a5d7e6f42ccac09276bb07d75d528', 'Pants/e7634b775e8cea0b87398b0ea477ef8ae1c65f65', 'Default Eyes.png', 'Shoe/064e83c10b3f15e55962b258e35e7d63e94964c3', 'Hat/468f8919f835983bd5da9e680ed911ba7c37aa16', 'Default Smile.png', 2, 1, 1, 1, '', 0, 0, 0, 0, '', '', '50.200.173.94', 1432141365, 'Accessory/a304baff8c4301ab1185bfc4978c8edebe443a3b', '', 1, 1, 297548, 1, 1, 1, 1, 1, 1, '', '2015-05-19 19:32:17', 11, 1, 1, 1, 2147483647, 20, 1432063536, 1432063536, 0, 0, 9, 1, 0, 1, 'Community Moderator of Avatar Life.', 1),
('DDOSINGTHISSITE', 'aa8465428e3ec522c97eb8d9b0f86b725c11e2c3', 'cookiesfo@yahoo.com', '9qN@D0%SYWzDUP$', 5, 0, '195', '11', '16', '', '', 3, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Hat/1cadeaab42c8e5742ee7fbbcae01b7b2ce36adee', 'Default Smile.png', 0, 0, 0, 0, '', 1, 0, 0, 0, 'Any attempts to ddos the site is a auto IP ban, this may just be a username though', '013', '73.141.75.202', 0, 'Accessory/a304baff8c4301ab1185bfc4978c8edebe443a3b', '', 0, 0, 4, 0, 0, 0, 0, 0, 0, '', '2015-05-19 20:14:15', 1, 0, 0, 0, 0, 20, 1432066053, 1432066053, 1432066800, 0, 10, 0, 0, 0, '', 0),
('Crimmy', '773018c9c906e6e0463a15efe849e728e433bba3', 'inteyclol@gmail.com', 'Vj9QdIn7codd#1R', 5, 0, '195', '39', '16', '', '', 16, 'Shirt/4ad42ec5cd41001a6211eafb93ce929b85b47020', 'Pants/9a872d2c5938ea3f4512c45f976f58722935a967', 'Default Eyes.png', '', 'Hat/8d5fea80f4a6591e9fcc220ff43fb482e7557d95', 'Default Smile.png', 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', '173.176.123.129', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2015-05-19 20:31:32', 1, 0, 0, 0, 0, 20, 1432067115, 1432067115, 0, 0, 11, 0, 0, 0, '', 0),
('Random12343', '866981b601f5929a6a23693bda45a8693f62c6ef', 'random@gmail,com', 'yv4NiX*TVt%e#cw', 5, 0, '195', '30', '16', '', '', 1, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Default Hat.png', 'Default Smile.png', 0, 0, 0, 0, '', 1, 0, 0, 0, 'Test', 'TEST', '173.176.123.129', 0, '', '', 0, 0, 30, 0, 0, 0, 0, 0, 0, '', '2015-05-19 20:35:45', 1, 0, 0, 0, 0, 20, 1432067429, 1432067429, 1432067467, 0, 12, 0, 0, 0, '', 0),
('Jesus', '6db5fb18b21af80521fa7baed81c05601d2af457', 'gamingslayerhd@gmail.com', 'kPppg20CTfH%6Z2', 5, 0, '195', '46', '20', '', '', 6, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Default Hat.png', 'Default Smile.png', 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', '74.131.77.251', 0, '', '', 0, 0, 30, 0, 0, 0, 0, 0, 0, '', '2015-05-19 20:40:51', 1, 0, 0, 0, 0, 20, 1432067652, 1432067652, 0, 0, 13, 0, 0, 0, '', 0),
('Pewdiepie', '75d25669b3994ff012eaa1b0e5fdf4f4bac6f50a', '1@hotmail.com', 'dXx6hMwiqCa?GrF', 5, 0, '195', '0', '17', '', '', 3, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Default Hat.png', 'Default Smile.png', 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', '78.151.157.169', 0, '', '', 0, 0, 30, 0, 0, 0, 0, 0, 0, '', '2015-05-19 21:06:43', 1, 0, 0, 0, 0, 20, 1432069201, 1432069201, 0, 0, 14, 0, 0, 0, '', 0),
('Richard', '75d25669b3994ff012eaa1b0e5fdf4f4bac6f50a', '2@hotmail.com', 'G$XFfyUf&t1nFxm', 5, 0, '195', '2', '17', '', '', 1, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Hat/8d5fea80f4a6591e9fcc220ff43fb482e7557d95', 'Default Smile.png', 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', '78.151.157.169', 0, '', '', 0, 0, 20, 0, 0, 0, 0, 0, 0, '', '2015-05-19 21:08:29', 1, 0, 0, 0, 0, 20, 1432069306, 1432069306, 0, 0, 15, 0, 0, 0, '', 0),
('Nicholas', '58be2f2fd9ce156a2b5a8326ccb45a54bae9662e', 'sanfilippo@us-ltd.tk', '2t$oLhijALr0iTC', 5, 0, '195', '40', '17', '', '', 9, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Default Hat.png', 'Default Smile.png', 0, 1, 1, 1, '', 0, 0, 0, 0, '', '', '73.46.200.163', 0, '', '', 1, 1, 30000000, 1, 1, 1, 1, 1, 1, '', '2015-05-19 21:09:26', 1, 1, 1, 1, 2147483647, 20, 1432069366, 1432069366, 0, 0, 16, 1, 0, 0, '', 1),
('03F', '47a39d48c22e512da72ab83dce017ef8d6cd185f', '03f@gmail.com', '3XM2tYZ22*g?t?&', 5, 0, '205', '5', '13', '', '', 8, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Hat/456101b02768e3dc252ca86c60a283b4b51711b9', 'Default Smile.png', 0, 1, 1, 1, '', 0, 0, 0, 0, '', '', '86.147.78.215', 0, '', '', 1, 1, 29998000, 1, 1, 1, 1, 1, 1, '', '2015-05-19 21:12:11', 1, 1, 1, 1, 2147483647, 20, 1432069531, 1432069531, 0, 0, 17, 1, 0, 1, '', 1),
('PageTest1', '75d25669b3994ff012eaa1b0e5fdf4f4bac6f50a', '3@hotmail.com', 'gOkeW@w2QR22hzx', 5, 0, '195', '17', '17', '', '', 1, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Default Hat.png', 'Default Smile.png', 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', '78.151.157.169', 0, '', '', 0, 0, 30, 0, 0, 0, 0, 0, 0, '', '2015-05-19 21:23:21', 1, 0, 0, 0, 0, 20, 1432070225, 1432070225, 0, 0, 18, 0, 0, 0, '', 0),
('Darp', '7c7c94a5ca20ac195b547d4ab5eccd254413a92d', 'bloxd0groblox@gmail.com', '@kIMzaE$tzL5RX2', 5, 0, '195', '8', '21', '', 'Hello, I''m Darp!\r\n\r\nYoutube: Darpeh\r\nTwitter: @DarpehYT\r\nClub penguin: Darpeh\r\nWeeWorld: Darp\r\nSteam: Darpeh', 21, 'Shirt/28dbaea4ff5d7d1eead379ac952341deec17ad00', 'Pants/e7634b775e8cea0b87398b0ea477ef8ae1c65f65', 'Default Eyes.png', '', 'Hat/85a380bc274fedcead15b16df580a2195dbd7338', 'Default Smile.png', 5, 0, 0, 0, '', 0, 0, 0, 0, '', '', '184.100.108.205', 1432073253, '', '', 0, 0, 27, 0, 0, 0, 0, 0, 0, '', '2015-05-19 21:49:19', 1, 0, 0, 0, 0, 20, 1432071759, 1432071759, 0, 0, 19, 0, 0, 0, '', 0),
('Northeastwales', '58a72a8f7c37c5083cc0ed0c2b261342962a8cdf', 'robloxian211@gmail.com', 'parwFE1utB22nqw', 5, 0, '205', '17', '12', '', '', 32, 'Shirt/120053830f2a5d7e6f42ccac09276bb07d75d528', 'Pants/ae0f0c6c10650a44472d5fc4f27228a1bc5c8a87', 'Default Eyes.png', 'Shoe/064e83c10b3f15e55962b258e35e7d63e94964c3', 'Hat/85a380bc274fedcead15b16df580a2195dbd7338', 'Default Smile.png', 2, 0, 0, 0, '', 0, 0, 0, 0, '', '', '41.235.28.158', 1432087132, 'Accessory/a304baff8c4301ab1185bfc4978c8edebe443a3b', 'Background/9a638d15891454e298e92eb289b97ce83832f9d1', 1, 0, 34, 1, 0, 0, 0, 0, 0, '', '2015-05-19 21:50:00', 1, 0, 0, 0, 50000000, 0, 1432071802, 1432071802, 0, 0, 20, 0, 0, 0, '', 0),
('SweetVictory', '162272705aa2b44a2de8e4812ba4d4174f0c786f', 'coolepic66@yahoo.com', 'Wjw5Hzutcs?#DD1', 5, 0, '195', '18', '22', '', '', 16, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Default Hat.png', 'Default Smile.png', 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', '24.97.218.18', 0, '', '', 0, 0, 1, 0, 0, 0, 0, 0, 0, '', '2015-05-20 00:18:18', 1, 0, 0, 0, 0, 20, 1432080698, 1432080698, 0, 0, 21, 0, 0, 0, '', 0),
('PlasticSheep', 'dbabd7cc0f1c427ba2697fac43acf2b46bdb634c', 'verifiedingaming@gmail.com', '#?hQrsLZRm4&1eq', 5, 0, '205', '51', '12', '', '', 1, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Default Hat.png', 'Default Smile.png', 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', '92.6.141.149', 0, '', '', 1, 1, 300000, 1, 1, 1, 1, 1, 1, '', '2015-05-20 15:56:28', 1, 1, 1, 1, 2147483647, 20, 1432136987, 1432136987, 0, 0, 26, 1, 0, 0, 'm888', 1),
('Namesnipe', '50cdd9f65ff44f67506d52496754a1da98ab7d4a', 'junkauzii@gmail.com', '1uXYAM$86L%4T69', 5, 0, '195', '48', '20', '', '', 8, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Hat/9f19b0d08d0e7bb8bb29250e8ce38548168a26da', 'Default Smile.png', 1, 0, 0, 0, '', 0, 0, 0, 0, '', '', '67.168.195.145', 1432082800, '', '', 0, 0, 5, 0, 0, 0, 0, 0, 0, '', '2015-05-20 00:49:24', 1, 0, 0, 0, 0, 20, 1432082572, 1432082572, 0, 0, 22, 0, 0, 0, '', 0),
('Legit', 'c5c678288df8fb04308d04da894da84d82ce3062', 'brosthepiggy@gmail.com', 'nj@zGGk!tzZrFZ?', 5, 0, '195', '58', '20', '', '', 2, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Default Hat.png', 'Default Smile.png', 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', '104.240.32.47', 0, '', '', 0, 0, 30, 0, 0, 0, 0, 0, 0, '', '2015-05-20 01:03:49', 1, 0, 0, 0, 0, 20, 1432083426, 1432083426, 0, 0, 23, 0, 0, 0, '', 0),
('Loweras', 'e49dffadf719c39dd0f2053bf76ceb6e20ca3f76', 'nicholsderek94@yahoo.com', 'Skca8XwzFoRukUZ', 5, 0, '195', '30', '23', '', '', 4, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Hat/cea496b021c936e4aaeddc5613b03444c4a41c96', 'Default Smile.png', 4, 0, 0, 0, '', 0, 0, 0, 0, '', '', '173.25.78.195', 1432092612, 'Accessory/0f1c0609b8034c454087d89f02863785fb2f1240', '', 0, 0, 13, 0, 0, 0, 0, 0, 0, '', '2015-05-20 03:00:54', 1, 0, 0, 0, 0, 15, 1432090455, 1432090455, 0, 0, 24, 0, 0, 0, '', 0),
('LordGinka', 'e49dffadf719c39dd0f2053bf76ceb6e20ca3f76', 'knicklefish@gmail.com', '!FD&1er1li1YKp5', 5, 0, '195', '39', '23', '', '', 11, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Hat/85a380bc274fedcead15b16df580a2195dbd7338', 'Default Smile.png', 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', '173.25.78.195', 0, 'Accessory/0f1c0609b8034c454087d89f02863785fb2f1240', '', 0, 0, 12, 0, 0, 0, 0, 0, 0, '', '2015-05-20 03:01:19', 1, 0, 0, 0, 0, 20, 1432090481, 1432090481, 0, 0, 25, 0, 0, 0, '', 0),
('gingerjoe', 'c8ea78789ebb7f3b86f9433bdf071f6f6758b6ad', 'me@mrferru.com', 'iS8mhb7XQFR6?MF', 5, 0, '205', '50', '12', '', '', 5, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Hat/aefeb31b704d8a1896325b93970272700c39209e', 'Default Smile.png', 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', '151.225.149.100', 0, '', '', 0, 0, 30, 0, 0, 0, 0, 0, 0, '', '2015-05-20 15:57:41', 1, 0, 0, 0, 0, 20, 1432137065, 1432137065, 0, 0, 27, 0, 0, 0, '', 0),
('iiBlackHat', 'c81060152fe0e940bc56c6f102d1d6f28b1727ef', 'Wordsbyjack270@gmail.com', 'Zo&TKF8x4jmZwJI', 5, 1, '205', '27', '13', '', '', 0, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', 'Shoe/064e83c10b3f15e55962b258e35e7d63e94964c3', 'Hat/43227dca233ad96587f8cbd61cc12fe5264047ed', 'Default Smile.png', 1, 0, 0, 0, '', 0, 0, 0, 0, '', '', '74.130.94.130', 1432141539, '', '', 0, 0, 11, 0, 0, 0, 0, 0, 0, '', '2015-05-20 15:59:38', 1, 0, 0, 0, 0, 20, 1432137183, 1432137183, 0, 0, 28, 0, 0, 0, '', 0),
('devinjones22', '44ac6bdb7590f31613604638728b8eef681515bf', 'pl169012@ahschool.com', 'i2HWWCAYvOFDb1N', 0, 0, '', '', '', '', '', 0, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Default Hat.png', 'Default Smile.png', 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', '', 0, '', '', 0, 0, 20, 0, 0, 0, 0, 0, 0, '', '2015-05-20 16:09:23', 1, 0, 0, 0, 0, 20, 0, 0, 0, 0, 29, 0, 0, 0, '', 0),
('Tony', '264d1a69e8554ba6a0a6c0b180f32842a06fbe8e', 'Blocked', 'tbU!@mHsmwAcUy&', 7, 0, '205', '13', '12', '', '', 1, 'Default Shirt.png', 'Default Pants.png', 'Default Eyes.png', '', 'Default Hat.png', 'Default Smile.png', 0, 0, 0, 0, '', 0, 0, 0, 0, '', '', '86.140.13.46', 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2015-05-20 16:19:49', 1, 0, 0, 0, 0, 20, 1432138390, 1432138390, 0, 0, 30, 0, 0, 0, '', 0),
('Paradox', '8215149317cb095f8504df29c0549dbb8a005176', 'tony.broo@hotmail.com', 'LusFcWE%uz32HQ2', 5, 1, '205', '22', '13', '', '', 0, 'Default Shirt.png', 'Pants/ae0f0c6c10650a44472d5fc4f27228a1bc5c8a87', 'Default Eyes.png', 'Shoe/064e83c10b3f15e55962b258e35e7d63e94964c3', 'Hat/8d5fea80f4a6591e9fcc220ff43fb482e7557d95', 'Default Smile.png', 1, 0, 0, 0, '', 0, 0, 0, 0, '', '', '78.151.157.169', 1432142105, '', '', 0, 0, 10, 0, 0, 0, 0, 0, 0, '', '2015-05-20 17:21:28', 1, 0, 0, 0, 0, 20, 1432142097, 1432142097, 0, 0, 31, 0, 0, 0, '', 0);

