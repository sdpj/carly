-- phpMyAdmin SQL Dump
-- version 4.2.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 24, 2015 at 03:01 PM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE IF NOT EXISTS `alerts` (
`id` int(10) unsigned NOT NULL,
  `type` enum('normal','success','warning','danger') COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`id`, `type`, `text`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'success', 'Welcome to your new SANS 2.0 installation!', 1, '2015-05-24 16:00:00', '2015-05-24 16:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `api_keys`
--

CREATE TABLE IF NOT EXISTS `api_keys` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `badge_type`
--

CREATE TABLE IF NOT EXISTS `badge_type` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `badge_type`
--

INSERT INTO `badge_type` (`id`, `name`, `description`, `filename`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', 'This badge signifies that the user receiving it is an Administrator on the website, and as so is highly respectable.', 'administrator.png', '2015-05-23 20:00:00', '2015-05-23 20:00:00', NULL),
(2, 'Designer', 'This badge indicates that the recipient is a designer for the website, and assists in creating assets for the Store.', 'designer.png', '2015-05-23 20:00:00', '2015-05-23 20:00:00', NULL),
(3, 'Upgraded Member', 'The holder of this badge has upgraded their account and now has the perks of being an Upgraded Member.', 'upgraded.png', '2015-05-23 20:00:00', '2015-05-23 20:00:00', NULL),
(4, 'Verified User', 'A user receives this badge when they have verified their e-mail address.', 'verified.png', '2015-05-23 20:00:00', '2015-05-23 20:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `badge_user`
--

CREATE TABLE IF NOT EXISTS `badge_user` (
`id` int(10) unsigned NOT NULL,
  `badge_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `badge_user`
--

INSERT INTO `badge_user` (`id`, `badge_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2015-05-23 20:00:00', '2015-05-23 20:00:00', NULL),
(2, 2, 1, '2015-05-23 20:00:00', '2015-05-23 20:00:00', NULL),
(3, 3, 1, '2015-05-23 20:00:00', '2015-05-23 20:00:00', NULL),
(4, 4, 1, '2015-05-23 20:00:00', '2015-05-23 20:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bans`
--

CREATE TABLE IF NOT EXISTS `bans` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `length` enum('warning','1_day','3_day','7_day','14_day','1_month','permanent') COLLATE utf8_unicode_ci NOT NULL,
  `expiry` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE IF NOT EXISTS `chat_messages` (
`id` bigint(20) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
`id` int(10) unsigned NOT NULL,
  `install_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sitename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `userstore` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sitedomain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency_1` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `themename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profanity` tinyint(1) NOT NULL DEFAULT '0',
  `maintenance` enum('off','maintenance','emergency_maintenance') COLLATE utf8_unicode_ci NOT NULL,
  `recovery_key` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `install_time`, `sitename`, `sitedomain`, `description`, `currency_1`, `themename`, `profanity`, `maintenance`, `recovery_key`, `updated_at`) VALUES
(1, NULL, '', '', '', '', '', 0, 'off', '', '2015-05-24 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `economy`
--

CREATE TABLE IF NOT EXISTS `economy` (
`id` int(10) unsigned NOT NULL,
  `type` enum('daily','weekly','monthly') COLLATE utf8_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forum_categories`
--

CREATE TABLE IF NOT EXISTS `forum_categories` (
`id` int(10) unsigned NOT NULL,
  `order` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `forum_categories`
--

INSERT INTO `forum_categories` (`id`, `order`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'General Topics', '2015-05-23 20:00:00', '2015-05-23 20:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forum_posts`
--

CREATE TABLE IF NOT EXISTS `forum_posts` (
`id` int(10) unsigned NOT NULL,
  `thread` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `post_editor` int(11) NOT NULL,
  `old_body` text COLLATE utf8_unicode_ci NOT NULL,
  `scrubbed_body` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forum_seen`
--

CREATE TABLE IF NOT EXISTS `forum_seen` (
`id` int(10) unsigned NOT NULL,
  `thread` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forum_threads`
--

CREATE TABLE IF NOT EXISTS `forum_threads` (
`id` int(10) unsigned NOT NULL,
  `topic` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT '0',
  `sticky` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE IF NOT EXISTS `forum_topics` (
`id` int(10) unsigned NOT NULL,
  `order` int(11) NOT NULL,
  `category` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` (`id`, `order`, `category`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'General Discussion', 'For all threads related to the website', '2015-05-23 20:00:00', '2015-05-23 20:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inventories`
--

CREATE TABLE IF NOT EXISTS `inventories` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `category` enum('clothing','headgear','accessories','addons') COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `currency_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'currency_1',
  `cost` int(11) NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
`id` int(10) unsigned NOT NULL,
  `type` enum('login_success','login_failure','stipend','change_email','change_password','verification','item_purchase','donation_out','donation_in') COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `old_data` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `new_data` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data_3` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` enum('stipend') COLLATE utf8_unicode_ci NOT NULL,
  `sender_id` int(11) NOT NULL,
  `seen` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `password_reminders`
--

CREATE TABLE IF NOT EXISTS `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'CanDonate', 'Determines if the user can send donations or not', '2014-12-24 21:00:00', '2014-12-24 21:00:00'),
(2, 'CanUpload', 'Determines if the user can upload to the store', '2014-12-30 21:00:00', '2014-12-30 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
`id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `permission_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `role_id`, `permission_id`) VALUES
(1, 4, 1),
(2, 3, 2),
(3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `private_messages`
--

CREATE TABLE IF NOT EXISTS `private_messages` (
`id` int(10) unsigned NOT NULL,
  `sender_id` int(11) NOT NULL,
  `recipient_id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `seen` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
`id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2015-05-23 20:00:00', '2015-05-23 20:00:00'),
(2, 'Moderator', '2015-05-23 20:00:00', '2015-05-23 20:00:00'),
(3, 'Designer', '2015-05-23 20:00:00', '2015-05-23 20:00:00'),
(4, 'Upgraded', '2015-05-23 20:00:00', '2015-05-23 20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `slots`
--

CREATE TABLE IF NOT EXISTS `slots` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `slot1` int(11) NOT NULL,
  `slot2` int(11) NOT NULL,
  `slot3` int(11) NOT NULL,
  `slot4` int(11) NOT NULL,
  `slot5` int(11) NOT NULL,
  `slot6` int(11) NOT NULL,
  `slot7` int(11) NOT NULL,
  `slot8` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stipend_log`
--

CREATE TABLE IF NOT EXISTS `stipend_log` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `stipend_amount` int(11) NOT NULL,
  `balance_before` int(11) NOT NULL,
  `balance_after` int(11) NOT NULL,
  `type` enum('initial','daily','','') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `regip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `last_activity` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `currency_1` int(11) NOT NULL DEFAULT '15',
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'UTC',
  `gender` enum('male','female','other','') COLLATE utf8_unicode_ci DEFAULT NULL,
  `race` enum('white','black','asian','') COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `signature` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_banner` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stipend_1_amount` int(11) NOT NULL DEFAULT '15',
  `last_stipend` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `firstlogin` tinyint(1) NOT NULL DEFAULT '1',
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `verify_token` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
`id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api_keys`
--
ALTER TABLE `api_keys`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `badge_type`
--
ALTER TABLE `badge_type`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `badge_user`
--
ALTER TABLE `badge_user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bans`
--
ALTER TABLE `bans`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `economy`
--
ALTER TABLE `economy`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_categories`
--
ALTER TABLE `forum_categories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_posts`
--
ALTER TABLE `forum_posts`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_seen`
--
ALTER TABLE `forum_seen`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_threads`
--
ALTER TABLE `forum_threads`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum_topics`
--
ALTER TABLE `forum_topics`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventories`
--
ALTER TABLE `inventories`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reminders`
--
ALTER TABLE `password_reminders`
 ADD KEY `password_reminders_email_index` (`email`), ADD KEY `password_reminders_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
 ADD PRIMARY KEY (`id`), ADD KEY `permission_role_role_id_foreign` (`role_id`), ADD KEY `permission_role_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `private_messages`
--
ALTER TABLE `private_messages`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `slots`
--
ALTER TABLE `slots`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stipend_log`
--
ALTER TABLE `stipend_log`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
 ADD PRIMARY KEY (`id`), ADD KEY `user_role_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `api_keys`
--
ALTER TABLE `api_keys`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `badge_type`
--
ALTER TABLE `badge_type`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `badge_user`
--
ALTER TABLE `badge_user`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `bans`
--
ALTER TABLE `bans`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `economy`
--
ALTER TABLE `economy`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forum_categories`
--
ALTER TABLE `forum_categories`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `forum_posts`
--
ALTER TABLE `forum_posts`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forum_seen`
--
ALTER TABLE `forum_seen`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forum_threads`
--
ALTER TABLE `forum_threads`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `forum_topics`
--
ALTER TABLE `forum_topics`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `inventories`
--
ALTER TABLE `inventories`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `private_messages`
--
ALTER TABLE `private_messages`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `slots`
--
ALTER TABLE `slots`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stipend_log`
--
ALTER TABLE `stipend_log`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
ADD CONSTRAINT `user_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
